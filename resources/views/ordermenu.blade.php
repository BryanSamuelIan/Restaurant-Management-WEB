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
                                <div class="relative bg-gray-100 rounded-md p-2 menu-item my-2 border-b border-gray-300"
                                    data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}"
                                    data-menu-price="{{ $menu->price }}">
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
                                                data-menu="{{ $menu->id }}" data-action="subtract">-</button>
                                            <span class="fs-6 mx-2 quantityDisplay">0</span>
                                            <button class="addBtn px-2 py-1 border border-gray-300 rounded-md bg-gray-200"
                                                data-menu="{{ $menu->id }}" data-action="add">+</button>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($menu->category_id == $category->id && $menu->is_alcohol == 1)
                                <div class="relative bg-gray-100 rounded-md p-2 menu-item my-2 border-b border-gray-300"
                                    data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}"
                                    data-menu-price="{{ $menu->price }}">
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
                                                data-menu="{{ $menu->id }}" data-action="subtract">-</button>
                                            <span class="fs-6 mx-2 quantityDisplay">0</span>
                                            <button class="addBtn px-2 py-1 border border-gray-300 rounded-md bg-gray-200"
                                                data-menu="{{ $menu->id }}" data-action="add">+</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            <form id="orderForm" method="POST" action="">
                @csrf

                <div class="flex flex-col md:flex-row justify-end items-end mt-2">
                    <div class="flex items-center pb-4 md:pb-0">
                        <span id="totalAmount" class="Totalinput px-2 py-1 border rounded md:mr-4">
                            <!-- The total amount will be updated dynamically -->
                            <h4><strong>Total: Rp <span id="totalAmountValue">0</span></strong></h4>
                        </span>
                    </div>
                    <div class="flex items-center pb-4 md:pb-0">
                        <label for="table_no" class="mr-2"><strong>Table number:</strong></label>
                        <input type="number" id="table_no" name="table_no" min="1" pattern="\d+"
                            class="px-2 py-1 border rounded w-16">
                    </div>
                    <div class="ml-4 pb-4 md:pb-0">
                        <button id="pass-all-items-btn" type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Order</button>
                    </div>
                </div>
            </form>



        </div>
        <div class="w-0 lg:w-1/4">
            <!-- Left Sidebar -->
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let cartItems = [];

            // Toggle category content
            const toggleButtons = document.querySelectorAll('.category-toggle');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const content = this.parentNode.nextElementSibling;
                    content.style.display = (content.style.display === 'none' || content.style
                        .display === '') ? 'block' : 'none';
                });
            });

            $('.menu-item').each(function() {
                let menuId = $(this).data('menu-id');
                let menuName = $(this).data('menu-name');
                let menuPrice = $(this).data('menu-price');

                console.log(menuId, menuName, menuPrice); // Check if values are logged correctly

                addToCart(menuId, menuName, menuPrice, 0); // Change the quantity as needed
            });
            console.log(cartItems);

            // Delegated event listener for subtract button
            $(document).on('click', '.subtractBtn', function() {
                let menuId = $(this).data('menu');
                updateCartItemQuantity(menuId, 'subtract');
            });

            // Delegated event listener for add button
            $(document).on('click', '.addBtn', function() {
                let menuId = $(this).data('menu');
                updateCartItemQuantity(menuId, 'add');
            });


            // Update quantity in cart
            function updateCartItemQuantity(menuId, action) {
                let existingItem = cartItems.find(item => item.menuId === menuId);

                if (existingItem) {
                    if (action === 'add') {
                        existingItem.quantity += 1;
                    } else if (action === 'subtract' && existingItem.quantity > 0) {
                        existingItem.quantity -= 1;
                    }

                    updateUIQuantity(menuId, existingItem.quantity);
                }
            }

            function updateUIQuantity(menuId, quantity) {
                // Find and update the UI element displaying the quantity
                $(`.menu-item[data-menu-id='${menuId}'] .quantityDisplay`).text(quantity);
                updateTotalAmount();
            }

            function addToCart(menuId, menuName, menuPrice, quantity) {
                let existingItem = cartItems.find(item => item.menuId === menuId);
                if (!existingItem) {
                    // If the item doesn't exist in the cart, add it
                    cartItems.push({
                        menuId: menuId,
                        menuName: menuName,
                        menuPrice: menuPrice,
                        quantity: quantity
                    });
                }
            }

            function calculateTotalPrice() {
                let totalPrice = 0;

                cartItems.forEach(item => {
                    totalPrice += item.menuPrice * item.quantity;
                });

                return totalPrice;
            }

            function updateTotalAmount() {
                const totalAmount = calculateTotalPrice();
                document.getElementById('totalAmountValue').textContent = number_format(totalAmount, 0, ',', '.');
            }

            $('#pass-all-items-btn').click(function(e) {
                e.preventDefault();

                const tableNumber = $('#table_no').val();

                let alertMessage = '<div style="text-align: left;">';
                alertMessage += '<h5>Detail Menu:</h5>';
                cartItems.forEach(item => {
                    if (item.quantity > 0) {
                        alertMessage +=
                            `<h6><strong>${item.quantity} ${item.menuName}</strong> (Harga:  Rp ${number_format(item.menuPrice * item.quantity, 0, ',', '.')})</h6>`;
                    }
                });
                alertMessage +=
                    `<h4><strong>Total:  Rp ${number_format(calculateTotalPrice(), 0, ',', '.')}</strong></h4>`;
                alertMessage +=
                    '<p>Please contact waitress/go to cashier. Silahkan kontak pelayan/pergi ke kasir.</p>';
                alertMessage += '</div>';

                Swal.fire({
                    title: 'Ringkasan Transaksi',
                    html: alertMessage,
                    icon: 'info',
                    showCloseButton: true,
                    showConfirmButton: false
                }).then(() => {
                    const serializedCartItems = JSON.stringify(cartItems);

                    // Create a form dynamically
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('store_order') }}';

                    // Add CSRF token input field
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}'; // Add the CSRF token here
                    form.appendChild(csrfInput);

                    // Add an input field for cartItems
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'cartItems';
                    input.value = serializedCartItems;
                    form.appendChild(input);

                    // Add table number to form data
                    const tableNumberInput = document.createElement('input');
                    tableNumberInput.type = 'hidden';
                    tableNumberInput.name = 'tableNumber';
                    tableNumberInput.value = tableNumber; // Set the table number value here
                    form.appendChild(tableNumberInput);

                    const paymentTypeInput = document.createElement('input');
                    paymentTypeInput.type = 'hidden';
                    paymentTypeInput.name = 'paymentTypeId';
                    paymentTypeInput.value = $('#payment-type').val();;
                    form.appendChild(paymentTypeInput);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();

                });

            });

            // Number format function
            function number_format(number, decimals, dec_point, thousands_sep) {
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                let n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        let k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };

                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }

                return s.join(dec);
            }
        });
    </script>
@endsection
