<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maths-matchmaker | Sign Up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #3473fb;
            --primary-dark: #2b5cc9;
            --secondary-color: #f5f8ff;
            --text-dark: #333;
            --text-light: #666;
            --white: #fff;
            --gray-light: #f0f2f5;
            --shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--gray-light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.3rem;
        }

        .logo-icon {
            background-color: var(--primary-color);
            color: var(--white);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link.btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 8px 16px;
            border-radius: 8px;
        }

        .nav-link.btn:hover {
            background-color: var(--primary-dark);
            color: var(--white);
        }

        .container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background-color: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            height: 650px;
        }

        .auth-image {
            flex: 1;
            background-color: var(--primary-color);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--white);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .auth-image::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            transform: rotate(45deg);
            z-index: 1;
        }

        .image-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .image-content h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .image-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .math-symbols {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0.2;
            user-select: none;
        }

        .symbol-1 {
            top: 10%;
            left: 20%;
        }

        .symbol-2 {
            top: 30%;
            right: 15%;
        }

        .symbol-3 {
            bottom: 25%;
            left: 10%;
        }

        .symbol-4 {
            bottom: 10%;
            right: 20%;
        }

        .auth-form {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .form-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .form-subtitle {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 115, 251, 0.1);
        }

        .submit-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
        }

        .social-login {
            margin-top: 20px;
            text-align: center;
        }

        .social-login p {
            color: var(--text-light);
            margin-bottom: 15px;
            position: relative;
        }

        .social-login p::before,
        .social-login p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #e1e4e8;
        }

        .social-login p::before {
            left: 0;
        }

        .social-login p::after {
            right: 0;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .social-icon:hover {
            background-color: #e1e4e8;
        }

        .signin-text {
            text-align: center;
            margin-top: 20px;
            color: var(--text-light);
        }

        .signin-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .signup-success {
            text-align: center;
            padding: 30px;
            display: none;
            animation: fadeIn 0.5s;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background-color: #dcf5e8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #30b67b;
            font-size: 40px;
        }

        .success-title {
            font-size: 1.8rem;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .success-message {
            color: var(--text-light);
            margin-bottom: 30px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                height: auto;
            }

            .auth-image {
                padding: 30px;
                max-height: 200px;
            }

            .image-content h1 {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .image-content p {
                font-size: 0.9rem;
                margin-bottom: 0;
            }

            .math-symbols {
                display: none;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="/" class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="#2962ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                <path d="M8 7h8"></path>
                <path d="M8 12h8"></path>
                <path d="M8 17h8"></path>
            </svg>
            Maths-matchmaker
        </a>

    </header>

    <div class="container">
        <div class="auth-container">
            <div class="auth-image">
                <div class="math-symbols symbol-1">∑</div>
                <div class="math-symbols symbol-2">π</div>
                <div class="math-symbols symbol-3">∫</div>
                <div class="math-symbols symbol-4">√</div>
                <div class="image-content">
                    <h1>Join Our Community</h1>
                    <p>Connect with fellow math enthusiasts. Share problems, find collaborators, and expand your
                        mathematical horizons.</p>
                </div>
            </div>

            <div class="auth-form">
                <div id="signupForm">
                    <h2 class="form-title">Create Account</h2>
                    <p class="form-subtitle">Join our mathematics community today</p>

                    @if ($errors->any())
                        <div style="color: red">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="fullname"> Name</label>
                            <input type="text" id="fullname" name="name" placeholder="Enter your  name">
                        </div>

                        <div class="form-group">
                            <label for="signup-email">Email</label>
                            <input type="email" name="email" id="signup-email" placeholder="Enter your email">
                        </div>

                        <div class="form-group">
                            <label for="signup-password">Password</label>
                            <input type="password" name="password" id="signup-password" placeholder="Create a password">
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="confirm-password"
                                placeholder="Confirm your password">
                        </div>

                        <button type="submit" class="submit-btn" id="signupBtn">Create Account</button>
                        {{-- 
                        <div class="social-login">
                            <p>Or sign up with</p>
                            <div class="social-icons">
                                <div class="social-icon">G</div>
                            </div>
                        </div> --}}

                        <p class="signin-text">
                            Already have an account? <a href="/login" class="signin-link">Sign In</a>
                        </p>
                    </form>
                </div>

                {{-- <div class="signup-success" id="successMessage">
                    <div class="success-icon">✓</div>
                    <h2 class="success-title">Account Created!</h2>
                    <p class="success-message">Your account has been created successfully. You can now sign in with your credentials.</p>
                    <button class="submit-btn" id="goToSignin">Go to Sign In</button>
                </div> --}}
            </div>
        </div>
    </div>

    <script>
        // document.getElementById('signupBtn').addEventListener('click', () => {
        //     const fullname = document.getElementById('fullname').value;
        //     const email = document.getElementById('signup-email').value;
        //     const password = document.getElementById('signup-password').value;
        //     const confirmPassword = document.getElementById('confirm-password').value;


        //     if (password !== confirmPassword) {
        //         alert('Passwords do not match!');
        //         return;
        //     }

        //     console.log('Sign Up:', { fullname, email, password });


        //     alert('Account Created');
        // });
    </script>
</body>

</html>
