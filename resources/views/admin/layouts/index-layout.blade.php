<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>基于Laravel的书吧管理系统</title>

    <!-- Google Font: Source Sans Pro 字体 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome 图标-->
    <link rel="stylesheet" href="{{asset('/admin/css/all.min.css')}}">
    <!-- Ionicons 图标-->
    {{--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/admin/css/adminlte.min.css')}}">
    <!-- overlayScrollbars 滚动条美化-->
    <link rel="stylesheet" href="{{asset('/admin/css/OverlayScrollbars.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@yield('content')

<!-- jQuery -->
<script src="{{asset('/admin/js/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
{{--<script src="{{asset('/admin/js/jquery-ui.min.js')}}"></script>--}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip->使用引导工具提示解决jQuery UI工具提示中的冲突-->
{{--<script>--}}
    {{--$.widget.bridge('uibutton', $.ui.button)--}}
{{--</script>--}}
<!-- Bootstrap 4 -->
<script src="{{asset('/admin/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars 滚动条-->
<script src="{{asset('/admin/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/admin/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes 演示颜色修改插件-->
{{--<script src="{{asset('/admin/js/demo.js')}}"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{asset('/admin/js/dashboard.js')}}"></script>--}}

@yield('my-js')

</body>
</html>
