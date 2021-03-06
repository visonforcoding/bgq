<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Export component
 */
class ExportComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * 导出csv
     * @param type $columnArr
     * @param type $data
     * @param type $filename 
     * @param type $name Description
     */
    public function exportCsv($columnArr, $data, $filename, $debug = false) {
        if (!$debug) {
//        header( 'Content-Type: text/csv' );
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
        }
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可  
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器  
        $fp = fopen('php://output', 'w');
        // 输出Excel列名信息  
        $head = $columnArr;
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码  
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }
        // 将数据通过fputcsv写到文件句柄  
        fputcsv($fp, $head);
        // 计数器  
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小  
        $limit = 100000;
        // 逐行取出数据，不浪费内存  
        foreach ($data as $key => $value) {
            $cnt ++;
            if ($limit == $cnt) {
                //刷新一下输出buffer，防止由于数据过多造成问题  
                ob_flush();
                flush();
                $cnt = 0;
            }
            foreach ($value as $i => $v) {
                $value[$i] = iconv('utf-8', 'gbk//ignore', $v);
            }
            fputcsv($fp, $value);
        }
        fclose($fp);
        exit();
    }

    public function phpexcelExport($filename, array $header, array $data) {
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator("柠檬智慧科技")
                ->setDescription("柠檬智慧科技生成.");
        $A = 'A';
        foreach ($header as $value) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($A . '1', $value);
            //$objPHPExcel->getActiveSheet(0)->getColumnDimension($A)->setAutoSize(true);
            $A++;
        }
        unset($A);
        $A = 'A';
        $i = 2;
        foreach ($data as $value) {
            foreach ($value as $k => $v) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($A . $i, $v);
                $A++;
            }
            $A = 'A';
            $i++;
        }
        
        $objPHPExcel->setActiveSheetIndex(0);
//    $objPHPExcel->getActiveSheet()->setTitle('Simple');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        // Write file to the browser
        $objWriter->save('php://output');
        exit();
    }
    
    
    /**
     * 导出图片，特别写的，不适用全部情况
     * @param type $filename
     * @param array $header
     * @param array $data
     */
    public function phpexcelExportWithImg($filename, array $header, array $data) {
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator("柠檬智慧科技")
                ->setDescription("柠檬智慧科技生成.");
        $A = 'A';
        foreach ($header as $value) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($A . '1', $value);
            //$objPHPExcel->getActiveSheet(0)->getColumnDimension($A)->setAutoSize(true);
            $A++;
        }
        unset($A);
        $A = 'A';
        $i = 2;
        foreach ($data as $value) {
            foreach ($value as $k => $v) {
                if($k == 'card_path' && $v){
                    if(file_exists(WWW_ROOT . $v)) {
                        $objDrawing = new \PHPExcel_Worksheet_Drawing();
                        $objDrawing->setResizeProportional(false);
                        $objDrawing->setWidthAndHeight(100, 100);
                        $objDrawing->setPath(WWW_ROOT . $v);
                        $objDrawing->setCoordinates($A . $i);
                        $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));
                        $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($i)->setRowHeight(100);
                        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($A)->setWidth(30);
                    } else {
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue($A . $i, $v);
                    }
                } else {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue($A . $i, $v);
                }
                $A++;
            }
            $A = 'A';
            $i++;
        }
        
        $objPHPExcel->setActiveSheetIndex(0);
//    $objPHPExcel->getActiveSheet()->setTitle('Simple');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        // Write file to the browser
        $objWriter->save('php://output');
        exit();
    }

}
