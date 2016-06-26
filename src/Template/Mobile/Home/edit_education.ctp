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
<div class="m-wraper edit-education-bottom wraper">

    <div class="education-items">
        <div class="education-title">
            <h3>
                教育经历<i>2</i></span>
                <a href="javascript:void(0);" class="deletbtn">删除</a>
            </h3>
        </div>
        <ul class="h-info-box e-info-box">
            <li  class="no-right-ico">
                <span>学校：</span>
                <div><input type="text" placeholder="北京大学" /></div>
            </li>
            <li  class="no-right-ico">
                <span>院系/专业：</span>
                <div>
                    <input type="text" placeholder="金融系" />
                </div>
            </li>
            <li class="no-right-ico">
                <span>学历：</span>
                <div>
                    <select name="" class="education">
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
                    <input type="text" placeholder="2004-7-1" class="checktime" readonly="readonly" />
                </div>
            </li>
            <li class="no-b-border">
                <span>结束日期：</span>
                <div>
                    <input type="text" placeholder="2004-7-1" readonly="readonly" class="checktime"/>
                </div>
            </li>

        </ul>
    </div>
    <div class="add-subject nobottom">
        <span>添加教育经历</span>
    </div>
    <a href="javascript:void(0);" class="nextstep">完成</a>
</div>
<div class='reg-shadow'  style="display: none;"></div>
<script src="/mobile/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/mobiscroll.2.13.2.js" type="text/javascript" charset="utf-8"></script>
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
//性别选择
    $('.checkedsex').mobiscroll().select({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) {
            return "请选择性别";
        },
    });
</script>