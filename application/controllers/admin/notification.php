<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Notification extends MY_Controller {

	/**
	 * Location Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 
	 * $this->load->library('crud');
	 * load crud library if u want to perform basic listing/add/edit and
	 * other similar stuffs
	 * $this->load->library('preferences');
	 * for showing a configuration table where users can only update fields
	 */	
public function __construct(){
	
				parent::__construct();
				$this->_setAsAdmin();
				$this->load->model('admin/promocode_model');
				$this->load->model('restaurant_model');
				$this->user 	= $this->session->userdata('user');
				if($this->user=='')
					redirect('admin');		
}
public function index(){
	redirect('admin/notification/add');		
	
}
public function add($id=''){
		$this->load->model('restaurant_model');
		
	    $restaurant_id	=	$this->session->userdata('user')->restaurant_id;
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$id=$this->input->post('id');
				$status = ($this->input->post('status'))?'Y':'N';
							if($id!='')
							{ 
								$data	 = array('title'=>$this->input->post('title'),
							                 'message'=>$this->input->post('message'),
							                 'restaurant_id'=>$restaurant_id,
							                 'location_id'=>'',
											 'status'=>$status
											);
								$this->promocode_model->setTable('fk_restaurant_messages');
								$this->promocode_model->update_by(array('id'=>$id),$data);
								$this->session->set_flashdata('message', 'Details Updated Successfully','SUCCESS');
								redirect('admin/notification/add');
							}	
							else{	
								$data	 = array('title'=>$this->input->post('title'),
							                 'message'=>$this->input->post('message'),
							                 'restaurant_id'=>$restaurant_id,
							                 'location_id'=>'',
											 'status'=>$status
											);
												 	
                    
								$this->restaurant_model->adddetails('fk_restaurant_messages',$data);
								$this->session->set_flashdata('message', 'Details Added Successfully','SUCCESS');
								redirect('admin/notification/add');
 					}
			}else{
				$condition =  array("restaurant_id"=>$restaurant_id);
			 	$data['details'] = $this->restaurant_model->get_where('fk_restaurant_messages',$condition,"id ASC","row");
				//print_r($data);exit;
				$output['output']                 = $this->load->view('admin/notification/add',$data,true);//loading success view
				$this->_render_output($output);
			}
			
}

	public function send(){
	
		echo '<pre>';print_r($_POST);
	
	}	
	
	public function sendPush($resturant_id){
	
		if($resturant_id)
		{
			
			$data=$this->promocode_model->getRestaurantUsers($resturant_id);
			$message	=	$_POST['instantMsg'];
			
			//exit;
			//echo '<pre>';print_r($data[4]);
			//echo '<pre>';print_r($data);exit;
			if(count($data)!=0){
				foreach($data as $var){
					//if($var['member_id']==16 || $var['member_id']==29){	
						$device_token	=	$var['device_token'];	
						$allow_notification	=	$var['allow_notification'];	
						
						//$message	=	"test message";
						//echo $device_token;exit;
						if($allow_notification=='Y' && $device_token){
						
							if($var['device_platform']=='Android'){
									$registatoin_ids = array($device_token);
									$message1 = array("message" =>  $message);
									$result = $this->send_notification($resturant_id,$registatoin_ids, $message1,1);
							}else{
									$user_id=1;
									$arr['user_id']  = $user_id; 
									$msg['sender_id']  = $user_id; 
									$msg['reciver_id']  = $user_id; 
									$msg['display_name']  = "Test"; 
					
									//$deviceTocken = $result['device_id'];
									$deviceTocken = $device_token;
									//$deviceTocken ="0fb7f6b14ecfcd2ff1cb25a7b6a1a336a90a9cf8ce1974ce327d65ceb50708b7";
									$badge_count  = 1;
									if($deviceTocken!='')
									{
										$this->sendPushNotificationIOS($resturant_id,$message,$deviceTocken,$badge_count,$msg,'mutual_match');
									}
							}
						}
					//}	
						
				}
			}
			$this->session->set_flashdata('message', 'Instant Notification Message Send Successfully','SUCCESS');
			redirect('manager/notification/add');	
		}
		else
		{
			$this->session->set_flashdata('message', 'Instant Notification Message Sending Failed','ERROR');
			redirect('manager/notification/add');	
		}
	}
	
	public function send_notification($resturant_id,$registatoin_ids, $message) {
	
			$rest_details = $this->restaurant_model->getAllDetails($resturant_id);
			$restaurant_google_api_key = $rest_details['google_api_key'];
			if(!$restaurant_google_api_key)
			{
				return;
				die('Push Failed');
			}
				
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
				'Authorization: key='.$restaurant_google_api_key,  //AIzaSyD7cjTCfbRq70waHf4vxPJX7poxQYHNsF4
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
				//die('Curl failed: ' . curl_error($ch));
				curl_close($ch);
				return;
				
			}
	
			// Close connection
			curl_close($ch);
	 	
		return;
		
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
			{
				fclose($fp);
			//	return;
			exit("Failed to connect: $err $errstr" . PHP_EOL);
			}
			
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
			
			
			return;
		
		}

	
	
	
}

	
?>
