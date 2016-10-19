<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Promocode_model extends MY_Model { 	
public $_table = 'fk_promocodes';
	
	public function setTable($table){
			$this->_table = $table;
	}
	
	
   public function adddetails($table,$data){
	   
        $this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
   }
   public function getPromoCount($key=''){
		
	$sql="SELECT COUNT(*) as num FROM fk_promocodes WHERE 1=1";
	if($key != ''){
			$sql .= " AND (fk_promocodes.title LIKE '%$key%')";
					}
					
	$query = $this->db->query($sql);
	
	$result=$query->row_array();	
	return  $result['num'];	
	

}	
	public function getAllPromocodes($status,$key,$num,$offset){
		
		$sql = "SELECT * FROM  fk_promocodes WHERE 1=1 ";
		
		if($status)
			$sql .= " AND fk_promocodes.status = '$status' ";
		
		if($key != ''){
			$sql .= " AND (fk_promocodes.title LIKE '%$key%')";	
		}
		
        	$sql.=" ORDER BY promo_id DESC ";	
		if($offset)
			$sql.=" limit $offset,$num ";
		else
			$sql.=" limit $num ";	
	//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->result_array();
			
		
	}
	
	
	public function checkExist($promocode,$restaurant_id,$promoID=''){
		$sql = "SELECT COUNT(promocode) as num FROM fk_promocodes WHERE restaurant_id='$restaurant_id' AND promocode= '$promocode'";
		//echo $sql;exit;
		if($promoID!=''){
			$sql.=" AND promo_id!='$promoID'";
		}
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		return $num ;
	}
	
	public function getPromocodeById($id){
		$this->db->select('fk_promocodes.*');
        $this->db->from('fk_promocodes');
        $this->db->where('promo_id',$id);
        $query = $this->db->get();
		$query =  $query->row_array();	
		//echo $this->db->last_query();
        return $query;
	}
	public function deletePromocodeById($id){

		 $this->db->where('promo_id', $id);
         $this->db->delete('fk_promocodes'); 
       
	}
	
	public function getAllUsers($id){
		$this->db->select('fk_member_master.*');
        $this->db->from('fk_member_master');
        $this->db->where('restaurant_id',$id);
        $query = $this->db->get();
		$query =  $query->result_array();	
		//echo $this->db->last_query();
        return $query;
	}
	
	public function getRestaurantUsers($id)
	{
		$this->db->select('fk_member_master.member_id,
						   fk_member_master.auth_type,
						   fk_member_master.auth_id,
						   fk_member_master.first_name,
						   fk_member_master.last_name,
						   fk_member_master.email,
						   fk_member_master.phone,
						   fk_member_master.profile_image,
						   fk_member_master.allow_notification,
						   fk_member_master.status,
						   fk_member_master.created_date,
						   fk_restaurant_members.restaurant_id,
						   fk_restaurant_members.device_id,
						   fk_restaurant_members.device_token,
						   fk_restaurant_members.device_platform');
        $this->db->from('fk_member_master');
		$this->db->join('fk_restaurant_members', 'fk_member_master.member_id = fk_restaurant_members.membar_id', 'left');
        $this->db->where('fk_restaurant_members.restaurant_id',$id);
        $query = $this->db->get();
		$query =  $query->result_array();	
		//echo $this->db->last_query();
        return $query;
	}
}



?>