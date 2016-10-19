<?php 
class Admin_model extends MY_Model {
	
	public $_table = 'member_admins';
	
	public function __construct()
	{
		$this->_database = $this->db;
		$this->load->database();
	}
	public function setTable($table){
		$this->_table = $table;
	}
	
	public function getUser(){
	
		$this->db->select("*");
		$this->db->from("member_admins");
		$query = $this->db->get();
		return $query->row();
	}
	
	
	public function getadmindetail($username){

		$sql="select fk_member_admins.*,
					fk_role_master.role as role_name,fk_role_master.root as root,
					fk_restaurant_master.name as restaurant_name,
					fk_restaurant_master.header_color as  fk_restaurant_master_header,
					fk_restaurant_master.body_color as  fk_restaurant_master_body,
					fk_restaurant_locations.restaurant_name as restaurant_location_name
				from fk_member_admins 
				LEFT JOIN fk_role_master
				ON fk_role_master.role_id = fk_member_admins.role
				LEFT JOIN fk_restaurant_master
				ON fk_restaurant_master.restaurant_id = fk_member_admins.restaurant_id
				LEFT JOIN fk_restaurant_locations
				ON fk_restaurant_locations.location_id = fk_member_admins.location_id 
				where username='$username'";
	
				
		$query =  $this->db->query($sql);
		$result = $query->result();	
		return $result[0];
	}
	
	public function getMemberDetails($id)
	{
	    $sql ="SELECT fk_member_admins.admin_id,
					 fk_member_admins.full_name,
					 fk_member_admins.location_id,
					 fk_member_admins.email,
					 fk_member_admins.restaurant_id,
					 fk_member_admins.role,
					 fk_member_admins.`status` as fk_member_admins_status,
					 fk_member_admins.username,
					 fk_restaurant_master.restaurant_id as  fk_restaurant_master_id,
					 fk_restaurant_master.`name`,
					 fk_restaurant_master.`status` as fk_restaurant_master_status,
					 fk_restaurant_locations.location_id as fk_restaurant_locations_id,
					 fk_restaurant_locations.restaurant_name,
					 fk_role_master.role as role_name
				FROM fk_member_admins
				LEFT JOIN fk_role_master
				ON fk_role_master.role_id = fk_member_admins.role
				LEFT JOIN fk_restaurant_master
				ON fk_restaurant_master.restaurant_id = fk_member_admins.restaurant_id
				LEFT JOIN fk_restaurant_locations
				ON fk_restaurant_locations.location_id = fk_member_admins.location_id 
				WHERE  fk_member_admins.admin_id=$id";
				
		$query =  $this->db->query($sql);
		$result = $query->result();	
		return $result[0];
	}
public function getpassword($email){
		$sql = "SELECT password,admin_id,full_name
				FROM fk_member_admins
				WHERE  email ='$email'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
public function getCount($location_id){
	   
		$sql = "SELECT COUNT(order_id) as num FROM fk_order_master";
		if($location_id!='')
		$sql .=" WHERE  location_id ='$location_id '";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}	
public function getCount2($restaurant_id){
	   
		$sql = "SELECT COUNT(order_id) as num FROM fk_order_master";
		if($restaurant_id!='')
		$sql .=" WHERE  restaurant_id ='$restaurant_id '";
		//print_r($sql);exit;
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}	
public function getMenu($location_id){
	
		$sql = "SELECT COUNT(category_id) as num FROM  fk_dish_category_master WHERE  location_id ='$location_id '";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}	
public function getPreference($location_id){
	
		$sql = "SELECT COUNT(field) as num FROM   fk_preferences WHERE  location_id ='$location_id'";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		if($num==0){
		$sql = "SELECT COUNT(field) as num FROM   fk_general_config WHERE  editable_to_restaurant ='Y'";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		return $num ;
		}
		return $num ;
}
public function getCustomer($restaurant_id){
	
		$sql = "SELECT COUNT(member_id) as num FROM  fk_member_master";
		if($restaurant_id!='')
		$sql .=" WHERE  restaurant_id ='$restaurant_id '";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}	
public function getRestaurant(){
	
		$sql = "SELECT COUNT(restaurant_id) as num FROM  fk_restaurant_master ";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}	
public function getSettings(){
	
		$sql = "SELECT COUNT(field) as num FROM  fk_general_config	 ";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}	
public function getReport($restaurant_id){
	
		$sql = "SELECT COUNT(order_id) as num FROM fk_order_master	 WHERE restaurant_id='$restaurant_id' ";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}
public function getLocation($restaurant_id){
	
		$sql = "SELECT COUNT(location_id) as num FROM fk_restaurant_locations WHERE restaurant_id='$restaurant_id' ";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}
public function getPromocode(){
	
		$sql = "SELECT COUNT(promo_id) as num FROM fk_promocodes ";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
}	

	
public function veryfyadmin($username,$password){
		$this->load->helper('url');
		$query = $this->db->get_where('fk_member_admins', array('username'=>$username,'password'=>$password)); 
		return $query->result();
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

public function updateMemberAdmin($data,$id)
{	
	if($id){
		$this->db->where('admin_id',$id);
		$result = $this->db->update('fk_member_admins',$data);
		return;
	}
	else 
	return 'error';
	
}

public function checkResetPassword($email)
{
	$sql ="SELECT fk_member_admins.email,fk_member_admins.password_reset_key,fk_member_admins.password_reset_time
			FROM fk_member_admins
			WHERE MD5(fk_member_admins.email) = '".$email."'";
	$query = $this->db->query($sql);
	
	return $query->row_array();
}

}