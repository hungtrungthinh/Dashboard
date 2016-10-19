<?php 
class Api_model extends CI_Model {
   public $_table = 'fk_order_master';

	public function __construct()
	{
		$this->load->database();
		date_default_timezone_set('GMT');
	}
	
	public function insert($table,$data)
	{
		//print_r($data);exit;
		$this->db->insert($table, $data);
		$insert_id	= 	$this->db->insert_id();
		return $insert_id;
	}
	public function update($table,$data ,$cond)
	{
		
		return $this->db->update($table, $data,$cond);
	}	
	public function delete_records($table,$data)
	{
		
		return $this->db->delete($table, $data); 
	}
	public function getUser_detail($user_name,$password){
		$sql = "SELECT * FROM `fk_member_admins` 
                WHERE username='".$user_name."' AND `password`='".$password."'  AND role='3'";	
				$query = $this->db->query($sql);
				return $query->row_array();	
		
	}	
	public function getpassword($email){
		$sql = "SELECT password,admin_id,full_name
				FROM fk_member_admins
				WHERE  email ='$email'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	#function to generate random Password
	public function randomPassword()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	public function getOrderDetails($restaurant_id,$location_id,$role){
		$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
				FROM fk_order_master A
				LEFT JOIN fk_member_master B on A.member_id=B.member_id 
				LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
				WHERE order_status='New' 
				";
		if($role=='3')		
			$sql.= " AND  A.location_id='".$location_id."'	";
			
		$sql.=" AND A.payment_status='Y' ";
		$sql.=" ORDER BY delivery_time ASC ";
		
		//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	public function countNewOrders($restaurant_id,$location_id,$role){
			$sql = "SELECT count(*) as num
					FROM fk_order_master A
					WHERE order_status='New' AND A.payment_status='Y'";
			if($role=='3')		
				$sql.= " AND  location_id='".$location_id."'	";
		
				
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}
	public function AllOrdersCount($restaurant_id,$location_id,$role){
		
		if($role=='3')		
			$query= " AND  fk_order_master.location_id='".$location_id."' AND fk_order_master.payment_status='Y'";
			
		$date=date('Y-m-d');
		$date.=" 23:59:59";	
			
		$sql="SELECT 
			  (SELECT count(*)	FROM fk_order_master WHERE order_status='Cancelled' ". $query ." ) as cancelled ,
			  (SELECT count(*)  FROM fk_order_master WHERE order_status='New'  ". $query ." ) as newcount,
			  (SELECT count(*) 	FROM fk_order_master  WHERE order_status='Accepted' ". $query ." ) as accepted,
			  (SELECT count(*) 	FROM fk_order_master  WHERE order_status!='Completed' ) as allcount,
			  (SELECT count(*) 	FROM fk_order_master  WHERE is_later='Y'  ". $query ."  AND order_status !='Cancelled' AND order_status !='Completed' AND delivery_time > '$date') as late
			  
			  ";
		//echo $sql;
		$query = $this->db->query($sql); 
		$result=$query->row_array();	
		return $result;	  
		}
		public function getDetailOrder($order_id){
		$sql = "SELECT MM.first_name,MM.last_name,MM.auth_type,MM.phone as 
		 member_phone,MM.email,MM.device_token,MM.device_platform,MM.allow_notification,RL.restaurant_name,
		 RL.address as res_address,RL.phone as res_phone,RL.state as res_state,RL.city as res_city,
		 RL.zip_code as res_zip,RL.type,OM.order_type,DA.*,
		 OM.order_status,OM.order_id,OM.order_ref_id,OM.created_time,OM.delivery_time,OM.tip,OM.discount_amount,
		 OM.tax_amount,OM.sub_total,OM.refund_amount,OM.total_amount,OM.delivery_service_amount
		 FROM fk_order_master OM 
		 LEFT JOIN fk_delivery_address DA ON OM.order_id = DA.order_id 
		 LEFT JOIN fk_member_master MM ON OM.member_id = MM.member_id
		 LEFT JOIN fk_restaurant_locations RL ON OM.location_id = RL.location_id
		 WHERE OM.order_id ='".$order_id."'";	
				//echo $sql;exit;
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	public function getDetailItem($order_id){
		$sql = "SELECT OI.*,DIM.item_id,DIM.category_id,DIM.item_name,DIM.item_chinese_name,DIM.item_description,DIM.status,DIM.sortorder
				FROM fk_order_items OI
				LEFT JOIN fk_dish_items_master DIM ON OI.item_id = DIM.item_id
				WHERE OI.order_id ='".$order_id."' ORDER BY DIM.sortorder ASC ";	
				//echo $sql;
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	public function getOrderStripMap($order_id,$payment_mode='')
	{
		$sql="SELECT fk_order_master.*,
					fk_order_stripid_map.last_4digit,
					fk_order_stripid_map.brand,
					fk_order_stripid_map.strip_order_id,
					fk_order_stripid_map.strip_customer_id,
					fk_order_stripid_map.order_id,
					fk_order_stripid_map.payment_mode
					FROM fk_order_master 
			LEFT JOIN fk_order_stripid_map
			ON fk_order_stripid_map.order_id = fk_order_master.order_id
			 WHERE  fk_order_master.order_id='".$order_id."' ";
			
		if($payment_mode)
			$sql.="and fk_order_stripid_map.payment_mode='".$payment_mode."' ";
		
		$sql.=" ORDER BY fk_order_stripid_map.created_time DESC";
			
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	public function getDetailOption($ord_item_id ){
		$sql = "SELECT * 
				FROM fk_order_option_map
				WHERE ord_item_id  =$ord_item_id";	
				//echo $sql;
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	public function getOwnerStripDetails($data)
	{
		//return array('stripe_public_key'=>$this->config->item('stripe_public_key'),'stripe_private_key'=>$this->config->item('stripe_private_key'));
		
		if(getLocationConfigValue('19',$data['location_id'],$data['restaurant_id'])!='')
			$stripe_public_key  =getLocationConfigValue('19',$data['location_id'],$data['restaurant_id']);
		else
			$stripe_public_key  =$this->config->item('stripe_public_key');
			
		if(getLocationConfigValue('20',$data['location_id'],$data['restaurant_id'])!='')
			$stripe_private_key  =getLocationConfigValue('20',$data['location_id'],$data['restaurant_id']);
		else
			$stripe_private_key  =$this->config->item('stripe_private_key');
			
		return array('stripe_public_key'=>$stripe_public_key,'stripe_private_key'=>$stripe_private_key);
	
	}
	public function refundOrder($order_id,$refund_amount){
			$sql = "UPDATE fk_order_master SET refund_amount='".$refund_amount."' WHERE order_id='".$order_id."'";
			$query = $this->db->query($sql);
			return true;	
	}
	public function acceptOrder($order_id){
		$sql = "UPDATE fk_order_master 
				SET order_status='Accepted' 
				WHERE order_id ='".$order_id."'";
		$query = $this->db->query($sql);
	    return true;	
	}
	public function completeOrder($order_id){
			$sql = "UPDATE fk_order_master SET order_status='Completed' WHERE order_id ='".$order_id."'";
			$query = $this->db->query($sql);
			return true;	
	}
	public function getLateOrders($restaurant_id,$location_id,$role){
			$date=date('Y-m-d');
			$date.=" 23:59:59";
			$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
					FROM fk_order_master A
					LEFT JOIN fk_member_master B on A.member_id=B.member_id
					LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
					 WHERE 1=1 
					";
					
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
				
			$sql.=" AND A.payment_status='Y' AND is_later='Y' AND order_status !='Cancelled' AND order_status !='Completed' ";
			
			$sql.=" AND delivery_time > '$date' ";	
				
			$sql.=" ORDER BY delivery_time ASC ";		
			
			//echo $sql;
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
	public function setTable($table){
			$this->_table = $table;
	}
	public function getAllOrders($restaurant_id,$location_id,$role){
			$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
					FROM fk_order_master A
					LEFT JOIN fk_member_master B on A.member_id=B.member_id
					LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
					 WHERE  
					";
					
			if($role=='3')		
				$sql.= " A.location_id=$location_id	";
			
			$sql.=" AND A.payment_status='Y'";				
			$sql.=" ORDER BY delivery_time ASC ";		
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
	public function getCancelledOrders($restaurant_id,$location_id,$num,$offset,$role){
			$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
					FROM fk_order_master A
					LEFT JOIN fk_member_master B on A.member_id=B.member_id
					LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
					WHERE C.restaurant_id = $restaurant_id 
					AND order_status='Cancelled'
					";
			
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
		
			$sql.=" AND A.payment_status='Y' ";		
			$sql.=" ORDER BY delivery_time ASC ";	
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
    public function getActiveOrders($restaurant_id,$location_id,$searchOrder,$role){
			$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
					FROM fk_order_master A
					LEFT JOIN fk_member_master B on A.member_id=B.member_id 
					LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
					WHERE order_status='".$searchOrder."'
	
					";
					
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
				
			$sql.=" AND A.payment_status='Y' ";	
			
			$sql.=	" ORDER BY delivery_time ASC ";
					
			$query = $this->db->query($sql);
			//echo  $this->db->last_query(); exit;	
			return $query->result_array();	
	}
	public function cancelOrder($order_id,$refund_amount){
			$sql = "UPDATE fk_order_master SET order_status='Cancelled',refund_amount=$refund_amount WHERE order_id=$order_id";
			$query = $this->db->query($sql);
			return true;	
	}	

}