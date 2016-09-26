<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<?php $this->end() ?> 
<div class="row">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-list-ul"></i> 数据统计
            <div class="panel-actions pull-right">
                <button role="button" class="btn btn-mini close-panel" data-toggle="dropdown"><span class="caret"></span></button>
            </div>
        </div>
        <div id="intChart" class="chart-bar row" style="margin:10px;">
            <div class="input-group date  col-md-3" data-link-field="dtp_input1">
                <input class="form-control form-date datepicker" id="choice_date" value="<?= date('Y-m-d') ?>"  data-date="" type="text"  readonly>
                <span class="input-group-addon"><span class="icon-calendar"></span></span>
                <span class="input-group-addon">按</span>
                <select id="choice-time-type" class="form-control" >
                    <option value="year" selected="selected">年</option>
                    <option value="month" >月</option>
                    <option value="week">周</option>
                </select>
            </div>
        </div>
        <div class="panel-body">
            <div id="register_chart" style="width:100%;height:400px;" >

            </div>
        </div>
    </div>
</div>
<?php $this->start('script'); ?>
<script src="/wpadmin/lib/echart/echarts.js"></script>
<script src="/wpadmin/lib/jqgrid/js/jquery.jqGrid.min.js"></script>
<script src="/wpadmin/lib/jqgrid/js/i18n/grid.locale-cn.js"></script>
<script>
        $(function () {
                    var ptag_chart = echarts.init(document.getElementById('register_chart'));
                    // 使用刚指定的配置项和数据显示图表。
                    var date = $('#choice_date').val();
                    var url = '/admin/pvchart/get-tag-chart/<?=$ptag?>';
                    var type = $('#choice-time-type').val();
                    initLineChart(url + '?date=' + date + '&type=' + type, ptag_chart);
                    $('.chart-column-btn').click(function () {
                        $('.chart-column-btn').removeClass('btn-primary');
                        $(this).addClass('btn-primary');
                        $('#choice_date').trigger('change');
                    });
                    $('#choice_date,#choice-time-type').change(function () {
                        var date = $('#choice_date').val();
                        var url = '/admin/pvchart/get-tag-chart/<?=$ptag?>';
                        var type = $('#choice-time-type').val();
                        url = url + '?date=' + date + '&type=' + type;
                        initLineChart(url, ptag_chart);
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
