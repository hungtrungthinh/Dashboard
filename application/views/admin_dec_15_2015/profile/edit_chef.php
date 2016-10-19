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

</style>
<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>


<script type="text/javascript"> 
$(document).ready(function(){
	var Countries = [{label:'00:00 AM', value: '00:00 AM'}, 
					 {label:'00:30 AM', value: '00:30 AM'},
					 {label:'01:00 AM', value: '01:00 AM'},
					 {label:'01:30 AM', value: '01:30 AM'},
					 {label:'02:00 AM', value: '02:00 AM'},
					 {label:'02:30 AM', value: '02:30 AM'},
					 {label:'03:00 AM', value: '03:00 AM'},
					 {label:'03:30 AM', value: '03:30 AM'},
					 {label:'04:00 AM', value: '04:00 AM'},
					 {label:'04:30 AM', value: '04:30 AM'},
					 {label:'05:00 AM', value: '05:00 AM'},
					 {label:'05:30 AM', value: '05:30 AM'},
					 {label:'06:00 AM', value: '06:00 AM'},
					 {label:'06:30 AM', value: '06:30 AM'},
					 {label:'07:00 AM', value: '07:00 AM'},
					 {label:'07:30 AM', value: '07:30 AM'},
					 {label:'08:00 AM', value: '08:00 AM'},
					 {label:'08:30 AM', value: '08:30 AM'},
					 {label:'09:00 AM', value: '09:00 AM'},
					 {label:'09:30 AM', value: '09:30 AM'},
					 {label:'10:00 AM', value: '10:00 AM'},
					 {label:'10:30 AM', value: '10:30 AM'},
					 {label:'11:00 AM', value: '11:00 AM'},
					 {label:'11:30 AM', value: '11:30 AM'},
					 {label:'12:00 PM', value: '12:00 PM'},
					 {label:'12:30 PM', value: '12:30 PM'},
					 {label:'01:00 PM', value: '01:00 PM'},
					 {label:'01:30 PM', value: '01:30 PM'},
					 {label:'02:00 PM', value: '02:00 PM'},
					 {label:'02:30 PM', value: '02:30 PM'},
					 {label:'03:00 PM', value: '03:00 PM'},
					 {label:'03:30 PM', value: '03:30 PM'},
					 {label:'04:00 PM', value: '04:00 PM'},
					 {label:'04:30 PM', value: '04:30 PM'},
					 {label:'05:00 PM', value: '05:00 PM'},
					 {label:'05:30 PM', value: '05:30 PM'},
					 {label:'06:00 PM', value: '06:00 PM'},
					 {label:'06:30 PM', value: '06:30 PM'},
					 {label:'07:00 PM', value: '07:00 PM'},
					 {label:'07:30 PM', value: '07:30 PM'},
					 {label:'08:00 PM', value: '08:00 PM'},
					 {label:'08:30 PM', value: '08:30 PM'},
					 {label:'09:00 PM', value: '09:00 PM'},
					 {label:'09:30 PM', value: '09:30 PM'},
					 {label:'10:00 PM', value: '10:00 PM'},
					 {label:'10:30 PM', value: '10:30 PM'},
					 {label:'11:00 PM', value: '11:00 PM'},
					 {label:'11:30 PM', value: '11:30 PM'}
					 ];
	
				$('.timeIntervals').autocomplete({
					source: Countries,
					minLength: 0
				}).focus(function() {
					$(this).autocomplete("search", "");
				}).click(function() {
					$(this).autocomplete("search", "");
				});
});
</script>
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
     	
        <?php	if($error=='') { ?>
        
        <div class="col-lg-12">
	      <legend> Basic Details</legend>
		</div> 
	 
    <div class="col-md-12" style="padding-bottom:10px;">
    
    
    	
    
		<form class="form-horizontal" role="form" action="<?php echo base_url()?>index.php/admin/profile/edit_chef" method="post" name="formlist" onsubmit="" id="formlist">
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4" for="textinput">Name</label>
				 <div class="col-sm-6">
                 <input type="text" name="name" value="<?php echo $chefdetails['restaurant_name']?>"  placeholder="Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter  name" >
		         </div>
           </div>
		    <!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4" for="textinput">Zip Code</label>
				 <div class="col-sm-2">
                 <input type="text" name="zipcode" value="<?=(isset($chefdetails['zip_code']))?$chefdetails['zip_code']:''?>"  placeholder="Zipcode" class="form-control fileldtheme js-placeholder zipcode " data-bvalidator="required" data-bvalidator-msg="Please enter Zipcode"  >
		         </div>
                 <div class="col-sm-2">
                 <input type="text" name="city" value="<?=(isset($chefdetails['city']))?$chefdetails['city']:''?>"  placeholder="City"  class="form-control fileldtheme js-placeholder city"  readonly="readonly">
		         </div>
                 <div class="col-sm-2">
                 <input type="text" name="state" value="<?=(isset($chefdetails['state']))?$chefdetails['state']:''?>"  placeholder="State" class="form-control fileldtheme js-placeholder state"  readonly="readonly">
		         </div>
           </div>
            <!-- Text input-->
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Address</label>
            	<div class="col-sm-6">
             	<input type="text" name="address" value="<?php echo $chefdetails['address']?>" placeholder="Address" class="form-control fileldtheme js-placeholder" >
               
	            </div>
         </div>
         <!-- Text input-->
 		 <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Phone Number</label>
            	<div class="col-sm-6">
             	<input type="text" name="phone" value="<?php  echo $chefdetails['phone']?>" placeholder="Phone Number" class="form-control fileldtheme js-placeholder" >
                
                </div>
         </div>	
         <?php $type=$result['type'];?>
                  <!-- Text input-->
                 <div class="form-group">
                        <label class="col-sm-4 " for="textinput">Type</label>
                        <div class="col-sm-6">
                        <input type="hidden" value="<?php echo $type;?>" />
                        <select name="type" id="type" class="form-control" >
                              <option value="Both" <?php if($type == 'Both' || $type == ''){?> selected="selected"<?php } ?> name="both">Both</option>
                             <option value="Pickup" <?php if($type == 'Pickup'){?> selected="selected"<?php } ?>name="pickup" >Pickup</option>
                             <option value="Delivery" <?php if($type == 'Delivery'){?> selected="selected"<?php } ?> name="delivery">Delivery</option>       
                        </select>
                        </div>
                 </div>	 
                   <!-- Text input--> 
        <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Description</label>
            	<div class="col-sm-6">
     
                <textarea class="form-control additem" name="description" id="description" role="4"><?php  echo $chefdetails['description']?></textarea>
                </div>
         </div>	
         
                  <!-- Text input-->
                  <!-- Text input--> 
                     <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Opening Time</label>
            	<div class="col-sm-8">
                <div class="col-sm-3"> <span>Day</span></div>
                <div class="col-sm-4"><span>Start time</span></div>
                <div class="col-sm-5"><span>End time</span></div>
                </div>
                <div class="col-sm-8">
                <div class="col-sm-3">
                <input type="checkbox" data-id="mon" name="day[]" value="monday" class="day"  <?php if($monday!=''){?> checked="checked" <?php }?> />Monday
             	</div>
                   <div class="col-sm-4">	
                   <?php  
				   	$start_at=date("g:i A ", strtotime ($monday['start_at']));
				   	if($monday['start_at']!=''){
					   
				   ?> 
                	<input class="timeIntervals start_at_mon" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly  <?php if($monday==''){?>
                     disabled="disabled" <?php }?>/>
                    <?php }else{
						?>
                    <input class="timeIntervals start_at_mon" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled" />&nbsp;&nbsp;
                    <?php }?>
                	</div>
                    <div class="col-sm-5">
                    <?php $end_at=date("g:i A ", strtotime ($monday['end_at']));?>
                    <?php  if($monday['end_at']!=''){?> 
                	<input  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals end_at_mon"  readonly <?php if($monday==''){?>
                     disabled="disabled" <?php }?>/>
                    <?php  }else{?>
                    <input class="timeIntervals end_at_mon"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly disabled="disabled" />&nbsp;&nbsp;
                    <?php  }?>
                    </div>
                </div>
         </div>
                     <div class="form-group">
                     <label class="col-sm-4 " for="textinput"></label>
                            <div class="col-sm-8">
                             <div class="col-sm-3">
                            <input type="checkbox" data-id="tue" class="day" name="day[]" value="tuesday" <?php if($tuesday!=''){?> checked="checked" <?php }?> />Tuesday
                            </div>
                            <div class="col-sm-4">
                                <?php $start_at=date("g:i A ", strtotime ($tuesday['start_at']));?>
                               <?php  if($tuesday['start_at']!=''){?> 
                                <input class="timeIntervals start_at_tue"  name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly  <?php if($tuesday==''){?>
                                 disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                <?php }else{?>
                                <input class="timeIntervals start_at_tue" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                <?php }?>
                                </div>
                                <div class="col-sm-5">
                                <?php $end_at=date("g:i A ", strtotime ($tuesday['end_at'])); ?>
                                <?php  if($tuesday['end_at']!=''){?> 
                                <input id="end_at" name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals end_at_tue" readonly <?php if($tuesday==''){?>
                                 disabled="disabled" <?php }?>/>
                                <?php  }else{?>
                                <input class="timeIntervals end_at_tue" id="end_at" name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                <?php  }?>
                                </div>
                            </div>
                     </div>
                     <div class="form-group">
                                 <label class="col-sm-4 " for="textinput"></label>
                                        <div class="col-sm-8">
                                        <div class="col-sm-3">
                                        <input type="checkbox" data-id="wed" name="day[]" value="wednesday"  class="day" <?php if($wednesday!=''){?> checked="checked" <?php }?>/>Wednesday
                                            </div>
                                            <div class="col-sm-4">
                                            <?php $start_at=date("g:i A ", strtotime ($wednesday['start_at']));?>
                                           <?php  if($wednesday['start_at']!=''){?> 
                                            <input class="timeIntervals start_at_wed" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($wednesday==''){?>
                                             disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                            <?php }else{?>
                                            <input class="timeIntervals start_at_wed" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                            <?php }?>
                                            </div>
                                            <div class="col-sm-5">
                                            <?php $end_at=date("g:i A ", strtotime ($wednesday['end_at']));?>
                                            <?php  if($wednesday['end_at']!=''){?> 
                                            <input  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals end_at_wed" readonly <?php if($wednesday==''){?>
                                             disabled="disabled" <?php }?>/>
                                            <?php  }else{?>
                                            <input class="timeIntervals end_at_wed"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                            <?php  }?>
                                            </div>
                                        </div>
                                 </div>
                     <div class="form-group">
                     <label class="col-sm-4 " for="textinput"></label>
                            <div class="col-sm-8">
                            <div class="col-sm-3">
                            <input type="checkbox" data-id="thu" name="day[]" value="thursday"  class="day" <?php if($thursday!=''){?> checked="checked" <?php }?> />Thursday
                            </div>
                            <div class="col-sm-4">
                                <?php $start_at=date("g:i A ", strtotime ($thursday['start_at']));?>
                               <?php  if($thursday['start_at']!=''){?> 
                                <input class="timeIntervals start_at_thu" id="start_at_thu" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($thursday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                <?php }else{?>
                                <input class="timeIntervals start_at_thu" id="start_at_thu" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                <?php }?>
                                </div>
                                <div class="col-sm-5">
                                <?php $end_at=date("g:i A ", strtotime ($thursday['end_at']));?>
                                <?php  if($thursday['end_at']!=''){?> 
                                <input name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals end_at_thu" readonly <?php if($thursday==''){?>disabled="disabled" <?php }?>/>
                                <?php  }else{?>
                                <input class="timeIntervals end_at_thu" name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>"  readonly disabled="disabled"/>&nbsp;&nbsp;
                                <?php  }?>
                            </div></div>
                     </div>
                     <div class="form-group">
                     <label class="col-sm-4 " for="textinput"></label>
                            <div class="col-sm-8">
                            <div class="col-sm-3">
                            <input type="checkbox" data-id="fri" name="day[]" value="friday"  class="day" <?php if($friday!=''){?> checked="checked" <?php }?>/>Friday
                            </div>
                           <div class="col-sm-4">
                                <?php $start_at=date("g:i A ", strtotime ($friday['start_at'])); ?>
                               <?php  if($friday['start_at']!=''){?> 
                                <input class="timeIntervals start_at_fri" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($friday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                <?php }else{?>
                                <input class="timeIntervals start_at_fri" name="start_at[]"  value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                <?php }?>
                            </div>  <div class="col-sm-5">
                                <?php  $end_at=date("g:i A ", strtotime ($friday['end_at']));?>
                                <?php  if($friday['end_at']!=''){?> 
                                <input name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals end_at_fri" readonly <?php if($friday==''){?>disabled="disabled" <?php }?>/>
                                <?php  }else{?>
                                <input class="timeIntervals end_at_fri"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                <?php  }?>
                            </div>
                           </div>
                     </div>
                     <div class="form-group">
                     <label class="col-sm-4 " for="textinput"></label>
                            <div class="col-sm-8">
                            <div class="col-sm-3">
                            <input type="checkbox" data-id="sat" name="day[]"  value="saturday"  class="day" <?php if($saturday!=''){?> checked="checked" <?php }?>/>Saturday
                                </div>
                                <div class="col-sm-4">
                                <?php  $start_at=date("g:i A ", strtotime ($saturday['start_at']));?>
                               <?php  if($saturday['start_at']!=''){?> 
                                <input  class="timeIntervals start_at_sat" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($saturday==''){?> disabled="disabled" <?php }?> />
                                <?php }else{?>
                                <input class="timeIntervals start_at_sat" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($saturday==''){?>disabled="disabled" <?php }?> />&nbsp;&nbsp;
                                <?php }?>
                                </div>
                                <div class="col-sm-5">
                                <?php $end_at=date("g:i A ", strtotime ($saturday['end_at']));?>
                                <?php  if($saturday['end_at']!=''){?> 
                                <input name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals end_at_sat" readonly  <?php if($saturday==''){?>disabled="disabled" <?php }?> />
                                <?php  }else{?>
                                <input class="timeIntervals end_at_sat" value="<?=(isset($end_at))?$end_at:''?>" name="end_at[]"  readonly <?php if($saturday==''){?>disabled="disabled" <?php }?> />&nbsp;&nbsp;
                                <?php  }?>
                            </div>
                            </div>
                     </div>
                     <div class="form-group">
                     <label class="col-sm-4 " for="textinput"></label>
                            <div class="col-sm-8">
                            <div class="col-sm-3">
                            <input type="checkbox" data-id="sun" name="day[]"  value="sunday"  class="day" <?php if($sunday!=''){?> checked="checked" <?php }?> />Sunday
                            </div>
                            <div class="col-sm-4">
                                <?php $start_at=date("g:i A ", strtotime ($sunday['start_at']));?>
                               <?php  if($sunday['start_at']!=''){?> 
                                <input class="timeIntervals start_at_sun" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($sunday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                <?php }else{?>
                                <input class="timeIntervals start_at_sun" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($sunday==''){?>disabled="disabled" <?php }?> />&nbsp;&nbsp;
                                <?php }?>
                                </div>
                                <div class="col-sm-5">
                                <?php $end_at=date("g:i A ", strtotime ($sunday['end_at']));?>
                                <?php  if($sunday['end_at']!=''){?> 
                                <input  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals end_at_sun" readonly <?php if($sunday==''){?>disabled="disabled" <?php }?>
                                 />
                                <?php  }else{?>
                                <input class="timeIntervals end_at_sun"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>"  readonly <?php if($sunday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                <?php }?>
                                </div>
                            </div>
                     </div>                  
               
                 <div class="form-group">
                        <label class="col-sm-4 " for="textinput">Time Zone</label>
                        <div class="col-sm-6">
                        <select name="timezone" id="timezone" class="form-control" >
                              <option value="Both"  name="defaulttimezone">Select</option>
                            <?php foreach($timezonedetails as $timezone ){ ?>
                             <option value="<?php echo $timezone['timezone'] ?>" <?php if($timezone['timezone'] == $chefdetails['timezone']){?> selected="selected"<?php } ?>   name="timezone" ><?php echo $timezone['timezone'] ?></option>
                            <?php }?>       
                        </select>
                        </div>
                 </div>	    
                 <!-- Text input--> 
         
         
         <!--<div class="form-group">
            	<label class="col-sm-4 " for="textinput">Opening Time</label>
            	<div class="col-sm-6">
             		<span>Start time</span>
                   <?php  if($chefdetails['start_at']!=''){
				   		  $start_at=date("g:i A ", strtotime ($chefdetails['start_at']));?> 
                	<input class="timeIntervals" id="start_at" name="start_at" value="<?=(isset($start_at))?$start_at:''?>" readonly/>&nbsp;&nbsp;
                    <?php }else{?>
                    <input class="timeIntervals" id="start_at" name="start_at" value="" readonly/>&nbsp;&nbsp;
                    <?php }?>
                	<span>End time</span>
                    <?php  if($chefdetails['end_at']!=''){
				    	   $end_at=date("g:i A ", strtotime ($chefdetails['end_at']));?> 
                	<input id="end_at" name="end_at" value="<?=(isset($end_at))?$end_at:''?>" class="timeIntervals" readonly />
                    <?php  }else{?>
                    <input class="timeIntervals" id="start_at" name="start_at" value="" readonly/>&nbsp;&nbsp;
                    <?php  }?>
                </div>
         </div>-->	
      <div class="col-lg-12">
	  </div>     
    <div class="col-lg-12">
   		 <legend>User Credential</legend>
	</div> 
	     <div class="clearfix">&nbsp;</div>
         <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">Name</label>
            <div class="col-sm-6">
              <input type="text" name="chefname" value="<?php echo $chefdetails['full_name'] ?>" placeholder="Name" class="form-control fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter Chef Name" >
		
			</div>
        </div>
 		
     
       <!-- Text input-->  
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">User Name</label>
            <div class="col-sm-6">
              <input type="text" name="username" value="<?php echo $chefdetails['username']?>" readonly id="username" placeholder="User Name" class="form-control fileldtheme js-placeholder"  >
              <p id="error" class="text-danger"></p>		
			</div>
            
        </div>
        
 		<!-- Text input--> 
     
      
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 " for="textinput">Password</label>
            <div class="col-sm-6">
            <strong> ********** </strong>  <a href="javascript:void(0);" class="txt_link" id="change_link" ><span class="mr_2" data-toggle="modal" data-target="#myModal"  data-backdrop="static">Change</span></a>
            </div>
        </div>
       
       <div class="form-group">
            <label class="col-sm-4 " for="textinput">Email</label>
            <div class="col-sm-6">
            <input type="text" name="email" value="<?php echo  $chefdetails['email']?>" placeholder="Email" class="form-control fileldtheme js-placeholder" data-bvalidator="email,required" data-bvalidator-msg="Please enter valid email id"  >
            </div>
	  </div>
      <div class="col-sm-10">  
          <input type="hidden" value="<?php echo $chefdetails['restaurant_id']?>"  id="restaurant_id" name="restaurant_id"/>
          <input type="hidden" value="<?php echo $chefdetails['location_id']?>" id="location_id" name="location_id"/>
            <input type="hidden" value="<?php echo $chefdetails['admin_id']?>" id="admin_id" name="admin_id"/>
          <button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/location/lists'">Cancel</button>
          <button type="submit" class="btn btn-info pull-right" name="submit_btn" id="submit_btn" style="margin-right:10px;">Save</button>
       </div>  
     
        </fieldset>
      </form>
      
    
    </div><!-- /.col-lg-12 -->	
    
      <?php }else{ ?>
	  		
			<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
	  
	  <?php } ?>
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
		
		
		 
	 $("#username").blur(function(){
	    var username=$("#username").val();
		if(username!=''){
			 $.ajax({
			type: "POST",
			url: "<?php echo base_url()?>index.php/admin/location/check",
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
 $("#change_link").click(function(){

		   var admin_id=$('#admin_id').val();
			$("#myModal").html("");
			$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>admin/location/change",
			data:{'admin_id':admin_id},
			success:function(data){
				$("#myModal").html(data);
			}
			});
			   
			    
		})
		$(".zipcode").blur(function(){
	

		   var zipcode=$('.zipcode').val();
			$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>admin/location/zipcode",
			data:{'zipcode':zipcode},
			success:function(data){
				var jsonData = JSON.parse(data);
				$('.city').val(jsonData.city);
				$('.state').val(jsonData.state);
			}
			});
			   
			    
		})
	$('body').on('click','.day', function(){
				var val=$(this).attr("data-id");
				//alert(val);
			if ($(this).is(":checked")){
				$(".start_at_"+val).removeAttr("disabled");
				$(".end_at_"+val).removeAttr("disabled");   
            } else {
                $(".start_at_"+val).attr("disabled","disabled");
				$(".end_at_"+val).attr("disabled","disabled");
            }
		
});			
</script>

	


