<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Preference_model extends MY_Model { 	
	public $_table = 'fk_preferences';
	
	public function setTable($table){
		$this->_table = $table;
	}
	
	public function get_all_conf_field_n_values(){ 
		$result = $this->get_many_by('display', 'Y');
		return $result;
	}
	public function get_config_value($fieldname){
		$result = $this->get_by(array('field'=>$fieldname));
		return $result->value;
	}
	public function get_restConfig($location_id){
		$sql="SELECT A.config_id,A.value As loc_value,A.location_id,B.*
				FROM fk_preferences A
				LEFT JOIN fk_general_config B on A.config_id=B.id 
				WHERE A.location_id='$location_id' 
				";
				
		$query = $this->db->query($sql);
		return $query->result();
	}

		
}