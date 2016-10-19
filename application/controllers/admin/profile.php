<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Profile extends MY_Controller {

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
				$this->load->model('restaurant_model');
				$this->load->model('location_model');
				$this->user 	= $this->session->userdata('user');
				if($this->user=='')
					redirect('admin');		
}
public function index(){
	switch($this->user->role){
		case 2: {
			//echo '<pre>'; print_r($this->session->userdata['user']->username);exit;
			 $restaurant_id=$this->session->userdata['user']->restaurant_id;
			 $data['profiledetails']	 = $this->restaurant_model->getAllDetails($restaurant_id);
			// echo '<pre>'; print_r($data['profiledetails']);exit;
			//echo '<pre>'; print_r($data['managerprofile']);exit;
			$output['output']=$this->load->view('admin/profile/edit_manager',$data, true);
		   $this->_render_output($output);
	   }
	   break;
	   case 3: {
		//echo '<pre>'; print_r($this->session->userdata['user']->username);exit;
		$location_id=$this->session->userdata['user']->location_id;
		$restaurant_id=$this->session->userdata['user']->restaurant_id;
		
		$data['chefdetails']		= $this->location_model->getLocationDet($location_id,$restaurant_id);
		$data['chefdetails']['location_id']=$location_id;
		//echo '<pre>'; print_r($data['chefdetails']);exit;
		$data['timezonedetails']	 = $this->location_model->getAllTimezone();
		$data['timeresult']		= $this->location_model->getLocationTimeDet($location_id);
		//print_r($data['timeresult']);exit;
		foreach ($data['timeresult'] as $timeresult ){
			$data[$timeresult['day']]=$timeresult;
		}
		//echo '<pre>'; print_r($data['timezonedetails']);exit;
		//echo '<pre>'; print_r($data['managerprofile']);exit;
		$output['output']=$this->load->view('admin/profile/edit_chef',$data, true);
	   	$this->_render_output($output);
	   }
	   break;
	   }
}	
public function edit_manager($restaurant_id){		

		if($_SERVER['REQUEST_METHOD']=='POST'){
			//echo '<pre>';print_r($_POST);exit;
	        $admin_id 		 = $admin_id?$admin_id:$this->input->post('admin_id');
 			$restaurant_id	= $restaurant_id?$restaurant_id:$this->input->post('restaurant_id');
			$data=array('full_name'=>trim($this->input->post('managername')),
						'username'=>trim($this->input->post('username')),
						'email'=>trim($this->input->post('email')));	
									
			$this->restaurant_model->updateDetails('fk_member_admins',$data,array('admin_id'=>$admin_id));
			
        	$data=array('name'=>$this->input->post('name'),   
						'phone'=>$this->input->post('phone'),
						'address'=>$this->input->post('address'));	
						
			$this->restaurant_model->updateDetails('fk_restaurant_master',$data,array('restaurant_id'=>$restaurant_id));
		    $this->session->set_flashdata('message', 'Restaurant Details successfully updated.!' ,'SUCCESS');	
			 				
			 redirect('admin/profile');
			
			 
	     }
	     else
	     {
			 $output['SUB_TITLE']		 = 'Edit Profile';
			 $data['reataurantdetails']	 = $this->restaurant_model->getAllDetails($restaurant_id);
			 $output['output']            = $this->load->view('admin/profile',$data,true);//loading success view
			 $this->_render_output($output);
	     }

} 

public function edit_chef($location_id){

			
		   $location_id	    = $this->input->post('location_id');
		   $restaurant_id	    = $this->input->post('restaurant_id');
		//echo $location_id;		
	//	print_r($_POST);exit;


						//location update
						$address=$this->input->post('zipcode').','.$this->input->post('city').','.$this->input->post('state').','.$this->input->post('address');
						$coordinates =file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
						$coordinates = json_decode($coordinates);
			 			if($coordinates->status !="ZERO_RESULTS"){
							$lat=$coordinates->results[0]->geometry->location->lat;
							$long=$coordinates->results[0]->geometry->location->lng;
						}
						
						// end location update

					  $data			 = array('restaurant_name'=>$this->input->post('name'),
								                 'restaurant_id'=>$restaurant_id,
												 'address '=>$this->input->post('address'),
												 'zip_code'=>$this->input->post('zipcode'),
												 'city '=>$this->input->post('city'),
												 'state '=>$this->input->post('state'),
												 'phone'=>$this->input->post('phone'),
												 'type'=>$this->input->post('type'),
												 'latitude '=>$lat,
												 'longitude '=>$long,
												 'description'=>$this->input->post('description'),
												 'timezone'=>$this->input->post('timezone'));
                    
						$this->location_model->UpdateDetails('fk_restaurant_locations',$data,array('location_id'=>$location_id));
						
						$data['timeresult']		= $this->location_model->getLocationTimeDet($location_id);
						//print_r($data['timeresult']);exit;
				foreach ($data['timeresult'] as $timeresult ){
					$data[$timeresult['day']]=$timeresult;
				}
				//print_r($data);exit;
					    $day=$this->input->post('day');
						$start=$this->input->post('start_at');
						$end=$this->input->post('end_at');
						$br_start = $this->input->post('break_start_at');
						$br_end = $this->input->post('break_end_at');
						$is_breaks = $this->input->post('is_break');
						$data['result']		= $this->location_model->deleteTimeDet($location_id);
						//print_r($day);exit;
						if($day!=''){
						for($i=0;$i<count($day);$i++)
						{
						
							//$day=$this->input->post('day');
							//$start=$this->input->post('start_at');
							//$end=$this->input->post('end_at');
						$data['result']		= $this->location_model->getTimeDet($location_id,$day[$i]);
						//print_r($data['result']);
						$startnew=explode(' ',$start[$i]);
						$endnew=explode(' ',$end[$i]);
						$br_startnew=explode(' ',$br_start[$i]);
						$br_endnew=explode(' ',$br_end[$i]);
						$breaked = $is_breaks[$i];
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
							
							if($br_startnew[1]=='PM'){
								$val=explode(':',$br_startnew[0]);
								if($val[0]==12)
									$sta=$val[0];
								else
									$sta=$val[0]+12;
								$br_startnew=$sta.':'.$val[1];
							}else{
								$val=explode(':',$br_startnew[0]);
								if($val[0]==12)
									$sta='00';
								else
									$sta=$val[0];
								$br_startnew=$sta.':'.$val[1];
								//$startnew=$startnew[0];
							}
							
							if($br_endnew[1]=='PM'){
								$val=explode(':',$br_endnew[0]);
								if($val[0]==12)
									$en=$val[0];
								else
									$en=$val[0]+12;
								$br_endnew=$en.':'.$val[1];
							}else{
								$val=explode(':',$br_endnew[0]);
								if($val[0]==12)
									$en='00';
								else
									$en=$val[0];
								$br_endnew=$en.':'.$val[1];
								//$endnew=$endnew[0];
							}
						if(count($data['result'])==0){
							
							
							$data1			 = array('location_id'=>$location_id,
													'day'=>$day[$i],
									  			 'start_at'=>$startnew,
												 'end_at'=>$endnew,
												 'break_start_at'=>$br_startnew,
												 'break_end_at'=>$br_endnew,
												 'is_break' => $breaked
												 );	
							//print_r($data1);
								$time	  		= $this->location_model->adddetails('fk_restaurant_opening_times',$data1);
								
						}
						else{
							
							$data2			 = array('day'=>$day[$i],
									  			    'start_at'=>$startnew,
												    'end_at'=>$endnew,
												    'break_start_at'=>$br_startnew,
												 	'break_end_at'=>$br_endnew,
												 	'is_break' => $breaked);
												
							$time=			$this->location_model->UpdateTimeDetails('fk_restaurant_opening_times',$data2,array('location_id'=>$location_id,'day'=>$day[$i]));
						
						}
						
								
					
												
						}
					}	
						$data			 = array('full_name'=>$this->input->post('chefname'),
									  			 'email'=>$this->input->post('email'));	
						$this->location_model->UpdateDetails('fk_member_admins',$data,array('location_id'=>$location_id));
						
						$this->session->set_flashdata('message', 'Details Updated Successfully','SUCCESS');
					    redirect('chef/profile');
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
public function uploadLogo($id){						
			if($id!='')
				//$id="temp";
			
			//$session_data	=	$this->session->userdata('users');
		    //$restaurant_id	=	$session_data['restaurant_id'];
			$uploadDir ="assets/images/profile/".$id;
							
				
			
				$fname = explode(".",str_replace(" ","",$_FILES['file']['name']));
				$fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fname[0]);
				$fileName = md5(microtime());
				$fileName=$fileName.'.'.$fname[1];
				$fileParts = pathinfo($_FILES['file']['name']);
				
                //$image_name = '_temp.jpg';	
				
			    $fileName=$restaurant_id.'.'.$fname[1];
				$uploadFile = $uploadDir.$fileName;	
				$image_info = getimagesize($_FILES["file"]["tmp_name"]);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
				//echo $image_height;exit;
				if ($image_width > 1500 || $image_height > 1500)
					{
					unlink(base_url("assets/images/profile/" . $image_info));
					echo 'image is to big';
					exit;
					}
				if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadFile))
				{
					 $imagePoP=array ("image" =>$image_name);
				   	  echo base_url().$uploadFile.'?'.time();	
					 
					$imagethumb1			= 		"assets/images/profile/".$restaurant_id.$fname;
							  
					
				 }
			 $data=array('logo'=>$id.'.'.$fname[1]);	
			 $this->restaurant_model->UpdateDetails('fk_restaurant_master',$data,array('restaurant_id'=>$id));	
		
		exit;
}
	
public function remove_imagetemp(){
		$id=$_POST['restaurant_id'];
			$img_name=$this->input->post('img_name');
			
			$name=explode('?',$img_name);	
				 unlink(base_url("assets/images/profile/" . $name[0])); 
				if(unlink('assets/images/profile/'.$name[0]))
				{	
				    $data=array('logo'=>'');				
					$this->restaurant_model->UpdateDetails('fk_restaurant_master',$data,array('restaurant_id'=>$id));				
					echo 'yes';				
				}
				else
				{
					echo 'no';
				}			
			
}	




}
	
?>
