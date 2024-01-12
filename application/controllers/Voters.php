<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voters extends CI_Controller {
	public $data;

	public function __construct(){
		parent::__construct();

		// load session library
		$this->load->library('session');
		$this->load->model('Voters_model'); 

		$this->load->helper('url');
		$this->data = array(
			'css' => $this->config->item('css'),
			'js' => $this->config->item('js'),
			'image'=>$this->config->item('image'),
			'nav'=>$this->config->item('nav')
		);
	}

	public function register_voter()
	{
		// Load useful variables
		$this->load->helper(array('form'));
		$this->load->library('form_validation');

		// Validation Rules
		$this->form_validation->set_rules('region', 'Regions', 'required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'min_length[5]|max_length[12]', 'Username must be filled and unique');
		$this->form_validation->set_rules('nin', "NIN', required|min_length(10)|max_length(15)|is_uniqued[voters.nin]");
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');	
		
		// $this->form_validation->set_rules('password', 'Password', 'required');
		// $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');

		// form submittion 
		if ($this->form_validation->run() === FALSE){	
			$this->data['firstname']	= array('name'	=>	"firstname",'required'	=> 'required', 'class' => 'form-control', 'type' => "text", 'placeholder' => 'Enter first name','value' => set_value('firstname'));	
			$this->data['lastname']		= array('name' => 'lastname','required' => 'required', 'class' => 'form-control', 'type' => "text", 'placeholder' => "Enter last name",'value' => set_value('lastname'));
			$this->data['username']		= array('name' => 'username','id' =>	"username",'required' => 'required','class' => 'form-control', 'type' => "text",'placeholder' => 'Enter Username','value' => set_value('username'));
			$this->data['nin']			= array('name' => 'nin','id' => 'nin','required' => 'required','placeholder' => 'Enter NIN','type' => 'text','class' => 'form-control','value' => set_value('nin'));
			$this->data['email']		= array('name' => 'email','id' => 'email','required' => 'required','placeholder' => 'Enter email', 'type' => 'text','class' => 'form-control','value' => set_value('email'));
			$this->data['password']		= array('name' => 'password','id' => 'password','required' => 'required','class' => 'form-control','placeholder' => 'Enter password','type' => 'password');
			$this->data['passconf']		= array('name' => 'passconf',	'id' => 'passconf','required' => 'required','class' => 'form-control','placeholder' => 'Enter password again','type' => 'password');
			$this->data['options']		= $this->Voters_model->get_regions();
			
			// $this->data['firstname']	= $firstname;
			// $this->data['lastname']		= $lastname;
			// $this->data['username'] 	= $username;
			// $this->data['nin'] 			= $nin;
			// $this->data['email'] 		= $email;
			// $this->data['password'] 	= $password;
			// $this->data['passconf'] 	= $passconf;
			
			$this->load->view('templates/header.html', $this->data);
			$this->load->view('voter_register', $this->data);
			$this->load->view('templates/footer.html', $this->data);
		}else{
			// $this->load->model('Voters_model');
			$this->Voters_model->register_voter();
			$this->load->view('voter_register_success');
		}

	}

	/*
	*/
	public function voter_login(){
		$this->load->helper(array('form'));
		$this->load->library('form_validation');

		# Validation rules for login
		$this->form_validation->set_rules('username', "Username", 'required');
		$this->form_validation->set_rules('password', "Password", 'required');

		if ($this->form_validation->run() === FALSE){
			$this->login_form();
			
		}else{
			// $this->load->model('Voters_model');
			$logged_in = $this->Voters_model->login_voter();

			if ($logged_in === FALSE) {
				// show login form
				$this->login_form();
			}else {
				// exit("Halt");
				$link = base_url() . 'index.php/voter_dashboard/index';
				redirect($link); //)->to($link);

			}

		}

	}

	public function voter_logout(){
		// $this->load->model('Voters_model');
		$logout = $this->Voters_model->logout_voter();
		if ($logout === TRUE) {
			redirect(base_url());
		}
	}

	private function login_form(){
		/**
		 * 
		 */
		$username = array(
			'name'	=>	"username",
			'id' 	=>	"username",
			'required'	=> 'required',
			'type' => "text",
			'class' => "form-control",
			'placeholder' => 'Enter username',
			'value' => set_value('username'),
			// 'errors' => array(
			// 	'required' => 'You must provide a value.')
		);	

		$password = array(
			'name' => 'password',
			'id' => 'pwd',
			'required' => 'required',
			'type' => 'password',
			'class' => 'form-control',
			'placeholder' => 'Enter password',
			'value' => set_value('password'),
		);

		$submit = array(
			'type' => 'submit',
			'class' => 'btn btn-default',
			'content' => "Login",
			'value' => 'True'
		);

		$this->data['username'] = $username;
		$this->data['password'] = $password;
		$this->data['submit'] = $submit;
			
		$this->load->view('templates/header.html', $this->data);
		$this->load->view('voter_login', $this->data);
		$this->load->view('templates/footer.html', $this->data);
	}
}
