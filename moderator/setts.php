<?php if(isset($_GET['ac']) && $_GET['ac'] ="remove-logo"){
update_option('site-logo', '');
 $db->clean_cache();
}
if(isset($_POST['update_options_now'])){
foreach($_POST as $key=>$value)
{
if($key !== "site-logo") {
  update_option($key, $value);
}
}
  echo '<div class="msg-info">Configuration options have been updated.</div>';

//Set logo
if(isset($_FILES['site-logo']) && !empty($_FILES['site-logo']['name'])){
$extension = end(explode('.', $_FILES['site-logo']['name']));
$thumb = ABSPATH.'/storage/uploads/'.nice_url($_FILES['site-logo']['name']).uniqid().'.'.$extension;
if (move_uploaded_file($_FILES['site-logo']['tmp_name'], $thumb)) {
     $sthumb = str_replace(ABSPATH.'/' ,'',$thumb);
    update_option('site-logo', $sthumb);
	  //$db->clean_cache();
	} else {
	echo '<div class="msg-warning">Logo upload failed.</div>';
	}
	
}
  $db->clean_cache();
}
$all_options = get_all_options();
?>

<div class="row row-setts">
<h3>Settings</h3>
<form id="validate" class="form-horizontal styled" action="<?php echo admin_url('setts');?>" enctype="multipart/form-data" method="post">

<input type="hidden" name="update_options_now" class="hide" value="1" />
<div class="row"> 
<div class="col-md-6 col-xs-12"> 		
<div class="form-group form-material">
<label class="control-label"><i class="icon-pencil"></i>Website Name</label>
<div class="controls">
<input type="text" name="site-logo-text" class="col-md-12" value="<?php echo get_option('site-logo-text'); ?>" /> 						
<span class="help-block" id="limit-text">Global site name. Also see <a href="<?php echo admin_url('seo'); ?>">SEO Setts</a> for titles.</span>
</div>	
</div>
</div>	
<div class="col-md-6 col-xs-12"> 
<p class="control-label text-left">Website Logo</p>
<div class="form-group form-material form-material-file">
<input type="text" class="form-control empty" readonly="" />
<input type="file" id="site-logo" name="site-logo" class="styled" />
<label class="floating-label">Browse...</label>
</div>
<div class="controls">
<span class="help-block" id="limit-text">If used, replaces the default text logo with this image.</span>
<?php if(get_option('site-logo')) { ?><p><img src="<?php echo thumb_fix(get_option('site-logo')); ?>"/> <br /> <a href="<?php echo admin_url('setts');?>&ac=remove-logo">Remove</a></p><?php } ?>
</div>	
</div>

</div>
<div class="row"> 
<div class="col-md-4 col-xs-12"> 
<div class="form-group form-material">
<label class="control-label"><i class="icon-th-list"></i>Site Theme</label>
<div class="controls">
<select placeholder="Select theme:" name="theme" class="select ">
<?php $directories = glob(ABSPATH.'/tpl' . '/*' , GLOB_ONLYDIR);
foreach($directories as $dir){
$dir = explode('/',$dir);
$dir= end($dir);	
$checkd =(get_option('theme','main') == $dir)? 'selected' : '';	
echo '<option value="'.$dir.'" '.$checkd.'>'.$dir.'</option>';	
}

?>
</select>
</div>	
</div>	
</div>	
<div class="col-md-offset-2 col-md-6 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-lock"></i>Maintainance</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="site-offline" class="styled" value="1" <?php if(get_option('site-offline', 0) == 1 ) { echo "checked"; } ?>>On</label>
	<label class="radio inline"><input type="radio" name="site-offline" class="styled" value="0" <?php if(get_option('site-offline', 0) <> 1 ) { echo "checked"; } ?>>Off</label>
	</div>
	</div>
	</div>
</div>

<h3>Media utils</h3>	
<div class="row"> 
<div class="col-md-4 col-xs-12"> 
<div class="form-group form-material">
<label class="control-label"><i class="icon-play-circle"></i>Global results per page</label>
<div class="controls">
<input type="text" name="bpp" class=" col-md-4" value="<?php echo get_option('bpp'); ?>" /> 
<span class="help-block" id="limit-text">Global number of elements (~videos) per page.</span>						
</div>	
</div>
</div>
</div>
<div class="row"> 
<div class="col-md-6 col-xs-12"> 
<div class="form-group form-material">
<label class="control-label"><i class="icon-arrows-h"></i>Thumbs resizing (Note: just image size, not container).</label>
 <div class="controls">
<div class="row">
<div class="col-md-6">
<input type="text" name="thumb-width" class="col-md-12" value="<?php echo get_option('thumb-width'); ?>"><span class="help-block">Default image <strong>resized width</strong> </span>
</div>
<div class="col-md-6">
<input type="text" name="thumb-height" class="col-md-12" value="<?php echo get_option('thumb-height'); ?>"><span class="help-block align-center">Default image <strong> resized height</strong></span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row"> 
<div class="col-md-6 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-film"></i>Related Videos Algorithm</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="RelatedSource" class="styled" value="1" <?php if(get_option('RelatedSource','0') == 1 ) { echo "checked"; } ?>>Same category</label>
	<label class="radio inline"><input type="radio" name="RelatedSource" class="styled" value="0" <?php if(get_option('RelatedSource','0') <> 1 ) { echo "checked"; } ?>> Similar names and text</label>
	<span class="help-block" id="limit-text">Choose what media shows as "Related".</span>						
	</div>
	</div>
	</div>
	<div class="col-md-6 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-film"></i>Related Videos Query </label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="ajaxyRel" class="styled" value="1" <?php if(get_option('ajaxyRel','1') == 1 ) { echo "checked"; } ?>>Ajax</label>
	<label class="radio inline"><input type="radio" name="ajaxyRel" class="styled" value="0" <?php if(get_option('ajaxyRel','1') <> 1 ) { echo "checked"; } ?>> In page</label>
	<span class="help-block" id="limit-text">Choose how related videos are queried.</span>						
	</div>
	</div>
</div>
</div>
<div class="row"> 
<div class="col-md-6 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-check-square"></i>Autoplay</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="autoplay" class="styled" value="1" <?php if(get_option('autoplay', 1) == 1 ) { echo "checked"; } ?>>On</label>
	<label class="radio inline"><input type="radio" name="autoplay" class="styled" value="0" <?php if(get_option('autoplay', 1) <> 1 ) { echo "checked"; } ?>>Off</label>
	</div>
	</div>
	</div>
<div class="col-md-6 col-xs-12"> 	
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-comments"></i>Comments</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="video-coms" class="styled" value="1" <?php if(get_option('video-coms') == 1 ) { echo "checked"; } ?>>Facebook</label>
	<label class="radio inline"><input type="radio" name="video-coms" class="styled" value="0" <?php if(get_option('video-coms') <> 1 ) { echo "checked"; } ?>>PHPVibe</label>
	<span class="help-block" id="limit-text">What comment system to use.</span>						
	</div>
	</div>
	</div>
	</div>
<h3>Branding</h3>
<div class="row"> 
<div class="col-md-6 col-xs-12"> 	
	<div class="form-group form-material">
<label class="control-label"><i class="icon-font"></i>Copyright</label>
<div class="controls">
<input type="text" name="site-copyright" class=" col-md-12" value="<?php echo get_option('site-copyright'); ?>" /> 
<span class="help-block" id="limit-text">Ex: &copy; 2013 <?php echo ucfirst(ltrim(cookiedomain(),".")); ?></span>						
</div>	
</div>	
</div>	
<div class="col-md-6 col-xs-12"> 
	<div class="form-group form-material">
<label class="control-label"><i class="icon-tint"></i>Custom licensing</label>
<div class="controls">
<input type="text" name="licto" class=" col-md-12" value="<?php echo get_option('licto'); ?>" /> 
<span class="help-block" id="limit-text">Ex: Licensed to <?php echo ucfirst(ltrim(cookiedomain(),".")); ?></span>						
</div>	
</div>
</div>	
</div>	
<div class="row"> 
<div class="col-md-6 col-xs-12"> 
<div class="form-group form-material">
	<label class="control-label"><i class="icon-bar-chart"></i>Tracking code</label>
	<div class="controls">
	<textarea id="googletracking" name="googletracking" class="auto col-md-12"><?php echo _pjs(get_option('googletracking')) ?></textarea>
	<span class="help-block" id="limit-text">Paste your full tracking code. For example Google Analytics</span>
	</div>
	</div>
	</div>
	</div>
<h3>Menus & Links</h3>	

<div class="row"> 
<div class="col-md-8 col-xs-12"> 
<div class="form-group form-material">
	<label class="control-label"><i class="icon-cloud-upload"></i>Show sharing menu to</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="upmenu" class="styled" value="1" <?php if(get_option('upmenu') == 1 ) { echo "checked"; } ?>>All registered users</label>
	<label class="radio inline"><input type="radio" name="upmenu" class="styled" value="0" <?php if(get_option('upmenu') <> 1 ) { echo "checked"; } ?>>Only moderators & administrators</label>
	</div>
	</div>
	</div>
<div class="col-md-4 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-reorder"></i>What's new menu</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="imagesmenu" class="styled" value="1" <?php if(get_option('imagesmenu') == 1 ) { echo "checked"; } ?>>Show</label>
	<label class="radio inline"><input type="radio" name="imagesmenu" class="styled" value="0" <?php if(get_option('imagesmenu') <> 1 ) { echo "checked"; } ?>>Hide</label>
	<span class="help-block" id="limit-text">Hides global activity menu</span>
	</div>
	</div>
	</div>
	</div>
	<div class="row"> 
<div class="col-md-4 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-reorder"></i>Playlists menu</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="showplaylists" class="styled" value="1" <?php if(get_option('showplaylists','1') == 1 ) { echo "checked"; } ?>>Show</label>
	<label class="radio inline"><input type="radio" name="showplaylists" class="styled" value="0" <?php if(get_option('showplaylists','1') <> 1 ) { echo "checked"; } ?>>Hide</label>
	</div>
	</div>
	</div>
<div class="col-md-4 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-reorder"></i>Channels menu</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="showusers" class="styled" value="1" <?php if(get_option('showusers','1') == 1 ) { echo "checked"; } ?>>Show</label>
	<label class="radio inline"><input type="radio" name="showusers" class="styled" value="0" <?php if(get_option('showusers','1') <> 1 ) { echo "checked"; } ?>>Hide</label>
	</div>
	</div>
	</div>

<div class="col-md-4 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-reorder"></i>Blog link</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="showblog" class="styled" value="1" <?php if(get_option('showblog','1') == 1 ) { echo "checked"; } ?>>Show</label>
	<label class="radio inline"><input type="radio" name="showblog" class="styled" value="0" <?php if(get_option('showblog','1') <> 1 ) { echo "checked"; } ?>>Hide</label>
	</div>
	</div>
	</div>
	</div>
	
<h3>Search stuff</h3>		
<div class="row">
<div class="col-md-6 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-at"></i>Search suggestions</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="youtube-suggest" class="styled" value="1" <?php if(get_option('youtube-suggest', 1) == 1 ) { echo "checked"; } ?>>On</label>
	<label class="radio inline"><input type="radio" name="youtube-suggest" class="styled" value="0" <?php if(get_option('youtube-suggest', 1) <> 1 ) { echo "checked"; } ?>>Off</label>
	<span class="help-block" id="limit-text">Youtube api suggestions for the search box </span>
	</div>
	</div>
	</div>
	<div class="col-md-6 col-xs-12"> 
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-check-square"></i>Search mode</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="searchmode" class="styled" value="1" <?php if(get_option('searchmode', 1) == 1 ) { echo "checked"; } ?>>Like / Compare</label>
	<label class="radio inline"><input type="radio" name="searchmode" class="styled" value="0" <?php if(get_option('searchmode', 1) <> 1 ) { echo "checked"; } ?>>Full Text</label>
	<span class="help-block" id="limit-text">Sql search mode</span>
	</div>
	</div>
	</div>
</div>	
<h3>Youtube API Settings</h3>	
<div class="form-group form-material">
<label class="control-label"><i class="icon-pencil"></i>Youtube key</label>
<div class="controls">
<input type="text" name="youtubekey" class="col-md-12" value="<?php echo get_option('youtubekey'); ?>" /> 						
<span class="help-block" id="limit-text">Your Youtube API  server key. See <a href="https://developers.google.com/youtube/registering_an_application" target="_blank">Google : Register your application</a>. </span>
</div>	
</div>	
<h3>Sharing</h3>
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-legal"></i>Shared video state </label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="videos-initial" class="styled" value="1" <?php if(get_option('videos-initial') == 1 ) { echo "checked"; } ?>>Published</label>
	<label class="radio inline"><input type="radio" name="videos-initial" class="styled" value="0" <?php if(get_option('videos-initial') == 0 ) { echo "checked"; } ?>>Unpublished</label>
	<span class="help-block" id="limit-text">Do you wish inserted videos to show on site immediately (Published) or hold them hidden until approval (Unpublished)? Note: <code>This applies to most if not all inserts!</code></span>
	</div>
	</div>
	<div class="form-group form-material">
	<label class="control-label"><i class="icon-edit"></i>Own video editing rule</label>
	<div class="controls">
	<label class="radio inline"><input type="radio" name="editrule" class="styled" value="1" <?php if(get_option('editrule') == 1 ) { echo "checked"; } ?>>Owner can edit</label>
	<label class="radio inline"><input type="radio" name="editrule" class="styled" value="0" <?php if(get_option('editrule') <> 1 ) { echo "checked"; } ?>>Only moderators and admins</label>
	</div>
	</div>	
<div class="row page-footer">
<button class="btn btn-large btn-primary pull-right" type="submit"><?php echo _lang("Update settings"); ?></button>	
</div>					
</form>
</div>
