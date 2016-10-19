                        	<h1>Options and Sides</h1>
                            <div class="option-and-sides-add-remove-links">
                            	<!--<a href="javascript:void(0);"><i class="fa fa-times"></i></a>-->
                                <a href="javascript:void(0);" class="add_option"><i class="fa fa-plus"></i></a>
                            </div>
                            
                            <div id="multi">
                            
                            
                            
		<div class="addmoreptions form-box option-table-container tile" <?php if($page!='plusBtn'){ ?> style=" display:none;" <?php } ?>>
   		<div class="option_div " id="option_div_1" data-attr="1" >
        <span class="multi-handle"><i class="fa fa-arrows-v"></i></span>
		<input type="hidden" name="itemsizecount" value="1" id="itemsizecount_1" >							
                                    <table class="table option-table edit-option-table">
                                        <tbody class="after-768-none">
                                            <tr>
                                                <td>
                                                    <input type="text" name="option_item[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass " style="" >
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                         	<input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_1" id="mandatory_1" class="mandatory_1" />
                                                            <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox"  name="multiple_1" id="multiple_1" data-attr="1" class="multiple_1" />
                                                            Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                	
                                                	<div class="mul_limit mul_limit_1" data-attr="1" >
                                                    <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" value="" style="" placeholder="Max"  onkeypress="return isNumber(event)" >
                                                    </div>
                      
                                                    
                                                </td>
                                                <td>
                                                    <!--<label class="switch">
                                                    	<input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                                                        <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                    </label>-->
                                                </td>
                                                <td>
                                                    <!--<a data-toggle="modal" data-target="#optionDelete" href="javascript:void(0);"><i class="fa fa-times"></i></a>-->
                                                    <a href="javascript:void(0)"  class=""  onclick="deleteall('<?php echo $val['option_id'];?>')"><i class="fa fa-times"></i></a>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                        
                                        
                                        <!-- For Lower Screen Below 768 -->
                                        <tbody class="after-768-show">
                                            <tr>
                                                <td>
                                                    <input type="text" name="option_item_mob[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass " style="" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
															<input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_1" id="mandatory_1" class="mandatory_1" />
                                                            <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox"  name="multiple_1" id="multiple_1" data-attr="1" class="multiple_1" />
                                                            Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                	<div class="mul_limit mul_limit_1" data-attr="1" >
                                                    <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" value="" style="" placeholder="Max"  onkeypress="return isNumber(event)" >
                                                    </div>
                                                	
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <!--<label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                    </label>-->
                                                    <a data-toggle="modal" data-target="#optionDelete" href="javascript:void(0);"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!-- End For Lower Screen Below 768 -->
                                    </table>
                                    
<table class="table table-hover sizes-table tble-drag newli_<?php echo $val['option_id']; ?>"  data-attr="<?php echo $val['option_id']; ?>">
                                        <thead>
                                            <tr>
                                                <th>Sides</th>
                                                <th>Price</th>
                                                <th>
                                                <a href="javascript:void(0);" class="addmore" data-attr="1">
                                                	<i class="fa fa-plus"></i>
                                                </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="tile__list addmoresize_1">
                                        
											<tr id="sidesdiv_1_1" class="sidesdiv_1">
                                                <td class="my-handle">
                                                <input type="text" class="errorsize_1 optionsides_1 newoptside " placeholder="Sides" id="sides_1_1" style="" name="sides_1[]" data-rel="1" ></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class="errorsize_1 newoptprice optionprice_1 " placeholder="Price" id="price_1_1" style="" name="price_1[]" data-rel="1" data-attr="1"></td>  
                                                <td>
                                              
                                                <a href="javascript:void(0);" class="" onclick="delsidesNew('1_1','1')"><i class="fa fa-times"></i></a>
                                               
                                               
                                                </td>
                                            </tr>
                                           
                                            
                                        </tbody>
                                    </table>                                            
   		
        </div>
       <div class="clearfix"></div>
       
       <input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id;?>" >      
       
                    
        </div>
        
                            <?php 
							if(count($options_details)!=0){ 
								$cnt=1;
								foreach($options_details as $val){	?>
            
            
                                <!-- Option Table -->
                                <div class="form-box option-table-container tile opt_<?php echo $itemdetails['item_id'];?>" id="optionlist_<?php echo $val['option_id']; ?>" data-attr="<?php echo $itemdetails['item_id'];?>" data-val="<?php echo $val['option_id']; ?>">
                                	<span class="multi-handle"><i class="fa fa-arrows-v"></i></span>
                                    <!-- Option Table -->
                                    <table class="table option-table edit-option-table">
                                        <tbody class="after-768-none">
                                            <tr>
                                                <td>
                                                    <input type="text"  placeholder="Enter your option name" id="opt_title_<?php echo $val['option_id'] ; ?>" name="opt_title_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['option_name'] ; ?>">
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_<?php echo $val['option_id'] ; ?>" id="mandatory_<?php echo $val['option_id'] ; ?>" class="mandatory_<?php echo $val['option_id'] ; ?> man_opt"  data-attr="<?php echo $val['option_id'] ; ?>">
                                                            <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox" <?php if($val['multiple']=='Y'){?>checked="true"<?php }?> name="multiple_<?php echo $val['option_id'] ; ?>" id="multiple_<?php echo $val['option_id'] ; ?>" class="mul-options1 multiple_<?php echo $val['option_id'] ; ?> mul_opt" data-attr="<?php echo $val['option_id'] ; ?>">
                                                            Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                
                                                	<div class=" mul_limit mul_limit_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo $val['option_id'] ; ?>" style="color:#34495e; font-size:14px;<?php if($val['multiple']=='N') { ?> display:none; <?php } ?>">
                                                    <input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" placeholder="Max"  name="mul_lim_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['limit']; ?>"  onkeypress="return isNumber(event)" >
                                                    </div>
                      
                                                    
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                    	<input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                                                        <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <!--<a data-toggle="modal" data-target="#optionDelete" href="javascript:void(0);"><i class="fa fa-times"></i></a>-->
                                                    <a href="javascript:void(0)"  class=""  onclick="deleteall('<?php echo $val['option_id'];?>')"><i class="fa fa-times"></i></a>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                        
                                        
                                        <!-- For Lower Screen Below 768 -->
                                        <tbody class="after-768-show">
                                            <tr>
                                                <td>
                                                    <input type="text"  placeholder="Enter your option name" id="opt_title_<?php echo $val['option_id'] ; ?>" name="opt_title_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['option_name'] ; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
															<input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_<?php echo $val['option_id'] ; ?>" id="mandatory_<?php echo $val['option_id'] ; ?>" class="mandatory_<?php echo $val['option_id'] ; ?> man_opt"  data-attr="<?php echo $val['option_id'] ; ?>">                                                        
                                                            <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox" <?php if($val['multiple']=='Y'){?>checked="true"<?php }?> name="multiple_<?php echo $val['option_id'] ; ?>" id="multiple_<?php echo $val['option_id'] ; ?>" class="mul-options-mob1 multiple_<?php echo $val['option_id'] ; ?> mul_opt" data-attr="<?php echo $val['option_id'] ; ?>">
                                                            Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                	<div class=" mul_limit mul_limit_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo $val['option_id'] ; ?>" style="color:#34495e; font-size:14px;<?php if($val['multiple']=='N') { ?> display:none; <?php } ?>">
                                                    <input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" placeholder="Max"  name="mul_lim_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['limit']; ?>"  onkeypress="return isNumber(event)" >
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                    </label>
                                                    <a data-toggle="modal" data-target="#optionDelete" href="javascript:void(0);"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!-- End For Lower Screen Below 768 -->
                                    </table>
                                    <!-- End Option Table -->
                                
                                    <!-- Sizes Table -->                            
                                    <table class="table table-hover sizes-table tble-drag newli_<?php echo $val['option_id']; ?>"  data-attr="<?php echo $val['option_id']; ?>">
                                        <thead>
                                            <tr>
                                                <th>Sides</th>
                                                <th>Price</th>
                                                <th>
                                                <a href="javascript:void(0);" class="addmoresides sort_<?php echo $val['option_id']; ?>" data-attr="<?php echo $val['option_id']; ?>" data-rel="<?php echo $val['option_id']; ?>"><i class="fa fa-plus"></i>
                                                </a>
                                                
                                               </th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="tile__list tbodyOpt_<?php echo $val['option_id']; ?>">
                                        <?php 
											if(count($sidesdetails[$val['option_id']])!=0){ 
												$i=0;
												foreach($sidesdetails[$val['option_id']] as $valu){  ?>
											<tr data-attr="<?php echo $valu['side_id'] ; ?>" id="sideslist_<?php echo $valu['side_id'];?>" class="tr_opt_<?php echo $val['option_id'] ; ?>">
                                                <td class="my-handle">
                                                <span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
                                                <input type="text"  id="saveopt_<?php echo $valu['side_id'] ; ?>" name="opt_name_<?php echo $val['option_id'];?>[]" class="addInput opt_name_<?php echo $val['option_id'] ; ?> inputside inputnew" value="<?php echo $valu['side_item']; ?>" data-rel="<?php echo $valu['side_id'] ; ?>" >
                                                </span>
                                                </td>
                                                <td>
                                                <span class="save_optionsprice edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
                                                <input type="text"  id="saveoptprice_<?php echo $valu['side_id'] ; ?>" name="opt_price_<?php echo $val['option_id'];?>[]" class="inputprice opt_price_<?php echo $val['option_id'] ; ?> inputnew" value="<?php echo $valu['price']; ?>" onkeypress="return isNumber(event)" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                                                </span>
                                                <input type="hidden"  id="saveopt_<?php //echo $val['option_id'];?>" name="opt_sideid_<?php echo $val['option_id'];?>[]" class="opt_sideid_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_id']; ?>">
                                                </td>
                                                <td>
                                                
                                                <!--<a href="javascript:void(0);" class="rowDelete" data-target="#rowDelete" data-toggle="modal">
                                                	<i class="fa fa-times"></i>
                                                </a>-->
                                                
                                                <a href="javascript:void(0);" class="" onclick="delsides(<?php echo $valu['side_id']; ?>,<?php echo $val['option_id'] ; ?>)" >
                                                	<i class="fa fa-times"></i>
                                                </a>
                    
                                                <?php 
												$i++;
												if($i==count($sidesdetails[$val['option_id']])){
												?>
												<a href="javascript:void(0);" class="addmoresides sort_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
												<i class="fa fa-plus"></i>
												</a>
												<?php } ?>
                
                
                                                </td>
                                            </tr>
                                            <?php 
												}
											}
											?>
                                            
                                            
                                        </tbody>
                                    </table>
                                    <!-- End Sizes Table -->
                                </div>
                                <!-- End Option Table -->
                               
                                <?php 
									}
								}
								?>
                               
                               
                               
                               
                               
                               
                            </div>


						<div class="bottom-save-btn">
                        	<div class=" row">
                            	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 col-lg-offset-10 col-md-offset-10 col-sm-offset-9 col-xs-offset-8">
                        			<button type="button" class="submit_btn">Save</button>
                                </div>
                            </div>
                        </div>



