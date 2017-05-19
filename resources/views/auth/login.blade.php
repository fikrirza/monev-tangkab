<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>E-Monev</title>

        <!-- Global stylesheets -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icons/icomoon/styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icons/fontawesome/styles.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icons/materialicons/styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <!-- /global stylesheets -->

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>

    <body class="login-container login-cover">

        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content">

                        <!-- Simple login form -->
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="panel panel-body login-form" style="min-width: 210px;">
                                @if (count($errors) > 0)
                                    <div class="alert bg-danger alert-styled-left">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <span>Error saat memproses data, pastikan data diisi dengan lengkap.</span>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="text-center">
                                    <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                    <h5 class="content-group">E-Monev Tangkab
                                    <small class="display-block">Masukan data login dengan lengkap </small></h5>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn bg-success btn-block">
                                        Mulai 
                                        <i class="icon-circle-right2 position-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- /simple login form -->

                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

        
        <!-- Core JS files -->
        <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/pages/login.js') }}"></script>

        <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>
        <!-- /theme JS files -->
    </body>
</html>
