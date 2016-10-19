<link href="<?php echo base_url() ?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>

<style>
.admin_body{
	background-color:#FFFFFF;
}
.form-group{
	margin-right:0px!important;
}
.ui-autocomplete { 
            cursor:pointer; 
            height:120px; 
            overflow-y:scroll;
        }  
.ui-corner-all{ border-radius:0px!important;}
.ui-menu-item{  width:100% !important; padding:0px !important; border-bottom:1px solid#EBEAEA;  }
a.ui-corner-all{ width:100% !important; display:block; padding:2px; margin:0;}
a.ui-state-focus{ background:#DF7707 !important; width:100% !important; padding:2px !important; margin:0px; border:1px solid#DF7707 !important; color:#FFF !important; border-radius:0px !important; }
.errmsg
{
color: red;
display:inline-block;
}
</style>

 <!-- Load jQuery and bootstrap datepicker scripts -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
$(function () {
  $(".datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  });
});
</script>
<style>
.brudcum_head{
	border-bottom:1px solid #f2f2f2;
	padding:5px;
}
</style>
    <?php /*?>    <div class="col-lg-12 brudcum_head"  >
                  <span> Basic Details</span>
        </div> <?php */?>

 <div class="container" style="padding-bottom:10px;"> 
	 <div class="clearfix" style="padding-top:15px;"></div>
     	
        <?php	if($error=='') { ?>
        
        <div class="col-lg-12">
	      <legend> Promo code Details</legend>
		</div> 
	 
    <div class="col-md-12" style="padding-bottom:10px;">
    
    
    	
    
		<form class="form-horizontal" role="form"  method="post" name="formlist"  id="formlist">
        	<fieldset>
       		<!-- Text input-->
          	<div class="form-group">
            	 <label class="col-sm-4" for="textinput">Title </label>
				 <div class="col-sm-6">
                 <input type="text" name="title" id="title"    placeholder="Title" class="form-control " value="<?=(isset($result['title']))?$result['title']:''?>" >
		         </div>
           </div>
		   <!-- Text input-->
          	
            <!-- Text input-->
          <div class="form-group">
           		<label class="col-sm-4 " for="textinput">Promo code</label>
                <a class="promo"  href="javascript:void(0);" id="promo"><span>Auto Generate</span></a>
                <?php if($result['promocode']!=''){?>
                <div class="col-sm-6" >
             	<input type="text" id="promocode" name="promocode" value="<?=(isset($result['promocode']))?$result['promocode']:''?>"  placeholder="Promo code" class="form-control fileldtheme js-placeholder" maxlength="25"  onblur="check_exist()"/>
                 <span id="err" class="errmsg"></span>
                 <span id="promocode_err" class="errmsg"></span>
                 
	            </div>
                <?php  }else{ ?>
            	<div class="col-sm-6" >
             	<input type="text" id="promocode" name="promocode" value="<?php if($promo!=''){ echo $promo;} ?>"  placeholder="Promo code" class="form-control fileldtheme js-placeholder" maxlength="25"  onblur="check_exist()"/>
                 <span id="err" class="errmsg"></span>
                 <span id="promocode_err" class="errmsg"></span>
                 
	            </div>
                <?php }?>
         </div>
         <!-- Text input-->
         <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Description</label>
            	<div class="col-sm-6">
     
                <textarea class="form-control additem" name="description" id="description" placeholder="Description"  ><?=(isset($result['description']))?$result['description']:''?></textarea>
                </div>
         </div>
          <!-- Text input-->
 		 <div class="form-group">
            	<label class="col-sm-4 " for="textinput">Date</label>
                <div class="col-sm-6">
                <div class="col-sm-6" style="padding:0px">
                <label  for="textinput">From</label>
                   <div id="datepicker" class="input-group date datepicker" data-date-format="yyyy-mm-dd" >
                        <input class="form-control" type="text" readonly  name="from" id="from" value="<?=(isset($result['start_date']))?$result['start_date']:''?>"/>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div> 
             
                </div>
                <div class="col-sm-6" style="padding:0px">
                <label class=" " for="textinput">To</label>
                  <div id="datepicker" class="input-group date datepicker" data-date-format="yyyy-mm-dd" >
                        <input class="form-control" type="text" readonly  name="to" id="to" value="<?=(isset($result['end_date']))?$result['end_date']:''?>" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div> 
                </div>
                 <span id="errto" class="errmsg"></span>
                </div>
                </div>
        
        
   
        
            
        
 		
       <div class="form-group">
            <label class="col-sm-4 " for="textinput">Uses Per Coupon</label>
            <div class="col-sm-6">
            <input type="text" name="uses"  placeholder="Uses Per Coupon" class="form-control fileldtheme js-placeholder"  value="<?=(isset($result['uses_per_coupon']))?$result['uses_per_coupon']:''?>"  id="uses">
            <span id="errmsguses" class="errmsg"></span>
            </div>
	  </div>
      	
       <div class="form-group">
            <label class="col-sm-4 " for="textinput">Discount Type</label>
           
            <div class="col-sm-6">
            <select name="type" id="discount" class="form-control"> 
                             <option   <?php if($result['discount_type']=='Percentage'){?> selected="selected"<?php }?> value="Percentage">Percentage</option>
                             <option  value="Fixed amount" <?php if($result['discount_type']=='Fixed amount'){?> selected="selected"<?php }?> >Fixed amount</option>
                            
                        </select>
            </div>
             <?php }?>     
	  </div>
      
      	
       <div class="form-group">
            <label class="col-sm-4 " for="textinput">Discount Amount</label>
            <div class="col-sm-6">
            <input type="text" name="discount"  placeholder="Discount Amount" class="form-control fileldtheme js-placeholder"  id="discountamt"  value="<?=(isset($result['discount_amount']))?$result['discount_amount']:''?>">
            <span id="errmsgdiscount" class="errmsg"></span>
            </div>
	  </div>
    <input type="hidden" value="<?=(isset($result['promo_id']))?$result['promo_id']:''?>"  id="id" name="id"/>
    <input type="hidden" value=" <?php echo($this->session->userdata('user')->restaurant_id);?>"  id="restaurant_id" name="restaurant_id"/>
   
      <div class="col-sm-10">  
        
          <button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo base_url()?>index.php/admin/promocodes/lists'">Cancel</button>
          <button type="button" class="btn btn-info pull-right" name="submit_btn" id="submit_btn" style="margin-right:10px;" onclick="validate();" >Save</button>
       </div>  
      
        </fieldset>
      </form>
      
    
    </div><!-- /.col-lg-12 -->	
    
      
	  	
	</div><!-- /.row -->
        
</div><!-- /.container -->



<script>

		
	function validate(){
 var promocode=document.getElementById("promocode").value.length;		
 var start=document.getElementById("from").value;

		var end=document.getElementById("to").value;
	    if(document.getElementById("title").value==''){
		 $("#title").addClass('errorborder');	
		}
        else if(promocode < 8 ){
		 $("#title").removeClass('errorborder');	 
         $("#promocode").addClass('errorborder');	
		document.getElementById("err").textContent="Promo code must contain at least 8 characters.";
		}
		 else if (start=='')
		 {
			 $("#from").addClass('errorborder');
			
		 }
		 else if (end=='')
		 {
			
			 $("#from").removeClass('errorborder');
			 $("#to").addClass('errorborder'); 
		 }
		 else if (start>end)
			{
				
			  $("#promocode").removeClass('errorborder');
		      $("#err").hide();$("#errmsguses").hide();
			  $("#title").removeClass('errorborder');	
			  $("#to").addClass('errorborder');
			   document.getElementById("errto").textContent="EndDate must be is Greater than StartDate...";
			}
		else if(document.getElementById("discountamt").value==''){
		$("#title").removeClass('errorborder');	
		 $("#to").removeClass('errorborder');
		 $("#promocode").removeClass('errorborder');
		 $("#err").hide();$("#errto").hide();	
		 $("#errmsguses").hide();	
		 $("#errmsgdiscount").hide();
		 $("#discountamt").addClass('errorborder');	
		}	
	
		else{
			$("#promocode").removeClass('errorborder');
			$("#err").hide();	
		 	$("#errmsguses").hide();	
		    $("#errmsgdiscount").hide();
			$("#discountamt").removeClass('errorborder');	
			$("#formlist").attr("action", "<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $result['promo_id']; ?>");
			$("#formlist").submit();return true;
		}
	}	
		
		 
	$("#promo").click(function(){

			$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>admin/promocodes/generatePromo",
			data:{},
			success:function(data){
				//alert(data);
				$("#promocode").val(data)
			}
			});
			   
			    
		}) 
	$(document).ready(function () {
  //called when key is pressed in textbox
  $("#uses").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       // $("#errmsguses").html("Digits Only").show().fadeOut("slow");
	   document.getElementById("errmsguses").textContent="Digits Only";
               return false;
    }
   });
   //called when key is pressed in textbox
  $("#discountamt").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       // $("#errmsgdiscount").html("Digits Only").show().fadeOut("slow");
		document.getElementById("errmsgdiscount").textContent="Digits Only";
               return false;
    }
   });
});
function check_exist(){
			var promo=$("#promocode").val();
			var restaurant_id=$("#restaurant_id").val();
			//alert(restaurant_id);
			if(promo!=''){
			$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>admin/promocodes/check_exist",
			data:{'promocode':promo,'restaurant_id':restaurant_id},
			success:function(data){
				if(data > 0){
				$("#promocode_err").show();
				$("#promocode").addClass('errorborder');	
				$("#promocode_err").text("This promo code already exist...");
				}
				else{
				$("#promocode_err").hide();
				$("#promocode").removeClass('errorborder');	
				}
			}
			});
		
			}
			   
		}
</script>
	


