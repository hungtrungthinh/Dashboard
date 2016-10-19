
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>Server Sent Events PHP Example - Stock Tickets</title>
<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">

<script>
if(typeof(EventSource) !== "undefined") {
   	var source = new EventSource("<?php echo base_url().$this->user->root."/orders/stocks"?>");
    source.onmessage = function(event) {
		var data=event.data;
		var datas = data.split("###");
		var count  = datas[0];
		var content= datas[1];
        document.getElementById("tablebody").innerHTML = content;
		//$('#tablebody').innerHTML(event.data);
        document.getElementById("countnew").innerHTML = count;
    };
} else {
    document.getElementById("tablebody").innerHTML = "Sorry, your browser does not support server-sent events...";
}
</script>



</head>

<body>
<div id="result"></div>


<div  class="tab_wrper">
    <ul role="tablist" class="nav nav-tabs tab_links" id="myTabs">
      <li class="active tog_tab" role="presentation">
      <a aria-expanded="true" role="tab" id="" href="<?php echo base_url().$this->user->root;?>/orders/lists">NEW
      <span class="badge" id="countnew"><?php echo $allcounts['newcount']; ?></span>
      </a>		
      
      </li>
      <li role="presentation" class="tog_tab">
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
    

<div class="tab-content tab_contwp dish_cat_tab" id="myTabContent">
    <div aria-labelledby="category-tab" id="category" class="" role="tabpanel">
		<div class="table-responsive">
<form name="userMasterForm" id="userMasterForm" action="<?php echo base_url().$this->user->root;?>/orders/lists" method="post" >   
    
        <table class="table table-striped tbl_category">
          <thead class="head_table">
            <tr>
              <th width="10%">ID</th>
              <th width="35%">Customer</th>

              <?php if($this->user->role=='3'){?>
              <th width="15%">Orderd</th>
              <th width="10%">Total</th>
              <th width="30%" colspan="3">Action</th>
              <?php }else{ ?>
              <th width="25%">Orderd</th>
              <th width="20%">Total</th>
              <th width="10%" colspan="3">Action</th>
               <?php }?>
            </tr>
          </thead>
          <tbody class="table_body" id="tablebody">
        	
			
			<?php  
			if(count($orderdetails)!=0){
           	foreach($orderdetails as $order){ ?>
            <?php /*?><tr id="row_<?php echo $order['order_id'];?>">
           	   <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
				<?php echo $order['order_ref_id'];?>
               </td>
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink">
				<?php echo $order['first_name'].' '.$order['last_name'];?>
               </td>
               
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo $order['created_time'];?></td>
               <td href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="cursor:pointer;" class="tdlink"><?php echo $order['total_amount'];?></td>
               <?php if($this->user->role=='3'){?>
               <td>
               <input type="button" class="btn btn-info accept" data-attr="<?php echo $order['order_id'];?>" value="ACCEPT">
               </td>
               <td>
               <input type="button" class="btn btn_gray cancel" data-attr="<?php echo $order['order_id'];?>" value="CANCEL">
               </td>
               <?php } ?>
               <td>
                <a href="<?php echo base_url().$this->user->root;?>/orders/details/<?php echo $order['order_id'];?>" style="color:#03F;" >Order Details</a></td>
            
                		
            </tr><?php */?>
            <?php 	}
				}else { ?>
      		  <tr>
              <td colspan="5" class="tbl_row">
             No new orders
              </td>
              </tr>
           <?php } ?>
            
          </tbody>
        </table>
       
             
        </div>
      </div>
    </div>
 
    </div>
</body>



<script>   
	$(document).ready(function(){
		$('body').on('click', '.tdlink', function () {
		//$('.tdlink').click(function(){
			window.location = $(this).attr('href');
			return false;
		});
	});

$('body').on('click', '.accept', function () {
	var order_id = $(this).attr("data-attr");
	$('.loader_home').show();
	//return false;
	
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/acceptOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				
				$('#row_'+order_id).remove();
				$('.alert-success').show();
				$('.alert-success').html('order accepted successfully');
				var rowCount = $('.tbl_category tr').length;
				if(rowCount=='1'){
					$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
				}

				$('.loader_home').hide();

				
            }
        });  

});

$('body').on('click', '.cancel', function () {
	var order_id = $(this).attr("data-attr");
	$('.loader_home').show();
        $.ajax({
            url: '<?php echo base_url().$this->user->root;?>/orders/cancelOrder',
            type: 'POST',
            data: {'order_id':order_id}, 
            success: function (result) {
				
				$('#row_'+order_id).remove();
				$('.alert-success').show();
				$('.alert-success').html('order cancelled successfully');
				var rowCount = $('.tbl_category tr').length;
				if(rowCount=='1'){
					$('.tbl_category').append('<tr><td colspan="5">No Orders</td></tr>');
				}

				$('.loader_home').hide();

				
				}
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
</style><style>
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