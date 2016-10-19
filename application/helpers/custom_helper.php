<?php
/*
 * This is a PHP library that handles calling Custom.
 *    - Documentation and latest version
 *          http://recaptcha.net/plugins/php/
 *    - Get a reCAPTCHA API Key
 *          https://www.google.com/recaptcha/admin/create
 *    - Discussion group
 *          http://groups.google.com/group/recaptcha
 *
 * Copyright (c) 2007 reCAPTCHA -- http://recaptcha.net
 * AUTHORS:
 *   Asker
 *   
 *
 */

/**
 * The reCAPTCHA server URL's
 */

/**
 * Encodes the given data into a query string format
 * @param $data - array of string elements to be encoded
 * @return string - encoded request
 */
 
 /* Print the output value */

	if (!function_exists('_number_format')) {
	function _number_format ($number, $echo=false) {       
		
			if($echo)
				return number_format($number, 2, '.', ',');
			else
				echo number_format($number, 2, '.', ',');
			
		
	}

	}
	if (!function_exists('_viewdate')) {
		function _viewdate ($string,$echo=false) {       
			$CI =& get_instance();
			$date_format = $CI->config->item('date_format');
			if($string != '0000-00-00' && $string != '' && $string != NULL)
				$Date = date($date_format, strtotime($string));
			else
				$Date = '';
			
				if($echo)
					return $Date;
				else
					echo $Date;
			
		}

	}
	if (!function_exists('_viewmonth')) {
		function _viewmonth ($string,$echo=false) {       
			$CI =& get_instance();
			$date_format = $CI->config->item('date_format');
			if($string != '0000-00-00' && $string != '' && $string != NULL)
				$Date = date("F, Y", strtotime($string));
			else
				$Date = '';
			
				if($echo)
					return $Date;
				else
					echo $Date;
			
		}

	}
	if (!function_exists('_viewtime')) {
		function _viewtime ($string,$echo=false) {       
				$CI =& get_instance();
				$time_format = $CI->config->item('time_format');			
				if($string != '0000-00-00 00:00:00' && $string != '' && $string != NULL)
					$Time = date($time_format, strtotime($string));
				else
					$Time = '';
			
				if($echo)
					return $Time;
				else
					echo $Time;
				
			
		}

	}
	if (!function_exists('_viewdatetime')) {
		function _viewdatetime ($string,$echo=false) {
			$CI =& get_instance();       
			$date_time_format = $CI->config->item('date_time_format');
			
			if($string != '0000-00-00 00:00:00' && $string != '' && $string != NULL)
				$DateTime =  date($date_time_format, strtotime($string));
			else
				$DateTime = '';
				
				if($echo)
					return $DateTime;
				else
					echo $DateTime;
			
		}

	}	
	if (!function_exists('getConfigValue')) {
		function getConfigValue($field = ""){			
			$ci =& get_instance();
			$ci->load->database();
			$sql = "select * from `fk_general_config` where field ='".$field."'";
			$q = $ci->db->query($sql);			 
			$result = $q->row_array();
			return $result['value'];
		}
	}
	
	if (!function_exists('getLocationConfigValue')) {
		function getLocationConfigValue($field = "",$location_id='',$restaurant_id){
			$ci =& get_instance();
			$ci->load->database();
			//$sql = "select * from `fk_preferences` where field ='".$field."' and location_id='".$location_id."'";
			$sql = "SELECT fk_p1.value as test,fk_gc.id,fk_gc.field,IFNULL( fk_p2.value , IFNULL(fk_p1.value, fk_gc.value)) AS value, 
					fk_gc.title, fk_gc.description
					FROM fk_general_config fk_gc 
					LEFT JOIN fk_preferences fk_p1
					ON (fk_gc.id = fk_p1.config_id AND fk_p1.restaurant_id = $restaurant_id AND fk_p1.location_id=0)
					LEFT JOIN fk_preferences fk_p2
					ON (fk_gc.id = fk_p2.config_id AND fk_p2.restaurant_id = $restaurant_id  
					AND IF($location_id > 0, fk_p2.location_id = $location_id , fk_p2.location_id=0 ) )
					WHERE fk_gc.editable='Y' ";
					
					if($field)
					$sql .= " AND fk_gc.id = '$field'  ";
					
					$sql .=  " GROUP BY IFNULL(fk_p1.id,fk_gc.id)";
			//echo '<pre>';echo $sql;
			$q = $ci->db->query($sql);	
			$result = $q->row_array();
			return $result['value'];
		}
	}
	
	if (!function_exists('_getToday')) {
		function _getToday ($echo=false) {	
				$DateTime = date(getConfigValue('date_format').' '.getConfigValue('time_format'));
				
				if(!$echo)
					return $DateTime;
				else
					echo $DateTime;			
		}
	}
	

	
	if (!function_exists('getMenus')) {
		function getMenus($role = ""){			
			$ci =& get_instance();
			$ci->load->database();
			$sql = "SELECT M.* 
					FROM `fk_menu_permissions` MP 
					LEFT JOIN fk_menus M on M.menu_id=MP.menu_id 
					WHERE M.status = 'Y' AND
					MP.role = '".$role."' ORDER BY display_order ASC";
					
			$q = $ci->db->query($sql);			 
			$result = $q->result_array();
			return $result;
		}
	}
	if (!function_exists('menuPermissions')) {
		function menuPermissions($role = ""){	
			$ci =& get_instance();
			$controller = $ci->router->fetch_class();
			$method     = $ci->router->fetch_method();
			switch($ci->user->role){
				case "2" :
					switch($controller){
						case "restaurant" :
								return "1";
								break;
							
						default	:  
							return "0";	break;
					}
				case "3" :
					switch($controller){
						case "location" :
								return "1";
								break;
						
						default	:  
							return "0";	break;
					}
				default	:  
					return "1";	break;
			}
			/*$ci =& get_instance();
			$ci->load->database();
			$sql = "SELECT M.* 
					FROM `fk_menu_permissions` MP 
					LEFT JOIN fk_menus M on M.menu_id=MP.menu_id 
					WHERE M.status = 'Y' AND
					MP.role = '".$role."' ORDER BY display_order ASC";
					
			$q = $ci->db->query($sql);			 
			$result = $q->result_array();*/
			//return $role;
		}
	}
	if ( ! function_exists('query_to_csv'))
	{ 
		function query_to_csv($query, $headers = TRUE, $download = "")
		{
			if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
			{
				show_error('invalid query');
			}
			
			$array = array();
			if ($headers)
			{
				$line = array();
				foreach ($query->list_fields() as $name)
				{
					$line[] = $name;
				}
				$array[] = $line;
			}
			foreach ($query->result_array() as $row)
			{
				$line = array();
				foreach ($row as $item)
				{
					$line[] = $item;
				}
				$array[] = $line;
			}
		    	
			echo array_to_csv($array, $download);
		}
			
	if ( ! function_exists('array_to_csv'))
	{
		function array_to_csv($array, $download = "")
		{

			$f = fopen($download, 'wb') or show_error("Can't open php://output");
			$n = 0;        
			foreach ($array as $line)
			{
				$n++;
				if ( ! fputcsv($f, $line))
				{
					show_error("Can't write line $n: $line");
				}
			}
			fclose($f) or show_error("Can't close php://output");

			if(file_exists($download)){
				header("Content-type: application/csv");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($download));
				header("Content-Disposition: attachment; filename=".basename($download));
				readfile($download);
				exit;
			}
			
		}
	}

	}

	
	?>
