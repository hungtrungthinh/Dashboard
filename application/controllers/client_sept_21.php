<?php 
class Client extends MY_Controller { 

	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('client_model');
	}

	public function index()
	{
		 if (isset($HTTP_RAW_POST_DATA))  
		 {
		  	$json = $HTTP_RAW_POST_DATA;
		 }
		 else 
		 {
		 	$json = implode("\r\n", file('php://input'));
		 } 
 	

		$array  = json_decode($json,TRUE);
		//echo '<pre>';print_r($array);exit;
		$token 			= $array['token'];
		$function_name 	= $array['function'];	
		$this->$function_name($array['parameters']);
	}

//-------------------------umesh---------------------------------
	//checkFbUser
	function FbLogin(){
			
		$testVar=$_GET['test'];
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
		
		
		$array 	=	 json_decode($data, true);
		
		$condition = array(
						"email"=> $array['email'],
						"restaurant_id"=> $array['restaurant_id']
					 );
		if($array['email']!='' and $array['restaurant_id']!=''){
			$response = $this->client_model->get_where('fk_member_master',$condition, 'member_id ASC');
			if(empty($response))
			{
				$result = array('status' => 'success', 'message' => $this->config->item('loginsuccess') , 'type' =>'3');
			}
			else if($response['auth_type']=='general')
			{
				$result = array('status' => 'success','member_id'=>$response['member_id'],'message' => $this->config->item('loginsuccess'), 'type' =>'2');
			}
			else
			{
				$result = array('status' => 'success','member_id'=>$response['member_id'],'message' => $this->config->item('loginsuccess'), 'type' =>'1');
			}
		}else{
			$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
		}
			
		echo json_encode($result);
		
	}
	//updateUser	
	function updateUserData(){  
		$testVar=$_GET['test'];
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
		
		$array 	=	 json_decode($data, true);
			
		if($data!=''){
			$response = $this->client_model->get_where('fk_member_master',array('member_id' => $array['member_id']), 'member_id ASC');
			if(count($response)==0){
				$result = array('status' => 'error','message' => $this->config->item('incorrectUser'));
			}else{
				$rs['result'] = $this->client_model->update('fk_member_master', $array['user_data'],array('member_id'=> $array['member_id']));
				$result = array('status' => 'success','result'=>$array['member_id'],'message' => $this->config->item('updateUser'));
			}
					
		}else{
			$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
		}
		echo json_encode($result);
	}
	//saveUserFb
	function signUpFb(){			

		$testVar=$_GET['test'];
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
			
		$array 	=	 json_decode($data, true);
		$array['user_data']['created_date'] = date('Y-m-d H:i:s');
		if($data!=''){
			$response = $this->client_model->get_where('fk_member_master',array('email' => $array['user_data']['email'],'restaurant_id'=> $array['user_data']['restaurant_id']), 'member_id ASC');
			if(count($response)){
				$result = array('status' => 'error','message' => $this->config->item('UserExist'));
			}else{		
				$insert_id = $this->client_model->insert('fk_member_master',$array['user_data']);
				$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('UserInserted'));
			}
		}else{
			$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
		}	
		echo json_encode($result);
	}
	//insertUser
	public function signUp(){

			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			
			if($data!=''){
				$array['user_data']['created_date'] = date('Y-m-d H:i:s');
				$response = $this->client_model->get_where('fk_member_master',array('email' => $array['user_data']['email'],'restaurant_id'=> $array['user_data']['restaurant_id']), 'member_id ASC');
				if(count($response)){
					$result = array('status' => 'error','message' => $this->config->item('UserExist'));
				}else{		
					$insert_id = $this->client_model->insert('fk_member_master',$array['user_data']);
					$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('UserInserted'));
				}
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
				echo json_encode($result);
				
		}	
	
	//authenticate	
	public function login(){
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			if($data!=''){
				
				$userDetails = $this->client_model->get_where('fk_member_master',array('email' => $array['email'],'restaurant_id'=> $array['restaurant_id']), 'member_id ASC');
				if(empty($userDetails)){
					$result = array('status' => 'error','message' => $this->config->item('incorrectEmail'));
				}else if($userDetails->auth_type!='facebook'){
					if($userDetails['password'] != $array['password']){
						$result = array('status' => 'error','message' => $this->config->item('incorrectPassword'));
					}
					elseif($userDetails['status'] == 'N'){
						$result = array('status' => 'error','message' => $this->config->item('userBlocked'));
					}
					else{
						$member_id = $userDetails['member_id'];
						$result = array('status' => 'success','member_id'=>$member_id,'message' => $this->config->item('loginsuccess'));
					}
				}
				else
				{
					$result = array('status' => 'error','message' => $this->config->item('incorrectUser'));
				}
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
	
		}
		
		
	public function restaurantList()
		{
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				$radius = ($this->config->item('default_radius'))?$this->config->item('default_radius'):0;
				$resp = $this->client_model->getRestaurant($array,$radius);
				$result = array('status' => 'success','result' =>$resp);

			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
		}
		
	public function getNearestRestaurant()
		{
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				$radius = ($this->config->item('default_radius'))?$this->config->item('default_radius'):0;
				$resp = $this->client_model->getRestaurant($array,$radius);
				$result = array('status' => 'success','result' =>$resp[0]);

			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
		}
		
	public function restaurantDetails(){
		
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				
				$resp = $this->client_model->getRestaurantDetails($array['location_id']);
				//echo date('y-m-d h:i:s');
				$today = new DateTime(date('Y-m-d H:i'));
				$today_end= new DateTime(date('Y-m-d H:i'));
				$today_date = date('Y-m-d');
				$today_time = date("Y-m-d H:i:s");
				$start_time = new DateTime($today_date.' '.$resp['start_at']);
				$end_time = new DateTime($today_date.' '.$resp['end_at']);
				
				
				$tomorrow = date("Y-m-d", time()+86400); 
				//date('y-m-d h:i:s');
				
				
				$minutes_to_add  =($this->config->item('delivery_in'))?$this->config->item('delivery_in'):45;
				$max_later_days  =($this->config->item('max_later_days'))?$this->config->item('max_later_days'):10;
				$min_later_days  =($this->config->item('min_later_days'))?$this->config->item('min_later_days'):4;
				//$min_interval  =($this->config->item('min_interval'))?$this->config->item('min_interval'):15;
				if(getLocationConfigValue('later_order_count',$array['location_id'])!='')
					$max_later_days  =getLocationConfigValue('later_order_count',$array['location_id']);
				else
					$max_later_days  =getConfigValue('later_order_count');
				if(getLocationConfigValue('max_delivery_time',$array['location_id'])!='')
					$minutes_to_add  =getLocationConfigValue('max_delivery_time',$array['location_id']);
				else
					$minutes_to_add  =getConfigValue('max_delivery_time');
					
				$min_interval  =getConfigValue('minute_interval');
				
				
				$today_end->modify('+'.$minutes_to_add.' minutes');
				
				if($today < $start_time)
				{
					$closed = 1;
					$status = 'before_start_time';
					$resp['start_at'] = $today_date.' '.$resp['start_at'];
					$resp['end_at'] = $today_date.' '.$resp['end_at'];
				}
				else if($end_time < $today_end)
				{
					$closed = 1;
					$status = 'after_end_time';
					$resp['start_at'] = $tomorrow.' '.$resp['start_at'];
					$resp['end_at'] = $tomorrow.' '.$resp['end_at'];
				}
				else
				{
					$closed = 0;
					$resp['start_at'] = $today_date.' '.$resp['start_at'];
					$resp['end_at'] = $today_date.' '.$resp['end_at'];
					$status = '';
				}
				
				if(empty($resp)){
					$result = array('status' => 'error','message' => $this->config->item('invalidLocation'));
				}else{
					$result = array('status' => 'success','result' =>$resp,
									'current_time'=>$today_time,
									'is_closed'=>$closed,
									'delivery_in'=>$minutes_to_add,
									'max_later_days'=>$max_later_days,
									'min_later_days'=>$min_later_days,
									'min_interval'=>$min_interval,
									'time_status'=>$status);
				}
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
	}
	public function deliveryAddress(){

			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			
			if($data!=''){
				$array['user_data']['created_date'] = date('Y-m-d H:i:s');
				//$response = $this->client_model->get_where('fk_delivery_address',array('member_id' => $array['user_data']['member_id']), 'member_id ASC');
				
				$insert_id = $this->client_model->insert('fk_delivery_address',$array['user_data']);
				$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('deliveryAddress'));
				
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
				echo json_encode($result);
				
		}	
	
	
		public function getRestaurantMenu()
		{
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				$result = $this->client_model->getRestaurantMenu($array);
				//echo '<pre>';print_r($result);
				$category = array();
				
				if(!empty($result)){
					foreach ($result as $r)
					{
						$category[$r['category_id']]['category_id'] = $r['category_id'];
						$category[$r['category_id']]['category_name'] = $r['category_name'];
						$category[$r['category_id']]['restaurant_id'] = $r['restaurant_id'];
						$category[$r['category_id']]['location_id'] = $r['location_id'];
						
						
						$item_array = array('item_id'=>$r['item_id'],
											'item_description'=>$r['item_description'],
											'item_name'=>$r['item_name'],
											'price'=>$r['price']);
						$category[$r['category_id']]['items'][] = $item_array;			
						$result = array('status' => 'success','result' => $category);
					}
				}else{
					$result = array('status' => 'error','message' => $this->config->item('invalidLocation'));
				}
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
		}
				
		public function getRestaurantMenuDetail()
		{
			
			//echo 'here';exit;
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				//$data['id'] = 12;
				$result_array = $this->client_model->getRestaurantMenuDetail($array['item_id']);
				//$check_fav  = $this->client_model->isFavItem($array['member_id'],$array['item_id']);
				
				$category = array();
				
				if(!empty($result_array)){
					
						
						foreach($result_array as $val)
						{
							$menu['category_id'] = $val['category_id'];
							$menu['item_name'] = $val['item_name'];
							$menu['item_id'] = $val['item_id'];
							$menu['item_description'] = $val['item_description'];
							$menu['location_id'] = $val['location_id'];
							$menu['price'] = $val['price'];
							$menu['is_fav'] = $check_fav;
							if($val['option_id']!=''){
								$menu['option_id'][$val['option_id']] = $val['option_id'];
								$menu['option_name'][$val['option_id']] = $val['option_name'];
								$menu['is_mandatory'][$val['option_id']] = $val['mandatory'];
								$menu['is_multiple'][$val['option_id']] = $val['multiple'];
								if($val['side_id']!=''){
								
										$menu['side_id'][$val['option_id']][$val['side_id']] = $val['side_id'];
										$menu['side_item'][$val['option_id']][$val['side_id']] = $val['side_item'];
										$menu['side_price'][$val['option_id']][$val['side_id']] = $val['side_price'];
									
									}
									else
									{
										$menu['side_id'][$val['option_id']] = array();
										$menu['side_item'][$val['option_id']] = array();
										$menu['side_price'][$val['option_id']] = array();
									}
								
							}
							else
							{
								$menu['option_id'] = array();
								$menu['option_name'] = array();
								$menu['is_mandatory'] = array();
								$menu['side_id'] = array();
								$menu['side_item'] = array();
								$menu['side_price'] = array();
							}
						}
					$result = array('status' => 'success','result' => $menu);		
				}else{
					$result = array('status' => 'error','message' => $this->config->item('invalidLocation'));
				}
				
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
		}	
		
			
		public function cancelOrder(){
						
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				$resp = $this->client_model->cancelOrder($array['order_id']);
				$result = array('status' => 'success','message' => $this->config->item('cancelOrder'));
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
		}

		public function checkout(){
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data,true);
			$array	=	$data['order_data'];
//{"order_data":{"user_id":"9","restaurant_id":1,"location_id":"5","category_id":"11","item_id":"12","item_price":"120","option_name":{"0":"Garlic paste"},"side_name":{"0":{"0":"Tomato sauce","1":"test"},"1":{"0":"test"}},"side_price":{"0":{"0":"30","1":"23"},"1":{"0":"50"}},"quantity":2,"total":300,"order_type":"Pickup","delivery_time":"2015-09-02T08:10:20.099Z","is_later":"N"}};
			
//echo date("Y-m-d H:i:s");

			echo '<pre>';print_r($array);exit;
			if($data!=''){
				$no=rand(000001,999999);
				$ordermaster=array("member_id"=>$array['user_id'],
					   "order_ref_id"=>"#FR".$array['user_id'].$no,
					   "restaurant_id"=>$array['restaurant_id'],
					   "location_id"=>$array['location_id'],
					   "created_time"=>date("Y-m-d H:i:s"),
					   "order_status"=>"New",
					   "total_amount"=>$array['total'],
					   "payment_status"=>'Y',
					   "order_type"=>$array['order_type'],
					   "is_later"=>$array['is_later'],
					   "delivery_time"=>date('Y-m-d H:i:s',strtotime($array['delivery_time']))
					  );
					  
				$order_id = $this->client_model->insert('fk_order_master',$ordermaster);
				$orderitems=array("order_id"=>$order_id,
						"item_id"=>$array['item_id'],
						"unit_price"=>$array['item_price'],
						"quantity"=>$array['quantity'],
						"price"=>$array['item_price']*2
						);	
				
				$ord_item_id = $this->client_model->insert('fk_order_items',$orderitems);
				
									
				if(count($array['option_name'])!=0){
					for($i=0;$i<count($array['option_name']);$i++){
						$sides='';
						$sides=array("sides"=>$array['side_name'][$i],"price"=>$array['side_price'][$i]);
						$sides= serialize($sides);
						$orderoptionmap = array("order_id"=>$order_id,
												"ord_item_id"=>$ord_item_id,
												"options"=>$array['option_name'][$i],
												"sides"=>$sides
											);	
						$mapid = $this->client_model->insert('fk_order_option_map',$orderoptionmap);
	
						
					}
				}
				//echo '<pre>';print_r($orderoptionmap);echo'<pre>';exit;	
				if($array['order_type'] == 'Delivery'){
					$array['delivery_address']['order_id'] = $order_id;
					$array['delivery_address']['created_date'] = date('Y-m-d H:i:s');
					$address_id = $this->client_model->insert('fk_delivery_address',$array['delivery_address']);
				}
				
				$result = array('status' => 'success','order_id'=>$order_id,'message' => $this->config->item('saveOrder'));
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result );
			//echo '<pre>';print_r($sides);echo'<pre>';exit;		 

		}
		
	public function favouriteCategory(){
		
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			//echo '<pre>';print_r($array);echo'<pre>';exit;
			if($data!=''){
				$array['favourite_date'] = date('Y-m-d H:i:s');
				//$response = $this->client_model->get_where('fk_delivery_address',array('member_id' => $array['user_data']['member_id']), 'member_id ASC');
				
				$insert_id = $this->client_model->insert('fk_favourite_category',$array);
				$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('addFavourite'));
				
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
		echo json_encode($result);
				
	}
	public function getFavouriteList()
	{
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				$result = $this->client_model->favouriteLists($array['member_id']);
				//echo '<pre>';print_r($result);
				$category = array();
				
				if(!empty($result)){
					foreach ($result as $r)
					{
						$category[$r['category_id']]['category_id'] = $r['category_id'];
						$category[$r['category_id']]['category_name'] = $r['category_name'];
						$category[$r['category_id']]['restaurant_id'] = $r['restaurant_id'];
						$category[$r['category_id']]['location_id'] = $r['location_id'];
						
						
						$item_array = array('item_id'=>$r['item_id'],
											'item_description'=>$r['item_description'],
											'item_name'=>$r['item_name'],
											'price'=>$r['price']);
						$category[$r['category_id']]['items'][] = $item_array;			
						$result = array('status' => 'success','result' => $category);
					}
				}else{
					$result = array('status' => 'success');
				}
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
	}
	public function addFavourite(){
		
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			//echo '<pre>';print_r($array);echo'<pre>';exit;
			if($data!=''){
				$array['created_time'] = date('Y-m-d H:i:s');
				$insert_id = $this->client_model->insert('fk_member_fav_items',$array);
				$result = array('status' => 'success','message' => $this->config->item('addFavourite'));
				//echo '<pre>';print_r($result);echo'<pre>';exit;
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
		echo json_encode($result);
				
	}
	public function removeFavourite(){
		
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			//echo '<pre>';print_r($array);echo'<pre>';exit;
			if($data!=''){
			
				$this->client_model->removeFavourite($array['member_id'],$array['item_id']);
				$result = array('status' => 'success','message' => $this->config->item('removeFavourite'));
				//echo '<pre>';print_r($result);echo'<pre>';exit;
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
		echo json_encode($result);
				
	}
	public function getAllOderDetails(){
	
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			//echo '<pre>';print_r($array);echo'<pre>';exit;
			if($data!=''){
				
				$orderList = $this->client_model->getAllOders($array['member_id']);
				if(count($orderList)!=0){
					for($i=0;$i<count($orderList);$i++){
						$orderList[$i]['items'] = $this->client_model->getAllOderItemDetails($orderList[$i]['order_id']);
					}
				}
				$result = array('status' => 'success','orderList'=>$orderList);
				//echo '<pre>';print_r($orderList);echo'<pre>';exit;
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
		echo json_encode($result);
	}
	
	public function getOderDetails(){
	
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			if($data!=''){
				
				$orderList = $this->client_model->get_where('fk_order_master',array('order_id' => $array['order_id']), 'order_id ASC');
				$orderList['items'] = $this->client_model->get_where('fk_order_items',array('order_id' => $array['order_id']), 'order_id ASC',$tpe="result");
				if(count($orderList['items'])!=0){
					for($i=0;$i<count($orderList['items']);$i++){
						//echo $orderList['items'][$i]['ord_item_id'];exit;
						$orderList['items'][$i]['details'] = $this->client_model->getOderItemDetails($orderList['items'][$i]['ord_item_id']);
						$sides = $this->client_model->getAllOderSidesDetails($orderList['items'][$i]['ord_item_id']);
						for($j=0;$j<count($sides);$j++){
							$sides[$j]['sides']=unserialize($sides[$j]['sides']);
						}
						$orderList['items'][$i]['option_array'] = $sides;
					}
				}
				$result = array('status' => 'success','orderDetail'=>$orderList);
				//echo '<pre>';print_r($orderList);echo'<pre>';exit;
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
		echo json_encode($result);
	}	
	
	public function getProfileDetails()
	{
				$testVar=$_GET['test'];
				if($testVar==1)
					$data=$_GET['data'];
				else
				$data 	= 	 file_get_contents("php://input");
				
				$data 	=	 json_decode($data, true);
				if($data)
				{
				$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $data['id']),'member_id');
				
				$result = array('status' => 'success','profile_details' => $profile_details);
				
				}
				else
				{
					$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
				}
				echo json_encode($result);
	
	}
	
	 public function insertImage() {


        $postDataJSON = file_get_contents("php://input");
        $postData = json_decode($postDataJSON, true);


        if ($_FILES['file']['name'] <> "") {

            $upload_dir = FCPATH . "uploads/";
//            $upload_dir = FCPATH . "uploads/temp/";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777);
            }
            //$extension = end(explode(".", $_FILES['file']['name']));
            $name = explode(".", $_FILES['file']['name']);
            //$image_name = strtotime(date("Y-m-d H:i:s")) ;
            $image = $name[0] . '_tmp.' . $name[1];
            move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $image);

          
            $array['user_data']['profile_image'] = $image;
        	$arr['member_id'] =  $user[1];
        	$this->client_model->update('fk_member_master', $array['user_data'],array('member_id'=> $arr['member_id']));

//            echo $image;
            exit();
        }
    }

    public function saveProfileImage() {

        $arr = json_decode(file_get_contents('php://input'), true);

        $img = str_replace('data:image/png;base64,', '', $arr['imageURI']);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file_name = $arr['file_name'];
        $file_name = FCPATH . 'uploads/' . $arr['file_name'];
        file_put_contents($file_name, $data);
        chmod($filename, 0777);

        $array['user_data']['profile_image'] = $arr['file_name'];
        $this->client_model->update('fk_member_master', $array['user_data'],array('member_id'=> $arr['member_id']));
        exit();
    }
	
//-------------------------umesh---------------------------------
		
		public function getUser(){
				
				$testVar=$_GET['test'];
				if($testVar==1)
					$data=$_GET['data'];
				else
				$data 	= 	 file_get_contents("php://input");
				
				$data 	=	 json_decode($data, true);
				
				$result = $this->client_model->get_where('fk_member_master',array('member_id' => $data['id']),'member_id');
				$address = $this->client_model->getDeliveryAddress($data['id']);
				$rs['name'] = $result['first_name'].' '.$result['last_name'];
				$rs['profile_image'] = $result['profile_image'];
				$rs['auth_type'] = $result['auth_type'];
				$rs['address'] = $address;
				echo json_encode($rs);
				
		}
		
		public function getDeliveryAddress(){
				
				
				$data 	= 	 file_get_contents("php://input");
				$data 	=	 json_decode($data, true);
				$address = $this->client_model->getDeliveryAddress($data['id']);
				$rs['address'] = $address;
				echo json_encode($rs);
				
		}
		
		function checkFbLogin(){
		
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);
			
			$data["auth_id !="] = '';
			
			$response = $this->client_model->get_where('fk_member_master', $data, 'member_id ASC');
			
			echo json_encode($response);
		
		}
		function checkFbUser(){
		
			
			
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);
			
			$response = $this->client_model->get_where('fk_member_master', $data, 'member_id ASC');
			
			if(empty($response))
			{
				$result['type'] = 3;
			}
			else if($response['auth_type']=='general')
			{
				$result['type'] = 2;
				$result['result'] = $response['member_id'];
			}
			else
			{
				$result['type'] = 1;
				$result['result'] = $response['member_id'];
			}
			
			echo json_encode($result);
		
		}
		function forgotPassword(){
		
			$this->load->model('client_model');
		
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			
		
			
			$userDetails = $this->client_model->get_where('fk_member_master', array('email' => $data['email']),'member_id ASC');
			
			if(empty($userDetails)){
				$rs['status'] ="error";
				$rs['message'] = "Incorrect Email";
			}else if($userDetails->auth_type!='facebook'){
		
				$this->load->model('email_model');
				
				$new_password 	= 	$this->client_model->randomPassword(); # generate random password
				$update_array['password'] = $new_password;
				$update_array['member_id'] = $userDetails['member_id'];
				$userDetails = $this->client_model->updateUser($update_array);
				
				$email = $this->email_model->get_email_template('forgot_password');
				
                $this->load->library('encrypt');
                $useremail 	 = $userDetails->email;
                $fstname = $userDetails->first_name;
                $lstname = $userDetails->last_name;
				$passwd = $userDetails->password;
                $target_name = $this->config->item('site_name');
               
                 
                $subject = $email['email_subject'];
               	$message  = $email['email_template'];        
                $headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html; charset=utf-8" . "\r\n";			
				$headers .= 'From: '.$this->config->item('email_from'). "\r\n";
						
				$message  = $email['email_template'];                          
				$message  = str_replace('%FULL_NAME%',$fstname.' '.$lstname,$message);	
				$message  = str_replace('%PASSWORD%',$passwd,$message);
				$message  = str_replace('%SITE_NAME%',$target_name,$message);
						
				@mail($useremail, $subject, $message, $headers);
				$rs['status'] ="success";			
				$rs['message'] = 'Check your registered email';
				
			}
			else
			{
				$rs['status'] ="error";
				$rs['message'] = "Incorrect User";
			}
			
			echo json_encode($rs);
		
		}
		public function getDefaultLocation(){
		
			$map_data = array('lat'=>$this->config->item('default_lat'),'long'=>$this->config->item('default_long'));
			echo json_encode($map_data);
		}
		public function addCartDetail()	{
			
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			$check_res = array();
			$check = 0;
			if($data['user_id']){
			
			if($data['clear']){
			
				$this->client_model->removeCartDetail(array('member_id'=>$data['user_id']));
				
			}else
			{
			 $check_res = $this->client_model->checkCartResId($data['user_id']);
			}
			
			if(empty($check_res) || $check_res['restaurant_id'] == $data['res_id']){
			
			$check_array = array('item_size'=>$data['map_id'],'item_id'=>$data['id'],'member_id'=>$data['user_id']);
			
			if(!$data['clear']){
			
				$check = $this->client_model->checkCartDetail($check_array);
			}
			if($check!=0)
			{
				$qty = $data['qty']+$check['quantity'];
				$update_array=array('quantity'=>$qty);
				$check_array = array('cart_id'=>$check['cart_id']);
				
				$result = $this->client_model->updateCartDetail($update_array,$check_array);
			}else{
				
				$insert_array = array('member_id'=>$data['user_id'],'item_id'=>$data['id'],'item_size'=>$data['map_id'],'quantity'=>$data['qty'],'restaurant_id'=>$data['res_id']);
				$result = $this->client_model->addCartDetail($insert_array);
			}
				
			}
			else
			{
				echo json_encode(array('error'=>'Items in cart are from another resturants.Do you need to clear your cart ?'));
			}
			}
		}
		public function getCartQuantity(){
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['user_id']){
			
				$check_array = array('member_id'=>$data['user_id']);
			    $cart_qty= $this->client_model->getCartQty($check_array);
				echo json_encode($cart_qty);
			}
		}
		public function getCartDetails(){
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['user_id']){
			
				$check_array = array('member_id'=>$data['user_id']);
				
				$this->client_model->deleteInactiveItems($check_array);//remove inactive products
				
			    $cart_details= $this->client_model->getCartDetails($check_array);
				$cart_total = $this->client_model->getCartTotal($check_array);
				echo json_encode(array('details'=>$cart_details,'total'=>$cart_total));
			}
		}
		public function removeCartItem(){
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['user_id']){
			
				$this->client_model->removeCartDetail(array('member_id'=>$data['user_id'],'cart_id'=>$data['cart_id']));
			}
		}
		public function insertOrderDetails(){
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['user_id']){
			
				$check_array = array('member_id'=>$data['user_id']);
				
				$this->client_model->deleteInactiveItems($check_array);//remove inactive products
				
				$cart_details= $this->client_model->getCartDetails($check_array);
				
				if(empty($cart_details))
				{
					$error = "You have no items in your cart";
					echo json_encode(array('error'=>$error));
					exit;
				}
				
				$order_ref_id = $this->client_model->getOrderRefId();
				$date_time  = date('Y-m-d H:i:s');
				$cart_total = $this->client_model->getCartTotal($check_array);
				$total_amount = $cart_total['total'];
				
				$insert_array = array('order_ref_id'=>$order_ref_id,
									  'member_id'=>$data['user_id'],
									   'created_time'=>$date_time,
									   'total_amount'=>$total_amount,
									   'restaurant_id'=>$cart_details[0]['restaurant_id']);
									   
				$delete_order_id = $this->client_model->getPendingOrder($data['user_id']);
				
				if($delete_order_id!=0)
				{
					$this->client_model->deletePendingOrder($delete_order_id);
				}
				
				$order_id  = $this->client_model->insertOrder($insert_array);		
				
				if($order_id){			   
			   
				foreach($cart_details as $items)
				{
					$insert_array = array('order_id'=>$order_id,
											'item_id'=>$items['item_id'],
											'item_size'=>$items['item_size'],
											'unit_price'=>$items['price'],
											'quantity'=>$items['quantity'],
											'price' =>$items['item_total'] );
											
					$this->client_model->insertOrderItem($insert_array);
					
				}
					
					$this->client_model->updateCartDetail(array('order_id'=>$order_id),array('member_id'=>$data['user_id']));
					
					$order_items = $this->client_model->getOrderItems($order_id);
					$order_details = array('date_time'=>date('d/m/Y h.i a',strtotime($date_time)),'order_ref_id'=>$order_ref_id);
					echo json_encode(array('details'=>$order_details,'items'=>$order_items,'total'=>$total_amount));
				}
				else
				{
					$error = "Unknown error occur.Try again";
					echo json_encode(array('error'=>$error));
				}
			}
		}
		public function completeOrder()	{
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['user_id']){
				
			  $pending_order_id = $this->client_model->getFinalOrder($data['user_id'],$data['order_ref_id']);
			  if($pending_order_id!=0)
			  {
			  	 $this->client_model->setOrderSucess($pending_order_id);
			  }
			  else
			  {
			  	$error = " Duplicated Order ! ";
			    echo json_encode(array('error'=>$error));
			  }
			
			}
		}
		public function getOrder(){

			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);	
			if($data['order_id']){
				$order_id = $data['order_id'];
				$data['orderdetails']=$this->client_model->getDetailOrder($order_id);
				$data['itemdetails']=$this->client_model->getDetailItem($order_id);
				//$data['optiondetails']=$this->order_model->getDetailOption($order_id);
				if(count($data['itemdetails']!='')){
					foreach($data['itemdetails'] as $var){
							$sidesdetails[$var['ord_item_id']]   =$this->client_model->getDetailOption($var['ord_item_id']);
						
					}
				}
				
				$data['sidesdetails']=$sidesdetails;
				
				$result = array('status' => 'success','result'=>$data,'message' => '');
				
				 
			}
			else
			{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			
			echo json_encode($result);
		}
		public function getResturantTime()
		{
			$today_time = date("Y-m-d H:i:s");
			$result = array('time'=>$today_time);
			echo json_encode($result);
		}
		
}