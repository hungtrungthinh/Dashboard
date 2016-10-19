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
        
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/style.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="css/meanmenu.css" media="all" />-->
        
        <!-- Awesome Fonts -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dashboard/css/font-awesome.min.css" rel="stylesheet">
        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="<?php echo base_url(); ?>assets/dashboard/css/bootstrap-theme.min.css" rel="stylesheet">
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/dashboard/js/jquery.min.js"></script>
        <script src="<?php echo $template_url; ?>/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    </head>
    
    <body>
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
                
                <!-- Toggle Menus -->
                <nav>
                    <ul role="navigation" class="hidden">
                    	<a href="<?php echo base_url().$route.'/home'?>">
                		<img class="logo-res-menu" src="<?php echo base_url(); ?>assets/dashboard/images/logo-big.png" alt="Image" title="Image" />
                        </a>
                            <li class="active"><a href="<?php echo base_url().$route.'/orders';?>"><i class="demo-icon icon-ico-orders">&#xe801;</i> Orders</a></li>
                            <li><a href="<?php echo base_url().$route.'/menu';?>"><i class="demo-icon icon-ico-menu">&#xe805;</i> Menu</a></li>
                            <li><a href="<?php echo base_url().$route.'/preference';?>"><i class="demo-icon icon-ico-preferences">&#xe802;</i> Preferences</a></li>
                            <li><a href="<?php echo base_url().$route.'/profile';?>"><i class="demo-icon icon-ico-profile">&#xe804;</i> Profile</a></li>
                            
                		
                            
  
                        <p>&copy; Forkourse All Rights Reserved</p>
                    </ul>
                </nav>
                <!-- End Toggle Menus -->
            </div>
            
            
            <!-- Small DropDown -->
            <div class="res-small-dropDown">
            	<a href="<?php echo site_url('admin/home/logout'); ?>"><i class="demo-icon icon-off">&#xe808;</i></a>
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
                                <a href="<?php echo base_url().$route.'/home'?>"><img src="<?php echo base_url(); ?>assets/dashboard/images/logo.png" alt="Logo" title="Logo" /></a>
                            </div>
                        </div>
                        <!-- End Logo -->
                        
                        <!-- Menu -->
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">
                            <div class="menu">
                                <nav class="navbar navbar-inverse navbar-static-top">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a href="<?php echo base_url().$route.'/orders';?>"><i class="demo-icon icon-ico-orders">&#xe801;</i> Orders</a></li>
                                        <li><a href="<?php echo base_url().$route.'/menu';?>"><i class="demo-icon icon-ico-menu">&#xe805;</i> Menu</a></li>
                                        <li><a href="<?php echo base_url().$route.'/preference';?>"><i class="demo-icon icon-ico-preferences">&#xe802;</i> Preferences</a></li>
                                        <li><a href="<?php echo base_url().$route.'/profile';?>"><i class="demo-icon icon-ico-profile">&#xe804;</i> Profile</a></li>
                                        <li>
                                        <a href="<?php echo site_url('admin/home/logout'); ?>"> 
                                        	<i class="demo-icon icon-off">&#xe808;</i>
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
		
		
		$('#tablebody').html(content);
		$('#countnew').html(count);
		$('.badgenew').html(count);
		$('#hidecount').val(count);
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
    border-radius: 3px;
    box-shadow: 0 0 12px #999999;
    margin: 0 0 6px;
    opacity: 0.8;
    overflow: hidden;
    padding: 15px 15px 15px 50px;
    pointer-events: auto;
    position: Fixed;
    width: 300px;
	bottom:0;
	z-index:999999999;
    }
</style>
<div id="toast" style="display:none;" >A New Order Placed</div>
<input type="hidden" name="hidecount" value="0" id="hidecount">
