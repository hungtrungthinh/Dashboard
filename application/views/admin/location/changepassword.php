<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>
 <div class="modal-dialog cust_dilog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" class="close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Change password</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Change Password Form -->
                    <form  role="form" action="" method="post" name="change" onsubmit="" id="change">
                        <!-- Modal Body -->
                        <div class="" id="status" style="margin:15px"></div>
                        <div class="modal-body">
                            <label>
                                <div class="check-match">
                                </div>
                                <input type="password" placeholder="New Password" id="txtNewPassword" required />
                            </label>
                            <label>
                                <div class="check-match">
                                </div>
                                <input type="password" placeholder="Re-enter new Password" id="txtConfirmPassword" onChange="checkPasswordMatch();" required />
                            </label>
                        </div>
                        <input type="hidden" value="<?php $admin_id;?>" id="admin_id" />
                        <!-- End Modal Body -->
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<input type="submit" value="Save" name="pwd_btn"  id="pwd_btn" onclick="">
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<button  data-dismiss="modal" aria-label="Close" >Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Footer -->
                    </form>
                    <!-- End Change Password Form -->
                </div>
            </div>
            
            

<script>

		 $("#pwd_btn").click(function(event){
		 
		 	  event.preventDefault();
			var new_pwd=$('#txtNewPassword').val();
			var confirm_pwd=$('#txtConfirmPassword').val(); 
			var admin_id=$('#admin_id').val();
			$('#status').html("");
			$('#status').attr("class","");
			
			if(new_pwd.length<6){
				$('#status').html("Password need minimum 6 characters");
				$("#status").addClass("alert");
				$("#status").addClass("alert-danger");
			}
			else if(new_pwd!=confirm_pwd){
			
			}
			else if((new_pwd!='')&&(confirm_pwd!='')&&(new_pwd==confirm_pwd)){ 
			
				$.ajax({
					type:"post",
					url:"<?php echo base_url(); ?>admin/profile/changepwd",
					data:{'new_pwd':new_pwd,'admin_id':admin_id},
					
					success:function(data){
					if(data=="success"){
					$('#status').html("Password sucessfully changed ...");
					$("#status").addClass("alert");
					$("#status").addClass("alert-success");
					//setTimeout($( "#sucessmsg" ).html( "Password Sucessfully Changed ..." ), 1000);
					setTimeout(function() {  $( ".close" ).trigger( "click" ); }, 2000);
				   
					}
					else
					{
					$('#status').html("Password not updated successfully!");
					$("#status").addClass("alert");
					$("#status").addClass("alert-danger");
					}
						
						
						}
				});
			}
		})
</script>