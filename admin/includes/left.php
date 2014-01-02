<script language="javascript" src="<?php echo BASE_URL;?>scripts/scripts.js"></script>
<div id="left" class="span-6">

<?php
    //$admin_check=mysql_query("SELECT ");
    $username = $_SESSION['username'];	
    if($_SESSION['level'] == "admin"){
?>
    	<div id="statistics" class="boxes span-6 last">
        	<h1 class="box_heading">General Tools</h1>
            	<ul class="box_menu hide">                	
                    <?php
                    				
                    $query=mysql_query("SELECT
                                            widgets.`name`,
                                            widgets.id,
                                            widgets.description,
                                            widgets.logo,
                                            widgets.type
                                        FROM
                                            widgets
                                        INNER JOIN admingeneraltool_tbl ON widgets.`name` = admingeneraltool_tbl.widgetname
                                        WHERE
                                            admingeneraltool_tbl.username = '$username' AND
                                            admingeneraltool_tbl.tools = 'yes' AND
                                            widgets.type = 'tools'");
                    while($widget=mysql_fetch_array($query)){
					?>
                    <li><a href="<?php echo BASE_URL."tools/".cut($widget['name']);?>"><span style="background:url(<?php echo BASE_URL;?>website_specifics/<?php echo cut($widget['name'])."/".$widget['logo'];?>)  <?php if(isset($_GET['widget'])){if (cut($widget['name'])==$_GET['widget']) echo "right"; else echo "left";} else echo "left";?>  bottom; height:32px; width:32px; display:block; float:left; margin-top:4px;">&nbsp;</span><?php echo $widget['name'];?></a></li>
                    <?php } ?>
                    
                    <?php /* <li class=""><a href="<?php echo BASE_URL;?>usermanagement"><span style="background:url(<?php echo WEB_URL;?>images/widgets/password.gif) left bottom; height:32px; width:32px; display:block; float:left; margin-top:4px;">&nbsp;</span>User Management</a></li>
                    <li class=""><a href="<?php echo BASE_URL;?>changepassword"><span style="background:url(<?php echo WEB_URL;?>images/widgets/password.gif) left bottom; height:32px; width:32px; display:block; float:left; margin-top:4px;">&nbsp;</span>Change Password</a></li>
                    */ ?>
                </ul>
            </div>
            
<?php
    }
?>
        <div id="specifics" class="boxes span-6 last">
        	<h1 class="box_heading icon1">Website Specifics</h1>
            <ul class="box_menu hide">                	
                    <?php
                    				
                    $query=mysql_query("SELECT
                                            widgets.`name`,
                                            widgets.id,
                                            widgets.description,
                                            widgets.logo,
                                            widgets.type
                                        FROM
                                            widgets
                                        INNER JOIN adminspecific_tbl ON widgets.`name` = adminspecific_tbl.widgetname
                                        WHERE
                                            adminspecific_tbl.username = '$username' AND
                                            adminspecific_tbl.tools = 'yes'");
                    while($widget=mysql_fetch_array($query)){
					?>
                    <li><a href="<?php echo BASE_URL."tools/".cut($widget['name']);?>"><span style="background:url(<?php echo BASE_URL;?>website_specifics/<?php echo cut($widget['name'])."/".$widget['logo'];?>)  <?php if(isset($_GET['widget'])){if (cut($widget['name'])==$_GET['widget']) echo "right"; else echo "left";} else echo "left";?>  bottom; height:32px; width:32px; display:block; float:left; margin-top:4px;">&nbsp;</span><?php echo $widget['name'];?></a></li>
                    <?php } ?>
                    
                    <?php /* <li class=""><a href="<?php echo BASE_URL;?>usermanagement"><span style="background:url(<?php echo WEB_URL;?>images/widgets/password.gif) left bottom; height:32px; width:32px; display:block; float:left; margin-top:4px;">&nbsp;</span>User Management</a></li>
                    <li class=""><a href="<?php echo BASE_URL;?>changepassword"><span style="background:url(<?php echo WEB_URL;?>images/widgets/password.gif) left bottom; height:32px; width:32px; display:block; float:left; margin-top:4px;">&nbsp;</span>Change Password</a></li>
                    */ ?>
                </ul>
            </div>
        <div id="commons" class="boxes span-6 last">
        	<h1 class="box_heading">Website Commons</h1>
            <ul class="box_menu">
				<?php
                    $query=mysql_query("SELECT
                                            widgets.`name`,
                                            widgets.id,
                                            widgets.description,
                                            widgets.logo,
                                            widgets.type
                                        FROM
                                            widgets
                                        INNER JOIN adminwidget_tbl ON widgets.`name` = adminwidget_tbl.widgetname
                                        WHERE
                                            adminwidget_tbl.username = '$username' AND
                                            adminwidget_tbl.tools = 'yes' AND widgets.type='common'");
					$num_of_widgets=mysql_num_rows($query);
					$this_widget=1;
                    while($widget=mysql_fetch_array($query)){
                ?>
            	<li <?php if($this_widget==1) echo "class='first'"; else if($this_widget==$num_of_widgets) echo "class='last'";?>>
                	<a href="<?php echo BASE_URL."widgets/".cut($widget['name']);?>"><span style="background:url(<?php echo BASE_URL;?>images/widgets/<?php echo $widget['logo'];?>) <?php if(isset($_GET['widget'])){if (cut($widget['name'])==$_GET['widget']) echo "right"; else echo "left";} else echo "left";?> bottom; height:32px; width:32px; display:block; float:left; margin-top:4px;">&nbsp;</span><?php echo $widget['name'];?></a>
                </li>
                <?php $this_widget++;} ?>
            </ul>
        </div>
    </div>
<script language="javascript"> 
    //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked
	$("box_heading").click(function()
	{
		$(this).slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().css({backgroundImage:"url(left.png)"});
	});
</script>