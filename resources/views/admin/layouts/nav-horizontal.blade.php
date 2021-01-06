<nav class="main-header navbar navbar-expand navbar-diy-orange navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu 信息下拉菜单-->
        <li class="nav-item dropdown mr-3">
            <a class="nav-link p-0" data-toggle="dropdown" href="#" style="">
                <img class="img-circle mr-1" style="width: 40px; height: 40px;"
                     src="{{asset(session()->get('admin')->user_img)}}"
                     alt="用户头像">
                <span>{{session()->get('admin')->nickname}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a class="dropdown-item-title">
                    <div class="text-center p-3">
                        <img class="img-circle" style="width: 75px; height: 75px;"
                             src="{{asset(session()->get('admin')->user_img)}}"
                             alt="User profile picture">
                        <h3 class="text-center mt-2">{{session()->get('admin')->nickname}}</h3>
                    </div>
                </a>
                {{--<div class="dropdown-divider"></div>--}}
                <div href="#" class="dropdown-item-text p-3 text-center">
                    <div class="btn-group float-left">
                        <a class="btn btn-outline-diy" data-toggle="modal" data-target="#modal-pswd" onclick="clearValidate('#modal-pswd')">
                            <i class="nav-icon fas fa-user-cog"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-outline-diy" data-toggle="modal" data-target="#modal-newUser" onclick="clearValidate('#modal-newUser')">
                            <i class="nav-icon fas fa-user-plus"></i>
                        </a>
                    </div>
                    <div class="btn-group float-right">
                        <a class="btn btn-outline-diy" href="{{url('admin/exit')}}" style="">
                            <i class="nav-icon fas fa-power-off"></i>
                        </a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>

{{--修改密码弹窗--}}
<div class="modal fade" id="modal-pswd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="nav-icon fas fa-user-cog"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <p class="Validate"></p>
                    <div class="form-group">
                        <label for="oldPassword">原密码：</label>
                        <input type="password" id="oldPassword" class="form-control" name="oldPassword" placeholder="请输入原密码">
                        <p id="oldPasswordValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">新密码：</label>
                        <input type="password" id="newPassword" class="form-control" name="newPassword" placeholder="请输入新密码" required="required">
                        <p id="newPasswordValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="relPassword">确认密码：</label>
                        <input type="password" id="relPassword" class="form-control" name="relPassword" placeholder="请再次输入新密码" required="required">
                        <p id="relPasswordValidate"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <a class="btn btn-add" onclick="userPswd()">确认修改</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--添加新管理员弹窗--}}
<div class="modal fade" id="modal-newUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="nav-icon fas fa-user-plus"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group  text-center">
                    <div class="layui-upload">
                        <div class="layui-upload-list">
                            <img class="layui-upload-img demoUp" src="{{asset('/Bookstore/uploads/defaultUserImg.png')}}" id="demo3" style="width: 100px; height: 100px; border-radius: 50%; border: 1px dashed lightgray;" onclick="uploadBtn(3)">
                        </div>
                        <label for="demo3">头像</label>
                        <div class="clearfix"></div>
                        <p id="demoText"></p>
                    </div>
                </div>
                <form>
                    <p class="Validate"></p>
                    <div class="form-group">
                        <label for="nickname">昵称：</label>
                        <input type="text" id="nickname" class="form-control" name="nickname"
                               placeholder="请输入昵称">
                        <p id="nicknameValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="username">用户名：</label>
                        <input type="text" id="username" class="form-control" name="username"
                               placeholder="请输入用户名">
                        <p id="usernameValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" id="password" class="form-control" name="password"
                               placeholder="请输入密码">
                        <p id="passwordValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="relUserPassword">确认密码：</label>
                        <input type="password" id="relUserPassword" class="form-control" name="relUserPassword"
                               placeholder="请再次输入密码">
                        <p id="relUserPasswordValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="email" id="email" class="form-control" name="email"
                               placeholder="请输入邮箱">
                        <p id="emailValidate"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <a class="btn btn-add" onclick="userAdd()">添加</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--editAjax(url,arrdata,hrefURL)--}}
@include('admin.public.editAjax')
<script>
    {{--初始化输入框和提示框--}}
    function clearValidate(idInfo) {
        $(idInfo).find('p').empty();
        $(idInfo).find('input').val('');
        $(idInfo).find('img').attr('src',"{{asset('/Bookstore/uploads/defaultUserImg.png')}}");
    }
    //修改密码
    function userPswd() {
        if ($('#oldPassword').val() == '' || $('#oldPassword').val() == null) {
            $('#oldPasswordValidate').html('<span style="color: #FF5722;">* 原密码不能为空</span>');
        } else {
            $('#oldPasswordValidate').html('');
        }
        if ($('#newPassword').val() == '' || $('#newPassword').val() == null) {
            $('#newPasswordValidate').html('<span style="color: #FF5722;">* 新密码不能为空</span>');
        } else {
            $('#newPasswordValidate').html('');
        }
        if ($('#relPassword').val() == '' || $('#relPassword').val() == null) {
            $('#relPasswordValidate').html('<span style="color: #FF5722;">* 确认密码不能为空</span>');
        } else {
            $('#relPasswordValidate').html('');
            var pswdUrl = "{{url('admin/service/user/pswd')}}";
            var hrefURL = "{{url('admin/login')}}"
            var arr = {};
            arr['oldPassword'] = $('#oldPassword').val();
            arr['newPassword'] = $('#newPassword').val();
            arr['relPassword'] = $('#relPassword').val();
            // console.log(JSON.stringify(arr));
            editAjax(pswdUrl, arr, hrefURL);
        }
    }
    //添加新管理员
    function userAdd() {
        if ($('#nickname').val() == '' || $('#nickname').val() == null) {
            $('#nicknameValidate').html('<span style="color: #FF5722;">* 昵称不能为空</span>');
        } else {
            $('#nicknameValidate').html('');
        }
        if ($('#username').val() == '' || $('#username').val() == null) {
            $('#usernameValidate').html('<span style="color: #FF5722;">* 用户名不能为空</span>');
        } else {
            $('#usernameValidate').html('');
        }
        if ($('#password').val() == '' || $('#password').val() == null) {
            $('#passwordValidate').html('<span style="color: #FF5722;">* 密码不能为空</span>');
        } else {
            $('#passwordValidate').html('');
        }
        if ($('#relUserPassword').val() == '' || $('#relUserPassword').val() == null) {
            $('#relUserPasswordValidate').html('<span style="color: #FF5722;">* 确认密码不能为空</span>');
        } else {
            $('#relUserPasswordValidate').html('');
        }
        if ($('#email').val() == '' || $('#email').val() == null) {
            $('#emailValidate').html('<span style="color: #FF5722;">* 邮箱不能为空</span>');
        } else {
            $('#emailValidate').html('');
            var hrefURL = '{{url('admin/users/user')}}'
            var addUrl = "{{url('admin/service/user/add')}}";
            var arr = {};
            arr['image'] = $('#demo3').attr('src');
            arr['nickname'] = $('#nickname').val();
            arr['username'] = $('#username').val();
            arr['password'] = $('#password').val();
            arr['relUserPassword'] = $('#relUserPassword').val();
            arr['email'] = $('#email').val();
            console.log(JSON.stringify(arr));
            editAjax(addUrl, arr, null);
            clearValidate('#modal-newUser');
        }
    }
</script>