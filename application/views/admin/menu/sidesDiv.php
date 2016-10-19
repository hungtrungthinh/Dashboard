<tr id="sidesdiv_<?php echo $optid;?>_<?php echo $count;?>" class="sidesdiv_<?php echo $optid;?>">
    <td>
    	<input type="text" class="errorsize_<?php echo $optid;?> form-control newoptside optionsides_<?php echo $optid;?>" placeholder="Sides" id="sides_<?php echo $optid;?>_<?php echo $count;?>" style="" name="sides_<?php echo $optid;?>[]"  data-rel="<?php echo $count;?>" >
    </td>  
    <td>
    	<input type="text" onkeypress="return isNumber(event)" class="errorsize_<?php echo $optid;?> newoptprice optionprice_<?php echo $optid;?> form-control" placeholder="Price" id="price_<?php echo $optid;?>_<?php echo $count;?>" style="" name="price_<?php echo $optid;?>[]" data-rel="<?php echo $count;?>"  data-attr="1">
    </td>  
    <td>
    	<label class="action pull-right">
        	<a href="javascript:void(0);" class="delete_rowoptside delete_newrow hvr-pop iconstyle" data-attr="<?php echo $optid;?>_<?php echo $count;?>" data-val="<?php echo $optid;?>">
            	<i class="fa fa-times-circle"></i>
            </a>
        </label>
    </td> 
</tr> 
<script>
$(document).ready(function() {

$('#sides_<?php echo $optid;?>_<?php echo $count;?>').focus();			
});

</script>