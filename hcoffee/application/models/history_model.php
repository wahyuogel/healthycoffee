<?php
	class History_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function check_history_row()
		{
			return $this->db->count_all('trhistory');
		}
		
		function get_all_history()
		{
			$this->db->select('*');
			$this->db->from('trhistory');
			$this->db->join('msaccount','trhistory.unique_id = msaccount.unique_id');
			$this->db->join('msdiseases','trhistory.diseases_id = msdiseases.diseases_id');
			$query = $this->db->get();
			return $query->result();
		}
		
		function get_all_history_json()
		{
			$this->db->select('*');
			$this->db->from('trhistory');
			$this->db->join('msaccount','trhistory.unique_id = msaccount.unique_id');
			$this->db->join('msdiseases','trhistory.diseases_id = msdiseases.diseases_id');
			$this->db->where('trhistory.valid', 'Active');
			$query = $this->db->get();
			return $query->result();
		}
		
		function get_statistic_json_count()
		{
			$query = $this->db->query("SELECT msdiseases.Diseases_Name as dis, COUNT(history.Diseases_ID) as val from (SELECT Diseases_ID,valid FROM trhistory) as history INNER JOIN msdiseases on history.Diseases_ID = msdiseases.Diseases_ID WHERE history.valid = 'ACTIVE' GROUP BY history.Diseases_ID");
			
			return $query->num_rows();
		}
		
		function get_statistic_json()
		{
			/*
			$query = $this->db->query("
			 SELECT
				 msdiseases.Diseases_Name as dis, COUNT(history.diseases_id) as val
				 FROM (SELECT DISTINCT trhistory.diseases_id FROM trhistory) as history
				 INNER JOIN msdiseases on history.diseases_ID = msdiseases.diseases_ID 
				 ORDER BY history.diseases_ID 
			");
			
			*/
			
			$query = $this->db->query("SELECT msdiseases.Diseases_Name as dis, COUNT(history.Diseases_ID) as val from (SELECT Diseases_ID,valid FROM trhistory) as history INNER JOIN msdiseases on history.Diseases_ID = msdiseases.Diseases_ID WHERE history.valid = 'ACTIVE' GROUP BY history.Diseases_ID");
			
			
			return $query->result();
		}
		
		
		function delete_history($id)
		{
			$this->db->where('hid', $id);
			$this->db->delete('trhistory');
		}
		
		function status_changes($id, $status)
		{
			if($status == 0)
			{
				$this->db->where('hid', $id);
				$this->db->update('trhistory', array('valid'=>'Non-Active'));
			}
			else if($status == 1)
			{
				$this->db->where('hid', $id);
				$this->db->update('trhistory', array('valid'=>'Active'));
			}
		}
		
		
	}