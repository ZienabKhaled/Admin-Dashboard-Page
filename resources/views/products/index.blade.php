@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('urlToTailwind')
    <!-- add tailwind css -->
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class=" grid lg:grid-cols-4 md:grid-cols-2">
        <!-- component -->

        <div
            class=" mx-auto mt-11 h-90 bg-gray-100 w-80 transform overflow-hidden rounded-lg dark:bg-slate-800 shadow-md duration-300 hover:scale-105 hover:shadow-lg">
            <a href="{{ route('products.create') }}">
                <button class="bg-black h-full w-full h-20 text-white text-2xl"> Add A new Product </button>
            </a>
        </div>

        <!-- component -->
        @foreach ($products as $product)
            <div
                class="mx-auto mt-11 w-80 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md duration-300 hover:scale-105 hover:shadow-lg
        {{ $product->trashed() ? 'opacity-50' : '' }}">

                <a href="{{ $product->trashed() ? '' : route('products.show', $product->id) }}">
                    @if ($product->image)
                        <img class="h-48 w-full object-cover object-center"
                            src="{{ strstr($product->image->image, 'via.placeholder.com') ? $product->image->image: Storage::url($product->image->image) }}"
                            alt="Product Image" />
                    @else
                        <img class="h-48 w-full object-cover object-center"
                            src="https://images.unsplash.com/photo-1674296115670-8f0e92b1fddb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                            alt="Product Image" />
                    @endif

                    <div class="p-4">
                        <h2 class="mb-2 text-lg font-medium dark:text-white text-gray-900">{{ $product->name }}</h2>
                        <p class="mb-2 text-base dark:text-gray-300 text-gray-700">{{ $product->description }}</p>

                        @if ($product->colors->isNotEmpty())
                            <p class="mb-2 text-base dark:text-gray-300 text-gray-700">
                                <span style="color: red; font-weight:bold;">Product Color:</span>
                                {{ $product->colors->first()->color }}
                            </p>
                        @endif

                        @if ($product->is_offer)
                            <div class="flex items-center">
                                <p class="mr-2 text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($product->price * ((100 - $product->offer_value) / 100), 2) }}</p>
                                <p class="text-base  font-medium text-gray-500 line-through dark:text-gray-300">
                                    {{ $product->price }}</p>
                                <p class="ml-auto text-base font-medium text-green-500">% {{ $product->offer_value }}</p>
                            </div>
                        @else
                            <div class="flex items-center">
                                <p class="mr-2 text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $product->price }}</p>
                            </div>
                        @endif

                        @if ($product->trashed())
                            <form action="{{ route('products.restore', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="w-full bg-green-500 text-white rounded-lg text-sm px-5 py-2.5 my-2 text-center">Restore
                                    Product</button>
                            </form>
                        @else
                            <a href="{{ route('products.update', $product->id) }}">
                                <button
                                    class="w-full bg-black text-white rounded-lg text-sm px-5 py-2.5 my-2 text-center">Edit
                                    Product</button>
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-500 text-white rounded-lg text-sm px-5 py-2.5 my-2 text-center">Delete
                                    Product</button>
                            </form>
                        @endif

                    </div>
                </a>
            </div>
        @endforeach

    </div>
@endsection

@section('scripts')
    <script src="/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection
