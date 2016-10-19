
        <!-- ===== Section Profile ===== -->
        <section class="profile">
        	<div class="container">
            	<!-- Profile Container -->
                <div class="profile-container">
                	<!-- Profile Form -->
                     <?php	if($error=='') { ?>
                 	<form role="form" action="<?php echo base_url()?>index.php/admin/customers/edit/<?php echo $result['member_id']; ?>" method="post" name="formlist" onsubmit="<?php echo base_url()?>index.php/admin/customers/edit/<?php echo $result['member_id']; ?>" id="formlist">
                        <!-- Basic Detail -->
                        <div class="basic-details">
                            <h1>Customer Details</h1>
                            <input type="text" placeholder="Name" value="<?php echo $result['first_name'];?> <?php echo $result['last_name'];?>" class="fileldtheme js-placeholder"  name="name" />
                            
                            <!-- Multi Fields in a Row -->
                            <div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="zip-field">
                            			<input type="text" name="zipcode" value="<?php echo $result['email'];?>"  placeholder="Email" class="fileldtheme js-placeholder zipcode"  />
                                    </div>
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                	<div class="zip-field">
                            			<input type="text" name="city" value="<?php $result['phone'];?>"  placeholder="Phone"  class="fileldtheme js-placeholder city"  readonly="readonly" />
                                    </div>
                                </div>
                            	
                            </div>
                            <!-- End Multi Fields in a Row -->
               				<?php $date= date("M d, Y h:i A ", strtotime ($result['created_date'])); ?>
                            <input type="text" placeholder="Join Date"  type="text" name="address" value="<?php echo $date;?>" class="fileldtheme js-placeholder" />
                            
                          
                         
                         
                        </div>
                        <!-- End Basic Detail -->
         				<input type="hidden" value="<?php echo $result['member_id'];?>" id="member_id" />
                      
                     
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
        






