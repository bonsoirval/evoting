<?php 

defined('BASEPATH') OR exit("Sorry, unknown error");

class Admin_model extends CI_model{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('security'));
        $this->load->library(array('session'));
        $this->load->database();
    }


    public function admin_login(){
        $username = $this->db->escape($this->security->xss_clean($this->input->post('username')));
        // $password = $this->db->escape($this->security->xss_clean($this->input->post('password')));
        $password = hash('sha512',$this->db->escape($this->input->post('password')));

        $sql = "SELECT id,username, email FROM admins WHERE username = ? AND password = ?";
        $result = $this->db->query($sql, array($username, $password));

        if ($result->num_rows() === 1){
            $result = $result->row_array(); // convert to array
            $userdata = array(
                'userid'        => $result['id'],
                'username'  => $result['username'],
                'email'     => $result['email'],
                'logged_in' => TRUE
                );
                // var_dump($user_session_data);
                $this->session->set_userdata($userdata); 
                return TRUE;
        }
        return FALSE;
    }

    public function add_pary(){
        $party_data = array(
            'name' => $this->db->escape($this->input->post('party')),
            'abbreviation' => $this->db->escape($this->input->post('abbreviation')),
            'slogan' => $this->db->escape($this->input->post('slogan')),
            'ideology' => $this->db->escape($this->input->post('ideology'))
        );

        return $this->db->insert('party', $party_data);

    }

    // fetch political parites
    public function get_parties($query){
        
        // $this->db->select($query_type);
        // $this->db->where(, $query);
        return $this->db->query(
        //    "SELECT name, abbreviation, slogan, ideology, status FROM party"
        $query
        )->row();
    }
}
