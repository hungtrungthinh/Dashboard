<style>
.admin_body{
	background-color:#FFFFFF;
	border-radius:3px;
}
.form-group{
	margin-right:0px!important;
}

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

 <div class=""> 
 	<span class="saving" style=" display:none;"></span>
    <?php if($this->session->flashdata('error_message')!=''){ ?>
 		<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-danger" role="alert" style="display:none;"></div>
    <?php } ?>
    <?php if($this->session->flashdata('success_message')!=''){ ?>
 		<span class="saving"><?php echo $this->session->flashdata('success_message'); ?></span>
    <?php }else{ ?>
 		<div class="alert alert-success" role="alert" style="display:none;"></div>
    <?php } ?>
    
	<div class="clearfix"></div>
    <div class="col-md-12">
    <ol class="breadcrumb cust_brdcrumb">
      <li><a href="<?php echo base_url().$this->user->root;?>/menu/dish">Menu</a></li>
      <li class="CatAjax" data-attr="<?php echo $itemdetails['category_id'];?>"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png" style="display:none" class="brd_img"><span id="brud_cat"  style="cursor:pointer;"></span></li>
      <li class="active"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_crumb.png"  style="display:none" class="brd_img"><span id="brud_item"></span></li>
      <li style="float:right">
      	<button type="button" class="btn btn_save mg_btm15" name="submit_btn" id="submit_btn">Save</button>
      </li>

    </ol>
    </div>
    <!-- <div class="col-md-2"><span class="saving color_orange" style=" display:none;" ></span></div>-->
    
    <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <form role="form" action="<?php echo base_url().$this->user->root;?>/menu/add_dish" method="post" name="formlist" onsubmit="" id="formlist">	
    <div  class="form-horizontal form_menu_detail" >
    <i class="dish_icon"><img src="<?php echo base_url()?>assets/admin_lte/img/icon_dish.png"></i>
    <div class="col-md-12">
    	
        <div class="col-md-6">
  		<div class="form-group">
        <label class=" control-label" for="textinput">Category<?php //echo $cat_id;?></label>
        <select name="category" id="category" class="form-control menuclass "  data-val="Category">
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
        <input type="text" name="menu_item" id="menu_item"  placeholder="Menu Item" class="form-control menuclass menudishtop"  data-val="Dish Item" >
        </div>
        </div>
       
        
        <div class="clearfix"></div>
        
                    
                    
        <div class="col-md-12 col-sm-12">
        <div class="form-group">
        <label class=" control-label" for="textinput">Description</label>
        <textarea class="form-control menuclass menudishtop" name="description" id="description" data-val="Description"  role="4"></textarea>
        </div>
        </div>
        <div class="clearfix"></div>
       
       <input type="hidden" id="testcat" value="">
        <input type="hidden" id="testitem" value="">
        <input type="hidden" id="testdesc" value="">
        
        
       </div><div class="clearfix"></div>
       </div>
       
       <div  class="form-horizontal form_menu_detail" >
        <div class="col-md-12">
       

        <div class="col-md-4">
            <div class="form-group">
            <input type="checkbox" id="nosize" name="nosize" value="no" >
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
                                  <td><input name="mulprice[]" style="" id="price_1" type="text" placeholder="Price" class="form-control errorsize newpriceadd additem" onkeypress="return isNumber(event)"></td>  
                                 
                                  <td>
                                    <a href="javascript:void(0);" class="delete_row hvr-pop iconstyle" data-attr="1" data-val="1"><i class="fa fa-times-circle"></i></a>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
                    
           </span>

        
    </div>
    <div class="clearfix"></div>
    
    </div>
    <div class="clearfix"></div>
    
    
    
    
    
    <div class="option_wp">
    <h4 class="label_lid">Options and Sides 
    <a href="javascript:void(0);" class="pull-right add_option hvr-pop plus-style"><i class="fa fa-plus-circle"></i></a>
    <a href="javascript:void(0);" class="pull-right remove_option  hvr-pop iconstyle" style="display:none; margin:0 15px;"><i class="fa fa-times-circle"></i></a>
    </h4>
    <div class="clearfix"></div>
    
   <!-- umesh-->
   <input type="hidden" name="itemoptioncount" value="1" id="itemoptioncount" >
   
   		<div class="addmoreptions" style="display:none">
   		<div class="option_div form_menu_detail pad0" id="option_div_1" data-attr="1" style="padding-top:5px !important;">
   		<div class="table-responsive" >
        <div class="col-md-1 col-sm-1">
        <label class="" for="textinput">OPTION</label></div>
        <div class="col-md-3 col-sm-3 ">
        
       		<input type="text" name="option_item[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass form-control" style="" >
        </div> 
         <div class="col-md-3 col-sm-3 ">
                      <span>
                      <input type="checkbox" name="mandatory_1" id="mandatory_1" class="mandatory_1" style="height:15px !important"/>
                      <span></span> This is Mandatory</span>
          </div>
          <div class="col-md-3 col-sm-3 ">            
                      
                    <span>   <input type="checkbox" name="multiple_1" id="multiple_1" data-attr="1" class="multiple_1" style="height:15px !important"/>
                     <span></span>Allow multiple options </span>
          </div>
          <div class="col-md-2 col-sm-2 ">         
                    <span class="mul_limit mul_limit_1" data-attr="1" style="color:#34495e; font-size:14px; display:none; ">
                    <span style="font-weight: inherit;">   MAX :</span>
                    <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" value="" style=" height:28px !important; width:70px;" onkeypress="return isNumber(event)" >
                    </span>   
                      
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
                          <a href="javascript:void(0);" class="pull-right addmore hvr-pop plus-style" data-attr="1"  style="margin-right:7px;">
                          <i class="fa fa-plus-circle"></i>
                          </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="table_body addmoresize_1">
                           <tr id="sidesdiv_1_1" class="sidesdiv_1">
                                 <td><input type="text" class="errorsize_1 newoptside form-control optionsides_1" placeholder="Sides" id="sides_1_1" style="" name="sides_1[]"  data-rel="1" ></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class="errorsize_1 newoptprice form-control optionprice_1" placeholder="Price" id="price_1_1" style="" name="price_1[]"  data-rel="1" data-attr="1"></td>  
                                 
                                  <td>
                                   <label class="action pull-right"><a href="javascript:void(0);" class="delete_rowoptside hvr-pop iconstyle" data-attr="1_1" data-val="1"><i class="fa fa-times-circle"></i></a></label>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
         </div>
        </div>
       </div> 
        
    <!-- umesh-->
    
    
<div class="clearfix"></div>


    
    </div>
    

    
<!--   *****************************  -->
    <div class="clearfix"></div>
    <div class="col-md-12 text-right mg_btm15">
    <input type="hidden" name="item_id" id="item_id" value="<?php //echo $itemdetails['item_id'];?>" >      
    <button type="button" class="btn btn_save mg_btm15" name="submit_btn" id="submit_btn">Save</button>
    <!--<button type="button" class="btn button_gray cancel" onclick="location.href='<?php echo base_url().$this->user->root;?>/menu/dish'">Cancel</button>-->
    </div>
    <div class="clearfix"></div>
    
	</div><!-- /.row -->
	<div class="clearfix"></div>

</div><!-- /.container -->

</form>

<script>
	//-------------------new code----------------------

	//$("body").on("blur",".additem", function(e){});
	 $("body").on("blur",".menudishtop", function(e){
		 
		var category = $.trim($('#category').val());
		var menu_item = $.trim($('#menu_item').val());  
		var description = $.trim($('#description').val());
		var label=$(this).attr('data-val');
		var item_id=$('#item_id').val();
		var flag=1;

		
		if(category!='' && menu_item!=''){
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
										
										
										
										$('#item_id').val(res.item_id);
										$('#testcat').val(res.category_id);
										$('#testitem').val(res.item_name);
										$('#testdesc').val(res.item_description);
										$('#brud_item').html(res.item_name);
										$('#brud_cat').html(res.category_name);
										$('.CatAjax').attr('data-attr',res.category_id);
										
										//$('#edit_'+option_id).hide();
										$('.brd_img').show();
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
			
		}
		
	});
	
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
						return true;
					}
			});	
									
			
			$('#itemsizecount').val(parseInt(itemsizecount)+1);
		  }else{
			return false;
		  }
                          
		   
     });
	
	//-------------------new code----------------------

	  $('body').on('click', '.saveoptions', function () {
		  
		
		var option_id=$(this).attr('data-attr'); 

		var optitle=$('#opt_title_'+option_id).val(); 
		
		if ($('.mandatory_'+option_id).is(":checked"))
		{
			var mandatory='Y';
		}else{
			var mandatory='N';
		}
		if ($('.multiple_'+option_id).is(":checked"))
		{
			var multiple='Y';
		}else{
			var multiple='N';
		}
		//alert(multiple);
		
		var opt=new Array();
		$( ".opt_name_"+option_id).each(function() {
			opt.push($(this).val());
		});
		//alert(opt);

		var price=new Array();
		$( ".opt_price_"+option_id).each(function() {
		 	
			price.push($(this).val());
		});
		
		var sidesid=new Array();
		$( ".opt_sideid_"+option_id).each(function() {
		 	
			sidesid.push($(this).val());
		});
	   //alert(sidesid);
	 
			if(optitle == '' ){
				$('#opt_title_'+option_id).addClass('errorborder');
				return false;
			}
			else{
				
				$('.menuclass').removeClass('errorborder');
				$('.alert').hide();
				$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/updateItem",
							data : {'option_item':optitle,'options':opt,'price':price,'option_id':option_id,'sidesid':sidesid,'mandatory':mandatory,'multiple':multiple},
							success: function(response){
								//alert(sidesid);
								//window.location.reload();
								$('.edit_'+option_id).hide();
								$('.save_'+option_id).hide();
                                $('.newside_'+option_id).hide();
								$('.opt_price_'+option_id).show();
								$('.span_'+option_id).show();
								
								var i=0;
								$( ".span_"+option_id+"_opt").each(function() {
									var id= $(this).attr('data-rel');
									$("#side_"+id).text(opt[i]);	
									
									//alert(opt[i]);
									i++;
								});
								var i=0;
								$( ".span_"+option_id+"_price").each(function() {
									var id= $(this).attr('data-ref');
									$("#price_"+id).text(price[i]);	
									
									//alert(opt[i]);
									i++;
								});
							    
								
							}
						});	
				
			}
			
			
		return false;
				
		
			});
			
			
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
			
			$('.edit_'+id).show();
			$('.save_'+id).show();
			$('.span_'+id).hide();
		});
		$('body').on('click', '.all_options_edit', function () {
			var id= $(this).attr('data-attr');
			$('#saveopt_'+id).show();
			$('.edit_'+id).show();
			$('.save_'+id).show();
			$('.span_'+id).hide();
			
			$('#saveopt_'+id).show();
			$('.newside_'+id).show();
			
		});
		$('body').on('click', '.remove_option', function () {
		 $('.option_div').hide(); 
		 $('.remove_option').hide();
		 $('.add_option').show();  
		 $('#option_item_1').val('');  
		 $('.optionsides_1').val('');  
		 $('.optionprice_1').val('');  
		 
		 
	  });
	  
		
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
								//$('#edit_'+option_id).hide();
								//$('#span_'+option_id).show();
								//$('#span_'+option_id).text(name);
								return true;
							}
						
						});
				
			}else{
				$('#opt_title_'+option_id).addClass('errorborder');
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
								$('.newli_'+opt_id).html(response);
							}
						});	
		}else{
			return false;
		}
	
     });
	 
	 $("body").on("blur",".save_options", function(e){
			var option_id= $(this).attr('data-attr');
			var side_id= $(this).attr('data-rel');
			
			//alert($('#saveopt_'+id).val());
			var value=$('#saveopt_'+side_id).val();
				$.ajax({
						type:"post",
						url:"<?php echo base_url().$this->user->root;?>/menu/saveOptionSideAjax",
						data:{'side_id':side_id,'value':value,'option_id':option_id},
						success:function(data){
						$(this).attr('data-rel', '222');
						return true;
					}
						
				});
				
			
		});
		
		$("body").on("blur",".save_optionsprice", function(e){
			
			var option_id= $(this).attr('data-attr');
			var side_id= $(this).attr('data-rel');
			
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
									
									return true;
								}
							
							});
					
				}else{
					$('#saveopt_'+option_id).addClass('errorborder');
					return false;
				}
			}
		});
		
		
				
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
						var mul_lim=1;
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
			if(flag==1){
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
				
			}
		}
		return false;
		

		   
     });
	
	
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

     
	$('body').on('click', '.delete_row', function () {
		var rowCount = $('.sizediv').length;
		var item_id=$('#item_id').val();
		
		if(rowCount!=1){
			var id	=$(this).attr("data-attr");
			var sizeid	=$(this).attr("data-id");
			var size=$('#size_'+id).val();
			if (confirm("Are you sure to delete?")) {
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
			}else{
			
			  var size_array=Array();
			  var price_array=Array();
			  var flag=1;
			  //for sizes and Prices
				if ($('#nosize').is(':checked')) {
							$( ".newsizeadd" ).each(function() {
								if($(this).val()==''){
									$(this).addClass('errorborder');
									flag=1;
								}else{
									$(this).removeClass('errorborder');
									flag=0;
								}
							});
							$( ".newpriceadd" ).each(function() {
								if($(this).val()==''){
									$(this).addClass('errorborder');
									flag=1;
								}else{
									$(this).removeClass('errorborder');
									flag=0;
								}
							});
							
							
						} else {
							if(price == '' ){
								$('.menuclass').removeClass('errorborder');
								$('#price_dish').addClass('errorborder');
								return false;
							}
							var price_array = $('#price').val();
							var size_array = "Regular";
							if(price_array!='')
								flag=0;
							else
								flag=1;
									
						}
				 //-----------------------
				//alert();
				if(flag==1){
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
			}
			
			});

	
	$('body').on('click', '.delsides', function () {
		var sidesid= $(this).attr('data-attr');
		var optionsid= $(this).attr('data-val');
		
		if (confirm("Are you sure to delete?")) {
			
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteSides",
							data:{'sidesid':sidesid},
							success:function(data){
								
								
								$('#sideslist_'+sidesid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
									$('#sideslist_'+sidesid).remove();	
								});
								$.ajax({
									type:"post",
									url:"<?php echo base_url().$this->user->root;?>/menu/ajaxdelShowsides",
									data:{'option_id':optionsid},
									success:function(data){
										$('.newli_'+optionsid).html(data);
									}
								
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
		//alert(sidesid);
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




function deleteall(option_id) {
		if (confirm("Are you sure to delete?")) {
			
					$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteall",
							data:{'option_id':option_id},
							success:function(data){
							    $('.alert-success').show();
								$('.alert-success').html('Options and sides deleted sucessfully'); 
								 $('#optionlist_'+option_id).hide();
								return true;
							}
						
						});
						
						
		}else{
			return false;	
		}
		
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
					//return false;
					// POST to server using $.post or $.ajax
					$.ajax({
						data: data,
						type: 'POST',
						url: '<?php echo base_url().$this->user->root;?>/menu/sortorder'
					});
				}
			});



});




<!--   *****************************  -->

		
		$('body').on('click', '#nosize', function () {
			if ($(this).is(':checked')) {
				$('.hidenoprice').show();
				$('.shownoprice').hide();
			} else {
				$('.hidenoprice').hide();
				$('.shownoprice').show();
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
					
					$('.admin_body').html(data);
					return true;
				}
			
		});
		
	});
	
	
	$('body').on('click','.multiple_check', function(e){
	
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
	
		$('body').on('click','.multiple_1', function(e){
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

/*$('body').on('keypress', '.inputside', function (e) {
    if(e.which == 13) {
		//alert("here");
		var opt_id= $(this).attr('data-rel');
		
		if(opt_id!=''){
			$('#saveoptprice_'+opt_id).focus();
		}else{
			var opt_id= $(this).attr('data-opt');
			$('.focprice_'+opt_id).focus();
		}
	}
});
*/
$('body').on('keypress', '.newoptside', function (e) {
    if(e.which == 13) {
		var opt_id= $(this).attr('data-rel');
		if(opt_id!=''){
			$('#price_1_'+opt_id).focus();
		}
	}
});

$('body').on('keypress', '.newoptprice', function (e) {
    if(e.which == 13) {
		var opt_id= $(this).attr('data-rel');
		if(opt_id!=''){
		var cn=parseInt(opt_id)+1;	
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
			
			$('#sides_1_'+cn).focus();			
			
			
		}else{
			if($('#sides_'+addid+'_'+itemsizecount).val()==''){
				$('#sides_'+addid+'_'+itemsizecount).addClass('errorborder');
			}
		}
		
		return true;
		
		}
	}
});


     </script>
	
<style>
ul,li{list-style-type:none !important; padding:0px;}
</style>

