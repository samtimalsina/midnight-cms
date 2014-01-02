<p>View and Delete Users.</p>

<div id="php_error">

</div>

<table style="border:2px solid #E5ECF9;">
<tbody>
<tr>
    <th>S.N.</th>
    <th> Username </th>
    <th> Access Level </th>
    <th>Actions</th>
</tr>
<?php

$sn = 1;
$show_user = mysql_query("SELECT * FROM login_table");

while($data = mysql_fetch_array($show_user)){  
?>
<tr id="<?php echo "id_".$data['id']; ?>">
    <td style="width:20px;"><?php echo $sn; ?></td>
    <td><?php echo $data['username']; ?></td>
    <td><?php echo $data['level']; ?></td>
    <td style="width:100px;"><a href="#" id="<?php echo $data['id']; ?>" class="icons delete" title="delete">&nbsp;</a></td>
    <input type="hidden" value="<?php echo $data['username']; ?>" id="username_<?php echo $data['id']; ?>" /> 
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
        var url_link = urls+"website_specifics/User-Management/View-Users/functions.php";
        var delete_id = $(this).attr('id');
        
        var username = $("#username_"+delete_id).val();
        $.ajax({
            type: "POST",
            url: urls+"website_specifics/User-Management/View-Users/functions.php",
            data: "delete=confirm&user="+username+"&urls="+url_link+"&id="+delete_id,
            success: function(msg){
               $("#main_delete_alert").html(msg);
            },
            beforeSend: function(){
                $("#main_delete_alert").html('<center><br><br><br><h3>Loding...</h3></center>');
            }
        })
         
    });
	
</script>



