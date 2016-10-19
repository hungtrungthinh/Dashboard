<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>
<!-- <script for color picker-->
<script type="text/javascript" src="<?php echo base_url() ?>assets/jscolor/jscolor.js"></script>
	<div class="container"> 
		<div class="clearfix">&nbsp;</div>
			<div class="col-lg-12">
				<legend>Restaurant App Details </legend>
			</div> 
	<div class="col-md-12" style="padding-bottom:15px;">
    
    
    	
    
    
    
		<form class="form-horizontal" role="form" action="<?php echo base_url()?>index.php/admin/restaurant/apiGenarete" method="post" name="formlist" onsubmit="" id="formlist">
        	
            <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Link For APP generation</label>
            	<div class="col-sm-6">
             	<a href="https://developers.facebook.com/quickstarts/?platform=web" target="_blank" style="color:#0000FF;">API</a>
                <small><i>Go to This Link</i></small>
               
                </div>
          </div>
            
            <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Site URL</label>
            	<div class="col-sm-6">
             	<input type="text" name="site_url" id="site_url" value="https://newagesme.com/forkourse/weborder/" placeholder="Site Url " class="form-control fileldtheme js-placeholder" readonly="readonly" ><small><i>Site Url</i></small>
               
                </div>
          </div>	
          <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Secure Page Tab URL</label>
            	<div class="col-sm-6">
             	<input type="text" name="page_tab_url" id="page_tab_url" value="https://newagesme.com/forkourse/weborder/home/<?php echo $restaurant_id;?>" placeholder="Secure Page Tab URL" class="form-control fileldtheme js-placeholder" readonly="readonly" ><small><i>Secure Page Tab URL</i></small>
               
                </div>
          </div>	
          
              
          
          
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4 " for="textinput">App ID</label>
				 <div class="col-sm-6">
                 <input type="text" name="app_id" value="<?php echo $reataurantdetails['app_id'] ; ?>" id="app_id"  placeholder="App ID" class="form-control fileldtheme js-placeholder" onblur="generateTab()" >
                 <small><i>App ID</i></small>
		         </div>
           </div>
		   <!-- Text input-->
 		  
          
           <div class="form-group">
            	<label class="col-sm-4 " for="textinput">App Name</label>
            	<div class="col-sm-6">
             	<input type="text" name="app_name" value="<?php echo $reataurantdetails['app_name'] ; ?>" id="app_name" placeholder="App Name" class="form-control fileldtheme js-placeholder" ><small><i>App Name</i></small>
               
                </div>
           </div>
           
           
           <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Restaurant Page Tab URL</label>
            	<div class="col-sm-6">
                <textarea id="res_pag_tab"  name="res_pag_tab"  class="form-control fileldtheme js-placeholder" readonly="readonly"><?php echo $reataurantdetails['res_pag_tab'] ; ?></textarea>
             	<small><i>Give this link for the page tab</i></small>
               
                </div>
           </div>
            
       
     	 <input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id;?>" id="restaurant_id">
       
         
          
      	<button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/restaurant/lists'">Cancel</button>
      	<button type="button" class="btn btn-info pull-right" name="submit_btn" id="submit_btn"  style="margin-right:10px;">Save</button>
     
     
        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<script>
function generateTab(){
	var app_id=$('#app_id').val();
	var site_url=$('#site_url').val();
	var page_tab_url=$('#page_tab_url').val();
	var app_name=$('#app_name').val();
	var flag1=1;
	$('.fileldtheme').removeClass('errorborder');
	if(app_id==''){
		$('#app_id').addClass('errorborder');
		$('#res_pag_tab').val('');
		flag1=0;
		
	}
	/*if(app_name==''){
		$('#app_name').addClass('errorborder');
		flag1=0;
	}*/
	
	if(flag1==0){
		return false;
	}else{
		var url = "http://www.facebook.com/dialog/pagetab?app_id="+app_id+"&next="+page_tab_url;
		$('#res_pag_tab').val(url);
	}
}
$('#submit_btn').click(function(){
	
	var app_id=$('#app_id').val();
	var site_url=$('#site_url').val();
	var page_tab_url=$('#page_tab_url').val();
	var app_name=$('#app_name').val();
	var res_pag_tab = $('#res_pag_tab').val();
	var url = "http://www.facebook.com/dialog/pagetab?app_id="+app_id+"&next="+page_tab_url;
	var flag=1;
	$('.fileldtheme').removeClass('errorborder');
	if(app_id==''){
		$('#app_id').addClass('errorborder');
		flag=0;
	}
	if(app_name==''){
		$('#app_name').addClass('errorborder');
		flag=0;
	}
	if(res_pag_tab==''){
		$('#res_pag_tab').addClass('errorborder');
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


<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
</style>