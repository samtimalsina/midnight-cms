<script src="<?php echo BASE_URL;?>website_specifics/Email-Management/Scripts/nicEdit.js" language="javascript"></script>

<?php
 
 function createNewXML($mail_header, $mail_footer, $filename){
    $create_xml = fopen($filename,'w');
    $xml_data = '<?xml version="1.0" encoding="utf-8"?>
<template>
<mail_header>'.$mail_header.'</mail_header>
<mail_footer>'.$mail_footer.'</mail_footer>
</template>';
    fwrite($create_xml,$xml_data);
    fclose($create_xml);
 }
 
 $filename = "website_specifics/Email-Management/Manage-Template/template.xml";
 if(isset($_POST['mail_header']) || isset($_POST['mail_footer'])){
    $mail_header = base64_encode($_POST['mail_header']);
    $mail_footer = base64_encode($_POST['mail_footer']);
    
    if(!file_exists($filename)){
        createNewXML($mail_header, $mail_footer, $filename);
    }
    else{
        unlink($filename);
        createNewXML($mail_header, $mail_footer, $filename);
    }
 }
 
 if(file_exists($filename)){
    $pre_header = base64_decode(getXMLValues($filename,"template","mail_header"));
    $pre_footer = base64_decode(getXMLValues($filename,"template","mail_footer"));
    $bttn_value = "Edit";
    $view_template = "true";
 }else{
    $pre_header = "";
    $pre_footer = "";
    $bttn_value = "Create";
    $view_template = "false";
 }
 
	
?>

<p>Create or Edit the template of email.</p>
    
 <form action="" method="post" onsubmit="">
    
 <b>Header:</b> 
 <textarea name="mail_header" id="headers"><?php echo $pre_header; ?></textarea>
 <script type="text/javascript">
    bkLib.onDomLoaded(function() {
	   new nicEditor({iconsPath : '<?php echo BASE_URL;?>website_specifics/Email-Management/Images/nicEditorIcons.gif'}).panelInstance( 'headers');
    });
 </script>
 <br />
 
 <b>Footer:</b> 
 <textarea name="mail_footer" id="footer"><?php echo $pre_footer; ?></textarea>
 <script type="text/javascript">
    bkLib.onDomLoaded(function() {
	   new nicEditor({iconsPath : '<?php echo BASE_URL;?>website_specifics/Email-Management/Images/nicEditorIcons.gif'}).panelInstance( 'footer');
    });
 </script>

 <input type="submit" class="button" value="<?php echo $bttn_value; ?>"/>
 
 </form>
 <br />
 <?php
 
    if($view_template=="true"){
 ?>
        <span id="view_template">view template</span>
 <?php
    }
 
 ?>
 <div id="template"></div>
 <div id="show_template"></div>
<style type="text/css">
<!--
    #view_template{
        color: blue;
    }
	#view_template:hover{
	   cursor: pointer;
       color: red;
	}
-->
</style>

<script type="text/javascript">
    $("#view_template").click(function(){
        var urls= '<?php echo BASE_URL; ?>';
        var width = $(window).width();
        var height = $(window).height();
        $.ajax({
            type: "POST",
            url: urls+"website_specifics/Email-Management/Manage-Template/functions.php",
            data: "url="+urls,
            success: function(msg){
                $("#template").width(width);
                $("#template").height(height);
                $("#template").css({
                    "background-color":"black",
                    "border":"solid 1px",
                    "opacity": "0.5",
                    "position": "fixed",
                    "top": "0",
                    "left": "0"
                })
                $("#show_template").css({
                    "top":height/17,
                    "left":width/4,
                    "width":"700",
                    "background-color":"white",
                    "border":"solid 1px",
                    "position": "fixed", 
                })
                $("#template").fadeIn('slow');
                $("#show_template").fadeIn('slow');
                $("#show_template").html(msg)
            },
            beforeSend: function(){
                $("#show_template").show();
                $("#show_template").html("loading....");
            }
        })
    })
</script>