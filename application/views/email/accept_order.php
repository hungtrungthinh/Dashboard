<body style="background:#fff; font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;">
<div style="margin:25px;">
<div style="background:#f5f5f5; padding:10px 15px; border-radius:10px; width:800px; margin:0 auto;">
<div style="background:#FFFFFF">
<br>
<br>
<div style="text-align:center"><img src="<?php echo base_url();?>assets/images/profile/<?php echo $restaurant_id.'.png'; ?>" height="114px;"></div>
<div style="text-align:center; color:#d12c37; font-size:26px;"><?php //echo $subject;?></div>
<br>
</div>
<br>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="55%" style="color:#49536e; font-size:24px;">Order Number : <span style=" color:#d12c37;"><?php echo $orderdetails[0]['order_ref_id'];?></span></td>
      <td style="color:#49536e; font-size:24px;">
      Tips : <?php if($orderdetails[0]['tip']!=''){ echo '$'.$orderdetails[0]['tip']; }else{ echo '-'; }?>
      </td>
    </tr>
    <tr>
      <?php if($orderdetails[0]['order_type']=='Delivery'){ ?>
      	<td style="color:#49536e; font-size:22px;">Delivery Address : </td>
      <?php }else{ ?>
      	<td style="color:#49536e; font-size:22px;">Order Type: </td>
      <?php } ?>
      <td style="color:#49536e; font-size:22px;"><?php if($orderdetails[0]['notes']!=''){?>Delivery Notes : <?php } ?></td>
    </tr>
    <tr>
		<?php if($orderdetails[0]['order_type']=='Delivery'){ ?>
      	<td style="color:#49536e; font-size:18px; vertical-align:text-top;"><?php echo $orderdetails[0]['first_name'].' '.$orderdetails[0]['last_name'];?><br>
        <?php echo $orderdetails[0]['address'];?><br>
        <?php echo $orderdetails[0]['city'];?>,
        <?php echo $orderdetails[0]['state'];?>
        <?php echo $orderdetails[0]['zipcode'];?></td>
      	<?php }else{ ?>
      	<td style="color:#49536e; font-size:22px;"><?php echo $orderdetails[0]['order_type'];?></td>
       <?php } ?>    
      <td style="color:#49536e; font-size:18px;">
        <p style="margin:0;"><?php echo $orderdetails[0]['notes'];?></p>
      </td>
    </tr>
    
    <tr>
      <?php if($orderdetails[0]['order_type']=='Delivery'){ ?>
      	<td style="color:#49536e; font-size:22px;">Phone No : <?php echo $orderdetails[0]['phone'];?></td>
      <?php }else{ ?>
      	<td style="color:#49536e; font-size:22px;"></td>
      <?php } ?>
    </tr>
    
    
  </tbody>
</table>
<br>
<br>
<br>
<table width="100%" border="0" cellspacing="0">
  <tbody>
    <tr>
      <th width="45%" scope="col" style="text-align:left; color:#49536e; font-size:18px; background-color:#f6fafb; border-bottom:1px solid #e8e8e8; padding:15px;">DISH</th>
      <th width="14%" scope="col" style="text-align:left; color:#49536e; font-size:18px; background-color:#f6fafb; border-bottom:1px solid #e8e8e8; padding:15px;">SIZE</th>
      <th width="12%" scope="col" style="text-align:left; color:#49536e; font-size:18px; background-color:#f6fafb; border-bottom:1px solid #e8e8e8; padding:15px;">QTY</th>
      <th width="14%" scope="col" style="text-align:left; color:#49536e; font-size:18px; background-color:#f6fafb; border-bottom:1px solid #e8e8e8; padding:15px;">PRICE</th>
      <th width="15%" scope="col" style="text-align:left; color:#49536e; font-size:18px; background-color:#f6fafb; border-bottom:1px solid #e8e8e8; padding:15px;">TOTAL</th>
    </tr>
    
    <?php if(count($itemdetails)!=0){ 
	foreach($itemdetails as $items){
	$itemprice=0;
	?>
    <tr>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      <?php echo $items['item_name'];?>
      </td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
	  <?php echo $items['size'];?>
      </td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
	  <?php echo $items['quantity'];?>
      </td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      $<?php echo $items['unit_price'];?>
      <?php $itemprice=$itemprice+$items['unit_price'];?>
      </td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">&nbsp;</td>
    </tr>
    <?php if(count($sidesdetails[$items['ord_item_id']])!=0){
	foreach($sidesdetails[$items['ord_item_id']] as $sides){
	
	$sidesList=unserialize($sides['sides']);
	//print_r($sidesList);
	?>
    <tr>
      <td colspan="5" style="color:#49536e; font-size:16px; background-color:#fff; font-weight:600;">
      <table width="100%" border="0">
      <tbody>
      <tr>
      <th colspan="2" scope="col" style="background:#f5f5f5; color:#49536e; font-size:18px; text-align:left; padding:15px;"><?php echo $sides['options'];?></th>
      </tr>
      
      <?php if(count($sidesList['sides'])!=0){
	  for($i=0;$i<count($sidesList['sides']);$i++){
	  ?>
	 
      <tr>
      <td width="72%" style="background:#f5f5f5; color:#49536e; font-size:16px; text-align:left; padding:15px;"><?php echo $sidesList['sides'][$i];?></td>
      <td width="28%" style="background:#f5f5f5; color:#49536e; font-size:16px; text-align:left; padding:15px;">+$<?php echo $sidesList['price'][$i];?></td>
      
      <?php $itemprice=$itemprice+$sidesList['price'][$i];?>
      </tr>
      <?php } ?>
      <?php } ?>
      
      </tbody>
      </table>
      </td>
    </tr>
    <?php }?>
    <?php }?>
    
    <tr>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">&nbsp;</td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">&nbsp;</td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">&nbsp;</td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      <?php 
	  $subtot=$itemprice*$items['quantity'];
	  echo '$'.$itemprice;
	  ?>
      
      </td>
      <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      <?php 
	  echo '$'.$subtot;
	  ?>
      </td>
    </tr>
    <tr>
    <td style="color:#49536e; font-size:16px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;" colspan="5">
    Note :   <?php echo $items['instructions'];?></td>
    </tr>
    
    
    <?php } ?>
    <?php } ?>
    
    
    
    
    
    
    
    <?php if($orderdetails[0]['delivery']!=''){ ?>
    <tr>
      <td colspan="4" style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">Delivery</td>
      <td style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      $<?php //echo $orderdetails[0]['total_amount'];?>
      </td>
    </tr>
    <?php } ?>
    
    <tr>
      <td colspan="4" style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">SUB TOTAL</td>
      <td style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      $<?php echo $orderdetails[0]['sub_total'];?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">Discount</td>
      <td style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      $<?php echo $orderdetails[0]['discount_amount'];?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">Tip</td>
      <td style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      <?php if($orderdetails[0]['tip'] !='' || $orderdetails[0]['tip']!=0){ ?>$<?php echo $orderdetails[0]['tip'];?>
	  <?php }else{ echo '-'; }?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">Tax</td>
      <td style="color:#49536e; font-size:18px; background-color:#fff; border-bottom:1px solid #efefef; padding:15px; font-weight:600;">
      $<?php echo $orderdetails[0]['tax_amount'];?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="color:#49536e; font-size:20px; background-color:#fff; padding:15px; font-weight:600;">TOTAL</td>
      <td style="color:#d12c37; font-size:24px; background-color:#fff; padding:15px; font-weight:600;">
      $<?php echo $orderdetails[0]['total_amount'];?>
      </td>
    </tr>
  </tbody>
</table>
<br>
<br>



</div>
</div>
</body>