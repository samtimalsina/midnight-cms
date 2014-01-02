  
    
	
    <div id="php_error">
       <?php
            if(isset($_POST)){
				foreach ($_POST as $key => $input_arr) {
					if ($_POST[$key]==""){
						echo "<p class='error'>Go hack someone else's Website</p>";
						$IP = $_SERVER['REMOTE_ADDR'];
						logLocation($IP);
						break;
					}
					$_POST[$key] = addslashes($input_arr);
				}
			}
        
       ?>
    </div>	
        
    <div id="error_msg" class="error" style="display: none;"></div>
    <?php
		$site=mysql_fetch_array(mysql_query("SELECT * FROM site_settings LIMIT 1"))
	?>

    <form method="post" action="" onsubmit="return fieldCheck();">
        <label for="web_title">Website Title&nbsp;*</label>
        <input type="text" name="web_title" id="web_title" value="<?php echo $site['site_title'];?>"/>
        <label for="website_name">Website Name&nbsp;*</label>
        <input type="text" name="website_name" id="website_name" value="<?php echo $site['site_name'];?>"/>
        <label for="web_url">Website URL&nbsp;*</label>        
        <input type="text" name="web_url" id="web_url" value="<?php echo $site['web_url'];?>"/>
        <label for="time_zone">Website Time Zone&nbsp;*</label>
        <select name="time_zone" id="time_zone">
            <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
            <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
            <option value="-10.0">(GMT -10:00) Hawaii</option>
            <option value="-9.0">(GMT -9:00) Alaska</option>
            <option value="-8.0">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
            <option value="-7.0">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
            <option value="-6.0">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
            <option value="-5.0">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
            <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
            <option value="-3.5">(GMT -3:30) Newfoundland</option>
            <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
            <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
            <option value="-1.0">(GMT -1:00) Azores, Cape Verde Islands</option>
            <option value="0.0">(GMT 0:00) Western Europe Time, London, Lisbon, Casablanca</option>
            <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
            <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
            <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
            <option value="3.5">(GMT +3:30) Tehran</option>
            <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
            <option value="4.5">(GMT +4:30) Kabul</option>
            <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
            <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
            <option value="5.75">(GMT +5:45) Kathmandu</option>
            <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
            <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
            <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
            <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
            <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
            <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
            <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
            <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
    	</select>
        <label for="meta_key">Meta Keywords&nbsp;*</label>
        <textarea name="meta_key" id="meta_key" ><?php echo $site['meta_key'];?></textarea>
        <label for="meta_desc">Meta Description&nbsp;*</label>
        <textarea name="meta_desc" id="meta_desc" ><?php echo $site['meta_desc'];?></textarea>
        <label for="email">Default Email&nbsp;*</label>
        <input type="text" name="email" id="email" value="<?php echo $site['site_email'];?>"/>
        <label for="status">Status&nbsp;*</label>
        <select name="status">
        	<option value="online">Online</option>
            <option value="offline">Offline</option>
        </select>
        <label for="offline_msg">Offline Message</label>
        <textarea name="offline_msg" id="offline_msg" ><?php echo $site['offline_msg'];?></textarea>
        <p><input type="submit" value="Update Settings" class="button"/></p>
    </form>   
    



<script type="text/javascript">
	function fieldCheck(){
	   if($("#web_title").val()=="" || $("#website_name").val()=="" || $("#web_url").val()=="" || $("#meta_key").val()=="" || $("#meta_desc").val()=="" || $("#email").val()==""){
	       $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("Fill up all the fields before submitting.")
		   $(this).scrollTop($('#header').position().top) 
           return false;
	   }
       else{
           return true; 
       }
	}
</script>