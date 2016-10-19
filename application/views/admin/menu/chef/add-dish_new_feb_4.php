<style>
 .saving{
  background-position: 15px center;
    background-repeat: no-repeat;
    border-radius: 3px;
    box-shadow: 0 0 12px #999999;
	background-color:#F2F2F2;
    margin-left:45%;
	margin-top:-5%;
    overflow: hidden;
    padding: 15px 15px 15px 15px;
    pointer-events: auto;
    position: relative;
    width: 300px;
	
	z-index:999999999;
    }
</style>
        <span class="saving" style=" display:none;"></span>
        <!-- ===== Start Add Dish ===== -->
       	<section class="main-sec">
            <div class="container-fluid">
            	<!-- Add Dish Form -->
            	<div class="add-dish-form">
                	<!-- Start Form -->
    				<form role="form" action="<?php echo base_url().$this->user->root;?>/menu/add_dish" method="post" name="formlist" onsubmit="" id="formlist">	
                    
                      <input type="hidden" name="item_id" id="item_id" value="<?php echo $itemdetails['item_id'];?>" >      
                    
                    	<!-- Breadcrumb & Save -->
                    	<div class="breadcrumb-save">
                        	<div class="row">
                            	<!-- Breadcrumb -->
                            	<div class="col-lg-6 col-md-6 col-sm-3 col-xs-3 display-ful">
                                	<div class="breadcrumb-box">
                                        <ul>
                                        	<li><a href="<?php echo base_url().$this->user->root;?>/menu/dish">Menu</a></li>
                                        	<?php if($itemdetails['category_name']!='') {?>
      										<li class="CatAjax" data-attr="<?php echo $itemdetails['category_id'];?>">
											<a href="<?php echo base_url().$this->user->root;?>/menu/dish/<?php echo $itemdetails['category_id'];?>">
											<?php echo $itemdetails['category_name'];?>
                                            </a>
                                            </li><?php } ?>
											<?php if($itemdetails['item_name']!='') {?>
                                            <li class="active">
											<?php echo stripslashes($itemdetails['item_name']);?>
                                            </li><?php } ?>
      
                                        </ul>
                                    </div>
                                </div>
                            	<!-- End Breadcrumb -->
                                
                            	<!-- Save Btn Top -->
                            	<div class="col-lg-6 col-md-6 col-sm-9 col-xs-9 display-ful">
                                	<div class="save-btn-top">
                                   		
                                    	<button type="button" class="copy-btn copy_dish" data-attr="<?php echo $itemdetails['category_id'];?>" data-rel="<?php echo $itemdetails['item_id'];?>">COPY</button>
                                        
                                    	<a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $itemdetails['category_id'];?>" id="addcategory"  style="color:#FFFFFF;"><button type="button">ADD NEW</button></a>
                                    	<button type="button" class="submit_btn">Save</button>
                                        
                                    </div>
                                </div>
                                <!-- End Save Btn Top -->
                            </div>
                        </div>
                        <!-- End Breadcrumb & Save -->
                        
                    	<!-- Form Box -->
                        <div class="form-box add-dish-box">
                        	<div class="row">
                            	<!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field">
                                    <select name="category" id="category" class="menuclass menudishtop" data-val="Category">
                                        <option disabled selected>-- Select Category --</option>
                                        <?php foreach($categorylist as $list){ ?>
                                        <option value="<?php echo $list['category_id']?>" <?php if($list['category_id']==$itemdetails['category_id']){ ?> selected <?php }?>><?php echo $list['category_name']?></option>
                                                <?php } ?>
                                    </select>
                
                                    	
                                    </div>
                                </div>
                                <!-- End Form Field -->
                                
                                <!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field">
                                        <input type="text" name="menu_item" class="menuclass menudishtop" value="<?php echo stripslashes($itemdetails['item_name']);?>" id="menu_item"  placeholder="Menu Item"  data-val="Dish Item">
                                    </div>
                                </div>
                                <!-- End Form Field -->
                            </div>
                            
                            <div class="add-dish-field">
                            	<textarea name="description"  class="menuclass menudishtop" data-val="Description" id="description" role="4" rows="5"><?php echo stripslashes($itemdetails['item_description']);?></textarea>
                            </div>
                        </div>
                        <!-- End Form Box -->
        				<input type="hidden" id="testcat" value="<?php echo $itemdetails['category_id'];?>">
        				<input type="hidden" id="testitem" value="<?php echo stripslashes($itemdetails['item_name']);?>">
       					<input type="hidden" id="testdesc" value="<?php echo $itemdetails['item_description'];?>">
                        
                        
                        
                        
                        
                        
                        <?php if(!isset($sizes_details)){ ?>
                    	<!-- Form Box -->
                        <input type="hidden" id="itemsizecount"  name="itemsizecount" value="1">
                        <div class="form-box add-dish-box">
                        	<div class="row">
                            	<!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field label-check">
                                    	<label>
                                        	<input type="checkbox" id="nosize" name="nosize" value="no"> This item has different sizes
                                        </label>
                                    </div>
                                </div>
                                <!-- End Form Field -->
                                
                                <!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field if-check-field shownoprice">
                                        <input name="price_dish" id="price_dish" type="text" value="<?php echo $sizes_details['prices'];?>" placeholder="Price" onkeypress="return isNumber(event)" class="additem">
                                    </div>
                                </div>
                                <!-- End Form Field -->
                            </div>
                            
                            <!-- Sizes Table -->                            
                            <table class="table table-hover sizes-table hidenoprice" style=" display:none;">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>
                                        <a href="javascript:void(0);" class="addmoresizeprice" data-attr="<?php echo $k;?>">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                </th>
                                    </tr>
                                </thead>
                                
                                <tbody class="table_body addmoresize">
                                    <tr class="sizediv" id="sizediv_1">
                                    	<td>
                                        	<input name="mulsize[]" style="" id="size_1" type="text" placeholder="Size" class="addInput newsizeadd">
                                        </td>
                                    	<td>
                                        	<input name="mulprice[]" style="" id="price_1" type="text" placeholder="Price" class="errorsize newpriceadd" onkeypress="return isNumber(event)">
                                        </td>
                                        <td>
                                        <a href="javascript:void(0);" class="delete_row rowDelete" data-attr="1" data-val="1"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <!-- End Sizes Table -->
                        </div>
                        <!-- End Form Box -->
                        <?php }else{ ?>
                        <?php if(count($sizes_details)!=0 && $sizes_details['sizes']=="Regular"){  ?>
                        
                      		<input type="hidden" id="itemsizecount"  name="itemsizecount" value="1">
							<div class="form-box add-dish-box">
                        	<div class="row">
                            	<!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field label-check">
                                    	<label>
                                        	<input type="checkbox" id="nosize" name="nosize" value="no">This item has different sizes
                                        </label>
                                    </div>
                                </div>
                                <!-- End Form Field -->
                                
                                <!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field if-check-field shownoprice">
                						<input name="price_dish" id="price_dish" type="text" value="<?php echo $sizes_details['prices'];?>" placeholder="Price" onkeypress="return isNumber(event)" class="">
                                    </div>
                                </div>
                                <!-- End Form Field -->
                            </div>
                            
                            <!-- Sizes Table -->                            
                            <table class="table table-hover sizes-table hidenoprice" style="display:none;">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>
                                            <a href="javascript:void(0);" class="addmoresizeprice" data-attr="<?php echo $k;?>">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody class="addmoresize">
                                   
                                   
                                    <tr class="sizediv" id="sizediv_1">
                                    	<td>
                                        <input name="mulsize[]" style="" id="size_1" type="text" placeholder="Size" class="addInput newsizeadd" value="<?php echo $sizes_details['sizes'];?>" data-rel="<?php echo $sizes_details['map_id'];?>">
                                        </td>  
                                  		<td><input name="mulprice[]" style="" id="price_1" type="text" placeholder="Price" class="errorsize newpriceadd" onkeypress="return isNumber(event)" value="<?php echo $sizes_details['prices'];?>"></td>  
                                        <td>
                                        	<a href="javascript:void(0);" class="rowDelete" data-attr="1" data-val="1"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Sizes Table -->
                        </div>
                        
        <?php }else{ 
				$sizedata	=	explode('*',$sizes_details['sizes']);
				$pricedata	=	explode('*',$sizes_details['prices']);
				$size_status	=	explode('*',$sizes_details['size_status']);
				$map_id	=	explode('*',$sizes_details['map_id']);
			//	print_r($size_status);
				?>
                
                <input type="hidden" name="itemsizecount" value="<?php echo count($sizedata);?>" id="itemsizecount" >
						<div class="form-box add-dish-box">
                        	<div class="row">
                            	<!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field label-check">
                                    	<label>
       										<input type="checkbox" id="nosize" name="nosize" value="no" checked="" >
                                        	This item has different sizes
                                        </label>
                                    </div>
                                </div>
                                <!-- End Form Field -->
                                
                                <!-- Form Field -->
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="add-dish-field if-check-field shownoprice" style="display:none;">
                						<input name="price_dish" id="price_dish" type="text" value="" placeholder="Price" onkeypress="return isNumber(event)" class="">
                                    </div>
                                </div>
                                <!-- End Form Field -->
                            </div>
                            
                            <!-- Sizes Table -->                            
                            <table class="table table-hover sizes-table hidenoprice" style="display:block;">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>
                                        <a href="javascript:void(0);" class="addmoresizeprice" data-attr="1">
                                        	<i class="fa fa-plus"></i>
                                        </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table_body addmoresize"> 
								   <?php $k=1; ?>
                                    <?php for($i=0;$i<count($sizedata);$i++){ ?>
                                       <tr class="sizediv" id="sizediv_<?php echo $k;?>">
                                             <td><input name="mulsize[]" style="" id="size_<?php echo $k;?>" type="text" value="<?php echo stripslashes($sizedata[$i]);?>" placeholder="Size" class="errorsize newsizeadd" data-rel="<?php echo $map_id[$i];?>"></td>  
                                              <td><input name="mulprice[]" style="" id="price_<?php echo $k;?>" type="text" value="<?php echo $pricedata[$i];?>" placeholder="Price" class="errorsize newpriceadd" onkeypress="return isNumber(event)"></td>  
                                              <td>
                                              <a href="javascript:void(0);" class="rowDelete" data-attr="<?php echo $k;?>" data-id="<?php echo $map_id[$i];?>"><i class="fa fa-times"></i></a>
                                              <!--<a href="javascript:void(0);" class="delete_row rowDelete" data-attr="<?php echo $k;?>" data-id="<?php echo $map_id[$i];?>"><i class="fa fa-times-circle"></i>
</a>-->
                                              
                                              </td> 
                                            <input name="mulsizeid[]" style="" type="hidden" value="<?php echo stripslashes($map_id[$i]);?>" placeholder="Size" class="">  
                                        <?php $k++; ?>
                                       </tr> 
                                       
                                       
                                        <?php } ?>
                              	</tbody>
                      
                            </table>
                            <!-- End Sizes Table -->
                        </div>
                        
        <?php }	?>
                <?php } ?>
                        
                        
                        
                        
                        
                        
                        
                        
                        <!-- Options & Sides -->
                        <div class="option-and-sides option_wp">
                        	<h1>Options and Sides</h1>
                            <div class="option-and-sides-add-remove-links">
                            	<!--<a href="javascript:void(0);"><i class="fa fa-times"></i></a>-->
                                <a href="javascript:void(0);" class="add_option"><i class="fa fa-plus"></i></a>
                            </div>
                            
                            <div id="multi">
                            
                            
                            
                            
		<div class="addmoreptions form-box option-table-container tile" style="display:none">
   		<div class="option_div " id="option_div_1" data-attr="1" >
        <span class="multi-handle"><i class="fa fa-arrows-v"></i></span>
		<input type="hidden" name="itemsizecount" value="1" id="itemsizecount_1" >							
                                    <table class="table option-table edit-option-table">
                                        <tbody class="after-768-none">
                                            <tr >
                                                <td>
                                                    <input type="text" name="option_item[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass " style="" >
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox" name="mandatory_1" id="mandatory_1" class="mandatory_1" style=""/>
                                                            <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox"name="multiple_1" id="multiple_1" data-attr='1' class="mul-options1 multiple_1 " style=""/>
                                                            Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                
                                                	<div class="mul_limit mul_limit_1" data-attr="1" style="display:none;" >
                                                    <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" value="" placeholder="MAX"  onkeypress="return isNumber(event)" >
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
                                                    <!--<a href="javascript:void(0)"  class=""  onclick="deleteall('<?php echo $val['option_id'];?>')"><i class="fa fa-times"></i></a>-->
                                                    <a href="javascript:void(0);" class="remove_option" style="display:none;"><i class="fa fa-times"></i></a>

                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                        
                                        
                                        <!-- For Lower Screen Below 768 -->
                                        <tbody class="after-768-show">
                                            <tr>
                                                <td>
                                                    <input type="text" name="option_item[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass " style="" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
															<input type="checkbox" name="mandatory_1" id="mandatory_1" class="mandatory_1" style=""/>
                                                            <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                        	<input type="checkbox"name="multiple_1" id="multiple_1" data-attr='1' class="mul-options 1multiple_1 " style=""/>
                                                            Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                	<div class="mul_limit mul_limit_1" data-attr="1" >
                                                    <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" placeholder="MAX" value="" style="" onkeypress="return isNumber(event)" >
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
                                              
                                                <a href="javascript:void(0);" class="delete_newrow" onclick="delsidesNew('1_1','1')"><i class="fa fa-times"></i></a>
                                               
                                               
                                                </td>
                                            </tr>
                                           
                                            
                                        </tbody>
                                    </table>                                            
   		
        </div>
       <div class="clearfix"></div>
       
       
       
                    
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
                                                
                                                	<div class=" mul_limit mul_limit_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo $val['option_id'] ; ?>" style=" <?php if($val['multiple']=='N') { ?> display:none; <?php } ?>">
                                                    <input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" name="mul_lim_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['limit']; ?>" placeholder="MAX"  onkeypress="return isNumber(event)" >
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
                                                    <input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" name="mul_lim_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['limit']; ?>" placeholder="MAX"  onkeypress="return isNumber(event)" >
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
											<tr data-attr="<?php echo $valu['option_id'] ; ?>" data-val="<?php echo $valu['side_id'] ; ?>" id="sideslist_<?php echo $valu['side_id'];?>" class="tr_opt_<?php echo $val['option_id'] ; ?>">
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
                        </div>
                        <!-- End Options & Sides -->
                        
                        
                        
                        
                        <!-- Bottom Save Button -->
                        <div class="bottom-save-btn">
                        	<div class=" row">
                            	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 col-lg-offset-10 col-md-offset-10 col-sm-offset-9 col-xs-offset-8">
                        			<button type="button" class="submit_btn">Save</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Bottom Save Button -->
                    </form>
                    <!-- End Start Form -->
                </div>
                <!-- End Add Dish Form -->
            </div>
        </section>
        <!-- ===== End Add Dish ===== -->
        




        
        <!-- Delete Row -->
        <div class="cat-delete modal fade" id="rowDelete" tabindex="-1" role="dialog" aria-labelledby="cat-delete-dish">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <input type="hidden" id="delID" value="" />   
                    <input type="hidden" id="delSideID" value="" />   
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Size</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <!-- End Modal Body -->
                        
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button type="button" aria-label="Close" data-dismiss="modal" class="dlt-ok delete_row" id="btnDelteYes">Ok</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button aria-label="Close" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>
        <!-- End Delete Row -->  

        <!-- Delete Row -->
        <div class="cat-delete modal fade" id="rowDeleteSide" tabindex="-1" role="dialog" aria-labelledby="cat-delete-dish">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <input type="hidden" id="delsidesid" value="" />   
                    <input type="hidden" id="deloption_id" value="" />   

                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Side</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <!-- End Modal Body -->
                        
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button type="button" aria-label="Close" data-dismiss="modal" class="dlt-ok delete_rowSide" id="btnDelteYes">Ok</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button aria-label="Close" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>
        <!-- End Delete Row -->  
        
        <!-- Delete Newly added options side Row -->
        <div class="cat-delete modal fade" id="rowDeleteSideNew" tabindex="-1" role="dialog" aria-labelledby="cat-delete-dish">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <input type="hidden" id="delsidesidNew" value="" />   
                    <input type="hidden" id="deloption_idNew" value="" />   

                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Side</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <!-- End Modal Body -->
                        
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button type="button" aria-label="Close" data-dismiss="modal" class="dlt-ok delete_newrow" id="btnDelteYes">Ok</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button aria-label="Close" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>
        <!-- End Newly added options side Row -->
        
        <!-- Delete Option -->
        <div class="cat-delete modal fade" id="optionDelete" tabindex="-1" role="dialog" aria-labelledby="delete-option">
           <input type="hidden" id="delOptionID" value="" />   
        
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Option</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <!-- End Modal Body -->
                        
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button type="button" onclick="delOption()" aria-label="Close" data-dismiss="modal" class="dlt-ok" id="btnDelteYes">Ok</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button aria-label="Close" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>
        <!-- End Delete Option --> 
        
        <!-- No Delete First Row -->
        <div class="cat-delete modal fade" id="noDeleteFirstRow" tabindex="-1" role="dialog" aria-labelledby="cat-delete-dish">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Side</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>First row can't be deleted</p>
                    </div>
                    <!-- End Modal Body -->
                        
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                    	<div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9 display-ful-480">
                                <button data-dismiss="modal" aria-label="Close">Ok</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>



<script>
	//for uncheck and check no size
		$('body').on('click', '#nosize', function () {
			if ($(this).is(':checked')) {
				$('.hidenoprice').show();
				$('.shownoprice').hide();
			} else {
				$('.hidenoprice').hide();
				$('.shownoprice').show();
			}
			
		});
		
	//for copy dish item	
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
								//$('.alert-danger').show();
								//$('.alert-danger').html('Item already exist');
								setTimeout(function(){
														$('.saving').show().html("Item already exists");
														$('.saving').fadeOut(5000);
													}, 100);
								$('#menu_item').addClass('errorborder');
								return false;
							}else{
								$('#menu_item').removeClass('errorborder');
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
		
		  //  alert(flag);
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
			 //$('#size_'+er).addClass('errorborder');
			 //$('#price_'+er).addClass('errorborder'); 
		  }
                          
		   
     });
	 
	 
	//for delete the size and price row
	$('body').on('click', '.rowDelete', function (e) {
		var id	=$(this).attr("data-attr");
		var sizeid	=$(this).attr("data-id");
		$('#delID').val(id);
		$('#delSideID').val(sizeid);
		var rowCount = $('.sizediv').length;

		if(rowCount!=1){
			$("#rowDelete").modal('show');
		}else{
			$("#noDeleteFirstRow").modal('show');
		}
		
	});
		
	
	$('body').on('click', '.delete_row', function (e) {
	
	
			var item_id=$('#item_id').val();
			var id	=$('#delID').val();
			var sizeid	=$('#delSideID').val();
			var size=$('#size_'+id).val();
			
			
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
	
	
	//to change the status of options
		
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
    //to delete options 
	function delOption(){
		var option_id=$('#delOptionID').val();
		$.ajax({
					type:"post",
					url:"<?php echo base_url().$this->user->root;?>/menu/deleteall",
					data:{'option_id':option_id},
					success:function(data){
						//$('.alert-success').html('Options and sides deleted sucessfully'); 
						setTimeout(function(){
							$('.saving').show().html("Options and sides deleted sucessfully");
							$('.saving').fadeOut(5000);
						}, 100);
						$('#optionlist_'+option_id).hide();
						return true;
					}
								
		});
	}
	function deleteall(option_id) {
		$('#delOptionID').val(option_id);
		$("#optionDelete").modal('show');
	}
		
	
	//function to add one more sides in option
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

	//function to delete newly added sides
	function delsidesNew(sidesid,option_id) {
		$('#delsidesidNew').val(sidesid);
		$('#deloption_idNew').val(option_id);
		$("#rowDeleteSideNew").modal('show');
	}
	
	$('body').on('click', '.delete_newrow', function (e) {
		
		var delid= $('#delsidesidNew').val();
		var val= $('#deloption_idNew').val();
		
		var rowCount = $('.sidesdiv_'+val).length;

			$('#sidesdiv_'+delid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
				$('#sidesdiv_'+delid).remove();	
			});
								
	});

    //function to delete the sides
	
	function delsides(sidesid,option_id) {
		$('#delsidesid').val(sidesid);
		$('#deloption_id').val(option_id);
		$("#rowDeleteSide").modal('show');
	}
	
 	$('body').on('click', '.delete_rowSide', function (e) {
		var sidesid= $('#delsidesid').val();
		var optionsid= $('#deloption_id').val();
		
		

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
							
					
			
		
	});    
     
     
	//function for add option
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
					//alert(multiple);
					//alert(mul_lim);
					//return false;
				
					if(item_id!=''){
						if(flag!=0){
							//alert("success");
							
							
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
     
     
    //function to hide newly added option
	$('body').on('click', '.remove_option', function () {
		 $('.option_div').hide();
		 $('.addmoreptions').hide();
		 $('#option_item_1').val(''); 
		 $('.optionsides_1').val(''); 
		 $('.optionprice_1').val(''); 
		 $('.remove_option').hide();
		 $('.add_option').show();  
		 
	  });     
     
     
     
     
     
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
									//$('.alert-danger').show();
									//$('.alert-danger').html('Item already exist');
									
									$('#menu_item').addClass('errorborder');
											setTimeout(function(){
														$('.saving').show().html("Item already exists");
														$('.saving').fadeOut(5000);
													}, 100);
									return false;
								}else{
									$('#menu_item').removeClass('errorborder');
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
	$('body').on('focus', '.inputside', function () {
				$('.ui-sortable-handle').removeClass('blueborder');
				$(this).parent().parent().parent().addClass('blueborder');
			
	});
	$('body').on('focus', '.inputprice', function () {
				$('.ui-sortable-handle').removeClass('blueborder');
				$(this).parent().parent().parent().parent().parent().addClass('blueborder');
			
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
	
 </script>
 