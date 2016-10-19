<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0' >
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="" />
        <title>Forkourse | Owner's Dashboard</title>
        <link rel="icon" href="<?php echo base_url(); ?>favicon.png" sizes="32x32" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dashboard/css/custom.css" rel="stylesheet">
        
        <!-- Awesome Fonts -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dashboard/css/font-awesome.min.css" rel="stylesheet">
        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap-theme.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.min.js"></script>
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
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
                		<img class="logo-res-menu" src="<?php echo base_url(); ?>assets/dashboard/images/logo.png" alt="Image" title="Image" />
                            
                            <li class="active"><a href="<?php echo base_url(); ?>manager/orders"><i class="demo-icon icon-ico-orders">&#xe801;</i> Orders</a></li>
                            <li><a href="<?php echo base_url(); ?>manager/reports"><i class="demo-icon icon-ico-reports">&#xe805;</i> Reports</a></li>
                            <li><a href="<?php echo base_url(); ?>manager/customers"><i class="demo-icon icon-ico-customers">&#xe807;</i> Customers</a></li>
                            <li><a href="<?php echo base_url(); ?>manager/location"><i class="demo-icon icon-ico-locations">&#xe800;</i> Locations</a></li>
                            <li><a href="<?php echo base_url(); ?>manager/profile"><i class="demo-icon icon-ico-profile">&#xe804;</i> Profile</a></li>
                            <li><a href="<?php echo base_url(); ?>manager/preference"><i class="demo-icon icon-ico-preferences">&#xe802;</i> Preferences</a></li>
                            <li><a href="<?php echo base_url(); ?>manager/promocodes"><i class="demo-icon icon-ico-promocodes">&#xe803;</i> Promo Codes</a></li>
							<li><a href="<?php echo base_url(); ?>manager/notification"><i class="fa fa-envelope-o"></i> Messages</a></li>
                            
                		
                            
                		<div class="svg-logo">
                        <?php echo '
                        <?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="246px" height="56px" viewBox="0 0 246 56" enable-background="new 0 0 246 56" xml:space="preserve">
<g>
	<polygon fill="#FFFFFF" points="70.951,30.12 70.951,42.025 65.04,42.025 65.04,13.834 85.152,13.834 85.152,18.724 70.951,18.724 
		70.951,25.145 83.366,25.145 83.366,30.12 70.951,30.12 	"/>
	<path fill="#FFFFFF" d="M97.757,37.944c3.373,0,5.06-2.126,5.06-6.378c0-4.225-1.687-6.336-5.06-6.336
		c-3.374,0-5.06,2.112-5.06,6.336C92.697,35.818,94.383,37.944,97.757,37.944L97.757,37.944z M97.735,42.579
		c-1.701,0-3.21-0.27-4.542-0.809c-1.325-0.538-2.452-1.296-3.374-2.26c-0.921-0.965-1.615-2.127-2.098-3.494
		c-0.482-1.36-0.723-2.855-0.723-4.472c0-1.645,0.248-3.154,0.744-4.515c0.496-1.368,1.205-2.53,2.14-3.494
		c0.936-0.964,2.062-1.715,3.373-2.239c1.318-0.525,2.807-0.787,4.479-0.787c1.645,0,3.111,0.262,4.416,0.787
		c1.296,0.524,2.409,1.268,3.331,2.218c0.921,0.949,1.623,2.105,2.119,3.473c0.496,1.36,0.744,2.884,0.744,4.557
		c0,1.672-0.248,3.188-0.744,4.535c-0.497,1.354-1.198,2.509-2.119,3.473c-0.921,0.964-2.041,1.715-3.352,2.24
		C100.812,42.316,99.352,42.579,97.735,42.579L97.735,42.579z"/>
	<path fill="#FFFFFF" d="M110.191,42.025V21.106h5.187v2.487c0.454-0.708,0.928-1.269,1.424-1.673
		c0.496-0.396,1.007-0.702,1.531-0.914c0.524-0.22,1.056-0.354,1.594-0.411c0.539-0.057,1.091-0.085,1.659-0.085h0.723v5.698
		c-0.51-0.085-1.02-0.127-1.531-0.127c-3.374,0-5.06,1.687-5.06,5.06v10.885H110.191L110.191,42.025z"/>
	<polygon fill="#FFFFFF" points="136.956,42.025 132.363,32.629 129.685,35.393 129.685,42.025 124.157,42.025 124.157,13.452 
		129.685,13.452 129.685,29.058 136.572,21.106 143.334,21.106 136.317,28.802 143.164,42.025 136.956,42.025 	"/>
	<path fill="#FFFFFF" d="M153.146,37.944c3.373,0,5.06-2.126,5.06-6.378c0-4.225-1.687-6.336-5.06-6.336s-5.06,2.112-5.06,6.336
		C148.087,35.818,149.773,37.944,153.146,37.944L153.146,37.944z M153.125,42.579c-1.7,0-3.21-0.27-4.542-0.809
		c-1.326-0.538-2.452-1.296-3.373-2.26c-0.922-0.965-1.616-2.127-2.099-3.494c-0.481-1.36-0.723-2.855-0.723-4.472
		c0-1.645,0.248-3.154,0.744-4.515c0.496-1.368,1.205-2.53,2.14-3.494c0.937-0.964,2.063-1.715,3.373-2.239
		c1.319-0.525,2.808-0.787,4.479-0.787c1.645,0,3.111,0.262,4.415,0.787c1.297,0.524,2.41,1.268,3.331,2.218
		c0.922,0.949,1.623,2.105,2.119,3.473c0.496,1.36,0.744,2.884,0.744,4.557c0,1.672-0.248,3.188-0.744,4.535
		c-0.496,1.354-1.197,2.509-2.119,3.473c-0.921,0.964-2.041,1.715-3.352,2.24C156.201,42.316,154.741,42.579,153.125,42.579
		L153.125,42.579z"/>
	<path fill="#FFFFFF" d="M179.128,42.025v-2.934c-1.418,2.324-3.587,3.487-6.507,3.487c-1.048,0-2.005-0.185-2.869-0.554
		c-0.865-0.368-1.609-0.892-2.232-1.573c-0.624-0.68-1.112-1.487-1.468-2.423c-0.354-0.936-0.53-1.984-0.53-3.146V21.106h5.527
		v12.926c0,2.608,1.177,3.912,3.529,3.912c1.417,0,2.487-0.447,3.21-1.34c0.723-0.894,1.084-2.033,1.084-3.423V21.106h5.486v20.919
		H179.128L179.128,42.025z"/>
	<path fill="#FFFFFF" d="M186.144,42.025V21.106h5.188v2.487c0.453-0.708,0.928-1.269,1.424-1.673
		c0.496-0.396,1.007-0.702,1.531-0.914c0.524-0.22,1.056-0.354,1.594-0.411c0.539-0.057,1.092-0.085,1.659-0.085h0.723v5.698
		c-0.511-0.085-1.021-0.127-1.531-0.127c-3.373,0-5.06,1.687-5.06,5.06v10.885H186.144L186.144,42.025z"/>
	<path fill="#FFFFFF" d="M213.357,27.441c-0.142-0.964-0.503-1.666-1.084-2.105s-1.467-0.659-2.657-0.659
		c-1.134,0-1.991,0.135-2.572,0.404c-0.581,0.27-0.872,0.73-0.872,1.382c0,0.567,0.291,1.021,0.872,1.36
		c0.581,0.34,1.425,0.667,2.529,0.979c1.814,0.51,3.345,0.942,4.593,1.296c1.247,0.354,2.246,0.773,2.997,1.255
		c0.752,0.481,1.29,1.084,1.616,1.808c0.326,0.722,0.489,1.693,0.489,2.912c0,1.871-0.779,3.423-2.339,4.656
		c-1.559,1.232-3.869,1.85-6.931,1.85c-1.503,0-2.864-0.17-4.082-0.511c-1.219-0.34-2.262-0.828-3.126-1.467
		c-0.864-0.638-1.53-1.403-1.998-2.296c-0.468-0.894-0.716-1.893-0.744-2.998h5.697c0,1.007,0.391,1.778,1.17,2.324
		s1.793,0.822,3.04,0.822c1.049,0,1.949-0.163,2.701-0.488c0.75-0.326,1.126-0.83,1.126-1.517c0-0.766-0.276-1.318-0.829-1.659
		c-0.553-0.339-1.396-0.638-2.53-0.899c-2.04-0.454-3.685-0.929-4.933-1.424c-1.247-0.497-2.218-1.043-2.912-1.645
		c-0.694-0.596-1.163-1.248-1.403-1.957c-0.241-0.708-0.361-1.509-0.361-2.388c0-0.794,0.162-1.552,0.488-2.261
		s0.844-1.332,1.553-1.871c0.709-0.546,1.63-0.978,2.764-1.304c1.134-0.326,2.523-0.489,4.167-0.489c3.005,0,5.201,0.61,6.591,1.829
		c1.389,1.219,2.154,2.905,2.296,5.06H213.357L213.357,27.441z"/>
	<path fill="#FFFFFF" d="M235.3,29.524c-0.027-0.765-0.162-1.438-0.403-2.02c-0.241-0.581-0.561-1.063-0.958-1.445
		c-0.396-0.383-0.85-0.667-1.359-0.851c-0.511-0.184-1.035-0.276-1.573-0.276c-1.106,0-2.063,0.404-2.871,1.212
		c-0.808,0.808-1.268,1.935-1.381,3.38H235.3L235.3,29.524z M226.583,33.012c0.086,1.587,0.546,2.849,1.382,3.784
		c0.837,0.936,1.935,1.403,3.296,1.403c0.907,0,1.708-0.206,2.402-0.617s1.141-0.984,1.34-1.722h5.697
		c-0.652,2.154-1.786,3.813-3.402,4.975c-1.615,1.163-3.543,1.744-5.782,1.744c-6.974,0-10.46-3.799-10.46-11.396
		c0-1.615,0.227-3.075,0.68-4.379c0.454-1.304,1.113-2.424,1.978-3.359c0.864-0.936,1.921-1.652,3.168-2.147
		c1.248-0.497,2.679-0.745,4.294-0.745c3.232,0,5.678,1.035,7.336,3.104c1.658,2.07,2.487,5.188,2.487,9.355H226.583L226.583,33.012
		z"/>
	<path fill="#FFFFFF" d="M11.787,1C21.963,1,32.14,1,42.316,1c0.703,0,1.356,0.288,1.824,0.756s0.756,1.095,0.756,1.824v14.147
		h-4.974V5.974c-8.581,0-17.161,0-25.741,0v11.753H9.207V3.58c0-0.729,0.288-1.356,0.756-1.824C10.43,1.288,11.083,1,11.787,1
		L11.787,1z"/>
	<path fill="#FFFFFF" d="M11.787,55.03h13.011v-4.975H14.181v-8.37c1.824-0.917,3.083-2.808,3.083-4.979V28.19l-1.866-1.397v9.56
		h-2.564V28.19l-2.28-1.397v9.56H7.99V28.19l-1.866-1.397v9.913c0,2.172,1.258,4.063,3.082,4.979v10.764
		c0,0.73,0.288,1.357,0.756,1.825C10.43,54.742,11.083,55.03,11.787,55.03L11.787,55.03z"/>
	<path fill="#FFFFFF" d="M42.316,55.03H29.305v-4.975h10.617v-6.993h-2.174v-8.523c0.029-4.72,1.731-7.746,5.848-7.746h1.3v12.753
		v3.516v9.387c0,0.73-0.288,1.357-0.756,1.825S43.019,55.03,42.316,55.03L42.316,55.03z"/>
	<path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M27.051,39.668c1.671,0,3.025,1.354,3.025,3.025
		c0,1.67-1.354,3.024-3.025,3.024c-1.671,0-3.025-1.354-3.025-3.024C24.026,41.021,25.38,39.668,27.051,39.668L27.051,39.668z"/>
</g>
</svg> ' ?>

                        </div>
                        <p>&copy; Forkourse All Rights Reserved</p>
                    </ul>
                </nav>
                <!-- End Toggle Menus -->
            </div>
            
            
            <!-- Small DropDown -->
            <div class="res-small-dropDown">
            	<a href="<?php echo base_url(); ?>admin/home/logout"><i class="demo-icon icon-off" style=" font-size:26px;">&#xe808;</i></a>
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
                                <a href="<?php echo base_url(); ?>manager/home">
                                
           <a href="<?php echo base_url().$route.'/home'?>">
                                <?php  if($userdetails['logo']!=''){?>
									<img src="<?php echo base_url().'assets/images/profile/'.$userdetails['logo'].'?'.time();?>"  alt="User Image" >
							  
							   <?php }else{?>
								   <img src="<?php echo base_url(); ?>assets/dashboard/images/logo.png" alt="Logo" title="Logo" />
							 
							 	<?php }   ?>
         						</a> 
             
                            </div>
                        </div>
                        <!-- End Logo -->
                        
                        <!-- Menu -->
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">
                        	<!-- Menu Desktop -->
                            <div class="menu">
                                <nav class="navbar navbar-inverse navbar-static-top">
                                    <ul class="nav navbar-nav">
                                        <li <?php if($controller=='orders'){?>class="active" <?php } ?>>
                                        <a href="<?php echo base_url(); ?>manager/orders"><i class="demo-icon icon-ico-orders">&#xe801;</i> Orders</a>
                                        </li>
                                        <li <?php if($controller=='reports'){?>class="active" <?php } ?>>
                                        <a href="<?php echo base_url(); ?>manager/reports"><i class="demo-icon icon-ico-reports">&#xe805;</i> Reports</a>
                                        </li>
                                        <li <?php if($controller=='customers'){?>class="active" <?php } ?>>
                                        <a href="<?php echo base_url(); ?>manager/customers"><i class="demo-icon icon-ico-customers">&#xe807;</i> Customers</a>
                                        </li>
                                        <li <?php if($controller=='location'){?>class="active" <?php } ?>>
                                        <a href="<?php echo base_url(); ?>manager/location"><i class="demo-icon icon-ico-locations">&#xe800;</i> Locations</a>
                                        </li>
                                        <li <?php if($controller=='profile'){?>class="active" <?php } ?>>
                                        <a href="<?php echo base_url(); ?>manager/profile"><i class="demo-icon icon-ico-profile">&#xe804;</i> Profile</a>
                                        </li>
                                            
                                        <li class="dropdown <?php if($controller=='preference' || $controller=='promocodes' || $controller=='notification' ){ ?>active <?php } ?>">
                                            <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            <img src="<?php echo base_url(); ?>assets/dashboard/images/menu-more-small.png" /> More</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo base_url(); ?>manager/preference"><i class="demo-icon icon-ico-preferences">&#xe802;</i> Preferences</a></li>
                                                <li><a href="<?php echo base_url(); ?>manager/promocodes"><i class="demo-icon icon-ico-promocodes">&#xe803;</i> Promo Codes</a></li>
                                                <li><a href="<?php echo base_url(); ?>manager/notification"><i class="fa fa-envelope-o"></i> Messages</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/home/logout"><i class="demo-icon icon-off">&#xe808;</i> Sign Out</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- End Menu Desktop -->
                        </div>
                        <!-- End Menu -->
                    </div>
                </div>
                <!-- End Logo Menu -->
            </div>
        </header>
        <!-- ===== End Header ===== -->
<script>
if(typeof(EventSource) !== "undefined") {
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
	
		$('.facebook').html(	$('#fb_svg').html());
		$('.web').html(	$('#web_svg').html());
		$('.app').html(	$('#app_svg').html());
		
		$('#countnew').html(count);
		$('.badgenew').html(count);
		$('#hidecount').val(count);
		//alert(count);
		//alert(oldcount);
		if(count!=oldcount && oldcount!='0'){
			setTimeout(function(){
		 		$('#toast').show();
				$('#toast').fadeOut(5000);
			}, 100);
		}else{
			
			
		}
		//document.getElementById("countnew").innerHTML = count;
    };
} else {
    document.getElementById("tablebody").innerHTML = "Sorry, your browser does not support server-sent events...";
}

	
</script>
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
                            

<div id="toast" style=" display:none;">
<div class="add-new-box">
<button class="submit_btn redSavetoast" onClick="clickToast()">
NEW ORDER
</button>
</div>
</div>





<input type="hidden" name="hidecount" value="0" id="hidecount">
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