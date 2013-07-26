<?php
	class Dashboard_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function check_admin_session($sessUser, $sessPass)
		{
			$this->db->select('*');
			$this->db->where('User_ID', $sessUser);
			$this->db->where('User_Password', $sessPass);
			$query = $this->db->get('msuser');
			return $query->num_rows();
		}
	}