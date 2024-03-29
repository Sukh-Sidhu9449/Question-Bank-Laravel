<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/loginn.css') }}"> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/new-login.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @php
        if (isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass'])) {
            $login_email = Cookie::get('login_email');
            $login_pass = Cookie::get('login_pass');
            $is_remember = "checked='checked'";
        } else {
            $login_email = '';
            $login_pass = '';
            $is_remember = '';
        }
        
    @endphp
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row">
                            <img src="{{ asset('images/Question-Bank-Logo.webp') }}" class="logo">
                        </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img src="{{ asset('img/login-images.png') }}" class="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5 my-5">
                        <span id="invalid"></span>
                        {{-- <div class="row mb-4 px-3">
                    <h6 class="mb-0 mr-4 mt-2">Sign in with</h6>
                    <div class="facebook text-center mr-3"><div class="fa fa-facebook"></div></div>
                    <div class="twitter text-center mr-3"><div class="fa fa-twitter"></div></div>
                    <div class="linkedin text-center mr-3"><div class="fa fa-linkedin"></div></div>
                </div>
                <div class="row px-3 mb-4">
                    <div class="line"></div>
                    <small class="or text-center">Or</small>
                    <div class="line"></div>
                </div> --}}
                        <form action="{{ route('userlogin') }}" method="post">
                            @csrf
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Email Address</h6>
                                </label>
                                <input class="mb-4" type="text" name="email" id="email"
                                    placeholder="Enter a valid email address" value="{{ $login_email }}">
                            </div>
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Password</h6>
                                </label>
                                <input type="password" name="password" id="password" placeholder="Enter password"
                                    value="{{ $login_pass }}">
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="rememberme" class="custom-control-input" id="rememberme" {{ $is_remember }}>
                                    <label for="rememberme" class="custom-control-label text-sm">Remember me</label>
                                </div>
                                {{-- <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a> --}}
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-blue text-center" id="login">Login</button>
                            </div>
                        </form>
                        <div class="row mb-4 px-3">
                            <small class="font-weight-bold">Don't have an account? <a href="{{url('/register')}}" class="text-danger ">Register</a></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3">
                    <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto">
                        <span class="fa fa-facebook mr-4 text-sm"></span>
                        <span class="fa fa-google-plus mr-4 text-sm"></span>
                        <span class="fa fa-linkedin mr-4 text-sm"></span>
                        <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript" src="{{ asset('/js/login.js') }}"></script>
</body>

</html>
