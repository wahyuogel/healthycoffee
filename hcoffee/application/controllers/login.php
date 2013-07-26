<?php
	class Login extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			session_start();
		}
		
		function index()
		{
			if($this->session->userdata('username') && $this->session->userdata('password'))
			{
				if($this->dashboard_model->check_admin_session($this->session->userdata('username'),$this->session->userdata('password')) == 1)
				{
					redirect('admin/dashboard');		
				}
			}
			else
			{
				$data['error'] = '';
				$this->load->view('login_view', $data);
			}
		}
		
		function login_error()
		{		
			if($this->input->post('txtuser') == NULL)
			{
				$data['error'] = '<i>Username Harus Diisi</i>';
				return $this->load->view('login_view', $data);
			}
			else if($this->input->post('txtpass') == NULL)
			{
				$data['error'] = '<i>Password Harus Diisi</i>';
				return $this->load->view('login_view', $data);
			}
			else if($this->login_model->check_login($this->input->post('txtuser'), sha1($this->input->post('txtpass'))) == 0)
			{
				$data['error'] = '<i>Username & Password Salah</i>';
				return $this->load->view('login_view', $data);
			}
			else
			{
				$this->session->set_userdata(array('username' => $this->input->post('txtuser'),'password' => sha1($this->input->post('txtpass'))));
				redirect('admin/dashboard');
			}
		}
	}