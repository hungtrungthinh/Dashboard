<?php 
					if(count($sidesdetails)!=0){ 
					$i=0;
		  				foreach($sidesdetails as $valu){  
						
						//print_r($valu);?>
                	
                    						<tr data-attr="<?php echo $valu['side_id'] ; ?>" id="sideslist_<?php echo $valu['side_id'];?>" class="tr_opt_<?php echo $option_id; ?> sideslist_<?php echo $option_id;?>">
                                                <td class="my-handle">
                                                <span class="save_options edit_<?php echo $option_id ; ?>"  id="edit_<?php echo $option_id ; ?>"  data-attr="<?php echo $option_id ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
                                                <input type="text"  id="saveopt_<?php echo $valu['side_id'] ; ?>" name="opt_name_<?php echo $option_id;?>[]" class=" opt_name_<?php echo $option_id; ?> inputside inputnew" value="<?php echo $valu['side_item']; ?>" data-rel="<?php echo $valu['side_id'] ; ?>" >
                                                </span>
                                                </td>
                                                <td>
                                                <span class="save_optionsprice edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $option_id ; ?>"  data-attr="<?php echo $option_id ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
                                                <input type="text"  id="saveoptprice_<?php echo $valu['side_id'] ; ?>" name="opt_price_<?php echo $option_id;?>[]" class="inputprice opt_price_<?php echo $option_id; ?> inputnew" value="<?php echo $valu['price']; ?>" onkeypress="return isNumber(event)" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $option_id; ?>">
                                                </span>
                                                <input type="hidden"  id="saveopt_<?php //echo $option_id;?>" name="opt_sideid_<?php echo $option_id;?>[]" class="opt_sideid_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_id']; ?>">
                                                </td>
                                                <td>
                                               
                                               
                                                <a href="javascript:void(0);" class="" onclick="delsides(<?php echo $valu['side_id']; ?>,<?php echo $option_id; ?>)" >
                                                	<i class="fa fa-times"></i>
                                                </a>
                    
                                                <?php 
												$i++;
												if($i==count($sidesdetails)){
												?>
												<a href="javascript:void(0);" class="addmoresides sort_<?php echo $option_id; ?>" data-attr="<?php echo $option_id; ?>" data-rel="<?php echo $option_id; ?>">
												<i class="fa fa-plus"></i>
												</a>
												<?php } ?>
                
                                                
												
                
                
                                                </td>
                                            </tr>
                   		 <?php 
							}
						}
					?>
<div class="clearfix"></div>
