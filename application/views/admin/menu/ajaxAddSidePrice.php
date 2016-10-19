<tr class="sizediv" id="sizediv_<?php echo $newcnt;?>">
    <td>
   		<input name="mulsize[]" id="size_<?php echo $newid;?>" type="text" data-rel="" value="" placeholder="size" class="form-control autosize newsizeadd">
    </td>
    <td>
    	<input name="mulprice[]" id="price_<?php echo $newid;?>" type="text" value="" placeholder="price" class="form-control additem newpriceadd" onkeypress="return isNumber(event)">
    </td>
    <td>
    	<a href="javascript:void(0);" class="delete_row hvr-pop iconstyle" data-attr="<?php echo $newcnt;?>" data-val="1"><i class="fa fa-times-circle"></i>
   		</a>
    </td>
</tr>