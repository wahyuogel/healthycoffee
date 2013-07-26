<?php
	class Diseases extends CI_Controller
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
		
		function view_sub($root_id)
		{
			$set['row'] = $this->diseases_model->get_coffee_row($root_id);
			$set['diseases'] = $this->diseases_model->get_diseases_row($root_id);
			$set['check'] = $this->diseases_model->check_diseases_row($root_id);
			$set['root_id'] = $root_id;
			$data['content'] = $this->load->view('admin/diseases_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function add_diseases($root_id)
		{
			$set['error'] = '';
			$set['root_id'] = $root_id;
			$set['rows'] = $this->diseases_model->get_coffee_row($root_id);
			$data['content'] = $this->load->view('admin/diseases_add_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_add_diseases()
		{	
			$this->form_validation->set_rules('txttitle', 'Name', 'trim');
			$this->form_validation->set_rules('txttitlelatin', 'Latin Name', 'trim');
			$this->form_validation->set_rules('txtstatus', 'Status', 'trim');
			$this->form_validation->set_rules('txtdescription', 'Description', 'trim');
			
			$this->form_validation->run();
			
			$root_id = $this->input->post('txtrootid');
			$title = stripslashes(mysql_escape_string($this->input->post('txttitle')));
			$titlelatin = stripslashes(mysql_escape_string($this->input->post('txttitlelatin')));
			$icon = mysql_escape_string($this->input->post('txtimage'));
			$status = $this->input->post('txtstatus');
			$description = stripslashes(mysql_escape_string($this->input->post('txtdescription')));
			
			if($title == NULL)
			{
				$set['error'] = 'Title is Required !';
				$set['root_id'] = $root_id;
				$set['row'] = $this->diseases_model->get_coffee_row($root_id);
				$data['content'] = $this->load->view('admin/diseases_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			elseif($titlelatin == NULL)
			{
				$set['error'] = 'Latin Name is Required !';
				$set['root_id'] = $root_id;
				$set['row'] = $this->diseases_model->get_coffee_row($root_id);
				$data['content'] = $this->load->view('admin/diseases_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else if($description == NULL)
			{
				$set['error'] = 'Description is Required !';
				$set['root_id'] = $root_id;
				$set['row'] = $this->diseases_model->get_coffee_row($root_id);
				$data['content'] = $this->load->view('admin/diseases_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else
			{
				$config['upload_path'] = './images/diseases_icon/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '1000';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['overwrite'] = 'true';
					
				$this->load->library('upload',$config);
					
				if($icon != NULL)
				{	
					if(! $this->upload->do_upload('icon'))
					{
						$set['error'] = $this->upload->display_errors('','',TRUE);
						$set['root_id'] = $root_id;
						$set['row'] = $this->diseases_model->get_coffee_row($root_id);
						$data['content'] = $this->load->view('admin/symptom_add_view',$set,TRUE);
						return $this->load->view('admin/dashboard_view', $data);
					}
				}
				
				$data = $this->upload->data();
				$img = $data['file_name'];
				$this->diseases_model->add_diseases($root_id, $title, $titlelatin, $img, $status, $description);
				$this->session->set_flashdata('message', 'New Diseases Information Added !');
				redirect('admin/diseases/view_sub/'.$root_id, 'refresh');
			}
		}
		
		function edit_diseases($root_id, $id)
		{
			$set['diseases'] = $this->diseases_model->get_diseases_single_row($id);
			$set['error'] = '';
			$set['row'] = $this->diseases_model->get_coffee_row($root_id);
			$data['content'] = $this->load->view('admin/diseases_edit_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_edit_diseases()
		{	
			$this->form_validation->set_rules('txttitle', 'Name', 'trim');
			$this->form_validation->set_rules('txttitle', 'Name Latin', 'trim');
			$this->form_validation->set_rules('txtstatus', 'Status', 'trim');
			$this->form_validation->set_rules('txtdescription', 'Description', 'trim');
			
			
			$this->form_validation->run();
			
			$root_id = $this->input->post('txtrootid');
			$id = $this->input->post('txtid');
			$title = stripslashes(mysql_escape_string($this->input->post('txttitle')));
			$titlelatin = stripslashes(mysql_escape_string($this->input->post('txttitlelatin')));
			$curimg = $this->input->post('txtcurimg');
			$icon = mysql_escape_string($this->input->post('txtimage'));
			$status = $this->input->post('txtstatus');
			$description = stripslashes(mysql_escape_string($this->input->post('txtdescription')));
			
			if($title == NULL)
			{
				$set['diseases'] = $this->diseases_model->get_diseases_single_row($id);
				$set['error'] = 'Name is Required !';
				$set['row'] = $this->diseases_model->get_coffee_row($root_id);
				$data['content'] = $this->load->view('admin/diseases_edit_view', $set, TRUE);
				$this->load->view('admin/dashboard_view', $data);
			}
			elseif($titlelatin == NULL)
			{
				$set['diseases'] = $this->diseases_model->get_diseases_single_row($id);
				$set['error'] = 'Name Latin is Required !';
				$set['row'] = $this->diseases_model->get_coffee_row($root_id);
				$data['content'] = $this->load->view('admin/diseases_edit_view', $set, TRUE);
				$this->load->view('admin/dashboard_view', $data);
			}
			else if($description == NULL)
			{
				$set['diseases'] = $this->diseases_model->get_diseases_single_row($id);
				$set['error'] = 'Description is Required !';
				$set['row'] = $this->diseases_model->get_coffee_row($root_id);
				$data['content'] = $this->load->view('admin/diseases_edit_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else
			{
				$config['upload_path'] = './images/diseases_icon/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '1000';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['overwrite'] = 'true';
					
				$this->load->library('upload',$config);
				if($icon != $curimg)
				{	
					if(! $this->upload->do_upload('txtimage'))
					{
						$set['error'] = $this->upload->display_errors('','',TRUE);
						$set['diseases'] = $this->diseases_model->get_diseases_single_row($id);
						$set['row'] = $this->diseases_model->get_coffee_row($root_id);
						$data['content'] = $this->load->view('admin/symptom_edit_view',$set,TRUE);
						return $this->load->view('admin/dashboard_view', $data);
					}
					else
					{
							$data = $this->upload->data();
							$img = $data['file_name'];
					}
				}
				
				if($icon == $curimg)
				{
					$set['root_id'] = $root_id;
					$img = $curimg;
				}
				
				$data = $this->upload->data();
				$img = $data['file_name'];
				$this->diseases_model->edit_diseases($id, $title, $titlelatin, $img, $status, $description);
				$this->session->set_flashdata('message', 'Updated Successfully !');
				redirect('admin/diseases/view_sub/'.$root_id, 'refresh');
			}
		}
		
		function delete_diseases($root_id, $id)
		{
			$this->diseases_model->delete_diseases($id);
			redirect('admin/diseases/view_sub/'.$root_id);
		}
		
		function status_changes($root_id, $id, $status)
		{
			$this->diseases_model->status_changes($id, $status);
			redirect('admin/diseases/view_sub/'.$root_id);
		}
	}
