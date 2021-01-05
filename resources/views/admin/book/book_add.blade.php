@extends('admin.index')

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-10" style="margin: 20px auto;">
            <div class="card card-diy">
                <div class="card-header">
                    <h3 class="card-title">图&ensp;书&ensp;添&ensp;加</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group float-left" style="width:49%;">
                        <label for="bookName">图书名称：</label>
                        <input type="text" id="bookName" class="form-control" placeholder="请输入图书名称">
                        <p id="bookNameValidate"></p>
                    </div>
                    <div class="form-group float-left" style="width:49%;margin-left: 1%;">
                        <label for="author">图书作者：</label>
                        <input type="text" id="author" class="form-control" placeholder="请输入图书作者">
                        <p id="authorValidate"></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group float-left" style="width:49%;">
                        <label for="bookCategory">图书分类：</label>
                        <select id="bookCategory" class="form-control custom-select" onchange="change({{$classes}})">
                            @foreach($categories as $category)
                                {{--<option selected disabled>小说</option>--}}
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group float-left" style="width:49%;margin-left: 1%;">
                        <label for="bookClasses">图书类别：</label>
                        <select id="bookClasses" class="form-control custom-select">
                            @foreach($classesFirst as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group float-left" style="width: 35%;">
                        <label for="price">图书价格：</label>
                        <input type="number" id="price" class="form-control" placeholder="请输入图书价格">
                        <p id="priceValidate"></p>
                    </div>
                    <div class="form-group float-left" style="width: 35%; margin-left: 1%;">
                        <label for="rentalPrices">出租价格：</label>
                        <input type="number" id="rentalPrices" class="form-control" placeholder="请输入图书出租价格">
                        <p id="rentalPricesValidate"></p>
                    </div>
                    <div class="form-group float-left" style="width: 27%; margin-left: 1%;">
                        <label for="quantity">图书总量：</label>
                        <input type="number" id="quantity" class="form-control" placeholder="默认为0">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="demo2">图书图片：</label>
                        <div class="layui-upload">
                            <div class="layui-upload-list float-left">
                                <img class="layui-upload-img demoUp" src="{{asset('/Bookstore/uploads/uploadDefault.png')}}" id="demo2" style="width: 100px; height: 125px; border-radius: 5px; border: 1px dashed lightgray;" onclick="uploadBtn(2)">
                            </div>
                            <div class="clearfix"></div>
                            <p id="demoText"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bookDescription">图书简介：</label>
                        <textarea id="bookDescription" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-add btn-lg" onclick="Add()">&ensp;&ensp;&ensp;添&ensp;&ensp;&ensp;加&ensp;&ensp;&ensp;</button>
                            {{--<a href="#" class="btn btn-secondary">Cancel</a>--}}
                            {{--<input type="submit" value="Create new Porject" class="btn btn-success float-right">--}}
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
        var demo;
        function uploadBtn(btnFlag){
            demo = '#demo' + btnFlag;
        }
        layui.use(['upload'], function(){
            var $ = layui.jquery
                ,upload = layui.upload
            var t_token = $('#token').val();
            var uploadInst = upload.render({
                elem: '.demoUp'
                ,url: '{{url("admin/service/category/img")}}'
                ,data: {'_token': t_token}
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    // obj.preview(function(index, file, result){
                    //     $('#demo1').attr('src', result); //图片链接（base64）
                    // });
                }
                ,done: function(res){

                    //如果上传失败
                    if(res.code != 200){
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    // console.log(res);
                    // $('#demoText').html(res.data.value);
                    $(demo).attr('src', res.data.src);
                }
                ,error: function(){
                    this.item.html('重选上传');
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span>');
                }
            });
        });
    </script>
    <script>
        function change(classes) {
            $('#bookClasses').find('option').remove();
            classes.forEach(function (item) {
                // console.log(item);
                if (item.category_id == $('#bookCategory option:selected').attr('value')){
                    $('#bookClasses').append('<option value="' + item.id + '">' + item.name + '</option>');
                }
            });
        }

        function Add() {
            var arr = {};
            var url = '';
                if ($('#bookName').val() == null || $('#bookName').val() == '') {
                    $('#bookNameValidate').html('<span style="color: #FF5722;">* 图书名称不能为空</span>');
                }else {
                    $('#bookNameValidate').html('');
                }
                if ($('#author').val() == null || $('#author').val() == ''){
                    $('#authorValidate').html('<span style="color: #FF5722;">* 图书作者不能为空</span>');
                }else{
                    $('#authorValidate').html('');
                }
                if ($('#price').val() == null || $('#price').val() == ''){
                    $('#priceValidate').html('<span style="color: #FF5722;">* 图书价格不能为空</span>');
                }else {
                    $('#priceValidate').html('');
                }
                if ($('#rentalPrices').val() == null || $('#rentalPrices').val() == ''){
                    $('#rentalPricesValidate').html('<span style="color: #FF5722;">* 出租价格不能为空</span>');
                }else{
                    $('#rentalPricesValidate').html('');
                    url = "{{url('/admin/service/book/add')}}";
                    arr['name'] = $('#bookName').val();
                    arr['author'] = $('#author').val();
                    arr['categoryId'] = $('#bookCategory option:selected').attr('value');
                    arr['classesId'] = $('#bookClasses option:selected').attr('value');
                    arr['image'] = $('#demo2').attr('src');
                    arr['price'] = $('#price').val();
                    arr['rentalPrices'] = $('#rentalPrices').val();
                    if ($('#quantity').val() == null || $('#quantity').val() == ''){
                        arr['quantity'] = 0;
                    } else{
                        arr['quantity'] = $('#quantity').val();
                    }
                    arr['description'] = $('#bookDescription').val();
                    ajaxAdd(url,JSON.stringify(arr));
                }
            // console.log(arr);
        }

        function ajaxAdd(addUrl,arrData) {
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
                    layer.msg(data.message, {icon: 1, time: 2000},function(){
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
