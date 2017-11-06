<?php
/**
* 文件上传类
* @author shuangyulin
* @author URL:www.shuangyulin.com
* @version 1.0
* @final 2013-02-04
*/
class upFiles
{
    /**
     * 上传的文件信息
     * @var array
     */
    public $uploadFiles = array();
    /**
     * 保存文件路径
     * @var string
     */
    public $saveFilePath;
    /**
     * 最大文件大小
     * @var int
     */
    public $maxFileSize;
    /**
     * 错误信息
     * @var string
     */
    public $lastError;
    /**
     * 默认充许上传的文件类型
     * @var array
     */
    public $allowType = array('gif','jpg','png','bmp');
    /**
     * 最终保存的文件名称
     * @var string
     */
    public $finalFile;
    /**
     * 返回已经上传文件的详细信息
     * @var array
     */
    public $saveFileInfo = array();
    /**
     * 构造函数,初始化相关信息,包括文件内容,上传地址,文件最大限制,文件类型
     * @param array $file
     * @param string $path
     * @param int $size
     * @param array $type
     */
    public function __construct($file, $path, $size, $type)
    {
        $this->uploadFiles     = $file;
        $this->saveFilePath = $path;
        $this->allowType = $type;
        $this->maxFileSize     = $size;
        
    }
    public function upload()
    {
    	if (is_array($this->uploadFiles['name']))
    	{
	        for($i=0;$i<count($this->uploadFiles['name']);$i++)
	        {
	            //如果文件上传没有出现错误
	            if($this->uploadFiles['error'][$i] == 0)
	            {
	                //获取当前文件名,临时文件名,文件大小,扩展名
	                $name             = $this->uploadFiles['name'][$i];
	                $tmpname     = $this->uploadFiles['tmp_name'][$i];
	                $size             = $this->uploadFiles['size'][$i];
	                $minetype     = $this->uploadFiles['type'][$i];
	                $type             = $this->getFileExt($this->uploadFiles['name'][$i]);
	                //检查文件大小是否合法
	                if(!$this->checkSize($size))
	                {
	                    $this->lastError = "文件大小超出限制.文件名称:".$name;
	                    $this->printMsg($this->lastError);
	                    continue;
	                }
	                
	                //检查文件扩展名是否合法
	                if(!$this->checkType($type))
	                {
	                    $this->lastError = "非法的文件类型.文件名称:".$name;
	                    $this->printMsg($this->lastError);
	                    continue;
	                }
	                
	                //检测当前文件是否非法提交
	                if(!is_uploaded_file($tmpname))
	                {
	                    $this->lastError = "上传文件无效.文件名称:".$name;
	                    $this->printMsg($this->lastError);
	                    continue;
	                }
	                
	               
	                 
	                //移动后的文件名称
	                $basename = $this->getBaseName($name,'.'.$type);
	                
	               
	                //上传文件重新命名
	                list($usec, $sec) = explode(" ",microtime());
	             
	             
	                $savename = substr($usec,2).'.'.$type;
	                //创建上传文件的文件夹
	                createdir($this->saveFilePath);
	                
	                $dir1 = $this->saveFilePath.'/'.date('Y');
	                createdir($dir1);
	                $dir2 = $this->saveFilePath.'/'.date('Y').'/'.date('m');
	                $thumb_dir = $dir2.'/thumb';
	                $cover_dir = $dir2."/cover";
	                createdir($dir2);
	                createdir($thumb_dir);
	                createdir($cover_dir);
	                //最终组合的文件路径
	                $this->finalFile = $dir2.'/'.$savename;
	                //把上传的文件从临时目录移到目标目录
	                echo $tmpname;
	                if(!move_uploaded_file($tmpname,$this->finalFile))
	                {
	                    $this->$this->uploadFiles['error'][$i];
	                    $this->printMsg($this->lastError);
	                    continue;
	                }
	                //存储已经上传的文件信息
	                $tembasename = $this->getBaseName($savename,'.'.$type);
	                $FileInfo = array(
	                    'name'            => $name,
	                    'type'            => $type,
	                    'minetype'        => $minetype,
	                    'file'			  => $this->finalFile,
	                    'size'                => $size,
	                    'basename'		=>$tembasename,
	                    'savename'    => $savename,
	                    'path'            => $dir2,
	                    'thumb_dir'     =>$thumb_dir."/",
	                    'cover_dir'     =>$cover_dir."/"
	                );
	                $this->saveFileInfo[] = $FileInfo;
	            }
            }
        }
        else 
        {
        	 if($this->uploadFiles['error'] == 0)
	            {
	                //获取当前文件名,临时文件名,文件大小,扩展名
	                $name             = $this->uploadFiles['name'];
	                $tmpname     = $this->uploadFiles['tmp_name'];
	                $size             = $this->uploadFiles['size'];
	                $minetype     = $this->uploadFiles['type'];
	                $type             = $this->getFileExt($this->uploadFiles['name']);
	                //检查文件大小是否合法
	                if(!$this->checkSize($size))
	                {
	                    $this->lastError = "文件大小超出限制.文件名称:".$name;
	                    $this->printMsg($this->lastError);
	                    continue;
	                }
	                //检查文件扩展名是否合法
	                if(!$this->checkType($type))
	                {
	                    $this->lastError = "非法的文件类型.文件名称:".$name;
	                    $this->printMsg($this->lastError);
	                    continue;
	                }
	                //检测当前文件是否非法提交
	                if(!is_uploaded_file($tmpname))
	                {
	                    $this->lastError = "上传文件无效.文件名称:".$name;
	                    $this->printMsg($this->lastError);
	                    continue;
	                }
	                //移动后的文件名称
	                $basename = $this->getBaseName($name,'.'.$type);
	                //上传文件重新命名
	                list($usec, $sec) = explode(" ",microtime());
	                $savename = substr($usec,2).'.'.$type;
	                //创建上传文件的文件夹
	                
	                createdir($this->saveFilePath);
	                $dir1 = $this->saveFilePath.'/'.date('Y');
	                createdir($dir1);
	                $dir2 = $this->saveFilePath.'/'.date('Y').'/'.date('m');
	                $thumb_dir = $dir2.'/thumb';
	                $cover_dir = $dir2."/cover";
	                createdir($dir2);
	                createdir($thumb_dir);
	                createdir($cover_dir);

	                //最终组合的文件路径
	                // $this->finalFile = $dir2.'/'.$savename;
	                $this->finalFile = $dir2.'/'.$savename;
	             
	                //把上传的文件从临时目录移到目标目录
	                if(!move_uploaded_file($tmpname,$this->finalFile))
	                {
	                    // $this->$this->uploadFiles['error'];
	                    $this->uploadFiles['error'];
	                    
	                    $this->printMsg($this->lastError);
	                    continue;

	                }
	                //存储已经上传的文件信息
	                $tembasename = $this->getBaseName($savename,'.'.$type);
	                $this->saveFileInfo = array(
	                    'name'            => $name,
	                    'type'            => $type,
	                    'minetype'        => $minetype,
	                    'file'			  => $this->finalFile,
	                    'size'                => $size,
	                    'basename'		=>$tembasename,
	                    'savename'    => $savename,
	                    'path'            => $dir2,
	                    'thumb_dir'     =>$thumb_dir."/",
	                    'cover_dir'     =>$cover_dir."/"
	                );
	            }
	          else {
	          }
        }
        //返回上传的文件数量
        return count($this->saveFileInfo);
    }
    /**
     * 取出已上传文件信息,以便进行其它操作
     *
     * @return array
     */
    public function getSaveFileInfo()
    {
        return $this->saveFileInfo;
    }
    /**
     * 检查上传文件大小是否合法
     *
     * @param int $size
     * @return boolean
     */
    private function checkSize($size)
    {
        return ($size > $this->maxFileSize) ? false : true;
    }
    /**
     * 检查文件类型是否合法
     *
     * @param string $etype
     * @return boolean
     */
    private function checkType($etype)
    {
        foreach($this->allowType as $type)
        {
            if(strcasecmp($etype,$type) == 0) return true;
        }
        return false;
    }
    /**
     * 打印信息
     *
     * @param string $msg
     */
    private function printMsg($msg)
    {
        return $msg;
    }
    /**
     * 获取文件的扩展名
     *
     * @param string $filename
     * @return string
     */
    private function getFileExt($filename)
    {
        $ext = pathinfo($filename);
        return $ext['extension'];
    }
    /**
     * 获取文件名
     *
     * @param string $filename
     * @param string $type
     * @return string
     */
    private function getBaseName($filename,$type)
    {
        $basename = basename($filename,$type);
        return $basename;
    }
}
?>