<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Shop Lite | Customer Catalog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }

        /* Product Card Hover */
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }

        /* Product Image Hover */
        .product-image { transition: transform 0.3s ease; }
        .product-card:hover .product-image { transform: scale(1.05); }

        /* Header font & Cart icon */
        header a span { font-family: 'Inter', sans-serif; font-weight: 700; }
        header .fa-shopping-cart { font-size: 1.25rem; transition: transform 0.3s ease; }
        header .fa-shopping-cart:hover { transform: scale(1.2); }

        /* Feature Cards Background */
        .feature-bg {
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 6px;
        }
        
        /* Enhanced image quality */
        .product-image {
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
        }
        
        /* Eye icon button */
        .eye-btn {
            transition: all 0.3s ease;
            border: 1px solid #3b82f6;
        }
        .eye-btn:hover {
            transform: scale(1.05);
            background-color: #3b82f6;
            color: white;
        }
        
        /* Products container */
        .products-container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .product-card a img:hover {
        filter: brightness(0.9);
}
/* Add to Cart button style */
.add-to-cart-btn {
    background-color: #009cff;
    color: white;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 156, 255, 0.2);
}

.add-to-cart-btn:hover {
    background-color: #0085e0;
    box-shadow: 0 4px 12px rgba(0, 156, 255, 0.5);
    transform: translateY(-2px);
}


    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Top Bar -->
    <div class="py-1 text-white text-center text-sm font-semibold"style="background-color:#009cff;">
        <marquee>CALL/WHATSAPP 0112962582 TO ORDER • FREE DELIVERY FOR ORDERS ABOVE KES 20,000</marquee>
    </div>

    <!-- Header -->
    <header class="sticky top-0 bg-white">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-sm flex items-center justify-center text-white font-bold">M</div>
                <span class="text-lg font-bold">MiniShop</span>
            </a>
            <div class="flex items-center gap-5">
                @guest
                <a href="{{ route('customer.login.form') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                    <i class="fas fa-user"></i> <span class="hidden sm:inline">Login</span>
                </a>
                @else
                <form action="{{ route('user.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-sign-out-alt"></i> <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
                @endguest
    
                <a href="{{ route('view.cart') }}" class="relative text-gray-700 hover:text-blue-600">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded w-5 h-5 flex items-center justify-center">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
            </div>
        </div>
    </header>
    

    <!-- Hero -->
    <section class="text-white py-12"style="background-color:#009cff;">
        <div class="container mx-auto px-4 text-center">
            <h2 class=" md:text-3xl font-bold mb-4">Laravel 11 MiniShop Lite</h2>
            <p class="text-lg mb-6 opacity-90">Browse our latest arrivals and shop at the best prices</p>
            <a href="#products" class="bg-white text-blue-600 px-6 py-2 rounded font-bold shadow hover:bg-gray-100 transition">Shop Now</a>
        </div>
    </section>

    <!-- Feature Cards Section with Laptop Background -->
    <section class="py-12 feature-bg">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-center">

                <!-- Quick Delivery -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 p-4 rounded shadow-md hover:shadow-lg transition transform hover:-translate-y-1 text-white">
                    <div class="text-white text-3xl mb-3">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="text-md font-semibold mb-2">Quick Delivery</h3>
                    <p class="text-white text-opacity-90 text-xs">Get your orders delivered fast and on time, every time.</p>
                </div>

                <!-- 24/7 Support -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-700 p-4 rounded shadow-md hover:shadow-lg transition transform hover:-translate-y-1 text-white">
                    <div class="text-white text-3xl mb-3">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-md font-semibold mb-2">24/7 Support</h3>
                    <p class="text-white text-opacity-90 text-xs">Our team is available round-the-clock to assist you.</p>
                </div>

                <!-- Quality Products -->
                <div class="bg-gradient-to-br from-green-500 to-green-700 p-4 rounded shadow-md hover:shadow-lg transition transform hover:-translate-y-1 text-white">
                    <div class="text-white text-3xl mb-3">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 class="text-md font-semibold mb-2">Quality Products</h3>
                    <p class="text-white text-opacity-90 text-xs">We offer only the best products, carefully selected for you.</p>
                </div>

                <!-- Easy Returns -->
                <div class="bg-gradient-to-br from-red-500 to-red-700 p-4 rounded shadow-md hover:shadow-lg transition transform hover:-translate-y-1 text-white">
                    <div class="text-white text-3xl mb-3">
                        <i class="fas fa-undo-alt"></i>
                    </div>
                    <h3 class="text-md font-semibold mb-2">Easy Returns</h3>
                    <p class="text-white text-opacity-90 text-xs">Hassle-free returns if you're not completely satisfied.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-12 bg-gradient-to-br from-blue-50 to-purple-50">
        <div class="products-container px-6">
            <h2 class="text-3xl font-bold mb-8 text-center">New Arrivals</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach($products as $product)
                <article class="product-card bg-white rounded overflow-hidden shadow-lg card-hover flex flex-col text-left opacity-100">
                    <!-- Image -->
                    <a href="{{ route('product.details', $product->id) }}" class="block h-44 overflow-hidden relative group cursor-pointer">
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-full object-cover product-image group-hover:scale-105 transition-transform duration-300"
                        >
                        @if(!empty($product->old_price))
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">Sale</span>
                        @endif
                    </a>
                    

                    <!-- Details -->
                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="text-sm font-bold mb-1">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-600 mb-2">{{ Str::limit($product->description, 50) }}</p>
                        <div class="mb-2">
                            <span class="text-blue-600 font-bold text-md">KES {{ number_format($product->price, 0) }}</span>
                            @if(!empty($product->old_price))
                            <span class="text-gray-400 line-through ml-1 text-xs">KES {{ number_format($product->old_price, 0) }}</span>
                            @endif
                        </div>
                        <small class="{{ $product->stock < 20 ? 'text-red-500' : ($product->stock <= 50 ? 'text-yellow-500' : 'text-green-600') }} text-xs mb-3">
                            stock: {{ $product->stock }}
                        </small>

                        <!-- Add to Cart and Eye Button Row -->
                        <div class="flex gap-2 mt-auto">
                            <form action="{{ route('add.to.cart', $product->id) }}" method="POST" class="flex-none">
                                @csrf
                                <button type="submit" class="add-to-cart-btn px-3 text-white py-1.5 rounded-sm text-xs font-semibold transition">
                                    <i class="fa-solid fa-cart-plus mr-1"></i> Add to Cart
                                </button>
                            </form>
                          
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 pt-12 pb-6">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">MiniShop</h3>
                <p class="text-sm leading-relaxed">
                    Your trusted online shop for the best products at unbeatable prices. Fast delivery and quality service always.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-base font-bold text-white mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-white">Home</a></li>
                    <li><a href="#products" class="hover:text-white">Shop</a></li>
                    <li><a href="{{ route('view.cart') }}" class="hover:text-white">Cart</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="text-base font-bold text-white mb-4">Customer Service</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Help Center</a></li>
                    <li><a href="#" class="hover:text-white">Returns</a></li>
                    <li><a href="#" class="hover:text-white">Shipping</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-base font-bold text-white mb-4">Contact Us</h4>
                <ul class="space-y-2 text-sm">
                    <li><i class="fas fa-map-marker-alt mr-2"></i> Nairobi, Kenya</li>
                    <li><i class="fas fa-phone mr-2"></i> +254 748 482 869</li>
                    <li><i class="fas fa-envelope mr-2"></i> support@minishop.com</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} MiniShop. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>