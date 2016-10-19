   
<script>

	function submitForm(){
		$("#frmPack").submit();
	 }
 
 
		 
	function cancel()
	{
	
	window.location.href = "<?php echo base_url()?>admin/home";
	}
</script>
  <?php 
  $this->load->library('session');
 
  ?>

  <!-- ===== Section Sign In ===== -->
        <section class="preferences">
        	<div class="container">
            	<div class="row">
                	<div class="col-lg-5 col-md-5 col-sm-6 col-xs-10 col-center">
                    	<div class="preferences-main">
                        	<h1>Preferences Details</h1>
                            
                            <!-- Preferences Form -->
                            <div class="preferences-form">
                            	<form method="post" name="formlist"  id="formlist" action=""  onsubmit="">
                                  <?php $i=0; foreach($configlist as $pref){?>
                                    <div class="input-group">
                                     <input type="hidden" placeholder="<?php echo $pref->title; ?>" class="form-control" name="title[]" id="<?php echo $pref->title; ?>"  value="<?php echo $pref->id; ?>">
                                        <input type="text"  placeholder="<?php echo $pref->title; ?>" name="<?php echo $pref->id; ?>" id="<?php echo $pref->field; ?>"  value="<?php echo$pref->value;  ?>">
                                      
                                        <div class="input-group-addon"><?php echo $pref->title; ?></div>
                                    </div>
                                    <?php } ?>
                                  
                                    
                                    <div class="row">
                                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    		<input type="submit" value="Submit">
                                        </div>
                                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    		<button onclick="cancel();">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Preferences Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===== End Section Sign In ===== -->