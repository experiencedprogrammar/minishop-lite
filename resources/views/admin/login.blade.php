<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 15px; }
        .login-container { background: white; border-radius: 6px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); width: 100%; max-width: 380px; padding: 25px; }
        .login-header { text-align: center; margin-bottom: 20px; }
        .login-header h2 { color: #2c3e50; font-size: 24px; margin-bottom: 5px; }
        .login-header p { color: #7f8c8d; font-size: 14px; }
        .error-message { background: #ffeaea; color: #e74c3c; padding: 10px; border-radius: 3px; margin-bottom: 15px; font-size: 13px; border-left: 3px solid #e74c3c; }
        .login-form { display: flex; flex-direction: column; gap: 15px; }
        .form-group label { color: #2c3e50; font-weight: 500; margin-bottom: 5px; font-size: 13px; display: block; }
        .input-with-icon { position: relative; }
        .input-with-icon input { width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 3px; font-size: 14px; background: #f9f9f9; transition: 0.2s; }
        .input-with-icon input:focus { outline: none; border-color: #3498db; background: white; box-shadow: 0 0 0 2px rgba(52,152,219,0.2); }
        .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #7f8c8d; }
        .form-options { display: flex; justify-content: space-between; margin: 10px 0; font-size: 13px; }
        .remember-me { display: flex; align-items: center; gap: 5px; color: #2c3e50; }
        .forgot-password { color: #3498db; text-decoration: none; }
        .login-button { background: linear-gradient(to right, #3498db, #2980b9); color: white; border: none; padding: 12px; border-radius: 3px; font-weight: 600; cursor: pointer; transition: 0.2s; margin-top: 5px; }
        .login-button:hover { background: linear-gradient(to right, #2980b9, #3498db); }
        .register-link { text-align: center; margin-top: 15px; color: #7f8c8d; font-size: 14px; }
        .register-link a { color: #3498db; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Administrator</h2>
        </div>
        @if ($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
      @endif
    

        <form class="login-form" method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-with-icon">
                    <span class="input-icon">@</span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <span class="input-icon">#</span>
                    <input id="password" type="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>

            <button type="submit" class="login-button">Sign In</button>
        </form>

    </div>
</body>
</html>

