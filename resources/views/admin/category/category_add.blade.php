@extends('admin.index')

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-10" style="margin: 20px auto; ">
            <div class="card card-diy">
                <div class="card-header">
                    <h3 class="card-title">添&ensp;加&ensp;分&ensp;类</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="categoryName">分类名称：</label>
                        <input type="text" id="categoryName" class="form-control">
                        <p id="categoryValidate"></p>
                    </div>

                    <div class="form-group">
                        <label for="demo1">分类代表性图片：</label>
                        <div class="layui-upload">
                            <div class="layui-upload-list float-left">
                                <img class="layui-upload-img demoUp"
                                     src="{{asset('/Bookstore/uploads/uploadDefault.png')}}" id="demo1"
                                     style="width: 100px; height: 125px;border-radius: 5px; border: 1px dashed lightgray"
                                     onclick="uploadBtn(1)">
                            </div>
                            {{--<div class="btn-group float-left" style="margin-top: 35px;margin-left: 20px;" onclick="uploadBtn(1)">--}}
                            {{--<a class="btn btn-app upbtn" id="test1" name="123">--}}
                            {{--<i class="fas fa-trash"></i> 上传图片--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            <div class="clearfix"></div>
                            <p id="demoText"></p>
                            {{--<button type="button" class="btn btn-add" id="test1" name="123">上传图片</button>--}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="categoryDescription">分类描述：</label>
                        <textarea id="categoryDescription" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-add btn-lg" onclick="Add(1)" id="cateadd">&ensp;&ensp;&ensp;添&ensp;&ensp;&ensp;加&ensp;&ensp;&ensp;</button>
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

    <div class="row">
        <div class="col-md-10" style="margin: 20px auto;">
            <div class="card card-diy">
                <div class="card-header">
                    <h3 class="card-title">添&ensp;加&ensp;类&ensp;别</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="classesName">类别名称：</label>
                        <input type="text" id="classesName" class="form-control">
                        <p id="classesValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="classesCategory">所属分类名称：</label>
                        <select id="classesCategory" class="form-control custom-select">
                            @foreach($categories as $category)
                                {{--<option selected disabled>小说</option>--}}
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="demo2">类别代表性图片：</label>
                        <div class="layui-upload">
                            <div class="layui-upload-list float-left">
                                <img class="layui-upload-img demoUp"
                                     src="{{asset('/Bookstore/uploads/uploadDefault.png')}}" id="demo2"
                                     style="width: 100px; height: 125px; border-radius: 5px; border: 1px dashed lightgray;"
                                     onclick="uploadBtn(2)">
                            </div>
                            <div class="clearfix"></div>
                            <p id="demoText"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="classesDescription">类别描述：</label>
                        <textarea id="classesDescription" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-add btn-lg" onclick="Add(2)">&ensp;&ensp;&ensp;添&ensp;&ensp;&ensp;加&ensp;&ensp;&ensp;</button>
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

        function uploadBtn(btnFlag) {
            demo = '#demo' + btnFlag;
        }

        layui.use(['upload'], function () {
            var $ = layui.jquery
                , upload = layui.upload
            var t_token = $('#token').val();
            var uploadInst = upload.render({
                elem: '.demoUp'
                , url: '{{url("admin/service/category/img")}}'
                , data: {'_token': t_token}
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    // obj.preview(function(index, file, result){
                    //     $('#demo1').attr('src', result); //图片链接（base64）
                    // });
                }
                , done: function (res) {

                    //如果上传失败
                    if (res.code != 200) {
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    // console.log(res);
                    // $('#demoText').html(res.data.value);
                    $(demo).attr('src', res.data.src);
                }
                , error: function () {
                    this.item.html('重选上传');
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span>');
                }
            });
        });
    </script>
    <script>
        function Add(btnFlag) {
            var arr = {};
            var url = '';
            if (btnFlag == 1) {
                if ($('#categoryName').val() == null || $('#categoryName').val() == '') {
                    $('#categoryValidate').html('<span style="color: #FF5722;">* 分类名称不能为空</span>');
                } else {
                    $('#categoryValidate').html('');
                    url = "{{url('/admin/service/category/add')}}";
                    arr['name'] = $('#categoryName').val();
                    arr['image'] = $('#demo1').attr('src');
                    arr['description'] = $('#categoryDescription').val();
                    ajaxAdd(url, arr);
                }
            } else if (btnFlag == 2) {
                if ($('#classesName').val() == null || $('#classesName').val() == '') {
                    $('#classesValidate').html('<span style="color: #FF5722;">* 类别名称不能为空</span>');
                } else {
                    $('#classesValidate').html('');
                    url = "{{url('/admin/service/classes/add')}}";
                    arr['name'] = $('#classesName').val();
                    arr['categoryId'] = $('#classesCategory option:selected').attr('value');
                    arr['image'] = $('#demo2').attr('src');
                    arr['description'] = $('#classesDescription').val();
                    ajaxAdd(url, arr);
                }
            }
            // console.log(arr);
        }

        function ajaxAdd(addUrl, arrData) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: addUrl, // 需要提交的 url
                dataType: 'json',
                data: {
                    arr: JSON.stringify(arrData),
                    _token: '{{csrf_token()}}',
                },
                success: function (data) {
                    if (data == null) {
                        layer.msg('服务端错误', {icon: 2, time: 2000});
                        return;
                    }
                    if (data.status != 0) {
                        layer.msg(data.message, {icon: 2, time: 2000});
                        return;
                    }

                    layer.msg(data.message, {icon: 1, time: 2000}, function () {
                        window.location.href = "{{url('/admin/books/category')}}";
                    });
                    // parent.location.reload();

                },
                error: function (xhr, status, error) {
                    // console.log(xhr);
                    // console.log(status);
                    // console.log(error);
                    layer.msg('ajax error', {icon: 2, time: 2000});
                },
                beforeSend: function (xhr) {
                    layer.load(0, {shade: false});
                },
            })
        }

    </script>
@endsection
