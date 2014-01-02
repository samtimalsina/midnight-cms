<?php
	include("includes/header.php");
	include("includes/left.php");
    include("conf/require-functions.php");
    
    
    $install_xml = "website_specifics/".$_REQUEST['tool']."/install.xml";
    
    if(file_exists($install_xml)){
        $tool_name = getXMLValues($install_xml,"tool_details","tool_name");
        $tool_icon = cut($tool_name)."/".getXMLValues($install_xml,"tool_details","tool_logo");
        $tool_info = getXMLValues($install_xml,"tool_details","tool_info");
        $tool_type = getXMLValues($install_xml,"tool_details","tool_type");
        $function_check = getXMLValues($install_xml,"function","function_name");
        if($tool_type=="tools"){
            validUserCheck("admingeneraltool_tbl",$tool_name);    
        }
        else if($tool_type=="specific"){
            validUserCheck("adminspecific_tbl",$tool_name);
        }
        else{
            echo "<h1> Error Occured</h1>";
            exit;
        }
        
    
    ?>
    
    <div id="main" class="span-18 last prepend-top">
    
        <span class="widget_icon big main" style="background:url(http://alpha/lozicbrain/admin/website_specifics/<?php echo $tool_icon; ?>) top; margin-right:10px;">&nbsp;</span>
        <h1><?php echo $tool_name; ?></h1>
        <p><?php echo $tool_info; ?></p>
        
        <?php  
            if($function_check != ""){
                $function_name = getXMLFunctions($install_xml,"function","function_name");
                $function_type = getXMLFunctions($install_xml,"function","function_type");
            
        ?>
        <div id="functions" class="span-18 last ">
        
        <p>
        <?php 
            $i = 0;
            foreach($function_name as $f_name){
        ?>
            <a class="functions <?php echo $function_type[$i]; ?>" href="<?php echo BASE_URL;?>tools/<?php echo cut($tool_name) ?>/<?php echo cut($f_name);  ?>" ><?php echo $f_name; ?></a>
           
        <?php
            $i++;
            }
        ?> 
        </p>
        </div>
        
        <?php
            if(isset($_REQUEST['function'])){
        ?>
        <div id="widget_heading" class="span-18 last prepend-top">
        
        <h2>
            <a href="<?php echo BASE_URL;?>tools/<?php echo cut($tool_name); ?>"><?php echo $tool_name; ?></a>&nbsp; &gt; 
            <?php 
                if(isset($_REQUEST['manageaccess'])){
                ?>
                    <a href="<?php echo BASE_URL;?>tools/<?php echo cut($tool_name); ?>/<?php echo cut($_REQUEST['function']); ?>/<?php echo cut($_REQUEST['level']); ?>/<?php echo $_REQUEST['user']; ?>">
                <?php
                }
                    echo space($_REQUEST['function']);
                ?>
                <?php
                    if(isset($_REQUEST['manageaccess'])){
                        echo "</a>"; 
                    } 
                    
                    if(isset($_REQUEST['manageaccess'])){
                        if($_REQUEST['manageaccess'] == 'websitecommons'){
                        ?>
                            &gt; Website Commons
                        <?php    
                        }
                        if($_REQUEST['manageaccess'] == 'generaltools'){
                        ?>
                            &gt; General Tools
                        <?php
                        }
                    }
                ?>
                
            
        </h2>
        
        
        </div>
        <?php
            }
            }
        ?>
        
        <?php 
            if(isset($_REQUEST['function']) && !isset($_REQUEST['level'])){
                $url = "website_specifics/".cut($tool_name)."/".$_REQUEST['function']."/index.php";
            }
            else if(isset($_REQUEST['function']) && isset($_REQUEST['level'])){;
                $url = "website_specifics/".cut($tool_name)."/".$_REQUEST['function']."/".$_REQUEST['level']."/index.php";
            }
            else{
                $url = "website_specifics/".cut($tool_name)."/index.php";
            }
            
            include($url); 
    
    }
    else{
        echo "<br><br><br><br><br><br><h2>The Tool is not Installed Properly.</h2>";
    }
    ?>

    
    </div>

<?php
	include("includes/footer.php");
?>