
 <form name="userMasterForm" id="userMasterForm" method="post" action="">        
        <!-- ===== Start Section Menu ===== -->
       	<section class="main-sec">
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="menu-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" >
                        	<!--<a href="#tab-category" aria-controls="category" role="tab" data-toggle="tab">Category</a>-->
                            <a aria-expanded="true" aria-controls="category" role="tab" id="category-tab" href="<?php echo base_url().$this->user->root;?>/menu/category">CATEGORY</a>		

                        </li>
                        
                        <li role="presentation" class="active">
                        	<!--<a href="#tab-dish" aria-controls="dish" role="tab" data-toggle="tab">Dish</a>-->
                            <a aria-controls="dish" class="dish-tab" id="dish-tab" role="tab" href="<?php echo base_url().$this->user->root;?>/menu/dish">DISH</a>
                        </li>
                    </ul>
                    <!-- End Nav tabs -->
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                    	<!-- Category -->
                     
                        <!-- End Category -->
                        <?php if($_REQUEST['category']!=''){
							$catid=$_REQUEST['category'];
						}else{
							$catid=$cat_id;
						}
						?>
                    	<!-- Dish -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-dish">
                        	<!-- Add New Dish Button -->
                            <div class="add-new-box">
                           		<a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $catid; ?>" class="btn btn-info pull-right" style="padding-bottom:10px; color:#FFF!important;">ADD NEW</a>
                            </div>
                            <!-- End Add New Dish Button -->
                            
                        	<table class="table table-hover dish-table for-view-higher-481 search-cat">
                                <thead>
                                    <tr>
                                        <th>Name<?php $_REQUEST['categoryMob'] = $cat_id;?></th>
                                        <th>ALT Name</th>
                                        <th>                                       
                                            <select class=""  id="cat" onchange="CategoryChange();" name="category">
                                                <?php 
												$i=0;
												while($i < count($categorylist)){ ?>
                                               		<option value='<?php echo $categorylist[$i]['category_id'];?>'  <?php if($cat_id==$categorylist[$i]['category_id'] || $_REQUEST['category']  ==$categorylist[$i]['category_id']){ ?> selected="selected"<?php } ?>>
													<?php echo $categorylist[$i]['category_name']; ?>
                                                    </option>
                                                <?php $i++; } ?>
                                                
                                               
                                            </select>
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="foo-dish">
                                    <?php  
									if(count($dishlist)!=0){
										//echo '<pre>';print_r($dishlist);	
										foreach($dishlist as $items){  //echo $items['item_name'];?>
										<tr id="row_<?php echo $items['item_id'];?>" data-attr="<?php echo $items['category_id'];?>" data-val="<?php echo $items['item_id'];?>" class="dish_tr_<?php echo $items['category_id'];?>" <?php if($cat_id!=$items['category_id'] && $cat_id!=''){ ?> style="display:none;"<?php } ?>>
											<td class="tdlink <?php if($cat_id==$items['category_id']){ ?>my-handle<?php } ?>  <?php if($_REQUEST['category']==$items['category_id']){ ?>my-handle <?php } ?>" href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['category_id'];?>/<?php echo $items['item_id'];?>"><?php echo $items['item_name'];?></td>
                                            <td class="tdlink <?php if($cat_id==$items['category_id']){ ?>my-handle<?php } ?>  <?php if($_REQUEST['category']==$items['category_id']){ ?>my-handle <?php } ?>" href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['category_id'];?>/<?php echo $items['item_id'];?>"><?php echo $items['item_chinese_name'];?></td>
											<td class="tdlink" href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['category_id'];?>/<?php echo $items['item_id'];?>"><?php echo $items['category_name'];?></td>
											<td>
												<label class="switch">
													<input type="checkbox" <?php if($items['status']=='Y'){ ?> checked="true" <?php } ?> onClick="cat_status(<?php echo $items['item_id'];?>,'<?php echo $items['status'];?>')" class="cat_status_<?php echo $items['item_id'];?>" data-val="<?php echo $items['status'];?>">
													<span class="switch-label" data-on="Yes" data-off="No"></span> <span class="switch-handle"></span>
												</label>
											   <!-- <a href="#" data-toggle="modal" data-target="#cat-delete-dish" ><i class="fa fa-trash-o"></i> Delete</a>
												-->
                                                
                                                <a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['category_id'];?>/<?php echo $items['item_id'];?>" >
                                                <i class="fa fa-pencil-square-o"></i> Edit
                                                </a>
                                            
                                            
												<a href="javascript:void(0)" class="delItemAjax" data-attr="<?php echo $items['item_id'];?>" >
												<i class="fa fa-trash-o"></i>DELETE
												</a>
												
											</td>
										</tr>
									<?php } 
									}else{ ?>
                                    	<tr>
                                        	<td colspan="4">
                                            No Dish Items
                                            </td>
                                        </tr>
                                   		
                                 	<?php } ?>
                                  
                                </tbody>
                            </table>
                            
                            <!-- For Mobile View -->                            
                            <table class="table table-hover for-view-lower-481 search-cat">
                            	<thead>
                                	<tr>
                                    	<th>
                                            <select class="searchslct"  id="categoryMob" onchange="CategoryChangeMob();" name="categoryMob">
                                                    <?php
													$j =0;
													while($j < count($categorylist)){ ?>
                                                        <option value='<?php echo $categorylist[$j]['category_id'];?>' <?php if($_REQUEST['categoryMob']==$categorylist[$j]['category_id']  || $cat_id==$categorylist[$j]['category_id']){ ?> selected="selected"<?php } ?> ><?php echo $categorylist[$j]['category_name']; ?></option>
                                                    <?php $j++; } ?>
                                                    
                                                   
                                            </select>
                                        
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody id="foo-dish-mob">
									<?php  
                                    if(count($dishlist)!=0){
                                    foreach($dishlist as $items){ //echo $cat_id; ?>
                                        <tr id="row_mob_<?php echo $items['item_id'];?>" data-attr="<?php echo $items['category_id'];?>" data-val="<?php echo $items['item_id'];?>" class="dish_tr_mob<?php echo $items['category_id'];?>" <?php if($cat_id!=$items['category_id'] && $cat_id!=''){ ?> style="display:none;"<?php } ?>>
                                            <td class="for-handle <?php if($_REQUEST['categoryMob']==$items['category_id']){ ?>my-handle<?php } ?>"></td>
                                            <td>
                                                <!-- Name -->
                                                <div class="td-name">
                                                    <span class="td-title">Name</span>
                                                    <a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['category_id'];?>/<?php echo $items['item_id'];?>">
                                                    <p style="margin-left:-7px;"><p><?php echo $items['item_name'];?></p></p>
                                                    </a>
                                                    
                                                </div>
                                                <!-- End Name -->

                                                <!-- Sub Title -->
                                                <div class="td-subtitle">
                                                    <span class="td-title">ALT Name</span>
                                                    <a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['category_id'];?>/<?php echo $items['item_id'];?>">
                                                    <p style="margin-left:-7px;"><p><?php echo $items['item_chinese_name'];?></p></p>
                                                    </a>
                                                    
                                                </div>
                                                <!-- End Sub Title -->

                                                <!-- Sub Title -->
                                                <div class="td-subtitle">
                                                    <span class="td-title">Category</span>
                                                    <p><?php echo $items['category_name'];?></p>
                                                </div>
                                                <!-- End Sub Title -->
                                                
                                                <!-- Action -->
                                                <div class="td-action">
                                                    <span class="td-title">Action</span>
                                                    <label class="switch">
                                                        <input type="checkbox" <?php if($items['status']=='Y'){ ?> checked="true" <?php } ?> onClick="cat_status(<?php echo $items['item_id'];?>,'<?php echo $items['status'];?>')" class="cat_status_<?php echo $items['item_id'];?>" data-val="<?php echo $items['status'];?>">
                                                        <span class="switch-label" data-on="Yes" data-off="No"></span> <span class="switch-handle"></span>
                                                    </label>
                                                
                                                   <a href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['category_id'];?>/<?php echo $items['item_id'];?>" >
                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                    </a>
                                                    <!--<a href="#" data-toggle="modal" data-target="#cat-delete-dish"><i class="fa fa-trash-o"></i> Delete</a>-->
                                                    <a href="javascript:void(0)" class="delItemAjax" data-attr="<?php echo $items['item_id'];?>" >
                                                   		<i class="fa fa-trash-o"></i>DELETE
                                                    </a>
                                                
                                                </div>
                                                <!-- End Action -->
                                            </td>
                                        </tr>
                                    <?php }
                                    }else{
                                    ?>
                                  		  <tr>
                                        	<td colspan="3">
                                            No Dish Items
                                            </td>
                                        </tr>
                                    <?php } ?>
                                
                                
                                </tbody>
                            </table>
                            <!-- End For Mobile View -->
                        </div>
                        <!-- End Dish -->
                    </div>
                    <!-- End Tab panes -->
                </div>
                <!-- End Tabs -->
            </div>
        </section>
        <!-- ===== End Section Menu ===== -->


</form>

       
        
  
        
        <!-- Category Delete Dish Modal -->
        <div class="cat-delete modal fade" id="cat-delete-dish" tabindex="-1" role="dialog" aria-labelledby="cat-delete-dish">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Dish Item</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <!-- End Modal Body -->
                    <input type="hidden" id="delItemID" value="" />   
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button class="dlt-ok delItemOK">Ok</button>
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
        <!-- End Category Delete Dish Modal-->
<script>
	
	function cat_status(item_id,status){
		var sta=$('.cat_status_'+item_id).attr('data-val'); 
		if($('.cat_status_'+item_id).attr('data-val')=='Y')
			$('.cat_status_'+item_id).attr('data-val','N');
		else
			$('.cat_status_'+item_id).attr('data-val','Y');
			//alert(sta);
		$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/itemStatus",
				data:{'item_id':item_id,'status':sta},
				success:function(data){
					return true;
				}
			
			});
	  }
	  
	  
	$('body').on('click', '.delItemOK', function (e) {
		var item_id	=$('#delItemID').val();
					$.ajax({
						type:"post",
						url:"<?php echo base_url().$this->user->root;?>/menu/deleteDish",
						data:{'item_id':item_id},
						success:function(data){
							//$('.alert-success').show();
							//$('.alert-success').html('Dish item deleted sucessfully');
							
							setTimeout(function(){
								$('.saving').show().html("Dish item deleted sucessfully");
								$('.saving').fadeOut(5000);
							}, 100);
														
							$("#cat-delete-dish").modal('hide');						
							$('#row_'+item_id).remove();
							$('#row_mob_'+item_id).remove();
							return true;
						}
					});
	});
	
	
	
	$('body').on('click', '.delItemAjax', function (e) {
		var item_id	=$(this).attr("data-attr");
		$('#delItemID').val(item_id);
		$("#cat-delete-dish").modal('show');
		
	});
</script>

<script>


	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});


	
	
	

		function CategoryChange(){
			var cat_id = document.getElementById("cat").value;
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/menu/dish/"+cat_id);
			$("#userMasterForm").submit();return true;		
		} 
		
	
	function CategoryChangeMob(){
			var cat_id = document.getElementById("categoryMob").value;
			//alert(cat_id);
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/menu/dish/"+cat_id);
			$("#userMasterForm").submit();return true;		
		} 
		

</script>   
 
