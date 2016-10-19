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
      <li class="active"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png"><?php echo $itemdetails['item_name'];?></li>
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
        
        <div class="col-md-6">
  		<div class="form-group">
        <label class=" control-label" for="textinput">Price</label>
        <input type="text" name="price_dish" value="<?php echo $itemdetails['price'];?>"  id="price_dish" placeholder="Price" class="form-control menuclass" onkeypress="return isNumber(event)" >
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
        
        
    </div>
    <div class="clearfix"></div>
    
    </div>
    <div class="clearfix"></div>
    
    
    
    
    
    <div class="option_wp">
    <h4 class="label_lid">Options and Sides 
    <a href="javascript:void(0);" class="pull-right add_option"><img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png"></a>
    </h4>
    <div class="clearfix"></div>
    
   <!-- umesh-->
   <input type="hidden" name="itemoptioncount" value="1" id="itemoptioncount" >
   
   		<div class="addmoreptions" style="display:none">
   		<div class="option_div form_menu_detail pad0" id="option_div_1" data-attr="1" style="padding-top:5px !important;">
   		<div class="table-responsive" >
        <div class="col-md-2 ">
        <label class="" for="textinput">OPTION</label></div>
        <div class="col-md-7">
        <input type="text" name="option_item[]" value="" id="option_item_1"  placeholder="Enter option name" class="menuclass" style=" width:100%;" >
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
                                 <td><input type="text" class="errorsize_1" placeholder="Sides" id="sides_1_1" style="" name="sides_1[]" ></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class="errorsize_1" placeholder="Price" id="price_1_1" style="" name="price_1[]"></td>  
                                 
                                  <td>
                                   <label class="action pull-right"><a href="javascript:void(0);" class="delete_row" data-attr="1_1" data-val="1"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
         </div>
        </div>
       </div> 
        
        
    
    <!-- umesh-->
    
    
    
    
    <div class="clearfix"></div>
    
    
    <?php 
		if(count($options_details)!=0){ 
		  	foreach($options_details as $val){ ?>
				
				<div class="sides_wp">
                    <h5 class="item_lid">
					  <span class="all_options" id="span_<?php echo $val['option_id'];?>" title="Double click to edit" data-attr="<?php echo $val['option_id'] ; ?>"><?php echo $val['option_name'] ; ?></span>
					  <span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>"  style="display:none;">
					 	 <input type="text"  id="saveopt_<?php echo $val['option_id'] ; ?>" name="" class="" value="<?php echo $val['option_name'] ; ?>">
                      </span>
                      
                      <span><input type="checkbox"> <span>*</span> This is Mandatory</span>
                      
                      
                      <div class="pull-right">
                      
                   
                      <a href="javascript:void(0)"  class="pull-right"  onclick="viewPopup('<?php echo $val['option_id'];?>')"><span class="mr_2" data-toggle="modal" data-target="#myModal" >edit</span></a>
                      
                      
                      <span style="margin:0; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                      <label>
                      <input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                      <span></span>
                      </label>
                      </span>
                      </div>
                      
                      
                    </h5>
                    
                    
                    
                    <ul class="item_list">
                
                <?php 
					if(count($sidesdetails[$val['option_id']])!=0){ 
		  				foreach($sidesdetails[$val['option_id']] as $valu){  
						
						//print_r($valu);?>
                	
                    <li id="sideslist_<?php echo $valu['side_id']; ?>" >
                    <?php echo $valu['side_item']; ?>
                    <div class="pull-right">
                    <label class="action pull-right"></label>
                    <label class="action pull-right">
                    <a href="javascript:void(0);" data-attr="<?php echo $valu['side_id']; ?>" class="delsides" >
                    	<img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png">
                    </a>
                    </label>
                    <label class="rate">+$
					<?php echo $valu['price']; ?>
                    </label>
                    </div>
                    </li>
                    <div class="clearfix"></div>
                    
                   		 <?php 
							}
							
						}
					?>
                    
                    </ul>
                    </div>
				
				
	<?php 
			}
			
		}
	?>
    
    
    
    
    
    
    
    
    
    
    </div>
    
    
    <!--   *****************************  -->
  				<ul class="exclude1 exclude list sortable" id="">  
  <?php 
		if(count($options_details)!=0){ 
		  	foreach($options_details as $val){ ?>

                <li style="height: 30px" id="">	
				<div class="sides_wp" style="margin: 5% 0px 2%; padding-bottom: 0px; padding-top: 0px;">
                    <h5 class="item_lid">
					  <span class="all_options" id="span_<?php echo $val['option_id'];?>" title="Double click to edit" data-attr="<?php echo $val['option_id'] ; ?>"><?php echo $val['option_name'] ; ?></span>
					  <span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>"  style="display:none;">
					 	 <input type="text"  id="saveopt_<?php echo $val['option_id'] ; ?>" name="" class="" value="<?php echo $val['option_name'] ; ?>">
                      </span>
                      
                      <span><input type="checkbox"> <span>*</span> This is Mandatory</span>
                      
                      
                      <div class="pull-right">
                      
                   
                      <a href="javascript:void(0)"  class="pull-right"  onclick="viewPopup('<?php echo $val['option_id'];?>')"><span class="mr_2" data-toggle="modal" data-target="#myModal" >edit</span></a>
                      
                      
                      <span style="margin:0; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                      <label>
                      <input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                      <span></span>
                      </label>
                      </span>
                      </div>
                      
                      
                    </h5>
                    
                    
                    
                    <ul class="item_list">
                
                <?php 
					if(count($sidesdetails[$val['option_id']])!=0){ 
		  				foreach($sidesdetails[$val['option_id']] as $valu){  
						
						//print_r($valu);?>
                	<ul class="item_list  list sortable2">
                    <li id="sideslist_<?php echo $valu['side_id']; ?>" >
                    <?php echo $valu['side_item']; ?>
                    <div class="pull-right">
                    <label class="action pull-right"></label>
                    <label class="action pull-right">
                    <a href="javascript:void(0);" data-attr="<?php echo $valu['side_id']; ?>" class="delsides" >
                    	<img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png">
                    </a>
                    </label>
                    <label class="rate">+$
					<?php echo $valu['price']; ?>
                    </label>
                    </div>
                    </li>
                    <div class="clearfix"></div>
                    
                   		 <?php 
							}
							
						}
					?>
                    
                    </ul>
                    </div>
				
				
	<?php 
			}
			
		}
	?>
    </li>
    </ul>
    
	</ul>
    
    
    
<!--   *****************************  -->
    <div class="clearfix"></div>
    <div class="col-md-12 text-right mg_btm15">
    <input type="hidden" name="item_id" id="item_id" value="<?php echo $itemdetails['item_id'];?>" >      
    <button type="button" class="btn btn_save mg_btm15" name="submit_btn" id="submit_btn">Save</button>
    <button type="button" class="btn button_gray cancel" onclick="location.href='<?php echo base_url().$this->user->root;?>/menu/dish'">Cancel</button>
    </div>
    <div class="clearfix"></div>
    
	</div><!-- /.row -->
	<div class="clearfix"></div>

</div><!-- /.container -->

</form>








    
    
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  
	 </div>
<script>

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
			$('#edit_'+id).show();
			$('#span_'+id).hide();
		});
		

		
		$("body").on("blur",".save_options", function(e){
			var option_id= $(this).attr('data-attr');
			if($('#saveopt_'+option_id).val()!=''){
				//alert($('#saveopt_'+id).val());
				var name=$('#saveopt_'+option_id).val();
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/saveOptionAjax",
							data:{'option_id':option_id,'name':name},
							success:function(data){
								$('#edit_'+option_id).hide();
								$('#span_'+option_id).show();
								$('#span_'+option_id).text(name);
								return true;
							}
						
						});
				
			}else{
				$('#saveopt_'+option_id).addClass('errorborder');
				return false;
			}
			
		});
		

		
	$("body").on("click",".add_option", function(e){
		    $(".addmoreptions").show(); 
		    var count = $('#itemoptioncount').val(); 
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
	
	
	$('body').on('click', '.delete_row', function () {
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
			}else if(price == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#price_dish').addClass('errorborder');
				return false;
			}/*else if(description == '' ){
				$('.menuclass').removeClass('errorborder');
				$('#description').addClass('errorborder');
				return false;
			}*/else{
				
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

	
	$('body').on('click', '.delsides', function () {
		var sidesid= $(this).attr('data-attr');
		if (confirm("Are you sure to delete?")) {
			
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteSides",
							data:{'sidesid':sidesid},
							success:function(data){
								
								$('#sideslist_'+sidesid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
									$('#sideslist_'+sidesid).remove();	
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
		alert(sidesid);
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

			
});

		

<!--   *****************************  -->
</script>
	
<style>
ul,li{list-style-type:none !important;padding-left:0px !important}
</style>

