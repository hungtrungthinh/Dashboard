<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Reports_model extends MY_Model { 	
public $_table = 'fk_order_master';
	
	public function setTable($table){
			$this->_table = $table;
	}
	
	
	public function getAllSalesReport($restaurant_id,$num,$offset,$startDate,$endDate){
		$sql = "SELECT A.*,B.first_name,B.last_name,B.auth_type,C.restaurant_name,C.type
				FROM fk_order_master A
				LEFT JOIN fk_member_master B on A.member_id=B.member_id 
				LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id 
				WHERE A.restaurant_id=$restaurant_id ";
		if($startDate!='' && $endDate!='')		
			$sql.=	" AND created_time >= '$startDate' AND created_time <= '$endDate' ";		

		$sql.=	" ORDER BY payment_status  DESC ";
		if($offset)
			$sql.="limit $offset,$num";
		else
			$sql.="limit $num";		
		//echo $sql;		
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	public function countSalesReport($restaurant_id,$startDate,$endDate){
			$sql = "SELECT count(*) as num
					FROM fk_order_master A
					WHERE 1=1 
					AND restaurant_id=$restaurant_id
					";
			if($startDate!='' && $endDate!='')				
				$sql.=	" AND created_time >= '$startDate' AND created_time <= '$endDate' ";				
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}
	public function getAllSalesReportcsv($fields,$limit='',$per_page='',$start='',$end=''){
	
		//SELECT * from table Where comp_id IN (".implode(',',$arr).");
		
		if(count($fields) > 0 ){
 $comma='';	  
for($i=0;$i<count($fields);$i++){
switch($fields[$i]){
case 'order_ref_id':
$flds .=$comma ."A.order_ref_id";	
   break;
case 'restaurant_name':
$flds .=$comma ."C.restaurant_name  ";
   break;
case 'first_name':
$flds .=$comma ."B.first_name,B.last_name";
   break;
   case 'order_type ':
$flds .=$comma ."A.order_type";
   break;
   case 'total_amount':
$flds .=$comma ."A.total_amount";
   break;
   case 'created_time ':
$flds .=$comma ."A.created_time";
   break;
  
default:
$flds .=$comma .$fields[$i];	
}	
$comma = ' , ';
}	
}

      
		$sql = "SELECT ";
		$sql.= " $flds FROM fk_order_master A
				LEFT JOIN fk_member_master B on A.member_id=B.member_id 
				LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id 
				WHERE 1=1 ";
       if($start!='' && $end!='')				
				$sql.=	" AND created_time >= '$start' AND created_time <= '$end' ";	
		if($limit)
		$sql.="limit $limit,$per_page";
		//echo $sql;exit;		
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	
	public function getAllCustomerReportcsv($restaurant_id,$fields,$limit='',$per_page='',$start='',$end=''){
	
		//SELECT * from table Where comp_id IN (".implode(',',$arr).");
		
		
	$order_meal_time_sql = $this->getRestaurantMealTime($restaurant_id,$location_id);
		
		


		if(count($fields) > 0 ){
 $comma='';	  
for($i=0;$i<count($fields);$i++){
switch($fields[$i]){
case 'customer_name':
$flds .=$comma ."CONCAT (T3.first_name,' ',T3.last_name) as Name ";	
   break;
case 'total':
$flds .=$comma ."SUM(total_amount) as Total_Cost ,COUNT(*) as Total_Order";
   break;
case 'pickup':
$flds .=$comma ."(SELECT SUM(total_amount) as pickup FROM fk_order_master WHERE order_type='pickup' AND member_id=T2.member_id) as Pickup_Cost,
		(SELECT COUNT(*) as pickup_count FROM fk_order_master WHERE order_type='pickup' AND member_id=T2.member_id) as Pickup_Order";
   break;
case 'delivery':
$flds .=$comma ."(SELECT SUM(total_amount) as delivery FROM fk_order_master  WHERE order_type='Delivery' AND member_id=T3.member_id) as Delivery_Cost,
		(SELECT COUNT(*) as  delivery_count FROM fk_order_master  WHERE order_type='Delivery' AND member_id=T3.member_id) as Delivery_Order";
   break;
case 'app':
$flds .=$comma ."(SELECT SUM(total_amount) as app FROM fk_order_master  WHERE source_type='app' AND member_id=T3.member_id) as App_Cost ,
		(SELECT COUNT(*) as  app_count FROM fk_order_master  WHERE source_type='app' AND member_id=T3.member_id) as App_Order";
   break;
case 'facebook':
$flds .=$comma ."(SELECT SUM(total_amount) as facebook FROM fk_order_master  WHERE source_type='facebook' AND member_id=T3.member_id) as Facebook_Cost ,
		(SELECT COUNT(*) as  facebook_count FROM fk_order_master  WHERE source_type='facebook' AND member_id=T3.member_id) as Facebook_Order";
   break;
   
case 'website':
$flds .=$comma ."(SELECT SUM(total_amount) as website FROM fk_order_master  WHERE source_type='website' AND member_id=T3.member_id) as Website_Cost ,
		(SELECT COUNT(*) as  website_count FROM fk_order_master  WHERE source_type='website' AND member_id=T3.member_id) as Website_Order";
   break;

case 'breakfast':
$flds .=$comma ."( SELECT SUM(total_amount) as breakfast FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Breakfast' AND member_id=T3.member_id) as Breakfast_Cost,
		 ( SELECT COUNT(*) as breakfast_count FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Breakfast' AND member_id=T3.member_id) as Breakfast_Order";
   break;
case 'lunch':
$flds .=$comma ."( SELECT SUM(total_amount) as lunch_count FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Lunch' AND member_id=T3.member_id) as Lunch_Cost ,
		  ( SELECT COUNT(*) as lunch FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Lunch' AND member_id=T3.member_id) as Lunch_Order";
   break;
case 'dinner':
$flds .=$comma ." ( SELECT SUM(total_amount) as dinner FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Dinner' AND member_id=T3.member_id) as Dinner_Cost ,
		  ( SELECT COUNT(*)  as dinner_count FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Dinner' AND member_id=T3.member_id) as Dinner_Order";
   break;
    
default:
$flds .=$comma .$fields[$i];	
}	
$comma = ' , ';
}	
}

		
		


		$sql = "
		 SELECT $flds" ;


$sql.=" FROM 
fk_order_master T2
LEFT JOIN fk_member_master T3 ON T2.member_id=T3.member_id 
WHERE T2.restaurant_id='".$restaurant_id."' ";

	if($start!='' && $end!='')				
					$sql.=	" AND created_time >= '$start' AND created_time <= '$end' ";		
					
         $sql.="  GROUP BY T2.member_id";
		 if($limit)
			$sql.=" limit $limit,$per_page";
				
					

//AND T2.location_id='".$location_id."'	
		//echo '<pre>';echo $sql;		
		$query = $this->db->query($sql);
		return $query;
		//return $query->result_array();	
	
	}
	
	public function getAllItemReportcsv($restaurant_id,$fields,$limit='',$per_page='',$start='',$end=''){
	
		//SELECT * from table Where comp_id IN (".implode(',',$arr).");
		
		
		$order_meal_time_sql = $this->getRestaurantMealTime($restaurant_id,$location_id);	


		if(count($fields) > 0 ){
 $comma='';	  
for($i=0;$i<count($fields);$i++){
switch($fields[$i]){
case 'item_name':
$flds .=$comma ."T4.item_name as Item_Name ";	
   break;
case 'total':
$flds .=$comma ."SUM(total_amount) as Total_Cost ,COUNT(*) as Total_Order";
   break;
case 'pickup':
$flds .=$comma ."(SELECT SUM(total_amount) as pickup FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='pickup' AND  T1.item_id=OI.item_id) as Pickup_Cost,
		(SELECT COUNT(*) as pickup_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='pickup' AND  T1.item_id=OI.item_id) as Pickup_Order";
   break;
case 'delivery':
$flds .=$comma ."(SELECT SUM(total_amount) as delivery FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='delivery' AND T1.item_id=OI.item_id) as Delivery_Cost,
		(SELECT COUNT(*) as delivery_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='delivery' AND T1.item_id=OI.item_id) as Delivery_Order";
   break;
case 'app':
$flds .=$comma ."(SELECT SUM(total_amount)  as app FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='app' AND T1.item_id=OI.item_id) as App_Cost ,
		(SELECT COUNT(*) as app_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='app' AND T1.item_id=OI.item_id) as App_Order";
   break;
case 'facebook':
$flds .=$comma ."(SELECT SUM(total_amount) as facebook FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='facebook' AND T1.item_id=OI.item_id) as Facebook_Cost ,
		(SELECT COUNT(*) as facebook_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='facebook' AND T1.item_id=OI.item_id) as Facebook_Order";
   break;
   
case 'website':
$flds .=$comma ."(SELECT SUM(total_amount) as website FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='web' AND T1.item_id=OI.item_id) as Website_Cost ,
		(SELECT COUNT(*) as website_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='web' AND T1.item_id=OI.item_id) as Website_Order";
   break;

case 'breakfast':
$flds .=$comma ."(SELECT SUM(total_amount) as breakfast_amount FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='breakfast' AND T1.item_id=OI.item_id) as Breakfast_Cost,
		 (SELECT COUNT(*) as breakfast_count FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='breakfast' AND T1.item_id=OI.item_id) as Breakfast_Order";
   break;
case 'lunch':
$flds .=$comma ."(SELECT SUM(total_amount) as lunch FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='lunch' AND T1.item_id=OI.item_id) as Lunch_Cost ,
		  (SELECT COUNT(*) as lunch_count FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='lunch' AND T1.item_id=OI.item_id) as Lunch_Order";
   break;
case 'dinner':
$flds .=$comma ." (SELECT SUM(total_amount) as dinner FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='dinner' AND T1.item_id=OI.item_id) as Dinner_Cost ,
		  (SELECT COUNT(*) as dinner_count FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='dinner' AND T1.item_id=OI.item_id) as Dinner_Order";
   break;
    
default:
$flds .=$comma .$fields[$i];	
}	
$comma = ' , ';
}	
}

		
		


		$sql = "
		 SELECT $flds" ;


$sql.=" FROM 
fk_order_items T1 LEFT JOIN  fk_order_master T2 ON T1.order_id=T2.order_id
LEFT JOIN fk_member_master T3 ON T2.member_id=T3.member_id
LEFT JOIN fk_dish_items_master T4 ON T1.item_id=T4.item_id
WHERE T2.restaurant_id='".$restaurant_id."'";

	if($start!='' && $end!='')				
					$sql.=	" AND created_time >= '$start' AND created_time <= '$end' ";		
					
         $sql.="  GROUP BY T1.item_id";
		 if($limit!='')
			$sql.=" limit $limit,$per_page";
				
					

//AND T2.location_id='".$location_id."'	
		//echo '<pre>';echo $sql;		
		$query = $this->db->query($sql);
		return $query;
		//return $query->result_array();	
	
	}
	
	public function getQuery($fields,$limit='',$per_page='',$start,$end){
	
			if(count($fields) > 0 ){
			 $comma='';	  
			for($i=0;$i<count($fields);$i++){
			switch($fields[$i]){
			case 'order_ref_id':
			$fld .=$comma ."A.order_ref_id";	
			   break;
			case 'restaurant_name':
			$fld .=$comma ."C.restaurant_name  ";
			   break;
			case 'first_name':
			$fld .=$comma ."B.first_name,B.last_name";
			   break;
			   case 'order_type ':
			$fld .=$comma ."A.order_type";
			   break;
			   case 'total_amount':
			$fld .=$comma ."A.total_amount";
			   break;
			   case 'created_time ':
			$fld .=$comma ."A.created_time";
			   break;
			  
			default:
			$fld .=$comma .$fields[$i];	
			}	
			$comma = ' , ';
			}	
			}
			
				  
					$sql = "SELECT ";
					$sql.= " $fld FROM fk_order_master A
							LEFT JOIN fk_member_master B on A.member_id=B.member_id 
							LEFT JOIN fk_restaurant_locations C on A.location_id=C.location_id 
							WHERE 1=1 ";
					if($start!='' && $end!='')				
					$sql.=	" AND created_time >= '$start' AND created_time <= '$end' ";		
					if($limit)
					$sql.=" limit $limit,$per_page";
					$query = $this->db->query($sql);
					//print_r( $query);exit;
					return $query;	
		}
		
		
	public function getAllCustomerReport($restaurant_id,$location_id,$offset,$limit,$startDate,$endDate){
		
		$order_meal_time_sql = $this->getRestaurantMealTime($restaurant_id,$location_id);


		$sql = "
		 SELECT T3.member_id,T3.first_name,T3.last_name, SUM(total_amount) as total_amount ,COUNT(*) as total_order,
		(SELECT SUM(total_amount) as pickup FROM fk_order_master WHERE order_type='pickup' AND member_id=T2.member_id AND restaurant_id=".$restaurant_id." ) as pickup,
		(SELECT COUNT(*) as pickup_count FROM fk_order_master WHERE order_type='pickup' AND member_id=T2.member_id AND restaurant_id=".$restaurant_id.") as pickup_count,
		(SELECT SUM(total_amount) as delivery FROM fk_order_master  WHERE order_type='Delivery' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as delivery ,
		(SELECT COUNT(*) as  delivery_count FROM fk_order_master  WHERE order_type='Delivery' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as delivery_count ,
		(SELECT SUM(total_amount) as app FROM fk_order_master  WHERE source_type='app' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as app ,
		(SELECT COUNT(*) as  app_count FROM fk_order_master  WHERE source_type='app' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as app_count ,
		(SELECT SUM(total_amount) as website FROM fk_order_master  WHERE source_type='website' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as website ,
		(SELECT COUNT(*) as  website_count FROM fk_order_master  WHERE source_type='website' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as website_count ,
		(SELECT SUM(total_amount) as facebook FROM fk_order_master  WHERE source_type='facebook' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as facebook ,
		(SELECT COUNT(*) as  facebook_count FROM fk_order_master  WHERE source_type='facebook' AND member_id=T3.member_id AND restaurant_id=".$restaurant_id.") as facebook_count , " ;

$sql .= "( SELECT SUM(total_amount) as breakfast FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Breakfast' AND member_id=T3.member_id) as breakfast,
		 ( SELECT COUNT(*) as breakfast_count FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Breakfast' AND member_id=T3.member_id) as breakfast_count, 
		 ( SELECT SUM(total_amount) as lunch_count FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Lunch' AND member_id=T3.member_id) as lunch ,
		  ( SELECT COUNT(*) as lunch FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Lunch' AND member_id=T3.member_id) as lunch_count ,
		 ( SELECT SUM(total_amount) as dinner FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Dinner' AND member_id=T3.member_id) as dinner ,
		  ( SELECT COUNT(*)  as dinner_count FROM  ( ".$order_meal_time_sql." )as t1 WHERE type='Dinner' AND member_id=T3.member_id) as dinner_count 
		 ";

$sql.=" FROM 
fk_order_master T2
LEFT JOIN fk_member_master T3 ON T2.member_id=T3.member_id 
WHERE T2.restaurant_id='".$restaurant_id."' ";
if($startDate!='' && $endDate!='')		
			$sql.=	" AND created_time >= '$startDate' AND created_time <= '$endDate' ";

         $sql.="  GROUP BY T2.member_id";
if($limit==''){
$limit=0;
}
					$sql.=" limit $limit,$offset";	
				
					

//AND T2.location_id='".$location_id."'	
		//echo '<pre>';echo $sql;		
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	
	public function countCustomersReports($restaurant_id,$locationid,$startDate,$endDate){
			$sql = "SELECT count(*) AS num FROM (SELECT count(*) as num
				  FROM fk_order_items T1 
          LEFT JOIN fk_order_master T2 ON T1.order_id=T2.order_id 
          WHERE T2.restaurant_id='".$restaurant_id."'";
		   if($startDate!='' && $endDate!='')				
				$sql.=	" AND created_time >= '$startDate' AND created_time <= '$endDate' ";
				   $sql.="GROUP BY T2.member_id) AS order_customer";
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
	}
	
	
	public function getAllItemsReport($restaurant_id,$location_id,$offset,$limit,$startDate,$endDate){
	
		$order_meal_time_sql = $this->getRestaurantMealTime($restaurant_id,$location_id);
	


		$sql = "SELECT T1.item_id,T4.item_name,T3.member_id,T3.first_name,T3.last_name,SUM(total_amount) as total_amount ,COUNT(*) as total_order,
		(SELECT SUM(total_amount) as pickup FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='pickup' AND  T1.item_id=OI.item_id ) as pickup,
		
		 (SELECT COUNT(*) as pickup_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='pickup' AND  T1.item_id=OI.item_id ) as pickup_count,
		
		(SELECT SUM(total_amount) as delivery FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='delivery' AND T1.item_id=OI.item_id) as delivery,
		
		(SELECT COUNT(*) as delivery_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.order_type='delivery' AND T1.item_id=OI.item_id) as delivery_count,
		 
		(SELECT SUM(total_amount)  as app FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='app' AND T1.item_id=OI.item_id) as app,
		
		(SELECT COUNT(*) as app_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='app' AND T1.item_id=OI.item_id) as app_count,
		
		(SELECT SUM(total_amount) as website FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='web' AND T1.item_id=OI.item_id) as website,
		
		(SELECT COUNT(*) as website_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='web' AND T1.item_id=OI.item_id) as website_count,
		
		
		(SELECT SUM(total_amount) as facebook FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='facebook' AND T1.item_id=OI.item_id) as facebook,
		
		
		(SELECT COUNT(*) as facebook_count FROM fk_order_master OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.source_type='facebook' AND T1.item_id=OI.item_id) as facebook_count,
		 
		 (SELECT SUM(total_amount) as breakfast_amount FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='breakfast' AND T1.item_id=OI.item_id) as breakfast,
		 
		 (SELECT COUNT(*) as breakfast_count FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='breakfast' AND T1.item_id=OI.item_id) as breakfast_count,
		 
		 (SELECT SUM(total_amount) as lunch FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='lunch' AND T1.item_id=OI.item_id) as lunch,
		 
		 (SELECT COUNT(*) as lunch_count FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='lunch' AND T1.item_id=OI.item_id) as lunch_count,
		 
		 (SELECT SUM(total_amount) as dinner FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='dinner' AND T1.item_id=OI.item_id) as dinner,
		 
		 (SELECT COUNT(*) as dinner_count FROM (".$order_meal_time_sql.") OM LEFT JOIN fk_order_items OI
		 ON OM.order_id=OI.order_id WHERE OM.type='dinner' AND T1.item_id=OI.item_id) as dinner_count
		 
 
 FROM 
 fk_order_items T1 LEFT JOIN  fk_order_master T2 ON T1.order_id=T2.order_id
LEFT JOIN fk_member_master T3 ON T2.member_id=T3.member_id
LEFT JOIN fk_dish_items_master T4 ON T1.item_id=T4.item_id
WHERE T2.restaurant_id='".$restaurant_id."'";
      if($startDate!='' && $endDate!='')		
			$sql.=	" AND created_time >= '$startDate' AND created_time <= '$endDate' ";
      $sql.=" GROUP BY T1.item_id";
if($limit==''){
$limit=0;
}
					$sql.=" limit $limit,$offset";	
				
					

//AND T2.location_id='".$location_id."'	
	//echo '<pre>';echo $sql;		
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
		  
		  
	public function countItemsReport($restaurant_id,$location_id){
		  
		  $sql = "SELECT count(*) AS num FROM ( SELECT count(*) FROM fk_order_items T1 
          LEFT JOIN fk_order_master T2 ON T1.order_id=T2.order_id WHERE T2.restaurant_id='".$restaurant_id."'";
		    if($startDate!='' && $endDate!='')				
				$sql.=	" AND created_time >= '$startDate' AND created_time <= '$endDate' ";
		    $sql.=" GROUP BY T1.item_id) AS order_customer";
					
					
					
			$query = $this->db->query($sql);
			$result=$query->row_array();	
			return  $result['num'];
			
	}
	
	public function getRestaurantMealTime($restaurant_id,$location_id='')
	{
		
		$array['location_id'] = ($location_id) ? $location_id :0;
		$array['restaurant_id'] = ($restaurant_id) ? $restaurant_id :0;
		
		$restaurant_meal_time['breakfast_start_time'] =
						(getLocationConfigValue('26',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('26',$array['location_id'],$array['restaurant_id']) :getConfigValue('breakfast_start_time');
		$restaurant_meal_time['breakfast_end_time'] =
						(getLocationConfigValue('27',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('27',$array['location_id'],$array['restaurant_id']) :getConfigValue('breakfast_start_time');
						
		$restaurant_meal_time['lunch_start_time'] =
						(getLocationConfigValue('28',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('28',$array['location_id'],$array['restaurant_id']) :getConfigValue('breakfast_start_time');
		$restaurant_meal_time['lunch_end_time'] =
						(getLocationConfigValue('29',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('29',$array['location_id'],$array['restaurant_id']) :getConfigValue('breakfast_start_time');
						
		$restaurant_meal_time['dinner_start_time'] =
						(getLocationConfigValue('30',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('30',$array['location_id'],$array['restaurant_id']) :getConfigValue('breakfast_start_time');
		$restaurant_meal_time['dinner_end_time'] =
						(getLocationConfigValue('31',$array['location_id'],$array['restaurant_id']))? getLocationConfigValue('31',$array['location_id'],$array['restaurant_id']) :getConfigValue('breakfast_start_time');
		
					
		
		
		$order_meal_time_sql = "
		 SELECT fk_order_master.order_id,fk_order_master.total_amount,fk_order_master.member_id,
		IF((fk_order_master.delivery_time > 
					concat(DATE_FORMAT(fk_order_master.delivery_time,'%Y-%m-%d'),' ','".$restaurant_meal_time['breakfast_start_time']."') 
				&& 
				fk_order_master.delivery_time <	
					concat(DATE_FORMAT(fk_order_master.delivery_time,'%Y-%m-%d'),' ','".$restaurant_meal_time['breakfast_end_time']."')),'Breakfast'
		, IF((fk_order_master.delivery_time > 
					concat(DATE_FORMAT(fk_order_master.delivery_time,'%Y-%m-%d'),' ','".$restaurant_meal_time['lunch_start_time']."') 
				&& 
				fk_order_master.delivery_time <	
					concat(DATE_FORMAT(fk_order_master.delivery_time,'%Y-%m-%d'),' ','".$restaurant_meal_time['lunch_end_time']."')),'Lunch'
		,'Dinner'
		
		)
		
		) as type
		FROM fk_order_master  ";
		
		return $order_meal_time_sql;
	}
	
		
}
?>