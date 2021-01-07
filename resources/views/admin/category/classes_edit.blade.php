@extends('admin.index')

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-10" style="margin: 20px auto;">
            <div class="card card-diy">
                <div class="card-header">
                    <h3 class="card-title">修&ensp;改&ensp;类&ensp;别</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="classesName">类别名称：</label>
                        <input type="text" id="classesName" class="form-control" value="{{$class->name}}">
                        <p id="classesValidate"></p>
                    </div>
                    <div class="form-group">
                        <label for="classesCategory">所属分类名称：</label>
                        <select id="classesCategory" class="form-control custom-select">
                            <option selected value="{{$class->category_id}}">{{$class->category->name}}</option>
                            @foreach($categories as $category)
                                @if($class->category_id !== $category->id)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="demo2">类别代表性图片：</label>
                        <div class="layui-upload">
                            <div class="layui-upload-list float-left">
                                <img class="layui-upload-img demoUp" src="{{asset($class->classes_img)}}" id="demo2"
                                     style="width: 100px; height: 125px; border-radius: 5px; border: 1px dashed lightgray;"
                                     onclick="uploadBtn(2)">
                            </div>
                            <div class="clearfix"></div>
                            <p id="demoText"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="classesDescription">类别描述：</label>
                        <textarea id="classesDescription" class="form-control" rows="5"
                                  value="{{$class->description}}">{{$class->description}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-add btn-lg" onclick="Edit(2,{{$class->id}})">&ensp;&ensp;&ensp;修&ensp;&ensp;&ensp;改&ensp;&ensp;&ensp;</button>
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
        $('#nav-book').addClass('menu-is-opening menu-open');
    </script>
    <script>
        function Edit(btnFlag, id) {
            var arr = {};
            var url = '';
            if (btnFlag == 2) {
                if ($('#classesName').val() == null || $('#classesName').val() == '') {
                    $('#classesValidate').html('<span style="color: #FF5722;">* 类别名称不能为空</span>');
                    return;
                }
                url = "{{url('admin/service/classes/edit')}}";
                arr['id'] = id;
                arr['name'] = $('#classesName').val();
                arr['categoryId'] = $('#classesCategory option:selected').attr('value');
                arr['image'] = $('#demo2').attr('src');
                arr['description'] = $('#classesDescription').val();
            }
            // console.log(arr);
            ajaxEdit(url, arr);
        }

        function ajaxEdit(deitUrl, arrData) {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: deitUrl, // 需要提交的 url
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