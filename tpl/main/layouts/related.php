<?php $seenvids = array();
$hs = uHistory();
if(not_empty($hs)) {
$seenvids = @explode(',',uHistory());	
}
$seened = $video->id;

$seened = rtrim($seened, ",");
$noseen = "AND ".DB_PREFIX."videos.id not in (".$seened.")";
if(get_option('RelatedSource','0') == 1) {
$result = $cachedb->get_results("SELECT ".DB_PREFIX."videos.title,".DB_PREFIX."videos.id as vid,".DB_PREFIX."videos.thumb, ".DB_PREFIX."videos.views,".DB_PREFIX."videos.duration,".DB_PREFIX."users.name, ".DB_PREFIX."users.id as owner, ".DB_PREFIX."users.group_id  FROM ".DB_PREFIX."videos LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id where ".DB_PREFIX."videos.category ='".$video->category."' and ".DB_PREFIX."videos.pub > 0 ".$noseen." and ".DB_PREFIX."videos.media = '".$video->media."'  ORDER BY ".DB_PREFIX."videos.id DESC limit 0,".get_option('related-nr')." ");
} else {
$pieces = array_filter(explode(" ",removeCommonWords($video->title)));
$pieces2 = array_filter(explode(",",removeCommonWords($video->tags)));
$pieces = array_merge($pieces, $pieces2);
$par = array();
$par[] = removeCommonWords($video->title);
foreach($pieces as $p) {
if(strlen($p) > 2){	
if(strlen($p) < 4){
$par[] = $p.'*';	
} else {
$par[] = $p;	
}	
}
}	
$key = 	toDb(implode(",",$par));
$options = DB_PREFIX."videos.id as vid,".DB_PREFIX."videos.title,".DB_PREFIX."videos.user_id as owner,".DB_PREFIX."videos.thumb,".DB_PREFIX."videos.views,".DB_PREFIX."videos.duration";
$vq = "select ".$options.", ".DB_PREFIX."users.name , ".DB_PREFIX."users.group_id ,
MATCH (title,description,tags) AGAINST ('".$key."' IN BOOLEAN MODE) AS relevance,
MATCH (title) AGAINST ('".$key."' IN BOOLEAN MODE) AS title_relevance FROM ".DB_PREFIX."videos LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id 
	WHERE MATCH (title,description,tags) AGAINST('".$key."' IN BOOLEAN MODE) AND ".DB_PREFIX."videos.pub > 0 AND ".DB_PREFIX."videos.media = '".$video->media."' ".$noseen." ORDER by title_relevance DESC,relevance DESC limit 0,".get_option('related-nr',12)." ";
	$result = $cachedb->get_results($vq);
}
$firstseen = false;
$fsc = 1;
if ($result) {	
	foreach ($result as $related) {
	
	$watched = (in_array($related->vid,$seenvids)) ? '<span class="vSeen">'._lang("Watched").'</span>' : '';
	$watchedcls = (in_array($related->vid,$seenvids)) ? 'beenSeen' : '';
	if(($fsc < 2 ) && !in_array($related->vid,$seenvids)) {
	$fsc++; /* Count only not seened */
	$firstseen = true;
	$watchedcls = 'AutoplHold';
	}	
	$duration = ($related->duration > 0) ? video_time($related->duration) : '<i class="material-icons">&#xE439;</i>';
	if(isset($related->group_id)) { $grcreative= group_creative($related->group_id); } else { $grcreative=''; };
	$wlater = (is_user()) ? '<a class="laterit" title="'._lang("Add to watch later").'" href="javascript:Padd('.$related->vid.', '.later_playlist().')"><i class="material-icons">&#xE924;</i></a>' : '';
    $autoplay = (isset($_SESSION['autoplayoff'])) ? '' : 'checked';
	$goplaynext = (isset($_SESSION['autoplayoff'])) ? 'noautoplay' : 'autoplay';
	echo '
	<li data-id="'.$related->vid.'" class="item-post '.$watchedcls.'">';
	if(($firstseen) && (get_option('autoplay',1) ==1) && !has_list() ) {
	echo '<div id="'.$goplaynext.'" class="PlayUP block text-right">
	<div class="pull-left text-left inline-block media-middle">
	<strong style="line-height:45px">'._lang('Next play:').' </strong>
	</div>
	<div class="pull-right text-left inline-block media-middle">
	
	<a href="javascript:void(0)" class="tipS text-uppercase" data-placement="left" title="'._lang("Autoplay will start the next video automatically").'">
	'._lang('Autoplay').' 
	</a>
		<div class="checkbox-custom checkbox-primary inline-block mleft10">
		 <input type="checkbox" name="autoplay" id="autoplayHandler" '.$autoplay.'>
		 <label></label> 
		 </div>
    </div>
	</div>';	
	}
	echo '<div class="inner">					
					<div class="thumb">
						<a class="clip-link" data-id="'.$related->vid.'" title="'._html($related->title).'" href="'.video_url($related->vid , $related->title).'">
							<span class="clip">
								<img src="'.thumb_fix($related->thumb, true, 100, 64).'" alt="'._html($related->title).'" /><span class="vertical-align"></span>
							</span>
						<span class="timer">'.$duration.'</span>					
							<span class="overlay"></span>
						</a>'.$wlater.$watched.'
					</div>			
					<div class="data">
						<span class="title"><a href="'.video_url($related->vid , $related->title).'" rel="bookmark" class="tipS" title="'._html($related->title).'" data-placement="bottom">'._cut(_html($related->title),154 ).'</a></span>
			
						<span class="usermeta">
							'._lang('by').' <a href="'.profile_url($related->owner, $related->name).'"> '._html($related->name).' </a> '.$grcreative.'
							<p>'.number_format($related->views).' '._lang('views').'</p>
						</span>
					</div>
				</div>
				</li>
	';
	$firstseen = false;
	}
}

?>