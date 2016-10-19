<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
</style>
<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>

 <div class="container"> 
	 <div class="clearfix" style="padding-top:15px;"></div>
      <?php	if($error=='') { ?>
     	<div class="col-lg-12">
	      <legend> Customer Details</legend>
		</div> 
	 <div class="col-md-12">
		<form class="form-horizontal" role="form" action="<?php echo base_url()?>index.php/admin/customers/edit/<?php echo $result['member_id']; ?>" method="post" name="formlist" onsubmit="<?php echo base_url()?>index.php/admin/customers/edit/<?php echo $result['member_id']; ?>" id="formlist">
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4" for="textinput">First Name</label>
				 <div class="col-sm-6">
                	<!-- <input type="text" name="first_name" value="<?=(isset($result['first_name']))?$result['first_name']:''?>"  placeholder="First Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter  Firstname" >-->
                     <span><?=(isset($result['first_name']))?$result['first_name']:''?></span>
		         </div>
           </div>
		   <!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4" for="textinput">Last Name</label>
				 <div class="col-sm-6">
                	<!-- <input type="text" name="last_name" value="<?=(isset($result['last_name']))?$result['last_name']:''?>"  placeholder="Last Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter  Lastname" >-->
                     <span><?=(isset($result['last_name']))?$result['last_name']:''?></span>
		         </div>
           </div>
          
          <!-- label input-->
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Email</label>
            	<div class="col-sm-6">
             		<span><?=(isset($result['email']))?$result['email']:''?></span>
				</div>
         </div>
     
          <!-- label input-->
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Phone Number</label>
            	<div class="col-sm-6">
             		<span><?=(isset($result['phone']))?$result['phone']:''?></span>
				</div>
          </div>
          <!-- label input-->
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Join Date</label>
            	<div class="col-sm-6">
                <?php $date= date("M d, Y h:i A ", strtotime ($result['created_date'])); ?>
             		<span> <?=(isset($date))?$date:''?></span>
				</div>
          </div>

      <div class="col-sm-10">  
          <input type="hidden" value="<?=(isset($result['member_id']))?$result['member_id']:''?>" id="member_id" />
         <!-- <button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/customers/lists'">Cancel</button>
          <button type="submit" class="btn btn-info pull-right" name="submit_btn" id="submit_btn" >Save</button>-->
       </div>  
     
        </fieldset>
      </form>
      
    </div><!-- /.col-lg-12 -->	
      <?php }else{ ?>
	  		
			<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
	  
	  <?php } ?>
    <div>&nbsp;</div>
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
			
</script>
	


