<?php
$q = intval($_POST['query']);

$con = mysqli_connect('localhost','root','georgea','instavideo2');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT door_no, title FROM `vibe_warehouses_doors` WHERE `warehouse_id` = '".$q."'";
$result = mysqli_query($con,$sql);

$door_info = [];
while($row = mysqli_fetch_array($result)) {
    //echo $row[0];
    //echo $row[1];
    echo '<option value = "'.$row[0].'" > '.$row[1].'</option>';
    //echo $row->title;
}
mysqli_close($con);

?>
