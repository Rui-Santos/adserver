 <script language="javascript">
 function creative_type(status){
	
	if (status=="upload"){
$("#creative_type_upload").attr("checked", "true");
document.getElementById('creative_url_div').style.display='none'; document.getElementById('html_div').style.display='none'; document.getElementById('creative_upload_div').style.display='block'; document.getElementById('creative_upload_div').style.display='block'; document.getElementById('click_url_div').style.display='block';
	}
	
	if (status=="external"){
$("#creative_type_url").attr("checked", "true");
document.getElementById('creative_upload_div').style.display='none'; document.getElementById('html_div').style.display='none'; document.getElementById('creative_url_div').style.display='block'; document.getElementById('creative_upload_div').style.display='block'; document.getElementById('creative_upload_div').style.display='none'; document.getElementById('click_url_div').style.display='block';	}
	
	if (status=="html"){
$("#creative_type_html").attr("checked", "true");
document.getElementById('creative_upload_div').style.display='none'; document.getElementById('creative_url_div').style.display='none';  document.getElementById('click_url_div').style.display='none'; document.getElementById('html_div').style.display='block';	}
	

}

 </script>
 <div id="create_adunit" class="widget">
						
						<div class="widget-header">
							<span class="icon-article"></span>
							<h3 class="icon aperture"><?php if ($current_action=='create'){?>Create Ad Unit<?php } else if ($current_action=='edit'){ ?>Edit Ad Unit<?php } ?></h3>
						</div> <!-- .widget-header -->
						
						<div class="widget-content">
                        
                          <?php if ($user_detail['tooltip_setting']==1){ ?>
                         <div class="notify notify-info">						
						
                        						<p>Please create your first ad-unit below. Once the campaign is setup, you will be able to add additional ad units to the campaign.</p>
					</div> <!-- .notify -->
                        <?php } ?>
                        
                         <div class="field-group">
			
								<div class="field">
									<input type="text" value="<?php  if (!isset($page_desc)){$page_desc=''; } if ($current_action=="create" && empty($editdata['adv_name']) && $page_desc!='create_adunit'){ echo "Creative 1"; } else if (!empty($editdata['adv_name'])){echo $editdata['adv_name']; }?>"  name="adv_name" id="adv_name" size="28" class="" />			
									<label for="adv_name">Creative Name</label>
								</div>
							</div> <!-- .field-group -->
                        
                            <div id="zonesize" class="field-group">
			                    <?php if ($current_action=='create'){?>
<?php
$ad_sizes = array(
   1 => array('width'=>320, 'height'=>50, 'desc'=>'Banner'),
   2 => array('width'=>300, 'height'=>250, 'desc'=>'Medium Banner'),
   3 => array('width'=>728, 'height'=>90, 'desc'=>'Leaderboard'),
   4 => array('width'=>160, 'height'=>600, 'desc'=>'Skyscraper'),
   5 => array('width'=>300, 'height'=>50, 'desc'=>'Banner'),
   6 => array('width'=>320, 'height'=>480, 'desc'=>'Full Screen'),

   7 => array('width'=>468, 'height'=>60, 'desc'=>'Full Banner'),
   8 => array('width'=>336, 'height'=>280, 'desc'=>'Large Rectangle'),
   9 => array('width'=>300, 'height'=>600, 'desc'=>'Half Page Ad'),
   11 => array('width'=>300, 'height'=>100, 'desc'=>'3:1 Rectangle'),
   12 => array('width'=>250, 'height'=>250, 'desc'=>'Square'),
   13 => array('width'=>240, 'height'=>400, 'desc'=>'Vertical Rectangle')

);

$phone_sizes = array(5,1,2,6);
$tablet_sizes = array(3,2,4,1);
$web_sizes = array(3,7,8,1,9,11,12,13);

print "<script>\n";
print "var ad_sizes = eval((".json_encode($ad_sizes)."));\n";
print "var phone_sizes = eval((".json_encode($phone_sizes)."));\n";
print "var tablet_sizes = eval((".json_encode($tablet_sizes)."));\n";
print "var web_sizes = eval((".json_encode($web_sizes)."));\n";
print "</script>\n";

?>
<script>
function select_medium() {
   var medium = document.getElementById('creative_medium').value;

   var sizes = [];
   if (medium == "phone") {
      sizes = phone_sizes;
   } else if (medium == "tablet") {
      sizes = tablet_sizes;
   } else if (medium == "web") {
      sizes = web_sizes;
   }

   var creative_format = document.getElementById("creative_format");

   creative_format.options.length = 0;

   creative_format[0] = new Option("--- select format ---", "", true,  true);

   for (var i=0; i<sizes.length; i++) {
      var opt_name = ad_sizes[sizes[i]]['width'] + 'x' + ad_sizes[sizes[i]]['height'] + " " + ad_sizes[sizes[i]]['desc'];

      creative_format[i+1] = new Option (opt_name, sizes[i], false, false);
   }
   creative_format.selectedIndex = 0;
}
</script>
								<div class="field">
<select id='creative_medium' name=creative_medium onchange="return select_medium();">
<option value=''>-- select medium --</option>
<option value='phone'>Phone</option>
<option value='tablet'>Tablet</option>
<option value='web'>Web</option>
</select>
									<label for="creative_medium">Creative Medium</label>
</div>

								<div class="field">
<select id="creative_format" name="creative_format">
<option>-- select medium --</option></select>
									<!--select onchange="if (this.options[this.selectedIndex].value=='10'){showadiv('widthzonediv'); showadiv('heightzonediv');} else {hideadiv('widthzonediv'); hideadiv('heightzonediv');}" id="creative_format" name="creative_format"-->

<!--
								  <option>- Phone  -</option>
<?php
   foreach ($phone_sizes as $sizeindex) {
      $w = $ad_sizes[$sizeindex]['width'];
      $h = $ad_sizes[$sizeindex]['height'];
      $desc = $ad_sizes[$sizeindex]['desc'];
      print "<option ";
      if (isset($editdata['creative_format']) && $editdata['creative_format']==$sizeindex){
         echo 'selected="selected"';
      }
      print " value=$sizeindex>${w}x${h} $desc</option>\n";
   }
?>
                                  <option>- Tablet  -</option>

<?php
   foreach ($tablet_sizes as $sizeindex) {
      $w = $ad_sizes[$sizeindex]['width'];
      $h = $ad_sizes[$sizeindex]['height'];
      $desc = $ad_sizes[$sizeindex]['desc'];
      print "<option ";
      if (isset($editdata['creative_format']) && $editdata['creative_format']==$sizeindex){
         echo 'selected="selected"';
      }
      print " value=$sizeindex>${w}x${h} $desc</option>\n";
   }
?>

                                  <option>- Web  -</option>

<?php
   foreach ($web_sizes as $sizeindex) {
      $w = $ad_sizes[$sizeindex]['width'];
      $h = $ad_sizes[$sizeindex]['height'];
      $desc = $ad_sizes[$sizeindex]['desc'];
      print "<option ";
      if (isset($editdata['creative_format']) && $editdata['creative_format']==$sizeindex){
         echo 'selected="selected"';
      }
      print " value=$sizeindex>${w}x${h} $desc</option>\n";
   }
?>


                                  <!--option <?php if (isset($editdata['creative_format']) && $editdata['creative_format']==10){echo 'selected="selected"'; } ?> value="10">Custom Size:</option-->

								</select>					-->
									<label for="creative_format">Creative Format</label>
								</div>
                                <?php } ?>
                                <div id="widthzonediv" class="field">
									<input type="text" value="<?php if (isset($editdata['custom_creative_width'])){ echo $editdata['custom_creative_width']; } ?>" name="custom_creative_width" id="custom_creative_width" size="3" class="" />		x	
									<label for="last_name">Width</label>
								</div>
                               
                                <div id="heightzonediv" class="field">
									<input type="text" value="<?php if (isset($editdata['custom_creative_height'])){ echo $editdata['custom_creative_height']; } ?>" name="custom_creative_height" id="custom_creative_height" size="3" class="" />			
									<label for="last_name">Height</label>
								</div>
							</div> <!-- .field-group -->
                            
                            <div class="field-group control-group inline">	
  
	
									<div class="field">
										<input type="radio"   onclick="document.getElementById('creative_url_div').style.display='none'; document.getElementById('html_div').style.display='none'; document.getElementById('creative_upload_div').style.display='block'; document.getElementById('creative_upload_div').style.display='block'; document.getElementById('click_url_div').style.display='block';" name="creative_type" id="creative_type_upload" value="1" />
										<label for="creative_type_upload">Creative Upload</label>
									</div>
			
									<div class="field">
										<input type="radio"  onclick="document.getElementById('creative_upload_div').style.display='none'; document.getElementById('html_div').style.display='none'; document.getElementById('creative_url_div').style.display='block'; document.getElementById('creative_upload_div').style.display='block'; document.getElementById('creative_upload_div').style.display='none'; document.getElementById('click_url_div').style.display='block';" name="creative_type" id="creative_type_url" value="2" />
										<label for="creative_type_url">External Image URL</label>
									</div>
                                    
                                    <div class="field">
										<input type="radio"  onclick="document.getElementById('creative_upload_div').style.display='none'; document.getElementById('creative_url_div').style.display='none';  document.getElementById('click_url_div').style.display='none'; document.getElementById('html_div').style.display='block';" name="creative_type" id="creative_type_html" value="3" />
										<label for="creative_type_html">HTML (MRAID supported)</label>
									</div>
                                    
                                    <div style="color:#999; font-size:11px;">Creative Type</div>
			
									
								</div>
                                
                                <div id="click_url_div" class="field-group">
                                
                                <div class="field">
									<input type="text" value="<?php if (isset($editdata['click_url'])){ echo $editdata['click_url']; } ?>"  name="click_url" id="click_url" size="28" class="" />			
									<label for="click_url">Click URL</label>
								</div>
							</div> <!-- .field-group -->
                                
                                                         <div id="tracking_pixel_div" class="field-group">
                                
                                <div class="field">
									<input type="text" value="<?php if ( isset($editdata['tracking_pixel'])){ echo $editdata['tracking_pixel']; } ?>"  name="tracking_pixel" id="tracking_pixel" size="28" class="" />			
									<label for="tracking_pixel">Tracking Pixel URL</label>
								</div>
							</div> <!-- .field-group -->
                            
                                                                                     <div id="creative_url_div" class="field-group">
                            
                            <div class="field">
									<input type="text" value="<?php if (isset($editdata['creative_url'])){echo $editdata['creative_url']; } ?>"  name="creative_url" id="creative_url" size="28" class="" />			
									<label for="creative_url">Creative Image URL</label>
								</div>
							</div> <!-- .field-group -->
								
                                <div id="html_div" class="field-group">
			
								<div class="field">
									<textarea name="html_body" id="html_body" rows="5" cols="38"><?php if (isset($editdata['html_body'])){ echo $editdata['html_body']; } ?></textarea>	
									<label for="html_body">HTML Body</label><br /><input <?php if (isset($editdata['adv_mraid']) && $editdata['adv_mraid']==1){echo 'checked="checked"'; } ?> type="checkbox" name="adv_mraid" id="adv_mraid" value="1" /> <label for="adv_mraid">This is an MRAID ad</label>
								</div>
							</div> <!-- .field-group -->
							
								
								<div id="creative_upload_div" class="field-group inlineField">	
									<label for="creative_file">Creative Upload: <?php if ($current_action=='edit'){?>(Updates current creative)<?php } ?></label>
			
									<div class="field">
										<input type="file" name="creative_file" id="creative_file" />
									</div>	
								</div>
							
						</div> <!-- .widget-content -->
						
					</div> <!-- .widget -->	
                    
