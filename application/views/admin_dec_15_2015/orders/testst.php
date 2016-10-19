
			
			<ul class="exclude1 exclude list sortable" id="addrowu_l">
		
				<li style="height: 30px" id="ids_0">	
				<div class="tb_row">	
					
					<div class="tb_td wd_5   al_center">
					<span class="relax notclicked"><img class="margin_top_6 relaximg" src="<?php echo site_url("assets/images/plus.png");?>" alt="plus" /></span>
			 		</div>
					<div class="tb_td wd_84">
					<a title="" class="link_blak_sml" href=""  id="cat_1" >abcd</a>
					
					</div>										
										
					
					
		</div>
		<div class="clear"></div>
		<ul class="subexclude hide list sortable2">
					
							<li style="height: 30px"  id="id_1">	
								<div class="tb_row ">								
										<div class="tb_td wd_3 color_active_config">
										<input disabled type="checkbox" name="sel[]" value=""  rel="" class="chk margin_lft_10 margin_top_8 curs_mov"  />
										</div>
										<div class="tb_td wd_5 color_active_config">										
										</div>
										<div class="tb_td wd_84 color_active_config">
										<a class="link_blak_sml" title="" href=""  id="sys_1" >1234</a>
										<a title="Delete System" class="link_blak_sml float_right delete_sys" rel="" href="javascript:void(0)" ><img class="margin_top_6" src="<?=base_url() ?>images/trashicon.gif" /></a>
										<a rel="" class="link_blak_sml float_right clone_system" href="javascript:void(0)" >[Clone System]</a>
										<a class="link_blak_sml float_right" href="" >[Configure System]</a>
										
										
										</div>
                                        </li>
                                        <li style="height: 30px"  id="id_2">	
                                      <div class="tb_row ">								
										<div class="tb_td wd_3 color_active_config">
										<input disabled type="checkbox" name="sel[]" value=""  rel="" class="chk margin_lft_10 margin_top_8 curs_mov"  />
										</div>
										<div class="tb_td wd_5 color_active_config">										
										</div>
										<div class="tb_td wd_84 color_active_config">
										<a class="link_blak_sml" title="" href=""  id="sys_2" >4567</a>
										<a title="Delete System" class="link_blak_sml float_right delete_sys" rel="" href="javascript:void(0)" ><img class="margin_top_6" src="<?=base_url() ?>images/trashicon.gif" /></a>
										<a rel="" class="link_blak_sml float_right clone_system" href="javascript:void(0)" >[Clone System]</a>
										<a class="link_blak_sml float_right" href="" >[Configure System]</a>
										
										
										</div>
										
							</li>
										
						<div class="clear"></div>	
				</ul>			
			
		</li>
		
		
		
				<li style="height: 30px" id="ids_1">	
				<div class="tb_row">	
					
					<div class="tb_td wd_5   al_center">
					<span class="relax notclicked"><img class="margin_top_6 relaximg" src="<?php echo site_url("assets/images/plus.png");?>" alt="plus" /></span>
			 		</div>
					<div class="tb_td wd_84">
					<a title="" class="link_blak_sml" href=""  id="cat_2" >efgh</a>
					
					</div>										
										
					
					
		</div>
		<div class="clear"></div>
		<ul class="subexclude hide list sortable2">
					
							<li style="height: 30px"  id="id_1">	
								<div class="tb_row ">								
										<div class="tb_td wd_3 color_active_config">
										<input disabled type="checkbox" name="sel[]" value=""  rel="" class="chk margin_lft_10 margin_top_8 curs_mov"  />
										</div>
										<div class="tb_td wd_5 color_active_config">										
										</div>
										<div class="tb_td wd_84 color_active_config">
										<a class="link_blak_sml" title="" href=""  id="sys_1" >1234</a>
										<a title="Delete System" class="link_blak_sml float_right delete_sys" rel="" href="javascript:void(0)" ><img class="margin_top_6" src="<?=base_url() ?>images/trashicon.gif" /></a>
										<a rel="" class="link_blak_sml float_right clone_system" href="javascript:void(0)" >[Clone System]</a>
										<a class="link_blak_sml float_right" href="" >[Configure System]</a>
										
										
										</div>
                                        </li>
                                        <li style="height: 30px"  id="id_2">	
                                      <div class="tb_row ">								
										<div class="tb_td wd_3 color_active_config">
										<input disabled type="checkbox" name="sel[]" value=""  rel="" class="chk margin_lft_10 margin_top_8 curs_mov"  />
										</div>
										<div class="tb_td wd_5 color_active_config">										
										</div>
										<div class="tb_td wd_84 color_active_config">
										<a class="link_blak_sml" title="" href=""  id="sys_2" >4567</a>
										<a title="Delete System" class="link_blak_sml float_right delete_sys" rel="" href="javascript:void(0)" ><img class="margin_top_6" src="<?=base_url() ?>images/trashicon.gif" /></a>
										<a rel="" class="link_blak_sml float_right clone_system" href="javascript:void(0)" >[Clone System]</a>
										<a class="link_blak_sml float_right" href="" >[Configure System]</a>
										
										
										</div>
										
							</li>
										
						<div class="clear"></div>	
				</ul>			
			
		</li>
		
		</ul>
          
		
<div id="clone_div"></div>
<script>
//****************Sub category relax**********************//
			$('.relax').click(function(){						
				obj = $(this).closest('li');	
				var count=obj.children('ul').children().length;					
				count=(count*35);										
				if(obj.children('ul').css('display') == 'none'){		
					
					$(this).addClass('clicked');
					$(this).removeClass('notclicked');
					obj.attr('style','height:'+count+'px');
					//obj.children('ul').attr('style:','height:'+count+'px')			
					obj.children('ul').removeClass('hide');		
					obj.children('ul').show();											
					// Change image +,- *****************************					
					$(this).children('img').removeAttr('src');
					$(this).children('img').attr('src','<?php echo site_url("images/minus.png");?>');				
				}
				else{
					$(this).addClass('notclicked');
					$(this).removeClass('clicked');
					obj.attr('style','height:30px');
					obj.children('ul').hide();					
					$(".sortable,.sortable2").sortable({
			     		opacity: 0.5
			        });
					// Change image +,- *****************************
					$(this).children('img').removeAttr('src');
					$(this).children('img').attr('src','<?php echo site_url("plus/images/plus.png");?>');		
				}							
			});
		//****************Sub category relax**********************//
		
		
		
$(function() {
			$('.expn_all').click(function(){
				
				if($(this).val()=='Collapse All')
				{					
					$('.clicked').click();
					$('.expn_all').attr('title','Expand All');					
					$('.expn_all').val('Expand All');					
				}
				else
				{					
					$('.notclicked').click();					
					$('.expn_all').attr('title','Collapse All');
					$('.expn_all').val('Collapse All');					
				}
				
			});
			
			
			$(".sortable,.sortable2").sortable({
			     opacity: 0.5
			        });

			
});

		

</script> 
<style>
ul,li{list-style-type:none !important}
</style>