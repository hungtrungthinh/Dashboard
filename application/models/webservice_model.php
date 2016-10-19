<?php 
class Webservice_model extends CI_Model {

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
	
	public function get_sample_jsons()
	{
			$sql = "select *  from webservice where type ='JSON' order  by category ";
			$query	=	$this->db->query($sql)	;	
			return $query->result_array();

	}	
	
	
	public function get_sample_log($limit)
	{
			$sql = "select `data` as json,id  from log OrDER BY id desc LIMIT $limit";
			$query	=	$this->db->query($sql)	;	
			return $query->result_array();

	}
	
	
	public function get_sample_post()
	{
			$sql = "select *  from webservice where type ='POST' order  by category ";
			$query	=	$this->db->query($sql)	;	
			return $query->result_array();

	}
	
	
}