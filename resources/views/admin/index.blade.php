<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico"/>

    <title>基于Laravel的书吧管理系统</title>

    <!-- Google Font: Source Sans Pro 字体 -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome 图标-->
    <link rel="stylesheet" href="{{asset('/admin/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/admin/css/adminlte.min.css')}}">
    <!-- layui style -->
    <link rel="stylesheet" href="{{asset('/layui/css/layui.css')}}">
    @yield('my-css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{--水平导航条--}}
        @include('admin.layouts.nav-horizontal')
        {{--垂直导航条--}}
        @include('admin.layouts.nav-vertical')
        {{--主体body--}}
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel">
                                @yield('content')
                            </section>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        {{--footer--}}
        @include('admin.layouts.footer')

    </div>
    <!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('/admin/js/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/admin/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/admin/js/adminlte.min.js')}}"></script>
<!-- layui -->
<script src="{{asset('/layui/layui.all.js')}}"></script>
@yield('my-js')

</body>
</html>