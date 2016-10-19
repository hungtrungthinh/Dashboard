<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Promocodes extends MY_Controller {

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
				$this->load->model('admin/promocode_model');
				$this->user 	= $this->session->userdata('user');
				if($this->user=='')
					redirect('admin');		
}
public function index(){
	redirect('admin/promocodes/lists');		
	
}
public function add($id=''){
	
	
            $id = $this->input->post('id')?$this->input->post('id'):$id;
			if($id!=''){
				$data['result']		= $this->promocode_model->getPromocodeById($id);
				}
			else{
				$data['result'] = $_POST;
			}
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				               
								if($id)
								{
									
									$data			 = array('title'=>$this->input->post('title'),
								                 'promocode'=>$this->input->post('promocode'),
												 'restaurant_id'=>$this->input->post('restaurant_id'),
												 'location_id'=>'',
												 'description'=>$this->input->post('description'),
												 'start_date '=>$this->input->post('from'),
												 'end_date'=>$this->input->post('to'),
												 'uses_per_coupon '=>$this->input->post('uses'),
												 'total_uses'=>0, 	
												 'discount_type'=>$this->input->post('type'),
												 'discount_amount'=>$this->input->post('discount'),
												 'status'=>'Y');
									$this->promocode_model->update_by(array('promo_id'=>$id),$data);
									$this->session->set_flashdata('message', 'Details Updated Successfully','SUCCESS');
									 redirect('admin/promocodes/lists');
								}	
								else{	
					
					   			$data			 = array('title'=>$this->input->post('title'),
								                 'promocode'=>$this->input->post('promocode'),
												 'restaurant_id'=>$this->input->post('restaurant_id'),
												 'location_id'=>'',
												 'description'=>$this->input->post('description'),
												 'start_date '=>$this->input->post('from'),
												 'end_date'=>$this->input->post('to'),
												 'uses_per_coupon '=>$this->input->post('uses'),
												 'discount_type'=>$this->input->post('type'),
												 'discount_amount'=>$this->input->post('discount'),
												 'status'=>'Y');
												 	
                      // print_r($data);exit;
						$this->promocode_model->adddetails('fk_promocodes',$data);
						$this->session->set_flashdata('message', 'Details Added Successfully','SUCCESS');
					    redirect('admin/promocodes/lists');
				
			}
			}
				$page						      =	($_REQUEST['pageno'])?$_REQUEST['pageno']:'';
				$output['output']                 = $this->load->view('admin/promocodes/add',$data,true);//loading success view
				$this->_render_output($output);
			
			
}

public function lists(){

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
			$config['base_url'] 	= site_url($this->user->root."/promocodes/lists")."/".$params;
            $config['total_rows']	= $this->promocode_model->getPromoCount($_REQUEST['key']);
		    $config['per_page']   	= $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
		    $data['page'] 			= $_REQUEST['per_page'];
		    $data['limit'] 			= $_REQUEST['limit'];
			$data['key'] 			= $_REQUEST['key'];
			$data['status'] 		= $_REQUEST['status'];
			
		    $this->pagination->initialize($config);	

		    $data['promolist']   = $this->promocode_model->getAllPromocodes($_REQUEST['status'],$_REQUEST['key'],$config['per_page'],$_REQUEST['per_page']);
			
		//----------------------------------------------------------
	   //echo "here";exit;
       $output['SUB_TITLE'] = 'promocodes List';               
       $output['output']=$this->load->view('admin/promocodes/lists',$data, true);
	   $this->_render_output($output);
}	
	
public function delete($promo_id)
	{
		$promo_id	=	$_POST['item_id'];
		$delete_id = $this->promocode_model->deletePromocodeById($promo_id);				
		$this->session->set_flashdata('message', 'promocode(s) Successfully Deleted ');
		redirect('admin/promocodes/lists');
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

public function generatePromo(){
	
		   $this->load->helper('string');
		   $promo= random_string('alpha',8);              
		   echo $promo;
	          
}
public function check_exist(){
	            
       	 $promocode=$_POST['promocode'];
		 $restaurant_id=$_POST['restaurant_id'];
		 $promoID=$_POST['promID'];
		 echo $promo_code = $this->promocode_model->checkExist($promocode,$restaurant_id,$promoID);			
	          
}
}

	
?>
