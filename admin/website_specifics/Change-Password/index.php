
	
    <div id="php_error">
       <?php
            if(isset($_REQUEST['old_password']) && isset($_REQUEST['new_password'])){
                $old_password = $_REQUEST['old_password'];
                $new_password = $_REQUEST['new_password'];
				
				if (strlen($new_password)<5){
					echo "<p class='error'>Password must be atleast 5 characters long.</p>";
				}
				else{
					$username = $_SESSION['username'];
					
					$password_check = mysql_fetch_array(mysql_query("SELECT password FROM login_table WHERE username='$username'"));
					
					if(comparePassword($old_password, $password_check['password']) == 1){
						$hash_password = getPasswordHash(getPasswordSalt(), $new_password);
						$sql ="UPDATE login_table SET password='$hash_password' WHERE username='$username'";
						mysql_query($sql) or die(mysql_error());
						echo "<p class='info'>Password changed successfully</p><br>";   
                          
					}
					else{
						echo "<p class='error'>You Entered Wrong Old password</p>";
					}
				}
            }
        
       ?>
    </div>	
        
    <div id="error_msg" class="error" style="display: none;"></div> 

    <form method="post" action="" onsubmit="return fieldCheck();">
        <label for="old_password">Old Password&nbsp;*</label>
        <input type="password" name="old_password" id="old_password" />
        <label for="new_password">New Password&nbsp;*</label>
        <input type="password" name="new_password" id="new_password" />
        <label for="re_new_password">Repeat New Password&nbsp;*</label>
        <input type="password" name="re_new_password" id="re_new_password" />
        <p><input type="reset" value="Reset" class="button"/>
        <input type="submit" value="Change Password" class="button"/></p>
    </form>
        
    


<script type="text/javascript">
	function fieldCheck(){
	   if($("#old_password").val()=="" || $("#new_password").val()=="" || $("#re_new_password").val()=="" ){
	       $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("Fill up all the fields before submitting.")
           return false;
	   }
       else if($("#new_password").val() != $("#re_new_password").val() ){
           $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("Password do not match.")
           return false;
       }
	   else if($("#new_password").val().length <5 || $("#re_new_password").val().length <5 ){
           $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("Password must be atleast 5 characters long.")
           return false;
       }
       else{
           return true; 
       }
	}
</script>