
<h3>Access Levels</h3>
<p>You can assign access level from here</p>

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
    <tr>
        <td style="width:20px;"><?php echo $sn; ?></td>
        <td><?php echo $data['username']; ?></td>
        <td><?php echo $data['level']; ?></td>
        <td style="width:100px;"><a href="<?php echo BASE_URL;?>tools/User-Management/Access-Levels/Assign-Levels/<?php echo $data['username']; ?>"> assign level</a></td>
    </tr>
    <?php
    $sn++;
    }
    ?>
</tbody>
</table>    

