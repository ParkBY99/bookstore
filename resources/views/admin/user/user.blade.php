@extends('admin.index')

@section('content')
    <div class="row">
        <div class="col-12">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-11" style="margin: 20px auto;">
                            <form id="bookSearch" method="get" action="{{url('admin/users/user')}}">
                                <div class="form-group float-left" style="width: 35%;">
                                    <label for="nickname">昵称：</label>
                                    <input type="text" id="nickname" class="form-control" name="nickname"
                                           placeholder="请输入要查询的用户的昵称"
                                           value="{{$keyword['nickname']}}">
                                    <label for="username">用户名：</label>
                                    <input type="text" id="username" class="form-control" name="username"
                                           placeholder="请输入要查询的用户的用户名"
                                           value="{{$keyword['username']}}">
                                </div>
                                <div class="form-group float-left" style="width: 35%;margin-left: 2%">
                                    <label for="email">邮箱：</label>
                                    <input type="text" id="email" class="form-control" name="email"
                                           placeholder="请输入要查询的用户的邮箱"
                                           value="{{$keyword['email']}}">
                                    <label for="registerTime">注册时间：</label>
                                    <input type="text" id="registerTime" class="form-control" name="registerTime"
                                           placeholder="例如“1999-02-12 12:21:20”"
                                           value="{{$keyword['registerTime']}}"
                                    >
                                </div>
                                <div class="form-group float-left" style="margin: 2% auto auto 4%; width: 100px;">
                                    <label for="Power">权限：</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="userRole" value=""
                                                   @if($keyword['userRole'] == '') checked @endif>
                                            <label class="form-check-label">全部</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="userRole"
                                                   value="ROLE_ADMIN"
                                                   @if($keyword['userRole'] == 'ROLE_ADMIN') checked @endif>
                                            <label class="form-check-label">管理员</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="userRole"
                                                   value="ROLE_USER"
                                                   @if($keyword['userRole'] == 'ROLE_USER') checked @endif>
                                            <label class="form-check-label">用户</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-left" style="margin: 5% auto auto 2%;">
                                    <button type="submit" class="btn btn-add">搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">用户详情列表</h3>
                </div>
                <div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch">
                        @foreach($users as $user)
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card bg-light">
                                    <div class="ribbon-wrapper">
                                        @if($user->role == 'ROLE_ADMIN')
                                            <div class="ribbon bg-danger">
                                                管理员
                                            </div>
                                        @elseif($user->role == 'ROLE_USER')
                                            <div class="ribbon bg-olive">
                                                用户
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-header text-muted border-bottom-0">
                                        <i class="fas fa-lg fa-user-astronaut"></i>&ensp;
                                        {{$user->nickname}}
                                    </div>
                                    <div class="card-body p-3 pb-4">
                                        <div class="row">
                                            <div class="col-4 text-center" style="padding-left: 2%;">
                                                <img src="{{url($user->user_img)}}" alt="user-avatar" class="img-circle"
                                                     style="width: 75px;height: 75px;">
                                            </div>
                                            <div class="col-8" style="padding-left: 2.5%;">
                                                <p class="text-muted  mt-2 "><i class="fas fa-lg fa-user"></i>&ensp;&nbsp;&ensp;<b>{{$user->user_name}}</b>
                                                </p>
                                                <p class="text-muted  mt-2"><i class="fas fa-lg fa-envelope"></i>&ensp;&nbsp;&nbsp;{{$user->email}}
                                                </p>
                                                <p class="text-muted  mt-2"><i class="fas fa-lg fa-calendar-alt"></i>&ensp;&ensp;&nbsp;{{$user->register_time}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-sm btn-add">
                                                <i class="fas fa-user-edit"></i>
                                                编辑
                                            </a>
                                            <a href="#" class="btn btn-sm bg-gray">
                                                <i class="fas fa-trash-alt"></i>
                                                删除
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" id="userPage">
                    {!! $users->appends([
                        'nickname'=>$keyword['nickname'],
                        'username'=>$keyword['username'],
                        'email'=>$keyword['email'],
                        'registerTime'=>$keyword['registerTime'],
                        'userRole'=>$keyword['userRole'],
                    ])->render() !!}
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('my-js')
    <script>
        $('#nav-user').addClass('menu-is-opening menu-open');
        $('#userPage nav ul').attr('class', 'pagination justify-content-center m-0');
    </script>
@endsection