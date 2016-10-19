<link href="<?php echo base_url(); ?>assets/dashboard/css/daterangepicker.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/dashboard/js/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/daterangepicker.js"></script>
<script>
		// DATE: Range Picker
		$(function() {
			$('input[name="daterange"]').daterangepicker();
		});
		//==========================================
        </script>
	<section class="main-sec">
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="menu-tabs customers-container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        
                        
                        <li class="active" role="presentation">
                          <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/sales">SALES</a>		
                        </li>
                       
                        <li role="presentation">
                          <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url(); ?>manager/reports/customers">CUSTOMERS</a>
                        </li>
                        <li role="presentation">
                          <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/items">ITEMS</a>		
                        </li>
      
                    </ul>
                    <!-- End Nav tabs -->
                    
                    
                    
                    
                    
<form name="form-sales" id="form-sales" action="<?php echo base_url()?>admin/reports/sales" method="post" >   
       
                    
                    
                    
                    <!-- Tab panes -->
                    <div class="tab-content customers-content">
                    	<!-- Sales -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-sales">
                        	<!-- Button -->
                            <div class="add-new-box filter-box">
                                <a href="javascript:void(0)" onclick="view_export()" data-toggle="modal" data-target="#export-modal">EXPORT <i class="fa fa-share-square-o"></i></a>
                                <label>
                                	<span>Filter By <i class="fa fa-calendar"></i></span>
                                    
                                    <input type="text"  name="daterange"  id="filter_date" class="" value="<?php if($startDate!=''){ echo date('m/d/Y',strtotime($startDate)); ?> - <?php echo date('m/d/Y',strtotime($endDate)); }?>"> 
                                    <input type="hidden" name="startdate" id="startdate" value="<?php echo $startDate; ?>">
         							<input type="hidden" name="enddate" id="enddate" value="<?php echo $endDate; ?>">
                                </label>
                            </div>
                            <!-- End Button -->
                            
                            <!-- Sales Table -->
                            <div class="over-scroll sale-scroller">
                                <table class="table table-hover rep-sale-tble">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Location</th>
                                            <th>Customer</th>
                                            <th>Type</th>
                                            <th>Source</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php  
									if(count($orderdetails)!=0){
									foreach($orderdetails as $order){ ?>
									<tr id="row_<?php echo $order['order_id'];?>">
									   <td href="<?php echo base_url(); ?>admin/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
										<?php echo $order['order_ref_id'];?>
									   </td>
									   <td href="<?php echo base_url(); ?>admin/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
										<?php echo $order['restaurant_name'];?>
									   </td>
									   
									   <td href="<?php echo base_url(); ?>admin/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
										<?php echo $order['first_name'].' '.$order['last_name'];?>
									   </td>
									   <td href="<?php echo base_url(); ?>admin/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
										<?php echo $order['order_type'];?>
									   </td>
										<?php if($order['source_type']=='app') { ?>	
										<td>
                                        <?php echo '<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve"><circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
    <text transform="matrix(1 0 0 1 22.2852 33.2441)" fill="#FFFFFF" font-family="FontAwesome" font-size="20">&#xf10b;</text></svg>';?>
                                        
                                        </td>
										<?php }else if($order['source_type']=='facebook'  ) { ?>	
										<td>
										<?php echo '<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve"><circle fill="#1C3749" cx="26" cy="26" r="25.364"/><text transform="matrix(1 0 0 1 20.2852 33.2441)" fill="#FFFFFF" font-family="FontAwesome" font-size="20">&#xf09a;</text></svg>'?>
                                        </td>
										<?php }else if($order['source_type']=='web') { ?>	
										<td>
										<?php echo '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve"><circle fill="#1C3749" cx="26" cy="26" r="25.364"/><text transform="matrix(1 0 0 1 14.2852 33.2441)" fill="#FFFFFF" font-family="FontAwesome" font-size="20">&#xf109; </text></svg>'?>
                                        </td>
										<?php }?>
									   <td><?php echo "$". $order['total_amount'];?></td>
									
												
									</tr>
									<?php 	}
										}else { ?>
									  <tr>
									  <td colspan="6" class="tbl_row">
									  No Reports
									  </td>
									  </tr>
								   <?php } ?>
                                        
                                            <?php /*?><td><?xml version="1.0" encoding="utf-8"?>
    <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
    <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
    <text transform="matrix(1 0 0 1 20.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20"></text>
    </svg></td><?php */?>
                                           
                                      
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Sales Table -->
                            <?php if(sizeof($orderdetails) > 0) { ?> 
                            <!-- Post Page -->
                            <div class="post-page">
                            	<div class="row">
                                	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-8 display-ful-480">
                                        <nav>
                                             <?php echo $this->pagination->create_links(); ?>
                                        </nav>

                                    </div>
                                	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 display-ful-480">
                                        <select name="limit" id="limit" class="" >
                                            <option value="5" <?php if($limit == 5){?> selected="selected"<?php } ?> >5</option>
                                            <option value="10" <?php if($limit == 10){?> selected="selected"<?php } ?> >10</option>
                                            <option value="20" <?php if($limit == 20){?> selected="selected"<?php } ?> >20</option>
                                            <option value="50" <?php if($limit == 50){?> selected="selected"<?php } ?>>50</option>
                                            <option value="100" <?php if($limit == 100){?> selected="selected"<?php } ?>>100</option>
                                            <option value="all" <?php if($limit == 'all'){?> selected="selected"<?php } ?>>ALL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Post Page -->
							<?php }?>
                            
                        </div>
                        <!-- End Sales -->
                        
                        
					</form>                        
                        
                       
                    </div>
                    <!-- End Tab panes -->
                </div>
                <!-- End Tabs -->
            </div>
        </section>

<div class="edit-cat modal fade" id="export-modal" tabindex="-1" role="dialog" aria-labelledby="export-modal">

</div>


<script>   
<?php /*?>	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});
<?php */?>

	$('body').on('click', '.applyBtn', function () {
		var sales = $('#filter_date').val();
		salesnew=sales.split('-');
		$('#startdate').val(salesnew[0]);
		$('#enddate').val(salesnew[1]);
		$('#form-sales').submit();
		
		
	});	


	$(document).on('change', '#limit', function() {
			$("#form-sales").attr("action", "<?php echo base_url()?>admin/reports/sales");
				$("#form-sales").submit();return true;
	});	
    
</script>
<script>


 function csvgenerate(){
$("#form-sales").attr("action", "<?php echo base_url()?>admin/reports/csv/?id=<?php  echo $order['restaurant_id']?>");
	$("#form-sales").submit();return true;
}	
function view_export()
{
	var start=$("#startdate").val();
	var end=$("#enddate").val();
	$("#export-modal").html("");
	$.ajax({
	type:"post",
	url:"<?php echo base_url(); ?>admin/reports/generatecsv",
	data:{'limit':<?php echo $limit;?>,'per_page':<?php echo $per_page;?>,'start':start,'end':end},
	success:function(data){
		$("#export-modal").html(data);
		}
	});
}
</script>
<style>
.daterangepicker .calendar {
    display: none;
    max-width: 300px !important;
}
.cal
{
background-image:url(<?php echo base_url(); ?>/assets/images/icon-calender.png);
background-repeat: no-repeat;
border:none;
background-color:#ebeaea;
}

</style>