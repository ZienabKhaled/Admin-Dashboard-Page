<?php
namespace App\Repositories;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
// use Symfony\Component\HttpFoundation\Request;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use DataTables;
use Spatie\Backtrace\File;


class ControllerRepository implements ControllerInterface
{
    //index function
    public function getAllProducts()
    {
        return Product::withTrashed()->orderBy('created_at', 'desc')->get();
        //return Product::withTrashed()->orderBy('created_at', 'desc')->orderBy('deleted_at', 'asc')->get();

    }

    // show one product
    public function findById($productId)
    {

        return Product::findOrFail($productId);
    }

    //store one product
    public function store(StoreRequest $request)
    {
        //store the image  (php artisan storage:link)
        $path = Storage::putFile('public', $request->file('image'));
        //fetch all data from request
        $data = $request->all();
        //Fetch the inputs from the HTML (it's stored in string format)
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $colors = $data['colors'];

        //to split a comma-separated string of colors into an array
        $colorsArr = explode(',', $colors);
        // array_unique is like a set in js
        $uniqueColors = array_unique($colorsArr);

        if ($request->has("has_offer") && $request->get('has_offer') == "on") {
            $has_offer = true;
            $offer_value = floatval($data['offer_value']);
        }
        else {
            $has_offer=false ;
            $offer_value = 0;
        }

        $product = Product::create([
            'name'=> $name,
            'description'=> $description,
            'price' => $price,
            'offer_value' => $offer_value,
            'is_offer' => $has_offer,
        ]);
        // Create and associate the product image
        $productImage = new ProductImage(['image' => $path]);
        // $product->image = $productImage;
        $product->image()->save($productImage);

        // iterate over each color and create a new product color instance
        foreach ($uniqueColors as $color) {
            // Create and associate the product color
            $productColor = new ProductColor(['color' => $color]);
            $product->colors()->save($productColor);
        }
        return $product;
    }


    public function update(UpdateRequest $request, $productId)
    {
    $product = Product::findOrFail($productId);

    if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public');
            $productImage = new ProductImage(['image' => $path]);

            if ($product->image){
                // Storage::delete($product->image);
                $oldImagePath = storage_path('app/' . $product->image->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file
                }
                $product->image->delete();
            }
            $product->image()->save($productImage);
        }

        // Update other product inputs
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->is_offer = $request->has('has_offer');

        // Update the 'offer_value' only if 'has_offer' is true
        if ($product->is_offer) {
            $product->offer_value = floatval($request['offer_value']);
        } else {
            $product->offer_value = 0;
        }

        // Update the colors associated with the product
        $colors = $request['color'];
        if ($colors) {
            $colorArr = explode(',', $colors);
            $product->colors()->delete(); // Remove existing colors

            foreach ($colorArr as $color) {
                // Create and associate the product color
                $productColor = new ProductColor(['color' => $color]);
                $product->colors()->save($productColor);
            }
        }

        // Save the changes to the product
        $product->save();

        return $product;
    }

    // destroy
    public function destroy($productId)
    {
        return Product::find($productId)->delete();
    }

    //restore
    public function restore($productId)
    {
        return Product::withTrashed()->find($productId)->restore();
    }
}
