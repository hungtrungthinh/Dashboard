<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Menu extends My_Controller {


	public function __construct()
	{                        
		parent::__construct();
		$this->_setAsAdmin();
		$this->load->helper(array('url','cookie'));	
		$this->load->model('admin/menu_model');		
		$this->user 	= $this->session->userdata('user');
		if($this->user=='')
			redirect('admin');	
	}

	public function index()
	{
		redirect($this->user->root.'/menu/category');
	}
	public function category($category_id){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;
		if($_SERVER['REQUEST_METHOD']=='POST'){
		//print_r($_POST);exit;
			$category_id		=	$this->input->post('cate_id');
			$array=array(	
							'category_name'=>$this->input->post('category_name'),
							'subtitle'=>$this->input->post('subtitle'),
							'restaurant_id'=>$restaurant_id,
							'location_id'=>$location_id,
							'status'=>'Y',
						);
			$number	=	$this->menu_model->maxSortOrderCategory($location_id);
			$data['dishlist']	=	$this->menu_model->gelSelectedDishItems($location_id);
			$result	=	$this->menu_model->checkCategoryExist($location_id,$array['category_name'],$category_id);
			
			if(count($result)!=0){
				$this->session->set_flashdata('error_message', 'Category already exist');
				redirect($this->user->root.'/menu/category/'.$category_id);
			}else{
				$resultsitem['id']	=$this->menu_model->insertCategory($array,$category_id,$number);
				if($category_id!='')
					$this->session->set_flashdata('success_message', 'Category updated successfully');
				else
					$this->session->set_flashdata('success_message', 'Category added successfully');
				redirect($this->user->root.'/menu/category/'.$category_id);
			}

		}else{
			if($category_id!=''){
				$data['categorydetails']	=$this->menu_model->getCategoryDetails($category_id);
			}
			$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
			$data['dishlist']	=	$this->menu_model->gelSelectedDishItems($location_id);
			foreach($data['categorylist'] as $val){
				//$this->menu_model->delAllDishItems($val['category_id']);
			}
		
			//echo '<pre>';print_r($data['categorylist']);exit;		
			$ouput['output']			= $this->load->view('admin/menu/chef/menu-tab',$data,true);
			$this->_render_output($ouput);
		}
	}
	public function dish($cat_id)
	{   
	    $user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;		
		$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		
		
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			$data['dishlist']	=	$this->menu_model->gelSelectedDishItems($location_id,$cat_id);
			//print_r($data['dishlist']);
		}else{
			if($cat_id==''){
				$data['cat_id']='';
				$data['dishlist']	=	$this->menu_model->gelSelectedDishItems($location_id);
			}else{
				$data['cat_id']=$cat_id;
				$data['dishlist']	=	$this->menu_model->gelSelectedDishItems($location_id,$cat_id);
			}
		}
		//echo $data['cat_id'];
		//print_r($data['dishlist']);
		
		$ouput['output']			= $this->load->view('admin/menu/chef/dish-tab',$data,true);
		$this->_render_output($ouput);
	}
	
	public function add_dish($cat_id,$item_id){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;		
		
		$this->load->library('user_agent');

		if ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
			$data['is_mobile']=1;
		}else{
			$agent = 'Unidentified User Agent';
			$data['is_mobile']=0;
		}
		
		//echo $agent;
		
		if($_SERVER['REQUEST_METHOD']=='POST'){
			//echo '<pre>';print_r($_POST);exit;
			$item_id		=	$this->input->post('item_id');
			$number	=	$this->menu_model->maxSortOrderDishItem($location_id,$this->input->post('category'));

			
			$array=array(	
							'category_id'=>$this->input->post('category'),
							'item_name'=>stripslashes(mysql_real_escape_string($this->input->post('menu_item'))),
							'item_description'=>$this->input->post('description'),
							'sortorder'=>$number+1,
						);
			$result	=	$this->menu_model->checkItemExist($array['category_id'],$array['item_name'],$item_id);

			if(count($result)!=0){
				$this->session->set_flashdata('error_message', 'Item already exist');
				redirect($this->user->root.'/menu/add_dish/'.$item_id);
			}else{
				$resultsitem['id']	=$this->menu_model->insertDishItems($array,$item_id);
				//echo $resultsitem['id'];exit;
				//-------------for options and dishes start
				
				//for price and sizes
				
				$mulsize=$this->input->post('mulsize');
				$mulprice=$this->input->post('mulprice');
				$mulsizeid=$this->input->post('mulsizeid');
				//echo print_r($mulprice);exit;
				
				if($this->input->post('nosize')=='no'){
					for($i=0;$i<count($mulsize);$i++){
						 if($mulsize[$i]!='' and $mulprice[$i]!=''){
							$newarr=array("item_id"=>$resultsitem['id'],
									  "size"=>$mulsize[$i],
									  "price"=>$mulprice[$i]
									  );	
							$resu	=$this->menu_model->UpdateOrInsertDishItemSize($newarr,$mulsizeid[$i]);			  
						}
					}	  
				}else{
					
					$newarr=array("item_id"=>$resultsitem['id'],
								  "size"=>"Regular",
								  "price"=>$this->input->post('price_dish')
								  );
					$resu	=$this->menu_model->insertDishItemSize($newarr,$resultsitem['id']);	
				}
				//$delid	=$this->menu_model->deleteOptionAndSides($resultsitem['id']);
				
				//echo '<pre>';print_r($_POST);exit;
				if($agent=='iPhone' || $agent=='Android' || $agent=='BlackBerry')
				{
					$option_item		=	$this->input->post('option_item_mob');
				}else{
					$option_item		=	$this->input->post('option_item');
				}
		
				$rev_option_item = array_reverse($option_item);
				//$rev_option_item = $option_item;
				$j=1;
				
				
				for($i=0;$i<count($rev_option_item);$i++)
				{
				
					$ar=array('option_item'=>$rev_option_item[$i],
						  	  'sides'=>$this->input->post('sides_'.$j),
						  	  'price'=>$this->input->post('price_'.$j)
						  );
						// print_r($ar);	
						$sidearr=  $this->input->post('sides_'.$j);
						$mandatoryAr=  $this->input->post('mandatory_'.$j);
						if($agent=='iPhone' || $agent=='Android' || $agent=='BlackBerry')
						{
							$mul_limAr=  $this->input->post('mul_lim_'.$j);
						}else{
							$mul_limAr=  $this->input->post('mul_lim_mob_'.$j);
						}
				
						$multipleAr=  $this->input->post('multiple_'.$j);
						if($multipleAr=='on'){
							$multiple='Y';
							$mul_lim=$mul_limAr;
						}else{
							$multiple='N';
							$mul_lim=1;
						}
						if($mandatoryAr=='on'){
							$mandatory='Y';
						}else{
							$mandatory='N';
						}
						
						
						$maxnum	=$this->menu_model->maxSortOrder($location_id,$resultsitem['id']);
						$maxnum=$maxnum+1;
						if($ar['option_item']!='' and $sidearr[0]!=''){
							
							$dishoption=array("location_id"=>$location_id,
											  "restaurant_id"=>$restaurant_id,
											  "dish_item_id"=>$resultsitem['id'],
											  "option_name"=>$ar['option_item'],
											  "mandatory"=>$mandatory,
											  "multiple"=>$multiple,
											  "limit"=>$mul_lim,
											  "sortorder"=>$maxnum,
											   );
							//insert into dish_options
							$optid	=$this->menu_model->insertDishOptions($dishoption);
							//echo '<pre>';$ar['option_item'];
							if(count($ar['sides'])!=0 and count($ar['price'])!=0){
								for($k=0;$k<count($ar['sides']);$k++){
									if($ar['sides'][$k]!=''){
										//insert into option_sides
										$sidenumber	=$this->menu_model->maxSortOrderDish($optid);
										$sidenumber=$sidenumber+1;
										$sidesarray=array("option_id"=>$optid,
											   "side_item"=>$ar['sides'][$k],
											   "price"=>$ar['price'][$k],
											   "sortorder"=>$sidenumber,
											   );
										$dishid	=$this->menu_model->insertOptionsSides($sidesarray);
										
										//echo '<pre>';echo $ar['sides'][$k];
										//echo '<pre>';echo $ar['price'][$k];
									}
								}
							}
						}	  
						  
						  
					$j++;
				}	
				
				//-------------for options and dishes-----close
				
				if($item_id!='')
					$this->session->set_flashdata('success_message', 'Dish item updated successfully');
				else
					$this->session->set_flashdata('success_message', 'Dish item added successfully');
				redirect($this->user->root.'/menu/add_dish/'.$array['category_id'].'/'.$resultsitem['id']);
				//echo $this->load->view('admin/menu/add_dish');
				exit;
			}
		
		}else{
			if($item_id!=''){
				$result	=	$this->menu_model->checkItem($item_id);
				if(count($result)!=0){
					$data['itemdetails']	=$this->menu_model->getItemDetails($item_id);
					$data['options_details']	=$this->menu_model->getDishOptions($item_id);
					$data['sizes_details']	=$this->menu_model->getDishsizes($item_id);
					
					if(count($data['options_details']!='')){
						foreach($data['options_details'] as $var){
								$sidesdetails[$var['option_id']]	=$this->menu_model->getOptionSides($var['option_id']);
							
						}
					}
					$data['sidesdetails']=$sidesdetails;
					
					$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
					$ouput['output']			= $this->load->view('admin/menu/chef/add-dish_new',$data,true);
					$this->_render_output($ouput);
					
				}else{
					redirect($this->user->root.'/menu/dish');
					
				}
			}else{
				$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
				
				$data['itemdetails']['category_id']= $cat_id;
				$ouput['output']			= $this->load->view('admin/menu/chef/add-dish',$data,true);
				$this->_render_output($ouput);
			}
		}
		
		
	}
	public function copyDish($cat_id,$item_id){
		
		$category_id=$_POST['category_id'];
		$item_id=$_POST['item_id'];
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;		
		
		
		
		if($item_id!=''){
			
				$details	=$this->menu_model->get_where('fk_dish_items_master',array("item_id"=>$item_id));
				
				if(count($details)!=0){
					$arr=array(
						"category_id"=>$details['category_id'],
						"item_name"=>stripslashes(mysql_real_escape_string($details['item_name'].'_copy')),
						"item_description"=>mysql_real_escape_string($details['item_description']),
						"status"=>$details['status']);
				}
				echo $new_item_id	=$this->menu_model->insert('fk_dish_items_master',$arr);
				
				$sizes_details	=$this->menu_model->get_where('fk_dish_item_size_map',array("item_id"=>$item_id), "result");
				
				if(count($sizes_details)!=0){
					foreach($sizes_details as $size){
						$sizearr=array(
							"item_id"=>$new_item_id,
							"size"=>$size['size'],
							"price"=>$size['price'],
							"status"=>$size['status']
						);
						$this->menu_model->insert('fk_dish_item_size_map',$sizearr);
					}
				}
				//echo '<pre>';print_r($sizes_details);exit;
				
				$options_details	=$this->menu_model->get_where('fk_dish_options',array("dish_item_id"=>$item_id), "result");
				
				
				if(count($options_details)!=0){
					foreach($options_details as $opt){
						$optarr=array(
							"dish_item_id"=>$new_item_id,
							"location_id"=>$opt['location_id'],
							"restaurant_id"=>$opt['restaurant_id'],
							"option_name"=>$opt['option_name'],
							"status"=>$opt['status'],
							"mandatory"=>$opt['mandatory'],
							"multiple"=>$opt['multiple'],
							"sortorder"=>$opt['sortorder'],
							"limit"=>$opt['limit']
						);
						$newoption_id=$this->menu_model->insert('fk_dish_options',$optarr);
						$sides_details	=$this->menu_model->get_where('fk_option_sides',array("option_id"=>$opt['option_id']), "result");
						if(count($sides_details)!=0){
							foreach($sides_details as $side){
								$sidearr=array(
									"option_id"=>$newoption_id,
									"side_item"=>$side['side_item'],
									"price"=>$side['price'],
									"sortorder"=>$side['sortorder'],
								);
								$this->menu_model->insert('fk_option_sides',$sidearr);
								
							}
						}
					}
				}
				
			}else{
				
				$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
				$data['itemdetails']['category_id']= $cat_id;
				echo $this->load->view('admin/menu/copy-dish',$data);
				//$this->_render_output($ouput);
		}

		
	
	}
	
	
	public function SaveDishItem(){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;
		$item_id		=	$this->input->post('item_id');
		$this->load->library('user_agent');
		if ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
			$data['is_mobile']=1;
		}
		else
		{
			$agent = 'Unidentified User Agent';
			$data['is_mobile']=0;
		}
		$array=array(	
						'category_id'=>$this->input->post('category'),
						'item_name'=>stripslashes(mysql_real_escape_string($this->input->post('menu_item'))),
						'item_description'=>mysql_real_escape_string($this->input->post('description')),
					);
		$resultsitem['id']	=$this->menu_model->insertDishItems($array,$item_id);
		
		$mulsize=$this->input->post('size_array');
		$mulprice=$this->input->post('price_array');
		$mulsizeid=$this->input->post('map_id');
		//echo print_r($mulprice);exit;
		//echo '<pre>';print_r($_POST);exit;
		if($this->input->post('nosize')!='true'){
			$newarr=array("item_id"=>$resultsitem['id'],
						  "size"=>"Regular",
						  "price"=>$this->input->post('price_array')
						  );
			
			$resu	=$this->menu_model->insertDishItemSize($newarr,$resultsitem['id']);			
		}else{
			$resu	=$this->menu_model->deleteDishItemSize($resultsitem['id']);			
			for($i=0;$i<count($mulsize);$i++){
				if($mulsize[$i]!='' and $mulprice[$i]!=''){
						$newarr=array("item_id"=>$resultsitem['id'],
							  "size"=>$mulsize[$i],
							  "price"=>$mulprice[$i]
							  );	
					//$resu	=$this->menu_model->UpdateOrInsertDishItemSize($newarr,$mulsizeid[$i]);			  
					$resu	=$this->menu_model->UpdateOrInsertDishItemSize($newarr);			  
				}
			}
		}
		$optionsides=$this->input->post('optionsides');
		$optionprice=$this->input->post('optionprice');
		$option_item=$this->input->post('option_item');
		$mandatory=$this->input->post('mandatory');
		$multiple=$this->input->post('multiple');
		$mul_lim=$this->input->post('mul_lim');
		
		$number	=$this->menu_model->maxSortOrder($location_id,$item_id);
		
		$dishoption=array("location_id"=>$location_id,
						  "restaurant_id"=>$restaurant_id,
						  "dish_item_id"=>$item_id,
						  "option_name"=>$option_item,
						  "mandatory"=>$mandatory,
						  "multiple"=>$multiple,
						  "limit"=>$mul_lim,
						  "sortorder"=>$number+1,
					);
		if($option_item!='' and $optionsides[0]!=''){
		//insert into dish_options
			$optid	=$this->menu_model->insertDishOptions($dishoption);
			if(count($optionsides)!=0 ){
				for($k=0;$k<count($optionsides);$k++){
				
					$sidenumber	=$this->menu_model->maxSortOrderDish($optid);
					$maxnumber= $sidenumber+1;
		
		
					if($optionsides[$k]!=''){
					//insert into option_sides
						$sidesarray=array("option_id"=>$optid,
										   "side_item"=>$optionsides[$k],
										   "price"=>$optionprice[$k],
										   "sortorder"=>$maxnumber
								   );
						$dishid	=$this->menu_model->insertOptionsSides($sidesarray);
						
					}
				}
			}
							
		}
		$arrOptid=$this->input->post('arrOptid');
		$arrMan=$this->input->post('arrMan');
		$arrMul=$this->input->post('arrMul');
		$arrLimit=$this->input->post('arrLimit');
		if(count($arrOptid)!=0 ){
				for($j=0;$j<count($arrOptid);$j++){
						$arraydata=array("mandatory"=>$arrMan[$j],
										 "multiple"=>$arrMul[$j],
										 "limit"=>$arrLimit[$j]
								   );
						
						$dishid	=$this->menu_model->updateDishitem($arraydata,$arrOptid[$j]);
					}
				}
		//echo '<pre>';print_r($arrLimit);exit;		
		$newsideArrayID=$this->input->post('newsideArrayID');
		$newsideArray=$this->input->post('newsideArray');
		$newPriceArray=$this->input->post('newPriceArray');	
		if(count($newsideArrayID)!=0 ){ 	 	
			for($l=0;$l<count($newsideArrayID);$l++){
				if($newsideArray[$l]!=''){
						$sidenumber	=$this->menu_model->maxSortOrderDish($newsideArrayID[$l]);
						$arraydata2=array("side_item"=>$newsideArray[$l],
										  "price"=>$newPriceArray[$l],
										  "option_id"=>$newsideArrayID[$l],
										  "sortorder"=>$sidenumber+1,
									   );
						$dishid	=$this->menu_model->insertOptionsSides($arraydata2);
					}
				}
		}
		
		if($item_id!=''){
				$data['itemdetails']	=$this->menu_model->getItemDetails($item_id);
				$data['options_details']	=$this->menu_model->getDishOptions($item_id);
				$data['sizes_details']	=$this->menu_model->getDishsizes($item_id);
				
				if(count($data['options_details']!='')){
					foreach($data['options_details'] as $var){
							$sidesdetails[$var['option_id']]	=$this->menu_model->getOptionSides($var['option_id']);
						
					}
				}
				$data['sidesdetails']=$sidesdetails;
				
			//echo '<pre>';print_r($data);exit;
			//echo '<pre>';print_r($data);
			//echo $item_id;
			
		}	
		$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		echo $this->load->view('admin/menu/ajaxoptionsides',$data);
		
	}
	public function editOption(){
		
		//echo '<pre>';print_r($_POST);exit;
		
		$option_item		=	$this->input->post('option_item');
		$option_id		=	$this->input->post('option_id');
		$sides		=	$this->input->post('sides');
		$price		=	$this->input->post('price');
		$sidesID		=	$this->input->post('sidesID');
		if($option_item!='' and $option_id	!=''){
			$this->menu_model->updateDishOptions($option_id,$option_item);
			for($i=0;$i<count($sides);$i++)
				{
					if(trim($sides[$i])!='' and trim($price[$i])!=''){
					$array=array(
								'side_item'=>$sides[$i],
								'price'=>$price[$i],
								'option_id'=>$option_id,
					);
					if($sidesID[$i]!=''){
				 		$dishid	=$this->menu_model->UpdateOptionsSides($array,$sidesID[$i]);
					}else{
				 		$dishid	=$this->menu_model->insertOptionsSides($array);
					}
					}
				
				}	
			$this->session->set_flashdata('success_message', 'Option updated successfully');	
			redirect($this->user->root.'/menu/dish');
		}else{
			redirect($this->user->root.'/menu/dish');
		}
		
		
	}
	public function checkItemExist(){
		$category_id	=	$this->input->post('category');
		$item_name		=	stripslashes(mysql_real_escape_string($this->input->post('menu_item')));
		$item_id		=	$this->input->post('item_id');
		$result	=	$this->menu_model->checkItemExist($category_id,$item_name,$item_id);
			if(count($result)!=0){
				echo "0";//exist
			}else{
				echo "1";//not exist
			}
		exit;
	}
	public function deleteDishItem($item_id){
	
		$item_id		=	$this->input->post('item_id');
		if($item_id!='')
			$res	=	$this->menu_model->delRestaurantItems($item_id);
		$this->session->set_flashdata('success_message', 'Dish item deleted successfully');
		//redirect('admin/menu/dish/');
		exit;
	}
	public function deleteDish($item_id){
		
		$item_id		=	$this->input->post('item_id');
		if($item_id!='')
			$res	=	$this->menu_model->delRestaurantItems($item_id);
		$this->session->set_flashdata('success_message', 'Dish item deleted successfully');
		redirect('admin/menu/dish/');
	}
	
	
	public function itemStatus(){
	
		$item_id=$_POST['item_id'];
		if($_POST['status']=='Y')
			$status='N';
		else
			$status='Y';
		if($item_id!='')
			$res	=	$this->menu_model->dishItemStatus($item_id,$status);
	
	}
	
	
	public function checkCategoryExist(){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;		
		
		$category_name	=	$this->input->post('category');
		$category_id		=	$this->input->post('category_id');
		$result	=	$this->menu_model->checkCategoryExist($location_id,$category_name,$category_id);
			if(count($result)!=0){
				echo "0";//exist
			}else{
				echo "1";//not exist
			}
		exit;
	}	
	public function getCategoryDetail(){
		$cat_id=$_POST['cat_id'];
		$res	=	$this->menu_model->getCategoryDetails($cat_id);
		$data['category_id']=$res['category_id'];
		$data['category_name']=stripslashes($res['category_name']);
		$data['subtitle']=stripslashes($res['subtitle']);
		echo json_encode($data);
		exit;
	}
	public function categoryStatus(){
	
		$category_id=$_POST['category_id'];
		if($_POST['status']=='Y')
			$status='N';
		else
			$status='Y';
		if($category_id!='')
			$res	=	$this->menu_model->categoryStatus($category_id,$status);
	
	}
	
	public function deleteSides()
	{
		$sidesid=isset($_POST['sidesid'])?$_POST['sidesid']:'';
		$optionsid=$_POST['optionsid'];
		$res	=	$this->menu_model->delDishItemSides($sidesid,$optionsid);
		echo $res;
		exit;
	}
	public function saveOptionAjax(){
		$option_id=$_POST['option_id'];
		$option_name =$_POST['name'];
		$this->menu_model->setTable('fk_dish_options');
		$res	=	$this->menu_model->update_by(array('option_id'=>$option_id), array('option_name'=>$option_name));
		return true;
	}
	public function saveOptionSideAjax(){
		$option_id=$_POST['option_id'];
		$side_id=$_POST['side_id'];
		$side_item =$_POST['value'];
		$this->menu_model->setTable('fk_option_sides');
		if($side_id!=''){
			$res	=	$this->menu_model->update_by(array('side_id'=>$side_id), array('side_item'=>$side_item));
		}else{
			if($side_item!=''){
				$res	=	$this->menu_model->insert(array('option_id'=>$option_id,'side_item'=>$side_item));
			}
		}
		//echo $this->db->insert_id();
		//print_r($res);
		$data['sidesdetails']	=$this->menu_model->getOptionSides($option_id,'ASC');
		$data['option_id']	=	$option_id;
		echo $this->load->view('admin/menu/ajaxSidePrice',$data);
		
		return true;
	}
	public function saveOptionPriceAjax(){
		$option_id=$_POST['option_id'];
		$side_id=$_POST['side_id'];
		$price =$_POST['value'];
		$this->menu_model->setTable('fk_option_sides');
		$res	=	$this->menu_model->update_by(array('side_id'=>$side_id), array('price'=>$price));
		return true;
	}

	
	public function OptionStatus(){
	
		$option_id=$_POST['option_id'];
		if($_POST['status']=='Y')
			$status='N';
		else
			$status='Y';
		if($option_id!=''){
			$this->menu_model->setTable('fk_dish_options');
			$res	=	$this->menu_model->update_by(array('option_id'=>$option_id), array('status'=>$status));
		}
	}
	
	public function saveSidesAjax(){
		$side_id=$_POST['sides_id'];
		$side_item =$_POST['sides'];
		$this->menu_model->setTable('fk_option_sides');
		$res	=	$this->menu_model->update_by(array('side_id'=>$side_id), array('side_item'=>$side_item));
		return true;
	}	
	public function saveSidesPriceAjax(){
		$side_id=$_POST['sides_id'];
		$price =$_POST['price'];
		$this->menu_model->setTable('fk_option_sides');
		$res	=	$this->menu_model->update_by(array('side_id'=>$side_id), array('price'=>$price));
		return true;
	}	
	
	
	public function deleteCategory($category_id){
		$category_id		=	$this->input->post('category_id');
		if($category_id!='')
			$res	=	$this->menu_model->delCategory($category_id);
		$this->session->set_flashdata('success_message', 'Category deleted successfully');
		//redirect('admin/menu/dish/');
	}
	public function addOptionDiv(){
		$data['count']=$_POST['count']+1;
		echo $this->load->view('admin/menu/optionDiv',$data);
	}
	public function addSidesDiv(){
		$data['optid']=$_POST['optid'];
		$data['count']=$_POST['count']+1;
		echo $this->load->view('admin/menu/chef/sidesDiv',$data);
	}
	public function ajaxAddSidePrice(){
		$data['newid']=$_POST['newid'];
		$data['newcnt']=$_POST['newcnt'];
		$data['item_id']=$_POST['item_id'];

		$mulsize=$_POST['size_array'];
		$mulprice=$_POST['price_array'];
		$mulsizeid=$_POST['map_id'];
		//echo '<pre>';print_r($_POST);exit;
		for($i=0;$i<count($mulsize);$i++){
			if($mulsize[$i]!='' and $mulprice[$i]!=''){
				
				if($data['item_id']!=''){
					$newarr=array("item_id"=>$data['item_id'],
						  "size"=>$mulsize[$i],
						  "price"=>$mulprice[$i]
						  );	
					$resu	=$this->menu_model->UpdateOrInsertDishItemSize($newarr,$mulsizeid[$i]);	
				}
			}
		}
				
		echo $this->load->view('admin/menu/chef/ajaxAddSidePrice',$data);
	}
	public function ajaxUpdateDIshItem(){
		$category=$_POST['category'];
		$menu_item=stripslashes(mysql_real_escape_string($_POST['menu_item']));
		$description=stripslashes(mysql_real_escape_string($_POST['description']));
		$item_id=$_POST['item_id'];
		
		$newarray=array("category_id"=>$category,
						"item_name"=>$menu_item,
						"item_description"=>$description,
						);
		$resu	=$this->menu_model->insertDishItems($newarray,$item_id);			  
		
		
		$result	=$this->menu_model->getItemDetails($resu);			  
		$result['item_name']=stripslashes($result['item_name']);
		//echo '<pre>';print_r($result);	exit;
		echo json_encode($result);		
		//echo $this->load->view('admin/menu/ajaxAddSidePrice',$data);
	}
		
		
		
	public function addSidesPopDiv(){
		$data['optid']=$_POST['optid'];
		$data['count']=$_POST['count']+1;
		echo $this->load->view('admin/menu/sidesPopup',$data);
	}	
	public function ajaxOptionAndSides(){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;		
		$option_item=$_POST['option_item'];
		$optside=$_POST['optside'];
		$optprice=$_POST['optprice'];
		$item_id=$_POST['item_id'];
		$mandatory=$_POST['mandatory'];
		$multiple=$_POST['multiple'];
		$limit=$_POST['mul_lim'];
		
		$this->load->library('user_agent');
		if ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
			$data['is_mobile']=1;
		}
		else
		{
			$agent = 'Unidentified User Agent';
			$data['is_mobile']=0;
		}
		
		$number	=$this->menu_model->maxSortOrder($location_id,$item_id);
		
		$dishoption=array("location_id"=>$location_id,
						  "restaurant_id"=>$restaurant_id,
						  "dish_item_id"=>$item_id,
						  "mandatory"=>$mandatory,
						  "multiple"=>$multiple,
						  "limit"=>$limit,
					   	  "option_name"=>$option_item,
					   	  "sortorder"=>$number+1,
					);
		//insert into dish_options
		$optid	=$this->menu_model->insertDishOptions($dishoption);
		
		
		
		
		
		
		if(count($optside)!=0 and count($optprice)!=0){
			for($k=0;$k<count($optside);$k++){
				if($optside[$k]!='' and $optprice[$k]!=''){
				//insert into option_sides
				$sidenumber	=$this->menu_model->maxSortOrderDish($optid);
				$maxnumber= $sidenumber+1;
		
					$sidesarray=array("option_id"=>$optid,
						   		   "side_item"=>$optside[$k],
								   "price"=>$optprice[$k],
								   "sortorder"=>$maxnumber,
							   );
							   
							   
					$dishid	=$this->menu_model->insertOptionsSides($sidesarray);
				}
			}
		}
							
							
		if($item_id!=''){
				$data['itemdetails']	=$this->menu_model->getItemDetails($item_id);
				$data['options_details']	=$this->menu_model->getDishOptions($item_id);
				$data['sizes_details']	=$this->menu_model->getDishsizes($item_id);
				
				if(count($data['options_details']!='')){
					foreach($data['options_details'] as $var){
							$sidesdetails[$var['option_id']]	=$this->menu_model->getOptionSides($var['option_id']);
						
					}
				}
				$data['sidesdetails']=$sidesdetails;
				
			//echo '<pre>';print_r($data['sizes_details']);exit;
			//echo '<pre>';print_r($data);
			//echo $item_id;
			
		}
		$data['item_id']=$item_id;
		$data['page']="plusBtn";
		$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		echo $this->load->view('admin/menu/chef/ajaxoptionsides',$data);
	}
	public function optionPopup(){
		$data['option_id']=$_POST['option_id'];
		//$data['count']=$_POST['count']+1;
		$data['options_details']	=$this->menu_model->getOptionDetail($data['option_id']);
		$data['sidesdetails']	=$this->menu_model->getOptionSides($data['option_id']);
		//echo '<pre>';print_r($data['sidesdetails']);	
		//exit;		
		echo $this->load->view('admin/menu/optionPopup',$data);
	}	
	
	public function deleteall(){
		$data['option_id']=$_POST['option_id'];
		//$data['count']=$_POST['count']+1;
		$data['deletealloptions']	=$this->menu_model->delDishOption($data['option_id']);
		$data['deleteallsides']	=$this->menu_model->delDishSide($data['option_id']);
		//echo '<pre>';print_r($data['sidesdetails']);	
		exit;		
		
	}	
	
	public function add_dish_1($item_id){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;		
		
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			$item_id		=	$this->input->post('item_id');
			$array=array(	
							'category_id'=>$this->input->post('category'),
							'item_name'=>stripslashes(mysql_real_escape_string($this->input->post('menu_item'))),
							'price'=>$this->input->post('price_dish'),
							'item_description'=>mysql_real_escape_string($this->input->post('description')),
						);
			$result	=	$this->menu_model->checkItemExist($array['category_id'],$array['item_name'],$item_id);

			if(count($result)!=0){
				$this->session->set_flashdata('error_message', 'Item already exist');
				redirect($this->user->root.'/menu/add_dish/'.$item_id);
			}else{
				$resultsitem['id']	=$this->menu_model->insertDishItems($array,$item_id);
				//echo $resultsitem['id'];exit;
				//-------------for options and dishes start
				
				
				//$delid	=$this->menu_model->deleteOptionAndSides($resultsitem['id']);
				
				
				$option_item		=	$this->input->post('option_item');
				$rev_option_item = array_reverse($option_item);
				$j=1;
				for($i=0;$i<count($rev_option_item);$i++)
				{
					$ar=array('option_item'=>$rev_option_item[$i],
						  'sides'=>$this->input->post('sides_'.$j),
						  'price'=>$this->input->post('price_'.$j)
						  );
						  
						if($ar['option_item']!=''){
							
							$dishoption=array("location_id"=>$location_id,
											   "restaurant_id"=>$restaurant_id,
											   "dish_item_id"=>$resultsitem['id'],
											   "option_name"=>$ar['option_item'],
											   );
							//insert into dish_options
							$optid	=$this->menu_model->insertDishOptions($dishoption);
							//echo '<pre>';$ar['option_item'];
							if(count($ar['sides'])!=0 and count($ar['price'])!=0){
								for($k=0;$k<count($ar['sides']);$k++){
									if($ar['sides'][$k]!='' and $ar['price'][$k]!=''){
										//insert into option_sides
										
										$sidesarray=array("option_id"=>$optid,
											   "side_item"=>$ar['sides'][$k],
											   "price"=>$ar['price'][$k],
											   );
										$dishid	=$this->menu_model->insertOptionsSides($sidesarray);
										
										//echo '<pre>';echo $ar['sides'][$k];
										//echo '<pre>';echo $ar['price'][$k];
									}
								}
							}
						}	  
						  
						  
					$j++;
				}				
				//-------------for options and dishes-----close
				
				if($item_id!='')
					$this->session->set_flashdata('success_message', 'Dish item updated successfully');
				else
					$this->session->set_flashdata('success_message', 'Dish item added successfully');
				redirect($this->user->root.'/menu/dish/'.$item_id);
			}
		
		}else{
			if($item_id!=''){
				$data['itemdetails']	=$this->menu_model->getItemDetails($item_id);
				$data['options_details']	=$this->menu_model->getDishOptions($item_id);
				if(count($data['options_details']!='')){
					foreach($data['options_details'] as $var){
							$sidesdetails[$var['option_id']]	=$this->menu_model->getOptionSides($var['option_id']);
						
					}
				}
				$data['sidesdetails']=$sidesdetails;
				
			//echo '<pre>';print_r($data['itemdetails']);
			//echo '<pre>';print_r($data['sidesdetails']);
			//echo $item_id;
			//exit;
			}
			$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
			$ouput['output']			= $this->load->view('admin/menu/add-dish_1',$data,true);
			$this->_render_output($ouput);
		}
		
		
	}
	
	public function updateItem(){
		$optitle	=	$_POST['option_item'];
		$options	=	$_POST['options'];
		$prices		=	$_POST['price'];
		$option_id	=	$_POST['option_id'];
		$sidesid	=	$_POST['sidesid'];
		$mandatory	=	$_POST['mandatory'];
		$multiple	=	$_POST['multiple'];
		
		
		$data['categorylist']	=	$this->menu_model->updateDishOptions($option_id,$optitle,$mandatory,$multiple);
		
		if(count($options)!=0){
			for($i=0;$i<count($options);$i++){
				if($options[$i]!=''){
				$arr=array(
						  'side_item'=>$options[$i],
						  'price'=>$prices[$i],
						  'option_id'=>$option_id
						  );
				//echo '<pre>';print_r($arr);
				$data['categorylist']	=	$this->menu_model->UpdateOptionsSides($arr,$sidesid[$i]);
			  // echo '<pre>';print_r($option_id);exit;
				//echo $this->load->view('admin/menu/add',$option_id);
				}
			}
		}
		
		//print_r($option);exit;
		
			
	}
	public function sortorder(){
		//$sidesort	=	$_POST['sideslist'];
		$sidesort	=	$_POST['sideslist'];
		//echo '<pre>';print_r($sidesort);
		$i=1;
		foreach($sidesort as $val){
			//echo $val;
			$this->menu_model->setTable('fk_option_sides');
			$this->menu_model->update_by(array('side_id'=>$val),array('sortorder'=>$i));
			$i++;
		}
		
	}
	public function optionsortorder(){
		$optionlist	=	$_POST['optionlist'];
		//echo '<pre>';print_r($_POST['optionlist']);
		$i=1;
		foreach($optionlist as $val){
			$this->menu_model->setTable('fk_dish_options');
			$this->menu_model->update_by(array('option_id'=>$val),array('sortorder'=>$i));
			$i++;
		}
		
	}
	public function deleteSize()
	{
		$sizeid=isset($_POST['sizeid'])?$_POST['sizeid']:'';
		if($sizeid!=''){
			$res	=	$this->menu_model->delDishItemSize($sizeid);
		}else{
			$item_id	=	$_POST['item_id'];
			$size	=	$_POST['size'];
			$res	=	$this->menu_model->delDishItemSize('',$item_id,$size);
		}	
	}
	
	public function getCat($cat_id)
	{
		$cat_id	=	$_POST['cat_id'];
	    $user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;		
		//$data['category']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		$data['catid']	=	$cat_id;
		$data['category']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		$data['dishlist']	=	$this->menu_model->gelSelectedDishItems($location_id,$cat_id);
		//print_r($data['category']);exit;
		echo $this->load->view('admin/menu/dish-tab',$data);
		
	}
	public function ajaxUpdateItem(){
		$optitle	=	$_POST['option_item'];
		$options	=	$_POST['options'];
		$prices		=	$_POST['price'];
		$option_id	=	$_POST['option_id'];
		$sidesid	=	$_POST['sidesid'];
		$mandatory	=	$_POST['mandatory'];
		$multiple	=	$_POST['multiple'];
		
		
		$data['categorylist']	=	$this->menu_model->updateDishOptions($option_id,$optitle,$mandatory,$multiple);
		
		if(count($options)!=0){
			for($i=0;$i<count($options);$i++){
				if($options[$i]!=''){
				
				$number	=$this->menu_model->maxSortOrderDish($option_id);
				
				$arr=array(
						  'side_item'=>$options[$i],
						  'price'=>$prices[$i],
						  'option_id'=>$option_id
						  );
				
				$data['categorylist']	=	$this->menu_model->UpdateOptionsSides($arr,$sidesid[$i],$options[$i],$option_id,$number);
			  // echo '<pre>';print_r($option_id);exit;
				//echo $this->load->view('admin/menu/add',$option_id);
				}
			}
		}
		$data['sidesdetails']	=$this->menu_model->getOptionSides($option_id,'ASC');
		$data['option_id']	=	$option_id;
		echo $this->load->view('admin/menu/chef/ajaxSidePrice',$data);
		//print_r($option);exit;
		
			
	}
	
	public function ajaxdelShowsides(){
		$option_id	=	$_POST['option_id'];
		$data['sidesdetails']	=$this->menu_model->getOptionSides($option_id);
		$data['option_id']	=	$option_id;
		echo $this->load->view('admin/menu/chef/ajaxSidePriceDel',$data);
			
	}
	public function moveCategory(){
		$data['category_id']	=	$_POST['category_id'];
		$restaurant_id	=	$_POST['restaurant_id'];
		$location_id	=	$_POST['location_id'];
		$data['category']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		echo $this->load->view('admin/menu/movecategory',$data);	
			
	}
	public function moveupdateCategory(){
		$category_id	=	$_POST['category_id'];
		$newcategory_id	=	$_POST['newcategory_id'];
		$data['del']	=	$this->menu_model->delCategory($category_id);
		$data['category']	=	$this->menu_model->moveUpdateCategories($category_id,$newcategory_id);
		echo $this->load->view('admin/menu/movecategory',$data);	
			
	}
	public function checkCat($cat_id)
	{
		$category_id	=	$_POST['category_id'];
	    $user = $this->session->userdata('user');
		$location_id=$user->location_id;		
		$data['catid']	=	$cat_id;
		$data['dishlist']	=	$this->menu_model->gelSelectedDishItems($location_id,$category_id);
		echo count($data['dishlist']);
		
	}
	public function sortCategory(){
		$categorylist	=	$_POST['categorylist'];
		$i=1;
		
		//print_r($categorylist);
		foreach($categorylist as $val){
			$this->menu_model->setTable('fk_dish_category_master');
			$this->menu_model->update_by(array('category_id'=>$val),array('sortorder'=>$i));
			echo $this->db->last_query();
			$i++;
		}
		
	}
	public function sortDIshItem(){
		$dishlist	=	$_POST['dishlist'];
		$i=1;
		foreach($dishlist as $val){
			$this->menu_model->setTable('fk_dish_items_master');
			$this->menu_model->update_by(array('item_id'=>$val),array('sortorder'=>$i));
			$i++;
		}
		
	}
	
	public function sortDown(){
		$option_id	=	$_POST['option'];
		$item_id	=	$_POST['item_id'];
		$sortno	=	$_POST['sortno'];

		$this->load->library('user_agent');

		if ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
			$data['is_mobile']=1;
		}
		else
		{
			$agent = 'Unidentified User Agent';
			$data['is_mobile']=0;
		}
		$this->menu_model->setTable('fk_dish_options');
		$result	=	$this->menu_model->get_by(array('sortorder'=>$sortno+1,'dish_item_id'=>$item_id));
		
		$res	=	$this->menu_model->update_by(array('option_id'=>$option_id), array('sortorder'=>$sortno+1));
		$srt=$result->sortorder;
		
		$resu	=	$this->menu_model->update_by(array('option_id'=>$result->option_id), array('sortorder'=>$srt-1));

			if($item_id!=''){
				$data['itemdetails']	=$this->menu_model->getItemDetails($item_id);
				$data['options_details']	=$this->menu_model->getDishOptions($item_id);
				$data['sizes_details']	=$this->menu_model->getDishsizes($item_id);
				
				if(count($data['options_details']!='')){
					foreach($data['options_details'] as $var){
							$sidesdetails[$var['option_id']]	=$this->menu_model->getOptionSides($var['option_id']);
						
					}
				}
				$data['sidesdetails']=$sidesdetails;
			
		}
		//$data['page']="plusBtn";
		$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		echo $this->load->view('admin/menu/ajaxoptionsides',$data);
				
	}
	
	public function sortUp(){
		$option_id	=	$_POST['option'];
		$sortno	=	$_POST['sortno'];
		$item_id	=	$_POST['item_id'];
		$this->menu_model->setTable('fk_dish_options');
		
		$this->load->library('user_agent');
		if ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
			$data['is_mobile']=1;
		}
		else
		{
			$agent = 'Unidentified User Agent';
			$data['is_mobile']=0;
		}
			
		$result	=	$this->menu_model->get_by(array('sortorder'=>$sortno-1,'dish_item_id'=>$item_id));
		
		$res	=	$this->menu_model->update_by(array('option_id'=>$option_id), array('sortorder'=>$sortno-1));
		$srt=$result->sortorder;
		
		$resu	=	$this->menu_model->update_by(array('option_id'=>$result->option_id), array('sortorder'=>$srt+1));

			if($item_id!=''){
				$data['itemdetails']	=$this->menu_model->getItemDetails($item_id);
				$data['options_details']	=$this->menu_model->getDishOptions($item_id);
				$data['sizes_details']	=$this->menu_model->getDishsizes($item_id);
				
				if(count($data['options_details']!='')){
					foreach($data['options_details'] as $var){
							$sidesdetails[$var['option_id']]	=$this->menu_model->getOptionSides($var['option_id']);
						
					}
				}
				$data['sidesdetails']=$sidesdetails;
			
		}
		//$data['page']="plusBtn";
		$data['categorylist']	=	$this->menu_model->gelAllCategories($restaurant_id,$location_id);
		echo $this->load->view('admin/menu/ajaxoptionsides',$data);	
		
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */