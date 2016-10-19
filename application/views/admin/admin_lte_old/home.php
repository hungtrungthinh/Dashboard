 <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css">

	<?php if($error!=1){   ?>
    
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        
						
							
						<div class="col-lg-12" style="padding-top:10px;">
                        
                        
                        <?php 
						//echo "<pre>";print_r($menus);
						//echo $url_segment;
						foreach($menus as $menu){?> 
                        
                        <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-hometab">
                        <a href="<?php echo base_url().$this->user->root.'/'.$menu['controller'];?>/<?php echo $menu['method'];?>"  class="small-box-footer">
                        	<p style="height:78px; margin-top:18%; font-size:21px;">
							<?php echo strtoupper ($menu['menu_desc']);?>
                            </p>
                            <div class="icon">
                                <i class="fa fa-<?php echo $menu['class'];?>"></i>
                            </div>
                        </a>
                        </div>
                        
                        
                            <!--<div class="small-box bg-<?php echo $menu['controller'];?>">
                            <a href="<?php echo base_url().$this->user->root.'/'.$menu['controller'];?>"  class="small-box-footer">
                                <div class="inner">
                                    <h3>
                                    
                                        <?php /*?><?php
										 if($user->role==1){
										 switch($menu['controller']){
												case "orders":
													 echo $countorder?$countorder:0; 
													 break;
												case "customers":
													 echo $countcustomer?$countcustomer:0; 
													 break;
												case "restaurant":
													 echo $countrestaurant?$countrestaurant:0; 
													 break;
												case "settings":
													 echo $countsettings?$countsettings:0; 
													 break;
												}
										 }
										  if($user->role==2){
										 switch($menu['controller']){
												case "orders":
													 echo $countorder?$countorder:0; 
													 break;
												case "reports":
													 echo $countreport?$countreport:0; 
													 break;
												case "customers":
													 echo $countcustomer?$countcustomer:0; 
													 break;
												case "location":
													 echo $countlocation?$countlocation:0; 
													 break;
												case "profile":
													 echo 1; 
													 break;
											   case "promocodes":
													 echo $countpromocode?$countpromocode:0; 
													 break;
												}
										 }
										 if($user->role==3){
										 switch($menu['controller']){
												case "orders":
													 echo $countorder?$countorder:0; 
													 break;
												case "profile":
													echo 1; 
													 break;
												case "menu":
													echo  $countmenu?$countmenu:0;
													 break;
												case "preference":
													echo  $countpreference?$countpreference:0;
													 break;
												}
										 }
										
										 ?><?php */?>&nbsp;
                                    </h3>
                                    <p>
                                        <?php echo strtoupper ($menu['menu_desc']);?>
                                    </p>
                                </div>
                                 </a>
                                <div class="icon">
                                    <i class="fa fa-<?php echo $menu['class'];?>"></i>
                                </div>
                                </a>
                                <a href="<?php echo base_url().$this->user->root.'/'.$menu['controller'];?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                               </a>
                            </div>-->
                        </div><!-- ./col -->
                            
                        <?php }?> 
                        
                        
                       <?php /*?> <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-dark-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $restaurantcount?$restaurantcount:0;?>
                                    </h3>
                                    <p>
                                        Restaurant Management
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-grid "></i>
                                </div>
                                <a href="<?php echo base_url('/index.php/admin/restaurant/lists');?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-blue">
                                <div class="inner">
                                    <h3>
                                        <?php echo ($userscount)?$userscount:0; ?>
                                    </h3>
                                    <p>
                                       User Management
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('/index.php/admin/users/lists');?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
					
												
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray">
                                <div class="inner">
                                    <h3>
                                        <?php echo ($config_count)?$config_count:0; ?>
                                    </h3>
                                    <p>
                                       General Settings
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-settings"></i>
                                </div>
                                <a href="<?php echo base_url('/index.php/admin/configuration/settings');?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						<?php */?>
						
						</div>
						
                    </div><!-- /.row -->

        <?php }else{ ?>
        
        		<?php echo $error_message?>
                
        <?php } ?>          