<?php function youtubelinks($txt = '') {
return $txt.'
<li><a href="'.admin_url('yt').'"><i class="icon-youtube"></i>Youtube Importer</a></li>
';
}
add_filter('importers_menu', 'youtubelinks')

?>