<p>Send NewsLetters.</p>
<div id="php_error">
<?php


 

?>
</div>
<div id="error_msgs" class="error" style="display: none;"></div>

<form method="post" action="" onsubmit="">

<strong>Send Mail To:</strong><br />
    <select id="send_mail_to" name="send_mail_to">
        <option value="all_members">All Members</option>
        <option value="all_subscribers">All Subscribers</option>
        <option value="manual">Enter Email Address</option>
    </select>
    &nbsp;&nbsp;<input type="text" name="manual_mails" id="manual_text" style="display: none;" /><br />
<strong>Select Mail:</strong><br />
    <select>
        <option value="0" selected="selected">Select Email Address</option>
    
    
    </select>

</form>

<script type="text/javascript">
	$("#send_mail_to").change(function(){
	   if($(this).val() == 'manual'){
	       $("#manual_text").fadeIn('slow');
	   }
       else{
           $("#manual_text").fadeOut('slow');  
       }
	})
</script>