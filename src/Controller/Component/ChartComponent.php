<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * service data for chart.js
 * Chart component
 */
class ChartComponent extends Component {

    
    protected $colors = ['#69D2E7','#A7DBDB','#E0E4CC','#F38630','#FA6900','#E94C6F','#542733','#5A6A62','#C6D5CD'
        ,'#FDF200','#DB3340','#E8B71A','#F7EAC8','#1FDA9A','#28ABE3','#588C73','#DFE0DB','#FF66CC','#000000','#F7F960'];
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
    public function setPieChart(array $data,array $labels){
        $colors = [];
        $colorsConfig = $this->colors;
        foreach ($data as $key=>$item){
            $colors[] = $colorsConfig[$key];
        }
        $datasets = ['data'=>$data,'backgroundColor'=>$colors];
        $output['data']['datasets'] = [$datasets];
        $output['data']['labels'] = $labels;
        return json_encode($output);
    }

}
