<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/js/fileupload/jquery.blockUI.js" ?>"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
//Multiple File upload	
jQuery("#fileToUpload").change(function(){
	   var allowed_ext = ["jpg","png","gif"];
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
	 	var img = $('<img id="dynamic" style="height: 60px;width: 60px;margin:0px 15px 15px 19px; ">'); //Equivalent: $(document.createElement('img'))
		var hid=$('<input type=hidden id=imgsrc name=imgsrc[] >');
		var rem=$('<a href="javascript:void(0);" class="remove_imagetemp" style="margin-left:15px;color:#000000;" >Remove<img class="hide" id="loading"/></a>');
		//var pdfname=$('<img title="Upload Image" width="25px" style="" height="25px" src="<?php echo base_url().'assets/images/profile/'?>" id="imagediv">      '); 
		var imgname=evt.target.responseText.substr(evt.target.responseText.lastIndexOf('/') + 1);
		//alert(evt.target.responseText.lastIndexOf(substring[, startindex]));
		if(evt.target.responseText=="image is to big")
		{
		alert("Maximum Allowed File size is 150*150");
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
	<div class="container"> 
		<div class="clearfix">&nbsp;</div>
			<div class="col-lg-12">
				<legend>Restaurant Details </legend>
			</div> 
	<div class="col-md-12" style="padding-bottom:15px;">
		<form class="form-horizontal" role="form" action="<?php echo base_url()?>index.php/admin/profile/edit_manager" method="post" name="formlist" onsubmit="" id="formlist">
        	
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4 " for="textinput">Name</label>
				 <div class="col-sm-6">
                 <input type="text" name="name" value="<?php echo $profiledetails['name'];?>"  placeholder="Name" class="form-control fileldtheme js-placeholder" >
		         </div>
           </div>
		   <!-- Text input-->
 		   <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Contact Number</label>
            	<div class="col-sm-6">
             	<input type="text" name="phone" value="<?php echo $profiledetails['phone'];?>" placeholder="Contact Number" class="form-control fileldtheme js-placeholder" ><small><i>Head Office Contact Number</i></small>
               
                </div>
          </div>	    
          <!-- Text input--> 
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Address</label>
            	<div class="col-sm-6">
             	<input type="text" name="address" value="<?php echo $profiledetails['address'];?>" placeholder="Address" class="form-control fileldtheme js-placeholder"  ><small><i>Head Office Address</i></small>
                
	            </div>
         </div>
         <!--image upload-->
         <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Logo</label>
            	<div class="col-sm-6">
                <?php if($profiledetails['logo']!=''){ ?>
                <div class="div_details_in_r" style="float:left">
					<span class="file-wrapper" style="opacity: 1;z-index: 10000000"> 
						<input id="fileToUpload" type="file" multiple name="fileToUpload">						
						</span>
				</div>					
						<div id="imagediv" class="library_img ui-draggable" style="position:relative; z-index:3;">
						<input id="<?php echo $imdata;?>" type="hidden" name="imgsrc[]" value="<?php echo $imdata;?>">
						</div>
					
				
                <div id="imagediv" class="" style=" position:relative; z-index:3;">
						<span><a style="color:#000000;" href="<?php echo base_url().'assets/images/profile/'.$profiledetails['logo'];?>"></a>
                  <img src="<?php echo base_url().'assets/images/profile/'.$profiledetails['logo'];?>" width="100" height="50"/>
                        </span>
                      <a href="javascript:void(0);" class="remove_imagetemp" style="margin-left:15px;color:#000000;" rel="<?php echo  $profiledetails['logo']?>" >Remove<img class="hide" id="loading"/></a>
						</div>
                <?php } else{ ?>
             	<div class="div_details_in_r" style="float:left">
					<span class="file-wrapper" style="opacity: 1;z-index: 10000000"> 
						<input id="fileToUpload" type="file" multiple name="fileToUpload">						
						</span>
									
						<div id="imagediv" class="library_img ui-draggable" style="margin-top:5px; position:relative; z-index:3;">
						<input id="<?php echo $imdata;?>" type="hidden" name="imgsrc[]" value="<?php echo $imdata;?>">
						</div>
					
				</div>
                    <?php } ?>       
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
              <input type="text" name="managername" value="<?php echo $profiledetails['full_name'];?>" placeholder="Name" class="form-control fileldtheme js-placeholder"  >
		
			</div>
        </div>
 		<!-- Text input-->   
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">User Name</label>
            <div class="col-sm-6">
              <input type="text" readonly name="username" id="username" placeholder="User Name" value="<?php echo $profiledetails['username'];?>" class="form-control fileldtheme js-placeholder" >
             
	    </div>
        </div>
 		<!-- Text input-->
        <div class="form-group">
         	<?php if($profiledetails['password']){?>
            <label class="col-sm-4" for="textinput">Password</label>
            <div class="col-sm-6">
            <strong> ********** </strong>  <a href="javascript:void(0);" class="txt_link" id="change_link" ><span class="mr_2" data-toggle="modal" data-target="#myModal"  data-backdrop="static">Change</span></a>
            </div>
            <?php }?>
        </div>
        
       <div class="form-group">
            <label class="col-sm-4 " for="textinput">Email</label>
            <div class="col-sm-6">
            <input type="text" name="email" value="<?php echo $profiledetails['email'];?>" placeholder="Email" class="form-control fileldtheme js-placeholder">
            </div>
	  </div>
     	 <input type="hidden" name="restaurant_id" value="<?php echo $profiledetails['restaurant_id'];?>" id="restaurant_id">
         <input type="hidden" name="admin_id" value="<?php echo $profiledetails['admin_id'];?>" id="admin_id">
       <button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/restaurant/lists'">CANCEL</button>
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
									//$("#pdfname").hide();
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



<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
</style>