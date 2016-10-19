
        
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
                                        
                                    	<button type="button" ><a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $itemdetails['category_id'];?>" id="addcategory">ADD NEW</a></button>
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
                        <div class="option-and-sides">
                        	<h1>Options and Sides</h1>
                            <div class="option-and-sides-add-remove-links">
                            	<a href="javascript:void(0);"><i class="fa fa-times"></i></a>
                            	<a href="javascript:void(0);"><i class="fa fa-plus"></i></a>
                            </div>
                            
                            <div id="multi">
                                <!-- Option Table -->
                                <div class="form-box option-table-container tile">
                                	<span class="multi-handle"><i class="fa fa-arrows-v"></i></span>
                                    <!-- Option Table -->
                                    <table class="table option-table edit-option-table">
                                        <tbody class="after-768-none">
                                            <tr>
                                                <td>
                                                    <input type="text" placeholder="Enter your option name">
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox"> <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox" id="mul-options1"> Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="max-input-box1">
                                                        <input type="text" placeholder="Max">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#optionDelete" href="javascript:void(0);"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                        <!-- For Lower Screen Below 768 -->
                                        <tbody class="after-768-show">
                                            <tr>
                                                <td>
                                                    <input type="text" placeholder="Enter your option name">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox"> <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox" id="mul-options-mob1"> Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="max-input-box-mob1">
                                                        <input type="text" placeholder="Max">
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
                                    <table class="table table-hover sizes-table tble-drag">
                                        <thead>
                                            <tr>
                                                <th>Sides</th>
                                                <th>Price</th>
                                                <th><a href="javascript:void(0);"><i class="fa fa-plus"></i></a></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="tile__list">
                                            <tr>
                                                <td class="my-handle"><input type="text" placeholder="Sides" class="addInput" /></td>
                                                <td><input type="text" placeholder="Price" /></td>
                                                <td><a href="javascript:void(0);" class="rowDelete" data-target="#noDeleteFirstRow" data-toggle="modal"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" placeholder="Sides" class="addInput" /></td>
                                                <td><input type="text" placeholder="Price" /></td>
                                                <td><a href="javascript:void(0);" class="rowDelete" data-target="#rowDelete" data-toggle="modal"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" placeholder="Sides" class="addInput" /></td>
                                                <td><input type="text" placeholder="Price" /></td>
                                                <td><a href="javascript:void(0);" class="rowDelete" data-target="#rowDelete" data-toggle="modal"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" placeholder="Sides" class="addInput" /></td>
                                                <td><input type="text" placeholder="Price" /></td>
                                                <td><a href="javascript:void(0);" class="rowDelete" data-target="#rowDelete" data-toggle="modal"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- End Sizes Table -->
                                </div>
                                <!-- End Option Table -->
                                
                                <!-- Option Table -->
                                <div class="form-box option-table-container tile">
                                	<span class="multi-handle"><i class="fa fa-arrows-v"></i></span>
                                    <!-- Option Table -->
                                    <table class="table option-table edit-option-table">
                                        <tbody class="after-768-none">
                                            <tr>
                                                <td>
                                                    <input type="text" placeholder="Enter your option name">
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox"> <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox" id="mul-options2"> Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="max-input-box2">
                                                        <input type="text" placeholder="Max">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#optionDelete" href="javascript:void(0);"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                        <!-- For Lower Screen Below 768 -->
                                        <tbody class="after-768-show">
                                            <tr>
                                                <td>
                                                    <input type="text" placeholder="Enter your option name">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox"> <span>*</span>This is Mandatory
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="label-check-box">
                                                        <label>
                                                            <input type="checkbox" id="mul-options-mob2"> Allow multiple options
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="max-input-box-mob2">
                                                        <input type="text" placeholder="Max">
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
                                    <table class="table table-hover sizes-table tble-drag">
                                        <thead>
                                            <tr>
                                                <th>Sides</th>
                                                <th>Price</th>
                                                <th><a href="javascript:void(0);"><i class="fa fa-plus"></i></a></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="tile__list">
                                            <tr>
                                                <td><input type="text" placeholder="Sides" class="addInput" /></td>
                                                <td><input type="text" placeholder="Price" /></td>
                                                <td><a href="javascript:void(0);" class="rowDelete" data-target="#noDeleteFirstRow" data-toggle="modal"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" placeholder="Sides" class="addInput" /></td>
                                                <td><input type="text" placeholder="Price" /></td>
                                                <td><a href="javascript:void(0);" class="rowDelete" data-target="#rowDelete" data-toggle="modal"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" placeholder="Sides" class="addInput" /></td>
                                                <td><input type="text" placeholder="Price" /></td>
                                                <td><a href="javascript:void(0);" class="rowDelete" data-target="#rowDelete" data-toggle="modal"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- End Sizes Table -->
                                </div>
                                <!-- End Option Table -->
                            </div>
                        </div>
                        <!-- End Options & Sides -->
                        
                        <!-- Bottom Save Button -->
                        <div class="bottom-save-btn">
                        	<div class=" row">
                            	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 col-lg-offset-10 col-md-offset-10 col-sm-offset-9 col-xs-offset-8">
                        			<button>Save</button>
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
        
        <!-- Delete Option -->
        <div class="cat-delete modal fade" id="optionDelete" tabindex="-1" role="dialog" aria-labelledby="delete-option">
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
                                <button aria-label="Close" data-dismiss="modal" class="dlt-ok" id="btnDelteYes">Ok</button>
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
		
		//alert(item_id);return false;
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
		
    
    
    
    
    </script>
 