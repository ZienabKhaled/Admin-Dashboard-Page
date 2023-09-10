@extends('layouts.app')

@section('urlToTailwind')
    <!-- add tailwind css -->
    @vite('resources/css/app.css')
@endsection

@section('content')

    <!-- component -->
    <div class=" p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto ">
            <div>
                <h1 class="font-medium text-2xl">Product Details</h1>
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            @if ($product->image)
                                    <img src="{{ strstr($product->image->image, 'via.placeholder.com') ? $product->image->image : Storage::url($product->image->image) }}"
                                        alt="image">
                                @else
                                    <img class="h-48 w-full object-cover object-center"
                                        src="https://images.unsplash.com/photo-1674296115670-8f0e92b1fddb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="Product Image" />
                            @endif
                        </div>

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-5">
                                <h1 style="font-size: 25px ; color:#033222">Product name: {{ $product->name }}</h1>
                            </div>

                            <div class="md:col-span-5 mt-3">
                                <h2 class="font-bold">Product Description:</h2>
                                <p> {{ $product->description }}</p>
                            </div>

                            <div class="md:col-span-2 mt-5">
                                <p><span class="font-bold">Product Price
                                    </span>{{ number_format($product->price * ((100 - $product->offer_value) / 100), 2) }}$
                                </p>
                            </div>

                            <div class="md:col-span-5">
                                @if ($product->colors->isNotEmpty())
                                <span class="font-bold"> Product Colors :</span>
                                @else
                                <span class="line-through" style="color: red">No Colors for this product</span>
                                @endif
                                @foreach ($product->colors as $color)
                                <div class="w-40 h-10 m-2 bg-{{ $color->color }}" style="background-color:{{ $color->color }}"> </div>
                                    {{-- <input type="color" name="product_color" id="color" value={{ $color->color }}
                                        style="background-color:{{ $color->color }}" /> --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script src="/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
@endsection
