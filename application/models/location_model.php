<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Location_model extends MY_Model { 	
public $_table = 'fk_restaurant_locations';
	
public function setTable($table){
		$this->_table = $table;
}

public function getLocationDet($location_id='',$restaurant_id){ 
        $this->db->select('fk_member_admins.*,fk_restaurant_locations.*, fk_restaurant_opening_times.*');
        $this->db->from('fk_member_admins');
        $this->db->where('fk_member_admins.restaurant_id',$restaurant_id);
        $this->db->join('fk_restaurant_locations', 'fk_member_admins.location_id=fk_restaurant_locations.location_id');
		$this->db->join('fk_restaurant_opening_times', 'fk_member_admins.location_id=fk_restaurant_opening_times.location_id','LEFT');
        $this->db->where('fk_restaurant_locations.location_id',$location_id);
        $query = $this->db->get();
		$query =  $query->row_array();	
		//echo $this->db->last_query();
        return $query;
}
public function adddetails($table,$data){ 

		$this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
		//echo($insert_id);exit;
		return $insert_id;
}
	
public function usernameExist($username)
{
	
	$this->db->where('username', $username);
    $this->db->from('fk_member_admins');
    return $this->db->count_all_results();
	
}
public function getLocationCount($restaurant_id,$key=''){
		
	$sql="SELECT COUNT(*) as num FROM fk_restaurant_locations WHERE restaurant_id=$restaurant_id";
	if($key != ''){
			$sql .= " AND (fk_restaurant_locations.restaurant_name LIKE '%$key%' OR 
					  fk_restaurant_locations.address LIKE '%$key%')";
					}
					
	$query = $this->db->query($sql);
	
	$result=$query->row_array();	
	return  $result['num'];	
	

}	
public function getAllLocations($restaurant_id,$status,$key,$num,$offset){
		$chef_role = $this->config->item('chef_role_id')?$this->config->item('chef_role_id'):3;
		$start = $start?$start:0;
		$sql = "SELECT fk_restaurant_master.*,fk_restaurant_locations.*, fk_member_admins.username
		  		FROM fk_restaurant_master
				LEFT JOIN  fk_restaurant_locations 
					ON (fk_restaurant_master.restaurant_id=fk_restaurant_locations.restaurant_id )
				LEFT JOIN  fk_member_admins 
					ON (fk_member_admins.location_id=fk_restaurant_locations.location_id )	
				WHERE fk_restaurant_locations.restaurant_id=$restaurant_id ";
		
		if($status)
			$sql .= " AND fk_restaurant_locations.is_clossed = '$status' ";
		
		if($key != ''){
			$sql .= " AND (fk_restaurant_locations.restaurant_name LIKE '%$key%' OR 
					  fk_restaurant_locations.address LIKE '%$key%' OR 
					  fk_member_admins.username LIKE '%$key%' OR 
					  fk_restaurant_locations.city LIKE '%$key%' OR 
					  fk_restaurant_locations.state LIKE '%$key%'OR 
					  fk_restaurant_locations.zip_code LIKE '%$key%')";	
		}
		
		$sql .= " GROUP BY fk_restaurant_locations.location_id";

		if($offset)
			$sql.=" limit $offset,$num";
		else
			$sql.=" limit $num";	
	//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->result_array();
			
}
public function getAllDetails($res_id){

		$this->db->select('fk_restaurant_locations.*,fk_restaurant_master.*');
        $this->db->from('fk_restaurant_locations');
        $this->db->join('fk_restaurant_master', 'fk_restaurant_locations.restaurant_id=fk_restaurant_master.restaurant_id');
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
public function UpdateTimeDetails($table,$data,$where){

		//print_r($data);exit; 
		$this->db->where($where);
		$this->db->update($table, $data);
		return true;
		
}

public function bulkDelete($location_id){
		
	   if(is_array($location_id))
	   {
		$location_id=implode(",",$location_id);
	
		}

		$sql = "DELETE FROM fk_restaurant_locations 
				WHERE fk_restaurant_locations.location_id IN($location_id)";
		$query = $this->db->query($sql);

}
public function getTimeDet($location_id,$day){

			
		$sql = "SELECT day FROM `fk_restaurant_opening_times` WHERE  location_id =$location_id AND day ='$day'";
		//echo $sql;
		$query = $this->db->query($sql);
      	$query =  $query->row_array();	
       	return $query;
		
}
public function getLocationTimeDet($location_id){ 
        $this->db->select('fk_restaurant_opening_times.*');
        $this->db->from('fk_restaurant_opening_times');
        $this->db->where('fk_restaurant_opening_times.location_id',$location_id);
        $query = $this->db->get();
		$query =  $query->result_array();	
		//echo $this->db->last_query();
		//print_r($query);exit;
        return $query;
}
public function deleteTimeDet($location_id){

		$sql = "DELETE FROM fk_restaurant_opening_times 
				WHERE fk_restaurant_opening_times.location_id =$location_id";
		$query = $this->db->query($sql);

}
public function getAllTimezone(){

		$this->db->select('*');
        $this->db->from('fk_timezone_master');
        $query = $this->db->get();
		$query =  $query->result_array();	
        return $query;
		
}
	public function get_where($table, $data,$type = "row"){	
		//$query   = $this->db->order_by($order_by)->get_where($table, $data);
		$query   = $this->db->get_where($table, $data);
		if($type == "row")
		{
			return  $query->row_array();
		}else{
		
			return $query->result_array();
		}
		
	}	
}
?>