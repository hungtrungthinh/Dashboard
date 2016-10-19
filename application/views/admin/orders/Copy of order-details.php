<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">

<style>

.form-group{
	margin-right:0px!important;
}
</style>

	<?php if($this->session->flashdata('success_message')!=''){ ?>
 		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success_message'); ?></div>
    <?php } ?>

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
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/cancelled">CANCELLED
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
        <span><h4>#<?php foreach($orderdetails as $order){echo ($order['order_ref_id']);}?>	</h4></span>
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
           	foreach($orderdetails as $order){?>
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
          <td><label>Status</label></td>
          <td class="color_orange"><?php echo $order['order_status'];?></td>
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
          <td><?php echo ($order['address'].' '.$order['city '].' '.$order['zipcode']); ?> </td>
          
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
          <td><label>Tips</label></td>
          <td class="tip">$00.00</td>
          <td></td>
          <td ></td>
        </tr>
        <?php 	}
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
       <?php  if(count($itemdetails)!=0){
		   $i=0;
           	foreach($itemdetails as $item){
			$i++;	
				?>
        <tr>
          <th width="8%"># </th>
          <th width="44%">DISH</th>
          <th width="12%">SIZE</th>
          <th width="12%">QTY</th>
          <th width="12%">RATE</th>
          <th width="12%">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td scope="row"><div class="circle "><?php echo $i;?><?php //echo $item['ord_item_id'];?></div></td>
          <td><?php echo $item['item_name'];?></td>
          <td>Regular</td>
          <td></td>
          <td>$<?php echo $item['price'];?></td>
          <td></td>
        </tr>
        <tr>
            <?php 
		 	if(count($sidesdetails[$item['ord_item_id']])!=0){  
		 	foreach($sidesdetails[$item['ord_item_id']] as $valu){  ?>
        <td colspan="6">
        <div class="table_sides">
        <table class="table">
        <caption>OPTIONS AND SIDES</caption>
        <tbody>
         <tr>
          <td width="77%"><?php echo $valu ['options']; ?></td>
          <td></td>
         </tr>
          <?php $sides=unserialize($valu ['sides'])?>
        
         <tr>
          <td width="77%"><?php echo '.'.$sides ['sides']; ?></td>
          <td><?php echo '+ $ '.$sides ['price']; ?><?php $price=$price+$sides ['price']; ?></td>
         </tr>
        </tbody>
         
          </table>
          </div>
          </td>
        </tr>
        
        <?php  ?>
        <tr class="divider">
          <td scope="row"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
         <!-- <td class="color_orange">$40.50</td>-->
          <td></td>
        </tr>
        <?php } }}
				?>
       
         <?php 	}else { ?>
      		  <tr>
              <td colspan="6" class="tbl_row">
              No Options and Sides
              </td>
              </tr>
           <?php } ?>
          <tr class="divider">
          <td scope="row"></td>
          <td></td>
          <td></td>
          <td><?php echo $item['quantity'];?></td>
          <td>$<?php echo $item['price']+$price;?></td>
         <!-- <td class="color_orange">$40.50</td>-->
         <td>$<?php $grand= $item['quantity']*($item['price']+$price); echo $grand?></td>
        </tr>  
         <tr>
          <td colspan="6" class="total_amt">$<?php echo ($grand+$grand1);?></td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="col-md-6 col-md-offset-6 pad0">
   <?php if( $order['order_status']=="New" && $usertype!="manager" ){?>
    <span class="acbtncls">
    <button class="btn button_gray pull-right cancel" type="button" >CANCEL</button>
    <button class="btn button_orange pull-right accept" type="button">ACCEPT </button>
    </span>
    <span class="cmpbtncls" style="display:none;">
    <button class="btn button_gray pull-right cancel" type="button">CANCEL</button>
    <button class="btn button_orange pull-right completed11" type="submit">COMPLETE </button>
    </span>
    <?php }else if($order['order_status']=="Accepted" && $usertype!="manager"){ ?>
    <span class="acbtncls" style="display:none;">
    <button class="btn button_gray pull-right cancel" type="button">CANCEL</button>
    <button class="btn button_orange pull-right accept" type="button">ACCEPT </button>
    </span>
    <span class="cmpbtncls">
    <button class="btn button_gray pull-right cancel" type="button">CANCEL</button>
    <button class="btn button_orange pull-right completed11" type="submit">COMPLETE </button>
    </span>
    <?php }?>
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
$('body').on('click', '.cancel', function () {
	var order_id = $("#order_id").val();
	$('.loader_home').show();
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/cancelOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				
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
