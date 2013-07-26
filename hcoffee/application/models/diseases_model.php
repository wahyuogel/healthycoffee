<?php
	class Diseases_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function check_diseases_row($root_id)
		{
			$this->db->select('*');
			$this->db->from('msdiseases');
			$this->db->join('mscoffee','msdiseases.Coffee_ID = mscoffee.Coffee_ID');
			$this->db->where('msdiseases.Coffee_ID', $root_id);
			$query = $this->db->get();
			return $query->num_rows();
		}
	
		function get_diseases_row($root_id)
		{
			$this->db->select('*');
			$this->db->where('msdiseases.Coffee_ID', $root_id);
			$this->db->order_by('Diseases_ID', 'ASC');
			$query = $this->db->get('msdiseases');
			return $query->result();
		}
		
		function get_coffee_row($root_id)
		{
			$this->db->select('*');
			$this->db->where('mscoffee.Coffee_ID', $root_id);
			$query = $this->db->get('mscoffee');
			return $query->row();
		}
		
		function get_diseases_single_row($id)
		{
			$this->db->where('Diseases_ID', $id);
			$query = $this->db->get('msdiseases');
			return $query->result();
		}
		
		function get_diseases_json()
		{
			$query = $this->db->query("SELECT * FROM msdiseases");
			return $query->result();

			
		}
		
		function add_diseases($root_id, $title, $titlelatin, $img, $status, $description)
		{
			if($img != NULL)
			{
				$this->db->set('Diseases_Image',$img);
			}
			$this->db->set('Coffee_ID', $root_id);
			$this->db->set('Diseases_Name', $title);
			$this->db->set('Diseases_Latin', $titlelatin);
			$this->db->set('Diseases_Status', $status);
			$this->db->set('Diseases_Description', $description);
			$this->db->set('Date_Entry', date('Y-m-d'));
			$this->db->set('Date_Updated', date('Y-m-d'));
			$this->db->set('User_ID', $this->session->userdata('username'));
			$this->db->insert('msdiseases');
		}
		
		function edit_diseases($id, $title, $titlelatin, $img, $status, $description)
		{
			$this->db->where('Diseases_ID', $id);
			$this->db->update('msdiseases', array('Diseases_Name'=>$title, 'Diseases_Latin'=>$titlelatin, 'Diseases_Image'=>$img, 'Diseases_Status'=>$status, 'Diseases_Description'=>$description, 'Date_Updated'=>date('Y-m-d'), 'User_ID'=>$this->session->userdata('username')));
		}
		
		function delete_diseases($id)
		{
			$this->db->where('Diseases_ID', $id);
			$this->db->delete('msdiseases');
		}
		
		function status_changes($id, $status)
		{
			if($status == 0)
			{
				$this->db->where('Diseases_ID', $id);
				$this->db->update('msdiseases', array('Diseases_Status'=>'Non-Active'));
			}
			else
			{
				$this->db->where('Diseases_ID', $id);
				$this->db->update('msdiseases', array('Diseases_Status'=>'Active'));
			}
		}
	}