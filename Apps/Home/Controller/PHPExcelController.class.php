<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/8
 * Time: 15:58
 */
namespace Home\Controller;
use Think\Controller;
class PHPExcelController extends Controller
{

//文件导入需要先把文件存储到Uploads文件夹中，因为浏览器无法获取文件的真实路径
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('xls', 'xlsx', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();

        if(!$info) {// 上传错误提示错误信息
             $this->ajaxReturn(array(status=>0,msg=>$upload->getError()));
        }else{// 上传成功
            $filepath = './Uploads/'.$info['excelFile']['savepath'].$info['excelFile']['savename'];
            if(file_exists($filepath)){
                //文件准备妥当，开始写入数据库
                self::importExcel($filepath);
            }else{
                $this->ajaxReturn(array(status=>1,msg=>'文件上传不存在',fliepath=>$filepath));
            }
            
        }
    }

    

    /**
    +----------------------------------------------------------
     * Import Excel | 2013.08.23
     * Author:HongPing <hongping626@qq.com>
    +----------------------------------------------------------
     * @param  $file   upload file $_FILES
    +----------------------------------------------------------
     * @return array   array("error","message")
    +----------------------------------------------------------
     */
    public function importExcel($file){
        if(!file_exists($file)){
            return array("error"=>0,'message'=>'file not found!');
        }
        vendor("PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.IOFactory");
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        try{
            $PHPExcel = $objReader->load($file);
        }catch(Exception $e){}
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表  
        $highestRow = $sheet->getHighestRow(); // 取得总行数  
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数  
        $data = array();
        $data['highestRow'] = $highestRow;
        $data['highestColumm'] = $highestColumm;
        for($j=1;$j<=$highestRow;$j++){
        //从A列读取数据
            $tepmK = 'A';
            for($k=0;$k<=3;$k++){
                // 读取单元格
                $data[$j][]=$PHPExcel->getActiveSheet()->getCell(($tepmK++).$j)->getValue();
            } 
        }  
        $data['dt']=$PHPExcel->getActiveSheet()->getCell("A1")->getValue();
        $this->ajaxReturn(array(status=>1,msg=>$data));


    }

    public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['loginAccount'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        import("Org.Excel.PHPExcel.IOFactory");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle);
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$j]);
            }
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    function impUser(){
        if(isset($_FILES["import"]) && ($_FILES["import"]["error"] == 0)){
            $result = $this->importExecl($_FILES["import"]["tmp_name"]);
            if($result["error"] == 1){
                $execl_data = $result["data"][0]["Content"];
                foreach($execl_data as $k=>$v){
//                    ..这里写你的业务代码..
                      }
             }
        }
    }
    function test(){
       $data['msg'] = "test success";
       $this->ajaxReturn($data);
    }

    
}