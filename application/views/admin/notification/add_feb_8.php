<section class="profile">
        	<div class="container">
            	<!-- Profile Container -->
                <div class="profile-container custome-message">
                	<!-- Custome Message Form -->
					<form class="form-horizontal" role="form"  method="post" name="formlist"  id="formlist" action="<?php echo base_url()?>index.php/admin/notification/add">
                        <div class="basic-details">
                            <div class="user-credential">
                                <h1>Message Details</h1>
                                <textarea class="additem" name="message" id="message" placeholder="Message"  ><?=(isset($details['message']))?$details['message']:''?></textarea>
                                <div class="row" style="margin-top:40px;">
                                    <div class="col-lg-6 col-md-6 col-sm-4">
                                    	<div class="toggle-switch">
                                        	<p>Show / Hide</p>
                                            <label class="switch">
                                                <input type="checkbox"  <?php if($details['status']!='N'){ ?> checked="true" <?php } ?> name="status" >
                                                <span data-off="Hide" data-on="Show" class="switch-label"></span> <span class="switch-handle"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-8">
                                        <div class="profile-form-btns">
                                            <input type="button" class="redSave" id="submit_btn" name="submit_btn" value="Save" />
                                            <button type="button"  onclick="location.href='<?php echo base_url()?>index.php/admin/home'">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value=" <?php echo($this->session->userdata('user')->restaurant_id);?>"  id="restaurant_id" name="restaurant_id"/>
                        <input type="hidden" value="<?php echo $details['id'];?>"  id="id" name="id"/> 
                        
                    </form>
                    <!-- End Custome Message Form -->
                    
                	<!-- Custome Message Form -->
					<form class="cm2" role="form"  method="post" name="formlist" action="<?php echo base_url()?>index.php/admin/notification/sendPush">
                        <div class="basic-details">
                            <div class="user-credential">
                                <h1>Instant Notification</h1>
                                <textarea class="form-control additem" name="instantMsg" id="instantMsg" placeholder="Message"  ></textarea>
                                <div class="profile-form-btns">
                                     <input type="submit" value="Send">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End Custome Message Form -->
                </div>
                <!-- End Profile Container -->
            </div>
        </section>


<link href="<?php echo base_url() ?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>



    

<script>
$('#submit_btn').click(function(){
	
	//var title=$('#title').val();
	var message=$('#message').val();
	
	var flag=1;
	$('.fileldtheme').removeClass('errorborder');
	/*if(title==''){
		$('#title').addClass('errorborder');
		flag=0;
	}*/
	if(message==''){
		$('#message').addClass('errorborder');
		flag=0;
	}
	
	
	if(flag==0){
		return false;
	}else{
		$('#formlist').submit();
	}
	
	//$('#formlist').submit();
});
</script>