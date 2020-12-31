@extends('admin.index')

@section('content')
    <div class="row">
        <div class="col-12" style="margin: auto;margin-top: 20px;">
            <!-- Content Header (Page header) -->
            {{--<section class="content-header">--}}
            {{--<div class="container-fluid">--}}
            {{--<div class="row mb-2">--}}
            {{--<div class="col-sm-6">--}}
            {{--<h1>图书分类</h1>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div><!-- /.container-fluid -->--}}
            {{--</section>--}}
            <div class="card">
                <div class="card-header">
                    <span><h3 class="card-title">图书分类</h3></span>
                    <span style="float: right;">
                        <div class="btn-group">
                            <a class="btn btn-add" href="{{url('admin/books/category_add')}}" style="">
                                <i class="nav-icon fas fa-plus-square"></i>
                                &ensp;添加分类/类别
                            </a>
                        </div>
                    </span>
                </div>
                <!-- ./card-header -->
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody id="categoryBody">
                        @foreach($categories as $category)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>
                                    <i class="fas fa-caret-right fa-fw"></i>
                                    {{$category->name}}
                                    <span class="float-right ">
                                    <a class="btn btn-block btn-outline-diy" onclick="Del(1,{{$category->id}})">
                                        <i class="fas fa-trash"></i>
                                     </a>
                                </span>
                                </td>
                            <tr class="expandable-body">
                                <td>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="300">类别名称</th>
                                                <th width="800">简述</th>
                                                <th width="150">预览图</th>
                                                <th width="250">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($classes as $class)
                                                @if($class->category_id == $category->id)
                                                    <tr>
                                                        <td>{{$class->name}}</td>
                                                        <td>{{$class->description}}</td>
                                                        <td style="text-align: center; display:table-cell; vertical-align:middle">
                                                            <img src="{{asset($class->classes_img)}}"
                                                                 style="width: 60px; max-width: 120px;">
                                                            {{--/resources/upload/c05f7df2362d49399d78262637f03eb9.jpg-uploads--}}
                                                        </td>
                                                        <td style="display:table-cell; vertical-align:middle">

                                                            <div class="btn-group" style="margin: 5px 0 5px 10px;">
                                                                <a class="btn btn-block btn-outline-diy"
                                                                   href="{{url('admin/books/classes_edit')}}?id={{$class->id}}">
                                                                    <i class="fas fa-edit"></i> 编辑
                                                                </a>
                                                            </div>
                                                            <div class="btn-group" style="margin: 5px 0 5px 10px;">
                                                                <a class="btn btn-block btn-outline-diy"
                                                                   onclick="Del(2,{{$class->id}})">
                                                                    <i class="fas fa-trash"></i>&nbsp; 删除
                                                                </a>
                                                            </div>
                                                            {{--<button type="button" class="btn btn-block btn-outline-diy">删除</button>--}}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

@endsection

@section('my-js')
    <script>
        $('#categoryBody tr:first').attr('aria-expanded', true);
    </script>
    <script>
        function Del(btnFlag, id) {
            if (confirm("确定删除吗？")) {
                var url = '';
                if (btnFlag == 1) {
                    url = "{{url('admin/service/category/del')}}";
                } else if (btnFlag == 2) {
                    url = "{{url('admin/service/classes/del')}}";
                }
                ajaxDel(url, id);
            } else {
                return;
            }
        }

        function ajaxDel(delUrl, id) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: delUrl, // 需要提交的 url
                dataType: 'json',
                data: {
                    id: id,
                    _token: '{{csrf_token()}}',
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
                    alert(data.message);
                    window.location.href = "{{url('admin/books/category')}}";
                },
                error: function (xhr, status, error) {
                    // console.log(xhr);
                    // console.log(status);
                    // console.log(error);
                    alert('ajax error');
                },
                beforeSend: function (xhr) {
                },
            })
        }
    </script>
@endsection