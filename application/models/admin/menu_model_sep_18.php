<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Menu_model extends MY_Model { 	
public $_table = 'fk_dish_category_master';
	
	public function setTable($table){
			$this->_table = $table;
	}
	
	public function gelAllCategories($restaurant_id,$location_id){ 
			$sql="select * from fk_dish_category_master where restaurant_id ='$restaurant_id' AND location_id='$location_id'";
			$query =  $this->db->query($sql);
			$result = $query->result_array();	
			return $result;
	}
	public function gelAllDishItems($restaurant_id,$location_id){ 
			$sql = "SELECT A.*,B.category_name 
				FROM fk_dish_items_master A
				LEFT JOIN fk_dish_category_master B on A.category_id=B.category_id 
				WHERE  A.category_id in (
				SELECT category_id 
				FROM  fk_dish_category_master 
				WHERE restaurant_id='$restaurant_id'
				AND location_id='$location_id' )";
		$query = $this->db->query($sql);
		return $query->result_array();
	}	
	public function checkItemExist($category,$item,$item_id=''){ 
		$sql = "SELECT * from fk_dish_items_master 
				WHERE category_id='$category' 
				AND item_name='$item'";
		if($item_id!='')
			$sql.=" AND item_id!='$item_id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
		
	public function insertDishItems($data,$item_id=''){
		if($item_id!=''){
			$this->db->where('item_id', $item_id);
			$this->db->update('fk_dish_items_master', $data);
			return $item_id;
		}else{
			$this->db->insert('fk_dish_items_master', $data);
			$id	=	$this->db->insert_id();
			return $id;
		}
	}
	public function getItemDetails($item_id=''){
		//$sql = "SELECT A.*
		//		FROM fk_dish_items_master A 
		//		WHERE A.item_id=$item_id";
		$sql = "SELECT A.*,B.category_name
			    FROM fk_dish_items_master A  
				LEFT JOIN fk_dish_category_master B 
				on A.category_id=B.category_id 
			    WHERE A.item_id=$item_id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function getCategoryDetails($category_id=''){
		$sql = "SELECT A.*
				FROM fk_dish_category_master A 
				WHERE A.category_id=$category_id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function insertCategory($data,$category_id=''){
		if($category_id!=''){
			$this->db->where('category_id', $category_id);
			$this->db->update('fk_dish_category_master', $data);
			return $category_id;
		}else{
			$this->db->insert('fk_dish_category_master', $data);
			$id	=	$this->db->insert_id();
			return $id;
		}
	}
	
	public function delRestaurantItems($item_id){
		$this->db->delete('fk_dish_items_master', array('item_id' => $item_id));
		return true;
	}
	public function dishItemStatus($item_id,$status){
		$sql = "UPDATE fk_dish_items_master 
				SET status='$status' 
				WHERE item_id=$item_id";
		$query = $this->db->query($sql);
		return true;		
	}
	public function checkCategoryExist($location_id,$category_name,$category_id=''){ 
		$sql = "SELECT * from fk_dish_category_master 
				WHERE location_id='$location_id' 
				AND category_name='$category_name' AND location_id='$location_id'";
		if($category_id!='')
			$sql.=" AND category_id!='$category_id'";
			
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function categoryStatus($category_id,$status){
		$sql = "UPDATE fk_dish_category_master 
				SET status='$status' 
				WHERE category_id=$category_id";
		$query = $this->db->query($sql);
		return true;		
	}

	public function delCategory($category_id){
		
		$this->db->delete('fk_dish_category_master', array('category_id' => $category_id));
		return true;
	}
	
	public function deleteOptionAndSides($dish_item_id){
		
		$this->db->delete('fk_dish_options', array('dish_item_id' => $dish_item_id));
		return true;
	}

	public function insertDishOptions($data){
			$this->db->insert('fk_dish_options', $data);
			$id	=	$this->db->insert_id();
			return $id;
	}
	
	public function insertOptionsSides($data){
			$this->db->insert('fk_option_sides', $data);
			$id	=	$this->db->insert_id();
			return $id;
	}
	public function getDishOptions($item_id){
		$sql = "SELECT *
				FROM fk_dish_options 
				WHERE  dish_item_id = $item_id
				ORDER BY sortorder ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getOptionSides($option_id){
		$sql = "SELECT *
				FROM fk_option_sides 
				WHERE  option_id =	$option_id 
				ORDER BY sortorder ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function delDishItemSides($sidesid){
		$this->db->delete('fk_option_sides', array('side_id' => $sidesid));
	}	
	public function delDishOption($option_id){
		$this->db->delete('fk_dish_options', array('option_id' => $option_id));
	}
	public function delDishSide($option_id){
		$this->db->delete('fk_option_sides', array('option_id' => $option_id));
	}	
	public function getOptionDetail($option_id){
		$sql = "SELECT *
				FROM fk_dish_options 
				WHERE  option_id =	$option_id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}	
	public function updateDishOptions($option_id,$option_name,$mandatory=''){
		$sql = "UPDATE fk_dish_options 
				SET option_name='$option_name' 
				";
		if($mandatory!='')
			$sql .= " ,mandatory = '$mandatory' ";
		$sql .= " WHERE option_id=$option_id";	
		//echo $sql;exit;
		$query = $this->db->query($sql);
		return true;		
	}
	public function UpdateOptionsSides($array,$side_id=''){
		if($side_id==''){
			$this->db->insert('fk_option_sides', $array);
		}else{
			$this->db->where('side_id', $side_id);
			$this->db->update('fk_option_sides', $array);
		}
		
		return true;
	}
	public function gelSelectedDishItems($cat_id=''){ 
	
	        if($cat_id==0 || $cat_id==''){
				$sql = "SELECT A.*,B.category_name 
					   FROM fk_dish_items_master A
					   LEFT JOIN fk_dish_category_master B on A.category_id=B.category_id 
					   ";	
			}else{
		
			$sql = "SELECT A.*,B.category_name 
				FROM fk_dish_items_master A
				LEFT JOIN fk_dish_category_master B on A.category_id=B.category_id 
				WHERE  A.category_id=$cat_id";
			}
		
		$query = $this->db->query($sql);
		return $query->result_array();
		exit;
	}	

}
?>