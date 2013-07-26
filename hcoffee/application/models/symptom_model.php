<?php
	class Symptom_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function get_dropdown_list()
		{
			$this->db->select('*');
			$this->db->from('msdiseases');
			$this->db->join('mscoffee','msdiseases.Coffee_ID = mscoffee.Coffee_ID');
			$this->db->order_by('msdiseases.Coffee_ID', 'ASC');
			$query = $this->db->get();
			return $query->result();
		}
		
		function get_root_id($sub_id)
		{
			$this->db->where('Diseases_ID', $sub_id);
			$query = $this->db->get('msdiseases');
			return $query->row();
		}
		
		function get_symptom($sub_id)
		{
			$this->db->where('mssymptom.Diseases_ID',$sub_id);
			$this->db->order_by('Symptom_ID', 'ASC');
			$query = $this->db->get('mssymptom');
			return $query->result();
		}
		
		function get_symptom_single_row($id)
		{
			$this->db->where('Symptom_ID', $id);
			$query = $this->db->get('mssymptom');
			return $query->result();
		}
		
		function get_diseases_row($sub_id)
		{
			$this->db->select('*');
			$this->db->where('msdiseases.Diseases_ID', $sub_id);
			$query = $this->db->get('msdiseases');
			return $query->row();
		}
		
		function check_symptom_row($txtstatus)
		{
			$this->db->select('*');
			$this->db->from('mssymptom');
			$this->db->join('mscoffee','mssymptom.Coffee_ID = mscoffee.Coffee_ID');
			$this->db->join('msdiseases','mssymptom.Diseases_ID = msdiseases.Diseases_ID');
			$this->db->where('mssymptom.Diseases_ID', $txtstatus);
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		function add_symptom($root_id, $sub_id, $title, $img, $status, $overview)
		{
			if($img != NULL)
			{
				$this->db->set('Symptom_Image',$img);
			}
			$this->db->set('Coffee_ID', $root_id);
			$this->db->set('Diseases_ID', $sub_id);
			$this->db->set('Symptom_Name', $title);
			$this->db->set('Symptom_Status', $status);
			$this->db->set('Symptom_Overview', $overview);
			$this->db->set('Date_Entry', date('Y-m-d'));
			$this->db->set('Date_Updated', date('Y-m-d'));
			$this->db->set('User_ID', $this->session->userdata('username'));
			$this->db->insert('mssymptom');
		}
		
		function edit_symptom($id, $title, $img, $status, $overview)
		{
			$this->db->where('Symptom_ID', $id);
			$this->db->update('mssymptom', array('Symptom_Name'=>$title, 'Symptom_Image'=>$img, 'Symptom_Status'=>$status, 'Symptom_Overview'=>$overview, 'Date_Updated'=>date('Y-m-d'), 'User_ID'=>$this->session->userdata('username')));
		}
		
		function delete_symptom($root_id, $sub_id, $id)
		{
			$this->db->where('Symptom_ID', $id);
			$this->db->delete('mssymptom');
		}
		
		function status_changes($root_id, $sub_id, $id, $status)
		{
			if($status == 0)
			{
				$this->db->where('Symptom_ID', $id);
				$this->db->update('mssymptom', array('Symptom_Status'=>'Hide'));
			}
			else
			{
				$this->db->where('Symptom_ID', $id);
				$this->db->update('mssymptom', array('Symptom_Status'=>'Show'));
			}
		}
	}