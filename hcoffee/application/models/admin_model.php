<?php
	class Admin_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function check_admin_row()
		{
			return $this->db->count_all('msuser');
		}
		
		function get_all_admin()
		{
			$this->db->select('*');
			$this->db->order_by('User_ID','ASC');
			$query = $this->db->get('msuser');
			return $query->result();
		}
		
		function get_admin($AID)
		{
			$this->db->where('AID', $AID);
			$query = $this->db->get('msuser');
			$this->db->order_by('User_ID','ASC');
			return $query->result();
		}
		
		function get_pass($AID)
		{
			$this->db->select('User_Password');
			$this->db->where('AID', $AID);
			$query = $this->db->get('msuser');
			if ($query->num_rows() > 0)
			{
			   $row = $query->row(); 
			
			   return $row->User_Password;
			  
			}
			
		}
		
		function add_admin($id, $name, $pass)
		{
			$this->db->set('User_Name', $name);
			$this->db->set('User_ID', $id);
			$this->db->set('User_Password', sha1($pass));
			$this->db->insert('msuser');
		}
		
		function edit_admin($AID, $id, $name, $pass)
		{
			$this->db->where('AID', $AID);
			$this->db->update('msuser', array('User_Name'=>$name, 'User_ID'=>$id, 'User_Password'=>sha1($pass)));
		}
		
		function edit_admin_old($AID, $id, $name)
		{
			$this->db->where('AID', $AID);
			$this->db->update('msuser', array('User_Name'=>$name, 'User_ID'=>$id));
		}
		
		function delete_admin($id)
		{
			$this->db->where('AID', $id);
			$this->db->delete('msuser');
		}
		
		
	}