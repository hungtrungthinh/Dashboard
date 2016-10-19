<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Restaurant extends MY_Controller {

	/**
	 * Index Page for this controller.
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
			$this->load->helper(array('url','cookie'));	
			$this->user 	= $this->session->userdata('user');
			$permission= menuPermissions($this->user->role);	
			//echo $permission;
			
			if($permission==0)
				redirect($this->user->root);		
		  if($this->user=='')
				redirect('admin');		
}
public function check(){
	$username=$_POST['username'];
	$usernameexist= $this->restaurant_model->usernameExist($username);
	echo $usernameexist;
}	
public function add(){
        
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			
			$usernameexist= $this->restaurant_model->usernameExist($this->input->post('username'));
			if(($usernameexist)>0){
				 $msg = ' UserName Already Exist.!' ;
			     $this->session->set_flashdata('message', $msg ,'SUCCESS');					
				 redirect('admin/restaurant/add');
		     }
			 
				 	$data=array('restaurant_id'=>'',
								'name'=>$this->input->post('name'),
								'phone'=>$this->input->post('phone'),
								'address'=>$this->input->post('address'),
								'header_color'=>"#".$this->input->post('header_color'),
						        'body_color'=>"#".$this->input->post('body_color'),
								'loc_limit'=>$this->input->post('loc_limit'),
								'google_api_key'=>$this->input->post('google_api_key'),
								'restaurant_fb_link'=>$this->input->post('restaurant_fb_link')
								);	
				  $id= $this->restaurant_model->adddetails('fk_restaurant_master',$data);
	 		
	

			      $data=array('admin_id'=>'',
			             'full_name'=>$this->input->post('managername'),
						 'username'=>$this->input->post('username'),
						 'password'=>$this->input->post('password'),
						 'email'=>$this->input->post('email'),
						 'created_time'=>date('Y-m-d H:i:s'),
						 'role'=>2,
						 'restaurant_id'=>$id);	
   			 $this->restaurant_model->adddetails('fk_member_admins',$data);
				$msg		 = 'Restaurant Details Added successfully .!' ;
				$this->session->set_flashdata('message', $msg ,'SUCCESS');	
				redirect('admin/restaurant/lists');
	
   		}			
		$output['SUB_TITLE'] = 'Add Restaurant';
		$output['output']	= $this->load->view('admin/restaurant/add','',true);//loading success view
	    $this->_render_output($output);


}

public function lists(){
           
			//echo '<pre>';print_r($_POST);	
           //for pagination
			$config					= array();
			$config					= $this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows'] 	= 2;
			$_REQUEST['limit'] 		= (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$_REQUEST['key'] 		= (!$_POST['key'] ? ($_GET['key'] ? $_GET['key'] :''):$_POST['key']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
				if($_REQUEST['key']) $params .= '&key='.$_REQUEST['key'];
				if($_REQUEST['status']) $params .= '&key='.$_REQUEST['status'];
			$config['base_url'] 	= site_url("admin/restaurant/lists")."/".$params;
            $config['total_rows'] 	= $this->restaurant_model->getRestaurantCount($_REQUEST['key']);
		    $config['per_page']   	= $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
		    $data['page'] 			= $_REQUEST['per_page'];
		    $data['limit'] 			= $_REQUEST['limit'];
		    $data['key'] 			= $_REQUEST['key'];
		    $data['status'] 		= $_REQUEST['status'];
			
			
		    $this->pagination->initialize($config);	
		//----------------------------------------------------------
	   $data['userlist']       = $this->restaurant_model->getRestaurantLists($_REQUEST['status'],$_REQUEST['key'],$config['per_page'],$_REQUEST['per_page']);
	   
	   
	   //echo '<pre>';print_r($data['userlist']);exit;		
       
	   
	   $output['SUB_TITLE'] 		= 'Restaurant List';               
       $output['output']			= $this->load->view('admin/restaurant/lists',$data, true);
	   $this->_render_output($output);
}	
	
public function edit($restaurant_id){		

		if($_SERVER['REQUEST_METHOD']=='POST'){
			 
	        $admin_id 		 = $admin_id?$admin_id:$this->input->post('admin_id');
 			$restaurant_id	= $restaurant_id?$restaurant_id:$this->input->post('restaurant_id');
			$data=array('full_name'=>trim($this->input->post('managername')),
						'username'=>trim($this->input->post('username')),
						'email'=>trim($this->input->post('email')));	
										
			$this->restaurant_model->updateDetails('fk_member_admins',$data,array('admin_id'=>$admin_id));
        	$data=array('name'=>$this->input->post('name'),   
						'phone'=>$this->input->post('phone'),
						'address'=>$this->input->post('address'),
						'header_color'=>"#".$this->input->post('header_color'),
						'body_color'=>"#".$this->input->post('body_color'),
						'loc_limit'=>$this->input->post('loc_limit'),
						'google_api_key'=>$this->input->post('google_api_key'),
						'restaurant_fb_link'=>$this->input->post('restaurant_fb_link'),
						'forkourse_stripe_percentage'=>$this->input->post('forkourse_stripe_percentage')
						);	
						
			$this->restaurant_model->updateDetails('fk_restaurant_master',$data,array('restaurant_id'=>$restaurant_id));
		    $this->session->set_flashdata('message', 'Restaurant Details successfully updated.!' ,'SUCCESS');	
			 				
			 redirect('admin/restaurant/lists');
			
			 
	     }
	     else
	     {
			 $output['SUB_TITLE']		 = 'Edit Restaurant';
			 $data['reataurantdetails']	 = $this->restaurant_model->getAllDetails($restaurant_id);
			 $output['output']            = $this->load->view('admin/restaurant/edit',$data,true);//loading success view
			 $this->_render_output($output);
	     }

} 



public function apiGenarete($restaurant_id){

	if($_SERVER['REQUEST_METHOD']=='POST'){
			//echo '<pre>';print_r($_POST);exit; 

 			$restaurant_id	= $restaurant_id?$restaurant_id:$this->input->post('restaurant_id');
			
			
			$data=array('app_id'=>trim($this->input->post('app_id')),
						'restaurant_id'=>trim($this->input->post('restaurant_id')),
						'site_url'=>trim($this->input->post('site_url')),
						'page_tab_url'=>trim($this->input->post('page_tab_url')),
						'app_name'=>trim($this->input->post('app_name')),
						'res_pag_tab'=>trim($this->input->post('res_pag_tab'))
						
						);	
			$reataurantdetails = $this->restaurant_model->get_where('fk_restaurant_apps',$condition,"id ASC","row");
			if(count($reataurantdetails)!=0){
				$this->restaurant_model->UpdateDetails('fk_restaurant_apps',$data,array('restaurant_id'=>$restaurant_id));
		   		$this->session->set_flashdata('message', 'Restaurant App Details updated added.!' ,'SUCCESS');
			}else{
				$this->restaurant_model->adddetails('fk_restaurant_apps',$data);
		   		$this->session->set_flashdata('message', 'Restaurant App Details successfully added.!' ,'SUCCESS');	
			}
				
			 				
			redirect('admin/restaurant/lists');
			
			 
	}
	else
	{
			 $output['SUB_TITLE']		 = 'Edit Restaurant';
			 $condition =  array("restaurant_id"=>$restaurant_id);
			 $data['reataurantdetails'] = $this->restaurant_model->get_where('fk_restaurant_apps',$condition,"id ASC","row");
			 //echo '<pre>';print_r($data['reataurantdetails']);exit; 
			 $data['restaurant_id']		=	$restaurant_id;
			 $output['output']            = $this->load->view('admin/restaurant/createAPI',$data,true);//loading success view
			 $this->_render_output($output);
	}
		 
}
public function bulkAction($bulkaction_list='',$res_id){	
	
			$bulkaction =  $this->input->post('bulkaction');
			$id=$this->uri->segment(5);
			$res_id = $this->input->post('sel')?$this->input->post('sel'):$id;
			
		if($bulkaction=='')
			$bulkaction	=	'delete';
			
		if($bulkaction){
			if($res_id){
				switch($bulkaction){
					case 'delete':
					
						$delete_id = $this->restaurant_model->bulkDelete($res_id);					
						$this->session->set_flashdata('message', 'Restaurant(s) Successfully Deleted ');
						
						break;
					case 'inactive':
						$update_id = $this->restaurant_model->bulkUpdate(array('restaurant_id'=>$res_id), array('status'=>'N'));	
							//echo "<pre>";  print_r(COUNT($owner_id)); echo "</pre>"; exit;
							if((COUNT($res_id)) == 1)
								$msg = 'User details updated successfully' ;
							else
								$msg = COUNT($res_id).' Restaurant details Successfully Updated.!' ;
							$this->session->set_flashdata('message', $msg ,'SUCCESS');	
						break;
					case 'active':
						$update_id = $this->restaurant_model->bulkUpdate(array('restaurant_id'=>$res_id), array('status'=>'Y'));						
						
							if(COUNT($res_id) == 1)
								$msg = 'User details updated successfully' ;
							else
								$msg = COUNT($res_id).' Restaurant details Successfully Updated.!' ;
							$this->session->set_flashdata('message', $msg ,'SUCCESS');	
						
						break;
				}
			  }  
			 else{
				$this->session->set_flashdata('message', 'Please select at least one member.! ','ERROR');	
			  }
		}
		redirect('admin/restaurant/lists');
}
public function ajaxblock(){
  
			$id 	=	$this->input->post('id');
			$block		=	$this->input->post('is_block') == 'Y' ? 'N':'Y';
			$this->restaurant_model->UpdateDetails('fk_restaurant_master',array('status'=>$block),array('restaurant_id'=>$id));					
			if($block=='Y')
			{						
					$this->session->set_flashdata('message', "  Restaurant Unblocked ");
			}
			else
			{
					$this->session->set_flashdata('message', "  Restaurant Blocked ");
			}
			$this->session->set_flashdata('class', "success");
			
			
}

public function ajaxstate()
{
	$id 	=	$this->input->post('id');
	$state		=	$this->input->post('is_on') == '1' ? '0':'1';
	$this->restaurant_model->UpdateDetails('fk_restaurant_master',array('forkourse_stripe_status'=>$state),array('restaurant_id'=>$id));	
}
public function change(){
	    
		$data['admin_id']		= $_POST['admin_id'];
		echo $this->load->view('admin/restaurant/changepassword',$data);	
		
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
public function checkPwd(){
	$admin_id		= $_POST['admin_id']; 
	$password		= $_POST['password']; 
	$reataurantdetails = $this->restaurant_model->get_where('fk_member_admins',array('admin_id'=>$admin_id,'password'=>$password),"admin_id ASC","row");
	//print_r($reataurantdetails);
	
	if(count($reataurantdetails)!=0)
		echo "success";
	else
		echo "error";
	exit;
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
}
	
?>
