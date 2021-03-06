<?php  //Global query options
$key = toDb(token());
$ps = site_url().playlistsearch.'/'.$key.'/?p=';
$key = str_replace(array("-","+")," ",$key);	
	

$pl_heading = '';
if($key == 1){
    $pl_heading = _lang('Playlists by').' '.'Warehouse';
}else if($key == 2){
    $pl_heading = _lang('Playlists by').' '.'Date of Recording';
}
$heading = $pl_heading;
if($_SESSION['group'] == 1){
    $count = $db->get_row("Select count(*) as nr from ".DB_PREFIX."playlists WHERE (type like '%" .$key. "%' or description like '%" .$key. "%' ) and (picture not in ('[likes]','[history]','[later]') or picture is null and ptype <> 2)");
    $playlists = $db->get_results("select ".DB_PREFIX."playlists.*, ".DB_PREFIX."users.name as user,
    ".DB_PREFIX."warehouses.title from ".DB_PREFIX."playlists LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."playlists.owner = ".DB_PREFIX."users.id
    JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."playlists.title = ".DB_PREFIX."warehouses.location
    WHERE (".DB_PREFIX."playlists.type like '%" .$key. "%' or ".DB_PREFIX."playlists.description like '%" .$key. "%' ) and (".DB_PREFIX."playlists.picture not in ('[likes]','[history]','[later]') or ".DB_PREFIX."playlists.picture is null) and (".DB_PREFIX."playlists.ptype <> 2) order by views DESC ".this_limit()."");
    
}else{
    $count = $db->get_row("Select count(*) as nr from ".DB_PREFIX."playlists WHERE (".DB_PREFIX."playlists.groupid = ".$_SESSION['group'].") and (type like '%" .$key. "%' or description like '%" .$key. "%' ) and (picture not in ('[likes]','[history]','[later]') or picture is null and ptype <> 2)");
    $playlists = $db->get_results("select ".DB_PREFIX."playlists.*, ".DB_PREFIX."users.name as user,
    ".DB_PREFIX."warehouses.title from ".DB_PREFIX."playlists LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."playlists.owner = ".DB_PREFIX."users.id
    JOIN ".DB_PREFIX."warehouses ON ".DB_PREFIX."playlists.title = ".DB_PREFIX."warehouses.location
    WHERE (".DB_PREFIX."playlists.groupid = ".$_SESSION['group'].") and (".DB_PREFIX."playlists.type like '%" .$key. "%' or ".DB_PREFIX."playlists.description like '%" .$key. "%' ) and (".DB_PREFIX."playlists.picture not in ('[likes]','[history]','[later]') or ".DB_PREFIX."playlists.picture is null) and (".DB_PREFIX."playlists.ptype <> 2) order by views DESC ".this_limit()."");
    
}

/*
$count = $db->get_row("Select count(*) as nr from ".DB_PREFIX."playlists WHERE (title like '%" .$key. "%' or description like '%" .$key. "%' ) and (picture not in ('[likes]','[history]','[later]') or picture is null and ptype <> 2)");
$playlists = $db->get_results("select ".DB_PREFIX."playlists.*, ".DB_PREFIX."users.name as user from ".DB_PREFIX."playlists LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."playlists.owner = ".DB_PREFIX."users.id WHERE (".DB_PREFIX."playlists.title like '%" .$key. "%' or ".DB_PREFIX."playlists.description like '%" .$key. "%' ) and (".DB_PREFIX."playlists.picture not in ('[likes]','[history]','[later]') or ".DB_PREFIX."playlists.picture is null) and (".DB_PREFIX."playlists.ptype <> 2) order by views DESC ".this_limit()."");
*/
if($playlists) {
/*Count videos */	
$entries = array();	
$counter = $cachedb->get_results("SELECT COUNT(*) AS entries, playlist FROM  ".DB_PREFIX."playlist_data GROUP BY playlist LIMIT 0 , 30000");
if($counter){
foreach($counter as $c)	{
$entries[$c->playlist] = $c->entries;
}	
}
}

$a = new pagination;	
$a->set_current(this_page());
$a->set_first_page(true);
$a->set_pages_items(7);
$a->set_per_page(bpp());
$a->set_values($count->nr);
// SEO Filters
$loc = 'Location';
function modify_title( $text ) {
global $heading;
    return strip_tags(stripslashes($heading));
}
function modify_desc( $text ) {
global $heading;
    return _cut(strip_tags(stripslashes($heading)), 160);
}
add_filter( 'phpvibe_title', 'modify_title' );
add_filter( 'phpvibe_desc', 'modify_desc' );
//Time for design
if (!is_ajax_call()) {  the_header(); the_sidebar(); }
include_once(TPL.'/playlists.php');
if (!is_ajax_call()) { the_footer(); }
?>