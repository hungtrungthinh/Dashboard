 
                    <li id="newside_<?php echo $option_id; ?>" class="newside_<?php echo $option_id;?>" data-attr=""  style="display:none;" >
                    <span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>"  style="display:none;">
                    <input type="text"  id="saveopt_<?php echo $val['option_id'] ; ?>" name="opt_name_<?php echo $val['option_id'];?>[]" class="opt_name_<?php echo $val['option_id'] ; ?>" value="">
                    </span>  
                    
                    <div class="pull-right">
                    <label class="action pull-right"></label>
                    <label class="action pull-right">
                    <a href="javascript:void(0);" class="pull-right addmoresides" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                          <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                    </a>
                    </label>
                    
                   
                    <label class="rate">+$
                    <input type="text"  id="saveopt_<?php echo $val['option_id'] ; ?>" name="opt_price_<?php echo $val['option_id'];?>[]" class="opt_price_<?php echo $val['option_id'] ; ?>" value="">
                    </label>
                    </div>
					</li>	
						