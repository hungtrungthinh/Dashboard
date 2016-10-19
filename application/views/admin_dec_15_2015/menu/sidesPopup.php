<tr id="sidesdivpop_<?php echo $count;?>" class="sidesdivpop">
    <td>
    	<input type="text" class="errorsize_<?php echo $count;?>" placeholder="Sides" id="sides_<?php echo $count;?>" style="" name="sides[]" >
    </td>  
    <td>
    	<input type="text" onkeypress="return isNumber(event)" class="errorsize_<?php echo $count;?>" placeholder="Price" id="price_<?php echo $count;?>" style="" name="price[]">
    </td>  
    <td>
    	<label class="action pull-right">
        	<a href="javascript:void(0);" class="delete_rowpop" data-attr="<?php echo $count;?>" >
            	<img src="<?php echo base_url()?>assets/admin_lte/img/close_icon.png">
            </a>
        </label>
    </td> 
    <input type="hidden" name="sidesID[]" value=""  >
</tr> 	

<script>
$(".delete_rowpop").click(function(e){
		var delid= $(this).attr('data-attr');
		
		var rowCount = $('.sidesdivpop').length;
		if(rowCount!=1){

			if (confirm("Are you sure to delete?")) {
				$('#sidesdivpop_'+delid).animate( {backgroundColor:'#F6FAFB'}, 500).fadeOut(500,function() {
						$('#sidesdivpop_'+delid).remove();	
							
				});

				}else{
					return false;	
				}
			
		}else{
			
		}
	});	 
</script>	 