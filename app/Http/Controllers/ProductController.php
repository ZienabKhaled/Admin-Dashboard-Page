<?php

namespace App\Http\Controllers;


use App\Repositories\ControllerRepository;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Repositories\ControllerInterface;
use Yajra\DataTables\DataTables;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Product;

class ProductController extends Controller
{
/**
 * The function is a constructor that initializes a private property with a value passed as a
 * parameter.
 *
 * @param ControllerInterface controllerRepository The parameter `` is of type
 * `ControllerInterface`. It is being injected into the constructor of the class.
 */

    private $controllerRepository;

    public function __construct(ControllerInterface $controllerRepository)
    {
        $this->controllerRepository = $controllerRepository ;
    }
    
/**
 * The index function retrieves all products from the controller repository and passes them to the view
 * for display.
 *
 * @return a view called 'products.index' with an array of products as the data.
 */

    //index function
    public function index()
    {
        $allProducts = $this->controllerRepository->getAllProducts();
        return view('products.index',[
            'products'=>$allProducts,
        ]);
    }


  /**
   * The function "show" retrieves a product by its ID and displays it on the "products.show" view.
   *
   * @param productId The `productId` parameter is the unique identifier of the product that needs to
   * be shown. It is used to retrieve the product from the database using the `findById` method of the
   * `controllerRepository`.
   *
   * @return a view called 'products.show' with the product data passed as a parameter.
   */
    //show one product
    public function show($productId)
    {
        $product = $this->controllerRepository->findById($productId);
        // if ($product->trashed()) {
        //     abort (403,'This product is deleted');
        // }
        return view('products.show',[
            'product'=>$product,
        ]);
    }

    //create a product from dashboard
    public function create()
    {
        return view('products.create');
    }
/**
 * The function stores a created product and redirects to the index page.
 *
 * @param StoreRequest request The `` parameter is an instance of the `StoreRequest` class. It
 * is used to retrieve and validate the data submitted in the request.
 *
 * @return The code is returning a redirect response to the "products.index" route.
 */

    //store created product
    public function store(StoreRequest $request)
    {
        $this->controllerRepository->store($request);
        return redirect()->route('products.index');
    }

   /**
    * The above function retrieves a product by its ID and returns a view for updating the product.
    *
    * @param productId The productId parameter is the unique identifier of the product that needs to be
    * edited. It is used to retrieve the specific product from the database using the findById method
    * of the controllerRepository.
    *
    * @return a view called 'products.update' with a variable called 'product' that contains the
    * product data retrieved from the controller repository.
    */
    //edit get route
    public function edit($productId)
    {
        $product = $this->controllerRepository->findById($productId);
        return view('products.update', [
        'product' => $product,
        ]);
    }

    //update a certain product
    public function update (UpdateRequest $request , $productId)
    {
        $this->controllerRepository->update($request, $productId);
        return redirect()->route('products.index');
    }

    //delete a certain product
    public function destroy($productId)
    {
        $this->controllerRepository->destroy($productId);
        return back();
    }

    //restore a certain product
    public function restore($productId)
    {
        $this->controllerRepository->restore($productId);
        return back();
    }
}
