<!DOCTYPE html>
<html lang="en">

<head>
    <title>Masuk</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Favicons -->
    <link href="{{ asset('OnePage/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('OnePage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100 bg-white">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <span class="login100-form-title p-b-32">
                    <a href="/">
                        <h2><b>Dashboard Admin</b></h2>
                    </a>
                </span>
                @if (session('loginError'))
                    <div class="alert alert-danger">
                        {{ session('loginError') }}
                    </div>
                @endif
                <form action="/admin/login" method="POST" class="login100-form validate-form flex-sb flex-w">
                    @csrf
                    <span>Username</span>
                    <div class="wrap-input100 validate-input m-b-12 mt-2" data-validate = "Username wajib diisi">
                        <input type="text" name="username" class="input100" id="username" placeholder="Masukkan username"
                            required>
                    </div>
                    <span>Password</span>
                    <div class="wrap-input100 validate-input m-b-12 mt-2" data-validate = "Password wajib diisi">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input type="password" name="password" class="input100" id="password" placeholder="Masukkan password"
                            required>
                    </div>
                    <div>
                        <input type="checkbox" name="remember-me" id="remember-me"> Ingat Saya
                        <button type="submit" class="login100-form-btn" style="margin-left: 200px;">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('template-login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('template-login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/js/main.js') }}"></script>

</body>

</html>
