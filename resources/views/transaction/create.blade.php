@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-3 mb-4 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">
                                        <div data-category="{{ $category->id }}">
                                            {{ $category->name }}
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        @if ($category->menus->isNotEmpty())
                                            <div class="flex-fill">
                                                @foreach ($category->menus as $menu)
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="menu-item-container">
                                                                <button class="btn btn-secondary menu-link menu-button w-100" 
                                                                        data-menu="{{ $menu->id }}"
                                                                        data-name="{{ $menu->name }}"
                                                                        data-price="{{ $menu->price }}">
                                                                    {{ $menu->name }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="flex-fill text-center">No menus available in this category.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>

            <div class="col-md-3">
                <div class="fixed-cart-container position-fixed" style="width: 300px; max-width: 90vw;">
                    <h2>Transaksi</h2>
                    <div id="cart-items" class="custom-height overflow-y-scroll overflow-x-hidden">
                        @if (empty($cartItems))
                            Keranjang Belum Terisi
                        @endif
                    </div>
                    <hr>
                    <div id="cart-total">
                        
                    </div>
                    <div class="mb-3">
                        <label for="payment-type">Metode Pembayaran:</label>
                        <select id="payment-type" class="form-control">
                            @foreach($paymentTypes as $paymentType)
                                <option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button id="pass-all-items-btn" class="btn btn-success mt-3" disabled>Selesaikan Pesanan</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Add this link to your HTML file's head section -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            let cartItems = [];

            // Handle category link click
            $('.category-link').click(function(e) {
                e.preventDefault();
                alert('Category link clicked. You can add category-specific logic here.');
            });

            // Handle menu link click
            $('.menu-link').click(function(e) {
                e.preventDefault();
                let menuId = $(this).data('menu');
                let menuName = $(this).data('name');
                let menuPrice = $(this).data('price');

                addToCart(menuId, menuName, menuPrice, 1);
                updateButtonState();
            });

            $('#pass-all-items-btn').click(function(e) {
                e.preventDefault();

                let alertMessage = '<div style="text-align: left;">';
                alertMessage += '<h5>Detail Menu:</h5>';
                cartItems.forEach(item => {
                    alertMessage +=
                        `<h6><strong>${item.quantity} ${item.menuName}</strong> (Harga:  Rp ${number_format(item.menuPrice * item.quantity, 0, ',', '.')})</h6>`;
                });
                alertMessage +=
                    `<h4><strong>Total:  Rp ${number_format(calculateTotalPrice(), 0, ',', '.')}</strong></h4>`
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
                    form.action = '{{ route('transaction.store') }}';

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

            function updateButtonState() {
                let passAllItemsBtn = $('#pass-all-items-btn');
                if (cartItems.length > 0) {
                    passAllItemsBtn.prop('disabled', false);
                } else {
                    passAllItemsBtn.prop('disabled', true);
                }
                console.log('Button state updated:', passAllItemsBtn.prop('disabled'));
            }

            function calculateTotalPrice() {
                let totalPrice = 0;

                cartItems.forEach(item => {
                    totalPrice += item.menuPrice * item.quantity;
                });

                return totalPrice;
            }
            // Add menu to cart
            function addToCart(menuId, menuName, menuPrice, quantity) {
                let existingItem = cartItems.find(item => item.menuId === menuId);

                if (existingItem) {
                    existingItem.quantity += quantity;
                } else {
                    cartItems.push({
                        menuId,
                        menuName,
                        menuPrice,
                        quantity
                    });
                }

                updateCartUI();
            }

            // Update cart UI
            function updateCartUI() {
                let cartList = $('#cart-items');
                cartList.empty();

                let totalPrice = 0;

                cartItems.forEach(item => {
                    let cartItem = `
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2 px-2">
    <div class="d-flex flex-column">
        <span class="menu-name fs-6">${item.menuName}</span>
        <div class="quantity d-flex align-items-center mt-2">
            <button class="btn btn-sm btn-primary quantity-btn" data-menu="${item.menuId}" data-action="subtract">-</button>
            <span class="fs-6 mx-2">${item.quantity}</span>
            <button class="btn btn-sm btn-primary quantity-btn" data-menu="${item.menuId}" data-action="add">+</button>
        </div>
    </div>
    <div class="d-flex flex-column align-items-end">
        <span class="price fs-6"> Rp ${number_format(item.menuPrice * item.quantity, 0, ',', '.')}</span>
        <button class="btn btn-danger btn-sm remove-btn mt-2" data-menu="${item.menuId}">Remove</button>
    </div>
</div>
`;


                    cartList.append(cartItem);

                    totalPrice += item.menuPrice * item.quantity;
                });

                // Attach click event to quantity buttons
                $('.quantity-btn').click(function(e) {
                    e.preventDefault();
                    let menuId = $(this).data('menu');
                    let action = $(this).data('action');

                    updateCartItemQuantity(menuId, action);
                });

                // Attach click event to remove buttons
                $('.remove-btn').click(function(e) {
                    e.preventDefault();
                    let menuId = $(this).data('menu');
                    removeCartItem(menuId);
                });

                // Update total price in the cart
                let cartTotal = $('#cart-total');
                if (cartItems.length > 0) {
                    cartTotal.text('Total:  Rp ' + number_format(totalPrice, 0, ',', '.'));
                } else {
                    cartTotal.text('Keranjang Belum Terisi');
                }
            }

            // Update quantity in cart
            function updateCartItemQuantity(menuId, action) {
                let existingItem = cartItems.find(item => item.menuId === menuId);

                if (existingItem) {
                    if (action === 'add') {
                        existingItem.quantity += 1;
                    } else if (action === 'subtract' && existingItem.quantity > 1) {
                        existingItem.quantity -= 1;
                    }

                    updateCartUI();
                }
            }

            // Remove item from cart
            function removeCartItem(menuId) {
                cartItems = cartItems.filter(item => item.menuId !== menuId);
                updateCartUI();
                updateButtonState();
            }

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
