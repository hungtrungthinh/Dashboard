

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
          <input type="text" name="daterange" class="cal" value="<?php echo $_REQUEST['daterange'];?>" style="" name="filter_date"  id="filter_date"/>
          <input type="hidden" name="startdate" id="startdate" value="">
          <input type="hidden" name="enddate" id="enddate" value="">
      </li> 
      <li  class="tog_tab pull-right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
      <li class="tog_tab pull-right" role="presentation">
          <label ><a href="javascript:void(0)" onclick="view_export()" data-toggle="modal" data-target="#myModal">EXPORT</a>   </label>
          <i class="glyphicon glyphicon-export"></i>
      </li>
      <li  class="tog_tab pull-right" >&nbsp;</li>
    </ul>
    

 
<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">
    <div aria-labelledby="category-tab" id="category" class="" role="tabpanel">
		<div class="table-responsive">

        <table class="table table-striped tbl_category">
          <thead class="head_table">
            <tr >
              <th class="col-md-2 col-sm-2">Customer Name</th>
              <th class="col-md-1 col-sm-1" colspan="2" >Delivery<br/># Cost</th>
              <th class="col-md-1 col-sm-1" colspan="2">Pick Up<br/># Cost</th>
              <th class="col-md-1 col-sm-1" colspan="2">Facebook<br/># Cost</th>
              <th class="col-md-1 col-sm-1" colspan="2">App<br/># Cost</th>
              <th class="col-md-1 col-sm-1" colspan="2">Website<br/># Cost</th>
             <!-- <th class="col-md-1 col-sm-1"  colspan="2">Breakfast<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1"  colspan="2">Lunch<br/>Order Cost</th>
              <th class="col-md-1 col-sm-1"  colspan="2">Dinner<br/>Order Cost</th>-->
              <th class="col-md-2 col-sm-2" colspan="2">Total<br/># Cost</th>
            </tr>
            
          </thead>
          <tbody class="table_body">
        	
			
			<?php  
			setlocale(LC_MONETARY, 'en_US.UTF-8');

			if(count($orderdetails)!=0){
           	foreach($orderdetails as $items){ ?>
            <tr id="row_<?php echo $items['member_id'];?>">
           	   <td  style="cursor:pointer;" class="tdlink">
				<?php echo $items['first_name'].' '.$items['last_name'];?>
               </td>
               
               <td style="cursor:pointer;" class="tdlink" >
				<?php echo $items['delivery_count'];?>
               </td>
               <td style="cursor:pointer;" class="tdlink" >
				<?php echo money_format('%.2n', $items['delivery']);?>
				
               </td>
               
               <td style="cursor:pointer;" class="tdlink">
			   <?php echo $items['pickup_count'];?>
               </td>
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo money_format('%.2n', $items['pickup']);?>
               </td>
               
               <td style="cursor:pointer;" class="tdlink">
			   <?php echo $items['facebook_count'];?>
               </td>
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo money_format('%.2n', $items['facebook']);?>
               </td>
               
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo $items['app_count'];?>
               </td>
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo money_format('%.2n', $items['app']);?>
               </td>
               
               <td style="cursor:pointer;" class="tdlink">
			   <?php echo $items['website_count'];?>
               </td>
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo money_format('%.2n', $items['website']);?>
               </td>
               
               <?php /*?><td style="cursor:pointer;" class="tdlink">
			   <?php echo $items['breakfast_count'];?>
               </td>
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo money_format('%.2n', $items['breakfast']);?>
               </td>
               
               <td style="cursor:pointer;" class="tdlink">
			   <?php echo $items['lunch_count'];?>
               </td>
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo money_format('%.2n', $items['lunch']);?>
               </td>
               
               <td style="cursor:pointer;" class="tdlink">
			   <?php echo $items['dinner_count'];?>
               </td>
                <td style="cursor:pointer;" class="tdlink">
			   <?php echo money_format('%.2n', $items['dinner']);?>
               </td><?php */?>
               
               <td  style="cursor:pointer;" class="tdlink"><?php echo $items['total_order'] ; ?></td>
               <td  style="cursor:pointer;" class="tdlink"><?php echo money_format('%.2n', $items['total_amount']) ; ?></td>
      
              
              
            
                		
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

 	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
   
<script>
	$(document).ready(function(){

		
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
	url:"<?php echo base_url(); ?>admin/reports/generate_customer_csv",
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