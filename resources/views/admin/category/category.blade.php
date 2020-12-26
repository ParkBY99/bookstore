@extends('admin.index')

@section('content')
    <div class="row">
        <div class="col-12" style="margin: auto;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>图书分类</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card">
                <div class="card-header">
                    <span><h3 class="card-title">图书分类</h3></span>
                    <span style="float: right; margin-right: 10px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-add">添加分类</button>
                            <button type="button" class="btn btn-add dropdown-toggle dropdown-hover dropdown-icon"
                                    data-toggle="dropdown">
                                <span class="sr-only">下拉切换</span>
                                <div class="dropdown-menu dropdown-menu-sm-right" role="menu"
                                     style="background: rgba(188,88,38,.8);">
                                    <a class="dropdown-item-add" href="#" style="">添加分类</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item-add" href="#" style="">添加类别</a>
                                </div>
                            </button>
                        </div>
                    </span>
                </div>
                <!-- ./card-header -->
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($categories as $category)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>
                                <i class="fas fa-caret-right fa-fw"></i>
                                {{$category->name}}
                            </td>
                        <tr class="expandable-body">
                            <td>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 300px;">类别名称</th>
                                            <th>简述</th>
                                            <th style="width: 150px;">预览图</th>
                                            <th style="width: 250px;">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($classes as $class)
                                            @if($class->category_id == $category->id)
                                                <tr>
                                                    <td>{{$class->name}}</td>
                                                    <td>{{$class->description}}</td>
                                                    <td style="text-align: center">
                                                        <img src="{{asset('/Bookstore/resources/upload/category-classes/p1.jpg')}}" style="width: 60px;">
                                                        {{--/resources/upload/c05f7df2362d49399d78262637f03eb9.jpg--}}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" style="margin-left: 10px;">
                                                            <a class="btn btn-block btn-outline-diy">
                                                                <i class="fas fa-edit"></i> 编辑
                                                            </a>
                                                        </div>
                                                        <div class="btn-group" style="margin-left: 10px;">
                                                            <a class="btn btn-block btn-outline-diy">
                                                                <i class="fas fa-trash"></i> 删除
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