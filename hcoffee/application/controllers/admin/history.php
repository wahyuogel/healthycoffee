<?php
	class History extends CI_Controller
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
			$set['check'] = $this->history_model->check_history_row();
			$set['history'] = $this->history_model->get_all_history();
			$data['content'] = $this->load->view('admin/history_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		
		function generate()
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

   
			
			echo "{maps:".$result."}";
		}
		
		
		
		function delete_history($id)
		{
			$this->history_model->delete_history($id);
			redirect('admin/history');
		}
		
		function status_changes($id, $status)
		{
			$this->history_model->status_changes($id, $status);
			redirect('admin/history');
		}
	}
