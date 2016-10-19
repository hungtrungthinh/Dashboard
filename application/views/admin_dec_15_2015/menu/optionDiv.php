<div class="option_div form_menu_detail pad0" id="option_div_<?php echo $count;?>" data-attr="<?php echo $count;?>"  style="padding-top:5px !important;">
   		<div class="table-responsive">
        <div class="col-md-1 col-sm-1">
        <label class="" for="textinput">OPTION</label></div>
        <div class="col-md-3 col-sm-3">
        <input type="text" name="option_item[]" value="" id="option_item_<?php echo $count;?>" data-attr="<?php echo $count;?>" placeholder="Enter option name" class=" menuclass optionclass form-control" style="" >
        </div>
        <div class="col-md-3 col-sm-3">
                      <span>
                      <input type="checkbox" name="mandatory_<?php echo $count;?>" id="mandatory_<?php echo $count;?>" class="mandatory_<?php echo $count;?>" style="height:15px !important"/>
                      <span>*</span> This is Mandatory</span>
          </div>
           <div class="col-md-3 col-sm-3 ">    
                      
                    <span>   <input type="checkbox" name="multiple_<?php echo $count;?>" id="multiple_<?php echo $count;?>"  class="multiple_check multiple_<?php echo $count;?>" style="height:15px !important"  data-attr="<?php echo $count;?>" />
                      <span></span>Allow multiple options </span>
           </div>
           <div class="col-md-2 col-sm-2 ">         
                    <span class="mul_limit mul_limit_<?php echo $count;?>" data-attr="<?php echo $count;?>" style="color:#34495e; font-size:14px; display:none; ">
                    <span style="font-weight: inherit;">   MAX :</span>
                      <input type="text"  id="mul_lim_<?php echo $count;?>" name="mul_lim_<?php echo $count;?>" class="" value="" style=" height:28px !important; width:70px;" onkeypress="return isNumber(event)" >
                    </span>  
                      
        	</div>
            
            
        </div>
       <div class="clearfix"></div>
       
       
       <div class="table-responsive"   style="padding-top:5px !important;">
       <input type="hidden" name="itemsizecount" value="1" id="itemsizecount_<?php echo $count;?>" >
                    <table class="table table-striped">
                      <thead class="head_table">
                        <tr>
                          <th class="col-md-7 col-sm-7">SIDES</th>
                          <th class="col-md-3 col-sm-3">PRICE</th>
                          <th class="col-md-1 col-sm-1">
                          <a href="javascript:void(0);" class="pull-right hvr-pop plus-style addmore" data-attr="<?php echo $count;?>" style="margin-right:7px;">
                         <i class="fa fa-plus-circle"></i>
                          </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="table_body addmoresize_<?php echo $count;?>">
                           <tr id="sidesdiv_<?php echo $count;?>_1" class="sidesdiv_<?php echo $count;?>">
                                 <td><input type="text" class=" form-control errorsize_<?php echo $count;?> optionsides_<?php echo $count;?>" placeholder="Sides" id="sides_<?php echo $count;?>_1" style="" name="sides_<?php echo $count;?>[]" ></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class=" form-control errorsize_<?php echo $count;?> optionprice_<?php echo $count;?>" placeholder="Price" id="price_<?php echo $count;?>_1" style="" name="price_<?php echo $count;?>[]"></td>  
                                 
                                  <td>
                                   <label class="action pull-right">
                                   <a href="javascript:void(0);" class="delete_row hvr-pop iconstyle" data-attr="<?php echo $count;?>_1" data-val="<?php echo $count;?>"><i class="fa fa-times-circle"></i></a>
                                   
                                  
                                   
                                   </label>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
         </div>
        </div>
        