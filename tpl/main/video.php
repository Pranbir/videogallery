<?php the_sidebar(); do_action('pre-video');?>
<div class="video-holder row">
<?php if(has_list()){  ?>
<div id="renderPlaylist">
<?php } ?>
    <div class="<?php if(!has_list()){ echo "col-md-8 col-xs-12";} else {echo "row block player-in-list";}?> ">
        <div id="video-content" class="<?php if(has_list()){ echo "col-md-8 col-xs-12";} else {echo "row block";}?>">
            <div class="video-player pull-left 
                <?php rExternal() ?>">
                <?php do_action('before-videoplayer');
                echo _ad('0','before-videoplayer');
                echo the_embed(); 
                echo _ad('0','after-videoplayer');
               do_action('after-videoplayer');
            ?>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php if(has_list()){ ?>
        <div id="ListRelated" class="video-under-right nomargin pull-right col-md-4 col-xs-12">
            <?php do_action('before-listrelated'); ?>
            <div class="video-player-sidebar pull-left">			
                <div class="items">
                  <?php 
					echo '<div class="ajaxreqList" data-url="playlist/?list='._get('list').'&idowner='.$video->user_id.'&videoowner&videoid='.$video->id.'">
					 <div class="cp-spinner cp-flip"></div>  
					  </div>
					';
				?>                  
               </div>
				</div>
                <?php do_action('after-listrelated'); ?>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php } ?>
    </div>
    <?php if(has_list()){  ?>
    <div id="LH" class="row nomargin">
        <div class="playlistvibe">
            <div class="cute">
                <h1>
                    <?php  echo _html('Now playing:'); ?>
                    <span>
                        <?php  echo _html(_cut(list_title(_get('list')),260));?>
                    </span>
                </h1>
                <div class="cute-line"></div>
            </div>
            <div class="next-an list-next">
                <a class="fullit tipS" href="javascript:void(0)" title="<?php  echo _html('Resize player');?>">
                    <i id="flT" class="material-icons">&#xE85B;</i>
                </a>
                <a id="ComingNext" href="" class="tipS" title="">
                   <i class="material-icons">&#xE5C8;</i>
                </a>
                <a class="tipS" title="<?php  echo _html('Stop playlist');?>" href="<?php  echo $canonical;?>">
                <i class="material-icons">&#xE047;</i></a>
            </div>
        </div>
    </div>
	</div>
    <?php } ?>
    <div class="rur video-under-right oboxed <?php if(has_list()){ echo "mtop10";}?> pull-right col-md-4 col-xs-12">
        <?php do_action('before-related');  echo _ad('0','related-videos-top');?>
            <div class="related video-related top10 related-with-list">
                
                    <?php 
					if(get_option("ajaxyRel" , 1) == 1) {
                    echo '<div class="ajaxreqRelated" data-url="relatedvids?videoowner&videoid='.$video->id.'&videomedia='.$video->media.'&videocategory='.$video->category.'">
					 <div class="cp-spinner cp-flip"></div>  
					  </div>
					';
					} else {	
					echo '<ul>';
					layout('layouts/related'); 
					echo '</ul>';
					}
?>
                
            </div>
            <?php do_action('after-related'); ?>
        </div>
        <div class="video-under col-md-8 col-xs-12">
            <div class="oboxed odet mtop10">
                <div class="row vibe-interactions">
                    <?php do_action('before-video-title'); ?>
                    <h1>
                        <?php echo _html($video->title);?>
                    </h1>
                    <?php do_action('after-video-title'); ?>
                    <div class="addiv">
					<div class="like-views">
                    <?php echo number_format($video->views);?>  <?php echo _lang('views');?>
                    </div>
                          <div class="interaction-icons">
                <div class="likes-bar">                          
                            <?php if($is_liked) { ?>
                            <div class="aaa">
                                <a href="javascript:RemoveLike(<?php echo $video->id;?>)" id="i-like-it" class="isLiked pv_tip likes" title=" <?php echo _lang('Remove from liked');?>">
                                    <i class="material-icons">&#xE8DC;</i>
                                    <span><?php echo number_format($video->liked);?></span>
                                </a>
                            </div>
                            <?php } else { ?>
                            <div class="aaa">
                                <a href="javascript:iLikeThis(<?php echo $video->id;?>)" id="i-like-it" class="pv_tip likes" title=" <?php echo _lang('Like');?>">
                                    <i class="material-icons">&#xE8DC;</i>									
                                    <span><?php echo number_format($video->liked);?></span>
                                </a>
                            </div>
                            <?php } ?>
							  <div class="aaa ">
                                <a href="javascript:iHateThis(<?php echo $video->id;?>)" id="i-dislike-it" class="pv_tip dislikes <?php if($is_disliked) { echo 'isLiked'; }?>" data-toggle="tooltip" data-placement="top" title=" <?php echo _lang('Dislike');?>">
                                    <i class="material-icons">&#xE8DB;</i>
                                   <span> <?php echo number_format($video->disliked); ?></span>
                                </a>
                            </div>
                            <div class="like-box">
                                
                                <div class="like-progress">
                                    <div class="likes-success" style="width: 
                                        <?php echo $likes_percent;?>%;">
                                    </div>
                                    <div class="likes-danger second" style="width: 
                                        <?php echo $dislikes_percent;?>%;">
                                    </div>
                                </div>
                            </div>
						   </div>               						  
                            
                            <div class="aaa">
                                <a id="social-share" href="javascript:void(0)"  title=" <?php echo _lang('Share or Embed');?>">
                                   <i class="material-icons ico-flipped">&#xE15E;</i>
                                    <span class="hidden-xs">
                                        <?php echo _lang('Share');?>
                                    </span>
                                </a>
                            </div>
                            <?php if (is_user()) { ?>
                            <div class="aaa">
                                <a data-toggle="dropdown" id="dLabel" data-target="#" class="dropdown-toogle" title=" <?php echo _lang('Add To');?>">
                                    <i class="material-icons">&#xE03B;</i>                        
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <?php  $playlists=$cachedb->get_results("SELECT * from ".DB_PREFIX."playlists where owner='".user_id()."' and ptype = 1 and picture not in ('[likes]', '[history]', '[later]') limit 0,100");
			if($playlists){  ?>
			<li>
			<a title="<?php echo _lang("Watch later");?>" href="javascript:Padd(<?php echo $video->id; ?>,<?php echo later_playlist(); ?>)">
                                   <i class="material-icons">&#xE924;</i>
                                  <?php  echo _lang("Watch later");?>
                                </a>
			</li>
                                    <?php  foreach($playlists as $pl){?>
                                    <li id="PAdd-<?php echo $pl->id; ?>">
                                        <a href="javascript:Padd(<?php echo $video->id; ?>,<?php echo $pl->id; ?>)">
                                        <i class="material-icons">&#xE147;</i>
                                            <?php  echo _html($pl->title);?>
                                        </a>
                                    </li>
                                    <?php }?>
                                    <?php }?>
									<li class="divider" role="presentation"></li>
                                    <li>
                                        <a href="<?php echo site_url().me; ?>?sk=new-playlist">
                                           <i class="material-icons">&#xE146;</i>
                                            <?php  echo _lang("Create playlist");?>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <?php } ?>
                            <div class="aaa">
                                <a class="tipS" title=" <?php echo _lang('Report');?>" data-target="#report-it" data-toggle="modal" href="javascript:void(0)"  title=" <?php echo _lang('Report media');?>">
                                   <i class="material-icons">&#xE153;</i>
                                </a>
                            </div>
							</div>
							<br style="clear:both">
							</div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
           
                <div class="user-container full top20 bottom20">
                    <div class="pull-left user-box" style="">
                        <?php echo '
                        <a class="userav" href="'.profile_url($video->user_id,$video->owner).'" title="'.addslashes($video->owner).'">
                            <img src="'.thumb_fix($video->avatar, true, 60,50).'" data-name="'.addslashes($video->owner).'"/>
                        </a>
						<div class="user-box-txt">
						<a class="" href="'.profile_url($video->user_id,$video->owner).'" title="'.addslashes($video->owner).'">
                                <h3>'.$video->owner.'</h3>
                            </a> '.group_creative($video->group_id).'
							<p>  '.time_ago($video->date).'</p>
						</div>';?>
						
                        <div class="pull-right" style="max-width:100%;"><?php subscribe_box($video->user_id);?></div>
                    </div>					
                    <div style="clear:both"></div>
                </div>
            
                <div class="sharing-icos mtop10 odet hide">
				<?php do_action('before-social-box'); ?>
			<div class="has-shadow">
            <div class="text-center text-uppercase full bottom10 top20">
			<h4><?php  echo _lang('Let your friends enjoy it also!');?></h4>
			</div>			
             <div id ="jsshare" data-url="<?php echo $canonical; ?>" data-title="<?php echo _cut($video->title, 40); ?>"></div>                            
            </div>
			<div class="video-share mtop10 has-shadow right20 left20 clearfix">
			<div class="text-center text-uppercase full bottom20 top20">
			<h4><?php  echo _lang('Add it to your website');?></h4>
			</div>
                <div class="form-group form-material floating">
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="material-icons">&#xE157;</i>
                        </span>
                        <div class="form-control-wrap">
                            <input type="text" name="link-to-this" id="share-this-link" class="form-control" title="<?php echo _lang('Link back');?>" value="<?php echo canonical();?>" />
                                <label class="floating-label">
                                    <?php  echo _lang('Link to this');?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-material floating">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="material-icons">&#xE911;</i>
                            </span>
                            <div class="form-control-wrap">
							<div class="row">
							
							<div class="col-md-7">
<textarea style="min-height:80px" id="share-embed-code-small" name="embed-this" class="form-control" title=" <?php echo _lang('Embed this media on your page');?>"><iframe width="853" height="480" src="<?php echo site_url().embedcode.'/'._mHash($video->id).'/';?>" frameborder="0" allowfullscreen></iframe></textarea>
 <label class="floating-label"> <?php  echo _lang('Embed code');?></label>
     <div class="radio-custom radio-primary"><input type="radio" name="changeEmbed" class="styled" value="1"><label>1920x1080</label></div>
	<div class="radio-custom radio-primary"><input type="radio" name="changeEmbed" class="styled" value="2"><label>1280x720</label></div>	
	<div class="radio-custom radio-primary"><input type="radio" name="changeEmbed" class="styled" value="3"><label>854x480</label></div>	
	<div class="radio-custom radio-primary"><input type="radio" name="changeEmbed" class="styled" value="4"><label>640x360</label></div>	
	<div class="radio-custom radio-primary"><input type="radio" name="changeEmbed" class="styled" value="5"><label>426x240</label></div>
					  </div>
							<div class="col-md-4 col-md-offset-1">
  	<div class="well">
				<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">&#xE86F;</i></span>
                    <input type="number" class="form-control" name="CustomWidth" id="CustomWidth" placeholder="<?php echo _lang("Custom width");?>">
                  </div>
                </div>
				<div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">&#xE883;</i></span>
                    <input type="number" name="CustomHeight" id="CustomHeight" class="form-control" placeholder="<?php echo _lang("Custom height");?>"> </div>
                </div>
				</div>
					</div>
							</div>
							</div>
                        </div>
                    </div>
					<div class="form-group form-material floating">
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="material-icons">&#xE1B1;</i>
                        </span>
                        <div class="form-control-wrap">
                            <input type="text" name="link-to-this" id="share-this-responsive" class="form-control" title=" <?php echo _lang('Make the iframe responsive on your website');?>" value='<script src="<?php  echo site_url();?>lib/vid.js"></script>' />
                                <label class="floating-label">
                                    <?php  echo _lang('Responsive embed');?>
                                </label>
                            </div>
							<span class="help-block">
							<?php  echo _lang('Include this script into your page along with the iframe for a'); ?> <code><?php  echo _lang('responsive media embed');?></code>
                        <span>
						</div>
                    </div>
                </div>
                </div>
                <?php do_action('before-description-box'); ?>
                <div class="mtop10 oboxed odet col-md-6">
                    <ul id="media-info" class="list-unstyled">
                        <li>                           
                           
                    <div class="fb-like pull-left" style="display:none;" data-href="<?php echo $canonical; ?>" data-width="124" data-layout="standard" data-colorscheme="dark" data-action="like" data-show-faces="true" data-share="true"></div>
                          </li>
						  <li><h4><u>Details :</u></h4></li>
						  <li>
						  <div id ="media-description" data-small="<?php echo _lang("show more");?>" data-big=" <?php echo _lang("show less");?>">
                           <!--
                            <?php echo makeLn(_html($video->description));?>
							-->
                            <?php
                                $st_dt = new DateTime($video->start_date_time);
                                $en_dt = new DateTime($video->end_date_time);
                                $s_dt = $st_dt->format('Y/m/d');
                                $s_tm = $st_dt->format('H:i:s');
                                $e_tm = $en_dt->format('H:i:s');
                                echo 'Date: '.$s_dt; 
                                echo '<br>';
                                echo 'Start Time: '.$s_tm;
                                echo '<br>';
                                echo 'End Time: '.$e_tm;
                                echo '<br>';
                                echo 'Warehouse: '.$video->warehouse_title;
                                echo '<br>';
                                echo 'Door No.: '.$video->door;
                                for($x=1;$x<21;$x++){
                                    $load = 'load_'.$x;
                                    if($video->$load){
                                        echo '<br>';
                                        echo 'Load No. '.$x.': '.$video->$load;
                                    }
                                    
                                }
                                echo '<br>';
                                if($video->comment){
                                    echo 'Comments: '.$video->comment;
                                }
                                
                            ?>
                            
                            <p style="font-weight:500; color:#333" class="hideTheElement">
							 <?php echo _lang("Category :");?> <a href="<?php echo channel_url($video->category,$video->channel_name);?>" title="<?php echo _html($video->channel_name);?>">
                                <?php echo _html($video->channel_name);?>
                            </a>
							</p>
							<?php if($video->tags) { ?>
							<p> <?php echo pretty_tags($video->tags,'right20','#','');?></p>
							<?php } ?>
                            </div>
                        </li>                      
                    </ul>
                 
                    <?php do_action('after-description-box'); ?>
                </div>
                <div class="mtop10 oboxed odet col-md-6">
                    <ul id="media-info" class="list-unstyled">
                        <li>                           
                           
                    <div class="fb-like pull-left" style="display:none;" data-href="<?php echo $canonical; ?>" data-width="124" data-layout="standard" data-colorscheme="dark" data-action="like" data-show-faces="true" data-share="true"></div>
                          </li>
						  <li><h4><u>Load No. :</u></h4></li>
						  <li>
						  <div id ="media-description" data-small="<?php echo _lang("show more");?>" data-big=" <?php echo _lang("show less");?>">
                            <?php 
                                
                                /*
                                foreach(split_load_numbers($video->load_numbers) as $ln){
                                    $ln1 = "'".$ln."'";
                                    echo '<li>';
                                    echo '<input type="text" id="LD_'.$load_number_count.'" value="'.$ln.'" disabled>';
                                    echo '<a id="e_'.$load_number_count.'" class="btn btn-warning" href="javascript:edit_load_number('.$load_number_count.' )" >Edit</a>';
                                    echo '<a id="s_'.$load_number_count.'" class="btn btn-warning" href="javascript:save_load_number('.$load_number_count.')" style="display: none;">Save</a>';
                                    echo '</li>';
                                    $load_number_count = $load_number_count +1;
                                   
                                }
                               */
                                //if($load_number_count <21){
                                    //echo '<a class="btn btn-success" href="javascript:add_new_load_number()">Add</a>';
                                    for($load_number_count = 1;$load_number_count < 21; $load_number_count++){
                                        echo '<li>';
                                        if($video->load_.$load_number_count){
                                            $val = 'load_'.$load_number_count;
                                            echo '<input type="text" id="LD_'.$load_number_count.'" value="'.$video->$val.'" disabled>';
                                        }else{
                                            echo '<input type="text" id="LD_'.$load_number_count.'" value="" disabled>';
                                        }
                                        echo '<a id="e_'.$load_number_count.'" class="btn btn-warning" href="javascript:edit_load_number('.$load_number_count.' )" >Edit</a>';
                                        echo '<a id="s_'.$load_number_count.'" class="btn btn-warning" href="javascript:save_load_number('.$load_number_count.')" style="display: none;">Save</a>';
                                        echo '</li>';
                                    }
                                //}
                                
                            ?>
                            <script type="text/javascript">
                                function add_new_load_number(){
                                    $("#media-info ul").append('<li>New Row</li>');
                                    <?php
                                    
                                //    echo '<input type="text" id="LD_'.$load_number_count.'" value="">';
                                //    echo '<a id="e_'.$load_number_count.'" class="btn btn-warning" href="javascript:edit_load_number('.$load_number_count.' )" style="display: none;">Edit</a>';
                                //    echo '<a id="s_'.$load_number_count.'" class="btn btn-warning" href="javascript:save_load_number('.$load_number_count.')" >Save</a>';

                                //    $load_number_count = $load_number_count +1;
                                    ?>
                                    console.log('<?php echo $load_number_count; ?>');
                                }
                            </script>
							</div>
                        </li>                      
                    </ul>
                 
                    <?php do_action('after-description-box'); ?>
                </div>
                <div class="clearfix"></div>
                <div class="oboxed related-mobi mtop10 visible-sm visible-xs hidden-md hidden-lg">
                    <a id="revealRelated" href="javascript:void(0)">
                        <span class="show_more text-uppercase">
                            <?php echo _lang("show more");?>
                        </span>
                        <span class="show_more text-uppercase hide">
                            <?php echo _lang("show less");?>
                        </span>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="oboxed ocoms mtop10" style="display:none;">
                    <?php echo _ad('0','top-of-comments');?>
                    <?php do_action('before-comments'); ?>
                    <?php 
					$comsNav = '<nav id="page_nav"><a href="'.$canonical.'?p='.next_page().'"></a></nav>';					
					echo comments();
					?>
                    <?php do_action('after-comments'); ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <script type="text/javascript">
$(document).ready(function(){
	DOtrackview(<?php echo $video->id; ?>);
});
function edit_load_number(val){
    
    var id = '#LD_'+val;
    var e_button_id = '#e_'+val;
    var s_button_id = '#s_'+val;
    $(id).prop('disabled', false);
    $(e_button_id).hide();
    $(s_button_id).show();
    document.cookie = "colname=";
    //console.log(val);
}

function save_load_number(val){
    var id = '#LD_'+val;
    var e_button_id = '#e_'+val;
    var s_button_id = '#s_'+val;
    var col_name = 'load_'+val;
    var col_val = "'"+$(id).val()+"'";
    var vid_id = <?php echo $video->id; ?>;

  $.ajax({
				url: "/tpl/main/update_load.php",
				type: "POST",
                data: {"col_name": col_name,
                        "col_val": col_val,
                        "vid_id": vid_id},
				success: function(res) {
				//	console.log(res);
					
				}
			});
  $(id).prop('disabled', true);
    $(e_button_id).show();
    $(s_button_id).hide();
  
}


$("#dateTimeWarePick_warehouse").change(function() {
			//get the selected value
			var selectedValue = this.value;
			console.log(selectedValue);
			//$("#dateTimeDoorPick_warehouse").val = selectedValue;
			var $select = $("#dateTimeDoorPick_warehouse");
			$select.find("option").remove();
			
			
			$.ajax({
				url: "/tpl/main/fetch_doorno.php",
				type: "POST",
				data: {"query": selectedValue},
				success: function(res) {
					console.log(res);
					if(res){
						$select.append("<option value= >All Doors</option>");
						$select.append(res);
					}else{
						$select.append("<option value =  > Select WareHouse First</option>");
					} 
				}
			});
});
        </script>
    </div>
    <?php do_action('post-video'); ?>
    <!-- Start Report Sidebar -->
    <div class="modal fade" id="report-it" aria-hidden="true" aria-labelledby="report-it"
                        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">
                        <?php  echo _lang('Report video');?>
                    </h4>
                </div>
                <div class="modal-body">
                    <?php if(!is_user()){?>
                    <p>
                        <?php  echo _lang('Please login in order to report media.');?>
                    </p>
                    <?php } elseif(is_user()){?>
                    <div class="ajax-form-result"></div>
                    <form class="horizontal-form ajax-form" action="
                        <?php echo site_url().'lib/ajax/report.php';?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="
                            <?php  echo $video->id;?>" />
                            <input type="hidden" name="token" value="
                                <?php  echo $_SESSION['token'];?>" />
                                <div class="control-group" style="border-top: 1px solid #fff;">
                                    <label class="control-label">
                                        <?php  echo _lang('Reason for reporting');?>: 
                                    </div>
                                    <div class="controls">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" name="rep[]" value="
                                                <?php echo _lang('Media not playing');?>" class="checkbox-custom">
                                                <label>
                                                    <?php echo _lang('Video not playing');?>
                                                </label>
                                            </div>
                                            <div class="checkbox-custom checkbox-primary">
                                                <input type="checkbox" name="rep[]" value="
                                                    <?php  echo _lang('Wrong title/description');?>" class="styled">
                                                    <label>
                                                        <?php  echo _lang('Wrong title/description');?>
                                                    </label>
                                                </div>
                                                <div class="checkbox-custom checkbox-primary">
                                                    <input type="checkbox" name="rep[]" value="
                                                        <?php  echo _lang('Media is offensive');?>" class="styled">
                                                        <label>
                                                            <?php echo _lang('Video is offensive');?>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input type="checkbox" name="rep[]" value="
                                                            <?php  echo _lang('Media is restricted');?>" class="styled">
                                                            <label>
                                                                <?php echo _lang('Video is restricted');?>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox-custom checkbox-primary">
                                                            <input type="checkbox" name="rep[]" value="
                                                                <?php  echo _lang('Copyrighted material');?>" class="styled">
                                                                <label>
                                                                    <?php  echo _lang('Copyrighted material');?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <textarea rows="5" cols="3" name="report-text" class="form-control" required></textarea>
                                                            <p>
                                                                <strong>
                                                                    <?php  echo _lang('Required'); ?>
                                                                </strong> :
                                                                <?php  echo _lang('Tell us what is wrong with the video in a few words');?>
                                                            </p>
                                                            <div class="row mtop20 bottom10">
                                                                <button class="btn btn-primary btn-block" type="submit">
                                                                    <?php  echo _lang('Send report');?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <?php } ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                            </div>
                            <!-- End Report Sidebar -->
