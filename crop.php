<?php
header("Content-Type: application/json", true);
require_once("inc/inc.php");


$lnk = $_POST['vlink'];
$startTime = $_POST['st'];
$endTime = $_POST['et'];

// $result = array('link' => "C:\xampp\htdocs\videogallery\crop-videos\abc.webm", 'st' => $startTime, 'et' => $endTime );

// echo json_encode($result);


   // _____ _______       _____ _______    _____ ____  _____  ______  
  // / ____|__   __|/\   |  __ \__   __|  / ____/ __ \|  __ \|  ____| 
 // | (___    | |  /  \  | |__) | | |    | |   | |  | | |  | | |__    
  // \___ \   | | / /\ \ |  _  /  | |    | |   | |  | | |  | |  __|   
  // ____) |  | |/ ____ \| | \ \  | |    | |___| |__| | |__| | |____  
 // |_____/   |_/_/    \_\_|  \_\ |_|     \_____\____/|_____/|______| 



if(  getOS() == "windows" ){
	// system("chcp 65001 &"); //system unicode display for windows, you must use unicode font in cmd to see this ! 
}

 
$supportExt = array("mp4", "flv", "avi", "webm" , "mkv"); // hỗ trợ file nào !?

// if( empty( $startTime ) ){
// 	echo json_encode(array('error' => "Empty start time!" ));
// 	die();
// }

// if( empty( $endTime ) ){
// 	echo json_encode(array('error' => "Empty end time!" ));	
// 	die();
// }

// if( $endTime == '00:00:00'){
// 	echo json_encode(array('error' => "Please enter end time!" ));	
// 	die();
// }


//--------------------------------------------------------------------- PROGRAM START -------------------------------------------------------------------------------------------------------------------------------------
// convert and save to dir 
// paramS: $arrFileName ,  $arrSupportExt , $saveDirPath , $startTime , $endTime(in seconds) 
cutVideoAndSave($lnk, $supportExt, $startTime, $endTime);





?>