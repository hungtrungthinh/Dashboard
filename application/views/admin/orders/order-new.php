<script>
//if(typeof(EventSource) !== "undefined") {
//   	var source = new EventSource("<?php echo base_url().$this->user->root."/orders/loadNewOrder"?>");
//    source.onmessage = function(event) {
//		var data=event.data;
//		var datas = data.split("###");
//		var count  = datas[0];
//		var content= datas[1];
//       
//		
//		$('#tablebody').html(content);
//		$('#tablebody_tab').html(content);
//		$('#tablebody_mob').html(content);
//	
//		$('#tablebody_tab .hide-desk').removeClass('hide');
//		$('#tablebody_mob .hide-desk').removeClass('hide');
//		
//		$('#tablebody .hide-desk').hide();
//		$('#tablebody_tab .hide-tab').hide();
//		$('#tablebody_mob .hide-mob').hide();
//	
//		$('.facebook').html(	$('#fb_svg').html());
//		$('.web').html(	$('#web_svg').html());
//		$('.app').html(	$('#app_svg').html());
//		//$( "#tablebody_tab .source" ).after("<td  class='tdlink hide-desk'><a class='more-btn' href='#'></a></td>");
//	///	$( "#tablebody_mob .source" ).after("<td  class='tdlink hide-desk'><a class='more-btn' href='#'></a></td>");
//		
//		$('#countnew').html(count);
//		//document.getElementById("countnew").innerHTML = count;
//    };
//} else {
//    document.getElementById("tablebody").innerHTML = "Sorry, your browser does not support server-sent events...";
//}
</script>

<?php if($this->session->flashdata('success_message')!=''){ ?>
 		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success_message'); ?></div>
<?php } ?>

<span id="fb_svg" class="hide">
   
    <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
    <circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
    <text transform="matrix(1 0 0 1 20.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20"></text>
    </svg>
</span>
<span id="web_svg" class="hide">
<!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
<circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
<text transform="matrix(1 0 0 1 16.2852 32.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="18"></text>
</svg>
</span> 
<span id="app_svg" class="hide">
   
<!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
<circle fill="#1C3749" cx="26" cy="26" r="25.364"/>
<text transform="matrix(1 0 0 1 22.2852 33.2441)" fill="#FFFFFF" font-family="'FontAwesome'" font-size="20"></text>
</svg>
</span>  


    <!-- ===== Start Section Main ===== -->
       	<section class="main-sec">
        
        <div class="alert alert-danger hide" role="alert"></div>
        <div class="alert alert-success hide" role="alert"></div>
        
            <div class="container-fluid">
            	<!-- Tabs -->
                <div class="order-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-new" aria-controls="new" role="tab" data-toggle="tab">New 
                        (<span class="countnew" id="countnew"><?php echo $allcounts['newcount']; ?></span>)</a></li>
                        <li role="presentation"><a  href="<?php echo base_url().$this->user->root;?>/orders/accepted" aria-controls="accepted" >Accepted 
                        (<span class="accbadge"><?php echo $allcounts['accepted']; ?></span>)</a></li>
                        <li role="presentation"><a href="<?php echo base_url().$this->user->root;?>/orders/cancelled" aria-controls="declined" >Declined </a></li>
                        <li role="presentation"><a href="<?php echo base_url().$this->user->root;?>/orders/late" aria-controls="late" >Future 
                        (<span class="latecount" id="latecount"><?php echo $allcounts['late']; ?></span>)</a></li>
                        <li role="presentation"><a href="<?php echo base_url().$this->user->root;?>/orders/all" aria-controls="all" >All</a></li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                    	<!-- New -->
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-new">
                        	<!-- DESKTOP OR IPAD VIEW -->
                        	<table class="table table-hover table-dekstop tbl_category">
                                <thead>
                                    <tr>
                                    	<?php if($this->user->role!='3'){?>
                                        <th width="10%">Location</th>
                                        <?php } ?>  
                                        <th>Customer</th>
                                        <th>Created</th>
                                        <th>Expected</th>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th style="text-align:center;">Total</th>
                                        <th style="text-align:center;">SRC</th>
                                      
                                    </tr>
                                </thead>
                                
                                <tbody  class="table_body" id="tablebody">
                                
                                  
                                 
                                   
                                </tbody>
                            </table>
                            <!-- END DESKTOP OR IPAD VIEW -->
                            
                            <!-- TABLET VIEW -->
                        	<table class="table table-tablet table-tablet">
                                <thead>
                                    <tr>
                                        <?php if($this->user->role!='3'){?>
                                        <th width="10%">Location</th>
                                        <?php } ?>  
                                        <th>Customer</th>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th style="text-align:center;">SRC</th>
                                        <th style="text-align:center;">More</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="tablebody_tab">
                                 
                                   
                                   
                                    
                                </tbody>
                            </table>
                            <!-- END TABLET VIEW -->
                            
                            <!-- MOBILE VIEW -->
                        	<table class="table table-mobile">
                                <thead>
                                    <tr>
                                    	
                                        <th>Customer</th>
                                        <th>Type</th>
                                        <th style="text-align:center;">SRC</th>
                                        <th style="text-align:center;">More</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="tablebody_mob">
                                   
                                </tbody>
                            </table>
                            <!-- END MOBILE VIEW -->
                        </div>
                        <!-- End New -->
                        
                        <!-- Accepted -->
                        
                        <!-- End Accepted -->
                        
                        <!-- Declined -->
                       
                        <!-- End Declined -->
                        
                        <!-- Late -->
                       
                        <!-- End Late -->
                        
                        <!-- All -->
                       
                        <!-- End All -->
                    </div>
                    <!-- End Tab panes -->
                </div>
                <!-- End Tabs -->
        
                <!-- Order Detail Modal 1 -->
                <div class="order-detail-modal modal fade bs-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        	<!-- Order Close Modal -->
                            <a href="#" data-dismiss="modal" aria-label="Close" onclick="closeDetail()"><i class="fa fa-times"></i></a>
                            <!-- End Order Close Modal -->
                            
                            <!-- Order Modal Body -->
                            <div class="modal-body">
                                
                            </div>
                            <!-- End Order Modal Body -->
                        </div>
                    </div>
                </div>
                <!-- End Order Detail Modal 1 -->
        
            

            </div>
        </section>
        <!-- ===== End Section Main ===== -->
        
        
<script>
   function closeDetail(){
		//$('#deltime').html('');
		source2.close();
	}
	$(document).ready(function(){
		$('body').on('click', '.trlink', function () {
		//$('.tdlink').click(function(){
			//window.location = $(this).attr('href');
			$('#deltime').html('');
			var order_id = $(this).attr("id");
			$('.loader_home').show();
			//return false;
			$('#detailID').val(1);
				$.ajax({
					url: '<?php echo base_url().$this->user->root;?>/orders/details_ajax',
					type: 'POST',
					data: {'order_id':order_id}, 
					success: function (result) {
						
						$(".order-detail-modal .modal-body").html(result);
						$("#myModal1").modal("show");
						
						$('.loader_home').hide();
						
						
					}
				});  
			
			return false;
		});
	});




//Change Limit of pagination
	$(document).on('change', '#limit', function() {
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/orders/lists");
				$("#userMasterForm").submit();return true;
	});	
	
	
	$('#btn_search').click(
		function(){		
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/orders/lists");
				$("#userMasterForm").submit();return true;
	});
	
	$(document).on('change', '#status', function() {
			$("#userMasterForm").attr("action", "<?php echo base_url().$this->user->root;?>/orders/lists");
			$("#userMasterForm").submit();return true;	
	});
	// END: Change Limit of pagination
	

</script>


<script>

$('body').on('click', '.completed', function () {
	$('#detailID').val(0);
	var order_id = $("#order_id").val();
	//alert(order_id);
	$('.loader_home').show();
	var cnt	= parseInt($('.accbadge').html())-1;
	//return false;
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/completeOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (response) {
				//$('.accbadge').html(cnt);
				var result=$.parseJSON(response);
				//console.log(result);
				$('.countnew').html(result.result.newcount);
				$('.accbadge').html(result.result.accepted);
				$('.latecount').html(result.result.late);
				
				$('#'+order_id).remove();
				$('.alert-success').removeClass('hide');
				$('.alert-success').html('Order completed successfully');
				window.setTimeout(function(){$('.alert-success').addClass('hide');}, 3000);
				
				var rowCount = $('.tbl_category tr').length;
				if(rowCount=='1'){
					$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
				}

				$('.loader_home').hide();
				$("#myModal1").modal('hide');
				//window.load('<?php echo base_url().$this->user->root;?>/orders/lists');
				
            }
        });  

});
$('body').on('click', '.cancel', function (e) {
	var order_id = $("#order_id").val();
	$('#detailID').val(0);
	$('#myModal1').modal('hide');
			e.preventDefault();
			$.Zebra_Dialog('Are you sure you want to decline this order?', {
						'type':     'question',
						'title':    'Decline order',
						'buttons':  ['OK','Cancel'],
						'onClose':  function(caption) {
						if(caption=='OK'){
						$('.loader_home').show();
							$.ajax({
								url: '<?php echo base_url().$this->user->root;?>/orders/cancelOrder',
								type: 'POST',
								data: {'order_id':order_id}, 
								success: function (result) {
									
									if(result=='success')
									{
										
										$('#'+order_id).remove();
										$('.alert-success').show();
										$('.alert-success').html('Order cancelled successfully');
										var rowCount = $('.tbl_category tr').length;
										if(rowCount=='1'){
											$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
										}
						
										//window.location.href="<?php echo base_url().$this->user->root;?>/orders/lists";
									}
									else
									{
										$('.alert-danger').removeClass('hide');
										$('.alert-danger').html('Unknown error occured');
										$("html, body").animate({ scrollTop: 0 }, "fast");
										window.setTimeout(function(){$('.alert-danger').addClass('hide');;}, 3000);
									}
									$("#myModal1").modal('hide');
									$('.loader_home').hide();
									}
							});  
							return true;
						}else{
							return false;
						}
					}
			});

	
        

});

$('body').on('click', '.accept', function () {
	var order_id = $("#order_id").val();
	$('.loader_home').show();
	//return false;
	var cnt	= parseInt($('.accbadge').html())+1;

        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/acceptOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (response) {
				var result=$.parseJSON(response);
				console.log(result);
				$('.acbtncls').hide();
				$('.cmpbtncls').show();
				//$('.accbadge').html(cnt);
				$('.countnew').html(result.result.newcount);
				$('.accbadge').html(result.result.accepted);
				$('.latecount').html(result.result.late);
				//alert($('#hidecount').val());
				var cnt11=parseInt($('#hidecount').val())-1;
				$('#hidecount').val(cnt11);
				/*$('#row_'+order_id).remove();
					$('.alert-success').show();
					$('.alert-success').html('order accepted successfully');
					var rowCount = $('.tbl_category tr').length;
					if(rowCount=='1'){
						$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
					}
	
					$('.loader_home').hide();
				*/
				
            }
        });  

});

</script>
<style>
.ZebraDialog{
z-index:9999999999!important;
}
</style>