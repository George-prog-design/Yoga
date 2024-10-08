<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Register | Upcube - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{asset('Backend Theme/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />

        <link href="{{asset('Backend Theme/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('Backend Theme/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />


    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                    <img src="{{asset('Backend Theme/assets/images/logo-dark.png')}}" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="{{asset('Backend Theme/assets/images/logo-light.png')}}" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>

                        <h4 class="text-muted text-center font-size-18"><b>Register</b></h4>

                        <div class="p-3">
                            <form class="form-horizontal mt-3" action="{{ route('register') }}" method="POST" >
                                @csrf



                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input  name="name" class="form-control" type="text"  placeholder="Name"  required autofocus autocomplete="name">
                                        @error('name')
                                           {{ $message  }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input  name="email" class="form-control" type="email"  placeholder="Email"  required autofocus autocomplete="email">
                                        @error('email')
                                           {{ $message  }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input name="password" id="password" class="form-control" type="password"  placeholder="Password" >
                                        @error('password')
                                           {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input name="password_confirmation" id="password_confirmation" class="form-control" type="password"  placeholder="Password Confirmation" >
                                        @error('password_confirmation')
                                           {{ $message }}
                                        @enderror
                                    </div>
                                </div>




                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>

                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-3 text-center">
                                        <a href="{{route('login')}}" class="text-muted">Already have account?</a>
                                    </div>
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->


        <!-- JAVASCRIPT -->
        <script src="{{asset('Backend Theme/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('Backend Theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('Backend Theme/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('Backend Theme/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('Backend Theme/assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('Backend Theme/assets/js/app.js')}}"></script>


    </body>
</html>
