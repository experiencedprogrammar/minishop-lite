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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body { 
            font-family: 'Poppins', 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        /* HTMLCodex-inspired color scheme */
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --accent: #f1f5f9;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
        }
        
        .htmlcodex-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }
        
        .htmlcodex-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .product-image { 
            transition: transform 0.5s ease; 
        }
        
        .product-card:hover .product-image { 
            transform: scale(1.08); 
        }
        
        .htmlcodex-btn {
            background: var(--primary);
            color: white;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .htmlcodex-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50%;
            height: 3px;
            background: var(--primary);
        }
        
        .price-tag {
            background: linear-gradient(135deg, var(--primary) 0%, #4f46e5 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .sale-badge {
            background: #ef4444;
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10;
        }
        
        .stock-badge {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            display: inline-block;
        }
        
        .stock-high {
            background: #dcfce7;
            color: #166534;
        }
        
        .stock-medium {
            background: #fef9c3;
            color: #854d0e;
        }
        
        .stock-low {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Top Bar - HTMLCodex Style -->
    <div class="bg-gradient-to-r from-blue-700 to-indigo-800 py-2 text-white text-center text-sm font-medium">
        <div class="container mx-auto px-4">
            <div class="flex justify-center items-center">
                <span class="bg-yellow-400 text-blue-900 px-2 py-1 rounded mr-2 font-bold">HOT</span>
                <span>CALL/WHATSAPP 0748 482 869 TO ORDER • FREE DELIVERY FOR ORDERS ABOVE KES 3,000</span>
            </div>
        </div>
    </div>

    <!-- Header - HTMLCodex Style -->
    <header class="sticky top-0 bg-white shadow-sm z-40 border-b border-gray-200">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-md">M</div>
                <span class="text-xl font-bold text-gray-900">MiniShop</span>
            </a>

            <div class="flex items-center gap-6">
                <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-blue-600 transition-colors">
                    <i class="fas fa-user-circle text-lg"></i> <span class="hidden sm:inline font-medium">Account</span>
                </a>
                <a href="{{ route('view.cart') }}" class="relative text-gray-700 hover:text-blue-600 transition-colors">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold shadow">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero - HTMLCodex Style -->
    <section class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Welcome to MiniShop Lite</h1>
            <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">Browse our latest arrivals and shop at the best prices with fast delivery</p>
            <a href="#products" class="htmlcodex-btn px-8 py-3 inline-block text-lg font-semibold shadow-lg">
                Shop Now <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </section>

    <!-- Products Section - HTMLCodex Style -->
    <section id="products" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-center text-gray-900">New Arrivals</h2>
            
            <!-- Grid like HTMLCodex -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                <article class="htmlcodex-card flex flex-col h-full">
                    
                    <!-- Image -->
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover product-image">

                        @if(!empty($product->old_price))
                        <span class="sale-badge">SALE</span>
                        @endif
                        
                        <!-- Quick view button (HTMLCodex style) -->
                        <button class="absolute top-2 right-2 bg-white text-gray-800 p-2 rounded-full shadow-md opacity-0 transition-opacity duration-300 product-card:hover:opacity-100 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>

                    <!-- Details -->
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold mb-2 text-gray-900 truncate">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4 flex-grow">{{ Str::limit($product->description, 70) }}</p>

                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-blue-700 font-bold text-xl">KES {{ number_format($product->price, 0) }}</span>
                                @if(!empty($product->old_price))
                                <span class="text-gray-400 line-through ml-2 text-sm">KES {{ number_format($product->old_price, 0) }}</span>
                                @endif
                            </div>
                            
                            <!-- Rating (HTMLCodex style) -->
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-4 flex justify-between items-center">
                            @if($product->stock > 50)
                                <span class="stock-badge stock-high">In Stock</span>
                            @elseif($product->stock > 20)
                                <span class="stock-badge stock-medium">Low Stock</span>
                            @else
                                <span class="stock-badge stock-low">Only {{ $product->stock }} left</span>
                            @endif
                            
                            <span class="text-xs text-gray-500">SKU: {{ substr($product->id, 0, 8) }}</span>
                        </div>

                        <!-- Add to Cart -->
                        <form action="{{ route('add.to.cart', $product->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="htmlcodex-btn w-full py-3 text-sm font-semibold flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </article>
                @endforeach
            </div>
            
            <!-- HTMLCodex-style pagination/load more -->
            <div class="mt-12 text-center">
                <button class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 hover:border-gray-400 transition-colors shadow-sm">
                    Load More Products <i class="fas fa-chevron-down ml-2"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Footer - HTMLCodex Style -->
    <footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-10">
            
            <!-- About -->
            <div class="md:col-span-2">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold mr-2">M</div>
                    MiniShop
                </h3>
                <p class="text-sm leading-relaxed mb-6 max-w-md">
                    Your trusted online shop for the best products at unbeatable prices. We offer fast delivery and quality service with a satisfaction guarantee.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold text-white mb-6">Quick Links</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i> Home</a></li>
                    <li><a href="#products" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i> Shop</a></li>
                    <li><a href="{{ route('view.cart') }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i> Cart</a></li>
                    <li><a href="#" class="hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-blue-400 mr-2 text-xs"></i> Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-bold text-white mb-6">Contact Us</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-blue-400 mr-3 mt-1"></i>
                        <span>Nairobi, Kenya</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone text-blue-400 mr-3"></i>
                        <span>+254 748 482 869</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-blue-400 mr-3"></i>
                        <span>support@minishop.com</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-clock text-blue-400 mr-3"></i>
                        <span>Mon-Fri: 9AM-6PM</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-6 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} MiniShop. All rights reserved. | Designed with <i class="fas fa-heart text-red-500 mx-1"></i> by MiniShop Team</p>
        </div>
    </footer>

</body>
</html>