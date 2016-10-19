<?php 
class Client_model extends CI_Model {

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
	
	
	public function get_where($table, $data, $order_by = "id ASC", $type = "row"){	
		
		$query   = $this->db->order_by($order_by)->get_where($table, $data);
		
		if($type == "row")
		{
			return  $query->row_array();
		}else{
		
			return $query->result_array();
		}
		
	}	
	
	
	public function updateUser($data){
	
		$user_id 			= $data['member_id'];
		
		$this->db->update('fk_member_master',array('password'=>$data['password']),array('member_id'=>$user_id));
		
		return $this->getUserDetails($user_id);
		
	}
	
	public function getUserDetails($id)
	{
		$this->db->select('*');
		$this->db->from('fk_member_master');
	//	$this->db->join("member_details","member_details.member_id=member_master.member_id","left");
		$this->db->where('fk_member_master.member_id', $id); 
		$result = $this->db->get();
		//echo $str = $this->db->last_query();
		$resu=$result->result_object();
		return $resu[0];		
	}
		#function to generate random Password
	function randomPassword()
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
	
	public function cancelOrder($order_id){
			$sql = "UPDATE fk_order_master SET order_status='Cancelled' WHERE order_id=$order_id";
			$query = $this->db->query($sql);
			return true;	
	}
	
	
	public function favouriteLists($member_id,$location_id){
			$sql = "SELECT fk_member_fav_items.fav_id,dc.category_id,dc.category_name,dc.location_id,dc.restaurant_id,
					di.item_id,di.item_description,di.item_name,
					(SELECT MIN(price) as price from fk_dish_item_size_map where item_id=di.item_id) as price
					FROM fk_member_fav_items 
					INNER JOIN fk_dish_items_master di
					ON fk_member_fav_items.item_id = di.item_id
					INNER JOIN fk_dish_category_master dc  
					ON(dc.category_id = di.category_id)
					WHERE fk_member_fav_items.member_id=$member_id
					AND dc.location_id=$location_id
					AND dc.status = 'Y' 
					AND di.status='Y' 
					ORDER BY fk_member_fav_items.created_time DESC
					";
			$query = $this->db->query($sql);
			$res	=	$query->result_array();
			return $res;
	}
	
	public function removeFavourite($member_id,$item_id)
	{
		$sql = "DELETE FROM fk_member_fav_items  WHERE fk_member_fav_items.member_id=$member_id and fk_member_fav_items.item_id=$item_id";
		$query = $this->db->query($sql);
		return ;
	}
	public function isFavItem($member_id,$item_id)
	{
		$sql = "SELECT fav_id FROM fk_member_fav_items  WHERE fk_member_fav_items.member_id=$member_id and fk_member_fav_items.item_id=$item_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	public function getAllOders($member_id,$loc_id,$offset,$order_id='',$limit){
			
			$server_timezone = date_default_timezone_get();
			if($server_timezone=='GMT')
			{
			$server_offset = '+0:00';
			}
			else
			{
			$dateTimeZone= new DateTimeZone($server_timezone);
			$date = new DateTime("now", $dateTimeZone);
			$server_offset = $dateTimeZone->getOffset($date);
			}
		 
			$sql = "SELECT DISTINCT OM.order_id,
						   OM.order_ref_id,
						   OM.restaurant_id,
						   OM.location_id,
						   rl.restaurant_name,
						   rl.phone as rest_phone,
						   rl.address as rest_address,
						   rl.city as rest_city,
						   rl.state as rest_state,
						   rl.zip_code as rest_zip_code,
						   rm.restaurant_fb_link,
						   OM.member_id,
						   OM.total_amount,
						   OM.sub_total,
						   OM.discount_amount,
						   OM.tax_amount,
						   OM.refund_amount,
						   OM.delivery_service_amount,
						   OM.order_status,
						   OM.payment_status,
						   OM.order_type,
						   OM.is_later,
						   OM.delivery_time,
						   OM.tip,
						   da.address,
						   da.apartment,
						   da.zipcode,
						   da.city,
						   da.phone,
						   da.state,
						   da.notes,
						   sm.last_4digit,
						   mm.phone as contact_phone,
						   DATE_FORMAT(CONVERT_TZ(OM.created_time,'".$server_offset."','".$offset."'),'%Y-%m-%d %H:%i:%s') as created_time
						   FROM fk_order_master OM
						   LEFT JOIN fk_delivery_address da
						   ON da.order_id =  OM.order_id
						   LEFT JOIN fk_order_stripid_map sm
						   ON sm.order_id =  OM.order_id
						   LEFT JOIN fk_restaurant_locations rl
						   ON rl.location_id =  OM.location_id
						   LEFT JOIN fk_restaurant_master rm
						   ON rm.restaurant_id =  OM.restaurant_id
						   LEFT JOIN fk_member_master mm
						   ON mm.member_id =  OM.member_id
					WHERE  OM.member_id = '$member_id' and OM.status='Y'";
			if($loc_id)
			{
				$sql.=" and OM.location_id=".$loc_id;
			}		
			if($order_id!='')
				$sql.=" and OM.order_id=".$order_id;
					
			 $sql.=" ORDER BY OM.created_time DESC 
					";
					
			if($limit)
				$sql.= " LIMIT 0,$limit";
				
			$query = $this->db->query($sql);
			$res	=	$query->result_array();
			return $res;
	}

	public function getAllOderItemDetails($order_id){
			$sql = "SELECT OI.*,DIM.* FROM fk_order_items OI
					LEFT JOIN fk_dish_items_master DIM on DIM.item_id=OI.item_id 
					WHERE OI.order_id = '$order_id'
					";
			$query = $this->db->query($sql);
			$res	=	$query->result_array();
			return $res;
	}
	public function getOderItemDetails($order_item_id){
			$sql = "SELECT OI.*,DIM.* FROM fk_order_items OI
					LEFT JOIN fk_dish_items_master DIM on DIM.item_id=OI.item_id 
					WHERE OI.ord_item_id = '$order_item_id'
					";
			$query = $this->db->query($sql);
			$res	=	$query->row_array();
			return $res;
	}
	public function getAllOderSidesDetails($ord_item_id){
			$sql = "SELECT * FROM fk_order_option_map 
					WHERE ord_item_id = '$ord_item_id' ORDER BY sortorder ASC
					";
			$query = $this->db->query($sql);
			$res	=	$query->result_array();
			return $res;
	}
	public function getAllOderSidesDetailsSort($ord_item_id){
			$sql = "SELECT OM.*, OI.item_id, IM.sortorder as sort 
			FROM fk_order_option_map OM 
			INNER JOIN fk_order_items OI on OI.ord_item_id = OM.ord_item_id 
			INNER JOIN fk_dish_options IM on IM.dish_item_id = OI.item_id 
			AND IM.option_name=OM.options
			WHERE OM.ord_item_id ='$ord_item_id'
			ORDER BY sort ASC
			";
			$query = $this->db->query($sql);
			$res	=	$query->result_array();
			return $res;
	}
	
			
	function get_categary_list()
	{
	 		$sql   = "select *  from category_master WHERE  status ='Y' ";	
			$query	=	$this->db->query($sql);
			$res	=	$query->result_array();
	 		return $res;
		
	}
	

	

	public function getRestaurant($data,$radius)
	{
		
		if($data['lat'] && $data['long'])
		{
			$sql = "SELECT * FROM (SELECT r.location_id,r.restaurant_id,r.restaurant_name,r.description,
					 (case when (r.type ='Both' ) THEN 'Delivery - Pickup' ELSE r.type  END) as type ,
					r.address,r.phone,r.latitude,r.longitude,r.city,r.state,r.zip_code,
			(
				  3959 * acos (
				  cos ( radians(".$data['lat'].") )
				  * cos( radians( latitude ) )
				  * cos( radians( longitude ) - radians(".$data['long'].") )
				  + sin ( radians(".$data['lat'].") )
				  * sin( radians( latitude ) )
				)
			) AS distance FROM fk_restaurant_locations  r
			  INNER JOIN fk_restaurant_master rm 
			  ON r.restaurant_id = rm.restaurant_id
			  LEFT JOIN fk_dish_category_master  dc
			  ON r.location_id = dc.location_id
			  WHERE  r.latitude!=0 and r.longitude!=0 and rm.status='Y' and  r.restaurant_id =".$data['restaurant_id']." and r.is_clossed='N' GROUP BY r.location_id ) temp ";
			  
			  if($radius!=0)
			  	$sql .= " WHERE temp.distance<=".$radius ;
			  
			  $sql.=" ORDER BY temp.distance";
			
			
		}
		else
		{
			 $sql = "SELECT r.location_id,r.restaurant_id,r.restaurant_name,r.description,
			 (case when (r.type ='Both' ) THEN 'Delivery - Pickup' ELSE r.type  END) as type ,
			  r.address,r.city,r.state,r.zip_code,r.phone,r.latitude,r.longitude
			  FROM fk_restaurant_locations  r
			  INNER JOIN fk_restaurant_master rm 
			  ON r.restaurant_id = rm.restaurant_id
			  LEFT JOIN fk_dish_category_master  dc
			  ON r.location_id = dc.location_id
			  WHERE  r.latitude!=0 and r.longitude!=0 and rm.status='Y' and  r.restaurant_id =".$data['restaurant_id']." and r.is_clossed='N'  GROUP BY r.location_id ";
		}
		$query	=	$this->db->query($sql);
		$res	=	$query->result_array();
		
		return $res;
	}
	
	public function getRestaurantDetails($location_id){
		$sql = "SELECT r.location_id,r.restaurant_id,r.restaurant_name,r.description,
			 (case when (r.type ='Both' ) THEN 'Delivery - Pickup' ELSE r.type  END) as type ,
			  r.address,r.city,r.state,r.zip_code,r.is_clossed as is_not_valid,r.timezone,r.phone,r.latitude,r.longitude,GROUP_CONCAT(DISTINCT dc.category_name) as category_name 
			  FROM fk_restaurant_locations  r
			  INNER JOIN fk_restaurant_master rm 
			  ON r.restaurant_id = rm.restaurant_id
			  LEFT JOIN fk_dish_category_master  dc
			  ON r.location_id = dc.location_id
			  WHERE  rm.status='Y' and  r.location_id ='".$location_id."'  GROUP BY r.location_id ";
		//echo $sql;exit;	  
		$query	=	$this->db->query($sql);
		$res	=	$query->row_array();
			
		return $res;
	}
	public function getRestaurantMenu($data)
	{
		$res = array();
		if($data['location_id']){
		
			$sql = 
			"		
				SELECT dc.category_id,dc.category_name,dc.location_id,dc.restaurant_id,dc.sortorder as category_sort,
				dc.subtitle,di.item_id,di.item_description,di.item_name,di.sortorder as dish_sort,
				(SELECT MIN(price) as price from fk_dish_item_size_map where item_id=di.item_id) as price
				FROM fk_dish_items_master di
				INNER JOIN fk_dish_category_master dc  
				ON(dc.category_id = di.category_id)
				WHERE dc.location_id = '".$data['location_id']."' 
				AND dc.restaurant_id='".$data['restaurant_id']."' 
				AND dc.status = 'Y' 
				AND di.status='Y' 
				ORDER BY category_sort,dish_sort
			";
		
			$query	=	$this->db->query($sql);
			$res	=	$query->result_array();
			
			return $res;
					
			
			}
	}
	
	public function getRestaurantMenuDetail($id)
	{
		$res = array();
		
		if($id){
		
			$sql = 
			"SELECT fk_dish_items_master.*,fk_restaurant_locations.location_id,fk_dish_options.option_id,fk_dish_options.option_name,
				fk_dish_options.sortorder,fk_dish_options.mandatory,fk_dish_options.multiple,fk_dish_options.limit,fk_option_sides.side_id,
				fk_option_sides.side_item,fk_option_sides.sortorder as sidesortorder,fk_option_sides.price as side_price		
				FROM fk_dish_items_master
				LEFT JOIN  fk_dish_options
				ON fk_dish_items_master.item_id=fk_dish_options.dish_item_id and fk_dish_options.status!='N'
				LEFT JOIN  fk_option_sides
				ON fk_option_sides.option_id = fk_dish_options.option_id
				INNER JOIN fk_dish_category_master
				ON fk_dish_items_master.category_id = fk_dish_category_master.category_id
				INNER JOIN fk_restaurant_locations
				ON fk_restaurant_locations.location_id = fk_dish_category_master.location_id
				WHERE fk_dish_items_master.item_id=$id and fk_dish_category_master.`status`='Y'
				and fk_dish_items_master.`status`='Y'
				ORDER BY fk_dish_options.sortorder,sidesortorder
			";
		
			$query	=	$this->db->query($sql);
			$res	=	$query->result_array();
			
		
			return $res;
				
			
			}
	}
	public function getRestaurantMenuSizeDetail($id){
		$sql=	"SELECT price,size
				FROM fk_dish_item_size_map
				WHERE item_id = $id
				ORDER BY price ASC
				";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function checkCartResId($id)
	{
		$sql=	"SELECT restaurant_id 
				FROM order_cart_items
				WHERE order_cart_items.member_id = $id
				GROUP BY restaurant_id";
		$result = $this->db->query($sql);
		return $result->row_array();
	
	}
	public function checkCartDetail($check_array)
	{
	
		$result = $this->db->get_where('order_cart_items',$check_array);
		if($result->num_rows()!=0)
		{
			return $result->row_array();
		}
		else
		{
			return 0;
		}
	}
	public function getCartQty($check_array)
	{
		
		$result = $this->getCartDetails($check_array);
		return count($result);
	}
	
	public function addCartDetail($data)
	{
	
		$this->db->insert('order_cart_items',$data);
		return $this->db->insert_id();
	}
	
	public function updateCartDetail($data,$check_array)
	{
		$this->db->where($check_array);
		$this->db->update('order_cart_items',$data);
		
	}
	
	public function removeCartDetail($check_array)
	{
		$this->db->where($check_array);
		$this->db->delete('order_cart_items');
	}
	public function getCartDetails($check_array)
	{
		$sql = "SELECT order_cart_items.cart_id,
						dish_items_master.item_id,
						dish_items_master.item_name,
						dish_item_size_map.size,
						dish_item_size_map.price,
						order_cart_items.quantity,
						order_cart_items.item_size,
						order_cart_items.restaurant_id,
						order_cart_items.quantity * dish_item_size_map.price as item_total
			FROM order_cart_items
			INNER JOIN dish_items_master
			ON dish_items_master.item_id = order_cart_items.item_id
			INNER JOIN dish_item_size_map
			ON dish_item_size_map.map_id = order_cart_items.item_size
			WHERE dish_items_master.`status`='Y' and dish_item_size_map.`status`='Y' and order_cart_items.member_id = ".$check_array['member_id'];
			
		$result = $this->db->query($sql);
		
		return $result->result_array();
	}
	
	public function deleteInactiveItems($check_array)
	{
		$sql = "DELETE order_cart_items FROM order_cart_items
				INNER JOIN dish_items_master
				ON dish_items_master.item_id = order_cart_items.item_id
				INNER JOIN dish_category_master
				ON dish_category_master.category_id = dish_items_master.category_id
				WHERE  ( dish_category_master.`status`='N' || dish_items_master.`status`='N' )  and order_cart_items.member_id = ".$check_array['member_id'];
			
		$result = $this->db->query($sql);
	}
	public function getCartTotal($check_array)
	{
		$sql = "SELECT SUM(order_cart_items.quantity * dish_item_size_map.price) as total
			FROM order_cart_items
			INNER JOIN dish_items_master
			ON dish_items_master.item_id = order_cart_items.item_id
			INNER JOIN dish_item_size_map
			ON dish_item_size_map.map_id = order_cart_items.item_size
			WHERE dish_items_master.`status`='Y' and dish_item_size_map.`status`='Y' and order_cart_items.member_id = ".$check_array['member_id']." GROUP BY order_cart_items.member_id";
			
		$result = $this->db->query($sql);
		
		return $result->row_array();
	}
	
	
	public function getOrderRefId()
	{
		$this->db->select_max('order_ref_id');
		$result = $this->db->get('order_master')->row();  
		$ref_id = $result->order_ref_id ;
		if($ref_id < 10000)
		{
			$ref_id = 10001;
		}
		else
		{
			$ref_id = $ref_id+1;
		}
		return $ref_id;
	}
	
	public function insertOrder($data)
	{
		$this->db->insert('order_master',$data);
		return $this->db->insert_id();
	}
	
	public function insertOrderItem($data)
	{
		$this->db->insert('order_items',$data);
		return $this->db->insert_id();
	}
	
	public function getPendingOrder($user_id)
	{
		if($user_id)
		{
		$result = $this->db->get_where('order_master',array('member_id'=>$user_id,'order_status'=>'Pending'));
		if($result->num_rows()!=0)
		{
			return $result->row()->order_id;
		}
		}
		else
		{
		return 0;
		}
	}
	
	public function deletePendingOrder($order_id)
	{
		if($order_id)
		{
			$this->db->where('order_id',$order_id);
			$this->db->delete('order_master');
			
			$this->db->where('order_id',$order_id);
			$this->db->delete('order_items');
		}		
	}
	
	public function getOrderItems($order_id)
	{
		if($order_id)
		{
			$sql = "SELECT  order_items.order_id,
							dish_items_master.item_id,
							dish_items_master.item_name,
							dish_item_size_map.size,
							dish_item_size_map.price,
							order_items.quantity,
							order_items.item_size,
							order_items.price
				FROM order_items
				INNER JOIN dish_items_master
				ON dish_items_master.item_id = order_items.item_id
				INNER JOIN dish_item_size_map
				ON dish_item_size_map.map_id = order_items.item_size
				WHERE order_items.order_id = ".$order_id ;
				
			$result = $this->db->query($sql);
			
			return $result->result_array();
		}
	}
	
	public function getFinalOrder($user_id,$order_ref_id)
	{
		if($user_id)
		{
		$result = $this->db->get_where('order_master',array('member_id'=>$user_id,'order_ref_id'=>$order_ref_id,'order_status'=>'Pending'));
		if($result->num_rows()!=0)
		{
			return $result->row()->order_id;
		}
		}
		else
		{
		return 0;
		}
	}
	
	public function setOrderSucess($order_id)
	{
		if($order_id)
		{
			
			$this->db->where('order_id',$order_id);
			$this->db->update('order_master',array('order_status'=>'New'));
			
			$this->db->where('order_id',$order_id);
			$this->db->delete('order_cart_items');
			
		}
	}
	
	public function getOrder($order_ref_id)
	{
		$this->db->where('order_ref_id',$order_ref_id);
		$result = $this->db->get('order_master');
		return $result->row_array();
	}
	
	public function getDetailOrder($order_id){
		$sql = "SELECT MM.first_name,MM.last_name,MM.auth_type,RL.restaurant_name,RL.type,OM.order_status,OM.order_id,OM.order_ref_id,OM.created_time
				FROM fk_order_master OM 
				LEFT JOIN fk_member_master MM ON OM.member_id = MM.member_id
				LEFT JOIN fk_restaurant_locations RL ON OM.location_id = RL.location_id
				WHERE OM.order_id =$order_id";	
				//echo $sql;exit;
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	public function getDetailOption($ord_item_id ){
		$sql = "SELECT * 
				FROM fk_order_option_map
				WHERE ord_item_id  =$ord_item_id";	
				//echo $sql;exit;
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	public function getDetailItem($order_id){
		$sql = "SELECT OI.*,DIM.*
				FROM fk_order_items OI
				LEFT JOIN fk_dish_items_master DIM ON OI.item_id = DIM.item_id
				WHERE OI.order_id =$order_id";	
				$query = $this->db->query($sql);
				return $query->result_array();	
		
	}
	
	public function getDeliveryAddress($id)
	{
		$sql=  "SELECT da.address,da.city,da.zipcode,da.notes,da.created_date,da.status,da.state FROM fk_delivery_address da 
				LEFT JOIN fk_order_master om ON da.order_id = om.order_id
				WHERE om.member_id = $id
				ORDER BY created_date DESC
				LIMIT 0,1";
		$result = $this->db->query($sql);
	
		return $result->row_array();
	}
	public function getRestaurantTimeDetails($location_id,$offset,$rest_offset){
		
		$sql = "SELECT day,start_at,end_at,break_start_at, break_end_at, is_break FROM  (
				SELECT day,start_at,end_at,break_start_at,break_end_at,is_break  	FROM fk_restaurant_opening_times
				WHERE location_id  = $location_id
				UNION 
				
				SELECT day_name,start_at,end_at,break_start_at, break_end_at, is_break
								FROM fk_days_name
				WHERE
				fk_days_name.day_name NOT IN(SELECT day
				FROM fk_restaurant_opening_times
				WHERE location_id  =$location_id)) tmp ORDER BY FIELD(day, 'sunday', 'monday', 'tuesday','wednesday','thursday','friday','saturday')";	
				
				/*$sql = "SELECT day,start_at,end_at,start_at_convert ,end_at_convert FROM  (
				SELECT day,start_at as start_at,end_at as end_at,DATE_FORMAT(CONVERT_TZ(CONCAT(CURDATE(),' ',start_at),'".$rest_offset."','".$offset."'),'%H:%i:%s') as start_at_convert,DATE_FORMAT(CONVERT_TZ(CONCAT(CURDATE(),' ',end_at),'".$rest_offset."','".$offset."'),'%H:%i:%s') as end_at_convert  FROM fk_restaurant_opening_times
				WHERE location_id  = $location_id
				UNION 
				
				SELECT day_name,start_at,end_at,start_at,end_at 
								FROM fk_days_name
				WHERE
				fk_days_name.day_name NOT IN(SELECT day
				FROM fk_restaurant_opening_times
				WHERE location_id  =$location_id)) tmp ORDER BY FIELD(day, 'sunday', 'monday', 'tuesday','wednesday','thursday','friday','saturday')";	*/
				
				//echo '<pre>';echo $sql;exit;
				$query = $this->db->query($sql);
				return $query->result_array();	
	}
	
	public function getPromocode($data)
	{
		$this->db->where($data);
		$result = $this->db->get('fk_promocodes');
		return $result->row_array();	
		
	}
	
	public function updatePromoCount($id,$promocode,$restaurant_id)
	{
		$this->db->where(array('promocode'=>$promocode,'restaurant_id'=>$restaurant_id));
		$result = $this->db->get('fk_promo_order_map');
		$count = $result->num_rows();
		
		$this->db->where('promo_id', $id);
		$this->db->update('fk_promocodes', array('total_uses'=>$count));
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
	
	public function getCustomerStripId($data)
	{
		$this->db->order_by("created_time", "desc");
		$this->db->where(array('member_id'=>$data['member_id'],'restaurant_id'=>$data['restaurant_id'],'location_id'=>$data['location_id']));
		$query = $this->db->get('fk_order_stripid_map');	
		return $query->result_array();	
	}
	public function getSalesTaxRestaurant($restaurant_id)
	{
		$sql = "SELECT * FROM `fk_preferences` 
				WHERE `field`=(
				SELECT id FROM `fk_general_config` 
				WHERE `field`='sales_tax_percentage')
				AND  	restaurant_id =	$restaurant_id";	
		//echo $sql;exit;
		$query 	= $this->db->query($sql);
		$result	= $query->row_array();	
		if(count($result)!=0){
			return $result;
		}else{
			$sql2 = "SELECT * FROM `fk_general_config` 
					WHERE `field`='sales_tax_percentage'";	
			//echo $sql;exit;
			$query2 	= $this->db->query($sql2);
			$result2	= $query2->row_array();	
			return $result2;
		}
	}

	public function getForkourseStripeKey()
	{		
		$query = $this->db->get_where('fk_general_config', array('field' => 'sales_stripe_public_key'));
		$row = $query->row();
		$public_key = (is_null($row)) ? null : $row->value; 

		$query = $this->db->get_where('fk_general_config', array('field' => 'sales_stripe_private_key'));
		$row = $query->row();
		$private_key = (is_null($row)) ? null : $row->value; 
		return array(
					'public_key' => $public_key,
					'private_key' => $private_key
				);
	}


	public function getCustomerStripInfoForForkourse($customer_id)
	{
		$query = $this->db->get_where('fk_order_stripid_map_forkourse', array('customer_id' => $customer_id));
		return (count($query->row_array()) > 0) ? $query->row_array() : null; 
	}
	
	public function setCustomerStripInfoForForkourse($stripData)
	{
		return $this->db->insert('fk_order_stripid_map_forkourse', $stripData);
	}
}