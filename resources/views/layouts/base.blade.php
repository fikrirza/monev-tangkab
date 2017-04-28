<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eMonev</title>

    @section('stylesheet')
        @include('layouts.stylesheets')
    @show
</head>

    <body>

        @section("navbar")
            @include('layouts.navbar')
        @show
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                @include('layouts.sidebar')

                <!-- Main content -->
                <div class="content-wrapper">

                    @section('content')
                        <!-- Page Header (if any) and content here -->
                    @show

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->
        @section('script')
            @include('layouts.scripts')
        @show
    </body>
</html>
