<?php $this->start('css')?>
<link rel="stylesheet" type="text/css" href="/mobile/css/mobiscroll.css"/>
<?php $this->end('css')?>
<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            教育经历
        </h1>

    </div>
</header>
<iframe id="submitAction" name="submitAction" style="display: none"></iframe>
<div class="m-wraper edit-education-bottom wraper">
    <div class="education-items" style="display: none">
        <form action="" method="post">
        <div class="education-title">
            <h3>
                教育经历<i></i></span>
                <a onclick="delete(this);" class="deletbtn ml20">删除</a>
                <a onclick="checkForm(this);" class="savetbtn">保存</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>学校：</span>
                <div><input name="school" type="text" /></div>
            </li>
            <li  class="no-right-ico">
                <span>院系/专业：</span>
                <div>
                    <input name="major" type="text"  />
                </div>
            </li>
            <li class="no-right-ico">
                <span>学历：</span>
                <div>
                    <select name="deucation" class="education">
                        <option value="1">高中</option>
                        <option value="2">中专</option>
                        <option value="3">大专</option>
                        <option value="4">本科</option>
                        <option value="5" selected="selected">研究生</option>
                        <option value="6">硕士</option>
                        <option value="7">博士</option>
                    </select>
                </div>
            </li>
            <li>
                <span>开始日期：</span>
                <div>
                    <input type="text" name="start_date" class="checktime" readonly="readonly" />
                </div>
            </li>
            <li class="no-b-border">
                <span>结束日期：</span>
                <div>
                    <input type="text" name="end_date" readonly="readonly" class="checktime"/>
                </div>
            </li>

        </ul>
        </form>
    </div>
    <?php $k=0?>
    <?php foreach($educations as $education): ?>
    <?php $k++;?>
    <div class="education-items">
        <form action="" method="post">
        <div class="education-title">
            <h3>
                教育经历<i><?=$k?></i></span>
                <a onclick="delete(this);" data-id="<?=$education->id?>" class="deletbtn ml20">删除</a>
                <a onclick="checkForm(this);" data-id="<?=$education->id?>" class="savebtn">保存</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>学校：</span>
                <div><input name="school" type="text" value="<?=$education->school?>" /></div>
            </li>
            <li  class="no-right-ico">
                <span>院系/专业：</span>
                <div>
                    <input name="major" type="text" value="<?=$education->major?>"  />
                </div>
            </li>
            <li class="no-right-ico">
                <span>学历：</span>
                <div>
                    <select name="education" class="education">
                        <option value="<?=$education->education?>" selected="selected"><?=$educationType[$education->education]?></option>
                        <option value="1">高中</option>
                        <option value="2">中专</option>
                        <option value="3">大专</option>
                        <option value="4">本科</option>
                        <option value="5">研究生</option>
                        <option value="6">硕士</option>
                        <option value="7">博士</option>
                    </select>
                </div>
            </li>
            <li>
                <span>开始日期：</span>
                <div>
                    <input type="text" name="start_date" value="<?=$education->start_date->i18nFormat('yyyy-MM-dd')?>" class="checktime" readonly="readonly" />
                </div>
            </li>
            <li class="no-b-border">
                <span>结束日期：</span>
                <div>
                    <input type="text" name="end_date" readonly="readonly" value="<?=$education->end_date->i18nFormat('yyyy-MM-dd')?>" class="checktime"/>
                </div>
            </li>

        </ul>
        </form>
    </div>
    <?php endforeach;?>
    <div class="add-subject nobottom">
        <span id="addwork">添加教育经历</span>
    </div>
    <!--<a href="javascript:void(0);" id="submit" class="nextstep">完成</a>-->
</div>
<div class='reg-shadow'  style="display: none;"></div>
<script src="/mobile/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/mobiscroll.2.13.2.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $('#addwork').on('touchstart', function () {
        $('.wraper .education-items').eq(0).clone(true,true).insertBefore('.add-subject').show();
    });
    
    function delete() {
        if(window.confirm('您确认要删除这段教育经历吗?')){
            //do delete
        }
    }
    function checkForm(em){
        var form = null;
        while(em){
            if(em.tagName != 'FORM'){
                em = em.parentNode;
            }
            else{
                form = em;
                break;
            }
        }
        if(!form.school.value){
            $.util.alert('请填写学校');
            return;
        }
        if(!form.major.value){
            $.util.alert('请填写院系/专业');
            return;
        }
        if(!form.start_date.value){
            $.util.alert('请填写开始时间');
            return;
        }
        if(!form.start_date.value){
            $.util.alert('请填写结束时间,如果未结束,可填写"至今"');
            return;
        }

        form.submit();
    }
</script>
<script type="text/javascript">
// 日期选择
    $('.checktime').mobiscroll().date({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) {
            return "请选择时间";
        },
        //onBeforeShow: function (inst) { inst.settings.wheels[0].length>2?inst.settings.wheels[0].pop():null; },
        endYear: 2020,
        //startYear:1980
        dateFormat: 'yy-mm-dd',
        rows: 3
    });
    $('.education').mobiscroll().select({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) {
            return "请选择学历";
        },
        rows: 3
    });
    $('.education').mobiscroll().select({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) {
            return "请选择学历";
        },
        rows: 3
    });
//性别选择
    $('.checkedsex').mobiscroll().select({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) {
            return "请选择性别";
        },
    });
    $('.deletbtn').on('tap',function(){
        var id = $(this).data('id');
        var obj = $(this);
        if(!id){
            return false;
        }
        $.util.ajax({
            url:'/home/del-education/'+id,
            func:function(res){
                $.util.alert(res.msg);
                if(res.status){
                    $(obj).parents('div.education-items').remove();
                }
            }
        });
    });
    $('.savebtn').on('tap',function(){
        var data_id =  $(this).data('id');
        var form  = $(this);
        var data = $(form).find('form').serialize();
        if(!data_id){
            data['id'] = data_id;
        }
        $.util.ajax({
            data : data,
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