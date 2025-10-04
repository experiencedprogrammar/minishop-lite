<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { 
      margin: 0; 
      padding: 0; 
      box-sizing: border-box; 
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .add-user-container {
      width: 580px;
      background: white;
      border-radius: 6px;
      padding: 30px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      transform: scale(0.95);
    }

    .form-title {
      font-size: 1.7rem;
      color: #2c3e50;
      margin-bottom: 20px;
      font-weight: 600;
      text-align: center;
      padding-bottom: 12px;
      border-bottom: 1px solid #f0f4f8;
      position: relative;
    }

    .form-title:after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: #0088fe;
      border-radius: 1px;
    }

    .form-row {
      display: flex;
      gap: 15px;
      margin-bottom: 15px;
    }

    .form-group {
      flex: 1;
      position: relative;
    }

    .input-label {
      display: block;
      font-weight: 500;
      color: #374151;
      margin-bottom: 6px;
      font-size: 0.9rem;
      height: 20px;
    }

    .input-container {
      position: relative;
    }

    .form-group i.input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6b7280;
      font-size: 0.9rem;
      z-index: 2;
    }

    .text-input {
      width: 100%;
      border: 1.5px solid #e2e8f0;
      border-radius: 4px;
      padding: 10px 40px 10px 40px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.2s ease;
      height: 46px;
      background: #f8fafc;
    }

    .text-input:focus {
      outline: none;
      border-color: #0088fe;
      background: white;
      box-shadow: 0 0 0 3px rgba(0, 136, 254, 0.15);
    }

    .input-action {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6b7280;
      font-size: 0.9rem;
      z-index: 2;
      transition: color 0.2s;
    }

    .input-action:hover {
      color: #0088fe;
    }

    .input-error {
      color: #ef4444;
      font-size: 0.8rem;
      margin-top: 5px;
      display: none;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      gap: 15px;
      margin-top: 25px;
      padding-top: 20px;
      border-top: 1px solid #f0f4f8;
    }

    .btn {
      padding: 10px 22px;
      border-radius: 4px;
      border: none;
      cursor: pointer;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .btn-primary {
      background: linear-gradient(to right, #0088fe, #0066cc);
      color: white;
      box-shadow: 0 2px 5px rgba(0, 136, 254, 0.25);
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #0066cc, #0052a3);
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(0, 136, 254, 0.3);
    }

    .btn-secondary {
      background: #f1f5f9;
      color: #64748b;
      border: 1.5px solid #e2e8f0;
    }

    .btn-secondary:hover {
      background: #e2e8f0;
      transform: translateY(-1px);
    }

    .success-message {
      background: #d4edda;
      color: #155724;
      padding: 12px;
      border-radius: 4px;
      margin-bottom: 20px;
      display: none;
      border-left: 4px solid #28a745;
    }

    .error-message {
      background: #f8d7da;
      color: #721c24;
      padding: 12px;
      border-radius: 4px;
      margin-bottom: 20px;
      display: none;
      border-left: 4px solid #dc3545;
    }

    .password-strength {
      margin-top: 6px;
      height: 5px;
      border-radius: 2px;
      background: #e2e8f0;
      overflow: hidden;
    }

    .password-strength-bar {
      height: 100%;
      width: 0%;
      transition: width 0.3s;
      border-radius: 2px;
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 12px;
      }
      
      .add-user-container {
        width: 100%;
        padding: 20px 18px;
      }
      
      .btn {
        padding: 9px 18px;
      }
    }
  </style>
</head>
<body>
  <div class="add-user-container">
    <h2 class="form-title">Add New User</h2>
    
    <div class="success-message" id="success-message"></div>
    <div class="error-message" id="error-message"></div>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- First Row -->
      <div class="form-row">
        <!-- Name -->
        <div class="form-group">
          <label class="input-label" for="name">Full Name</label>
          <div class="input-container">
            <i class="fas fa-user input-icon"></i>
            <input class="text-input" id="name" type="text" name="name" required autofocus autocomplete="name" placeholder="Enter full name">
          </div>
          <div class="input-error" id="name-error"></div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label class="input-label" for="email">Email Address</label>
          <div class="input-container">
            <i class="fas fa-envelope input-icon"></i>
            <input class="text-input" id="email" type="email" name="email" required autocomplete="email" placeholder="Enter email address">
          </div>
          <div class="input-error" id="email-error"></div>
        </div>
      </div>

      <!-- Second Row -->
      <div class="form-row">
        <!-- Password -->
        <div class="form-group">
          <label class="input-label" for="password">Password</label>
          <div class="input-container">
            <i class="fas fa-lock input-icon"></i>
            <input class="text-input" id="password" type="password" name="password" required autocomplete="new-password" placeholder="Create password">
            <i class="fas fa-random input-action" id="generate-password" title="Generate Password"></i>
            <i class="fas fa-eye input-action" id="toggle-password" title="Show/Hide Password" style="right: 2.6rem;"></i>
          </div>
          <div class="password-strength">
            <div class="password-strength-bar" id="password-strength-bar"></div>
          </div>
          <div class="input-error" id="password-error"></div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
          <label class="input-label" for="password_confirmation">Confirm Password</label>
          <div class="input-container">
            <i class="fas fa-lock input-icon"></i>
            <input class="text-input" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
            <i class="fas fa-eye input-action" id="toggle-confirm-password" title="Show/Hide Password"></i>
          </div>
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-secondary" id="cancel-btn">
          <i class="fas fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-user-plus"></i> Add User
        </button>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle password visibility
      const togglePassword = document.getElementById('toggle-password');
      const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
      const passwordInput = document.getElementById('password');
      const confirmInput = document.getElementById('password_confirmation');
      const strengthBar = document.getElementById('password-strength-bar');
      
      // Function to toggle password visibility
      function togglePasswordVisibility(inputElement, toggleElement) {
        if (inputElement.type === 'password') {
          inputElement.type = 'text';
          toggleElement.classList.remove('fa-eye');
          toggleElement.classList.add('fa-eye-slash');
        } else {
          inputElement.type = 'password';
          toggleElement.classList.remove('fa-eye-slash');
          toggleElement.classList.add('fa-eye');
        }
      }
      
      // Toggle main password visibility
      if (togglePassword) {
        togglePassword.addEventListener('click', () => {
          togglePasswordVisibility(passwordInput, togglePassword);
        });
      }
      
      // Toggle confirm password visibility AND main password visibility
      if (toggleConfirmPassword) {
        toggleConfirmPassword.addEventListener('click', () => {
          // Toggle both password fields
          togglePasswordVisibility(passwordInput, togglePassword);
          togglePasswordVisibility(confirmInput, toggleConfirmPassword);
        });
      }
      
      // Password strength indicator
      if (passwordInput && strengthBar) {
        passwordInput.addEventListener('input', function() {
          const password = this.value;
          let strength = 0;
          
          if (password.length >= 8) strength += 25;
          if (/[A-Z]/.test(password)) strength += 25;
          if (/[0-9]/.test(password)) strength += 25;
          if (/[^A-Za-z0-9]/.test(password)) strength += 25;
          
          strengthBar.style.width = strength + '%';
          
          if (strength < 50) {
            strengthBar.style.backgroundColor = '#ef4444';
          } else if (strength < 75) {
            strengthBar.style.backgroundColor = '#f59e0b';
          } else {
            strengthBar.style.backgroundColor = '#10b981';
          }
        });
      }
      
      // Generate random password
      const generateBtn = document.getElementById('generate-password');
      if (generateBtn) {
        generateBtn.addEventListener('click', () => {
          const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
          let pwd = "";
          for (let i = 0; i < 12; i++) {
            pwd += chars.charAt(Math.floor(Math.random() * chars.length));
          }
          passwordInput.value = pwd;
          confirmInput.value = pwd;
          
          // Trigger password strength update
          const event = new Event('input', { bubbles: true });
          passwordInput.dispatchEvent(event);
          
          // Show the generated password briefly
          passwordInput.type = 'text';
          confirmInput.type = 'text';
          
          // Update eye icons to show they're in "visible" state
          togglePassword.classList.remove('fa-eye');
          togglePassword.classList.add('fa-eye-slash');
          toggleConfirmPassword.classList.remove('fa-eye');
          toggleConfirmPassword.classList.add('fa-eye-slash');
          
          setTimeout(() => {
            passwordInput.type = 'password';
            confirmInput.type = 'password';
            
            // Reset eye icons
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
            toggleConfirmPassword.classList.remove('fa-eye-slash');
            toggleConfirmPassword.classList.add('fa-eye');
          }, 2000);
        });
      }
      
      // Form submission handling
      const userForm = document.querySelector('form');
      if (userForm) {
        userForm.addEventListener('submit', function(e) {
          e.preventDefault();
          
          // Basic validation
          let isValid = true;
          const name = document.getElementById('name');
          const email = document.getElementById('email');
          const password = document.getElementById('password');
          const confirmPassword = document.getElementById('password_confirmation');
          
          // Reset errors
          document.querySelectorAll('.input-error').forEach(el => {
            el.style.display = 'none';
          });
          
          document.getElementById('success-message').style.display = 'none';
          document.getElementById('error-message').style.display = 'none';
          
          // Name validation
          if (!name.value.trim()) {
            document.getElementById('name-error').textContent = 'Name is required';
            document.getElementById('name-error').style.display = 'block';
            isValid = false;
          }
          
          // Email validation
          if (!email.value.trim()) {
            document.getElementById('email-error').textContent = 'Email is required';
            document.getElementById('email-error').style.display = 'block';
            isValid = false;
          } else if (!/\S+@\S+\.\S+/.test(email.value)) {
            document.getElementById('email-error').textContent = 'Email is invalid';
            document.getElementById('email-error').style.display = 'block';
            isValid = false;
          }
          
          // Password validation
          if (password.value.length < 8) {
            document.getElementById('password-error').textContent = 'Password must be at least 8 characters';
            document.getElementById('password-error').style.display = 'block';
            isValid = false;
          }
          
          // Confirm password validation
          if (password.value !== confirmPassword.value) {
            document.getElementById('password-error').textContent = 'Passwords do not match';
            document.getElementById('password-error').style.display = 'block';
            isValid = false;
          }
          
          if (isValid) {
            // In a real application, this would submit to the server
            // For demo purposes, we'll show a success message
            document.getElementById('success-message').textContent = 'User added successfully!';
            document.getElementById('success-message').style.display = 'block';
            
            // Reset form
            userForm.reset();
            strengthBar.style.width = '0%';
            
            // Reset eye icons
            if (togglePassword) {
              togglePassword.classList.remove('fa-eye-slash');
              togglePassword.classList.add('fa-eye');
            }
            if (toggleConfirmPassword) {
              toggleConfirmPassword.classList.remove('fa-eye-slash');
              toggleConfirmPassword.classList.add('fa-eye');
            }
            
            // You might want to redirect or update the users list in a real application
          }
        });
      }
      
      // Cancel button
      const cancelBtn = document.getElementById('cancel-btn');
      if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
          // In a real application, this would go back to the users list
          if (confirm('Are you sure you want to cancel? All entered data will be lost.')) {
            window.location.href = "{{ route('admin.users') }}";
          }
        });
      }
    });
  </script>
</body>
</html>