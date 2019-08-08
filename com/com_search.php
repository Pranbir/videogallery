<?php  //Global query options
$key = toDb(token());
//$key = stripslashes($key);
//die($key);
//error_reporting(1);
$ntype = _get('type');

if(not_empty($ntype)){
	switch ($ntype) {
	case 'picture':
    redirect(site_url().imgsearch.'/'.$key);
    break;	
	case 'channel':
    redirect(site_url().pplsearch.'/'.$key);
    break;	
	case 'playlist':
    redirect(site_url().playlistsearch.'/'.$key);
    break;	
		
	}
	
}

if(not_empty($ntype) && trim($ntype)=="time_range"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	if(!isset($timeArray[0]) || $timeArray[0]==""){$timeArray[0] = date("Y-m-d H:i:s");}
	
	if(!isset($timeArray[1]) || $timeArray[1] == ""){$timeArray[1] = date("Y-m-d H:i:s");}
	
	$heading = "From : ".$timeArray[0]." to ".$timeArray[1];	
	//$heading = "YYUYU";	
}

else if(not_empty($ntype) && trim($ntype)=="time_range_loc"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	if(!isset($timeArray[0]) || $timeArray[0]==""){$timeArray[0] = date("Y-m-d H:i:s");}
	
	if(!isset($timeArray[1]) || $timeArray[1] == ""){$timeArray[1] = date("Y-m-d H:i:s");}
	if(!isset($timeArray[2]) || $timeArray[2] == ""){$timeArray[2] = "";}
	
	$heading = "From : ".$timeArray[0]." to ".$timeArray[1].". <br>Location search string : ".$timeArray[2];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="ware_door"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	$heading = "Search string Warehouse: ".$timeArray[2]."/Door : ".$timeArray[1];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="ware"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	$heading = "Search string Warehouse: ".$timeArray[1];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="time_range_ware_door"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	if(!isset($timeArray[0]) || $timeArray[0]==""){$timeArray[0] = date("Y-m-d H:i:s");}
	
	if(!isset($timeArray[1]) || $timeArray[1] == ""){$timeArray[1] = date("Y-m-d H:i:s");}
	if(!isset($timeArray[2]) || $timeArray[2] == ""){$timeArray[2] = "";}
	
	$heading = "From : ".$timeArray[0]." to ".$timeArray[1].". <br>Search string Warehouse: ".$timeArray[4]."/Door : ".$timeArray[3];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="time_range_ware"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	if(!isset($timeArray[0]) || $timeArray[0]==""){$timeArray[0] = date("Y-m-d H:i:s");}
	
	if(!isset($timeArray[1]) || $timeArray[1] == ""){$timeArray[1] = date("Y-m-d H:i:s");}
	if(!isset($timeArray[2]) || $timeArray[2] == ""){$timeArray[2] = "";}
	
	$heading = "From : ".$timeArray[0]." to ".$timeArray[1].". <br>Warehouse search string : ".$timeArray[3];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="ware_door_load"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	$heading = "Warehouse search string : ".$timeArray[2]." / Door No.: ".$timeArray[1]." / Load No.: ".$timeArray[3];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="ware_load"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	$heading = "Warehouse search string : ".$timeArray[1]." / Load no.:".$timeArray[2];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="time_range_ware_door_load"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	if(!isset($timeArray[0]) || $timeArray[0]==""){$timeArray[0] = date("Y-m-d H:i:s");}
	
	if(!isset($timeArray[1]) || $timeArray[1] == ""){$timeArray[1] = date("Y-m-d H:i:s");}
	if(!isset($timeArray[2]) || $timeArray[2] == ""){$timeArray[2] = "";}
	
	$heading = "From : ".$timeArray[0]." to ".$timeArray[1].". <br>Warehouse search string : ".$timeArray[4]." / Door No.: ".$timeArray[3]." / Load No.: ".$timeArray[5];	
	//$heading = "YYUYU";	
}else if(not_empty($ntype) && trim($ntype)=="time_range_ware_load"){
	//echo $key;
	$s = $key;
	$s = str_replace("+" , " " , $s);
	$timeArray = explode("|",$s);
	
	if(!isset($timeArray[0]) || $timeArray[0]==""){$timeArray[0] = date("Y-m-d H:i:s");}
	
	if(!isset($timeArray[1]) || $timeArray[1] == ""){$timeArray[1] = date("Y-m-d H:i:s");}
	if(!isset($timeArray[2]) || $timeArray[2] == ""){$timeArray[2] = "";}
	
	$heading = "From : ".$timeArray[0]." to ".$timeArray[1].". <br>Warehouse search string : ".$timeArray[3]." / Load No.: ".$timeArray[4];	
	//$heading = "YYUYU";	
}
else if (not_empty($ntype) && trim($ntype)=="location"){	
	$heading = _lang('Location : ').ucfirst(str_replace(array("+","-")," ",$key));	
}
else if (not_empty($ntype) && trim($ntype)=="load"){	
	$heading = _lang('Load number : ').ucfirst(str_replace(array("+","-")," ",$key));	
}
else if (not_empty($ntype) && trim($ntype)=="item"){
	$heading = _lang('Item number : ').ucfirst(str_replace(array("+","-")," ",$key));		
}
else if (not_empty($ntype) && trim($ntype)=="comment"){
	$heading = _lang('Comment : ').ucfirst(str_replace(array("+","-")," ",$key));		
}
else{
	$heading = _lang('#').ucfirst(str_replace(array("+","-")," ",$key));	
}

$heading_plus = ('Video search results for ').$key;
if(not_empty($key)) {
$interval = '';
//Check for sorting 
if(_get('sort'))
{
switch(_get('sort')){
case "w":
$interval = "AND WEEK( DATE ) = WEEK( CURDATE( ) ) ";
break;
case "m":
$interval = "AND MONTH(date) = MONTH(CURDATE( ))";
break;
case "y":
$interval = "AND YEAR( DATE ) = YEAR( CURDATE( ) ) ";
break;
}
}
//Remove url format
$key = str_replace(array("-","+")," ",$key);
$nkey = str_replace(" ", "_",$key);
$mkey = str_replace(" ", "-",$key);
$or_key = explode(",", $key);
//echo count($or_key).'<br>';
$or_count = 1;
$merged_query = '';
foreach($or_key as $or){
	//echo '<br>'.$or;
	$and_key = explode(" ", trim($or));
	$and_count = 1;
	foreach($and_key as $and){
		//echo '<br>';
		//echo trim($and);
		$merged_query .= "(";
		$merged_query .= DB_PREFIX."videos.title like '%".$and."%' OR ";
		$merged_query .= DB_PREFIX."videos.description like '%".$and."%' OR ";
		$merged_query .= DB_PREFIX."videos.comment like '%".$and."%' OR ";
		$merged_query .= DB_PREFIX."videos.door like '%".$and."%' OR ";
		$merged_query .= DB_PREFIX."videos.warehouse like '%".$and."%' OR ";
		$merged_query .= DB_PREFIX."videos.description like '%".$and."%' OR ";
		$merged_query .= DB_PREFIX."warehouses.title like '%".$and."%' OR ";
		$merged_query .= "(CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$and%')";		
		$merged_query .= ")";
		if($and_count < count($and_key)){
			//echo ' && ';
			$merged_query .= " AND ";
			//echo "<br>";
		}
		$and_count = $and_count+1;
	}
	if($or_count < count($or_key)){
		//echo ' || ';
		$merged_query .= " OR ";
		//echo "<br>";
	}
	
$or_count = $or_count+1;
	
}
//echo $merged_query;

$options = DB_PREFIX."videos.id,".DB_PREFIX."videos.description,".DB_PREFIX."videos.title, ".DB_PREFIX."videos.date,".DB_PREFIX."videos.user_id,".DB_PREFIX."videos.thumb,".DB_PREFIX."videos.views,".DB_PREFIX."videos.liked,".DB_PREFIX."videos.duration,".DB_PREFIX."videos.nsfw,".DB_PREFIX."videos.start_date_time,".DB_PREFIX."videos.end_date_time,".DB_PREFIX."videos.warehouse,".DB_PREFIX."videos.door,".DB_PREFIX."videos.comment,".DB_PREFIX."videos.groupid";
 /* If 3 letter word */
 

 if($_SESSION['group'] == 1){
	if((strlen($key) < 0) /* || (get_option("searchmode",1) == 1) */) {
		$vq = "select ".$options.", ".DB_PREFIX."users.name as owner,".DB_PREFIX."users.group_id FROM ".DB_PREFIX."videos,".DB_PREFIX."warehouses.title as warehouse_title 
		LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
		LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
		WHERE (".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() and ( ".DB_PREFIX."videos.title like '%".$key."%' or ".DB_PREFIX."videos.title like '%".$nkey."%' or ".DB_PREFIX."videos.title like '%".$mkey."%' or ".DB_PREFIX."videos.description like '%".$key."%' or ".DB_PREFIX."videos.tags like '%".$key."%' ) ".$interval."
		)
			  ORDER BY CASE WHEN ".DB_PREFIX."videos.title like '" .$key. "%' THEN 0
					  WHEN ".DB_PREFIX."videos.title like '%" .$key. "%' THEN 1
					  WHEN ".DB_PREFIX."videos.tags like '" .$key. "%' THEN 2
					  WHEN ".DB_PREFIX."videos.tags like '%" .$key. "%' THEN 3		   
					  WHEN ".DB_PREFIX."videos.description like '%" .$key. "%' THEN 4
					  WHEN ".DB_PREFIX."videos.tags like '%" .$key. "%' THEN 5
					  ELSE 6
				 END, title ".this_limit();
		} else {
			
			   //############################
			   if(not_empty($ntype)){
				   switch (trim($ntype)) {
				   case 'location':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
					   MATCH (location) AGAINST ('".$key."' IN BOOLEAN MODE) AS location_relevance,".DB_PREFIX."warehouses.title as warehouse_title 
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (LOCATION LIKE '%$key%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date,location_relevance DESC ".this_limit();
				   break;	
				   case 'load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
					   MATCH (load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) AGAINST ('".$key."' IN BOOLEAN MODE) AS load_relevance,".DB_PREFIX."warehouses.title as warehouse_title 
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE ((CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$key%' ) 
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date,load_relevance DESC ".this_limit();
						   
				   break;	
				   case 'item':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id FROM ".DB_PREFIX."videos 
				   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
				   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
				   WHERE (item LIKE '%$key%' AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval 
				   )
				   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   break;
				   case 'comment':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
					   MATCH (comment) AGAINST ('".$key."' IN BOOLEAN MODE) AS comment_relevance,".DB_PREFIX."warehouses.title as warehouse_title FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   (comment LIKE '%$key%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date,comment_relevance DESC ".this_limit();
				   break;
				   case 'time_range':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]' 
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval 
						   )
						   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_loc':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND LOCATION LIKE '%$timeArray[2]%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware_door':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (WAREHOUSE LIKE '%$timeArray[0]%' AND DOOR = $timeArray[1]
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (WAREHOUSE LIKE '%$timeArray[0]%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_ware_door':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%' AND DOOR = $timeArray[3]
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_ware':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware_door_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (WAREHOUSE LIKE '%$timeArray[0]%' AND DOOR = $timeArray[1] AND
					   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[3]%' )
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (WAREHOUSE LIKE '%$timeArray[0]%' AND
					   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[2]%' )
	   
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_ware_door_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%' AND DOOR = $timeArray[3] AND
						   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[5]%' )
	   
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval 
						   )
						   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   
						   //die($vq);
				   break;
				   case 'time_range_ware_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%' AND
						   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[4]%' )
	   
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
						   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   default:
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner,".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title FROM ".DB_PREFIX."videos 
				   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
				   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
		   WHERE (".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() and ( ".$merged_query." ) 
		   or (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$key%' )".$interval."
			  )ORDER BY title ".this_limit();
				   //die($vq);
				   break;
					   
				   }
				   
			   }
			   else{
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
	   MATCH (title,description,tags) AGAINST ('".$key."' IN BOOLEAN MODE) AS relevance,
	   MATCH (title) AGAINST ('".$key."' IN BOOLEAN MODE) AS title_relevance FROM ".DB_PREFIX."videos LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
		   WHERE (MATCH (title,description,tags) AGAINST('".$key."' IN BOOLEAN MODE) AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval) ORDER by title_relevance DESC,relevance DESC ".this_limit();
			   }
			   
			   //die($vq);
			   
			   //###############################
			   
		/* Use full search */	 
	   /* $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
	   MATCH (title,description,tags) AGAINST ('".$key."' IN BOOLEAN MODE) AS relevance,
	   MATCH (title) AGAINST ('".$key."' IN BOOLEAN MODE) AS title_relevance FROM ".DB_PREFIX."videos LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
		   WHERE MATCH (title,description,tags) AGAINST('".$key."' IN BOOLEAN MODE) AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval ORDER by title_relevance DESC,relevance DESC ".this_limit();
		 */
		
		}
 }else{
	if((strlen($key) < 0) /* || (get_option("searchmode",1) == 1) */) {
		$vq = "select ".$options.", ".DB_PREFIX."users.name as owner,".DB_PREFIX."users.group_id FROM ".DB_PREFIX."videos,".DB_PREFIX."warehouses.title as warehouse_title 
		LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
		LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
		WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
		(".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() and ( ".DB_PREFIX."videos.title like '%".$key."%' or ".DB_PREFIX."videos.title like '%".$nkey."%' or ".DB_PREFIX."videos.title like '%".$mkey."%' or ".DB_PREFIX."videos.description like '%".$key."%' or ".DB_PREFIX."videos.tags like '%".$key."%' ) ".$interval."
		)
			  ORDER BY CASE WHEN ".DB_PREFIX."videos.title like '" .$key. "%' THEN 0
					  WHEN ".DB_PREFIX."videos.title like '%" .$key. "%' THEN 1
					  WHEN ".DB_PREFIX."videos.tags like '" .$key. "%' THEN 2
					  WHEN ".DB_PREFIX."videos.tags like '%" .$key. "%' THEN 3		   
					  WHEN ".DB_PREFIX."videos.description like '%" .$key. "%' THEN 4
					  WHEN ".DB_PREFIX."videos.tags like '%" .$key. "%' THEN 5
					  ELSE 6
				 END, title ".this_limit();
		} else {
			
			   //############################
			   if(not_empty($ntype)){
				   switch (trim($ntype)) {
				   case 'location':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
					   MATCH (location) AGAINST ('".$key."' IN BOOLEAN MODE) AS location_relevance,".DB_PREFIX."warehouses.title as warehouse_title 
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (LOCATION LIKE '%$key%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date,location_relevance DESC ".this_limit();
				   break;	
				   case 'load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
					   MATCH (load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) AGAINST ('".$key."' IN BOOLEAN MODE) AS load_relevance,".DB_PREFIX."warehouses.title as warehouse_title 
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and ((CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$key%' ) 
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date,load_relevance DESC ".this_limit();
						   
				   break;	
				   case 'item':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id FROM ".DB_PREFIX."videos 
				   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
				   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
				   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and (item LIKE '%$key%' AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval 
				   )
				   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   break;
				   case 'comment':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
					   MATCH (comment) AGAINST ('".$key."' IN BOOLEAN MODE) AS comment_relevance,".DB_PREFIX."warehouses.title as warehouse_title FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and (comment LIKE '%$key%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date,comment_relevance DESC ".this_limit();
				   break;
				   case 'time_range':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]' 
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval 
						   )
						   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_loc':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND LOCATION LIKE '%$timeArray[2]%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware_door':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (WAREHOUSE LIKE '%$timeArray[0]%' AND DOOR = $timeArray[1]
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (WAREHOUSE LIKE '%$timeArray[0]%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_ware_door':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group']." )and 
					   (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%' AND DOOR = $timeArray[3]
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_ware':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%'
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware_door_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (WAREHOUSE LIKE '%$timeArray[0]%' AND DOOR = $timeArray[1] AND
					   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[3]%' )
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'ware_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (WAREHOUSE LIKE '%$timeArray[0]%' AND
					   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[2]%' )
	   
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
							ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   case 'time_range_ware_door_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%' AND DOOR = $timeArray[3] AND
						   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[5]%' )
	   
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval 
						   )
						   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   
						   //die($vq);
				   break;
				   case 'time_range_ware_load':
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title
					   FROM ".DB_PREFIX."videos 
					   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
					   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
					   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
					   (start_date_time BETWEEN '$timeArray[0]' AND '$timeArray[1]'
						   AND WAREHOUSE LIKE '%$timeArray[2]%' AND
						   (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$timeArray[4]%' )
	   
						   AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval
						   )
						   ORDER by ".DB_PREFIX."videos.date ".this_limit();
				   //die($vq);
				   break;
				   default:
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner,".DB_PREFIX."users.group_id,".DB_PREFIX."warehouses.title as warehouse_title FROM ".DB_PREFIX."videos 
				   LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
				   LEFT JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."videos.warehouse = ".DB_PREFIX."warehouses.id
		   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and 
		   (".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() and ( ".$merged_query." ) 
		   or (CONCAT_WS('',load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8,load_9,load_10,load_11,load_12,load_13,load_14,load_15,load_16,load_17,load_18,load_19,load_20) LIKE '%$key%' )".$interval."
			  )ORDER BY title ".this_limit();
				   //die($vq);
				   break;
					   
				   }
				   
			   }
			   else{
				   $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
	   MATCH (title,description,tags) AGAINST ('".$key."' IN BOOLEAN MODE) AS relevance,
	   MATCH (title) AGAINST ('".$key."' IN BOOLEAN MODE) AS title_relevance FROM ".DB_PREFIX."videos LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
		   WHERE (".DB_PREFIX."videos.groupid = ".$_SESSION['group'].") and (MATCH (title,description,tags) AGAINST('".$key."' IN BOOLEAN MODE) AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval) ORDER by title_relevance DESC,relevance DESC ".this_limit();
			   }
			   
			   //die($vq);
			   
			   //###############################
			   
		/* Use full search */	 
	   /* $vq = "select ".$options.", ".DB_PREFIX."users.name as owner, ".DB_PREFIX."users.group_id,
	   MATCH (title,description,tags) AGAINST ('".$key."' IN BOOLEAN MODE) AS relevance,
	   MATCH (title) AGAINST ('".$key."' IN BOOLEAN MODE) AS title_relevance FROM ".DB_PREFIX."videos LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
		   WHERE MATCH (title,description,tags) AGAINST('".$key."' IN BOOLEAN MODE) AND ".DB_PREFIX."videos.pub > 0 and ".DB_PREFIX."videos.date < now() $interval ORDER by title_relevance DESC,relevance DESC ".this_limit();
		 */
		
		}
 }
 	
// Canonical url
if(_get('sort')) {
$canonical = site_url().show.url_split.str_replace(array(" "),array("-"),$key)."&sort="._get('sort'); 
} else {
$canonical = site_url().show.url_split.str_replace(array(" "),array("-"),$key);	
}

} else {
$vq = '';
}	
// SEO Filters
function modify_title( $text ) {
global $heading;
    return strip_tags(stripslashes($heading));
}
function modify_desc( $text ) {
global $heading_plus;
    return _cut(strip_tags(stripslashes($heading_plus)), 160);
}
add_filter( 'phpvibe_title', 'modify_title' );
add_filter( 'phpvibe_desc', 'modify_desc' );
//Time for design
if (!is_ajax_call()) {  the_header(); the_sidebar(); }
include_once(TPL.'/searchresults.php');
if (!is_ajax_call()) { the_footer(); }
?>