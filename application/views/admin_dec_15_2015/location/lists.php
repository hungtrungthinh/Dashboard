<style>
.fa.fa-gear {
    color: #a2a2a2;
    font-size: 23px;
}
</style>
<script language="javascript">

//Change Limit of pagination
	$(document).on('change', '#limit', function() {
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/location/lists");
				$("#userMasterForm").submit();return true;
	});	
	
	$('#btn_search').click(
		function(){	
		
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/location/lists");
				$("#userMasterForm").submit();return true;
	});
	
  
	
	$(document).on('change', '#status', function() {
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/location/lists");
			$("#userMasterForm").submit();return true;	
	});
	// END: Change Limit of pagination
	

</script>

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
    
<form name="userMasterForm" id="userMasterForm" action="<?php echo base_url().$this->user->root;?>/location/lists" method="post" >   

<div  class="tab_wrper" >

    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li role="presentation" class="active tog_tab" style="width:10%;">
      <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url().$this->user->root;?>/location/lists">LOCATION</a>
      </li>
      <li style="width:90%;">
      		<div class="col-lg-3">
               <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-map-marker"></i> 
                    </span>	
                    <select name="bulkaction" id="bulkaction" class="form-control" >
                        <option value="" <?php if($bulkaction ==''){?> selected="selected"<?php } ?> >Bulk actions</option>
                        <option value="delete" <?php if($bulkaction == 'delete'){?> selected="selected"<?php } ?> >Delete</option>
                    </select>
         
                 </div><!-- /input-group -->
 			</div>
        	<div class=" col-lg-3">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-map-marker"></i> 
                </span>	
                <select name="status" id="status" class="form-control" >
                    <option value="" <?php if($status ==''){?> selected="selected"<?php } ?> >Filter by Status</option>
                    <option value="N" <?php if($status == 'N'){?> selected="selected"<?php } ?> >Open</option>
                    <option value="Y" <?php if($status == 'Y'){?> selected="selected"<?php } ?> >Closed</option>
                </select>
         
                </div><!-- /input-group -->
 			</div>
             <div class="col-lg-5">
     		<div class="input-group">
   			  <input type="text" class="form-control" placeholder="Keyword Search" onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>"/>
      				<span class="input-group-btn btn_search">
     					 <button class="btn btn-info" id="btn_search" type="button">Go!</button>
     				</span>
                  
	  				<span class="input-group-btn btn_search">
                          <a href="javascript:" onclick="window.location.href='<?php echo base_url().$this->user->root;?>/location/lists'" class="blu_btn">
                          <button class="btn btn-default" type="button">Reset</button></a>
	  				</span>
    		 </div><!-- /input-group --> 	 	
          
   		 	</div>
     		<div class="col-lg-1"><a href="<?php echo base_url().$this->user->root;?>/location/add" class="btn btn-info">Add New</a></div>
      </li>
            
    </ul>
    
    
 
	<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">                
    	<div aria-labelledby="category-tab" id="category" class="" role="tabpanel">           
			<div class="table-responsive"> 
                <table class="table table-striped tbl_category">
                  <thead class="head_table">
                    <tr>
                      <th class="col-md-2 col-sm-2">Name</th>
                      <th class="col-md-3 col-sm-3">Location</th>
                      <th class="col-md-2 col-sm-2">Zip Code</th>
                      <th class="col-md-2 col-sm-2">Phone Number</th>
                      <th class="col-md-2 col-sm-2">Status</th>
<!--                  <th class="col-md-2 col-sm-2">Close Restaurant</th>-->
                      <th class="col-md-1 col-sm-1">Config</th>
                    </tr>
                  </thead>
                  <tbody class="table_body">
                    
                    
                    <?php 
                    $user = $this->session->userdata('user');
                    $admin_id=$user->admin_id; 
                    $username=$user->username; 
                    if(count($locationlist)!=0){
                    foreach($locationlist as $items){ ?>
                    <tr id="row_<?php echo $items['order_id'];?>">
                     
                       <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link">
                        <?php echo $items['restaurant_name'];?>
                       </td>
                       <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link" >           
                        <?php
						if($items['state']!=''){
						echo $items['city']." , ".$items['state'];}else{
						echo $items['city']." ".$items['state'];	
						}
						?>
                       </td>
                        <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link"><?php echo $items['zip_code'];?></td>
                        <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link"><?php echo $items['phone'];?></td>
                      <!-- <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link" >
                        <?php echo  date("h:i a ", strtotime ($items['start_at']))."-".date("h:i a ", strtotime ($items['end_at']));?>
                       </td>-->
                       
                      
                       
                       
                      <td><div class="checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin:0;">
                       <label>
                      <input type="checkbox" <?php if($items['is_clossed']=='N'){ ?> checked="true" <?php } ?> onClick="restaurant_status(<?php echo $items['location_id'];?>,'<?php echo $items['status'];?>')" class="restaurant_status<?php echo $items['location_id'];?>" data-val="<?php echo $items['is_clossed'];?>"><span></span>
                      </label>
                      </div></td>
                    
                    <td href="<?php echo base_url().$this->user->root;?>/preference/lists/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="config_link">
                    	<i class="fa fa-gear"></i>
                    </td>
                                
                    </tr>
                    
                    <?php 	}
                        }else { ?>
                        
                      <tr>
                      <td colspan="6">
                      No Restaurants...
                      </td>
                      </tr>
                   <?php } ?>
                    
                  </tbody>
                </table>
     		</div>
   		</div>
   </div>
       <?php if(count($locationlist)!=0){?>
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
  <?php } ?>
  
</div>
</form>


<script>
  $(document).ready(function(){
    $('.full_link').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
	
	$('.config_link').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
	
  });


function restaurant_status(location_id,is_closed){
        
		var status=$('.restaurant_status'+location_id).attr('data-val'); 
		if($('.restaurant_status'+location_id).attr('data-val')=='Y')
			$('.restaurant_status'+location_id).attr('data-val','N');
		else
			$('.restaurant_status'+location_id).attr('data-val','Y');
			//alert(sta);
		$.ajax({
			
				type:"post",
				url:"<?php echo base_url().$this->user->root;?>/location/restaurant_status",
				data:{'location_id':location_id,'status':status},
				success:function(data){
				
					return true;
				}
			
			});
 }
	 
		
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