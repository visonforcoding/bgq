<?php $this->start('static') ?>   
<link href="/wpadmin/css/index.css" rel="stylesheet">
<script src="/wpadmin/js/Chart.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/wpadmin/js/chart-config.js" type="text/javascript" charset="utf-8"></script>
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
                            <span class="databox-number themesecondary"><?=$savantCounts?></span>
                            <div class="databox-text darkgray">待处理</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themethirdcolor ht">
                            小秘书          
                        </div>
                        <div class="databox-right">
                            <span class="databox-number cosecondar"><?=$needCounts?></span>
                            <div class="databox-text darkgray">待处理</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themeprimary ht">
                            提现        
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
                            会员          
                        </div>
                        <div class="databox-right">
                            <span class="databox-number cosecond"><?=$newUserCounts?></span>
                            <div class="databox-text darkgray">今日新增</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
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
                            <span class="databox-number themesecondary"><?=$newsCounts?></span>
                            <div class="databox-text darkgray">今日新增</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themethirdcolor ht">
                            活动          
                        </div>
                        <div class="databox-right">
                            <span class="databox-number cosecondar">90</span>
                            <div class="databox-text darkgray"><?=$activityCounts?></div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="">more</i>
                            </div>
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
        <div class="panel col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="panel-heading">
                用户消费分析
                <div class="panel-actions pull-right">
                    <button role="button" class="btn btn-mini close-panel" data-toggle="dropdown"><span class="caret"></span></button>
                </div>
            </div>
            <div class="panel-body">
                <div class="datacontainer">
                    <canvas id="myChart" height='170px' width='400px'></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="datacontainer">
                <div class="databox-left" style='width:600px;height:220px;'><canvas id="mycanvas" height='220px' width='500px'></canvas></div>




            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var data = [
        {
            value: 30,
            color: "#F7464A"
        },
        {
            value: 50,
            color: "#E2EAE9"
        },
        {
            value: 100,
            color: "#a0d468"
        },
        {
            value: 40,
            color: "#2dc3e8"
        },
        {
            value: 120,
            color: "skyblue"
        },
        {
            value: 120,
            color: "skygreen"
        }
    ];
    window.onload = function () {
        var ctx = document.getElementById("myChart").getContext("2d");
        $.getJSON('/admin/index/get-user-industry-proportion', function (res) {
            console.log(res);
            new Chart(ctx, {
                type: 'pie',
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