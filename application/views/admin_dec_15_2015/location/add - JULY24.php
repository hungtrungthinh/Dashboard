
<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>

 <div class="container"> 
	 <div class="clearfix">&nbsp;</div>
     	<div class="col-lg-12">
	      <legend> Basic Details</legend>
		</div> 
	 
    <div class="col-md-12">
		<form class="form-horizontal" role="form" action="" method="post" name="formlist" onsubmit="<?php echo base_url()?>index.php/admin/location/add" id="formlist">
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-2 control-label" for="textinput">Name</label>
				 <div class="col-sm-10">
                 <input type="text" name="name" value="<?=(isset($result['restaurant_name']))?$result['restaurant_name']:''?>"  placeholder="Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter  name" >
		         </div>
           </div>
		   
          <div class="form-group">
           		<label class="col-sm-2 control-label" for="textinput">Address</label>
            	<div class="col-sm-10">
             	<input type="text" name="address" value="<?=(isset($result['address']))?$result['address']:''?>" placeholder="Address" class="form-control fileldtheme js-placeholder" >
                <p>
                <small>Head Office Address</small>
                </p>
	            </div>
         </div>
         <!-- Text input-->
 		 <div class="form-group">
            	<label class="col-sm-2 control-label" for="textinput">Contact Number</label>
            	<div class="col-sm-10">
             	<input type="text" name="phone" value="<?=(isset($result['phone']))?$result['phone']:''?>" placeholder="Contact Number" class="form-control fileldtheme js-placeholder" >
                <p>
                <small>Head Office Contact Number</small>
                </p>
                </div>
         </div>	    
         <!-- Text input-->
 		 <div class="form-group">
            	<label class="col-sm-2 control-label" for="textinput">Type</label>
            	<div class="col-sm-10">
             	<select name="type" id="type" class="form-control" >
                    <option value="" selected="selected">Select</option>
                    <option value="pickup" name="pickup">Pickup</option>
                    <option value="delivery" name="delivery">Delivery</option>
                     <option value="both" name="both">Both</option>
			    </select>
                </div>
         </div>	    
         <!-- Text input--> 
      <div class="col-lg-12">
	  </div>     
     <div class="col-lg-12">
	     <legend>User Credential</legend>
	</div> 
	     <div class="clearfix">&nbsp;</div>
      <?php if($result['username']!=''){?>
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">User Name</label>
            <div class="col-sm-10">
              <input type="text" name="username" readonly="readonly" id="username" value="<?=(isset($result['username']))?$result['username']:''?>" placeholder="User Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter User Name" >
             
              <p id="error" class="text-danger"></p>
		
			</div>
        </div>
 		<!-- Text input-->
        <?php } else{ ?>
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">User Name</label>
            <div class="col-sm-10">
              <input type="text" name="username" value="<?=(isset($result['username']))?$result['username']:''?>" id="username" placeholder="User Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter User Name" >
             
              <p id="error" class="text-danger"></p>
		
			</div>
        </div>
 		<!-- Text input--> 
        <?php }?>
         <?php if($result['password']!=''){?>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Password</label>
            <div class="col-sm-10">
            <strong> ********** </strong>  <a href="javascript:void(0);" class="txt_link" id="change_link" ><span class="mr_2" data-toggle="modal" data-target="#myModal"  data-backdrop="static">Change</span></a>
            </div>
        </div>
        <?php } else{ ?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Password</label>
            <div class="col-sm-10">
            <input type="password" name="password" value="<?=(isset($result['password']))?$result['password']:''?>" placeholder="Password" class="form-control fileldtheme js-placeholder" data-bvalidator="minlength[6],required" data-bvalidator-msg="Passord require minimum 6 characters"  id="password">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Confirm Password</label>
            <div class="col-sm-10">
            <input type="password" name="confirmpassword" value="<?=(isset($result['password']))?$result['password']:''?>" placeholder="Confirm Password" class="form-control fileldtheme js-placeholder" data-bvalidator="equalto[password],required" data-bvalidator-msg="Please enter the same value again" >
            </div>
       </div>
       <!-- Text input-->
        
       <?php }?>
       <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Email</label>
            <div class="col-sm-10">
            <input type="text" name="email" value="<?=(isset($result['email']))?$result['email']:''?>" placeholder="Email" class="form-control fileldtheme js-placeholder" data-bvalidator="email,required" data-bvalidator-msg="Please enter valid email id"  >
            </div>
	  </div>
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Name</label>
            <div class="col-sm-10">
              <input type="text" name="chefname" value="<?=(isset($result['full_name']))?$result['full_name']:''?>" placeholder="Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter Chef Name" >
		
			</div>
        </div>
 		<!-- Text input-->   
      <input type="hidden" value="<?=(isset($result['restaurant_id']))?$result['restaurant_id']:''?>" />
       <button type="submit" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/restaurant/lists'">Cancel</button>
      <button type="submit" class="btn btn-info pull-right" name="submit_btn" id="submit_btn">Save</button>
     
     
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
	


