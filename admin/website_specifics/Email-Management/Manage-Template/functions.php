<?php
 //include(BASR_URL)
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
 $filename = $_POST['url']."website_specifics/Email-Management/Manage-Template/template.xml";
 $pre_header = base64_decode(getXMLValues($filename,"template","mail_header"));
 $pre_footer = base64_decode(getXMLValues($filename,"template","mail_footer"));
 echo "<div style='padding-left: 10px; border: solid 1px;'>";
 echo "<span id='close_me'>X</span>";
 
 echo $pre_header."<br>";
 echo "<span id='jst_border'></span>";
 echo "<span id='email_body'><h2>===This area covers the main body of your email.===</h2></span><br>";
 echo "<span id='jst_border'></span>";
 echo $pre_footer;
 echo "</div>";

?>
<div style="margin"></div>
<style type="text/css">
<!--
    #close_me{
        float: right;
        margin-right: 5px;
    }
	#close_me:hover{
	   cursor: pointer;
	}
    #email_body{

    }
    #jst_border{
        border: solid silver 1px;
        width: 97%;
        position: absolute;
    }
-->
</style>

<script type="text/javascript">
	$("#close_me").click(function(){
	   $("#template").fadeOut('slow');
       $("#show_template").fadeOut('slow');
	})
</script>