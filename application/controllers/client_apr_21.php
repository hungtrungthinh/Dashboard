<?php 

class Client extends MY_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('client_model');
		
		date_default_timezone_set('GMT');
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
						"email"=> $array['email']
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
				$this->updateDeviceToken($array,$response['member_id']);
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
					//try this code
					$details = $this->client_model->get_where('fk_restaurant_members',array('membar_id' => $insert_id,'restaurant_id'=>  $array['user_data']['restaurant_id']), 'id ASC');
					if(count($details)==0){
						$insert_id = $this->client_model->insert('fk_restaurant_members',array('membar_id' => $insert_id,'restaurant_id'=> $array['user_data']['restaurant_id'],'device_platform'=>$array['user_data']['device_platform'],'device_token'=>$array['user_data']['device_token'],'device_id'=>$array['user_data']['device_id']));
					}
						
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
				
				//$userDetails = $this->client_model->get_where('fk_member_master',array('email' => $array['email'],'restaurant_id'=> $array['restaurant_id']), 'member_id ASC');  //old code 
				$userDetails = $this->client_model->get_where('fk_member_master',array('email' => $array['email']), 'member_id ASC');
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
						
						$this->updateDeviceToken($array,$member_id);
						
						//echo '<pre>';print_r($userDetails);exit;
						$details = $this->client_model->get_where('fk_restaurant_members',array('membar_id' => $member_id,'restaurant_id'=> $array['restaurant_id']), 'id ASC');
						//echo '<pre>';print_r($details);exit;
						if(count($details)==0){
							$insert_id = $this->client_model->insert('fk_restaurant_members',array('membar_id' => $member_id,'restaurant_id'=> $array['restaurant_id']));
						}
						
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
		
	public function updateDeviceToken($array,$member_id)
	{
		if($array['device_token'])
						{
							$query   = $this->db->get_where('fk_restaurant_members',array('membar_id'=>$member_id,'restaurant_id'=>$array['restaurant_id']));
							$result = $query->row_array();
							
							if(!$result[restaurant_id])
							{
								
								$this->db->insert('fk_restaurant_members',
								array('device_id'=>$array['device_id'],
									  'device_platform'=>$array['device_platform'],
									  'device_token'=>$array['device_token'],
									  'membar_id'=>$member_id,
									  'restaurant_id'=>$array['restaurant_id']
									  
									  ));
							}
							else
							{
								$this->db->where(array('membar_id'=>$member_id,'restaurant_id'=>$array['restaurant_id']));
							$this->db->update('fk_restaurant_members',array('device_id'=>$array['device_id'],'device_platform'=>$array['device_platform'],'device_token'=>$array['device_token']));
							}
		
							
						}
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
				
				//get resturant timing 
				foreach($resp as $location)
				{
					if(!$location['timezone'])
						$location['timezone'] = 'GMT';
					
					$rest_offset = $this->getOffsetTimezone($location['timezone']);
					
					if(!$rest_offset)
						$rest_offset = '+00:00';
					
					$timing[$location['location_id']] = $this->client_model->getRestaurantTimeDetails($location['location_id']);
					
				}
				
				$result = array('status' => 'success','result' =>$resp,'timing'=>$timing);

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
				if($resp[0])
					$result = array('status' => 'success','result' =>$resp[0]);
				else
					$result = array('status' => 'error','message' => $this->config->item('noOpenRest'));
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
		}
		
	public function restaurantDetails($check_array=''){
		
			
			if($check_array)
			{ // call on change delivery type from app
				$data = $check_array;
			}
			else
			{
				$testVar=$_GET['test'];
				if($testVar==1)
					$data=$_GET['data'];
				else
					$data 	= 	 file_get_contents("php://input");
				
				
			}
			
			$array 	=	 json_decode($data, true);
			
			if($data!=''){
				
				$server_timezone = date_default_timezone_get();
				$resp = $this->client_model->getRestaurantDetails($array['location_id']);
			
			if($resp['location_id'] && $resp['restaurant_id'] == $array['restaurant_id'])
			{
				if(!$resp['timezone'])
					$resp['timezone'] = $server_timezone;
					
				
				$rest_offset = $this->getOffsetTimezone($resp['timezone']);
				
				if(!$rest_offset)
					$rest_offset = '+00:00';
					
				if(!$array['offset'])
					$array['offset'] = '+00:00';
					
				$resp['timings'] = $this->client_model->getRestaurantTimeDetails($array['location_id']);
				$resp['start_at']='';
				$resp['end_at']='';
				
				$current_day = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'),'w');
				$today = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s')); //date with resturant time zone
				
				$day_array = array ('sunday'=>0,'monday'=>1,'tuesday'=>2,'wednesday'=>3,'thursday'=>4,'friday'=>5,'saturday'=>6);
				 
				if(count($resp['timings'])!=0){
				
					for($i=0;$i<7;$i++){
						foreach($resp['timings'] as $timing){
						
						if($timing['start_at']!='' &&  $timing['end_at']!='')
						{
							
							$timing_arrray[$day_array[$timing['day']]]['start_at'] = $timing['start_at'];
							$timing_arrray[$day_array[$timing['day']]]['end_at'] = $timing['end_at'];
						}
				
						}
					}
				
				$resp['timings'] = $timing_arrray;//$timing_arrray;
				
				//echo '<pre>';print_r($resp['timings']);	exit;	
				/*echo $resp['start_at'];	
				echo $resp['end_at'];	
				exit;	*/
					
				
				
				$today_end=$this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s')); ///new DateTime(date('Y-m-d H:i'));//for checking by adding delivery time 	
				
				$today_date = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'),'Y-m-d');//date('Y-m-d');
				
				$today_time = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'),'Y-m-d H:i:s');//date("Y-m-d H:i:s");
				
				$tomorrow = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'));
				
				$tomorrow->modify('+1 day');
				$tomorrow->format('Y-m-d');
				
				//$date_array =$this->client_model->getConvertedCurrentDateTime($array['offset']);
				//$today_convert_date = $date_array['date'];
				//$today_convert_time = $date_array['date_time'];
				
				//$tomorrow = date("Y-m-d", time()+86400); 
				//date('y-m-d h:i:s');
			
				if(getLocationConfigValue('11',$array['location_id'],$array['restaurant_id'])!='')
					$max_later_days  =getLocationConfigValue('11',$array['location_id'],$array['restaurant_id']);
				else
					$max_later_days  =getConfigValue('later_order_count');
				
				$minimum_pick_up_time =
						(getLocationConfigValue('16',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('16',$array['location_id'],$array['restaurant_id']) :getConfigValue('minimum_pick_up_time');
				
				$minimum_delivery_time =
						(getLocationConfigValue('15',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('15',$array['location_id'],$array['restaurant_id']) :getConfigValue('minimum_delivery_time');
				
				if($check_array)
					$type = $array['type']; // call on delivery option change from app
				else
					$type = $resp['type'];
				
				if($type =='Delivery - Pickup' || $type =='Pickup'){
				
					$minutes_to_add = $minimum_pick_up_time;
				}
				else if($type =='Delivery'){
				
					$minutes_to_add =$minimum_delivery_time;
				}
			
				if(getLocationConfigValue('17',$array['location_id'],$array['restaurant_id'])!='')
					$sales_tax_percentage  =getLocationConfigValue('17',$array['location_id'],$array['restaurant_id']);
				else
					$sales_tax_percentage  =getConfigValue('sales_tax_percentage');
				
				if(getLocationConfigValue('22',$array['location_id'],$array['restaurant_id'])!='')
					$min_delivery_amount  =getLocationConfigValue('22',$array['location_id'],$array['restaurant_id']);
				else
					$min_delivery_amount  =getConfigValue('min_delivery_amount');
				
				if(getLocationConfigValue('23',$array['location_id'],$array['restaurant_id'])!='')
					$delivery_charge  =getLocationConfigValue('23',$array['location_id'],$array['restaurant_id']);
				else
					$delivery_charge  =getConfigValue('delivery_charge');
				
				if(getLocationConfigValue('24',$array['location_id'],$array['restaurant_id'])!='')
					$is_delivery_taxable  =getLocationConfigValue('24',$array['location_id'],$array['restaurant_id']);
				else
					$is_delivery_taxable  =getConfigValue('is_delivery_taxable');
						
					
				$min_interval  =getConfigValue('minute_interval');
				$min_later_days  =($this->config->item('min_later_days'))?$this->config->item('min_later_days'):4;
				
				$condition =  array("restaurant_id"=>$array['restaurant_id'],"status"=>'Y');
				$details = $this->client_model->get_where('fk_restaurant_messages',$condition,"id ASC","row");
				$custom_message =$details['message'];
				
				
				if($timing_arrray[$current_day])
				{
				
					$start_time = new DateTime($today_date.' '.$timing_arrray[$current_day]['start_at'],new DateTimeZone($resp['timezone']));
					$today_start= new DateTime($today_date.' '.$timing_arrray[$current_day]['start_at'],new DateTimeZone($resp['timezone']));//for checking by subtracting delivery time 
					$end_time = new DateTime($today_date.' '.$timing_arrray[$current_day]['end_at'],new DateTimeZone($resp['timezone']));
					
					
					$today_end->modify('+'.$minutes_to_add.' minutes');
					$today_start->modify('-'.$minutes_to_add.' minutes');
					
					if($end_time < $start_time)
						$end_time = new DateTime($tomorrow.' '.$timing_arrray[$current_day]['end_at'],new DateTimeZone($resp['timezone'])); // if time on ni8 to day
				
					
					if($today < $today_start)
					{	
						$closed = 1;
						$status = 'before_start_time';
						$resp['start_at'] = $today_date.' '.$timing_arrray[$current_day]['start_at'];
						$resp['end_at'] = $today_date.' '.$timing_arrray[$current_day]['end_at'];
						
						if($resp['end_at'] < $resp['start_at'])
						$end_time = new DateTime($tomorrow.' '.$timing_arrray[$current_day]['end_at'],new DateTimeZone($resp['timezone'])); // if time on ni8 to day
						
					}
					else if($end_time < $today_end)
					{
						$closed = 1;
						
						$date_array = $this->getNextOpenDate($timing_arrray,$current_day,$today);
						$next_date = $date_array['date'];
						$next_day_no = $date_array['day_no'];
						$next_day = $date_array['day'];
						$status = $next_day;
						$resp['start_at'] = $next_date.' '.$timing_arrray[$next_day_no]['start_at'];
						$resp['end_at'] = $next_date.' '.$timing_arrray[$next_day_no]['end_at'];
						
					}
					else
					{
						$closed = 0;
						$resp['start_at'] = $today_date.' '.$timing_arrray[$current_day]['start_at'];
						$resp['end_at'] = $today_date.' '.$timing_arrray[$current_day]['end_at'];
						$status = '';
						
						if($resp['end_at'] < $resp['start_at'])
						$end_time = new DateTime($tomorrow.' '.$timing_arrray[$current_day]['end_at'],new DateTimeZone($resp['timezone'])); // if time on ni8 to day
					}
				
				}
				else
				{	
					$closed = 1;
					$date_array = $this->getNextOpenDate($timing_arrray,$current_day,$today);
					$next_date = $date_array['date'];
					$next_day_no = $date_array['day_no'];
					$next_day = $date_array['day'];
					$status = $next_day;
					$resp['start_at'] = $next_date.' '.$timing_arrray[$next_day_no]['start_at'];
					$resp['end_at'] = $next_date.' '.$timing_arrray[$next_day_no]['end_at'];
					
				}
			
				}
			
				
				if(empty($resp) || empty($resp['timings']) ){
					$result = array('status' => 'error','message' => $this->config->item('invalidLocation'));
				}else{
					$result = array('status' => 'success','result' =>$resp,
									'custom_message'=>$custom_message,
									'current_time'=>$today_time,
									'is_closed'=>$closed,
									'minimum_delivery_time'=>$minimum_delivery_time,
									'minimum_pick_up_time'=>$minimum_pick_up_time,
									'max_later_days'=>$max_later_days,
									'min_later_days'=>$min_later_days,
									'min_interval'=>$min_interval,
									'min_delivery_amount'=>$min_delivery_amount,
									'delivery_charge'=>$delivery_charge,
									'is_delivery_taxable'=>$is_delivery_taxable,
									'time_status'=>$status,
									'sales_tax_percentage'=>$sales_tax_percentage);
				}
			}
			else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			//echo'<pre>';print_r($result);
			if($check_array)
				return $result;
			else
				echo json_encode($result);
	}
	
	public function ChangeDeliveryType()
	{
	
		$testVar=$_GET['test'];
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
		
		$array 	=	 json_decode($data, true);
		
		$resturant_details = $this->restaurantDetails($data);
		
		if($resturant_details['status']=='success')
		{
			$result = array('status' => 'success',
							'current_time'=>$resturant_details['current_time'],
							'start_at'=>$resturant_details['result']['start_at'],
							'end_at'=>$resturant_details['result']['end_at'],
							'is_closed'=>$resturant_details['is_closed'],
							'time_status'=>$resturant_details['time_status']);
		}
		else
		{
			$result = $resturant_details;
		}
		echo json_encode($result);
			
	}
	
	public function getOffsetTimezone($time_zone)
	{
		$dateTimeZone= new DateTimeZone($time_zone);
		$date = new DateTime("now", $dateTimeZone);
		$timeOffset = $dateTimeZone->getOffset($date);
		
		$time_zone  = '+';
		if($timeOffset <0)
		{
		$time_zone  = '-';
		}
		$time_zone .=gmdate('H:i',abs($timeOffset));
		
		return $time_zone;
		
	}
	
	public function timeConvert($from='',$to='',$time='',$format='')
	{
		if($from=='')
			date_default_timezone_get();
		
		if($to=='')
			date_default_timezone_get();
		if($time=='')
			date('Y-m-d H:i:s');
		
			
				
		$date = new DateTime($time, new DateTimeZone($from));
		$date->setTimezone(new DateTimeZone($to));
		if($format=='')
		return $date;
		else
		return $date->format($format);
	}
	
	public function getNextOpenDate($timing_arrray,$current_day,$date)
	{
		
		$day_array = array(0=>'sunday',1=>'monday',2=>'tuesday',3=>'wednesday',4=>'thursday',5=>'friday',6=>'saturday');
		
		for($i=$current_day+1 ; $i< 7;$i++)
		{
			if($timing_arrray[$i]){
				$next_day = $day_array[$i];
				$min=$i;
				break;
			}	
		}
		
		if(!$next_day)
		{	
			$min = min(array_keys($timing_arrray));
			$next_day = $day_array[$min];
		}
		
		$date->modify('next '.$next_day);//strtotime('next '.$next_day);
		//return array('date'=>date('Y-m-d', $next_day_date),'day_no'=>$min,'day'=>$next_day);	
		return array('date'=>$date->format('Y-m-d'),'day_no'=>$min,'day'=>$next_day);	
		
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
						$sort_order = intval($r['category_sort']);
						$category[$sort_order]['category_id'] = $r['category_id'];
						$category[$sort_order]['category_name'] = $r['category_name'];
						$category[$sort_order]['subtitle'] = $r['subtitle'];
						$category[$sort_order]['restaurant_id'] = $r['restaurant_id'];
						$category[$sort_order]['location_id'] = $r['location_id'];
						
						
						$item_array = array('item_id'=>$r['item_id'],
											'item_description'=> nl2br($r['item_description']),
											'item_name'=>$r['item_name'],
											'price'=>$r['price']);
						$category[$sort_order]['items'][] = $item_array;			
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
				
		public function getRestaurantMenuDetail($check_array='')
		{
			
			//echo 'here';exit;
			if(!$check_array){
				$testVar=$_GET['test'];
				if($testVar==1)
					$data=$_GET['data'];
				else
					$data 	= 	 file_get_contents("php://input");
			}
			else
			{
				$data=$check_array;
			}
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				//$data['id'] = 12;
				$result_array = $this->client_model->getRestaurantMenuDetail($array['item_id']);
				
				if($array['member_id'])
					$check_fav  = $this->client_model->isFavItem($array['member_id'],$array['item_id']);
				
				$sizeresult = $this->client_model->getRestaurantMenuSizeDetail($array['item_id']);
				//echo '<pre>';print_r($result_array);exit;
				$category = array();
				
				if(!empty($result_array)){
						$i=0;
						foreach($result_array as $val)
						{
							$menu['category_id'] = $val['category_id'];
							$menu['item_name'] = $val['item_name'];
							$menu['item_id'] = $val['item_id'];
							$menu['item_description'] = nl2br($val['item_description']);
							$menu['location_id'] = $val['location_id'];
							
							$menu['is_fav'] = $check_fav;
							
							
							if($val['option_id']!=''){
								
								$sort_order = $val['sortorder'];
								$menu['option_id'][$sort_order] = $val['option_id'];
								$menu['option_name'][$val['option_id']] = $val['option_name'];
								$menu['is_mandatory'][$val['option_id']] = $val['mandatory'];
								$menu['is_multiple'][$val['option_id']] = $val['multiple'];
								$menu['multiple_limit'][$val['option_id']] = $val['limit'];
								$menu['sortorder'][$val['option_id']] = $val['sortorder'];
								
								if($val['side_id']!=''){
										
										$side_sort_order = $val['sidesortorder'];
										$menu['side_id'][$val['option_id']][$side_sort_order] = $val['side_id'];
										$menu['side_item'][$val['option_id']][$val['side_id']] = $val['side_item'];
										$menu['side_price'][$val['option_id']][$val['side_id']] = $val['side_price'];
									
									}
									else
									{
										$menu['side_id'][$val['option_id']] = array();
										$menu['side_item'][$val['option_id']] = array();
										$menu['side_price'][$val['option_id']] = array();
									}
							$i++;
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
					$menu['sizes']=$sizeresult;
					$result = array('status' => 'success','result' => $menu);		
				}else{
					$result = array('status' => 'error','message' => $this->config->item('invalidLocation'));
				}
				
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			
			if($check_array)
				return $result;
			else
				echo json_encode($result);
		}	
		
		public function getOrderItemsDetail()
		{
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			$items = $this->client_model->get_where('fk_order_items',array('order_id' => $array['order_id']), 'order_id ASC',$tpe="result");
			
			foreach($items as $item)
			{	
				$check = json_encode(array('item_id'=>$item['item_id']));
				$detail = $this->getRestaurantMenuDetail($check);
			
				if($detail['status']=='success')
					$detail_array[$item['item_id']] = $detail['result'];
				else
					$detail_array[$item['item_id']] = array();
			}
			
			$result = array('status' => 'success','result' => $detail_array);	
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
			
			$this->load->library('stripe_lib');
				
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data,true);
			$array	=	$data['order_data'];
//{"order_data":{"user_id":"9","restaurant_id":1,"location_id":"5","category_id":"11","item_id":"12","item_price":"120","option_name":{"0":"Garlic paste"},"side_name":{"0":{"0":"Tomato sauce","1":"test"},"1":{"0":"test"}},"side_price":{"0":{"0":"30","1":"23"},"1":{"0":"50"}},"quantity":2,"total":300,"order_type":"Pickup","delivery_time":"2015-09-02T08:10:20.099Z","is_later":"N"}};
			
//echo date("Y-m-d H:i:s");

			//echo '<pre>';print_r($array);exit;
			if($data!=''){
				
				$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $array['user_id']),'member_id');
				if($profile_details['status']!='Y')
				{
					
					$result = array('status' => 'error','message' => $this->config->item('blockUser'));
					echo json_encode($result );
					exit;

				}
				
				$check_data = array('location_id'=>$array['location_id'],'restaurant_id'=>$array['restaurant_id'],'member_id'=>$array['user_id']);
				
				$resdetails = $this->client_model->get_where('fk_restaurant_master',array('restaurant_id' => $array['restaurant_id']),'restaurant_id');
				
				$stripe = $this->client_model->getOwnerStripDetails($check_data);
			
				if(!$stripe)
				{
					$result = array('status' => 'error','message' => $this->config->item('invalidStripAccount'));
					echo json_encode($result);
					exit;
				}	
				
				$this->stripe_lib->setApiKey($stripe['stripe_private_key']);
				if($array['payment_data']!='' && !$array['payment_data']['cust_id'])
				{
					
					$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $array['user_id']),'member_id');
					$admin_args = array(
						'description'=>"Customer for ".$profile_details['email'],
						'email'=>$profile_details['email'],
						'source' => $array['payment_data']['token']
					);
					
					$customer = $this->stripe_lib->createCustomer($admin_args);
					$customer_strip_id = $customer->id;
					$last_4digit = $array['payment_data']['last4'];
					$brand = $array['payment_data']['brand'];
				
				}
				else
				{
					if(!$array['payment_data']['cust_id']){
						$customer_strip_id_array = $this->client_model->getCustomerStripId($check_data);
					}
					else
					{
						$this->db->where(array('strip_customer_id'=>$array['payment_data']['cust_id']));
						$this->db->order_by("created_time", "desc"); 
						$query = $this->db->get('fk_order_stripid_map');	
						$customer_strip_id_array = $query->result_array();	
						
					}
				
					if($customer_strip_id_array[0])
					{
						$customer_strip_id = $customer_strip_id_array[0]['strip_customer_id'];
						$last_4digit = $customer_strip_id_array[0]['last_4digit'];
						$brand = $customer_strip_id_array[0]['brand'];
					}
					else
					{
						$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
						echo json_encode($result);
						exit;
					}
				}
				
				
					
				$cart_data=$array['cart_data'];
				$promo_data=$array['promo_data'];
				$total = $array['sub_total'];
				$discount = 0;
				
				if(count($promo_data)!=0)
				{
					switch($promo_data['discount_type'])
					{
						case 'Percentage': $discount = ($total*$promo_data['discount_amount'])/100;break;
						case 'Fixed amount': $discount = $promo_data['discount_amount'];break;
					}
					
					$total = $total - $discount;
					if($total <=0){
						$total = 0;
						$discount = $total;
					}
						
				}
				
				$tax_amount = 0;
				
				if($array['order_type']=='Delivery'){
				
					if(getLocationConfigValue('23',$array['location_id'],$array['restaurant_id'])!='')
						$delivery_charge  =getLocationConfigValue('23',$array['location_id'],$array['restaurant_id']);
					else
						$delivery_charge  =getConfigValue('delivery_charge');
					
					if(getLocationConfigValue('24',$array['location_id'],$array['restaurant_id'])!='')
						$is_delivery_taxable  =getLocationConfigValue('24',$array['location_id'],$array['restaurant_id']);
					else
						$is_delivery_taxable  =getConfigValue('is_delivery_taxable');
					
					if($is_delivery_taxable=='Y')
						$subtotal = $array['sub_total']+$delivery_charge;
					else
						$subtotal = $array['sub_total'];
						
						
				}
				else
				{
					$subtotal =$array['sub_total'];
					$delivery_charge = 0;
				}
					
				if(getLocationConfigValue('17',$array['location_id'],$array['restaurant_id'])!='')
					$sales_tax_percentage  =getLocationConfigValue('17',$array['location_id'],$array['restaurant_id']);
				else
					$sales_tax_percentage  =getConfigValue('sales_tax_percentage');
				$tax_amount = ($subtotal * $sales_tax_percentage)/100;
				$total = $total + $delivery_charge + $tax_amount;
				
				if($array['tip'])
				{
					$total = $total + $array['tip'];
				}
				
				/*if(count($array['cart_data'])!=0){
					$location_id=$cart_data[0]['location_id'];
				}*/
				
				$owner_payment = array(
				'amount' => bcmul($total, 100),
				'currency' => 'usd',
				'customer' => $customer_strip_id
				);
				
				$retData=$this->stripe_lib->chargeCustomer($owner_payment);		
				$response = mysql_real_escape_string(serialize($retData));
				
				$total= bcdiv($retData->amount, 100, 3); ;
			
				$no=rand(000001,999999);
				$ordermaster=array("member_id"=>$array['user_id'],
					   "order_ref_id"=>"#FR".$array['user_id'].$no,
					   "restaurant_id"=>$array['restaurant_id'],
					   "location_id"=>$array['location_id'],
					   "created_time"=>date("Y-m-d H:i:s"),
					   "order_status"=>"New",
					   "sub_total"=>$array['sub_total'],
					   "total_amount"=>$total,
					   "discount_amount"=>$discount,
					   "tax_amount" =>$tax_amount,
					   "delivery_service_amount"=>$delivery_charge,
					   "payment_status"=>'Y',
					   "order_type"=>$array['order_type'],
					   "is_later"=>$array['is_later'],
					   "tip"=>$array['tip'],
					   "source_type"=>'app',
					   "delivery_time"=>date('Y-m-d H:i:s',strtotime($array['delivery_time']))
					  );
				//echo '<pre>';print_r($ordermaster);exit;	  
				$order_id = $this->client_model->insert('fk_order_master',$ordermaster);
				
				if($order_id && count($promo_data)!=0){
				
				$promo_map = array('order_id'=>$order_id,
									'promocode'=>$promo_data['promocode'],
									'discount_type'=>$promo_data['discount_type'],
									'discount_value'=>$promo_data['discount_amount'],
									'member_id'=>$array['user_id'],
									'restaurant_id'=>$array['restaurant_id']);
				$this->client_model->insert('fk_promo_order_map',$promo_map);
				
				$this->client_model->updatePromoCount($promo_data['promo_id'],$promo_data['promocode'],$array['restaurant_id']);
									
				}
				
				if(count($cart_data)!=0){
					for($j=0;$j<count($cart_data);$j++){
						
						if($cart_data[$j]['quantity'] && ($cart_data[$j]['quantity']!=0 && $cart_data[$j]['delete']!='Y')){
						
						$orderitems=array("order_id"=>$order_id,
								"item_id"=>$cart_data[$j]['item_id'],
								"unit_price"=>$cart_data[$j]['item_price'],
								"quantity"=>$cart_data[$j]['quantity'],
								"price"=>$cart_data[$j]['item_price']*$cart_data[$j]['quantity'],
								"instructions"=>$cart_data[$j]['notes'],
								"size"=>$cart_data[$j]['item_size']
								);	
						
						$ord_item_id = $this->client_model->insert('fk_order_items',$orderitems);
						
										
						if(count($cart_data[$j]['option_name'])!=0){
							for($i=0;$i<count($cart_data[$j]['option_name']);$i++){
								$sides='';
								
								//remove user deleted sides
								
								foreach($cart_data[$j]['side_name'][$i] as $key=>$sides)
								{
								 if($cart_data[$j]['side_delete'][$i][$key] == 'Y'){
								 	unset($cart_data[$j]['side_name'][$i][$key]);
									unset($cart_data[$j]['side_price'][$i][$key]);
									}
								}
								
								$sides=array("sides"=>$cart_data[$j]['side_name'][$i],"price"=>$cart_data[$j]['side_price'][$i]);
								$sides= serialize($sides);
								$hh=$i+1;
								$orderoptionmap = array("order_id"=>$order_id,
														"ord_item_id"=>$ord_item_id,
														"options"=>$cart_data[$j]['option_name'][$i],
														"sortorder"=>$cart_data[$j]['option_sort_order'][$i],
														"sides"=>$sides
													);	
								$mapid = $this->client_model->insert('fk_order_option_map',$orderoptionmap);
			
								
							}
						}
						
						}
					}
				
				}
				
				//echo '<pre>';print_r($orderoptionmap);echo'<pre>';exit;	
				if($array['order_type'] == 'Delivery'){
					$array['delivery_address']['order_id'] = $order_id;
					$array['delivery_address']['created_date'] = date('Y-m-d H:i:s');
					$address_id = $this->client_model->insert('fk_delivery_address',$array['delivery_address']);
				}
				
				if($order_id)
				{
					$arr=array("member_id"=>$array['user_id'],
						"restaurant_id"=>$array['restaurant_id'],
						"location_id"=>$array['location_id'],
						"strip_customer_id"=>$customer_strip_id,
						"created_time"=>date('Y-m-d H:i'),
						"last_4digit"=>$last_4digit,
						"brand"=>$brand,
						"order_id"=>$order_id,
					   "strip_order_id"=>$retData->id,
					   "strip_response"=>$response);
						
					$this->db->insert('fk_order_stripid_map',$arr);
				
				}
				
				$result = array('status' => 'success','order_id'=>$order_id,'message' => $this->config->item('saveOrder'));
				
				
			
			//$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $array['user_id']),'member_id');
			//$email	=	$profile_details['email'];

			
			
			
			$this->load->model('email_model');		
			$this->load->model('admin/order_model');		
			$data['orderdetails']=$this->order_model->getDetailOrder($order_id);
			$email	=	$data['orderdetails'][0]['email'];
			
		
			$data['orderdetails']=$this->order_model->getDetailOrder($order_id);
			$data['itemdetails']=$this->order_model->getDetailItem($order_id);
			$payment_details = $this->order_model->getOrderStripMap($order_id);
			
			foreach($payment_details as $payment)
			{
				if($payment['payment_mode']=='fund')
					$data['payment_details']['fund'] = $payment;
					
				else if($payment['payment_mode']=='refund')
					$data['payment_details']['refund'] = $payment;
			}
			
			//$data['optiondetails']=$this->order_model->getDetailOption($order_id);
			if(count($data['itemdetails']!='')){
					foreach($data['itemdetails'] as $var){
						$sidesdetails[$var['ord_item_id']]   =$this->order_model->getDetailOption($var['ord_item_id']);
						//echo '<pre>';print_r($sidesdetails);
					}
				}
			
			$data['sidesdetails']=$sidesdetails;
			$data['orderid']=$order_id;	
			$data['restaurant_id']=$array['restaurant_id'];
			$data['restaurant_name']=$data['orderdetails'][0]['restaurant_name'];
			$data['logo']=$resdetails['logo'];
			
				
			//$emaildata	=$this->email_model->get_email_template('accept_order');
			//$message  = $emaildata['email_template'];
			//$message = str_replace('#REFNO#', $result['first_name'], $message);
			//$subject= $emaildata['email_subject'];
			//$subject= "Your order is successfully placed.";
			$data['subject']="Thank you for your order from ".$data['restaurant_name'];
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <info@forkourse.com>'. "\r\n";
			$message = $this->load->view('email/accept_order_new', $data, TRUE);
			//echo $this->load->view('email/accept_order', $data, TRUE);
			mail($email,$data['subject'], $message, $headers);

			$sendPush = $this->sendPush($array['location_id']);	


				
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result );
			//echo '<pre>';print_r($sides);echo'<pre>';exit;		 

		}
		
		public function createStripCustomer($data)
		{
			$this->load->library('stripe_lib');
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);
			
			
			$stripe = $this->client_model->getOwnerStripDetails($data);
			
			if(stripe)
			{	
				$this->stripe_lib->setApiKey($stripe['stripe_private_key']);
				
				$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $data['member_id']),'member_id');
				
				$admin_args = array(
					'description'=>"Customer for ".$profile_details['email'],
					'email'=>$profile_details['email'],
					'source' => $data['token']
				);
				
				$customer = $this->stripe_lib->createCustomer($admin_args);
				$customer_id = $customer->id;
				
				$arr=array("member_id"=>$data['member_id'],"restaurant_id"=>$data['restaurant_id'],"location_id"=>$data['location_id'],"strip_customer_id"=>$customer_id,
					"created_time"=>date('Y-m-d H:i'),"last_4digit"=>$data['last4'],"brand"=>$data['brand']);
					
				$this->db->insert('fk_order_stripid_map',$arr);
				$result = array('status' => 'success');
				
			}
			else
			{
				$result = array('status' => 'error','message' =>$this->config->item('invalidStripAccount'));
			}
			echo json_encode($result );
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
				$result = $this->client_model->favouriteLists($array['member_id'],$array['location_id']);
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
			
			$max_pre_order = ($this->config->item('max_pre_order'))?$this->config->item('max_pre_order'):5;
			
			//echo '<pre>';print_r($array);echo'<pre>';exit;
			if($data!=''){
				
				$orderList = $this->client_model->getAllOders($array['member_id'],$array['loc_id'],$array['offset'],'',$max_pre_order);
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
				
				$orderList = $this->client_model->getAllOders($array['member_id'],$array['loc_id'],$array['offset'],$array['order_id']);//$this->client_model->get_where('fk_order_master',array('order_id' => $array['order_id']), 'order_id ASC');
				$orderList = $orderList[0];
				$orderList['items'] = $this->client_model->get_where('fk_order_items',array('order_id' => $array['order_id']), 'order_id ASC',$tpe="result");
				if(count($orderList['items'])!=0){
					for($i=0;$i<count($orderList['items']);$i++){
						//echo $orderList['items'][$i]['ord_item_id'];exit;
						$orderList['items'][$i]['details'] = $this->client_model->getOderItemDetails($orderList['items'][$i]['ord_item_id']);
						$sides = $this->client_model->getAllOderSidesDetails($orderList['items'][$i]['ord_item_id']);
						$sidesOld = $this->client_model->getAllOderSidesDetailsSort($orderList['items'][$i]['ord_item_id']);
						for($j=0;$j<count($sides);$j++){
							$sidesOld[$j]['sides']=unserialize($sidesOld[$j]['sides']);
						}
						
						for($j=0;$j<count($sides);$j++){
							$sides[$j]['sides']=unserialize($sides[$j]['sides']);
						}
						$orderList['items'][$i]['option_array'] = $sides;
						$orderList['items'][$i]['option_array_new'] = $sidesOld;
					}
				}
				$result = array('status' => 'success','orderDetail'=>$orderList);
				//echo '<pre>';print_r($orderList);echo'<pre>';exit;
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
		echo json_encode($result);
	}	
	public function orderHide()
	{
		$testVar=$_GET['test'];
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
		
		$array 	=	 json_decode($data, true);
		$max_pre_order = ($this->config->item('max_pre_order'))?$this->config->item('max_pre_order'):5;
		
		if($data)
		{
			$set_data=array('status'=>'N');
			$this->db->where('order_id', $array['order_id']);
			$result = $this->db->update('fk_order_master', $set_data); 
			if($result)
			{
				$orderList = $this->client_model->getAllOders($array['member_id'],$array['loc_id'],$array['offset'],'',$max_pre_order);
				if(count($orderList)!=0){
					for($i=0;$i<count($orderList);$i++){
						$orderList[$i]['items'] = $this->client_model->getAllOderItemDetails($orderList[$i]['order_id']);
					}
				}
				$result = array('status' => 'success','message'=>$this->config->item('orderDelete'),'orderList'=>$orderList);
			}
			else
			{
					$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}

		}
		else
		{
			$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
		}
		
		echo json_encode($result);
	}
		
	public function orderCancel()
	{
		$testVar=$_GET['test'];
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
		
		$array 	=	 json_decode($data, true);
		
		
		
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
				$rs['phone'] = $result['phone'];
				$rs['auth_type'] = $result['auth_type'];
				$rs['address'] = $address;
				echo json_encode($rs);
				
		}
		
		public function checkDeliveryAddress()
		{
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);
			if($data){	
			
			$address = $data['address'];
			
			$coordinates =file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
			$coordinates = json_decode($coordinates);
		
			if($coordinates->status =="OK"){
			
				$lat=$coordinates->results[0]->geometry->location->lat;
				$long=$coordinates->results[0]->geometry->location->lng;
				if($lat!='' && $long!='')
				{
					$resp = $this->client_model->getRestaurantDetails($data['location_id']);
					
					if($resp['latitude']!='' && $resp['longitude']!='')
					{	
							if(getLocationConfigValue('14',$data['location_id'],$resp['restaurant_id'])!='')
								$radius  =getLocationConfigValue('14',$data['location_id'],$resp['restaurant_id']);
							else
								$radius = getConfigValue('max_delivery_radius');
					
						$distance = $this->distance($lat, $long, floatval($resp['latitude']),floatval($resp['longitude']), "M");
						
						if($distance <= $radius)
							$result = array('status'=>'success','distance'=>$distance,'message'=>'Valid Address');	
						else
							$result = array('status'=>'error','distance'=>$distance,'message'=>$this->config->item('addressNotReachable'));	
						
					}
					  
			
				
				}
				else
				{
					$result = array('status'=>'invalid','message'=> $this->config->item('invalidAddress'));
				}
			}
			else
			{
			$result = array('status'=>'invalid','message'=>'Invalid Address');
			}
			
			echo json_encode($result);
			
			}
		}
		
		public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		
		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);
		
		  if ($unit == "K") {
			return ($miles * 1.609344);
		  } else if ($unit == "N") {
			  return ($miles * 0.8684);
			} else {
				return $miles;
			  }
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
			}else if($userDetails['auth_type']!='facebook'){
		
				$this->load->model('email_model');
				
				$new_password 	= 	$this->client_model->randomPassword(); # generate random password
				$update_array['password'] = $new_password;
				$update_array['member_id'] = $userDetails['member_id'];
				$userDetails = $this->client_model->updateUser($update_array);
				
				$email = $this->email_model->get_email_template('forgot_password');
				
              //  $this->load->library('encrypt');
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
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);	
			$server_timezone = date_default_timezone_get();
			$today_time = $this->timeConvert($server_timezone,$data['timezone'],date('Y-m-d H:i:s'),'Y-m-d H:i:s');
			$result = array('time'=>$today_time);
			echo json_encode($result);
		}
		
		public function checkPromocode()
		{	
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);	
			
			
			$check_data = array('promocode'=>$data['promocode'],'restaurant_id'=>$data['restaurant_id'],'status'=>'Y');
			$promocode_array = $this->client_model->getPromocode($check_data);
			
			//print_r($promocode_array);
			
			if(count($promocode_array)!=0){
			
				$resp = $this->client_model->getRestaurantDetails($data['location_id']);
				if(!$resp['timezone'])
					$resp['timezone'] = $server_timezone;
					
				$server_timezone = date_default_timezone_get();
				$today_time = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'),'Y-m-d H:i:s');
				
				$start_time = $promocode_array['start_date'].' 00:00:00';
				$end_time = $promocode_array['end_date'].' 00:00:00';
				
				if($promocode_array['start_date']!='' && $today_time < $start_time){
				
					$result = array('status'=>'error','message' => $this->config->item('invalidPromocode'));
				}
				elseif($promocode_array['end_date']!='' && $today_time > $end_time){
					$result = array('status'=>'error','message' => $this->config->item('expirePromocode'));
				}
				elseif($promocode_array['uses_per_coupon'] && $promocode_array['uses_per_coupon'] <= $promocode_array['total_uses']){
				
					$result = array('status'=>'error','message' => $this->config->item('reachMaxPromocode'));
				}
				else
				{
					$result = array('status'=>'success','message'=>$this->config->item('validPromocode'),'data'=>$promocode_array);
				}
				
			}
			else
			{
				$result = array('status'=>'error','message' => $this->config->item('invalidPromocode'));
			}
			
			//$result = array('time'=>$today_time);
			echo json_encode($result);
		}
		
		public function getStripDetails()
		{	
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);	
			//pk_test_E8w4Y4sEFLSf9WD4wGNnMYeS
			//sk_test_lRwyKV3qUsQJfMp8PMA8c3tm
			
			$stripe = $this->client_model->getOwnerStripDetails($data);
			$customer_strip_id_array = $this->client_model->getCustomerStripId($data);
			if($customer_strip_id_array[0])
			{
				$customer_strip_id = $customer_strip_id_array[0]['strip_customer_id'];
				$last_4digit =  $customer_strip_id_array[0]['last_4digit'];
			}
			$result = array('status'=>'success','stripe_public_key' =>$stripe['stripe_public_key'],'customer_strip_id'=>$customer_strip_id,'last_4digit'=>$last_4digit );
			
			//$result = array('status'=>'error','message' => $this->config->item('invalidStripAccount'));
			echo json_encode($result);
		
		}
		public function getNewDeliveryTime()
		{
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			$resturant_details = $this->restaurantDetails($data);
			
			if($resturant_details['status']=='success')
			{
				$result = array('status' => 'success',
								'current_time'=>$resturant_details['current_time']
								);
			}
			else
			{
				$result = $resturant_details;
			}
			echo json_encode($result);
		
		
		}
		
		
public function sendPush($location_id){
		$locDetails = $this->client_model->get_where('fk_restaurant_locations',array('location_id' => $location_id),'location_id');
		//print_r($locDetails);
		//$data['orderdetails']=$this->order_model->getDetailOrder($order_id);
		if($locDetails['device_token']!=''){
			$restaurant_id	=	$locDetails['restaurant_id'];
			$device_token	=	$locDetails['device_token'];	
			$allow_notification	=	$locDetails['allow_notification'];	
			
		
			$message	=	"New order placed";
			
			if($allow_notification=='Y'){
			
				if($locDetails['device_platform']=='Android'){
						$registatoin_ids = array($device_token);
						$message = array("message" =>  $message);	
						$result = $this->send_notification($restaurant_id,$restaurant_google_api_key,$registatoin_ids, $message,1);
				}else{
						$user_id=1;
						$arr['user_id']  = $user_id; 
						$aaaa['sender_id']  = $user_id; 
						$aaaa['reciver_id']  = $user_id; 
						$aaaa['display_name']  = "Test"; 
		
						//$deviceTocken = $result['device_id'];
						$deviceTocken = $device_token;
						//$deviceTocken ="0fb7f6b14ecfcd2ff1cb25a7b6a1a336a90a9cf8ce1974ce327d65ceb50708b7";
						$badge_count  = 1;
						if($deviceTocken!='')
						{
							$this->sendPushNotificationIOS($restaurant_id,$message,$deviceTocken,$badge_count,$aaaa,'mutual_match');
						}
				}
			}
		}
	}

	function sendPushNotificationIOS($restaurant_id,$message,$deviceToken,$badge_count=1,$details,$type)
		{
		
			// Put your device token here (without spaces):
			//$deviceToken = 'be83f428d2bf39337dd58b105c43077cab80e0adba3b74718f27fe396f71395c';
			//$message = "Testing";
			// Put your private key's passphrase here:
			$passphrase = 'newage'; 
			////////////////////////////////////////////////////////////////////////////////
			
			
			//$devmode = getConfigValue('dev_mode');
			$devmode = 'N';
			
			$dev_pem_name = 'bfg_dev.pem';
			$prod_pem_name = 'bfg_dist.pem';
			
			//$devmode='N';
			$ctx = stream_context_create();
			if($devmode=='Y'){
				stream_context_set_option($ctx, 'ssl', 'local_cert', $dev_pem_name);
			}else{
				stream_context_set_option($ctx, 'ssl', 'local_cert', $prod_pem_name);
			}
				stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
			// Open a connection to the APNS server
			//gateway.push.apple.com 
			//gateway.sandbox.push.apple.com:2195
			//'ssl://gateway.push.apple.com:2195'
			
			
			if($devmode=='Y'){
				$fp = stream_socket_client(
				'ssl://gateway.sandbox.push.apple.com:2195', $err,
				$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			}else{
				$fp = stream_socket_client(
				'ssl://gateway.push.apple.com:2195', $err,
				$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			}
			
			//if (!$fp)
				//exit("Failed to connect: $err $errstr" . PHP_EOL);
			
				
			
			
			//echo 'Connected to APNS' . PHP_EOL;
			// Create the payload body
			$body['aps'] = array(
			'alert' => $message,
			//'badge' => intval($badge_count),
			'sound' => 'default',
			'type' => $type,
			'details' => $details
			);
			// Encode the payload as JSON
			$payload = json_encode($body);
			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));
			//	 print_r($result);
			//exit;
			/*	if (!$result)
			echo 'Message not delivered' . PHP_EOL;
			else
			echo 'Message successfully delivered' . PHP_EOL;*/
			// Close the connection to the server
			fclose($fp);
		}
	
		
		
		

		
}