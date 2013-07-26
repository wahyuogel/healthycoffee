<?php
	class Account extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			session_start();
			
			if(!$this->session->userdata('username') && !$this->session->userdata('password'))
			{
				redirect('login', 'refresh');
			}
			else if($this->session->userdata('username') && $this->session->userdata('password')) 
			{
				if($this->dashboard_model->check_admin_session($this->session->userdata('username'), $this->session->userdata('password')) == 0)
				{
					redirect('login', 'refresh');
				}
			}
		}
		
		function index()
		{
			$set['check'] = $this->account_model->check_account_row();
			$set['account'] = $this->account_model->get_all_account();
			$data['content'] = $this->load->view('admin/account_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		
		
		function delete_account($AID)
		{
			$this->account_model->delete_account($AID);
			redirect('admin/account');
		}
		
		function status_changes($id, $status)
		{
			$this->account_model->status_changes($id, $status);
			redirect('admin/account');
		}
		
		
	}
