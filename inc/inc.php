<?php

use FFMpeg\FFMpeg;
//use FFMpeg\Coordinate\TimeCode;
//use FFMpeg\Format\Video;
use FFMpeg\FFProbe;

require_once( dirname(__DIR__) . "/vendor/autoload.php");
// ----------------- int class ---------------------
if( getOS() == "linux" ){
	// $Ffmpeg = FFMpeg::create(array(
	// 	"ffmpeg.binaries" => __DIR__ . "/ffmpegLinux/ffmpeg",
	// 	"ffprobe.binaries" => __DIR__ . "/ffmpegLinux/ffprobe",
	// 	"timeout" => 3600, 
	// 	"ffmpeg.threads" => 24
	// ));	
    
    try{
        $Ffmpeg = FFMpeg::create();
    }catch(Exception $e){
        echo "\n Có lỗi xảy ra khi khởi tạo ffmpeg, bạn đã cài đặt ffmpeg cho linux chưa !? \n ";
        die;
    }
    $Ffmpeg = FFMpeg::create();
}else {
	if( getOS()  == "windows") {
		try{
			$Ffmpeg = FFMpeg::create();
		}catch( Exception $ex ){
			echo "\n Co loi xay ra khi khoi tao ffmpeg, them ffmpeg vao system PATH : http://adaptivesamples.com/how-to-install-ffmpeg-on-windows/ ";
			die;
		}
	}else{
		echo "\n your OS is not supported: {$PHP_OS} \n ";
		die;
	}

}

$Ffprobe = FFProbe::create();


// ----------------- end class ----------------------
// 
// 
// -------------------------------- start functions ----------------------------------------------------------------------------------
// truyen array list file -> loc list file ho tro -> convert -> save();
// startTime = thoi gian bat dau convert 
// endTime = thoi gian cắt trước khi kết thúc ;
// $openDirPath : folder can xu li 
//  $saveDirPath : folder save da xu li 
function cutVideoAndSave($file, $arrSupportExt, $startTime, $endTime) {
    $osType = getOS();

    $arrName = explode(".", $file);
    if (in_array(strtolower($arrName[sizeof($arrName) - 1]), $arrSupportExt)) {

        $cmd = cutCommandBuilder( $file, $startTime, $endTime, $osType);
        // echo "command: ".$cmd;
        system($cmd[1]);
        // echo "\n";
        echo json_encode(array('output' => $cmd[0] ));
    } else {
        echo json_encode(array('error' => "Supported file formats are: " . implode(",",$arrSupportExt)));
    }
}

// function convert and save 

function getVideoLength($videoName) {
    global $Ffprobe;
    // return $Ffprobe->streams($videoName)->videos()->first()->get("duration");
	return $Ffprobe->format($videoName)->get("duration");
}

// build cutCommand 
function cutCommandBuilder($currentFilePath, $startTime, $endTime, $osType) {
    // if ($osType == "linux") {
    //     $commandBuilt = "ffmpeg -y -ss {$startTime} -t {$endTime} -i \"{$openDir}".DIRECTORY_SEPARATOR."{$currentFileName}\" -vcodec copy -acodec copy \"{$saveDir}" .DIRECTORY_SEPARATOR. "{$currentFileName}\" &>/dev/null ";
    // } else {
    //     $commandBuilt = "ffmpeg -y -ss {$startTime} -t {$endTime} -i \"{$openDir}".DIRECTORY_SEPARATOR."{$currentFileName}\" -vcodec copy -acodec copy \"{$saveDir}" .DIRECTORY_SEPARATOR. "{$currentFileName}\" >nul 2>&1";
    // }

 $ranNo = time() . mt_rand(1,100);
 $pathArray = explode(".",$currentFilePath);
 $ext = $pathArray[sizeof($pathArray) - 1];
 $outputURL = "C:\\xampp\\htdocs\\videogallery\\crop-videos\\".$ranNo.".".$ext;

 $commandBuilt = "ffmpeg -y -i {$currentFilePath} -vcodec copy -acodec copy -ss {$startTime} -to {$endTime} ".$outputURL;

    $result = array($ranNo.".".$ext, $commandBuilt);
    // return $commandBuilt;
    return $result;
}

//  convert second -> hh:mm:ss
function convertSecondToTimeCode($timeSecond) {
    $oldTimeSecond = $timeSecond;
    $hour = 0;
    $min = 0;
    $second = 0;

    if ($timeSecond < 60) {
        $second = $timeSecond;
    }

    if ($timeSecond > 60) {
        while ($timeSecond / 60 > 1) {
            $min++;
            $timeSecond -= 60;
        }
    }

    if ($min > 60) {
        while ($min / 60 > 1) {
            $hour++;
            $min -= 60;
        }
    }
    echo "hour:{$hour} min: {$min} | second : {$timeSecond}" . " = " . $oldTimeSecond;

    return "{$hour}:${min}:{$timeSecond}";
}; //convert second to TimeCode ;

//getos : return : [linux | windows ]
function getOS(){
	if( strtolower(PHP_OS) == "linux" ){
		return "linux";
	}else{
		if( substr( strtolower(PHP_OS) , 0 , 3 ) == "win" ){
			return "windows";
		}else{
			echo "not support os " . PHP_OS ;
			die;
		}
	}
}//get OS 

function getNumber($number){
	if( is_numeric( $number ) ){
		return $number;
	}else{
		echo "\n Vui lòng nhập số ! \n ";
		die;
	}
}//getNumber
	// -------------------------------------------- end functions ----------------------------------------------------------