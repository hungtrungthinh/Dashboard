<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Order_model extends MY_Model { 	
public $_table = 'fk_order_master';
	
	public function setTable($table){
			$this->_table = $table;
	}
	
	
	public function getOrderDetails($restaurant_id,$location_id,$num,$offset,$role){
		$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
				FROM fk_order_master A
				LEFT JOIN fk_member_master B on A.member_id=B.member_id 
				LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
				WHERE order_status='New' 
				";
		if($role=='3')		
			$sql.= " AND  A.location_id=$location_id	";
		else
			$sql.= " AND  A.restaurant_id=$restaurant_id	";		
		$sql.=" AND A.payment_status='Y' ";
		$sql.=" ORDER BY delivery_time ASC ";
		
		if($offset)
			$sql.="limit $offset,$num";
		else
			$sql.="limit $num";		
		//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	public function countNewOrders($restaurant_id,$location_id,$role){
			$sql = "SELECT count(*) as num
					FROM fk_order_master A
					WHERE order_status='New' AND A.payment_status='Y'";
			if($role=='3')		
				$sql.= " AND  location_id=$location_id	";
			else
				$sql.= " AND  restaurant_id=$restaurant_id	";
				
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}
	
	public function getActiveOrders($restaurant_id,$location_id,$searchOrder,$num,$offset,$role){
			$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
					FROM fk_order_master A
					LEFT JOIN fk_member_master B on A.member_id=B.member_id 
					LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
					WHERE order_status='".$searchOrder."'
	
					";
					
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
			else
				$sql.= " AND  A.restaurant_id=$restaurant_id	";	
				
			$sql.=" AND A.payment_status='Y' ";	
			
			$sql.=	" ORDER BY delivery_time ASC ";
			
					
			if($offset)
				$sql.="limit $offset,$num";
			else
				$sql.="limit $num";			
					
			$query = $this->db->query($sql);
			//echo  $this->db->last_query(); exit;	
			return $query->result_array();	
	}
	
	public function countActiveOrders($restaurant_id,$location_id,$searchOrder,$role){
			$sql = "SELECT count(*) as num
					FROM fk_order_master A
					WHERE order_status='".$searchOrder."'
					
					";
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
			else
				$sql.= " AND  A.restaurant_id=$restaurant_id	";
			
			$sql.=" AND A.payment_status='Y' ";
								
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}
	
	public function getCancelledOrders($restaurant_id,$location_id,$num,$offset,$role){
			$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
					FROM fk_order_master A
					LEFT JOIN fk_member_master B on A.member_id=B.member_id
					LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
					WHERE order_status='Cancelled'
					";
					
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
			else
				$sql.= " AND  A.restaurant_id=$restaurant_id	";		
				
			$sql.=" AND A.payment_status='Y' ";		
			$sql.=" ORDER BY delivery_time ASC ";		
			if($offset)
				$sql.="limit $offset,$num";
			else
				$sql.="limit $num";
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
	public function getLateOrders($restaurant_id,$location_id,$num,$offset,$role){
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
			else
				$sql.= " AND  A.restaurant_id=$restaurant_id	";		
				
			$sql.=" AND A.payment_status='Y' AND is_later='Y' AND order_status !='Cancelled' AND order_status !='Completed' ";
			
			$sql.=" AND delivery_time > '$date' ";	
				
			$sql.=" ORDER BY delivery_time ASC ";		
			if($offset)
				$sql.="limit $offset,$num";
			else
				$sql.="limit $num";
			//echo $sql;
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
	public function countCancelledOrders($restaurant_id,$location_id,$role){
			$sql = "SELECT count(*) as num
					FROM fk_order_master A
					WHERE order_status='Cancelled'
					";
					
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
			else
				$sql.= " AND  A.restaurant_id=$restaurant_id	";			
			$sql.=" AND A.payment_status='Y' ";				
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}
	public function countLateOrders($restaurant_id,$location_id,$role){
			$date=date('Y-m-d');
			$date.=" 23:59:59";
			
			$sql = "SELECT count(*) as num
					FROM fk_order_master A
					WHERE order_status='New'
					";
					
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
			else
				$sql.= " AND  A.restaurant_id=$restaurant_id	";			
			$sql.=" AND A.payment_status='Y' AND is_later='Y'  AND order_status !='Cancelled' AND order_status !='Completed' ";	
			
			$sql.=" AND delivery_time > '$date' ";	
			
			//echo $sql;			
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}	
	public function getAllOrders($restaurant_id,$location_id,$num,$offset,$role){
			$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
					FROM fk_order_master A
					LEFT JOIN fk_member_master B on A.member_id=B.member_id
					LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
					 WHERE  
					";
					
			if($role=='3')		
				$sql.= " A.location_id=$location_id	";
			else
				$sql.= "   A.restaurant_id=$restaurant_id	";	
			$sql.=" AND A.payment_status='Y'";				
			$sql.=" ORDER BY delivery_time ASC ";		
			if($offset)
				$sql.="limit $offset,$num";
			else
				$sql.="limit $num";
				
			
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
	public function countAllOrders($restaurant_id,$location_id,$role){
			$sql = "SELECT count(*) as num
					FROM fk_order_master A
					WHERE 1=1
					";
					
			if($role=='3')		
				$sql.= " AND  A.location_id=$location_id	";
			else
				$sql.= " AND  A.restaurant_id=$restaurant_id	";			
			$sql.=" AND A.payment_status='Y' ";	
			//echo $sql;
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}	
	public function AllOrdersCount($restaurant_id,$location_id,$role){
		
		if($role=='3')		
			$query= " AND  fk_order_master.location_id=$location_id AND fk_order_master.payment_status='Y'";
		else
			$query= " AND  fk_order_master.restaurant_id=$restaurant_id	AND fk_order_master.payment_status='Y'";  
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
	public function acceptOrder($order_id){
		$sql = "UPDATE fk_order_master 
				SET order_status='Accepted' 
				WHERE order_id =$order_id";
		$query = $this->db->query($sql);
	    return true;	
	}
	public function completeOrder($order_id){
			$sql = "UPDATE fk_order_master SET order_status='Completed' WHERE order_id =$order_id";
			$query = $this->db->query($sql);
			return true;	
	}
	
	public function cancelOrder($order_id,$refund_amount){
			$sql = "UPDATE fk_order_master SET order_status='Cancelled',refund_amount=$refund_amount WHERE order_id=$order_id";
			$query = $this->db->query($sql);
			return true;	
	}
	public function refundOrder($order_id,$refund_amount){
			$sql = "UPDATE fk_order_master SET refund_amount=$refund_amount WHERE order_id=$order_id";
			$query = $this->db->query($sql);
			return true;	
	}
	public function getOrderInfo($order_id,$location_id){
		$sql = "SELECT OM.order_id,OM.order_ref_id,OM.member_id,OM.created_time,OM.total_amount,
				DIM.item_name,DIM.price,DIM.category_id,
				OI.unit_price,OI.quantity,OI.price,
				MM.first_name,MM.lasr_name
				FROM fk_order_master OM 
				LEFT JOIN fk_order_items OI ON OM.order_id = OI.order_id
				LEFT JOIN fk_dish_items_master DIM ON OI.item_id = DIM.item_id
				LEFT JOIN fk_member_master MM ON OM.member_id = MM.member_id
				WHERE OM.order_id =$order_id AND location_id='$location_id'";	
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	/*public function getDetailOrder($order_id){
		$sql = "SELECT MM.first_name,MM.last_name,MM.auth_type,OM.order_status,
				OM.created_time,RL.restaurant_name,RL.type,OI.*,DIM.*,DO.*
				FROM fk_order_master OM 
				LEFT JOIN fk_member_master MM ON OM.member_id = MM.member_id
				LEFT JOIN fk_restaurant_locations RL ON OM.location_id = RL.location_id
				LEFT JOIN fk_order_items OI ON OM.order_id = OI.order_id
				LEFT JOIN fk_dish_items_master DIM ON OI.item_id =DIM .item_id
				LEFT JOIN fk_dish_options DO ON OI.option_id = DO.option_id
				WHERE OM.order_id =$order_id";	
				//echo $sql;exit;
				$query = $this->db->query($sql);
				return $query->result_array();	
		state 	city 	zip_code
	}*/
	public function getDetailOrder($order_id){
		$sql = "SELECT MM.first_name,MM.last_name,MM.auth_type,MM.phone as 
		 member_phone,MM.email,RMs.device_token,RMs.device_platform,MM.allow_notification,RL.restaurant_name,
		 RL.address as res_address,RL.phone as res_phone,RL.state as res_state,RL.city as res_city,
		 RL.zip_code as res_zip,RL.type,RL.restaurant_id,RM.google_api_key,OM.order_type,DA.*,
		 OM.order_status,OM.order_id,OM.order_ref_id,OM.created_time,OM.delivery_time,OM.tip,OM.discount_amount,
		 OM.tax_amount,OM.sub_total,OM.refund_amount,OM.total_amount,OM.delivery_service_amount
		 FROM fk_order_master OM 
		 LEFT JOIN fk_delivery_address DA ON OM.order_id = DA.order_id 
		 LEFT JOIN fk_member_master MM ON OM.member_id = MM.member_id
		 LEFT JOIN fk_restaurant_locations RL ON OM.location_id = RL.location_id
		 LEFT JOIN fk_restaurant_master RM ON OM.restaurant_id = RM.restaurant_id
		 LEFT JOIN fk_restaurant_members RMs ON OM.restaurant_id = RMs.restaurant_id AND OM.member_id = RMs.membar_id
		 WHERE OM.order_id =$order_id";	
				//echo $sql;exit;
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
	public function getDetailOptionNew($ord_item_id){
		$sql = "SELECT * 
				FROM fk_order_option_map
				WHERE ord_item_id  =$ord_item_id 
				ORDER BY sortorder ASC";	
				
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	
	public function getDetailItem($order_id){
		$sql = "SELECT OI.*,DIM.item_id,DIM.category_id,DIM.item_name,DIM.item_description,DIM.status,DIM.sortorder
				FROM fk_order_items OI
				LEFT JOIN fk_dish_items_master DIM ON OI.item_id = DIM.item_id
				WHERE OI.order_id =$order_id ORDER BY DIM.sortorder ASC ";	
				//echo $sql;
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}

	public function searchOrder($restaurant_id,$location_id,$searchOrder,$num,$offset,$role){
		if($searchOrder=='')
			$searchOrder="Accepted";
		$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name 
				FROM fk_order_master A
				LEFT JOIN fk_member_master B on A.member_id=B.member_id 
				LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id
				WHERE order_status='".$searchOrder."'
				";
		if($role=='3')		
			$sql.= " AND  A.location_id=$location_id	";
		else
			$sql.= " AND  A.restaurant_id=$restaurant_id	";		
		
		$sql.=" ORDER BY order_id  DESC ";		
		if($offset)
			$sql.="limit $offset,$num";
		else
			$sql.="limit $num";			
				
		$query = $this->db->query($sql);
		
		
					
			//echo  $this->db->last_query(); exit;	
		return $query->result_array();	
	}
	public function getOrderDetailsAdmin($key,$id){
	
		/*$sql     = "SELECT fk_order_master.*,fk_restaurant_locations.restaurant_name, fk_member_master.first_name,fk_member_master.last_name,fk_member_master.auth_type,fk_restaurant_master.name
		  		    FROM fk_member_master INNER JOIN fk_order_master  
					INNER JOIN fk_restaurant_master on fk_restaurant_master.restaurant_id =fk_order_master.restaurant_id
					INNER JOIN fk_restaurant_locations
					ON (fk_member_master.member_id =  fk_order_master.member_id) AND  
					AND fk_restaurant_master.restaurant_id =fk_restaurant_locations.restaurant_id 
		  		    WHERE  1=1 AND fk_order_master.payment_status='Y' ";
		if($id != ''&& $id != 0 ){
			$sql	 .=" AND fk_member_master.restaurant_id=$id";
			}	
		if($key != ''){
		$sql  .= "  AND (fk_member_master.first_name LIKE '%$key%' OR 
				    fk_member_master.last_name LIKE '%$key%' OR 
				    fk_restaurant_master.name LIKE '%$key%') ";	
			
		}
		$sql  .= " GROUP BY fk_member_master.member_id  "	;	*/
		
		$sql="SELECT OM.*,RM.*,RL.*,MM.* FROM fk_order_master OM
			  LEFT JOIN fk_restaurant_master RM on RM.restaurant_id=OM.restaurant_id 
			  LEFT JOIN fk_restaurant_locations RL on RL.location_id=OM.location_id 
			  LEFT JOIN fk_member_master MM on MM.member_id=OM.member_id
			  WHERE OM.payment_status='Y' ";
       if($id != ''&& $id != 0 ){
			$sql	 .=" AND OM.restaurant_id=$id";
			}	
		if($key != ''){
		$sql  .= "  AND (MM.first_name LIKE '%$key%' OR 
				    MM.last_name LIKE '%$key%' OR 
				    RM.name LIKE '%$key%' OR
					RL.restaurant_name LIKE '%$key%' OR
					OM.order_status LIKE '%$key%' OR
					OM.order_type LIKE '%$key%') ";	
			
		} 


		//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->result_array();	
	}	
	
	public function getOwnerStripDetails($data)
	{	
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
			 WHERE  fk_order_master.order_id='$order_id' ";
			
		if($payment_mode)
			$sql.="and fk_order_stripid_map.payment_mode='$payment_mode'";
		
		$sql.=" ORDER BY fk_order_stripid_map.created_time DESC";
			
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	
}



?>