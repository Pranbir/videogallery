<?php /* PHPVibe PRO v6's header */
//####################
// if(!is_user()){
  // redirect(site_url().'login/');	  
  // }
//###################  
  
register_style('phpvibe');
if(!is_home() && !is_video()) {
register_style('more');
}
register_style('bootstrap.min');
if(!is_home()) {
register_style('jssocials');
register_style('playerads');	
}
if(!is_video()) {
register_style('owl');
}
register_style('https://fonts.googleapis.com/css?family=Material+Icons|Roboto:300,400,500');
if(not_empty(get_option('rtl_langs',''))) {
//Rtl	
$lg = @explode(",",get_option('rtl_langs'));
if(in_array(current_lang(),$lg)) {	
	register_style('rtl');
}
}
function header_add(){
global $page;
$head = render_styles(0);
$head .= extra_css().'
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
if((typeof jQuery == "undefined") || !window.jQuery )
{
   var script = document.createElement("script");
   script.type = "text/javascript";
   script.src = "'.tpl().'styles/js/jquery.js";
   document.getElementsByTagName(\'head\')[0].appendChild(script);
}
var acanceltext = "'._lang("Cancel").'";
var startNextVideo,moveToNext,nextPlayUrl;
</script>
';
$head .=players_js();

$head .= '</head>
<body class="body-'.$page.'">
'.top_nav().'
<div id="wrapper" class="'.wrapper_class().' haside">
<div class="row block page p-'.$page.'">
';
return $head;
}

function meta_add(){
$meta = '<!doctype html> 
<html prefix="og: http://ogp.me/ns#" dir="ltr" lang="en-US">  
<head>  
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<title>'.seo_title().'</title>
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width,  height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<base href="'.site_url().'" />  
<meta name="description" content="'.seo_desc().'">
<meta name="generator" content="PHPVibe" />
<link rel="alternate" type="application/rss+xml" title="'.get_option('site-logo-text').' '._lang('All Media Feed').'" href="'.site_url().'feed/" />
<link rel="alternate" type="application/rss+xml" title="'.get_option('site-logo-text').' '._lang('Video Feed').'" href="'.site_url().'feed?m=1" />
<link rel="alternate" type="application/rss+xml" title="'.get_option('site-logo-text').' '._lang('Music Feed').'" href="'.site_url().'feed?m=2" />
<link rel="alternate" type="application/rss+xml" title="'.get_option('site-logo-text').' '._lang('Images Feed').'" href="'.site_url().'feed?m=3" />
<link rel="canonical" href="'.canonical().'" />
<meta property="og:site_name" content="'.get_option('site-logo-text').'" />
<meta property="fb:app_id" content="'.Fb_Key.'" />
<meta property="og:url" content="'.canonical().'" />
<link rel="apple-touch-icon" sizes="180x180" href="'.site_url().'lib/favicos/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="'.site_url().'lib/favicos/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="'.site_url().'lib/favicos/favicon-16x16.png">
<link rel="manifest" href="'.site_url().'lib/favicos/site.webmanifest">
<link rel="mask-icon" href="'.site_url().'lib/favicos/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="'.site_url().'lib/favicos/favicon.ico">
<meta name="msapplication-TileColor" content="#2b5797">
<meta name="msapplication-config" content="'.site_url().'lib/favicos/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
';
if(is_video()) {
global $video;

$meta .= '<meta property="og:video" content="'.$video->source.'">';

$meta .= '
<meta property="og:image" content="'.thumb_fix($video->thumb).'" />
<meta property="og:description" content="'.seo_desc().'"/>
<meta property="og:title" content="'._html($video->title).'" />
<meta property="og:type" content="video.other" />
<meta itemprop="name" content="'._html($video->title).'">
<meta itemprop="description" content="'.seo_desc().'">
<meta itemprop="image" content="'.thumb_fix($video->thumb).'">
<meta property="video:duration" content="'.$video->duration.'">
';
}


if(com() == profile) {
global $profile;
if(isset($profile) && $profile) {
$meta .= '
<meta property="og:image" content="'.thumb_fix($profile->avatar).'" />
<meta property="og:description" content="'.seo_desc().'"/>
<meta property="og:title" content="'._html($profile->name).'" />';
}
}
return $meta;
}

function top_nav(){
$nav = '';
$nav .= '
<div class="fixed-top" style="background: #011033 !important ;">
<div class="row block" style="position:relative;">
<div class="logo-wrapper">';    
$nav .= '<a id="show-sidebar" style="color:#d8d8d8;" href="javascript:void(0)" title="'._lang('Show sidebar').'"><i class="material-icons">&#xE5D2;</i></a>
<a href="'.site_url().'"  style="color:#d8d8d8;" title="" class="logo">'.show_logo().'</a>
<br style="clear:both;"/>
</div>		
<div class="header">
<div class="searchWidget">
<form action="" method="get" id="searchform" onsubmit="location.href=\''.site_url().show.'/\' + encodeURIComponent(this.tag.value).replace(/%20/g, \'+\') + \'?type=\' + encodeURIComponent(this.component.value).replace(/%20/g, \'+\'); return false;"';
if(get_option('youtube-suggest',1) > 0) { $nav .= 'autocomplete="off"'; }
$nav .= '> <div class="search-holder">
                    <span class="search-button">
					<button type="submit">
						<i class="material-icons">&#xE8B6;</i>
					</button>
					<a onClick="showDateTimePick();" style="display:none;
					background: none;
					border: 0;
					box-shadow: none;
					outline: 0;
					z-index: 12;
					font-size: 24px;
					line-height: 46px;
					padding: 0 17px;
					vertical-align: top;
					color: rgba(0,0,0,0.38);
					background-color: #FAFAFA;
					" id="time_rage_selector" class="btn legitRipple btn-md" >
						<i class="material-icons" style=" font-size: 10p;">&#xE05F;</i>
					</a>
					</span>
					<div class="search-target">
					<a id="switch-search" class="dropdown-toggle"  data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button"><i class="icon material-icons">&#xE63A;</i></a>
					<input type="text" id="switch-com" class="hide" name="component" value ="video">                
					<ul class="dropdown-menu dropdown-left bullet" role="menu">
					<li role="presentation"><a id="s-video" href="javascript:SearchSwitch(\'video\')"><i class="icon material-icons">&#xE63A;</i>'._lang("Any").'</a></li>
					
					<li role="presentation"><a id="s-location" href="javascript:SearchSwitch(\'location\')"><i class="icon material-icons">&#xE55A;</i>'._lang("Location").'</a></li>
					
					<li role="presentation"><a id="s-load" href="javascript:SearchSwitch(\'load\')"><i class="icon material-icons">&#xE63A;</i>'._lang("Load Number").'</a></li>
					
					<li role="presentation"><a id="s-item" href="javascript:SearchSwitch(\'item\')"><i class="icon material-icons">&#xE63A;</i>'._lang("Item Number").'</a></li>
					
					<li role="presentation"><a id="s-comment" href="javascript:SearchSwitch(\'comment\')"><i class="icon material-icons">&#xE05F;</i>'._lang("Comment").'</a></li>
					
					<li role="presentation"><a id="s-time_range" href="javascript:SearchSwitch(\'time_range\')"><i class="icon material-icons">&#xE05F;</i>'._lang("Time range").'</a></li>
					</ul>
					</div>
                    <div class="form-control-wrap">
                      <input type="text" class="form-control input-lg empty" name="tag" value ="" placeholder="'._lang("Search").'">                
                    </div>
                     </div>

				</form>
';
if(get_option('youtube-suggest',1) > 0) {
$nav .= '<div id="suggest-results"></div> ';
}
$nav .= '</div>
<div class="user-quick"><a data-target="#search-now" data-toggle="modal" href="javascript:void(0)" class="top-link" id="show-search"><i style="color:#d8d8d8;" class="material-icons">search</i></a>';
if(!is_user()) {
$nav .= '	
<a id="uploadNow" data-target="#login-now" data-toggle="modal" href="javascript:void(0)" class="top-link hideTheElement" title="'._lang("Login to upload").'">	<i class="material-icons">file_upload</i> </a> 
<a id="openusr" class="btn uav btn-small no-user"  href="javascript:showLogin()"
data-animation="scale-up" role="button" title="'._lang('Login').'">	
<img title="'._lang('Guest').'" data-name="'._lang('Guest').'" src="'.site_url().'storage/uploads/def-avatar.png" /> 
</a>
</div>
';
} else {
if((get_option('upmenu') == 1) ||  is_moderator()) {
$nav .= '<a id="uplBtn" href="'.site_url().share.'" class="top-link hideTheElement" title="'._lang('Upload video').'">	
<i class="material-icons">file_upload</i></a>';	
}
$nav .= '<a id="notifs" href="'.site_url().'dashboard/" class="top-link hideTheElement"><i class="icon material-icons">notifications</i></a>	
';
if(get_option('showusers','1') == 1 ) {
$nav .=  '<a class="top-link hideTheElement" href="'.site_url().members.'/"><i class="material-icons">&#xE1BD;</i></a>';
}

$force_left_='style=""';
if(basename($_SERVER['REQUEST_URI']) != ""){
$force_left_='style="left:-100px;"';
}

$nav .= '<a id="openusr" class="btn uav btn-small dropdown-toggle"  data-toggle="dropdown" href="#" aria-expanded="false"
data-animation="scale-up" role="button" title="'._lang('Dashboard').'">	
<img data-name="'.addslashes(user_name()).'" src="'.thumb_fix(user_avatar(), true, 35,35).'" /> 
</a>
<ul class="dropdown-menu dropdown-left" '.$force_left_.' role="menu">
<li role="presentation" class="drop-head">'.group_creative(user_group()).' <a href="'.profile_url(user_id(), user_name()).'"> '.user_name().' </a>
';

$nav .= '
</li>
<li class="divider" role="presentation"></li>';
$nav .= '<li class="my-buzz" role="presentation"><a href="'.site_url().'dashboard/"><i class="icon material-icons">&#xE031;</i> '. _lang('Media Studio').'</a> </li>
<li role="presentation"><a href="'.site_url().'dashboard/?sk=edit"><i class="icon material-icons">&#xE8B8;</i> '._lang("My Settings").'</a></li>
<li style="display:none;" role="presentation"> <a href="'.site_url().me.'"> <i class="icon material-icons">&#xE04A;</i> '._lang("My Videos").' </a>       </li>       
<li style="display:none;" class="my-inbox" role="presentation"><a href="'.site_url().'conversation/0/"><i class="icon material-icons">&#xE0C9;</i> '. _lang('Messages').'</a> </li>';
if(is_admin()){
$nav .= '
<li role="presentation"><a href="'.ADMINCP.'"><i class="icon material-icons">&#xE8A4;</i> '._lang("Administration").'</a></li>
';	
}
$nav .= '<li role="presentation" class="drop-footer"><a href="'.site_url().'index.php?action=logout"><i class="icon material-icons">&#xE14C;</i> '._lang("Logout").'</a></li>
</ul>
</div>
';
}
$nav .= '
</div>
</div>
</div>
';

$nav.= '<div id="dateTimePickModal" class="modal fade" role="dialog" style="top: 50px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose date and time</h4>
      </div>
      <div class="modal-body" style="background: #15254c;">
        <div class="form-group row">
			<label class="col-md-6 col-xs-12">Start Date : <input style="background: inherit;" id="dateTimePick_startDate" type="date" placeholder="Date" class="form-control"></label>
			<label class="col-md-6 col-xs-12"> Start time : <input style="background: inherit;" id="dateTimePick_startTime" type="time" class="form-control"></label>
			<label class="col-md-6 col-xs-12">End Date : <input style="background: inherit;" id="dateTimePick_endDate" type="date" placeholder="Date" class="form-control"></label>
			<label class="col-md-6 col-xs-12"> End time : <input style="background: inherit;" id="dateTimePick_endTime" type="time" class="form-control"></label>
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success legitRipple" onClick="generateDateTimeSearchValue();" >Submit</button>
        <button type="button" class="btn btn-danger btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';
return $nav;
}