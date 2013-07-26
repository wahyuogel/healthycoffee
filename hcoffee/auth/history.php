<?php


    // include db handler
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];  
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	
	$response = array("tag" => $tag, "success" => 0, "error" => 0);
	
	
	if ($tag == 'history') {
   
    //$string = $_POST['uid'];
	$string = "[50dff0a8a9a790.63717319]";
	$rep = str_replace("[","",$string);
	$rep2 = str_replace("]","",$rep);
	//$rep3 = str_replace(" ","",$rep2);
	$q = $rep2;
	
	if (isset($q) && $q != '') 
	{	 $user = $db->getUser($q);
		 $response = '';
		 $no_of_rows = mysql_num_rows($user);
        if ($no_of_rows > 0) {
			
            while($result = mysql_fetch_array($user))
			{
				$response["success"] = 1;
				$response["uid"] = $result["unique_id"];
				$response["diseases"] = $result["Diseases_Name"];
				$response["date"] = $result["created_at"];
				$response["valid"] = $result["valid"];
			}
			echo json_encode($response);
            
        } 
	}
	else 
	{
		 $response["success"] = 0;
	}
	}
	
	
}
?>
