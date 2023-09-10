@extends('layouts.app')

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
<div class=" min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto ">
        <div>
            <form method="POST" action="/products" id="formId" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600 ">
                            <input
                                class="border border-lg w-full h-80 mt-3 p-3 rounded-lg bg-gray-100 text-center font-bold"
                                type="file" name="image" placeholder="Add Product image (+) ">
                        </div>
                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <input type="text" name="name" placeholder="Product name" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                    </div>

                                    <div class="md:col-span-5">
                                        <input type="text" name="description" id="description"
                                            class="h-40 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                            placeholder="Product Description " />
                                    </div>

                                    <div class="md:col-span-2">
                                        <input type="number" name="price" id="price"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                            placeholder="Product Price" />
                                    </div>

                                    <div class="md:col-span-3"> Choose a color
                                        <input type="hidden" id="colorsList" name="colors" value="">
                                        <input type="text" name="color" id="color"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                            placeholder="Product Color" />
                                        <div id="colorPreview" class="h-10 w-10 mt-1 rounded-lg ml-2"></div>
                                    </div>

                                    <div class="md:col-span-3">
                                        <button id="addColorBtn" type="button"
                                            class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Add Color</button>
                                    </div>
                                    <div class="md:col-span-3">
                                        <ul id="colorList" class="list-disc pl-5"></ul>
                                    </div>

                                    <div class="md:col-span-2">
                                        <input type="number" name="offer_value" id="offer_value"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                            placeholder="Offer Value if any ( % )" />
                                    </div>

                                    <div class="md:col-span-3">
                                        <input type="checkbox" name="has_offer" id="has_offer" class="h-5 w-5 pt-2 mt-3" />
                                        <span class="text-center rounded px-4 w-full bg-gray-50">Offer on this product</span>
                                    </div>
                                    <div class="md:col-span-5 text-right">
                                    <button style="background-color: black;" type="submit" class="rounded-lg bg-back hover:bg-black-700 text-white w-full font-bold py-2 px-4 rounded">Add Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('scripts')
    <script src="/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>


    <script>
        $(document).ready(function() {
            const colorInput = $('#color');
            const colorPreview = $('#colorPreview');

            // Initialize Spectrum Color Picker
            colorInput.spectrum({
                showInput: true,
                allowEmpty: true,
                preferredFormat: 'hex',
                showAlpha: true,
                change: function(color) {
                    // Update the color preview element with the selected color
                    colorPreview.css('background-color', color.toHexString());
                },
            });

            // Initialize an array to store selected colors
            let selectedColors = [];

            // Event listener for the "Add Color" button
            $('#addColorBtn').on('click', function() {
                const selectedColor = $('#color').spectrum('get').toHexString();
                if (selectedColor) {
                    selectedColors.push(selectedColor);
                    updateColorList(selectedColors);
                    // Clear the color picker input
                    $('#color').spectrum('set', null);
                }
            });

            // Event listener for changes in the "has_offer" checkbox
            $('#has_offer').on('change', function() {
                // Check if "has_offer" is checked
                if ($(this).prop('checked')) {
                    // Enable the "offer_value" input
                    $('#offer_value').prop('disabled', false);
                } else {
                    // If "has_offer" is not checked, set "offer_value" to zero and disable the input
                    $('#offer_value').val('0').prop('disabled', true);
                }
            });

            // Function to update the color list
            function updateColorList(colors) {
                const colorList = $('#colorList');
                colorList.empty();
                colors.forEach(function(color) {
                    colorList.append(`<li>${color}</li>`);
                });
            }

            // Event listener for form submission
            $('#formId').on('submit', function(e) {
                e.preventDefault();
                console.log("i'm here")
                // Join selectedColors array into a comma-separated string
                // const colorString = selectedColors.map(color => color.slice(1)).join(',')
                const colorString = selectedColors.join(',')
                // Add the color string to a hidden input field in the form
                // $('#colorInput').val(colorString);
                $("input#colorsList").val(colorString)
                // Now, you can submit the form
                e.target.submit()
            });
        });
    </script>
@endsection
