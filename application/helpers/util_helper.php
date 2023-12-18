<?php 
    if (!function_exists('get_candidate')){
        // get candidates
        function get_candidate($election_id){
            $ci=& get_instance();
            $ci->load->database(); 
            
            $candidates = $ci->db->query(
                "
                    SELECT concat(c.firstname, ' ' , c.surname, ' ', c.lastname) as cand_name, c.id AS cand_id, p.name AS party
                    FROM candidate c 
                    JOIN party p ON c.party_id = p.id 
                    WHERE election_id = ".(int)$election_id."
                "
            )->result_array();

            // var_dump($candidates);
            return $candidates; 
        }
    }
    if (!function_exists('get_election_id')){
        //get election id
        function get_election_id($election) {
            $last = 500;
            return $last;
        }
    }
        
    function test(){
        echo "Hello how u";
    }
?>