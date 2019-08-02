<?php
//echo $_POST['col_name'];
//echo $_POST['col_val'];
//echo $_POST['vid_id'];
$col_name = $_POST['col_name'];
$col_val = $_POST['col_val'];
$vid_id = $_POST['vid_id'];
$con = mysqli_connect('localhost','root','georgea','instavideo2');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="UPDATE vibe_videos SET ".$col_name."=".$col_val." WHERE id = ".$vid_id.";";
mysqli_query($con,$sql);

echo $sql;
mysqli_close($con);
?>