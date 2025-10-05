<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minishop Pay</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* Keep your existing styles */
    body {font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#f0fff4,#dff9f2,#c8f7e8);min-height:100vh;display:flex;flex-direction:column;margin:0;font-size:.8rem;}
    main {flex:1;display:flex;align-items:flex-start;justify-content:center;padding:40px 20px;}
    .checkout-container{max-width:450px;width:100%;}
    .order-summary{background:#fff;border-radius:4px;box-shadow:0 4px 15px rgba(0,0,0,0.1);padding:10px;margin-bottom:5px;font-size:.6rem;}
    .order-summary h6{font-weight:550;margin-bottom:10px;display:flex;justify-content:space-between;align-items:center;color:#2c3e50;font-size:.8rem;}
    .order-summary thead th{font-size:.7rem;border:none;padding:3px 5px;color:#2FC56D;font-weight:550;text-transform:uppercase;}
    .order-summary tbody td{font-size:.8rem;border:none;padding:3px 5px;color:#0C5460;}
    .order-summary tbody tr:nth-child(odd){background:#f9f9f9;}
    .order-summary tbody tr:nth-child(even){background:#e8f5e9;}
    .order-summary tbody tr:hover{background:#D1ECF1;}
    .checkout-form{background:#fff;border-radius:3px;box-shadow:0 4px 15px rgba(0,0,0,0.1);margin-bottom:6px;}
    .checkout-header{background:#fff;padding:14px 32px 6px 30px;font-weight:410;font-size:.8rem;color:#2c3e50;display:flex;justify-content:space-between;align-items:center;}
    .checkout-header img{height:30px;}
    .header-logo{height:30px;}
    .checkout-body{padding:8px 16px 16px;font-size:.9rem;}
    .gradient-input{width:100%;border:none;border-radius:3px;padding:.7rem .85rem;font-size:.9rem;background:linear-gradient(90deg,#e0f7fa,#f1f8e9);color:#2c3e50;box-shadow:inset 0 2px 5px rgba(0,0,0,0.05);}
    .gradient-input:focus{outline:none;box-shadow:0 0 0 2px rgba(47,197,109,.4);}
    .total-box{background:#3a7bd5; /* solid */ color:#fff;font-weight:500;border-radius:2px;padding:14px 15px;margin-top:10px;box-shadow:0 3px 8px rgba(58,123,213,.3);font-size:1rem;}
    .total-box h5{font-size:1rem;margin-bottom:16px;font-weight:600;}
    .total-row{display:flex;justify-content:space-between;align-items:center;}
    .submit-btn{background:linear-gradient(to right,#2FC56D,#28a955);border:none;padding:.7rem 1.2rem;border-radius:3px;font-size:1rem;font-weight:600;width:100%;color:white;transition:.3s ease;box-shadow:0 4px 10px rgba(47,197,109,.3);margin-top:5px;margin-bottom:8px;}
    .submit-btn:hover{background:linear-gradient(to right,#28a955,#2FC56D);transform:translateY(-2px);}
    .checkout-footer{padding:6px 18px;background:#fff;text-align:left;}
    .payment-banner img{width:100%;height:30px;object-fit:contain;}
    .coming-soon{font-size:.7rem;color:#6c757d;text-align:center;margin-bottom:3px;}
    .spacer-text{font-size:.8rem;margin:10px 0;text-align:center;color:#444;}
    .hidden-row{display:none;}
    .status-message{text-align:center;padding:10px;font-weight:bold;margin-top:10px;border-radius:3px;}
    .status-message.success{background:#d4edda;color:#155724;border:1px solid #c3e6cb;}
    .status-message.error{background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;}
    header, footer{border-top:1px solid #ccc;border-bottom:1px solid #999;padding:20px;text-align:left;}
  </style>
</head>
<body>

  <!-- Full-page header -->
 

  <main>
    <section class="checkout-container">
      <!-- Order Summary -->
      <article class="order-summary">
        <h6>
          Order Summary
          <a href="#" id="view-all-toggle">View All</a>
        </h6>
        <table class="table table-sm">
          <thead>
            <tr><th>Item</th><th>Qty</th><th>Price(KES)</th><th>Subtotal(KES)</th></tr>
          </thead>
          <tbody id="order-summary-body">
            @foreach($cartItems as $id => $item)
            <tr class="hidden-row" data-product-id="{{ $id }}">
              <td>{{ $item['name'] }}</td>
              <td class="live-quantity" data-price="{{ $item['price'] }}">{{ $item['quantity'] }}</td>
              <td>{{ number_format($item['price'], 2) }}</td>
              <td class="live-subtotal">{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
            </tr>
            @endforeach
            <!-- Total Row -->
            <tr class="hidden-row">
              <td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
              <td class="live-total" style="font-weight: bold;">KES {{ number_format($total, 2) }}</td>
            </tr>
          </tbody>
        </table>
      </article>

      <!-- Payment Section -->
      <article class="checkout-form">
        <div class="checkout-header">
          Mobile Money
          <img src="/storage/img/mpesa2.png" alt="Logo" class="header-logo">
        </div>

        <div class="checkout-body">
          <form id="payment-form" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="tel" class="gradient-input" name="phone" value="{{ old('phone', $phone ?? '') }}" required>

            <div class="total-box">
              <h5>Payment Summary</h5>
              <div class="total-row">
                <span>Total Amount:</span>
                <span id="payment-total">KES {{ number_format($amount ?? $total, 2) }}</span>
              </div>
            </div>

            <!-- Hidden fields that will be updated with live quantities -->
            <input type="hidden" name="amount" id="live-amount" value="{{ $amount ?? $total }}">
            <input type="hidden" name="address" value="{{ $address }}">
            
            <!-- Hidden field to store updated cart quantities -->
            <input type="hidden" name="updated_cart" id="updated-cart">

            <button type="submit" class="submit-btn">
              <i class="fas fa-money-check mr-2"></i>Pay Now
            </button>
          </form>
          <div id="payment-status"></div>
        </div>

        <div class="checkout-footer">
          <div class="coming-soon">Other payment methods coming soon...</div>
          <div class="payment-banner"><img src="/storage/img/payments.png" alt="Payment Methods"></div>
        </div>
      </article>
   </section>
  </main>
  
  <!-- Full-page footer -->


  <script>
    document.getElementById('view-all-toggle').addEventListener('click', e=>{
      e.preventDefault();
      const rows=document.querySelectorAll('.order-summary .hidden-row');
      const link=document.getElementById('view-all-toggle');
      rows.forEach(r=>{
        if(r.style.display==='none'||r.style.display===''){r.style.display='table-row';link.textContent='View Less';}
        else{r.style.display='none';link.textContent='View All';}
      });
    });

    // Function to fetch live quantities from cart page
    function fetchLiveCartQuantities() {
      return new Promise((resolve) => {
        // Try to get quantities from localStorage (if user came from cart page)
        const liveCartData = localStorage.getItem('liveCartQuantities');
        
        if (liveCartData) {
          resolve(JSON.parse(liveCartData));
        } else {
          // Fallback: Use the quantities from the checkout page (original quantities)
          const quantities = {};
          document.querySelectorAll('[data-product-id]').forEach(row => {
            const productId = row.getAttribute('data-product-id');
            const quantityCell = row.querySelector('.live-quantity');
            quantities[productId] = parseInt(quantityCell.textContent) || parseInt(quantityCell.getAttribute('data-quantity')) || 1;
          });
          resolve(quantities);
        }
      });
    }

    // Function to update order summary with live quantities
    function updateOrderSummaryWithLiveQuantities(liveQuantities) {
      let newTotal = 0;
      const updatedCart = {};

      document.querySelectorAll('[data-product-id]').forEach(row => {
        const productId = row.getAttribute('data-product-id');
        const quantityCell = row.querySelector('.live-quantity');
        const subtotalCell = row.querySelector('.live-subtotal');
        const price = parseFloat(quantityCell.getAttribute('data-price'));
        
        // Use live quantity if available, otherwise use original
        const liveQuantity = liveQuantities[productId] || parseInt(quantityCell.textContent);
        
        quantityCell.textContent = liveQuantity;
        const subtotal = price * liveQuantity;
        subtotalCell.textContent = numberFormat(subtotal);
        
        newTotal += subtotal;
        
        // Store updated cart data
        updatedCart[productId] = {
          quantity: liveQuantity,
          price: price,
          subtotal: subtotal
        };
      });

      // Update total display
      document.querySelector('.live-total').textContent = 'KES ' + numberFormat(newTotal);
      document.getElementById('payment-total').textContent = 'KES ' + numberFormat(newTotal);
      document.getElementById('live-amount').value = newTotal;
      document.getElementById('updated-cart').value = JSON.stringify(updatedCart);

      return newTotal;
    }

    // Helper function for number formatting
    function numberFormat(number) {
      return parseFloat(number).toFixed(2);
    }

    // Main form submission handler
    document.getElementById('payment-form').addEventListener('submit', async e => {
      e.preventDefault();
      
      const form = e.target;
      const status = document.getElementById('payment-status');
      const btn = document.querySelector('.submit-btn');
      
      // Show processing message
      status.innerHTML = '<p class="status-message">Processing your request...</p>';
      btn.disabled = true;

      try {
        // Fetch live quantities before submitting
        const liveQuantities = await fetchLiveCartQuantities();
        
        // Update the order summary with live quantities
        const newTotal = updateOrderSummaryWithLiveQuantities(liveQuantities);
        
        // Prepare form data
        const formData = new FormData(form);
        
        // Submit the form
        const response = await fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        });

        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.message || 'Server error');
        }

        const data = await response.json();

        if (data.success) {
          status.innerHTML = `<p class="status-message success">${data.message} Redirecting in 5 seconds...</p>`;
          
          // Clear localStorage after successful payment
          localStorage.removeItem('liveCartQuantities');
          
          let countdown = 5;
          const interval = setInterval(() => {
            countdown--;
            if (countdown > 0) {
              status.innerHTML = `<p class="status-message success">${data.message} Redirecting in ${countdown} seconds...</p>`;
            } else {
              clearInterval(interval);
              window.location.href = "{{ route('home') }}";
            }
          }, 1000);
        } else {
          status.innerHTML = `<p class="status-message error">Error: ${data.message}</p>`;
          btn.disabled = false;
        }
      } catch (error) {
        status.innerHTML = `<p class="status-message error">An unexpected error occurred: ${error.message}</p>`;
        btn.disabled = false;
      }
    });

    // Initialize on page load - try to get live quantities
    document.addEventListener('DOMContentLoaded', async () => {
      const liveQuantities = await fetchLiveCartQuantities();
      updateOrderSummaryWithLiveQuantities(liveQuantities);
    });
  </script>
</body>
</html>