<?php 
/**
 * 建立文件目录
 *
 * @access      public
 * @param       string      dir       文件目录
 * @return      TRUE/FLASE
 */
function createdir($dir) {
	
	if (!is_dir($dir)) {
		$temp = explode('/',$dir);
		$cur_dir = '';
		
		for($i=0;$i<count($temp);$i++) {
			$cur_dir .= $temp[$i].'/';
			if (!is_dir($cur_dir)) {
				@mkdir($cur_dir,0777);
				@fopen("$cur_dir/index.htm","a");
			}
		}
	}
}
?>