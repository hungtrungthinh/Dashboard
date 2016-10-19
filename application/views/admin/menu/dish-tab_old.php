<script src="<?php echo base_url('assets');?>/js/rowsorter.js"></script>
<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo base_url('assets');?>/js/zebra_dialog.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zebra_dialog.css" type="text/css">	

<?php $catid=$_REQUEST['category'];?>
<?php $catidMob=$_REQUEST['categoryMob'];?>

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
                        
                    	<!-- Dish -->
                        <div role="tabpanel" class="tab-pane" id="tab-dish" style="display:block">
                        	<!-- Add New Dish Button -->
                            <div class="add-new-box">
                                <a href="add-dish.html">Add New</a>
                            </div>
                            <!-- End Add New Dish Button -->
                            <?php //print_r($categorylist);?>
                        	<table  id="table1"  class="table table-hover dish-table for-view-higher-481 search-cat" >
                                <thead>
                                    <tr>
                                   		<?php if($catid!=''){ ?><th class="<?php if($catid!=''){ echo "rowTD" ; } ?>"></th> <?php } ?>
                                        <th>Name</th>
                                        <th>
                                        <?php //print_r($categorylist);?>
                                        <select id="cat" onchange="CategoryChange()" name="category">
                                            <?php 
                                            $i = 0;
                                            while($i < count($categorylist)){
                                            
                                            $cat_name= $categorylist[$i]['category_name'];
                                            $cat_id= $categorylist[$i]['category_id'];
                                            ?>
                                            
                                            <option value='<?php echo $cat_id?>' <?php if($cat_id== $_REQUEST['category']||$cat_id==$catid) { ?>selected="selected"<?php } ?>><?php echo $cat_name ?></option>
                                            
                                             <?php $i++;
                                            }?>
                                        </select>
            
            
                                        	<!--<select class="search-slct">
                                                <option selected disabled>-- Select Category --</option>
                                                <?php //while($i < count($categorylist)){
												//$cat_name= $categorylist[$i]['category_name'];
												?>
                                                <option><?php //echo stripslashes($cat_name); ?></option>
                                                <?php  //$i++; } ?>
                                                
                                            </select>-->
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="foo-dish">
                                
                                <?php  
								if(count($dishlist)!=0){
									foreach($dishlist as $items){  ?>
                                    <tr id="row_<?php echo $items['item_id'];?>" data-attr="<?php echo $items['item_id'];?>" class="dish_tr">
                                   		<?php if($catid!=''){ ?><td class="<?php if($catid!=''){ echo "sorter cat_tb rowTD" ; } ?>"></td> <?php } ?>
                                    	<td <?php if($catid!=''){ ?> class="my-handle" <?php } ?>><?php echo $items['item_name'];?></td>
                                        <td><?php echo $items['category_name'];?></td>
                                        <td>
                                        	<label class="switch">
                                                <input type="checkbox" <?php if($items['status']=='Y'){ ?> checked="true" <?php } ?> onClick="cat_status(<?php echo $items['item_id'];?>,'<?php echo $items['status'];?>')" class="cat_status_<?php echo $items['item_id'];?>" data-val="<?php echo $items['status'];?>">
                                                <span class="switch-label" data-on="Yes" data-off="No"></span> <span class="switch-handle"></span>
                                            </label>
                                           <!-- <a href="#" data-toggle="modal" data-target="#cat-delete-dish" ><i class="fa fa-trash-o"></i> Delete</a>
                                            -->
                                            <a href="javascript:void(0)" class="delItemAjax" data-attr="<?php echo $items['item_id'];?>" >
                                            <i class="fa fa-trash-o"></i>DELETE
                                            </a>
                                            
                                        </td>
                                    </tr>
                                <?php } 
								} ?>
                                 
                                 
                                </tbody>
                            </table>
                            
                            <!-- For Mobile View -->                            
                            <table id="table2" class="table table-hover for-view-lower-481 search-cat">
                            	<thead>
                                	<tr>
                                    	<th>
                                            <select id="catMob" onchange="CategoryChangeMob()" name="categoryMob">
                                                <?php 
                                                $i = 0;
                                                while($i < count($categorylist)){
                                                
                                                $cat_name= $categorylist[$i]['category_name'];
                                                $cat_id= $categorylist[$i]['category_id'];
                                                ?>
                                                
                                                <option value='<?php echo $cat_id?>' <?php if($cat_id== $_REQUEST['categoryMob']||$cat_id==$catid) { ?>selected="selected"<?php } ?>><?php echo $cat_name ?></option>
                                                
                                                 <?php $i++;
                                                }?>
                                            </select>
                                        
                                        	<?php /*?><select class="search-slct">
                                                <option selected disabled>-- Select Category --</option>
                                                <?php while($i < count($categorylist)){
												$cat_name= $categorylist[$i]['category_name'];
												?>
                                                <option><?php echo stripslashes($cat_name) ?></option>
                                                <?php  $i++; } ?>
                                                
                                            </select><?php */?>
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody id="foo-dish-mob">
                                <?php  
								if(count($dishlist)!=0){
								foreach($dishlist as $items){  ?>
                                    <tr id="row_<?php echo $items['item_id'];?>" data-attr="<?php echo $items['item_id'];?>" class="dish_tr">
                                    	<td class="for-handle"></td>
                                        <td>
                                        	<!-- Name -->
                                        	<div class="td-name">
                                            	<span class="td-title">Name</span>
                                                <p><?php echo $items['item_name'];?></p>
                                            </div>
                                            <!-- End Name -->
                                            
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
                                                    <input type="checkbox" />
                                                    <span class="switch-label" data-on="Yes" data-off="No"></span> <span class="switch-handle"></span>
                                                </label>
                                                <a href="#" data-toggle="modal" data-target="#cat-delete-dish"><i class="fa fa-trash-o"></i> Delete</a>
                                            </div>
                                            <!-- End Action -->
                                        </td>
                                    </tr>
                                    
                                <?php }
								}
								?>
                                   
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
                        <p>Are you sure to delete.?</p>
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
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});

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
							return true;
						}
					});
				
		
	});
	
	
	
	$('body').on('click', '.delItemAjax', function (e) {
		var item_id	=$(this).attr("data-attr");
		$('#delItemID').val(item_id);
		$("#cat-delete-dish").modal('show');
		
	});
	
	
	
	
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
	function CategoryChange(){
			var cat_id = document.getElementById("cat").value;
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/menu/dish/"+cat_id);
			$("#userMasterForm").submit();return true;		
		} 
	function CategoryChangeMob(){
			var cat_id = document.getElementById("catMob").value;
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/menu/dish/"+cat_id);
			$("#userMasterForm").submit();return true;		
		} 
		
		
	$("#table1").rowSorter({
		handler: "td.sorter",
		onDrop: function(tbody, row, index, oldIndex) {
			var dishArr=Array();
			
			
			if($(tbody).attr('id')=="foo"){
			alert("foo");
				//$('.cat_tr').each(function() {
					//catArr.push($(this).attr('data-attr'));
				//});
			}else{
			alert("foo-mob");
				//$('.cat_trmob').each(function() {
					//catArr.push($(this).attr('data-attr'));
				//});
			}
			
			
			
			$('.dish_tr').each(function() {
				dishArr.push($(this).attr('data-attr'));
			});
			
			$.ajax({
					data:{'dishlist':dishArr},
					type: 'POST',
					url: '<?php echo base_url().$this->user->root;?>/menu/sortDIshItem',
					success: function(response){
					//alert(rowCount);
				}
			});
		}
	});	
	
	
</script>   
 
<style>#table1 .rowTD{
	width:2%!important;
	padding: 0px!important;						
}
</style>
