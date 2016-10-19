
<?php 
if(count($sidesdetails)!=0){ 
	$i=0;
	foreach($sidesdetails as $valu){  ?>
                        
<tr data-attr="<?php echo $valu['side_id'] ; ?>" id="sideslist_<?php echo $valu['side_id']; ?>" class="ui-sortable-handle tr_opt_<?php echo $option_id; ?> sideslist_<?php echo $option_id;?> ">
        <td class="sorter" style="width:30px;">
        	<!--<img src="<?php echo base_url()?>assets/admin_lte/img/grippy_large.png">-->
        </td>
        <td>
            <span class="save_options edit_<?php echo $option_id ; ?>"  id="edit_<?php echo $option_id ; ?>"  data-attr="<?php echo $option_id ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
					 <input type="text"  id="saveopt_<?php echo $valu['side_id'] ; ?>" name="opt_name_<?php echo $val['option_id'];?>[]" class="opt_name_<?php echo $option_id ; ?> inputnew inputside" style="width:100%;" value="<?php echo $valu['side_item']; ?>" data-rel="<?php echo $valu['side_id'] ; ?>">
                    </span> 
        </td>
    	<td>
            <div class="pull-right">
                    <label class="action pull-right"></label>
                    <label class="rate">+$
					<span class="save_optionsprice edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $option_id ; ?>"  data-attr="<?php echo $option_id ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
					 <input type="text"  id="saveoptprice_<?php echo $valu['side_id'] ; ?>" name="opt_price_<?php echo $option_id;?>[]" class="opt_price_<?php echo $option_id ; ?> inputprice inputnew" value="<?php echo $valu['price']; ?>" onkeypress="return isNumber(event)"  data-attr="<?php echo count($sidesdetails[$option_id]); ?>" data-rel="<?php echo $option_id; ?>">
                    </span>
                    
                    <input type="hidden"  id="saveopt_<?php //echo $option_id;?>" name="opt_sideid_<?php echo $option_id;?>[]" class="opt_sideid_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_id']; ?>">
                    </label>
                    <?php 
					$i++;
                    ?>
                    <label class="action pull-right"></label>
					
                    <label class="action pull-right">
                    <a href="javascript:void(0);" data-attr="<?php echo $valu['side_id']; ?>" data-val="<?php echo $option_id ; ?>" class="hvr-pop iconstyle delsides" >
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
                    
<tr data-attr="" id="newside_<?php echo $option_id;?>" class="ui-sortable-handle tr_opt_<?php echo $option_id ; ?> sideslist_<?php echo $option_id;?> "> 
<td class="sorter" style="width:30px;">
	<!--<img src="<?php echo base_url()?>assets/admin_lte/img/grippy_large.png">-->
</td>                         
<td>
<span class="save_optionssss edit_<?php //echo $option_id ; ?>"  id="edit_<?php //echo $val['option_id'] ; ?>"  data-attr="<?php echo $option_id ; ?>" data-rel="">
   		<input type="text"  id="saveopt_new" name="opt_name_<?php //echo $val['option_id'];?>[]" class="opt_name_<?php echo $option_id ; ?> focsize_<?php echo $option_id ; ?> inputnew inputside" value="" style="width:100%;" data-rel="" data-opt="<?php echo $option_id ; ?>">
    </span>
</td>
<td>

<div class="pull-right">
    <label class="action pull-right"></label>
    <label class="action pull-right">
        <a href="javascript:void(0);" class="pull-right addmoresides hvr-pop plus-style" data-attr="<?php echo $option_id ; ?>" data-rel="<?php echo $option_id ; ?>">
        <i class="fa fa-plus-circle"></i>
        </a>
    </label>
    <label class="rate">+$<span class="save_optionsprice save_optionspricesss edit_<?php echo $option_id ; ?>"  id="edit_<?php echo $option_id ; ?>"  data-attr="<?php echo $option_id ; ?>" data-rel=""  >
    	<input type="text"  id="saveoptprice_<?php echo $option_id ; ?>" name="opt_price_<?php //echo $val['option_id'];?>[]" class="inputprice inputnew focprice_<?php echo $option_id ; ?> opt_price_<?php echo $option_id ; ?>" value="" style="" onkeypress="return isNumber(event)"  data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $option_id; ?>">
    </span>
    </label>
    

    <label class="action pull-right">
    <a href="javascript:void(0);" data-attr="" class="delsides hvr-pop iconstyle"  data-val="<?php echo $option_id; ?>">
    	<i class="fa fa-times-circle"></i>
    </a>
    </label>               
                    
</div>
</td>
</tr>                  
                
