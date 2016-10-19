 
<script>

	function submitForm(){
		$("#frmPack").submit();
	 }
 
 
		 
	function cancel()
	{
	
	window.location.href = "<?php echo base_url()?>admin/home";
	}
</script>


  <div class="container">
  <div class="clearfix" style="padding-top:15px;"></div>

  <?php $this->load->library('session');
 
  ?>
  
     <div class="col-lg-12"><legend>Preferences Details</legend></div>


	 
<div class="col-md-12" style="padding-bottom:10px;">
	 
	
  
  <form  method="post" name="formlist"  id="formlist" action=""  onsubmit="">
 
   <fieldset>
   
       
	    <?php $i=0; foreach($configlist as $pref){?>
		<?php if ($i==0){?>    <div class="row form-group">  <?php }$i++; ?>
     
        
          <div class="col-lg-6">
          <label><?php echo $pref->title; ?></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->title; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="<?php echo $pref->field; ?>"  value="<?php echo $pref->loc_value; ?>">
          </div>
        </div>
      
        
        
         <?php if ($i==2){ $i=0;?>   </div> <?php } ?> 
		
		 <?php } ?>
        
 <div class="row form-group"></div>
   <div class="row form-group">
  <div class="col-lg-3"></div>
        <div class="col-lg-3 col-offset-3"><button class="btn btn-info btn-group-justified">Submit</button></div>
        <div class="col-lg-3"><button class="btn btn-default btn-group-justified" type="button"  onclick="cancel();">Cancel</button></div>
         <div class="col-lg-3"></div>
      </div>
    </fieldset>
  </form>


</div>

</div>
<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
</style>