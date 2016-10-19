<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">
	
	
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
    
<div  class="tab_wrper">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class=" tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/lists">NEW
      <span class="badge badgenew"><?php echo $allcounts['newcount']; ?></span>
      </a>		
      
      </li>
      <li role="presentation" class="tog_tab">
      <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url().$this->user->root;?>/orders/accepted">ACCEPTED
      <span class="badge"><?php echo $allcounts['accepted']; ?></span>
      </a>
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/cancelled">DECLINED
      <span class="badge"><?php //echo $allcounts['cancelled']; ?></span>
      </a>		
      </li>
	  <li class="active tog_tab" role="presentation">
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
    
<form class="form-horizontal" role="form" action="<?php echo base_url().$this->user->root;?>/orders/late" method="post" name="formcategory" onsubmit="" id="formcategory">	

<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">
    <div aria-labelledby="category-tab" id="category" class="" role="tabpanel">
		<div class="table-responsive">

    
        <table class="table table-striped tbl_category">
          <thead class="head_table">
            <tr>
            <?php if($this->user->role!='3'){?>
              <th width="10%">Location</th>
            <?php } ?>  
              <th width="10%">Customer</th>
              <?php if($this->user->role=='3'){?>
              <!--<th width="10%">Status</th>-->
              <th width="10%">Created</th>
              <th width="10%">Expected</th>
              <th width="10%">ID</th>
              <th width="10%">Type</th>
              <th width="10%">Total</th>
              <!--<th width="20%" colspan="2">Action</th>-->
              <th width="10%">Src</th>
              <?php /*?><th width="10%" colspan="3">Action</th><?php */?>
              <?php }else{ ?>
              <!--<th width="10%">Status</th>-->
              <th width="10%">Created</th>
              <th width="10%">Expected</th>
              <th width="10%">ID</th>
              <th width="10%">Type</th>
              <th width="10%">Total</th>
              <th width="10%">Src</th>
              <?php /*?><th width="10%" colspan="3"></th><?php */?>
               <?php }?>
            </tr>
          </thead>
          <tbody class="table_body">
        	
			
			<?php  
			if(count($orderdetails)!=0){
           	foreach($orderdetails as $order){ ?>
            <tr id="row_<?php echo $order['order_id'];?>">
             <?php   if($this->user->role!='3'){	 ?>
             <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink " >
				<?php echo $order['restaurant_name'];?>
               </td>
			<?php } ?>   
           	   <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
				<?php echo $order['first_name'].' '.$order['last_name'];?>
               </td>
               <!--<td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink fontorange">
				<?php echo $order['order_status'];?>
               </td>-->
               <?php  $datetimeformat = getConfigValue('time_format').' '.getConfigValue('date_format'); ?>
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo date($datetimeformat, strtotime($order['created_time']));?></td>
                <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo date($datetimeformat, strtotime($order['delivery_time']));?></td>      
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo $order['order_ref_id'];?></td>
                <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo $order['order_type'];?></td>
                 <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo '$'.$order['total_amount'];?></td>
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink " >
				<?php
				 	if($order['auth_type']=="both" || $order['auth_type']=="facebook"){
					?>
					<img src="<?php echo base_url()?>/assets/images/icon-frkouse.png">
					<?php }else if($order['auth_type']=="general"){
				?>
                <img src="<?php echo base_url()?>/assets/images/icon-frkouse.png">
                <?php }?>
               </td>  
               <?php /*?><?php if($this->user->role=='3'){?>
               <td>
               <input type="button" class="btn btn-info accept" data-attr="<?php echo $order['order_id'];?>" value="ACCEPT">
               </td>
               <td>
               <input type="button" class="btn btn_gray cancel" data-attr="<?php echo $order['order_id'];?>" value="CANCEL">
               </td>
               <?php } ?>
               <td>
                <a href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="color:#03F;" >Order Details</a></td><?php */?>
            
                		
            </tr>
            <?php 	}
				}else { ?>
      		  <tr>
              <td colspan="10" class="tbl_row">
              No Late Orders
              </td>
              </tr>
           <?php } ?>
            
          </tbody>
        </table>
           
        </div>
      </div>
    </div>
    
    <?php if(count($orderdetails)!=0){?>
    <div class="row" id="Table footer">
    <div class="col-lg-12 ">
		<div class="col-offset-1 col-lg-2 pull-right">
			<div class="input-group">
			  <span class="input-group-addon">
				<i class="glyphicon glyphicon-map-marker"></i> 
			  </span>
			  <select name="limit" id="limit" class="form-control" >
					<option value="5" <?php if($limit == 5){?> selected="selected"<?php } ?> >5</option>
					<option value="10" <?php if($limit == 10){?> selected="selected"<?php } ?> >10</option>
					<option value="20" <?php if($limit == 20){?> selected="selected"<?php } ?> >20</option>
					<option value="50" <?php if($limit == 50){?> selected="selected"<?php } ?>>50</option>
					<option value="100" <?php if($limit == 100){?> selected="selected"<?php } ?>>100</option>
					<option value="all" <?php if($limit == 'all'){?> selected="selected"<?php } ?>>ALL</option>
				</select>
			</div>
		</div>
		
		<div class="col-offset-1 col-lg-10">
				<div class="input-group">
					<ul class="pagination pull-right" style="margin:0px;">
					<?php echo $this->pagination->create_links(); ?>
					</ul>
				</div>
		</div>
    </div>
  </div>
  <?php } ?>
    </div>
</form>
<script>  

	$(document).on('change', '#limit', function() {
			$("#formcategory").attr("action", "<?php echo base_url().$this->user->root;?>/orders/late");
				$("#formcategory").submit();return true;
	});	
	
		$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});

$('body').on('click', '.accept', function () {
	var order_id = $(this).attr("data-attr");
	$('.loader_home').show();
	//return false;
	
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/acceptOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				
				$('#row_'+order_id).remove();
				$('.alert-success').show();
				$('.alert-success').html('order accepted successfully');
				var rowCount = $('.tbl_category tr').length;
				if(rowCount=='1'){
					$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
				}

				$('.loader_home').hide();

				
            }
        });  

});

$('body').on('click', '.cancel', function () {
	var order_id = $(this).attr("data-attr");
	$('.loader_home').show();
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/cancelOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				
				$('#row_'+order_id).remove();
				$('.alert-success').show();
				$('.alert-success').html('order cancelled successfully');
				var rowCount = $('.tbl_category tr').length;
				if(rowCount=='1'){
					$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
				}

				$('.loader_home').hide();

				
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
</style>