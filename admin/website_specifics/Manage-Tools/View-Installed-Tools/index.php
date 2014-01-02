 <p>View Installed Tools.</p>


 <table style="border:2px solid #E5ECF9;">
 <tbody>
 <tr>
     <th>S.N.</th>
     <th> Tool Name </th>
     <th> Tool Type </th>
     <th>Actions</th>
 </tr>
 
 <?php
 
    $sn = 1;
    $query1 = mysql_query("SELECT * FROM widgets WHERE (type='specific' OR type='tools') ") or die (mysql_error()); 
    while($row = mysql_fetch_array($query1)){
 ?>
 
 <tr id="<?php echo "id_".$row['id']; ?>">
    <td style="width:20px;"><?php echo $sn; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['type']; ?></td>
    <td style="width:100px;">
    <?php
        if($row['system']!='default'){
    ?>
    <a href="#" id="<?php echo $row['id']; ?>" class="icons delete" title="delete">&nbsp;</a>
    <input type="hidden" value="<?php echo $row['name']; ?>" id="<?php echo "getname_".$row['id']; ?>" />
    <?php 
        }else{
            //echo "X";
        }
    ?>
    </td>
 </tr>
    
 <?php
    $sn++;
    }
 ?>
 </tbody>
 </table> 
 
 <div id="delete_alert" style="display: none; position: fixed; top: 0px; left: 0px;"></div>
<div id="main_delete_alert" style="display: none; position: fixed; "></div>

<script type="text/javascript">
	$(".delete").click(function(){
	   var width = $(window).width();
       var height = $(window).height();
       
       $("#delete_alert").width(width);
       $("#delete_alert").height(height);
       
       $("#delete_alert").css({
           "background-color":"white",
           "opacity": "0.5"
       });
       $("#delete_alert").fadeIn('slow');
       $("#main_delete_alert").css({
           "top":height/4,
           "left":width/3,
           "background-color":"white",
           "border":"solid 1px" 
       });
       $("#main_delete_alert").width(width/4);
       $("#main_delete_alert").height(height/3);
       $("#main_delete_alert").fadeIn('slow');   
       
       var urls= '<?php echo BASE_URL; ?>';
       var url_link = urls+"website_specifics/Manage-Tools/View-Installed-Tools/functions.php";
       var id = $(this).attr('id');
       var tool_name = $("#getname_"+id).val();
       //alert($("#get_id").val())
       //alert(tool_name);
       $.ajax({
            type: "POST",
            url: urls+"website_specifics/Manage-Tools/View-Installed-Tools/functions.php",
            data: "delete=confirm&urls="+url_link+"&toolname="+tool_name+"&id="+id,
            success: function(msg){
               $("#main_delete_alert").html(msg);
            },
            beforeSend: function(){
                $("#main_delete_alert").html('<center><br><br><br><h3>Loding...</h3></center>');
            }
        })
    });
</script>