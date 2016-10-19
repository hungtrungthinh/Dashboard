 <?php $url_segment = $this->uri->segment(2);
 	   $user_data = $this->session->userdata('user');
	
		?>


<!DOCTYPE html><head>
        <meta charset="UTF-8">
        <title><?php  echo $TITLE?$TITLE:'Forkourse'; ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="viewport" content="width=device-width" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $template_url; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- font Awesome -->
        <link href="<?php echo $template_url; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Ionicons -->
        <link href="<?php echo $template_url; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <!-- Morris chart -->
        <link href="<?php echo $template_url; ?>/css/morris/morris.css" rel="stylesheet" type="text/css">
        <!-- jvectormap -->
        <link href="<?php echo $template_url; ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
        <!-- Date Picker -->
        <link href="<?php echo $template_url; ?>/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
        <!-- Daterange picker -->
        <link href="<?php echo $template_url; ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo $template_url; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css">
        <!-- time picker  manager preference-->
        <link href="<?php echo $template_url; ?>/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
        <!-- Theme style -->
        <link href="<?php echo $template_url; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css">
		<link href="<?php echo $template_url; ?>/css/main.css" rel="stylesheet" type="text/css">
		
        
        
        


        <link href="<?php echo base_url('assets/css'); ?>/adminstyle.css" rel="stylesheet" type="text/css">
		<script src="<?php echo base_url('assets/js'); ?>/jquery.js"></script>
		 <script src="<?php echo base_url('assets');?>/js/jquery.datetimepicker.full.js"></script>
           
   		<script src="<?php echo base_url('assets');?>/js/jquery.bxslider.min.js"></script>
       
		<link href="<?php echo base_url('assets');?>/css/jquery.bxslider.css" rel="stylesheet" />
       
         <?php if($user_data->fk_restaurant_master_header!=''){?>
         <style>
		 body.skin-black > header > nav.navbar { background-color:<?php echo $user_data->fk_restaurant_master_header ; ?>;  }

		.checkbox-slider--b-flat input:checked + span:before {
		  background: <?php echo $user_data->fk_restaurant_master_body; ?>;
		}
		.badge{
			color:<?php echo $user_data->fk_restaurant_master_body; ?>;
			background-color:#FFF;
			line-height:1.5!important;
		}
		.badge:hover{
			/*background-color:#000; */
		}
		.nav-tabs > li.active > a > span {
			background-color: #E8E9EA!important;
		}
		.fontorange{
			color:<?php echo $user_data->fk_restaurant_master_body; ?>!important;
		}
		.tip{ color:<?php echo $user_data->fk_restaurant_master_body; ?> !important; font-size:20px !important;}
		.total_amt{ font-size:36px !important; color:<?php echo $user_data->fk_restaurant_master_body; ?> !important; text-align:right; padding-right:15px; width:100%;}
		.color_orange{ color:<?php echo $user_data->fk_restaurant_master_body; ?> !important;}
		.button_orange{ background:<?php echo $user_data->fk_restaurant_master_body; ?>; border:none; color:#fff; font-size:20px; padding:6px 30px; margin-bottom:15px; margin-left:5px;}
		.btn_save{ background:<?php echo $user_data->fk_restaurant_master_body; ?>; padding:6px 60px; font-size:18px; color:#fff; text-transform:uppercase;}
		.btn.btn-info {
		  background-color: <?php echo $user_data->fk_restaurant_master_body; ?>;
		  border-color: <?php echo $user_data->fk_restaurant_master_body; ?>;
		  color:#FFFFFF;
		}
		.btn.btn-info:hover,
		.btn.btn-info:active,
		.btn.btn-info.hover {
		  background-color: <?php echo $user_data->fk_restaurant_master_body; ?>;
		}
		.mr_2{
		color:<?php echo $user_data->fk_restaurant_master_body; ?>;
		}
		/* ---------- home tab colors ------------- */
		.bg-restaurant {
		  background-color: #036365 !important;
		}
		.bg-location {
		  background-color: #f39c12 !important;
		}
		.bg-menu {
		  background-color: #00c0ef !important;
		}
		.bg-reports {
		  background-color: #0073b7 !important;
		}
		.bg-orders {
		  background-color: #036365 !important;
		}
		.bg-customers {
		  background-color: #cccccc  !important;
		}
		
		.bg-profile {
		  background-color: #00a65a  !important;
		}
		.bg-hometab {
		  background-color: <?php echo $user_data->fk_restaurant_master_header;?>;
		  opacity:0.8;
		}

		.glyphicon-user{
		color:#fff;
		} 
		#toast{	
			background-color:<?php echo $user_data->fk_restaurant_master_body; ?>;
			color:#ffffff;
		}
		</style>
         <?php }else{?>
         <link href="<?php echo base_url('assets/css'); ?>/theme.css" rel="stylesheet" type="text/css">
         <?php }?>
    </head>
<script>
if(typeof(EventSource) !== "undefined") {
   	var source = new EventSource("<?php echo base_url().$this->user->root."/orders/loadNewOrder"?>");
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
<body class="skin-black">

<div id="toast" style="display:none;" >A New Order Placed</div>



<input type="hidden" name="hidecount" value="0" id="hidecount">
		<header class="header">
          <a href="<?php echo base_url().$route.'/home'; ?>" class="logo">
           <?php  
		   if($userdetails['logo']!='')
		   {?>
		    <img src="<?php echo base_url().'assets/images/profile/'.$userdetails['logo'];?>"  alt="User Image" class=" " style=" padding-top:3px;width:72%;vertical-align:middle !important;" >
          
		   <?php }else{?>
               <img class="" src="<?php echo base_url().'assets/images/logo.png' ?>"  alt="User Image" style="  padding-top:3px;width:72%;vertical-align:middle !important;" >
         
         <?php }   ?>
             </a>  
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
            	
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                       
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu" style="padding-top:10px;">
                                
                               <h4> <i class="glyphicon glyphicon-user"></i>
                                <span style="color:#FFFFFF" > Hi,<?php echo ucfirst($user_data->full_name);?>
                                 <a href="<?php echo site_url('admin/home/logout'); ?>" class="img-circle" style="margin-left:12px" title="Logout"> 
                                 <img src="<?php echo site_url('assets');?>/images/icon-logout.png" class="" alt="Log Out" >
                                 </a>  
                                </span > 
                                </h4> 

                           
                            
                        </li>
                    </ul>
                </div>
            </nav>
            
        </header>

<div class="wrapper row-offcanvas row-offcanvas-left" >

		<aside class="left-side sidebar-offcanvas" style="min-height: 1519px; background-color:#1F3749">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                   
                    
                   <div class="user-panel">
                       <?php //echo '<pre>';print_r($menus);?> 
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    	<?php 
			
						//echo $url_segment;
						//print_r($menus);exit;
						foreach($menus as $menu){?> 
                            <li <?php if($url_segment == $menu['controller']) {?>class="active" <?php } ?>>
                                <a href="<?php echo base_url().$route; ?>/<?php echo $menu['controller'];?>/<?php echo $menu['method'];?>">
                                    <i class="fa fa-<?php echo $menu['class'];?>"></i> <span><?php echo $menu['menu_title'];?></span>
                                </a>
                            </li>
                        <?php }?> 
                    
                       <?php /*?> <li <?php if($url_segment == 'home') {?>class="active" <?php } ?>>
                            <a href="<?php echo base_url(); ?>index.php/admin/restaurant/add">
                                <i class="fa fa-globe"></i> <span>Restaurant</span>
                            </a>
                        </li>
                        <li <?php if($url_segment == 'home') {?>class="active" <?php } ?>>
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-file-text"></i> <span>Order</span>
                            </a>
                         </li>
                          <li>
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-file"></i> <span>Report</span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo base_url('index.php/admin/configuration/changePassowrd');?>">
                                <i class="fa fa-lock"></i> <span>Change Password</span>
                            </a>
                          </li><?php */?>
                       
                        
                        
                        
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            
            
            <aside class="right-side">
            
            <?php /*?><section class="content-header">
                <h1>
                    <?php echo $SUB_TITLE?$SUB_TITLE:'Control Panel';?>
                </h1>
                <ol class="breadcrumb">
                	<?php
					$controller = $this->router->fetch_class();
					$method     = $this->router->fetch_method();
					
					switch($controller){
						case "app" :
							$controller = 'App customization';
							break;
						case "contacts":
							$controller = 'Contact Us';
							break;
					}
					
					switch($method){
						case "index" :
							$method = $controller;
							break;
						case "lists":
							$method = 'Manage'.' '.$controller;
							break;
						case "progress":
							$method = 'In progress';
							break;
						default :
							$method = str_replace('_',' ',$method);
					}
					
					?>
                    <li>
                    	<a href="<?php echo base_url().'admin/'.$this->router->fetch_class(); ?>"><i class="fa fa-dashboard"></i> 
							<?php echo ucwords($controller); ?>
                         </a>
                    </li>
                    <li class="active"><?php echo ucwords($method); ?></li>
                </ol>
            </section><?php */?>
            
            <div id="status"></div>
            <?php if($this->session->flashdata('message')){ ?>
            <section class="alert alert-success">
             <?php echo $this->session->flashdata('message'); ?>
            </section>
            <?php } ?>
            
             <?php if($this->session->flashdata('error')){ ?>
            <section class="alert alert-danger">
             <?php echo $this->session->flashdata('error'); ?>
            </section>
            <?php } ?>
            
            <section class="wp-content">