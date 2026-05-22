<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(request()->routeIs('register')) Register @else Login @endif - Ebla Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #eef9f0 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .auth-card {
            background-color: #ffffff;
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.12);
            position: relative;
            overflow: hidden;
            width: 1200px;
            max-width: 98vw;
            min-height: 760px;
            padding: 20px 0;
        }
        
        .auth-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(245, 197, 71, 0.15), transparent 35%), radial-gradient(circle at bottom right, rgba(20, 92, 50, 0.08), transparent 25%);
            pointer-events: none;
        }
        
        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
            color: #666;
        }
        
        .container span {
            font-size: 13px;
            color: #666;
        }
        
        .container a {
            color: #145c32;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
            transition: color 0.3s ease;
            font-weight: 600;
        }
        
        .container a:hover {
            color: #0d4228;
        }
        
        .container button {
            background: #145c32;
            color: #fff;
            font-size: 13px;
            padding: 12px 45px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .container button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 18px rgba(20, 92, 50, 0.35);
        }
        
        .container button.hidden {
            background: #f5c547;
            border: 2px solid #f5c547;
            color: #145c32;
        }
        
        .container button.hidden:hover {
            background: #f2b638;
            border-color: #f2b638;
        }
        
        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }
        
        .container input {
            background-color: #f5f5f5;
            border: none;
            margin: 8px 0;
            padding: 12px 18px;
            font-size: 14px;
            border-radius: 50px;
            width: 100%;
            outline: none;
            transition: all 0.3s ease;
            color: #333;
        }
        
        .container input::placeholder {
            color: #999;
        }
        
        .container input:focus {
            box-shadow: 0 0 0 3px rgba(20, 92, 50, 0.2);
            background-color: #fff;
            border: 1px solid #145c32;
        }
        
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
            padding: 0;
        }
        
        .form-container form {
            max-width: 430px;
            margin: 0 auto;
        }
        
        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }
        
        .container.active .sign-in {
            transform: translateX(100%);
        }
        
        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }
        
        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }
        
        @keyframes move {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }
        
        .social-icons {
            margin: 20px 0;
            display: flex;
            gap: 15px;
        }
        
        .social-icons a {
            border: 1px solid #ddd;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .social-icons a:hover {
            background-color: #f4f9f5;
            border-color: #c6e8d0;
            color: #145c32;
        }
        
        .icon i {
            font-size: 20px;
        }
        
        .icon .fa-google {
            color: #DB4437;
        }
        
        .icon .fa-facebook {
            color: #4267B2;
        }
        
        .icon .fa-github {
            color: #333;
        }
        
        .icon .fa-linkedin {
            color: #0077B5;
        }
        
        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 150px;
            z-index: 1000;
        }
        
        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 150px 0;
        }
        
        .toggle {
            background: linear-gradient(180deg, #145c32 0%, #0a3a20 100%);
            height: 100%;
            color: #fff;
            position: relative;
            left: -100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }
        
        .container.active .toggle {
            transform: translateX(50%);
        }
        
        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }
        
        .toggle-panel h1,
        .toggle-panel p {
            z-index: 2;
        }
        
        .container.active .toggle-left {
            transform: translateX(0);
        }
        
        .toggle-right {
            background: #145c32;
            right: 0;
            transform: translateX(0);
        }
        
        .container.active .toggle-right {
            transform: translateX(200%);
        }
        
        h1 {
            font-weight: 600;
            margin: 0;
            color: #333;
            font-size: 28px;
        }
        
        .toggle-panel h1 {
            color: #fff;
            font-size: 32px;
            margin-bottom: 18px;
        }
        
        .toggle-panel p {
            color: rgba(255,255,255,0.9);
            font-size: 15px;
            line-height: 1.6;
            margin: 20px 0 30px;
            max-width: 320px;
        }
        
        @media (max-width: 768px) {
            .container {
                min-height: 800px;
            }
            
            .form-container {
                width: 100%;
            }
            
            .toggle-container {
                display: none;
            }
            
            .sign-up {
                transform: translateX(100%);
            }
            
            .container.active .sign-up {
                transform: translateX(0);
            }
            
            .container.active .sign-in {
                transform: translateX(-100%);
            }
        }
        
        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #145c32;
            font-size: 16px;
            z-index: 2;
        }
        
        .input-group input {
            padding-left: 45px !important;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container auth-card" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                @if ($errors->has('general'))
                    <div class="error-message mb-2">{{ $errors->first('general') }}</div>
                @endif
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fab fa-google"></i></a>
                    <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fab fa-github"></i></a>
                    <a href="#" class="icon"><i class="fab fa-linkedin"></i></a>
                </div>
                <span>or use your email for registration</span>
                
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required />
                </div>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                </div>
                
                <button type="submit">Sign Up</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fab fa-google"></i></a>
                    <a href="#" class="icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fab fa-github"></i></a>
                    <a href="#" class="icon"><i class="fab fa-linkedin"></i></a>
                </div>
                <span>or use your email for login</span>
                
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        
        @if(request()->routeIs('register'))
            container.classList.add("active");
        @endif
        
        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });
        
        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>
</html>