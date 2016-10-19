<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets');?>/js/zebra_dialog.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zebra_dialog.css" type="text/css">	
<script>
if(typeof(EventSource) !== "undefined") {
	var orderid= <?php echo $orderid; ?>;
   	var source = new EventSource("<?php echo base_url().$this->user->root."/orders/loadAutoTimeUpdateDetail/"?>"+orderid);
    source.onmessage = function(event) {
		var data=event.data;
		//alert(data); 

		$('#deltime').html(data);
		//alert(count);
		//document.getElementById("countnew").innerHTML = count;
    };
} else {
    document.getElementById("tablebody").innerHTML = "Sorry, your browser does not support server-sent events...";
}
</script>


<style>

.form-group{
	margin-right:0px!important;
}
</style>

		
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
<form name="completeform" action="<?php echo base_url().$this->user->root;?>/orders/sublitcompleteOrder" method="post" >
 <div  class="tab_wrper">
<ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">

      <li class="active tog_tab" role="presentation" style="'">
      <a aria-expanded="true" role="tab" id="" href="javascript:void(0)">
      ORDER DETAILS
      <span class="" style="line-height: 2!important;"></span>
      </a>
      </li>
      
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/lists">NEW
      <span class="badge badgenew"><?php echo $allcounts['newcount']; ?></span>
      </a>		
      
      </li>
      <li role="presentation" class=" tog_tab">
      <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url().$this->user->root;?>/orders/accepted">ACCEPTED
      <span class="badge accbadge"><?php echo $allcounts['accepted']; ?></span>
      </a>
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/cancelled">DECLINED
      <span class="badge"><?php //echo $allcounts['cancelled']; ?></span>
      </a>		
      </li>
	  <li class="tog_tab" role="presentation">
      <a aria-expanded="true"  role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/late">LATE
      <span class="badge"><?php echo $allcounts['late']; ?></span>
      </a>		
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true"  role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/all">ALL
      <span class="badge"><?php //echo $allcounts['allcount']; ?></span>
      </a>		
      </li>
      
    </ul>


 <div id="myTabContent" class="tab-content tab_contwp dish_cat_tab">
    <div role="tabpanel" class="" id="category" aria-labelledby="category-tab">
    <div class="form_menu_detail" style="margin:0px;">
        <div class="table-responsive"> 
        <span><h4>#<?php 
		
		//echo '<pre>';print_r($orderdetails);
		
		foreach($orderdetails as $order){echo ($order['order_ref_id']);}?>	</h4></span>
        <?php /*?><span class="pull-right"><a href="<?php echo base_url()?>admin/orders/accepted" class="btn btn-info" >CANCEL</a></span><?php */?>
          
         <!--<table class="table table-striped tbl_category" style="border:1px solid #f2f2f2;">
          <thead class="head_table">
            <tr>
              <th class="col-md-2 col-sm-2">ORDER ID</th>
              <th class="col-md-2 col-sm-2">ITEM NAME</th>
              <th class="col-md-2 col-sm-2">QUANTITY</th>
              <th class="col-md-2 col-sm-2">UNIT PRICE</th>
              <th class="col-md-2 col-sm-2">PRICE</th>
            </tr>
          </thead>
          <tbody class="table_body">
    	<?php foreach($details as $items){ ?>
               <tr>
                <td><?php echo $items['order_ref_id'];?></td>
                <td><?php echo $items['item_name'];?></td>
                <td><?php echo $items['quantity'];?></td>
                <td><?php echo $items['unit_price'];?></td>
                <td><?php echo $items['price'];?></td>
              </tr>
          
        <?php } ?>
        <tr>
          <td class="text-right" colspan="4"><span><b>Total:&nbsp;($)&nbsp;&nbsp;</b><span><span></span></span></span></td><td>
          <?php echo $details[0]['total_amount'];?>
          </td></tr>
       </tbody>
      </table>-->
      <div>
      <table class="table table-condensed odre_detail_table">
      <tbody>
      <?php  if(count($orderdetails)!=0){
           	foreach($orderdetails as $order){
				//print_r($order);
			?>
         <?php if($usertype=="manager") {?>
          <tr>
          <td scope="row"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_down.png"></td>
          <td><label>Customer</label></td>
          <td class="color_orange"><?php echo $order['first_name'].' '.$order['last_name'];?></td>
          <td><label>Create At</label></td>
          <td><?php echo date("H:i a m / d / Y  ", strtotime ($order['created_time']));?></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Locations</label></td>
          <td><?php echo $order['restaurant_name'];?></td>
          <td><label>Expected By</label></td>
          <td><?php echo date("H:i a m / d / Y  ", strtotime ($order['delivery_time']));?></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Email</label></td>
          <td class="color_orange"><?php echo $order['email'];?></td>
          <td><label>Type</label></td>
          <td><?php echo $order['type'];?></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Src<?php //print_r($order) ?></label></td>
          <?php if($order['auth_type']=='facebook') { ?>	
          <td><img src="<?php echo base_url()?>assets/admin_lte/img/fb_icon.png"></td>
          <?php }?>	
          <?php  if($order['auth_type']=='general') { ?>
          <td><img src="<?php echo base_url()?>assets/images/icon-frkouse.png"></td>
          <?php } ?>	
          <?php  if($order['auth_type']=='both') { ?>	
           <td><img src="<?php echo base_url()?>assets/admin_lte/img/fb_icon.png"></td>
           <?php } ?>
           <?php  if($order['order_type']=='Delivery') { ?>	
          <td><label>Delivery Address</label></td>
          <td><?php echo $order['address'].' '.$order['city'].' '.$order['zipcode']; ?> </td>
          
          <?php }else {?>
          <td></td>
          <td></td>
          <?php } ?>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Promo Code</label></td>
          <td class="promcde"><?php /*?><span></span><?php */?></td>
           <td><label>Discount</label></td>
          <td class="discnt">$00.00</td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Tips</label> :
          <span class="tip">
          $<?php 
		  if($order['tip']!=''){
		 	 echo number_format($order['tip'],2);
		  }else{
			  echo '0.00';
		  }?></span></td>
          <td class=""></td>
          <td></td>
          <td ></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Stripe Order Id</label> : 
          <span class="color_orange"><?php echo $payment_details['fund']['strip_order_id'];?></span></td>
          <td></td>
          <td> <?php if($payment_details['refund']) {?><label>Stripe Refund Id</label> : 
          <span class="color_orange"><?php echo $payment_details['refund']['strip_order_id'];?></span> <?php } ?></td>
          <td></td>
          
        </tr> 
   
         <?php }else{?>
        <tr>
          <td scope="row"><?php /*?><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_down.png"><?php */?></td>
          <td class="color_orange"><?php echo $order['first_name'].' '.$order['last_name'];?></td>
          <td></td>
          <td><label> <?php echo $order['order_type'];?></label> : 
          <span id="deltime"></span></td>
          <td></td>
        </tr>
        
        <tr>
          <td scope="row"></td>
          <td><label>Email</label> : 
          <span class="color_orange"><?php echo $order['email'];?></span></td>
          <td></td>
          <td><label>Tips</label> :
          <span class="tip">
          $<?php 
		  if($order['tip']!=''){
		 	 echo number_format($order['tip'],2);
		  }else{
			  echo '0.00';
		  }?></span></td>
          <td></td>
          
        </tr>
        
        
        
        
        <tr>
        <?php 	
		$vall='';
		$m=1;
		foreach($itemdetails as $item){ 
			if($item['instructions']!=''){
				$vall.=$item['instructions'];
				if($m!=count($itemdetails))
					$vall.=', ';
			}
			$m++;
		}?>
          <td scope="row"></td>
          <td><label>Special Notes </label>: <span class="color_orange"><?php echo $vall; ?></span></td>
          <td class="promcde"><?php /*?><span></span><?php */?></td>
          
          
          <?php if($order['address']!=''){ ?>
           <td> <label>Delivery Address</label>:<span class="color_orange"><br />
          <?php echo $order['address'].', '.$order['city'].', '.$order['zipcode'].', '.$order['phone']; 
		  
		  
		  }?> 
           
           </span> </td>
          <td class="discnt"></td>
          <td></td>
        </tr>
        
        <tr>
          <td scope="row"></td>
          <td><label>Stripe Order Id</label> : 
          <span class="color_orange"><?php echo $payment_details['fund']['strip_order_id'];?></span></td>
          <td></td>
          <td> <?php if($payment_details['refund']) {?><label>Stripe Refund Id</label> : 
          <span class="color_orange"><?php echo $payment_details['refund']['strip_order_id'];?></span> <?php } ?></td>
          <td></td>
          
        </tr>
      
        
        <?php }	}
				}else { ?>
      		  <tr>
              <td colspan="5" class="tbl_row">
              No Options and Sides
              </td>
              </tr>
           <?php } ?>
            
      </tbody>
    </table>
      
      
      </div>

    <div class="table-responsive dis_detail_table">
    <table class="table">
      <thead>
      <tr>
          <th width="52%" style="font-size:19px;">DISH</th>
          <th width="12%" style="font-size:19px;">SIZE</th>
          <th width="12%" style="font-size:19px;">QTY</th>
          <th width="12%" style="font-size:19px;">PRICE</th>
          <th width="12%" style="font-size:19px;">TOTAL</th>
        </tr>
       <?php  if(count($itemdetails)!=0){
		   $i=0;
		   $grand=0;
		  	//echo '<pre>';print_r($itemdetails);
           	foreach($itemdetails as $item){
			$i++;
			$newprice=0;
				?>
        
      </thead>
      <tbody>
        <tr>
          <!--<div class="circle "><?php //echo $i;?><?php //echo $item['ord_item_id'];?></div>-->
          <td style="font-size:18px;"><b><?php echo $item['item_name'];?></b></td>
          <td><?php echo $item['size'];?></td>
          <td><?php echo $item['quantity'];?></td>
          <td>$<?php echo number_format($item['unit_price'],2);?> 
         
          </td>
          <td></td>
        </tr>
        
        <?php 
		 	if(count($sidesdetails[$item['ord_item_id']])!=0){   ?>
        
        
         
        <tr>
        <!--<td colspan="5">
        <div class="table_sides">
        <table class="table">
        <caption>OPTIONS AND SIDES</caption>
        </table>
        </div>
        </td>-->
        </tr>
        
        <tr>
            <?php 
		 	
		 	foreach($sidesdetails[$item['ord_item_id']] as $valu){  
			//$newprice=0;
			//print_r($valu);
			?>
        <td colspan="5">
        <div class="table_sides">
        <table class="table">
        <tbody>
         <tr>
          <td width="77%"><b><?php echo $valu ['options']; ?></b></td>
          <td></td>
         </tr>
          <?php $sidesdata=unserialize($valu['sides']);
		  $sides=$sidesdata['sides'];
		  $price=$sidesdata['price'];
		  //print_r($price);
		  for($i=0;$i<count($sides);$i++){
		  ?>
         <tr>
          <td width="77%" style="padding-left: 7%;">
          <i class="fa fa-angle-double-right"></i>&nbsp;<?php echo $sides[$i]; ?></td>
          <td><?php echo '+ $ '.number_format($price[$i],2); ?><?php $newprice=$newprice+$price[$i]; ?></td>
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
		 }?>
		<tr class="divider dividertop">
          <td scope="row"></td>
          <td></td>
          <td><?php $totquantity= $totquantity + $item['quantity'];?></td>
          <td><?php $totalitemprice = $item['unit_price']+$newprice; 
		   echo '$'.number_format($totalitemprice,2);
		  ?></td>
         <!-- <td class="color_orange">$40.50</td>-->
          <td><?php echo '$'.number_format($item['quantity']*$totalitemprice,2); $grand+=$item['quantity']*$totalitemprice; ?></td>
        </tr>

		<?php
		 }
				?>
       
         <?php 	}else { ?>
      		  <tr>
              <td colspan="5" class="tbl_row">
              No Options and Sides
              </td>
              </tr>
           <?php } ?>
          <!--<tr class="divider">
          <td scope="row"></td>
          <td></td>
          <td></td>
          <td><?php //echo $totquantity;?></td>
          <td><?php //echo number_format($item['unit_price']+$newprice,2);?></td>
         <td><?php //$grand= $item['quantity']*($item['unit_price']+$newprice); //echo number_format($grand,2)?></td>
        </tr>  -->
        
        <?php if($orderdetails[0]['order_type']=='Delivery'){?>
        <tr>
          <td colspan="4">Delivery<?php //print_r($orderdetails[0]); ?></td>
          <td class="">+$<?php echo number_format($orderdetails[0]['delivery_service_amount'],2);?></td>
        </tr>
        <?php } ?>
         <tr>
          <td colspan="4">Sub Total<?php //print_r($orderdetails[0]); ?></td>
          <td class="">&nbsp; $<?php echo number_format($orderdetails[0]['sub_total'],2);?></td>
        </tr>
        <tr>
          <td colspan="4">Discount</td>
          <td class="">- $<?php echo number_format($orderdetails[0]['discount_amount'],2);?></td>
        </tr>
        <tr>
          <td colspan="4">Sales Tax</td>
          <td class="">+ $<?php echo number_format($orderdetails[0]['tax_amount'],2);?></td>
        </tr>
         <tr>
          <td colspan="4">Tip</td>
          <td class="">+ $<?php echo number_format($orderdetails[0]['tip'],2);?></td>
        </tr>
        <tr>
          <td colspan="4" style="font-size:25px;">Total</td>
          <td class="total_amt">$<?php echo number_format($orderdetails[0]['total_amount'],2);?></td>
        </tr>
        <tr <?php if($orderdetails[0]['refund_amount']=="") echo 'style="display:none"';?>>
          <td colspan="4">Refund</td>
          <td class="">- $<?php echo number_format($orderdetails[0]['refund_amount'],2);?></td>
        </tr>
        <?php if($orderdetails[0]['refund_amount']==""){?>
        <tr id="refund_input" style="display:none">
          <td colspan="5" rowspan="2" >
          	
            <div class="input-group  col-lg-12 col-md-12 col-sm-12" data-toggle="tooltip" data-placement="bottom" title="Enter refund amount" >
              <div class="input-group-addon">$</div>
              <input type="number"  name="refund_amount" id="refund_amount" 
              value="<?php echo number_format($orderdetails[0]['total_amount'],2);?>" class="form-control" 
              placeholder="Refund Amount"/>
            </div>
            <input type="hidden" value="<?php echo number_format($orderdetails[0]['total_amount'],2);?>" id="total_amount" />
           
          </td>
          
        </tr>
        <?php } ?>
      </tbody>
    </table>
    

    
    </div>
    <div class="col-md-6 col-md-offset-6 pad0">
   <?php if( $order['order_status']=="New" && $usertype!="manager" ){?>
    <span class="acbtncls">
    <button class="btn button_gray pull-right cancel" type="button" >DECLINE</button>
    <button class="btn button_orange pull-right accept" type="button">ACCEPT </button>
    </span>
    <span class="cmpbtncls" style="display:none;">
    <button class="btn button_gray pull-right cancel" type="button">DECLINE</button>
    <button class="btn button_orange pull-right completed11" type="submit">COMPLETE </button>
    </span>
    <?php }else if($order['order_status']=="Accepted" && $usertype!="manager"){ ?>
    <span class="acbtncls" style="display:none;">
    <button class="btn button_gray pull-right cancel" type="button">DECLINE</button>
    <button class="btn button_orange pull-right accept" type="button">ACCEPT </button>
    </span>
    <span class="cmpbtncls">
    <button class="btn button_gray pull-right cancel" type="button">DECLINE</button>
    <button class="btn button_orange pull-right completed11" type="submit">COMPLETE </button>
    </span>
    <?php }else if($order['order_status']=="Completed" && $usertype!="manager" && $orderdetails[0]['refund_amount']==""){?>
    
    	<span class="acbtncls">
        <button class="btn button_orange pull-right refund" type="button">REFUND</button>
        </span>
        
        <span class="cmpbtncls" style="display:none;">
        <button class="btn button_gray pull-right refund_cancel" type="button">CANCEL</button>
        <button class="btn button_orange pull-right continue" type="button">CONTINUE </button>
        </span>
        <span class="refund_progess pull-right" style="display:none;">
        	Refund on progress.Please wait <img src="<?php echo base_url(); ?>assets/images/loader.gif" width="20px;"/>
        </span>
    <?php } ?>
    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    </div>
 	
<input type="hidden" value="<?php echo $order['order_id'] ?>" id="order_id" name="order_id" />
	</div><!-- /.row -->
	<div class="clearfix"></div>

</div><!-- /.container -->
</form>
<script>
$('body').on('click', '.completed', function () {

	var order_id = $("#order_id").val();
	//alert(order_id);
	$('.loader_home').show();
	var cnt	= parseInt($('.accbadge').html())-1;
	//return false;
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/completeOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				$('.accbadge').html(cnt);
				window.load('<?php echo base_url().$this->user->root;?>/orders/lists');
				$('#row_'+order_id).remove();
				$('.alert-success').show();
				$('.alert-success').html('Order completed successfully');
				var rowCount = $('.tbl_category tr').length;
				if(rowCount=='1'){
					$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
				}

				$('.loader_home').hide();

				
            }
        });  

});
$('body').on('click', '.cancel', function (e) {
	var order_id = $("#order_id").val();
	$('.loader_home').show();
	
			e.preventDefault();
			$.Zebra_Dialog('Are you sure you want to decline this order?', {
						'type':     'question',
						'title':    'Decline order',
						'buttons':  ['OK','Cancel'],
						'onClose':  function(caption) {
						if(caption=='OK'){
							$.ajax({
								url: '<?php echo base_url().$this->user->root;?>/orders/cancelOrder',
								type: 'POST',
								data: {'order_id':order_id}, 
								success: function (result) {
									
									if(result=='success')
									{
										
										$('#row_'+order_id).remove();
										$('.alert-success').show();
										$('.alert-success').html('Order cancelled successfully');
										window.location.href="<?php echo base_url().$this->user->root;?>/orders/lists";
										var rowCount = $('.tbl_category tr').length;
										if(rowCount=='1'){
											$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
										}
						
										$('.loader_home').hide();
									}
									else
									{
										$('.alert-danger').show();
										$('.alert-danger').html('Unknown error occured');
										$("html, body").animate({ scrollTop: 0 }, "fast");
									}
									
									}
							});  
							return true;
						}else{
							return false;
						}
					}
			});

	
        

});
$('body').on('click', '.accept', function () {
	var order_id = $("#order_id").val();
	$('.loader_home').show();
	//return false;
	var cnt	= parseInt($('.accbadge').html())+1;

        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/acceptOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				$('.acbtncls').hide();
				$('.cmpbtncls').show();
				$('.accbadge').html(cnt);
				//alert($('#hidecount').val());
				var cnt11=parseInt($('#hidecount').val())-1;
				$('#hidecount').val(cnt11);
				/*$('#row_'+order_id).remove();
					$('.alert-success').show();
					$('.alert-success').html('order accepted successfully');
					var rowCount = $('.tbl_category tr').length;
					if(rowCount=='1'){
						$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
					}
	
					$('.loader_home').hide();
				*/
				
            }
        });  

});

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

$('body').on('click', '.continue', function () {
var amount= parseFloat($("#refund_amount").val());
var total_amount= parseFloat($("#total_amount").val());
var order_id = $("#order_id").val();
if(amount >0 && amount<= total_amount){
	$("#refund_input").hide();
	$('.acbtncls').hide();
	$('.cmpbtncls').hide();
	$('.refund_progess').show();
	$("#refund_input").removeClass('has-error');
	$("#refund_input .input-group").attr('data-original-title','Enter refund amount');
	
	   $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/OrderPartialRefund',
            type: 'POST',
            data: {'order_id':order_id,'amount':amount}, 
            success: function (result) {
				$('.refund_progess').hide();
				if(result=='success')
				{
					$(".refund").removeClass('.refund');
					$('.alert-success').show();
					$('.alert-success').html('Refund successfully');
					$("html, body").animate({ scrollTop: 0 }, "fast");
					setTimeout(function(){window.location.href="<?php echo base_url().$this->user->root;?>/orders/details/"+order_id;}, 1000);
				}
				else
				{
					$('.acbtncls').show();
					$('.alert-danger').show();
					$('.alert-danger').html('Unknown error occured');
					$("html, body").animate({ scrollTop: 0 }, "fast");
				}
			}
			});
	
}
else
{
	$("#refund_input").addClass('has-error');
	$("#refund_input .input-group").attr('data-original-title','Invalid amount');
	
}
});
</script>
<style>
.nav-tabs {
    border-bottom: 11px solid #ffffff!important;
}
.nav-tabs > li {
    margin-left: -1px!important;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fff;
    border-image: none;
    border-style: solid;
    border-width: 1px;
    color: #555;
    cursor: default;
}
</style><style>
.nav-tabs {
    border-bottom: 11px solid #ffffff!important;
}
.nav-tabs > li {
    margin-left: -1px!important;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fff;
    border-image: none;
    border-style: solid;
    border-width: 1px;
    color: #555;
    cursor: default;
}

</style>
