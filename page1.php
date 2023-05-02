<?php
Require 'connect.php';
if(isset($_POST["add"])){
    $name=$_POST["name"];
    $pName=$_POST["pName"];
    $age=$_POST["age"];
    $pDate=$_POST["date"];
    $page=$_POST["page"];

    $sci_fic="";
    if(isset($_POST["sci-fic"])){
        $sci_fic=$_POST["sci-fic"];
    }
    $drama="";
    if(isset($_POST["drama"])){
        $drama=$_POST["drama"];
    }
    $novel="";
    if(isset($_POST["novel"])){
        $novel=$_POST["novel"];
    }

    $bookType=$sci_fic.' '.$drama.' '. $novel;
    $query="insert into booklist (name, pName, age,pDate, page,bookType) values('$name','$pName','$age', '$pDate','$page','$bookType')";
    $result=mysqli_query($conn,$query);

    if($result){
        header('location: page2.php'); 
    }
    else{
        echo "<script> alert('failed!'); </script>";
    }
}
$id="";
if(isset($_REQUEST['id']) ){
    $id=$_REQUEST['id'];

    $query2="select * from booklist where id='$id'";
    $result2=mysqli_query($conn,$query2);
    $details= mysqli_fetch_assoc($result2);

    
    $dt = new DateTime($details['pDate']);
    $date = $dt->format('Y-m-d');
    
    // check book type
    $type=$details['bookType'];
    // if(str_contains($type,"sci-fic")){}
}

// update book info
if(isset($_POST["update"])){
    $name=$_POST["name"];
    $pName=$_POST["pName"];
    $age=$_POST["age"];
    $pDate=$_POST["date"];
    $page=$_POST["page"];

    $sci_fic="";
    if(isset($_POST["sci-fic"])){
        $sci_fic=$_POST["sci-fic"];
    }
    $drama="";
    if(isset($_POST["drama"])){
        $drama=$_POST["drama"];
    }
    $novel="";
    if(isset($_POST["novel"])){
        $novel=$_POST["novel"];
    }

    $bookType=$sci_fic.' '.$drama.' '. $novel;

    $update_query="update booklist set name='$name',pName='$pName',age='$age',pDate='$pDate', page='$page', bookType='$bookType' where id ='$id'";
    $info=mysqli_query($conn, $update_query);
    if($info){
        echo "<script> alert('Updated successfully!'); </script>";
        header('location: ./page2.php'); 
    }
    else{
        echo "<script> alert('failed'); </script>";
    }
}

// delete book
$del_id="";
if(isset($_REQUEST['del_id'])){
    $del_id=$_REQUEST['del_id'];
}

if(isset($_POST['delete'])){
    $query_del="delete from booklist where id = '$del_id'";
    $inf=mysqli_query($conn, $query_del);
    if($inf){
        header('location: page2.php'); 
    }
    else{
        echo "<script> alert('failed'); </script>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head></head>

    <body>
        <form action="" method="post">
            <label for="">Name</label>&nbsp
            <input type="text" name="name" value="<?php if(isset($details)){echo $details['name'];} ?>" />
            <br/>
            <br/>

            <label for="">Publisher Name</label>
            <input type="text" name="pName" value="<?php if(isset($details)){echo $details['pName'];} ?>" />
            <br/>
            <br/>

            <label for="">Age</label>
            &nbsp&nbsp&nbsp&nbsp
            <select name="age">  
            <option value="20" <?php if(isset($details)){if($details['age']==20){echo "selected";}} ?> >20</option>  
            <option value="25" <?php if(isset($details)){if($details['age']==25){echo "selected";}} ?> >25</option>  
            <option value="30" <?php if(isset($details)){if($details['age']==30){echo "selected";}} ?> >30</option>  
            <option value="35" <?php if(isset($details)){if($details['age']==35){echo "selected";}} ?> >35</option>  
            <option value="40" <?php if(isset($details)){if($details['age']==40){echo "selected";}} ?> >40</option>  
            </select>  
            <br/>
            <br/>

            <label for="">date</label>&nbsp&nbsp
            <input type="date" name="date" value="<?php if(isset($details)){echo $date;} ?>" />
            <br/>
            <br/>

            <label for="">page</label>&nbsp&nbsp
            <input type="number" name="page" value="<?php if(isset($details)){echo $details['page'];} ?>" />
            <br/>
            <br/>

            <label for="">Book Type</label>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label> Sci-fic</label>
            <input type="checkbox" name="sci-fic" value="sci-fic" <?php if(isset($details)){if(str_contains($type,"sci-fic")){ echo "checked";}} ?>/>
            &nbsp
            <label> Drama</label>
            <input type="checkbox" name="drama" value="drama" <?php if(isset($details)){if(str_contains($type,"drama")){ echo "checked";}} ?>/>
            &nbsp
            <label> novel</label>
            <input type="checkbox" name="novel" value="novel" <?php if(isset($details)){if(str_contains($type,"novel")){ echo "checked";}} ?>/>

            <br/>

            <br>
            <button type="submit" name="add" value="add" <?php if($id!==""){ echo "hidden";} ?>>Add book</button>
            <button type="submit" name="update" value="update" <?php if($id=="" || $del_id!==""){ echo "hidden";} ?> >Update</button>

            <?php if($del_id!==""){ echo "Are you sure?";} ?> &nbsp&nbsp&nbsp&nbsp&nbsp
            <button type="submit" name="delete" value="delete" <?php if($del_id==""){ echo "hidden";} ?> >Delete</button>
        </form>
    </body>
</html>