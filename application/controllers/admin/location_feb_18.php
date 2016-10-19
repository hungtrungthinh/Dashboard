<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Location extends MY_Controller {

	/**
	 * Location Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 
	 * $this->load->library('crud');
	 * load crud library if u want to perform basic listing/add/edit and
	 * other similar stuffs
	 * $this->load->library('preferences');
	 * for showing a configuration table where users can only update fields
	 */	
public function __construct(){
	
				parent::__construct();
				$this->_setAsAdmin();
				$this->load->model('location_model');
				$this->user 	= $this->session->userdata('user');
				if($this->user=='')
					redirect('admin');		
}
public function index(){
	redirect('admin/location/lists');
}
public function check(){
		$username		= $_POST['username'];
		$usernameexist	= $this->location_model->usernameExist($username);
		echo $usernameexist;exit;
}	
public function add($location_id=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$admin_id=$user->admin_id;
			$this->load->library('form_validation');
			$data['TITLE']	    = 'Add Restaurant Location';
			$location_id	    = $location_id?$location_id:($this->input->get('location_id')?$this->input->get('location_id'):0);
			$data['timezonedetails']	 = $this->location_model->getAllTimezone();
			$data['location_id']=$location_id;
			if($location_id!=''){
				$data['result']		= $this->location_model->getLocationDet($location_id,$restaurant_id);
				//print_r($data[$result]);exit;
				$data['timeresult']		= $this->location_model->getLocationTimeDet($location_id);
				foreach ($data['timeresult'] as $timeresult ){
					$data[$timeresult['day']]=$timeresult;
				}
				//print_r($data[$timeresult['day']]);exit;
				if(count($data['result'])==0){
					$data['error']="No location found";
				}else{
					$data['error']='';
				}
		    }
			else{
				$data['error']='';
				$data['result'] = $_POST;
			}
				
			if($_SERVER['REQUEST_METHOD']=='POST'){	
			
				if($location_id){
					$this->form_validation->set_rules('username', 'User Name', 'required');
					$this->form_validation->set_rules('name', 'Restaurant Name', 'required');
					$this->form_validation->set_rules('chefname', 'Name', 'required');
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				}
				else{
					
					$this->form_validation->set_rules('name', 'Restaurant Name', 'required');
					$this->form_validation->set_rules('chefname', 'Name', 'required');
					$this->form_validation->set_rules('username', 'User Name', 'required|is_unique[fk_member_admins.username]');
					$this->form_validation->set_rules('password', 'Passowrd', 'required|min_length[6]|matches[confirmpassword]');
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
					$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required');
					$data['user'] = $_POST;
				}
				
				if ($this->form_validation->run() === TRUE){
					
					if($location_id)
					{   
					
					    $address=$this->input->post('zipcode').','.$this->input->post('city').','.$this->input->post('state').','.$this->input->post('address');
						$coordinates =file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
						$coordinates = json_decode($coordinates);
			 			if($coordinates->status !="ZERO_RESULTS"){
								$lat=$coordinates->results[0]->geometry->location->lat;
								$long=$coordinates->results[0]->geometry->location->lng;
					   			$data			 = array('restaurant_name'=>$this->input->post('name'),
								                 'restaurant_id'=>$restaurant_id,
												 'zip_code '=>$this->input->post('zipcode'),
												 'city '=>$this->input->post('city'),
												 'state '=>$this->input->post('state'),
												 'timezone'=>$this->input->post('timezone'),
												 'address '=>$this->input->post('address'),
												 'latitude '=>$lat,
												 'longitude '=>$long,
												 'phone'=>$this->input->post('phone'),
												 'type'=>$this->input->post('type'),
												 'description'=>$this->input->post('description'));
												 	
                      
						$this->location_model->UpdateDetails('fk_restaurant_locations',$data,array('location_id'=>$location_id));
							
						}
						else{
						$data			 = array('restaurant_name'=>$this->input->post('name'),
						                         'restaurant_id'=>$restaurant_id,
												 'zip_code'=>$this->input->post('zipcode'),
												 'city '=>$this->input->post('city'),
												 'state '=>$this->input->post('state'),
												 'timezone'=>$this->input->post('timezone'),
												 'address '=>$this->input->post('address'),
												 'latitude '=>'',
												 'longitude '=>'',
												 'phone'=>$this->input->post('phone'),
												 'type'=>$this->input->post('type'),
												 'description'=>$this->input->post('description'));
												 
						$this->location_model->UpdateDetails('fk_restaurant_locations',$data,array('location_id'=>$location_id));
						
						}
						$day=$this->input->post('day');
						$start=$this->input->post('start_at');
						$end=$this->input->post('end_at');
						$data['result']		= $this->location_model->deleteTimeDet($location_id);
						
						if($day!=''){
						
						//echo '<pre>';print_r($end);exit;
						for($i=0;$i<count($day);$i++)
						{
						
							//$day=$this->input->post('day');
							//$start=$this->input->post('start_at');
							//$end=$this->input->post('end_at');
						$data['result']		= $this->location_model->getTimeDet($location_id,$day[$i]);
						//print_r($data['result']);
						$startnew=explode(' ',$start[$i]);
						$endnew=explode(' ',$end[$i]);
						
							if($startnew[1]=='PM'){
								$val=explode(':',$startnew[0]);
								if($val[0]==12)
									$sta=$val[0];
								else
									$sta=$val[0]+12;
								$startnew=$sta.':'.$val[1];
							}else{
								$val=explode(':',$startnew[0]);
								if($val[0]==12)
									$sta='00';
								else
									$sta=$val[0];
								$startnew=$sta.':'.$val[1];
								//$startnew=$startnew[0];
							}
							if($endnew[1]=='PM'){
								$val=explode(':',$endnew[0]);
								if($val[0]==12)
									$en=$val[0];
								else
									$en=$val[0]+12;
								$endnew=$en.':'.$val[1];
							}else{
								$val=explode(':',$endnew[0]);
								if($val[0]==12)
									$en='00';
								else
									$en=$val[0];
								$endnew=$en.':'.$val[1];
								//$endnew=$endnew[0];
							}
						if(count($data['result'])==0){
							
							
							$data1			 = array('location_id'=>$location_id,
													'day'=>$day[$i],
									  			 	'start_at'=>$startnew,
												 	'end_at'=>$endnew
												 	);	
							//print_r($data1);
								$time	  		= $this->location_model->adddetails('fk_restaurant_opening_times',$data1);
								
						}
						else{
							
							$data2			 = array('day'=>$day[$i],
									  			    'start_at'=>$startnew,
												    'end_at'=>$endnew);	
												
							$time=			$this->location_model->UpdateTimeDetails('fk_restaurant_opening_times',$data2,array('location_id'=>$location_id,'day'=>$day[$i]));
						
						}
						
								
					
												
						}
					}
						$data			 = array('full_name'=>$this->input->post('chefname'),
									  			 'email'=>$this->input->post('email'));	
						$this->location_model->UpdateDetails('fk_member_admins',$data,array('location_id'=>$location_id));
						
						$this->session->set_flashdata('message', 'Details Updated Successfully','SUCCESS');
					    redirect('admin/location/lists');
					}	
					else
					{       
                            $user 				= $this->session->userdata('user');
                            $restaurant_id		= $user->restaurant_id;
							$address=$this->input->post('zipcode').','.$this->input->post('city').','.$this->input->post('state').','.$this->input->post('address');
						    $coordinates =file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
						    $coordinates = json_decode($coordinates);
			 				if($coordinates->status !="ZERO_RESULTS"){
									$lat=$coordinates->results[0]->geometry->location->lat;
									$long=$coordinates->results[0]->geometry->location->lng;
									$data			 = array('restaurant_name'=>$this->input->post('name'),
													 'restaurant_id'=>$restaurant_id,
													 'zip_code'=>$this->input->post('zipcode'),
													 'city '=>$this->input->post('city'),
													 'state '=>$this->input->post('state'),
													 'timezone'=>$this->input->post('timezone'),
													 'address '=>$this->input->post('address'),
													 'latitude '=>$lat,
													 'longitude '=>$long,
													 'phone'=>$this->input->post('phone'),
													 'type'=>$this->input->post('type'),
													 'description'=>$this->input->post('description'),
													 /*'start_at'=>$this->input->post('start_at'),
													 'end_at'=>$this->input->post('end_at')*/
													 );
								   
								$location	  		= $this->location_model->adddetails('fk_restaurant_locations',$data);
							}else{
							
									$data		 = array('restaurant_name'=>$this->input->post('name'),
							                     'restaurant_id'=>$restaurant_id,
												 'zip_code'=>$this->input->post('zipcode'),
												 'city '=>$this->input->post('city'),
												 'state '=>$this->input->post('state'),
												 'timezone'=>$this->input->post('timezone'),
												 'address '=>$this->input->post('address'),
												 'latitude '=>'',
												 'longitude '=>'',
												 'phone'=>$this->input->post('phone'),
												 'type'=>$this->input->post('type'),
												 'description'=>$this->input->post('description'),
												 /*'start_at'=>$this->input->post('start_at'),
												 'end_at'=>$this->input->post('end_at')*/
												 );
					           
							$location	  		= $this->location_model->adddetails('fk_restaurant_locations',$data);
							}
							
							$data			   	= array('full_name'=>$this->input->post('chefname'),
									     			   'username'=>$this->input->post('username'),
									     			   'password'=>$this->input->post('password'),
									                   'email'=>$this->input->post('email'),
										 			   'created_time'=>date('Y-m-d H:i:s'),
										 			   'role'=>3,
										 			   'restaurant_id'=>$restaurant_id,
										 			   'location_id'=>$location);	
							
							$chef				= $this->location_model->adddetails('fk_member_admins',$data);
							
							//new code for start time and end time
							$day=$this->input->post('day');
							$start=$this->input->post('start_at');
							$end=$this->input->post('end_at');
						
						
						
						if($day!=''){
						
						//echo '<pre>';print_r($end);exit;
						for($i=0;$i<count($day);$i++)
						{
						
							
						//print_r($data['result']);
						$startnew=explode(' ',$start[$i]);
						$endnew=explode(' ',$end[$i]);
						
							if($startnew[1]=='PM'){
								$val=explode(':',$startnew[0]);
								if($val[0]==12)
									$sta=$val[0];
								else
									$sta=$val[0]+12;
								$startnew=$sta.':'.$val[1];
							}else{
								$val=explode(':',$startnew[0]);
								if($val[0]==12)
									$sta='00';
								else
									$sta=$val[0];
								$startnew=$sta.':'.$val[1];
								//$startnew=$startnew[0];
							}
							if($endnew[1]=='PM'){
								$val=explode(':',$endnew[0]);
								if($val[0]==12)
									$en=$val[0];
								else
									$en=$val[0]+12;
								$endnew=$en.':'.$val[1];
							}else{
								$val=explode(':',$endnew[0]);
								if($val[0]==12)
									$en='00';
								else
									$en=$val[0];
								$endnew=$en.':'.$val[1];
								//$endnew=$endnew[0];
							}
					
							
							$data1			 = array('location_id'=>$location,
													'day'=>$day[$i],
									  			 	'start_at'=>$startnew,
												 	'end_at'=>$endnew
												 	);	
							//print_r($data1);
							$time	  		= $this->location_model->adddetails('fk_restaurant_opening_times',$data1);
												
						}
					}						
						
							
					       $this->session->set_flashdata('message', 'Details Added Successfully','SUCCESS');
						   //echo $this->user->root;
						  redirect($this->user->root.'/location/lists');
							
						
					}	
			
				}
			}else{
			
				$page						      =	($_REQUEST['pageno'])?$_REQUEST['pageno']:'';
				$output['output']                 = $this->load->view('admin/location/add',$data,true);//loading success view
				$this->_render_output($output);
			}
			
}

public function lists(){

            $user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
             //for pagination
			$config					= array();
			$config					= $this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows'] 	= 2;

			$_REQUEST['limit'] 		= (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$_REQUEST['key'] 		= (!$_POST['key'] ? ($_GET['key'] ? $_GET['key'] :''):$_POST['key']);
			$_REQUEST['status'] 		= (!$_POST['status'] ? ($_GET['status'] ? $_GET['status'] :''):$_POST['status']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
				if($_REQUEST['key']) $params .= '&key='.$_REQUEST['key'];
				if($_REQUEST['status']) $params .= '&status='.$_REQUEST['status'];
			$config['base_url'] 	= site_url($this->user->root."/location/lists")."/".$params;
            $config['total_rows']	= $this->location_model->getLocationCount($restaurant_id,$_REQUEST['key']);
		    $config['per_page']   	= $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
		    $data['page'] 			= $_REQUEST['per_page'];
		    $data['limit'] 			= $_REQUEST['limit'];
			$data['key'] 			= $_REQUEST['key'];
			$data['status'] 		= $_REQUEST['status'];
			
		    $this->pagination->initialize($config);	

		    $data['locationlist']   = $this->location_model->getAllLocations($restaurant_id,$_REQUEST['status'],$_REQUEST['key'],$config['per_page'],$_REQUEST['per_page']);
			
		//----------------------------------------------------------
	   //echo "here";exit;
       $output['SUB_TITLE'] = 'Location List';               
       $output['output']=$this->load->view('admin/location/lists',$data, true);
	   $this->_render_output($output);
}	
	

public function bulkAction($bulkaction_list='',$location_id){	
	
			$bulkaction =  $this->input->post('bulkaction');
			$location_id=$this->uri->segment(5);
			$location_id = $this->input->post('sel')?$this->input->post('sel'):$location_id;
			
		if($bulkaction=='')
			$bulkaction	=	'delete';
			
		if($bulkaction){
			if($location_id){
				switch($bulkaction){
					case 'delete':
					
						$delete_id = $this->location_model->bulkDelete($location_id);					
						$this->session->set_flashdata('message', 'Restaurant(s) Successfully Deleted ');
						
						break;
					case 'inactive':
						$update_id = $this->restaurant_model->bulkUpdate(array('restaurant_id'=>$res_id), array('status'=>'N'));	
							//echo "<pre>";  print_r(COUNT($owner_id)); echo "</pre>"; exit;
							if((COUNT($location_id)) == 1)
								$msg = 'User details updated successfully' ;
							else
								$msg = COUNT($location_id).' Restaurant details Successfully Updated.!' ;
							$this->session->set_flashdata('message', $msg ,'SUCCESS');	
						break;
					case 'active':
						$update_id = $this->restaurant_model->bulkUpdate(array('restaurant_id'=>$res_id), array('status'=>'Y'));						
						
							if(COUNT($location_id) == 1)
								$msg = 'User details updated successfully' ;
							else
								$msg = COUNT($location_id).' Restaurant details Successfully Updated.!' ;
							$this->session->set_flashdata('message', $msg ,'SUCCESS');	
						
						break;
				}
			  }  
			 else{
				$this->session->set_flashdata('message', 'Please select at least one member.! ','ERROR');	
			  }
		}
		redirect('admin/location/lists');
}
public function restaurant_status(){
  
			$location_id	=	$this->input->post('location_id');
			$status	    	=	$this->input->post('status') == 'Y' ? 'N':'Y';
		    $this->location_model->UpdateDetails('fk_restaurant_locations',array('is_clossed'=>$status),array('location_id'=>$location_id));					
			
			
			
}
public function change(){
	    
		$data['admin_id']		= $_POST['admin_id'];
		echo $this->load->view('admin/location/changepassword',$data);	
		
}
public function changepwd(){
	
	  $new_pwd		= $_POST['new_pwd']; 
	  $admin_id		= $_POST['admin_id']; 
	  $data			= array( 'password'=>$new_pwd );
	  
										
		if($this->restaurant_model->updateDetails('fk_member_admins',$data,array('admin_id'=>$admin_id))==true){
			echo "success";exit;
		}
		else{
			echo "error";exit;
		}
}

public function pagination(){
		
			$config['page_query_string'] = TRUE;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';

			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#' class='btn-info btn'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";			
			
			return $config;		
		
		
}
public function zipcode(){
	    
		$zipcode	= $_POST['zipcode'];
		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $zipcode . "&sensor=true";
		$address_info = file_get_contents($url);
        $json = json_decode($address_info);
		$city = "";
    $state = "";
    $country = "";
    if (count($json->results) > 0) {
        //break up the components
        $arrComponents = $json->results[0]->address_components;

        foreach($arrComponents as $index=>$component) {
            $type = $component->types[0];

            if ($city == "" && ($type == "sublocality_level_1" || $type == "locality") ) {
                $city = trim($component->short_name);
            }
            if ($state == "" && $type=="administrative_area_level_1") {
                $state = trim($component->short_name);
            }
            if ($country == "" && $type=="country") {
                $country = trim($component->short_name);

                if ($blnUSA && $country!="US") {
                    $city = "";
                    $state = "";
                    break;
                }
            }
            if ($city != "" && $state != "" && $country != "") {
                //we're done
                break;
            }
        }
    }
    $arrReturn = array("city"=>$city, "state"=>$state);

    die(json_encode($arrReturn));

		print_r($arrReturn);exit;
		
}
}

	
?>
