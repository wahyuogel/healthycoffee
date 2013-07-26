<?php
	class Account_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index() {}
		
		function check_account_row()
		{
			return $this->db->count_all('msaccount');
		}
		
		function get_all_account()
		{
			$this->db->select('*');
			$this->db->order_by('uid','ASC');
			$query = $this->db->get('msaccount');
			return $query->result();
		}
		
		function get_account($uid)
		{
			$this->db->where('uid', $uid);
			$query = $this->db->get('msaccount');
			$this->db->order_by('uid','ASC');
			return $query->result();
		}
		
		
		
		function delete_account($id)
		{
			$this->db->where('uid', $id);
			$this->db->delete('msaccount');
		}
		
		function status_changes($id, $status)
		{
			if($status == 0)
			{
				$this->db->where('uid', $id);
				$this->db->update('msaccount', array('status'=>'Non-Active'));
			}
			else
			{
				$this->db->where('uid', $id);
				$this->db->update('msaccount', array('status'=>'Active'));
			}
		}
		
		
	}