<?php
	class Coffee_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function check_coffee_row()
		{
			return $this->db->count_all('mscoffee');
		}
		
		function get_all_coffee()
		{
			$this->db->select('*');
			$this->db->order_by('Coffee_ID','ASC');
			$query = $this->db->get('mscoffee');
			return $query->result();
		}
		
		function get_coffee($id)
		{
			$this->db->where('Coffee_ID', $id);
			$query = $this->db->get('mscoffee');
			$this->db->order_by('Coffee_ID','ASC');
			return $query->result();
		}
		
		function add_coffee($title, $status, $description)
		{
			$this->db->set('Coffee_Name', $title);
			$this->db->set('Coffee_Status', $status);
			$this->db->set('Coffee_Description', $description);
			$this->db->set('Date_Entry', date('Y-m-d'));
			$this->db->set('Date_Updated', date('Y-m-d'));
			$this->db->set('User_ID', $this->session->userdata('username'));
			$this->db->insert('mscoffee');
		}
		
		function edit_coffee($id, $title, $status, $description)
		{
			$this->db->where('Coffee_ID', $id);
			$this->db->update('mscoffee', array('Coffee_Name'=>$title, 'Coffee_Status'=>$status, 'Coffee_Description'=>$description, 'Date_Updated'=>date('Y-m-d'), 'User_ID'=>$this->session->userdata('username')));
		}
		
		function delete_coffee($id)
		{
			$this->db->where('Coffee_ID', $id);
			$this->db->delete('mscoffee');
		}
		
		function status_changes($id, $status)
		{
			if($status == 0)
			{
				$this->db->where('Coffee_ID', $id);
				$this->db->update('mscoffee', array('Coffee_Status'=>'Non-Active'));
			}
			else
			{
				$this->db->where('Coffee_ID', $id);
				$this->db->update('mscoffee', array('Coffee_Status'=>'Active'));
			}
		}
	}