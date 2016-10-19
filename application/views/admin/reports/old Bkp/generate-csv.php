 <form name="form-sales" method="post" action="<?php echo base_url()?>admin/reports/csv">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
		  <div class="col-md-5 col-sm-5">
            <label for="textinput" class="control-label">Select Fields</label>
		</div>
		<div class="col-md-1 col-sm-1">:
		  </div>
			<div class="col-md-6 col-sm-6">
           
	<select name='feilds[]' size=4 multiple id="feilds" >
        <option value='order_ref_id ' selected="selected">Order ID</option>
        <option value='restaurant_name' selected="selected">Location</option>
        <option value='first_name' selected="selected">Customer Name</option>
        <option value='order_type' selected="selected">Order Type</option>
        <option value='total_amount' selected="selected">Total Amount</option>
        <option value='created_time' selected="selected">Ordered Date</option>
	 </select>
    
			</div>
          </div>
		  <div class="clearfix"></div>
          <div class="clearfix"></div>
       <input type="hidden" value="<?php echo $_POST['limit'];?>" name="limit" />
        <input type="hidden" value="<?php echo $_POST['per_page'];?>" name="per_page" />
      <div class="form-group">
		  <div class="col-md-5 col-sm-5">
            <label for="textinput" class="control-label">Data</label>
		</div>
		<div class="col-md-1 col-sm-1">:
		  </div>
			<div class="col-md-5 col-sm-5">
			<input type="radio" value="all"   name="page" checked="checked"/>AllPages
            <input type="radio" value="single" name="page" />CurrentPage
			</div>
          </div>
		  <div class="clearfix"></div>
          <input type="hidden" name="startdate" id="startdate" value="<?php echo $start; ?>">
          <input type="hidden" name="enddate" id="enddate" value="<?php echo $end; ?>">
         <button type="submit" class="btn btn-default  pull-right" >
         EXPORT</button>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>
  </div>
  </form>
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