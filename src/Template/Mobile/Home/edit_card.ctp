<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            上传名片
        </h1>
    </div>
</header>

<div class="wraper">
    <div class="uploadbox nobottom">
        <input type="hidden" name="card_path" value="<?= $user->card_path ?>" />

        <!-- <a href='javascript:void(0);' class='imgcard'><div class="scroller"> -->
            <img id="img" class='upload_pic' src='<?= $user->card_path ?>' />
        <!-- </div></a> -->

        <a href="javascript:void(0)" id="uploadPic" class="uploadbtn">上传名片</a>
        <!--<a href="#this" style="width:100%" id="save" class="nextstep">保存</a>-->
    </div>
</div>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(function () {
        $('#uploadPic').on('touchstart', function () {
            if ($.util.isAPP) {
                LEMON.event.uploadPhoto('{"dir":"user/mp"}', function (data) {
                    var data = JSON.parse(data);
                    $('#img').attr('src', data.path);

                    if (data.status === true) {
                        $('#img').attr('src', data.path);
                        $.util.ajax({
                            data: {card_path: data.path},
                            func: function (msg) {
                                $.util.alert(msg.msg);
                            }
                        });
                    } else {
                        $.util.alert('app上传失败');
                    }
                });
                return false;
            } else if ($.util.isWX) {
                $.util.wxUploadPic(function (id) {
                    $.util.ajax({
                        url: "/wx/wxUploadPic/" + id + '?dir=user/mp',
                        func: function (res) {
                            if (res.status === true) {
                                $('#img').attr('src', res.path);
                                $.util.ajax({
                                    data: {card_path: res.path},
                                    func: function (msg) {
                                        $.util.alert(msg.msg);
                                    }
                                });
                            }
                        }
                    });
                });
            } else {
                $.util.alert('请在微信或APP上传图片');
            }
        });

    });
</script>
<?php
$this->end('script');
