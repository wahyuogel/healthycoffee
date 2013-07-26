<?php
	class Login_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function check_login($user, $pass)
		{
			$this->db->select('*');
			$this->db->where('User_ID', $user);
			$this->db->where('User_Password', $pass);
			$query = $this->db->get('msuser');
			return $query->num_rows();
		}
	}