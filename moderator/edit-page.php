<?php $pid = (isset($_POST["pid"])) ? $_POST["pid"] : intval($_GET['pid']);
if(isset($_POST['play-name'])) {
$picture ='';
$formInputName   = 'play-img';							# This is the name given to the form's file input
	$savePath	     = ABSPATH.'/storage/uploads';								# The folder to save the image
	$saveName        = md5(time()).'-'.user_id();									# Without ext
	$allowedExtArray = array('.jpg', '.png', '.gif');	# Set allowed file types
	$imageQuality    = 100;
$uploader = new FileUploader($formInputName, $savePath, $saveName , $allowedExtArray);
if ($uploader->getIsSuccessful()) {
//$uploader -> resizeImage(200, 200, 'crop');
$uploader -> saveImage($uploader->getTargetPath(), $imageQuality);
$thumb  = $uploader->getTargetPath();
$picture  = str_replace(ABSPATH.'/' ,'',$thumb);
} else { $picture = '';}
if(!nullval($picture)) { 
$db->query("UPDATE ".DB_PREFIX."pages SET pic ='".$picture."' WHERE pid = '".$pid."'");
}

$db->query("UPDATE ".DB_PREFIX."pages SET 
menu ='".intval($_POST['menu'])."', 
title ='".$db->escape($_POST['play-name'])."' ,
content ='".$db->escape(htmlentities($_POST['content']))."', 
tags ='".$db->escape($_POST['tags'])."' 
WHERE pid = '".$pid."'");
}
$page = $db->get_row("select * from ".DB_PREFIX."pages where pid = '".$pid."'");

?>
<div class="row">
<form id="validate" class="form-horizontal styled" action="<?php echo canonical();?>" enctype="multipart/form-data" method="post">
<fieldset>
<div class="form-group form-material">
<label class="control-label"><i class="icon-text-height"></i>Page title</label>
<div class="controls">
<input type="text" name="play-name" class="validate[required] col-md-12" value="<?php echo _html($page->title); ?>"/> 						
</div>	
</div>	
<div class="row">
<div class="col-md-4 col-xs-12">
<div class="form-group form-material">
	<label class="control-label"><i class="icon-check"></i>Show in menu?</label>
	<div class="controls">
		<label class="radio inline"><input type="radio" name="menu" class="styled" value="1" <?php if($page->menu == 1 ) { echo "checked"; } ?>>Yes</label>
	<label class="radio inline"><input type="radio" name="menu" class="styled" value="0" <?php if($page->menu == 0 ) { echo "checked"; } ?>>No</label>
	<span class="help-block" id="limit-text">Should this be visible in menus?</span>
	</div>
	</div>	
	</div>
<div class="col-md-4 col-xs-12">
<div class="form-group form-material">
<label class="control-label"><i class="icon-align-left"></i>Menu order</label>
<div class="controls">
<input type="text" name="m_order" value="<?php echo $page->m_order;?> " class="validate[required] col-md-12"/> 						
</div>	
</div>		
	</div>
	</div>
<div class="form-group form-material">
<label class="control-label">Page content</label>
<div class="controls">
<textarea rows="5" cols="5" name="content" class="ckeditor col-md-12" style="word-wrap: break-word; resize: horizontal; height: 88px;"><?php echo _html($page->content); ?></textarea>					
</div>	
</div>
<label class="control-label">Change the Image?</label>
<div class="form-group form-material form-material-file">

<div class="controls">
<input type="text" class="form-control empty" readonly="" />
<input type="file" id="play-img" name="play-img" class="styled" />
<label class="floating-label">Browse...</label>
</div>	
</div>
<div class="form-group form-material">
	<label class="control-label">Tags</label>
	<div class="controls">
	<input type="text" id="tags" name="tags" class="tags col-md-12" value="<?php echo _html($page->tags); ?>">
	<span class="help-block" id="limit-text">Press enter after each tag</span>
	</div>
	</div>
<div class="form-group form-material">
<button class="btn btn-large btn-primary pull-right" type="submit">Save changes</button>	
</div>	
</fieldset>						
</form>
</div>
