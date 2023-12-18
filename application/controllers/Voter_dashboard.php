<?php 
// defined(BASEPATH) or exit("Unauthorized accessed denied");

include_once('Voters.php');

class voter_dashboard extends Voters{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array( 'url'));
        $this->load->library('form_validation');
        $this->load->model('Voters_model');
        $this->load->helpers('util_helper');
        $this->load->library('session');
    }

    //index page 
    public function index(){
        $this->load->library('session');
        $elections = $this->Voters_model->get_elections();

        $data = array(
            'userid' => $this->session->userid . "Yello",
            'title'     => "page title",
            // 'result'    => $result,
            'elections'  => $elections,
        );

        $this->load->view('templates/voter/header.html', $data);
        $this->load->view('voter_pages/voter_index.php', $data);
        $this->load->view('templates/footer.html');
    }

    public function vote(){
        $elections = $this->Voters_model->get_elections();
        // die(var_dump($elections));
        // die(var_dump($_POST));
        $imo = $this->input->post($elections[0]['election']); //$_POST['imo_guber'];
        echo "====" . $elections[0]['election'] . "==== IMO GUBER: ".$imo;
        
        // // var_dump($elections);
        $my_votes = array();
        // echo "Election : " . $this->input->post('imo_guber');
        
        foreach($this->input->post() as $key => $val)
        {
            $my_votes[$key] = $val;
        
        }
        $election = 'imo_guber';
        echo "<br/>" . get_election_id($election) . ' <br/> ';
        $my_actual_vote = $this->Voters_model->vote($my_votes);
    
        var_dump($my_votes);
        

    }

    //get candidate
    public function get_candidate($election_id){
        return $this->Voters_model->get_candidate($election_id);
    }
}

?>