<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * service data for chart.js
 * Chart component
 */
class EchartComponent extends Component {

    protected $colors = ['#69D2E7', '#A7DBDB', '#E0E4CC', '#F38630', '#FA6900', '#E94C6F', '#542733', '#5A6A62', '#C6D5CD'
        , '#FDF200', '#DB3340', '#E8B71A', '#F7EAC8', '#1FDA9A', '#28ABE3', '#588C73', '#DFE0DB', '#FF66CC', '#000000', '#F7F960'];
    protected $days = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14'
        , '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
    protected $week = ['周一', '周二', '周三', '周四', '周五', '周六', '周日'];
    protected $month = ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    /**
     * 
     * @param array $data   数据
     * @param type $type   统计时间类型
     * @param type $name   线名称 
     * @param type $title  统计图标题
     * @param type $yAxis  y轴单位
     * @return type
     */
    public function setLineChart(array $data,$type,$name,$title,$yAxis) {
        $intdata = [];
        $output = [];
        if($type=='month'){
            for ($i = 0; $i < 31; $i++) {
                $intdata[$i] = 0;
            }
            $output['xAxis']['data'] = $this->days;
        }
        if($type=='year'){
            for ($i = 0; $i < 12; $i++) {
                $intdata[$i] = 0;
            }
            $output['xAxis']['data'] = $this->month;
        }
        if($type=='week'){
            for ($i = 0; $i < 7; $i++) {
                $intdata[$i] = 0;
            }
            $output['xAxis']['data'] = $this->week;
        }
        foreach ($intdata as $k => $v) {
            foreach ($data as $key => $value) {
                if($type=='week'){
                    if ($k == $value['time_item']) {
                        $intdata[$k] = $value['nums'];
                    }
                }else{
                    if ($k+1 == $value['time_item']) {
                        $intdata[$k] = $value['nums'];
                    }
                }
            }
        }
        $series = [
            'name' => $name,
            'type' => 'line',
            'data' => $intdata,
            'markPoint' => [
                'data' => [
                    ['type' => 'max', 'name' => '最大值'],
                    ['type' => 'min', 'name' => '最小值'],
                ]]
        ];
        $output['title']['text'] = $title['text'];
        $output['legend']['data'] = [$name];
        $output['series'] = [$series];
        $output['yAxis'] = $yAxis;
        return json_encode($output);
    }
    
    /**
     * 
     * @param array $data
     * @param type $type
     * @param type $name
     * @param type $title
     * @param type $yAxis
     * @return type
     */
    public function setPieChart(array $data,$name,$title) {
        $output = [];
        $series = [];
        $legend = [];
        foreach($data as $item){
            $series[] = [
                'value'=>  intval($item['nums']),
                'name'=>$item['name']
            ];
            $legend[] = $item['name'];
        }
        $output['title']['text'] = $title['text'];
        $output['series']['name'] = $name;
        $output['series']['data'] = $series;
        $output['legend']['data'] = $legend;
        return json_encode($output);
    }

}
