@extends('layouts.template')
@section('content')
<div class="mx-2 lg:mx-20 flex flex-col lg:flex-row h-auto lg:mt-12 ">
        <div class="w-0 lg:w-1/4">
            <!-- Left Sidebar -->
        </div>
        <div class="w-full lg:w-2/4">
            @foreach ($categories as $category)
                <div class="bg-white border border-gray-300 shadow-lg rounded-lg p-4 mb-4">
                    <h2 class="text-2xl font-semibold mb-2" style="font-family: 'Diphylleia', sans-serif">{{ $category->name }}</h2>
                    <div class="grid grid-cols-1 gap-2">
                        @foreach ($menus as $menu)
                            @if ($menu->category_id == $category->id &&$menu->is_alcohol==0)
                            <div class="bg-gray-100 rounded-md p-2">
                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <div class="col-span-2">
                                        <span class="font-semibold" style="font-family: 'Diphylleia', sans-serif">{{ $menu->name }}</span>
                                        <p class="text-gray-600 text-xs mt-1">{{ $menu->description }}</p>
                                    </div>
                                    <div class="flex justify-end">
                                        <span class="text-gray-500 text-sm">Rp.{{ number_format($menu->price, 0, ',', '.') }},00</span>
                                    </div>
                                </div>

                                <div class="lg:flex lg:justify-end lg:mt-2">
                                    <div class="lg:flex lg:space-x-2 lg:ml-auto">
                                        <button id="subtractBtn" class="px-2 py-1 border border-gray-300 rounded-md bg-gray-200" onclick="subtractQuantity('{{ $menu->id }}')">-</button>
                                        <input id="quantityInput_{{ $menu->id }}" type="number" value="0" class="w-14 text-center border border-gray-300 rounded-md bg-gray-200" disabled>
                                        <button id="addBtn" class="px-2 py-1 border border-gray-300 rounded-md bg-gray-200" onclick="addQuantity('{{ $menu->id }}')">+</button>
                                    </div>
                                </div>
                            </div>
                            @elseif ($menu->category_id == $category->id &&$menu->is_alcohol==1)
                            <div class="bg-gray-100 rounded-md p-2">
                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <div class="col-span-2">
                                        <span class="font-semibold">{{ $menu->name }}</span>
                                        <p class="text-gray-600 text-xs mt-1">
                                            {{ $menu->description }}. Alcohol percentage: {{ $menu->{'alcohol%'} }}%
                                        </p>
                                    </div>
                                    <div class="flex justify-end">
                                        <span class="text-gray-500 text-sm">Rp.{{ number_format($menu->price, 0, ',', '.') }},00</span>
                                    </div>
                                </div>

                                <div class="lg:flex lg:justify-end lg:mt-2">
                                    <div class="lg:flex lg:space-x-2 lg:ml-auto">
                                        <button id="subtractBtn" class="px-2 py-1 border border-gray-300 rounded-md bg-gray-200" onclick="subtractQuantity('{{ $menu->id }}')">-</button>
                                        <input id="quantityInput_{{ $menu->id }}" type="number" value="0" class="w-14 text-center border border-gray-300 rounded-md bg-gray-200" disabled>
                                        <button id="addBtn" class="px-2 py-1 border border-gray-300 rounded-md bg-gray-200" onclick="addQuantity('{{ $menu->id }}')">+</button>
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
                <div class="flex justify-end items-center mt-2">

                    <div class="flex items-center">
                        <label for="table_number" class="mr-2" >Table number:</label>
                        <input type="number" id="table_number" name="table_number" class="px-2 py-1 border rounded"  required>
                    </div>
                    <div class="ml-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Order</button>
                    </div>
                </div>
            </form>



        </div>
        <div class="w-0 lg:w-1/4">
            <!-- Left Sidebar -->
        </div>

    </div>





    <script>

        function subtractQuantity(menuId) {
            const quantityInput = document.getElementById(`quantityInput_${menuId}`);
            let quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                quantity--;
                quantityInput.value = quantity;
            }
        }

        function addQuantity(menuId) {
            const quantityInput = document.getElementById(`quantityInput_${menuId}`);
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;
        }


    </script>

@endsection
