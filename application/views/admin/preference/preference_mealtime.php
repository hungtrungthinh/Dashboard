
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
   
       
	    <?php $i=0; foreach($configlist as $pref){ ?>
		<?php if ($i==0){?>    
        <div class="row form-group" style="margin-bottom:0px;">  <?php }$i++; ?>
          <div class="col-lg-6" style="padding-bottom:10px;">
          <label><?php echo $pref->title; ?></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            
            <?php if($pref->field != 'breakfast_start_time' && $pref->field != 'breakfast_end_time' && $pref->field != 'lunch_start_time' && $pref->field != 'lunch_end_time' &&$pref->field != 'dinner_start_time' && $pref->field != 'dinner_end_time'){ ?>
            
            <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="<?php echo $pref->field; ?>" value="<?php echo $pref->value; ?>">
            
            <?php }else if($pref->field == 'breakfast_start_time'){?>
             <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="datetimepicker1"  value="<?php echo $pref->value; ?>" />
            <?php }else if($pref->field == 'breakfast_end_time'){ ?>
            
              <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="datetimepicker2"  value="<?php echo $pref->value; ?>" />
            
            <?php }else if($pref->field == 'lunch_start_time'){ ?>
            
              <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="datetimepicker3"  value="<?php echo $pref->value; ?>" />
            
           <?php  }else if($pref->field == 'lunch_end_time'){ ?>
            
              <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="datetimepicker4"  value="<?php echo $pref->value; ?>" />
            
           <?php }else if($pref->field == 'dinner_start_time'){ ?>
            
              <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="datetimepicker5"  value="<?php echo $pref->value; ?>" />
            
           <?php }else if($pref->field == 'dinner_end_time'){ ?>
            
              <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
            <input type="text" placeholder="<?php echo $pref->title; ?>" class="form-control" name="<?php echo $pref->id; ?>" id="datetimepicker6"  value="<?php echo $pref->value; ?>" />
            
            <?php } ?>
         
          </div>
        </div>
      
        
        
         <?php if ($i==2){ $i=0;?>   </div> <?php } ?> 
		
		 <?php } ?>
 <div class="row form-group"></div>
  <div class="row form-group">
  <div class="col-lg-12">
  <div class="col-lg-8 col-ms-8 col-xs-8"></div>
        <div class="col-lg-4 col-md-4 col-xs-4 "><button class="btn btn-info " style="width:49%;">Submit</button>
        <button class="btn btn-default " type="button"  onclick="cancel();"  style="width:49%;">Cancel</button></div>
      </div>
   </div>
       <div class="clearfix" style="padding-top:15px;"></div>
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
<script>


$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5
});
$('#datetimepicker2').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5,
	defaultTime:$('#datetimepicker2').val()
});
$('#datetimepicker3').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5,
	defaultTime:$('#datetimepicker3').val()
});
$('#datetimepicker4').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5,
	defaultTime:$('#datetimepicker4').val()
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5,
	defaultTime:$('#datetimepicker5').val()
});
$('#datetimepicker6').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5,
	defaultTime:$('#datetimepicker6').val()
});</script>