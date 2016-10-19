<?php
	
	require_once(FCPATH.'application/libraries/lib/stripe/init.php');
	
	class Stripe_lib{
	
		public function __construct(){
			$this->ci = &get_instance();		
			$this->ci->load->helper('url');
			$this->ci->load->library('session');
			$this->ci->load->model('client_model');
		}
		
		public function setApiKey($secret_key){
		
			\Stripe\Stripe::setApiKey($secret_key);
			return;
		}
		
		public function createToken($CUSTOMER_ID, $CONNECTED_STRIPE_ACCOUNT_ID){
			try{
				$token = \Stripe\Token::create(
					array("customer" => $CUSTOMER_ID),
					array("stripe_account" => $CONNECTED_STRIPE_ACCOUNT_ID)
				);
				
				return $token;
				
			} catch(Exception $e){
				$body = $e->getJsonBody();
				echo json_encode(array('error'=>$body['error']['message']));
				exit;
			}
			
		}
		
		public function createCustomer($arguments=array()){		
		
			try{				
				$customer = \Stripe\Customer::create($arguments);			
				return $customer;				
			} catch(Exception $e){
				$body = $e->getJsonBody();
				echo json_encode(array('error'=>$body['error']['message']));
				exit;
			}
		}
		
		public function chargeCustomer($arguments=array()){		
			try{
		
				if(!empty($arguments)){
					$resp = \Stripe\Charge::create($arguments);
					return $resp ;
				}

			} catch(Exception $e){
				$body = $e->getJsonBody();
				echo json_encode(array('error'=>$body['error']['message']));
				exit;
			}
		}
		
		public function saveCustemerId($member_id, $customer_id){			
			
			return $this->ci->client_model->update('member_master', array('customer_id'=>$customer_id), array('member_id'=>$member_id));
		
		}
		
		public function saveAdminCustemerId($member_id, $customer_id){			
			
			return $this->ci->client_model->update('member_master', array('admin_cust_id'=>$customer_id), array('member_id'=>$member_id));
		
		}
		
		public function refundeCustomer($arguments=array()){		
			try{
		
				if(!empty($arguments)){
					$resp = \Stripe\Refund::create($arguments);
					return $resp ;
				}

			} catch(Exception $e){
				$body = $e->getJsonBody();
				return $body['error']['message'];
				exit;
			}
		}
		
		public function getChargeDetails($charge_id=''){		
			try{
		
				if($charge_id!=''){
					$resp = \Stripe\Charge::retrieve($charge_id);
					return $resp ;
				}

			} catch(Exception $e){
				$body = $e->getJsonBody();
				return $body['error']['message'];
				exit;
			}
		}
		
	}

?>