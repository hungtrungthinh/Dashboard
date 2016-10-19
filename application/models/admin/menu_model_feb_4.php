<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Menu_model extends MY_Model { 	
public $_table = 'fk_dish_category_master';
	
	public function setTable($table){
			$this->_table = $table;
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
	public function insert($table,$data)
	{
		//print_r($data);exit;
		$this->db->insert($table, $data);
		$insert_id	= 	$this->db->insert_id();
		return $insert_id;
	}

	
	public function gelAllCategories($restaurant_id,$location_id){ 
			$sql="select * from fk_dish_category_master where restaurant_id ='$restaurant_id' AND location_id='$location_id' 
			ORDER BY sortorder ASC";
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
				AND item_name='".mysql_real_escape_string($item)."'";
		if($item_id!='')
			$sql.=" AND item_id!='$item_id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function checkItem($item_id=''){ 
		$sql = "SELECT * from fk_dish_items_master 
				WHERE item_id='$item_id'";
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
	public function insertCategory($data,$category_id='',$number){
		if($category_id!=''){
			$this->db->where('category_id', $category_id);
			$this->db->update('fk_dish_category_master', $data);
			return $category_id;
		}else{
			$data['sortorder']=$number+1;
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
				AND category_name='".mysql_real_escape_string($category_name)."' AND location_id='$location_id'";
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
	
			$sql = "SELECT count(*) as num
				FROM fk_dish_options 
				WHERE  option_name ='".$data['option_name']."' and dish_item_id='".$data['dish_item_id']."' 
				AND location_id='".$data['location_id']."'";
			$query = $this->db->query($sql);
			
			$res= $query->row_array();
			
			if($res['num']==0){
				$this->db->insert('fk_dish_options', $data);
				$id	=	$this->db->insert_id();
				return $id;
			}else{
			return true;
			}
			
			
	}
	
	public function insertOptionsSides($data){
	
		$sql = "SELECT count(*) as num
				FROM fk_option_sides 
				WHERE  option_id =	".$data['option_id']." and side_item='".$data['side_item']."'";
		$query = $this->db->query($sql);
		$res= $query->row_array();
		
		if($res['num']==0){
			$this->db->insert('fk_option_sides', $data);
		}else{
			//$this->db->where('side_id', $side_id);
			//$this->db->update('fk_option_sides', $array);
		}
		
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
	public function getDishsizes($item_id){
		$sql = "SELECT group_concat(size separator '*') as sizes,
				group_concat(price separator '*') as prices,
				group_concat(A.status separator '*') as size_status,
				group_concat(A.map_id separator '*') as map_id
				FROM fk_dish_item_size_map A
				WHERE A.item_id=$item_id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}	
	public function getOptionSides($option_id,$sortby=''){
		$sql = "SELECT *
				FROM fk_option_sides 
				WHERE  option_id =	$option_id 
				";
				
		if($sortby!='')	
			$sql .= " ORDER BY sortorder ".$sortby."";
		else
			$sql .= " ORDER BY sortorder ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function delDishItemSides($sidesid,$optionsid=''){
		$sql = "SELECT count(*) as num
				FROM fk_option_sides 
				WHERE  option_id =	$optionsid 
				";
		$query = $this->db->query($sql);
		$res=$query->row_array();
		if($res['num']==1 and $optionsid!=''){
			$this->db->delete('fk_dish_options', array('option_id' => $optionsid));
			$this->db->delete('fk_option_sides', array('side_id' => $sidesid));
			echo "1";
		}else{
			$this->db->delete('fk_option_sides', array('side_id' => $sidesid));
			echo "0";
		}
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
	public function updateDishOptions($option_id,$option_name,$mandatory='',$multiple=''){
		$sql = "UPDATE fk_dish_options 
				SET option_name='$option_name' 
				";
		if($mandatory!='')
			$sql .= " ,mandatory = '$mandatory',multiple = '$multiple' ";
		$sql .= " WHERE option_id=$option_id";	
		
		$query = $this->db->query($sql);
		return true;		
	}
	public function UpdateOptionsSides($array,$side_id='',$sideitem='',$option_id='',$num=''){
		//echo $side_id;
		$sql = "SELECT count(*) as num
				FROM fk_option_sides 
				WHERE  option_id =	$option_id and side_item='$sideitem'";
		$query = $this->db->query($sql);
		$res= $query->row_array();
		//echo $res['num'];
		//if($side_id==''){
		if($res['num']==0){
			$array['sortorder']=$num+1;
			$this->db->insert('fk_option_sides', $array);
			
		}else{
			$this->db->where('side_id', $side_id);
			$this->db->update('fk_option_sides', $array);
		}
		
		return true;
	}
	public function gelSelectedDishItems($location_id,$cat_id=''){ 
	
	        if($cat_id==0 || $cat_id==''){
				$sql = "SELECT A.*,B.category_name 
					   FROM fk_dish_items_master A
					   INNER JOIN fk_dish_category_master B on A.category_id=B.category_id 
					   AND A.category_id in ( select category_id from fk_dish_category_master where location_id=$location_id) 
					   ";	
			}else{
				$sql = "SELECT A.*,B.category_name 
					FROM fk_dish_items_master A
					INNER JOIN fk_dish_category_master B on A.category_id=B.category_id 
					WHERE  A.category_id=$cat_id ORDER BY sortorder ASC";
			}
	
		$query = $this->db->query($sql);
		return $query->result_array();
		exit;
	}	
	public function delDishItemSize($sizeid,$item_id='',$size=''){
		if($sizeid!='')
			$this->db->delete('fk_dish_item_size_map', array('map_id' => $sizeid));
		else
			$this->db->delete('fk_dish_item_size_map', array('item_id' => $item_id,'size'=>$size));
	}	
	public function insertDishItemSize($data,$item_id){
		$this->db->delete('fk_dish_item_size_map', array('item_id' => $item_id));
		$this->db->insert('fk_dish_item_size_map', $data);
		$id	=	$this->db->insert_id();
		return $id;
		
	}
	public function UpdateOrInsertDishItemSize($newarr,$map_id=''){
		
		//$this->db->delete('fk_dish_item_size_map', array('size ' =>'Regular'));
		//$this->db->delete('fk_dish_item_size_map', array('item_id' => $item_id));
		if($map_id!=''){
			$this->db->where('map_id',$map_id);
			$this->db->update('fk_dish_item_size_map', $newarr);
		}else{
			$sql = "SELECT count(*) as num
				FROM fk_dish_item_size_map 
				WHERE  item_id =".$newarr['item_id']." and size='".$newarr['size']."'";
			$query = $this->db->query($sql);
			
			$res= $query->row_array();
			
			if($res['num']==0){
				$this->db->insert('fk_dish_item_size_map', $newarr);
			}else{
				$this->db->where('size',$newarr['size']);
				$this->db->where('item_id',$newarr['item_id']);
				$this->db->update('fk_dish_item_size_map', $newarr);
			}
			
			
			
		}
	}
	
	public function delAllDishItems($cat_id){
		$sql="select * from fk_dish_items_master where category_id 	 ='$cat_id' ";
		$query =  $this->db->query($sql);
		$result = $query->result_array();	
		foreach($result as $res){
			$sql2="select * from fk_dish_item_size_map where item_id =".$res['item_id'];
			$query2 =  $this->db->query($sql2);
			$result2 = $query2->result_array();
			if(count($result2)==0){
				$this->db->delete('fk_dish_items_master', array('item_id ' =>$res['item_id']));
			}
		}
	}
	public function deleteDishItemSize($item_id){
		$this->db->delete('fk_dish_item_size_map', array('item_id' => $item_id));
	}	
	
	public function updateDishitem($data,$option_id){
		if($option_id!=''){
			$this->db->where('option_id', $option_id);
			$this->db->update('fk_dish_options', $data);
		}
	}
	
	public function maxSortOrder($location_id,$dish_item_id){
		$sql = "SELECT max(sortorder) as maxval 
				FROM fk_dish_options 
				WHERE location_id=$location_id AND dish_item_id=$dish_item_id";
		$query = $this->db->query($sql);
		$res= $query->row_array();
		return $res['maxval'];
	}
	public function maxSortOrderDish($option_id){
		$sql = "SELECT max(sortorder) as maxval 
				FROM fk_option_sides 
				WHERE option_id=$option_id ";
		$query = $this->db->query($sql);
		$res= $query->row_array();
		return $res['maxval'];
	}
	public function moveUpdateCategories($category_id,$newcategory_id){
		$sql = "UPDATE  fk_dish_items_master 
				SET category_id='$newcategory_id' WHERE category_id=$category_id ";
		$query = $this->db->query($sql);
		return true;	
	}
	
	public function maxSortOrderCategory($location_id){
		$sql = "SELECT max(sortorder) as maxval 
				FROM fk_dish_category_master 
				WHERE location_id=$location_id ";
		$query = $this->db->query($sql);
		$res= $query->row_array();
		return $res['maxval'];
	}
	public function maxSortOrderDishItem($location_id,$category_id){
		$sql = "SELECT max(sortorder) as maxval 
				FROM fk_dish_items_master 
				WHERE category_id=$category_id";
		$query = $this->db->query($sql);
		$res= $query->row_array();
		return $res['maxval'];
	}

	
}
?>