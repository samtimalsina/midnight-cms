<?php
session_start();
include("../../../conf/dbConnect.php");
/**
 * @author qualia
 * @copyright 2011
 */
 $search_word = $_POST['searchword'];
 if( mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$search_word."'"))){
     $result = mysql_query("SHOW COLUMNS FROM $search_word")or die("error-->".mysql_error());
     if (mysql_num_rows($result) > 0) {
        echo '<select id="column_name" name="column_name">';
        while ($row = mysql_fetch_assoc($result)) {
            echo '<option value="'.$row['Field'].'">'.$row['Field'].'</option>';
        }
        echo '</select>';
    }
    // echo "table found";
 }
 else{
 ?>
    <select id="column_name">
        <option selected="selected" value="0">Enter correct table name.</option>
    </select>
 <?php
 }

?>

