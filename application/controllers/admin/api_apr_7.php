<?php 

class api extends MY_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('admin/order_model');
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

		public function getStripDetails()
		{	
			$data 	= 	 file_get_contents("php://input");
			
			$data 	=	 json_decode($data, true);	
			$result = array('status'=>'success','stripe_public_key' =>$stripe['stripe_public_key'],'last_4digit'=>$last_4digit );
			echo json_encode($result);
		
		}
		public function login($data='')
		{
			if(!isset($data['user_name'])){
				$data 	= 	 file_get_contents("php://input");
				$data 	=	 json_decode($data, true);
			}
			
			$response = $this->api_model->getUser_detail($data['user_name'],$data['password']);
			if(isset($response['admin_id']))
			{
				 if($response['status']=='Y')
				 {
				 	 $this->updateDeviceToken($data,$response['location_id']);
					 $message='login successfully';
					 $status='true';
				 }
				 else
				 {
					 $message='User is deactivated';
					 $status='false';
				 }
			}else{
				 $message='Invalid username or password';
				 $status='false';
			}
			$result = array('status'=>$status,'message' =>$message,'data'=>$response );
			echo json_encode($result);
		}
		
		public function updateDeviceToken($array,$location_id)
		{
			if($array['deviceToken'])
			{
				$this->db->where(array('location_id'=>$location_id));
				$this->db->update('fk_restaurant_locations',array('device_id'=>$array['deviceId'],'device_platform'=>$array['devicePlatform'],'device_token'=>$array['deviceToken']));
			}
		}	

	    public function forgotPassword($data='')
		{
			if(!isset($data['email'])){
				$data 	= 	 file_get_contents("php://input");
				$data 	=	 json_decode($data, true);
			}
			#############
			$email_id		= $data['email']; 
			$data       = $this->api_model->getpassword($email_id);
			$new_password 	= 	$this->api_model->randomPassword(); 
			$this->load->model('email_model');
			$this->load->helper('cookie');
		
			//echo (count($data));
			if(count($data)>0)
			{
			$email = $this->email_model->get_email_template('forgot_password_admins');
						
			$this->load->library('encrypt');
			$full_name = $data['full_name'];
			$target_name = $this->config->item('site_name');
			$link =base_url().'admin/login/reset_password/'.$new_password.'/?sess='.md5($email_id);
			 
			$subject = $email['email_subject'];
			$message  = $email['email_template'];        
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html; charset=utf-8" . "\r\n";			
			$headers .= 'From: '.$this->config->item('email_from'). "\r\n";
					
			$message  = $email['email_template'];                          
			$message  = str_replace('%FULL_NAME%',$full_name,$message);	
			$message  = str_replace('%LINK%',$link,$message);
			$message  = str_replace('%SITE_NAME%',$target_name,$message);
		
			if (@mail($email_id, $subject, $message, $headers))
			{
			   $message= "success";
			   $status='true';
				$update_array = array('password_reset_key'=>$new_password,'password_reset_time'=>date('Y-m-d H:i:s'));
				$this->db->where('email',$email_id);
				$this->db->update('fk_member_admins',$update_array);
				
			}
			 else
			 {
			   $status='false';
			   $message= "There is error in sending mail!";
			 }
			}
		else{
			  $status='false';
			  $message="Please enter valid email id!";
			}
			$result = array('status'=>$status,'message' =>$message);
			echo json_encode($result);
				#############
   }
	public function orderListing($arr='')
	{
	
	
		//$data 	= 	 file_get_contents("php://input");
		//$arr 	=	 json_decode($data, true);
		
	    if(!isset($arr['restaurant_id'])){
			$arr 	= 	 file_get_contents("php://input");
			$arr 	=	 json_decode($arr, true);
		}
		
		//print_r($arr);
		#####################################################
		$restaurant_id=$arr['restaurant_id'];
		$location_id=$arr['location_id'];
		
		$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,3);
		
		$total_rows = $this->api_model->countNewOrders($restaurant_id,$location_id,3);
		$datetimeformat = getConfigValue('time_format').' '.getConfigValue('date_format');
		//$timeformat = getConfigValue('time_format');
		$data['orderdetails']	=$this->api_model->getOrderDetails($restaurant_id,$location_id,3);
		//echo '<pre>';print_r($data['orderdetails']);exit;		
		
		if(count($data['orderdetails'])!=0){
           	$kk=0;
			foreach($data['orderdetails'] as $order){
				$this->order_model->setTable('fk_restaurant_locations');	
				$row = $this->order_model->get_by('location_id',$location_id);	
				$created_time=$this->ConvertToViewTimezone($row->timezone,$order['created_time']);
				//$delivery_time=$this->ConvertToViewTimezone($row->timezone,$order['delivery_time']);
				$data['orderdetails'][$kk]['created_time']=date('g:i a m/j/Y',strtotime($created_time));
				$data['orderdetails'][$kk]['delivery_time']=date('g:i a m/j/Y',strtotime($order['delivery_time']));
				//$order['created_time']=strtotime($created_time);
				//$data['orderdetails'][$kk]['created_time']=$order['created_time'];
				//$data['orderdetails'][$kk]['delivery_time']=$order['delivery_time'];
				$kk++;
			}
		}
       //echo '<pre>';print_r($data);exit;		     
     $result = array('status'=>'success','data' =>$data);
	 echo json_encode($result);
	 exit;	
	//echo $this->load->view('admin/orders/stocks','',true);
			
	
		#####################################################
	}	
	
	public function orderDetail($arr='')
	{
	
		//$arr=array("restaurant_id"=>"6","location_id"=>"13","order_id"=>"52");
	
	   if(!isset($arr['order_id'])){
		$arr 	= 	 file_get_contents("php://input");
		$arr 	=	 json_decode($arr, true);
		}
	#########################################################
	
			$order_id=$arr['order_id'];
			$restaurant_id=$arr['restaurant_id'];
			$location_id=$arr['location_id'];
			$data['usertype']=$user->root;
			$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,3);
			
			$data['orderdetails']=$this->api_model->getDetailOrder($order_id);
			//echo '<pre>';print_r($data['orderdetails']);exit;
			
			
			$data['orderdetails'][0]['delivery_time']	=	$this->getTime($data['orderdetails'][0]['delivery_time']);
			
			if($data['orderdetails'][0]['tip']==''){
				$data['orderdetails'][0]['tip']=0;
			}
			if($data['orderdetails'][0]['discount_amount']==''){
				$data['orderdetails'][0]['discount_amount']=0;
			}
			if($data['orderdetails'][0]['tax_amount']==''){
				$data['orderdetails'][0]['tax_amount']=0;
			}
			
			
			
			$data['itemdetails']=$this->api_model->getDetailItem($order_id);
			$payment_details = $this->api_model->getOrderStripMap($order_id);
			
			foreach($payment_details as $payment)
			{
				if($payment['payment_mode']=='fund')
					$data['payment_details']['fund'] = $payment;
					
				else if($payment['payment_mode']=='refund')
					$data['payment_details']['refund'] = $payment;
			}
			$newsidear=array();
			//$data['optiondetails']=$this->order_model->getDetailOption($order_id);
			if(count($data['itemdetails']!='')){
					foreach($data['itemdetails'] as $var){
						//$sidesdetails[$var['ord_item_id']]   =$this->api_model->getDetailOption($var['ord_item_id']);
						$sidesdetail   =$this->api_model->getDetailOption($var['ord_item_id']);
						//echo '<pre>';print_r($sidesdetail);
						$i=0;
						foreach($sidesdetail as $valu){
							$sidesdetails[$var['ord_item_id']][$i]['id']=$valu['id'];
							$sidesdetails[$var['ord_item_id']][$i]['ord_item_id']=$valu['ord_item_id'];
							$sidesdetails[$var['ord_item_id']][$i]['order_id']=$valu['order_id'];
							$sidesdetails[$var['ord_item_id']][$i]['options']=$valu['options'];
							$sidesdetails[$var['ord_item_id']][$i]['sortorder']=$valu['sortorder'];
							//$sidesdetails[$var['ord_item_id']][$i]['sides']=unserialize($valu['sides']);
							$sidesdata=unserialize($valu['sides']);
							//echo '<pre>';print_r($sidesdata);
							$newsidear=array();
							foreach($sidesdata as $key => $values){
								//echo $key;
								$kk=0;
								
								foreach($values as $variab){
									//echo '<pre>';print_r($variab);
									$newsidear[$kk][$key]=$variab;
									$kk++;
								}
							
							}
							//echo '<pre>';print_r($newsidear);
							$sidesdetails[$var['ord_item_id']][$i]['sides']=$newsidear;
							$i++;
						}
						
						//$sidesdetails[$var['ord_item_id']]
						
					}
				}
				//exit;	
			//echo '<pre>';print_r($sidesdetails);exit;	
			
			$data['sidesdetails']=$sidesdetails;
			$data['orderid']=$order_id;
			$result = array('status'=>"success",'data' =>$data);
	        echo json_encode($result);
			
		
		
	
	#########################################################	
		
	}
	public function getTime($deliveryTime){
		date_default_timezone_set('America/New_York');

		$deldate=explode(' ',$deliveryTime);
		
		
				$newdata="";
				
				$retval ='';
                $granularity=1;
               	$date = strtotime($deliveryTime);
				
				
               	$difference = $date -  time();
                $periods = array('decade' => 315360000,
                'year' => 31536000,
                'month' => 2628000,
                'week' => 604800,
                'day' => 86400,
                'hour' => 3600,
                'minute' => 60,
                'second' => 1);
				if ($difference < 5) { 
					$retval_time = "just now";
                }else{
					foreach ($periods as $key => $value_date) {
						if ($difference >= $value_date) {
							$time = floor($difference/$value_date);
							$difference %= $value_date;
							$retval .= ($retval ? ' ' : '').$time.' ';
							$granularity--;
						}
						if ($granularity == '0') { break; }
					}
					$retval_time=$retval;
                }
				if($key=='day'){
					if(date('H:i A',strtotime($deldate[1]))=='00:00 AM'){
						$newdata.= '12:00 AM '.date('m-d-Y',strtotime($deliveryTime));
					}else{
						$newdata.=date('l g:i A',strtotime($deliveryTime));
					}
						
				}else if($key=='hour'){
					if(strtotime($deldate[0])==strtotime(date('Y-m-d'))){
						$newdata.= date('g:i A',strtotime($deldate[1]));
					}else{
						$newdtar=explode(':',$deldate[1]); 
						$newdata.= "Tomorrow ".date('g:i A',strtotime($deldate[1]));
					}
				}else if($key=='minute'){
					$newdata.= $retval.' Mins';
				}else if($key=='second'){
					$newdata.= 'Now';
				}else if($key=='week' || $key=='month' || $key=='year'){
					$newdata.= 'Future';
				}else{
					if($difference < 0)
						$newdata = "Late";
					else 
						$newdata.='Future';
				}
				return $newdata;
		}	
	
		
		public function ConvertToViewTimezone($user_time_zone,$newdate){
		   	//$user_time_zone= $this->session->userdata('timezone');
			
			$to_time_zone	 = 'Greenwich';
			//$to_time_zone	 = date_default_timezone_get();
			//$user_time_zone	= 'America/Mexico_City';
			$to_time_zone 	= ($to_time_zone)?$to_time_zone:date_default_timezone_get();
			$user_time_zone = ($user_time_zone)?$user_time_zone:date_default_timezone_get();
			if($user_time_zone){
				$schedule_date = new DateTime($newdate, new DateTimeZone($to_time_zone) );
				$schedule_date->setTimeZone(new DateTimeZone($user_time_zone));
				$returndate =  $schedule_date->format('Y-m-d H:i:s');
				
			}
			return $returndate;	
	   }	
	   public function refundOrderAmountForapp($order_id,$amount=0)
	   {	
	   		$this->load->library('stripe_lib');
			$data =	$this->order_model->getOrderStripMap($order_id);
	
			
			if(sizeof($data)!=0){
			
				$check_data = array('location_id'=>$data[0]['location_id'],'restaurant_id'=>$data[0]['restaurant_id']);
					
				$stripe = $this->order_model->getOwnerStripDetails($check_data);
				
				if(!$stripe)
				{
					return array('status'=>'error');
					exit;
				}
				
				
				$this->stripe_lib->setApiKey($stripe['stripe_private_key']);
				$strip_order_id =$data[0]['strip_order_id'] ;
				$refund_amount = $data[0]['total_amount'];
				
				$charge_details = $this->stripe_lib->getChargeDetails($strip_order_id);
				
				if($amount>0 && $amount<=$data[0]['total_amount'])
					$refund_amount = $amount;
				$amount = $refund_amount; 	
				//$amount = bcmul($refund_amount, 100); 
				
				if($amount > $charge_details->amount && $charge_details->amount)
					$amount = $charge_details->amount;
					
				$reason = 'requested_by_customer'; 
				$refund_array = array("charge" => $strip_order_id,"amount"=>$amount,"reason"=>$reason);
				
				//echo '<pre>';print_r($refund_array);
				
				$resp = $this->stripe_lib->refundeCustomer($refund_array);
				//echo 'hai';
				
				
				$response = serialize($resp);
				//echo '<pre>';print_r($resp);
				//echo $resp->id;
				//exit;
				if($resp->id)
				{
					$arr=array("member_id"=>$data[0]['member_id'],
							   "restaurant_id"=>$data[0]['restaurant_id'],
							   "location_id"=>$data[0]['location_id'],
							   "strip_customer_id"=>$data[0]['strip_customer_id'],
							   "created_time"=>date('Y-m-d H:i'),
							   "last_4digit"=>$data[0]['last_4digit'],
							   "brand"=>$data[0]['brand'],
							   "order_id"=>$order_id,
							   "strip_order_id"=>$resp->id,
							   "strip_response"=>$response,
							   "payment_mode"=>"refund");						
					$this->db->insert('fk_order_stripid_map',$arr);
					
					return array('status'=>'success','refund_amount'=>$refund_amount);
					
				
				}
				else
				{
					return array('status'=>'error');
					
				}
			
			}
			else
			{
				return array('status'=>'error');
				
			}
			
			
	   }


	   
	   public function refundOrderAmount($order_id,$amount=0)
	   {	
	   		$this->load->library('stripe_lib');
			$data =	$this->order_model->getOrderStripMap($order_id);
	
			
			if(sizeof($data)!=0){
			
				$check_data = array('location_id'=>$data[0]['location_id'],'restaurant_id'=>$data[0]['restaurant_id']);
					
				$stripe = $this->order_model->getOwnerStripDetails($check_data);
				
				if(!$stripe)
				{
					return array('status'=>'error');
					exit;
				}
				
				
				$this->stripe_lib->setApiKey($stripe['stripe_private_key']);
				$strip_order_id =$data[0]['strip_order_id'] ;
				$refund_amount = $data[0]['total_amount'];
				
				$charge_details = $this->stripe_lib->getChargeDetails($strip_order_id);
				//echo '<pre>';print_r($charge_details);
				//exit;
				//echo $amount;
				if($amount>0 && $amount<=$data[0]['total_amount'])
					$refund_amount = $amount;
				//$amount = $refund_amount; 	
				$amount = bcmul($refund_amount, 100); 
				
				if($amount > $charge_details->amount && $charge_details->amount)
					$amount = $charge_details->amount;
					
				$reason = 'requested_by_customer'; 
				$refund_array = array("charge" => $strip_order_id,"amount"=>$amount,"reason"=>$reason);
				
				//echo '<pre>';print_r($refund_array);
				
				$resp = $this->stripe_lib->refundeCustomer($refund_array);
				//echo 'hai';
				
				
				$response = serialize($resp);
				
				//echo $resp->id;
				//exit;
				if($resp->id)
				{
					$arr=array("member_id"=>$data[0]['member_id'],
							   "restaurant_id"=>$data[0]['restaurant_id'],
							   "location_id"=>$data[0]['location_id'],
							   "strip_customer_id"=>$data[0]['strip_customer_id'],
							   "created_time"=>date('Y-m-d H:i'),
							   "last_4digit"=>$data[0]['last_4digit'],
							   "brand"=>$data[0]['brand'],
							   "order_id"=>$order_id,
							   "strip_order_id"=>$resp->id,
							   "strip_response"=>$response,
							   "payment_mode"=>"refund");						
					$this->db->insert('fk_order_stripid_map',$arr);
					
					return array('status'=>'success','refund_amount'=>$refund_amount);
					
				
				}
				else
				{
					return array('status'=>'error');
					
				}
			
			}
			else
			{
				return array('status'=>'error');
				
			}
			
			
	   }
	public function cancelOrder($arr=''){
 		if(!isset($arr['order_id'])){
			$arr 	= 	 file_get_contents("php://input");
			$arr 	=	 json_decode($arr, true);
		}
		//$arr=array("restaurant_id"=>6,"location_id"=>13,"order_id"=>76);
		$order_id=$arr['order_id'];
		if($order_id!=''){
			$resp = $this->refundOrderAmount($order_id);
			//$mailsend = $this->sendOrderEmail($order_id,'cancel');
			
						
			if($resp['status']=='success'){
				$sendPush = $this->sendPush($order_id,'cancel');		
				$order	=	$this->api_model->cancelOrder($order_id,$resp['refund_amount']);
				$result = array('status'=>"success",'data' =>$order);
				echo json_encode($result);
			}else{
				$result = array('status'=>'error');
				echo json_encode($result);
			}
		}else{
			$result = array('status'=>'error');
			echo json_encode($result);
		}
		
	}
	   
	   
	   public function OrderPartialRefund($arr){
	   
	  
	    if(!isset($arr['order_id'])){
	    $arr 	= 	 file_get_contents("php://input");
		$arr 	=	 json_decode($arr, true);
		}
		
		$order_id=$arr['order_id'];
		$amount = $arr['amount'];
		 
		
		if($order_id && $amount>0){
			$resp = $this->refundOrderAmountForapp($order_id,$amount);
			//print_r($resp);
			if($resp['status']=='success')
			{	
				$order	=	$this->api_model->refundOrder($order_id,$amount);
				$result = array('status'=>"success",'data' =>$order);
	            echo json_encode($result);
				
				
			}
			else
			{
			$result = array('status'=>'error');
	        echo json_encode($result);
			}
		}
		else
		{
			$result = array('status'=>'error');
	        echo json_encode($result);
		}
	 	//$sendPush = $this->sendPush($order_id,'accept');
		
	}
	public function acceptOrder($arr=''){
	
		if(!isset($arr['order_id'])){
			$arr 	= 	 file_get_contents("php://input");
			$arr 	=	 json_decode($arr, true);
		}	
		
		//$arr=array("restaurant_id"=>1,"location_id"=>1,"order_id"=>133);
		//echo $devmode = getConfigValue('dev_mode');
		//exit;	
		$restaurant_id=$arr['restaurant_id'];
		$location_id=$arr['location_id'];
		$order_id=$arr['order_id'];
		$order	=	$this->api_model->acceptOrder($order_id);
			
		$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,3);
		$result = array('status' => 'success','result' =>$data['allcounts']);
		echo json_encode($result);
		
	    //$mailsend = $this->sendOrderEmail($order_id,'accept');
	    $sendPush = $this->sendPush($order_id,'accept');
	
	}
	public function completeOrder($arr=''){
	   if(!isset($arr['order_id'])){
	    $arr 	= 	 file_get_contents("php://input");
		$arr 	=	 json_decode($arr, true);	
		}
		
		$order_id=$arr['order_id'];
		$order	=	$this->api_model->completeOrder($order_id);
		
		//$mailsend = $this->sendOrderEmail($order_id,'complete');
	    $sendPush = $this->sendPush($order_id,'complete');			
		
		$restaurant_id=$arr['restaurant_id'];
		$location_id=$arr['location_id']; 
		
		
		$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,3);
		$result = array('status' => 'success','result' =>$data['allcounts']);
		echo json_encode($result);
		exit;
		
	}
	
		public function late($user)
	{
		   if(!isset($user['restaurant_id'])){
			$user 	= 	 file_get_contents("php://input");
			$user 	=	 json_decode($user, true);
			}	
			//$user = $this->session->userdata('user');
			$restaurant_id=$user['restaurant_id'];
			$location_id=$user['location_id'];
			$role=3;
			
			$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,3);
			$orderdetails	=$this->api_model->getLateOrders($restaurant_id,$location_id,3);
				$arr=array();
				if(count($orderdetails)!=0){
           			foreach($orderdetails as $order){
						$this->order_model->setTable('fk_restaurant_locations');	
						$row = $this->order_model->get_by('location_id',$location_id);	
						$created_time=$this->ConvertToViewTimezone($row->timezone,$order['created_time']);
						$order['created_time']=date('g:i a m/j/Y',strtotime($created_time));
						//$delivery_time=$this->ConvertToViewTimezone($row->timezone,$order['delivery_time']);
						$order['delivery_time']=date('g:i a m/j/Y',strtotime($order['delivery_time']));
						$arr[]=$order;
					}
				}	
				$data['orderdetails']=$arr;
				$result = array('status' => 'success','result' =>$data);
				echo json_encode($result);
				exit;
	   }
	   
	   
	 public function all($user)
	{
		 if(!isset($user['restaurant_id'])){
			$user 	= 	 file_get_contents("php://input");
			$user 	=	 json_decode($user, true);
			}	
			//$user = $this->session->userdata('user');
			$restaurant_id=$user['restaurant_id'];
			$location_id=$user['location_id'];
			$role=3;
			
			$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,3);
				$orderdetails	=$this->api_model->getAllOrders($restaurant_id,$location_id,3);
				$arr=array();
				if(count($orderdetails)!=0){
           			foreach($orderdetails as $order){
						$this->order_model->setTable('fk_restaurant_locations');	
						$row = $this->order_model->get_by('location_id',$location_id);	
						$created_time=$this->ConvertToViewTimezone($row->timezone,$order['created_time']);
						$order['created_time']=date('g:i a m/j/Y',strtotime($created_time));
						//$delivery_time=$this->ConvertToViewTimezone($row->timezone,$order['delivery_time']);
						$order['delivery_time']=date('g:i a m/j/Y',strtotime($order['delivery_time']));
						$arr[]=$order;
					}
				}	
				$data['orderdetails']=$arr;
				$result = array('status' => 'success','result' =>$data);
				echo json_encode($result);
				exit;
	    }	
		
		
		
		
		
	public function cancelled($user)
	{
	
			if(!isset($user['restaurant_id'])){
				$user 	= 	 file_get_contents("php://input");
				$user 	=	 json_decode($user, true);
			}	
			//$user = $this->session->userdata('user');
			$restaurant_id=$user['restaurant_id'];
			$location_id=$user['location_id'];
			$role=3;
			
			$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,3);
			
			$orderdetails	=$this->api_model->getCancelledOrders($restaurant_id,$location_id,3);
				$arr=array();
				if(count($orderdetails)!=0){
           			foreach($orderdetails as $order){
						$this->order_model->setTable('fk_restaurant_locations');	
						$row = $this->order_model->get_by('location_id',$location_id);	
						
						$created_time=$this->ConvertToViewTimezone($row->timezone,$order['created_time']);
						$order['created_time']=date('g:i a m/j/Y',strtotime($created_time));
						//$delivery_time=$this->ConvertToViewTimezone($row->timezone,$order['delivery_time']);
						$order['delivery_time']=date('g:i a m/j/Y',strtotime($order['delivery_time']));
						
						
						$arr[]=$order;
					}
				}	
				$data['orderdetails']=$arr;
				$result = array('status' => 'success','result' =>$data);
				echo json_encode($result);
				exit;
				
	}	
	
	public function accepted()
	{
		
			if(!isset($user['restaurant_id'])){
				$user 	= 	 file_get_contents("php://input");
				$user 	=	 json_decode($user, true);
			}	
			//$user=array("restaurant_id"=>1,"location_id"=>1);
			//$user = $this->session->userdata('user');
			$restaurant_id=$user['restaurant_id'];
			$location_id=$user['location_id'];
			$role=3;
			
			if($order_status=='')
				$order_status="Accepted";
				
			$data['allcounts']=$this->api_model->AllOrdersCount($restaurant_id,$location_id,$role);
			
				$arr=array();
				$orderdetails	=$this->api_model->getActiveOrders($restaurant_id,$location_id,$order_status,$role);
				if(count($orderdetails)!=0){
           			foreach($orderdetails as $order){
						$this->order_model->setTable('fk_restaurant_locations');	
						$row = $this->order_model->get_by('location_id',$location_id);	
						
						$created_time=$this->ConvertToViewTimezone($row->timezone,$order['created_time']);
						$order['created_time']=date('g:i a m/j/Y',strtotime($created_time));
						
						//$delivery_time=$this->ConvertToViewTimezone($row->timezone,$order['delivery_time']);
						$order['delivery_time']=date('g:i a m/j/Y',strtotime($order['delivery_time']));
						
						$arr[]=$order;
					}
				}	
				$data['orderdetails']=$arr;
				$result = array('status' => 'success','result' =>$data);
				echo json_encode($result);
				exit;
			
		
	}

		
	public function newOrders(){
			
			if(!isset($data['restaurant_id'])){
				$data 	= 	 file_get_contents("php://input");
				$user 	=	 json_decode($data, true);
			}	
			//$user = $this->session->userdata('user');
			$restaurant_id=$user['restaurant_id'];
			$location_id=$user['location_id'];
			
		$total_rows = $this->api_model->countNewOrders($restaurant_id,$location_id,3);
		
        $result = array('status' => 'success','result' =>$total_rows);
		echo json_encode($result);
		exit;
	}

	public function sendPush($order_id,$state){
	
		$data['orderdetails']=$this->order_model->getDetailOrder($order_id);
		
		$restaurant_id	=	$data['orderdetails'][0]['restaurant_id'];
		$restaurant_google_api_key	=	$data['orderdetails'][0]['google_api_key'];
		$email	=	$data['orderdetails'][0]['email'];
		$order_ref_id	=	$data['orderdetails'][0]['order_ref_id'];
		$device_token	=	$data['orderdetails'][0]['device_token'];	
		$allow_notification	=	$data['orderdetails'][0]['allow_notification'];	
		
				//$message	= "Your order ".$order_ref_id." is being processed now";	//accept
				//$message	= "Your order ".$order_ref_id." is ready for PickUP";		//pickup complete
				//$message	= "Your order ".$order_ref_id." is out for Delivery";		//delivery complete
				//$message	= "Your order ".$order_ref_id." is cancelled. The due amount will be refunded to your account";		//cancel order		
		if($state=='accept'){
			$message	=	"Your order ".$order_ref_id." is being processed";
		}elseif($state=='cancel'){
			$message	=	"Your order ".$order_ref_id." is cancelled. The due amount will be refunded to your account.";
		}else if($state=='complete'){
			if($data['orderdetails'][0]['order_type']=='Delivery'){
				$message	=	"Your order ".$order_ref_id." is out for delivery";
			}else{
				$message	=	"Your order ".$order_ref_id." is ready for pickup";
			}
		}		
		if($device_token!=''){
			if($allow_notification=='Y'){
			
				if($data['orderdetails'][0]['device_platform']=='Android'){
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
		public function send_notification($restaurant_id,$restaurant_google_api_key,$registatoin_ids, $message) {
			// include config
			// Set POST variables
			$url = 'https://android.googleapis.com/gcm/send';
	 
			$fields = array(
				'registration_ids' => $registatoin_ids,
				'data' => $message,
			);
			
			if(!$restaurant_google_api_key)
				die('Push Failed');
	 		
			/*   $headers = array(
				'Authorization: key=AIzaSyAJk9yuOe9E9Babuv2rUs6isF5x8b5tm2A',
				'Content-Type: application/json'
			);*/
		 	//AIzaSyD7cjTCfbRq70waHf4vxPJX7poxQYHNsF4
			$headers = array(
				'Authorization: key='.$restaurant_google_api_key, 
				'Content-Type: application/json'
			);
			// Open connection
			$ch = curl_init();
			//print_r($headers);
			//echo "here";exit;
			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
	 
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	 
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	 
			// Execute post
			$result = curl_exec($ch);
			if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
	
			// Close connection
			curl_close($ch);
	 		//print_r($result); 
	//print_r($fields);
		  //   echo $result;
		
	}	
	function sendPushNotificationIOS($restaurant_id,$message,$deviceToken,$badge_count=1,$details,$type)
		{
			// Put your device token here (without spaces):
			// $deviceToken = 'afe39a3382c565700a9a3a2a61c72dab67634bdfd1dcc8565205a9e1a3f344cc';
			// $message = "Testing";
			// Put your private key's passphrase here:
			$passphrase = 'newage'; 
			////////////////////////////////////////////////////////////////////////////////
			
			//if($this->config->item('development_mode')=='Y'){
			
			$devmode = getConfigValue('dev_mode');
			
			$dev_pem_name = 'apns-dev-'.$restaurant_id.'.pem';
			$prod_pem_name = 'apns-prod-'.$restaurant_id.'.pem';
			
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
			
			//if($this->config->item('development_mode')=='Y'){
			if($devmode=='Y'){
			$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			}else{
			$fp = stream_socket_client(
			'ssl://gateway.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			}
			
			if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
				//exit;
			
				
			
			
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
?>