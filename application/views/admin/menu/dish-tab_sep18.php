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
    
<form name="userMasterForm" id="userMasterForm" method="post" action="">      
<div  class="tab_wrper" style="padding:10px;">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class="tog_tab" role="presentation">
     <a aria-expanded="true" aria-controls="category" role="tab" id="category-tab" href="<?php echo base_url().$this->user->root;?>/menu/category">CATEGORY</a>
      </li>
      <li role="presentation" class="active tog_tab">
      <a aria-controls="dish" class="dish-tab" id="dish-tab" role="tab" href="<?php echo base_url().$this->user->root;?>/menu/dish">DISH</a>
      </li>
      
      <li class="pull-right" style="width:10%">
      <div class="col-lg-12">
      	<a href="<?php echo base_url().$this->user->root;?>/menu/add_dish" class="btn btn-info" style="padding-bottom:10px; color:#FFF!important;">ADD NEW</a>
      </div>
      
      </li>
      
    </ul>
    
    <input type="hidden" name="add_value" id="add_value" value="">

    
    
    <div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">
    
<div aria-labelledby="category-tab" id="category" class="" role="tabpanel">


<div class="table-responsive">



<div class="addcateg" style=" display:none;">
    <div class="col-lg-2 col-md-3">
    	<label class="col-sm-3 control-label" for="inputEmail3">Name  </label>
    </div>
    <div class="col-lg-5 col-md-5">
   		<input name="category_name" id="category_name"  type="text" placeholder="Category Name" style="width:70%; float:left; margin-right:5px;" class="additem form-control">
    
    	<button type="button" name="save_category" class="btn btn_cmplete pull_right save_categorys">Save</button>
    </div>
	<div class="clearfix"></div>
</div>
        <input type="hidden" name="cate_id" id="cate_id" value="">
        <table class="table table-striped tbl_category">
          <thead class="head_table">
            <tr>
              <th class="col-md-4 col-sm-4">NAME</th>
              <th class="col-md-7 col-sm-7">  
             
             <select id="cat" onchange="CategoryChange();" name="category">
                    <option value="0" selected="selected">CATEGORY</option>
                    <?php 
                    $i = 0;
                    while($i < count($category)){
                    
                      $cat_name= $category[$i]['category_name'];
                      $cat_id= $category[$i]['category_id'];
                    ?>
                    
                    <option value='<?php echo $cat_id?>' <?php if($cat_id== $_REQUEST['category']) { ?>selected="selected"<?php } ?>><?php echo $cat_name ?></option>
                    
                     <?php $i++;
                    }?>
			</select>
              </th>
              <th class="col-md-1 col-sm-1" colspan="2">ACTION</th>
            </tr>
          </thead>
          <tbody class="table_body">
        	
			
			<?php  
			if(count($dishlist)!=0){
           	foreach($dishlist as $items){ ?>
            <tr id="row_<?php echo $items['item_id'];?>">
                <td href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['item_id'];?>" style="cursor:pointer;" class="tdlink">
					<?php echo $items['item_name'];?>
                </td>
                <td  href="<?php echo base_url().$this->user->root;?>/menu/add_dish/<?php echo $items['item_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo $items['category_name'];?></td>
                <td>
              <div class="checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin:0;">
			  <label>
			  <input type="checkbox" <?php if($items['status']=='Y'){ ?> checked="true" <?php } ?> onClick="cat_status(<?php echo $items['item_id'];?>,'<?php echo $items['status'];?>')" class="cat_status_<?php echo $items['item_id'];?>" data-val="<?php echo $items['status'];?>"><span></span>
			  </label>
			  </div>
              </td>
                <td>
                <a href="javascript:void(0)"  data-attr="<?php echo $items['item_id'];?>" class="delItemAjax111">
                <button class="btn btn_gray">DELETE</button>
                </a>
                
           			 <?php /*?><a href="javascript:void(0)" class="editCatAjax" data-attr="<?php //echo $items['category_id'];?>" >
                     <button class="btn btn_gray">EDIT</button>
                     </a><?php */?>
            	</td>
            </tr>
            <?php 	}
				}else { ?>
      		  <tr>
              <td colspan="3">
              No Dishes Found
              </td>
              </tr>
           <?php } ?>
            
          </tbody>
        </table>
        </div>
      </div>
    </div>
    </div>
   </form>   

<script>
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});
	$('body').on('click', '.delItemAjax111', function () {
		
		var item_id	=$(this).attr("data-attr");
		
		if (confirm("Are you sure to delete?")) {
		$.ajax({
					type:"post",
					url:"<?php echo base_url().$this->user->root;?>/menu/deleteDishItem",
					data:{'item_id':item_id},
					success:function(data){
						$('.alert-success').show();
						$('.alert-success').html('Dish item deleted sucessfully');
						$('#row_'+item_id).remove();
						return true;
					}
				
				});
		}else{
			return false;	
		}
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
	 
</script>


<style>
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