<form role="form" action="<?php echo base_url().$this->user->root;?>/menu/editOption" method="post" name="formoption" onsubmit="" id="formoption">	
<input type="hidden" name="option_id" value="<?php echo $option_id; ?>" id="option_id" >
<div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#DF7707;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $options_details['option_name'];?></h4>
          </div>
        <div class="modal-body">
        <div class="option_div form_menu_detail pad0" id="option_div_1" data-attr="<?php //echo $count;?>"  style="padding-top:5px !important;">
   		<div class="table-responsive">
        <div class="col-md-2 ">
        <label class="" for="textinput">OPTION</label></div>
        <div class="col-md-7">
        <input type="text" name="option_item" value="<?php echo $options_details['option_name'];?>" id="option_item"  placeholder="Enter option name" class=" menuclass " style="" >
        </div>
        </div>
       <div class="clearfix"></div>
       
       
       <div class="table-responsive"  style="padding-top:5px !important;">
       <input type="hidden" name="itemsizecount" value="<?php if(count($sidesdetails)!=0){echo count($sidesdetails);}else{ echo "1"; } ?>" id="itemsizecountpop" >
                    <table class="table table-striped">
                      <thead class="head_table">
                        <tr>
                          <th class="col-md-6 col-sm-6">SIDES</th>
                          <th class="col-md-4 col-sm-4">PRICE</th>
                          <th class="col-md-1 col-sm-1">
                          <a href="javascript:void(0);" class="pull-right addmoresides" data-attr="<?php echo count($sidesdetails); ?>">
                          <img src="<?php echo base_url()?>assets/admin_lte/img/plus_icon.png">
                          </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="table_body addmoresize">
                      <?php if(count($sidesdetails)!=0){
						  $i=1;
					  ?>
                      <?php foreach($sidesdetails as $val ){ ?>	
                           <tr id="sidesdivpop_<?php echo $i;?>" class="sidesdivpop">
                                 <td><input type="text" class="errorsize_<?php echo $i;?>" placeholder="Sides" id="sides_<?php echo $i;?>" style="" name="sides[]"  value="<?php echo $val['side_item'];?>"></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class="errorsize_<?php echo $i;?>" placeholder="Price" id="price_<?php echo $i;?>" style="" name="price[]" value="<?php echo $val['price'];?>"></td>  
                                 
                                  <td>
                                   <label class="action pull-right"><a href="javascript:void(0);" class="delete_rowpop" data-val="<?php echo $val['side_id']; ?>" data-attr="<?php echo $i;?>"><img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png"></a></label>
                                  
                                  </td> 
                                  <input type="hidden" name="sidesID[]" value="<?php echo $val['side_id']; ?>"  >
                           </tr>
                      <?php $i++;
					  } ?>     
                      <?php }else{ ?>
                          <tr id="sidesdivpop_<?php echo $count;?>" class="sidesdivpop">
                            <td>
                                <input type="text" class="errorsize_1" placeholder="Sides" id="sides_1" style="" name="sides[]" >
                            </td>  
                            <td>
                                <input type="text" onkeypress="return isNumber(event)" class="errorsize_1" placeholder="Price" id="price_1" style="" name="price[]">
                            </td>  
                            <td>
                                <label class="action pull-right">
                                    <a href="javascript:void(0);" class="delete_rowpop" data-attr="1" >
                                        <img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png">
                                    </a>
                                </label>
                            </td> 
                            <input type="hidden" name="sidesID[]" value="" >
                        </tr> 
                      
                      <?php } ?>          
                      </tbody>
                    </table>
         </div>
        </div>
        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="button" class="btn btn_blue" id="saveOption" value="Save changes">
          </div>
          
        </div>
      </div>
      </form>
      
      <script>
	  	$(".addmoresides").click(function(e){
		var addid= $(this).attr('data-attr');
		//var cnt=$('#option_div_'+addid).attr('data-attr');
		
		//var option_item = $('#option_item').val();  
		var itemsizecount = $('#itemsizecountpop').val();  
		//alert(itemsizecount);
		//var count = $('#itemoptioncount').val(); 
		$('.errorsize_'+addid).removeClass('errorborder');
		if($('#sides_'+itemsizecount).val()!='' && $('#price_'+itemsizecount).val()!='' ){
		
			$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/addSidesPopDiv",
							data:{'optid':addid,'count':itemsizecount},
							success:function(data){
								$('.addmoresize').append(data);
								$('#itemsizecountpop').val(parseInt(itemsizecount)+1);
							}
						
						});
		}else{
			if($('#sides_'+itemsizecount).val()=='' && $('#price_'+itemsizecount).val()=='' ){
				$('#sides_'+itemsizecount).addClass('errorborder');
				$('#price_'+itemsizecount).addClass('errorborder');
			}else if($('#sides_'+itemsizecount).val()==''){
				$('#sides_'+itemsizecount).addClass('errorborder');
			}else{
				$('#price_'+itemsizecount).addClass('errorborder');
			}
		}
		return false;
		

		   
     });
	
	$(".delete_rowpop").click(function(e){
		var delid= $(this).attr('data-attr');
		var sideid= $(this).attr('data-val');
		
		var rowCount = $('.sidesdivpop').length;
		if(rowCount!=1){

			if (confirm("Are you sure to delete?")) {
				
				$.ajax({
							type:"post",
							url:"<?php echo base_url().$this->user->root;?>/menu/deleteSides",
							data:{'sidesid':sideid},
							success:function(data){
								$('#sidesdivpop_'+delid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
									$('#sidesdivpop_'+delid).remove();	
										
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
	 
	
	  		$('body').on('click', '#saveOption', function () {
			var option_item = $('#option_item').val();  
			var option_id = $('#option_id').val();
			
			if(option_item == '' ){
				$('#option_item').addClass('errorborder');
				return false;
			}
			
			else{
				
				$('.menuclass').removeClass('errorborder');
				$('.alert').hide();
				$.ajax({
							type:'POST',
							url: "<?php echo base_url().$this->user->root;?>/menu/checkItemExist",
							data : {'option_item':option_item,'option_id':option_id},
							success: function(response){
								if(response==0){
									$('.alert-danger').show();
									$('.alert-danger').html('Item already exist');
									return false;
								}else{
									$('#formoption').submit();
								}
								
							}
						});	
				
			}
			
			});


  </script>