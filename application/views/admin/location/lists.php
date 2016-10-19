<section class="main-sec">
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="menu-tabs location-container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a aria-controls="location" aria-controls="location" role="tab" data-toggle="tab" href="<?php echo base_url().$this->user->root;?>/location/lists">LOCATION</a>
                        </li>
                    </ul>
                    <!-- End Nav tabs -->
                    
                    <!-- Tab panes -->
                    <div class="tab-content location-content">
                    	<!-- Location -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-location">
                        	<!-- Add New Category Button -->
                            <div class="add-new-box">
                            	<form>
                                    <label>
                                        <input type="submit" value="&#xf002;" />
                                        <input type="text" class="" placeholder="Keyword Search..." onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>"/>
                                    </label>
                                    <input type="reset" onclick="window.location.href='<?php echo base_url().$this->user->root;?>/location/lists'" value="Reset">
                                    
                                </form>
                                <?php if($totalnum < $resdetails['loc_limit']){ ?>
                                	<a href="<?php echo base_url().$this->user->root;?>/location/add" class="">Add New</a>
                                <?php }else{ ?>
                                	<a href="javascript:" class="" data-backdrop="static" data-target="#myModal" data-toggle="modal" class="mr_2">Add New</a>
                                <?php } ?>
                            </div>
                            <!-- End Add New Category Button -->
                            
                            <!-- Location Table -->
                            <div class="over-scroll">
                                <table class="table table-hover location-tble">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Zip Code</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th>Config</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php 
									$user = $this->session->userdata('user');
									$admin_id=$user->admin_id; 
									$username=$user->username; 
									if(count($locationlist)!=0){
									foreach($locationlist as $items){ ?>
                    
                                        <tr>
                                            <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link">
											<?php echo $items['restaurant_name'];?>
                                            </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link" >
											<?php
                                            if($items['state']!=''){
												echo $items['city']." , ".$items['state'];
											}else{
												echo $items['city']." ".$items['state'];
											}?>
                                            </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link">
											<?php echo $items['zip_code'];?>
                                            </td>
                       						<td href="<?php echo base_url().$this->user->root;?>/location/add/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="full_link">
											<?php echo $items['phone'];?>
                                            </td>
                                            
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" <?php if($items['is_clossed']=='N'){ ?> checked="true" <?php } ?> onClick="restaurant_status(<?php echo $items['location_id'];?>,'<?php echo $items['status'];?>')" class="restaurant_status<?php echo $items['location_id'];?>" data-val="<?php echo $items['is_clossed'];?>">
                                                    <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                </label>
                                            </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/preference/lists/<?php echo $items['location_id'];?>" style="cursor:pointer;" class="config_link">
                                            <i class="fa fa-cog"></i></a>
                                            </td>
                                        </tr>
                                    <?php 	}
                        			}	?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Location Table -->
                            
                            <!-- Post Page -->
                            <?php if(count($locationlist)!=0){?>
                            <div class="post-page">
                            	<div class="row">
                                	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 col-lg-offset-10 col-md-offset-10 col-sm-offset-9 col-xs-offset-9 display-ful-480">
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
                            <?php } ?>
                            <!-- End Post Page -->
                        </div>
                        <!-- End Location -->
                    </div>
                    <!-- End Tab panes -->
                </div>
                <!-- End Tabs -->
            </div>
        </section>
        
        
<div class="change-pass modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog cust_dilog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" class="close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Maximum Locations Created</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Change Password Form -->
                        <!-- Modal Body -->
                        <div class="" id="status" style="margin:15px"></div>
                        <div class="modal-body">
                            <label>
                                <div class="check-match">
                                </div>
                                
                            </label>
                                <div class="check-match">
                                </div>
                                You have reached maximum no of locations for this restaurant. Please contact Forkourse Administrator for further support.
                        </div>
                        <!-- End Modal Body -->
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<button  data-dismiss="modal" aria-label="Close" >OK</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Footer -->
                    <!-- End Change Password Form -->
                </div>
            </div>
            
</div>


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
	  
