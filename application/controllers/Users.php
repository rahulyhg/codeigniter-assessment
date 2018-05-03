<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login()
	{
		$this->load->model('User_Model');

	    if ($this->input->post('login'))
	    {
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
	    	
	    	$user_id = $this->User_Model->login($email, $password);

	    	if ( !empty($user_id) ) {
    			return redirect('users/success');
	    	}
	    	else {
    			return redirect('users/login');
	    	}
	    }
	    
	    return $this->load->view('login_page');
	}

	public function register()
	{
		$this->load->model('User_Model');

	    if ($this->input->post('register'))
	    {
			$data['first_name'] = $this->input->post('first_name');
			$data['last_name']  = $this->input->post('last_name');
			$data['username']   = $this->input->post('username');
			$data['email']      = $this->input->post('email');
			$data['password']   = $this->input->post('password');
			$data['phone']      = $this->input->post('phone');
	    	
	    	$token = $this->User_Model->register($data);

	    	if ( !empty($token) ) {
                $to = $this->input->post('email');
                $subject = 'CodeIgniter Assessment Activation Link';
                $message = '
                <p>
                    Thank you for registering.
                    Please activate your account in <a href="' . base_url("users/activation") . $token . '">here</a>.
                </p>
                ';

				if(empty($to)) {
					return FALSE;
				}
				$this->load->library('email');
				$this->email->from('ricky@softwareseni.com', 'CodeIgniter Assessment');
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();

    			return redirect('users/login');
	    	}
	    	else {
    			return redirect('users/register');
	    	}
	    }
	    
	    return $this->load->view('register_page');
	}

	public function activate($token = '')
	{
		$this->load->model('User_Model');

		if ( empty($token) ) {
			return redirect('users/error');
		}
    	$activation = $this->User_Model->activate($token);
    	if ( !empty($activation) ) {
			return redirect('users/success');
    	}
    	else {
			return redirect('users/error');
    	}
	}

	public function error()
	{
		return $this->load->view('error_page');
	}

	public function success()
	{
		return $this->load->view('success_page');
	}
}
