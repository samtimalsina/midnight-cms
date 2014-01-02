<?php
function scanDirOnly($path) {
	$sortedData = array();
	foreach(scandir($path) as $file) {
		if(is_file($path.$file) || $file === '.' || $file === '..') {
			continue;
		}
		else{
			array_unshift($sortedData, $file);
		}
	}
	return $sortedData;
}

function scanFileOnly($path) {
	$sortedData = array();
	foreach(scandir($path) as $file) {
		if(is_file($path . $file)) {
			array_unshift($sortedData, $file);
		} else {
			continue;
		}
	}
	return $sortedData;
}

function scanAll($path) {
	$sortedData = array();
	foreach(scandir($path) as $file) {
		if($file != '.' && $file != '..') {
			array_unshift($sortedData, $file);
		}
		else if(is_file($path.$file) && $file != '.' && $file != '..'){
			array_unshift($sortedData, $file);
		}
	}
	return $sortedData;
}

if(isset($_POST['dir'])){
	$mimeTypeExt=array(
					   "app"=>array("exe"),
					   "audio"=>array("mp3"),
					   "font"=>array("fon"),
					   "image"=>array("jpg","jpeg","gif","png","tiff"),
					   "zip"=>array("zip"),
					   "html"=>array("htm","html"),
					   "txt"=>array("txt"),
					   "script"=>array("php","js","xml","css","htaccess"),
					   "doc"=>array("rtf","doc","docx"),
					   "ppt"=>array("ppt","pptx"),
					   "xls"=>array("xls","xlsx"));
	$files=scanAll($_POST['dir']);
	$jason=array();
	for($i=0; $i<count($files); $i++){
		if (strpos($files[$i], ".")==false){
			array_push($jason, array("filename"=>$files[$i], "type"=>"folder", "extension"=>"FOLDER", "PATH"=>$_POST['dir'].$files[$i]."/"));
		}
		else{
			foreach($mimeTypeExt as $key=>$value){
				for($j=0; $j<count($mimeTypeExt[$key]); $j++){				
					if(substr(strrchr($files[$i],'.'),1)==$mimeTypeExt[$key][$j]){
						if($mimeTypeExt[$key]=="image"){
							list($width, $height, $type, $attr) = getimagesize("img/flag.jpg");	
						}
						array_push($jason, array("filename"=>$files[$i], "type"=>$key, "extension"=>$mimeTypeExt[$key][$j]." FILE", "PATH"=>$_POST['dir']."/"));
					}
				}
			}
		}
	}
	echo '{"files":'.json_encode($jason).'}';
}
?>