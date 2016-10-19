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
      <li><a href="#">Menu</a></li>
      <li class="active"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png"> Burgers</li>
    </ol>
    <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <form class="form-horizontal form_menu_detail" role="form" action="<?php echo base_url().$this->user->root;?>/menu/add_dish" method="post" name="formlist" onsubmit="" id="formlist">	
    <i class="dish_icon"><img src="<?php echo base_url()?>assets/admin_lte/img/icon_dish.png"></i>
    <div class="col-md-12">
    	
        <div class="col-md-4">
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
         
        <div class="col-md-4">
  		<div class="form-group">
        <label class=" control-label" for="textinput">Menu Item</label>
        <input type="text" name="menu_item" value="<?php echo $itemdetails['item_name'];?>" id="menu_item"  placeholder="Menu Item" class="form-control menuclass " >
        </div>
        </div>
        
        <div class="col-md-4">
  		<div class="form-group">
        <label class=" control-label" for="textinput">Price</label>
        <input type="text" name="price" value="<?php echo $itemdetails['price'];?>"  id="price" placeholder="Price" class="form-control menuclass" onkeypress="return isNumber(event)" >
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
        
        
    </div>
    <div class="clearfix"></div>
    </form>
    <div class="clearfix"></div>
    
    <div class="option_wp">
    <h4 class="label_lid">Options and Sides 
    <a href="#" class="pull-right"><img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png"></a>
    </h4>
    <div class="clearfix"></div>
    <div class="sides_wp">
    <h5 class="item_lid">Bread   
      <span><input type="checkbox"> <span>*</span> This is Madatory</span>
      <span style="margin:0; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
	  <label>
	  <input type="checkbox" checked=""><span></span>
	  </label>
	  </span>
    </h5>
    
    <ul class="item_list">
    
    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>
    
    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>

    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>

    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>
    
    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png"></a></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+ </label>
    </div>
    </li>
    <div class="clearfix"></div>
    
    </ul>
    </div>
    
    <div class="sides_wp">
    <h5 class="item_lid">Bread   
      <span><input type="checkbox"> <span>*</span> This is Madatory</span>
      <span style="margin:0; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
	  <label>
	  <input type="checkbox" checked=""><span></span>
	  </label>
	  </span>
    </h5>
    
    <ul class="item_list">
    
    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>
    
    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>

    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>

    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+$1.75</label>
    </div>
    </li>
    <div class="clearfix"></div>
    
    <li>Seeded Bun 
    <div class="pull-right">
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png"></a></label>
    <label class="action pull-right"><a href="#"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
    <label class="rate">+ </label>
    </div>
    </li>
    <div class="clearfix"></div>
    
    </ul>
    </div>
    
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 text-right mg_btm15">
    <input type="hidden" name="item_id" id="item_id" value="<?php echo $itemdetails['item_id'];?>">      
    <button type="button" class="btn btn_save mg_btm15" name="submit_btn" id="submit_btn">Save</button>
    <button type="button" class="btn btn_gray" onclick="location.href='<?php echo base_url().$this->user->root;?>/menu/dish'">Cancel</button>
    </div>
    <div class="clearfix"></div>
    
	</div><!-- /.row -->
	<div class="clearfix"></div>

</div><!-- /.container -->


<script>

		$('body').on('click', '#submit_btn', function () {
			var category = $.trim($('#category').val());
			var menu_item = $('#menu_item').val();  
			var price = $.trim($('#price').val());
			var description = $.trim($('#description').val());
			var item_id=$('#item_id').val();
			if(category == '' ){
				$('#category').addClass('errorborder');
				return false;
			}else if(menu_item == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#menu_item').addClass('errorborder');
				return false;
			}else if(price == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#price').addClass('errorborder');
				return false;
			}else if(description == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#description').addClass('errorborder');
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
			
			});
			
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 46 || charCode > 57) ) {
			return false;
		}
		return true;
	}

</script>
	


