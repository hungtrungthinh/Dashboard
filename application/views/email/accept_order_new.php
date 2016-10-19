<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Forkourse | Order Detail</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
        <style>
		
			
			
	
			
			
			
					

			@media screen and (max-width: 599px) {
				body[yahoo]	.wrapper {
					width: 100% !important;
				}
				body[yahoo]	.device-width {
					width: 100% !important;
					height: auto !important;
				}
				body[yahoo]	.mobile-font {
					font-size: 60px !important;
				}
				body[yahoo] .less-mobile-font {
					font-size: 45px !important;
				}
				body[yahoo] .mobile-top-gap {
					height: 15px !important;
				}
				body[yahoo] .visible-mobile {
					display: block !important;
				}
				
				.logo , .top-detail {
					text-align:center !important;	
				}
				
				.logo img {
					display:inline-block;
				}
			}
			@media screen and (max-width: 479px) {
				body[yahoo]	.mobile-gap {
					width: 10px !important;
				}
				body[yahoo]	.heart-repeater {
					width: 75px !important;
				}
				body[yahoo] .pink-heart {
					width: 30px !important;
				}
			}
        </style>
    </head>
    
    <body style="-webkit-text-size-adjust: none;-ms-text-size-adjust: none;font-family: 'Roboto', sans-serif; font-size: 16px; line-height:24px; color: #646464; background: #ffffff; margin: 0; width:100% !important; 	padding: 0; " yahoo="fix">
    
    	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="wrapper" style="background: #f4f4f4;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;border-spacing: 0;">
			<!-- Row 1 Start Here -->
			<tr class="row1" style="background:#1f374a;border-bottom:3px solid #db5d67;">
				<td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                        <tr>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;display: block;	border: none;outline: none;text-decoration: none;" /></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                    <tr>
                                        <td class="mobile-top-gap" height="10"><img src="images/blank.gif" width="1" height="1" alt="" border="0" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="wrapper" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                <tr>
                                                    <td class="editable logo">
                                                    <?php  if($logo!=''){?>
									<img src="<?php echo base_url().'assets/images/profile/'.$logo.'?'.time();?>"  alt="User Image" >
							  
							   <?php }else{?>
								   <img src="<?php echo base_url();?>assets/images/1.png" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;">
							 	<?php }   ?>
                                                    
                                                   
                                                </tr>
                                            </table>
                                            <table class="wrapper" border="0" cellspacing="0" cellpadding="0" align="right" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                <tr>
                                                    <td class="mobile-top-gap" height="30"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                                </tr>
                                                <tr>
                                                
                                         
                    
                                                    <td class="editable top-detail" style="color: #fff; font-size: 16px; font-weight: 400; line-height: 24px; text-align: right;"> <?php echo $orderdetails[0]['res_address'];?> <br /> <?php echo $orderdetails[0]['res_city'];?> <?php echo $orderdetails[0]['res_state'];?> <?php echo $orderdetails[0]['res_zip'];?> <a href="callto:9081111111" style="color: #FFF;text-decoration: none;outline: none;display:block;transition:all 0.5s ease;-o-transition:all 0.5s ease;-moz-transition:all 0.5s ease;-ms-transition:all 0.5s ease;-webkit-transition:all 0.5s ease;"><?php echo $orderdetails[0]['res_phone'];?></a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mobile-top-gap" height="10"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                        </tr>
                    </table>
                </td>
			</tr>
			<!-- Row 1 End Here -->
            <?php //echo '<pre>';print_r($orderdetails);?>
  
			<!-- Row 2 Start Here -->
			<tr class="row2" style="border-bottom:1px solid #db5d67;">
				<td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                        <tr>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                    <tr>
                                        <td height="36"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                        	<div class="editable order-number" style="text-align:left;margin: 0;padding: 0;	">
                                            	<p style="font-size:22px;line-height:30px;color:#1f374a;margin: 0;padding: 0;">Order Number: <span style="color:#e41d3e;"><?php echo $orderdetails[0]['order_ref_id'];?></span></p>
                                                <?php if($orderdetails[0]['order_type']=='Delivery'){ ?>
                                                <p style="font-size:22px;line-height:30px;color:#1f374a;margin: 0;padding: 0;"><?php echo $orderdetails[0]['order_type'];?> <br />
                                                Time: <?php echo date('g:i A',strtotime($orderdetails[0]['delivery_time']));?></p>
                                                <?php }else{ ?>
                                                <p style="font-size:22px;line-height:30px;color:#1f374a;margin: 0;padding: 0;"><?php echo $orderdetails[0]['order_type'];?> <br /> 
                                                Time: <?php echo date('g:i A',strtotime($orderdetails[0]['delivery_time']));?></p>
      											<?php } ?>   
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="46"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                        	<div class="editable order-address" style="text-align:left;	">
                                            	<p style="font-size:22px;line-height:30px;color:#1f374a;margin: 0;padding: 0;">
												<?php echo $orderdetails[0]['first_name'].' '.$orderdetails[0]['last_name'];?></p>
                                                
												<?php if($orderdetails[0]['order_type']=='Delivery'){ ?>
                                                    <p style="font-size:22px;line-height:30px;color:#1f374a;margin: 0;padding: 0;">
                                                    <?php echo $orderdetails[0]['address'];?><br>
                                                    <?php if($orderdetails[0]['apartment']!=''){?>
                                                    <?php echo $orderdetails[0]['apartment'];?><br>
                                                    
                                                    <?php } ?>
                                                    <?php echo $orderdetails[0]['city'];?>,
                                                    <?php echo $orderdetails[0]['state'];?>
                                                    <?php echo $orderdetails[0]['zipcode'];?><br>
                                                    <a href="callto:<?php echo $orderdetails[0]['phone'];?>" style="color: #000;text-decoration: none;outline: none;display:block;transition:all 0.5s ease;-o-transition:all 0.5s ease;-moz-transition:all 0.5s ease;-ms-transition:all 0.5s ease;-webkit-transition:all 0.5s ease;"><?php echo $orderdetails[0]['phone'];?></a>
                                                    </p>
													<?php }else{ ?>
                                                    <a href="callto:<?php echo $orderdetails[0]['member_phone'];?>" style="color: #000;text-decoration: none;outline: none;display:block;transition:all 0.5s ease;-o-transition:all 0.5s ease;-moz-transition:all 0.5s ease;-ms-transition:all 0.5s ease;-webkit-transition:all 0.5s ease;"><?php echo $orderdetails[0]['member_phone'];?></a>
                                                    
                                                    <?php } ?>
                                                   
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                    <td><br /></td></tr>
                                    
                                    <?php if($orderdetails[0]['notes']!=''){?>
                                    <tr>
                                    	<td>
                                        <p style="font-size:22px;line-height:30px;color:#1f374a;margin: 0;padding: 0;">
                                        Delivery Note : <?php echo $orderdetails[0]['notes'];?></td>
                                        </p>
                                    </tr>
                                    <?php } ?>
                                    
                                    
                                    
                                    <tr>
                                        <td height="36"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                        </tr>
                    </table>
                </td>
			</tr>
			<!-- Row 2 End Here -->
            
            
            <?php if(count($itemdetails)!=0){ 
			foreach($itemdetails as $items){
			$itemprice=0;
			?>
          
      
      		<?php $itemprice=$itemprice+$items['unit_price'];?>
      
      
            
            
			<!-- Row 3 Start Here -->
			<tr class="row3" style="border-bottom:1px solid #db5d67;">
				<td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                        <tr>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                    <tr>
                                        <td height="30"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;" /></td>
                                    </tr>
                                    <tr>
                                    	<td>
                                        
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-title" style="text-align:left;margin: 0;padding: 0;">
                                                                        <h4 style="margin:0;font-size:22px;line-height:30px;color:#e41d3e;"><?php echo $items['item_name'];?></h4>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin: 0;padding: 0;">$<?php echo $items['unit_price'];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                <tr>
                                                    <td height="10"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                                </tr>
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-title" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;">Qty :  <?php echo $items['quantity'];?></p>
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;">Size : <?php echo $items['size'];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                                </tr>
                                            </table>
                                            
                                            
                                    		<?php if(count($sidesdetails[$items['ord_item_id']])!=0){
													foreach($sidesdetails[$items['ord_item_id']] as $sides){
													
													$sidesList=unserialize($sides['sides']);
													//print_r($sidesList);
													?>
                                                    
                                                    

      
      
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-title" style="text-align:left;margin: 0;padding: 0;">
                                                                        <h4 style="margin:0;font-size:18px;line-height:30px;color:#111111;"><?php echo $sides['options'];?></h4>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                            <?php if(count($sidesList['sides'])!=0){
											  for($i=0;$i<count($sidesList['sides']);$i++){
											  ?>
	 										 <?php $itemprice=$itemprice+$sidesList['price'][$i];?>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                <tr>
                                                    <td height="10"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                                </tr>
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-title" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;">- <?php echo $sidesList['sides'][$i];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td valign="bottom" width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable dish-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin: 0;padding: 0;">+<?php echo $sidesList['price'][$i];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php } ?>
     										<?php } ?>
											<br />
                                            
                                            
                                         <?php }?>
   										 <?php }?>   
                                		 <?php 
                                          $subtot=$itemprice*$items['quantity'];
                                         ?>
      
                                			
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                    	<td>
                                        	<table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                <tbody>
                                                	<tr>
                                                       	<td>
                                                           	<div class="editable dish-title" style="text-align:left;margin: 0;padding: 0;">
                                                                 <p style="color:#acacac;margin:0;font-size:16px;line-height:24px; margin: 0;padding: 0;">Note : <?php echo $items['instructions'];?></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            	</tbody>
                                            </table>
                                   		</td>
                                   	</tr>
                                    
                                    <tr>
                                        <td height="10"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                        </tr>
                    </table>
                </td>
			</tr>
			<!-- Row 3 End Here -->
            
            
            <?php 
			
			}
			
			}?>
            
            
			<!-- Row 4 Start Here -->
			
			<!-- Row 4 End Here -->
            
			<!-- Row 5 Start Here -->
            



			<tr>
				<td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                        <tr>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;" /></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                    <tr>
                                        <td height="30"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    <tr>
                                    	<td>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total" style="text-align:left;margin: 0;padding: 0;">
                                                                        <h4 style="margin:0;font-size:22px;line-height:30px;color:#1f374a;">Sub-Total</h4>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;">$<?php echo $orderdetails[0]['sub_total'];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    
                                    <?php if($orderdetails[0]['delivery']!=''){ ?> 
                                    <tr>
                                    	<td>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin: 0;padding: 0;">Delivery Fee</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;">+$8.00</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    
                                    <tr>
                                        <td height="15"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    <tr>
                                    	<td>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin: 0;padding: 0;">Discount</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;">+$<?php echo $orderdetails[0]['discount_amount'];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="15"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    <tr>
                                    	<td>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin: 0;padding: 0;">Tip</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;"><?php if($orderdetails[0]['tip'] !='' || $orderdetails[0]['tip']!=0){ ?>$<?php echo $orderdetails[0]['tip'];?>
																		<?php }else{ echo '-'; }?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="15"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    <tr>
                                    	<td>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td width="90%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin: 0;padding: 0;">Sales Tax</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td width="10%">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable total-ammount" style="text-align:left;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:16px;line-height:24px;color:#646464;margin: 0;padding: 0;">+$<?php echo $orderdetails[0]['tax_amount'];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                        </tr>
                    </table>
                </td>
			</tr>
			<!-- Row 5 End Here -->
            
			<!-- Row 6 Start Here -->
			<tr class="row6" style="background:#e41d3e;">
				<td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                        <tr>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                    <tr>
                                        <td height="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;"/></td>
                                    </tr>
                                    <tr>
                                    	<td>
                                			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                            	<tr>
                                                	<td>
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable bottom-total-text" style="text-align:left;margin: 0;padding: 0;	">
                                                                        <h4 style="margin:0;font-size:30px;line-height:38px;color:#fff;">Total</h4>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                	<td>
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-spacing: 0;">
                                                        	<tr>
                                                            	<td>
                                                                	<div class="editable bottom-total-ammount" style="text-align:right;margin: 0;padding: 0;">
                                                                        <p style="margin:0;font-size:30px;line-height:38px;color:#fff;margin: 0;padding: 0;">+$<?php echo $orderdetails[0]['total_amount'];?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;" /></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="20"><img src="images/blank.gif" width="1" height="1" alt="" border="0" style="margin: 0;padding: 0;display: block;	border: none;outline: none;text-decoration: none;" /></td>
                        </tr>
                    </table>
                </td>
			</tr>
			<!-- Row 6 End Here -->
        </table>
    
    </body>
</html>



    
