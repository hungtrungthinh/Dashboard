<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Restaurant_model extends MY_Model { 	
public $_table = 'fk_restaurant_master';
	
public function setTable($table){
		$this->_table = $table;
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
		
public function adddetails($table,$data){ 
		$this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
}
	
public function usernameExist($username)
{
	
	$this->db->where('username', $username);
    $this->db->from('fk_member_admins');
    return $this->db->count_all_results();
	
}
public function getRestaurantCount($key=''){
		
	//return $this->db->count_all_results('fk_restaurant_master');
	$sql="SELECT COUNT(*) as num FROM fk_restaurant_master WHERE status='Y'";
	if($key != ''){
			$sql .= " AND (fk_restaurant_master.name LIKE '%$key%' OR 
					  fk_restaurant_master.phone LIKE '%$key%' OR 
					  fk_restaurant_master.address LIKE '%$key%')";
					}
					
	$query = $this->db->query($sql);
	$result=$query->row_array();	
	return  $result['num'];	
	

}	
public function getRestaurantLists($status,$key,$num,$offset){
		$manager_role = $this->config->item('manager_role_id')?$this->config->item('manager_role_id'):2;
		$start = $start?$start:0;
		$sql = "SELECT fk_member_admins.admin_id, fk_member_admins.full_name, 
					fk_member_admins.username, fk_restaurant_master.restaurant_id, 
					fk_restaurant_master.name,fk_restaurant_master.phone,fk_restaurant_master.status
		  		FROM fk_member_admins
				INNER JOIN fk_restaurant_master 
					ON (fk_member_admins.restaurant_id=fk_restaurant_master.restaurant_id AND fk_member_admins.role = $manager_role)
				WHERE 1=1 ";
		
		if($status)
			$sql .= " AND fk_restaurant_master.status = '$status' ";
		
		if($key != ''){
			$sql .= " AND (fk_restaurant_master.name LIKE '%$key%' OR 
					  fk_restaurant_master.address LIKE '%$key%' OR 
					  fk_member_admins.username LIKE '%$key%'OR 
					  fk_member_admins.full_name LIKE '%$key%')";	
		}
		
		$sql .= " GROUP BY fk_restaurant_master.restaurant_id";
		
		if($offset)
			$sql.=" limit $offset,$num";
		else
			$sql.=" limit $num";	
		
		
		$query = $this->db->query($sql);
		return $query->result_array();
			
}
public function getAllDetails($res_id){
	
	
		
		$this->db->select('fk_member_admins.*,fk_restaurant_master.*');
        $this->db->from('fk_member_admins');
        $this->db->join('fk_restaurant_master', 'fk_member_admins.restaurant_id=fk_restaurant_master.restaurant_id');
        $this->db->where('fk_restaurant_master.restaurant_id',$res_id);
        $query = $this->db->get();
		$query =  $query->row_array();	
        return $query;
		
}

public function UpdateDetails($table,$data,$where){

		$this->db->where($where);
		$this->db->update($table, $data);
		return true;
		
		
}

public function bulkDelete($res_id){
		
	   if(is_array($res_id))
	   {
		$res_id=implode(",",$res_id);
	
		}

		$sql = "DELETE FROM fk_member_admins,fk_restaurant_master USING 
				fk_member_admins INNER JOIN fk_restaurant_master on 
				(fk_member_admins.restaurant_id = fk_restaurant_master.restaurant_id)
				WHERE fk_restaurant_master.restaurant_id IN($res_id)";
		$query = $this->db->query($sql);


		
}
public function bulkUpdate($res_id,$status){
	
	$res_id=implode(",",$res_id['restaurant_id']);
	$status=($status['status']);
	$sql = "UPDATE fk_restaurant_master SET `status`='$status' WHERE restaurant_id IN ($res_id)";
	$query = $this->db->query($sql);
	echo $this->db->last_query(); 
		
}

public function getRestaurant()
{
	$sql = "SELECT restaurant_id,name FROM fk_restaurant_master";
	
	$result =  $this->db->query($sql);
	$results =  $result->result_array();	
	return $results;
}

}
?>