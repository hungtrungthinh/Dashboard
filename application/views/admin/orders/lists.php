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
<form name="userMasterForm" id="userMasterForm" action="<?php echo base_url().$this->user->root;?>/customers/lists" method="post" >     
	<div  class="tab_wrper" style="padding:10px;">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class="active tog_tab" role="presentation">
     	 <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/customers/lists">ORDERS</a>		
      </li>
       <div class="col-lg-5">
     		<div class="input-group">
   			  <input type="text" class="form-control" placeholder="Keyword Search" onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>">
      				<span class="input-group-btn btn_search">
     					 <button class="btn btn-info " id="btn_search" type="button">Go!</button>
     				</span>
	  				<span class="input-group-btn btn_search">
                          <a href="javascript:" onclick="window.location.href='<?php echo base_url().$this->user->root;?>/orders/lists'" class="blu_btn">
                          <button class="btn btn-default" type="button">Reset</button></a>
	  				</span>
    		 </div><!-- /input-group --> 	
          
   		 </div>
        <?php $role=$this->session->userdata('user')->role;
				  if($role==1){?>
         <div class="col-offset-1 col-lg-3">
            <div class="input-group">
             <span class="input-group-addon">
        		<i class="glyphicon glyphicon-map-marker"></i> 
      		</span>	
	  	<select class="form-control" id="rest" onchange="CustomerDetails();" name="rest">
			<option value="0" selected="selected">Select</option>
				<?php 
                $i = 0;
                while($i < count($restaurantlist)){
                
                  $res_id= $restaurantlist[$i]['restaurant_id'];
                  $res_name= $restaurantlist[$i]['name'];
                ?>

			<option value='<?php echo $res_id?>' <?php if($res_id== $_REQUEST['rest']) { ?>selected="selected"<?php } ?>><?php echo $res_name ?></option>

				 <?php $i++;
                }?>
		</select> 
	 
    		</div><!-- /input-group -->
 		</div>

        <?php }?>
    </ul>
     
<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">     
        
     
    <div aria-labelledby="category-tab" id="category" class="" role="tabpanel">     
          
		<div class="table-responsive">     
    		<table class="table table-striped tbl_category">
         		 <thead class="head_table">
           			 <tr>
                     <th class="col-md-1 col-sm-1">Restaurant</th>
                      <th class="col-md-1 col-sm-1">Location</th>
                      <th class="col-md-1 col-sm-1">Customer</th>
                      <th class="col-md-1 col-sm-1">Status</th>
                      <th class="col-md-2 col-sm-2">Create At</th>
                      <th class="col-md-2 col-sm-2">Expected By</th>
                      <th class="col-md-1 col-sm-1">ID</th>
                      <th class="col-md-1 col-sm-1">Type</th>
                      <th class="col-md-1 col-sm-1">Total</th>
                      <th class="col-md-1 col-sm-1">Src</th>
                      <?php $role=$this->session->userdata('user')->role;
				  if($role==2){?>
                       <th class="col-md-1 col-sm-1">Delete User</th>
                       <?php }?>
           			 </tr>
         		 </thead>
          		 <tbody class="table_body">
					<?php if(count($orderdetails)!=0){$i=1;
                          foreach($orderdetails as $order){ 
                    ?>
                 <tr id="row_<?php echo $order['order_id'];?>">
           	   		
                    
                    <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $order['name'];?>
               		</td>
                   
                   <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $order['restaurant_name'];?>
               		</td>
                   
              		<td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $order['first_name'].' '.$order['last_name'];?>
               		</td>
               		
                    <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $order['order_status'];?>
                    </td>    
                    
                     <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo  date("h:i A m/d/Y", strtotime ($order['created_time']));?>
                    </td>  
                     <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo  date("h:i A m/d/Y", strtotime ($order['delivery_time']));?>
                    </td>  
  					<td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $order['order_ref_id'];?>
                    </td>     
              		<td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
                    
						<?php echo $order['order_type'];?>
                    </td>  
                    <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo "$". $order['total_amount'];?>
               	   </td>
                     <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php if($order['auth_type']=="facebook")
						{?>
                        <img src="<?php echo base_url()?>assets/images/icon-fb.png" />
						<?php }
						else
						{?>
                        <img src="<?php echo base_url()?>assets/images/icon-frkouse.png" />
                        <?php
						}
						?> 
                     </td>    	
               		
                   
               	  
                  
                 <?php $role=$this->session->userdata('user')->role;
				  if($role==2){?>
                  	 <td>
                            <center>
                                <a href="<?php echo base_url();?>admin/customers/delete/<?php echo $customer['order_id']; ?>" onclick="return confirm('Are you sure you want to delete?');"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                            </center>
                        </td>
              </tr>
              
					<?php }	$i++;}
					}else { ?>
      		  <tr>
                  <td colspan="10" class="tbl_row">No Orders ... </td>
             </tr>
				  <?php } ?>
            
             </tbody> 
        </table>
          <?php if(count($orderdetails)!=0){?>
     <!--  <div class="row" id="Table footer"> 
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
		</div>-->
		
		<div class="col-offset-1 col-lg-10">
				<div class="input-group">
					<ul class="pagination pull-right" style="margin:0px;">
					<?php //echo $this->pagination->create_links(); ?>
					</ul>
				</div>
		</div>
    </div>
  </div>
  <?php } ?>
 </form>      
<script>   
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});

// BLock Unblock
	$('.block').click(function(){
          
		var member_id = $(this).data('id');
		var selector = '#' + 'block_' + member_id + " " + 'img';
		var imgsrc = $(selector).attr('src');       
		var status = $(this).data('block');
		var $this  = $(this);
		$.ajax({
            type : "POST",
            url  : "<?php echo base_url().$this->user->root;?>/customers/ajaxblock",
            data : {is_block: status, id:member_id}, 
            cache : false,
            success : function(res) {
			window.location.reload();
				if(res=='Y'){
				  	 $this.data('block','Y');
				 	 $(selector).attr('src',"<?php echo base_url() ?>assets/images/unblock.png");
					
				}
				else if(res=='N'){
					$this.data('block','N');
				 	$(selector).attr('src',"<?php echo base_url() ?>assets/images/block.png");
					
				}
            }
         });  
	}); //END: BLock Unblock
$('#btn_search').click(
		function(){		
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/orders/lists");
				$("#userMasterForm").submit();return true;
	});
	//Change Limit of pagination
	$(document).on('change', '#limit', function() {
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/orders/lists");
				$("#userMasterForm").submit();return true;
	});	
function CustomerDetails(){
var rest = document.getElementById("rest").value;
if(rest!=0){
$("#userMasterForm").attr("action", "<?php echo site_url("admin/orders/lists");?>");
$("#userMasterForm").submit();return true;	
}
else
alert("Please select atleat one restaurant !");
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