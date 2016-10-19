<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Customer_model extends MY_Model { 	
	public $_table = 'fk_member_master';
		
	public function setTable($table){
				$this->_table = $table;
	}
		
	public function getCustomerDetails($restaurant_id,$key,$num,$offset){
			$sql     = "SELECT fk_member_master.*, fk_restaurant_master.name
						FROM fk_member_master INNER JOIN fk_restaurant_master 
						ON (fk_member_master.restaurant_id = fk_restaurant_master.restaurant_id)
						WHERE fk_member_master.restaurant_id = $restaurant_id";
			if($key != ''){
			$sql  .= "  AND (fk_member_master.first_name LIKE '%$key%' OR 
						fk_member_master.last_name LIKE '%$key%' OR 
						fk_member_master.email LIKE '%$key%')";	
			}
			if($offset)
				$sql.=" limit $offset,$num";
			else
				$sql.=" limit $num";		
		
			$query 	= $this->db->query($sql);
			return $query->result_array();	
	}
	public function getCustomerDetails1($key,$num,$offset,$id=''){
			$sql     = "SELECT fk_member_master.*, fk_restaurant_master.name
						FROM fk_member_master INNER JOIN fk_restaurant_master 
						ON (fk_member_master.restaurant_id = fk_restaurant_master.restaurant_id)
						WHERE  1=1 ";
						
			if($id != ''&& $id != 0 ){
				$sql	 .=" AND fk_member_master.restaurant_id=$id";
				}			
			if($key != ''){
			$sql  .= "  AND (fk_member_master.first_name LIKE '%$key%' OR 
						fk_member_master.last_name LIKE '%$key%' OR 
						fk_member_master.email LIKE '%$key%' OR
						fk_restaurant_master.name LIKE '%$key%')";	
			}
			if($offset)
				$sql.=" limit $offset,$num";
			else
				$sql.=" limit $num";		
	
			$query 	= $this->db->query($sql);
			return $query->result_array();	
	}
		
	public function countCustomers($restaurant_id,$key){
				$sql	 = "SELECT count(*) as num
							FROM fk_member_master
							WHERE restaurant_id=$restaurant_id";
				if($key != '' ){
				$sql .= " AND (fk_member_master.first_name LIKE '%$key%' OR 
						  fk_member_master.last_name LIKE '%$key%' OR 
						  fk_member_master.email LIKE '%$key%')";	
				}			
				$query 	= $this->db->query($sql);
				$result	= $query->row_array();	
				return  $result['num'];
	}
	public function countCustomers1($key,$id=''){
				$sql	 = "SELECT count(*) as num
							FROM fk_member_master WHERE 1=1";
				if($id != '' && $id != 0){
				$sql	 .=" AND restaurant_id = $id";
				}
				if($key != ''){
				$sql .= " AND (fk_member_master.first_name LIKE '%$key%' OR 
						  fk_member_master.last_name LIKE '%$key%' OR 
						  fk_member_master.email LIKE '%$key%')";	
				}	
				
				$query 	= $this->db->query($sql);
				$result	= $query->row_array();	
				return  $result['num'];
	}
	public function UpdateDetails($table,$data,$where){
	
				$this->db->where($where);
				$this->db->update($table, $data);
				return true;
				
	}
	public function getCustomerInfo($member_id,$restaurant_id)
	{
		
				/*$sql 	= "SELECT fk_member_master.*, fk_restaurant_master.name 
						   FROM fk_member_master
						   INNER JOIN fk_restaurant_master 
						   ON (fk_member_master.restaurant_id = fk_restaurant_master.restaurant_id AND fk_member_master.member_id = $member_id)
						   WHERE fk_member_master.restaurant_id='$restaurant_id'";*/
				if($restaurant_id != ''){		   
				$sql 	= "SELECT fk_member_master.*, fk_restaurant_master.name 
						   FROM fk_member_master
						   INNER JOIN fk_restaurant_master 
						   ON (fk_member_master.restaurant_id = fk_restaurant_master.restaurant_id AND fk_member_master.member_id = $member_id)
						   WHERE fk_member_master.restaurant_id='$restaurant_id'";	
						   }
				$sql 	= "SELECT fk_member_master.*
						   FROM fk_member_master
						   WHERE  fk_member_master.member_id = $member_id";	   	   
				$query 	= $this->db->query($sql);
				$query  = $query->row_array();	
				return $query;
	}
	public function bulkDelete($member_id){
			
			$sql = "DELETE FROM fk_member_master 
					WHERE fk_member_master.member_id =$member_id";
					
			$query = $this->db->query($sql);
	
	}
	public function csvGenetaion($restaurant_id,$fields,$limit,$per_page){
		//echo count($fields);
		//echo '<pre>';print_r($fields);
		if(count($fields) > 0 ){
			$comma='';	  
			for($i=0;$i<count($fields);$i++){
				switch($fields[$i]){
					case 'email':
						$fld .=$comma ."A.email ";	
						break;
					case 'customer_name':
						$fld .=$comma ."A.first_name,A.last_name";
					   break;
					default:
					$fld .=$comma .$fields[$i];	
				}	
			$comma = ' , ';
			}	
		}
		//echo $fld;	
		$sql = "SELECT ";
		$sql.= " $fld FROM fk_member_master A
				WHERE 1=1 and restaurant_id=$restaurant_id";
				
		//if($limit)
		//	$sql.=" limit $limit,$per_page";
		
		//echo $sql;exit;		
		$query = $this->db->query($sql);
		//print_r( $query);exit;
		return $query;	
	}

}
?>