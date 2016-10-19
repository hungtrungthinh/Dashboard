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
     	 <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/customers/lists">CUSTOMERS</a>		
      </li>
      
      
      
       <div class="col-lg-5">
     		<div class="input-group">
   			  <input type="text" class="form-control" placeholder="Keyword Search" onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>">
      				<span class="input-group-btn btn_search">
     					 <button class="btn btn-info " id="btn_search" type="button">Go!</button>
     				</span>
	  				<span class="input-group-btn btn_search">
                          <a href="javascript:" onclick="window.location.href='<?php echo base_url().$this->user->root;?>/customers/lists'" class="blu_btn">
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
        
        
        <li class="tog_tab pull-right" role="presentation">
           <label ><a href="javascript:void(0)" class="" data-toggle="modal" data-target="#myModal">EXPORT</a>   </label>
          <i class="glyphicon glyphicon-export"></i>
      	</li>
        
    </ul>
     

     
<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">  
        
    <div aria-labelledby="category-tab" id="category"  role="tabpanel"> 
         
		<div class="table-responsive"> 
    		<table class="table table-striped tbl_category">
         		 <thead class="head_table">
           			 <tr>
                      <th class="col-md-2 col-sm-2">Restaurant Name</th>
                      <th class="col-md-2 col-sm-2">Customer Name</th>
                      <th class="col-md-2 col-sm-2">E-Mail</th>
                      <th class="col-md-2 col-sm-2">Phone Number</th>
                      <th class="col-md-2 col-sm-2">Join Date</th>
                      <th class="col-md-1 col-sm-1">Block User</th>
                      <?php $role=$this->session->userdata('user')->role;
				  if($role==2){?>
                       <th class="col-md-1 col-sm-1">Delete User</th>
                       <?php }?>
           			 </tr>
         		 </thead>
          		 <tbody class="table_body">
					<?php if(count($customerdetails)!=0){$i=1;
                          foreach($customerdetails as $customer){ 
                    ?>
                 <tr id="row_<?php echo $customer['member_id'];?>">
           	   		<td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $customer['name'];?>
               		</td>
              		<td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $customer['first_name'].' '.$customer['last_name'];?>
               		</td>
               		
  					<td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $customer['email'];?>
                    </td>     
              			
               		<td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo $customer['phone'];?>
               	   </td>
                   <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:pointer;" class="tdlink">
						<?php echo  date("M d, Y h:i A ", strtotime ($customer['created_date']));?>
               	   </td>
               	   <td>
						<a class="block" data-id="<?php echo $customer['member_id'];?>" data-block="<?php echo $customer['status'];?>" id="block_<?php echo $customer['member_id']; ?>" href="javascript: void(0)">	 
                        <?php if($customer['status'] == 'N'): ?><img src="<?php echo base_url() ?>assets/images/block.png" alt="" class="tmg25">
               			<?php else: ?>
                		<img src="<?php echo base_url() ?>assets/images/unblock.png" alt="" class="tmg25">
						<?php endif; ?>
                		</a>
        				
                  </td>	
                  
                 <?php $role=$this->session->userdata('user')->role;
				  if($role==2){?>
                  	 <td>
                            <center>
                                <a href="<?php echo base_url();?>admin/customers/delete/<?php echo $customer['member_id']; ?>" onclick="return confirm('Are you sure you want to delete?');"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                            </center>
                        </td>
              </tr>
              
					<?php }	$i++;}
					}else { ?>
      		  <tr>
                  <td colspan="8" class="tbl_row">No Customers ... </td>
             </tr>
				  <?php } ?>
            
            </tbody>
        </table>
          <?php if(count($customerdetails)!=0){?>
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
 </form>  
 
 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Export</h4>
      </div>
      <div class="modal-body">
        <form name="form-sales" method="post" action="<?php echo base_url().$this->user->root;?>/customers/export">
        
                <div class="form-group">
                  <div class="col-md-5 col-sm-5">
                    <label for="textinput" class="control-label">Select Fields</label>
                </div>
                <select name='feilds[]' size=4 multiple id="feilds" >
                    <option value='customer_name' selected="selected">Customer Name</option>
                    <option value='email' selected="selected">E-mail</option>
                 </select>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <input type="hidden" value="<?php echo $_POST['limit'];?>" name="limit" />
                <input type="hidden" value="<?php echo $_POST['per_page'];?>" name="per_page" />
               <!-- <div class="form-group">
                  <div class="col-md-5 col-sm-5">
                    <label for="textinput" class="control-label">Data</label>
                </div>
                <div class="col-md-1 col-sm-1">:</div>
                    <div class="col-md-5 col-sm-5">
                        <input type="radio" value="all"   name="page" checked="checked"/>AllPages
                        <input type="radio" value="single" name="page" />CurrentPage
                    </div>
               </div>-->
               <div class="clearfix"></div>
                
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default  pull-right">EXPORT</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
 
     
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
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/customers/lists");
				$("#userMasterForm").submit();return true;
	});
	//Change Limit of pagination
	$(document).on('change', '#limit', function() {
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/customers/lists");
				$("#userMasterForm").submit();return true;
	});	
function CustomerDetails(){
var rest = document.getElementById("rest").value;
if(rest!=0){
$("#userMasterForm").attr("action", "<?php echo site_url("admin/customers/lists");?>");
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