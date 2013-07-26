<?php
	class Dashboard extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			session_start();
			
			if(!$this->session->userdata('username') && !$this->session->userdata('password'))
			{
				redirect('login', 'refresh');
			}
			else if($this->session->userdata('username') && $this->session->userdata('password')) 
			{
				if($this->dashboard_model->check_admin_session($this->session->userdata('username'), $this->session->userdata('password')) == 0)
				{
					redirect('login', 'refresh');
				}
			}
		}
		
		function index()
		{	
			
					$data['content'] = $this->load->view('admin/home_view', TRUE);
					$this->load->view('admin/dashboard_view', $data);
			
		}
		
		function indent($json) {

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;
        
        // If this character is the end of an element, 
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element, 
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }
            
            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        $prevChar = $char;
    }

    return $result;
}
		
		function distribution_maps()
		{	
		
					
			$history = $this->history_model->get_all_history_json();
			$json = json_encode($history);
			$result      = '';
			$pos         = 0;
			$strLen      = strlen($json);
			$indentStr   = '  ';
			$newLine     = "\n";
			$prevChar    = '';
			$outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;
        
        // If this character is the end of an element, 
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element, 
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }
            
            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        $prevChar = $char;
   		 }

					$set['maps'] = $result;
					$data['content'] = $this->load->view('admin/maps_view',$set, TRUE);
					$this->load->view('admin/dashboard_view', $data);
			
		}
		
		function stats()
		{
		
			$statistic = $this->history_model->get_statistic_json();
			$statistic_c = $this->history_model->get_statistic_json_count();
		
				
				
				foreach ($statistic as $row)
				{
					for($i=0;$i<$statistic_c;$i++)
		  		{ 
					$data[$i]["key"]=$row->dis;
        			$data[$i]["value"]=$row->val; 
				}
			}
		
		
 		
		$this->chart_generator->create_bar_chart("Data Statistik Penyebaran Penyakit Tanaman Kopi",$data,950,400);	
		
		
		}
	
		function statistic()
		{
			
			$data['content'] = "<img src='".base_url()."admin/dashboard/stats/' />";
			$this->load->view('admin/dashboard_view', $data);
			
			 
		}
		
		function logout()
		{
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('password');
			redirect('login','refresh');
		}
	}