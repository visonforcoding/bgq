<?php $this->start('static') ?>   
<link href="/wpadmin/css/index.css" rel="stylesheet">
<script src="/wpadmin/js/Chart.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/wpadmin/js/chart-config.js" type="text/javascript" charset="utf-8"></script>
<style>
    .a-link{
        display:block;
    }
    .a-link:hover{
        text-decoration:none;
    }
</style>
<?php $this->end() ?>     
<div class="cbody">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themesecondary ht">
                            专家认证          
                        </div>
                        <div class="databox-right">
                            <a class="a-link" href="/admin/savant/index">
                                <span class="databox-number themesecondary"><?= $savantCounts ?></span>
                                <div class="databox-text darkgray">待处理</div>
                                <div class="databox-stat themesecondary radius-bordered">
                                    <i class="">more</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themethirdcolor ht">
                            小秘书          
                        </div>
                        <div class="databox-right">
                            <a class="a-link" href="/admin/need/index">
                                <span class="databox-number cosecondar"><?= $needCounts ?></span>
                                <div class="databox-text darkgray">待处理</div>
                                <div class="databox-stat themesecondary radius-bordered">
                                    <i class="">more</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themeprimary ht">
                            提现        
                        </div>
                        <div class="databox-right">
                            <a class="a-link" href="/admin/withdraw/index">
                                <span class="databox-number coseconda">90</span>
                                <div class="databox-text darkgray">今日新增</div>
                                <div class="databox-stat themesecondary radius-bordered">
                                    <i class="">more</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-palegreen ht">
                            会员          
                        </div>
                        <div class="databox-right">
                            <a class="a-link" href="/admin/user/index">
                                <span class="databox-number cosecond"><?= $userCounts ?></span>
                                <div class="databox-text darkgray">会员总数</div>
                                <div class="databox-stat themesecondary radius-bordered">
                                    <i class="">more</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themesecondary ht">
                            资讯          
                        </div>
                        <div class="databox-right">
                            <a class="a-link" href="/admin/news/index">
                                <span class="databox-number themesecondary"><?= $newsTotalCounts ?></span>
                                <div class="databox-text darkgray">资讯总数</div>
                                <div class="databox-stat themesecondary radius-bordered">
                                    <i class="">more</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themethirdcolor ht">
                            活动          
                        </div>
                        <div class="databox-right">
                            <a class="a-link" href="/admin/activity/index">
                                <span class="databox-number cosecondar"><?= $activityCounts ?></span>
                                <div class="databox-text darkgray">活动总数</div>
                                <div class="databox-stat themesecondary radius-bordered">
                                    <i class="">more</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themeprimary ht">
                            报名        
                        </div>
                        <div class="databox-right">
                            <span class="databox-number coseconda">90</span>
                            <div class="databox-text darkgray">今日新增</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-palegreen ht">
                            约见          
                        </div>
                        <div class="databox-right">
                            <span class="databox-number cosecond">90</span>
                            <div class="databox-text darkgray">今日新增</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="datacontainer">
                    <ul id="myTab" class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">注册数</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">Tab2</a>
                        </li>
                        <li class="dropdown">
                            <a href="#tab3" data-toggle="tab">Tab2</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane in active" id="tab1">
                            <canvas id="new-user-chart" height='170px' width='400px'></canvas>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <p>星火燎原我热情的眼眸</p>
                            <p>曾点亮最灿烂的天空</p>
                            <p>晴天霹雳你绝情的放手</p>
                            <p>在我最需要你的时候</p>
                            <p>于是爱恨交错人消瘦</p>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <p>怕是怕这些苦没来由</p>
                            <p>于是悲欢起落人静默</p>
                            <p>等一等这些伤会自由</p>
                            <p>于是爱恨交错人消瘦</p>
                            <p>怕是怕这些苦没来由</p>
                            <p>于是悲欢起落人静默</p>
                            <p>等一等这些伤会自由</p>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <p>口是心非你矫情的面容</p>
                            <p>都烙印在心灵的角落</p>
                            <p>无话可说我纵情的结果</p>
                            <p>就像残破光秃的山头</p>
                            <p>浑然天成我纯情的悸动</p>
                            <p>曾奔放最滚烫的节奏</p>
                            <p>不可收拾你滥情的抛空</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class="panel col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="panel-body">
                <canvas id="myChart" height='170px' width='400px'></canvas>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload = function () {
        var ctx = document.getElementById("myChart").getContext("2d");
        $.getJSON('/admin/index/get-user-industry-proportion', function (res) {
            console.log(res);
            new Chart(ctx, {
                type: 'pie',
                data: res.data
            });
        }, 'json');
        var newUserChart = document.getElementById('new-user-chart').getContext('2d');
        $.getJSON('/admin/index/getNewUserByDayWithMonth', function (res) {
            console.log(res);
            new Chart(newUserChart, {
                type: 'line',
                data: res.data
            });
        }, 'json');

        //var ct = document.getElementById("mycanvas").getContext("2d");
        //new Chart(ct).Bar(datas);
//				initEvent(chartBar, clickCall);
    }
    var datas = {
        labels: ["一月", "二月", "三月", "四月", "五月", "六月", "七月"],
        datasets: [
            {
                fillColor: "#2dc3e8",
                strokeColor: "#2dc3e8 ",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                fillColor: "rgba(230,72,109,1)",
                strokeColor: "rgba(230,72,109,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    }
</script>