<div class="progress-container">
    <div class="progress-bar" id="myProgressBar"></div>
</div>

<!-- Topbar Start -->
<div class="topbar">
    <div class="text-scroll-container">
        <h4 class="scrolling-text">CALL/WHATSAPP 0748 482 869 TO ORDER</h4>
        <h4 class="scrolling-text">FREE DELIVERY FOR ORDERS ABOVE KES 3,000</h4>
    </div>
</div>
<!-- Topbar End -->

<!-- Sticky Header (Logo + Search + Account) -->
<div class="sticky-header bg-light">
    <div class="container-max flex justify-between items-center py-3">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="/frontend/img/Logo4.png" alt="Logo" class="brand-logo">
        </a>

        <!-- Search -->
        <form action="" method="GET" class="flex w-1/2">
            <input type="text" name="search" class="form-control flex-1" placeholder="Search products">
            <button type="submit" class="btn-primary ml-2">
                <i class="fa fa-search"></i>
            </button>
        </form>

        <!-- Account / Cart -->
        <div class="account-info flex items-center">
            <div class="account-circle">
                <i class="fas fa-user"></i>
            </div>
            @if(Auth::check())
                <span class="user-name">Hello,</span>
                <a href="{{ route('logout') }}" class="btn btn-sm btn-danger logout-btn ml-2"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <span class="account-text">Account</span>
                <a href="{{ route('login') }}" class="btn-secondary ml-2">Login</a>
                <a href="{{ route('register') }}" class="btn-primary ml-2">Register</a>
            @endif

            <!-- Cart -->
            <a href="" class="ml-4 flex items-center">
                <i class="fas fa-shopping-cart fa-2x text-primary mr-1"></i>
                <span class="badge">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
        </div>
    </div>
</div>
<!-- Sticky Header End -->

<!-- Notification Popup -->
<div class="notification-popup" id="cart-notification">
    <div class="notification-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <div class="notification-content">
        <div class="notification-title">Success!</div>
        <div class="notification-message">Product added to cart successfully!</div>
        <div class="notification-buttons">
            <button class="notification-btn btn-view-cart" onclick="window.location.href=''">View Cart</button>
            <button class="notification-btn btn-close-notification" onclick="hideNotification()">Close popup</button>
        </div>
    </div>
</div>

<script>
    // Scroll progress indicator
    window.onscroll = function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById("myProgressBar").style.width = scrolled + "%";
    };
</script>
