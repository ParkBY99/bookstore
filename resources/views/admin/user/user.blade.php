@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-12" style="margin: auto;margin-top: 30px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contacts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Contacts</li>
                        </ol>
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
                    <div class="col-3 col-sm-6 col-md-3">
                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                <span class="float-left">
                                    <i class="fas fa-lg fa-user-astronaut"></i>&ensp;
                                    {{$user->nickname}}
                                </span>
                                <span class="float-right">管理员</span>
                            </div>
                            <div class="card-body p-3 pb-4">
                                <div class="row">
                                    <div class="col-4 text-center" style="padding-left: 2%;">
                                        <img src="{{url($user->user_img)}}" alt="user-avatar" class="img-circle" style="width: 75px;height: 75px;">
                                    </div>
                                    <div class="col-8" style="padding-left: 5%;">
                                        <p class="text-muted  mt-2 "><i class="fas fa-lg fa-user"></i>&ensp;&nbsp;&ensp;<b>{{$user->user_name}}</b></p>
                                        <p class="text-muted  mt-2"><i class="fas fa-lg fa-envelope"></i>&ensp;&nbsp;&nbsp;{{$user->email}}</p>
                                        <p class="text-muted  mt-2"><i class="fas fa-lg fa-calendar-alt"></i>&ensp;&ensp;&nbsp;{{$user->register_time}}</p>
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
                    {{--<ul class="pagination justify-content-center m-0">--}}
                {!! $users->links() !!}
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('my-js')
    <script>
        $('#userPage nav ul').attr('class','pagination justify-content-center m-0');
    </script>

@endsection