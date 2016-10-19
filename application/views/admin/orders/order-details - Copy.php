 <style>

.form-group{
	margin-right:0px!important;
}
</style>
<div  class="tab_wrper">
<ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">

        
      <li class="active tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="javascript:void(0)">
      ORDER DETAILS
      </a>
      </li>
      
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/lists">NEW
      <span class="badge"><?php echo $allcounts['newcount']; ?></span>
      </a>		
      
      </li>
      <li role="presentation" class=" tog_tab">
      <a aria-controls="dish" class="dish-tab" id="" role="tab" href="<?php echo base_url().$this->user->root;?>/orders/accepted">ACCEPTED
      <span class="badge"><?php echo $allcounts['accepted']; ?></span>
      </a>
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/cancelled">CANCELLED
      <span class="badge"><?php echo $allcounts['cancelled']; ?></span>
      </a>		
      </li>
	  <li class="tog_tab" role="presentation">
      <a aria-expanded="true"  role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/late">LATE
      <span class="badge"><?php echo $allcounts['late']; ?></span>
      </a>		
      </li>
      <li class="tog_tab" role="presentation">
      <a aria-expanded="true"  role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/all">ALL
      <span class="badge"><?php echo $allcounts['allcount']; ?></span>
      </a>		
      </li>
      
    </ul>


 <div id="myTabContent" class="tab-content tab_contwp dish_cat_tab">
    <div role="tabpanel" class="" id="category" aria-labelledby="category-tab">
    <div class="form_menu_detail" style="margin:0px;">
        <div class="table-responsive"> 
        <span><h4>#5823522655</h4></span>
        <?php /*?><span class="pull-right"><a href="<?php echo base_url()?>admin/orders/accepted" class="btn btn-info" >CANCEL</a></span><?php */?>
          
         <!--<table class="table table-striped tbl_category" style="border:1px solid #f2f2f2;">
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
      </table>-->
      
      <table class="table table-condensed odre_detail_table">
      <tbody>
        <tr>
          <td scope="row"><img src="<?php echo base_url()?>assets/admin_lte/img/arrow_down.png"></td>
          <td><label>Customer</label></td>
          <td class="color_orange">Rebecca Judd</td>
          <td><label>Create At</label></td>
          <td>02.13pm 06/23/2015</td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Locations</label></td>
          <td>Lola's Burrito Joint-Jacksonville</td>
          <td><label>Expected By</label></td>
          <td>05.20pm 06/23/2015</td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Status</label></td>
          <td class="color_orange">Accepted</td>
          <td><label>Type</label></td>
          <td>Delivery</td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Src</label></td>
          <td><img src="<?php echo base_url()?>assets/admin_lte/img/fb_icon.png"></td>
          <td><label>Delivery Address</label></td>
          <td> 5 Vaughn Dr, Princeton, NJ 08540,<br> United States </td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Promo Code</label></td>
          <td class="promcde"><span>FORK596482</span></td>
          <td><label>Discount</label></td>
          <td class="discnt">$2.68</td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td><label>Tips</label></td>
          <td class="tip">$01.00</td>
          <td></td>
          <td ></td>
        </tr>
      </tbody>
    </table>
      
      
      </div>

    <div class="table-responsive dis_detail_table">
    <table class="table">
      <thead>
        <tr>
          <th width="8%">#</th>
          <th width="56%">DISH</th>
          <th width="12%">SIZE</th>
          <th width="12%">RATE</th>
          <th width="12%">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td scope="row"><div class="circle ">01</div></td>
          <td>Rosted Tomato Caprase Salad</td>
          <td>Regular</td>
          <td>$40.50</td>
          <td></td>
        </tr>
        <tr>
          <td colspan="5">
          <div class="table_sides">
          <table class="table">
          <caption>OPTIONS AND SIDES</caption>
          <tbody>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          </tbody>
          </table>
          </div>
          </td>
        </tr>
        <tr class="divider">
          <td scope="row"></td>
          <td></td>
          <td></td>
          <td class="color_orange">$40.50</td>
          <td>$87.00</td>
        </tr>
        
        <tr>
          <td scope="row"><div class="circle ">03</div></td>
          <td>Rosted Tomato Caprase Salad</td>
          <td>Regular</td>
          <td>$40.50</td>
          <td></td>
        </tr>
        <tr>
          <td colspan="5">
          <div class="table_sides">
          <table class="table">
          <caption>OPTIONS AND SIDES</caption>
          <tbody>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          <tr>
          <td width="77%">. Pineapple</td>
          <td>+ $01.50</td>
          </tr>
          </tbody>
          </table>
          </div>
          </td>
        </tr>
        <tr class="divider">
          <td scope="row"></td>
          <td></td>
          <td></td>
          <td class="color_orange">$40.50</td>
          <td>$87.00</td>
        </tr>
        <tr>
          <td colspan="5" class="total_amt">$174.00</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="col-md-6 col-md-offset-6 pad0">
    <button class="btn button_gray pull-right">CANCEL ORDER</button>
    <button class="btn button_orange pull-right">COMPLETE</button>
    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    </div>
 	

	</div><!-- /.row -->
	<div class="clearfix"></div>

</div><!-- /.container -->


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
