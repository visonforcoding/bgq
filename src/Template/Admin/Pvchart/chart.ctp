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
        <div class="panel-body">
            <div class="col-md-3">
                <div id="industry_chart" style="width:100%;height:400px;" >

                </div>
            </div>
            <div class="col-md-3">
                <div id="level_chart" style="width:100%;height:400px;" >

                </div>
            </div>
            <div class="col-md-6">
                <div id="level_chart2" style="width:100%;height:400px;" >

                </div>
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
        var industry_chart = echarts.init(document.getElementById('industry_chart'));
        var level_chart = echarts.init(document.getElementById('level_chart'));
        var level_chart2 = echarts.init(document.getElementById('level_chart2'));
        // 使用刚指定的配置项和数据显示图表。
        $.get('/admin/pvchart/getPieChart1', function (data) {
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
                        data: data.series.data,
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
        $.get('/admin/pvchart/getPieChart2', function (data) {
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
                        data: data.series.data,
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
        $.get('/admin/pvchart/getPieChart3', function (data) {
            level_chart2.setOption({
                title: {
                    text: data.title.text,
                    x: 'right'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: data.legend.data,
                    show:false
                },
                series: [
                    {
                        name: data.series.name,
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '60%'],
                        data: data.series.data,
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
    });
</script>
<?php
$this->end('script');
