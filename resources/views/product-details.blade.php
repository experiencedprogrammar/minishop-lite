<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | MiniShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .zoom:hover img { transform: scale(1.05); }
        img { transition: transform 0.3s ease; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="sticky top-0 bg-white shadow z-40">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">M</div>
                <span class="text-lg font-bold">MiniShop</span>
            </a>
            <a href="{{ route('view.cart') }}" class="relative text-gray-700 hover:text-blue-600">
                <i class="fas fa-shopping-cart text-lg"></i>
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-3 text-center text-white text-sm">
        <a href="/" class="hover:underline">Home</a> →
        <a href="/#products" class="hover:underline">Products</a> →
        <span class="font-semibold">{{ $product->name }}</span>
    </div>

    <!-- Product Details -->
    <section class="py-12">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl">
            
            <!-- Product Image -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden zoom">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
            </div>

            <!-- Product Info -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-2 text-gray-800">{{ $product->name }}</h1>

                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-blue-600 font-bold text-xl">KES {{ number_format($product->price, 0) }}</span>
                        @if($product->old_price)
                        <span class="text-gray-400 line-through text-sm">KES {{ number_format($product->old_price, 0) }}</span>
                        @endif
                    </div>

                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ $product->description }}</p>

                    <div class="flex flex-wrap gap-4 text-sm mb-6">
                        <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                            <i class="fas fa-box"></i> In Stock: {{ $product->stock }}
                        </span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                            <i class="fas fa-tags"></i> Category: {{ $product->category ?? 'Uncategorized' }}
                        </span>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            <i class="fas fa-check-circle"></i> Quality Guaranteed
                        </span>
                    </div>
                </div>

                <!-- Add to Cart -->
                <form action="{{ route('add.to.cart', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold text-lg transition">
                        <i class="fa fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                </form>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 pt-12 pb-6 mt-12">
        <div class="container mx-auto px-4 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} MiniShop. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
