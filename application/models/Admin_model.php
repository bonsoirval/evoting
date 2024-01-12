<?php 

defined('BASEPATH') OR exit("Sorry, unknown error");

class Admin_model extends CI_model{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('security'));
        $this->load->library(array('session'));
        $this->load->database();
    }

    public function add_election(){
        /**
         * validate and pick post data, 
         * clean data
         * and insert into database
         * add flash data
         */
        if(null !== $this->input->post('add_election') &&
        $this->input->post() && $this->form_validation->run() == True){
            $election = $this->db->escape_str(xss_clean($this->input->post('election')));
            $region = $this->db->escape_str(xss_clean($this->input->post('region')));
            $election_date = $this->db->escape_str(xss_clean($this->input->post('election_date')));
             
            // add flash data
            $this->session->set_flashdata('election_added', "Election added successfully.");
            return $this->db->insert('election', $data = array('name' => $election, 'region_id' => $region, 'election_date' => $election_date, 'status' => 'upcoming',), True);
        }

        return False;
    }

    // return election region(s) for passed id
    // or return all election regions
    public function get_regions($region_id = NULL){
        if(isset ($region_id)){
            exit("Value Passed");
            // clean variable
            $region_id = xss_clean($this->db->escape_str($region_id));

            $this->db->select("state");
            $this->db->from('election');
            $this->db->where('id',$region_id);
            $result = $this->db->get();
            return $result;
        }

        $result = $this->db->query("SELECT id, state FROM regions where id >= 1 ORDER BY state ASC")->result_array();

        // pack result into array
        $result_arr = array(); 
        foreach($result as $row){
            $result_arr[$row['id']] = $row['state'];
        }
        return $result_arr;
    }

    public function update_party(){
        // confirm posted data
        $party_clicked = $this->input->post('party_clicked');
        
        if ($this->input->post()){
            // set variable to null so the condition is not passed the 2nd time
            $party_clicked  = null;
            $party          = xss_clean($this->db->escape($this->input->post('party')));
            $abbreviation   = xss_clean($this->db->escape($this->input->post('abbreviation')));
            $slogan         = xss_clean($this->db->escape($this->input->post('slogan')));
            $ideology       = xss_clean($this->db->escape($this->input->post('ideology')));
            $status         = xss_clean($this->db->escape($this->input->post('status')));

            
            $query = "UPDATE party SET name = $party, abbreviation = $abbreviation, slogan = $slogan, ideology = $ideology, status = $status 
            WHERE id = '".(int)$this->session->search_id."' "; 
            $result = $this->db->query($query);
            
            if($result == True){
                $this->session->set_flashdata('party_update', 'Party Updated Successfully');
                return $result;
            }
        }
    
        $this->db->select("name, abbreviation, slogan, ideology, status");
        $this->db->from('party');
        $this->db->where('id', (int)$this->session->search_id);
        $result = $this->db->get()->row();
        
        return $result;
    }

    public function update_election($election_id = null){

        // capture election id from url
        $update_election_lenght = strlen('update_election');
        $count_last_slash = strlen('/');
        $count2first_update_election = strpos(current_url(), 'update_election');
        
        try{
            $election_id = (int)substr(current_url(),$count2first_update_election + $update_election_lenght + $count_last_slash);
        }catch(Exception $e){
            print("Something went wrong");
        };
        
        // confirm posted data
        $election_clicked = $this->input->post('election_clicked');

        // update election table
        if ($this->input->post()){
            $query          = xss_clean($this->db->escape_str($this->input->post('query')));
            $search_type    = xss_clean($this->db->escape_str($this->input->post('search_type')));
            $search_item    = xss_clean($this->db->escape_str($this->input->post('query')));
            /**
             * '3' => 'Election Region', '4' => 'Election Date', '5' => 'Election Status'
             */
            if ((int)$search_type === 1){
                $this->db->select("e.id,e.name, e.election_date, e.status, r.state");
                $this->db->from('election AS e');
                $this->db->join('regions AS r','r.id = e.region_id');

                return $this->db->get()->result_array();

            }else if((int)$search_type === 2){
                $this->db->select('e.id, e.name, e.election_date, e.status, r.state');
                $this->db->from('election AS e');
                $this->db->join('regions AS r', 'r.id = e.region_id');
                $this->db->where('name =', $search_item);
                return $this->db->get()->result_array();

            }else if ((int)$search_type === 3){
                // election region
                $search_item = strtolower($search_item);
                $result = $this->db->query(
                    "SELECT r.id, r.state,e.id, e.name, e.election_date AS election_date, e.status 
                    FROM regions r
                    JOIN election e
                    WHERE r.state LIKE '%$search_item%' AND r.id = e.region_id"
                )->result_array();
                
                return $result;

            }else if ((int)$search_type === 4){
                // election date
                //$search_item = $this->db->escape_str($search_item);
                // $result = $this->db->query("
                //     SELECT e.name, e.election_date, e.status, r.state 
                //     FROM election AS e 
                //     JOIN regions AS r ON r.id = e.region_id
                //     WHERE e.election_date = '".$search_item."'
                // ")->result_array();

                $this->db->select("e.id,e.name, e.election_date, e.status, r.state");
                $this->db->from('election AS e');
                $this->db->join('regions AS r', 'r.id = e.region_id','right',True);
                $this->db->where('election_date = ', $search_item);
                $result = $this->db->get()->result_array();
                return $result;
                
            }else if ((int)$search_type === 5){
                $this->db->select("e.id,e.name, e.election_date, e.status, r.state");
                $this->db->from("election AS e");
                $this->db->join('regions AS r', 'r.id = e.region_id', 'right', True);
                $this->db->where('status = ', $search_item);
                $result = $this->db->get()->result_array();
                return $result;
            }

            // set variable to null so the condition is not passed the 2nd time
            $party_clicked  = null;
            $query          = xss_clean($this->db->escape($this->input->post('party')));
            $search_type   = xss_clean($this->db->escape($this->input->post('abbreviation')));
            /**
             * ["election_name"]=> string(9) "imo_guber" 
             * ["election_region"]=> string(3) "imo" 
             * ["election_date"]=> string(10) "2023-11-03" 
             * ["Name_ur"]=> string(0) "" 
             * ["election_update"]=> string(6) "Update" 
             */
            $election_name      = xss_clean($this->db->escape_str($this->input->post('election_name')));
            $election_region    = xss_clean($this->db->escape_str($this->input->post('election_region')));
            $election_date      = xss_clean($this->db->escape_str($this->input->post('election_date')));
            $status             = xss_clean($this->db->escape_str($this->input->post('status')));

            $election_update = array(
                'name' =>$election_name, 
                'election_date' =>$election_date, 
                'status' =>$status);
            // exit(var_dump($this->input->post()));
            $this->db->set($election_update);
            $this->db->where('id', $election_id);
            if ($this->db->update('election') == True){
                $region_update = array('state' =>'' );

            }

            // exit(var_dump($this->input->post()));
            
            $query = "UPDATE party SET name = $party, abbreviation = $abbreviation, slogan = $slogan, ideology = $ideology, status = $status 
            WHERE id = '".(int)$this->session->search_id."' "; 
            $result = $this->db->query($query);
            
            if($result == True){
                $this->session->set_flashdata('party_update', 'Party Updated Successfully');
                return $result;
            }
        }
    
        $this->db->select('e.name, e.status, e.election_date, r.state');
        $this->db->from('election AS e');
        $this->db->join('regions AS r', 'e.region_id = r.id',TRUE);
        $this->db->where('e.id', $election_id);
        return $this->db->get()->result_array();
        // $this->db->select('name');
        // $this->db->from('election');
        // $this->db->where('id >',0);
        // $result = $this->db->get()->result_array();
        // // exit(var_dump($result));
        // $returned_result = array();
        // foreach($result as $key => $value){
        //     $returned_result[$key] = $value;
        // }

        // return $returned_result;
    }

    public function get_region(){
        $this->db->select('id, state');
        $this->db->from('regions');
        $this->db->where('id >',0);
        return $this->db->get()->result_object();
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
        $search_result = $this->db->query($query)->row();

        // Add session data if data exists
        if (!empty($search_result->id)){
            $this->session->set_userdata("search_id", $search_result->id);
        }
        
        return $search_result;
    }

}
