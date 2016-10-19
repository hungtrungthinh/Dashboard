<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Reports extends My_Controller {


	public function __construct()
	{                        
		parent::__construct();
		$this->_setAsAdmin();
		$this->load->helper(array('url','cookie'));	
		$this->load->model('admin/reports_model');		
	}

	public function index()
	{
		redirect('admin/reports/sales');
	}
	public function sales($category_id=''){

		if($this->session->userdata('user')!=''){
			
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			
			//for pagination
			$config	=array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']= 2;
			
			$_REQUEST['limit'] = (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$_REQUEST['daterange'] = (!$_POST['daterange'] ? ($_GET['daterange'] ? $_GET['daterange'] :''):$_POST['daterange']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
				if($_REQUEST['daterange']) $params .= '&daterange='.$_REQUEST['daterange'];
				
			//print_r($_POST);
			if($_REQUEST['daterange']!='')
			{
				$daterange	=	$_REQUEST['daterange'];
				$dates	=	explode('-',$daterange);
				$startDate	=	date('Y-m-d',strtotime($dates[0]));
				$endDate	=	date('Y-m-d',strtotime($dates[1]));
				$data['startDate']   =  $startDate;
				$data['endDate']   =  $endDate;
			}else{
				//$startDate	=	date('Y-m-d');
				//$endDate	=	date('Y-m-d');
				//$data['startDate']   =  $startDate;
				//$data['endDate']   =  $endDate;
			
			}
			
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$config['total_rows'] = $this->reports_model->countSalesReport($restaurant_id,$startDate,$endDate);
				 $config['per_page'] =$data['limit']= $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
				$data['orderdetails']	=$this->reports_model->getAllSalesReport($restaurant_id,$config['per_page'],$_REQUEST['per_page'],$startDate,$endDate);
				
			}else{
				$config['total_rows'] = $this->reports_model->countSalesReport($restaurant_id);
				$config['per_page'] = $data['limit']=$_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
				$data['orderdetails']	=$this->reports_model->getAllSalesReport($restaurant_id,$config['per_page'],$_REQUEST['per_page']);
			}
			$data['per_page']=$config['per_page'] ;
			$config['base_url'] = site_url($this->user->root."/reports/sales")."/".$params;	
			$this->pagination->initialize($config);		
			//echo '<pre>';print_r($data['orderdetails']);exit;		
			$ouput['output']			= $this->load->view('admin/reports/reports-sales',$data,true);
			$this->_render_output($ouput);
		
		}else{
			redirect('admin');
		}
	}
	




public function customers($per_page)
	{
	
		if($this->session->userdata('user')!=''){
			
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
			
			//for pagination
			$config	=array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']= 2;
			
			 $_REQUEST['limit'] = (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$_REQUEST['daterange'] = (!$_POST['daterange'] ? ($_GET['daterange'] ? $_GET['daterange'] :''):$_POST['daterange']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
				if($_REQUEST['daterange']) $params .= '&daterange='.$_REQUEST['daterange'];
				
				
			if($_REQUEST['daterange']!='')
			{
				$daterange	=	$_REQUEST['daterange'];
				$dates	=	explode('-',$daterange);
				$startDate	=	date('Y-m-d',strtotime($dates[0]));
				$endDate	=	date('Y-m-d',strtotime($dates[1]));
				$data['startDate']   =  $startDate;
				$data['endDate']   =  $endDate;
			}
			
			
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
			
				$config['total_rows'] = $this->reports_model->countCustomersReports($restaurant_id,$location_id,$startDate,$endDate);
				 $config['per_page'] =$data['limit']= $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
				$data['orderdetails']	=$this->reports_model->getAllCustomerReport($restaurant_id,$location_id,$config['per_page'],$per_page,$startDate,$endDate);
				
			}else{
			//echo $_REQUEST['per_page'];
			
				$config['total_rows'] = $this->reports_model->countCustomersReports($restaurant_id,$location_id);
				$config['per_page'] = $data['limit']=$_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
				$data['orderdetails']	=$this->reports_model->getAllCustomerReport($restaurant_id,$location_id,$config['per_page'],$_REQUEST['per_page']);
			}
			$data['per_page']=$config['per_page'] ;
			$config['base_url'] = site_url($this->user->root."/reports/customers")."/".$params;	
			$this->pagination->initialize($config);		
			//echo '<pre>';print_r($data['orderdetails']);exit;		
			$ouput['output']			= $this->load->view('admin/reports/reports-customers',$data,true);
			$this->_render_output($ouput);
		
		}else{
			redirect('admin');
		}
	}


	public function items($per_page)
	{
		if($this->session->userdata('user')!=''){
			$user = $this->session->userdata('user');
			$restaurant_id=$user->restaurant_id;
			$location_id=$user->location_id;
		    $location_id;
			
						//for pagination
			$config	=array();
			$config=$this->pagination();
			$this->load->library('pagination');
			$data['total_rows']= getConfigValue('default_pagination');
			//$data['total_rows']= 2;
			
			$_REQUEST['limit'] = (!$_POST['limit'] ? ($_GET['limit'] ? $_GET['limit'] :$data['total_rows']):$_POST['limit']);
			$params = '?t=1';
				if($_REQUEST['limit']) $params .= '&limit='.$_REQUEST['limit'];
			$config['base_url'] = site_url($this->user->root."/reports/items")."/".$params;
			$config['total_rows'] = $this->reports_model->countItemsReport($restaurant_id,$location_id);
			$config['per_page'] = $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
			$data['page'] = $_REQUEST['per_page'];
			$this->pagination->initialize($config);	
			
			
			if($_REQUEST['daterange']!='')
			{
				$daterange	=	$_REQUEST['daterange'];
				$dates	=	explode('-',$daterange);
				$startDate	=	date('Y-m-d',strtotime($dates[0]));
				$endDate	=	date('Y-m-d',strtotime($dates[1]));
				$data['startDate']   =  $startDate;
				$data['endDate']   =  $endDate;
			}
			
			
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
			
				$config['total_rows'] = $this->reports_model->countCustomersReports($restaurant_id,$location_id,$startDate,$endDate);
				 $config['per_page'] =$data['limit']= $_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
				$data['orderdetails']	=$this->reports_model->getAllItemsReport($restaurant_id,$location_id,$config['per_page'],$per_page,$startDate,$endDate);
				
			}else{
			//echo $_REQUEST['per_page'];
			
				//$config['total_rows'] = $this->reports_model->countCustomersReports($restaurant_id,$location_id);
				$config['per_page'] = $data['limit']=$_REQUEST['limit'] == 'all' ? $config['total_rows']:$_REQUEST['limit'];
				$data['orderdetails']	=$this->reports_model->getAllItemsReport($restaurant_id,$location_id,$config['per_page'],$_REQUEST['per_page']);
			}
				
				//echo '<pre>';print_r($data['orderdetails']);exit;		
				$data['per_page']=$config['per_page'] ;
				$ouput['output']			= $this->load->view('admin/reports/reports-items',$data,true);
				$this->_render_output($ouput);
			
		}else{
			redirect('admin');
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
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#' class=''>";
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
	public function csv()
	{    
	    
	    $this->load->helper('custom_helper');
	     $page=$_POST['page'];
		 $fields=$_POST['feilds'];
		 $limit=$_POST['limit'];
		 $per_page=$_POST['per_page'];
		 $start=$_POST['startdate'];
		 $end=$_POST['enddate'];
		 $line=implode (", ", $fields);
	  // echo $limit;exit;
	  	$user = $this->session->userdata('user');
		$restaurant_id=$user->restaurant_id;
		 if($page=='single'){
		 $data['orderdetails']	=$this->reports_model->getAllSalesReportcsv($fields,$limit,$per_page,$start,$end);
		 }else{
		 $data['orderdetails']	=$this->reports_model->getAllSalesReportcsv($fields,'','',$start,$end);
		 }
		 
	    $file_name="uploads/csv/".$restaurant_id.'_'.date('d-m-Y').".csv";
		$fp = fopen($file_name, 'w');
		$line .= "\n";
        fputs($fp, $line);
		$order	=	explode(',', $data['orderdetails']);
		//print_r($data['orderdetails']);exit;
		foreach($data['orderdetails'] as $order){
			
		$line = "";
		$line = str_replace('"', '""', $order['order_ref_id']) . ','.str_replace('"', '""', $order['restaurant_name']) . ','.
				str_replace('"', '""', $order['first_name'].''.$order['last_name']).
		        ','.str_replace('"', '""', $order['order_type']). ','.str_replace('"', '""', $order['total_amount']). ','.
				str_replace('"', '""', date('d-m-Y',strtotime($order['created_time'])));
		$line .= "\n";
		fputs($fp, $line); 		
		}
		
//$phones	=	explode(',', $phones);

fclose($fp);
            
          
// this function is written in custom_helper
	$date = date("Y-m-d");
   
	 if($page=='single'){
		$result=$this->reports_model->getQuery($fields,$limit,$per_page,$start,$end); 
	 }else{
		$result=$this->reports_model->getQuery($fields,'','',$start,$end);
	 }
		 
   query_to_csv($result,TRUE,'uploads/csv/_'.strtotime($date).'.csv');
   $ouput['output']			= $this->load->view('admin/reports/reports-sales',$data,true);
   $this->_render_output($ouput);
          
	}
	
	public function generatecsv()
	{
		 $data['start']=$_POST['start'];
		 $data['end']=$_POST['end'];
		//$data['generatecsv']=array("OrderID","Name");
		echo $this->load->view('admin/reports/generate-csv',$data,true);	
	}
	
	public function generate_customer_csv()
	{
		 $data['start']=$_POST['start'];
		 $data['end']=$_POST['end'];
		//$data['generatecsv']=array("OrderID","Name");
		echo $this->load->view('admin/reports/generate-customers-csv',$data,true);	
	}
	
	public function customer_csv()
	{    
	    
	    $this->load->helper('custom_helper');
	     $page=$_POST['page'];
		 $fields=$_POST['feilds'];
		 $limit=$_POST['limit'];
		 $per_page=$_POST['per_page'];
		 $start=$_POST['startdate'];
		 $end=$_POST['enddate'];
		 $line=implode (", ", $fields);
	  // echo $limit;exit;
	  
	 	 $user = $this->session->userdata('user');
		 $restaurant_id=$user->restaurant_id;
		 if($page=='single'){
		 $query = $this->reports_model->getAllCustomerReportcsv($restaurant_id,$fields,$limit,$per_page,$start,$end);
		// $data['orderdetails']	= $query ->result_array();
		
		 }else{
		 $query = $this->reports_model->getAllCustomerReportcsv($restaurant_id,$fields,'','',$start,$end);
		 //$data['orderdetails']	= $query ->result_array();
		 }
/*		
		
	    $file_name="uploads/csv/customer_order_".$restaurant_id.'_'.date('d-m-Y').".csv";
		$fp = fopen($file_name, 'w');
		$line .= "\n";
        fputs($fp, $line);
		$order	=	explode(',', $data['orderdetails']);
		//print_r($data['orderdetails']);exit;
		foreach($data['orderdetails'] as $order){
			
		$line = "";
		$line = str_replace('"', '""', $order['first_name'].''.$order['last_name']) . ','.
				str_replace('"', '""', $order['delivery_count']) . ','.str_replace('"', '""', $order['delivery']).','.
				str_replace('"', '""', $order['pickup_count']). ','.str_replace('"', '""', $order['pickup']). ','.
				str_replace('"', '""', $order['facebook_count']). ','.str_replace('"', '""', $order['facebook']). ','.
				str_replace('"', '""', $order['app_count']). ','.str_replace('"', '""', $order['app']). ','.
				str_replace('"', '""', $order['website_count']). ','.str_replace('"', '""', $order['website']). ','.
				str_replace('"', '""', $order['breakfast_count']). ','.str_replace('"', '""', $order['breakfast']). ','.
				str_replace('"', '""', $order['lunch_count']). ','.str_replace('"', '""', $order['lunch']). ','.
				str_replace('"', '""', $order['dinner_count']). ','.str_replace('"', '""', $order['dinner']). ','.
				str_replace('"', '""', $order['total_order']). ','.str_replace('"', '""', $order['total_amount']);
		$line .= "\n";
		fputs($fp, $line); 		
		}
		
//$phones	=	explode(',', $phones);

fclose($fp);*/
            
          
// this function is written in custom_helper
	$date = date("Y-m-d");
  

   query_to_csv($query,TRUE,'uploads/csv/customer_order_'.strtotime($date).'.csv');
   $ouput['output']			= $this->load->view('admin/reports/reports-sales',$data,true);
   $this->_render_output($ouput);
          
	}
	
	public function generate_item_csv()
	{
		 $data['start']=$_POST['start'];
		 $data['end']=$_POST['end'];
		//$data['generatecsv']=array("OrderID","Name");
		echo $this->load->view('admin/reports/generate-items-csv',$data,true);	
	}
	
	
	public function item_csv()
	{    
	    
	    $this->load->helper('custom_helper');
	     $page=$_POST['page'];
		 $fields=$_POST['feilds'];
		 $limit=$_POST['limit'];
		 $per_page=$_POST['per_page'];
		 $start=$_POST['startdate'];
		 $end=$_POST['enddate'];
		 $line=implode (", ", $fields);
	  // echo $limit;exit;
	  
	 	 $user = $this->session->userdata('user');
		 $restaurant_id=$user->restaurant_id;
		 if($page=='single'){
		 $query = $this->reports_model->getAllItemReportcsv($restaurant_id,$fields,$limit,$per_page,$start,$end);
		 $data['orderdetails']	= $query ->result_array();
		
		 }else{
		 $query = $this->reports_model->getAllItemReportcsv($restaurant_id,$fields,'','',$start,$end);
		 $data['orderdetails']	= $query ->result_array();
		 }
		// echo '<pre>';print_r($data['orderdetails']);exit;
/*		
		
	    $file_name="uploads/csv/customer_order_".$restaurant_id.'_'.date('d-m-Y').".csv";
		$fp = fopen($file_name, 'w');
		$line .= "\n";
        fputs($fp, $line);
		$order	=	explode(',', $data['orderdetails']);
		//print_r($data['orderdetails']);exit;
		foreach($data['orderdetails'] as $order){
			
		$line = "";
		$line = str_replace('"', '""', $order['first_name'].''.$order['last_name']) . ','.
				str_replace('"', '""', $order['delivery_count']) . ','.str_replace('"', '""', $order['delivery']).','.
				str_replace('"', '""', $order['pickup_count']). ','.str_replace('"', '""', $order['pickup']). ','.
				str_replace('"', '""', $order['facebook_count']). ','.str_replace('"', '""', $order['facebook']). ','.
				str_replace('"', '""', $order['app_count']). ','.str_replace('"', '""', $order['app']). ','.
				str_replace('"', '""', $order['website_count']). ','.str_replace('"', '""', $order['website']). ','.
				str_replace('"', '""', $order['breakfast_count']). ','.str_replace('"', '""', $order['breakfast']). ','.
				str_replace('"', '""', $order['lunch_count']). ','.str_replace('"', '""', $order['lunch']). ','.
				str_replace('"', '""', $order['dinner_count']). ','.str_replace('"', '""', $order['dinner']). ','.
				str_replace('"', '""', $order['total_order']). ','.str_replace('"', '""', $order['total_amount']);
		$line .= "\n";
		fputs($fp, $line); 		
		}
		
//$phones	=	explode(',', $phones);

fclose($fp);*/
            
          
// this function is written in custom_helper
	$date = date("Y-m-d");
  

   query_to_csv($query,TRUE,'uploads/csv/item_order_'.strtotime($date).'.csv');
   $ouput['output']			= $this->load->view('admin/reports/reports-items',$data,true);
   $this->_render_output($ouput);
          
	}
	
	
	}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */