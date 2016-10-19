    <h4 class="label_lid">Options and Sides 
    <div class="col-lg-12">
    <div class="col-lg-10"></div><div class="col-lg-2">
   
    <a href="javascript:void(0);" class="pull-right add_option hvr-pop plus-style"><i class="fa fa-plus-circle"></i></a>
    <?php if($page!='plusBtn'){ ?>
    	<a href="javascript:void(0);" class="pull-right remove_option hvr-pop iconstyle" style="margin:0px 15px; display:none;"><i class="fa fa-times-circle"></i></a>
    <?php }else{ ?>
    	<a href="javascript:void(0);" class="pull-right remove_option hvr-pop iconstyle" style="margin:0px 15px;"><i class="fa fa-times-circle"></i></a>
    <?php } ?>
    	
       	</div>
    </div>

    </h4>
    <div class="clearfix"></div>
    
   <!-- umesh-->
   <input type="hidden" name="itemoptioncount" value="1" id="itemoptioncount" >
   
   		<div class="addmoreptions" <?php if($page!='plusBtn'){ ?> style=" display:none;" <?php } ?> >
   		<div class="option_div form_menu_detail pad0" id="option_div_1" data-attr="1" style="padding-top:5px !important;">
   		<div class="table-responsive" >
        <div class="col-md-2 col-sm-2">
        <label class="" for="textinput">OPTION</label></div>
        <div class="col-md-4 col-sm-4">
        
       		<input type="text" name="option_item[]" value="" id="option_item_1" data-attr="1"  placeholder="Enter option name" class="menuclass optionclass form-control" style="" >
        </div> 
         <div class="col-md-3 col-sm-3">
                      <span>
                      <input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_1" id="mandatory_1" class="mandatory_1" style="height:15px !important"/>
                      <span>*</span> This is Mandatory</span>
          </div>
          <div class="col-md-3 col-sm-3">            
                      
                    <span>   <input type="checkbox"  name="multiple_1" id="multiple_1" data-attr="1" class="multiple_1" style="height:15px !important"/>
                    <span>*</span>Allow multiple options </span><br>
                   	<span class="mul_limit mul_limit_1" data-attr="1" style="color:#34495e; font-size:14px; display:none; ">
                      MAX : <input type="text"  id="mul_lim_1" name="mul_lim_1" class="" value="" style=" height:28px !important;" onkeypress="return isNumber(event)" >
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
                          <a href="javascript:void(0);" class="pull-right addmore hvr-pop plus-style" data-attr="1">
                          <i class="fa fa-plus-circle"></i>
                          </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="table_body addmoresize_1">
                           <tr id="sidesdiv_1_1" class="sidesdiv_1">
                                 <td><input type="text" class="errorsize_1 optionsides_1 newoptside  form-control" placeholder="Sides" id="sides_1_1" style="" name="sides_1[]"  data-rel="1"  data-attr="1"></td>  
                                  <td><input type="text" onkeypress="return isNumber(event)" class="errorsize_1 optionprice_1 newoptprice  form-control" placeholder="Price" id="price_1_1" style="" name="price_1[]" data-attr="1" data-rel="1"></td>  
                                 
                                  <td>
                                   <label class="action pull-right"><a href="javascript:void(0);" class="hvr-pop iconstyle delete_rowoptside delete_newrow" data-attr="1_1" data-val="1"><i class="fa fa-times-circle"></i></a></label>
                                  
                                  </td> 
                           </tr> 
                      </tbody>
                    </table>
         </div>
        </div>
       </div> 
        
        
    
    <!-- umesh-->
    
    
    
    
<div class="clearfix"></div>
  
  <ul class="exclude1 exclude list sortable" id="">  
  <?php 
		if(count($options_details)!=0){ 
			$cnt=1;
		  	foreach($options_details as $val){ 
			
			
			?>

              <li id="optionlist_<?php echo $val['option_id']; ?>" data-attr="" >
  				<div class="sides_wp">
                <div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablepad  item_lid">
  <tr  style=" background:none;">
    <td><h5 class="item_lid"></td>
    <td><span class="saveopttitle edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>">
					  <input type="text"  id="opt_title_<?php echo $val['option_id'] ; ?>" name="opt_title_<?php echo $val['option_id'];?>" class="form-control" value="<?php echo $val['option_name'] ; ?>">
                      </span></td>
    <td><span class="">
                      
                      <input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_<?php echo $val['option_id'] ; ?>" id="mandatory_<?php echo $val['option_id'] ; ?>" class="mandatory_<?php echo $val['option_id'] ; ?> man_opt"  data-attr="<?php echo $val['option_id'] ; ?>">
                      <span></span> This is Mandatory
                      </span></td>
    <td><span class=""> 
                         <input type="checkbox" <?php if($val['multiple']=='Y'){?>checked="true"<?php }?> name="multiple_<?php echo $val['option_id'] ; ?>" id="multiple_<?php echo $val['option_id'] ; ?>" class="multiple_<?php echo $val['option_id'] ; ?> mul_opt" data-attr="<?php echo $val['option_id'] ; ?>">
                      <span></span>Allow multiple options 
                      
                      </span></td>
    <td><span class=""> 
                      
                      <span class="mul_limit mul_limit_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo $val['option_id'] ; ?>" style="color:#34495e; font-size:14px;<?php if($val['multiple']=='N') { ?> display:none; <?php } ?>"><label style="margin:6px;font-weight: inherit;"> MAX : </label><input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" name="mul_lim_<?php echo $val['option_id'];?>" class="inputnew" value="<?php echo $val['limit']; ?>" style="position:absolute; height:33px; width:50px;" onkeypress="return isNumber(event)" >
                      </span>
                      </label>
                      
                      </span></td>
    <td  style="padding:15px;"><span class="">
                       
                        
                      <a href="javascript:void(0)"  class="pull-right hvr-pop iconstyle "  onclick="deleteall('<?php echo $val['option_id'];?>')"><i class="fa fa-times-circle"></i></a>
                         
                      <div class="pull-right" style="width:50%"> 
                      
                      <a href="javascript:void(0)"  class="pull-right saveoptions save_<?php echo $val['option_id'];?> glyphicon glyphicon-ok" data-attr="<?php echo $val['option_id'];?>" style="display:none;">
                     	  
                      </a>
                     
                      
                      <span style="margin:0px 15px; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                      <label>
                      <input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                      <span></span>
                      </label>
                      </span>
                    
                      </div>
                      </span></td>
    
    <?php if($is_mobile==1){ ?>
    <td class="sortarrow" >
    <?php if($cnt==1){ ?>
    	<p style=" display:none;"><a href="javascript:void(0)" style="color:#989898;" class="sort_up iconstyle" data-item="<?php echo $itemdetails['item_id'];?>" data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-asc"></i></a></p>
    <?php }else{ ?>
   		<p><a href="javascript:void(0)"  class="sort_up iconstyle" style="color:#989898;" data-item="<?php echo $itemdetails['item_id'];?>" data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-asc"></i></a></p>
    <?php } ?>
    
    <?php if($cnt==count($options_details)){ ?>
    	<p style=" display:none;">
        	<a href="javascript:void(0)"  class="sort_down iconstyle" style="color:#989898;"  data-item="<?php echo $itemdetails['item_id'];?>"  data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-desc"></i></a>
        </p>
    <?php }else{ ?>
   		<p>
        	<a href="javascript:void(0)"   class="sort_down iconstyle" style="color:#989898;"  data-item="<?php echo $itemdetails['item_id'];?>" data-attr="<?php  echo $val['option_id']; ?>" data-sort="<?php  echo $val['sortorder']; ?>"><i class="fa fa-sort-desc"></i></a>
        </p>
    <?php } ?>
    
    
    </td>
     <?php }?>     
    
    
  </tr>
</table>
                </div>
                <div>
                
                
                    <?php /*?><h5 class="item_lid col-lg-12 col-md-12">
					  <span class="col-lg-4 col-sm-4 save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>">
					  <input type="text"  id="opt_title_<?php echo $val['option_id'] ; ?>" name="opt_title_<?php echo $val['option_id'];?>" class="form-control" value="<?php echo $val['option_name'] ; ?>">
                      </span>
                      <span class="col-lg-2 col-sm-2">
                      <input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_<?php echo $val['option_id'] ; ?>" id="mandatory_<?php echo $val['option_id'] ; ?>" class="mandatory_<?php echo $val['option_id'] ; ?> man_opt" data-attr="<?php echo $val['option_id'] ; ?>">
                      <span>*</span> This is Mandatory</span>
                      <span class="col-lg-2 col-sm-2"> 
                      <input type="checkbox" <?php if($val['multiple']=='Y'){?>checked="true"<?php }?> name="multiple_<?php echo $val['option_id'] ; ?>" id="multiple_<?php echo $val['option_id'] ; ?>" class="multiple_<?php echo $val['option_id'] ; ?> mul_opt" data-attr="<?php echo $val['option_id'] ; ?>">
                      <span>*</span>Allow multiple options 
                      </span>
                      <span class="col-lg-2 col-sm-2"> 
                      <span class="mul_limit mul_limit_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo $val['option_id'] ; ?>" style="color:#34495e; font-size:14px;<?php if($val['multiple']=='N') { ?> display:none; <?php } ?>">
                      MAX : <input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" name="mul_lim_<?php echo $val['option_id'];?>" class="" value="<?php echo $val['limit']; ?>" style="position:absolute;" onkeypress="return isNumber(event)" >
                      </span>
                      </span>
                      <span class="col-lg-2 col-sm-2">   
                          <a href="javascript:void(0);"  onclick="deleteall('<?php echo $val['option_id'];?>')" class="hvr-pop iconstyle delete_rowoptside pull-right" ><i class="fa fa-times-circle"></i></a>
                      <div class="pull-right" style="width:50%;"> 
                      <a href="javascript:void(0)"  class="pull-right saveoptions save_<?php echo $val['option_id'];?> glyphicon glyphicon-ok" data-attr="<?php echo $val['option_id'];?>" style="display:none;">
                      </a>
                      <span style="margin:0px 15px; float:right;" class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                      <label>
                      <input type="checkbox"  <?php if($val['status']=='Y'){ ?> checked="true" <?php } ?> onClick="option_status(<?php echo $val['option_id'];?>,'<?php echo $val['status'];?>')" class="option_status_<?php echo $val['option_id'];?>" data-val="<?php echo $val['status'];?>">
                      <span></span>
                      </label>
                      </span>
                      </div>
                      </span>
                      
                    </h5><?php */?>
                           
<div class="clearfix"></div>

<table id="diagnosis_list" class="table2 diagnosis_list newli_<?php echo $val['option_id']; ?>"  data-attr="<?php echo $val['option_id']; ?>" >
<tbody  class="tbodyOpt_<?php echo $val['option_id']; ?>">
                <?php 
					if(count($sidesdetails[$val['option_id']])!=0){ 
					$i=0;
		  				foreach($sidesdetails[$val['option_id']] as $valu){  ?>
<tr data-attr="<?php echo $valu['side_id'] ; ?>" id="sideslist_<?php echo $valu['side_id'];?>" class="ui-sortable-handle tr_opt_<?php echo $val['option_id'] ; ?>">
        <td class="sorter" style="width:30px;">
        	<!--<img src="<?php echo base_url()?>assets/admin_lte/img/grippy_large.png">-->
        </td>
        <td>
            <span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" >
					 <input type="text"  id="saveopt_<?php echo $valu['side_id'] ; ?>" name="opt_name_<?php echo $val['option_id'];?>[]" class="opt_name_<?php echo $val['option_id'] ; ?> inputnew inputside" value="<?php echo $valu['side_item']; ?>" data-rel="<?php echo $valu['side_id'] ; ?>" style=" width:100%;">
            </span>  
          
        </td>
    	<td>
            <div class="pull-right">
                    
                    
                    <label class="rate">+$
                    
					<span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" >
					 <input type="text"  id="saveoptprice_<?php echo $valu['side_id'] ; ?>" name="opt_price_<?php echo $val['option_id'];?>[]" class="opt_price_<?php echo $val['option_id'] ; ?> inputprice  inputnew" value="<?php echo $valu['price']; ?>"  onkeypress="return isNumber(event)" style=""  data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                    </span>
                    
                    <input type="hidden"  id="saveopt_<?php //echo $val['option_id'];?>" name="opt_sideid_<?php echo $val['option_id'];?>[]" class="opt_sideid_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_id']; ?>">
                    
                    </label>
                     <label class="action pull-right"></label>
					
					<?php 
					$i++;
					if($i==count($sidesdetails[$val['option_id']])){
					?>
                    <label class="action pull-right">
                    <a class="pull-right addmoresides hvr-pop plus-style sort_<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $val['option_id'] ; ?>" data-attr="" href="javascript:void(0);" >
                    	<i class="fa fa-plus-circle"></i>
                    </a></label>
                    <?php 
					}else{?>
                    <label class="action pull-right">
                    <a class="pull-right addmoresides hvr-pop plus-style sort_<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $val['option_id'] ; ?>" data-attr="" href="javascript:void(0);" style="display:none;">
                    	<i class="fa fa-plus-circle"></i>
                    </a></label>
                    
                    <?php } ?>
                    <label class="action pull-right">
                    <a href="javascript:void(0);" data-attr="<?php echo $valu['side_id']; ?>" class="hvr-pop iconstyle delsides" data-val="<?php echo $val['option_id'] ; ?>" >
                    	<i class="fa fa-times-circle"></i>
                    </a>
                    </label>
                    </div>
    	</td>
    </tr>
 <?php 
	}
}
?>
</tbody>
</table>
</div>
 <div class="clearfix"></div>          
</div>
</li>

	<?php 
		$cnt++;
			}
			
		}
	?>
    
    </ul> 
    
<script>

$(document).ready(function() {
	//Helper function to keep table row from collapsing when being sorted
	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index)
		{
		  $(this).width($originals.eq(index).width())
		});
		return $helper;
	};

	//Make diagnosis table sortable
	$(".diagnosis_list tbody").sortable({
    	helper: fixHelperModified,
		update: function(event, ui) {
		var arr = $(this).sortable('serialize');
		//alert(arr);
		$.ajax({
			//data:{'sideslist':arr},
				data: arr,
				type: 'POST',
				url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
				success: function(response){
				//$('.addmoresides').hide();
				var sid=$(this).attr('data-attr')
				//alert(sid);
				var rowCount = $('.sort_'+sid).length;
				//alert(rowCount);
				}
			}); 
	  },
		stop: function(event,ui) {renumber_table('.diagnosis_list')}
	});



});

function renumber_table(tableID) {
	//alert(tableID);
	$(tableID + " tr").each(function() {
		count = $(this).parent().children().index($(this)) + 1;
		$(this).find('.priority').html(count);
	});
}


	$(function() {
		
			setTimeout(function(){
				$('.saving').fadeOut(5000);
			}, 100);
			
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
			//$(".sortable2").disableSelection();
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
						url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
						success: function(response){
								//$('.addmoresides').hide();
								var sid=$(this).attr('data-attr')
								//alert(sid);
								var rowCount = $('.sort_'+sid).length;
								//alert(rowCount);
							}
					});
				}
			});



});
	$(".table2").rowSorter({
		handler: "td.sorter",
		onDrop: function(tbody, row, index, oldIndex) {
			var opt_id	=	$(tbody).parent().attr("data-attr");
			var sideAr=Array();
			$('.tr_opt_'+opt_id).each(function() {
				sideAr.push($(this).attr('data-attr'));
			});
			//alert(sideAr);
			//var data = $(this).sortable('serialize');
			$.ajax({
				data:{'sideslist':sideAr},
				//data: data,
				type: 'POST',
				url: '<?php echo base_url().$this->user->root;?>/menu/sortorder',
				success: function(response){
						//$('.addmoresides').hide();
						//$('.tbodyOpt_'+opt_id).html(response);
						var sid=$(this).attr('data-attr')
						//alert(sid);
						var rowCount = $('.sort_'+sid).length;
						//alert(rowCount);
					}
			});
			//$(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
		}
	});   


</script>