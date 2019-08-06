<?php

$title = $_POST['title'];
$con = mysqli_connect('localhost','root','','instavideo2');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"instavideo2");
$sql="SELECT start_date_time, end_date_time from vibe_videos WHERE title ='".$title."';";
$result = mysqli_query($con,$sql);

$row=mysqli_fetch_assoc($result);

echo json_encode($row);
// mysqli_close($con);
?>