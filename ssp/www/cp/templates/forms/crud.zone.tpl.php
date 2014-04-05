<script language="JavaScript">  

function showadiv(id) {  
//safe function to show an element with a specified id
		  
	if (document.getElementById) { // DOM3 = IE5, NS6
		document.getElementById(id).style.visibility = 'visible';
	}
	else {
		if (document.layers) { // Netscape 4
			document.id.visibility = 'visible';
		}
		else { // IE 4
			document.all.id.style.visibility = 'visible';
		}
	}
}

function hideadiv(id) {  
//safe function to hide an element with a specified id
	if (document.getElementById) { // DOM3 = IE5, NS6
		document.getElementById(id).style.visibility = 'collapse';
	}
	else {
		if (document.layers) { // Netscape 4
			document.id.visibility = 'collapse';
		}
		else { // IE 4
			document.all.id.style.visibility = 'collapse';
		}
	}

}

function checkdivs(){
if (document.forms['crudpublication'].elements['zone_size'].value=='10'){hideadiv('widthzonediv'); hideadiv('heightzonediv');}
}

function checkdivsreopen(){
if (document.forms['crudpublication'].elements['zone_size'].value=='10'){showadiv('widthzonediv'); showadiv('heightzonediv');}
}


</script>
                    
                    <div class="widget">
						
						<div class="widget-header">
							<span class="icon-article"></span>
							<h3>Ad Unit / Placement Details</h3>
						</div> <!-- .widget-header -->
                        
						
						<div class="widget-content">
                        
                        <?php if ($user_detail['tooltip_setting']==1){ ?>
                        <div class="notify notify-info">						
						
						<p>A placement is a single place in your mobile application or website in which an advertisement can appear. You can create an unlimited number of placements for your publication, and a placement can either be a banner or a full page interstitial.</p>
					</div> <!-- .notify -->
						<?php } ?>
                            
                            <div class="field-group">
			
								<div class="field">
									<input type="text" value="<?php if (isset($editdata['zone_name']) && !empty($editdata['zone_name'])){ echo $editdata['zone_name']; } else { echo 'Main Placement'; } ?>"  name="zone_name" id="zone_name" size="28" class="" />			
									<label for="zone_name">Placement Name</label>
								</div>
							</div> <!-- .field-group -->
                           
                                                       <div class="field-group">
                     <div class="field">
									<textarea name="zone_description" id="zone_description" rows="5" cols="50"><?php if (isset($editdata['zone_description'])){ echo $editdata['zone_description']; } ?></textarea>	
									<label for="zone_description">Description</label>
								</div>
							</div> <!-- .field-group -->
                            
                            <div class="field-group control-group inline">	
			
									<div class="field">
										<input type="radio" <?php if (isset($editdata['zone_type']) && $editdata['zone_type']=='banner'){echo'checked="checked"'; }?>  onclick="showadiv('zonesize'); checkdivsreopen();" name="zone_type" id="zone_type_banner" value="banner" />
										<label for="zone_type_banner">Banner Ad</label>
									</div>
			
									<div id="interstitialoptiobutton" class="field">
										<input type="radio" <?php if (isset($editdata['zone_type']) && $editdata['zone_type']=='interstitial'){echo'checked="checked"'; }?> onclick="hideadiv('zonesize'); checkdivs();" name="zone_type" id="zone_type_interstitial" value="interstitial" />
										<label for="zone_type_interstitial">Full Page Interstitial</label>
									</div>
			
									
								</div>	
                                
                                <div id="zonesize" class="field-group">
			                    <?php if ($current_action=='create'){?>

<?php
require_once MAD_PATH . '/www/cp/ad_unit_sizes.php';

print "<script>\n";
print "var ad_sizes = eval((".json_encode($ad_sizes)."));\n";
print "var phone_sizes = eval((".json_encode($phone_sizes)."));\n";
print "var tablet_sizes = eval((".json_encode($tablet_sizes)."));\n";
print "var web_sizes = eval((".json_encode($web_sizes)."));\n";
print "</script>\n";
?>
<script>
function select_medium() {
   var medium = document.getElementById('zone_medium').value;

   var sizes = [];
   if (medium == "phone") {
      sizes = phone_sizes;
   } else if (medium == "tablet") {
      sizes = tablet_sizes;
   } else if (medium == "web") {
      sizes = web_sizes;
   }

   var zone_size = document.getElementById("zone_size");

   zone_size.options.length = 0;

   zone_size[0] = new Option("--- select format ---", "", true,  true);

   var uniform_zone_size = document.getElementById("uniform-zone_size");
   uniform_zone_size.childNodes[0].innerHTML = "--- select format ---";

   for (var i=0; i<sizes.length; i++) {
      var opt_name = ad_sizes[sizes[i]]['width'] + 'x' + ad_sizes[sizes[i]]['height'] + " " + ad_sizes[sizes[i]]['desc'];

      zone_size[i+1] = new Option (opt_name, sizes[i], false, false);
   }
   zone_size.selectedIndex = 0;
}
</script>

                                                                <div class="field">
<select id='zone_medium' name=zone_medium onchange="return select_medium();">
<option value=''>-- select medium --</option>
<option value='phone'>Phone</option>
<option value='tablet'>Tablet</option>
<option value='web'>Web</option>
</select>
                                                                        <label for="zone_medium">Ad Unit Medium</label>
</div>


								<div class="field">
									<select id="zone_size" name="zone_size">
<option>-- select medium --</option>
</select>
									<label for="zone_size">Ad Unit Size</label>
								</div>
                                <?php } ?>
                                <div id="widthzonediv" class="field">
									<input type="text" value="<?php  if (isset($editdata['zone_width'])){ echo $editdata['zone_width']; } ?>" name="custom_zone_width" id="custom_zone_width" size="3" class="" />		x	
									<label for="last_name">Width</label>
								</div>
                               
                                <div id="heightzonediv" class="field">
									<input type="text" value="<?php if (isset($editdata['zone_height'])){ echo $editdata['zone_height']; } ?>" name="custom_zone_height" id="custom_zone_height" size="3" class="" />			
									<label for="last_name">Height</label>
								</div>
							</div> <!-- .field-group -->
                            
                            <div class="field-group">
			
								<div class="field">
									<select id="zone_channel" name="zone_channel">
								  <option>- Use publication default channel  -</option>
	 <?php if (!isset($editdata['zone_channel'])){$editdata['zone_channel']=''; } get_channel_dropdown($editdata['zone_channel']); ?>
								</select>					
									<label for="zone_channel">Channel Override</label>
								</div>
							</div> <!-- .field-group -->
                            
                            <div class="field-group">
			
								<div class="field">
									<input type="text" value="<?php if (isset ($editdata['zone_refresh']) && !empty($editdata['zone_refresh'])){ echo $editdata['zone_refresh']; } else { echo '30'; } ?>"  name="zone_refresh" id="zone_refresh" size="1" class="" /> seconds	
									<label for="zone_refresh">Refresh Interval (enter 0 for no refresh)</label>
								</div>
							</div> <!-- .field-group -->
                            
			
								
                            
                           
                             
                             
                            
                          
                            
			
							
							
						
						</div> <!-- .widget-content -->
						
					</div> <!-- .widget -->
                    
                    <div class="notify">			
                        <h3>Monetization Settings</h3>			
						
						<p><input <?php if (isset($editdata['mobfox_backfill_active']) or $editdata['mobfox_backfill_active']==1){echo'checked="checked"'; }?> name="mobfox_backfill_active" id="mobfox_backfill_active" type="checkbox" value="0" /><label for="mobfox_backfill_active"><strong>BackFill - </strong>Attempt to show an ad from the MobFox:Connect network before an ad space remains unfilled. (recommended)</label></p><p><input id="mobfox_min_cpc_active" <?php if (isset($editdata['mobfox_min_cpc_active']) && $editdata['mobfox_min_cpc_active']==1){echo'checked="checked"'; }?> name="mobfox_min_cpc_active" type="checkbox" value="0" /><label for="mobfox_min_cpc_active">Only back-fill through MobFox:Connect when the ad pays at least a CPC of $<input type="text" value="<?php if (!empty($editdata['min_cpc'])){ echo $editdata['min_cpc']; } else { echo '0.10'; } ?>"  name="min_cpc" id="min_cpc" size="2" class="" /> (max. $0.20) or a CPM of $<input type="text" value="<?php if (!empty($editdata['min_cpm'])){ echo $editdata['min_cpm']; } else { echo '2.50'; } ?>"  name="min_cpm" id="min_cpm" size="2" class="" /> (max. $5)</label></p>
					</div> <!-- .notify -->
                    
                  <div class="notify">			
    <h3>BackFill Settings - Alternative Networks</h3>			
						
						<p><input <?php if (isset ($editdata['backfill_alt_1']) && is_numeric($editdata['backfill_alt_1'])){echo'checked="checked"'; }?> id="backfill_alt_1_active" name="backfill_alt_1_active" type="checkbox" value="0" />
                        <label for="backfill_alt_1_active">
						Alternative 1: If an ad-request can neither be filled by a direct campaign nor by MobFox:Connect, try to request an ad from 
						</label>
						<select name="backfill_alt_1" id="backfill_alt_1">
						  <?php if (!isset($editdata['backfill_alt_1'])){$editdata['backfill_alt_1']=''; } get_network_dropdown($editdata['backfill_alt_1']); ?>
						  </select>
					</p>
					<p><input <?php if (isset ($editdata['backfill_alt_2']) && is_numeric($editdata['backfill_alt_2'])){echo'checked="checked"'; }?> id="backfill_alt_2_active" name="backfill_alt_2_active" type="checkbox" value="0" />
                    <label for="backfill_alt_2_active">
Alternative 2: If an ad-request can not be filled by Alternative 1, try to request an ad from
                      </label>
					  <select name="backfill_alt_2" id="backfill_alt_2">
 <?php if (!isset($editdata['backfill_alt_2'])){$editdata['backfill_alt_2']=''; }  get_network_dropdown($editdata['backfill_alt_2']); ?>				      </select>
				    </p>
<p><input <?php if (isset ($editdata['backfill_alt_3']) && is_numeric($editdata['backfill_alt_3'])){echo'checked="checked"'; }?> id="backfill_alt_3_active" name="backfill_alt_3_active" type="checkbox" value="0" />
<label for="backfill_alt_3_active">
Alternative 3: If an ad-request can not be filled by Alternative 2, try to request an ad from
                      </label>
					  <select name="backfill_alt_3" id="backfill_alt_3">
 <?php if (!isset($editdata['backfill_alt_3'])){$editdata['backfill_alt_3']=''; }  get_network_dropdown($editdata['backfill_alt_3']); ?>				      </select>
				    </p>

</div> 
                         <!-- .notify -->
                    <script language="javascript">if (document.forms["crudpublication"].elements["zone_size"].value!='10'){hideadiv('widthzonediv'); hideadiv('heightzonediv');} else {showadiv('widthzonediv'); showadiv('heightzonediv');} if (document.forms["crudpublication"].elements["inv_type"].value=='3'){hideadiv('interstitialoptiobutton');} else {showadiv('interstitialoptiobutton');}
</script><?php if (isset ($editdata['zone_type']) && $editdata['zone_type']=='interstitial'){?><script language="javascript">hideadiv('zonesize'); checkdivs();</script><?php } ?>
