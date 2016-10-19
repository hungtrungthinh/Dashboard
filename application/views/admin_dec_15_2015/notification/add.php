<link href="<?php echo base_url() ?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>

<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
.ui-autocomplete { 
            cursor:pointer; 
            height:120px; 
            overflow-y:scroll;
        }  
.ui-corner-all{ border-radius:0px!important;}
.ui-menu-item{  width:100% !important; padding:0px !important; border-bottom:1px solid#EBEAEA;  }
a.ui-corner-all{ width:100% !important; display:block; padding:2px; margin:0;}
a.ui-state-focus{ background:#DF7707 !important; width:100% !important; padding:2px !important; margin:0px; border:1px solid#DF7707 !important; color:#FFF !important; border-radius:0px !important; }
.errmsg
{
color: red;
display:inline-block;
}
</style>

<style>
.brudcum_head{
	border-bottom:1px solid #f2f2f2;
	padding:5px;
}
</style>
    <?php /*?>    <div class="col-lg-12 brudcum_head"  >
                  <span> Basic Details</span>
        </div> <?php */?>

 <div class="container" style="padding-bottom:10px;"> 
	 <div class="clearfix" style="padding-top:15px;"></div>
        
        <div class="col-lg-12">
	      <legend> Message Details</legend>
		</div> 
	 
    <div class="col-md-12" style="padding-bottom:10px;">
    
		<form class="form-horizontal" role="form"  method="post" name="formlist"  id="formlist" action="<?php echo base_url()?>index.php/admin/notification/add">
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4" for="textinput">Title </label>
				 <div class="col-sm-6">
                 <input type="text" name="title" id="title"    placeholder="Title" class="form-control " value="<?=(isset($details['title']))?$details['title']:''?>" >
		         </div>
           </div>
		 
          
         <!-- Text input-->
         <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Message</label>
            	<div class="col-sm-6">
     
                <textarea class="form-control additem" name="message" id="message" placeholder="Message"  ><?=(isset($details['message']))?$details['message']:''?></textarea>
                </div>
         </div>
          <!-- Text input-->
         <div class="form-group">
           <label class="col-sm-4 " for="textinput">Show / Hide</label>
          <div class="col-sm-6">
     		<div class="checkbox-slider--b-flat checkbox-slider-md">
            <label>
                <input type="checkbox"  <?php if($details['status']!='N'){ ?> checked="true" <?php } ?> name="status" ><span></span>
            </label>
       	    </div>
                
         </div>
         </div>
 	
      <input type="hidden" value=" <?php echo($this->session->userdata('user')->restaurant_id);?>"  id="restaurant_id" name="restaurant_id"/>
      <input type="hidden" value="<?php echo $details['id'];?>"  id="id" name="id"/>
   	  
      <div class="col-sm-10">  
        
          <button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/home'">Cancel</button>
          <button type="button" class="btn btn-info pull-right" name="submit_btn" id="submit_btn" style="margin-right:10px;" >Save</button>
       </div>  
      
        </fieldset>
      </form>
      
    
    </div><!-- /.col-lg-12 -->	
    
      
	  	
	</div><!-- /.row -->
        
</div><!-- /.container -->

<script>
$('#submit_btn').click(function(){
	
	var title=$('#title').val();
	var message=$('#message').val();
	
	var flag=1;
	$('.fileldtheme').removeClass('errorborder');
	if(title==''){
		$('#title').addClass('errorborder');
		flag=0;
	}
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