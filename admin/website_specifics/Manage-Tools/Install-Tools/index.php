
    <div id="php_error">
    </div>        
    <div id="error_msg" class="error" style="display: none;"></div>
<?php
    if(!isset($_REQUEST['hidden'])){
?>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return formCheck();">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file" class="button" />
        <br />
        <input type="hidden" name="hidden" value="set" />
        <input type="submit" name="submit" value="Submit" class="button" />
    </form>
    <br />
    * only zip file is allowed.
<?php
    }
    if(isset($_REQUEST['hidden']) && $_REQUEST['hidden']=="set"){
        //echo $_FILES["file"]["type"];
        if (($_FILES["file"]["type"] == "application/zip")){
            if ($_FILES["file"]["error"] > 0){
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
            else{
                if (file_exists("upload/" . $_FILES["file"]["name"])){
                    echo "<p class='error'>".$_FILES["file"]["name"] . " already exists. </p>";
                }
                else{
                    $file_name = "website_specifics/Manage-Tools/Install-Tools/upload/" . $_FILES["file"]["name"];
                    move_uploaded_file($_FILES["file"]["tmp_name"],$file_name);
                    //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                }
            }
            
            include("install.php");
            echo "<br>";
            XMLCheck($file_name);
        }
        else{
            echo "<p class='span-18 error last'>Invalid File.</p>";
        }
    }
?>



<script type="text/javascript">
	function formCheck(){
	   if($("#file").val()==""){
	       $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("<p class='span-18 error last'>Please select a file to upload.</p>")
           return false;
	   }
       else{
           objValue = $("#file").val();
           var fileExt=["zip"];
           var extension = objValue.substr( (objValue.lastIndexOf('.') +1) );
           if(extension == fileExt){
                $("#php_error").hide();
               $("#error_msg").show();
               $("#error_msg").html("<p class='span-18 info last'>File can be uploaded</p>")
               return true;
           }
           else{
               $("#php_error").hide();
               $("#error_msg").show();
               $("#error_msg").html("<p class='span-18 error last'>Invalid File Type.</p>");
               return false; 
           }
           
       }
       
	}
</script>

