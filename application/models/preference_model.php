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
				WHERE A.location_id='$location_id' AND B.editable_to_restaurant='Y' and editable='Y'
				";
				
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_restConfig_manager($restaurant_id , $location_id=0,$role){
		if(!$restaurant_id ) return false;
		$sql=" SELECT fk_p1.value as test,fk_gc.id,fk_gc.units,fk_gc.field,IFNULL( fk_p2.value , IFNULL(fk_p1.value, fk_gc.value)) AS value, 
				fk_gc.title, fk_gc.description
				FROM fk_general_config fk_gc 
				LEFT JOIN fk_preferences fk_p1
				 ON (fk_gc.id = fk_p1.config_id AND fk_p1.restaurant_id = $restaurant_id AND IF($location_id > 0, fk_p1.location_id = $location_id , fk_p1.location_id=0 ) )
				LEFT JOIN fk_preferences fk_p2
				 ON (fk_gc.id = fk_p2.config_id AND fk_p2.restaurant_id = $restaurant_id  
				 		AND IF($location_id > 0, fk_p2.location_id = $location_id , fk_p2.location_id=0 ) )
				WHERE fk_gc.editable='Y' AND fk_gc.editable_to_restaurant='Y' ";
				
		if($role==2)
			$sql .= " OR fk_gc.manager_only = 'Y'  ";
			$sql .=  "GROUP BY IFNULL(fk_p1.id,fk_gc.id)";


		$query = $this->db->query($sql);
		return $query->result();
	}

		
}