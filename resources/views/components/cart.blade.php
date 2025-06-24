<!-- Ekka Cart Start -->
<style>
    /* Custom Cart Quantity Controls */
    .cart-item-qty {
        display: flex;
        align-items: center;
        border: 1px solid #eeeeee;
        border-radius: 30px;
        overflow: hidden;
        width: 85px;
        height: 35px;
        margin-top: 7px;
        background: #ffffff;
    }

    .cart-item-qty button {
        width: 28px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        font-size: 18px;
        color: #777777;
        cursor: pointer;
        padding: 0;
    }

    .cart-item-qty .cart-qty-minus {
        border-right: 1px solid #eeeeee;
    }

    .cart-item-qty .cart-qty-plus {
        border-left: 1px solid #eeeeee;
    }

    .cart-item-qty .cart-qty-input {
        width: 29px;
        border: none;
        text-align: center;
        font-size: 14px;
        color: #444444;
        padding: 0;
        background: transparent;
    }

    .cart-item-qty button:hover {
        background-color: #f5f5f5;
    }

    .cart-item-qty button:active {
        background-color: #eeeeee;
    }
</style>

<style>
    .cart-item-size  {
        font-size: 14px;
        color: orange;
        margin-bottom: 6px;
    }
</style>

<form action="{{route('cart.checkout')}}" method="post">
    @csrf
    <div class="ec-side-cart-overlay"></div>
    <div id="ec-side-cart" class="ec-side-cart">
        <div class="ec-cart-inner">
            <div class="ec-cart-top">
                <div class="ec-cart-title">
                    <span class="cart_title">My Cart</span>
                    <button class="ec-close">×</button>
                </div>
                <ul class="eccart-pro-items">
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $cart)
                            <li data-product-id="{{ $id }}">
                                <a href="product-left-sidebar.html" class="sidecart_pro_img">
                                    <img src="{{asset($cart['image'])}}" alt="product">
                                </a>
                                <div class="ec-pro-content">
                                    <a href="single-product-left-sidebar.html" class="cart_pro_title">{{$cart['name']}}</a>
                                    <div class="cart-item-size" style="margin-bottom: 6px;">
                                        <span class="size-label">Size: {{ $cart['size'] }} ML</span>
                                    </div>
                                    <span class="cart-price"><span>Rp {{number_format($cart['price'])}}</span> x {{$cart['quantity']}}</span>
                                    <div class="cart-item-qty">
                                        <button type="button" class="cart-qty-minus">-</button>
                                        <input class="cart-qty-input" type="text" name="quantity" value="{{$cart['quantity']}}">
                                        <input type="hidden" name="user_id" value="1">
                                        <button type="button" class="cart-qty-plus">+</button>
                                    </div>
                                    <a href="#" class="remove">×</a>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="empty-cart">Your cart is empty</li>
                    @endif
                </ul>
            </div>
            <div class="ec-cart-bottom">
                <div class="cart-sub-total">
                    <table class="table cart-table">
                        <tbody>
                        @if(session('cart'))
                        <td class="text-left"><strong>Sub-Total :</strong></td>
                        @foreach(session('cart') as $id => $cart)
                            <tr class="item-row" data-product-id="{{ $id }}">
                                <td class="text-left">{{ $cart['name'] }} ({{ $cart['quantity'] }}x) :</td>
                                <td class="text-right item-total">Rp {{number_format($cart['price'] * $cart['quantity'])}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-left"><strong>Total :</strong></td>
                            <td class="text-right primary-color" id="cart-total">
                                Rp {{number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart'))))}}
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                @if(session('cart'))
                <div class="cart_btn">
                    <a href="{{route('cart')}}" class="btn btn-primary">View Cart</a>
                    <a class="btn btn-secondary"><button type="submit" style="color: white;">CHECKOUT</button></a>
                </div>
                @else
                    <div class="cart_btn">
                        <a href="{{route('cart')}}" class="btn btn-primary">View Cart</a>
                        <a href="#" class="btn btn-secondary">CHECKOUT</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</form>

@if(url()->current() !== route('cart'))

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Button event handlers
        const plusBtns = document.querySelectorAll('.cart-qty-plus');
        const minusBtns = document.querySelectorAll('.cart-qty-minus');

        plusBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.cart-qty-input');
                const currentVal = parseInt(input.value);
                input.value = currentVal + 1;
                updateCartQuantity(input);
            });
        });

        minusBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.cart-qty-input');
                const currentVal = parseInt(input.value);
                if (currentVal > 1) {
                    input.value = currentVal - 1;
                    updateCartQuantity(input);
                }
            });
        });

        function updateCartQuantity(input) {
            const quantity = parseInt(input.value);
            const item = input.closest('li');
            const priceElement = item.querySelector('.cart-price');
            const productId = item.dataset.productId;

            // Update the displayed quantity in cart item
            const priceText = priceElement.innerHTML;
            priceElement.innerHTML = priceText.replace(/x \d+/, 'x ' + quantity);

            // Update the item total in the subtotal section
            const subtotalRow = document.querySelector(`.item-row[data-product-id="${productId}"]`);
            if (subtotalRow) {
                const priceValue = parseInt(item.querySelector('.cart-price span').innerText.replace(/[^\d]/g, ''));
                const itemTotal = priceValue * quantity;

                // Update item quantity in the name
                const itemName = subtotalRow.querySelector('td:first-child');
                itemName.textContent = itemName.textContent.replace(/\(\d+x\)/, `(${quantity}x)`);

                // Update item total price
                subtotalRow.querySelector('.item-total').textContent = 'Rp ' + formatNumber(itemTotal);
            }

            // Update cart totals
            updateCartTotals();

            // Send update to server
            updateCartSession(productId, quantity);
        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateCartTotals() {
            let subtotal = 0;
            const items = document.querySelectorAll('.eccart-pro-items li:not(.empty-cart)');
            if (items.length === 0) {
                document.getElementById('cart-total').innerText = 'Rp 0';
                return;
            }
            items.forEach(function(item) {
                const priceSpan = item.querySelector('.cart-price span');
                const qtyInput = item.querySelector('.cart-qty-input');
                if (priceSpan && qtyInput) {
                    const price = parseInt(priceSpan.innerText.replace(/[^\d]/g, ''));
                    const quantity = parseInt(qtyInput.value);
                    subtotal += price * quantity;
                }
            });
            document.getElementById('cart-total').innerText = 'Rp ' + formatNumber(subtotal);
        }

        function updateCartSession(itemId, quantity) {
            fetch('/cart/updateQuantity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ id: itemId, quantity: quantity })
            });
        }

        // Add event listeners to remove buttons
        const removeBtns = document.querySelectorAll('.ec-pro-content .remove');

        removeBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                // Get the cart item and product ID
                const cartItem = this.closest('li');
                const productId = cartItem.dataset.productId;

                // Send delete request to server first to ensure data is removed
                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: productId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove item from DOM
                            cartItem.remove();

                            // Remove corresponding row from subtotal section
                            const subtotalRow = document.querySelector(`.item-row[data-product-id="${productId}"]`);
                            if (subtotalRow) {
                                subtotalRow.remove();
                            }

                            // Update cart totals
                            updateCartTotals();

                            // Show empty cart message if no items left
                            const remainingItems = document.querySelectorAll('.eccart-pro-items li');
                            if (remainingItems.length === 0) {
                                const emptyMessage = document.createElement('li');
                                emptyMessage.className = 'empty-cart';
                                emptyMessage.textContent = 'Your cart is empty';
                                document.querySelector('.eccart-pro-items').appendChild(emptyMessage);

                                // Clear the subtotal section
                                document.querySelector('.cart-table tbody').innerHTML = `
                        <tr>
                            <td class="text-left"><strong>Total :</strong></td>
                            <td class="text-right primary-color" id="cart-total">Rp 0</td>
                        </tr>
                    `;
                            }
                        }
                    })
                    .catch(error => console.error('Error removing item:', error));
            });
        });
    });
</script>
@endif

