<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public $data = array();
    public $form_validation;
    public $Admin_model;

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $form_validation = $this->load->library('form_validation');
        $this->load->model('Admin_model');
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
                SELECT id, name, abbreviation, slogan, ideology, status 
                FROM party 
                WHERE $query_type = '".$this->db->escape_str($query)."' ";

            $this->data['table_data'] = $this->Admin_model->get_parties($query);
           
        }


        $this->data['title'] = "Admin title";
        $this->load->view('admin/partials/header',$this->data);
        $this->load->view('admin/manage_party', $this->data);
        $this->load->view('admin/partials/footer',$this->data);
    }

    public function update_party(){

        // if form submitted
        if($this->input->post() && $this->input->post('party_clicked')){
            if($this->Admin_model->update_party() == True){ // update was successful
                return redirect('admin/manage_party');
            }
        }

        $party_update = $this->Admin_model->update_party();
        
        $this->data['title']        = "Party update";
        // exit(var_dump($party_update));
        if ($this->form_validation->run() == False){
            // form fields
            $this->data['party_update'] = $party_update;
            $this->data['party']        = array('name'=>'party', 'class'=>'form-control', 'value' => $party_update->name);
            $this->data['abbreviation'] = array('name' => 'abbreviation', 'class'=>'form-control', 'value' => $party_update->abbreviation);
            $this->data['slogan']       = array('name'=>'slogan', 'class'=>'form-control', 'value' => $party_update->slogan);
            $this->data['ideology']     = array('name' => 'ideology', 'class'=>'form-control', 'value'=> $party_update->ideology);
            $this->data['status']       = array('name' => 'status');
            $this->data['options']      = array('' =>'Select Status', 'deactivated' => 'Deactivated', 'active' => 'Active', 'non' => 'None existent' );
            $this->data['extra']        = array('class' => 'form-control');

            // validation rules
            $this->form_validation->set_rules('party',"Party",'required',array('<style color:"red">Party name is required</style>'));
            $this->form_validation->set_rules('abbreviation', 'Abbreviation','required',array('<style color:"red">Party abbreviation is required</style>'));
            $this->form_validation->set_rules('slogan', 'Slogan','required',array('Party slogan is required'));
            $this->form_validation->set_rules('ideology','Ideology','required', array('Ideology is required'));
            $this->form_validation->set_rules('status', 'Status', 'required', array('Status is required'));


            $this->load->view('admin/partials/header', $this->data);
            $this->load->view('admin/update_party', $this->data);
            $this->load->view('admin/partials/footer', $this->data);
        }else{
            exit("Hey you");
            $result = $this->Admin_model->update_party();
            exit(var_dump($result));
            // Load views
            $this->load->view('admin/partials/header', $this->data);
            $this->load->view('admin/update_party', $this->data);
            $this->load->view('admin/partials/footer', $this->data);
        }
    }

    public function add_election(){
        
        // validate no duplications
        $this->form_validation->set_rules('election', 'Election', 'required|is_unique[election.name]', array('required' =>'Election name must be provided','is_unique'=>'Duplicate [double] election names are not allowed'));
        $this->form_validation->set_rules('election_date', 'Election date','required', array('required' => "Date for election must be provided"));
        $this->form_validation->set_rules('region', 'Election Region','required', array('required' => 'Provide election region'));

        // add form fields to this->data
        $this->data['election'] = array('name' => 'election', 'class'=>'form-control', 'type' => 'text', 'required' => True, 'placeholder' => 'Enter election name');
        $this->data['election_date'] = array('name' => 'election_date', 'class'=>'form-control', 'type' => 'date', 'required' => True);
        $this->data['region'] = array('name' => 'region', 'class'=>'form-control', 'type' => 'text','required' => True, 'placeholder' => 'Enter election region');
        $this->data['add_election'] = array('name' => 'add_election', 'type' => 'submit',  'value' => 'Add Election', 'class' => 'form-control');
        $this->data['title'] = "Add election";
        // create region variable 
        $this->data['region'] = $this->Admin_model->get_region();
        
        /**
         * if button is clicked
         * form validation successful
         * and data posted
         */
        $election = $this->input->post('add_election');
        if(isset($election) && $this->form_validation->run() == True &&
        $this->input->post()){
            $this->Admin_model->add_election();
        }
        // election region dropdown options
        $options = array();
        // populate the dropdown options
        foreach ($this->data['region'] as $key => $val){
            $options[$val->id] = $val->state;
        }

        $this->data['options'] = $options;

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