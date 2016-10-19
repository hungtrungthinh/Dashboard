<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
</style>
 <div class="container"> 
	<div class="clearfix">&nbsp;</div>
    <div class="col-md-12">
    
 <div id="myTabContent" class="tab-content tab_contwp dish_cat_tab">
    <div role="tabpanel" class="" id="category" aria-labelledby="category-tab">
        <div class="table-responsive"> 
        <span><h4>Order Details</h4></span>
        <?php /*?><span class="pull-right"><a href="<?php echo base_url()?>admin/orders/accepted" class="btn btn-info" >CANCEL</a></span><?php */?>
          
         <table class="table table-striped tbl_category" style="border:1px solid #f2f2f2;">
          <thead class="head_table">
            <tr>
              <th class="col-md-2 col-sm-2">ORDER ID</th>
              <th class="col-md-2 col-sm-2">ITEM NAME</th>
              <th class="col-md-2 col-sm-2">QUANTITY</th>
              <th class="col-md-2 col-sm-2">UNIT PRICE</th>
              <th class="col-md-2 col-sm-2">PRICE</th>
            </tr>
          </thead>
          <tbody class="table_body">
    	<?php foreach($details as $items){ ?>
               <tr>
                <td><?php echo $items['order_ref_id'];?></td>
                <td><?php echo $items['item_name'];?></td>
                <td><?php echo $items['quantity'];?></td>
                <td><?php echo $items['unit_price'];?></td>
                <td><?php echo $items['price'];?></td>
              </tr>
          
        <?php } ?>
        <tr>
          <td class="text-right" colspan="4"><span><b>Total:&nbsp;($)&nbsp;&nbsp;</b><span><span></span></span></span></td><td>
          <?php echo $details[0]['total_amount'];?>
          </td></tr>
       </tbody>
      </table>

         </div>
      </div>
    </div>
 	
    </div>
	</div><!-- /.row -->
	<div class="clearfix">&nbsp;</div>

</div><!-- /.container -->



