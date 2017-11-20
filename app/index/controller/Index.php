<?php
namespace app\index\controller;
use app\common\controller\Index as commonIndex;
use app\index\model\Sku;
use app\index\model\Skumix;
// use think\Loader;

use think\Config;
use think\Env;
use think\Db;
use PHPExcel_IOFactory;
use PHPExcel;
class Index
{
    public function __construct()
    {
        config('before', 'beforeAction');
    }


    public function getSkuList()
    {
        $res = Sku::all(function($query){
            $query->order("barcode DESC");
                
        });
        $result = [];
        foreach($res as $val)
        {
            $result[] = $val->toArray();
        }
        return json($result);
    }
    

    public function addSku()
    {
        $skuModel = new Sku;

        /*处理图片上传*/
        require_once("D:/Users/zhangxy/Documents/Learning/www/Apache24/htdocs/mixmatch-tp5/app/index/util/upload.class.php");
        require_once("D:/Users/zhangxy/Documents/Learning/www/Apache24/htdocs/mixmatch-tp5/app/index/util/util.php");

        $photo = "../public/upload/NoImage.jpg"; 
        if ($_FILES['photo']['name'] != ''){
            /*--  实例化上传类  --*/
            $file = $_FILES['photo'];
            $upload_path = '../public/upload';
            $allow_type = array('jpg','bmp','png','gif','jpeg');
            // $max_size=2048000;
            $max_size=5120000;
            $upload = new \upFiles($file, $upload_path, $max_size, $allow_type);

            $upload->upload();

            $pic = $upload->getSaveFileInfo();
            // $photo = substr($pic['path'], 2)."/".$pic['savename']; 
            $photo = "../../../mixmatch-tp5".substr($pic['path'], 2)."/".$pic['savename']; 
            // $photo = $pic['path']."/".$pic['savename']; 
        }

        $skuModel->skuName = $_POST['skuName'];
        $skuModel->skuType = $_POST['skuType'];
        $skuModel->skuLink = $_POST['skuLink'];
        $skuModel->skuStatus = $_POST['skuStatus'];
        $skuModel->channel = $_POST['channel'];
        $skuModel->brand = $_POST['brand'];
        $skuModel->size = $_POST['size'];
        $skuModel->price = $_POST['price'];
        $skuModel->purchaseDate = $_POST['purchaseDate'];
        $skuModel->archiveDate = $_POST['archiveDate'];
        $skuModel->photo = $photo;
        $skuModel->allowField(true)->save();
        // dump($skuModel->barcode);
        if($skuModel->barcode) {
            $result = (object) [
                'result' => [],
                'code'=> '200',
                'resultMassage'=> '保存sku成功',
                "success"=>true
            ];
        } else {
             $result = (object) [
                'result' => [],
                'code'=> '500',
                'resultMassage'=> '失败',
                "success"=>false
            ];
        }
        return json($result);

    }


    public function updateSku() 
    {
        $barcode = $_POST['barcode'];

        $skuModel = Sku::get($barcode);

        /*处理图片上传*/
        require_once("D:/Users/zhangxy/Documents/Learning/www/Apache24/htdocs/mixmatch-tp5/app/index/util/upload.class.php");
        require_once("D:/Users/zhangxy/Documents/Learning/www/Apache24/htdocs/mixmatch-tp5/app/index/util/util.php");

        $photo = "../public/upload/NoImage.jpg"; 
        if (isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
            /*--  实例化上传类  --*/
            $file = $_FILES['photo'];
            $upload_path = '../public/upload';
            $allow_type = array('jpg','bmp','png','gif','jpeg');
            // $max_size=2048000;
            $max_size=5120000;
            $upload = new \upFiles($file, $upload_path, $max_size, $allow_type);

            $upload->upload();

            $pic = $upload->getSaveFileInfo();
            // $photo = substr($pic['path'], 2)."/".$pic['savename']; 
            $photo = "../../../mixmatch-tp5".substr($pic['path'], 2)."/".$pic['savename']; 
            // $photo = $pic['path']."/".$pic['savename']; 

            $skuModel->photo = $photo;
        }

        $skuModel->skuName = $_POST['skuName'];
        $skuModel->skuType = $_POST['skuType'];
        $skuModel->skuLink = isset($_POST['skuLink']) && $_POST['skuLink'];
        $skuModel->skuStatus = $_POST['skuStatus'];
        $skuModel->channel = $_POST['channel'];
        $skuModel->brand = $_POST['brand'];
        $skuModel->size = $_POST['size'];
        $skuModel->price = $_POST['price'];
        $skuModel->purchaseDate = $_POST['purchaseDate'];
        $skuModel->archiveDate = $_POST['archiveDate'];
        $skuModel->allowField(true)->save();
        // dump($skuModel->barcode);
        if($skuModel->barcode) {
            $result = (object) [
                'result' => [],
                'code'=> '200',
                'resultMassage'=> '更新sku成功'.$barcode,
                "success"=>true
            ];
        } else {
             $result = (object) [
                'result' => [],
                'code'=> '500',
                'resultMassage'=> '失败',
                "success"=>false
            ];
        }
        return json($result);
    }


    public function deleteSku()
    {
        $barcode = $_POST['barcode'];
        $res = Sku::destroy($barcode);//主键
        if($res) {
            $result = (object) [
                'result' => [],
                'code'=> '200',
                'resultMassage'=> '删除sku成功'.$barcode,
                "success"=>true
            ];
        } else {
             $result = (object) [
                'result' => [],
                'code'=> '500',
                'resultMassage'=> '失败',
                "success"=>false
            ];
        }
        return json($result);
    }


    public function getSkuMixList()
    {
        $res = Skumix::all(function($query){
            $query->order("id DESC");
                
        });
        $result = [];
        foreach($res as $val)
        {
            $result[] = $val->toArray();
        }
        return json($result);
    }


    public function modelTest()
    {

        // ┏━━━━┓
        // ┃查询数据┃
        // ┗━━━━┛
        //1.// use app\index\model\Sku; 推荐
        // $res = Sku::get(1);
        // $res = $res->toArray();
        // dump($res);

        //2.// use app\index\model\Sku;
        // $sku = new Sku();
        // $res = $sku::get(2);
        // $res = $res->toArray();
        // dump($res);

        //3.use think\Loader;
        // $sku = Loader::model("Sku");
        // $res = $sku::get(2);
        // $res = $res->toArray();
        // dump($res);

        //4.助手函数不推荐
        // $sku = model('Sku');
        // $res = $sku::get(1);
        // $res = $res->toArray();
        // dump($res);

        // $res = Sku::get(1);
        // // dump($res->skuName);
        // $res = $res->toArray();
        // dump($res);

        // $res = Sku::get(function($query){
        //     $query->where("barcode", "eq", "1")
        //         ->field("barcode, skuName");
        // });
        // dump($res->toArray());

        // $res = Sku::where("barcode", 3)
        //     ->field("barcode, skuName")
        //     ->find();
        // dump($res->toArray());

        // $res = Sku::all();
        // $res = Sku::all("1,2,3");
        // $res = Sku::all([1,2,3]);
        // $res = Sku::all(function($query){
        //     $query->where("barcode", "<>", 2)
        //         ->field("barcode, skuName");
        // });
        // $res = Sku::where("barcode", ">=", 1)
        //             ->field("barcode, skuName, skuStatus")
        //             ->limit(3)
        //             ->order("skuStatus DESC")
        //             ->select();
        // foreach($res as $val)
        // {
        //     dump($val->toArray());
        // }

        // $res = Sku::where("barcode", 1)->value('skuName');
        // dump($res);

        // $res = Sku::column("skuStatus","skuName");
        // dump($res);

        // ┏━━━━┓
        // ┃添加数据┃
        // ┗━━━━┛
        // $res = Sku::create([
        //     'skuName' => '测试',
        //     'skuType' => 1,
        //     'skuStatus' => 1,
        //     'price' => 12.3,
        //     'channel' => '测试渠道',
        //     'brand' => '测试品牌',
        //     'size' => '73/44',
        //     'purchaseDate' => '2017-10-11',
        //     'photo' => './upload/2013/07/test.gif',
        //     'demo' => '133'
        // ], true);

        // $res = Sku::create([
        //     'skuName' => '测试',
        //     'skuType' => 1,
        //     'skuStatus' => 1,
        //     'price' => 12.3,
        //     'channel' => '测试渠道',
        //     'brand' => '测试品牌',
        //     'size' => '73/44',
        //     'purchaseDate' => '2017-10-11',
        //     'photo' => './upload/2013/07/test.gif',
        //     'demo' => '133'
        // ], ['skuName', 'skuType']);//允许插入的字段名
        // dump($res->barcode);


        // $skuModel = new Sku;
        // $skuModel->skuName = '123';
        // $skuModel->skuType = 1;
        // $skuModel->save();
        // dump($skuModel->barcode);


        // $skuModel = new Sku;
        // $res = $skuModel->allowField(true)->save([
        //     'skuName' => 'imocc',
        //     'skuType' => 2,
        //     'demo' => '13'
        // ]);
        // dump($res);//插入数据的行数

        // $skuModel = new Sku;
        // $res = $skuModel->saveAll([
        //     'skuName' => '我的'
        // ],[
        //     'skuName' => '你的'
        // ]); //无效啊？？


        // $res = Sku::all();
        // foreach($res as $val)
        // {
        //     dump($val->toArray());
        // }

        // ┏━━━━┓
        // ┃更新数据┃
        // ┗━━━━┛
        // $res = Sku::update([
        //     'barcode' => 1,
        //     'skuName' => '测试啦啦啦啦'
        // ]);
        // dump($res);

        // $res = Sku::update([
        //     'skuName' => 'hello'
        // ],['barcode'=>2]);
        // dump($res);

        // $res = Sku::update([
        //     'skuName' => 'woshi'
        // ], function($query){
        //     $query->where("barcode", 'LT', 5);
        // });
        // dump($res);

        //建议 使用 返回被更新数据的行数
        // $res = Sku::where("barcode", "<", 6)
        //         ->update([
        //             'skuName' => 'hll'
        //         ]);
        // dump($res);


        // $skuModel = Sku::get(1);
        // $skuModel->skuName = '123';
        // $res = $skuModel->save();
        // dump($res);

        // $skuModel = new Sku;
        // $res = $skuModel->save([
        //         'skuName' => '333'
        //     ], ['barcode'=>5]);


        // ┏━━━━┓
        // ┃删除数据┃
        // ┗━━━━┛
        // $db = Db::name('sku');
        // $res = $db->where([
        //     'barcode' => 1
        //     ])->delete();
        // dump($res);


        // $db = Db::name('sku');
        // $res = $db->delete(2); //主键
        // dump($res);

        // $db = Db::name('sku');
        // $res = $db->where("1=1")->delete(); //删除所有记录 ，不要使用
        // dump($res);


        // $res = Sku::destroy(18);//主键
        // dump($res);

        // $res = Sku::destroy(function($query){
        //     $query->where("barcode", "<", 5);
        // });
        // dump($res);


        // $skuModel = Sku::get(9);
        // $res = $skuModel->delete();
        // dump($res);

        // $res = Sku::where("barcode", 5)
        //         ->delete();
        // dump($res);

        // $res = Sku::where("barcode", "<", 10)
        // ->delete();
        // dump($res);        

        // $res = Sku::where("1=1")
        // ->delete();
        // dump($res);





    }
    public function mixmatch()
    {
        echo 'mixmatch';
        $db = Db::name('sku');
        $res = $db->where([
                'skuType'=> 4
            ])->select();
        dump($res);
    }
    public function index()
    {
        // return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
        // return "this is index index index";
        // $common = new commonIndex();
    	// return $common->index();
        dump(config());
        // $conf1 = [
        //     'username'  => 'wuyunlong'
        // ];
        // $conf2 = [
        //     'username'  => 'along'
        // ];
        // dump(array_merge($conf1, $conf2));

        // $res = \think\Config::get();
        // $res = Config::get();
        // dump($res);

        // Config::set('username', 'along', 'index');
        // dump(Config::get('username', 'index'));

        // dump(config('?username'));

        // dump($_ENV);
        // $res = Env::get('email');
        // $res = Env::get('email2', 'default_value');
        // $res = Env::get('database_hostname', 'default_value');
        // $res = Env::get('database.hostname', 'default_value');
        // dump($res);
    }
    public function common(){
    	$common = new commonIndex();
    	return $common->index();
    }

     public function info($id)
    {
        //http://127.0.0.1:8099/myfunds/public/index/index/info/id/5
        //http://127.0.0.1:8099/myfunds/public/news/5.html
        echo url('index/index/index', ['id' => 10]) ."<br>";
        echo url('index/index/info', ['id' => 10]) ."<br>";
        return "{$id}";
    }

    public function demo()
    {
        dump(config());
        //1
        // $res = Db::connect();//惰性加载，使用时才连接
        //2
        // $res = Db::connect([
        //     // 数据库类型
        //     'type'            => 'mysql',
        //     // 服务器地址
        //     'hostname'        => '127.0.0.1',
        //     // 数据库名
        //     'database'        => '',
        //     // 用户名
        //     'username'        => 'root',
        //     // 密码
        //     'password'        => '',
        //     // 端口
        //     'hostport'        => '',
        //     // 连接dsn
        //     'dsn'             => '',
        //     // 数据库连接参数
        //     'params'          => [],
        //     // 数据库编码默认采用utf8
        //     'charset'         => 'utf8',
        //     // 数据库表前缀
        //     'prefix'          => '',
        // ]);
        //3
        // $res = Db::connect("mysql://root:123456@127.0.0.1:3306/course#utf8");//惰性加载，使用时才连接
        //4
        // $res = Db::connect('db_config_imooc');//惰性加载，使用时才连接

        //5
        // $res = Db::connect(Config::get('db_config_imooc'));//Config::get返回数组


        // dump(config('database'));

        // $res = Db::query("select * from imooc_user where id=?", [1]);
        // $res = Db::execute("insert into imooc_user set username=?,password=?,email=?",[
        //     'imooc',
        //     md5('imooc'),
        //     'imooc@qq.com'
        //     ]);
        // $res = Db::table('imooc_user')->where([
        //         'id' => '1'
        //     ])->select();

        //select 所有记录，二维数组 结果不存在 空数组
        // $res = Db::table('imooc_user')->select();

        //column 一维数组,数组中的value值就是我们要获取的列的值 结果不存在 空数组
        //第二个参数作为key
        // $res = Db::table('imooc_user')->column('email', 'username');


        //find 一维数组 id正序排列 一条记录 结果不存在 null
        // $res = Db::table('imooc_user')->where([
        //         'id' => '10'
        //     ])->find();

        //value 一条记录 结果不存在 null
        // $res = Db::table('imooc_user')->where([
        //         'id' => '10'
        //     ])->value('username');

        // $res = Db::name('user')->select();
        // $res = db('user',[],false)->select();//db助手函数，不要实例化 Db类是单例模式 

        $this->printExcel();
        $db = Db::name('transfer');
        //insert返回影响记录的行数 插入数
        // $db->insert([
        //     'email' => 'imooc_03@qq.com',
        //     'password' => md5('imooc_03'),
        //     'username' => 'imooc_03'
        // ]);

        //insertGetId 返回插入数据的自增id
        
        //insertAll 返回插入数据成功的行数
        // $data = [];
        // for($i=0; $i<10; $i++) {
        //     $data[] = [
        //         'email' => "imooc_03_{$i}@qq.com",
        //         'password' => md5("imooc_{$i}"),
        //         'username' => "imooc_{$i}"
        //     ];
        // }
        // $db->insertAll($data);


        $res = $db -> select();
        dump($res);
    }

    public function readExcel($page = 0){
        $path = dirname(__FILE__); //找到当前脚本所在路径
        // dump($path);
        error_reporting(E_ALL);  
        // date_default_timezone_set('Asia/ShangHai');  
        // include_once('Classes/PHPExcel/IOFactory.php');//包含类文件  
          
        $filename = $path.'\myMoney.xls';
        if (!file_exists($filename)) {  
        exit("not found.\n");  
        }  
          
        $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        if($ext == 'xlsx'){
            $reader=PHPExcel_IOFactory::createReader('Excel2007');
            $PHPExcel = $reader->load($filename,'utf-8');
        }elseif($ext == 'xls'){
            $reader=PHPExcel_IOFactory::createReader('Excel5');
            $PHPExcel = $reader->load($filename,'utf-8');
        }

        $sheet = $PHPExcel->getSheet($page); // 读取第一個工作表  
        $highestRow = $sheet->getHighestRow(); // 取得总行数  
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数  

        $excelData = array();
        for ($row =1; $row <= $highestRow; $row++){//行数是以第1行开始  

            for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始  
                    $excelData[$row][$column] = $sheet->getCell($column.$row)->getValue();
                
            }
        }  
        $res['excelData'] = $excelData;
        $res['highestRow'] = $highestRow;
        $res['highestColumm'] = $highestColumm;
        return $res;
    }

    public function  printExcel()
    {
        $res = $this->readExcel(1);
        // dump($exceldata);

        /** 循环读取每个单元格的数据 */  
        echo "<table border=1>";  
        for ($row =1; $row <= $res['highestRow']; $row++){//行数是以第1行开始  
            echo "<tr>";  
            echo "<td>".$row."</td>";  
            for ($column = 'A'; $column <= $res['highestColumm']; $column++) {//列数是以A列开始  
                
                    echo "<td>".$res['excelData'][$row][$column]."</td>";  
            }
            echo "</tr>";  
        }  
        echo "</table>"; 
    }

    public function  saveToDb($page=0)
    {
        $res = $this->readExcel($page);
        // dump($res);

        // $this->printExcel();


        switch ($page)
            {
            case 0:
              $curTable = 'expense';
              break;
            case 1:
              $curTable = 'income';
              break;
            case 4:
              $curTable = 'transfer';
              break;
            default:
              echo "No table";
            }

        $db = Db::name($curTable);
        $rowData = array();
        $key = [
            'A' => 'transactionType',
            'J' => 'date',
            'B' => 'category',
            'C' => 'subCategory',
            'D' => 'accountOut',
            'E' => 'accountIn',
            'I' => 'project',
            'G' => 'member',
            'H' => 'merchant',
            'F' => 'sum',
            'K' => 'notes',
        ];
        /** 循环读取每个单元格的数据 */  
        for ($row =1; $row <= $res['highestRow']; $row++){//行数是以第1行开始  
            $rowData[$row]['id'] = $row;
            for ($column = 'A'; $column <= $res['highestColumm']; $column++) {//列数是以A列开始  
                    $columnName = $key[$column];
                    $rowData[$row][$columnName] = $res['excelData'][$row][$column];
            }
        }  

        $res = $db->insertAll($rowData);


        $data = $db -> select();
        dump($data);
    }

    public function initialAllData(){
        //source D:\Users\zhangxy\Documents\Learning\www\Apache24\htdocs\myfunds\myfunds_db.sql

        // $this->saveToDb(0);//支出
        // $this->saveToDb(1);//收入
        // $this->saveToDb(4);//转账
    }


    public function queryData(){
       
        //1
        // $sql = $db->where([
        //         'id' => 1
        // ])->buildSql();

        //2
        // $sql = $db->where("id=1")->buildSql();

        //3
        // $sql = $db->where("id", 1)->buildSql();

        //4 条件表达式 不区分大小写
        //EQ =
        //NEQ <>
        //LT <
        //ELT <=
        //GT >
        //EGT >=
        //BETWEEN BETWEEN * AND *
        //NOTBETWEEN NOTBETWEEN * AND *
        //IN IN(*,*)
        //NOTIN NOT IN(*,*)
        // $sql = $db->where("id", "EGT", 1)->buildSql();
        // $sql = $db->where("id", "notbetween", "1,5")->buildSql();
        // $sql = $db->where("id", "notbetween", [1,10])->buildSql();
        // $sql = $db->where("id", "in", [1,10,20])->buildSql();


        //5
        // $sql = $db->where([
        //         'id' => ['EGT', 1],
        //         'username' => ['IN', [1,2,3,4,5]]
        // ])->buildSql();

        //6
        // $sql = $db->where("id", "EXP", "not in (1,2,3)")->buildSql();

        //7
        // $sql = $db
        // ->where("id", "in", "1,2,3")
        // ->where("username", "eq", "my")
        // ->buildSql();

        //8
        // $sql = $db
        // ->where("id", "in", "1,2,3")
        // ->whereOr("username", "eq", "my")
        // ->buildSql();

        // dump($sql);

        // $db = Db::name('transfer');
        // $res = Db::table('myfunds_transfer')
        // ->where([
        //     'accountOut' => '❤️财通可持续组合'
        //     ])
        // ->whereOr('accountIn', 'EQ', '❤️财通可持续组合')
        // ->select();

       

    }

    public function buyinSum()
    {
        $db = Db::name('transfer');
        $accountsIn = Db::table('myfunds_transfer')
        ->order("id DESC")
        ->column('sum', 'accountIn');
        $buyin = [];
        foreach($accountsIn as $key => $accountIn) {
            $buyin[$key] = Db::table('myfunds_transfer')
            ->where([
                'accountIn' => $key
                ])
            ->sum('sum');
        }
        // dump($buyin);

        header('Content-type: text/json;charset=utf-8');
        $result['result'] = $buyin;
        $result['code'] = '200';
        $result['resultMassage'] = 'buyinSum查询成功';
        $result['success'] = true;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }
    public function selloutSum()
    {
        $db = Db::name('transfer');
        $accountsOut = Db::table('myfunds_transfer')
        ->order("id DESC")
        ->column('sum', 'accountOut');
        $sellout = [];
        foreach($accountsOut as $key => $accountOut) {
            $sellout[$key] = Db::table('myfunds_transfer')
            ->where([
                'accountOut' => $key
                ])
            ->sum('sum');
        }
        // dump($sellout);

        header('Content-type: text/json;charset=utf-8');
        $result['result'] = $sellout;
        $result['code'] = '200';
        $result['resultMassage'] = 'selloutSum查询成功';
        $result['success'] = true;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }
    public function minusSum()
    {
        $db = Db::name('expense');
        $accountsOut = Db::table('myfunds_expense')
        ->order("id DESC")
        ->column('sum', 'accountOut');
        $minus = [];
        foreach($accountsOut as $key => $accountOut) {
            $minus[$key] = Db::table('myfunds_expense')
            ->where([
                'accountOut' => $key
                ])
            ->sum('sum');
        }
        // dump($minus);

        header('Content-type: text/json;charset=utf-8');
        $result['result'] = $minus;
        $result['code'] = '200';
        $result['resultMassage'] = 'minusSum查询成功';
        $result['success'] = true;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }
    public function plusSum()
    {
        $db = Db::name('income');
        $accountsOut = Db::table('myfunds_income')
        ->order("id DESC")
        ->column('sum', 'accountOut');
        $plus = [];
        foreach($accountsOut as $key => $accountOut) {
            $plus[$key] = Db::table('myfunds_income')
            ->where([
                'accountOut' => $key
                ])
            ->sum('sum');
        }
        // dump($plus);

        header('Content-type: text/json;charset=utf-8');
        $result['result'] = $plus;
        $result['code'] = '200';
        $result['resultMassage'] = 'plusSum查询成功';
        $result['success'] = true;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }

}