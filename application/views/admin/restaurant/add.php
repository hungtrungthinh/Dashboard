
<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>
<!-- <script for color picker-->
<script type="text/javascript" src="<?php echo base_url() ?>assets/jscolor/jscolor.js"></script>
 <div class="container"> 
	 <div class="clearfix" style="padding-top:15px;"></div>
     	<div class="col-lg-12">
	      <legend>Restaurant Details</legend>
		</div> 
	 
    <div class="col-md-12" style="padding-bottom:10px;">
		<form class="form-horizontal" role="form" action="<?php echo base_url()?>index.php/admin/restaurant/add" method="post" name="formlist" onsubmit="" id="formlist">
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4 " for="textinput">Name</label>
				 <div class="col-sm-6">
                 <input type="text" name="name" value=""  placeholder="Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter your name" >
		         </div>
           </div>
		   <!-- Text input-->
 		   <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Contact Number</label>
            	<div class="col-sm-6">
             	<input type="text" name="phone" value="" placeholder="Contact Number" class="form-control fileldtheme js-placeholder" >
                <p>
                <small><i>Head Office Contact Number</i></small>
                </p>
                </div>
          </div>	    
          <!-- Text input--> 
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Address</label>
            	<div class="col-sm-6">
             	<input type="text" name="address" value="" placeholder="Address" class="form-control fileldtheme js-placeholder" >
                <p>
                <small><i>Head Office Address</i></small>
                </p>
	            </div>
         </div>
         
         <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Google Api Key</label>
            	<div class="col-sm-6">
             	<input type="text" name="google_api_key" value="" placeholder="Google Api Key" class="form-control fileldtheme js-placeholder" >
                <p>
                <small><i>Google Api Key</i></small>
                </p>
	            </div>
         </div>
         
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Restaurant Facebook Link</label>
            	<div class="col-sm-6">
             	<input type="text" name="restaurant_fb_link" value="<?php echo $reataurantdetails['restaurant_fb_link'];?>" placeholder="Restaurant Facebook Link" class="form-control fileldtheme js-placeholder" >
                <p>
                <small><i>Restaurant Facebook Link</i></small>
                </p>
	            </div>
         </div>
         
         <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Location Limit</label>
            	<div class="col-sm-6">
             	<input type="text" name="loc_limit" value="<?php echo $reataurantdetails['loc_limit'];?>" placeholder="Limit" class="form-control fileldtheme js-placeholder" >
                <p>
                <small><i>Location creation limit</i></small>
                </p>
	            </div>
         </div>
         
         
      <div class="col-lg-12">
	  </div>     
     <div class="col-lg-12">
	     <legend>Manager Details</legend>
	</div> 
	     <div class="clearfix">&nbsp;</div>
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">Name</label>
            <div class="col-sm-6">
              <input type="text" name="managername" value="" placeholder="Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter Restaurant Manager Name" >
		
			</div>
        </div>
 		<!-- Text input-->   
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">User Name</label>
            <div class="col-sm-6">
              <input type="text" name="username" id="username" placeholder="User Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter User Name" >
             
              <p id="error" class="text-danger"></p>
		
			</div>
        </div>
 		<!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">Password</label>
            <div class="col-sm-6">
            <input type="password" name="password" value="" placeholder="Password" class="form-control fileldtheme js-placeholder" data-bvalidator="minlength[6],required" data-bvalidator-msg="Passord require minimum 6 characters"  id="password">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">Confirm Password</label>
            <div class="col-sm-6">
            <input type="password" name="confirmpassword" value="" placeholder="Confirm Password" class="form-control fileldtheme js-placeholder" data-bvalidator="equalto[password],required" data-bvalidator-msg="Please enter the same value again" >
            </div>
       </div>
       <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-4 " for="textinput">Email</label>
            <div class="col-sm-6">
            <input type="text" name="email" value="" placeholder="Email" class="form-control fileldtheme js-placeholder" data-bvalidator="email,required" data-bvalidator-msg="Please enter valid email id"  >
            </div>
	  </div>
      
<!--	   <div class="form-group">
          <label class="col-sm-4 " for="textinput">Header color:</label>
          <div class="col-sm-2"> 
          <input class="color form-control" value="<?php echo $reataurantdetails['header_color'];?>" name="header_color">
          </div>
          </div>
          
          <div class="form-group">
         <label class="col-sm-4 " for="textinput">Body color: </label>
          <div class="col-sm-2"> 
          <input class="color form-control" value="<?php echo $reataurantdetails['body_color'];?>" name="body_color">
          </div>
          </div>-->
          
          
       <button type="submit" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/restaurant/lists'">Cancel</button>
      <button type="submit" class="btn btn-info pull-right" name="submit_btn" id="submit_btn" style="margin-right:10px;">Save</button>
     
     
        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->	
	</div><!-- /.row -->
        
</div><!-- /.container -->


<script>

		$(document).ready(function(){
	
			
			var options = {
				singleError: true,
				showCloseIcon: false,					
			};
			$var=$("#formlist").bValidator(options);
			
		});
		
		
		 
	 $("#username").blur(function(){
	    var username=$("#username").val();
		if(username!=''){
			 $.ajax({
			type: "POST",
			url: "<?php echo base_url()?>index.php/admin/restaurant/check",
			data: {username:username},
			success: function(data) {
				if((data)>0)
				{
				$("#error").text("User Name Already Exist!!!");
				$("#error").show();
				}
				else
				{
				$("#error").hide();
				}
			}
	
			}); 
			}    
			else
			{
				$("#error").hide();
			}     
		})
</script>
	

<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
</style>