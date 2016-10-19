<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
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
.ui-menu-item{  width:100% !important; padding:0px !important; border-bottom:1px solid#FFF;  }
a.ui-corner-all{ width:100% !important; display:block; padding:2px; margin:0;}
a.ui-state-focus{ background:#3399FF !important; width:100% !important; padding:2px !important; margin:0px; border:1px solid#FFF !important; color:#FFF !important; border-radius:0px !important; }


*:after, *:before {
    box-sizing: border-box;
}
section.profile .profile-container form .basic-details .opening-fields-main .opening-fields-box .start_at_mon {
    -moz-appearance: none;
    background: url("../images/svg/dd-arrow.svg") no-repeat scroll 98% 50% rgba(0, 0, 0, 0);
    border: 1px solid rgb(228, 228, 228);
    cursor: pointer;
    display: block;
    padding: 16px;
    width: 100%;
}


section.profile .profile-container form .basic-details .start_at_mon {
    -moz-appearance: none;
    background: url("../images/svg/dd-arrow.svg") no-repeat scroll 98% 50% rgba(0, 0, 0, 0);
    border: 1px solid rgb(228, 228, 228);
    cursor: pointer;
    display: block;
    font-size: 12px;
    line-height: 20px;
    margin-bottom: 15px;
    padding: 16px;
    width: 100%;
}
</style>

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


        <!-- ===== Section Profile ===== -->
        <section class="profile">
        	<div class="container">
            	<!-- Profile Container -->
                <div class="profile-container">
                	<!-- Profile Form -->
                     <?php	if($error=='') { ?>
                	<form role="form" action="<?php echo base_url()?>index.php/admin/profile/edit_chef" method="post" name="formlist" onsubmit="" id="formlist">
                 
                        <!-- Basic Detail -->
                        <div class="basic-details">
                            <h1>Basic Details</h1>
                            <input type="text" placeholder="Name" value="<?php echo $chefdetails['restaurant_name']?>" class="fileldtheme js-placeholder" data-bvalidator="required" data-bvalidator-msg="Please enter  name"  name="name" />
                            
                            <!-- Multi Fields in a Row -->
                            <div class="row">
                            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                	<div class="zip-field">
                            			<input type="text" name="zipcode" value="<?php echo (isset($chefdetails['zip_code']))?$chefdetails['zip_code']:''?>"  placeholder="Zipcode" class="fileldtheme js-placeholder zipcode" data-bvalidator="required" data-bvalidator-msg="Please enter Zipcode" />
                                    </div>
                                </div>
                            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                	<div class="zip-field">
                            			<input type="text" name="city" value="<?php echo isset($chefdetails['city'])?$chefdetails['city']:''?>"  placeholder="City"  class="fileldtheme js-placeholder city"  readonly="readonly" />
                                    </div>
                                </div>
                            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                	<div class="zip-field">
                            			<input type="text" name="state" value="<?php echo (isset($chefdetails['state']))?$chefdetails['state']:'' ?>"  placeholder="State" class="fileldtheme js-placeholder state"  readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <!-- End Multi Fields in a Row -->
                            
                            <input type="text" placeholder="Address"  type="text" name="address" value="<?php  echo $chefdetails['address']?>" placeholder="Address" class="fileldtheme js-placeholder" />
                            
                            <!-- Multi Fields in a Row -->
                            <div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="zip-field">
                            			<input  type="text" name="phone" value="<?php  echo $chefdetails['phone']?>" placeholder="Phone Number" class="fileldtheme js-placeholder"/>
                                    </div>
                                </div>
                                  <?php $type=$result['type'];?>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="zip-field">
                                    <input type="hidden" value="<?php echo $type;?>" />
                            			<select name="type" id="type" class="" >
                                        	<option value="Both" <?php if($type == 'Both' || $type == ''){?> selected="selected"<?php } ?> name="both">Both</option>
                                        	<option value="Pickup" <?php if($type == 'Pickup'){?> selected="selected"<?php } ?>name="pickup" >Pickup</option>
                                        	<option value="Delivery" <?php if($type == 'Delivery'){?> selected="selected"<?php } ?> name="delivery">Delivery</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Multi Fields in a Row -->
                            
                            <textarea placeholder="Description" name="description" id="description"><?php  echo $chefdetails['description']?></textarea>
                            
                            <!-- Opening Time -->
                            <!-- --------------------------------- -->
                                <h6>Opening Time</h6>
                                <div class="opening-title">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="opening-title-box">
                                                <h6>Day</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="opening-title-box">
                                                <h6>Start Time</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="opening-title-box">
                                                <h6>End Time</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Opening Fields -->
                                <div class="opening-fields-main">
                                    <div class="row">
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <label>
                                                    <input class="title-day day" type="checkbox" data-id="mon" name="day[]" value="monday" <?php if($monday!=''){?> checked="checked" <?php }?>  />
                                                    Monday
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <?php  
												$start_at=date("g:i A ", strtotime ($monday['start_at']));
												if($monday['start_at']!=''){
												   
											   ?> 
												<input class="start_at_mon timeIntervals start_at_mon" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly 
                                                 <?php if($monday==''){?>
												 disabled="disabled" <?php }?>/>
												<?php }else{
													?>
												<input class="start_at_mon timeIntervals start_at_mon" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly 
                                                disabled="disabled" />&nbsp;&nbsp;
												<?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <?php $end_at=date("g:i A ", strtotime ($monday['end_at']));?>
												<?php  if($monday['end_at']!=''){?> 
                                                <input  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="start_at_mon timeIntervals end_at_mon"  readonly 
												<?php if($monday==''){?>
                                                 disabled="disabled" <?php }?>/>
                                                <?php  }else{?>
                                                <input class="start_at_mon timeIntervals end_at_mon"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly 
                                                disabled="disabled" />&nbsp;&nbsp;
                                                <?php  }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                    </div>
                                </div>
                                <!-- Opening Fields -->
                            
                                <!-- Opening Fields -->
                                <div class="opening-fields-main">
                                    <div class="row">
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <label>
                                                  <input class="title-day day"  type="checkbox" data-id="tue" name="day[]" value="tuesday" <?php if($tuesday!=''){?> checked="checked" <?php }?> />
                                                    Tuesday
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                               <?php $start_at=date("g:i A ", strtotime ($tuesday['start_at']));?>
											   <?php  if($tuesday['start_at']!=''){?> 
                                                <input class="start_at_mon timeIntervals start_at_tue"  name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly  <?php if($tuesday==''){?>
                                                 disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                                <?php }else{?>
                                                <input class="start_at_mon timeIntervals start_at_tue" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                                <?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                              <?php $end_at=date("g:i A ", strtotime ($tuesday['end_at'])); ?>
												<?php  if($tuesday['end_at']!=''){?> 
                                                <input id="end_at" name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="start_at_mon timeIntervals end_at_tue" readonly <?php if($tuesday==''){?>
                                                 disabled="disabled" <?php }?>/>
                                                <?php  }else{?>
                                                <input class="start_at_mon timeIntervals end_at_tue" id="end_at" name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                                <?php  }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                    </div>
                                </div>
                                <!-- Opening Fields -->
                            
                                <!-- Opening Fields -->
                                <div class="opening-fields-main">
                                    <div class="row">
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <label>
                                                    <input class="title-day day" type="checkbox" value="wednesday" data-id="wed" name="day[]"  <?php if($wednesday!=''){?> checked="checked" <?php }?> />
                                                    Wednesday
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                              <?php $start_at=date("g:i A ", strtotime ($wednesday['start_at']));?>
                                           <?php  if($wednesday['start_at']!=''){?> 
                                            <input class="start_at_mon timeIntervals start_at_wed" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($wednesday==''){?>
                                             disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                            <?php }else{?>
                                            <input class="start_at_mon timeIntervals start_at_wed" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                            <?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                              <?php $end_at=date("g:i A ", strtotime ($wednesday['end_at']));?>
                                            <?php  if($wednesday['end_at']!=''){?> 
                                            <input  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="start_at_mon timeIntervals end_at_wed" readonly <?php if($wednesday==''){?>
                                             disabled="disabled" <?php }?>/>
                                            <?php  }else{?>
                                            <input class="start_at_mon timeIntervals end_at_wed"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                            <?php  }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                    </div>
                                </div>
                                <!-- Opening Fields -->
                            
                                <!-- Opening Fields -->
                                <div class="opening-fields-main">
                                    <div class="row">
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <label>
                                                    <input class="title-day day" type="checkbox" value="thursday" data-id="thu" name="day[]"  <?php if($thursday!=''){?> checked="checked" <?php }?> / />
                                                    Thursday
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                  <?php $start_at=date("g:i A ", strtotime ($thursday['start_at']));?>
												   <?php  if($thursday['start_at']!=''){?> 
                                                    <input class="start_at_mon timeIntervals start_at_thu" id="start_at_thu" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($thursday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                                    <?php }else{?>
                                                    <input class="start_at_mon timeIntervals start_at_thu" id="start_at_thu" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                                    <?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                               <?php $end_at=date("g:i A ", strtotime ($thursday['end_at']));?>
												<?php  if($thursday['end_at']!=''){?> 
                                                <input name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="start_at_mon timeIntervals end_at_thu" readonly <?php if($thursday==''){?>disabled="disabled" <?php }?>/>
                                                <?php  }else{?>
                                                <input class="start_at_mon timeIntervals end_at_thu" name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>"  readonly disabled="disabled"/>&nbsp;&nbsp;
                                                <?php  }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                    </div>
                                </div>
                                <!-- Opening Fields -->
                            
                                <!-- Opening Fields -->
                                <div class="opening-fields-main">
                                    <div class="row">
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <label>
                                                    <input class="title-day day" type="checkbox" value="friday" data-id="fri" name="day[]"  <?php if($friday!=''){?> checked="checked" <?php }?> />
                                                    Friday
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                              <?php $start_at=date("g:i A ", strtotime ($friday['start_at'])); ?>
											   <?php  if($friday['start_at']!=''){?> 
                                                <input class="start_at_mon timeIntervals start_at_fri" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($friday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                                <?php }else{?>
                                                <input class="start_at_mon timeIntervals start_at_fri" name="start_at[]"  value="<?=(isset($start_at))?$start_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                                <?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <?php  $end_at=date("g:i A ", strtotime ($friday['end_at']));?>
												<?php  if($friday['end_at']!=''){?> 
                                                <input name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="start_at_mon timeIntervals end_at_fri" readonly <?php if($friday==''){?>disabled="disabled" <?php }?>/>
                                                <?php  }else{?>
                                                <input class="start_at_mon timeIntervals end_at_fri"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" readonly disabled="disabled"/>&nbsp;&nbsp;
                                                <?php  }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                    </div>
                                </div>
                                <!-- Opening Fields -->
                            
                                <!-- Opening Fields -->
                                <div class="opening-fields-main">
                                    <div class="row">
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <label>
                                                    <input class="title-day day" type="checkbox" value="saturday" data-id="sat" name="day[]"  <?php if($saturday!=''){?> checked="checked" <?php }?> />
                                                    Saturday
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <?php  $start_at=date("g:i A ", strtotime ($saturday['start_at']));?>
											   <?php  if($saturday['start_at']!=''){?> 
                                                <input  class="start_at_mon timeIntervals start_at_sat" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($saturday==''){?> disabled="disabled" <?php }?> />
                                                <?php }else{?>
                                                <input class="start_at_mon timeIntervals start_at_sat" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($saturday==''){?>disabled="disabled" <?php }?> />&nbsp;&nbsp;
                                                <?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                               <?php $end_at=date("g:i A ", strtotime ($saturday['end_at']));?>
												<?php  if($saturday['end_at']!=''){?> 
                                                <input name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="start_at_mon timeIntervals end_at_sat" readonly  <?php if($saturday==''){?>disabled="disabled" <?php }?> />
                                                <?php  }else{?>
                                                <input class="start_at_mon timeIntervals end_at_sat" value="<?=(isset($end_at))?$end_at:''?>" name="end_at[]"  readonly <?php if($saturday==''){?>disabled="disabled" <?php }?> />&nbsp;&nbsp;
                                                <?php  }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                    </div>
                                </div>
                                <!-- Opening Fields -->
                            
                                <!-- Opening Fields -->
                                <div class="opening-fields-main">
                                    <div class="row">
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <label>
                                                    <input class="title-day day" type="checkbox" value="sunday" data-id="sun" name="day[]" <?php if($sunday!=''){?> checked="checked" <?php }?> />
                                                    Sunday
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                                <?php $start_at=date("g:i A ", strtotime ($sunday['start_at']));?>
											   <?php  if($sunday['start_at']!=''){?> 
                                                <input class="start_at_mon timeIntervals start_at_sun" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($sunday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                                <?php }else{?>
                                                <input class="start_at_mon timeIntervals start_at_sun" name="start_at[]" value="<?=(isset($start_at))?$start_at:''?>" readonly <?php if($sunday==''){?>disabled="disabled" <?php }?> />&nbsp;&nbsp;
                                                <?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                        
                                        <!-- Opening Fields Box -->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 display-ful">
                                            <div class="opening-fields-box">
                                               <?php $end_at=date("g:i A ", strtotime ($sunday['end_at']));?>
												<?php  if($sunday['end_at']!=''){?> 
                                                <input  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>" class="start_at_mon timeIntervals end_at_sun" readonly <?php if($sunday==''){?>disabled="disabled" <?php }?>
                                                 />
                                                <?php  }else{?>
                                                <input class="start_at_mon timeIntervals end_at_sun"  name="end_at[]" value="<?=(isset($end_at))?$end_at:''?>"  readonly <?php if($sunday==''){?>disabled="disabled" <?php }?>/>&nbsp;&nbsp;
                                                <?php }?>
                                            </div>
                                        </div>
                                        <!-- End Opening Fields Box -->
                                    </div>
                                </div>
                                <!-- Opening Fields -->
                                
                            <!-- End Opening Time -->
                            <!-- --------------------------------- -->
                            
                            <!-- Time Zone -->
                            <!-- --------------------------------- -->
                                <h6>Time Zone</h6>
                                <div class="time-zone">
                                    <select name="timezone" id="timezone">
                                         <option value="Both"  name="defaulttimezone">Select</option>
										<?php foreach($timezonedetails as $timezone ){ ?>
                                         <option value="<?php echo $timezone['timezone'] ?>" <?php if($timezone['timezone'] == $chefdetails['timezone']){?> selected="selected"<?php } ?>   name="timezone" ><?php echo $timezone['timezone'] ?></option>
                                        <?php }?>       
                                    </select>
                                </div>
                            <!-- End Time Zone -->
                            <!-- --------------------------------- -->
                        </div>
                        <!-- End Basic Detail -->
                        
                        <!-- User Credential -->
                        <div class="user-credential">
                            <h1>User Credentials</h1>
                            
                            <input type="text" name="chefname" value="<?php echo $chefdetails['full_name'] ?>" placeholder="Name" data-bvalidator="required" data-bvalidator-msg="Please enter Chef Name"/>
                            <input type="text" placeholder="Username" name="username" value="<?php echo $chefdetails['username']?>" readonly id="username" />
                            <input type="email" placeholder="Email" name="email" value="<?php echo  $chefdetails['email']?>" data-bvalidator="email,required" data-bvalidator-msg="Please enter valid email id" />
                            <label>
                            	<input type="password" placeholder="Password"  value="**********" readonly id="password"/>
                                <input type="hidden" value="<?php echo $chefdetails['restaurant_id']?>"  id="restaurant_id" name="restaurant_id"/>
                                <input type="hidden" value="<?php echo $chefdetails['location_id']?>" id="location_id" name="location_id"/>
                                 <input type="hidden" value="<?php echo $chefdetails['admin_id']?>" id="admin_id" name="admin_id"/>
                                <a href="javascript:void(0);" class="txt_link" id="change_link" ><span class="mr_2" data-toggle="modal" data-target="#myModal"  data-backdrop="static">Change password?</span></a>
                            </label>
                        </div>
                        <!-- End User Credential -->
                        
                        <!-- Form Buttons -->
                        <div class="profile-form-btns">
                        	<input type="submit" value="Save" />
                            <button>Cancel</button>
                        </div>
                        <!-- End Form Buttons -->
                        <?php }
                        else{ ?>
	  		
						<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
	  
	 				 
                    </form>
                    <?php } ?>
                    <!-- End Profile Form -->
                </div>
                <!-- End Profile Container -->
            </div>
        </section>
        <!-- ===== End Section Profile ===== -->
        
         <!-- Change Password Modal -->
        <div class="change-pass modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
           
        </div>
        <!-- End Change Password Modal -->
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

	
