@extends('admin.index')

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-10" style="margin: 20px auto;">
            <div class="card card-diy">
                <div class="card-header">
                    <h3 class="card-title">图&ensp;书&ensp;修&ensp;改</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group float-left" style="width:49%;">
                        <label for="bookName">图书名称：</label>
                        <input type="text" id="bookName" class="form-control" value="{{$book->name}}">
                        <p id="bookNameValidate"></p>
                    </div>
                    <div class="form-group float-left" style="width:49%;margin-left: 1%;">
                        <label for="author">图书作者：</label>
                        <input type="text" id="author" class="form-control" value="{{$book->author}}">
                        <p id="authorValidate"></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group float-left" style="width:49%;">
                        <label for="bookCategory">图书分类：</label>
                        <select id="bookCategory" class="form-control custom-select" onchange="change({{$classes}})">
                            <option selected value="{{$book->category_id}}">{{$book->category->name}}</option>
                            @foreach($categories as $category)
                                @if($category->id !== $book->category_id)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-left" style="width:49%;margin-left: 1%;">
                        <label for="bookClasses">图书类别：</label>
                        <select id="bookClasses" class="form-control custom-select">
                            <option selected value="{{$book->classes_id}}">{{$book->classes->name}}</option>
                            @foreach($classes as $class)
                                @if($class->category_id == $book->category_id)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group float-left" style="width: 24%;">
                        <label for="price">图书价格：</label>
                        <input type="number" id="price" class="form-control" value="{{$book->price}}">
                        <p id="priceValidate"></p>
                    </div>
                    <div class="form-group float-left" style="width: 24%; margin-left: 1%;">
                        <label for="rentalPrices">出租价格：</label>
                        <input type="number" id="rentalPrices" class="form-control" value="{{$book->rental_prices}}">
                        <p id="rentalPricesValidate"></p>
                    </div>
                    <div class="form-group float-left" style="width: 24%; margin-left: 1%;">
                        <label for="quantity">图书总量：</label>
                        <input type="number" id="quantity" class="form-control" value="{{$book->quantity}}">
                        <p id="quantityValidate"></p>
                    </div>
                    <div class="form-group float-left" style="width: 24%; margin-left: 1%;">
                        <label for="inventory">图书库存：</label>
                        <input type="number" id="inventory" class="form-control" value="{{$book->inventory}}">
                        <p id="inventoryValidate"></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group float-left" style="width:49%;">
                        <label for="demo2">图书图片：</label>
                        <div class="layui-upload">
                            <div class="layui-upload-list float-left">
                                <img class="layui-upload-img demoUp"
                                     src="{{asset($book->book_img)}}" id="demo2"
                                     style="width: 100px; height: 125px; border-radius: 5px; border: 1px dashed lightgray;"
                                     onclick="uploadBtn(2)">
                            </div>
                            <div class="clearfix"></div>
                            <p id="demoText"></p>
                        </div>
                    </div>
                    <div class="form-group float-left" style="width:30%;margin-left: 1%">
                        <label for="hot" style="margin-top: 20px;">是否热销：</label>
                        <select id="hot" class="form-control custom-select">
                            @if($book->hot == 1)
                                <option selected value="1">热销</option>
                                <option value="2">非热销</option>
                            @elseif($book->hot == 2)
                                <option value="1">热销</option>
                                <option selected value="2">非热销</option>
                            @endif
                        </select>
                        <label for="status">状态：</label>
                        <select id="status" class="form-control custom-select">
                            @if($book->book_status == 1)
                                <option selected value="1">已上架</option>
                                <option value="2">已下架</option>
                            @elseif($book->book_status == 2)
                                <option value="1">已上架</option>
                                <option selected value="2">已下架</option>
                            @endif
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="bookDescription">图书简介:</label>
                        <textarea id="bookDescription" class="form-control" rows="5">{{$book->description}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-add btn-lg" onclick="Edit({{$book->id}})">&ensp;&ensp;&ensp;修&ensp;&ensp;&ensp;改&ensp;&ensp;&ensp;</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

@section('my-js')
    <script>
        function change(classes) {
            $('#bookClasses').find('option').remove();
            classes.forEach(function (item) {
                // console.log(item);
                if (item.category_id == $('#bookCategory option:selected').attr('value')) {
                    $('#bookClasses').append('<option value="' + item.id + '">' + item.name + '</option>');
                }
            });
        }

        function Edit(bookId) {
            var arr = {};
            var url = '';
            if ($('#bookName').val() == null || $('#bookName').val() == '') {
                $('#bookNameValidate').html('<span style="color: #FF5722;">* 图书名称不能为空</span>');
            } else {
                $('#bookNameValidate').html('');
            }
            if ($('#author').val() == null || $('#author').val() == '') {
                $('#authorValidate').html('<span style="color: #FF5722;">* 图书作者不能为空</span>');
            } else {
                $('#authorValidate').html('');
            }
            if ($('#price').val() == null || $('#price').val() == '') {
                $('#priceValidate').html('<span style="color: #FF5722;">* 图书价格不能为空</span>');
            } else {
                $('#priceValidate').html('');
            }
            if ($('#rentalPrices').val() == null || $('#rentalPrices').val() == '') {
                $('#rentalPricesValidate').html('<span style="color: #FF5722;">* 出租价格不能为空</span>');
            } else {
                $('#rentalPricesValidate').html('');
            }
            if ($('#quantity').val() == null || $('#quantity').val() == '') {
                $('#quantityValidate').html('<span style="color: #FF5722;">* 图书总量不能为空</span>');
            } else {
                $('#quantityValidate').html('');
            }
            if ($('#inventory').val() == null || $('#inventory').val() == '') {
                $('#inventoryValidate').html('<span style="color: #FF5722;">* 图书库存不能为空</span>');
            }else {
                $('#inventoryValidate').html('');
                url = "{{url('/admin/service/book/edit')}}";
                arr['id'] = bookId;
                arr['name'] = $('#bookName').val();
                arr['author'] = $('#author').val();
                arr['categoryId'] = $('#bookCategory option:selected').attr('value');
                arr['classesId'] = $('#bookClasses option:selected').attr('value');
                arr['image'] = $('#demo2').attr('src');
                arr['price'] = $('#price').val();
                arr['rentalPrices'] = $('#rentalPrices').val();
                arr['quantity'] = $('#quantity').val();
                arr['inventory'] = $('#inventory').val();
                arr['hot'] = $('#hot option:selected').attr('value');
                arr['status'] = $('#status option:selected').attr('value');
                arr['description'] = $('#bookDescription').val();
                ajaxAdd(url, JSON.stringify(arr));
            }
            // console.log(arr);
        }

        function ajaxAdd(addUrl, arrData) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: addUrl, // 需要提交的 url
                dataType: 'json',
                data: {
                    arr: arrData,
                    _token: '{{csrf_token()}}',
                },
                success: function (data) {
                    if (data == null) {
                        layer.msg('服务端错误', {icon: 1, time: 2000});
                        return;
                    }
                    if (data.status != 0) {
                        layer.msg(data.message, {icon: 2, time: 2000});
                        return;
                    }
                    layer.msg(data.message, {icon: 1, time: 2000}, function () {
                        window.location.href = "{{url('/admin/books/book')}}";
                    });
                },
                error: function (xhr, status, error) {
                    layer.msg('ajax error', {icon: 2, time: 2000});
                },
                beforeSend: function (xhr) {
                    // layer.load(0, {shade: false});
                },
            })
        }
    </script>
@endsection
