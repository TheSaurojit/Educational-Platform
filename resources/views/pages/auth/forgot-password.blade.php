<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maths-matchmaker | Forgot Password </title>
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
            height: 600px;
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
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
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

        .symbol-1 { top: 10%; left: 20%; }
        .symbol-2 { top: 30%; right: 15%; }
        .symbol-3 { bottom: 25%; left: 10%; }
        .symbol-4 { bottom: 10%; right: 20%; }

        .auth-form {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .form-title {
            margin-top: 19px;
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
            margin-bottom: 25px;
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

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }

        .forgot-pass {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .send-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
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

        .signup-text {
            text-align: center;
            margin-top: 20px;
            color: var(--text-light);
        }

        .signup-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
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
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2962ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <h1>Reset Password</h1>
                    <p>Enter your email address and we'll send you a link to reset your password.</p>
                </div>
            </div>

            <div class="auth-form">
                <h2 class="form-title">Forgot Password</h2>
                <p class="form-subtitle">Enter your email address and we'll send you a link to reset your password.</p>


                @if ($errors->any())
                <div style="color: red">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div style="color:green">
                    {{ session('success') }}
                </div>
                @endif


                <form id="Emailform" method="POST">
  
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email">
                    </div>

                    <button type="submit" class="send-btn" id="sendBtn">Send</button>
                </form>
            </div>
        </div>
    </div>

    
</body>
</html>