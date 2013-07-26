<?php 
	class Symptom extends CI_Controller
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
			$set['dropdown'] = $this->symptom_model->get_dropdown_list();
			$set['sub_id'] = 0;
			$data['content'] = $this->load->view('admin/symptom_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function view_symptom($root_id, $sub_id)
		{
			$set['root_id'] = $root_id;
			$set['sub_id'] = $sub_id;
			$set['dropdown'] = $this->symptom_model->get_dropdown_list();
			$set['symptom'] = $this->symptom_model->get_symptom($sub_id);
			$set['check'] = $this->symptom_model->check_symptom_row($sub_id);
			$data['content'] = $this->load->view('admin/symptom_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function add_symptom($root_id, $sub_id)
		{
			$set['error'] = '';
			$set['root_id'] = $root_id;
			$set['sub_id'] = $sub_id;
			$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
			$data['content'] = $this->load->view('admin/symptom_add_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_add_symptom()
		{	
			$this->form_validation->set_rules('txttitle', 'Title', 'trim');
			$this->form_validation->set_rules('txtstatus', 'Status', 'trim');
			$this->form_validation->set_rules('txtoverview', 'Overview', 'trim');
			
			$this->form_validation->run();
			
			$root_id = $this->input->post('txtrootid');
			$sub_id = $this->input->post('txtsubid');
			$title = stripslashes(mysql_escape_string($this->input->post('txttitle')));
			$icon = mysql_escape_string($this->input->post('txticon'));
			$status = $this->input->post('txtstatus');
			$overview = stripslashes(mysql_escape_string($this->input->post('txtoverview')));
			
			if($title == NULL)
			{
				$set['error'] = 'Title is Required !';
				$set['root_id'] = $root_id;
				$set['sub_id'] = $sub_id;
				$set['dropdown'] = $this->symptom_model->get_dropdown_list();
				$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
				$data['content'] = $this->load->view('admin/symptom_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else if($overview == NULL)
			{
				$set['error'] = 'Product Overview is Required !';
				$set['root_id'] = $root_id;
				$set['sub_id'] = $sub_id;
				$set['dropdown'] = $this->symptom_model->get_dropdown_list();
				$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
				$data['content'] = $this->load->view('admin/symptom_add_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else
			{
				$config['upload_path'] = './images/symptom_icon/';
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
						$set['sub_id'] = $sub_id;
						$set['dropdown'] = $this->symptom_model->get_dropdown_list();
						$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
						$data['content'] = $this->load->view('admin/symptom_add_view',$set,TRUE);
						return $this->load->view('admin/dashboard_view', $data);
					}
				}
				
				$data = $this->upload->data();
				$img = $data['file_name'];
				
				$this->symptom_model->add_symptom($root_id, $sub_id, $title, $img, $status, $overview);
				$this->session->set_flashdata('message', 'New Symptom Information Added !');
				redirect('admin/symptom/view_symptom/'.$root_id.'/'.$sub_id, 'refresh');
			}
		}
		
		function edit_symptom($root_id, $sub_id, $id)
		{
			$set['symptom'] = $this->symptom_model->get_symptom_single_row($id);
			$set['error'] = '';
			$set['root_id'] = $root_id;
			$set['sub_id'] = $sub_id;
			$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
			$data['content'] = $this->load->view('admin/symptom_edit_view', $set, TRUE);
			$this->load->view('admin/dashboard_view', $data);
		}
		
		function do_edit_symptom()
		{
			$this->form_validation->set_rules('txttitle', 'Title', 'trim');
			$this->form_validation->set_rules('txtstatus', 'Status', 'trim');
			$this->form_validation->set_rules('txtoverview', 'Product Overview', 'trim');
			
			$this->form_validation->run();
			
			$root_id = $this->input->post('txtrootid');
			$sub_id = $this->input->post('txtsubid');
			$id = $this->input->post('txtid');
			$curimg = $this->input->post('txtcurimg');
			$title = stripslashes(mysql_escape_string($this->input->post('txttitle')));
			$icon = mysql_escape_string($this->input->post('txticon'));
			$status = $this->input->post('txtstatus');
			$overview = stripslashes(mysql_escape_string($this->input->post('txtoverview')));
			
			if($title == NULL)
			{
				$set['error'] = 'Title is Required !';
				$set['root_id'] = $root_id;
				$set['sub_id'] = $sub_id;
				$set['symptom'] = $this->symptom_model->get_symptom_single_row($id);
				$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
				$data['content'] = $this->load->view('admin/symptom_edit_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else if($overview == NULL)
			{
				$set['error'] = 'Product Overview is Required !';
				$set['root_id'] = $root_id;
				$set['sub_id'] = $sub_id;
				$set['symptom'] = $this->symptom_model->get_symptom_single_row($id);
				$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
				$data['content'] = $this->load->view('admin/symptom_edit_view',$set,TRUE);
				return $this->load->view('admin/dashboard_view', $data);
			}
			else
			{
				$config['upload_path'] = './images/symptom_icon/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '1000';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['overwrite'] = 'true';
					
				$this->load->library('upload',$config);
					
				if($icon != $curimg)
				{	
					if(! $this->upload->do_upload('icon'))
					{
						$set['error'] = $this->upload->display_errors('','',TRUE);
						$set['root_id'] = $root_id;
						$set['sub_id'] = $sub_id;
						$set['symptom'] = $this->symptom_model->get_symptom_single_row($id);
						$set['row'] = $this->symptom_model->get_diseases_row($sub_id);
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
					$set['sub_id'] = $sub_id;
					$set['root_id'] = $root_id;
					$img = $curimg;
				}
				
				$this->symptom_model->edit_symptom($id, $title, $img, $status, $overview);
				$this->session->set_flashdata('message', 'Updated  Successfully !');
				redirect('admin/symptom/view_symptom/'.$root_id.'/'.$sub_id, 'refresh');
			}
		}
		
		function delete_symptom($root_id, $sub_id, $id)
		{
			$this->symptom_model->delete_symptom($root_id, $sub_id, $id);
			redirect('admin/symptom/view_symptom/'.$root_id.'/'.$sub_id);
		}
		
		function status_changes($root_id, $sub_id, $id, $status)
		{
			$this->symptom_model->status_changes($root_id, $sub_id, $id, $status);
			redirect('admin/symptom/view_symptom/'.$root_id.'/'.$sub_id);
		}
	}