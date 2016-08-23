<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * service data for chart.js
 * Chart component
 */
class ChartComponent extends Component {

    protected $colors = ['#69D2E7', '#A7DBDB', '#E0E4CC', '#F38630', '#FA6900', '#E94C6F', '#542733', '#5A6A62', '#C6D5CD'
        , '#FDF200', '#DB3340', '#E8B71A', '#F7EAC8', '#1FDA9A', '#28ABE3', '#588C73', '#DFE0DB', '#FF66CC', '#000000', '#F7F960'];
    protected $days = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14'
        , '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
    protected $lineCap = ['butt', 'round', 'square'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * 
     * @param array $data
     */
    public function setPieChart(array $data, array $labels) {
        $colors = [];
        $colorsConfig = $this->colors;
        foreach ($data as $key => $item) {
            $colors[] = $colorsConfig[$key];
        }
        $datasets = ['data' => $data, 'backgroundColor' => $colors];
        $output['data']['datasets'] = [$datasets];
        $output['data']['labels'] = $labels;
        return json_encode($output);
    }

    
    /**
     * 
     * @param array $data
     * @param type $label
     * @param type $option
     * @return type
     */
    public function setLineChartByDayWithMonth(array $data, $label, $option = []) {
        $fill = isset($option['fill']) ? $option['fill'] : true;
        $backgroundColor = isset($option['backgroundColor']) ? $this->colors[$option['backgroundColor']] : $this->colors[0];
        $pointRadius = isset($option['pointRadius']) ? $option['pointRadius'] : 1;
        $borderCapStyle = isset($option['borderCapStyle']) ? $option['borderCapStyle'] : $this->lineCap[0];
        $intdata = [];
        for ($i = 0; $i < 31; $i++) {
            $intdata[$i] = 0;
        }
        foreach ($intdata as $k => $v) {
            foreach ($data as $key => $value) {
                if ($k + 1 == $value['day']) {
                    $intdata[$k] = $value['nums'];
                }
            }
        }
        $datasets = [
            'data' => $intdata,
            'label' => $label,
            'backgroundColor' => $backgroundColor,
            'fill' => $fill,
            'pointRadius' => $pointRadius,
            'borderCapStyle' => $borderCapStyle
        ];
        $output['data']['labels'] = $this->days;
        $output['data']['datasets'] = [$datasets];
        return json_encode($output);
    }

}
