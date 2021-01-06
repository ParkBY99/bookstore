{{--修改layuiUploda的JS,供有图片上传功能的页面引用--}}
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