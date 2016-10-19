<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Customers extends My_Controller {


public function __construct() {                        
		parent::__construct();
		$this->_setAsAdmin();
		$this->load->helper(array('url','cookie'));	
		$this->load->model('admin/customer_model');	
		$this->load->model('restaurant_model');		
}

public function index(){
		redirect($this->user->root.'/customers/lists');
}

public function lists($res_id){
 		//print_r( $_POST);
        $role=$this->session->userdata('user')->role;
		if($this->session->userdata('user')!=''){
			$user				 	= $this->session->userdata('user');
			$restaurant_id			= $user->restaurant_id;
            //for pagination
			$config					= array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']		= 2;
			$_REQUEST['limit'] 		= (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$params					= '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
			$config['base_url']		= site_url($this->user->root."/customers/lists")."/".$params;
			if($role==1){
			$restaurant_id=$_POST['rest'];
			
			$config['total_rows'] 	= $this->customer_model->countCustomers1($_REQUEST['key'],$restaurant_id);
			}
			
			else{
			$config['total_rows'] 	= $this->customer_model->countCustomers($restaurant_id,$_REQUEST['key']);
			}
			$config['per_page'] 	= $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
			$data['page'] 			= $_REQUEST['per_page'];
			$data['limit'] 			= $_REQUEST['limit'];
			$data['key']  			= $_REQUEST['key'];
			$this->pagination->initialize($config);		
		     if($role==1){
			 $restaurant_id=$_POST['rest'];
			//print_r( $restaurant_id);
			 $data['customerdetails'] = $this->customer_model->getCustomerDetails1($_REQUEST['key'],$config['per_page'],$_REQUEST['per_page'],$restaurant_id);	
			// print_r($data['customerdetails']);
			 $data['restaurantlist']=$this->restaurant_model->getRestaurant();
			 }
			 
			 else{
			 $data['customerdetails'] = $this->customer_model->getCustomerDetails($restaurant_id,$_REQUEST['key'],$config['per_page'],$_REQUEST['per_page']);	
			 }
			// print_r($data['customerdetails']);exit;
			$ouput['output']		 = $this->load->view('admin/customers/lists',$data,true);
			$this->_render_output($ouput);
		
		}else{
			redirect('admin');
		}
	}
	
	
public function details($member_id){
	if($this->session->userdata('user')!=''){
			$user				 	= $this->session->userdata('user');
			$restaurant_id			= $user->restaurant_id;
			$member_id	    = $member_id?$member_id:($this->input->get('member_id')?$this->input->get('member_id'):0);
			if($member_id!=''){
			$data['result'] 			= $this->customer_model->getCustomerInfo($member_id,$restaurant_id);
			if(count($data['result'])==0){
					$data['error']="No customers found";
				}else{
					$data['error']='';
				}
		    }
			else{
				$data['error']='';
				$data['result'] = $_POST;
			}
			$ouput['output']			= $this->load->view('admin/customers/details',$data,true);
			$this->_render_output($ouput);
	}else{
		redirect('admin');
	}
		
}
public function ajaxblock(){
  
			$id 		=	$this->input->post('id');
			$block		=	$this->input->post('is_block') == 'Y' ? 'N':'Y';
			$this->customer_model->UpdateDetails('fk_member_master',array('status'=>$block),array('member_id'=>$id));					
				if($block=='Y')
				{						
					$this->session->set_flashdata('message', "  Customer Unblocked ");
				}
				else{
					$this->session->set_flashdata('message', "  Customer Blocked ");
				}
			$this->session->set_flashdata('class', "success");
			
			
}
public function edit($member_id){	
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$member_id 		 = $member_id?$member_id:$this->input->post('member_id');
			$data			 = array('first_name'=>trim($this->input->post('first_name')),
									 'last_name'=>trim($this->input->post('last_name')));	
			$this->customer_model->UpdateDetails('fk_member_master',$data,array('member_id'=>$member_id));
		    $this->session->set_flashdata('message', 'Customer Details successfully updated.!' ,'SUCCESS');	
		    redirect($this->user->root.'/customers/lists');
		}
	    

} 
public function export(){
		//echo '<pre>';print_r($_POST);exit;
	    
	    
	     $this->load->helper('custom_helper');
	     $page=$_POST['page'];
		 $fields=$_POST['feilds'];
		 $limit=$_POST['limit'];
		 $per_page=$_POST['per_page'];
		 
		 $line=implode (", ", $fields);
	    // echo $limit;exit;
	  
	 	 $user = $this->session->userdata('user');
		 $restaurant_id=$user->restaurant_id;
		 if($page=='single'){
		 	////$query = $this->reports_model->getAllCustomerReportcsv($restaurant_id,$fields,$limit,$per_page,$start,$end);
			//$query = $this->customer_model->csvGenetaion($restaurant_id,$fields,0,10);	 
		 }else{
		 	//$query = $this->reports_model->getAllCustomerReportcsv($restaurant_id,$fields,'','',$start,$end);
			//$query = $this->customer_model->csvGenetaion($restaurant_id,$fields,'','');	 
		 }
	$query = $this->customer_model->csvGenetaion($restaurant_id,$fields,0,10);	 
	//echo '<pre>';print_r($data['customerdetails']);exit;
	$date = date("Y-m-d");
  

   query_to_csv($query,TRUE,'uploads/csv/user'.strtotime($date).'.csv');
   $ouput['output']			= $this->load->view('admin/reports/reports-sales',$data,true);
   $this->_render_output($ouput);
          
	
}	
public function pagination(){
		
			$config['page_query_string'] = TRUE;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';

			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
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
public function delete($member_id){
	
	 $member_id	    = $member_id?$member_id:($this->input->get('member_id')?$this->input->get('member_id'):0);	
     $this->customer_model->bulkDelete($member_id);
		    $this->session->set_flashdata('message', 'Customer Details successfully deleted.!' ,'SUCCESS');	
		   redirect($this->user->root.'/customers/lists');
} 	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */