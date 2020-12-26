<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LW-Bookstore后台管理系统</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/admin/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('/admin/css/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/admin/css/adminlte.min.css')}}">
</head>
<body class="login-page">

<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/admin/login')}}"><b>LW-</b>Bookstore</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="用户名">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password"name="password" class="form-control" placeholder="密码">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-diy" onclick="onLogin()">登录</button>
                </div>
        </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('/admin/js/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/admin/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/admin/js/adminlte.min.js')}}"></script>
<script type="text/javascript">
    function onLogin() {
        // console.log('ok');
        var username = $('input[name=username]').val();
        var password = $('input[name=password]').val();
        $.ajax({
            type: 'post',
            url: "{{url('/admin/on_login')}}",
            dataType: 'json',
            data: {
                username: username,
                password: password,
                _token: "{{csrf_token()}}"
            },
            success: function (data) {
                if (data == null) {
                    alert('服务端错误');
                    return;
                }
                if (data.status != 0) {
                    alert(data.message);
                    return;
                }
                location.href = "{{url('admin/books/category')}}";
            },
            error: function (xhr, status, error) {
                alert('ajax error');
            },
            beforeSend: function (xhr) {
            }
        })
    }
</script>
</body>
</html>
