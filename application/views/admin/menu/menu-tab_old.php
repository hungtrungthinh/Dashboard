<script src="<?php echo base_url('assets');?>/js/rowsorter.js"></script>
<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo base_url('assets');?>/js/zebra_dialog.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zebra_dialog.css" type="text/css">	
        <!-- ===== Start Section Menu ===== -->
       	<section class="main-sec">
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="menu-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                        	<!--<a href="#tab-category" aria-controls="category" role="tab" data-toggle="tab">Category</a>-->
                            <a aria-expanded="true" aria-controls="category" role="tab" id="category-tab" href="<?php echo base_url().$this->user->root;?>/menu/category">CATEGORY</a>		

                        </li>
                        
                        <li role="presentation">
                        	<!--<a href="#tab-dish" aria-controls="dish" role="tab" data-toggle="tab">Dish</a>-->
                            <a aria-controls="dish" class="dish-tab" id="dish-tab" role="tab" href="<?php echo base_url().$this->user->root;?>/menu/dish">DISH</a>
                        </li>
                    </ul>
                    <!-- End Nav tabs -->
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                    	<!-- Category -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-category">
                        	<!-- Add New Category Button -->
                            <div class="add-new-box">
                                <a href="#" data-toggle="modal" data-target="#add-new">Add New</a>
                            </div>
                            <!-- End Add New Category Button -->
                            
                        	<table id="table1" class="table1 table table-hover for-view-higher-481">
                                <thead>
                                    <tr>
                                    	<th class="rowTD" ></th>
                                        <th>Name</th>
                                        <th>Subtitle</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="foo">
                                <?php  
								if(count($categorylist)!=0){
									foreach($categorylist as $items){ ?>
                                    <tr id="row_<?php echo $items['category_id'];?>" data-attr="<?php echo $items['category_id'];?>" class="cat_tr">
                                    	<td class="cat_tb sorter rowTD"></td>
                                    	<td><?php echo $items['category_name'];?>  </td>
                                        <td><?php echo $items['subtitle'];?> </td>
                                        <td>
                                        	<label class="switch">
                                                <input type="checkbox" <?php if($items['status']=='Y'){ ?> checked=""  <?php } ?> onClick="cat_status(<?php echo $items['category_id'];?>,'<?php echo $items['status'];?>')" class="cat_status_<?php echo $items['category_id'];?>" data-val="<?php echo $items['status'];?>" >
                                                <span class="switch-label" data-on="Yes" data-off="No"></span> <span class="switch-handle"></span>
                                            </label>
                                            <!--<a href="#" class="editCat" data-toggle="modal" data-target="#edit-cat"><i class="fa fa-pencil-square-o"></i> Edit</a>-->
                                            
                                            <a href="javascript:void(0)" class="editCatAjax editCat" data-attr="<?php echo $items['category_id'];?>" >
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                            </a>
                                            <!--<a href="#" data-toggle="modal" data-target="#cat-delete"><i class="fa fa-trash-o"></i> Delete</a>-->
                                            <a  href="javascript:void(0)" class="delCatAjax mr_2"  id="delCatAjax"  data-attr="<?php echo $items['category_id'];?>"><i class="fa fa-trash-o"></i> Delete</a>
                                            
                                        </td>
                                    </tr>
                                 <?php }
								 } ?>
                                    
                                 
                                   
                                </tbody>
                            </table>
                            
                            <!-- For Mobile View -->                            
                            <table id="table2" class="table1 table table-hover for-view-lower-481">
                                <tbody id="foo-mob">
                                 <?php  
								if(count($categorylist)!=0){
									foreach($categorylist as $items){ ?>
                                    <tr id="row_<?php echo $items['category_id'];?>" data-attr="<?php echo $items['category_id'];?>" class="cat_trmob">
                                    	<td class="sorter2"></td>
                                        <td>
                                        	<!-- Name -->
                                        	<div class="td-name">
                                            	<span class="td-title">Name</span>
                                                <p><?php echo $items['category_name'];?></p>
                                            </div>
                                            <!-- End Name -->
                                            
                                            <!-- Sub Title -->
                                        	<div class="td-subtitle">
                                            	<span class="td-title">Subtitle</span>
                                                <p><?php echo $items['subtitle'];?></p>
                                            </div>
                                            <!-- End Sub Title -->
                                            
                                            <!-- Action -->
                                        	<div class="td-action">
                                            	<span class="td-title">Action</span>
                                                <label class="switch">
                                                    <input type="checkbox" <?php if($items['status']=='Y'){ ?> checked=""  <?php } ?> onClick="cat_status(<?php echo $items['category_id'];?>,'<?php echo $items['status'];?>')" class="cat_status_<?php echo $items['category_id'];?>" data-val="<?php echo $items['status'];?>" >
                                                    <span class="switch-label" data-on="Yes" data-off="No"></span> <span class="switch-handle"></span>
                                                </label>
                                                <!--<a href="#" class="editCat2" data-toggle="modal" data-target="#edit-cat"><i class="fa fa-pencil-square-o"></i> Edit</a>-->
                                                <a href="javascript:void(0)" class="editCatAjax" data-attr="<?php echo $items['category_id'];?>" >
                                                <!--<a href="#" data-toggle="modal" data-target="#cat-delete"><i class="fa fa-trash-o"></i>Delete</a>-->
                                                
                                                
                                                <a  href="javascript:void(0)" class="delCatAjax mr_2"  id="delCatAjax"  data-attr="<?php echo $items['category_id'];?>"><i class="fa fa-trash-o"></i> Delete</a>
                                            </div>
                                            <!-- End Action -->
                                        </td>
                                    </tr>
                                  	<?php }
								 } ?>  
                                  
                                
                                </tbody>
                            </table>
                            <!-- End For Mobile View -->
                        </div>
                        <!-- End Category -->
                        
                    	<!-- Dish -->
                        
                        <!-- End Dish -->
                    </div>
                    <!-- End Tab panes -->
                </div>
                <!-- End Tabs -->
            </div>
        </section>
        <!-- ===== End Section Menu ===== -->
        

        
        <!-- Add New Modal -->
        <div class="add-new modal fade" id="add-new" tabindex="-1" role="dialog" aria-labelledby="add-new">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Add New Category</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Add New Form -->
                    <form class="form-horizontal" role="form" action="<?php echo base_url().$this->user->root;?>/menu/category" method="post" name="formcategory" onsubmit="" id="formcategorynew">
                        <!-- Modal Body -->
                        <div class="modal-body">
                        	<label>
                            	<input type="text" name="category_name" id="category_namenew"  placeholder="Category Name" required />
                            </label>
                        	<label>
                            	<textarea name="subtitle" id="subtitlenew" placeholder="Category Subtitle"></textarea>
                            </label>
                        </div>
                        <!-- End Modal Body -->
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<!--<input type="submit" value="Save">-->
                                    <button type="button" name="save_categorynew" id="save_categorynew" class="">Save</button>
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<button aria-label="Close" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Footer -->
                    </form>
                    <!-- End Add New Form -->
                </div>
            </div>
        </div>
        <!-- End Add New Modal -->
        
        <!-- Edit Category Modal -->
        
        <div class="edit-cat modal fade" id="edit-cat" tabindex="-1" role="dialog" aria-labelledby="edit-cat">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Edit Category</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Edit Caegory Form -->
                    <form class="form-horizontal" role="form" action="<?php echo base_url().$this->user->root;?>/menu/category" method="post" name="formcategory" onsubmit="" id="formcategory">
                        <!-- Modal Body -->
                        <div class="modal-body">
                        	<label>
                            	<input type="text" id="category_name" name="category_name" placeholder="Category Name" required />
                            </label>
                        	<label>
                            	<textarea id="subtitle" name="subtitle" placeholder="Category Subtitle"></textarea>
                            </label>
                        </div>
             			<input type="hidden" name="cate_id" id="cate_id" value="<?php //echo $categorydetails['category_id'];?>"> 
                       
                        <!-- End Modal Body -->
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<!--<input type="submit" value="Save">-->
                                    <button type="button" name="save_category" id="save_category" class="">Save</button>
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<button aria-label="Close" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Footer -->
                    </form>
                    <!-- End Edit Caegory Form -->
                </div>
            </div>
        </div>
        <!-- End Edit Category Modal -->        
        
        <!-- Category Delete Modal -->
        <div class="cat-delete modal fade" id="cat-delete" tabindex="-1" role="dialog" aria-labelledby="cat-delete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Category</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Deleting category is not feasible until the Dishes under are removed or moved.</p>
                    </div>
                    <!-- End Modal Body -->
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9 display-ful-480">
                                <button aria-label="Close" data-dismiss="modal">Ok</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>
        <!-- End Category Delete Modal -->       
        
        <!-- Category Delete Dish Modal -->
        
        <!-- End Category Delete Dish Modal-->
    
    

   
      
      <script>
	  
$(document).ready(function() {
    var text_max = 120;
    $('#textarea_feedback').html(text_max);

    $('#subtitle').keyup(function() {
        var text_length = $('#subtitle').val().length;
        var text_remaining = text_max - text_length;
        $('#textarea_feedback').html(text_remaining );
    });
});
	  
	  	$('body').on('click', '#save_category', function () {
			var category = $.trim($('#category_name').val());
			var subtitle = $.trim($('#subtitle').val());
			var category_id=$('#cate_id').val();
			if(category == '' ){
				$('#category_name').addClass('errorborder');
				return false;
			}else{
				$('#category_name').removeClass('errorborder');
				$('.alert').hide();
				$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/checkCategoryExist",
							data : {'category':category,'category_id':category_id,'subtitle':subtitle},
							success: function(response){
								//alert(response);return false;
								if(response==0){
									//$('.alert-danger').show();
									//$('.alert-danger').html('Category already exist');
									setTimeout(function(){
										$('.saving').show().html("Category already exist");
										$('.saving').fadeOut(5000);
									}, 100);
						
									return false;
								}else{
									$('#formcategory').submit();
								}
								
							}
						});	
				
			}
			
		});
		
		$('body').on('click', '#save_categorynew', function () {
			var category = $.trim($('#category_namenew').val());
			var subtitle = $.trim($('#subtitlenew').val());
			
			if(category == '' ){
				$('#category_namenew').addClass('errorborder');
				return false;
			}else{
				$('#category_namenew').removeClass('errorborder');
				$('.alert').hide();
				$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/checkCategoryExist",
							data : {'category':category,'subtitle':subtitle},
							success: function(response){
								//alert(response);return false;
								if(response==0){
									//$('.alert-danger').show();
									//$('.alert-danger').html('Category already exist');
									setTimeout(function(){
										$('.saving').show().html("Category already exist");
										$('.saving').fadeOut(5000);
									}, 100);
						
									return false;
								}else{
									$('#formcategorynew').submit();
								}
								
							}
						});	
				
			}
			
		});
		
		
		
		
		
			
			
	  	$('body').on('click', '#addcategory', function () {
			$('.addcateg').show();
			$('#category_name').val('');
			$('#cate_id').val('');
		
		});
	  
	  	
		$('body').on('click', '.editCatAjax', function () {
		
			var cat_id	=$(this).attr("data-attr");
			$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/getCategoryDetail",
				data:{'cat_id':cat_id},
				success:function(data){
					var response = $.parseJSON(data);	
					$('#category_name').val(response.category_name);
					$('#subtitle').val(response.subtitle);
					$('#cate_id').val(response.category_id);
					$('.alert').hide();
					$('.addcateg').show();
					
					$("#edit-cat").modal('show');
					//alert(data);
					//$('.dish_cat_tab').html(data);
					return true;
				}
			
		});});
			
			
		function cat_status(category_id,status){
		var sta=$('.cat_status_'+category_id).attr('data-val'); 
		if($('.cat_status_'+category_id).attr('data-val')=='Y')
			$('.cat_status_'+category_id).attr('data-val','N');
		else
			$('.cat_status_'+category_id).attr('data-val','Y');
			//alert(sta);
		$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/categoryStatus",
				data:{'category_id':category_id,'status':sta},
				success:function(data){
					return true;
				}
			
			});
	  }
	 
	$('body').on('click', '.delCatAjax', function (e) {
		var category_id	=$(this).attr("data-attr");
	//var cnfm=(alert("Deleting category is not feasible until the Dishes under are removed or moved"));
	//alert(cnfm);
		
		
		$.ajax({
					type:"post",
					url:"<?php echo base_url().$this->user->root;?>/menu/checkCat",
					data:{'category_id':category_id},
					success:function(data){
						if(data==0){
							$.ajax({
								type:"post",
								url:"<?php echo base_url().$this->user->root;?>/menu/deleteCategory",
								data:{'category_id':category_id},
								success:function(data){
									//$('.alert-success').show();
									//$('.alert-success').html('Category sucessfully deleted');
									setTimeout(function(){
										$('.saving').show().html("Category sucessfully deleted");
										$('.saving').fadeOut(5000);
									}, 100);
									
									$('#row_'+category_id).remove();
									return true;
								}
							
							});
						}
						else{
						
						
						 $("#cat-delete").modal('show');
								/*e.preventDefault();
								$.Zebra_Dialog('Deleting category is not feasible until the Dishes under are removed or moved.', {
									'type':     'question',
									'title':    'Delete Category',
									'buttons':  ['OK'],
									'onClose':  function(caption) {
										if(caption=='OK'){
											return true;
										}else{
											return true;
										}
									}
								});*/
							//alert("Deleting category is not feasible until the Dishes under are removed or moved.");
						 }
					}
				
				});
		
	});
	
	
	$('body').on('click', '.CatAjax', function () {
		    
			var cat_id	=$(this).attr("data-attr");
			
			$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/menu/getCat",
				data:{'cat_id':cat_id},
				success:function(data){
					//alert(data)
					$('#myTabs').hide();
					$('#myTabContent').html(data);
					return true;
				}
			
		});});
		
		function CategoryChange(){
			var newcategory_id = document.getElementById("cat").value;
			var category_id = document.getElementById("category_id").value;
			$.ajax({
					type:"post",
					url:"<?php echo base_url().$this->user->root;?>/menu/moveupdateCategory",
					data:{'newcategory_id':newcategory_id,'category_id':category_id},
					success:function(data){
					//alert(data);
						//$('.alert-success').html('Category sucessfully deleted');
						$("#myModal").hide();
						$("#row_"+category_id).hide();
						//return true;
					}
				
				});
		} 
		

	$("#table1").rowSorter({
		handler: "td.sorter",
		onDrop: function(tbody, row, index, oldIndex) {
		
		
			var catArr=Array();
			
        	
			$('.cat_tr').each(function() {
				catArr.push($(this).attr('data-attr'));
			});
			//alert(catArr);
			$.ajax({
					data:{'categorylist':catArr},
					type: 'POST',
					url: '<?php echo base_url().$this->user->root;?>/menu/sortCategory',
					success: function(response){
					//alert(rowCount);
				}
			});
		}
	});
	$("#table2").rowSorter({
		handler: "td.sorter2",
		onDrop: function(tbody, row, index, oldIndex) {
			var catArr=Array();
			if($(tbody).attr('id')=="foo"){
				$('.cat_tr').each(function() {
					catArr.push($(this).attr('data-attr'));
				});
			}else{
				$('.cat_trmob').each(function() {
					catArr.push($(this).attr('data-attr'));
				});
			}
			
			$.ajax({
					data:{'categorylist':catArr},
					type: 'POST',
					url: '<?php echo base_url().$this->user->root;?>/menu/sortCategory',
					success: function(response){
					//alert(rowCount);
				}
			});
		}
	});	 
	
</script>

<style>
							#table1 .rowTD{
								width:2%!important;
								padding: 0px!important;						
							}
							</style>
