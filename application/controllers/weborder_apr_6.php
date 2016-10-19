<?php 
class Weborder extends MY_Controller {

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
	public function home($resID){
		//$resID=$_REQUEST[''];
		
		
		//echo "h";echo $resID;echo "h";
		//$json = $_POST['signed_request'];
		//print_r($json);
   		//$obj = json_decode($json,TRUE);
		
		//echo $_POST['signed_request'];
    	//$json = $_POST['signed_request'];
		//obj = json_decode($json,TRUE);
		//print $obj->{'member_id'}; 
		
		//exit;
		$data 	= array("resID"=>$resID);
		$this->load->view('weborder/header',$data);
		$this->load->view('weborder/view',$data);
		$this->load->view('weborder/footer',$data);
	}
	public function home1(){
		$data 	= array("resID"=>'1');
		//$this->load->view('weborder/header',$data);
		$this->load->view('weborder/view',$data);
		//$this->load->view('weborder/footer',$data);
	}
//-------------------------umesh---------------------------------
	//checkFber
	public function FbLogin(){
			
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
	public function updateUserData(){  
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
				$rs['result'] = $this->client_model->update('fk_member_master', $array['er_data'],array('member_id'=> $array['member_id']));
				$result = array('status' => 'success','result'=>$array['member_id'],'message' => $this->config->item('updateUser'));
			}
		}else{
			$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
		}
		echo json_encode($result);
	}
	//saveerFb
	public function signUpFb(){			

		$testVar=$_GET['test'];
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
			
		$array 	=	 json_decode($data, true);
		$array['er_data']['created_date'] = date('Y-m-d H:i:s');
		if($data!=''){
			$response = $this->client_model->get_where('fk_member_master',array('email' => $array['er_data']['email'],'restaurant_id'=> $array['er_data']['restaurant_id']), 'member_id ASC');
			if(count($response)){
				$result = array('status' => 'error','message' => $this->config->item('UserExist'));
			}else{		
				$insert_id = $this->client_model->insert('fk_member_master',$array['er_data']);
				$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('UserInserted'));
			}
		}else{
			$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
		}	
		echo json_encode($result);
	}
	//inserter
	public function signUp(){

			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			
			if($data!=''){
				$array['er_data']['created_date'] = date('Y-m-d H:i:s');
				$response = $this->client_model->get_where('fk_member_master',array('email' => $array['er_data']['email'],'restaurant_id'=> $array['er_data']['restaurant_id']), 'member_id ASC');
				if(count($response)){
					$result = array('status' => 'error','message' => $this->config->item('UserExist'));
				}else{		
					$insert_id = $this->client_model->insert('fk_member_master',$array['er_data']);
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
				
				$erDetails = $this->client_model->get_where('fk_member_master',array('email' => $array['email'],'restaurant_id'=> $array['restaurant_id']), 'member_id ASC');
				if(empty($erDetails)){
					$result = array('status' => 'error','message' => $this->config->item('incorrectEmail'));
				}else if($erDetails->auth_type!='facebook'){
					if($erDetails['password'] != $array['password']){
						$result = array('status' => 'error','message' => $this->config->item('incorrectPassword'));
					}
					else if($erDetails['status'] == 'N'){
						$result = array('status' => 'error','message' => $this->config->item('UserBlocked'));
					}else{
						$member_id = $erDetails['member_id'];
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
		
	public function checkUserData(){
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			if($data!=''){
				$userDetails = $this->client_model->get_where('fk_member_master',array('member_id' => $array['member_id']), 'member_id ASC');
				//print_r($userDetails);
				if($userDetails['status'] == 'N'){
					$result = array('status' => 'error','message' => $this->config->item('blockUser'));
				}else{
					$result = array('status' => 'success');
				}
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			echo json_encode($result);
	
		}		
		
		
	public function restaurantList()		{
		
		$data = file_get_contents('php://input'); 
		$array 	=	 json_decode($data, true);
		
		
			//$array['lat']	=	$this->input->post('lat');
		
			if($array!=''){
				$radi = ($this->config->item('default_radi'))?$this->config->item('default_radi'):0;
				$resp = $this->client_model->getRestaurant($array,$radi);
				//print_r($resp);
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
		
	public function getNearestRestaurant()		{
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				$radi = ($this->config->item('default_radi'))?$this->config->item('default_radi'):0;
				$resp = $this->client_model->getRestaurant($array,$radi);
				$result = array('status' => 'success','result' =>$resp[0]);

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
				
				//$day_array =['sunday'=>0,'monday'=>1,'tuesday'=>2,'wednesday'=>3,'thursday'=>4,'friday'=>5,'saturday'=>6];
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
				
				$today_end=$this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s')); ///new DateTime(date('Y-m-d H:i'));//for checking by adding delivery time 	
				$today_date = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'),'Y-m-d');//date('Y-m-d');
				$today_time = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'),'Y-m-d H:i:s');//date("Y-m-d H:i:s");
				$tomorrow = $this->timeConvert($server_timezone,$resp['timezone'],date('Y-m-d H:i:s'));
				$tomorrow->modify('+1 day');
				$tomorrow->format('Y-m-d');
				
								
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
					
					
				$min_interval  =getConfigValue('minute_interval');
				$min_later_days  =($this->config->item('min_later_days'))?$this->config->item('min_later_days'):4;
				
				$condition =  array("restaurant_id"=>$array['restaurant_id']);
				$details = $this->client_model->get_where('fk_restaurant_messages',$condition,"id ASC","row");
				$ctom_message =$details['message'];
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
						$stat = 'before_start_time';
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
						$stat = $next_day;
						$resp['start_at'] = $next_date.' '.$timing_arrray[$next_day_no]['start_at'];
						$resp['end_at'] = $next_date.' '.$timing_arrray[$next_day_no]['end_at'];
						
					}
					else
					{
						$closed = 0;
						$resp['start_at'] = $today_date.' '.$timing_arrray[$current_day]['start_at'];
						$resp['end_at'] = $today_date.' '.$timing_arrray[$current_day]['end_at'];
						$stat = '';
						if($resp['end_at'] < $resp['start_at'])
						$end_time = new DateTime($tomorrow.' '.$timing_arrray[$current_day]['end_at'],new DateTimeZone($resp['timezone'])); // if time on ni8 to day
					}
				}else{	
					$closed = 1;
					$date_array = $this->getNextOpenDate($timing_arrray,$current_day,$today);
					$next_date = $date_array['date'];
					$next_day_no = $date_array['day_no'];
					$next_day = $date_array['day'];
					$stat = $next_day;
					$resp['start_at'] = $next_date.' '.$timing_arrray[$next_day_no]['start_at'];
					$resp['end_at'] = $next_date.' '.$timing_arrray[$next_day_no]['end_at'];
					
					}
			
				}
			
				
				if(empty($resp) || empty($resp['timings']) ){
					$result = array('status' => 'error','message' => $this->config->item('invalidLocation'));
				}else{
					$result = array('status' => 'success','result' =>$resp,
									'current_time'=>$today_time,
									'is_closed'=>$closed,
									'minimum_delivery_time'=>$minimum_delivery_time,
									'minimum_pick_up_time'=>$minimum_pick_up_time,
									'max_later_days'=>$max_later_days,
									'min_later_days'=>$min_later_days,
									'min_interval'=>$min_interval,
									'time_stat'=>$stat,
									'sales_tax_percentage'=>$sales_tax_percentage);
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
	
	public function ChangeDeliveryType()	{
	
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
							'time_stat'=>$resturant_details['time_stat']);
		}
		else
		{
			$result = $resturant_details;
		}
		echo json_encode($result);
	}
	
	public function getOffsetTimezone($time_zone)	{
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
	
	public function timeConvert($from='',$to='',$time='',$format='')	{
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
	
	public function getNextOpenDate($timing_arrray,$current_day,$date)	{
		
		//$day_array =[0=>'sunday',1=>'monday',2=>'tuesday',3=>'wednesday',4=>'thursday',5=>'friday',6=>'saturday'];
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
				$array['er_data']['created_date'] = date('Y-m-d H:i:s');
				//$response = $this->client_model->get_where('fk_delivery_address',array('member_id' => $array['er_data']['member_id']), 'member_id ASC');
				$insert_id = $this->client_model->insert('fk_delivery_address',$array['er_data']);
				$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('deliveryAddress'));
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
				echo json_encode($result);
				
		}	
	public function getRestaurantMenu()		{
			
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
	public function getRestaurantMenuDetail()		{
			
			
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			if($data!=''){
				//$data['id'] = 12;
				$result_array = $this->client_model->getRestaurantMenuDetail($array['item_id']);
				
				if($array['member_id'])
					$check_fav  = $this->client_model->isFavItem($array['member_id'],$array['item_id']);
				
				$sizeresult = $this->client_model->getRestaurantMenuSizeDetail($array['item_id']);
				
				if(count($sizeresult)==0){
					$sizeresult[0]=array();
				}
				
				$category = array();
				
				
				$newOptions=array();
				//foreach($result_array as $val)
				//{
				//	$newOptions[]=	$val;
						
				//} 				//echo "<pre>";print_r($newOptions);exit;
				//echo "<pre>";print_r($result_array);exit;
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
										$menu['side_sortorder'][$val['option_id']][$val['side_id']] = $val['sidesortorder'];
									
									}
									else
									{
										$menu['side_id'][$val['option_id']] = array();
										$menu['side_item'][$val['option_id']] = array();
										$menu['side_price'][$val['option_id']] = array();
										$menu['side_sortorder'][$val['option_id']] = array();
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
							
						$menu['options']=$newOptions;
						}
					$menu['sizes']=$sizeresult;
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
			
			$this->load->library('stripe_lib');
				
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data,true);
			
			$type=$data['facebook'];
			if($type=='FB'){
				$source_type="facebook";
			}else{
				$source_type="web";
			}
			$array	=	$data['order_data'];
			//print_r($array);
			if($data!=''){
				//print_r($array);
				$check_data = array('location_id'=>$array['location_id'],'restaurant_id'=>$array['restaurant_id'],'member_id'=>$array['user_id']);
				
				$resdetails = $this->client_model->get_where('fk_restaurant_master',array('restaurant_id' => $array['restaurant_id']),'restaurant_id');
				
				//print_r($resdetails);exit;
				$stripe = $this->client_model->getOwnerStripDetails($check_data);
				
				if(!$stripe)
				{
					$result = array('status' => 'error','message' => $this->config->item('invalidStripAccount'));
					echo json_encode($result);
					exit;
				}	
				
				$this->stripe_lib->setApiKey($stripe['stripe_private_key']);
				
				//new code
				$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $array['user_id']),'member_id');
				
				$admin_args = array(
					'description'=>"customer for ".$profile_details['email'],
					'email'=>$profile_details['email'],
					'source' => $array['payment_data']['token']
				);
				$customer = $this->stripe_lib->createCustomer($admin_args);
				$customer_strip_id = $customer->id;
				
				$arr=array("member_id"=>$array['user_id'],"restaurant_id"=>$array['restaurant_id'],"location_id"=>$array['location_id'],"strip_customer_id"=>$customer_strip_id,"created_time"=>date('Y-m-d H:i'),"last_4digit"=>$array['payment_data']['last4'],"brand"=>$array['payment_data']['brand']);
				
				$last_4digit=$array['payment_data']['last4'];
				$brand=$array['payment_data']['brand'];
				
				
				$customer_strip_id_array = $this->client_model->getCustomerStripId($check_data);
				//if($customer_strip_id_array[0])
				//{
				//	$customer_strip_id = $customer_strip_id_array[0]['strip_customer_id'];
				//}
				//else
				//{
				//	$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
				//	echo json_encode($result);
				//	exit;
				//}
				
				
					
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
				if(getLocationConfigValue('17',$array['location_id'],$array['restaurant_id'])!='')
					$sales_tax_percentage  =getLocationConfigValue('17',$array['location_id'],$array['restaurant_id']);
				else
					$sales_tax_percentage  =getConfigValue('sales_tax_percentage');
				$tax_amount = ($array['sub_total'] * $sales_tax_percentage)/100;
				$total = $total + $tax_amount;
				
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
				
				$retData=$this->stripe_lib->chargecustomer($owner_payment);		
				$response = serialize($retData);
				
			
			
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
					   "source_type"=>$source_type,
					   "delivery_time"=>date('Y-m-d H:i:s',strtotime($array['delivery_time']))
					  );
				//echo '<pre>';print_r($ordermaster);	  
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
				
				
				//echo '<pre>';print_r($cart_data);
				if(count($cart_data)!=0){
					for($j=0;$j<count($cart_data);$j++){ 
						
						if($cart_data[$j]['quantity'] && ($cart_data[$j]['quantity']!=0 && $cart_data[$j]['delete']!='Y')){
						
						$orderitems=array("order_id"=>$order_id,
								"item_id"=>$cart_data[$j]['item_id'],
								"unit_price"=>$cart_data[$j]['price'],
								"quantity"=>$cart_data[$j]['quantity'],
								"price"=>$cart_data[$j]['price']*$cart_data[$j]['quantity'],
								"instructions"=>$cart_data[$j]['specialIns'],
								"size"=>$cart_data[$j]['size']['size']
								);	
						
						$ord_item_id = $this->client_model->insert('fk_order_items',$orderitems);
						
										
						if(count($cart_data[$j]['optionsOLD'])!=0){
							for($i=0;$i<count($cart_data[$j]['optionsOLD']);$i++){ 
								$sides='';
								
								//remove er deleted sides
								 
								/*foreach($cart_data[$j]['sides'][$i] as $key=>$sides)
								{
								 if($cart_data[$j]['side_delete'][$i][$key] == 'Y'){
								 	unset($cart_data[$j]['side_name'][$i][$key]);
									unset($cart_data[$j]['side_price'][$i][$key]);
									}
								}*/
								$ar1=array();
								$ar2=array();
								$ar3=array();
								
								//$sides=array("sides"=>$cart_data[$j]['options']['sides'],"price"=>$cart_data[$j]['options']['side_price'][$i]);
								for($k=0;$k<count($cart_data[$j]['optionsOLD'][$i]['sides']);$k++){ 
									$ar1[]=$cart_data[$j]['optionsOLD'][$i]['sides'][$k]['sideitem'];
									$ar2[]=$cart_data[$j]['optionsOLD'][$i]['sides'][$k]['sidePrice'];
									$ar3[]=$cart_data[$j]['optionsOLD'][$i]['sides'][$k]['sideid'];
									
								}
								
								//$dataarr['sides']=$ar1;
								//$dataarr['price']=$ar2;
								$sides=array("sides"=>$ar1,"price"=>$ar2,"sideid"=>$ar3);
								//print_r($sides);
								$sides= serialize($sides);
								$orderoptionmap = array("order_id"=>$order_id,
														"ord_item_id"=>$ord_item_id,
														"sortorder"=>$cart_data[$j]['optionsOLD'][$i]['sortorder'],
														"options"=>$cart_data[$j]['optionsOLD'][$i]['optTitle'],
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
				
					$array['delivery_address']['zipcode'] = $array['delivery_address']['zip'];
					$array['delivery_address']['order_id'] = $order_id;
					$array['delivery_address']['created_date'] = date('Y-m-d H:i:s');
					
					//$array['delivery']['zipcode'] = $array['delivery_address']['zip'];
					//$array['delivery']['order_id'] = $order_id;
					//$array['delivery']['created_date'] = date('Y-m-d H:i:s');
					$new_array=array(
								"zipcode"=>$array['delivery_address']['zipcode'],
								"apartment"=>$array['delivery_address']['appartment'],
								"city"=>$array['delivery_address']['city'],
								"state"=>$array['delivery_address']['state'],
								"notes"=>$array['delivery_address']['instruction'],
								"address"=>$array['delivery_address']['address'],
								"order_id"=>$order_id,
								"phone"=>$array['phone'],
								"created_date"=>date('Y-m-d H:i:s')
								);
					
					//echo '<pre>';print_r($new_array);exit;
					//$data['delevery_details']=$new_array;
					$address_id = $this->client_model->insert('fk_delivery_address',$new_array);
				}
				
				$this->client_model->update('fk_member_master',array('phone'=>$array['phone']),array('member_id'=> $array['user_id']));

				
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
			
			$this->load->model('email_model');		
			$this->load->model('admin/order_model');		
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
						$sidesdetails[$var['ord_item_id']]   =$this->order_model->getDetailOptionNew($var['ord_item_id']);
						//echo '<pre>';print_r($sidesdetails);
					}
				}
			
			$data['sidesdetails']=$sidesdetails;
			$data['orderid']=$order_id;	
			$data['restaurant_id']=$array['restaurant_id'];
			
			
			
			$email	=	$data['orderdetails'][0]['email'];
			
			//echo '<pre>';print_r($data['delevery_details']);
			//echo '<pre>';print_r($data['orderdetails']);exit;
			//mail functionality
			$data['logo']=$resdetails['logo'];
			$data['restaurant_name']=$data['orderdetails'][0]['restaurant_name'];
			$data['subject']="Thank you for your order from ".$data['restaurant_name'];
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <info@forkourse.com>'. "\r\n";
			$message = $this->load->view('email/accept_order_new', $data, TRUE);
			mail($email,$data['subject'], $message, $headers);
			
			
				$sendPush = $this->sendPush($array['location_id']);			
				
				$result = array('status' => 'success','order_id'=>$order_id,'message' => $this->config->item('saveOrder'));
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			
			
			
			
			echo json_encode($result );
			//echo '<pre>';print_r($sides);echo'<pre>';exit;		 

		}
		
		
		
	public function sendPush($location_id){
		$location_id=1;
		$locDetails = $this->client_model->get_where('fk_restaurant_locations',array('location_id' => $location_id),'location_id');
		//print_r($locDetails);
		//$data['orderdetails']=$this->order_model->getDetailOrder($order_id);
		//exit;
		//be83f428d2bf39337dd58b105c43077cab80e0adba3b74718f27fe396f71395c
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
			//$deviceToken = '715dea67992f4995474cea4e8392f7f482c25d50eedf0ddedf89d1fd15a0b59a';
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
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function test(){
			
			$this->load->library('stripe_lib');
				
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$data='{"order_data":{"user_id":"96","restaurant_id":"1","location_id":"1","cart_data":[{"item_id":"573","quantity":3,"specialIns":"","item_name":"Coccos Sandwich","salesTax":"7","price":"7.25","size":"","options":[],"optionsOLD":[],"Sideindex":0}],"sub_total":21.75,"promo_data":{},"order_type":"Pickup","is_later":"Y","delivery_time":"2016/3/30   8:00 am","phone":"9446757747","payment_data":{"token":"tok_17ug1EDLTLqbIcktnyA4RkDd","last4":"4242","brand":"Visa"}}}';
			$data 	=	 json_decode($data,true);
			
			$type=$data['facebook'];
			if($type=='FB'){
				$source_type="facebook";
			}else{
				$source_type="web";
			}
			$array	=	$data['order_data'];
			//print_r($array);
			if($data!=''){
				
				$check_data = array('location_id'=>$array['location_id'],'restaurant_id'=>$array['restaurant_id'],'member_id'=>$array['user_id']);
				
				$resdetails = $this->client_model->get_where('fk_restaurant_master',array('restaurant_id' => $array['restaurant_id']),'restaurant_id');
				
				//print_r($resdetails);exit;
				$stripe = $this->client_model->getOwnerStripDetails($check_data);
				
				if(!$stripe)
				{
					$result = array('status' => 'error','message' => $this->config->item('invalidStripAccount'));
					echo json_encode($result);
					//exit;
				}	
				
				$this->stripe_lib->setApiKey($stripe['stripe_private_key']);
				
				//new code
				$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $array['user_id']),'member_id');
				
				$admin_args = array(
					'description'=>"customer for ".$profile_details['email'],
					'email'=>$profile_details['email'],
					'source' => $array['payment_data']['token']
				);
				$customer = $this->stripe_lib->createCustomer($admin_args);
				$customer_strip_id = $customer->id;
				
				$arr=array("member_id"=>$array['user_id'],"restaurant_id"=>$array['restaurant_id'],"location_id"=>$array['location_id'],"strip_customer_id"=>$customer_strip_id,"created_time"=>date('Y-m-d H:i'),"last_4digit"=>$array['payment_data']['last4'],"brand"=>$array['payment_data']['brand']);
				
				$last_4digit=$array['payment_data']['last4'];
				$brand=$array['payment_data']['brand'];
				
				
				$customer_strip_id_array = $this->client_model->getCustomerStripId($check_data);
				//if($customer_strip_id_array[0])
				//{
				//	$customer_strip_id = $customer_strip_id_array[0]['strip_customer_id'];
				//}
				//else
				//{
				//	$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
				//	echo json_encode($result);
				//	exit;
				//}
				
				
					
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
				if(getLocationConfigValue('17',$array['location_id'],$array['restaurant_id'])!='')
					$sales_tax_percentage  =getLocationConfigValue('17',$array['location_id'],$array['restaurant_id']);
				else
					$sales_tax_percentage  =getConfigValue('sales_tax_percentage');
				$tax_amount = ($array['sub_total'] * $sales_tax_percentage)/100;
				$total = $total + $tax_amount;
				
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
				
				$retData=$this->stripe_lib->chargecustomer($owner_payment);		
				$response = serialize($retData);
				
			
			
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
					   "source_type"=>$source_type,
					   "delivery_time"=>date('Y-m-d H:i:s',strtotime($array['delivery_time']))
					  );
				//echo '<pre>';print_r($ordermaster);	  
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
				
				
				//echo '<pre>';print_r($cart_data);
				if(count($cart_data)!=0){
					for($j=0;$j<count($cart_data);$j++){ 
						
						if($cart_data[$j]['quantity'] && ($cart_data[$j]['quantity']!=0 && $cart_data[$j]['delete']!='Y')){
						
						$orderitems=array("order_id"=>$order_id,
								"item_id"=>$cart_data[$j]['item_id'],
								"unit_price"=>$cart_data[$j]['price'],
								"quantity"=>$cart_data[$j]['quantity'],
								"price"=>$cart_data[$j]['price']*$cart_data[$j]['quantity'],
								"instructions"=>$cart_data[$j]['specialIns'],
								"size"=>$cart_data[$j]['size']['size']
								);	
						
						$ord_item_id = $this->client_model->insert('fk_order_items',$orderitems);
						
										
						if(count($cart_data[$j]['optionsOLD'])!=0){
							for($i=0;$i<count($cart_data[$j]['optionsOLD']);$i++){ 
								$sides='';
								
								//remove er deleted sides
								 
								/*foreach($cart_data[$j]['sides'][$i] as $key=>$sides)
								{
								 if($cart_data[$j]['side_delete'][$i][$key] == 'Y'){
								 	unset($cart_data[$j]['side_name'][$i][$key]);
									unset($cart_data[$j]['side_price'][$i][$key]);
									}
								}*/
								$ar1=array();
								$ar2=array();
								$ar3=array();
								
								//$sides=array("sides"=>$cart_data[$j]['options']['sides'],"price"=>$cart_data[$j]['options']['side_price'][$i]);
								for($k=0;$k<count($cart_data[$j]['optionsOLD'][$i]['sides']);$k++){ 
									$ar1[]=$cart_data[$j]['optionsOLD'][$i]['sides'][$k]['sideitem'];
									$ar2[]=$cart_data[$j]['optionsOLD'][$i]['sides'][$k]['sidePrice'];
									$ar3[]=$cart_data[$j]['optionsOLD'][$i]['sides'][$k]['sideid'];
									
								}
								
								//$dataarr['sides']=$ar1;
								//$dataarr['price']=$ar2;
								$sides=array("sides"=>$ar1,"price"=>$ar2,"sideid"=>$ar3);
								//print_r($sides);
								$sides= serialize($sides);
								$orderoptionmap = array("order_id"=>$order_id,
														"ord_item_id"=>$ord_item_id,
														"sortorder"=>$cart_data[$j]['optionsOLD'][$i]['sortorder'],
														"options"=>$cart_data[$j]['optionsOLD'][$i]['optTitle'],
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
				
					$array['delivery_address']['zipcode'] = $array['delivery_address']['zip'];
					$array['delivery_address']['order_id'] = $order_id;
					$array['delivery_address']['created_date'] = date('Y-m-d H:i:s');
					
					//$array['delivery']['zipcode'] = $array['delivery_address']['zip'];
					//$array['delivery']['order_id'] = $order_id;
					//$array['delivery']['created_date'] = date('Y-m-d H:i:s');
					$new_array=array(
								"zipcode"=>$array['delivery_address']['zipcode'],
								"apartment"=>$array['delivery_address']['appartment'],
								"city"=>$array['delivery_address']['city'],
								"state"=>$array['delivery_address']['state'],
								"notes"=>$array['delivery_address']['instruction'],
								"address"=>$array['delivery_address']['address'],
								"order_id"=>$order_id,
								"phone"=>$array['phone'],
								"created_date"=>date('Y-m-d H:i:s')
								);
					
					//echo '<pre>';print_r($new_array);exit;
					//$data['delevery_details']=$new_array;
					$address_id = $this->client_model->insert('fk_delivery_address',$new_array);
				}
				
				$this->client_model->update('fk_member_master',array('phone'=>$array['phone']),array('member_id'=> $array['user_id']));

				
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
			
			$this->load->model('email_model');		
			$this->load->model('admin/order_model');		
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
						$sidesdetails[$var['ord_item_id']]   =$this->order_model->getDetailOptionNew($var['ord_item_id']);
						//echo '<pre>';print_r($sidesdetails);
					}
				}
			
			$data['sidesdetails']=$sidesdetails;
			$data['orderid']=$order_id;	
			$data['restaurant_id']=$array['restaurant_id'];
			
			
			
			$email	=	$data['orderdetails'][0]['email'];
			
			//echo '<pre>';print_r($data['delevery_details']);
			//echo '<pre>';print_r($data['orderdetails']);exit;
			//mail functionality
			$data['logo']=$resdetails['logo'];
			$data['restaurant_name']=$data['orderdetails'][0]['restaurant_name'];
			$data['subject']="Thank you for your order from ".$data['restaurant_name'];
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <info@forkourse.com>'. "\r\n";
			$message = $this->load->view('email/accept_order_new', $data, TRUE);
			mail($email,$data['subject'], $message, $headers);
			
			
				$sendPush = $this->sendPush($array['location_id']);			
				
				$result = array('status' => 'success','order_id'=>$order_id,'message' => $this->config->item('saveOrder'));
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}
			
			
			
			
			echo json_encode($result );
			//echo '<pre>';print_r($sides);echo'<pre>';exit;		 

		}
	public function createStripcustomer($data)		{
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
					'description'=>"customer for ".$profile_details['email'],
					'email'=>$profile_details['email'],
					'source' => $data['token']
				);
				
				$customer = $this->stripe_lib->createcustomer($admin_args);
				$customer_id = $customer->id;
				
				$arr=array("member_id"=>$data['member_id'],"restaurant_id"=>$data['restaurant_id'],"location_id"=>$data['location_id'],"stripe_ct_id"=>$customer_id,
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
				//$response = $this->client_model->get_where('fk_delivery_address',array('member_id' => $array['er_data']['member_id']), 'member_id ASC');
				
				$insert_id = $this->client_model->insert('fk_favourite_category',$array);
				$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('addFavourite'));
				
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
		echo json_encode($result);
				
	}
	public function getFavouriteList()	{
			
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
			
			//echo '<pre>';print_r($array);echo'<pre>';exit;
			if($data!=''){
				
				$orderList = $this->client_model->getAllOders($array['member_id'],$array['offset']);
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
				
				$orderList = $this->client_model->getAllOders($array['member_id'],$array['offset'],$array['order_id']);//$this->client_model->get_where('fk_order_master',array('order_id' => $array['order_id']), 'order_id ASC');
				$orderList = $orderList[0];
				
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
	public function getProfileDetails()	{
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

          
            $array['er_data']['profile_image'] = $image;
        	$arr['member_id'] =  $er[1];
        	$this->client_model->update('fk_member_master', $array['er_data'],array('member_id'=> $arr['member_id']));

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

        $array['er_data']['profile_image'] = $arr['file_name'];
        $this->client_model->update('fk_member_master', $array['er_data'],array('member_id'=> $arr['member_id']));
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
		public function checkDeliveryAddress(){
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);
			if($data){	
			
			$address = $data['address'];
			
			
			//$result = array('status'=>'success','message'=>'Valid Address');
			//$result = array('status'=>'invalid','message'=> $this->config->item('invalidAddress'));
			//echo json_encode($result);
			//exit;
			
			//echo 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address).'&sensor=true';exit;
			$coordinates =file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address).'&sensor=true');
			//$coordinates =file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key='.$this->config->item('google_api_key').'&sensor=true');
			$coordinates = json_decode($coordinates);
		
			if($coordinates->status =="OK"){
			
				$lat=$coordinates->results[0]->geometry->location->lat;
				$long=$coordinates->results[0]->geometry->location->lng;
				if($lat!='' && $long!='')
				{
					$resp = $this->client_model->getRestaurantDetails($data['location_id']);
					
					if($resp['latitude']!='' && $resp['longitude']!='')
					{	
							if(getLocationConfigValue('14',$data['location_id'],$data['restaurant_id'])!='')
								$radi  =getLocationConfigValue('14',$data['location_id'],$data['restaurant_id']);
							else
								$radi = getConfigValue('max_delivery_radi');
					
						$distance = $this->distance($lat, $long, floatval($resp['latitude']),floatval($resp['longitude']), "M");
						
						if($distance <= $radi)
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
		public function checkFbLogin(){
		
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);
			
			$data["auth_id !="] = '';
			
			$response = $this->client_model->get_where('fk_member_master', $data, 'member_id ASC');
			
			echo json_encode($response);
		
		}
		public function checkFber(){
		
			
			
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
		public function forgotPassword(){
		
			$this->load->model('client_model');
		
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			
		
			
			$erDetails = $this->client_model->get_where('fk_member_master', array('email' => $data['email']),'member_id ASC');
			
			if(empty($erDetails)){
				$rs['status'] ="error";
				$rs['message'] = "Incorrect Email";
			}else if($erDetails->auth_type!='facebook'){
		
				$this->load->model('email_model');
				
				$new_password 	= 	$this->client_model->randomPassword(); # generate random password
				$update_array['password'] = $new_password;
				$update_array['member_id'] = $erDetails['member_id'];
				$erDetails = $this->client_model->updateUser($update_array);
				
				$email = $this->email_model->get_email_template('forgot_password');
				
                $this->load->library('encrypt');
                $eremail 	 = $erDetails->email;
                $fstname = $erDetails->first_name;
                $lstname = $erDetails->last_name;
				$passwd = $erDetails->password;
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
						
				@mail($eremail, $subject, $message, $headers);
				$rs['status'] ="success";			
				$rs['message'] = 'Check your registered email';
				
			}
			else
			{
				$rs['status'] ="error";
				$rs['message'] = "Incorrect er";
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
			
				$this->client_model->removeCartDetail(array('member_id'=>$data['member_id']));
				
			}else
			{
			 $check_res = $this->client_model->checkCartResId($data['member_id']);
			}
			
			if(empty($check_res) || $check_res['restaurant_id'] == $data['res_id']){
			
			$check_array = array('item_size'=>$data['map_id'],'item_id'=>$data['id'],'member_id'=>$data['member_id']);
			
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
				
				$insert_array = array('member_id'=>$data['member_id'],'item_id'=>$data['id'],'item_size'=>$data['map_id'],'quantity'=>$data['qty'],'restaurant_id'=>$data['res_id']);
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
			if($data['member_id']){
			
				$check_array = array('member_id'=>$data['member_id']);
			    $cart_qty= $this->client_model->getCartQty($check_array);
				echo json_encode($cart_qty);
			}
		}
		public function getCartDetails(){
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['member_id']){
			
				$check_array = array('member_id'=>$data['member_id']);
				
				$this->client_model->deleteInactiveItems($check_array);//remove inactive products
				
			    $cart_details= $this->client_model->getCartDetails($check_array);
				$cart_total = $this->client_model->getCartTotal($check_array);
				echo json_encode(array('details'=>$cart_details,'total'=>$cart_total));
			}
		}
		public function removeCartItem(){
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['member_id']){
			
				$this->client_model->removeCartDetail(array('member_id'=>$data['member_id'],'cart_id'=>$data['cart_id']));
			}
		}
		public function insertOrderDetails(){
			$data 	= 	 file_get_contents("php://input");
			$data 	=	 json_decode($data, true);
			if($data['member_id']){
			
				$check_array = array('member_id'=>$data['member_id']);
				
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
									  'member_id'=>$data['member_id'],
									   'created_time'=>$date_time,
									   'total_amount'=>$total_amount,
									   'restaurant_id'=>$cart_details[0]['restaurant_id']);
									   
				$delete_order_id = $this->client_model->getPendingOrder($data['member_id']);
				
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
					
					$this->client_model->updateCartDetail(array('order_id'=>$order_id),array('member_id'=>$data['member_id']));
					
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
			if($data['member_id']){
				
			  $pending_order_id = $this->client_model->getFinalOrder($data['member_id'],$data['order_ref_id']);
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
		public function getResturantTime(){	
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
		public function checkPromocode(){	
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
				elseif($promocode_array['es_per_coupon'] && $promocode_array['es_per_coupon'] <= $promocode_array['total_es']){
				
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
		public function getStripDetails(){	
			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);	
			//pk_test_E8w4Y4sEFLSf9WD4wGNnMYeS
			//sk_test_lRwyKV3qQJfMp8PMA8c3tm
			
			$stripe = $this->client_model->getOwnerStripDetails($data);
			
			$customer_strip_id_array = $this->client_model->getcustomerStripId($data);
			if($customer_strip_id_array[0])
			{
				$customer_strip_id = $customer_strip_id_array[0]['stripe_ct_id'];
			}
			$result = array('status'=>'success','stripe_public_key' =>$stripe['stripe_public_key'],'customer_strip_id'=>$customer_strip_id);
			
			//$result = array('status'=>'error','message' => $this->config->item('invalidStripAccount'));
			echo json_encode($result);
		
		}
		public function getNewDeliveryTime(){
			
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
		
//------------------------------------------------------------for website order 

	function FbLoginWeb(){
			
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
		$name=explode(' ',$array['name']);			 
		$profile_image="http://graph.facebook.com/".$array['auth_id']."/picture?width=150&height=120";
		$created_date = date('Y-m-d H:i:s');
		$user_data	=	array(
						"email"=>$array['email'],
						"restaurant_id"=>$array['restaurant_id'],
						"auth_id"=>$array['auth_id'],
						"auth_type"=>'facebook',
						"first_name"=>$name[0],
						"last_name"=>$name[1],
						"profile_image"=>$profile_image,
						"created_date"=>$created_date
						);
		if($array['email']!='' and $array['restaurant_id']!=''){
			$response = $this->client_model->get_where('fk_member_master',$condition, 'member_id ASC');
			if(empty($response))
			{
				$insert_id = $this->client_model->insert('fk_member_master',$user_data);
				$result = array('status' => 'success','member_id'=>$insert_id,'message' => $this->config->item('UserInserted'),'type' =>'3');
				//$result = array('status' => 'success', 'message' => $this->config->item('loginsuccess') , 'type' =>'3');
			}
			else if($response['auth_type']=='general')
			{
				$this->client_model->update('fk_member_master', $user_data,array('email'=> $array['email']));
				$result = array('status' => 'success','member_id'=>$response['member_id'],'message' => $this->config->item('loginsuccess'), 'type' =>'2');
			}
			else
			{
				$this->client_model->update('fk_member_master', $user_data,array('email'=> $array['email']));
				$result = array('status' => 'success','member_id'=>$response['member_id'],'message' => $this->config->item('loginsuccess'), 'type' =>'1');
			}
		}else{
			$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
		}
			
		echo json_encode($result);
		
	}

	public function loginWeb(){
			
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
						$result = array('status' => 'error','message' => $this->config->item('UserBlocked'));
					}
					else{
						$member_id = $userDetails['member_id'];
						$result = array('status' => 'success','member_id'=>$member_id,'first_name'=>$userDetails['first_name'],'message' => $this->config->item('loginsuccess'));
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
		public function gerRestaurantTimings(){
				$data 	= 	 file_get_contents("php://input");
				$data 	=	 json_decode($data, true);
				$day	='';
				
				
				
				//exit;
				
				switch($data['day']){
					case 'Mon':$day	= $today= 'Monday';$dayKey = 1; break;
					case 'Tue':$day	= $today= 'Tuesday';$dayKey = 2; break;
					case 'Wed':$day	= $today= 'Wednesday';$dayKey = 3; break;
					case 'Thu':$day	= $today= 'Thursday';$dayKey = 4; break;
					case 'Fri':$day	= $today= 'Friday';$dayKey = 5; break;
					case 'Sat':$day	= $today= 'Saturday';$dayKey = 6; break;
					case 'Sun':$day	= $today= 'Sunday';$dayKey = 0; break;
					default:break;
				}
				
				$curDay=date('D');
				if($curDay==$data['day']){
					$flag=1;
					$today = 'Today';
				}else{
					$flag=0;
				}
				 
					
				$result['res'] = $this->client_model->get_where('fk_restaurant_opening_times',array('location_id' => $data['location_id'],'day'=>$day),'map_id');
				//echo $this->db->last_query(); 
				$startAt	=	$result['res']['start_at'];
				$endsAt		=	$result['res']['end_at'];
				$date = date('h:i a', strtotime($result['res']['start_at'].'+ 30 minutes') );
				
				$start	= explode(':',$result['res']['start_at']);
				$end	= explode(':',$result['res']['end_at']);
				
				//echo "<pre>";print_r($result);
				//echo "<pre>";print_r($end);
				//echo date('H:i');
			
				//date_default_timezone_set('Asia/Kolkata');
			$server_timezone = date_default_timezone_get();
			$curTime = $this->timeConvert($server_timezone,"America/New_York",date('H:i'),'H:i');	
			$OrgTime = $this->timeConvert($server_timezone,"America/New_York",date('H:i:s'),'H:i:s');	
			//$curTime= date('H:i');
			
			//echo $startAt;	//08:00:00 < 4:38:34 and 21:00:00 > 4:38:34
			//echo $endsAt;	//21:00:00
			//echo $OrgTime;	//4:38:34

			$resp['timings'] = $this->client_model->getRestaurantTimeDetails($data['location_id']);

				
			if($OrgTime >=  $startAt and $OrgTime <=  $endsAt){
				$curTime=$OrgTime;
			}else if($OrgTime <  $startAt){
				$curTime=$startAt;
			}else if($OrgTime >  $endsAt){
				$curTime='next day start';
				//$endsAt= $this->nextWorkindDay($dayKey,$resp['timings']);
				//print_r($endsAt);
				//$curTime=$endsAt['start_at'];
			}
			
		
		
			//exit;
			$val = array();
			$j=0;
			
			
			if($flag==1){
				$curTime=explode(':',$curTime);
				$start[0]=$curTime[0];
				if($curTime[1]>30){
					$start[1]=00;
					$start[0]=$curTime[0]+1;
				}else{
					$start[0]=$curTime[0];
					$start[1]=30;
				}
			}
			//echo '<pre>';print_r($start);
			//echo '<pre>';print_r($end);
			
			
			
			
			
			
			
						
			for($i=$start[0];$i<= $end[0];$i=$i+0.25){
				if($i==$start[0]){
					if($start[1]==30){
						$i = $i+0.50;
					}
				}
				$whole = floor($i).':00';      
				$fraction = $i - $whole;
				if($fraction == 0.25){
					$valstart =	date('h:i a', strtotime($whole.'+ 15 minutes') );
					$val[$j]['start'] = ltrim($valstart, '0');
				}else if($fraction == 0.50){
					$valstart = date('h:i a', strtotime($whole.'+ 30 minutes') );
					$val[$j]['start'] = ltrim($valstart, '0');
				}else if($fraction == 0.75){
					$valstart = date('h:i a', strtotime($whole.'+ 45 minutes') );
					$val[$j]['start'] = ltrim($valstart, '0');
				}else{
					$valstart= date('h:i a', strtotime($whole) );
					$val[$j]['start'] = ltrim($valstart, '0');
				}
				$j++;
				
		
			}
			if($end[1]==30){
				$i = $i+0.25;
				$whole = floor($i).':00';      
				$fraction = $i - $whole;
				if($fraction == 0.25){
					$valstart =	date('h:i a', strtotime($whole.'+ 15 minutes') );
					$val[$j]['start'] = ltrim($valstart, '0');
				}else if($fraction == 0.50){
					$valstart = date('h:i a', strtotime($whole.'+ 30 minutes') );
					$val[$j]['start'] = ltrim($valstart, '0');
				}else if($fraction == 0.75){
					$valstart = date('h:i a', strtotime($whole.'+ 45 minutes') );
					$val[$j]['start'] = ltrim($valstart, '0');
				}else{
					$valstart= date('h:i a', strtotime($whole) );
					$val[$j]['start'] = ltrim($valstart, '0');
				}
			}
			
			
			$result['result']['time']=$val;
			$result['day']=$day;
			$result['today']=$today;
			$result['startAt']=$startAt;
			$result['endsAt']=$endsAt;
			if($result['startAt']==''){
				$result['result']['time']='';
			}



				
				if(count($result['result'])!=0)
					$result['status']='success';
				else
					$result['status']='error';
					
				echo json_encode($result);
		}
	public function getAllDetails()	{
				$testVar=$_GET['test'];
				if($testVar==1)
					$data=$_GET['data'];
				else
				$data 	= 	 file_get_contents("php://input");
				
				$data 	=	 json_decode($data, true);
				if($data)
				{
					$stripe = $this->client_model->getOwnerStripDetails($data);
					$customer_strip_id_array = $this->client_model->getCustomerStripId($data);
					if($customer_strip_id_array[0])
					{
						$customer_strip_id = $customer_strip_id_array[0]['stripe_cust_id'];
					}
					
					$profile_details = $this->client_model->get_where('fk_member_master',array('member_id' => $data['member_id']),'member_id');
					
					$tax	=	$this->client_model->getSalesTaxRestaurant($data['restaurant_id']);
					$result = array('status' => 'success','profile_details' => $profile_details,'stripe_public_key' =>$stripe['stripe_public_key'],'customer_strip_id'=>$customer_strip_id,'salesTax'=>$tax['value']);
					//echo '<pre>';print_r($datas);
				
				}
				else
				{
					$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
				}
				echo json_encode($result);
				
	
	}
	public function getResDetails(){
		if($testVar==1)
			$data=$_GET['data'];
		else
			$data 	= 	 file_get_contents("php://input");
			
		$data 	=	 json_decode($data, true);
		
		$res = $this->client_model->get_where('fk_restaurant_locations',array('location_id' => $data['location_id']),'location_id');
		$result = array('status' => 'success','result' => $res);
		echo json_encode($result);
	}
	public function getTaxDetails()	{
				$testVar=$_GET['test'];
				if($testVar==1)
					$data=$_GET['data'];
				else
				$data 	= 	 file_get_contents("php://input");
				
				$data 	=	 json_decode($data, true);
				if($data)
				{
					
					$tax	=	$this->client_model->getSalesTaxRestaurant($data['restaurant_id']);
					
					$min_delivery_amount =(getLocationConfigValue('22',$data['location_id'],$data['restaurant_id']))? getLocationConfigValue('22',$data['location_id'],$data['restaurant_id']) :getConfigValue('min_delivery_amount');
					
					$delivery_charge =(getLocationConfigValue('23',$data['location_id'],$data['restaurant_id']))? getLocationConfigValue('23',$data['location_id'],$data['restaurant_id']) :getConfigValue('delivery_charge');
					
					$minimum_delivery_time =(getLocationConfigValue('15',$data['location_id'],$data['restaurant_id']))? getLocationConfigValue('15',$data['location_id'],$data['restaurant_id']) :getConfigValue('minimum_delivery_time');
					
					$is_delivery_taxable =(getLocationConfigValue('24',$data['location_id'],$data['restaurant_id']))? getLocationConfigValue('24',$data['location_id'],$data['restaurant_id']) :getConfigValue('is_delivery_taxable');
					
					$result = array('status' => 'success','salesTax'=>$tax['value'],'min_delivery_amount'=>$min_delivery_amount,'delivery_charge'=>$delivery_charge,'minimum_delivery_time'=>$minimum_delivery_time,'is_delivery_taxable'=>$is_delivery_taxable);
					
					
					//echo '<pre>';print_r($datas);
					
				}
				else
				{
					$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
				}
				echo json_encode($result);
				
	
	}	
	public function getResTime(){

			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);	
		 	$server_timezone = date_default_timezone_get();
			
			$today_time = $this->timeConvert($server_timezone,"America/New_York",date('Y-m-d H:i'),'Y-m-d H:i');
			
			$dt=explode(' ',$today_time);
			$today_date = $dt[0];
			$today_time = $dt[1]; 
			$today_am =  date('a',$today_time );

				$minimum_pick_up_time =
						(getLocationConfigValue('16',$data['location_id'],$data['restaurant_id']))? getLocationConfigValue('16',$data['location_id'],$data['restaurant_id']) :getConfigValue('minimum_pick_up_time');
				
				$minimum_delivery_time =
						(getLocationConfigValue('15',$data['location_id'],$data['restaurant_id']))? getLocationConfigValue('15',$data['location_id'],$data['restaurant_id']) :getConfigValue('minimum_delivery_time');


			if($data['type']=='PickUP'){
				$newInt=$minimum_pick_up_time*60;
			}else{
				$newInt=$minimum_delivery_time*60;
			}
			$t=strtotime($today_time)+$newInt;
	
			//to calculate time added by 15 miutes
			$interval=15*60;
			$last = $t - $t % $interval;
			$next = $last + $interval ;
			$org_time =strftime('%H:%M:%S', $next);
			$updated_time =strftime('%l:%M', $next);
			$updated_time = ltrim($updated_time, '0');
			$today_am =  date('a',strtotime($org_time));
			//for check res open or closed
				switch($data['day']){
					case 'Mon':$day	= 'monday';$dayKey = 1; break;
					case 'Tue':$day	= 'tuesday';$dayKey = 2; break;
					case 'Wed':$day	= 'wednesday';$dayKey = 3; break;
					case 'Thu':$day	= 'thursday';$dayKey = 4; break;
					case 'Fri':$day	= 'friday';$dayKey = 5; break;
					case 'Sat':$day	= 'saturday';$dayKey = 6; break;
					case 'Sun':$day	= 'sunday';$dayKey = 0; break;
					default:break;
				}
				
				$curDay=date('D');
				if($curDay==$data['day']){
					$today = 'Today';
				}
				//$result['today']=$today;
					
				$result['res'] = $this->client_model->get_where('fk_restaurant_opening_times',array('location_id' => $data['location_id'],'day'=>$day),'map_id');
				
				$startAt	=	$result['res']['start_at'];
				$endsAt		=	$result['res']['end_at'];
				$resp['timings'] = $this->client_model->getRestaurantTimeDetails($data['location_id']);
			
			
			if($startAt <=$org_time and $endsAt >=$org_time){
				$res_status="open";
				$today_time=$updated_time;
				$nextDay='Today';
			}else{
				$res_status="closed";
				if($org_time < $startAt){
					$t1=strtotime($startAt);
					$updated_time =strftime('%l:%M', $t1);	
					$today_am =  date('a',strtotime($startAt));
					//$updated_time =date('h:m', $updated_time);
					//$updated_time;
					//$updated_time=date('h:m',strtotime($updated_time));
					$updated_time = ltrim($updated_time, '0');
					$updated_time=' '.$updated_time;
					$nextDay='Today';

				}else if($org_time  >  $endsAt ){
					//$updated_time=$endsAt;
					$endsAt= $this->nextWorkindDay($dayKey,$resp['timings']);
					// echo '<pre>';print_r($endsAt);
					$t2=strtotime($endsAt['start_at']);
					$updated_time =strftime('%l:%M', $t2);
					$today_am =  date('a',strtotime($endsAt['start_at']));
					$updated_time = ltrim($updated_time, '0');
					//$updated_time=$endsAt['day'].' '.$updated_time;
					$nextDay=$endsAt['day'];
					$updated_time=$updated_time;
				}
			}
			
			
			//echo '<pre>';print_r($resp);
			
			$result = array('time'=>strtotime($today_time),'res_status'=>$res_status,'today_date'=>$today_date,'today_time'=>$updated_time,'today_am'=>$today_am,'status'=>'success','today'=>$today,'nextDay'=>ucfirst($nextDay));
			echo json_encode($result);
	}
	
public function nextWorkindDay($dayKey,$resp){
			if($dayKey==6)
				$dayKey=0;
			else
				$dayKey++;
			
			
			for($i=0;$i<7;$i++){
			
				if($resp[$dayKey]['start_at']==''){
					if($dayKey==6)
						$dayKey=0;
					else
						$dayKey++;
				}else{
					return $resp[$dayKey];
					break;
				}
			}
		
		exit;
	}

	
	public function webForgot(){
		$data 	= 	 file_get_contents("php://input");
	    $array 	=	 json_decode($data, true);
		$email_id		= $array['email']; 
		//$data       = $this->admin_model->getpassword($email_id);
		$response = $this->client_model->get_where('fk_member_master',array("email"=>$email_id), 'member_id ASC');
		$new_password 	= 	$this->client_model->randomPassword(); 
		$resultData = $this->client_model->update('fk_member_master',array('verify_code'=>$new_password),array('email'=> $email_id));
		
		
		
		$this->load->model('email_model');
		
		
		if(count($array)>0)
		{
			$email = $this->email_model->get_email_template('forgot_password_web');
						
			$this->load->library('encrypt');
			$full_name = $data['full_name'];
			$target_name = $this->config->item('site_name');
			//$link =base_url().'weborder_des/#/verifyPassword/';
			$link =base_url().'weborder/#/verifyPassword/'.$email_id.'/'.$new_password;
			
			
			
			$subject = $email['email_subject'];
			$message  = $email['email_template'];        
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html; charset=utf-8" . "\r\n";			
			$headers .= 'From: '.$this->config->item('email_from'). "\r\n";
					
			$message  = $email['email_template'];                          
			//$message  = str_replace('#FULL_NAME#',$full_name,$message);	
			$message  = str_replace('#LINK#',$link,$message);
			$message  = str_replace('#PASSWORD_CODE#',$new_password,$message);
		
			if (@mail($email_id, $subject, $message, $headers))
			{
				$result = array('status' => 'success','message' => "success");
			}
			else
				$result = array('status' => 'error','message' => "There is error in sending mail!");
				
		}else{
			$result = array('status' => 'error','message' => "Please enter valid email id!");
		}
		echo json_encode($result);		
	}
	public function getUserDetails(){
		$data 			= 	 file_get_contents("php://input");
	    $array 			=	 json_decode($data, true);
		$email			=	 $array['verEmail']; 
		$password		=	 $array['verpassword']; 
		$verify_code	=	 $array['vercode']; 
		//$response = $this->client_model->get_where('fk_member_master',array("email"=>$email,"verify_code"=>$verify_code), 'member_id ASC');
		$response = $this->client_model->get_where('fk_member_master',array("email"=>$email), 'member_id ASC');
		
		if(count($response)!=0){
			if($response['verify_code']==$verify_code){
				$resultData = $this->client_model->update('fk_member_master',array('password'=>$password,'verify_code'=>''),array('email'=> $email));
				$result = array('status' => 'success','message' => "Password reset successfully.");
			}else{
				$result = array('status' => 'error','message' => "Password reset code invalid.");
			}
		}else{
			$result = array('status' => 'error','message' => "Account does not exist.");
		}
		echo json_encode($result);		
	}
	public function signUpWeborder(){

			$testVar=$_GET['test'];
			if($testVar==1)
				$data=$_GET['data'];
			else
				$data 	= 	 file_get_contents("php://input");
			
			$array 	=	 json_decode($data, true);
			
			
			$dataArray=array('auth_type'=>'general',
							 'first_name'=>$array['firstname'],
							 'last_name'=>$array['lastname'],
							 'password'=>$array['password'],
							 'email'=> $array['email'],
							 'created_date'=>date('Y-m-d H:i:s'),
							 'restaurant_id'=>$array['restaurant_id']
							);
	
	
			if($data!=''){
				$response = $this->client_model->get_where('fk_member_master',array('email' => $array['email']), 'member_id ASC');
				if(count($response)){
					$result = array('status' => 'error','message' => $this->config->item('UserExist'));
				}else{		
					$insert_id = $this->client_model->insert('fk_member_master',$dataArray);
					$userDetails = $this->client_model->get_where('fk_member_master',array('member_id' => $insert_id), 'member_id ASC');
					//$result = array('status' => 'success','member_id'=>$insert_id,'message' =>"Registered succssfully");
					$result = array('status' => 'success','member_id'=>$insert_id,'first_name'=>$userDetails['first_name'],'message' => "Registered succssfully");
				}
			}else{
				$result = array('status' => 'error','message' => $this->config->item('invalidRequest'));
			}		
			echo json_encode($result);
				
	}		

		
}