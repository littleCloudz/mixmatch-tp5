<?php
namespace app\api\controller;
use PHPExcel_IOFactory;
use PHPExcel;
class Excel
{

	public function index()
    {
     
        dump(config());
        
    }

	public function  test()
	{
		$path = dirname(__FILE__); //找到当前脚本所在路径
		dump($path);

		$PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
		$PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
		$PHPSheet->setTitle('demo'); //给当前活动sheet设置名称
		$PHPSheet->setCellValue('A1','姓名')->setCellValue('B1','分数');//给当前活动sheet填充数据，数据填充是按顺序一行一行填充的，假如想给A1留空，可以直接setCellValue('A1',');
		$PHPSheet->setCellValue('A2','张三')->setCellValue('B2','50');
		$PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel,'Excel2007');//按照指定格式生成Excel文件，'Excel2007'表示生成2007版本的xlsx，
		$PHPWriter->save($path.'/demo.xlsx'); //表示在$path路径下面生成demo.xlsx文件
		
	}
	public function  read()
	{
		$path = dirname(__FILE__); //找到当前脚本所在路径
		dump($path);
		error_reporting(E_ALL);  
		// date_default_timezone_set('Asia/ShangHai');  
		// include_once('Classes/PHPExcel/IOFactory.php');//包含类文件  
		  
		$filename = $path.'\myMoney.xls';
		if (!file_exists($filename)) {  
		exit("not found.\n");  
		}  
		  
		// $reader = PHPExcel_IOFactory::createReader('Excel2007'); //设置以Excel5格式(Excel97-2003工作簿)  
		// $PHPExcel = $reader->load($filename); // 载入excel文件  
		$ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
		if($ext == 'xlsx'){
		    $reader=PHPExcel_IOFactory::createReader('Excel2007');
		    $PHPExcel = $reader->load($filename,'utf-8');
		}elseif($ext == 'xls'){
		    $reader=PHPExcel_IOFactory::createReader('Excel5');
		    $PHPExcel = $reader->load($filename,'utf-8');
		}

		$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表  
		$highestRow = $sheet->getHighestRow(); // 取得总行数  
		$highestColumm = $sheet->getHighestColumn(); // 取得总列数  
		  
		/** 循环读取每个单元格的数据 */  
		$dataset=array();  
		echo "<table border=1>";  
		for ($row =1; $row <= $highestRow; $row++){//行数是以第1行开始  
			echo "<tr>";  
			echo "<td>".$row."</td>";  

			for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始  
				
					echo "<td>".$sheet->getCell($column.$row)->getValue()."</td>";  
				
			}
			echo "</tr>";  
		}  
		echo "</table>"; 
	}

	public function  savetodb()
	{
		dump(config());
		// $db = Db::name('user');
        // $db->insert([
        //     'email' => 'imooc_03@qq.com',
        //     'password' => md5('imooc_03'),
        //     'username' => 'imooc_03'
        // ]);
        // $res = $db -> select();
        $res = Db::connect();
        dump($res);
		// $res = Db::connect()
		// $res = Db::table('expense')->select();

		// $db = Db::name('expense');
  // //       $db->insert([
  // //           'email' => 'imooc_03@qq.com',
  // //           'password' => md5('imooc_03'),
  // //           'username' => 'imooc_03'
  // //       ]);
  //       $res = $db -> select();
        // dump($res);
	}
}