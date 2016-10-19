<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preference extends MY_Controller {

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
	public function __construct()
	{
		parent::__construct();
		$this->_setAsAdmin();
		$this->load->model('preference_model');
		$this->user 	= $this->session->userdata('user');
		if($this->user=='')
			redirect('admin');		
			
	}
    public function index(){
	
		redirect($this->user->root.'/preference/lists');
	
	}
	public function lists($location_id=''){
		$user = $this->session->userdata('user');
	
	    $role=$user->role;
		$restaurant_id=$user->restaurant_id;
		if($location_id=='')
	    $location_id=$user->location_id;	
		
		$data['configlist']	=	$this->preference_model->get_restConfig_manager($restaurant_id, $location_id,$role);
		//echo '<pre>';print_r($data['configlist']);exit;
		
		
		$data['restconfiglist']=$this->preference_model->get_many_by(array('location_id'=>$location_id));
		//echo '<pre>';print_r($data['restconfiglist']);exit;
		
		
		//exit;
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$post_title	=	$_POST['title'];
			$post_aar	=	$_POST;
			//echo '<pre>';print_r($_POST);
			if(count($data['restconfiglist'])!=0){
				foreach ($post_aar as $key => $value) 
				{
					if($key!='title'){
					$data_getdata=$this->preference_model->get_by(array('location_id'=>$location_id,'config_id'=>$key));
					if(sizeof($data_getdata))
					{
						$update_id = $this->preference_model->update_by(array('config_id'=>$key,'location_id'=>$location_id,'restaurant_id'=>$restaurant_id), array('value'=>$value));
						}
						else
						{
						
						$dd=array('config_id'=>$key,
								  'field'=>$key,
								  'value'=>$value,
								  'location_id'=>$location_id,
								  'restaurant_id'=>$restaurant_id,
								  'description'=>$key);
						$update_id = $this->preference_model->insert($dd);
						}
						
					}
				}
			}else{
				
				$i=0;
				foreach ($post_aar as $key => $value) 
				{
				
					if($key!='title'){
						$dd=array('config_id'=>$key,
								  'field'=>$key,
								  'value'=>$value,
								  'location_id'=>$location_id,
								  'restaurant_id'=>$restaurant_id,
								  'description'=>$post_title[$i]);
						$update_id = $this->preference_model->insert($dd);
						$i++;
						//echo "test1";
						//exit;
						
					}
					
				}
				
			}
			
			
			$this->session->set_flashdata('message', 'Preferences  Updated Successfully. ','SUCCESS');				
			redirect($this->user->root.'/preference/lists/'.$location_id);
		} 
		
		
		//echo '<pre>';print_r($data);exit;
		$output['output']=$this->load->view('admin/preference/preference', $data, true);
		$this->_render_output($output);
	}
	

}
