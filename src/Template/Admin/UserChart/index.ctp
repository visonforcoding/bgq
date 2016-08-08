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
                <button data-val="order" class="btn btn-primary  chart-column-btn"><i class="icon icon-book"></i> 订单数</button>
                <button data-val="income" class="btn  chart-column-btn"><i class="icon icon-yen red"></i> 营业额</button>
                <button data-val="member" class="btn  chart-column-btn"><i class="icon icon-yen red"></i> 会员数</button>
            </div>
            <div class="input-group date   col-md-2 " style="float: left;margin-left:-120px;margin-right:10px;"  data-link-field="dtp_input1">
                <input class="form-control form-date datepicker" id="choice_date"  data-date="" type="text"  readonly>
                <span class="input-group-addon"><span class="icon-calendar"></span></span>
            </div>
            <div class="input-group col-md-1">
                <span class="input-group-addon">按</span>
                <select id="choice-time-type" class="form-control" >
                    <option value="year">年</option>
                    <option value="month">月</option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div id="chart" style="width:100%;height:400px;" >

            </div>
        </div>
    </div>
</div>
<?php $this->start('script'); ?>
<script src="/wpadmin/lib/echart/echarts.js"></script>
<script>
    $(function(){
          var myChart = echarts.init(document.getElementById('chart'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    });
</script>
<?php $this->end('script');