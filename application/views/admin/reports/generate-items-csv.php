
         <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <a aria-label="Close" data-dismiss="modal" href="#"><i class="fa fa-times"></i></a>
                        <h6>Export Sale Details</h6>
                    </div>
                    <!-- End Modal Header -->
                    
                    <!-- Form -->
 					<form name="form-sales" method="post" action="<?php echo base_url()?>admin/reports/item_csv">
                        <!-- Modal Body -->
                        <div class="modal-body">                            
                            <select name='feilds[]' size=4 multiple id="feilds" style=" height:160px;" >
                                <option value='item_name' selected="selected">Item Name</option>
                                <option value='delivery' selected="selected">Delivery</option>
                                <option value='pickup' selected="selected">Pick Up</option>
                                <option value='facebook' selected="selected">Facebook</option>
                                <option value='app' selected="selected">App</option>
                                <option value='website' selected="selected">Website</option>
                                 <option value='breakfast' selected="selected">Breakfast</option>
                                <option value='lunch' selected="selected">Lunch</option>
                                <option value='dinner' selected="selected">Dinner</option>
                                <option value='total' selected="selected">Total</option>
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