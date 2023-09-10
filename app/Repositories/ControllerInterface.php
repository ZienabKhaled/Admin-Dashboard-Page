<?php

namespace App\Repositories;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;

interface ControllerInterface
{
    public function getAllProducts();

    public function findById($productId);

    public function store(StoreRequest $request);

    public function update(UpdateRequest $request, $productId);

    public function destroy($productId);

    public function restore($productId);

}
