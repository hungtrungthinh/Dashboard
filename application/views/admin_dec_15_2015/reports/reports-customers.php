

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
    
<form name="form-order" id="form-order" action="<?php echo base_url()?>admin/reports/customers" method="post" >   

<div  class="tab_wrper">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class=" tog_tab" role="presentation">
      <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/sales">SALES</a>		
      </li>
      <li role="presentation" class="tog_tab active">
      <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url(); ?>manager/reports/customers">CUSTOMERS</a>
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url(); ?>manager/reports/items">ITEMS</a>		
      </li>
      <li class="tog_tab pull-right" role="presentation">
          <label>Filter by</label>
          <input type="text" name="daterange" class="" value="<?php echo $_REQUEST['daterange'];?>" style="" name="filter_date"  id="filter_date"/>
          <input type="hidden" name="startdate" id="startdate" value="">
          <input type="hidden" name="enddate" id="enddate" value="">
      </li> 
      <li  class="tog_tab pull-right" >&nbsp;</li>
      <li class="tog_tab pull-right" role="presentation">
          <label class="orange-link">EXPORT </label>
          <i class="glyphicon glyphicon-export"></i>
      </li>
      <li  class="tog_tab pull-right" >&nbsp;</li>
    </ul>
    

 
<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">
    <div aria-labelledby="category-tab" id="category" class="" role="tabpanel">
		<div class="table-responsive">

        <table class="table table-striped tbl_category">
          <thead class="head_table">
            <tr>
              <th class="col-md-2 col-sm-2">Customer Name</th>
              <th class="col-md-1 col-sm-1">Delivery<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1">Pick Up<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1">Facebook<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1">App<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1">Website<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1">Breakfast<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1">Lunch<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1">Dinner<br/>Order Cost</th>
              <th class="col-md-2 col-sm-2">Total<br/>Order Cost</th>
            </tr>
          </thead>
          <tbody class="table_body">
        	
			
			<?php  
			if(count($orderdetails)!=0){
           	foreach($orderdetails as $items){ ?>
            <tr id="row_<?php echo $items['member_id'];?>">
           	   <td href="<?php echo base_url(); ?>admin/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink">
				<?php echo $items['first_name'].' '.$items['last_name'];?>
               </td>
               <td href="<?php echo base_url(); ?>admin/orders/details/<?php echo $items['order_id'];?>" style="cursor:pointer;" class="tdlink" >
				<?php echo $items['Delivery'];?>
               </td>
               
               <td style="cursor:pointer;" class="tdlink"><?php echo $items['pickup'];?></td>
               <td  style="cursor:pointer;" class="tdlink"><?php echo"0";?></td>
               <td  style="cursor:pointer;" class="tdlink"><?php echo"0";?></td>
               <td style="cursor:pointer;" class="tdlink"><?php echo"0";?></td>
               <td  style="cursor:pointer;" class="tdlink"><?php echo"0";?></td>
               <td  style="cursor:pointer;" class="tdlink"><?php echo"0";?></td>
               <td  style="cursor:pointer;" class="tdlink"><?php echo"0";?></td>
               <td  style="cursor:pointer;" class="tdlink"><?php echo $items['pickup'] + $items['Delivery']; ?></td>
               <td><?php //echo $items['order_status'];?>
               
              
            
                		
            </tr>
            <?php 	}
				}else { ?>
      		  <tr>
              <td colspan="10">
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

     
   
<script>
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
		
	<?php //if($date_range){?>
	<?php  if($date_values['from_date'] && $date_values['to_date']){ ?>
			
                  var optionSet = {
                    startDate: '<?php echo $date_values['from_date']?>',
                    endDate: '<?php echo $date_values['to_date']?>',
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
	

$('body').on('click', '.completed', function () {
	var order_id = $(this).attr("data-attr");
	$('.loader_home').show();
	//return false;
        $.ajax({
            url: '<?php echo base_url(); ?>admin/orders/completeOrder',
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

$(document).on('change', '#limit', function() {
			$("#form-order").attr("action", "<?php echo base_url()?>admin/reports/customers");
				$("#form-order").submit();return true;
	});	


$('body').on('click', '.applyBtn', function () {
		var sales = $('#filter_date').val();
		salesnew=sales.split('-');
		$('#startdate').val(salesnew[0]);
		$('#enddate').val(salesnew[1]);
		$('#form-order').submit();
		
		
	});

</script>