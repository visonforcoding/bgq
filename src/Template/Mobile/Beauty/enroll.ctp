<link rel="stylesheet" type="text/css" href="/mobile/css/zt.css"/>
<div class="wraper content_inner">
    <div class="infotab m-infotab-list">
        <div class="tabcon bd2 zt_tab_con">
            <form>
            <ul class="cur inner basicon">
                <li class="b-dq"><span><i class="iconfont col_darkblue">&#xe66a;</i>姓 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span><div><em><?= $user->truename; ?></em></div></li>
                <li class="b-hy"><span><i class="iconfont col_yellow">&#xe684;</i>我的星座</span>
                    <div >
                        <em class="hid_wid">
                            <select name="constellation" style="overflow: scroll;">
                                <option value="白羊座">白羊座</option>
                                <option value="金牛座">金牛座</option>
                                <option value="双子座">双子座</option>
                                <option value="巨蟹座">巨蟹座</option>
                                <option value="狮子座">狮子座</option>
                                <option value="处女座">处女座</option>
                                <option value="天秤座">天秤座</option>
                                <option value="天蝎座">天蝎座</option>
                                <option value="射手座">射手座</option>
                                <option value="摩羯座">摩羯座</option>
                                <option value="水瓶座">水瓶座</option>
                                <option value="双鱼座">双鱼座</option>
                            </select>
                        </em>
                    </div>
                    <b class="iconfont r_more">&#xe667;</b>
                </li>
                <li class="b-yw">
                    <span><i class="iconfont col_cyan">&#xe670;</i>参赛宣言</span>
                    <div><em><input name="declaration" type="text" placeholder="请输入" /></em></div>
                </li>
                <li class="b-gs"><span><i class="iconfont color-items">&#xe61c;</i>兴趣爱好</span><div><em><input name="hobby" type="text" placeholder="请输入" /></em></div></li>
                <li class="b-gs noafter"><span><i class="iconfont col_blue">&#xe67e;</i>个人简介</span><div><em class="zt_text"><textarea name="brief" placeholder="请输入"></textarea></em></div></li>
            </ul>
            </form>
        </div>
    </div>
    <!--照片-->
    <div class='photo_album mt20'>
        <div class="p_title  innercon"><h3><i class="iconfont">&#xe685;</i>你的照片</h3></div>
        <div class="photo_list bgff">
            <ul>
                <li><img src="/mobile/images/nophoto.png"/></li>
                <li>
                    <div class="uploadfile">
                        <span class="addpoto"><i class="iconfont">&#xe692;</i></span>
                        <input type="file" name="vote_pic" class="type_file" id="" />
                    </div>
                </li>
            </ul>
            <h3 class="tc poto_tips">( 至少上传1张，最多上传6张 )</h3>
        </div>
    </div>
</div>
<a href="javascript:void(0);" class="f-bottom" id="submit">提交申请</a>
<?php $this->start('script'); ?>
<script>
    $('#submit').on('tap', function(){
        $.util.ajax({
            url: $('form').attr('action'),
            data: $('form').serialize(),
            func: function(res){
                $.util.alert(res.msg);
                if(res.status){
                    setTimeout(function(){
                        location.href = '/beauty/index';
                    }, 1000);
                }
            }
        });
    });
</script>
<?php $this->end('script');