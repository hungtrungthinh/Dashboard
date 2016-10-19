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
    
<form name="form-sales" id="form-sales" action="<?php echo base_url()?>admin/reports/sales" method="post" >   
<div  class="tab_wrper" >
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class="active tog_tab" role="presentation">
      <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/sales">SALES</a>		
      </li>
      <li role="presentation" class="tog_tab">
      <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url(); ?>manager/reports/customers">CUSTOMERS</a>
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/items">ITEMS</a>		
      </li>
	  <li class="tog_tab pull-right" role="presentation">
          <label>Filter by</label>
          <input type="text"  name="daterange"   name="filter_date"  id="filter_date" class="cal"> 
          <input type="hidden" name="startdate" id="startdate" value="<?php echo $startDate; ?>">
          <input type="hidden" name="enddate" id="enddate" value="<?php echo $endDate; ?>">
      </li> 
   <li  class="tog_tab pull-right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
      <li class="tog_tab pull-right" role="presentation">
  <label>    <a href="javascript:void(0)" onclick="view_export()" data-toggle="modal" data-target="#myModal">EXPORT</a>   </label> 
    <!--  <label class="orange-link" onclick="csvgenerate();">EXPORT </label>-->
          <i class="glyphicon glyphicon-export"></i>
      </li>
       
    </ul>
    

<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">
    <div aria-labelledby="category-tab" id="category" class="" role="tabpanel">
		<div class="table-responsive">

    
        <table class="table table-striped tbl_category">
          <thead class="head_table">
            <tr>
              <th class="col-md-2 col-sm-2"># ID</th>
              <th class="col-md-2 col-sm-2">Location</th>
              <th class="col-md-2 col-sm-2">Customer Name</th>
              <th class="col-md-2 col-sm-2">Type</th>
              <th class="col-md-2col-sm-2">Source</th>
              <th class="col-md-2 col-sm-2">Order Total</th>
            </tr>
          </thead>
          <tbody class="table_body">
        	
			
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
                <?php if($order['auth_type']=='facebook') { ?>	
                <td><img src="<?php echo base_url()?>assets/admin_lte/img/fb_icon.png"></td>
                <?php }?>
                 <?php if($order['auth_type']=='general' ||$order['auth_type']=='' ) { ?>	
                <td><img src="<?php echo base_url()?>assets/images/icon-frkouse.png"></td>
                <?php }?>
                 <?php if($order['auth_type']=='both') { ?>	
                <td><img src="<?php echo base_url()?>assets/admin_lte/img/fb_icon.png"></td>
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
            
          </tbody>
        </table>
        
<?php if(sizeof($orderdetails) > 0) { ?>       
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
			</div><!-- /input-group -->
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
 <?php }?>
 
 
             
             
        </div>
      </div>
    </div>
    </div>
</form>  

  <!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

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

$(document).ready(function(){
	<?php //if($date_range){?>
	<?php  if($date_values['from_date'] && $date_values['to_date']){ ?>
			
                  var optionSet = {
                   
					format: "YYYY/MM/DD"
					};

	<?php }else 
		{?>
			
                  var optionSet = {
					//startDate: moment().subtract(29, 'days'),
					startDate: moment(),
                    endDate: moment(),
					format: "YYYY/MM/DD",
					opens: "left",
  					drops: "down",
					
					};
		<?php }?>	
		$('input[name="daterange"]').daterangepicker(optionSet);
	<?php //} ?>
});
 function csvgenerate(){
$("#form-sales").attr("action", "<?php echo base_url()?>admin/reports/csv/?id=<?php  echo $order['restaurant_id']?>");
	$("#form-sales").submit();return true;
}	
function view_export()
{
	var start=$("#startdate").val();
	var end=$("#enddate").val();
	$("#myModal").html("");
	$.ajax({
	type:"post",
	url:"<?php echo base_url(); ?>admin/reports/generatecsv",
	data:{'limit':<?php echo $limit;?>,'per_page':<?php echo $per_page;?>,'start':start,'end':end},
	success:function(data){
		$("#myModal").html(data);
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