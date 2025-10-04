<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-icon {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .eye {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #2563eb;
            border-radius: 50%;
        }
        
        .left-eye {
            left: 22px;
            top: 22px;
        }
        
        .right-eye {
            right: 22px;
            top: 22px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-md shadow-md p-6">
            <!-- Admin Icon -->
            <div class="text-center mb-6">
                <div class="admin-icon inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-3">
                    <i class="fas fa-user text-2xl text-blue-600"></i>
                    <div class="eye left-eye"></div>
                    <div class="eye right-eye"></div>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Admin Login</h1>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mb-4 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-800 text-sm font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-blue-300"
                           value="{{ old('email') }}" 
                           required 
                           autofocus>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-800 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-blue-300"
                           required>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1">
                    Sign In
                </button>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>