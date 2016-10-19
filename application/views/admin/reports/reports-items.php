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
                        
                        
                        <li role="presentation">
                          <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/sales">SALES</a>		
                        </li>
                       
                        <li role="presentation">
                          <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url(); ?>manager/reports/customers">CUSTOMERS</a>
                        </li>
                        <li class="active"  role="presentation">
                          <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/items">ITEMS</a>		
                        </li>
      
                    </ul>
                    <!-- End Nav tabs -->
                    
                    
                    
                    
                    
<form name="form-item" id="form-item" action="<?php echo base_url()?>admin/reports/items" method="post" >      
       
                    
                    
                    
                    <!-- Tab panes -->
                    <div class="tab-content customers-content">
                    	<!-- Sales -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-sales">
                        	<!-- Button -->
                            <div class="add-new-box filter-box">
                                <a href="javascript:void(0)" onclick="view_export()" data-toggle="modal" data-target="#export-modal">EXPORT <i class="fa fa-share-square-o"></i></a>
                                <label>
                                	<span>Filter By <i class="fa fa-calendar"></i></span>
                                    
                                    <input type="text" name="daterange" value="<?php if($startDate!=''){ echo date('m/d/Y',strtotime($startDate)); ?> - <?php echo date('m/d/Y',strtotime($endDate)); }?>" style="" name="filter_date"  id="filter_date"/>
                                    
                                    <input type="hidden" name="startdate" id="startdate" value="<?php echo $startDate; ?>">
         							<input type="hidden" name="enddate" id="enddate" value="<?php echo $endDate; ?>">
                                    <input type="hidden" name="add_value" id="add_value" value=""> 	
                                </label>
                            </div>
                            <!-- End Button -->
                            
                            <!-- Sales Table -->
                            <div class="over-scroll sale-scroller">
                                <table class="table table-hover span-table rep-cust-tble">
                                    <thead>
                                         <tr>
                                            <th>Item Name</th>
                                            <th>Delivery<br><span>#</span> Cost</th>
                                            <th>Pickup<br><span>#</span> Cost</th>
                                            <th>Facebook<br><span>#</span> Cost</th>
                                            <th>App<br><span>#</span> Cost</th>
                                            <th>Website<br><span>#</span> Cost</th>
                                            <th>Total<br><span>#</span> Cost</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                  
            
           	<?php  
			setlocale(LC_MONETARY, 'en_US.UTF-8');
			if(count($orderdetails)!=0){
           	foreach($orderdetails as $items){ ?>
           					<tr id="row_<?php echo $items['item_id'];?>">
                                            <td><?php echo $items['item_name'];?></td>
                                            <td><span><?php echo $items['delivery_count'];?></span><?php echo money_format('%.2n', $items['delivery']);?></td>
                                            <td><span><?php echo $items['pickup_count'];?></span><?php echo money_format('%.2n', $items['pickup']);?></td>
                                            <td><span><?php echo $items['facebook_count'];?></span><?php echo money_format('%.2n', $items['facebook']);?></td>
                                            <td><span><?php echo $items['app_count'];?></span><?php echo money_format('%.2n', $items['app']);?></td>
                                            <td><span><?php echo $items['website_count'];?></span><?php echo money_format('%.2n', $items['website']);?></td>
                                            <td><span><?php echo $items['total_order'];?></span><?php echo money_format('%.2n', $items['total_amount']) ; ?></td>
                                        </tr>
          
            <?php 	}
				}else { ?>
      		  <tr>
              <td colspan="20">
              No Reports 
              </td>
              </tr>
           <?php } ?>
            
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


$(document).on('change', '#limit', function() {
			$("#form-item").attr("action", "<?php echo base_url()?>admin/reports/items");
				$("#form-item").submit();return true;
	});
	
	
	
		$('body').on('click', '.applyBtn', function () {
		var sales = $('#filter_date').val();
		salesnew=sales.split('-');
		$('#startdate').val(salesnew[0]);
		$('#enddate').val(salesnew[1]);
		$('#form-item').submit();
		
		
	});	
	
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
	url:"<?php echo base_url(); ?>admin/reports/generate_item_csv",
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