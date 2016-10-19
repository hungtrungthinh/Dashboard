<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>

<div class="modal-dialog cust_dilog">
    <div class="modal-content ">
      <div class="modal-header" style="background-color:#DF7707 ;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        <div id="MainMenu">
		  <div class="list-group panel">
                <form class="form-horizontal" role="form" action="" method="post" name="change" onsubmit="" id="change">
                <span id="sucessmsg" class="text-success"></span>
		   			<!-- Text input-->
 		  			 <div class="form-group">
            			<label class="col-sm-4 control-label" for="textinput">New Passsword</label>
            				<div class="col-sm-8">
                                <input type="text" id="new" value="" placeholder="New Passsword" class="form-control fileldtheme js-placeholder" >
               		         </div>
          			</div>	    
        			<!-- Text input-->
 		  			<div class="form-group">
            			<label class="col-sm-4 control-label" for="textinput">Confirm Password</label>
            				<div class="col-sm-8">
             					<input type="text" id="confirmnew" value="" placeholder="Confirm Password" class="form-control fileldtheme js-placeholder" >
                			</div>
                            <input type="hidden" value="<?php $admin_id;?>" id="admin_id" />
          			</div>
                 <button type="button" class="btn btn-default pull-right " data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</span></button>  
                <button type="button" class="btn btn-info pull-right" name="pwd_btn"  id="pwd_btn" onclick="">Save</button>
			   
                </form>
		  </div>
		</div>
      </div>

    </div>
  </div>
<script>

		 $("#pwd_btn").click(function(){
			var new_pwd=$('#new').val();
			var confirm_pwd=$('#confirmnew').val(); 
			var admin_id=$('#admin_id').val();
			if((new_pwd.length!=6)&&(confirm_pwd.length!=6)){
			alert("Passord require minimum 6 characters");
			}
			if((new_pwd!='')&&(confirm_pwd!='')&&(new_pwd==confirm_pwd)){ 
			
				$.ajax({
					type:"post",
					url:"<?php echo base_url(); ?>admin/restaurant/changepwd",
					data:{'new_pwd':new_pwd,'admin_id':admin_id},
					success:function(data){
					if(data=="success"){
					$( "#sucessmsg" ).html( "Password Sucessfully Changed ..." );
					//setTimeout($( "#sucessmsg" ).html( "Password Sucessfully Changed ..." ), 1000);
					setTimeout(function() {  $( ".close" ).trigger( "click" ); }, 2000);
				   
					}
					else
					{
					alert("Password not Updated");
					}
						
						
						}
				});
			}
			else{
			 alert("Password and Confirm Password should be same !!");   
			 }
		})
</script>