<?php
	function curPageURL() {
	 $pageURL = 'http';
	
	 $pageURL .= "://";
	 
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}

	function removeSpaces($str){
	  $newStr = trim($str);
	  return $newStr;
	}
	function cut($text){
		$ext="-";
		$spc=" ";
		$replace="";
		$replace = str_replace($spc, $ext, $text);
		return $replace;
	}
	function space($text){
		$ext="-";
		$spc=" ";
		$replace="";
		$replace = str_replace($ext, $spc, $text);		
		return $replace;
	}
	function slash($text){
		$ext="/";
		$spc="_";
		$replace="";
		$replace = str_replace($ext, $spc, $text);		
		return $replace;
	}
	function under($text){
		$ext="_";
		$spc="/";
		$replace="";
		$replace = str_replace($ext, $spc, $text);		
		return $replace;
	}
	function getParts($text, $type){
		if ($type==0){
			$parts = explode('.', $text);
			return $parts;
		}
		else if ($type==1){
			$parts = explode(',', $text);
			return $parts;
		}
	}
	
	function cartItems(){
		$cart = $_SESSION['cart'];
		if(!$cart){
			return "You have no items in your cart";
		}
		else{
			$item_count = count(explode(',',$cart['item_id']));
			return "You have $item_count items in your cart";
		}
	}
	
	function clean_xss_strip_tags($str)
	{
		$str=trim($str);
		$str=strip_tags($str);
		$str=htmlspecialchars($str, ENT_QUOTES);	
		return $str;
	}
	
	function add_column_if_not_exist($table, $column, $column_attr ){
		$query=mysql_query("SHOW COLUMNS FROM $table LIKE '$column'");
        if(mysql_num_rows($query)==0){
			mysql_query("ALTER TABLE $table ADD $column $column_attr") or die(mysql_error());
		}
    }	
	function make_condition($name){
		$name=strtolower($name);
	}	
	function limit_text($text, $limit){
		// figure out the total length of the string
		if( strlen($text)>$limit){
			# cut the text
			$text = substr( $text,0,$limit );
			$text=$text."...";
		}
		else{
			$text=$text;
		}
		// return the processed string
		return $text;
	}
	/* to count number of words */
	function count_words($str){
		$no = count(explode(" ",$str));
		return $no;
	}	
    /* to check email */
	function check_email($email){
	   if(@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
            return true;
       }
       else{
          return false;
       }
	}
    /* to check URL */    
    function validateURL($URL){ 
        $http_check = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        if((bool)preg_match($http_check, $URL) == true){
            return true;
        }
        else{
            $www_check = "/^(www|wap).([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
            return (bool)preg_match($www_check, $URL);
        }
    }
	function eyecandy($data){
		$candy_type="";    
		$word_count =  count_words($data);	
		if ($word_count==1){
			$candy_type="single";            
			$image_arr=array("jpg","jpeg","gif","png","JPG");
			for ($i=0; $i<count($image_arr); $i++){
				if (substr(strrchr($data,'.'),1)==$image_arr[$i]){
					$candy_type="image"; break;
				}
			}            
            $doc_arr=array("doc","pdf","ppt","docx");
            for ($i=0; $i<count($doc_arr); $i++){
                 if (substr(strrchr($data,'.'),1)==$doc_arr[$i]){
                    $candy_type="document"; break;
                 }
            }            
            if(check_email($data) == true){
                $candy_type="email";
            }            
            if(validateURL($data) == true){
                $candy_type="url";
            }
            if($data=="yes" || $data=="no"){
                $candy_type="yes_no";
            }
		}
		else{		  
            if(count_words($data) > 10){
                $candy_type = "long_text";
            }
		}
		return $candy_type;
	}
	function url_exists($url) {
		//$hdrs = @get_headers($url);
		//return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
		if (!$fp = curl_init($url)) return false;
    	return true;	
	}        
    function formValidation($keys){
        $error = "";
        $form_name = $keys['formname'];
        //echo $keys['menu_title'];
        $get_form_id = mysql_fetch_array(mysql_query("SELECT id FROM forms WHERE form_name='$form_name'"));
        $form_id = $get_form_id['id'];
        $compulsory_field = mysql_query("SELECT * FROM form_elements WHERE form_id='$form_id' AND compulsory='yes'");
        $compulsory_files = mysql_query("SELECT * FROM form_elements WHERE form_id='$form_id' AND compulsory='yes' AND type='file'");
		while($compulsory = mysql_fetch_array($compulsory_field)){
            if($compulsory['validation'] != 'image' && $keys[$compulsory['name']] == ""){
                echo $compulsory['validation'];  
                $error .= emptyMessage($compulsory['name']);
            }
            if($compulsory['validation'] == 'image'){
                if (isset($_POST['edit'])){
                    if($keys['file_check'] == "file_not_exists" && basename($_FILES[$compulsory['name']]['name'])==""){
                        $error .= emptyMessage($compulsory['name']);
                    }
                    else if(basename($_FILES[$compulsory['name']]['name']) != ""){
                        $error .= imageCheck(basename($_FILES[$compulsory['name']]['name']));
                    }
                }
                else{
                    $filename = basename($_FILES[$compulsory['name']]['name']);      
                    if($filename==""){
                       $error .= emptyMessage($compulsory['name']);
                    }else{
                        $error .= imageCheck($filename);
                    }
                }
            }            
            if($compulsory['validation'] == 'email' && $keys[$compulsory['name']] != ""){
                if(check_email($keys[$compulsory['name']])==false){
                    $error .= $compulsory['name'].",";
                }
            }            
            if($compulsory['validation']=='website' && $keys[$compulsory['name']] != ""){
                if(validateURL($keys[$compulsory['name']])==false){
                    $error .= $compulsory['name'].",";
                }
            }			
			if($compulsory['validation'] == 'text' && $keys[$compulsory['name']] != ""){
				break;
			}
        }        
        return $error;
    }    
    function emptyMessage($field){
        $msg = $field.",";
        return $msg;
    }    
    function imageCheck($image_name){
        $msg = "photo,";
        $image_arr=array("jpeg","JPG","gif","png","jpg");
        for ($i=0; $i<count($image_arr); $i++){
		  if (substr(strrchr($image_name,'.'),1)==$image_arr[$i]){
		      $msg = "";
		  }
	    }
        return $msg;        
    }
    function getPasswordSalt(){
        return substr( str_pad( dechex( mt_rand() ), 8, '0', STR_PAD_LEFT ), -8 );
    }
    function getPasswordHash( $salt, $password ){
        return $salt.(hash('whirlpool', $salt.$password));
    }
    function comparePassword( $password, $hash ){
        $salt = substr( $hash, 0, 8 );
        return $hash == getPasswordHash( $salt, $password );
    }
	function logLocation($ip){
		include('ip2locationlite.class.php');
		$ipLite = new ip2location_lite;
		$ipLite->setKey('da0de6e5f56b43759c6debdb090edb1053898455c23951d3c03fdd96b1ef80cc');
		$locations = $ipLite->getCity($ip);
		$errors = $ipLite->getError();
		if (!empty($locations) && is_array($locations)){
			$use_errors = libxml_use_internal_errors(true);
			$xml = simplexml_load_file(HOST_NAME."logs/iplog.xml");
			if (!$xml) {
				echo "<p class='error'>".date("H:i a (P)").": Cannot access the XML File</p>";
				$xml = simplexml_load_file("logs/iplog.xml");
				libxml_clear_errors();
				libxml_use_internal_errors($use_errors);
				return;
			}

			$sxe = new SimpleXMLElement($xml->asXML());
			$ip = $sxe->addChild("ips");
			$ip->addChild("date", date("M d, Y"));
			$ip->addChild("time", date("g:i a"));
			foreach ($locations as $field => $val){
				$ip->addChild($field, $val);
			}
			$sxe->asXML(HOST_NAME."logs/iplog.xml");
		}
	}
	
	function paginate(){
		include("paginator.class.php");
	}
    
    
    function getXMLValues($xml_file,$second,$third){
        $doc = new DOMDocument();
        $doc->load($xml_file);
        $tool_details = $doc->getElementsByTagName( $second ); 
        foreach($tool_details as $tool_detail){
            $tool_name = $tool_detail->getElementsByTagName( $third );
		    $value = $tool_name->item(0)->nodeValue;
            return $value;                 
        }  
      
    }
    


    function getXMLFunctions($xml_file,$function,$name){
        $doc = new DOMDocument();
        $doc->load($xml_file);  
        $get_function_name = array();

        $functions = $doc->getElementsByTagName( $function );
        
        foreach($functions as $function){
            $function_name = $function->getElementsByTagName( $name );
            
            foreach($function_name as $f_name){
                array_push($get_function_name, $f_name->textContent);
            } 
        }
        
        return($get_function_name);        
    }
    
    function deleteDir($installed_path) {
        $files = glob($installed_path . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($installed_path);
     }	 
	 	
	function isComplex($string){
		if(strpos($string, ".")) return true; else return false;
	}
?>