<style>
.admin_body{
	background-color:#FFFFFF;
	border-radius:3px;
}
.form-group{
	margin-right:0px!important;
}
</style>
 <div class=""> 
 	
    <?php if($this->session->flashdata('error_message')!=''){ ?>
 		<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-danger" role="alert" style="display:none;"></div>
    <?php } ?>
    <?php if($this->session->flashdata('success_message')!=''){ ?>
 		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-success" role="alert" style="display:none;"></div>
    <?php } ?>
    
	<div class="clearfix"></div>
    <div class="col-md-12">
    <ol class="breadcrumb cust_brdcrumb">
      <li><a href="<?php echo base_url().$this->user->root;?>/menu/dish">Menu</a></li>
      <?php if($itemdetails['category_name']!='') {?>
     <li class=" CatAjax" data-attr="<?php echo $itemdetails['category_id'];?>" ><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png"><?php echo $itemdetails['category_name'];?></li><?php } ?>
       <?php if($itemdetails['item_name']!='') {?>
      <li class="active"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png"><?php echo $itemdetails['item_name'];?></li><?php } ?>
    </ol>
    <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <form role="form" action="<?php echo base_url().$this->user->root;?>/menu/add_dish" method="post" name="formlist" onsubmit="" id="formlist">	
    <div  class="form-horizontal form_menu_detail" >
    <i class="dish_icon"><img src="<?php echo base_url()?>assets/admin_lte/img/icon_dish.png"></i>
    <div class="col-md-12">
    	
        <div class="col-md-6">
  		<div class="form-group">
        <label class=" control-label" for="textinput">Category</label>
        <select name="category" id="category" class="form-control menuclass ">
        <option value="">--select--</option>
        <?php foreach($categorylist as $list){ ?>
        <option value="<?php echo $list['category_id']?>" <?php if($list['category_id']==$itemdetails['category_id']){ ?> selected <?php }?>><?php echo $list['category_name']?></option>
					<?php } ?>
        </select>
        </div>
        </div>
         
        <div class="col-md-6">
  		<div class="form-group">
        <label class=" control-label" for="textinput">Menu Item</label>
        <input type="text" name="menu_item" value="<?php echo $itemdetails['item_name'];?>" id="menu_item"  placeholder="Menu Item" class="form-control menuclass " >
        </div>
        </div>
       
        
        <div class="clearfix"></div>
        
                    
                    
        <div class="col-md-12 col-sm-12">
        <div class="form-group">
        <label class=" control-label" for="textinput">Description</label>
        <textarea class="form-control additem menuclass" name="description" id="description" role="4"><?php echo stripslashes($itemdetails['item_description']);?></textarea>
        </div>
        </div>
        <div class="clearfix"></div>
        
        
        
        <?php if(!isset($sizes_details)){ ?>
        <div class="col-md-4">
            <div class="form-group">
            <input type="checkbox" id="nosize" name="nosize" value="no" >
            <label for="control-label" class=" control-label">This Item has different Sizes</label>
            </div>
            </div>
            <div class="col-md-7">
            <div class="form-group">
            <span class="shownoprice">
                <input name="price_dish" id="price_dish" type="text" value="<?php echo $sizes_details['prices'];?>" placeholder="Price" onkeypress="return isNumber(event)" class="additem form-control">
            </span>
            </div>
            </div>
            
            
            <div class="clearfix"></div>
            
        <span class="hidenoprice" style=" display:none;">
       			 <table class="table table-striped">
                      <input type="hidden" id="itemsizecount"  name="itemsizecount" value="1">
                      <thead>
                         <tr>
                         <th>Size</th>
                         <th>Price</th>
                         <th>
                         	<a href="javascript:void(0);" class="pull-right addmoresizeprice" data-attr="<?php echo $k;?>">
                                   <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                            </a>
                         </th>
                         </tr> 
                        </thead>
                      <tbody class="table_body addmoresize">
                           <tr class="sizediv" id="sizediv_1">
                                 <td><input name="mulsize[]" style="" id="size_1" type="text" placeholder="Size" class="form-control autosize newsizeadd"></td>  
                                  <td><input name="mulprice[]" style="" id="price_1" type="text" placeholder="Price" class="form-control errorsize newpriceadd" onkeypress="return isNumber(event)"></td>  
                                 
                                  <td>
                                    <a href="javascript:void(0);" class="delete_row" data-attr="1" data-val="1"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
                    
           </span>
        <?php }else{ ?>
        <?php 
		if(count($sizes_details)!=0 && $sizes_details['sizes']=="Regular"){ ?>
            <div class="col-md-4">
            <div class="form-group">
            <input type="checkbox" id="nosize" name="nosize" value="no"  >
            <label for="control-label" class=" control-label">This Item has different Sizes</label>
            </div>
            </div>
            <div class="col-md-8">
            <div class="form-group">
            <span class="shownoprice">
                <input name="price_dish" id="price_dish" type="text" value="<?php echo $sizes_details['prices'];?>" placeholder="Price" onkeypress="return isNumber(event)" class="additem form-control">
            </span>
            </div>
            </div>

            <div class="clearfix"></div>
            <span class="hidenoprice" style=" display:none;">
       			 <table class="table table-striped">
                      <input type="hidden" id="itemsizecount"  name="itemsizecount" value="1">
                      <thead>
                         <tr>
                         <th>Size</th>
                         <th>Price</th>
                         <th>
                         	<a href="javascript:void(0);" class="pull-right addmoresizeprice" data-attr="<?php echo $k;?>">
                              	<img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
           					</a>
                         </th>
                         </tr> 
                        </thead>
                        
                      <tbody class="table_body addmoresize">
                           <tr class="sizediv" id="sizediv_1">
                                 <td><input name="mulsize[]" style="" id="size_1" type="text" placeholder="Size" class="form-control autosize newsizeadd"></td>  
                                  <td><input name="mulprice[]" style="" id="price_1" type="text" placeholder="Price" class="form-control errorsize newpriceadd" onkeypress="return isNumber(event)"></td>  
                                 
                                  <td>
                                    <a href="javascript:void(0);" class="delete_row" data-attr="1" data-val="1"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
                    
           </span>
        <?php }else{ ?>
        <div class="col-md-4">
  		<div class="form-group">
        <input type="checkbox" id="nosize" name="nosize" value="no" >
        <label for="control-label" class=" control-label">This Item has different Sizes</label>
        </div>
        </div>
        <div class="col-md-7" >
            <div class="form-group">
            <span class="shownoprice" style="display:none;">
                <input name="price_dish" id="price_dish" type="text" value="" placeholder="Price" onkeypress="return isNumber(event)" class="additem form-control">
            </span>
            </div>
            </div>
            
            
        <div class="clearfix"></div>
       			<?php 
				$sizedata	=	explode('*',$sizes_details['sizes']);
				$pricedata	=	explode('*',$sizes_details['prices']);
				$size_status	=	explode('*',$sizes_details['size_status']);
				$map_id	=	explode('*',$sizes_details['map_id']);
			//	print_r($size_status);
				?>
        <span class="hidenoprice" style="">
       			 <table class="table table-striped">
                      <input type="hidden" name="itemsizecount" value="<?php echo count($sizedata);?>" id="itemsizecount" >
                      <thead>
                         <tr>
                         <th>Size</th>
                         <th>Price</th>
                         <th>
                         	<a href="javascript:void(0);" class="pull-right addmoresizeprice" data-attr="1">
             				 	<img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
           				 	</a>
                         </th>
                         </tr> 
                        </thead>
                        <tbody class="table_body addmoresize"> 
                       <?php $k=1; ?>
						<?php for($i=0;$i<count($sizedata);$i++){ ?>
                           <tr class="sizediv" id="sizediv_<?php echo $k;?>">
                                 <td><input name="mulsize[]" style="" id="size_<?php echo $k;?>" type="text" value="<?php echo stripslashes($sizedata[$i]);?>" placeholder="Size" class="errorsize form-control autosize newsizeadd"></td>  
                                  <td><input name="mulprice[]" style="" id="price_<?php echo $k;?>" type="text" value="<?php echo $pricedata[$i];?>" placeholder="Price" class="errorsize  form-control newpriceadd" onkeypress="return isNumber(event)"></td>  
                                  <td>
                                  <a href="javascript:void(0);" class="delete_row" data-attr="<?php echo $k;?>" data-id="<?php echo $map_id[$i];?>"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a>
                                  
                                  </td> 
                                  
                            <?php $k++; ?>
                           </tr> 
                           
                           <input name="mulsizeid[]" style="" type="hidden" value="<?php echo stripslashes($map_id[$i]);?>" placeholder="Size" class="">
                           
                           
                            <?php } ?>
                		
                      </tbody>  
                        
                    </table>
                    
           </span>
        
        
        
			
		<?php }
		?>
        
        <?php } ?>
             
                
                    
        
    </div>
    <div class="clearfix"></div>
    
    </div>
    <div class="clearfix"></div>
    
    
    
    
    
    <div class="option_wp">
    <h4 class="label_lid">Options and Sides 
    <a href="javascript:void(0);" class="pull-right add_option"><img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png"></a>
    <a href="javascript:void(0);" class="pull-right remove_option" style="display:none"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a>
    </h4>
    <div class="clearfix"></div>
    
   <!-- umesh-->
   <input type="hidden" name="itemoptioncount" value="1" id="itemoptioncount" >
   
   		<div class="addmoreptions" style="display:none">
   		<div class="option_div form_menu_detail pad0" id="option_div_1" data-attr="1" style="padding-top:5px !important;">
   		<div class="table-responsive" >
        <div class="col-md-2 ">
        <label class="" for="textinput">OPTION</label></div>
        <div class="col-md-4">
        
       		<input type="text" name="option_item[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass form-control" style="" >
        </div> 
         <div class="col-md-3">
                      <span>
                      <input type="checkbox" name="mandatory_1" id="mandatory_1" class="mandatory_1" style="height:15px !important"/>
                      <span>*</span> This is Mandatory</span>
          </div>
          <div class="col-md-3">            
                      
                    <span>   <input type="checkbox" name="multiple_1" id="multiple_1" data-attr="1" class="multiple_1" style="height:15px !important"/>
                     <span>*</span>Allow multiple options </span>
                  	 <br>
                    <span class="mul_limit mul_limit_1" data-attr="1" style="color:#34495e; font-size:14px; display:none; ">
                      Enter The Limit : <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" value="" style=" height:28px !important;" onkeypress="return isNumber(event)" >
                    </span>   
                      
        </div>
        </div>
       <div class="clearfix"></div>
       
       
       <div class="table-responsive"  style="padding-top:5px !important;">
       <input type="hidden" name="itemsizecount" value="1" id="itemsizecount_1" >
                    <table class="table table-striped">
                      <thead class="head_table">
                        <tr>
                          <th class="col-md-6 col-sm-6">SIDES</th>
                          <th class="col-md-4 col-sm-4">PRICE</th>
                          <th class="col-md-1 col-sm-1">
                          <a href="javascript:void(0);" class="pull-right addmore" data-attr="1">
                          <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                          </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="table_body addmoresize_1">
                           <tr id="sidesdiv_1_1" class="sidesdiv_1">
                                 <td><input type="text" class="errorsize_1 form-control optionsides_1" placeholder="Sides" id="sides_1_1" style="" name="sides_1[]" ></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class="errorsize_1 form-control optionprice_1" placeholder="Price" id="price_1_1" style="" name="price_1[]"></td>  
                                 
                                  <td>
                                   <label class="action pull-right"><a href="javascript:void(0);" class="delete_rowoptside" data-attr="1_1" data-val="1"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
         </div>
        </div>
       </div> 
        
        
    
    <!-- umesh-->
    
    
    
    
<div class="clearfix"></div>
  <ul class="exclude1 exclude list sortable" id="">  
  <?php 
		if(count($options_details)!=0){ 
		  	foreach($options_details as $val){ ?>

              <li id="optionlist_<?php echo $val['option_id']; ?>" data-attr="" >
  				<div class="sides_wp">
                    <h5 class="item_lid">
					  <!--<span class="all_options span_<?php echo $val['option_id'];?>" id="span_<?php echo $val['option_id'];?>" title="Double click to edit" data-attr="<?php echo $val['option_id'] ; ?>"><?php echo $val['option_name'] ; ?></span>-->
					  <span class="saveopttitle edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>">
					  <input type="text"  id="opt_title_<?php echo $val['option_id'] ; ?>" name="opt_title_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['option_name'] ; ?>">
                      </span>
                      
                      <span>
                      
                      <input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_<?php echo $val['option_id'] ; ?>" id="mandatory_<?php echo $val['option_id'] ; ?>" class="mandatory_<?php echo $val['option_id'] ; ?>">
                      <span>*</span> This is Mandatory</span>
                      
                      
                    <span>   <input type="checkbox" <?php if($val['multiple']=='Y'){?>checked="true"<?php }?> name="multiple_<?php echo $val['option_id'] ; ?>" id="multiple_<?php echo $val['option_id'] ; ?>" class="multiple_<?php echo $val['option_id'] ; ?>">
                      <span>*</span>Allow multiple options </span>
                      
                          <a href="javascript:void(0)"  class="pull-right "  onclick="deleteall('<?php echo $val['option_id'];?>')"><img src="http://192.168.1.254/forkourse/assets/admin_lte/img/close_icon.png"></a>
                          
                      <div class="pull-right"> 
                      <?php if($itemdetails['item_id']!=''){;?>
                      <?php /*?><a href="javascript:void(0)"  class="pull-right" ><span class="all_options_edit span_<?php echo $val['option_id'];?>  glyphicon glyphicon-edit " id="span_<?php echo $val['option_id'];?>" title="Double click to edit" data-attr="<?php echo $val['option_id'] ; ?>"></span></a><?php */?>
                      <?php }?>
                      <a href="javascript:void(0)"  class="pull-right saveoptions save_<?php echo $val['option_id'];?> glyphicon glyphicon-ok" data-attr="<?php echo $val['option_id'];?>" style="display:none;">
                     	  
                      </a>
                        
                        
                      <!--<a href="javascript:void(0)"  class="pull-right"  onclick="viewPopup('<?php echo $val['option_id'];?>')"><span class="mr_2" data-toggle="modal" data-target="#myModal" >edit</span></a>-->
                      
                      <span style="margin:0; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                      <label>
                      <input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                      <span></span>
                      </label>
                      </span>
                      
                    
                      </div>
                      
                      
                    </h5>
                           

                      
                   <ul class="item_list  list sortable2 newli_<?php echo $val['option_id']; ?>">
                
                <?php 
					if(count($sidesdetails[$val['option_id']])!=0){ 
					$i=0;
		  				foreach($sidesdetails[$val['option_id']] as $valu){  
						
						//print_r($valu);?>
                	
                 
                    <li id="sideslist_<?php echo $valu['side_id']; ?>" class="sideslist_<?php echo $val['option_id'];?> " data-attr=""  >
                  
                    <!--<span class="all_options span_<?php echo $val['option_id'];?> span_<?php echo $val['option_id'];?>_opt" id="side_<?php echo $valu['side_id']; ?>" data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id']; ?>"><?php echo $valu['side_item']; ?></span>-->
					<span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
					 <input type="text"  id="saveopt_<?php echo $valu['side_id'] ; ?>" name="opt_name_<?php echo $val['option_id'];?>[]" class="opt_name_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_item']; ?>" data-rel="<?php echo $valu['side_id'] ; ?>">
                    </span>  
                      
                    <div class="pull-right">
                    <label class="action pull-right"></label>
                    
                    
                    <label class="rate">+$
                   <!-- <span class="all_options span_<?php echo $val['option_id'];?> span_<?php echo $val['option_id'];?>_price" id="price_<?php echo $valu['side_id']; ?>" data-attr="<?php echo $val['option_id'] ; ?> " data-ref="<?php echo $valu['side_id']; ?>">
					<?php echo number_format($valu['price'],2); ?></span>-->
					<span class="save_optionsprice edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
					 <input type="text"  id="saveoptprice_<?php echo $valu['side_id'] ; ?>" name="opt_price_<?php echo $val['option_id'];?>[]" class="opt_price_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['price']; ?>">
                    </span>
                    
                    <input type="hidden"  id="saveopt_<?php echo $val['option_id'];?>" name="opt_sideid_<?php echo $val['option_id'];?>[]" class="opt_sideid_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_id']; ?>">
                    
                    </label>
                    
                   
                    <?php 
					$i++;
					if($i==count($sidesdetails[$val['option_id']])){
                    ?>
					 <label class="action pull-right" >
                    <a href="javascript:void(0);" class="pull-right addmoresides" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                          <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                    </a>
                    </label>
					<?php 
					}else{ ?>
					<label class="action pull-right" >
                    <a href="javascript:void(0);" class="pull-right addmoresides" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>" style="display:none">
                          <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                    </a>
                    </label>	
					<?php }
					
					?> 
                    <label class="action pull-right">
                    <a href="javascript:void(0);" data-attr="<?php echo $valu['side_id']; ?>" class="delsides"  data-val="<?php echo $val['option_id'] ; ?>">
                    	<img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png">
                    </a>
                    </label>
                    </div>
					</li>
                    
                    
                    <?php 
					
					if($i==count($sidesdetails[$val['option_id']])){
					?>
                    <!--<label class="action pull-right">
                    <a href="javascript:void(0);" class="pull-right addmoresides" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                          <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                    </a>
                    </label> -->
                       
                    <!--<li id="newside_<?php echo $valu['side_id']; ?>" class="newside_<?php echo $val['option_id'];?>" data-attr=""  style="display:none;" >
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
					</li>	-->
						  <?php 
					}
					?>
                   
                    
                    
                    <div class="clearfix"></div>
                    
                    
                    
                    
                   		 <?php 
							
							}
							
						}
					?>
                    
                    </ul>
                   <!-- 
                    <label class="action pull-right">
                    <a href="javascript:void(0);" class="pull-right addmoresides" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                          <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                    </a>
                    </label> 
                    -->
                    
                    </div>
				
				 </li>

	<?php 
			}
			
		}
	?>
    
    </ul> 
    

    
    
    
    
    
    
    </div>
    
    
    <!--   *****************************  -->

 
    
    
<!--   *****************************  -->
    <div class="clearfix"></div>
    <div class="col-md-12 text-right mg_btm15">
    <input type="hidden" name="item_id" id="item_id" value="<?php echo $itemdetails['item_id'];?>" >      
    <button type="button" class="btn btn_save mg_btm15" name="submit_btn" id="submit_btn">Save</button>
    <!--<button type="button" class="btn button_gray cancel" onclick="location.href='<?php echo base_url().$this->user->root;?>/menu/dish'">Cancel</button>-->
    </div>
    <div class="clearfix"></div>
    
	</div><!-- /.row -->
	<div class="clearfix"></div>

</div><!-- /.container -->

</form>








    
    
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  
	 </div>
<script>

	  $('body').on('click', '.saveoptions', function () {
		  
		
		var option_id=$(this).attr('data-attr'); 

		var optitle=$('#opt_title_'+option_id).val(); 
		
		if ($('.mandatory_'+option_id).is(":checked"))
		{
			var mandatory='true';
		}else{
			var mandatory='false';
		}
		if ($('.multiple_'+option_id).is(":checked"))
		{
			var multiple='Y';
		}else{
			var multiple='N';
		}
		//alert(multiple);
		
		var opt=new Array();
		$( ".opt_name_"+option_id).each(function() {
			opt.push($(this).val());
		});
		//alert(opt);

		var price=new Array();
		$( ".opt_price_"+option_id).each(function() {
		 	
			price.push($(this).val());
		});
		
		var sidesid=new Array();
		$( ".opt_sideid_"+option_id).each(function() {
		 	
			sidesid.push($(this).val());
		});
	   //alert(sidesid);
	 
			if(optitle == '' ){
				$('#opt_title_'+option_id).addClass('errorborder');
				return false;
			}
			else{
				
				$('.menuclass').removeClass('errorborder');
				$('.alert').hide();
				$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/updateItem",
							data : {'option_item':optitle,'options':opt,'price':price,'option_id':option_id,'sidesid':sidesid,'mandatory':mandatory,'multiple':multiple},
							success: function(response){
								//alert(sidesid);
								//window.location.reload();
								$('.edit_'+option_id).hide();
								$('.save_'+option_id).hide();
                                $('.newside_'+option_id).hide();
								$('.opt_price_'+option_id).show();
								$('.span_'+option_id).show();
								
								var i=0;
								$( ".span_"+option_id+"_opt").each(function() {
									var id= $(this).attr('data-rel');
									$("#side_"+id).text(opt[i]);	
									
									//alert(opt[i]);
									i++;
								});
								var i=0;
								$( ".span_"+option_id+"_price").each(function() {
									var id= $(this).attr('data-ref');
									$("#price_"+id).text(price[i]);	
									
									//alert(opt[i]);
									i++;
								});
							    
								
							}
						});	
				
			}
			
			
		return false;
				
		
			});
			
			
		function option_status(option_id,status){
		var sta=$('.option_status_'+option_id).attr('data-val'); 
		if($('.option_status_'+option_id).attr('data-val')=='Y')
			$('.option_status_'+option_id).attr('data-val','N');
		else
			$('.option_status_'+option_id).attr('data-val','Y');
			//alert(sta);
		$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/OptionStatus",
				data:{'option_id':option_id,'status':sta},
				success:function(data){
					return true;
				}
			
			});
	  }
		$( ".all_options" ).dblclick(function() {
			var id= $(this).attr('data-attr');
			
			$('.edit_'+id).show();
			$('.save_'+id).show();
			$('.span_'+id).hide();
		});
		$('body').on('click', '.all_options_edit', function () {
			var id= $(this).attr('data-attr');
			$('#saveopt_'+id).show();
			$('.edit_'+id).show();
			$('.save_'+id).show();
			$('.span_'+id).hide();
			
			$('#saveopt_'+id).show();
			$('.newside_'+id).show();
			
		});
		$('body').on('click', '.remove_option', function () {
		 $('.option_div').hide(); 
		 $('.remove_option').hide();
		 $('.add_option').show();  
	  });
		
		$("body").on("blur",".saveopttitle", function(e){
			var option_id= $(this).attr('data-attr');
			var side_id= $(this).attr('data-rel');
			if($('#opt_title_'+option_id).val()!=''){
				//alert($('#saveopt_'+id).val());
				var name=$('#opt_title_'+option_id).val();
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/saveOptionAjax",
							data:{'option_id':option_id,'name':name},
							success:function(data){
								//$('#edit_'+option_id).hide();
								//$('#span_'+option_id).show();
								//$('#span_'+option_id).text(name);
								return true;
							}
						
						});
				
			}else{
				$('#opt_title_'+option_id).addClass('errorborder');
				return false;
			}
			
		});
	$('body').on('click', '.addmoresides', function () {
		var addid= $(this).attr('data-attr');
		var opt_id= $(this).attr('data-rel');
		//var cnt=$('#option_div_'+addid).attr('data-attr');
		
		var option_item = $('#opt_title_'+opt_id).val();  
		var itemsizecount = $('#itemsizecountpop').val();  
		var flag = 1;
		var optside=Array();
		var optprice=Array();
		var optsideid=Array();
		
		$( ".opt_name_"+opt_id).each(function() {
			//alert($(this).val());
			if($(this).val()!=''){
				optsideid.push($(this).attr('data-rel'));
				optside.push($(this).val());
				$(this).removeClass('errorborder');
			}else{
				optsideid.push($(this).attr('data-rel'));
				$(this).addClass('errorborder');
				//alert(".opt_name_"+opt_id);
				flag=0;
			}
		});
		//alert(optsideid);
		$( ".opt_price_"+opt_id).each(function() {
			optprice.push($(this).val());
		});
		
		if(flag!=0){
					$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/ajaxUpdateItem",
							data : {'option_item':option_item,'options':optside,'price':optprice,'option_id':opt_id,'sidesid':optsideid},
							success: function(response){
								$('.addmoresides').hide();
								$('.newli_'+opt_id).html(response);
							}
						});	
		}else{
			return false;
		}
		//alert(optside);
		//alert(opt_id);
		/*if(flag!=0){
			//$('.addmoresides').hide();
			$('.newli_'+opt_id).append('<li id="newside_<?php //echo $valu['side_id']; ?>" class="newside_<?php //echo $val['option_id'];?>" data-attr="" ><span class="save_optionssss edit_<?php //echo $val['option_id'] ; ?>"  id="edit_<?php //echo $val['option_id'] ; ?>"  data-attr="'+opt_id+'" data-rel=""><input type="text"  id="saveopt_<?php //echo $val['option_id'] ; ?>" name="opt_name_<?php //echo $val['option_id'];?>[]" class="opt_name_'+opt_id+'" value="" data-rel=""></span><div class="pull-right"><label class="action pull-right"></label><label class="action pull-right"><a href="javascript:void(0);" class="pull-right addmoresides" data-attr="'+opt_id+'" data-rel="'+opt_id+'"><img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png"></a></label><label class="rate">+$<span class="save_optionspricesss edit_'+opt_id+'"  id="edit_'+opt_id+'"  data-attr="'+opt_id+'" data-rel=""  ><input type="text"  id="saveoptprice_<?php //echo $val['option_id'] ; ?>" name="opt_price_<?php //echo $val['option_id'];?>[]" class="opt_price_'+opt_id+'" value=""></span></label></div></li>');

		
		}else{
			return false;
		}*/
		
	
		   
     });
	 
	 $("body").on("blur",".save_options", function(e){
			var option_id= $(this).attr('data-attr');
			var side_id= $(this).attr('data-rel');
			
			//alert($('#saveopt_'+id).val());
			var value=$('#saveopt_'+side_id).val();
				$.ajax({
						type:"post",
						url:"<?php echo base_url().$this->user->root;?>/menu/saveOptionSideAjax",
						data:{'side_id':side_id,'value':value,'option_id':option_id},
						success:function(data){
						$(this).attr('data-rel', '222');
							//$('#edit_'+option_id).hide();
									//$('#span_'+option_id).show();
								//$('#span_'+option_id).text(name);
						return true;
					}
						
				});
				
			
		});
		
		$("body").on("blur",".save_optionsprice", function(e){
			
			var option_id= $(this).attr('data-attr');
			var side_id= $(this).attr('data-rel');
			
			if(side_id==''){
				
			}else{
				if($('#saveoptprice_'+side_id).val()!=''){
					//alert($('#saveopt_'+id).val());
					var value=$('#saveoptprice_'+side_id).val();
					
						$.ajax({
								type:"post",
								url:"<?php echo base_url().$this->user->root;?>/menu/saveOptionPriceAjax",
								data:{'side_id':side_id,'value':value,'option_id':option_id},
								success:function(data){
									//$('#edit_'+option_id).hide();
									//$('#span_'+option_id).show();
									//$('#span_'+option_id).text(name);
									return true;
								}
							
							});
					
				}else{
					$('#saveopt_'+option_id).addClass('errorborder');
					return false;
				}
			}
		});
		
		
				
	$("body").on("click",".add_option", function(e){
		    $('#option_div_1').show(); 
		    $(".addmoreptions").show(); 
			//$(".add_option").hide(); 
			$(".remove_option").show(); 
			var item_id=$('#item_id').val(); 
		    var count = $('#itemoptioncount').val(); 
			
			var flag=1;
			
			$( ".optionclass").each(function() {
				var id=$(this).attr('data-attr');
				//alert(id);
				if($(this).val()!=''){
					$(this).removeClass('errorborder');
					var opitem=$(this).val();
					var optside=Array();
					var optprice=Array();
					
					$( ".optionsides_"+id).each(function() {
						if($(this).val()==''){
							$(this).addClass('errorborder');
							flag=0;
							return false;
						}else{
							optside.push($(this).val());
							$(this).removeClass('errorborder');
						}
							
					});
					$( ".optionprice_"+id).each(function() {
						if($(this).val()==''){
							optprice.push(0);
						}else{
							optprice.push($(this).val());
						}
					});
					
					if ($('.mandatory_'+id).is(":checked"))
					{
						var mandatory='true';
					}else{
						var mandatory='false';
					}
					if ($('.multiple_1').is(":checked"))
					{
						var multiple='Y';
					}else{
						var multiple='N';
					}
					//alert(mandatory);
					//alert(multiple);
				
					if(item_id!=''){
						if(flag!=0){
							//alert("success");
							//alert(optside);
							//alert(optprice);
							
							$.ajax({
								type:'POST',
								url: "<?php echo base_url().$this->user->root;?>/menu/ajaxOptionAndSides",
								data : {'option_item':opitem,'optside':optside,'optprice':optprice,'item_id':item_id,'mandatory':mandatory,'multiple':multiple},
								success: function(response){
									$('#option_div_'+id).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
										$('#option_div_'+id).remove();	
									});
									$('.option_wp').html(response);	
									
								}
							});
						}
					}
				}else{
					flag=0;
					$(this).addClass('errorborder');
					return false;
				}
			
			});
			if(flag==1){
				$('.menuclass').removeClass('errorborder');
				if($('#option_item_'+count).val()!=''){
					$.ajax({
								type:"post",
								url:"<?php echo base_url().$this->user->root;?>/menu/addOptionDiv",
								data:{'count':count},
								success:function(data){
									$('.addmoreptions').prepend(data);
									$('#itemoptioncount').val(parseInt(count)+1);
									 
								}
							
							});
				}else{
					$('#option_item_'+count).addClass('errorborder');
				}
			}
			return false;
		 
		   
     });
	 
	 
	$("body").on("click",".addmore", function(e){
		var addid= $(this).attr('data-attr');
		//var cnt=$('#option_div_'+addid).attr('data-attr');
		
		var itemsizecount = $('#itemsizecount_'+addid).val();  
		//alert(itemsizecount);
		//var count = $('#itemoptioncount').val(); 
		$('.errorsize_'+addid).removeClass('errorborder');
		if($('#sides_'+addid+'_'+itemsizecount).val()!=''){
		
			$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/addSidesDiv",
							data:{'optid':addid,'count':itemsizecount},
							success:function(data){
								$('.addmoresize_'+addid).append(data);
								$('#itemsizecount_'+addid).val(parseInt(itemsizecount)+1);
							}
						
						});
		}else{
			if($('#sides_'+addid+'_'+itemsizecount).val()==''){
				$('#sides_'+addid+'_'+itemsizecount).addClass('errorborder');
				//$('#price_'+addid+'_'+itemsizecount).addClass('errorborder');
			}//else if($('#sides_'+addid+'_'+itemsizecount).val()==''){
				//$('#sides_'+addid+'_'+itemsizecount).addClass('errorborder');
			//}else{
				//$('#price_'+addid+'_'+itemsizecount).addClass('errorborder');
			//}
		}
		return false;
		

		   
     });
	
	
	$('body').on('click', '.delete_rowoptside', function () {
		var delid= $(this).attr('data-attr');
		var val= $(this).attr('data-val');
		
		var rowCount = $('.sidesdiv_'+val).length;
		if(rowCount!=1){

			if (confirm("Are you sure to delete?")) {
				$('#sidesdiv_'+delid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
						$('#sidesdiv_'+delid).remove();	
							
				});

				}else{
					return false;	
				}
			
		}else{
			
		}
	});

     
	$('body').on('click', '.delete_row', function () {
		var rowCount = $('.sizediv').length;

		if(rowCount!=1){
			var id	=$(this).attr("data-attr");
			var sizeid	=$(this).attr("data-id");
			
			if (confirm("Are you sure to delete?")) {
				$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteSize",
							data:{'sizeid':sizeid},
							success:function(data){
								$('#sizediv_'+id).animate( {backgroundColor:'#003744'}, 500).fadeOut(500,function() {
								$('#sizediv_'+id).remove();
								$('#price_'+id).val('');
								$('#size_'+id).val('');
								});
								
								return true;
							}
						
						});
				}else{
					return false;	
				}
			
		}else{
			
		}
	});
	
	
	 $('body').on('click', '#submit_btn', function () {
		 
			var category = $.trim($('#category').val());
			var menu_item = $('#menu_item').val();  
			var price = $.trim($('#price_dish').val());
			var description = $.trim($('#description').val());
			var item_id=$('#item_id').val();
			if(category == '' ){
				$('#category').addClass('errorborder');
				return false;
			}else if(menu_item == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#menu_item').addClass('errorborder');
				return false;
			}/*else if(price == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#price_dish').addClass('errorborder');
				return false;
			}else if(description == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#description').addClass('errorborder');
				return false;
			}*/else{
			
			  var size_array=Array();
			  var price_array=Array();
			  var flag=1;
			  //for sizes and Prices
				if ($('#nosize').is(':checked')) {
							$( ".newsizeadd" ).each(function() {
								if($(this).val()==''){
									$(this).addClass('errorborder');
									flag=1;
								}else{
									$(this).removeClass('errorborder');
									flag=0;
								}
							});
							$( ".newpriceadd" ).each(function() {
								if($(this).val()==''){
									$(this).addClass('errorborder');
									flag=1;
								}else{
									$(this).removeClass('errorborder');
									flag=0;
								}
							});
							
							
						} else {
							if(price == '' ){
								$('.menuclass').removeClass('errorborder');
								$('#price_dish').addClass('errorborder');
								return false;
							}
							var price_array = $('#price').val();
							var size_array = "Regular";
							if(price_array!='')
								flag=0;
							else
								flag=1;
									
						}
				 //-----------------------
				//alert();
				if(flag==1){
					return false;
				}else{
					
				
				$('.menuclass').removeClass('errorborder');
				$('.alert').hide();
				$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/checkItemExist",
							data : {'category':category,'menu_item':menu_item,'item_id':item_id},
							success: function(response){
								if(response==0){
									$('.alert-danger').show();
									$('.alert-danger').html('Item already exist');
									return false;
								}else{
									$('#formlist').submit();
								}
								
							}
						});	
				}
			}
			
			});

	
	$('body').on('click', '.delsides', function () {
		var sidesid= $(this).attr('data-attr');
		var optionsid= $(this).attr('data-val');
		
		if (confirm("Are you sure to delete?")) {
			
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteSides",
							data:{'sidesid':sidesid},
							success:function(data){
								
								
								$('#sideslist_'+sidesid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
									$('#sideslist_'+sidesid).remove();	
								});
								$.ajax({
									type:"post",
									url:"<?php echo base_url().$this->user->root;?>/menu/ajaxdelShowsides",
									data:{'option_id':optionsid},
									success:function(data){
										$('.newli_'+optionsid).html(data);
									}
								
								});
								return true;
							}
						
						});
						
						
		}else{
			return false;	
		}
		
	});

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 46 || charCode > 57) ) {
			return false;
		}
		return true;
	}
	
	$('body').on('click', '.edip_popup', function () {
		var sidesid= $(this).attr('data-attr');
		//alert(sidesid);
		return false;	
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/opo",
							data:{'sidesid':sidesid},
							success:function(data){
								
								$('#sideslist_'+sidesid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
									$('#sideslist_'+sidesid).remove();	
								});
								
								return true;
							}
						
						});
						
		
		
	});


function viewPopup(option_id)
{
	$("#myModal").html("");
	$.ajax({
	type:"post",
	url:"<?php echo base_url().$this->user->root;?>/menu/optionPopup",
	data:{'option_id':option_id},
	success:function(data){
		$("#myModal").html(data);
		//alert(data);
		}
	});
}




function deleteall(option_id) {
		if (confirm("Are you sure to delete?")) {
			
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteall",
							data:{'option_id':option_id},
							success:function(data){
							    $('.alert-success').show();
								$('.alert-success').html('Options and sides deleted sucessfully'); 
								 $('#optionlist_'+option_id).hide();
								return true;
							}
						
						});
						
						
		}else{
			return false;	
		}
		
	}

<!--   *****************************  -->
//****************Sub category relax**********************//
			$('.relax').click(function(){						
				obj = $(this).closest('li');	
				var count=obj.children('ul').children().length;					
				count=(count*35);										
				if(obj.children('ul').css('display') == 'none'){		
					
					$(this).addClass('clicked');
					$(this).removeClass('notclicked');
					obj.attr('style','height:'+count+'px');
					//obj.children('ul').attr('style:','height:'+count+'px')			
					obj.children('ul').removeClass('hide');		
					obj.children('ul').show();											
					// Change image +,- *****************************					
					$(this).children('img').removeAttr('src');
					$(this).children('img').attr('src','<?php echo site_url("assets/images/minus.png");?>');				
				}
				else{
					$(this).addClass('notclicked');
					$(this).removeClass('clicked');
					obj.attr('style','height:30px');
					obj.children('ul').hide();					
					$(".sortable,.sortable2").sortable({
			     		opacity: 0.5
			        });
					// Change image +,- *****************************
					$(this).children('img').removeAttr('src');
					$(this).children('img').attr('src','<?php echo site_url("assets/images/plus.png");?>');		
				}							
			});
		//****************Sub category relax**********************//
		
		
		
$(function() {
			$('.expn_all').click(function(){
				
				if($(this).val()=='Collapse All')
				{					
					$('.clicked').click();
					$('.expn_all').attr('title','Expand All');					
					$('.expn_all').val('Expand All');					
				}
				else
				{					
					$('.notclicked').click();					
					$('.expn_all').attr('title','Collapse All');
					$('.expn_all').val('Collapse All');					
				}
				
			});
			
			
			$(".sortable,.sortable2").sortable({
			     opacity: 0.5
			        });

			$('.sortable').sortable({
				opacity: 0.5,
				axis: 'y',
				update: function (event, ui) {
					var data = $(this).sortable('serialize');
					//alert(data);
					// POST to server using $.post or $.ajax
					$.ajax({
						data: data,
						type: 'POST',
						url: '<?php echo base_url().$this->user->root;?>/menu/optionsortorder'
					});
				}
			});
			
			$('.sortable2').sortable({
				opacity: 0.5,
				axis: 'y',
				update: function (event, ui) {
					var data = $(this).sortable('serialize');
					//return false;
					// POST to server using $.post or $.ajax
					$.ajax({
						data: data,
						type: 'POST',
						url: '<?php echo base_url().$this->user->root;?>/menu/sortorder'
					});
				}
			});



});




<!--   *****************************  -->

		
		$('body').on('click', '#nosize', function () {
			if ($(this).is(':checked')) {
				$('.hidenoprice').show();
				$('.shownoprice').hide();
			} else {
				$('.hidenoprice').hide();
				$('.shownoprice').show();
			}
			
		});
		
	$("body").on("click",".addmoresizeprice", function(e){
		  var rowCount = $('.sizediv').length;
		  //alert(rowCount);
		  var er=1;
		  var flag=1;
		  var itemsizecount = $('#itemsizecount').val();  
		  $( ".sizediv" ).each(function() {
			  	//alert($( this ).attr('id'));
				var id= $(this).attr('id').split('_');
				if($('#size_'+id[1]).val()=='' && $('#price_'+id[1]).val()=='')
				{
					flag=0;
					er=id[1];
				}
		  });
		  
		
		  if(flag==1)
		  {
			$('.errorsize').removeClass('errorborder');
			//var newid=parseInt(rowCount)+1;
			var newid=parseInt(itemsizecount)+1;
			var newcnt=parseInt(itemsizecount)+1;
		 	var tr_content = '<tr class="sizediv" id="sizediv_'+newcnt+'"><td><input name="mulsize[]" id="size_'+newid+'" type="text" value="" placeholder="size" class="form-control autosize newsizeadd"></td><td><input name="mulprice[]" id="price_'+newid+'" type="text" value="" placeholder="price" class="form-control additem newpriceadd" onkeypress="return isNumber(event)"></td><td><a href="javascript:void(0);" class="delete_row" data-attr="'+newcnt+'" data-val="1"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></td></tr>';
		 	$('.addmoresize').append(tr_content);
			<?php /*?>$(".autosize").autocomplete({source: "<?php echo base_url(); ?>index.php/restaurant/autocompletesize",
				minLength: 0,
			}).focus(function () {
   				 $(this).autocomplete("search");
			}); <?php */?>
			$('#itemsizecount').val(parseInt(itemsizecount)+1);
		  }else{
			 $('#size_'+er).addClass('errorborder');
			 $('#price_'+er).addClass('errorborder'); 
		  }
                          
		   
     });

     $('body').on('click', '.CatAjax', function () {
		    
			var cat_id	=$(this).attr("data-attr");
			
			$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/getCat",
				data:{'cat_id':cat_id},
				success:function(data){
					//alert(data)
					
					$('.admin_body').html(data);
					return true;
				}
			
		});
		
	});
	
	$('body').on('click','.multiple_1', function(e){
		if ($(this).is(":checked")){
			var id=$(this).attr("data-attr");
			$('.mul_limit_'+id).show();
			var nosize='true';
		}else{
			var id=$(this).attr("data-attr");
			$('.mul_limit_'+id).hide();
			var nosize='false';
		}
		//alert(nosize);	
			
	});


     </script>
	
<style>
ul,li{list-style-type:none !important; padding:0px;}
</style>

