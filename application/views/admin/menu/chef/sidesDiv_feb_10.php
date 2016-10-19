<tr id="sidesdiv_<?php echo $optid;?>_<?php echo $count;?>" class="sidesdiv_<?php echo $optid;?>">
    <td>
    	<input type="text" class="errorsize_<?php echo $optid;?> newoptside optionsides_<?php echo $optid;?>" placeholder="Sides" id="sides_<?php echo $optid;?>_<?php echo $count;?>" style="" name="sides_<?php echo $optid;?>[]"  data-rel="<?php echo $count;?>" >
    </td>  
    <td>
    	<input type="text" onkeypress="return isNumber(event)" class="errorsize_<?php echo $optid;?> newoptprice optionprice_<?php echo $optid;?> " placeholder="Price" id="price_<?php echo $optid;?>_<?php echo $count;?>" style="" name="price_<?php echo $optid;?>[]" data-rel="<?php echo $count;?>"  data-attr="1">
    </td>  
    <td>
        <a href="javascript:void(0);" class="delete_newrow" onclick="delsidesNew('<?php echo $optid;?>_<?php echo $count;?>','<?php echo $optid;?>')"><i class="fa fa-times"></i></a>

    </td> 
</tr> 
<script>
$(document).ready(function() {

$('#sides_<?php echo $optid;?>_<?php echo $count;?>').focus();			
});

</script>