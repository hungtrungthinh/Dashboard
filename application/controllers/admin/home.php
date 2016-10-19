<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends MY_Controller {

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
	 */	
	public function __construct()
	{
		
		
		parent::__construct();
		$this->_setAsAdmin();
		$this->user 	= $this->session->userdata('user');
		$this->load->model('restaurant_model');
		$this->load->model('admin/admin_model');
		if($this->user=='')
			redirect('admin');	
	}
	
	public function index(){	
	
	
		
		$data['template_url']  		 = $this->template_url ;		
		$member_details = $this->admin_model->getMemberDetails($this->user->admin_id);//print_r($member_details);
		$data['menus']	= getMenus($this->user->role);
		$data['user'] = $this->session->userdata('user');
		
		//$data['countorder']=$this->admin_model->getCount();
		//$data['countcustomer']=$this->admin_model->getCustomer();
		$data['countrestaurant']=$this->admin_model->getRestaurant();
		$data['countsettings']=$this->admin_model->getSettings();
		$data['route'] = $data['user']->root;
		//print_r($this->session->userdata('user'));exit;
		switch($this->user->role){
			case 1:{
					$ouput['output']			= $this->load->view('admin/admin_lte_old/home',$data,true);
				}
				break;
			case 2: {
					///for restaurant manager 
					$restaurant_id = $member_details->fk_restaurant_master_id;
					//data['restaurantcount']=$this->admin_model->getRestaurantcount($this->user->admin_id);
					
					$data['countorder']=$this->admin_model->getCount2($restaurant_id);
					$data['countreport']=$this->admin_model->getReport($restaurant_id);
					$data['countcustomer']=$this->admin_model->getCustomer($restaurant_id);
					$data['countlocation']=$this->admin_model->getLocation($restaurant_id);
					$data['countpromocode']=$this->admin_model->getPromocode();
					
					if($restaurant_id == ''){
						$data['error']=1;
						$data['error_message'] = "You are not assigned with any restaurant. Please contact administrator. ";
					}
					elseif($restaurant_id && $member_details->fk_restaurant_master_status=='N'){
						$data['error']=1;
						$data['error_message'] = "Administrator has blocked your restaurant. Please contact administrator. ";
					}
				}
				//print_r($this->session->userdata('user'));
				//$ouput['output']			= $this->load->view('admin/admin_lte_old/home',$data,true);
				$ouput['output']			= $this->load->view('admin/manager/home',$data,true);
				break;
			case 3: {
					//for restaurant chef 
					$restaurant_id = $member_details->fk_restaurant_master_id;
					$location_id    = $member_details->fk_restaurant_locations_id;
					$data['user'] = $this->session->userdata('user');
					//$data['countorder']=$this->admin_model->getCount($location_id);
					$data['countmenu']=$this->admin_model->getMenu($location_id );
					$data['countpreference']=$this->admin_model->getPreference($location_id );
					
					if($restaurant_id == ''){
						$data['error']=1;
						$data['error_message'] = "You are not assigned with any restaurant. Please contact your Manager. ";
					}
					if($location_id == ''){
						$data['error']=1;
						$data['error_message'] = "You are not assigned with any restaurant location. Please contact your Manager. ";
					}
					elseif($member_details->fk_restaurant_master_status=='N'){
						$data['error']=1;
						$data['error_message'] = "Administrator has blocked your restaurant. Please contact your Manager. ";
					}
				}
				$ouput['output']			= $this->load->view('admin/'.$this->admin_theme.'/home',$data,true);
			break;
		}
		
		$this->_render_output($ouput);
			
	}

	
  
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */