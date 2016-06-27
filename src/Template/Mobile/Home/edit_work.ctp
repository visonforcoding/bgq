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
                <a href="javascript:void(0);" class="deletbtn">删除</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>公司：</span>
                <div><input type="text" name="company" placeholder="请输入" /></div>
            </li>
            <li  class="no-right-ico">
                <span>职位：</span>
                <div>
                    <input type="text" name="position" placeholder="请输入" />
                </div>
            </li>
            <li class="">
                <span>开始日期：</span>
                <div>
                    <input type="text" name="start_date" placeholder="请选择日期" class="checktime" readonly="readonly"  />
                </div>
            </li>
            <li class="">
                <span>结束日期：</span>
                <div>
                    <input type="text" name="end_date" placeholder="请选择日期" class="checktime" readonly="readonly"  />
                </div>
            </li>
            <li  class="no-b-border textareabox no-right-ico">
                <span>描述</span>
                <textarea name="desc"></textarea>
            </li>
        </ul>
        </form>
    </div>
    <?php $key=1; foreach($careers as $career):?>
        <div class="education-items">
        <form action="" method="post">
        <div class="education-title">
            <h3>
                工作经历<?php echo $key;$key++;?><i></i></span>
                <a href="javascript:void(0);" data-id="<?=$career->id?>" class="deletbtn">删除</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>公司：</span>
                <div><input name="company" type="text" value="<?=$career->company?>" readonly  /></div>
            </li>
            <li  class="no-right-ico">
                <span>职位：</span>
                <div>
                    <input name="position" type="text" value="<?=$career->position?>" />
                </div>
            </li>
            <li class="">
                <span>开始日期：</span>
                <div>
                    <input type="text" name="start_date" placeholder="请选择日期" value="<?=$career->start_date?>" class="checktime" readonly="readonly"  />
                </div>
            </li>
            <li class="">
                <span>结束日期：</span>
                <div>
                    <input type="text" name="end_date" placeholder="请选择日期" class="checktime" value="<?=$career->end_date?>" readonly="readonly"  />
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
    <div class="education-items">
        <form action="" method="post">
        <div class="education-title">
            <h3>
                工作经历<i></i></span>
                <a href="javascript:void(0);" class="deletbtn">删除</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>公司：</span>
                <div><input name="company" type="text"  /></div>
            </li>
            <li  class="no-right-ico">
                <span>职位：</span>
                <div>
                    <input name="position" type="text" />
                </div>
            </li>
            <li class="">
                <span>开始日期：</span>
                <div>
                    <input type="text" name="start_date" placeholder="请选择日期" class="checktime" readonly="readonly"  />
                </div>
            </li>
            <li class="">
                <span>结束日期：</span>
                <div>
                    <input type="text" name="end_date" placeholder="请选择日期" class="checktime" readonly="readonly"  />
                </div>
            </li>
            <li  class="no-b-border textareabox no-right-ico">
                <span>描述</span>
                <textarea name="descb"></textarea>
            </li>
        </ul>
        </form>
    </div>
    <div class="add-subject nobottom">
        <span id="addwork">添加工作经历</span>
    </div>
    <a href="javascript:void(0);" id="submit" class="nextstep">完成</a>
</div>
<script type="text/javascript">
    $('#addwork').on('touchstart', function () {
        $('.wraper .education-items').eq(0).clone(true).insertBefore('.add-subject').show();
    });
</script>
<script src="/mobile/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/mobiscroll.2.13.2.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
// 日期选择
    $('.checktime').mobiscroll().date({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) {
            return "请选择时间";
        },
        //onBeforeShow: function (inst) { inst.settings.wheels[0].length>2?inst.settings.wheels[0].pop():null; },
        endYear: 2028,
        //startYear:1980
        dateFormat: 'yy-mm-dd',
        rows: 3
    });
    $('.deletbtn').on('tap',function(){
        var id = $(this).data('id');
        var obj = $(this);
        if(!id){
            return false;
        }
        $.util.ajax({
            url:'/home/del-career/'+id,
            func:function(res){
                $.util.alert(res.msg);
                if(res.status){
                    $(obj).parents('div.education-items').remove();
                }
            }
        });
    });
    $('#submit').on('tap',function(){
        var form  = $(this).prevAll('.education-items')[0];
        $.util.ajax({
            data : $(form).find('form').serialize(),
            func : function(res){
                $.util.alert(res.msg);
                if(res.status){
                    setTimeout(function(){
                     window.location.href = '/home/edit-userinfo';   
                    },1500);
                }
            }
        });
    });
</script>