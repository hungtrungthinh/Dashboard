<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class User_model extends MY_Model { 
	public $_table = 'fk_member_master';
	
	public function setTable($table){
		$this->_table = $table;
	}
	function getFieldNames($table){
		return $this->db->list_fields($table);
	
	}
	public function checkFbUser($authid){
	
		$this->db->where('fb_id', $authid);
		$rs = $this->db->get('fk_member_master');		
		return $rs->row_array();
	
	}
	
	public function checkUserImage($user_id, $image_id){
	
		$this->db->where('user_id', $user_id);
		$this->db->where('image_id', $image_id);
		$rs = $this->db->get('user_images');		
		return $rs->row_array();
	
	}
	
	public function getUserCount(){
		$sql = "SELECT COUNT(member_id) as num FROM fk_member_master";
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		$num = $results[0]->num?$results[0]->num:0;
		
		return $num ;
			
	}
	public function getUserLists($status='',$limit, $start=0, $key){
		//echo $status.'==='.$limit.'==='. $start; exit;
		$start = $start?$start:0;
		$sql = "SELECT member_master.* FROM fk_member_master where 1 ";
		
		if($status)
			$sql .= " AND fk_member_master.status='$status' ";
		
		if($key != ''){
			$sql .= " AND (fk_member_master.email LIKE '%$key%' OR fk_member_master.first_name LIKE '%$key%' OR fk_member_master.last_name LIKE '%$key%')";	
		}
		
		$sql .= " GROUP BY fk_member_master.member_id";
		
		if($limit)
			$sql .= " LIMIT $start, $limit";
			
		$result =  $this->db->query($sql);
		$results =  $result->result();	
		//echo $str = $this->db->last_query(); exit;
		//print_r($results);exit;
		return $results;
			
	}
	public function getUserListsByID($member_id){
		$sql = "select * from fk_member_master where member_id='$member_id' ";
		$result =  $this->db->query($sql);
		$results =  $result->row_array();	
		//echo $str = $this->db->last_query();
		return $results;
			
	}


	function updateUser($data){
		$user_id 			= $data['member_id'];
		$arr1 				= array_flip($this->getFieldNames('fk_member_master'));  		
		$member_master 		= array_intersect_key($data, $arr1);
		if($this->update_by(array('member_id'=>$user_id),$member_master)){
			return $this->getUserDetails($user_id);
		}
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

	public function insertDetails($arr)
	{
		$this->db->insert('member_profile', $arr);
		return $this->db->insert_id();	
	}
	public function updateDtetails($arr,$id)
	{
		$this->db->update('member_profile', $arr,array('member_id' => $id));
		return $this->db->insert_id();	
	}
	public function check_user($id)
	{
		$this->db->select('*');
		$this->db->from('member_profile');
		$this->db->where('member_id', $id); 	
		$result = $this->db->get();
		return $result->num_rows();
	}
	
	public function checkUserDetailsExist($user_id){
	
		$this->db->where('member_id', $user_id);
		
		$query = $this->db->get($this->_table);
		
		return $query->row_array();
	
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
	
}