<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webservice extends MY_Controller {

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
	   $this->load->model('webservice_model');
	   
	   
	   print_r($_SEESSION);

    }
	public function index_old()
	{

		//$this->load->view('templates/header', $data);
		$this->load->view('webservice', $data);	
		//$this->load->view('templates/footer', $data);
	}
	
	
	public function index()
	{


	//print_r($_SERVER);
		$sample_jsons	=	$this->webservice_model->get_sample_jsons();
		$data['sample_jsons'] = $sample_jsons;
		
		
		$sample_post	=	$this->webservice_model->get_sample_post();
		$data['sample_post'] = $sample_post;

		
		
		
		
		$this->load->view('webservice_new', $data);	
	}
	
	
	
	
	
	
	public function logs($limit)
	{


	//print_r($_SERVER);
		
		if($limit=='')
		{
			
		 $limit  = 10;
		}
		
		$sample_jsons	=	$this->webservice_model->get_sample_log($limit);
		
		$cnt  = count($sample_jsons);
		
		for($i=0;$i<$cnt;$i++)
		{
			
			$array  = json_decode($sample_jsons[$i]['json'],TRUE);
			$sample_jsons[$i]['category'] = "Sample";
			$sample_jsons[$i]['name'] = $array['function'];
			$sample_jsons[$i]['desc'] = "";
			$sample_jsons[$i]['type'] = "JSON";
			$sample_jsons[$i]['controller'] = "api";
		
		}
		
		
		$data['sample_jsons'] = $sample_jsons;
		
		
		$sample_post	=	$this->webservice_model->get_sample_post();
		$data['sample_post'] = array();

		
		
		
		
		$this->load->view('webservice_new', $data);	
	}
	
	
	
	public function yesJson()
	{
	
		$data_string='{"function":"registration_info", "parameters": {"full_name": "Basil Bby","email": "","username": "basilkk","password": "123456","device_id": "(null)"}}';                                  
		//$data_string = json_encode($data);                                                                                   

		$ch = curl_init(base_url().'client');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		 
		$result = curl_exec($ch);
	    print_r($result);exit;
	}
	
	public function noJson()
	{
	
		// Your ID and token
		$blogID = '8070105920543249955';
		$authToken = 'OAuth 2.0 token here';
		
		$postData='{"function":"registration_info", "parameters": {"full_name": "Basil Bby","email": "","username": "basilkk","password": "123456","device_id": "(null)"}}';
		
		// Create the context for the request
		$context = stream_context_create(array(
			'http' => array(
				// http://www.php.net/manual/en/context.http.php
				'method' => 'POST',
				'header' => "Authorization: {$authToken}\r\n"."Content-Type: application/json\r\n",
				'content' => $postData
			)
		));
		
		// Send the request
		$response = file_get_contents(base_url().'client', FALSE, $context);
		
		// Check for errors
		if($response === FALSE){
			die('Error');
		}
		
		print_r($response);exit;

	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */