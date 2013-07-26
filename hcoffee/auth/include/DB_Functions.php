<?php

class DB_Functions {

    private $db;

    
    function __construct() {
        require_once 'DB_Connect.php';
        $this->db = new DB_Connect();
        $this->db->connect();
    }
	
    function __destruct() {
        
    }

    
    public function storeUser($name, $email, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $result = mysql_query("INSERT INTO msaccount(unique_id, name, email, encrypted_password, salt, created_at) VALUES('$uuid', '$name', '$email', '$encrypted_password', '$salt', NOW())");
        // check for successful store
        if ($result) {
            // get user details 
            $uid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM msaccount WHERE uid = $uid");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }

    
    public function getUserByEmailAndPassword($email, $password) {
        $result = mysql_query("SELECT * FROM msaccount WHERE email = '$email'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }


	public function getUser($id)
	{
		
		  $query = mysql_query("SELECT * FROM trhistory INNER JOIN msaccount on msaccount.unique_id = trhistory.unique_id INNER JOIN msdiseases on msdiseases.Diseases_ID = trhistory.Diseases_ID WHERE trhistory.unique_id = '$id' ORDER BY trhistory.unique_id") or die(mysql_error());
		 return $query;
	}
	
	public function getDiseases($id)
	{
		
		  $query = mysql_query("SELECT * FROM msdiseases WHERE Diseases_Name LIKE '$id'") or die(mysql_error());
		  $no_of_rows = mysql_num_rows($query);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($query);
            
            return $result;
            
        } else {
            // user not found
            return false;
        }
	}
	
	function updateHistory($uid,$lat,$lang,$did)
	{						
	$tgl = date('Y-m-d');
	mysql_query("INSERT INTO trhistory (unique_id, lat, lng, Diseases_ID, created_at, valid) VALUES ('$uid', '$lang', '$lat', '$did', '$tgl', 'Non-Active')");	
		
	}
	
	

    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from msaccount WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>
