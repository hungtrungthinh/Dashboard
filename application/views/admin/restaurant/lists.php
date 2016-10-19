
<script language="javascript">

function toggleStatus(id,status,statusdiv){
		$.ajax({
					url: "<?php echo base_url()?>admin/users/ajaxstatus",
					data : {id:id,status:status,statusdiv:statusdiv},
					success: function(result){	
					
					window.location.reload();
						
				}
			
				});		
	
	}	
	
function toggleblock(id,block,blockdiv){
		$.ajax({
					url: "<?php echo base_url()?>admin/users/ajaxblock",
					data : {id:id,block:block,blockdiv:blockdiv},
					success: function(result){	
					//alert(result);return false;
					window.location.reload();
						
				}
			
				});		
	
	}	
		


$(document).ready(function(){
// function to delete masteraction 
	$("#deleteSel").click(function(){
		var chkCnt	=	$(".chk:checked").length;
		if(chkCnt==0){
			//alert("Please select at least one user.!");
			showMessageBox('Select atleast one item','danger');
			return false;
		}
		
			if(confirm('Are you sure to delete the selected user(s)?')){
				$("#userMasterForm").attr("action", "<?php echo site_url("admin/restaurant/index");?>");
				$("#bulkaction_list").val('delete_list');
				$("#actions").val("delete");
				$("#userMasterForm").submit();return true;
			}
			
});
	
	
// function to delete product 
$("#bulkaction").change(function(){
	
		var chkCnt	=	$(".chk:checked").length;
		var action	=	$("#bulkaction").val();		
		if(chkCnt==0){
			alert("Please select at least one user.!");
			return false;
		}
		else if(action == 'delete'){
			if(confirm('Are you sure to delete the selected user(s)?')){
				$("#userMasterForm").attr("action", "<?php echo site_url("admin/restaurant/bulkAction");?>");
				$("#userMasterForm").submit();return true;
			}
			else{
				return false;
			}	
		
		}
		else if(action == 'active' || action == 'inactive'){
			if(confirm('Are you sure to change status of the selected user(s)?')){			
				$("#userMasterForm").attr("action", "<?php echo site_url("admin/restaurant/bulkAction");?>");
				$("#userMasterForm").submit();return true;
			}
			
			else{
				return false;
			}	
		
		}
		else{
			alert("Please specify any action.!");
			return false;
		}
});
	
// filter function
$("#filter_button").click(function(){
			$("#userMasterForm").submit();return true;	
});
// End : filter function
		
//check all
$('#select_all').click(	function(){
	//alert("s");
		if($('#select_all').is(':checked'))
		$('.chk').prop('checked',true);
		else
			$('.chk').prop('checked',false);
});
// end check all
	
//check all
$('.sortlink').click(
		function(){
		var feild = $(this).attr('rel');
		var title = $(this).attr('title');
		
		$(this).removeAttr('title');
		if(title =='ASC'){
			$(this).attr('title', 'DESC');
		}
		else{	
			$(this).attr('title', 'ASC');
		}
		$('#order_by_field').val(feild);
		$('#order_by_value').val($(this).attr('title'));
		$("#userMasterForm").attr("action", "<?php echo site_url("admin/restaurant/lists");?>");
		$("#userMasterForm").submit();return true;	
});
// END: check all
	
//Change Limit of pagination
	$(document).on('change', '#limit', function() {
		
			$("#userMasterForm").attr("action", "<?php echo site_url("admin/restaurant/lists");?>");
				$("#userMasterForm").submit();return true;
	});	
	
	
	$('#btn_search').click(
		function(){		
			$("#userMasterForm").attr("action", "<?php echo site_url("admin/restaurant/lists");?>");
				$("#userMasterForm").submit();return true;
	});
	
	$(document).on('change', '#status', function() {
			$("#userMasterForm").attr("action", "<?php echo site_url("admin/restaurant/lists");?>");
			$("#userMasterForm").submit();return true;	
	});
	// END: Change Limit of pagination
	
});




</script>



<form name="userMasterForm" id="userMasterForm" method="post" action="">
    <input type="hidden" name="order_by_field" id="order_by_field" value="" />
    <input type="hidden" name="order_by_value" id="order_by_value" value="" />
    <input type="hidden" name="actions" id="actions" value="" />
    <div class="row" id="Title">
  	
  	</div>

  <div class="row form-group">
        <div class="col-offset-1 col-lg-3">
    		<div class="input-group">
 				<span class="input-group-addon">
        			<i class="glyphicon glyphicon-map-marker"></i> 
     			</span>	
	  			<select name="bulkaction" id="bulkaction" class="form-control" >
                    <option value="" <?php if($bulkaction ==''){?> selected="selected"<?php } ?> >Bulk actions</option>
                    <option value="delete" <?php if($bulkaction == 'delete'){?> selected="selected"<?php } ?> >Delete</option>
	  			</select>
	 
			 </div><!-- /input-group -->
         </div>
  
		<div class="col-offset-1 col-lg-3">
            <div class="input-group">
             <span class="input-group-addon">
        		<i class="glyphicon glyphicon-map-marker"></i> 
      		</span>	
	  		<select name="status" id="status" class="form-control" >
                <option value="" <?php if($status ==''){?> selected="selected"<?php } ?> >Filter by Status</option>
                <option value="Y" <?php if($status == 'Y'){?> selected="selected"<?php } ?> >Unblock</option>
                <option value="N" <?php if($status == 'N'){?> selected="selected"<?php } ?> >Block</option>
			</select>
	 
    		</div><!-- /input-group -->
 		</div>
  
          <div class="col-lg-6">
     		<div class="input-group">
   			  <input type="text" class="form-control" placeholder="Keyword Search" onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>">
      				<span class="input-group-btn btn_search">
     					 <button class="btn btn-info " id="btn_search" type="button">Go!</button>
     				</span>
	  				<span class="input-group-btn btn_search">
                          <a href="javascript:" onclick="window.location.href='<?php echo base_url()?>index.php/admin/restaurant/lists'" class="blu_btn">
                          <button class="btn btn-default" type="button">Reset</button></a>
	  				</span>
    		 </div><!-- /input-group --> 	
   		 </div>
         
 </div>
	<div class="col-lg-12">
			<a href="<?php echo base_url(); ?>index.php/admin/restaurant/add" class="pull-right btn btn-info">Add New</a>
        </div>
      <table class="table table-bordered table-hover"> 
             <thead>
              <tr>
                <th><center><input  type="checkbox" name="select_all"  id="select_all" ></center></th>
                <th colspan="1"><span class="link_blak" >Actions</span></th>
                <th>ID</th>
                <th>Restaurant Name</th>
                <th>Manager</th>
                <th>Contact Number</th>
                <th>User Name</th>
                <th>Action</th>
                <th>FB API Creation</th>
                <th>Forkourse Stripe State</th>
                <th>Forkourse Stripe Percentage</th>
              </tr> 
            </thead>
			<tbody>
				 <?php if(sizeof($userlist) > 0)  : ?>
                 <?php foreach($userlist as $val) : ?>
              <tr>
				<td>
                	<center>
                   	 <input  type="checkbox" name="sel[]" value="<?php echo $val['restaurant_id']?>"  rel="" class="chk"  />
                    </center>
				</td>
        		<!--<td>
                	<center>
                    	<a href="<?php echo base_url();?>admin/restaurant/bulkAction/delete/<?php echo $val['restaurant_id']; ?>?limit=<?php echo $limit;?>&per_page=<?php echo $per_page;?>" onclick="return confirm('Are you sure you want to delete?');"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
            		</center>
        		</td>-->
				
                <td>
                <center>
						<a href="<?php echo base_url()?>index.php/admin/restaurant/edit/<?php echo $val['restaurant_id'];?>" class="link1">
    <i class="glyphicon glyphicon-edit" title="Edit Details"></i></a>
    			</center>
               </td>
               
               
               <td><center><?php echo $val['restaurant_id'];?></center></td>
               
               
			   <td>
               			<a href="<?php echo base_url();?>index.php/admin/restaurant/edit/<?php echo $val['restaurant_id'];?>" class="link1"><?php echo $val['name'];?></a>
      		   </td>
			   <td>
               			<a href="<?php echo base_url();?>index.php/admin/restaurant/edit/<?php echo $val['restaurant_id'];?>" class="link1"><?php echo $val['full_name']; ?></a>
               </td>
  			   <td>
               			<a href="<?php echo base_url();?>index.php/admin/restaurant/edit/<?php echo $val['restaurant_id'];?>" class="link1"><?php echo $val['phone']; ?></a>
               </td>
               <td>
               			<a href="<?php echo base_url();?>index.php/admin/restaurant/edit/<?php echo $val['restaurant_id'];?>" class="link1"><?php echo $val['username']; ?></a>
               </td>
               <td>
             			  <a class="block" data-id="<?php echo $val['restaurant_id'];?>" data-block="<?php echo $val['status'];?>" id="block_<?php echo $val['restaurant_id']; ?>" href="javascript: void(0)">	  <?php if($val['status'] == 'N'): ?><img src="<?php echo base_url() ?>assets/images/block.png" alt="" class="tmg25">
                <?php else: ?><img src="<?php echo base_url() ?>assets/images/unblock.png" alt="" class="tmg25"><?php endif; ?>
                 </a>
               </td>
              
               <td>
               			<a href="<?php echo base_url();?>index.php/admin/restaurant/apiGenarete/<?php echo $val['restaurant_id'];?>" class="link1">Create</a>
               </td>
               <td align="center">
               		<a class="state" data-id="<?php echo $val['restaurant_id'];?>" data-state="<?php echo $val['forkourse_stripe_status'];?>" id="state_<?php echo $val['restaurant_id']; ?>" href="javascript: void(0)">	  <?php if($val['forkourse_stripe_status'] == 0): ?><img src="<?php echo base_url() ?>assets/images/turn-off.png" alt="" class="tmg25">
                <?php else: ?><img src="<?php echo base_url() ?>assets/images/turn-on.png" alt="" class="tmg25"><?php endif; ?>
               </td>
               <td align="center">
               		<a href="<?php echo base_url();?>index.php/admin/restaurant/edit/<?php echo $val['restaurant_id'];?>" class="link1"><?php echo sprintf("%.2f ", $val['forkourse_stripe_percentage']) . "%"; ?></a>
               </td>
               
			</tr>
			 <?php endforeach; ?>
             <?php else: ?>
	  		<tr>
            	<td  colspan="8">No records...</td>
            </tr>
				  <?php endif; ?>
			</tbody>
		</table>
  <?php if(sizeof($userlist) > 0) { ?>       
  <div class="row" id="Table footer">
    <div class="col-lg-12 ">
		<div class="col-offset-1 col-lg-2 pull-right">
			<div class="input-group">
			  <span class="input-group-addon">
				<i class="glyphicon glyphicon-map-marker"></i> 
			  </span>
			  <select name="limit" id="limit" class="form-control" >
					<option value="5" <?php if($limit == 5){?> selected="selected"<?php } ?> >5</option>
					<option value="10" <?php if($limit == 10){?> selected="selected"<?php } ?> >10</option>
					<option value="20" <?php if($limit == 20){?> selected="selected"<?php } ?> >20</option>
					<option value="50" <?php if($limit == 50){?> selected="selected"<?php } ?>>50</option>
					<option value="100" <?php if($limit == 100){?> selected="selected"<?php } ?>>100</option>
					<option value="all" <?php if($limit == 'all'){?> selected="selected"<?php } ?>>ALL</option>
				</select>
			</div><!-- /input-group -->
		</div>
		
		<div class="col-offset-1 col-lg-10">
				<div class="input-group">
					<ul class="pagination pull-right" style="margin:0px;">
					<?php echo $this->pagination->create_links(); ?>
					</ul>
				</div>
		</div>
    </div>
  </div>
 <?php }?>
</form>
  

<script>
  $(document).ready(function(){
    $('.full_link').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
  });
// BLock Unblock
	$('.block').click(function(){
          
		var restaurant_id = $(this).data('id');
		var selector = '#' + 'block_' + restaurant_id + " " + 'img';
		var imgsrc = $(selector).attr('src');       
		var status = $(this).data('block');
		var $this  = $(this);
		$.ajax({
            type : "POST",
            url  : "<?php echo site_url('admin/restaurant/ajaxblock'); ?>",
            data : {is_block: status, id:restaurant_id}, 
            cache : false,
            success : function(res) {
			 window.location.reload();
				if(res=='Y'){
				  	 $this.data('block','Y');
				 	 $(selector).attr('src',"<?php echo base_url() ?>assets/images/unblock.png");
					
				}
				else if(res=='N'){
					$this.data('block','N');
				 	$(selector).attr('src',"<?php echo base_url() ?>assets/images/block.png");
					
				}
            }
         });  
	}); //END: BLock Unblock
	$('.state').click(function(){
          
		var restaurant_id = $(this).data('id');
		var selector = '#' + 'state_' + restaurant_id + " " + 'img';
		var imgsrc = $(selector).attr('src');       
		var status = $(this).data('state');
		var $this  = $(this);
		$.ajax({
            type : "POST",
            url  : "<?php echo site_url('admin/restaurant/ajaxstate'); ?>",
            data : {is_on: status, id:restaurant_id}, 
            cache : false,
            success : function(res) {
			 window.location.reload();
				if(res=='1'){
				  	 $this.data('state','1');
				 	 $(selector).attr('src',"<?php echo base_url() ?>assets/images/turn-on.png");
					
				}
				else if(res=='0'){
					$this.data('state','0');
				 	$(selector).attr('src',"<?php echo base_url() ?>assets/images/turn-off.png");
					
				}
            }
         }); 
	}); //END: BLock Unblock
function toggleblock(id,block,blockdiv){

        if(block	== 'N'){
		var cofrm=confirm('Are you sure you want to Unblock ?');
		}
		else{
		var cofrm=confirm('Are you sure you want to Block ?');
		}
        if(cofrm	== true){
		$.ajax({    type:"get",
					url: "<?php echo base_url()?>admin/restaurant/ajaxblock",
					data : {id:id,block:block,blockdiv:blockdiv},
					success: function(result){	
					//alert(result);return false;
						window.location.reload();
						
				}
			
				});		
	     }
	}	
		
</script>
	  
 