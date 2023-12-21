@extends('layouts.template')
@section('content')
    <div class="mx-2 lg:mx-20 flex flex-col lg:flex-row h-auto lg:mt-12 ">
        <div class="w-0 lg:w-1/4">
            <!-- Left Sidebar -->
        </div>
        <div class="w-full lg:w-2/4">
            @foreach ($categories as $category)
                <div class="bg-white border border-gray-300 shadow-lg rounded-lg p-4 mb-4">
                    <h2 class="text-2xl font-semibold mb-2" style="font-family: 'Diphylleia', sans-serif">
                        <button class="category-toggle focus:outline-none">
                            {{ $category->name }}
                        </button>
                    </h2>

                    <div class="grid grid-cols-1 gap-2 category-content hidden">
                        @foreach ($menus as $menu)
                            @if ($menu->category_id == $category->id && $menu->is_alcohol == 0)
                                <div class="relative bg-gray-100 rounded-md p-2 menu-item my-2 border-b border-gray-300">
                                    @if (isset($menu->photo))
                                        <div
                                            class="popup hidden bg-white border border-gray-300 shadow-lg rounded-md p-4 absolute bottom-0 right-0 lg:right-40 ">
                                            <img class="w-20 h-20 object-scale-down"
                                                src="{{ asset('storage/' . $menu->photo) }}" alt="Menu Image">
                                        </div>
                                    @endif

                                    <div class="grid grid-cols-3 gap-2 items-center">
                                        <img class="hidden w-24 h-24 object-scale-down"
                                            src="{{ asset('storage/' . $menu->photo) }}" alt="Menu Image">
                                        <div class="col-span-2">
                                            <span class="font-semibold">{{ $menu->name }}</span>
                                            <p class="text-gray-600 text-xs mt-1">
                                                {{ $menu->description }}
                                            </p>
                                        </div>
                                        <div class="flex justify-end">
                                            <span
                                                class="text-gray-500 text-sm">Rp.{{ number_format($menu->price, 0, ',', '.') }},00</span>
                                        </div>
                                    </div>

                                    <div class="lg:flex lg:justify-end lg:mt-2">
                                        <div class="lg:flex lg:space-x-2 lg:ml-auto">
                                            <button
                                                class="subtractBtn px-2 py-1 border border-gray-300 rounded-md bg-gray-200"
                                                onclick="subtractQuantity('{{ $menu->id }}')">-</button>
                                            <input
                                                class="quantityInput w-14 text-center border border-gray-300 rounded-md bg-gray-200"
                                                type="number" value="0" disabled>
                                            <button class="addBtn px-2 py-1 border border-gray-300 rounded-md bg-gray-200"
                                                onclick="addQuantity('{{ $menu->id }}')">+</button>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($menu->category_id == $category->id && $menu->is_alcohol == 1)
                                <div class="relative bg-gray-100 rounded-md p-2 menu-item my-2 border-b border-gray-300">
                                    @if (isset($menu->photo))
                                        <div
                                            class="popup hidden bg-white border border-gray-300 shadow-lg rounded-md p-4 absolute bottom-0 right-0 lg:right-40 ">
                                            <img class="w-20 h-20 object-scale-down"
                                                src="{{ asset('storage/' . $menu->photo) }}" alt="Menu Image">
                                        </div>
                                    @endif
                                    <div class="grid grid-cols-3 gap-2 items-center">
                                        <img class="hidden w-24 h-24 object-scale-down"
                                            src="{{ asset('storage/' . $menu->photo) }}" alt="Menu Image">
                                        <div class="col-span-2">
                                            <span class="font-semibold">{{ $menu->name }}</span>
                                            <p class="text-gray-600 text-xs mt-1">
                                                {{ $menu->description }}. Alcohol percentage: {{ $menu->{'alcohol%'} }}%
                                            </p>
                                        </div>
                                        <div class="flex justify-end">
                                            <span
                                                class="text-gray-500 text-sm">Rp.{{ number_format($menu->price, 0, ',', '.') }},00</span>
                                        </div>
                                    </div>



                                    <div class="lg:flex lg:justify-end lg:mt-2">
                                        <div class="lg:flex lg:space-x-2 lg:ml-auto">
                                            <button
                                                class="subtractBtn px-2 py-1 border border-gray-300 rounded-md bg-gray-200"
                                                onclick="subtractQuantity('{{ $menu->id }}')">-</button>
                                            <input
                                                class="quantityInput w-14 text-center border border-gray-300 rounded-md bg-gray-200"
                                                type="number" value="0" disabled>
                                            <button class="addBtn px-2 py-1 border border-gray-300 rounded-md bg-gray-200"
                                                onclick="addQuantity('{{ $menu->id }}')">+</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            <form action="" method="GET">
                @csrf

                <div class="flex flex-col md:flex-row justify-end items-end mt-2">
                    <div class="flex items-center pb-4 md:pb-0">
                        <label for="Total" class="mr-2">Total:</label>
                        <input class="Totalinput px-2 py-1 border rounded md:mr-4" type="number" value="" disabled>
                    </div>
                    <div class="flex items-center pb-4 md:pb-0">
                        <label for="table_number" class="mr-2">Table number:</label>
                        <input type="number" id="table_number" name="table_number" class="px-2 py-1 border rounded w-16"
                            required>
                    </div>
                    <div class="ml-4 pb-4 md:pb-0">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Order</button>
                    </div>
                </div>
            </form>



        </div>
        <div class="w-0 lg:w-1/4">
            <!-- Left Sidebar -->
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle category content
            const toggleButtons = document.querySelectorAll('.category-toggle');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const content = this.parentNode.nextElementSibling;
                    if (content.style.display === 'none' || content.style.display === '') {
                        content.style.display = 'block';
                    } else {
                        content.style.display = 'none';
                    }
                });
            });

            // Function for subtracting quantity
            function subtractQuantity(menuId) {
                const quantityInput = document.getElementById(`quantityInput_${menuId}`);
                let quantity = parseInt(quantityInput.value);
                if (quantity > 0) {
                    quantity--;
                    quantityInput.value = quantity;
                }
            }

            // Function for adding quantity
            function addQuantity(menuId) {
                const quantityInput = document.getElementById(`quantityInput_${menuId}`);
                let quantity = parseInt(quantityInput.value);
                quantity++;
                quantityInput.value = quantity;
            }

            // Event delegation for subtract and add buttons
            $(document).on('click', '.subtractBtn', function() {
                const quantityInput = $(this).siblings('.quantityInput');
                let quantity = parseInt(quantityInput.val());
                if (quantity > 0) {
                    quantity--;
                    quantityInput.val(quantity);
                }
            });

            $(document).on('click', '.addBtn', function() {
                const quantityInput = $(this).siblings('.quantityInput');
                let quantity = parseInt(quantityInput.val());
                quantity++;
                quantityInput.val(quantity);
            });
        });
    </script>
@endsection
