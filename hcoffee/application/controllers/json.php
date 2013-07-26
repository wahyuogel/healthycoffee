<?php
	class Json extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function maps()
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
		
		function statistic()
		{
			
			$statistic = $this->history_model->get_statistic_json();
			$json = json_encode($statistic);
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

   
			
			echo "{statistic:".$result."}";
		}
		
		function diseases()
		{
			$query = $this->diseases_model->get_diseases_json();
			 echo '{ "contacts" : [';
			foreach ($query as $row)
			{
			  echo '{';
			   echo '"id" : "'.$row->Diseases_ID.'",';
			   echo '"name" : "'.$row->Diseases_Name.'",';
			   echo '"email" : "'.$row->Diseases_Latin.'",';
			   echo '"address" : "'.$row->Diseases_Name.'",';
			   echo '"gender" : "'.$row->User_ID.'",';
			   echo '"phone": {';
			   echo '"mobile" : "'.$row->Diseases_Description.'",';
			   echo '"home" : "'.$row->Diseases_Medicine.'"';
			   echo "} },";
			  
			}
			echo "] }";
			
			
		}
		
		
	}