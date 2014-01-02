
    <p>Assign access level for <strong><?php echo $_REQUEST['user']; ?></strong></p>
    <div id="php_error">
    <?php
        if(isset($_REQUEST['hidden_value']) && isset($_REQUEST['table_name'])){
           $user = $_REQUEST['hidden_value'];
           $table_name = $_REQUEST['table_name'];
           $tool_type = $_REQUEST['tool_type'];
           
           $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM $table_name WHERE username='$user'"));
           
           $query = mysql_query("SELECT name,id FROM widgets WHERE type='$tool_type'")or die("error->".mysql_error());
            if($tbl_check[0]==0){
                while($widget_name = mysql_fetch_array($query)){
                    $access_level = "select_".$widget_name['id'];
                    $widget_names =  $widget_name['name'];
                    $selected = $_REQUEST[$access_level];
                    mysql_query("INSERT INTO $table_name VALUES ('','$user','$widget_names','$selected')")or die("error->".mysql_error());
                }   
                echo "<p class='info'>Access Level Assigned Successfully.</p>";
            }
            else{
                while($widget_name = mysql_fetch_array($query)){
                    $access_level = "select_".$widget_name['id'];
                    $widget_names =  $widget_name['name'];
                    $selected = $_REQUEST[$access_level]; 
                    mysql_query("UPDATE $table_name SET tools='$selected' WHERE username='$user' AND widgetname='$widget_names' ") or die("error->".mysql_error());
                }
                echo "<p class='info'>Access Level Assigned Successfully.</p>";
            }
        }
    ?>
    </div>
    
    <?php
    if(!isset($_REQUEST['manageaccess'])){ 
    ?>
    <h2>
    <?php
        $selected_user = $_REQUEST['user'];
        $_REQUEST['user'];
        $sql="SELECT level FROM login_table WHERE username='$selected_user'";
        $query=mysql_fetch_array(mysql_query($sql))or die ("error->".mysql_error());
        if($query['level']=="admin"){
    ?>

        <a href="<?php echo BASE_URL;?>tools/User-Management/Access-Levels/Assign-Levels/generaltools/<?php echo $_REQUEST['user']; ?>">General Tools</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    }
    ?>
        <a href="<?php echo BASE_URL;?>tools/User-Management/Access-Levels/Assign-Levels/websitecommons/<?php echo $_REQUEST['user']; ?>">Website Commons</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo BASE_URL;?>tools/User-Management/Access-Levels/Assign-Levels/sepecifictools/<?php echo $_REQUEST['user']; ?>">Website Specifics</a>
    </h2>
    <?php
    }
    if(isset($_REQUEST['manageaccess'])){
        if($_REQUEST['manageaccess'] == "websitecommons"){
            $table_row = "Website Common";
            $query1= mysql_query("SELECT name, id FROM widgets WHERE TYPE='common'");
            $table_name = "adminwidget_tbl";
            $tool_type = "common";
        }
        else if($_REQUEST['manageaccess'] == "generaltools"){
            $table_row = "General Tools";
            $query1= mysql_query("SELECT name, id FROM widgets WHERE type='tools'");
            $table_name = "admingeneraltool_tbl";
            $tool_type = "tools";
        }
        else if($_REQUEST['manageaccess'] == "sepecifictools"){
            $table_row = "Specific Tools";
            $query1= mysql_query("SELECT name, id FROM widgets WHERE type='specific'");
            $table_name = "adminspecific_tbl";
            $tool_type = "specific";
        }
        else{
            echo "You dont have permission to view this page.";
            exit;
        }
        ?>
        <form action="" method="post">
        <table style="border:2px solid #E5ECF9;">
        <tbody>
        <tr>
            <th>S.N.</th>
            <th><?php echo $table_row; ?></th>
            <th> Allow </th>
        </tr>
        <?php
            $sn=1;
            while($data = mysql_fetch_array($query1)){
        ?>
        <tr>
            <td style="width:20px;"><?php echo $sn; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td style="width:100px;">
            <?php
                $user=$_REQUEST['user'];
                $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM $table_name WHERE username='$user'"));
                if($tbl_check[0]==0){
                ?>
                <select name="select_<?php echo $data['id']; ?>">
                    <option value="yes">yes</option>
                    <option selected="selected" value="no" >no</option>
                </select>
                <?php
                }else{
                    $widget_name = $data['name'];
                    $option_select = mysql_fetch_array(mysql_query("SELECT tools FROM $table_name WHERE username='$user' AND widgetname='$widget_name' "));
                ?>
                <select name="select_<?php echo $data['id']; ?>">
                    <option value="yes" <?php if($option_select['tools']=="yes"){ ?> selected="selected" <?php } ?> >yes</option>
                    <option value="no" <?php if($option_select['tools']=="no"){ ?> selected="selected" <?php } ?> >no</option>
                </select>
                <?php    
                }
            ?>
                
            </td>
        </tr>
        <?php
            $sn++;
            }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" value="Save" class="button" /></td>
        </tr>
        </tbody>
        </table>
        <input type="hidden" value="<?php echo $user; ?>" name="hidden_value"/> 
        <input type="hidden" value="<?php echo $table_name; ?>" name="table_name"/>
        <input type="hidden" value="<?php echo $tool_type; ?>" name="tool_type"/>
        </form>
        <?php
       // }
    }
    ?>
    
     




