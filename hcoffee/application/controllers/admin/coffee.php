<?php
	class Coffee extends CI_Controller
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
			$set['check'] = $this->coffee_model->check_coffee_row();
			$set['coffee'] = $this->coffee_model->get_all_coffee();
			$data['content'] = $this->load->view('admin/coffee_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function add_coffee()
		{
			$set['error'] = '';
			$data['content'] = $this->load->view('admin/coffee_add_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_add_coffee()
		{	
			$this->form_validation->set_rules('txttitle', 'Title', 'trim');
			$this->form_validation->set_rules('txtstatus', 'Status', 'trim');
			$this->form_validation->set_rules('txtdescription', 'Description', 'trim');
			
			$this->form_validation->run();
			
			$title = stripslashes(mysql_escape_string($this->input->post('txttitle')));
			$status = $this->input->post('txtstatus');
			$description = stripslashes(mysql_escape_string($this->input->post('txtdescription')));
			
			if($title == NULL)
			{
				$set['error'] = 'Title is Required !';
				$data['content'] = $this->load->view('admin/coffee_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else if($description == NULL)
			{
				$set['error'] = 'Description is Required !';
				$data['content'] = $this->load->view('admin/coffee_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else
			{
				$this->coffee_model->add_coffee($title, $status, $description);
				$this->session->set_flashdata('message', 'New Data Coffee Added !');
				redirect('admin/coffee', 'refresh');
			}
		}
		
		function edit_coffee($id)
		{
			$set['coffee'] = $this->coffee_model->get_coffee($id);
			$set['error'] = '';
			$data['content'] = $this->load->view('admin/coffee_edit_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_edit_coffee()
		{	
			$this->form_validation->set_rules('txttitle', 'Title', 'trim');
			$this->form_validation->set_rules('txtstatus', 'Status', 'trim');
			$this->form_validation->set_rules('txtdescription', 'Description', 'trim');
			
			$this->form_validation->run();
			
			$id = $this->input->post('txtid');
			$title = stripslashes(mysql_escape_string($this->input->post('txttitle')));
			$status = $this->input->post('txtstatus');
			$description = stripslashes(mysql_escape_string($this->input->post('txtdescription')));
			
			if($title == NULL)
			{
				$set['coffee'] = $this->coffee_model->get_coffee($id);
				$set['error'] = 'Title is Required !';
				$data['content'] = $this->load->view('admin/coffee_edit_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else if($description == NULL)
			{
				$set['coffee'] = $this->coffee_model->get_coffee($id);
				$set['error'] = 'Description is Required !';
				$data['content'] = $this->load->view('admin/coffee_edit_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else
			{
				$this->coffee_model->edit_coffee($id, $title, $status, $description);
				$this->session->set_flashdata('message', 'Updated Successfully !');
				redirect('admin/coffee', 'refresh');
			}
		}
		
		function delete_coffee($id)
		{
			$this->coffee_model->delete_coffee($id);
			redirect('admin/coffee');
		}
		
		function status_changes($id, $status)
		{
			$this->coffee_model->status_changes($id, $status);
			redirect('admin/coffee');
		}
	}
