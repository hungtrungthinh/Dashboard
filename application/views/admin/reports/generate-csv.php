
         <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Export Sale Details</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Form -->
                      <form name="form-sales" method="post" action="<?php echo base_url()?>admin/reports/csv">
                        <!-- Modal Body -->
                        <div class="modal-body">                            
                            <select name='feilds[]' size=4 multiple id="feilds" style=" height:160px;" >
                                <option value='order_ref_id ' selected="selected">Order ID</option>
                                <option value='restaurant_name' selected="selected">Location</option>
                                <option value='first_name' selected="selected">Customer Name</option>
                                <option value='order_type' selected="selected">Order Type</option>
                                <option value='total_amount' selected="selected">Total Amount</option>
                                <option value='created_time' selected="selected">Ordered Date</option>
                             </select>
                        </div>
                        <!-- End Modal Body -->
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<input type="submit" value="Export">
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            		<button aria-label="Close" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Footer -->
                        <input type="hidden" value="<?php echo $_POST['limit'];?>" name="limit" />
                		<input type="hidden" value="<?php echo $_POST['per_page'];?>" name="per_page" />
                        
                
                			<!--<input type="radio" value="all"   name="page" checked="checked"/>AllPages
                			<input type="radio" value="single" name="page" />CurrentPage-->
                            
                		<input type="hidden" name="startdate" id="startdate" value="<?php echo $start; ?>">
                		<input type="hidden" name="enddate" id="enddate" value="<?php echo $end; ?>">
                        
                     </form>
                    <!-- End Form -->
                </div>
            </div>


                
        

 <script>



 function csvgenerate(){
	 var fld = document.getElementById('feilds');
	 var values = [];
for (var i = 0; i < fld.options.length; i++) {
  if (fld.options[i].selected) {
    values.push(fld.options[i].value);
  }
}
var page = $("input[name='page']:checked").val();
/*$.ajax({
	type:"post",
	url:"<?php echo base_url(); ?>admin/reports/csv",
	data:{'feilds':values,'page':page,'limit':<?php echo $_POST['limit'];?> ,'per_page':<?php echo $_POST['per_page'];?> },
	success:function(data){
			
	
		}
	});*/
$("#form-sales").attr("action", "<?php echo base_url()?>admin/reports/csv");
			$("#form-sales").submit();return true;
	
}	
</script>