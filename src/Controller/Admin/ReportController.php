<?php

/**
* Encoding     :   UTF-8
* Created on   :   2016-7-20 17:08:55 by caowenpeng , caowenpeng1990@126.com
*/

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Index Controller
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\ChartComponent $Chart       
 */
class ReportController extends AppController {
    
    public function logger(){
        echo 'success';
        exit();
    }
    
}