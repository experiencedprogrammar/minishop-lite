<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login | MiniShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="flex flex-col md:flex-row bg-white shadow-xl rounded overflow-hidden max-w-4xl w-full">
        
        <!-- Left Illustration Section -->
        <div class="hidden md:block md:w-1/2 bg-gradient-to-tr from-blue-500 to-indigo-600 p-10 flex flex-col justify-center text-white">
            <h2 class="text-3xl font-bold mb-4">Welcome Back!</h2>
            <p class="text-md mb-6 opacity-90">Login and explore our latest products. Enjoy seamless shopping experience tailored just for you.</p>
            <img src="https://media.istockphoto.com/id/1200486875/photo/different-computers-in-store-background.jpg?s=612x612&w=0&k=20&c=KUkYqOE9DBzdDfWyX5NoVNzVnAOrlGzf8uUi8GNMc-4=" alt="Shopping illustration" class="rounded-lg shadow-lg">
        </div>

        <!-- Login Form Section -->
        <div class="w-full md:w-1/2 p-8 sm:p-10">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Login to Your Account</h2>

            @if($errors->any())
                <div class="mb-4 text-red-600 text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('customer.login.submit') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Enter your email" required>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input id="password" type="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Enter your password" required>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
                        Login
                    </button>
                </div>

                <!-- Register Link -->
                <p class="text-sm text-gray-500 text-center mt-4">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600 font-medium hover:underline">Register here</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>
