<?php $this->start('css')?>
<link rel="stylesheet" type="text/css" href="/mobile/css/mobiscroll.css"/>
<?php $this->end('css')?>
<header style="display:none">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            工作经历
        </h1>
    </div>
</header>
<div class="m-wraper edit-education-bottom wraper">
    <div class="education-items" style="display: none;">
        <form action="" method="post">
        <div class="education-title">
            <h3>
                工作经历<i></i></span>
                <a onclick="deleteEd(this);" class="deletbtn ml20">删除</a>
                <a onclick="checkForm(this);" class="savetbtn">保存</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>公司：</span>
                <div><input type="text" name="company"  /></div>
            </li>
            <li  class="no-right-ico">
                <span>职位：</span>
                <div>
                    <input type="text" name="position"   />
                </div>
            </li>
            <li  class="no-right-ico">
                <span>开始日期：</span>
                <div>
                    <input onclick="showDialog(this);" onblur="hideDialog();" type="text" name="start_date" placeholder="<?php echo date('Y-m-d'); ?>" class="checktime" />
                </div>
            </li>
            <li  class="no-right-ico">
                <span>结束日期：</span>
                <div>
                    <input onclick="showDialog(this);" onblur="hideDialog();" type="text" name="end_date" placeholder="<?php echo date('Y-m-d'); ?>" class="checktime" />
                </div>
            </li>
            <li  class="no-b-border textareabox no-right-ico">
                <span>描述</span>
                <textarea name="descb"></textarea>
            </li>
        </ul>
        </form>
    </div>
    <?php $key=1; foreach($careers as $career):?>
        <div class="education-items oldlist">
        <form action="" method="post">
        <div class="education-title">
            <h3 data-id="<?=$career->id?>">
                工作经历<?php echo $key;$key++;?><i></i></span>
                <a onclick="deleteEd(this);" class="deletbtn ml20">删除</a>
                <a onclick="checkForm(this);" class="savetbtn">保存</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>公司：</span>
                <div><input name="company" type="text" value="<?=$career->company?>"  /></div>
            </li>
            <li  class="no-right-ico">
                <span>职位：</span>
                <div>
                    <input name="position" type="text" value="<?=$career->position?>" />
                </div>
            </li>
            <li  class="no-right-ico">
                <span>开始日期：</span>
                <div>
                    <input onclick="showDialog(this);" onblur="hideDialog();" type="text" name="start_date" value="<?=$career->start_date ?>"  />
                </div>
            </li>
            <li  class="no-right-ico">
                <span>结束日期：</span>
                <div>
                    <input onclick="showDialog(this);" onblur="hideDialog();" type="text" name="end_date" value="<?=$career->end_date ?>" />
                </div>
            </li>
            <li  class="no-b-border textareabox no-right-ico">
                <span>描述</span>
                <textarea name="descb"><?=$career->descb?></textarea>
            </li>
        </ul>
        </form>
    </div>
    <?php endforeach;?>
    <div class="add-subject nobottom">
        <span id="addwork">添加工作经历</span>
    </div>
</div>
<?= $this->element('checkdate'); ?>
<script type="text/javascript">
    $('#addwork').on('touchstart', function () {
        $('.wraper .education-items').eq(0).clone(true).insertBefore('.add-subject').show();
    });


    if($('.oldlist').length == 0){
        $('.wraper .education-items').eq(0).clone(true,true).insertBefore('.add-subject').show();
    }
</script>
<!--<script src="/mobile/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/mobiscroll.2.13.2.js" type="text/javascript" charset="utf-8"></script>-->
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    if($.util.isAPP){
        LEMON.sys.back('/home/edit-userinfo');
    }

    function deleteEd(em) {
        var id = $(em.parentNode).data('id'), form=em;
        while(form && form.tagName != 'FORM'){
            form = form.parentNode;
        }
        if(!form || form.tagName != 'FORM') return;
        if(!id){
            $(form.parentNode).remove();
            return false;
        }
        if(window.confirm('您确认要删除这段工作经历吗?')){
            $.util.ajax({
                url:'/home/del-work/'+id,
                func:function(res){
                    $.util.alert(res.msg);
                    if(res.status){
                        $(form.parentNode).remove();
                    }
                }
            });
        }
    }

    function msg(str) {
        $.util.alert(str);
    }

    function checkForm(em){
        var form = em;
        while(form && form.tagName != 'FORM'){
            form = form.parentNode;
        }
        if(!form || form.tagName != 'FORM') return;
        if(!form.company.value){
            $.util.alert('请填写公司');
            return;
        }
        if(!form.position.value){
            $.util.alert('请填职位');
            return;
        }
        if(!form.start_date.value){
            $.util.alert('请填写开始时间');
            return;
        }
        if(!form.end_date.value){
            $.util.alert('请填写结束时间,如果未结束,可填写"至今"');
            return;
        }


        var data_id =  $(em.parentNode).data('id');
        var data = $(form).serialize();
        if(data_id){
            data += '&id='+data_id;
            //data['id'] = data_id;
        }
        $.util.ajax({
            data : data,
            url:'save-work',
            func : function(res){
                $.util.alert(res.msg);
                if(res.id){
                    $(em.parentNode).attr('data-id', res.id);
                }
            }
        });


        //form.submit();
    }
</script>