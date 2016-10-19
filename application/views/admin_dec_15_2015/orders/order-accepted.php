
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
    
<form name="form-order" id="form-order" action="<?php echo base_url().$this->user->root?>/orders/accepted" method="post" >   

<div  class="tab_wrper">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/lists">NEW
      <span class="badge badgenew"><?php echo $allcounts['newcount']; ?></span>
      </a>		
      </li>
      <li role="presentation" class="active tog_tab">
      <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url().$this->user->root;?>/orders/accepted">ACCEPTED
      <span class="badge"><?php echo $allcounts['accepted']; ?></span>
      </a>
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/cancelled">DECLINED
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
      
      <li class="tog_tab pull-right" role="presentation">
 	  <select name="search_sel" id="search_sel" class="form-control">
     	 <option value="">Filter by</option>
     	 <option value="Completed" <?php if($orderstatus=='Completed'){ ?> selected="true" <?php } ?> >Completed</option>
     	 <option value="Accepted" <?php if($orderstatus=='Accepted'){ ?> selected="true" <?php } ?>>Accepted</option>
      </select>
      </li> 
    </ul>
    

 
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
<!--              <th width="10%">Status</th>-->
			  <th width="10%">Created</th>
              <th width="10%">Expected</th>
              <th width="10%">ID</th>
              <th width="10%">Type</th>
              <th width="10%">Total</th>
              <!--<th width="20%" colspan="2">Action</th>-->
              <th width="10%">Src</th>
              <?php /*?><th width="10%" colspan="2"></th><?php */?>
              <?php }else{ ?>
              <!--<th width="10%">Status</th>-->
              <th width="10%">Created</th>
              <th width="10%">Expected</th>
              <th width="10%">ID</th>
              <th width="10%">Type</th>
              <th width="10%">Total</th>
              <th width="10%">Src</th>
              <?php /*?><th width="10%" colspan="2"></th><?php */?>
               <?php }?>
            </tr>
          </thead>
          <tbody class="table_body">
        	
			
			<?php  
			if(count($orderdetails)!=0){
           	foreach($orderdetails as $items){ ?>
            <tr id="row_<?php echo $items['order_id'];?>">
            
           <?php   if($this->user->role!='3'){	 ?>
             <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink " >
				<?php echo $items['restaurant_name'];?>
               </td>
			<?php } ?>              
           	   <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink">
				<?php echo $items['first_name'].' '.$items['last_name'];?>
               </td>
               <!--<td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink fontorange" >
				<?php echo $items['order_status'];?>
               </td>-->
              <?php  $datetimeformat = getConfigValue('time_format').' '.getConfigValue('date_format'); ?>
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo date($datetimeformat, strtotime($items['created_time']));?></td>
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo date($datetimeformat, strtotime($items['delivery_time']));?></td>
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink " >
				<?php echo $items['order_ref_id'];?>
               </td>
                <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink " >
				<?php echo $items['order_type'];?>
               </td>
                <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink " >
				<?php echo '$'.$items['total_amount'];?>
               </td>
                <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink " >
				<?php
				 	if($items['auth_type']=="both" || $items['auth_type']=="facebook"){
					?>
					<img src="<?php echo base_url()?>/assets/images/icon-frkouse.png">
					<?php }else if($items['auth_type']=="general"){
				?>
                <img src="<?php echo base_url()?>/assets/images/icon-frkouse.png">
                <?php }?>
               </td>
              <?php /*?> <td>
			   <?php if($this->user->role=='3'){?>
               		<input type="button" class="btn btn-info completed" data-attr="<?php echo $items['order_id'];?>" value="COMPLETED">
               <?php } ?>
              &nbsp;
              
              </td>
             <td>
             <a href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $items['order_id'];?>" style="color:#03F;" >Order Details</a>
             </td>
             <?php */?> 		
            </tr>
            <?php 	}
				}else { ?>
      		  <tr>
              <td colspan="10">
             No Accepted Orders
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
				<?php /*?>	<?php echo $this->pagination->create_links(); ?><?php */?>
					</ul>
				</div>
		</div>
    </div>
  </div>
  <?php } ?>
</div>

</form>

     
   
<script>
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});

$('body').on('click', '.completed', function () {
	var order_id = $(this).attr("data-attr");
	$('.loader_home').show();
	//return false;
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/completeOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				
			
				$('#row_'+order_id).remove();
				$('.alert-success').show();
				$('.alert-success').html('order completed successfully');
				var rowCount = $('.tbl_category tr').length;
				if(rowCount=='1'){
					$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
				}

				$('.loader_home').hide();

				
            }
        });  

});

	$('body').on('change', '#search_sel', function () {
		var search_sel = $('#search_sel').val();
		$('#form-order').submit();
	});	
	//Change Limit of pagination
	$(document).on('change', '#limit', function() {
			$("#form-order").attr("action", "<?php echo base_url().$this->user->root;?>/orders/accepted");
				$("#form-order").submit();return true;
	});	
	
	
	$('#btn_search').click(
		function(){		
			$("#form-order").attr("action", "<?php echo base_url().$this->user->root;?>/orders/accepted");
				$("#form-order").submit();return true;
	});
	
	$(document).on('change', '#status', function() {
			$("#form-order").attr("action", "<?php echo base_url().$this->user->root;?>/orders/accepted");
			$("#form-order").submit();return true;	
	});
	// END: Change Limit of pagination
	
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