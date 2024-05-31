<?php
if($_SESSION["user_role"]=='0'){
 
    header("location:{$hostname}/admin/post.php");

}

include "config.php";
$userid=$_GET['id'];

$sql="delete from user  where user_id={$userid}";

if(mysqli_query($conn,$sql)){
    header("location:{$hostname}/admin/users.php");
}else{
    echo " <p>  some thing error   </p>";
}
mysqli_close($conn);


?>