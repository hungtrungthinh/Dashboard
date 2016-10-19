<section class="profile">
        	<div class="container">
            	<!-- Profile Container -->
                <div class="profile-container man-profile">
                	<!-- Profile Form -->
                	<form class="form-horizontal" role="form" action="<?php echo base_url()?>index.php/admin/profile/edit_manager" method="post" name="formlist" onsubmit="" id="formlist">
                        <!-- Basic Detail -->
                        <div class="basic-details">
                            <h1>Restaurant Details</h1>
                            <input type="text" name="name" value="<?php echo $profiledetails['name'];?>"  placeholder="Name" class="" >
                            <input type="text" name="phone" value="<?php echo $profiledetails['phone'];?>" placeholder="Contact Number" class="" >
                            <input type="text" name="address" value="<?php echo $profiledetails['address'];?>" placeholder="Address" class=""  >
                            
                            <div class="pro-logo-area">
                            	<div class="row">
                                	 <?php if($profiledetails['logo']!=''){ ?>
                                         <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 display-ful">
                                            <div class="logo-upload">
                                                <label>
                                                    <span class="browse_btn">Choose File</span>
                                                    <input id="fileToUpload" type="file" multiple name="fileToUpload"/>
                                                    <input type="hidden" id="uploadFile" placeholder="No file selected." disabled="disabled" />
                                                    
                                                    
                                                    
                                                </label>
                                                <em>The maximum file limit is 5 MB.</em><br />
                                                <em>The dimension is 300*140.</em>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 display-ful">
                                            <div class="ad-logo-img" id="imgUp">
                                                <a style="color:#000000;" href="<?php echo base_url().'assets/images/profile/'.$profiledetails['logo'];?>"></a>
                                                <img src="<?php echo base_url().'assets/images/profile/'.$profiledetails['logo'].'?'.time();?>"/>
                                            </div>
                                            <div id="imagediv" class="library_img ui-draggable" style="margin-top:5px; position:relative; z-index:3;">
                                                <input id="<?php echo $imdata;?>" type="hidden" name="imgsrc[]" value="<?php echo $imdata;?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-4 display-ful">
                                            <div class="logo-remove">
                                                <p>
                                               
                                                <a href="javascript:void(0);" class="remove_imagetemp" style="margin-left:15px;color:#000000;" rel="<?php echo  $profiledetails['logo']?>" ><i class="fa fa-times"></i> Remove<img class="hide" id="loading"/></a></p>
                                            </div>
                                        </div>
                                        
                                  
                                    <?php } else{ ?>
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 display-ful">
                                            <div class="logo-upload">
                                                <label>
                                                    <span class="browse_btn">Choose File</span>
                                                    <input id="fileToUpload" type="file" multiple name="fileToUpload">	
                                                    <input type="hidden" id="uploadFile" placeholder="No file selected." disabled="disabled" />
                                                    
                                            
                                                </label>
                                                <em>The maximum file limit is 5 MB.</em>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 display-ful">
                                            <div class="ad-logo-img">
                                                <div id="imagediv" class="library_img ui-draggable" style="margin-top:5px; position:relative; z-index:3;">
                                                    	<input id="<?php echo $imdata;?>" type="hidden" name="imgsrc[]" value="<?php echo $imdata;?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    
									<?php } ?>      
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Basic Detail -->
                        
                        <!-- User Credential -->
                        <div class="user-credential">
                            <h1>Manager Details</h1>
                            
                             <input type="text" name="managername" value="<?php echo $profiledetails['full_name'];?>" placeholder="Name" class=""  >
                             <input type="text" readonly name="username" id="username" placeholder="User Name" value="<?php echo $profiledetails['username'];?>" class="" >
                             <input type="text" name="email" value="<?php echo $profiledetails['email'];?>" placeholder="Email" class="">
                            <label>
                            
                            	<input type="text" placeholder="Password"  value="**********"/>
                                <a href="#" data-toggle="modal" data-target="#myModal">Change password?</a>
                            </label>
                        </div>
                        <!-- End User Credential -->
                        <input type="hidden" name="restaurant_id" value="<?php echo $profiledetails['restaurant_id'];?>" id="restaurant_id">
        				<input type="hidden" name="admin_id" value="<?php echo $profiledetails['admin_id'];?>" id="admin_id">
                        <!-- Form Buttons -->
                        <div class="profile-form-btns">
                        	<input type="submit" value="Update" />
                            <button onclick="location.href='<?php echo base_url(); ?>manager/home'" type="button">Cancel</button>
                        </div>
                        <!-- End Form Buttons -->
                    </form>
                    <!-- End Profile Form -->
                </div>
                <!-- End Profile Container -->
            </div>
        </section>
        
        
<div class="change-pass modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Change password</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Change Password Form -->
                    <form class="form-horizontal" role="form" action="" method="post" name="change" onsubmit="" id="change">
                        <!-- Modal Body -->
                        <div class="modal-body">
                        	<label>
                            	<input type="password" placeholder="Current Password" id="curpassword" required />
                            </label>
                            <label>
                                <div class="check-match">
                                </div>
                                <input type="password" id="txtNewPassword" value="" placeholder="New Passsword" class="" required >
                            </label>
                            <label>
                                <div class="check-match">
                                </div>
                                <input type="password" placeholder="Re-enter new Password" id="txtConfirmPassword" onChange="checkPasswordMatch();" required />
                            </label>
                        </div>
                        <!-- End Modal Body -->
                        <input type="hidden" name="admin_id" value="<?php echo $profiledetails['admin_id'];?>" id="admin_id">
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		 <button type="button" class="btn btn-info redSaveMax"  name="pwd_btn"  id="pwd_btn" onclick="">Save</button>
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<button aria-label="Close" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Footer -->
                    </form>
                    <!-- End Change Password Form -->
                </div>
            </div>
        </div>
        
        
        
        <link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/js/fileupload/jquery.blockUI.js" ?>"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
//Multiple File upload	
jQuery("#fileToUpload").change(function(){
	   var allowed_ext = ["jpg","jpeg","png","gif"];
	   var restaurant_id=jQuery('#restaurant_id').val();
	
	 jQuery.each(this.files,function(index,value){
				 var fileExtension = "";
				var file = value;
			
				if (file) {
			
					if (file.name.lastIndexOf(".") > 0) {
						fileExtension = file.name.substring(file.name.lastIndexOf(".") + 1, file.name.length);
					}
					if (jQuery.inArray(fileExtension, allowed_ext) == -1) {
						alert("Allowed File formats are jpg,gif,png Only");
			            return false;
						
					}
					var fd = new FormData();
					fd.append('file',file);
					fd.append('form_key', window.FORM_KEY);
					var xhr = new XMLHttpRequest();
					xhr.upload.addEventListener("progress", uploadProgress, false);
					xhr.addEventListener("load", uploadComplete, false);
					xhr.addEventListener("error", uploadFailed, false);
					xhr.addEventListener("abort", uploadCanceled, false);
					jQuery.blockUI();
					xhr.open("POST","<?php echo base_url()?>admin/profile/uploadLogo/"+restaurant_id);
					xhr.setRequestHeader("Cache-Control", "no-cache");
					xhr.send(fd);
			
				 }
				 
					
			});
		
	});


	function uploadProgress(evt) {
			if (evt.lengthComputable) {
			  var percentComplete = Math.round(evt.loaded * 100 / evt.total);
			  jQuery('div#percent_div #sp_div').css("width", percentComplete.toString() + '%');
			  jQuery('div#percent_div #sp_div').html(percentComplete.toString() + '%');
			 
			}
			else {
			  document.getElementById('progressNumber').innerHTML = 'unable to compute';
			}
	}
	
	
	function uploadComplete(evt) {
	
	
	//$("#pdfname").show();
	jQuery.unblockUI();
	/* This event is raised when the server send back a response */
	jQuery("#fileToUpload").val("");
	jQuery('div#percent_div #sp_div').css("width", '0%');
	jQuery('div#percent_div #sp_div').html("");
	
	//if(evt.target.responseText == "error");
	 //alert(evt.target.responseText);
	 
	 	var img = $('<img id="dynamic" style="height: 60px;margin:0px 15px 15px 19px; ">'); //Equivalent: $(document.createElement('img'))
		var hid=$('<input type=hidden id=imgsrc name=imgsrc[] >');
		var rem=$('<a href="javascript:void(0);" class="remove_imagetemp" style="margin-left:15px;color:#000000;" >Remove<img class="hide" id="loading"/></a>');
		//var pdfname=$('<img title="Upload Image" width="25px" style="" height="25px" src="<?php echo base_url().'assets/images/profile/'?>" id="imagediv">      '); 
		var imgname=evt.target.responseText.substr(evt.target.responseText.lastIndexOf('/') + 1);
		//alert(evt.target.responseText.lastIndexOf(substring[, startindex]));
		if(evt.target.responseText=="image is to big")
		{
		alert("Maximum Allowed File size is 1500*1500");
		}
		else{
		img.attr('src',evt.target.responseText);
		
		hid.attr('value', imgname);
		hid.attr('id', imgname);
		rem.attr('rel', imgname);
		img.appendTo('#imagediv');
		rem.appendTo('#imagediv');
		hid.appendTo('#imagediv');
		//pdfname.appendTo('#imagediv');	
		//$("#pdfname").html(imgname);			
		$(".div_details_in_l").hide();
		//$(".file-wrapper").hide();
		}
	
		
		
	}
	
	
	 
	 
		function uploadFailed(evt) {
		alert("There was an error attempting to upload the file.");
		 
		}
		
		function uploadCanceled(evt) {
		alert("The upload has been canceled by the user or the browser dropped the connection.");
		 
		}
//Multiple File Upload		
});
</script>

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

$(document).on("click",".remove_imagetemp",function(){
				if(confirm("Are you sure you want to remove the image?"))
				{
					var obj = $(this);								
					var img_name=obj.attr('rel');
					var restaurant_id=jQuery('#restaurant_id').val();
								
						obj.children("img").removeClass('hide');							
						obj.children("img").attr("src","<?php echo base_url()."images/loading_small.gif" ;?>");					
					$.ajax({						
							type:'POST',
							url:'<?php echo base_url()."admin/profile/remove_imagetemp";?>',
							data:{  
									'img_name':img_name,'restaurant_id':restaurant_id
								},
							success:function(result){	//window.location.reload();	if necessary			
								if(result=='yes') 
							  	{
									obj.children("img").addClass('hide');
									obj.prev().remove();	
									obj.next().remove();																					
									obj.remove();
									$("#imgUp").hide();
									$(".div_details_in_l").show();
		                            $(".file-wrapper").show();
								}
								else
								{									
									alert('Error ! Could not remove Image.');
									obj.children("img").addClass('hide');
								}
							}
						
						});
				}					
			
	});
</script>
<script>

		 $("#pwd_btn").click(function(){
			var new_pwd=$('#txtNewPassword').val();
			var confirm_pwd=$('#txtConfirmPassword').val(); 
			var admin_id=$('#admin_id').val();
			var curpassword=$('#curpassword').val();
			if(curpassword==''){
				$('#curpassword').addClass('errorborder');
				return false;
			}else if((new_pwd.length<6)&&(confirm_pwd.length<6)){
				$('#curpassword').removeClass('errorborder');
				$('#txtNewPassword').addClass('errorborder');
				alert("Passowrd require minimum 6 characters");
				return false;
			}
			$('#curpassword').removeClass('errorborder');
			$('#txtNewPassword').removeClass('errorborder');
			if((new_pwd!='')&&(confirm_pwd!='')&&(new_pwd==confirm_pwd)){ 
					
					$.ajax({
							type:"post",
							url:"<?php echo base_url(); ?>admin/restaurant/checkPwd",
							data:{'password':curpassword,'admin_id':admin_id},
							success:function(data){
							if(data=="success"){
								$( "#sucessmsg" ).html( "Password Sucessfully Changed ..." );
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
								$('#myModal').modal('hide');
							}
							else
							{
								$('#curpassword').addClass('errorborder');
								alert("Invalid Current Password");
								return false;
							}
								
								
								}
						});
				
				
						
			}
			else{
			 alert("Password and Confirm Password should be same !!");   
			 }
		})
</script>

