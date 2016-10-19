<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="" />
        <title>Forkourse | Chef's Dashboard</title>
        <link rel="icon" href="<?php echo base_url(); ?>favicon.png" sizes="32x32" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dashboard/css/custom.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="css/meanmenu.css" media="all" />-->
        
        <!-- Awesome Fonts -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dashboard/css/font-awesome.min.css" rel="stylesheet">
        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zebra_dialog.css" type="text/css">	
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.min.js"></script>
        <script src="<?php echo $template_url; ?>/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url('assets');?>/js/zebra_dialog.js"></script>

    </head>
    
    <body>
    <div id="preloader" class="loader_home"></div>
		<?php //echo base_url().$route.'/orders';?>
        <!-- ===== Header ===== -->
        <!-- Responsive Menus -->
        <section class="responsive-menus">
            <div class="menu-section">
                <!-- Toggle Buttons -->
                <div class="menu-toggle">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
                <!-- End Toggle Buttons -->
                <?php $controller = $this->router->fetch_class();?>
                <!-- Toggle Menus -->
                <nav>
                    <ul role="navigation" class="hidden">
                    	<a href="<?php echo base_url().$route.'/home'?>">
                		<img class="logo-res-menu" src="<?php echo base_url(); ?>assets/dashboard/images/logo-big.png" alt="Image" title="Image" />
                        </a>
                            <li <?php if($controller=='orders'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/orders';?>"><i class="demo-icon icon-ico-orders">&#xe801;</i>Orders</a></li>
                            <li <?php if($controller=='menu'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/menu';?>"><i class="demo-icon icon-ico-menu">&#xe805;</i> Menu</a></li>
                            <li <?php if($controller=='preference'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/preference';?>"><i class="demo-icon icon-ico-preferences">&#xe802;</i> Preferences</a></li>
                            <li <?php if($controller=='profile'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/profile';?>"><i class="demo-icon icon-ico-profile">&#xe804;</i> Profile</a></li>
                            
                		
                            
  
                        <p>&copy; Forkourse All Rights Reserved</p>
                    </ul>
                </nav>
                <!-- End Toggle Menus -->
            </div>
            
            
            <!-- Small DropDown -->
            <div class="res-small-dropDown">
            	<a href="<?php echo site_url('admin/home/logout'); ?>"><i class="demo-icon icon-off" style="font-size:20px;">&#xe808;</i></a>
            </div>
            <!-- End Small DropDown -->
        </section>
        <!-- End Responsive Menus -->
        
        <header>
            <div class="container-fluid">
                <!-- Logo Menu -->
                <div class="logo-menu">
                    <div class="row">
                        <!-- Logo -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 logo-full">
                            <div class="logo">
                                <a href="<?php echo base_url().$route.'/home'?>">
                                <?php  if($userdetails['logo']!=''){?>
									<img src="<?php echo base_url().'assets/images/profile/'.$userdetails['logo'].'?'.time();?>"  alt="User Image" >
							  
							   <?php }else{?>
								   <img src="<?php echo base_url(); ?>assets/dashboard/images/logo.png" alt="Logo" title="Logo" />
							 
							 	<?php }   ?>
         						</a>
                                <div style="display:none;">
                                
                                
                                <audio controls id="myTune">
                                      <source src="horse.ogg" type="audio/ogg">
                                      <source src="<?php echo base_url(); ?>assets/test.mp3?t=<?php echo time(); ?>" type="audio/mpeg">
                    				 	Your browser does not support the audio element.
                    			</audio>
                                </div>
                                <button onClick="document.getElementById('myTune').play()" style="display:none;">Play Music</button>
                            </div>
                        </div>
                        <!-- End Logo -->
                        
                        <!-- Menu -->
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">
                            <div class="menu">
                                <nav class="navbar navbar-inverse navbar-static-top">
                                    <ul class="nav navbar-nav">
                                        <li <?php if($controller=='orders'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/orders';?>"><i class="demo-icon icon-ico-orders">&#xe801;</i> Orders</a></li>
                                        <li <?php if($controller=='menu'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/menu';?>"><i class="demo-icon icon-ico-menu">&#xe805;</i> Menu</a></li>
                                        <li <?php if($controller=='preference'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/preference';?>"><i class="demo-icon icon-ico-preferences">&#xe802;</i> Preferences</a></li>
                                        <li <?php if($controller=='profile'){?>class="active" <?php } ?>><a href="<?php echo base_url().$route.'/profile';?>"><i class="demo-icon icon-ico-profile">&#xe804;</i> Profile</a></li>
                                        <li>
                                        <a href="<?php echo site_url('admin/home/logout');?>" >
                                        	<i class="demo-icon icon-off" style="font-size:20px;">&#xe808;</i>
                                        </a>  
                                 

                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- End Menu -->
                    </div>
                </div>
                <!-- End Logo Menu -->
            </div>
        </header>
        <!-- ===== End Header ===== -->


<input type="hidden" name="detailID" value="0" id="detailID">
<input type="hidden" name="hidecount" value="0" id="hidecount">
<script>
if(typeof(EventSource) !== "undefined") {
	var detID = $('#detailID').val();
	//alert(detID);
	if(detID==0){
	
   	var source = new EventSource("<?php echo base_url().$route."/orders/loadNewOrder"?>");
	
    source.onmessage = function(event) {
		var data=event.data;
		var datas = data.split("###");
		var count  = datas[0];
		var content= datas[1];
        //document.getElementById("tablebody").innerHTML = content;
		var oldcount = $('#hidecount').val();
		//alert(count);
		
		$('#tablebody').html(content);
		$('#tablebody_tab').html(content);
		$('#tablebody_mob').html(content);
	
		$('#tablebody_tab .hide-desk').removeClass('hide');
		$('#tablebody_mob .hide-desk').removeClass('hide');
		
		$('#tablebody .hide-desk').hide();
		$('#tablebody_tab .hide-tab').hide();
		$('#tablebody_mob .hide-mob').hide();
	
		$('.facebook').html($('#fb_svg').html());
		$('.web').html(	$('#web_svg').html());
		$('.app').html(	$('#app_svg').html());
		
		$('#countnew').html(count);
		$('.badgenew').html(count);
		$('#hidecount').val(count);
		//alert(count);
		//alert(oldcount);
		
		if(count!=oldcount && oldcount!='0' && oldcount < count){
		$('#toast').show();
			//setTimeout(function(){
		 	//	$('#toast').show();
				//$("#id_of_button").click();
				//document.getElementById('myTune').play();
				//$('#toast').fadeOut(5000);
				//document.getElementById('myTune').pause();
				//document.getElementById('myTune').currentTime = 0;
				
			//}, 3000);
			
		}else{
			
		}
		//document.getElementById("countnew").innerHTML = count;
    };
	
	}
} else {
    document.getElementById("tablebody").innerHTML = "Sorry, your browser does not support server-sent events...";
}



	
</script>
<button id="id_of_button" style="display:none;">A</button>
<!--<button id="id_of_button" style="display:none;" onClick="document.getElementById('myTune').play();">A</button>-->


<style>
 #toast{
 	background-position: 15px center;
    background-repeat: no-repeat;
    border-radius: 10px;
    box-shadow: 0 0 12px #999999;
    margin: 0 0 6px;
    opacity: 0.8;
    overflow: hidden;
  	/*  padding: 15px 15px 15px 50px;*/
    pointer-events: auto;
    position: Fixed;
    width: 300px;
	bottom:20px;
	z-index:999999999;
	background: none repeat scroll 0 0 rgb(211, 42, 56) !important;
	color:#fff;
	left:15px;
    }
	.redSavetoast {
	background: none repeat scroll 0 0 rgb(211, 42, 56) !important;
    margin-right: 10px;
    border: medium none;
    box-shadow: 0 1px 2px rgb(153, 153, 153);
    color: rgb(255, 255, 255);
    display: inline-block;
    font-size: 14px;
    line-height: 22px;

    padding: 15px;
    text-align: center;
    transition: all 0.5s ease 0s;
    width: 100%;
}
</style>
<!--<div id="toast" style="display:none;">
<a href="javascript:">
<button onclick="document.getElementById('myTune').pause(); document.getElementById('myTune').currentTime = 0;">
A New Order Placed
</button>
</a>
</div>-->



<div id="toast" style=" display:none;">
<div class="add-new-box">
<button class="submit_btn redSavetoast" onClick="clickToast()">
NEW ORDER
</button>
</div>
</div>
<script>
function clickToast(){
$('#toast').hide();
document.getElementById('myTune').pause(); document.getElementById('myTune').currentTime = 0;
}
</script>
       
       
       
       <style>
	   #toast {
  
  margin: 0 auto;
  background-color: red;
  animation-name: stretch;
  animation-duration: 1.5s; 
  animation-timing-function: ease-out; 
  animation-delay: 0;
  animation-direction: alternate-reverse;
  animation-iteration-count: infinite;
  animation-fill-mode: none;
  animation-play-state: running;
}

@keyframes stretch {
  0% {
    transform: scale(.5);
    background-color: red;
    border-radius: 10%;
  }
  50% {
    background-color: orange;
  }
  100% {
    transform: scale(1.5);
    background-color: yellow;
  }
}

	   </style>                     
                            
<script language="javascript">
$(document).ready(function() {
	//$('#toast').blink({delay:1000});

	
});//end doc ready
(function($)
{
	$.fn.blink = function(options)
	{
		var defaults = { delay:50 };
		var options = $.extend(defaults, options);
		
		return this.each(function()
		{
			var obj = $(this);
			setInterval(function()
			{
				if($(obj).css("visibility") == "visible")
				{
					$(obj).css('visibility','hidden');
				}
				else
				{
					$(obj).css('visibility','visible');
				}
			}, options.delay);
		});
	}
}(jQuery))
</script>