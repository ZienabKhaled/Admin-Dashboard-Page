@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('urlToTailwind')
    <!-- add tailwind css -->
    @vite('resources/css/app.css')
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<!-- component -->
<div class="p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto ">
      <div>
        <form method="POST" action="{{ route('products.edit', $product->id) }}" id="formId" enctype="multipart/form-data">
            @csrf
            @method('PUT')

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
          <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-gray-600">
                <form >
                    @if($product->image)
              <img
              src="{{ strstr($product->image->image, 'via.placeholder.com') ? $product->image->image : Storage::url($product->image->image) }}"
              >
              @else
              <img
              src="https://images.unsplash.com/photo-1674296115670-8f0e92b1fddb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
              >
                @endif
                <button class="border border-lg border-gray-700 mt-3 p-3 rounded-lg bg-gray-100 text-center font-bold">
                    <input type="file" name="image">
                </button>

            </div>

            <div class="lg:col-span-2">
              <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-5">
                    <label class="font-bold">Product Name:</label>
                  <input type="text" name="name" value="{{ $product->name }}" id="full_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                </div>

                <div class="md:col-span-5">
                    <label class="font-bold">Product Description:</label>
                  <input type="text" name="description" id="description" class="h-40 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $product->description }} " />
                </div>

                <div class="md:col-span-2">
                    <label class="font-bold">Product Price:</label>
                  <input type="text" name="price" id="price" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $product->price}}"  />
                </div>

                <div class="md:col-span-5">
                    {{-- @if ($product->colors->isNotEmpty()) --}}
                    <span class="font-bold"> Product Colors :</span>
                    @foreach ($product->colors as $color)
                        <input type="color" id="color" value={{ $color->color }}
                            style="background-color:{{ $color->color }}" />
                    @endforeach
                    {{-- @else --}}
                    <div class="font-bold"> Change Colors: </div>
                    <input type="text" placeholder="Add hexadecimal colors Like #FFFFFF"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" name="color" id="color"  />
                    {{-- @endif --}}

                </div>

                <div class="md:col-span-2">
                    <label class="font-bold">Offer Value:</label>
                    <input type="number" name="offer_value" id="offer_value"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $product->is_offer ? $product->offer_value : '' }}"
                     />
                  </div>

                  <div class="md:col-span-3">
                      <input type="checkbox" name="has_offer" id="has_offer"
                      {{ $product->is_offer ? 'checked' : '' }} class="h-5 w-5 pt-2 mt-3"/>
                      <span
                      class="text-center rounded px-4 w-full bg-gray-50"
                      >Offer on this product</span>
                  </div>

                <div class="md:col-span-1 text-right">
                    <button style="background-color: black;" type="submit" class="rounded-lg bg-back hover:bg-black-700 text-white w-full font-bold py-2 px-4 rounded">Edit Product </button>
                </form>
                </div>

                <div class="md:col-span-1 text-right">
                      <a href="{{ route('products.index') }}">
                    <button style="background-color: green;" type="button" class="rounded-lg bg-back hover:bg-black-700 text-white w-full font-bold py-2 px-4 rounded">Go Back </button>
                      </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    @endsection
