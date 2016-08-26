<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/mobile/css/mobiscroll.css"/>
<?php $this->end('css') ?>
<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            教育经历
        </h1>

    </div>
</header>
<div class="m-wraper edit-education-bottom wraper">
    <div class="education-items" style="display: none;margin-bottom: 10px">
        <form action="/home/save-education" method="post">
            <div class="education-title">
                <h3>
                     <a onclick="deleteEd(this);" class="deletbtn iconfont">&#xe67a;</a>
                    教育经历<i></i></span>
                   
                    <a onclick="checkForm(this);" class="savetbtn fr">保存</a>
                </h3>
            </div>
            <ul class="h-info-box e-info-box">
                <li  class="no-right-ico">
                    <span>学校：</span>
                    <div><input name="school" type="text"/></div>
                </li>
                <li  class="no-right-ico">
                    <span>院系/专业：</span>
                    <div>
                        <input name="major" type="text"  />
                    </div>
                </li>
                <li>
                    <span>学历：</span>
                    <div>
                        <span class='typeselect c-select'>
                            <select name="education" class="education">
                                <option value="1">高中</option>
                                <option value="2">中专</option>
                                <option value="3">大专</option>
                                <option value="4">本科</option>
                                <option value="5" selected="selected">研究生</option>
                                <option value="6">硕士</option>
                                <option value="7">博士</option>
                            </select>
                        </span>
                    </div>
                </li>
                <li class='no-right-ico'>
                    <span>开始日期：</span>
                    <div>
                        <span name="start_date" onclick="_choose=this; showDialog(choosedate);"><?php echo date('Y-m'); ?></span>
                        <input style="display: none" type="text" name="start_date" maxlength="10" value="<?php echo date('Y-m'); ?>"/>
                    </div>
                </li>
                <li class="no-b-border no-right-ico">
                    <span>结束日期：</span>
                    <div>
                        <span name="end_date" onclick="_choose=this; showDialog(choosedate);"><?php echo date('Y-m'); ?></span>
                        <input style="display: none" type="text" name="end_date" maxlength="10" value="<?php echo date('Y-m'); ?>"/>
                    </div>
                </li>

            </ul>
        </form>
    </div>
    <?php $k = 0 ?>
    <?php foreach ($educations as $education): ?>
        <?php $k++; ?>
        <div class="education-items oldlist" style="margin-bottom: 10px">
            <form action="/home/save-education" method="post">
            <!--    <input type="hidden" name="id" value="<?= $education->id ?>">  -->
                <div class="education-title">
                    <h3 data-id="<?= $education->id ?>">
                        <a onclick="deleteEd(this);"  class="deletbtn iconfont">&#xe67a;</a>
                        教育经历<i><?= $k ?></i></span>

                        <a onclick="checkForm(this);" class="savebtn fr">保存</a>
                    </h3>
                </div>
                <ul class="h-info-box e-info-box">
                    <li  class="no-right-ico">
                        <span>学校：</span>
                        <div><input name="school" type="text" value="<?= $education->school ?>" /></div>
                    </li>
                    <li  class="no-right-ico">
                        <span>院系/专业：</span>
                        <div>
                            <input name="major" type="text" value="<?= $education->major ?>"  />
                        </div>
                    </li>
                    <li class="no-right-ico">
                        <span>学历：</span>
                        <div>
                            <span class='typeselect c-select'>
                                <select name="education" class="education">
                                    <option value="<?= $education->education ?>" selected="selected"><?= $educationType[$education->education] ?></option>
                                    <option value="1">高中</option>
                                    <option value="2">中专</option>
                                    <option value="3">大专</option>
                                    <option value="4">本科</option>
                                    <option value="5">研究生</option>
                                    <option value="6">硕士</option>
                                    <option value="7">博士</option>
                                </select>
                            </span>
                        </div>
                    </li>
                    <li  class="no-right-ico">
                        <span>开始日期：</span>
                        <div>
                            <span name="start_date" onclick="_choose=this; showDialog(choosedate);"><?= $education->start_date ?></span>
                            <input style="display: none" type="text" name="start_date" maxlength="10" value="<?= $education->start_date ?>" />
                        </div>
                    </li>
                    <li  class="no-right-ico">
                        <span>结束日期：</span>
                        <div>
                            <span name="end_date" onclick="_choose=this; showDialog(choosedate);"><?= $education->end_date ?></span>
                            <input type="text" style="display: none"  name="end_date" maxlength="10" value="<?= $education->end_date ?>" />
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    <?php endforeach; ?>
    <div class="add-subject nobottom">
        <span id="addwork">添加教育经历</span>
    </div>
    <!--<a href="javascript:void(0);" id="submit" class="nextstep">完成</a>-->
</div>
<div class='reg-shadow'  style="display: none;"></div>
<?= $this->element('checkdate'); ?>
<script type="text/javascript">
    
    $('#addwork').on('touchstart', function () {
        $('.wraper .education-items').eq(0).clone(true, true).insertBefore('.add-subject').show();
    });

    if ($('.oldlist').length == 0) {
        $('.wraper .education-items').eq(0).clone(true, true).insertBefore('.add-subject').show();
    }

    var _choose = null;
    function choosedate(value) {
        _choose.innerHTML = value;
        $(_choose.parentNode).find('input').val(value);
    }

    function deleteEd(em) {
        var id = $(em.parentNode).data('id'), form = em;
        while (form && form.tagName != 'FORM') {
            form = form.parentNode;
        }
        if (!form || form.tagName != 'FORM')
            return;
        if (!id) {
            $(form.parentNode).remove();
            return false;
        }
        if (window.confirm('您确认要删除这段教育经历吗?')) {
            $.util.ajax({
                url: '/home/del-education/' + id,
                func: function (res) {
                    $.util.alert(res.msg);
                    if (res.status) {
                        $(form.parentNode).remove();
                    }
                }
            });
        }
    }

    function msg(str) {
        $.util.alert(str);
    }

    function checkForm(em) {
        var form = em;
        while (form && form.tagName != 'FORM') {
            form = form.parentNode;
        }
        if (!form || form.tagName != 'FORM')
            return;
        if (!form.school.value) {
            $.util.alert('请填写学校');
            return;
        }
        if (!form.major.value) {
            $.util.alert('请填写院系/专业');
            return;
        }
        if (form.start_date.value == '至今') {
            $.util.alert('开始时间不能是至今');
            return;
        }
        if (form.end_date.value != '至今' && form.start_date.value > form.end_date.value) {
            $.util.alert('开始时间不能大于结束时间');
            return;
        }
//        if (!form.start_date.value) {
//            $.util.alert('请选择开始时间');
//            return;
//        }
//        if (!form.end_date.value) {
//            $.util.alert('请填写结束时间,如果未结束,可选择"至今"');
//            return;
//        }


        var data_id = $(em.parentNode).data('id');
        var data = $(form).serialize();
        if (data_id) {
            data += '&id=' + data_id;
            //data['id'] = data_id;
        }
        $.util.ajax({
            data: data,
            url: 'save-education',
            func: function (res) {
                $.util.alert(res.msg);
                if (res.id) {
                    $(em.parentNode).attr('data-id', res.id);
                }
            }
        });



        //form.submit();
    }

</script>
