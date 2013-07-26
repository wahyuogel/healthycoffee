<?php
	class Admin extends CI_Controller
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
			$set['check'] = $this->admin_model->check_admin_row();
			$set['admin'] = $this->admin_model->get_all_admin();
			$data['content'] = $this->load->view('admin/admin_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function add_admin()
		{
			$set['error'] = '';
			$data['content'] = $this->load->view('admin/admin_add_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_add_admin()
		{	
			$this->form_validation->set_rules('txtname', 'Name', 'trim');
			$this->form_validation->set_rules('txtid', 'Email', 'trim');
			$this->form_validation->set_rules('txtpassword', 'Password', 'trim');
			
			$this->form_validation->run();
			
			$name = stripslashes(mysql_escape_string($this->input->post('txtname')));
			$email = stripslashes(mysql_escape_string($this->input->post('txtid')));
			$pass = stripslashes(mysql_escape_string($this->input->post('txtpass')));
			
			if($name == NULL)
			{
				$set['error'] = 'Name is Required !';
				$data['content'] = $this->load->view('admin/admin_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else if($email == NULL)
			{
				$set['error'] = 'Email is Required !';
				$data['content'] = $this->load->view('admin/admin_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else
			{
				$this->admin_model->add_admin($email, $name, $pass);
				$this->session->set_flashdata('message', 'New Administrator Information Added !');
				redirect('admin/admin', 'refresh');
			}
		}
		
		function edit_admin($AID)
		{
			$set['admin'] = $this->admin_model->get_admin($AID);
			$set['error'] = '';
			$data['content'] = $this->load->view('admin/admin_edit_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_edit_admin()
		{	
			$this->form_validation->set_rules('txtname', 'Name', 'trim');
			$this->form_validation->set_rules('txtid', 'Email', 'trim');
			$this->form_validation->set_rules('txtpassword', 'Password', 'trim');
			
			$this->form_validation->run();
			
			$AID = $this->input->post('txtAID');
			$name = stripslashes(mysql_escape_string($this->input->post('txtname')));
			$email = stripslashes(mysql_escape_string($this->input->post('txtid')));
			$pass = stripslashes(mysql_escape_string($this->input->post('txtpass')));
			
			if($name == NULL)
			{
				$set['admin'] = $this->admin_model->get_admin($AID);
				$set['error'] = 'Name is Required !';
				$data['content'] = $this->load->view('admin/admin_edit_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else if($pass == NULL)
			{
				
				$this->admin_model->edit_admin_old($AID, $email, $name);
				$this->session->set_flashdata('message', 'Updated Successfully !');
				redirect('admin/admin', 'refresh');
			}
			else
			{
			
				$this->admin_model->edit_admin($AID, $email, $name, $pass);
				$this->session->set_flashdata('message', 'Updated Successfully !');
				redirect('admin/admin', 'refresh');
			}
		}
		
		function delete_admin($AID)
		{
			$this->admin_model->delete_admin($AID);
			redirect('admin/admin');
		}
		
		
	}
