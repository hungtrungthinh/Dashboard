<!--<script src="https://raw.github.com/furf/jquery-ui-touch-punch/master/jquery.ui.touch-punch.min.js"></script> 
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
<script src="<?php echo base_url('assets');?>/js/rowsorter.js"></script>
<link href="<?php echo base_url();?>assets/admin_lte/css/hover.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo base_url('assets');?>/js/zebra_dialog.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zebra_dialog.css" type="text/css">	


 <div class="dish-detail"> 
 	<span class="saving" style=" display:none;"></span>
    
    
    <?php if($this->session->flashdata('error_message')!=''){ ?>
 		<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-danger" role="alert" style="display:none;"></div>
    <?php } ?>
    <?php if($this->session->flashdata('success_message')!=''){ ?>
 		<span class="saving" role="alert"><?php echo $this->session->flashdata('success_message'); ?></span>
    <?php }else{ ?>
 		<div class="alert alert-success" role="alert" style="display:none;"></div>
    <?php } ?>
    
	<div class="clearfix"></div>
    <div class="col-md-12">
    
    <div class="col-md-7 col-sm-7 col-xs-7">
    <ol class="breadcrumb cust_brdcrumb" style="margin-top: 7px;">
      <li><a href="<?php echo base_url().$this->user->root;?>/menu/dish">Menu</a></li>
      <?php if($itemdetails['category_name']!='') {?>
      <li class="CatAjax" data-attr="<?php echo $itemdetails['category_id'];?>" ><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png"><span id="brud_cat" style="cursor:pointer;"><?php echo $itemdetails['category_name'];?></span></li><?php } ?>
       <?php if($itemdetails['item_name']!='') {?>
      <li class="active"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png"><span id="brud_item"><?php echo stripslashes($itemdetails['item_name']);?></span></li><?php } ?>
    </ol>
    </div>
    
    <div class="col-md-5 col-sm-5 col-xs-5 ">
      <span style="">
       <a href="javascript:void(0)" class="btn btn-info pull-right submit_btn" style=" color:#fff!important; margin-left: 10px; margin-top: 8px;" >
          SAVE
       </a>
       <a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $itemdetails['category_id'];?>" class="btn btn-info pull-right" style=" color:#fff!important; margin-left: 10px; margin-top: 8px;" id="addcategory">
      	ADD NEW
      </a>
      
      <a href="javascript:void(0)" class="btn btn-info copy_dish pull-right" style="color:#fff!important; margin-top: 8px;" data-attr="<?php echo $itemdetails['category_id'];?>" data-rel="<?php echo $itemdetails['item_id'];?>">
      	COPY
      </a>
      
      
      </span>
    </div>
   
    </div>
    <div class="clearfix"></div>
    
    
    <form role="form" action="<?php echo base_url().$this->user->root;?>/menu/add_dish" method="post" name="formlist" onsubmit="" id="formlist">	
    
    
    <div  class="form-horizontal form_menu_detail" >
    
    <i class="dish_icon"><img src="<?php echo base_url()?>assets/admin_lte/img/icon_dish.png"></i>
    <div class="col-md-12">
    	
        <div class="col-md-6">
            <div class="form-group">
                <label class=" control-label" for="textinput">Category</label>
                <select name="category" id="category" class="form-control menuclass menudishtop" data-val="Category">
                    <option value="">--select--</option>
                    <?php foreach($categorylist as $list){ ?>
                    	<option value="<?php echo $list['category_id']?>" <?php if($list['category_id']==$itemdetails['category_id']){ ?> selected <?php }?>>
							<?php echo $list['category_name']?>
                        </option>
                     <?php } ?>
                </select>
            </div>
        </div>
         
        <div class="col-md-6"  style="padding-right:0px">
            <div class="form-group">
                <label class=" control-label" for="textinput">Menu Item</label>
                <input type="text" name="menu_item" value="<?php echo stripslashes($itemdetails['item_name']);?>" id="menu_item"  placeholder="Menu Item" class="form-control menuclass menudishtop" data-val="Dish Item">
            </div>
        </div>
       
        
        <div class="clearfix"></div>
                            
        <div class="col-md-12 col-sm-12" style="padding-right:0px">
            <div class="form-group">
                <label class=" control-label" for="textinput">Description</label>
                <textarea class="form-control additem menuclass menudishtop" name="description" data-val="Description" id="description" role="4" rows="5"><?php echo stripslashes($itemdetails['item_description']);?></textarea>
            </div>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" id="testcat" value="<?php echo $itemdetails['category_id'];?>">
        <input type="hidden" id="testitem" value="<?php echo stripslashes($itemdetails['item_name']);?>">
        <input type="hidden" id="testdesc" value="<?php echo $itemdetails['item_description'];?>">
        
       </div><div class="clearfix"></div>
       </div>
       <div class="clearfix"></div>
       
       <div  class="form-horizontal form_menu_detail" >
         <div class="col-md-12">
        <?php if(!isset($sizes_details)){ ?>
        <div class="col-md-4">
            <div class="form-group">
            <input type="checkbox" id="nosize" name="nosize" value="no"  >
            <label for="control-label" class=" control-label">This item has different sizes</label>
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
                         	<a href="javascript:void(0);" class="pull-right addmoresizeprice hvr-pop plus-style" data-attr="<?php echo $k;?>">
                                   <i class="fa fa-plus-circle"></i>
                            </a>
                         </th>
                         </tr> 
                        </thead>
                      <tbody class="table_body addmoresize">
                           <tr class="sizediv" id="sizediv_1">
                                 <td><input name="mulsize[]" style="" id="size_1" type="text" placeholder="Size" class="form-control autosize newsizeadd"></td>  
                                  <td><input name="mulprice[]" style="" id="price_1" type="text" placeholder="Price" class="form-control errorsize newpriceadd" onkeypress="return isNumber(event)"></td>  
                                 
                                  <td>
                                    <a href="javascript:void(0);" class="delete_row hvr-pop iconstyle" data-attr="1" data-val="1"><i class="fa fa-times-circle"></i></a>
                                  
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
            <input type="checkbox" id="nosize" name="nosize" value="no" >
            <label for="control-label" class=" control-label">This item has different sizes</label>
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
                         	<a href="javascript:void(0);" class="pull-right addmoresizeprice hvr-pop plus-style" data-attr="<?php echo $k;?>">
                              	<i class="fa fa-plus-circle"></i>
           					</a>
                         </th>
                         </tr> 
                        </thead>
                        
                      <tbody class="table_body addmoresize">
                           <tr class="sizediv" id="sizediv_1">
                                 <td><input name="mulsize[]" style="" id="size_1" type="text" placeholder="Size" class="form-control autosize newsizeadd"></td>  
                                  <td><input name="mulprice[]" style="" id="price_1" type="text" placeholder="Price" class="form-control errorsize newpriceadd" onkeypress="return isNumber(event)"></td>  
                                 
                                  <td>
                                    <a href="javascript:void(0);" class="delete_row hvr-pop iconstyle" data-attr="1" data-val="1"><i class="fa fa-times-circle"></i></a>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
                    
           </span>
        <?php }else{ ?>
        <div class="col-md-4">
  		<div class="form-group">
        <input type="checkbox" id="nosize" name="nosize" value="no" checked="" >
        <label for="control-label" class=" control-label">This item has different sizes</label>
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
                         	<a href="javascript:void(0);" class="pull-right addmoresizeprice hvr-pop plus-style" data-attr="1">
             				 	<i class="fa fa-plus-circle"></i>
           				 	</a>
                         </th>
                         </tr> 
                        </thead>
                        <tbody class="table_body addmoresize"> 
                       <?php $k=1; ?>
						<?php for($i=0;$i<count($sizedata);$i++){ ?>
                           <tr class="sizediv" id="sizediv_<?php echo $k;?>">
                                 <td><input name="mulsize[]" style="" id="size_<?php echo $k;?>" type="text" value="<?php echo stripslashes($sizedata[$i]);?>" placeholder="Size" class="errorsize form-control autosize newsizeadd" data-rel="<?php echo $map_id[$i];?>"></td>  
                                  <td><input name="mulprice[]" style="" id="price_<?php echo $k;?>" type="text" value="<?php echo $pricedata[$i];?>" placeholder="Price" class="errorsize  form-control newpriceadd" onkeypress="return isNumber(event)"></td>  
                                  <td>
                                  <a href="javascript:void(0);" class="delete_row hvr-pop iconstyle" data-attr="<?php echo $k;?>" data-id="<?php echo $map_id[$i];?>"><i class="fa fa-times-circle"></i>
</a>
                                  
                                  </td> 
                                <input name="mulsizeid[]" style="" type="hidden" value="<?php echo stripslashes($map_id[$i]);?>" placeholder="Size" class="">  
                            <?php $k++; ?>
                           </tr> 
                           
                           
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
    <div class="col-lg-12">
    <div class="col-lg-10"></div><div class="col-lg-2">
    	<a href="javascript:void(0);" class="pull-right add_option hvr-pop plus-style"><i class="fa fa-plus-circle"></i></a>
    	<a href="javascript:void(0);" class="pull-right remove_option hvr-pop iconstyle" style="display:none; margin:0px 15px;"><i class="fa fa-times-circle"></i></a>
       	</div>
    </div>
    <div class="clearfix"></div>
    </h4>
    <div class="clearfix"></div>
    
   <!-- umesh-->
   <input type="hidden" name="itemoptioncount" value="1" id="itemoptioncount" >
   
   		<div class="addmoreptions" style="display:none">
   		<div class="option_div form_menu_detail pad0" id="option_div_1" data-attr="1" style="padding-top:5px !important;">
   		<div class="table-responsive" >
        <div class="col-md-1 col-sm-1 ">
        <label class="" for="textinput">OPTION</label></div>
        <div class="col-md-3 col-sm-3">
        
       		<input type="text" name="option_item[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass  form-control" style="" >
        </div> 
         <div class="col-md-3 col-sm-3">
                      <span>
                      <input type="checkbox" name="mandatory_1" id="mandatory_1" class="mandatory_1" style="height:15px !important"/>
                      <span></span> This is Mandatory</span>
          </div>
          <div class="col-md-3 col-sm-3">            
                      
                    <span>   
                    <input type="checkbox"name="multiple_1" id="multiple_1" data-attr='1' class="multiple_1 " style="height:15px !important"/>
                    <span></span>Allow multiple options </span>
            </div>
            <div class="col-md-2 col-sm-2">  
                    <span class="mul_limit mul_limit_1" data-attr="1" style="color:#34495e; font-size:14px; display:none; ">
                    <span style="font-weight: inherit;"> MAX : </span>
                    <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" value="" style=" height:33px !important;width:70px;" onkeypress="return isNumber(event)" >
                    </span>
                    
                      
                      
            </div>            
                      
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
                          <a href="javascript:void(0);" class="pull-right addmore hvr-pop plus-style" data-attr="1">
                          <i class="fa fa-plus-circle"></i>
                          </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="table_body addmoresize_1">
                           <tr id="sidesdiv_1_1" class="sidesdiv_1">
                                 <td><input type="text" class="errorsize_1 optionsides_1 newoptside form-control" placeholder="Sides" id="sides_1_1" style="" name="sides_1[]" data-rel="1" ></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class="errorsize_1 newoptprice optionprice_1 form-control" placeholder="Price" id="price_1_1" style="" name="price_1[]" data-rel="1" data-attr="1"></td>  
                                 
                                  <td>
                                   <label class="action pull-right"><a href="javascript:void(0);" class="delete_rowoptside delete_newrow hvr-pop iconstyle" data-attr="1_1" data-val="1"><i class="fa fa-times-circle"></i></a></label>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
         </div>
        </div>
    
        
    
    <!-- umesh-->
    
<div class="clearfix"></div>    



<div class="clearfix"></div>





  <ul class="exclude1 exclude list sortable" id="">  
  <?php 
		if(count($options_details)!=0){ 
			$cnt=1;
		  	foreach($options_details as $val){//echo $is_mobile;?>
			
              <li id="optionlist_<?php echo $val['option_id']; ?>" data-attr="" >
  				<div class="sides_wp">
                <div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablepad  item_lid">
  <tr  style=" background:none;" >
    <td><h5 class="item_lid"></td>
    <td><span class="saveopttitle edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>">
					  <input type="text"  id="opt_title_<?php echo $val['option_id'] ; ?>" name="opt_title_<?php echo $val['option_id'];?>" class="form-control" value="<?php echo $val['option_name'] ; ?>">
                      </span></td>
    <td><span class="">
                      
                      <input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_<?php echo $val['option_id'] ; ?>" id="mandatory_<?php echo $val['option_id'] ; ?>" class="mandatory_<?php echo $val['option_id'] ; ?> man_opt"  data-attr="<?php echo $val['option_id'] ; ?>">
                      <span></span> This is Mandatory
                      </span></td>
    <td><span class=""> 
                         <input type="checkbox" <?php if($val['multiple']=='Y'){?>checked="true"<?php }?> name="multiple_<?php echo $val['option_id'] ; ?>" id="multiple_<?php echo $val['option_id'] ; ?>" class="multiple_<?php echo $val['option_id'] ; ?> mul_opt" data-attr="<?php echo $val['option_id'] ; ?>">
                      <span></span>Allow multiple options 
                      
                      </span></td>
    <td><span class="">
                      
                      <span class="mul_limit mul_limit_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo $val['option_id'] ; ?>" style="color:#34495e; font-size:14px;<?php if($val['multiple']=='N') { ?> display:none; <?php } ?>"><label style="margin:6px;font-weight: inherit;"> MAX : </label><input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" name="mul_lim_<?php echo $val['option_id'];?>" class="inputnew" value="<?php echo $val['limit']; ?>" style="position:absolute; height:33px; width:50px;" onkeypress="return isNumber(event)" >
                      </span>
                      </label>
                      
                      </span></td>
    <td  style="padding:15px; background:none;"><span class="">
                       
                        
                      <a href="javascript:void(0)"  class="pull-right hvr-pop iconstyle "  onclick="deleteall('<?php echo $val['option_id'];?>')"><i class="fa fa-times-circle"></i></a>
                         
                      <div class="pull-right" style="width:50%"> 
                      
                      <a href="javascript:void(0)"  class="pull-right saveoptions save_<?php echo $val['option_id'];?> glyphicon glyphicon-ok" data-attr="<?php echo $val['option_id'];?>" style="display:none;">
                     	  
                      </a>
                     
                      
                      <span style="margin:0px 15px; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                      <label>
                      <input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                      <span></span>
                      </label>
                      </span>
                    
                      </div>
                      </span></td>
    
    		<?php if($is_mobile==1){ ?>
                <td class="sortarrow" >
                <?php if($cnt==1){ ?>
                    <p style=" display:none;"><a href="javascript:void(0)" style="color:#989898;" class="sort_up" data-item="<?php echo $itemdetails['item_id'];?>" data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-asc"></i></a></p>
                <?php }else{ ?>
                    <p><a href="javascript:void(0)"  class="sort_up" style="color:#989898;" data-item="<?php echo $itemdetails['item_id'];?>" data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-asc"></i></a></p>
                <?php } ?>
                
                <?php if($cnt==count($options_details)){ ?>
                    <p style=" display:none;">
                        <a href="javascript:void(0)"  class="sort_down" style="color:#989898;" data-item="<?php echo $itemdetails['item_id'];?>"  data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-desc"></i></a>
                    </p>
                <?php }else{ ?>
                    <p>
                        <a href="javascript:void(0)"   class="sort_down"  style="color:#989898;" data-item="<?php echo $itemdetails['item_id'];?>" data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-desc"></i></a>
                    </p>
                <?php } ?>
                
                
                </td>
           <?php }?>     
                
    
  </tr>
</table>


<div class="clearfix"></div>     
</div>  
<div>            
<!-- ----------------------------------------------code table------------------------------------------------------------ -->
<!--<table id="diagnosis_list" class="table2 table table-striped newli_<?php echo $val['option_id']; ?>"  data-attr="<?php echo $val['option_id']; ?>" >-->
<table id="diagnosis_list" class="table2 diagnosis_list  newli_<?php echo $val['option_id']; ?>"  data-attr="<?php echo $val['option_id']; ?>" >
<tbody  class="tbodyOpt_<?php echo $val['option_id']; ?>">
<?php 
if(count($sidesdetails[$val['option_id']])!=0){ 
	$i=0;
	foreach($sidesdetails[$val['option_id']] as $valu){  ?>
    <tr data-attr="<?php echo $valu['side_id'] ; ?>" id="sideslist_<?php echo $valu['side_id'];?>" class="ui-sortable-handle tr_opt_<?php echo $val['option_id'] ; ?>">
        <td class="sorter" style="width:30px;">
        	<!--<img src="<?php echo base_url()?>assets/admin_lte/img/grippy_large.png">-->
        </td>
        <td>
            <span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
            	<input type="text"  id="saveopt_<?php echo $valu['side_id'] ; ?>" name="opt_name_<?php echo $val['option_id'];?>[]" class="opt_name_<?php echo $val['option_id'] ; ?> inputside inputnew" value="<?php echo $valu['side_item']; ?>" data-rel="<?php echo $valu['side_id'] ; ?>" style="width:100%" >
            </span>
          
        </td>
    	<td class="tttt">
            <div class="pull-right">
                <label class="action pull-right"></label>
                <label class="rate">+$
                <span class="save_optionsprice edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
                <input type="text"  id="saveoptprice_<?php echo $valu['side_id'] ; ?>" name="opt_price_<?php echo $val['option_id'];?>[]" class="inputprice opt_price_<?php echo $val['option_id'] ; ?> inputnew" value="<?php echo $valu['price']; ?>" onkeypress="return isNumber(event)" style=""  data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                </span>
                                    
                <input type="hidden"  id="saveopt_<?php //echo $val['option_id'];?>" name="opt_sideid_<?php echo $val['option_id'];?>[]" class="opt_sideid_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_id']; ?>">
                                    
                </label>
            
                <?php 
                $i++;
                if($i==count($sidesdetails[$val['option_id']])){
                ?>
                <label class="action pull-right" >
                <a href="javascript:void(0);" class="pull-right addmoresides hvr-pop plus-style sort_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                <i class="fa fa-plus-circle"></i>
                </a>
                </label>
                <?php 
                }else{ ?>
                <label class="action pull-right" >
                    <a href="javascript:void(0);" class="pull-right addmoresides hvr-pop iconstyle sort_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>" style="display:none">
                    <i class="fa fa-plus-circle"></i>
                    </a>
                </label>	
                <?php }	?> 
                <label class="action pull-right">
                    <a href="javascript:void(0);" data-attr="<?php echo $valu['side_id']; ?>" class="delsides hvr-pop iconstyle"  data-val="<?php echo $val['option_id'] ; ?>">
                    <i class="fa fa-times-circle"></i>
                    </a>
                </label>
            </div>
    	</td>
    </tr>
<?php 
	}
}
?>
</tbody>
</table>
                   
<!-- ----------------------------------------------code table------------------------------------------------------------ -->
                   
                   
    </div>               
                   
                   
                   
                   
                   
                   
                    
                    </div>
				
				 </li>

	<?php 
			$cnt++;
			
			}
			
		}
	?>
    
    </ul>
   
   
   </div>
    
    
  
    
<!--   *****************************  -->
    <div class="clearfix"></div>
    <div class="col-md-12 text-right mg_btm15">
    <input type="hidden" name="item_id" id="item_id" value="<?php echo $itemdetails['item_id'];?>" >      
    <button type="button" class="btn btn_save mg_btm15 submit_btn" name="submit_btn" id="submit_btn">Save</button>
    <!--<button type="button" class="btn button_gray cancel" onclick="location.href='<?php echo base_url().$this->user->root;?>/menu/dish'">Cancel</button>-->
    </div>
    <div class="clearfix"></div>
    
	</div><!-- /.row -->
	<div class="clearfix"></div>

</div><!-- /.container -->

</form>


    
    
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  
	 </div>

<style>
.updowntbl:hover{
background:none!important;

}
.admin_body{
	background-color:#FFFFFF;
	border-radius:3px;
}
.form-group{
	margin-right:0px!important;
}

ul,li{list-style-type:none !important; padding:0px;}
</style>

<style>
 .saving{
  background-position: 15px center;
    background-repeat: no-repeat;
    border-radius: 3px;
    box-shadow: 0 0 12px #999999;
	background-color:#F2F2F2;
    margin-left:27%;
	margin-top:-5%;
    opacity: 0.8;
    overflow: hidden;
    padding: 15px 15px 15px 50px;
    pointer-events: auto;
    position: Fixed;
    width: 300px;
	
	z-index:999999999;
    }
</style>

<script>
	 $('body').on('click', '.submit_btn', function () {
		 
			var category = $.trim($('#category').val());
			var menu_item = $('#menu_item').val();  
			var description = $.trim($('#description').val());
			var item_id=$('#item_id').val();
			
			
			//var price = $.trim($('#price_dish').val());
			if ($('#nosize').is(":checked"))
				var nosize='true';
			else
				var nosize='false';
					
			if(category == '' ){
				$('#category').addClass('errorborder');
				return false;
			}else if(menu_item == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#menu_item').addClass('errorborder');
				return false;
			}else{
			
			  var size_array=Array();
			  var price_array=Array();
			  var map_id=Array();
			  var flag=1;
			  
			  //for sizes and Prices
				if ($('#nosize').is(':checked')) {
							$( ".newsizeadd" ).each(function() {
								if($(this).val()==''){
									flag=0;
									$(this).addClass('errorborder');
								}else{
									size_array.push($(this).val());
									map_id.push($(this).attr('data-rel'));
									$(this).removeClass('errorborder');
								}
							});
							$( ".newpriceadd" ).each(function() {
								if($(this).val()==''){
									flag=0;
									$(this).addClass('errorborder');
								}else{
									price_array.push($(this).val());
									$(this).removeClass('errorborder');
									
								}
							});
				} else {
					var price_array = $.trim($('#price_dish').val());
						if(price_array == '' ){
						$('.menuclass').removeClass('errorborder');
						$('#price_dish').addClass('errorborder');
						return false;
						}
					var size_array = "Regular";
					if(price_array!='')
							flag=1;
					else
						flag=0;
						
				}
				
				if($('#mandatory_1').is(":checked"))
				{
					var mandatory='Y';
				}else{
					var mandatory='N';
				}
				if ($('#multiple_1').is(":checked"))
				{
					var multiple='Y';
					var mul_lim=$('#mul_lim_1').val();
				}else{
					var multiple='N';
					var mul_lim=0;
				}	
			
				var optionsides=Array();
			    var optionprice=Array();
				var option_item=$('#option_item_1').val();
				if(option_item!=''){
					$( ".optionsides_1" ).each(function() {
						if($(this).val()==''){
							flag=0;
							$(this).addClass('errorborder');
						}else{
							optionsides.push($(this).val());
							$(this).removeClass('errorborder');
						}
					});
					$( ".optionprice_1" ).each(function() {
						optionprice.push($(this).val());
						$(this).removeClass('errorborder');
					});		
					//alert(option_item);
				}else{
					
				}
				var arrOptid=Array();
				var arrMan=Array();
				var arrMul=Array();
				var arrLimit=Array();
				$( ".mul_opt" ).each(function() {
					var opid=$(this).attr('data-attr');
					arrOptid.push(opid);
					if($('#mandatory_'+opid).is(":checked"))
					{
						arrMan.push("Y");
						
					}else{
						arrMan.push("N");
						
					}
					
				});
				
				$( ".man_opt" ).each(function() {
					var opid=$(this).attr('data-attr');
					if($('#multiple_'+opid).is(":checked"))
					{
						arrMul.push("Y");
						arrLimit.push($('#mul_lim_'+opid).val());
					}else{
						arrMul.push("N");
						arrLimit.push("");	
					}
					
				});
				//alert(arrLimit);
				//alert(arrOptid);
				var newsideArrayID=Array();
				var newsideArray=Array();
				var newPriceArray=Array();
				
				
				$( ".save_optionssss" ).each(function() {
						var opid=$(this).attr('data-attr');
						//if($("#saveopt_"+opid).val()!=''){
							newsideArrayID.push(opid);
							
							newsideArray.push($("#saveopt_new").val());
							//newsideArray.push($("#saveopt_"+opid).val());
						//}
				});
				$( ".save_optionspricesss" ).each(function() {
						var opid=$(this).attr('data-attr');
						newPriceArray.push($("#saveoptprice_"+opid).val());
				});
				
				//alert(newsideArray);	
				 //-----------------------
				//alert(test);				
				if(flag==0){
					$(window).scrollTop(100);
					return false;
					
				}else{
					
				$("#submit_btn").attr('disabled', 'disabled');
				$('.menuclass').removeClass('errorborder');
				$('.alert').hide();
				$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/checkItemExist",
							data : {'category':category,'menu_item':menu_item,'item_id':item_id},
							success: function(response){
								if(response==0){
									$("#submit_btn").removeAttr('disabled', 'disabled');
									$('.alert-danger').show();
									$('.alert-danger').html('Item already exist');
									return false;
								}else{
									
									$.ajax({
										type:'POST',
										url: "<?php echo base_url().$this->user->root;?>/menu/SaveDishItem",
										data : {'category':category,'menu_item':menu_item,'item_id':item_id,'description':description,'price_array':price_array,'size_array':size_array,'map_id':map_id,'nosize':nosize,'optionsides':optionsides,'optionprice':optionprice,'option_item':option_item,'mandatory':mandatory,'multiple':multiple,'mul_lim':mul_lim,'arrOptid':arrOptid,'arrMan':arrMan,'arrMul':arrMul,'newsideArrayID':newsideArrayID,'newsideArray':newsideArray,'newPriceArray':newPriceArray,'arrLimit':arrLimit},
										success: function(response){
											
											$("#submit_btn").removeAttr('disabled', 'disabled');	
											//$('.option_wp').html(response);	
												setTimeout(function(){
														$('.saving').show().html("Item updated successfully");
														$('.saving').fadeOut(5000);
													}, 100);
											//new style 
											
											$(".diagnosis_list tbody").sortable({
												helper: fixHelperModified,
												stop: function(event,ui) {
													renumber_table('.diagnosis_list')
													
													}
											});
																			
											//$(window).scrollTop(0);
											//$(".alert-success").html("Item updated successfully").show();
											
											/*$(".sortable,.sortable2").sortable({
												opacity: 0.5
											});*/
											
											//sorting---------
											
												$(".table2").rowSorter({
													handler: "td.sorter",
													onDrop: function(tbody, row, index, oldIndex) {
														var opt_id	=	$(tbody).parent().attr("data-attr");
														var sideAr=Array();
														$('.tr_opt_'+opt_id).each(function() {
															sideAr.push($(this).attr('data-attr'));
														});
														//alert(sideAr);
														//var data = $(this).sortable('serialize');
														$.ajax({
															data:{'sideslist':sideAr},
															//data: data,
															type: 'POST',
															url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
															success: function(response){
																	//$('.addmoresides').hide();
																	var sid=$(this).attr('data-attr')
																	//alert(sid);
																	var rowCount = $('.sort_'+sid).length;
																	//alert(rowCount);
																}
														});
														//$(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
													}
												}); 
																						
											//---------------------

  
											return true;
										}
									});	
									
									//$('#formlist').submit();
								}
								
							}
						});	
				}
			}
			
			});
			
	//for hide and show the no price selection 
		$('body').on('click', '#nosize', function () {
			if ($(this).is(':checked')) {
				$('.hidenoprice').show();
				$('.shownoprice').hide();
			} else {
				$('.hidenoprice').hide();
				$('.shownoprice').show();
			}
			
		});
			
	//for number validation
	function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 46 || charCode > 57) ) {
				return false;
			}
			return true;
		}
		
	//for add size and price fields
	
	$("body").on("click",".addmoresizeprice", function(e){
		  var rowCount = $('.sizediv').length;
		  var item_id=$('#item_id').val();
		  var flag=1;
		  var size_array=Array();
		  var price_array=Array();
		  var map_id=Array();
		  var itemsizecount = $('#itemsizecount').val();  
		 	 $( ".newsizeadd" ).each(function() {
				if($(this).val()==''){
					flag=0;
					$(this).addClass('errorborder');
				}else{
					size_array.push($(this).val());
					map_id.push($(this).attr('data-rel'));
					$(this).removeClass('errorborder');
				}
			});
			$( ".newpriceadd" ).each(function() {
				if($(this).val()==''){
					flag=0;
					$(this).addClass('errorborder');
				}else{
					price_array.push($(this).val());
					$(this).removeClass('errorborder');
					
				}
			});
				  
		  if(flag==1)
		  {
			$('.errorsize').removeClass('errorborder');
			//var newid=parseInt(rowCount)+1;
			var newid=parseInt(itemsizecount)+1;
			var newcnt=parseInt(itemsizecount)+1;
			
			$.ajax({
					type:'POST',
					url: "<?php echo base_url().$this->user->root;?>/menu/ajaxAddSidePrice",
					data : {'newid':newid,'newcnt':newcnt,'item_id':item_id,'size_array':size_array,'price_array':price_array,'map_id':map_id},
					success: function(response){
						$('.addmoresize').append(response);
						$(".sortable,.sortable2").sortable({
							opacity: 0.5
						});
						return true;
					}
			});	
									
			
			$('#itemsizecount').val(parseInt(itemsizecount)+1);
		  }else{
			 $('#size_'+er).addClass('errorborder');
			 $('#price_'+er).addClass('errorborder'); 
		  }
                          
		   
     });
	 //for update item, category, discription on change
	 $("body").on("blur",".menudishtop", function(e){
		var category = $.trim($('#category').val());
		var menu_item = $.trim($('#menu_item').val());  
		var description = $.trim($('#description').val());
		var item_id=$('#item_id').val();
		var label=$(this).attr('data-val');
		
		
		if(category!='' && menu_item!=''){
			
		
				$('.menudishtop').removeClass('errorborder');
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
								$.ajax({
									type:"post",
									url:"<?php echo base_url().$this->user->root;?>/menu/ajaxUpdateDIshItem",
									data:{'category':category,'menu_item':menu_item,'description':description,'item_id':item_id},
									success:function(data){
										var res= $.parseJSON(data);
										var flag=1;
										
										if($('#testcat').val()!=category){
											$('.saving').show().html('');
											$('.saving').html(label+" saved...");
											flag=0;
										}
										if($('#testitem').val()!=menu_item){
											$('.saving').show().html('');
											$('.saving').html(label+" saved...");
											flag=0;
										}
										if($('#testdesc').val()!=description){
											$('.saving').show().html('');
											$('.saving').html(label+" saved...");
											flag=0;
										}
										if(flag==0){
											setTimeout(function(){
												$('.saving').show();
												$('.saving').fadeOut(5000);
											}, 100);
										}
										
										setTimeout(function(){
											//$('.saving').hide();
										}, 3500);
										$('#testcat').val(res.category_id);
										$('#testitem').val(res.item_name);
										$('#testdesc').val(res.item_description);
										$('#brud_item').html(res.item_name);
										$('#brud_cat').html(res.category_name);
										$('.CatAjax').attr('data-attr',res.category_id);
										
										//$('#edit_'+option_id).hide();
										//$('#span_'+option_id).show();
										//$('#span_'+option_id).text(name);
										return true;
									}
									
								});
							}
							
						}
				});	
				
			
		}else{
			if(category==''){
				$('#category').addClass('errorborder');
			}else{
				$('#menu_item').addClass('errorborder');
			}
			return false;
		}
		
	});
	//link for brudcum
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
	//for delete the size and price row
	$('body').on('click', '.delete_row', function (e) {
		var rowCount = $('.sizediv').length;
		var item_id=$('#item_id').val();
		if(rowCount!=1){
			var id	=$(this).attr("data-attr");
			var sizeid	=$(this).attr("data-id");
			var size=$('#size_'+id).val();
			
			e.preventDefault();
			$.Zebra_Dialog('Are you sure to delete?', {
						'type':     'question',
						'title':    'Delete Size And Price',
						'buttons':  ['OK','Cancel'],
						'onClose':  function(caption) {
						if(caption=='OK'){
							$.ajax({
								type:"post",
								url:"<?php echo base_url().$this->user->root;?>/menu/deleteSize",
								data:{'sizeid':sizeid,'size':size,'item_id':item_id},
								success:function(data){
									$('#sizediv_'+id).animate( {backgroundColor:'#003744'}, 500).fadeOut(500,function() {
									$('#sizediv_'+id).remove();
									$('#price_'+id).val('');
									$('#size_'+id).val('');
									});
									
									return true;
								}
							
							});
							return true;
						}else{
							return false;
						}
					}
			});
								
								
			/*if (confirm("Are you sure to delete?")) {
				$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteSize",
							data:{'sizeid':sizeid,'size':size,'item_id':item_id},
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
				}*/
			
		}else{
			
		}
	});
	
	
	//for option add
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
						var mandatory='Y';
					}else{
						var mandatory='N';
					}
					if ($('.multiple_1').is(":checked"))
					{
						var multiple='Y';
						var mul_lim=$('#mul_lim_1').val();
					}else{
						var multiple='N';
						var mul_lim=0;
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
								data : {'option_item':opitem,'optside':optside,'optprice':optprice,'item_id':item_id,'mandatory':mandatory,'multiple':multiple,'mul_lim':mul_lim},
								success: function(response){
									$('#option_div_'+id).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
										$('#option_div_'+id).remove();	
									});
									$('.option_wp').html(response);	
									$(".sortable,.sortable2").sortable({
											opacity: 0.5
									});
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
			/*if(flag==1){
				$('.menuclass').removeClass('errorborder');
				if($('#option_item_'+count).val()!=''){
					$.ajax({
								type:"post",
								url:"<?php echo base_url().$this->user->root;?>/menu/addOptionDiv",
								data:{'count':count},
								success:function(data){
									//$('.addmoreptions').prepend(data);
									$('#itemoptioncount').val(parseInt(count)+1);
									$(".sortable,.sortable2").sortable({
										opacity: 0.5
									});
								}
							
							});
				}else{
					$('#option_item_'+count).addClass('errorborder');
				}
			}*/
			return true;
		 
		   
     });
	 
	//for add more option sides and price
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
			}
		}
		return false;
		

		   
     });
	 
	 //save option title on change
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
								
								return true;
							}
						
						});
				
			}else{
				$('#opt_title_'+option_id).addClass('errorborder');
				return false;
			}
			
		});
	//save option side name on change	
	 $("body").on("blur",".save_options", function(e){
			var option_id= $(this).attr('data-attr');
			var side_id= $(this).attr('data-rel');
			
			//alert($('#saveopt_'+id).val());
			var value=$('#saveopt_'+side_id).val();
			if(value!=''){
				$.ajax({
						type:"post",
						url:"<?php echo base_url().$this->user->root;?>/menu/saveOptionSideAjax",
						data:{'side_id':side_id,'value':value,'option_id':option_id},
						success:function(data){
							//$('.newli_'+option_id).html(data);
							$(".sortable,.sortable2").sortable({
								opacity: 0.5
							});
						return true;
					}
						
				});
			}else{
				
			}
				
			
		});
		//save option side price  on change	
		$("body").on("blur",".save_optionsprice", function(e){
			
			var option_id= $(this).attr('data-attr');
			var side_id= $(this).attr('data-rel');
			//alert(option_id);
			//alert(side_id);
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
		
			
	$('body').on('click', '.remove_option', function () {
		 $('.option_div').hide();
		 $('.addmoreptions').hide();
		 $('#option_item_1').val(''); 
		 $('.optionsides_1').val(''); 
		 $('.optionprice_1').val(''); 
		 $('.remove_option').hide();
		 $('.add_option').show();  
		 
	  });	

	$('body').on('click', '.delsides', function (e) {
		var sidesid= $(this).attr('data-attr');
		var optionsid= $(this).attr('data-val');
		//if(sidesid!=''){
		
		
			e.preventDefault();
			$.Zebra_Dialog('Are you sure to delete?', {
						'type':     'question',
						'title':    'Delete Sides',
						'buttons':  ['OK','Cancel'],
						'onClose':  function(caption) {
						if(caption=='OK'){
							$.ajax({
									type:"post",
									url:"<?php echo base_url().$this->user->root;?>/menu/deleteSides",
									data:{'sidesid':sidesid,'optionsid':optionsid},
									success:function(data){
										if(data==1){
											$('#sideslist_'+sidesid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
												$('#optionlist_'+optionsid).remove();	
											});
										}else{
										
											$('#sideslist_'+sidesid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
												$('#sideslist_'+sidesid).remove();	
											});
											$.ajax({
												type:"post",
												url:"<?php echo base_url().$this->user->root;?>/menu/ajaxdelShowsides",
												data:{'option_id':optionsid},
												success:function(data){
													//$('.newli_'+optionsid).html(data);
													$('.tbodyOpt_'+optionsid).html(data);
												}
											
											});
											
										}
										return true;
									}
								
								});
							}else{
								return false;
							}
						}
					});	
					
			
		/*}else{
			$('#newside_'+optionsid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
				$('#newside_'+optionsid).remove();	
			});
		}*/
		
	});
	
	
$('body').on('click', '.delete_newrow', function (e) {
	var delid= $(this).attr('data-attr');
	var val= $(this).attr('data-val');
	
	var rowCount = $('.sidesdiv_'+val).length;
	if(rowCount!=1){
			e.preventDefault();
			$.Zebra_Dialog('Are you sure to delete?', {
						'type':     'question',
						'title':    'Delete Sides',
						'buttons':  ['OK','Cancel'],
						'onClose':  function(caption) {
							if(caption=='OK'){
								$('#sidesdiv_'+delid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
									$('#sidesdiv_'+delid).remove();	
								});
							}else{
								return false;	
							}
						}
			});
						
		
		
	}else{
		
	}
});

/*	
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
	*/
	function deleteall(option_id) {
	 		
			$.Zebra_Dialog('Are you sure to delete?', {
						'type':     'question',
						'title':    'Delete Sides',
						'buttons':  ['OK','Cancel'],
						'onClose':  function(caption) {
							if(caption=='OK'){
								$.ajax({
									type:"post",
									url:"<?php echo base_url().$this->user->root;?>/menu/deleteall",
									data:{'option_id':option_id},
									success:function(data){
										//$('.alert-success').show();
										//$('.alert-success').html('Options and sides deleted sucessfully'); 
										setTimeout(function(){
											$('.saving').show().html("Options and sides deleted sucessfully");
											$('.saving').fadeOut(5000);
										}, 100);
															
															
										$('#optionlist_'+option_id).hide();
										return true;
									}
								
								});
							}else{
								return false;	
							}
						}
					});
		
	}
		
	
	
	$("body").on("blur",".save_optionsssss", function(e){
		
		var opt_id= $(this).attr('data-attr');
		//var cnt=$('#option_div_'+addid).attr('data-attr');
		
		var option_item = $('#opt_title_'+opt_id).val();  
		var itemsizecount = $('#itemsizecountpop').val();  
		var flag = 1;
		var optside=Array();
		var optprice=Array();
		var optsideid=Array();
		var rowCount = parseInt($('.opt_name_'+opt_id).length)-1;
		
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
								//$('.addmoresides').hide();
								//$('.newli_'+opt_id).html(response);
							
								//$( ".opt_price_82:nth-last-child(2)" ).css("background-color", "yellow");
							}
						});	
						//alert( ".opt_price_"+opt_id+":nth-last-child("+rowCount+")" );
			
		}else{
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
							//$('.addmoresides').hide();
							$('.tbodyOpt_'+opt_id).html(response);
							//$('.tbodyOpt_'+opt_id).append(response);
						}
					});	
		}else{
			return false;
		}
		
     });	
<!--   *****************************  -->


	$(function() {
		
			setTimeout(function(){
				$('.saving').fadeOut(5000);
			}, 100);
			
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
			//$(".sortable2").disableSelection();
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
					//alert(data);
					//return false;
					// POST to server using $.post or $.ajax
					$.ajax({
						data: data,
						type: 'POST',
						url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
						success: function(response){
								//$('.addmoresides').hide();
								var sid=$(this).attr('data-attr')
								//alert(sid);
								var rowCount = $('.sort_'+sid).length;
								//alert(rowCount);
							}
					});
				}
			});



});
$('body').on('click','.mul_opt,.multiple_1', function(e){
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
/*$('body').on('click','.multiple_1', function(e){
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
		
});*/

			
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
	
	
	$('body').on('click', '.copy_dish', function () {
		var category_id=$(this).attr("data-attr");
		var item_id=$(this).attr("data-rel");
		$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/copyDish",
				data:{'category_id':category_id,'item_id':item_id},
				success:function(data){
					window.location.href="<?php echo base_url().$this->user->root;?>"+"/menu/add_dish/"+category_id+"/"+data;
					//$('.dish-detail').html(data);
					return true;
				}
			
			});
	});

		$('body').on('focus', '.inputside', function () {
			$('.ui-sortable-handle').removeClass('blueborder');
			$(this).parent().parent().parent().addClass('blueborder');
		
		});
		$('body').on('focus', '.inputprice', function () {
			$('.ui-sortable-handle').removeClass('blueborder');
			$(this).parent().parent().parent().parent().parent().addClass('blueborder');
		
		});


<!--   *****************************  -->
</script>
<script>
	$(".table2").rowSorter({
		handler: "td.sorter",
		onDrop: function(tbody, row, index, oldIndex) {
			var opt_id	=	$(tbody).parent().attr("data-attr");
			var sideAr=Array();
			$('.tr_opt_'+opt_id).each(function() {
				sideAr.push($(this).attr('data-attr'));
			});
			//alert(sideAr);
			//var data = $(this).sortable('serialize');
			$.ajax({
				data:{'sideslist':sideAr},
				//data: data,
				type: 'POST',
				url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
				success: function(response){
						//$('.addmoresides').hide();
						//$('.tbodyOpt_'+opt_id).html(response);
						var sid=$(this).attr('data-attr')
						//alert(sid);
						var rowCount = $('.sort_'+sid).length;
						//alert(rowCount);
					}
			});
			//$(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
		}
	});   

//	$(".tableopt").rowSorter({
//		handler: "td.sorter",
//		onDrop: function(tbody, row, index, oldIndex) {
//			var opt_id	=	$(tbody).parent().attr("data-attr");
//			var sideAr=Array();
//			$('.tr_opt_'+opt_id).each(function() {
//				sideAr.push($(this).attr('data-attr'));
//			});
//			//alert(sideAr);
//			//var data = $(this).sortable('serialize');
//			$.ajax({
//				data:{'sideslist':sideAr},
//				//data: data,
//				type: 'POST',
//				url: '<?php //echo base_url().$this->user->root;?>/menu/sortorder',
//				success: function(response){
//						//$('.addmoresides').hide();
//						//$('.tbodyOpt_'+opt_id).html(response);
//						var sid=$(this).attr('data-attr')
//						//alert(sid);
//						var rowCount = $('.sort_'+sid).length;
//						//alert(rowCount);
//					}
//			});
//			//$(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
//		}
//	});   
	
$(document).ready(function() {

	//Helper function to keep table row from collapsing when being sorted
	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index)
		{
		  $(this).width($originals.eq(index).width())
		});
		return $helper;
	};

	//Make diagnosis table sortable
	$(".diagnosis_list tbody").sortable({
    	helper: fixHelperModified,
		update: function(event, ui) {
		var arr = $(this).sortable('serialize');
		//alert(arr);
		$.ajax({
			//data:{'sideslist':arr},
				data: arr,
				type: 'POST',
				url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
				success: function(response){
				//$('.addmoresides').hide();
				var sid=$(this).attr('data-attr')
				//alert(sid);
				var rowCount = $('.sort_'+sid).length;
				//alert(rowCount);
				}
			}); 
	  },
		stop: function(event,ui) {renumber_table('.diagnosis_list')}
	});



});

//Renumber table rows
function renumber_table(tableID) {
	//alert(tableID);
	$(tableID + " tr").each(function() {
		count = $(this).parent().children().index($(this)) + 1;
		$(this).find('.priority').html(count);
	});
}


$('body').on('keypress', '.inputprice', function (e) {

    if(e.which == 13) {
		
		var addid= $(this).attr('data-attr');
		var opt_id= $(this).attr('data-rel');
		//var cnt=$('#option_div_'+addid).attr('data-attr');
		//alert(opt_id);
		var option_item = $('#opt_title_'+opt_id).val();  
		var itemsizecount = $('#itemsizecountpop').val();  
		var flag = 1;
		var optside=Array();
		var optprice=Array();
		var optsideid=Array();
		
		$( ".opt_name_"+opt_id).each(function() {
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
		//alert(flag);
		//$(this).addClass('errorborder');
		$( ".opt_price_"+opt_id).each(function() {
			optprice.push($(this).val());
		});
		
		
		if(flag!=0){
				$.ajax({
						type:'POST',
						url: "<?php echo base_url().$this->user->root;?>/menu/ajaxUpdateItem",
						data : {'option_item':option_item,'options':optside,'price':optprice,'option_id':opt_id,'sidesid':optsideid},
						success: function(response){
							//$('.addmoresides').hide();
							$('.tbodyOpt_'+opt_id).html(response);
							$('.focsize_'+opt_id).focus();
							//$('.tbodyOpt_'+opt_id).append(response);
						}
					});	
		}else{
			return false;
		}
		
     
		
    }
});
$('body').on('keypress', '.inputside', function (e) {
    if(e.which == 13) {
		var opt_id= $(this).attr('data-rel');
		//alert(opt_id);
		if(opt_id!=''){
			$('#saveoptprice_'+opt_id).focus();
			
		}else{
			var opt_id= $(this).attr('data-opt');
			$('.focprice_'+opt_id).focus();
		}
	}
});
$('body').on('keypress', '.newoptside', function (e) {
    if(e.which == 13) {
		var opt_id= $(this).attr('data-rel');
		if(opt_id!=''){
			$('#price_1_'+opt_id).focus();
		}/*else{
			var opt_id= $(this).attr('data-opt');
			$('.focprice_'+opt_id).focus();
		}*/
	}
});

$('body').on('keypress', '.newoptprice', function (e) {
    if(e.which == 13) {
		var opt_id= $(this).attr('data-rel');
		if(opt_id!=''){
		
			
			
		var addid= $(this).attr('data-attr');
		var itemsizecount = $('#itemsizecount_'+addid).val();  
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
			var cn=parseInt(opt_id)+1;	
			
			$('#sides_1_'+cn).focus();			
		}else{
			if($('#sides_'+addid+'_'+itemsizecount).val()==''){
				$('#sides_'+addid+'_'+itemsizecount).addClass('errorborder');
			}
		}
		
		
		return true;
		



		}/*else{
			var opt_id= $(this).attr('data-opt');
			$('.focprice_'+opt_id).focus();
		}*/
	}
});

/*	$(".tableOpt").rowSorter({
		handler: "td.sorteropt",
		onDrop: function(tbody, row, index, oldIndex) {
			var rowoption=Array();
			$('.rowoption').each(function() {
				rowoption.push($(this).attr('data-attr'));
			});
			alert(rowoption);
			//$(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
		}
	});*/
	
/*	$(".diagnosis_list111 tbody").sortable({
    	helper: fixHelperModified,
		update: function(event, ui) {
		var arr = $(this).sortable('serialize');
		alert(arr);return false;
		$.ajax({
			//data:{'sideslist':arr},
				data: arr,
				type: 'POST',
				url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
				success: function(response){
				//$('.addmoresides').hide();
				var sid=$(this).attr('data-attr')
				//alert(sid);
				var rowCount = $('.sort_'+sid).length;
				//alert(rowCount);
				}
			}); 
	  },
		stop: function(event,ui) {renumber_table('.diagnosis_list')}
	});*/
</script>  


<script>
    $('#example3').bind('click', function(e) {
        e.preventDefault();
        $.Zebra_Dialog('Are you sure to delete.?', {
            'type':     'question',
            'title':    'Delete Sides',
            'buttons':  ['OK', 'Cancel'],
            'onClose':  function(caption) {
				if(caption=='OK'){
					alert(caption);
				}else{
					alert(caption);
				}
            }
        });
    });



	
	$('body').on('click', '.sort_up', function () {
		var option=$(this).attr("data-attr");
		var sortno=$(this).attr("data-sort");
		var item_id=$(this).attr("data-item");
		$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/sortUp",
				data:{'option':option,'sortno':sortno,'item_id':item_id},
				success:function(data){
					$('.option_wp').html(data);	
					return true;
				}
			
			});
	});


	
	$('body').on('click', '.sort_down', function () {
		var option=$(this).attr("data-attr");
		var sortno=$(this).attr("data-sort");
		var item_id=$(this).attr("data-item");
		$.ajax({
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/sortDown",
				data:{'option':option,'sortno':sortno,'item_id':item_id},
				success:function(data){
					$('.option_wp').html(data);		
				}
			
			});
	});

</script>



<style>
.tttt{
background:none!important;
}
</style>
