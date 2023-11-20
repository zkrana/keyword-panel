<?php
include("config.php");
if(isset($_GET['id'])){
    $del_id= $_GET['id'];
    
    $image = "SELECT * FROM user_table WHERE id = '$del_id'";
    $query = mysqli_query($connect, $image);
    $after = mysqli_fetch_assoc($query);
    
    $del_sql="DELETE FROM user_table WHERE id=$del_id"; 
    $query = mysqli_query($connect,$del_sql);
    if($query){
        unlink('img/uploads/user_photo/'.$after['photo']);
        header("Location: manageuser.php?success");
        die();
    }
}
?>