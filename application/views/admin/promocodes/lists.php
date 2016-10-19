<form name="userMasterForm" id="userMasterForm" action="<?php echo base_url().$this->user->root;?>/promocodes/lists" method="post" >     

<section class="main-sec">
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="menu-tabs location-container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                        	<a href="#tab-promo-codes" aria-controls="promo-codes" role="tab" data-toggle="tab">Promo Codes</a>
                        </li>
                    </ul>
                    <!-- End Nav tabs -->
                    
                    <!-- Tab panes -->
                    <div class="tab-content location-content">
                    	<!-- Location -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-promo-codes">
                        	<!-- Add New Category Button -->
                            <div class="add-new-box">
                             		
                                    <label>
                                    	<input type="text" placeholder="Keyword Search..." onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>">
                                    </label>
                                    <label>
                                    	<input type="button" id="btn_search" value="&#xf002;" class="redSave" style="font-family: FontAwesome;"  />
                                    </label>                                     
                                    <input type="reset" value="Reset" onclick="window.location.href='<?php echo base_url().$this->user->root;?>/promocodes/lists'"/>
                                <a href="<?php echo base_url().$this->user->root;?>/promocodes/add" >Add New</a>
                            </div>
                            <!-- End Add New Category Button -->
                            
                            <!-- Location Table -->
                            <div class="over-scroll">
                                <table class="table table-hover manager-promo-table promo-tble">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Promo code</th>
                                            <th>Valid To</th>
                                            <th>Uses</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    	<?php 
                   
										if(count($promolist)!=0){
										foreach($promolist as $promo){ ?>
										
                                        <tr id="row_<?php echo $promo['promo_id'];?>">
                                            <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" class="full_link">
											<?php echo $promo['title'];?>
                                           </td>
                                           <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>"  class="full_link" >           
                                            <?php echo $promo['promocode'];?>
                                           </td>
                                            
                                            <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" class="full_link">
                                            <?php echo  date("M. d, Y", strtotime ($promo['end_date']));?>
                                         	<td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" class="full_link" >
                                            <?php echo $promo['uses_per_coupon'];?></td>
                                           </td>
                                           <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>"  class="full_link">
                                           <?php if($promo['discount_type']=='Fixed amount'){ echo 'Fixed'; }else{ echo "%"; }?>
                                           </td>
                                            <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>"  class="full_link">
                                            <?php if($promo['discount_type']=='Fixed amount'){echo "$";} echo $promo['discount_amount'];if($promo['discount_type']=='Percentage'){echo " %";};?>
                       						</td>
                                            
                                            <td>
                                            	<a href="<?php  echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                                <a href="javascript:void(0)"  data-attr="<?php echo $promo['promo_id'];?>" class="delItemAjax">
                                                	<i class="fa fa-trash-o"></i> Delete
                                                </a>
                                                
                                            </td>
                                        </tr>
                                         <?php 	}
                       					 } ?>
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Location Table -->
                            
                            <!-- Post Page -->
                            <div class="post-page">
                            	<div class="row">
                                	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 col-lg-offset-10 col-md-offset-10 col-sm-offset-9 col-xs-offset-9 display-ful-480">
                                        
                                        <select name="limit" id="limit" class="" >
                                            <option value="5" <?php if($limit == 5){?> selected="selected"<?php } ?> >5</option>
                                            <option value="10" <?php if($limit == 10){?> selected="selected"<?php } ?> >10</option>
                                            <option value="20" <?php if($limit == 20){?> selected="selected"<?php } ?> >20</option>
                                            <option value="50" <?php if($limit == 50){?> selected="selected"<?php } ?>>50</option>
                                            <option value="100" <?php if($limit == 100){?> selected="selected"<?php } ?>>100</option>
                                            <option value="all" <?php if($limit == 'all'){?> selected="selected"<?php } ?>>ALL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-offset-1 col-lg-10">
                                    <div class="input-group">
                                        <ul class="pagination pull-right" style="margin:0px;">
                                        <?php echo $this->pagination->create_links(); ?>
                                        </ul>
                                    </div>
                            </div>
                            <!-- End Post Page -->
                        </div>
                        <!-- End Location -->
                    </div>
                    <!-- End Tab panes -->
                </div>
                <!-- End Tabs -->
            </div>
        </section>
 
</form>    
<div class="cat-delete modal fade" id="cat-delete" tabindex="-1" role="dialog" aria-labelledby="cat-delete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Delete Promo Code</h6>
                    </div>
                    <!-- End Modal Header -->
                    <input type="hidden" name="" value=""  id="promoDel" />
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <!-- End Modal Body -->
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9 display-ful-480">
                                <button aria-label="Close" type="button" onclick="delPromocode()" data-dismiss="modal">Ok</button>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Footer -->
                </div>
            </div>
        </div>

<script>   
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});
	
	function delPromocode(){
		var delID	=$("#promoDel").val();
		$.ajax({
						type:"post",
						url:"<?php echo base_url().$this->user->root;?>/promocodes/delete",
						data:{'item_id':delID},
						success:function(data){
							
							setTimeout(function(){
								$('.saving').show().html("Promocodes deleted sucessfully");
								$('.saving').fadeOut(5000);
							}, 100);
														
														
							$('#row_'+delID).remove();
							return true;
						}
					});
	}
	$('body').on('click', '.delItemAjax', function (e) {
		var delID	=$(this).attr("data-attr");
		$('#promoDel').val(delID);
		$("#cat-delete").modal('show');
		
		
	});
	
	
 $(document).ready(function(){
    $('.full_link').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
	
	$('.config_link').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
	
  });
// BLock Unblock
	
$('#btn_search').click(
		function(){		
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/promocodes/lists");
				$("#userMasterForm").submit();return true;
	});
	//Change Limit of pagination
	$(document).on('change', '#limit', function() {
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/promocodes/lists");
				$("#userMasterForm").submit();return true;
	});	
	
</script>
<script>
    $('#example3').bind('click', function(e) {
        e.preventDefault();
        $.Zebra_Dialog('Are you sure to delete.?', {
            'type':     'question',
            'title':    'Delete Sides',
            'buttons':  ['OK', 'Cancel'],
            'onClose':  function(caption) {
				if(caption=='OK'){
					alert(caption);
				}else{
					alert(caption);
				}
            }
        });
    });

</script>
