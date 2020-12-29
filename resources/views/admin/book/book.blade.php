@extends('admin.index')
@section('my-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/admin/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>图书详情</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card">
                <div class="card-header">
                    <span><h3 class="card-title">图书详情列表</h3></span>
                    <span style="float: right;">
                        <div class="btn-group">
                            <a class="btn btn-add" href="{{url('admin/books/category_add')}}" style="">
                                <i class="nav-icon fas fa-plus-square"></i>
                                &ensp;添加图书
                            </a>
                        </div>
                    </span>
                </div>
                <!-- ./card-header -->
                <div class="card-body table-responsive p-0">
                    <table id="book-list" class="table table-bordered table-hover text-wrap">
                        <thead>
                        <tr>
                            <th width="280">图书名称</th>
                            <th width="110">图书作者</th>
                            <th width="90">图书分类</th>
                            <th width="90">图书图片</th>
                            <th width="90">图书价格</th>
                            <th width="90">出租价格</th>
                            <th width="90">图书数量</th>
                            <th width="90">是否热销</th>
                            <th width="90">状态</th>
                            <th width="110">更新时间</th>
                            <th width="90">更新者</th>
                            <th width="300">操作</th>
                        </tr>
                        </thead>
                        <tbody id="bookBody">
                        @foreach($books as $book)
                            <tr data-widget="expandable-table" aria-expanded="false" style="word-break:break-all;word-wrap:break-word;">
                                <td width="200">{{$book->name}}</td>
                                <td width="110">{{$book->author}}</td>
                                <td width="90">{{$book->category->name}}</td>
                                <td style="text-align: center;" width="90">
                                    <img src="{{asset('/Bookstore'.$book->book_img)}}" style="width: 60px;">
                                </td>
                                <td width="90">{{$book->price}}</td>
                                <td width="90">{{$book->rental_prices}}</td>
                                <td width="90">{{$book->inventory}}</td>
                                <td width="90">
                                    @if($book->hot == 0)
                                        否
                                    @elseif($book->hot == 1)
                                        是
                                    @endif
                                </td>
                                <td width="90">
                                    @if($book->book_status == 0)
                                        已下架
                                    @elseif($book->book_status == 1)
                                        已上架
                                    @endif
                                </td>
                                <td width="110">{{$book->update_time}}</td>
                                <td width="90">{{$book->user->user_name}}</td>
                                <td width="300">
                                    <div class="btn-group" style="margin-left: 10px;">
                                        <a class="btn btn-app">
                                            <i class="fas fa-edit"></i> 编辑
                                        </a>
                                    </div>
                                    <div class="btn-group" style="margin-left: 10px;">
                                        <a class="btn btn-app">
                                            <i class="fas fa-trash"></i> 删除
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="expandable-body">
                                <td colspan="12">
                                    <p>
                                        <b>图书简介：</b><br>
                                        <span>&emsp;&emsp;{{$book->description}}</span>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('/admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/admin/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/admin/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/admin/js/responsive.bootstrap4.min.js')}}"></script>
    {{--    <script src="{{asset('/admin/js/dataTables.buttons.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/admin/js/buttons.bootstrap4.min.js')}}"></script>--}}
    {{--<script src="{{asset('/admin/js/jszip.min.js')}}"></script>--}}
    {{--<script src="{{asset('/admin/js/buttons.html5.min.js')}}"></script>--}}
    {{--<script src="{{asset('/admin/js/buttons.print.min.js')}}"></script>--}}
    {{--<script src="{{asset('/admin/js/buttons.colVis.min.js')}}"></script>--}}

    <!-- Page specific script -->
    <script>
        $(function () {
            $('#book-list').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        });
        $('#bookBody tr:first').attr('aria-expanded',true);
    </script>
@endsection