<?php

namespace App\Http\Controllers;


use App\Repositories\ControllerRepository;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Repositories\ControllerInterface;

class ProductController extends Controller
{

    private $controllerRepository;

    public function __construct(ControllerInterface $controllerRepository)
    {
        $this->controllerRepository = $controllerRepository ;
    }

    //index function
    public function index()
    {
        $allProducts = $this->controllerRepository->getAllProducts();
        return view('products.index',[
            'products'=>$allProducts,
        ]);
    }

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

    //store created product
    public function store(StoreRequest $request)
    {
        $this->controllerRepository->store($request);
        return redirect()->route('products.index');
    }

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
