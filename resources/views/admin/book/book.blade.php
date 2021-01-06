@extends('admin.index')
@section('my-css')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-11" style="margin: 20px auto;">
                            <form id="bookSearch" method="get" action="{{url('admin/books/book')}}">
                                <div class="form-group float-left" style="width: 35%;">
                                    <label for="bookName">图书名称：</label>
                                    <input type="text" id="bookName" class="form-control" name="name" placeholder="图书名称"
                                           value="{{$keyword['name']}}">
                                    <label for="author">图书作者：</label>
                                    <input type="text" id="author" class="form-control" name="author" placeholder="图书作者"
                                           value="{{$keyword['author']}}">
                                </div>
                                <div class="form-group float-left" style="width:30%;margin-left: 2%">
                                    <label for="bookCategory">图书分类：</label>
                                    <select id="bookCategory" class="form-control custom-select" name="category"
                                            onchange="change({{$classes}})">
                                        <option value="">全部分类</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if($keyword['category_id'] == $category->id)
                                                    selected
                                                    @endif
                                            >{{$category->name}}</option>
                                            {{--                                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
                                        @endforeach
                                    </select>
                                    <label for="bookClasses">图书类别:</label>
                                    <select id="bookClasses" class="form-control custom-select" name="classes">
                                        <option value="">全部类别</option>
                                        @foreach($classesFirst as $class)
                                            <option value="{{$class->id}}"
                                                    @if($keyword['classes_id'] == $class->id)
                                                    selected
                                                    @endif
                                            >{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group float-left" style="margin: 2% auto auto 4%; width: 100px;">
                                    <label for="status">是否热销：</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hot" value=""
                                                   @if($keyword['hot'] == '') checked @endif>
                                            <label class="form-check-label">全部</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hot" value="1"
                                                   @if($keyword['hot'] == 1) checked @endif>
                                            <label class="form-check-label">热销</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hot" value="2"
                                                   @if($keyword['hot'] == 2) checked @endif>
                                            <label class="form-check-label">非热销</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-left" style="margin: 2% auto auto 2%; width: 100px;">
                                    <label for="status">状态：</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value=""
                                                   @if($keyword['book_status'] == '') checked @endif>
                                            <label class="form-check-label">全部</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1"
                                                   @if($keyword['book_status'] == 1) checked @endif>
                                            <label class="form-check-label">已上架</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="2"
                                                   @if($keyword['book_status'] == 2) checked @endif>
                                            <label class="form-check-label">已下架</label>
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
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <span><h3 class="card-title" style="font-weight: bold;">图书详情列表</h3></span>
                                <span style="float: right;">
                                    <div class="btn-group">
                                        <a class="btn btn-add" href="{{url('admin/books/book_add')}}" style="">
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
                                        <th width="200">图书名称</th>
                                        <th width="100">图书作者</th>
                                        <th width="90">图书分类</th>
                                        <th width="90">图书类别</th>
                                        <th width="90">图书图片</th>
                                        <th width="90">图书价格</th>
                                        <th width="90">出租价格</th>
                                        <th width="90">图书总量</th>
                                        <th width="90">图书库存</th>
                                        <th width="90">是否热销</th>
                                        <th width="70">状态</th>
                                        <th width="110">更新时间</th>
                                        <th width="90">更新者</th>
                                        <th width="300">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody id="bookBody">
                                    @foreach($books as $book)
                                        <tr data-widget="expandable-table" aria-expanded="false"
                                            style="word-break:break-all;word-wrap:break-word;">
                                            <td width="200">{{$book->name}}</td>
                                            <td width="100">{{$book->author}}</td>
                                            <td width="90">{{$book->category->name}}</td>
                                            <td width="90">{{$book->classes->name}}</td>
                                            <td style="text-align: center; display:table-cell; vertical-align:middle;"
                                                width="90">
                                                <img src="{{$book->book_img}}" style="width: 60px;">
                                            </td>
                                            <td width="90">￥{{$book->price}}</td>
                                            <td width="90">￥{{$book->rental_prices}}</td>
                                            <td width="90">{{$book->quantity}}</td>
                                            <td width="90">{{$book->inventory}}</td>
                                            <td width="90">
                                                @if($book->hot == 2)
                                                    否
                                                @elseif($book->hot == 1)
                                                    是
                                                @endif
                                            </td>
                                            <td width="70">
                                                @if($book->book_status == 2)
                                                    已下架
                                                @elseif($book->book_status == 1)
                                                    已上架
                                                @endif
                                            </td>
                                            <td width="110">{{$book->update_time}}</td>
                                            <td width="90">{{$book->user->user_name}}</td>
                                            <td width="300">
                                                <div class="btn-group" style="margin-left: 10px;">
                                                    <a class="btn btn-app"
                                                       href="{{url('admin/books/book_edit')}}?id={{$book->id}}"
                                                       onclick="event.stopPropagation()">
                                                        <i class="fas fa-edit"></i> 编辑
                                                    </a>
                                                </div>
                                                <div class="btn-group" style="margin-left: 10px;">
                                                    <a class="btn btn-app" onclick="bookDel(event,{{$book->id}})">
                                                        <i class="fas fa-trash-alt"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="expandable-body">
                                            <td colspan="14">
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
                            <div class="card-footer" id="bookPage">
                                {{--Laravel 自带分页功能paginate(n)，通过此获得分页按钮，再次上传参数--}}
                                {{--{{$books->links()}}--}}
                                {!! $books->appends([
                                    'name'=>$keyword['name'],
                                    'author'=>$keyword['author'],
                                    'category'=>$keyword['category_id'],
                                    'classes'=>$keyword['classes_id'],
                                    'hot'=>$keyword['hot'],
                                    'book_status'=>$keyword['book_status'],
                                ])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('my-js')
    <script>
        $('#bookBody tr:first').attr('aria-expanded', true);
        $('#bookPage nav ul').attr('class','pagination justify-content-center m-0');
    </script>
    <script>
        function change(classes, keyword) {
            // console.log(classes,keyword);
            $('#bookClasses').find('option').remove();
            $('#bookClasses').append('<option value="">全部类别</option>');
            classes.forEach(function (item) {
                // console.log(item);
                if (item.category_id == $('#bookCategory option:selected').attr('value')) {
                    $('#bookClasses').append('<option value="' + item.id + '">' + item.name + '</option>');
                }
            });
        }

        function bookDel(e, bookId) {
            e.stopPropagation();
            if (confirm("确定删除吗？")) {
                var url = "{{url('admin/service/book/del')}}";
                ajaxDel(url, bookId);
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
                    window.location.href = "{{url('admin/books/book')}}";
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