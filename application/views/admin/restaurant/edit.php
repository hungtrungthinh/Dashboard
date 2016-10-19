<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>
<!-- <script for color picker-->
<script type="text/javascript" src="<?php echo base_url() ?>assets/jscolor/jscolor.js"></script>
	<div class="container"> 
		<div class="clearfix">&nbsp;</div>
			<div class="col-lg-12">
				<legend>Restaurant Details </legend>
			</div> 
	<div class="col-md-12" style="padding-bottom:15px;">
		<form class="form-horizontal" role="form" action="<?php echo base_url()?>index.php/admin/restaurant/edit" method="post" name="formlist" onsubmit="" id="formlist">
        	
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4 " for="textinput">Name</label>
				 <div class="col-sm-6">
                 <input type="text" name="name" value="<?php echo $reataurantdetails['name'];?>"  placeholder="Name" class="form-control fileldtheme js-placeholder" >
		         </div>
           </div>
		   <!-- Text input-->
 		   <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Contact Number</label>
            	<div class="col-sm-6">
             	<input type="text" name="phone" value="<?php echo $reataurantdetails['phone'];?>" placeholder="Contact Number" class="form-control fileldtheme js-placeholder" ><small><i>Head Office Contact Number</i></small>
               
                </div>
          </div>	    
          <!-- Text input--> 
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Address</label>
            	<div class="col-sm-6">
             	<input type="text" name="address" value="<?php echo $reataurantdetails['address'];?>" placeholder="Address" class="form-control fileldtheme js-placeholder"  ><small><i>Head Office Address</i></small>
                
	            </div>
         </div>
         
         <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Google Api Key</label>
            	<div class="col-sm-6">
             	<input type="text" name="google_api_key" value="<?php echo $reataurantdetails['google_api_key'];?>" placeholder="Google Api Key" class="form-control fileldtheme js-placeholder" >
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
          <div class="form-group">
              <label class="col-sm-4 " for="textinput">Forkourse Stripe Percentage</label>
              <div class="col-sm-6">
              <input type="text" name="forkourse_stripe_percentage" value="<?php echo $reataurantdetails['forkourse_stripe_percentage'];?>" placeholder="Forkourse Stripe Percentage" class="form-control fileldtheme js-placeholder" >
                <p>
                <small><i>Forkourse Stripe Percentage</i></small>
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
              <input type="text" name="managername" value="<?php echo $reataurantdetails['full_name'];?>" placeholder="Name" class="form-control fileldtheme js-placeholder"  >
		
			</div>
        </div>
 		<!-- Text input-->   
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">User Name</label>
            <div class="col-sm-6">
              <input type="text" readonly name="username" id="username" placeholder="User Name" value="<?php echo $reataurantdetails['username'];?>" class="form-control fileldtheme js-placeholder" >
             
	    </div>
        </div>
 		<!-- Text input-->
        <div class="form-group">
         	<?php if($reataurantdetails['password']){?>
            <label class="col-sm-4" for="textinput">Password</label>
            <div class="col-sm-6">
            <strong> ********** </strong>  <a href="javascript:void(0);" class="txt_link" id="change_link" ><span class="mr_2" data-toggle="modal" data-target="#myModal"  data-backdrop="static">Change</span></a>
            </div>
            <?php }?>
        </div>
        
       <div class="form-group">
            <label class="col-sm-4 " for="textinput">Email</label>
            <div class="col-sm-6">
            <input type="text" name="email" value="<?php echo $reataurantdetails['email'];?>" placeholder="Email" class="form-control fileldtheme js-placeholder">
            </div>
	  </div>
     	 <input type="hidden" name="restaurant_id" value="<?php echo $reataurantdetails['restaurant_id'];?>" id="restaurant_id">
         <input type="hidden" name="admin_id" value="<?php echo $reataurantdetails['admin_id'];?>" id="admin_id">
       
	<!--  <div class="form-group">
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
       
       <button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/restaurant/lists'">Cancel</button>
      <button type="submit" class="btn btn-info pull-right" name="submit_btn" id="submit_btn"  style="margin-right:10px;">UPDATE</button>
     
     
        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
  </div><!-- /.row -->
</div><!-- /.container -->


	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  
	 </div>

	<script>

	$(document).ready(function(){

		
		var options = {
			singleError: true,
       		showCloseIcon: false,					
		};
		$var=$("#formlist").bValidator(options);
		
	});
	
  $("#change_link").click(function(){
		   var admin_id=$('#admin_id').val();
			$("#myModal").html("");
			$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>admin/restaurant/change",
			data:{'admin_id':admin_id},
			success:function(data){
				$("#myModal").html(data);
				//alert(data);
				}
			});
			   
			    
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