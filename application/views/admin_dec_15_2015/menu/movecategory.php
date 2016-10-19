<link href="<?php echo base_url() ?>assets/css/bvalidator.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery.bvalidator.js"></script>

<div class="modal-dialog cust_dilog">
    <div class="modal-content ">
      <div class="modal-header" style="background-color:#DF7707 ;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Move Category</h4>
      </div>
      <div class="modal-body">
        <div id="MainMenu">
		  <div class="list-group panel">
                <form class="form-horizontal" role="form" action="" method="post" name="change" onsubmit="" id="change">
                <span id="sucessmsg" class="text-success"></span>
		   			<!-- Text input-->
 		  			 <div class="form-group">
                     <input type="hidden" value="<?php echo $category_id ?>" />
            			<label class="col-sm-4 control-label" for="textinput">Select Category</label>
            				<div class="col-sm-8">
                                 <select id="cat"  name="category">
                    <option value="0" selected="selected">CATEGORY</option>
                    <?php 
                    $i = 0;
                    while($i < count($category)){
                    
                      $cat_name= $category[$i]['category_name'];
                      $cat_id= $category[$i]['category_id'];
                    ?>
                    
                    <option value='<?php echo $cat_id?>' <?php if($cat_id== $_REQUEST['category']||$cat_id==$catid) { ?>selected="selected"<?php } ?>><?php echo $cat_name ?></option>
                    
                     <?php $i++;
                    }?>
			</select>
               		         </div>
          			</div>	    
        			
                 <button type="button" class="btn btn-default pull-right " data-dismiss="modal" aria-label="Close" onclick="cancel();"><span aria-hidden="true">Cancel</span></button>  
                <button type="button" class="btn btn-info pull-right" name="pwd_btn"  id="pwd_btn" onclick="CategoryChange();">Save</button>
                <input type="hidden" value="<?php echo $category_id;?>" id="category_id"  />
			   
                </form>
		  </div>
		</div>
      </div>

    </div>
  </div>
<script>

		
		function cancel()
	{
	
	$("#myModal").hide();
	}
</script>