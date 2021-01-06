<script>
    function editAjax(url, arrData, hrefURL) {
        $.ajax({
            type: 'post',
            url: url,
            dataType: 'json',
            data: {
                arr: JSON.stringify(arrData),
                _token: "{{csrf_token()}}"
            },
            success: function (data) {
                if (data == null) {
                    alert('服务端错误');
                    return;
                }
                if (data.status != 0) {
                    $('.Validate').html('<span style="color: #FF5722;">* ' + data.message + '</span>');
                    return;
                }
                alert(data.message);
                {{--"{{url('admin/login')}}"--}}
                if (hrefURL){
                    window.location.href = hrefURL;
                }
            },
            error: function (xhr, status, error) {
                alert('ajax error');
            },
            beforeSend: function (xhr) {
            }
        });
    }
</script>