<div class="row">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-list-ul"></i> 数据统计
            <div class="panel-actions pull-right">
                <button role="button" class="btn btn-mini close-panel" data-toggle="dropdown"><span class="caret"></span></button>
            </div>
        </div>
        <div id="intChart" class="chart-bar row" style="margin:10px;">
            <div class="col-md-4">
                <input type="hidden" id="chart-column" value="order" />
                <button data-val="praise" class="btn btn-primary  chart-column-btn"><i class="icon icon-user red"></i> 会员认证</button>
                <button data-val="subject" class="btn  chart-column-btn"><i class="icon icon-usecase red"></i> 会员话题</button>
                <button data-val="meet" class="btn  chart-column-btn"><i class="icon icon-coffee red"></i> 会员约见</button>
            </div>
            <div class="input-group date   col-md-2 " style="float: left;margin-left:-120px;margin-right:10px;"  data-link-field="dtp_input1">
                <input class="form-control form-date datepicker" id="choice_date" value="<?= date('Y-m-d') ?>"  data-date="" type="text"  readonly>
                <span class="input-group-addon"><span class="icon-calendar"></span></span>
            </div>
            <div class="input-group col-md-1">
                <span class="input-group-addon">按</span>
                <select id="choice-time-type" class="form-control" >
                    <option value="year" selected="selected">年</option>
                    <option value="month" >月</option>
                    <option value="week">周</option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div id="line_chart" style="width:100%;height:400px;" >

            </div>
        </div>
    </div>
</div>
<div class="row" hidden="true">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-list-ul"></i> 数据统计
            <div class="panel-actions pull-right">
                <button role="button" class="btn btn-mini close-panel" data-toggle="dropdown"><span class="caret"></span></button>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <div id="industry_chart" style="width:100%;height:400px;" >

                </div>
            </div>
            <div class="col-md-6">
                <div id="level_chart" style="width:100%;height:400px;" >

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->start('script'); ?>
<script src="/wpadmin/lib/echart/echarts.js"></script>
<script>
    $(function () {
        var line_chart = echarts.init(document.getElementById('line_chart'));
        var industry_chart = echarts.init(document.getElementById('industry_chart'));
        var level_chart = echarts.init(document.getElementById('level_chart'));
        // 使用刚指定的配置项和数据显示图表。
        var date = $('#choice_date').val();
        var url = '/admin/savant-chart/getAuthChart';
        var type = $('#choice-time-type').val();
        initLineChart(url + '?date=' + date + '&type=' + type, line_chart);
        $.get('/admin/user-chart/getIndustryPieChart', function (data) {
            industry_chart.setOption({
                title: {
                    text: data.title.text,
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: data.legend.data
                },
                series: [
                    {
                        name: data.series.name,
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '60%'],
                        data:data.series.data,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            });
        }, 'json');
        $.get('/admin/user-chart/getLevelPieChart', function (data) {
            level_chart.setOption({
                title: {
                    text: data.title.text,
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: data.legend.data
                },
                series: [
                    {
                        name: data.series.name,
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '60%'],
                        data:data.series.data,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            });
        }, 'json');

        $('.chart-column-btn').click(function () {
            $('.chart-column-btn').removeClass('btn-primary');
            $(this).addClass('btn-primary');
            $('#choice_date').trigger('change');
        });
        $('#choice_date,#choice-time-type').change(function () {
            var date = $('#choice_date').val();
            var column = $('.chart-column-btn.btn-primary').data('val');
            var url = '/admin/savant-chart/getAuthChart';
            if (column == 'auth') {
                url = '/admin/savant-chart/getAuthChart';
            }
            if (column == 'subject') {
                url = '/admin/savant-chart/getSubjectChart';
            }
            if (column == 'meet') {
                url = '/admin/savant-chart/getMeetChart';
            }
            var type = $('#choice-time-type').val();
            url = url + '?date=' + date + '&type=' + type;
            initLineChart(url, line_chart);
        });
    });
    function initLineChart(url, chartObj) {
        $.get(url, function (data) {
            chartObj.setOption({
                title: {
                    text: data.title.text,
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: data.legend.data
                },
                toolbox: {
                    show: true,
                    feature: {
                        dataZoom: {
                            yAxisIndex: 'none'
                        },
                        dataView: {readOnly: false},
                        magicType: {type: ['line', 'bar']},
                        restore: {},
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: data.xAxis.data
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}' + data.yAxis
                    }
                },
                series: data.series
            });
        }, 'json');
        chartObj.clear(); //清除缓存，防止下次获取而 面板未刷新
    }
</script>
<?php
$this->end('script');
