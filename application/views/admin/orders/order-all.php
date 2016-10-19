	
	
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
  <!-- ===== Start Section Main ===== -->
       	<section class="main-sec">
        
        <div class="alert alert-danger hide" role="alert"></div>
        <div class="alert alert-success hide" role="alert"></div>
        
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="order-tabs">

				<form class="form-horizontal" id="form-order"  role="form" action="<?php echo base_url().$this->user->root;?>/orders/lists" method="post" >	 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="<?php echo base_url().$this->user->root;?>/orders/lists" aria-controls="new">
                        New (<span  class="badgenew"><?php echo $allcounts['newcount']; ?></span>)</a></li>
                        <li role="presentation" ><a href="<?php echo base_url().$this->user->root;?>/orders/accepted" aria-controls="accepted">
                        Accepted (<?php echo $allcounts['accepted']; ?>)</a></li>
                        <li role="presentation"><a href="<?php echo base_url().$this->user->root;?>/orders/cancelled" aria-controls="declined" >
                        Declined </a></li>
                        <li role="presentation"  ><a href="<?php echo base_url().$this->user->root;?>/orders/late" aria-controls="late" >
                        Future (<?php echo $allcounts['late']; ?>)</a></li>
                        <li role="presentation" class="active"><a href="<?php echo base_url().$this->user->root;?>/orders/all" aria-controls="all" >
                        All </a></li>
                 
      
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                    	<!-- New -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-new">
                        	<!-- DESKTOP OR IPAD VIEW -->
                        	<table class="table table-hover table-dekstop tbl_category">
                                <thead>
                                    <tr>
                                    	<?php if($this->user->role!='3'){?>
                                          <th width="10%">Location</th>
                                        <?php } ?>  
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Expected</th>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th style="text-align:center;">Total</th>
                                        <th style="text-align:center;">SRC</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php if(count($orderdetails)!=0){
           						foreach($orderdetails as $items){ ?>
                                    <tr id="<?php echo $items['order_id'];?>" class='trlink'>
                                    	 <?php   if($this->user->role!='3'){	 ?>
                                         <td class="tdlink " >
                                            <?php echo $items['restaurant_name'];?>
                                           </td>
                                         <?php } ?>    
                                    	<td class="tdlink"><?php echo $items['first_name'].' '.$items['last_name'];?></th>
                                        <td class="tdlink"><?php echo $items['order_status'];?></th>
                                        <?php  $datetimeformat = getConfigValue('time_format').' '.getConfigValue('date_format'); ?>
                                        <td class="tdlink"><?php echo date($datetimeformat, strtotime($items['created_time']));?></td>
                                        <td class="tdlink"><?php echo date($datetimeformat, strtotime($items['delivery_time']));?></td>
                                        <td class="tdlink"><?php echo $items['order_ref_id'];?></th>
                                        <td class="tdlink"><?php echo $items['order_type'];?></td>
                                        <td style="text-align:center;" class="tdlink"><?php echo '$'.$items['total_amount'];?></td>
                                        <td class="tdlink">
                                        
                                        
                                        <?php switch($items['source_type']){ 
										
										case 'facebook': ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 20.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20">&#xf09a;</text>
                                                </svg>
                                              <?php break; 
									  case 'web': ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 14.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20">&#xf109; </text>
                                                </svg>
                                              <?php break; 
									case 'app': ?>
                                                    <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                         width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                    <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                    <text transform="matrix(1 0 0 1 20.2852 34.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="24">&#xf10b; </text>
                                                    </svg>
                                              <?php break; 
									default : ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 16.2852 32.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="18">&#xf109; </text>
                                                </svg>
                                              <?php break; 
									}?>

									</td>
                                    </tr>
                                    <?php } }
									else
									{ ?>
									<tr>
									  <td colspan="10">
										No Orders
									  </td>
									 </tr>
									<?php }?>
                                </tbody>
                            </table>
                            <!-- END DESKTOP OR IPAD VIEW -->
                            
                            <!-- TABLET VIEW -->
                        	<table class="table table-tablet table-tablet">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th style="text-align:center;">SRC</th>
                                        <th style="text-align:center;">More</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                 <?php if(count($orderdetails)!=0){
           							foreach($orderdetails as $items){ ?>
                                    <tr id="<?php echo $items['order_id'];?>" class='trlink'>
                                    	<td  class="tdlink"><?php echo $items['first_name'].' '.$items['last_name'];?></th>
                                         <td class="tdlink"><?php echo $order['order_status'];?></th>
                                        <td class="tdlink"><?php echo $items['order_ref_id'];?></td>
                                        <td class="tdlink"><?php echo $items['order_type'];?></th>
                                        <td style="text-align:center;" class="tdlink">     
                                        
                                        <?php switch($items['source_type']){ 
										
										case 'facebook': ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 20.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20">&#xf09a;</text>
                                                </svg>
                                              <?php break; 
									  case 'web': ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 14.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20">&#xf109; </text>
                                                </svg>
                                              <?php break; 
									case 'app': ?>
                                                    <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                         width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                    <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                    <text transform="matrix(1 0 0 1 20.2852 34.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="24">&#xf10b; </text>
                                                    </svg>
                                              <?php break; 
									default : ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">

                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 16.2852 32.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="18">&#xf109; </text>
                                                </svg>
                                              <?php break; 
									}?>
									</td>
                                        <td style="text-align:center;" class="tdlink">
                                        	<a href="javascript:void(0)" class="more-btn"></a>
                                        </td>
                                    </tr>
                                    <?php } }
									else
									{ ?>
									<tr>
									  <td colspan="5">
										 No Late Orders
									  </td>
									 </tr>
									<?php }?>
                                </tbody>
                            </table>
                            <!-- END TABLET VIEW -->
                            
                            <!-- MOBILE VIEW -->
                        	<table class="table table-mobile">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Type</th>
                                        <th style="text-align:center;">SRC</th>
                                        <th style="text-align:center;">More</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                 <?php if(count($orderdetails)!=0){
           							foreach($orderdetails as $items){ ?>
                                    <tr id="<?php echo $items['order_id'];?>" class='trlink'>
                                    	<td class="tdlink"><?php echo $items['first_name'].' '.$items['last_name'];?></th>
                                        <td class="tdlink"><?php echo $items['order_type'];?></td>
                                        <td class="tdlink" style="text-align:center;">
										<?php switch($items['source_type']){ 
										
										case 'facebook': ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 20.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20">&#xf09a;</text>
                                                </svg>
                                              <?php break; 
									  case 'web': ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 14.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20">&#xf109; </text>
                                                </svg>
                                              <?php break; 
									case 'app': ?>
                                                   <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                         width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                                    <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                    <text transform="matrix(1 0 0 1 20.2852 34.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="24">&#xf10b; </text>
                                                    </svg>

                                              <?php break; 
									default : ?>
                                                <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">

                                                <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
                                                <text transform="matrix(1 0 0 1 16.2852 32.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="18">&#xf109; </text>
                                                </svg>
                                              <?php break; 
									}?>
									</td>
                                        <td class="tdlink" style="text-align:center;">
                                        	<a href="javscript:void(0)" class="more-btn"></a>
                                        </td>
                                    </tr>
                                    <?php } }
									else
									{ ?>
									<tr>
									  <td colspan="4">
										 No Late Orders
									  </td>
									 </tr>
									<?php }?>
                                   
                                </tbody>
                            </table>
                            <!-- END MOBILE VIEW -->
                        </div>
                        <!-- End New -->
                        
                        <!-- Accepted -->
                       
                        <!-- End Accepted -->
                        
                        <!-- Declined -->
                       
                        <!-- End Declined -->
                        
                        <!-- Late -->
                        
                        <!-- End Late -->
                        
                        <!-- All -->
                        
                        <!-- End All -->
                    </div>
                    <!-- End Tab panes -->
                </div>
                
                    <?php if(count($orderdetails)!=0){?>
                           <div class="row" id="Table footer">
                        <div class="col-lg-12 ">
                            <div class="col-offset-1 col-lg-2 pull-right">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-chevron-down"></i> 
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
                </form>  
                <!-- End Tabs -->
      
                <!-- Order Detail Modal 1 -->
                <div class="order-detail-modal modal fade bs-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        	<!-- Order Close Modal -->
                            <a href="#" data-dismiss="modal" aria-label="Close" onclick="closeDetail()"><i class="fa fa-times"></i></a>
                            <!-- End Order Close Modal -->
                            
                            <!-- Order Modal Body -->
                            <div class="modal-body">
                                
                            </div>
                            <!-- End Order Modal Body -->
                        </div>
                    </div>
                </div>
               
            </div>
        </section>
        <!-- ===== End Section Main ===== -->
        
        
          
<script>
	function closeDetail(){
		$('#deltime').html('');
		source2.close();
	}
	
	$(document).ready(function(){
		$('body').on('click', '.trlink', function () {
			//$('.tdlink').click(function(){
			//window.location = $(this).attr('href');
			var order_id = $(this).attr("id");
			$('.loader_home').show();
			//return false;
			
				$.ajax({
					url: '<?php echo base_url().$this->user->root;?>/orders/details_ajax',
					type: 'POST',
					data: {'order_id':order_id}, 
					success: function (result) {
						
						$(".order-detail-modal .modal-body").html(result);
						$("#myModal1").modal("show");
						
						$('.loader_home').hide();
						
						
					}
				});  
			
			return false;
		});
	});




	$('body').on('change', '#search_sel', function () {
		var search_sel = $('#search_sel').val();
		$('#form-order').submit();
	});	
	//Change Limit of pagination
	$(document).on('change', '#limit', function() {
			$("#form-order").attr("action", "<?php echo base_url().$this->user->root;?>/orders/all");
				$("#form-order").submit();return true;
	});	
	
	
	$('#btn_search').click(
		function(){		
			$("#form-order").attr("action", "<?php echo base_url().$this->user->root;?>/orders/all");
				$("#form-order").submit();return true;
	});
	
	$(document).on('change', '#status', function() {
			$("#form-order").attr("action", "<?php echo base_url().$this->user->root;?>/orders/all");
			$("#form-order").submit();return true;	
	});
	// END: Change Limit of pagination
	$('body').on('click', '.continue', function () {
var amount= parseFloat($("#refund_amount").val());
var total_amount= parseFloat($("#total_amount").val());
var order_id = $("#order_id").val();
if(amount >0 && amount<= total_amount){
	$("#refund_input").hide();
	$('.acbtncls').hide();
	$('.cmpbtncls').hide();
	$("#refund_input").removeClass('has-error');
	$("#refund_input .input-group").attr('data-original-title','Enter refund amount');
	$('.loader_home').show();
	   $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/OrderPartialRefund',
            type: 'POST',
            data: {'order_id':order_id,'amount':amount}, 
            success: function (result) {
				$('.loader_home').hide();
				if(result=='success')
				{
					$(".refund").removeClass('.refund');
					$('.alert-success').removeClass('hide');
					$('.alert-success').html('Refund successfully');
					window.setTimeout(function(){$('.alert-success').addClass('hide');}, 3000);
					
					$("html, body").animate({ scrollTop: 0 }, "fast");
					//setTimeout(function(){window.location.href="<?php echo base_url().$this->user->root;?>/orders/details/"+order_id;}, 1000);
				}
				else
				{
					$('.acbtncls').show();
					$('.alert-danger').removeClass('hide');
					$('.alert-danger').html('Unknown error occured');
					$("html, body").animate({ scrollTop: 0 }, "fast");
					window.setTimeout(function(){$('.alert-danger').addClass('hide');;}, 3000);
				}
				
				$("#myModal1").modal('hide');
				
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
