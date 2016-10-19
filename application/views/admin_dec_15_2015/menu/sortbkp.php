


 <?php 
if(count($options_details)!=0){ 
foreach($options_details as $val){ ?>
<table style="width:100%" class="tableOpt diagnosis_list111">            
<tr class="rowoption" data-attr="<?php echo $val['option_id']; ?>">
<td width="100px;" align="top" class="sorteropt"><img src="<?php echo base_url()?>assets/admin_lte/img/grippy_large.png" style="margin-top:-59px;"></td>
<td>
<li id="optionlist_<?php echo $val['option_id']; ?>" data-attr="" >
  				<div class="sides_wp">
                    <h5 class="item_lid col-lg-12 col-md-12">
                    
					  
					  <span class="col-lg-4 col-sm-4 saveopttitle edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>">
					  <input type="text"  id="opt_title_<?php echo $val['option_id'] ; ?>" name="opt_title_<?php echo $val['option_id'];?>" class="form-control" value="<?php echo $val['option_name'] ; ?>">
                      </span>
                      
                      <span class="col-lg-2 col-sm-2">
                      
                      <input type="checkbox" <?php if($val['mandatory']=='Y'){?>checked="true"<?php }?> name="mandatory_<?php echo $val['option_id'] ; ?>" id="mandatory_<?php echo $val['option_id'] ; ?>" class="mandatory_<?php echo $val['option_id'] ; ?> man_opt"  data-attr="<?php echo $val['option_id'] ; ?>">
                      <span></span> This is Mandatory
                      </span>
                      
                      <span class="col-lg-2 col-sm-2"> 
                         <input type="checkbox" <?php if($val['multiple']=='Y'){?>checked="true"<?php }?> name="multiple_<?php echo $val['option_id'] ; ?>" id="multiple_<?php echo $val['option_id'] ; ?>" class="multiple_<?php echo $val['option_id'] ; ?> mul_opt" data-attr="<?php echo $val['option_id'] ; ?>">
                      <span></span>Allow multiple options 
                      
                      </span>
                      <span class="col-lg-2 col-sm-2"> 
                      
                      <span class="mul_limit mul_limit_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo $val['option_id'] ; ?>" style="color:#34495e; font-size:14px;<?php if($val['multiple']=='N') { ?> display:none; <?php } ?>"><label style="margin:6px;font-weight: inherit;"> MAX : </label><input type="text"  id="mul_lim_<?php echo $val['option_id'] ; ?>" name="mul_lim_<?php echo $val['option_id'];?>" class="inputnew" value="<?php echo $val['limit']; ?>" style="position:absolute; height:33px; width:70px;" onkeypress="return isNumber(event)" >
                      </span>
                      </label>
                      
                      </span>
                     
                      <span class="col-lg-2 col-sm-2">
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
                      </span>
                      
                     <div class="clearfix"></div> 
                    </h5>
                           

<div class="clearfix"></div>                   
<!-- ----------------------------------------------code table------------------------------------------------------------ -->
<!--<table id="diagnosis_list" class="table2 table table-striped newli_<?php echo $val['option_id']; ?>"  data-attr="<?php echo $val['option_id']; ?>" >-->
<table id="diagnosis_list" class="table2 diagnosis_list  newli_<?php echo $val['option_id']; ?>"  data-attr="<?php echo $val['option_id']; ?>" >
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
            <span class="save_options edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
            	<input type="text"  id="saveopt_<?php echo $valu['side_id'] ; ?>" name="opt_name_<?php echo $val['option_id'];?>[]" class="opt_name_<?php echo $val['option_id'] ; ?> inputside inputnew" value="<?php echo $valu['side_item']; ?>" data-rel="<?php echo $valu['side_id'] ; ?>" style="width:100%" >
            </span>
          
        </td>
    	<td class="tttt">
            <div class="pull-right">
                <label class="action pull-right"></label>
                <label class="rate">+$
                <span class="save_optionsprice edit_<?php echo $val['option_id'] ; ?>"  id="edit_<?php echo $val['option_id'] ; ?>"  data-attr="<?php echo $val['option_id'] ; ?>" data-rel="<?php echo $valu['side_id'] ; ?>"  >
                <input type="text"  id="saveoptprice_<?php echo $valu['side_id'] ; ?>" name="opt_price_<?php echo $val['option_id'];?>[]" class="inputprice opt_price_<?php echo $val['option_id'] ; ?> inputnew" value="<?php echo $valu['price']; ?>" onkeypress="return isNumber(event)" style=""  data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                </span>
                                    
                <input type="hidden"  id="saveopt_<?php //echo $val['option_id'];?>" name="opt_sideid_<?php echo $val['option_id'];?>[]" class="opt_sideid_<?php echo $val['option_id'] ; ?>" value="<?php echo $valu['side_id']; ?>">
                                    
                </label>
            
                <?php 
                $i++;
                if($i==count($sidesdetails[$val['option_id']])){
                ?>
                <label class="action pull-right" >
                <a href="javascript:void(0);" class="pull-right addmoresides hvr-pop plus-style sort_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>">
                <i class="fa fa-plus-circle"></i>
                </a>
                </label>
                <?php 
                }else{ ?>
                <label class="action pull-right" >
                    <a href="javascript:void(0);" class="pull-right addmoresides hvr-pop iconstyle sort_<?php echo $val['option_id'] ; ?>" data-attr="<?php echo count($sidesdetails[$val['option_id']]); ?>" data-rel="<?php echo $val['option_id'] ; ?>" style="display:none">
                    <i class="fa fa-plus-circle"></i>
                    </a>
                </label>	
                <?php }	?> 
                <label class="action pull-right">
                    <a href="javascript:void(0);" data-attr="<?php echo $valu['side_id']; ?>" class="delsides hvr-pop iconstyle"  data-val="<?php echo $val['option_id'] ; ?>">
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
                   
<!-- ----------------------------------------------code table------------------------------------------------------------ -->
                   
                     
                    </div>
				
				 </li>
</td>
</tr>
<table>
<?php 
			}
			
		}
?>

