<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">
	
	
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
    
<div  class="tab_wrper" style="padding:10px;">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class="active tog_tab" role="presentation">
      <a aria-expanded="true" aria-controls="category" role="tab" id="category-tab" href="<?php echo base_url().$this->user->root;?>/menu/category">CATEGORY</a>		
      </li>
      <li role="presentation" class="tog_tab">
      <a aria-controls="dish" class="dish-tab" id="dish-tab" role="tab" href="<?php echo base_url().$this->user->root;?>/menu/dish">DISH</a>
      </li>
      <li class="pull-right" style="width:10%">
      <div class="col-lg-12">
      <a href="javascript:void(0)" class="btn btn-info" style="padding-bottom:10px; color:#fff!important;" id="addcategory">ADD NEW</a></div>
      
      </li>
    </ul>
    
    <input type="hidden" name="add_value" id="add_value" value="">

    
    
<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">
    <div aria-labelledby="category-tab" id="category" class="" role="tabpanel">
		<div class="table-responsive">

    <form class="form-horizontal" role="form" action="<?php echo base_url().$this->user->root;?>/menu/category" method="post" name="formcategory" onsubmit="" id="formcategory">	

	<div class="addcateg" style="display:none; padding:10px;background-color:#f2f2f2;">
   		<div class="col-lg-1 col-md-2">
    		<label class="col-sm-3 control-label" for="inputEmail3">Name  </label>
    	</div>
  		<div class="form-group">
        <div class="col-lg-4 col-md-4">
            <input name="category_name" id="category_name"  type="text" placeholder="Category Name" style="width:100%; float:left; margin-right:5px;" class="additem form-control" value="">
            </div>
            </div>
            <div class="col-lg-1 col-md-2">
    		<label class="col-sm-3 control-label" for="inputEmail3">Subtitle  </label>
    	</div>
            <div class="col-lg-5 col-md-5">
            <textarea name="subtitle" id="subtitle" cols="5"  placeholder="Category Subtitle"  class="form-control" maxlength="120"></textarea>
            <span id="textarea_feedback"></span>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-7 col-md-7 pull-right">
             <input type="hidden" name="cate_id" id="cate_id" value="<?php echo $categorydetails['category_id'];?>"> 
          <button type="button" name="save_category" id="save_category" class="btn btn-info pull_right">Save</button>
          </div>
        <div class="clearfix"></div>
    </div>
     </form>
        <table class="table table-striped tbl_category">
          <thead class="head_table">
            <tr>
              <th class="col-md-5 col-sm-5">NAME</th>
               <th class="col-md-6 col-sm-6">SUBTITLE</th>
              <th class="col-md-1 col-sm-1" colspan="3">ACTION</th>
            </tr>
          </thead>
          <tbody class="table_body">
        	
			
			<?php  
			if(count($categorylist)!=0){
           	foreach($categorylist as $items){ ?>
            <tr id="row_<?php echo $items['category_id'];?>">
                <td style="cursor:pointer;"  data-attr="<?php echo $items['category_id'];?>"  class="CatAjax" >
                <!--<a href="<?php echo base_url().$this->user->root;?>/menu/dish"></a>-->
               <?php echo $items['category_name'];//print_r($items);?>  
                </td>
                <td style="cursor:pointer;"  data-attr="<?php echo $items['category_id'];?>"  class="CatAjax" >
                <!--<a href="<?php echo base_url().$this->user->root;?>/menu/dish"></a>-->
               <?php echo $items['subtitle'];?>  
                </td>
                 <td>
              <div class="checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin:0;">
			  <label>
			  <input type="checkbox" <?php if($items['status']=='Y'){ ?> checked=""  <?php } ?> onClick="cat_status(<?php echo $items['category_id'];?>,'<?php echo $items['status'];?>')" class="cat_status_<?php echo $items['category_id'];?>" data-val="<?php echo $items['status'];?>" ><span></span>
			  </label>
			  </div>
              </td>
              <td>
              <a href="javascript:void(0)" class="editCatAjax" data-attr="<?php echo $items['category_id'];?>" >
                     <button class="btn btn_gray">EDIT</button>
                     </a>
               </td>
                <td>
                <a href="javascript:void(0)" class="delCatAjax mr_2"  id="delCatAjax"  data-attr="<?php echo $items['category_id'];?>" > <button class="btn btn_blue" type="button"><span data-toggle="modal" data-target="#myModal"  data-backdrop="static" >DELETE</span></button></a>
            	</td>
                <input type="hidden" name="loc_id" id="loc_id" value="<?php echo $items['location_id'];?>"/>
                <input type="hidden" name="res_id" id="res_id" value="<?php echo $items['restaurant_id'];?>"/>
            </tr>
            <?php 	}
				}else { ?>
      		  <tr>
              <td colspan="3">
              No Category Found
              </td>
              </tr>
           <?php } ?>
            
          </tbody>
        </table>
        </div>
      </div>
    </div>
    </div>
   
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

   
      
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
									$('.alert-danger').show();
									$('.alert-danger').html('Category already exist');
									return false;
								}else{
									$('#formcategory').submit();
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
	 
	$('body').on('click', '.delCatAjax', function () {
		var category_id	=$(this).attr("data-attr");
	//var cnfm=(confirm("Delete dishes or move the dishes to some other category?"));
	//alert(cnfm);
		if (confirm("Delete dishes or move the dishes to some other category?")==true) {
			
		$.ajax({
					type:"post",
					url:"<?php echo base_url().$this->user->root;?>/menu/deleteCategory",
					data:{'category_id':category_id},
					success:function(data){
						$('.alert-success').show();
						$('.alert-success').html('Category sucessfully deleted');
						$('#row_'+category_id).remove();
						return true;
					}
				
				});
		}else{
			$("#myModal").html("");
			var restaurant_id = document.getElementById("res_id").value;
			var location_id = document.getElementById("loc_id").value;
			$.ajax({
					type:"post",
					url:"<?php echo base_url().$this->user->root;?>/menu/moveCategory",
					data:{'category_id':category_id,'restaurant_id':restaurant_id,'location_id':location_id},
					success:function(data){
					//alert(data);
						//$('.alert-success').html('Category sucessfully deleted');
						
						$("#myModal").show();
						$("#myModal").html(data);
						//return true;
					}
				
				});
			
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
</script>


<style>
 textarea {font-style:italic;}
.nav-tabs {
    border-bottom: 11px solid #ffffff!important;
}
.nav-tabs > li {
    margin-left: -1px!important;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fff;
    border-image: none;
    border-style: solid;
    border-width: 1px;
    color: #555;
    cursor: default;
}

</style>