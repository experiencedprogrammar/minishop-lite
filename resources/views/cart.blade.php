<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shopping Cart | Mini Shop Lite</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
body {
    font-family: 'Segoe UI', system-ui, sans-serif;
    background-color: #f8f9fa;
    color: #333;
}
/* Container */
.container-fluid { max-width: 1400px; }
/* Cart Table */
.cart-table {
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.cart-table thead th {
    background-color: #2c3e50;
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 12px 15px;
    border: none;
}
.cart-table tbody td {
    padding: 10px 15px;
    vertical-align: middle;
    border-bottom: 1px solid #eaeaea;
}
.cart-table tbody tr:last-child td { border-bottom: none; }
/* Product Info */
.product-info { display: flex; align-items: center; }
.product-image { width: 55px; height: 55px; object-fit: cover; border-radius: 3px; }
.product-info .text-left { margin-left: 12px; }
.product-info .font-weight-bold { font-weight: 600; margin-bottom: 3px; font-size: 0.95rem; }
.product-info .text-muted { font-size: 0.8rem; line-height: 1.3; }
/* Quantity Controls */
.quantity { display:flex; align-items:center; justify-content:center; }
.product-quantity { height: 36px; min-width: 40px; width: auto; text-align: center; border: 1px solid #dee2e6; background:white; font-weight:600; margin:0; padding:0 6px; }
.quantity .btn { height: 36px; width: 36px; display:flex; align-items:center; justify-content:center; border-radius:1px; color:#fff; border:none; }
.btn-plus, .btn-minus { background-color: #0dcaf0; }
/* Price & Total */
.product-price, .product-total { font-weight:600; color:#2c3e50; }
/* Remove Button */
.remove-item-form .btn { font-size:0.8rem; padding:5px 10px; border-radius:2px; }
/* Total Row */
.total-row { background-color: #f8f9fa; font-weight:600; }
/* Cart Summary */
.cart-summary-fixed {
    background:#fff;
    border-radius:4px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
    padding:16px;
}
.cart-summary-fixed .alert { border-radius:3px; border:none; font-size:0.85rem; padding:10px 12px; }
/* Form Styling */
.form-group { margin-bottom:16px; }
.form-control { border-radius:3px; padding:10px 12px; border:1px solid #ddd; font-size:0.9rem; height:36px; }
.form-control:focus { box-shadow:none; border-color:#0dcaf0; }
.input-group-text { background:#e8f5e9; border:1px solid #c8e6c9; border-radius:1px; display:flex; align-items:center; justify-content:center; width:40px; height:36px; }
/* Textarea */
textarea.form-control { min-height:80px; max-height:150px; resize:vertical; }
/* Summary Section */
.border-bottom { padding:10px 10px; margin-bottom:10px; background-color:#f0f4f8; border-radius:3px; }
.pt-2 { padding:15px 0 0 0; }
/* Buttons */
.btn-success { border-radius:3px; padding:8px 12px; font-weight:600; width:100%; }
/* Empty Cart */
.empty-cart-message { padding:60px 20px; }
/* Responsive */
@media(max-width:991.98px){ .cart-summary-fixed{ margin-top:25px; } }
@media(max-width:767.98px){
    .cart-table thead{ display:none; }
    .cart-table tbody tr{ display:block; margin-bottom:15px; border:1px solid #eaeaea; border-radius:4px; padding:12px; }
    .cart-table tbody td{ display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #eaeaea; padding:8px 0; }
    .cart-table tbody td:last-child{ border-bottom:none; }
    .cart-table tbody td::before{ content:attr(data-label); font-weight:600; color:#2c3e50; font-size:0.8rem; }
}
</style>
</head>
<body>
<div class="container-fluid py-4">
<div class="row px-xl-5">
@if(empty($cartItems))
<div class="col-12 text-center py-5">
    <div class="empty-cart-message">
        <i class="fas fa-shopping-cart fa-4x mb-4" style="color: #ddd;"></i>
        <h3 class="mb-3">Your cart is empty</h3>
        <h6 class="text-muted mb-4">Seems you haven't added any items to your cart yet</h6>
        <a href="{{ route('home') }}" class="btn btn-info btn-lg">
            <i class="fa fa-shopping-bag me-1"></i> Start Shopping
        </a>
    </div>
</div>
@else
<div class="col-lg-9 table-responsive mb-5">
    <table class="table table-light table-borderless table-hover text-center mb-0 cart-table">
        <thead class="thead-dark">
            <tr>
                <th class="text-left">Products</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody class="align-middle" id="cart-items">
        @foreach($cartItems as $id => $item)
            <tr id="product-{{ $id }}">
                <td class="align-middle text-left" data-label="Product">
                    <div class="product-info">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="product-image mr-3">
                        <div class="text-left">
                            <div class="font-weight-bold">{{ $item['name'] }}</div>
                            <small class="text-muted">{{ $item['description'] }}</small><br>
                            <small class="text-bold">Available:</small>
                            <small class="{{ $item['stock'] < 20 ? 'text-danger' : ($item['stock'] <= 50 ? 'text-warning' : 'text-success') }}">{{ $item['stock'] }} units</small>
                        </div>
                    </div>
                </td>
                <td class="align-middle product-price" data-price="{{ $item['price'] }}" data-label="Price">KES:{{ number_format($item['price'],2) }}</td>
                <td class="align-middle" data-label="Quantity">
                    <div class="quantity">
                        <button class="btn btn-minus" data-id="{{ $id }}"><i class="fa fa-minus"></i></button>
                        <input type="text" class="product-quantity" value="{{ $item['quantity'] }}" data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                        <button class="btn btn-plus" data-id="{{ $id }}"><i class="fa fa-plus"></i></button>
                    </div>
                </td>
                <td class="align-middle product-total" id="subtotal-{{ $id }}" data-label="Total">KES:{{ number_format($item['price'] * $item['quantity'],2) }}</td>
                <td class="align-middle" data-label="Remove">
                    <form action="{{ route('remove.from.cart', $id) }}" method="POST" class="d-inline remove-item-form">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
            <tr class="total-row">
                <td colspan="3" class="text-right font-weight-bold">Total:</td>
                <td class="align-middle product-total" id="cart-items-total">KES:{{ number_format($subtotal, 2) }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="continue-shopping-btn d-flex justify-content-between mt-3">
        <form action="{{ route('home') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-shopping-bag"></i> Continue shopping </button>
        </form>
    </div>
</div>

<div class="col-lg-3">
    <div class="cart-summary-fixed">

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="alert alert-info d-flex align-items-center p-2 mb-3">
            <i class="fas fa-info-circle me-2"></i>
            <small>Enter your delivery details below to complete your Order</small>
        </div>
        <form action="{{ route('checkout.fetchCart') }}" method="POST">
        @csrf
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <select name="constituency" class="form-control">
                        <option value="">-- Select Area --</option>
                        <option value="Embakasi West">Embakasi West</option>
                        <option value="Embakasi East">Embakasi East</option>
                        <option value="Embakasi Central">Embakasi Central</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="tel" name="phone" class="form-control" placeholder="Active Phone Number">
                </div>
            </div>
            <div class="form-group mb-3">
                <textarea name="address" class="form-control" placeholder="Delivery Address" rows="3"></textarea>
            </div>
            <div class="border-bottom pb-2 mb-2">
                <div class="d-flex justify-content-between"><strong>Subtotal</strong><strong id="cart-subtotal">KES:{{ number_format($subtotal,2) }}</strong></div>
                <div class="d-flex justify-content-between"><strong>Shipping</strong><strong id="shipping">KES:{{ number_format($shipping,2) }}</strong></div>
            </div>
            <div style="background-color:#e8f5e9;padding:12px;border-radius:4px;">
                <div class="d-flex justify-content-between mb-2"><strong>Total</strong><strong id="cart-total">KES:{{ number_format($total,2) }}</strong></div>
                <input type="hidden" id="amount" name="amount" value="{{ $total }}">
                @auth
                <button type="submit" class="btn btn-success"><i class="fas fa-credit-card me-1"></i> Proceed to Checkout</button>
                <button type="button" id="checkoutApiBtn" class="btn btn-outline-primary w-100 mt-2">Checkout (API Demo)</button>
                @else
                <a href="{{ route('login') }}" class="btn btn-success"><i class="fas fa-sign-in-alt me-1"></i> Login to Checkout</a>
                @endauth
            </div>
        </form>
    </div>
</div>
@endif
</div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function(){
    function updateCartTotals(){
        let subtotal=0;
        $('tr[id^="product-"]').each(function(){
            const price=parseFloat($(this).find('.product-price').data('price'));
            const qty=parseInt($(this).find('.product-quantity').val());
            const total = price*qty;
            $(this).find('.product-total').text('KES:'+total.toFixed(2));
            subtotal += total;
        });
        $('#cart-items-total').text('KES:'+subtotal.toFixed(2));
        const shipping=subtotal>=3000?0:70;
        $('#shipping').text('KES:'+shipping.toFixed(2));
        $('#cart-subtotal').text('KES:'+subtotal.toFixed(2));
        $('#cart-total').text('KES:'+(subtotal+shipping).toFixed(2));
        $('#amount').val((subtotal+shipping).toFixed(2));
    }

    $('.btn-plus').click(function(){
        let input=$(this).siblings('.product-quantity');
        input.val(parseInt(input.val())+1).trigger('input');
        updateCartTotals();
    });
    $('.btn-minus').click(function(){
        let input=$(this).siblings('.product-quantity');
        if(parseInt(input.val())>1){ 
            input.val(parseInt(input.val())-1).trigger('input');
            updateCartTotals();
        }
    });

    $('.product-quantity').on('input', function(){
        $(this).css('width', (this.value.length+1) + 'ch');
        if($(this).val() < 1) $(this).val(1);
        updateCartTotals();
    }).trigger('input');

    updateCartTotals();

    function storeLiveCartQuantities() {
        const liveQuantities = {};
        $('tr[id^="product-"]').each(function() {
            const id = $(this).attr('id').replace('product-', '');
            const quantity = parseInt($(this).find('.product-quantity').val()) || 1;
            liveQuantities[id] = quantity;
        });
        localStorage.setItem('liveCartQuantities', JSON.stringify(liveQuantities));
    }

    $('.continue-shopping-btn .btn-info').on('click', function(e) {
        e.preventDefault();
        storeLiveCartQuantities();
        window.location.href = "{{ route('home') }}";
    });

    $('form[action="{{ route("checkout.fetchCart") }}"]').on('submit', function() {
        storeLiveCartQuantities();
    });

    // API Checkout Demo
    $('#checkoutApiBtn').on('click', function() {
        const items = [];
        $('tr[id^="product-"]').each(function(){
            const id = $(this).attr('id').replace('product-', '');
            const qty = parseInt($(this).find('.product-quantity').val()) || 1;
            items.push({ product_id: id, qty: qty });
        });

        $.ajax({
            url: '/api/orders',
            type: 'POST',
            data: JSON.stringify({ items: items }),
            contentType: 'application/json',
            headers: { 'Authorization': 'Bearer {{ auth()->user()?->createToken("demo")->plainTextToken ?? "" }}' },
            success: function(res){ alert('Order placed: ' + JSON.stringify(res)); },
            error: function(err){ alert('Error: ' + err.responseJSON.error); }
        });
    });
});
</script>
</body>
</html>
