<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
$(function () {
  $(".datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  });
});
</script>
<section class="profile">
        	<div class="container">
            	<!-- Profile Container -->
                <div class="profile-container">
                	<!-- Profile Form -->
                	<form class="form-horizontal" role="form"  method="post" name="formlist"  id="formlist">
                        <!-- Basic Detail -->
                        <div class="basic-details">
                            <!-- User Credential -->
                            <div class="user-credential manager-promo">
                                <h1>Promo Code Details</h1>
                                
                                <input type="text" name="title" id="title" placeholder="Title"  value="<?=(isset($result['title']))?$result['title']:''?>" >
                                
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 display-ful">
                                            <?php if($result['promocode']!=''){?>
                                            <input type="text" id="promocode" name="promocode" value="<?=(isset($result['promocode']))?$result['promocode']:''?>"  placeholder="Promo code" class="" maxlength="25"  onblur="check_exist()"/>
                                             <?php  }else{ ?>
                                             <input type="text" id="promocode" name="promocode" value="<?php if($promo!=''){ echo $promo;} ?>"  placeholder="Promo code" class="" maxlength="25"  onblur="check_exist()"/>
                                             <?php } ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 display-ful">
                                        	 <a class="promo"  href="javascript:void(0);" id="promo"><span>Auto Generate</span></a>
                                    </div>
                                </div>
                                
                                
                                 
                                 
                               
                                
                                
                                <span id="err" class="errmsg"></span>
                				<span id="promocode_err" class="errmsg"></span>
                 
                                <textarea class="additem" name="description" id="description" placeholder="Description"  ><?=(isset($result['description']))?$result['description']:''?></textarea>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                            <div id="datepicker" class="input-group date datepicker" data-date-format="yyyy-mm-dd" >
                                                <input class="" type="text" readonly  name="from" id="from" value="<?=(isset($result['start_date']))?$result['start_date']:''?>"/>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div> 
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 display-ful">
                                            <div id="datepicker" class="input-group date datepicker" data-date-format="yyyy-mm-dd" >
                                                <input class="" type="text" readonly  name="to" id="to" value="<?=(isset($result['end_date']))?$result['end_date']:''?>" />
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div> 
                                            
                                    </div>
                                </div>
                                <input type="text" name="uses"  placeholder="Uses Per Coupon" class=""  value="<?=(isset($result['uses_per_coupon']))?$result['uses_per_coupon']:''?>"  id="uses">
                                <select name="type" id="discount" class="">
                                <option   <?php if($result['discount_type']=='Percentage'){?> selected="selected"<?php }?> value="Percentage">Percentage</option>
                                <option  value="Fixed amount" <?php if($result['discount_type']=='Fixed amount'){?> selected="selected"<?php }?> >Fixed amount</option>
                            	</select>
                                
                                <input type="text" name="discount"  placeholder="Discount Amount" class=""  id="discountamt"  value="<?=(isset($result['discount_amount']))?$result['discount_amount']:''?>">
                            </div>
                            <!-- End User Credential -->
                       		<input type="hidden" value="<?=(isset($result['promo_id']))?$result['promo_id']:''?>"  id="id" name="id"/>
   							<input type="hidden" value=" <?php echo($this->session->userdata('user')->restaurant_id);?>"  id="restaurant_id" name="restaurant_id"/>
                            <!-- Form Buttons -->
                            <div class="profile-form-btns">
                            
                                <button type="button" class="redSave" name="submit_btn" id="submit_btn" onclick="validate();" >Save</button>

          						<button type="button" class="" onclick="location.href='<?php echo base_url()?>index.php/admin/promocodes/lists'">Cancel</button>
                            </div>
                            <!-- End Form Buttons -->
                        </div>
                    </form>
                    <!-- End Profile Form -->
                </div>
                <!-- End Profile Container -->
            </div>
        </section>

<script>

		
	function validate(){
		var promocode=document.getElementById("promocode").value.length;		
 		var start=document.getElementById("from").value;
		var promID=$("#id").val();
		var end=document.getElementById("to").value;
	    if(document.getElementById("title").value==''){
		 $("#title").addClass('errorborder');	
		}
        else if(promocode < 6 ){
		 $("#title").removeClass('errorborder');	 
         $("#promocode").addClass('errorborder');	
		document.getElementById("err").textContent="Promo code must contain at least 6 characters.";
		}
		 else if (start=='')
		 {
			 $("#from").addClass('errorborder');
			
		 }else if (end=='')
		 {
			
			 $("#from").removeClass('errorborder');
			 $("#to").addClass('errorborder'); 
		 }else if (start>end){
				
			  $("#promocode").removeClass('errorborder');
		      $("#err").hide();$("#errmsguses").hide();
			  $("#title").removeClass('errorborder');	
			  $("#to").addClass('errorborder');
			   document.getElementById("errto").textContent="EndDate must be is Greater than StartDate...";
		}else if(document.getElementById("discountamt").value==''){
			$("#title").removeClass('errorborder');	
			 $("#to").removeClass('errorborder');
			 $("#promocode").removeClass('errorborder');
			 $("#err").hide();$("#errto").hide();	
			 $("#errmsguses").hide();	
			 $("#errmsgdiscount").hide();
			 $("#discountamt").addClass('errorborder');	
		}else{
			var restaurant_id=$("#restaurant_id").val();
			var promo=$("#promocode").val();
			$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>admin/promocodes/check_exist",
			data:{'promocode':promo,'restaurant_id':restaurant_id,'promID':promID},
			success:function(data){
				if(data > 0){
					$("#promocode_err").show();
					$("#promocode").addClass('errorborder');	
					$("#promocode_err").text("This promo code already exist...");
				}else{
					$("#promocode").removeClass('errorborder');
					$("#err").hide();	
					$("#errmsguses").hide();	
					$("#errmsgdiscount").hide();
					$("#discountamt").removeClass('errorborder');	
					$("#formlist").attr("action", "<?php echo base_url().$this->user->root;?>/promocodes/add/<?php echo $result['promo_id']; ?>");
					$("#formlist").submit();return true;
				}
			}
			});
			
			
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
	


