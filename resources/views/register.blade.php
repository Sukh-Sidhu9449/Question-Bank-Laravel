<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/loginn.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/new-login.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row ">
                <div class="col-lg-4">
                    <div class="card1 pb-5">
                        <div>
                            <img src="{{ asset('images/Question-Bank-Logo.webp') }}" class="logo">
                        </div>
                        <div class="px-5  pt-5 mt-5 mb-5 border-line">
                            <img src="{{ asset('img/login-images.png') }}" width="80%" class="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="text-start pt-4">
                        <h2 class="text-center">
                            Registration
                        </h2>    
                        <div class="w-75 mx-auto py-3 px-2 ">
                            <form class="w-100 ">
                                @csrf
                                <div class="my-3">
                                    <label for="inputname" class="form-label ">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="" placeholder="Enter Your Name">
                                        <span id="invalid-name" class="text-danger"></span>
                                </div>
                                <div class="my-3">
                                    <label for="inputemail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter Your Email">
                                    <span id="invalid-email" class="text-danger"></span>  
                                </div>
                                <div class="my-3" >
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password"  name="password"
                                        value="" placeholder="Enter Your Password">
                                        <span id="invalid-password" class="text-danger"></span>
                                </div>
                                <div class="my-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                        placeholder="Enter Confirm Password" value="">
                                </div>
                                <div class="my-4 text-center" >
                                        <button type="submit" class="btn btn-blue text-center"
                                            id="register">Register</button>
                                    <div class=" my-2 d-flex flex-row justify-content-center align-items-center">
                                        <p class="mb-0 ">I already have an account?   </p>
                                        <div class="mx-2">
                                            <a href="{{ url('/login') }}">Login</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
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
    <script type="text/javascript" src="{{ asset('/js/register.js') }}"></script>
</body>
</html>
