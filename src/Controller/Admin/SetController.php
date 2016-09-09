<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;
use Cake\Filesystem\File;
/**
 * Index Controller
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\EchartComponent $Echart       
 */
class SetController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $conf = \Cake\Cache\Cache::read('zhy','redis');
        if(!$conf){
            $conf = file_get_contents(ROOT.'/config/zhy');
            $conf = unserialize($conf);
        }
        if ($this->request->isAjax()) {
            $data = $this->request->data();
            $conf = [
                'bgmj' => [],
                'bggw' => [],
                'cytz' => [],
                'bgrz' => [],
            ];
            if ($data) {
                foreach ($data as $key => $value) {
                    foreach ($conf as $k => $v) {
                        if ($key == $k) {
                            foreach ($value as $m => $n) {
                                if ($n['name'] == 'agency_id[]') {
                                    $conf[$k]['agency'][] = $n['value'];
                                }
                                if ($n['name'] == 'industries[_ids][]') {
                                    $conf[$k]['industry'][] = $n['value'];
                                }
                            }
                        }
                    }
                }
            }
            $res = \Cake\Cache\Cache::write('zhy', $conf, 'redis');
            $file = new File(ROOT.'/config/zhy', true, 0644);
            $file->create();
            $file->write(serialize($conf));
            $file->close();
            if($res){
                $this->Util->ajaxReturn(true,'修改成功');
            }else{
                $this->Util->ajaxReturn(true,'修改失败');
            }
        }
        $this->set([
            'conf'=>$conf
        ]);
    }

}
