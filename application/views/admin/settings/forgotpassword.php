<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>

<div class="modal-dialog cust_dilog">
    <div class="modal-content ">
      <div class="modal-header" style="background-color:#DF7707 ;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <div id="MainMenu">
		  <div class="list-group panel">
                <form class="form-horizontal" role="form" action="" method="post" name="forgotpassword" onsubmit="" id="forgotpassword">
                <span id="sucessmsg" class="text-success"></span>
		   			<!-- Text input-->
 		  			 <div class="form-group">
            			<label class="col-sm-4 control-label" for="textinput">Enter Your Email Id</label>
            				<div class="col-sm-8">
                                <input type="text" id="new" value="" placeholder="Email Id" class="form-control fileldtheme js-placeholder" >
               		         </div>
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
			var email=$('#new').val();
			
			if((email!='')){
			
				$.ajax({
					type:"post",
					url:"<?php echo base_url(); ?>admin/login/forgotpwd",
					data:{'email':email},
					
					success:function(data){alert(data);return false;
					if(data=="success"){
					$( "#sucessmsg" ).html( "Password Sucessfully Changed ..." );
					//setTimeout($( "#sucessmsg" ).html( "Password Sucessfully Changed ..." ), 1000);
					setTimeout(function() {  $( ".close" ).trigger( "click" ); }, 2000);
				   
						}
					
						
						}
				});
			}
			
			
	
			
			else
			{
			alert("Please enter valid email id");
			}
			
		})
</script>