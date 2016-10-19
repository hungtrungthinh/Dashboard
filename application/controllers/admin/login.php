<?php
class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_setAsAdmin();
		$this->load->model('admin/admin_model');

	}

	public function index()
	{
			$this->_login();
	}
	
	
	public function check_login1() {		
	 	
	 	$username=$this->input->post('username');
	 	$password=$this->input->post('password');	
		$this->load->model('admin/admin_model');
		$arr_1	=	$this->admin_model->veryfyadmin($username,$password);
		//$user 		= $this->_authenticate($userid);
		
		
		if($arr_1[0]->role==2){
			$arr_1	=	$this->admin_model->checkStatusOfRestaurant($username,$password);
			//print_r($arr_1);
			if(count($arr_1)==0){
				$result = array('status' => 'error','result' => 'Invalid login. Restaurant is blocked');
				echo json_encode($result);
				exit;
			}
			
		}else if($arr_1[0]->role==3){
			$arr_1	=	$this->admin_model->checkStatusOfLocation($username,$password);
			if(count($arr_1)==0){
				$result = array('status' => 'error','result' => 'Invalid login. Restaurant is blocked');
				echo json_encode($result);
				exit;
			}
		}else{
			
		}

	 	if(count($arr_1)!=0)
		{
		
			switch($arr_1[0]->role){
				case "1" : $arr_1[0]->root = "admin";	break;
				case "2" : $arr_1[0]->root = "manager";	break;
				case "3" : $arr_1[0]->root = "chef";	break;
				default	:  $arr_1[0]->root = "admin";	break;
			}
		
			$this->session->set_userdata('user',$arr_1[0]);
			$this->user 	= $this->session->userdata('user');
			
			//print_r($this->user);exit;
			//$this->session->set_userdata($arr_1);
			$result = array('status' => 'success','result' => 'valid','role'=>$arr_1[0]->role);
			echo json_encode($result);
			//echo 'valid';
			exit;
		} else {
			$result = array('status' => 'error','result' => 'Invalid Username or Password');
			echo json_encode($result);
			//echo 'invalid';
			exit;
		}
	}	
	
public function forgotpassword(){
	    
		echo $this->load->view('admin/settings/forgotpassword');	
		
}

public function forgotpwd(){
   
	$email_id		= $_POST['email']; 
    $data       = $this->admin_model->getpassword($email_id);
	$new_password 	= 	$this->admin_model->randomPassword(); 
	$this->load->model('email_model');
	$this->load->helper('cookie');

	//echo (count($data));
	if(count($data)>0)
	{
	$email = $this->email_model->get_email_template('forgot_password_admins');
				
	$this->load->library('encrypt');
	$full_name = $data['full_name'];
	$target_name = $this->config->item('site_name');
   	$link =base_url().'admin/login/reset_password/'.$new_password.'/?sess='.md5($email_id);
	 
	$subject = $email['email_subject'];
	$message  = $email['email_template'];        
	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html; charset=utf-8" . "\r\n";			
	$headers .= 'From: '.$this->config->item('email_from'). "\r\n";
			
	$message  = $email['email_template'];                          
	$message  = str_replace('%FULL_NAME%',$full_name,$message);	
	$message  = str_replace('%LINK%',$link,$message);
	$message  = str_replace('%SITE_NAME%',$target_name,$message);

    if (@mail($email_id, $subject, $message, $headers))
	{
        echo "success";
		
		$update_array = array('password_reset_key'=>$new_password,'password_reset_time'=>date('Y-m-d H:i:s'));
		$this->db->where('email',$email_id);
		$this->db->update('fk_member_admins',$update_array);
		exit;
	}
    else
        echo "There is error in sending mail!";
		
	}
else{
	  echo "Please enter valid email id!";
	}
}

public function reset_password($new_password)
{
	$email = $this->input->get('sess');
	$expire_hour = ($this->config->item('reset_expire'))?$this->config->item('reset_expire'):4;
	$check_array = $this->admin_model->checkResetPassword($email);
	if(count($check_array) && ($check_array['password_reset_key'] == $new_password))
	{
		$diff_seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($check_array['password_reset_time']);
		$diff_hour = $diff_seconds/3600;
		if($diff_hour < $expire_hour)
		{
			$data['email'] = $check_array['email'];
			$data['key'] = $new_password;
			//delete_cookie($new_password);
			
			//$output['site_name']	= getConfigValue('site_name_front');
			$data['site_name']	= 'Forkourse';
			$data['title'] = 'Password Reset';
			$data['template_url'] = base_url('assets/admin_lte');
		    $this->load->view('admin/admin_lte/static_header',$data);
			$this->load->view('admin/settings/resetPassword',$data);
			$this->load->view('admin/admin_lte/footer',$data);
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Reset password link expire ! Try again !');
			redirect('/admin/login', 'refresh');
		}
	}
	else
	{
		$this->session->set_flashdata('error_message', 'Reset password link expire ! Try again !');
		redirect('/admin/login', 'refresh');
	}
	
}

public function changepassword()
{
	$data = $this->input->post();
	if($data['password'] == $data['confirm_password'])
	{
		
		$check = array('password'=>$data['password']);
		$admin_data  = $this->admin_model->getpassword($data['email']);
		$result = $this->admin_model->updateMemberAdmin($check,$admin_data['admin_id']);
		if($result!='error')
		{
			$update_array = array('password_reset_key'=>NULL,'password_reset_time'=>NULL);
			$this->admin_model->updateMemberAdmin($update_array,$admin_data['admin_id']);
			echo 'success';
		}	
		else{
			echo 'error';
		}
	}
	else
	{	
		echo 'Password Mismatch';
	}
}



}