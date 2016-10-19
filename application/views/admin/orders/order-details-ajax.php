
	<script>
    if(typeof(EventSource) !== "undefined") {
        var orderid= <?php echo $orderid; ?>;
        var source2 = new EventSource("<?php echo base_url().$this->user->root."/orders/loadAutoTimeUpdateDetail/"?>"+orderid);
        source2.onmessage = function(event) {
            var data=event.data;
            //alert(data); 
    
            $('#deltime').html(data);
            //alert(data);
            //document.getElementById("countnew").innerHTML = count;
        };
    } else {
        document.getElementById("tablebody").innerHTML = "Sorry, your browser does not support server-sent events...";
    }
    </script>


	
	<?php if($this->session->flashdata('error_message')!=''){ ?>
 		<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-danger" role="alert" style="display:none;"></div>
    <?php } ?>
    <?php if($this->session->flashdata('success_message')!=''){ ?>
 		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-success" role="alert" style="display:none;"></div>
    <?php } ?>
    
    <input type="hidden" name="orderid" id="orderid" value="<?php echo $orderid;?>" >
    
<div class="row">                                    
                                    <!-- All View -->
                                    <div class="order-detail-tablet-view">
                                    	<!-- Order Detail Text Tablet -->
                                    	<div class="order-detail-text">
                                        	<!-- Order Title -->
                                        	<div class="order-detail-text-title">
                                                <h3>Order Details</h3>
                                            </div>
                                            <!-- End Order Title -->
          	<?php if(count($orderdetails)!=0){
           	foreach($orderdetails as $order){  ?>
                     
                                            <!-- Customer Details Tblet -->
                                           
                                                
                                            
                                            
                                            
                                            <div class="customer-detail tablet-res">
                                              <?php if($usertype=="manager") { ?>
                                                
                                                <dl>          
                                                    <dt>Customer</dt>
                                                    <dd><?php echo $order['first_name'].' '.$order['last_name'];?></dd>
                                                    <div class="clear"></div>
                                                    <div class="line-bottom"></div>
                                                    
                                                    <dt><?php echo $order['order_type'];?></dt>
                                                    <dd><span id="deltime"></span></dd>
                                                 	<div class="clear"></div>
                                                    <div class="line-bottom"></div>
                                                 
                                                    
                                                    
                                                    <?php if($order['order_type']=='Delivery') { ?>	
                                                    <dt>Delivery Address</dt>
                                                    <dd>
                                                        <?php echo $order['address'];?><br>
                                                        <?php if($order['apartment']!='') { echo $order['apartment'];?><br> <?php }?>
                                                        <?php echo $order['city'];?>, <?php echo $order['zipcode'];?>
                                                        
                                                    </dd>
                                                    <div class="clear"></div>
                                                    <div class="line-bottom"></div>
                                                    
                                                    <?php if($order['notes']!=''){ ?>
                                                    <dt>Delivery Notes</dt>
                                                    <dd><?php echo $order['notes']; ?></dd>
                                                    <div class="clear"></div>
                                                    <div class="line-bottom"></div>
                                                    <?php }
													
													} ?>
                                                </dl>
												
                                                <!-- Hide Area For Collapse -->
                                                <div class="collapse" id="collapseExample">
                                                    <dl>
                                                        <!--<dt>Stripe ID</dt>
                                                        <dd><?php //echo $payment_details['fund']['strip_order_id'];?></dd>
                                                        <div class="clear"></div>
                                                        <div class="line-bottom"></div>-->
                                                        
                                                       <!-- <?php //if($payment_details['refund']) {?>
                                                        <dt>Stripe Refund ID</dt>
                                                        <dd><?php //echo $payment_details['refund']['strip_order_id'];?></dd>
                                                        <div class="clear"></div>
                                                        <div class="line-bottom"></div>
                                                        <?php //}?>-->
                                                        
                                                        
                                                        <dt>Tips</dt>
                                                        <dd><span>  $<?php 
													  if($order['tip']!=''){
														 echo number_format($order['tip'],2);
													  }else{
														  echo '0.00';
													  }?></span></dd>
                                                    	<div class="clear"></div>
                                                        <div class="line-bottom"></div>
                                                        <dt>Email</dt>
                                                        <dd><?php echo $order['email'];?></dd>                                                      
                                                        <div class="clear"></div>
                                                        <div class="line-bottom"></div>
                                                        
                                                        <?php if($order['member_phone']) {?>
                                                        <dt>Phone</dt>
                                                        <dd><?php echo $order['member_phone'];?></dd>                                                      
                                                        <div class="clear"></div>
                                                        <?php } ?>
                                                        
                                                    </dl>
                                                </div>
                                                
                                                <?php }else{ ?>
                                                
                                               <dl>          
                                                    <dt>Customer</dt>
                                                    <dd><?php echo $order['first_name'].' '.$order['last_name'];?></dd>
                                                    <div class="clear"></div>
                                                    
                                                    <dt><?php echo $order['order_type'];?></dt>
                                                    <dd>&nbsp;<span id="deltime">&nbsp;</span></dd>
                                                 	<div class="clear"></div>
                                                    
                                                 
                                                    
                                                    
                                                    <?php if($order['order_type']=='Delivery') { ?>	
                                                    <dt>Delivery Address</dt>
                                                    <dd>
                                                        <?php echo $order['address'];?><br>
                                                        <?php if($order['apartment']!='') { echo $order['apartment'];?><br> <?php }?>
                                                        <?php echo $order['city'];?>,<?php echo $order['state'];?>,<?php echo $order['zipcode'];?><br>
                                                        
                                                    </dd>
                                                    
                                                    <?php if($order['notes']!=''){ ?>
                                                    <dt>Delivery Notes</dt>
                                                    <dd><?php echo $order['notes']; ?></dd>
                                                    <?php }
													
													} ?>
                                                	
                                                </dl>
												
                                                <!-- Hide Area For Collapse -->
                                                <div class="collapse" id="collapseExample">
                                                    <dl>
                                                    	<!--<?php //if($payment_details['fund']['strip_order_id']!=''){ ?>
                                                            <dt>Stripe ID</dt>
                                                            <dd><?php //echo $payment_details['fund']['strip_order_id'];?></dd>
                                                            <div class="clear"></div>
                                                        <?php //} ?>
                                                        <?php //if($payment_details['refund']) {?>
                                                            <dt>Stripe Refund ID</dt>
                                                            <dd><?php //echo $payment_details['refund']['strip_order_id'];?></dd>
                                                            <div class="clear"></div>

                                                        <?php //}?>-->
                                                        <div class="clear"></div>
                                                        
                                                        <dt>Tips</dt>
                                                        <dd><span>  $<?php 
														  if($order['tip']!=''){
															 echo number_format($order['tip'],2);
														  }else{
															  echo '0.00';
														  }?></span></dd>
                                                    	<div class="clear"></div>
                                                        
                                                        <dt>Email</dt>
                                                        <dd><?php echo $order['email'];?></dd>                                                      
                                                        <div class="clear"></div>
                                                        
                                                        <?php if($order['member_phone']) {?>
                                                        <dt>Phone</dt>
                                                        <dd><?php echo $order['member_phone'];?></dd>                                                      
                                                        <div class="clear"></div>
                                                        <?php } ?>
                                                    </dl>
                                                </div>
                                                
                                                <?php } ?>
                                                <!-- End Hide Area For Collapse -->
                                                
                                                <!-- Collapse Toggle Btn -->
                                                <button class="in-active" data-toggle="collapse" data-target="#collapseExample" 
                                                aria-expanded="true" aria-controls="collapseExample"></button>
                                                <!-- End Collapse Toggle Btn -->
                                            </div>
                                            <?php } }else
											{?>
											   <div class="customer-detail tablet-res">
                                                <dl>          
                                                    <dt>No Options and Sides</dt>
                                                </dl>
                                                </div>
											<?php }?>
                                            <!-- End Customer Details Tablet -->
                                    	</div>
                                        <!-- End Order Detail Text Tablet -->
                                                
                                        <!-- Order Detail Table Tablet -->
                                    	 <div class="order-detail-table">
                                         <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Dish</th>
                                                        <th style="text-align:left;">Size</th>
                                                        <th style="text-align:center;">Qty</th>
                                                        <th style="text-align:right;">Price</th>
                                                        <th style="text-align:right;">Total</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                               		<?php  if(count($itemdetails)!=0){
													   $i=0;
													   $grand=0;
														foreach($itemdetails as $item){
														$i++;
														$newprice=0;
													?>
                                                   
                                                       <?php  
													   $newprice=0;
													   $item_total = 0;
													   if(count($sidesdetails[$item['ord_item_id']])!=0){ 
													   foreach($sidesdetails[$item['ord_item_id']] as $valu){  
													   
														   $sidesdata=unserialize($valu['sides']);
														   $sides=$sidesdata['sides'];
														   $price=$sidesdata['price'];
														   for($i=0;$i<count($sides);$i++){ 
														   $newprice=$newprice+$price[$i]; 
														   }
														   }
														   }
														 $item_total = ($newprice + $item['unit_price']) * $item['quantity'];
														 $newprice=0;
													     ?>
                                                       
                                                    
                                                    
                                                    <tr>
                                                        <td><?php echo $item['item_name'];?></td>
                                                        <td align="left" valign="middle"><?php echo $item['size'];?></td>
                                                        <td align="center" valign="middle"><?php echo $item['quantity'];?></td>
                                                        <td align="right" valign="middle">$<?php echo number_format($item['unit_price'],2);?></td>
                                                        <td align="right" valign="middle">$<?php echo number_format($item_total,2);?></td>
                                                    </tr>
                                                    <tr></tr>
                                                    
                                                   
                                                    <?php 
                                                    if(count($sidesdetails[$item['ord_item_id']])!=0){   ?>
                                                    <tr></tr>
                                                    <?php foreach($sidesdetails[$item['ord_item_id']] as $valu){  ?> 
                                                    <tr>
                                                        <td style="padding:0; border:none;" colspan="5">
                                                            <div class="table_sides">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                        	<td style="padding:0 0 0 10px; border:none;" class="sub-category"><?php echo $valu ['options']; ?>:</td>
                                                                            <td style="padding:0; border:none;"></td>
                                                                            
                                                                        </tr>
                                                                          <?php $sidesdata=unserialize($valu['sides']);
																			  $sides=$sidesdata['sides'];
																			  $price=$sidesdata['price'];
																		  
                                                                           for($i=0;$i<count($sides);$i++){ ?>
                                                                          <tr>
                                                                         	 <td style="padding:0 0 0 4%; border:none;" class="sub-category">
                                                                                <i class="fa fa-angle-double-right"></i> <?php echo $sides[$i]; ?>
                                                                            </td>
                                                                            <td style="padding:0; border:none; text-align:center; margin-left:10px;" class="sub-category-price"><?php echo '+ $'.number_format($price[$i],2); ?></td>
                                                                            
                                                                        </tr>
                                                                         <?php 
																			 }
																			 ?>
                                                                       
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } 
													}
													
                                                    if($item['instructions']!='')
													{ ?>
													
													<tr>
                                                        <td colspan="5" style="padding:0; border:none;">
                                                            <div class="table_sides">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="sub-category spl-notes" style="padding:0 0 0 10px; border:none;"> 
                                                                            Special Notes : <?php echo $item['instructions']?></td>
                                                                            <td style="padding:0; border:none; margin-left:10px;"></td>
                                                                        </tr>
                                                                       </tbody>
                                                                       </table>
                                                              </div>
                                                          </td>
                                                     </tr>
												   <?php } ?>  
												   
                                                    <?php 
													} 
													}
													
													?>
                                                </tbody>
                                            </table>
                                         
                                         
                                            
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-7 col-xs-9 col-lg-offset-7 col-md-offset-7 col-sm-offset-5 col-xs-offset-3 display-ful-480">
                                                    <div class="total-area-box">
                                                        <dl>          
                                                            <dt>Subtotal</dt>
                                                            <dd>$<?php echo number_format($orderdetails[0]['sub_total'],2);?></dd>
                                                            
                                                            <dt>Discount</dt>
                                                            <dd>- $<?php echo number_format($orderdetails[0]['discount_amount'],2);?></dd>
                                                            
                                                            <dt>Sales Tax</dt>
                                                            <dd>+ $<?php echo number_format($orderdetails[0]['tax_amount'],2);?></dd>
                                                            
                                                            <dt>Tip</dt>
                                                            <dd>+ $<?php echo number_format($orderdetails[0]['tip'],2);?></dd>
                                                            
                                                            <dt><span>Total</span></dt>
                                                            <dd class="total-val"><span>$<?php echo number_format($orderdetails[0]['total_amount'],2);?></span></dd>
                                                            
                                                            <dt <?php if($orderdetails[0]['refund_amount']=="") echo 'style="display:none"';?>><span>Refund</span></dt>
                                                            <dd <?php if($orderdetails[0]['refund_amount']=="") echo 'style="display:none"';?> class="total-val">
                                                            <span>- $<?php echo number_format($orderdetails[0]['refund_amount'],2);?></span></dd>
                                                            <?php if($orderdetails[0]['refund_amount']==""){?>
                                                            
                                                            <dt style="display:none"><span>Refund</span></dt>
                                                            <dd id="refund_input" style="display:none"> 
                                                            <div class="input-group  col-lg-12 col-md-12 col-sm-12" data-toggle="tooltip" data-placement="bottom" 
                                                            title="Enter refund amount" >
                                                          <div class="input-group-addon">$</div>
                                                          <input type="number"  name="refund_amount" id="refund_amount" 
                                                          value="<?php echo number_format($orderdetails[0]['total_amount'],2);?>" class="form-control" 
                                                          placeholder="Refund Amount"/>
                                                        	</div>
                                                        <input type="hidden" value="<?php echo number_format($orderdetails[0]['total_amount'],2);?>" id="total_amount" />
                                                        </dd>
                                                            
                                                            
                                                            <?php } ?>
                                                            
                                                            <div class="clear"></div>
                                                        </dl>
                                                        
                                                        
                                            
                                                        <?php if( $order['order_status']=="New" && $usertype!="manager" ){?>
                                                        <div class="accept-links accept-links-new acbtncls">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="decline cancel">DECLINE</a>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="accept accept-btn">ACCEPT</a>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="accept-links accept-links-new cmpbtncls" style="display:none">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <!--<a href="javascript:void(0)" class="decline cancel">DECLINE</a>-->
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="completed accept-btn">COMPLETE</a>
                                                            </div>
                                                        </div>
                                                       <?php } else if( $order['order_status']=="Accepted" && $usertype!="manager" ){?>
                                                       
                                                        <div class="accept-links accept-links-new acbtncls" style="display:none;">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="decline cancel">DECLINE</a>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="accept accept-btn">ACCEPT</a>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="accept-links accept-links-new cmpbtncls">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <!--<a href="javascript:void(0)" class="decline cancel">DECLINE</a>-->
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="accept-btn completed">COMPLETE</a>
                                                            </div>
                                                        </div>
                                                        
                                                       <?php }else if($order['order_status']=="Completed" && $usertype!="manager" && $orderdetails[0]['refund_amount']==""){?>
                                                       
                                                        <div class="accept-links accept-links-new acbtncls" >
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="decline refund accept-btn">REFUND</a>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="accept-links accept-links-new cmpbtncls" style="display:none;">
                                                            <!--<div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="decline refund_cancel">CANCEL</a>
                                                            </div>-->
                                                            
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <a href="javascript:void(0)" class="continue accept-btn">COMPLETE</a>
                                                            </div>
                                                            
                                                             <span class="refund_progess pull-right" style="display:none;">
                                                                  Refund on progress.Please wait <img src="<?php echo base_url(); ?>assets/images/loader.gif" width="20px;"/>
                                                             </span>
                                                        </div>
                                                       <?php } ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Order Detail Table Tablet -->
                                    </div>
                                    <!-- End All View -->
                                </div>
                                

<input type="hidden" value="<?php echo $order['order_id'] ?>" id="order_id" name="order_id" />

<script>


$('body').on('click', '.refund', function () {
	$("#refund_input").show();
	$('.acbtncls').hide();
	$('.cmpbtncls').show();
	$("#refund_amount").val($("#total_amount").val());
	$("#refund_input").removeClass('has-error');
	$("#refund_input .input-group").attr('data-original-title','Enter refund amount');
	
});

$('body').on('click', '.refund_cancel', function () {

	$("#refund_input").hide();
	$('.acbtncls').show();
	$('.cmpbtncls').hide();
	
});


$(document).ready(function(){
$(".customer-detail.tablet-res dl dd").after("<div class='line-bottom'></div>")
});

</script>
