<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->data = array();
        
    }

    public function index(){
        // Validation Rules
		$this->form_validation->set_rules('username', 'Username', 'required');
		// $this->form_validation->set_rules('username', 'Username', 'min_length[5]|max_length[12]', 'Username must be filled and unique');
		// $this->form_validation->set_rules('nin', "NIN', required|min_length(10)|max_length(15)|is_uniqued[voters.nin]");
		// $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		// $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');	

        if ($this->form_validation->run() == false) {
            // <input type="text" name="username" class="form-control" id="yourUsername" required>
            $username = array('type' => 'text','name' => 'username','class' => 'form-control','id' => 'yourUsername','required' => TRUE,'placeholder' => 'Enter username');

            //<input type="password" name="password" class="form-control" id="yourPassword" required>
            $password = array('type' => 'password','name' => 'password','class' => 'form-control','id' => 'password_id','required' => TRUE);

            $this->data['title'] = 'Imsu Election Admin Login';
            $this->data['username'] = $username;
            $this->data['password'] = $password;

            $this->load->view('admin/partials/login_header',$this->data);
            $this->load->view('admin/login', $this->data);
            $this->load->view('admin/partials/footer');
        }else{
            $this->data['title'] = "Admin Login";
            // admin login
            if ($this->Admin_model->admin_login() == True){


                $this->load->view('admin/partials/header',$this->data);
                $this->load->view('admin/index', $this->data);
                $this->load->view('admin/partials/footer',$this->data);
            }else{
                return redirect(base_url().'index.php/admin/index');
            }
        }
        
    }

    public function add_party(){
        // validation rules 
        $this->form_validation->set_rules('party', 'Party', 'required|is_unique[party.name]',
        //errory messages for required and is_unique
        array('required' => "Party name must be filled", 'is_unique' => "Party already exists"));
        
        $this->form_validation->set_rules('abbreviation', 'Abbreviation', 'required|is_unique[party.abbreviation]',
        array('required' => "Party abbreviation must be filled", 'is_unique' => "Party abbreviation already exists"));
        
        $this->form_validation->set_rules('slogan', 'Slogan', 'required|is_unique[party.slogan]',
        array('requred' => 'Party slogan must be filled', 'is_unique' => "Party slogan already exists"));
        
        $this->form_validation->set_rules('ideology','Ideology', 'required|is_unique[party.name]',
        array('rerquired' => "Party ideology already exists", 'is_unique' => "Ideology already exists"));

        // create form fields
        $name = array('name' => 'party', 'type' => 'text','class' => 'form-control');
        $abbrevition = array('name' => 'abbreviation', 'type' => "text",'class' => "form-control");
        $slogan = array('name' => 'slogan', 'type' => "text",'class' => "form-control");
        $ideology = array('name' => 'ideology', 'style' => "height: 100px", 'class' => "form-control");
        $register = array('name' => 'register', 'type' => "submit", 'class' => "btn btn-primary",'content' => "Register");

        // if validation failed
        if ($this->form_validation->run() == FALSE){
            echo "validation failed";
        }else if ($this->form_validation->run() == TRUE){
        // else if validation succeeded
            if ($this->Admin_model->add_pary() == TRUE){
                echo "added party";
            }
        }

        // add form fields to array data 
        $this->data['register'] = $register;
        $this->data['ideology'] = $ideology;
        $this->data['slogan'] = $slogan;
        $this->data['abbreviation'] = $abbrevition;
        $this->data['name'] = $name;
        $this->data['title'] = "Add a political party";
        $this->load->view('admin/partials/header',$this->data);
        $this->load->view('admin/add_party', $this->data);
        $this->load->view('admin/partials/footer',$this->data);
    }

    public function manage_party(){
        // load table library
        $this->load->library('table');

        // validation rules
        $this->form_validation->set_rules('query',"Query",'required',
        array('<style color:"red">Search Qery needed</style>'));
        $this->form_validation->set_rules('search_type', 'Search Type','required',
        array('<style color:"red">Search Type</style>'));

        // form fields
        
        $this->data['query']        = array('type' => 'text','name' => 'query','class' => 'form-control','id' => 'query','required' => TRUE,'placeholder' => 'Search');
        $this->data['search_type']  = array('' => 'Select Search Item','party_name' => 'Party Name','party_slogan' => 'Party Slogan','party_abbreviation' => 'Party Abbreviation');
        $this->data['attr']         = array('class' => 'form-control');
        

        if($this->form_validation->run() == True){
            // execute needed functions
            
            $query = $this->input->post('query');
            $query_type = strtolower(substr($this->input->post('search_type'),6));    

            // get values from model
            $query = "
                SELECT name, abbreviation, slogan, ideology, status 
                FROM party 
                WHERE $query_type = '".$this->db->escape_str($query)."' ";

            $this->data['table_data'] = $this->Admin_model->get_parties($query);
           
        }


        $this->data['title'] = "Admin title";
        $this->load->view('admin/partials/header',$this->data);
        $this->load->view('admin/manage_party', $this->data);
        $this->load->view('admin/partials/footer',$this->data);
    }

    public function add_election(){
        $this->load->view('admin/partials/header',$this->data);
        $this->load->view('admin/add_election', $this->data);
        $this->load->view('admin/partials/footer',$this->data);
    }

    public function manage_election(){
        $this->load->view('admin/partials/header',$this->data);
        $this->load->view('admin/manage_election', $this->data);
        $this->load->view('admin/partials/footer',$this->data);
    }

    public function add_voter_group(){
        $this->load->view('admin/partials/header',$this->data);
        $this->load->view('admin/add_voter_group', $this->data);
        $this->load->view('admin/partials/footer',$this->data);
    }

    public function manage_voter_group(){
        $this->load->view('admin/partials/header',$this->data);
        $this->load->view('admin/manage_voter_group', $this->data);
        $this->load->view('admin/partials/footer',$this->data);
    }

}

?>