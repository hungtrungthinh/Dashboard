<section class="main-sec">
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="menu-tabs customers-container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                        	<a href="#tab-customers" aria-controls="customers" role="tab" data-toggle="tab">Customers</a>
                        </li>
                    </ul>
                    <!-- End Nav tabs -->
                    
                    <!-- Tab panes -->
                    <div class="tab-content customers-content">
                    	<!-- Customers -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-customers">
                        	<!-- Add New Customers Button -->
                            <div class="add-new-box">
							<form name="userMasterForm" id="userMasterForm" action="<?php echo base_url().$this->user->root;?>/customers/lists" method="post" >     
                                    <label>
                                        <input type="text" class="" placeholder="Keyword Search..." onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>">
                                    </label>
                                    <label>
                                    	<input type="button" id="btn_search" value="&#xf002;" class="redSave" style="font-family: FontAwesome;"  />
                                    </label> 
                                   
                                    <input type="reset" href="javascript:" onclick="window.location.href='<?php echo base_url().$this->user->root;?>/customers/lists'"   value="Reset" />
                                
                                <a href="#" data-toggle="modal" data-target="#export-modal">Export <i class="fa fa-share-square-o"></i></a>
                            </div>
                            <!-- End Add New Customers Button -->
                            
                            <!-- Customers Table -->
                            <div class="over-scroll customer-scroller">
                                <table class="table table-hover customers-tble">
                                    <thead>
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Customer</th>
                                            <th>E-Mail</th>
                                            <th>Phone Number</th>
                                            <th>Join Date</th>
                                            <th>Block User</th>
                                            <?php $role=$this->session->userdata('user')->role;
				  							if($role==2){?>
                       						<!--<th>Delete</th>-->
                       						<?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($customerdetails)!=0){ $i=1;
                          			foreach($customerdetails as $customer){ 
                    				?>
                                    
                                        <tr id="row_<?php echo $customer['member_id'];?>">
                                            <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor: default;" class="tdlink">
											<?php echo $customer['name'];?>
                                            </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:default;" class="tdlink">
											<?php echo $customer['first_name'].' '.$customer['last_name'];?>
                                            </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:default;" class="tdlink">
											<?php echo $customer['email'];?>
                                            </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:default;" class="tdlink">
											<?php echo $customer['phone'];?>
                                            </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/customers/details/<?php echo $customer['member_id'];?>" style="cursor:default;" class="tdlink">
											<?php echo  date("M d, Y h:i A ", strtotime ($customer['created_date']));?>
                                            </td>
                                            
                                            <td>
                                            	<a class="" data-id="<?php echo $customer['member_id'];?>" data-block="<?php echo $customer['status'];?>" id="block_<?php echo $customer['member_id']; ?>" href="javascript: void(0)">
                                                <label class="switch">
                                                	 	 
                                                    <input type="checkbox" <?php if($customer['status'] == 'N'){ ?> checked <?php } ?>>
                                                    
                                                    <span data-off="No" data-on="Yes" class="switch-label"></span> <span class="switch-handle"></span>
                                                </label></a>
                                            </td>
                                            <?php $role=$this->session->userdata('user')->role;
				  							if($role==2){?>
                                           <!-- <td>
                                            
                                            <a href="javascript:void(0)" class="delCustomer"  data-attr="<?php echo $customer['member_id'];?>"><i class="fa fa-trash-o"></i> Delete</a>
                                            </td>-->
                                            <?php }$i++; ?>
                                        </tr>
                                        <?php 	
										}
										}else{?>
                                        <tr>
                                        	<td colspan="6">No Customers ... </td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Customers Table -->

 							<?php if(count($customerdetails)!=0){?>
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
                            
                             <?php } ?>
                        </div>
                        <!-- End Customers -->
                    </div>
                    <!-- End Tab panes -->
                </div>
                <!-- End Tabs -->
            </div>
        </section>
        
  </form>         
        
        
        
    
        <!-- Export Modal -->
        <div class="edit-cat modal fade" id="export-modal" tabindex="-1" role="dialog" aria-labelledby="export-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Export Customer Detail</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Edit Caegory Form -->
                    <form name="form-sales" method="post" action="<?php echo base_url().$this->user->root;?>/customers/export">
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <select name='feilds[]' size=4 multiple id="feilds" >
                                <option value='customer_name' selected="selected">Customer Name</option>
                                <option value='email' selected="selected">E-mail</option>
                                <option value='phone' selected="selected">Phone</option>
                             </select>
                            <!--<select>
                                <option selected disabled>-- Select Column --</option>
                                <option>Customer Name</option>
                                <option>Email</option>
                                <option>Phone Number</option>
                            </select>-->
                        </div>
                        <!-- End Modal Body -->
                        <input type="hidden" value="<?php echo $_POST['limit'];?>" name="limit" />
                		<input type="hidden" value="<?php echo $_POST['per_page'];?>" name="per_page" />
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<input type="submit" value="Export">
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<button aria-label="Close" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Footer -->
                    </form>
                    <!-- End Edit Caegory Form -->
                </div>
            </div>
        </div>
        <!-- End Export Modal -->       

        <!-- Customer Delete Modal -->
        <div class="cat-delete modal fade" id="cat-delete" tabindex="-1" role="dialog" aria-labelledby="cat-delete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Customer</h6>
                    </div>
                    <!-- End Modal Header -->
                    <input type="hidden" value="" id="delcustID"  />
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete.?</p>
                    </div>
                    <!-- End Modal Body -->
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9 display-ful-480">
                                <button aria-label="Close" data-dismiss="modal"  onclick="delCustomer()">Ok</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>
        <!-- End Customer Delete Modal -->
         
     
<script>   
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});
	
	
	$('body').on('click', '.delCustomer', function (e) {
		var custID	=$(this).attr("data-attr");
		$('#delcustID').val(custID);
		$("#cat-delete").modal('show');
		
	});
	
	function delCustomer(){
	
	
		var delcustID	=$('#delcustID').val();
					$.ajax({
						type:"post",
						url:"<?php echo base_url();?>admin/customers/delete/"+delcustID,
						data:{'item_id':delcustID},
						success:function(data){
							//$('.alert-success').show();
							//$('.alert-success').html('Dish item deleted sucessfully');
							
							setTimeout(function(){
								$('.saving').show().html("Dish item deleted sucessfully");
								$('.saving').fadeOut(5000);
							}, 100);
														
							$("#cat-delete").modal('hide');						
							$('#row_'+delcustID).remove();
							
							return true;
						}
					});
	}
	
	
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
