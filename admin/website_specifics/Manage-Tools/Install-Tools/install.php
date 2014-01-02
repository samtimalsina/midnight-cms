<?php

/**
 * @author qualia
 * @copyright 2011
 */

 function checkPlugin($xml_tag, $file_name){
    $zip = zip_open($file_name); 
    
    do {
        $entry = zip_read($zip);
    } while ($entry && zip_entry_name($entry) != "install.xml"); 
    if($entry==""){
        $version = "invalid";
    }
    else{
        zip_entry_open($zip, $entry, "r");
        $entry_content = zip_entry_read($entry, zip_entry_filesize($entry));
        
        if(!strpos($entry_content, "<".$xml_tag.">") && !strpos($entry_content, "</".$xml_tag.">")){
            //echo "Error while installing the plugin.<br>";
//            echo $xml_tag. " is missing in xml file.";
            $version = "invalid";
        }
        else{
            
            
            $version_open_pos = strpos($entry_content, "<".$xml_tag.">");
            
            $version_close_pos = strpos($entry_content, "</".$xml_tag.">", $version_open_pos);
            
            $version = substr(
                $entry_content,
                $version_open_pos + strlen("<".$xml_tag.">"),
                $version_close_pos - ($version_open_pos + strlen("<".$xml_tag.">"))
            );
                        
            
        }
        
        zip_entry_close($entry);
        zip_close($zip);
    }
    
    return($version);

 }
 
// function nodeCheck($tag_name, $file_name){
//    $dom = new DOMDocument(); 
//    $dom->load( $file_name ); 
//
//    $errorNodes = $dom->getElementsByTagName($tag_name); 
//
//    if($errorNodes->length == 0){
//        message('no error nodes'); // user defined
//    }
// }
 
 function XMLCheck($zip_file){
    if(checkPlugin('tool_name',$zip_file) != "invalid"){
        $tool_name = checkPlugin('tool_name',$zip_file);
        $tool_logo = checkPlugin('tool_logo',$zip_file);
        $tool_info = checkPlugin('tool_info',$zip_file);
        $tool_type = checkPlugin('tool_type',$zip_file);
        $tool_rights = checkPlugin('rights',$zip_file);
        
        //$tool_version = checkPlugin('version',$zip_file);
        //$tool_version = checkPlugin('rights',$zip_file);
        
        //echo nodeCheck('tool_name', $zip_file);
        
        
        //echo $tool_name;
        //exit;
        //class="span-18 last prepend-top"
        if($tool_name == ""){
            echo "<p class='span-18 error last'>There was an error while installing the plugin. Please Check your xml file and try installing again.</p>";
            //return("There was an error while installing the plugin. Please Check your xml file and try installing again.");
            exit;
        }
        if($tool_logo == ""){
            $tool_logo = "";
        }
        if($tool_rights == "all"){
            $tool_right = "yes";
        }else{
            $tool_right = "no";
        }
        
        
        //if($tool_version == ""){
//            $tool_version="1.0";
//        }
        
        checkWidget($tool_name);
        
        $installed_path = "website_specifics/".cut($tool_name);
        
        mkdir($installed_path);
        
        $zip = new ZipArchive;
        $zip->open($zip_file);
        $zip->extractTo($installed_path."/");
        $zip->close();
        
        unlink($zip_file);
        
        $new_xml_file = $installed_path."/install.xml";
        
        if($tool_type != "tools"){ 
            if($tool_type != "specific"){
                installationFail($installed_path);
            }
        }
        
        if($tool_type == "tools"){
            $table_name = "admingeneraltool_tbl";
        }
        if($tool_type == "specific"){
            $table_name = "adminspecific_tbl";
        }
        
        if(!file_exists($installed_path."/index.php")){
            installationFail($installed_path);
        }
        
        $function_check = getXMLValues($new_xml_file,"function","function_name");
        
        if($function_check == ""){
            addInstallWidgetDB($tool_name, $tool_info, $tool_logo, $tool_type, $tool_right, $table_name);
        }
        else{
            $function_name = getXMLFunctions($new_xml_file,"function","function_name");
            
            $i = 0;
            foreach($function_name as $f_name){
                if(!file_exists($installed_path."/".cut($f_name)."/index.php")){
                    installationFail($installed_path);
                }    
            }
            
            addInstallWidgetDB($tool_name, $tool_info, $tool_logo, $tool_type, $tool_right, $table_name);
        }     
    }
    else{
        echo "<p class='span-18 error last'>There was an error while installing the plugin. Please Check your xml file and try installing again.</p>";
        unlink($zip_file);
       //return("There was an error while installing the plugin. Please Check your xml file and try installing again.");
        exit;
    }
 }
 
 function checkWidget($tool_name){
    $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(name) FROM widgets WHERE name='$tool_name'"));
    if( $tbl_check[0] == 1 || file_exists("website_specifics/".cut($tool_name))){
        pluginAlreadyExists();
    }  
 }
 
 function pluginAlreadyExists(){
    echo "<p class='span-18 error last'>The tool you tried to installed has been already installed before.</p>";
    //return("The tool you tried to installed has been already installed before.");   
    exit;
 }
 
 function installationFail($installed_path){
    echo "<p class='span-18 error last'>There was error while installing the plugin.</p>";   
    deleteDir($installed_path."/");
    //return("There was error while installing the plugin.");
    exit;
 }
 
 
 function addInstallWidgetDB($widget_name, $description, $tool_logo, $tool_type, $tool_right, $table_name){
    mysql_query("INSERT INTO widgets VALUES ('','$widget_name', '$description', '$tool_logo', '$tool_type', 'installed')") or die ("error->".mysql_error());
    
    $getUsername = mysql_query("SELECT * FROM `login_table`");

    while($row=mysql_fetch_array($getUsername)){
        $usernames = $row['username'];
        mysql_query("INSERT INTO `$table_name` (`id` ,`username` ,`widgetname` ,`tools`) VALUES ('' , '$usernames', '$widget_name', '$tool_right')");
    }
    echo "<p class='info span-18'>The plugin has been installed succesfully.</p>";  
 }

?>