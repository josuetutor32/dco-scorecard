
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon.ico')}}">
    <title>DCO - Scorecard</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/dco-scorecard.css')}}" rel="stylesheet">
    <!-- page css -->
    <link href="{{asset('css/login/login-register-lock.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/login/login.css')}}" rel="stylesheet">
    <style nonce="{{csp_nonce()}}">

    .login-form-txt{
        border: 0px !important;
        border-bottom: 1px solid #d8d8d8 !important;
    }


    input:focus {
        border-bottom: 2px solid #1976d2 !important;
}
    </style>

<style class="cp-pen-styles" nonce={{csp_nonce()}}>@import    url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300);
        * {
          -webkit-box-sizing: border-box;
                  box-sizing: border-box;
          margin: 0;
          padding: 0;
          font-weight: 300;
        }


        form {
          padding: 20px 0;
          position: relative;
          z-index: 2;
        }


        .bg-bubbles {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 1;
        }
        .bg-bubbles li {
          position: absolute;
          list-style: none;
          display: block;
          width: 40px;
          height: 40px;
          background-color: rgba(255, 255, 255, 0.15);
          bottom: -160px;
          -webkit-animation: square 25s infinite;
          animation: square 25s infinite;
          -webkit-transition-timing-function: linear;
          transition-timing-function: linear;
        }
        .bg-bubbles li:nth-child(1) {
          left: 10%;
        }
        .bg-bubbles li:nth-child(2) {
          left: 20%;
          width: 80px;
          height: 80px;
          -webkit-animation-delay: 2s;
                  animation-delay: 2s;
          -webkit-animation-duration: 17s;
                  animation-duration: 17s;
        }
        .bg-bubbles li:nth-child(3) {
          left: 25%;
          -webkit-animation-delay: 4s;
                  animation-delay: 4s;
        }
        .bg-bubbles li:nth-child(4) {
          left: 40%;
          width: 60px;
          height: 60px;
          -webkit-animation-duration: 22s;
                  animation-duration: 22s;
          background-color: rgba(255, 255, 255, 0.25);
        }
        .bg-bubbles li:nth-child(5) {
          left: 70%;
        }
        .bg-bubbles li:nth-child(6) {
          left: 80%;
          width: 120px;
          height: 120px;
          -webkit-animation-delay: 3s;
                  animation-delay: 3s;
          background-color: rgba(255, 255, 255, 0.2);
        }
        .bg-bubbles li:nth-child(7) {
          left: 32%;
          width: 160px;
          height: 160px;
          -webkit-animation-delay: 7s;
                  animation-delay: 7s;
        }
        .bg-bubbles li:nth-child(8) {
          left: 55%;
          width: 20px;
          height: 20px;
          -webkit-animation-delay: 15s;
                  animation-delay: 15s;
          -webkit-animation-duration: 40s;
                  animation-duration: 40s;
        }
        .bg-bubbles li:nth-child(9) {
          left: 25%;
          width: 10px;
          height: 10px;
          -webkit-animation-delay: 2s;
                  animation-delay: 2s;
          -webkit-animation-duration: 40s;
                  animation-duration: 40s;
          background-color: rgba(255, 255, 255, 0.3);
        }
        .bg-bubbles li:nth-child(10) {
          left: 90%;
          width: 160px;
          height: 160px;
          -webkit-animation-delay: 11s;
                  animation-delay: 11s;
        }
        @-webkit-keyframes square {
          0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
          }
          100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
                    transform: translateY(-700px) rotate(600deg);
          }
        }
        @keyframes    square {
          0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
          }
          100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
                    transform: translateY(-700px) rotate(600deg);
          }
        }
        </style>

    <!-- You can change the theme colors from here -->
    {{-- <link href="css/colors/default-dark.css" id="theme" rel="stylesheet"> --}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">DCO Scorecard</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    {{-- <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{asset('images/login.jpg')}});"> --}}
        <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{asset('images/login.jpg')}}); background: #003b5d">
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        <div class="login-box card">
            <div class="card-body">
                <!-- <form method="POST" action="{{ route('login') }}"> -->
                <form>
                    @csrf
                    <a href="javascript:void(0)" class="text-center db"><img src="{{asset('images/personiv/logo.png')}}" style="width: 50px;color: black" alt="Home" /><br/>
                        <span style="color: black; font-weight: bold">  DCO SCORECARD</span>
                    </a>
                    <!-- <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input id="emp_id" type="text" placeholder="Employee ID" autofocus class="login-form-txt form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ old('emp_id') }}" required  autofocus>

                            @error('emp_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password" placeholder="Password" type="password" class="login-form-txt form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                {{-- <input id="checkbox-signup" type="checkbox" class="filled-in chk-col-light-blue"> --}}
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{-- <label for="checkbox-signup"> Remember me </label> --}}
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                            {{-- <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div> --}}
                    </div> -->
                    <div class="form-group m-t-10">

                        <div class="col-xs-12 text-center db">
                            <a href="{{route('connect')}}" class="btn btn-warning btn-md text-uppercase btn-rounded">Single Sign-On</a>
                        </div>
                    </div>
                </form>
                <!-- <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('js/theme/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('js/theme/popper.min.js')}}"></script>
    <script src="{{asset('js/theme/bootstrap.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script nonce="{{csp_nonce()}}" type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>

</body>

</html>
