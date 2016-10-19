<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Orders extends My_Controller {


	public function __construct() 
	{                        
		parent::__construct();
		$this->_setAsAdmin();
		$this->load->helper(array('url','cookie'));	
		$this->load->model('admin/order_model');
		$this->user 	= $this->session->userdata('user');
		if($this->user=='')
			redirect('admin');					
	}

	public function index()
	{
		redirect($this->user->root.'/orders/lists');
	}
	public function lists($category_id=''){
	
		$this->load->model('restaurant_model');		
        $role=$this->session->userdata('user')->role;
		if($this->session->userdata('user')!=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
            $role=$user->role;
			$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
			$config['total_rows'] = $this->order_model->countNewOrders($restaurant_id,$location_id,$role);
			$config['per_page'] = $config['total_rows'];
			 $data['key']  			= $_REQUEST['key'];
			 if( $role==1){
				 $restaurant_id=$_POST['rest'];
				 $data['restaurantlist']=$this->restaurant_model->getRestaurant();
				 $data['orderdetails']	=$this->order_model->getOrderDetailsAdmin($_REQUEST['key'],$restaurant_id);
				 //echo '<pre>';print_r($data['orderdetails']);exit;		
				 $ouput['output']			= $this->load->view('admin/orders/lists',$data,true);
				 $this->_render_output($ouput);
			 }
			else{
				$data['orderdetails']	=$this->order_model->getOrderDetails($restaurant_id,$location_id,$config['per_page'],'',$role);
				//echo '<pre>';print_r($data['orderdetails']);exit;
				$this->order_model->setTable('fk_restaurant_locations');	
				$row = $this->order_model->get_by('location_id',$location_id);	
				//echo '<pre>';print_r($row);exit;
				if(count($data['orderdetails'])!=0){
					$i=0;
					foreach($data['orderdetails'] as $val){
						//echo $row->timezone;
						$created_time=$this->ConvertToViewTimezone($row->timezone,$val['created_time']);
						$data['orderdetails'][$i]['created_time']=$created_time;
						$i++;					
					}
				}
				//echo '<pre>';print_r($data['orderdetails']);exit;	
				//echo $startdate =  $this->ConvertToViewTimezone($row->timezone,$newdate);
				//exit;
				$ouput['output']			= $this->load->view('admin/orders/order-new',$data,true);
				$this->_render_output($ouput);
		    }
		}else{
			redirect('admin');
		}
	}
	public function accepted()
	{
		
		
		if($this->session->userdata('user')!=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			$role=$user->role;
			
			
			$order_status=$_REQUEST['search_sel'];
			if($order_status=='')
				$order_status="Accepted";
				
			$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
			//for pagination
			$config	=array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']= 2;
			
			$_REQUEST['limit'] = (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
				if($_REQUEST['search_sel']) $params .= '&search_sel='.$_REQUEST['search_sel'];
				
			$config['base_url'] = site_url($this->user->root."/orders/accepted")."/".$params;
			
			$config['total_rows'] = $this->order_model->countActiveOrders($restaurant_id,$location_id,$order_status,$role);
			
			$config['per_page'] = $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
			$data['page'] = $_REQUEST['per_page'];
		    $data['limit'] 			= $_REQUEST['limit'];
			$this->pagination->initialize($config);		
			
			
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				$data['orderstatus']=$order_status;
				$data['orderdetails']	=	$this->order_model->searchOrder($restaurant_id,$location_id,$order_status,$config['per_page'],$_REQUEST['per_page'],$role);
				//echo '<pre>';print_r($data['orderdetails']);exit;	
				$ouput['output']			= $this->load->view('admin/orders/order-accepted',$data,true);
				$this->_render_output($ouput);
			}else{
				$data['orderdetails']	=$this->order_model->getActiveOrders($restaurant_id,$location_id,$order_status,$config['per_page'],$_REQUEST['per_page'],$role);
				//echo '<pre>';print_r($data['orderdetails']);exit;		
				$ouput['output']			= $this->load->view('admin/orders/order-accepted',$data,true);
				$this->_render_output($ouput);
			}
		}else{
			redirect('admin');
		}

	}


	public function cancelled()
	{
		if($this->session->userdata('user')!=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			$role=$user->role;
			
			$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
			
			//for pagination
			
			$config	=array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']= 2;
			
			$_REQUEST['limit'] = (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$params = '?t=1';
			if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
			$config['base_url'] = site_url($this->user->root."/orders/cancelled")."/".$params;
			$config['total_rows'] = $this->order_model->countCancelledOrders($restaurant_id,$location_id,$role);
			$config['per_page'] = $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
			$data['page'] = $_REQUEST['per_page'];
			$data['limit'] 			= $_REQUEST['limit'];
			$this->pagination->initialize($config);	
			
				$data['orderdetails']	=$this->order_model->getCancelledOrders($restaurant_id,$location_id,$config['per_page'],$_REQUEST['per_page'],$role);
				//echo '<pre>';print_r($data['orderdetails']);exit;		
				$ouput['output']			= $this->load->view('admin/orders/order-cancelled',$data,true);
				$this->_render_output($ouput);
			
		}else{
			redirect('admin');
		}

	}	
	
	//need to change the code.....
	public function late()
	{
		if($this->session->userdata('user')!=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			$role=$user->role;
			
			$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
			
			//for pagination
			
			$config	=array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']= 2;
			
			$_REQUEST['limit'] = (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
			$config['base_url'] = site_url($this->user->root."/orders/late")."/".$params;
			$config['total_rows'] = $this->order_model->countLateOrders($restaurant_id,$location_id,$role);
			$config['per_page'] = $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
			$data['page'] = $_REQUEST['per_page'];
			$data['limit'] 			= $_REQUEST['limit'];
			$this->pagination->initialize($config);	
			
				$data['orderdetails']	=$this->order_model->getLateOrders($restaurant_id,$location_id,$config['per_page'],$_REQUEST['per_page'],$role);
				//echo '<pre>';print_r($data['orderdetails']);exit;		
				$ouput['output']			= $this->load->view('admin/orders/order-late',$data,true);
				$this->_render_output($ouput);
			
		}else{
			redirect('admin');
		}

	}	

	public function all()
	{
		if($this->session->userdata('user')!=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			$role=$user->role;
			
			$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
			//for pagination
			
			$config	=array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']= 10;
			
			$_REQUEST['limit'] = (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
			$config['base_url'] = site_url($this->user->root."/orders/all")."/".$params;
			$config['total_rows'] = $this->order_model->countAllOrders($restaurant_id,$location_id,$role);
			$config['per_page'] = $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
			$data['page'] = $_REQUEST['per_page'];
			$data['limit'] 			= $_REQUEST['limit'];
			$this->pagination->initialize($config);	
			
				$data['orderdetails']	=$this->order_model->getAllOrders($restaurant_id,$location_id,$config['per_page'],$_REQUEST['per_page'],$role);
				//print_r($data['orderdetails']);exit;
				//echo '<pre>';print_r($data['orderdetails']);exit;		
				$ouput['output']			= $this->load->view('admin/orders/order-all',$data,true);
				$this->_render_output($ouput);
			
		}else{
			redirect('admin');
		}

	}	

	public function details($order_id){
		if($this->session->userdata('user')!=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			$role=$user->role;
			$data['usertype']=$user->root;
			$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
			//echo '<pre>';print_r($data['allcounts']);exit;
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
			//echo '<pre>';print_r($data);exit;	
			$data['sidesdetails']=$sidesdetails;
			$data['orderid']=$order_id;
			$ouput['output']	=	$this->load->view('admin/orders/order-details',$data,true);
			
			$this->_render_output($ouput);
		}else{
			redirect('admin');
		}
		
	}
	
	public function details_ajax(){
	
			$order_id = $this->input->post('order_id');
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			$role=$user->role;
			$data['usertype']=$user->root;
			$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
			//echo '<pre>';print_r($data['allcounts']);exit;
			$data['orderdetails']=$this->order_model->getDetailOrder($order_id);
			$data['itemdetails']=$this->order_model->getDetailItem($order_id);
			//echo '<pre>';print_r($data['orderdetails']);exit;
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
			//echo '<pre>';print_r($data);exit;	
			$data['sidesdetails']=$sidesdetails;
			$data['orderid']=$order_id;
			$ouput['output']	=	$this->load->view('admin/orders/order-details-ajax',$data,true);
			
			echo $ouput['output'];
	
	}
	
	public function acceptOrder(){
			
		//echo $devmode = getConfigValue('dev_mode');
		//exit;	
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;
		$role=$user->role;
		
			
			
		$order_id=$_POST['order_id'];
		$order	=	$this->order_model->acceptOrder($order_id);
			
		$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
		$result = array('status' => 'success','result' =>$data['allcounts']);
		
		echo json_encode($result);
		
	    //$mailsend = $this->sendOrderEmail($order_id,'accept');
	    $sendPush = $this->sendPush($order_id,'accept');
	
	}
	
	public function sendPush($order_id,$state){
	
		$data['orderdetails']=$this->order_model->getDetailOrder($order_id);
		
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
		
		if($allow_notification=='Y'){
		
			if($data['orderdetails'][0]['device_platform']=='Android'){
					$registatoin_ids = array($device_token);
					$message = array("message" =>  $message);	
					$result = $this->send_notification($registatoin_ids, $message,1);
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
						$this->sendPushNotificationIOS($message,$deviceTocken,$badge_count,$aaaa,'mutual_match');
					}
			}
		}
	}
	
	public function sendOrderEmail($order_id,$state){
			$this->load->model('email_model');		
			//$order_id=$_POST['order_id'];
			//$order_id=224;

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
			$order_ref_id	=	$data['orderdetails'][0]['order_ref_id'];
			//echo '<pre>';print_r($data);exit;	

			if($state=='accept'){
				$data['subject']="Your order ".$order_ref_id." is being processed now";
			}elseif($state=='cancel'){
				$data['subject']="Your order ".$order_ref_id." is cancelled. The due amount will be refunded to your account.";
			}else if($state=='complete'){
				if($data['orderdetails'][0]['order_type']=='Delivery'){
					$data['subject']	=	"Your order ".$order_ref_id." is out for delivery";
				}else{
					$data['subject']	=	"Your order ".$order_ref_id." is ready for pickup";
				}
			}			
			
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <info@forkourse.com>'. "\r\n";
			$message = $this->load->view('email/accept_order', $data, TRUE);
			//echo $this->load->view('email/accept_order', $data, TRUE);
			mail($email,$data['subject'], $message, $headers);
				
	}
	public function cancelOrder(){
		$order_id=$_POST['order_id'];
		
		
		$resp = $this->refundOrderAmount($order_id);
		
		//$mailsend = $this->sendOrderEmail($order_id,'cancel');
	    $sendPush = $this->sendPush($order_id,'cancel');		
	
		if($resp['status']=='success'){
			$order	=	$this->order_model->cancelOrder($order_id,$resp['refund_amount']);
			echo "success";
			}
		else
			echo "error";
			
		exit;
	}
	public function completeOrder(){
		
		$order_id=$_POST['order_id'];
		$order	=	$this->order_model->completeOrder($order_id);
		
		//$mailsend = $this->sendOrderEmail($order_id,'complete');
	    $sendPush = $this->sendPush($order_id,'complete');			
		
		
		
		
		
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;
		$role=$user->role;
		
		
		$data['allcounts']=$this->order_model->AllOrdersCount($restaurant_id,$location_id,$role);
		$result = array('status' => 'success','result' =>$data['allcounts']);
		
		echo json_encode($result);
		exit;
		
	}
	
	
	public function OrderPartialRefund(){
		$order_id=$_POST['order_id'];
		$amount = $_POST['amount'];
		if($order_id && $amount>0){
			$resp = $this->refundOrderAmount($order_id,$amount);
			if($resp['status']=='success')
			{	$order	=	$this->order_model->refundOrder($order_id,$amount);
				echo "success";
			}
			else
				echo "error";
		}
		else
		{
			echo "error";
		}
	
		exit;
	}
	public function sublitcompleteOrder(){
		//echo '<pre>';print_r($_POST);exit;	
		$order_id=$_POST['order_id'];
		$order	=	$this->order_model->completeOrder($order_id);
		
		//$mailsend = $this->sendOrderEmail($order_id,'complete');
	    $sendPush = $this->sendPush($order_id,'complete');	
			
		$this->session->set_flashdata('success_message', 'Order completed successfully');
		redirect($this->user->root.'/orders/lists');
	}
	public function pagination(){
		
			$config['page_query_string'] = TRUE;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';

			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#' class='btn-info btn'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";			
			
			return $config;		
		
		
	}
	

	public function loadNewOrder(){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;
        $role=$user->role;
		$total_rows = $this->order_model->countNewOrders($restaurant_id,$location_id,$role);
		$datetimeformat = getConfigValue('time_format').' '.getConfigValue('date_format');
		//$timeformat = getConfigValue('time_format');
		$data['orderdetails']	=$this->order_model->getOrderDetails($restaurant_id,$location_id,$total_rows,'',$role);
		//echo '<pre>';print_r($data['orderdetails']);exit;		
		$url=base_url().$this->user->root."/orders/details/";
		$fb_imgurl=base_url()."assets/images/icon-fb.png";
		$general_imgurl=base_url()."assets/images/icon-frkouse.png";
		header("Content-Type: text/event-stream");
		header("Cache-Control: no-cache");
		header("Connection: keep-alive");
		
		$newdata="";
		$newtabdata="";
		$newmobdata ="";
		
		if(count($data['orderdetails'])!=0){
           	foreach($data['orderdetails'] as $order){
            $newdata.="<tr id=".$order['order_id']." class='trlink'>";
			
			if($this->user->role!='3'){	
			$newdata.="<td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink'>".$order['restaurant_name']."</td>";
			$newtabdata.="<td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink'>".$order['restaurant_name']."</td>";
			$newmobdata.="<td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink'>".$order['restaurant_name']."</td>";
			}
				
				$this->order_model->setTable('fk_restaurant_locations');	
				$row = $this->order_model->get_by('location_id',$location_id);	

				$created_time=$this->ConvertToViewTimezone($row->timezone,$order['created_time']);
				$order['created_time']=date('g:i a m/j/Y',strtotime($created_time));
						
				
				
			$newdata.="<td style='cursor:pointer;' class='tdlink'>".$order['first_name'].' '.$order['last_name']."</td><td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink hide-tab hide-mob'>".$order['created_time']."</td><td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink hide-tab hide-mob'>".date($datetimeformat,strtotime($order['delivery_time']))."</td><td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink hide-mob'>".$order['order_ref_id']."</td><td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink'>".$order['order_type']."</td><td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink hide-mob hide-tab'>$".$order['total_amount']."</td>";
			

		
		
			$newdata.="<td href='".$url.$order['order_id']."' style='cursor:pointer;' class='tdlink source ".$order['source_type']."'>";
			$newdata.="</td><td  class='tdlink hide-desk hide'><a class='more-btn' href='javascript:void(0)'></a></td></tr>";
		
			
			
			}
		}else {
      		 $newdata.="<tr><td colspan='9' class='tbl_row'>No New Orders</td></tr>";
			 $newtabdata.="<tr><td colspan='5' class='tbl_row'>No New Orders</td></tr>";
			 $newmobdata.="<tr><td colspan='4' class='tbl_row'>No New Orders</td></tr>";
        } 
            
           echo "data: $total_rows###$newdata\n\n"; 
		 
		ob_flush();
		flush();
	//echo $this->load->view('admin/orders/stocks','',true);
			
	}

	
	

	public function loadAutoTimeUpdateDetail($order_id){
		$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		$location_id=$user->location_id;
        $role=$user->role;
		
		
		$orderdetails=$this->order_model->getDetailOrder($order_id);
		

		header("Content-Type: text/event-stream");
		header("Cache-Control: no-cache");
	    header("Connection: keep-alive");
		//echo date('Y-m-d H:i');
		//echo $orderdetails[0]['delivery_time'];
		
		
		$cur_date =strtotime(date('Y-m-d')); 
	    $deldate=explode(' ',$orderdetails[0]['delivery_time']);
		
		
				$newdata="";
				
				$retval ='';
                $granularity=1;
                $date = strtotime($orderdetails[0]['delivery_time']);
				//echo time();
				//$test=  strtotime(date('2015-09-17 12:59:00'));
               	$difference = $date -  time();
                $periods = array('decade' => 315360000,
                'year' => 31536000,
                'month' => 2628000,
                'week' => 604800,
                'day' => 86400,
                'hour' => 3600,
                'minute' => 60,
                'second' => 1);
				
			//echo 	date('Y-m-d H:i');
				
				
                if ($difference < 5) { 
					
					// less than 5 seconds ago, let's say "just now"
					// $retval = "posted just now";
					$retval_time = "just now";
					
                } else {
				
					foreach ($periods as $key => $value_date) {
						if ($difference >= $value_date) {
						
							$time = floor($difference/$value_date);
							$difference %= $value_date;
							$retval .= ($retval ? ' ' : '').$time.' ';
							//$retval .= (($time > 1) ? $key.'s' : $key);
							$granularity--;
						}
						if ($granularity == '0') { break; }
					}
					// $retval= ' posted '.$retval.' ago';
					//echo $time;
					$retval_time=$retval;
					
                
                }
				
				
				if($key=='day'){
					
					if(date('H:i A',strtotime($deldate[1]))=='00:00 AM'){
						$newdata.= '12:00 AM '.date('m-d-Y',strtotime($orderdetails[0]['delivery_time']));
						//$newdata.=date('H:i A m-d-Y',strtotime($orderdetails[0]['delivery_time']));
					}else{
						$newdata.=date('l g:i A',strtotime($orderdetails[0]['delivery_time']));
					}
						
				}else if($key=='hour'){
					if(strtotime($deldate[0])==strtotime(date('Y-m-d'))){
						$newdata.= date('g:i A',strtotime($deldate[1]));
					}else{
						//echo $deldate[1];
						$newdtar=explode(':',$deldate[1]); 
						//print_r($newdta);
						//if(date('H:i A',strtotime($deldate[1]))=='00:00 AM'){
						//if($newdtar[0]=='00'){
						//	$newdata.= '12:'.$newdtar[1].' AM Tomorrow';
						//}else{
							$newdata.= date('g:i A',strtotime($deldate[1]))." Tomorrow";
						//}
						
					}
				}else if($key=='minute'){
					$newdata.= $retval.' Mins';
				}else if($key=='second'){
					$newdata.= 'Now';
				}else{
					//$newdata.= 'Late';
				} 
				
			
            
        echo "data: $newdata\n\n"; 
		
		//ob_flush();
		//flush();
	//echo $this->load->view('admin/orders/stocks','',true);
			
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
				
				if($amount>0 && $amount<=$data[0]['total_amount'])
					$refund_amount = $amount;
					
				$amount = bcmul($refund_amount, 100); 
				
				if($amount > $charge_details->amount && $charge_details->amount)
					$amount = $charge_details->amount;
					
				$reason = 'requested_by_customer'; 
				$refund_array = array( "charge" => $strip_order_id,"amount"=>$amount,"reason"=>$reason);
				$resp = $this->stripe_lib->refundeCustomer($refund_array);
				$response = serialize($resp);
				
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
	
	function push_message_temp($registatoin_id, $message)
	{
		
		//--------------------------------------------------------------
			$data['orderdetails']=$this->order_model->getDetailOrder(360);
			$email	=	$data['orderdetails'][0]['email'];
			$order_ref_id	=	$data['orderdetails'][0]['order_ref_id'];
			$device_token	=	$data['orderdetails'][0]['device_token'];
	   //--------------------------------------------------------------
			$registatoin_ids = array($device_token);
			$message	= "Your order ".$order_ref_id." is being processed now";	//accept
			//$message	= "Your order ".$order_ref_id." is ready for PickUP";		//pickup complete
			//$message	= "Your order ".$order_ref_id." is out for Delivery";		//delivery complete
			//$message	= "Your order ".$order_ref_id." is cancelled. The due amount will be refunded to your account";		//cancel order
			
			//$message = array("product" =>  $message);   //android
			$message = array("message" =>  $message);	
			//$registatoin_ids = array($registatoin_id);
			//$message = array("message" =>  "NewAge Testing...... ");
			//$registatoin_ids = array("APA91bGsUiERo6fhQ4JXb__hF61OtqEth_ao2iVZfqfDFNBOqEJkRA0vHxC1-TB9jJGpIo6wjem4RGfdPcFSZYbPn6yvoM4JixLRdm7ZDsrson5hzwSK4Y5RmQPAYEADHbmk2jqu2vFH");
			
			$result = $this->send_notification($registatoin_ids, $message,1);
			echo"Done";
	}
	
	public function send_notification($registatoin_ids, $message) {
			// include config
			// Set POST variables
			$url = 'https://android.googleapis.com/gcm/send';
	 
			$fields = array(
				'registration_ids' => $registatoin_ids,
				'data' => $message,
			);
	 
			/*   $headers = array(
				'Authorization: key=AIzaSyAJk9yuOe9E9Babuv2rUs6isF5x8b5tm2A',
				'Content-Type: application/json'
			);*/
		 	
			$headers = array(
				'Authorization: key=AIzaSyAyRDPitzV8OsVc_rdmjVSbeDllkx042UM', //AIzaSyD7cjTCfbRq70waHf4vxPJX7poxQYHNsF4
				'Content-Type: application/json'
			);
			// Open connection
			$ch = curl_init();
			
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

	//ios
	function check_my_PushNotification($user_id)
		{
		 	$user_id=1;
			$arr['user_id']  = $user_id; 
			$aaaa['sender_id']  = $user_id; 
			$aaaa['reciver_id']  = $user_id; 
			$aaaa['display_name']  = "umesh"; 
			 
			 
			 
			//$this->load->model('client_model');
			//$result	=	$this->client_model->get_profile($arr['user_id']);
			$message = "Sample Push Notification";
			//$deviceTocken = $result['device_id'];
			$deviceTocken = '0fb7f6b14ecfcd2ff1cb25a7b6a1a336a90a9cf8ce1974ce327d65ceb50708b7';
			$badge_count  = 1;
			if($deviceTocken!='')
			{
				$this->sendPushNotificationIOS($message,$deviceTocken,$badge_count,$aaaa,'mutual_match');
				$result = array('status' => 'true', 'message'=>'Push Notification sucessfully Working' );
			}else{
				$result = array('status' => 'false', 'message'=>'Push Notification Not Working' );
			}
			echo json_encode($result);
		}

	function sendPushNotificationIOS($message,$deviceToken,$badge_count=1,$details,$type)
		{
			// Put your device token here (without spaces):
			// $deviceToken = 'afe39a3382c565700a9a3a2a61c72dab67634bdfd1dcc8565205a9e1a3f344cc';
			// $message = "Testing";
			// Put your private key's passphrase here:
			$passphrase = 'newage'; 
			////////////////////////////////////////////////////////////////////////////////
			
			//if($this->config->item('development_mode')=='Y'){
			
			$devmode = getConfigValue('dev_mode');
			
			//$devmode='N';
			$ctx = stream_context_create();
			if($devmode=='Y'){
				stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-dev.pem');
			}else{
				stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-prod.pem');
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */