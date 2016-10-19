<?php 
class Client_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
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
					r.address,r.phone,r.latitude,r.longitude,
			(
				  3959 * acos (
				  cos ( radians(".$data['lat'].") )
				  * cos( radians( latitude ) )
				  * cos( radians( longitude ) - radians(".$data['long'].") )
				  + sin ( radians(".$data['lat'].") )
				  * sin( radians( latitude ) )
				)
			) AS distance, GROUP_CONCAT(DISTINCT dc.category_name) as category_name FROM fk_restaurant_locations  r
			  INNER JOIN fk_restaurant_master rm 
			  ON r.restaurant_id = rm.restaurant_id
			  LEFT JOIN fk_dish_category_master  dc
			  ON r.location_id = dc.location_id
			  WHERE  rm.status='Y' and  r.restaurant_id =".$data['restaurant_id']."  GROUP BY r.location_id ) temp ";
			  
			  if($radius!=0)
			  	$sql .= " WHERE temp.distance<=".$radius ;
			  
			  $sql.=" ORDER BY temp.distance";
			
			
		}
		else
		{
			 $sql = "SELECT r.location_id,r.restaurant_id,r.restaurant_name,r.description,
			 (case when (r.type ='Both' ) THEN 'Delivery - Pickup' ELSE r.type  END) as type ,
			  r.address,r.phone,r.latitude,r.longitude,GROUP_CONCAT(DISTINCT dc.category_name) as category_name 
			  FROM fk_restaurant_locations  r
			  INNER JOIN fk_restaurant_master rm 
			  ON r.restaurant_id = rm.restaurant_id
			  LEFT JOIN fk_dish_category_master  dc
			  ON r.location_id = dc.location_id
			  WHERE  rm.status='Y' and  r.restaurant_id =".$data['restaurant_id']."  GROUP BY r.location_id ";
		}
	
		$query	=	$this->db->query($sql);
		$res	=	$query->result_array();
			
		return $res;
	}
	
	public function getRestaurantMenu($data)
	{
		$res = array();
		
		if($data['id']){
		
			$sql = 
			"	SELECT dc.category_id,
						 dc.category_name,
						 dc.location_id,
						 dc.restaurant_id,
						 di.item_id,
						 di.item_description,
						 di.item_name,
						 di.price
						 FROM fk_dish_items_master di
						 INNER JOIN fk_dish_category_master dc  
						    ON(dc.category_id = di.category_id)
						 WHERE dc.location_id = ".$data['id']." and dc.restaurant_id=".$data['restaurant_id']."  and dc.status = 'Y' and di.status='Y' 
						 
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
				fk_option_sides.side_id,fk_option_sides.side_item,fk_option_sides.price as side_price
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
				ORDER BY item_id
			";
		
			$query	=	$this->db->query($sql);
			$res	=	$query->result_array();
			
			
			return $res;
					
			
			}
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
	
}