<?php 
defined('BASEPATH') OR exit("Your action is not allowed");

class Voters_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_regions(){
        $result = $this->db->query("SELECT id,state FROM regions")->result();
        $options = array(''=>"Select Election State"); // associative array populated below
        for($index = 0; $index < count($result); $index++){
            $options[$result[$index]->id] = $result[$index]->state;
        }

        return $options;
    }
    public function vote($my_vote){
        foreach($my_vote as $key => $val){
            $result = $this->db->query("
                SELECT id as cand_id, election_id
                FROM candidate 
                WHERE id = ".$val."   
            ")->result_array();
        // die(var_dump($result));

            $voting = $this->db->query("
                INSERT INTO votes (voter_id, candidate_id, election_id)
                VALUES (".$this->session->userid.", ".$result[0]['cand_id'].",
                ".$result[0]['election_id'].")
                
            ");

            $voted = $this->db->query("
                UPDATE voter_has_election
                SET status = 'voted'
                WHERE voter_id = " . $this->session->userid . " 
                AND election_id = " . $result[0]['election_id'] . "
            ");
        }
        echo "<br/>";
    }

    public function register_voter(){
        // check if user already registered
        $data = array(
            'firstname' => $this->db->escape($this->security->xss_clean($this->input->post('firstname'))),
			'lastname'  => $this->db->escape($this->security->xss_clean($this->input->post('lastname'))),
			'username'  => $this->db->escape($this->security->xss_clean($this->input->post('username'))),
            'email'     => $this->db->escape($this->security->xss_clean($this->input->post('email'))),
			'nin'       => $this->db->escape($this->security->xss_clean($this->db->escape($this->input->post('nin')))),
            // password hash
            'password'  => hash('sha512', $this->db->escape($this->input->post('password'))),
        );
        
        $this->db->insert('voters', $data);
        $new_voter_id = $this->db->select_max('id')->from('voters')->get()->row()->id;

        $region_id = $this->input->post('region');

        $this->db->select('id,region_id');
        $this->db->from('election');
        $this->db->where('region_id', $region_id);
        $region_elections =  $this->db->get()->result_array();
        
        for($index = 0; $index < count($region_elections); $index++){
            $data = array(
                'voter_id' => (int)$new_voter_id, 
                'status' => 'not voted',
                'election_id' => (int)$region_elections[$index]['id']);
            $this->db->insert('voter_has_election', $data);
        }
        /**
         * register voter
         * pick his id 
         * pick the id of his chosen region 
         * for all elections in the region and fct
         * add voter_has_election
         */
        echo $this->db->affected_rows();
        
    }


    public function login_voter(){  
        $username = $this->db->escape($this->input->post('username'));
        $password = hash('sha512',$this->db->escape($this->input->post('password')));

        $sql = "SELECT id,username, email FROM voters WHERE username = ? AND password = ?";
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

    public function get_elections(){
        // // subqeury to get user eligible election
        // $this->db->select('id');
        // $this->db->from('voters_has_election');
        // $sub_query = $this->db->get_compiled_select();

        // // get elections
        // $this->db->select("*");
        // $this->db->from('election');
        // $this->db->where("id IN ($sub_query)");
        // $this->db->where('status = "ongoing" ');
        // $election_subquery = $this->db->get_compiled_select();

        // // get id 
        // $this->db->select("*");
        // $this->db->from('election');
        // $this->db->where("id IN ($sub_query)");
        // $this->db->where('status = "ongoing" ');
        // $election_ids = $this->db->get_compiled_select();

        // $this->db->select("id");
        // $this->db->from('candidates');
        // $this->db->where("id IN ($election_ids)");
        
        // // $this->db->where('status = "ongoing" ');
        // // $election_subquery = $this->db->get_compiled_select();
        // $election_result = $this->db->get()->result_array();

        /*
        select election
                party
                candidates
                for the user
        */
      
        $election_result = $this->db->query(
            "
            SELECT DISTINCT(e.name) AS election,c.surname as candidate,  e.id AS election_id
            FROM election e 
            JOIN candidate c ON c.election_id = e.id
            WHERE e.id IN (
                SELECT vhe.election_id 
                FROM voter_has_election vhe
                WHERE vhe.voter_id = ".$this->session->userid." 
                AND status = 'not voted'
            )
            AND e.status = 'ongoing'
            order by election
            "
        )->result_array();
        // exit(var_dump($election_result));
        return $election_result; 
    }

    // get candidates
    public function get_candidate($election_id){
        return 'cand election id: '.$election_id;
        $data = array(
            'status' => 'ongoing',
            'voters_id' => $this->session->userid,
        );

        $result = $this->db->get('voters_has_election', $data)->row_array();

        $election_data = array(
            'id' => (int)$result['voters_id'],
        );
        $election = $this->db->get('election', $data)->row_array();
        // echo var_dump((int)$result['voters_id']);
        // echo "<br/>";
        // echo var_dump((int)$election['id']);
        // echo "<br/>".$election['name'];

        return $election; 
    }

    public function logout_voter(){
        session_destroy();
        return TRUE;
    }
}