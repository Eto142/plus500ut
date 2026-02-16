<!DOCTYPE html>
<html lang="en">

<head>
        <script src="/userr/dash/js/plugin/sweetalert/sweetalert.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f6fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .login-container .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container .logo img {
            width: 150px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #013b9e;
            font-size: 24px;
            font-weight: bold;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input {
            padding: 15px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.2s;
        }

        .login-container input:focus {
            border-color: #013b9e;
            outline: none;
        }

        .login-container button {
            padding: 15px;
            font-size: 16px;
            background-color: #013b9e;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #005bb5;
        }

        .login-container a {
            text-align: center;
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
            display: block;
            font-size: 14px;
        }

        .login-container .social-login {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .login-container .social-login button {
            width: 40px;
            height: 40px;
            margin: 0 10px;
            background-color: #f1f1f1;
            border-radius: 50%;
            border: none;
            cursor: pointer;
        }

        .login-container .keep-logged-in {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .login-container .keep-logged-in input {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }

            .login-container h2 {
                font-size: 20px;
            }

            .login-container button {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
            }

            .login-container input,
            .login-container button {
                padding: 10px;
                font-size: 14px;
            }

            .login-container h2 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>


    <div class="login-container">
        <div class="logo">
            <a href="/">   <img src="logo.png" alt="Plus500 Logo"> </a>
        </div>
        <h2>Log in</h2>
        <form method="POST" action="{{ route('login') }}">
                    @if(session('success'))
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            swal({
                                title: 'Success!',
                                text: "{{ session('success') }}",
                                icon: 'success',
                                button: 'OK'
                            });
                        });
                        </script>
                    @endif
                    @if($errors->any())
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            swal({
                                title: 'Error',
                                text: "{{ $errors->first() }}",
                                icon: 'error',
                                button: 'OK'
                            });
                        });
                        </script>
                    @endif
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div style="position:relative; width:100%; margin-bottom:20px;">
                <input type="password" name="password" id="password" placeholder="Password" required class="" style="width:85%; padding-right:44px;">
                <span onclick="togglePassword()" style="position:absolute; top:50%; right:14px; transform:translateY(-50%); cursor:pointer;">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" width="22" height="22">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror


            <div class="keep-logged-in">
                <input type="checkbox" name="remember" id="keep-logged-in">
                <label for="keep-logged-in">Keep me logged in</label>
            </div>

            <button type="submit">Log in</button>

            <a href="{{ route('forgot.password.form') }}">Forgot password?</a>
            <a href="{{ route('register') }}">Create an account</a>
        </form>

        <div class="social-login">
        <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                eye.innerHTML = `<path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M3 3l18 18M9.88 9.88A3 3 0 0112 9c1.657 0 3 1.343 3 3 0 .795-.312 1.515-.82 2.05M6.2 6.2A9.956 9.956 0 002.458 12C3.732 16.057 7.523 19 12 19c1.64 0 3.192-.392 4.55-1.086M15.12 15.12L18.98 19\" />`;
            } else {
                input.type = 'password';
                eye.innerHTML = `<path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\" /><circle cx=\"12\" cy=\"12\" r=\"3\" />`;
            }
        }
        function showModal(msg) {
            var modal = document.getElementById('messageModal');
            var content = document.getElementById('modalContent');
            content.innerHTML = msg;
            modal.style.display = 'flex';
            document.getElementById('modalClose').onclick = function() {
                modal.style.display = 'none';
            };
            modal.onclick = function(e) {
                if(e.target === modal) modal.style.display = 'none';
            };
        }
        </script>
            <button><i class="fab fa-google"></i></button>
            <button><i class="fab fa-facebook-f"></i></button>
            <button><i class="fab fa-apple"></i></button>
        </div>
    </div>

</body>

</html>