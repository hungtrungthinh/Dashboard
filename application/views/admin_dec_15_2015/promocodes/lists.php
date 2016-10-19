<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets');?>/js/zebra_dialog.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zebra_dialog.css" type="text/css">	
	<?php if($this->session->flashdata('error_message')!=''){ ?>
 		<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-danger" role="alert" style="display:none;"></div>
    <?php } ?>
    <?php if($this->session->flashdata('success_message')!=''){ ?>
 		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success_message'); ?></div>
    <?php }else{ ?>
 		<div class="alert alert-success" role="alert" style="display:none;"></div>
    <?php } ?>
<form name="userMasterForm" id="userMasterForm" action="<?php echo base_url().$this->user->root;?>/customers/lists" method="post" >     
	<div  class="tab_wrper" style="padding:10px;">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class="active tog_tab" role="presentation">
     	 <a aria-expanded="true" aria-controls="category" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/promocodes/lists">Promo codes</a>		
      </li>
       <div class="col-lg-7 col-md-7 col-sm-7">
     		<div class="input-group">
   			  <input type="text" class="form-control col-lg-5 " placeholder="Keyword Search" onFocus="if(this.value=='Keywords')this.value=''" onBlur="if(this.value=='')this.value=''" name="key" id="key" value="<?php if($key != ''){ echo $key;}else{ echo '';}?>">
      				<span class="input-group-btn btn_search">
     					 <button class="btn btn-info " id="btn_search" type="button">Go!</button>
     				</span>
	  				<span class="input-group-btn btn_search">
                          <a href="javascript:" onclick="window.location.href='<?php echo base_url().$this->user->root;?>/promocodes/lists'" class="blu_btn">
                          <button class="btn btn-default" type="button">Reset</button></a>
	  				</span>
    		 </div><!-- /input-group --> 	
          
   		 </div>
         <div class="col-lg-1 pull-right "><a href="<?php echo base_url().$this->user->root;?>/promocodes/add" class="btn btn-info">Add New</a></div>
	</li>
    </ul>
     
<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">  
        
    <div aria-labelledby="category-tab" id="category"  role="tabpanel"> 
         
		<div class="table-responsive"> 
    		  <table class="table table-striped tbl_category">
                  <thead class="head_table">
                    <tr>
                     
                      <th class="col-md-2 col-sm-2">Title</th>
                      <th class="col-md-1 col-sm-1">Promo code</th>
                    <!--  <th class="col-md-2 col-sm-2">Valid From</th>-->
                      <th class="col-md-2 col-sm-2">Valid To</th>
                      <th class="col-md-1 col-sm-1">Uses</th>
                      <th class="col-md-2 col-sm-2">Type</th>
                      <th class="col-md-1 col-sm-1">Amount</th>
                       <th class="col-md-2 col-sm-3"  >Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table_body">
                    
                    
                    <?php 
                   
                    if(count($promolist)!=0){
                    foreach($promolist as $promo){ ?>
                    <tr id="row_<?php echo $promo['promo_id'];?>">
                    
                       
                     
                       <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" style="cursor:pointer;" class="full_link">
                        <?php echo $promo['title'];?>
                       </td>
                       <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" style="cursor:pointer;" class="full_link" >           
                        <?php echo $promo['promocode'];?>
                       </td>
                        <!--<td href="<?php echo base_url().$this->user->root;?>/promocodes/add" style="cursor:pointer;" class="full_link">
						<?php echo date("d-m-Y", strtotime ($promo['from_date']));?></td>-->
                        <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" style="cursor:pointer;" class="full_link">
						<?php echo  date("M. d, Y", strtotime ($promo['end_date']));?>
                      <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" style="cursor:pointer;" class="full_link" >
                        <?php echo $promo['uses_per_coupon'];?></td>
                       </td>
                       <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" style="cursor:pointer;" class="full_link">
                        <?php echo $promo['discount_type'];?>
                       </td>
                        <td href="<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" style="cursor:pointer;" class="full_link">
                        <?php if($promo['discount_type']=='Fixed amount'){echo "$";} echo $promo['discount_amount'];if($promo['discount_type']=='Percentage'){echo " %";};?>
                       </td>
                      
                     <td>
                        
                        <a href="<?php  echo base_url().$this->user->root;?>/promocodes/add/<?php echo $promo['promo_id'] ?>" class="full_link"> <button class="btn btn_gray" type="button">EDIT</button></a>
                        <a href="javascript:void(0)"  data-attr="<?php echo $promo['promo_id'];?>" class="delItemAjax">
                <button class="btn btn_gray" type="button">DELETE</button>
                </a>
       				</td>
                                
                    </tr>
                    
                    <?php 	}
                        }else { ?>
                        
                      <tr>
                      <td colspan="8">
                      No Promocodes...
                      </td>
                      </tr>
                   <?php } ?>
                    
                  </tbody>
                </table>
                </div>
                </div>
                </div>
          <?php if(count($promolist)!=0){?>
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
  <?php } ?>
  </div>
 </form>      
<script>   
	$(document).ready(function(){
		$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});
	$('body').on('click', '.delItemAjax', function (e) {
		
		var item_id	=$(this).attr("data-attr");
		e.preventDefault();
        $.Zebra_Dialog('Are you sure to delete.?', {
            'type':     'question',
            'title':    'Delete Promocodes',
            'buttons':  ['OK', 'Cancel'],
            'onClose':  function(caption) {
				if(caption=='OK'){
					$.ajax({
						type:"post",
						url:"<?php echo base_url().$this->user->root;?>/promocodes/delete",
						data:{'item_id':item_id},
						success:function(data){
							
							setTimeout(function(){
								$('.saving').show().html("Promocodes deleted sucessfully");
								$('.saving').fadeOut(5000);
							}, 100);
														
														
							$('#row_'+item_id).remove();
							return true;
						}
					});
				}else{
					return false;
				}
            }
        });
		
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
<style>
.nav-tabs {
    border-bottom: 11px solid #ffffff!important;
}
.nav-tabs > li {
    margin-left: -1px!important;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fff;
    border-image: none;
    border-style: solid;
    border-width: 1px;
    color: #555;
    cursor: default;
}
</style>