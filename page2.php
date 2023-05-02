<?php
    Require 'connect.php';
    $query="select * from booklist";
    $result=mysqli_query($conn, $query);

    $lists = [];

		while($list = mysqli_fetch_assoc($result)){
			array_push($lists, $list);
		}
		// return $lists;
    
        
        
    
?>

<!DOCTYPE html>
<html>
    <head></head>

    <body>
        <h3>Book list</h3>
        <br>
        <form>
    <table align = "left" border = "1" cellpadding = "3" cellspacing = "0">  
        <thead>
            <tr>  
            <td>SL</td>  
            <td>Book Name</td>  
            <td>Action</td> 
            </tr> 
        </thead> 
        <tbody>
        <?php  for($i=0; $i<count($lists); $i++){ ?>
				<tr align="center" style="width: 145px; height: 45px; font-size:20px;">
                    <td><?= $i ?></td>
					<td><?=$lists[$i]['name']?></td>
					<td>
                    <a style="text-decoration:none; color:white; background-color:yellow; padding:5px 5px; border-radius: 10px;"  href="page1.php?id=<?=$lists[$i]['id']?>">Edit</a>
						<a style="text-decoration:none; color:white; background-color:red; padding:5px 5px; border-radius: 10px;"  href="page1.php?id=<?=$lists[$i]['id']?>&del_id=<?=$lists[$i]['id']?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
        </tbody> 
</table>
        </form>
    </body>
<html>