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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themeprimary ht">
                            提现        
                        </div>
                        <div class="databox-right">
                            <a class="a-link" href="/admin/withdraw/index">
                                <span class="databox-number coseconda"><?=$withdrawCounts?></span>
                                <div class="databox-text darkgray">今日新增</div>
                                <div class="databox-stat themesecondary radius-bordered">
                                    <i class="">more</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
<!--                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
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
                           活动报名        
                        </div>
                        <div class="databox-right">
                            <span class="databox-number coseconda"><?=$activityApplyCounts?></span>
                            <div class="databox-text darkgray">总数</div>
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
                            <span class="databox-number cosecond"><?=$subjectbookCounts?></span>
                            <div class="databox-text darkgray">总数</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="datacontainer">
                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">用户注册数</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">活动报名数</a>
                    </li>
                    <li class="dropdown">
                        <a href="#tab3" data-toggle="tab">专家约见数</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active" id="tab1">
                        <canvas id="new-user-chart" height='170px' width='400px'></canvas>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <canvas id="activity-apply-chart" height='170px' width='400px'></canvas>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <canvas id="meet-chart" height='170px' width='400px'></canvas>
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
            new Chart(ctx, {
                type: 'pie',
                data: res.data
            });
        }, 'json');
        var newUserChart = document.getElementById('new-user-chart').getContext('2d');
        $.getJSON('/admin/index/getNewUserByDayWithMonth', function (res) {
            new Chart(newUserChart, {
                type: 'line',
                data: res.data
            });
        }, 'json');
        var activityApplyChart = document.getElementById('activity-apply-chart').getContext('2d');
        $.getJSON('/admin/index/getActivityApplyByDayWithMonth', function (res) {
            new Chart(activityApplyChart, {
                type: 'line',
                data: res.data
            });
        }, 'json');
        var meetChart = document.getElementById('meet-chart').getContext('2d');
        $.getJSON('/admin/index/getMeetByDayWithMonth', function (res) {
            new Chart(meetChart, {
                type: 'bar',
                data: res.data
            });
        }, 'json');
    }
</script>