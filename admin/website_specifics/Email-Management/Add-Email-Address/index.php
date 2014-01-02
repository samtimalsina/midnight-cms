<p>Add new email address.</p>
<div id="php_error">
<?php
 function stringCheck($string){
    $check = "";
    $check = strrpos($string, "@");
    if($check == ""){
        $check = strpos($string, " ");
        if($check == ""){
            return false;
        }else{
            return true;
        }
    }
    else{
        return true;
    }
 }
 $host_name = explode('@',$_SERVER['SERVER_ADMIN']);
 
 if(isset($_POST['email']) && isset($_POST['access']) && $_POST['email']!=""){
    if(stringCheck($_POST['email']) == true){
        echo "<p class='span-18 error last'>You cannot use 'whitespaces' or '@' in email.</p>";
    }else{    
        $email_access = $_POST['access'];
        $email = $_POST['email']."@".$host_name[1];
        
        if($email_access == 'admin' || $email_access == 'sub-admin' || $email_access == 'both' ){
            $query1 = mysql_fetch_array(mysql_query("SELECT COUNT( id ) FROM `email` WHERE email = '$email'")) or die ("Error-->".mysql_error());
            if($query1[0] == 0){
                mysql_query("INSERT INTO `email` (`id` ,`email` ,`access`) VALUES ( NULL , '$email', '$email_access')") or die ("Error-->".mysql_error());
                echo "<p class='span-18 info last'>The email has been created successfully.</p>";
            }
            else{
                echo "<p class='span-18 error last'>The email address already exists.</p>";
            }
        }
        else{
            echo "<p class='span-18 error last'>There was an error while creating an email. Please try again.</p>";
        }
    }
 }
?>
</div>
<div id="error_msgs" class="error" style="display: none;"></div> 

 <form method="post" action="" onsubmit="return fieldCheck();">
 <input type="text" name="email" id="input_text" />@<?php echo $host_name[1]; ?><br />
 admin:
    <input type="radio" name="access" value="admin" id="radio_bttn" checked />
 sub-admin:
    <input type="radio" name="access" value="sub-admin" id="radio_bttn" />
 both:
    <input type="radio" name="access" value="both" id="radio_bttn" /><br /><br />
 <input type="submit" value="Create" class="button" />
 </form>
 
 <style type="text/css">
<!--
	#radio_bttn{
	   width: 5px;
	}
    #input_text{
        width:240px;
    }
-->
</style>

<script type="text/javascript">
    function hasWhiteSpace(s) {
      return s.indexOf(' ') >= 0;
    }
    function hasString(s) {
      return s.indexOf('@') >= 0;
    }
	function fieldCheck(){
	   if($("#input_text").val()==""){
	       $("#php_error").hide();
           $("#error_msgs").html("");
           $("#error_msgs").html("Fill up all the fields before submitting.");
           $("#error_msgs").show();
	       return false;
	   }
  
       if(hasWhiteSpace($("#input_text").val()) == true || hasString($("#input_text").val()) == true ){
           $("#php_error").hide();
           $("#error_msgs").html("");
           $("#error_msgs").html("You cannot use 'whitespaces' or '@' in email.");
           $("#error_msgs").show();
	       return false;       
       }
	}
    
</script>