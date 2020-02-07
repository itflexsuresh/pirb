<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function register()
	{
		$data['content'] 	= $this->load->view('design/register', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];

		$this->layout2($data);
	}

	public function coclogging()
	{
		$data['content'] 	= $this->load->view('design/coclogging', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function admin_cocstatement()
	{
		$data['content'] 	= $this->load->view('design/admin_cocstatement', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function coc_order()
	{
		$data['content'] 	= $this->load->view('design/coc_order', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function my_cpd()
	{
		$data['content'] 	= $this->load->view('design/my_cpd', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function audit_report()
	{
		$data['content'] 	= $this->load->view('design/audit_report', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);

	}

	public function reseller_details()
	{
		$data['content'] 	= $this->load->view('design/reseller_details', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function company_reg_details()
	{
		$data['content'] 	= $this->load->view('design/company_reg_details', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function employee_details()
	{
		$data['content'] 	= $this->load->view('design/employee_details', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function allocate_coc_confirmation()
	{
		$data['content'] 	= $this->load->view('design/allocate_coc_confirmation', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function allocate_coc()
	{
		$data['content'] 	= $this->load->view('design/allocate_coc', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function myprofile_reseller_details()
	{
		$data['content'] 	= $this->load->view('design/myprofile_reseller_details', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function after_reg_myprofile()
	{
		$data['content'] 	= $this->load->view('design/after_reg_myprofile', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function cocstatement()
	{
		$data['content'] 	= $this->load->view('design/cocstatement', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function audit_statement()
	{
		$data['content'] 	= $this->load->view('design/audit_statement', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function audit_history()
	{
		$data['content'] 	= $this->load->view('design/audit_history', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function my_report()
	{
		$data['content'] 	= $this->load->view('design/my_report', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function auditor_profile()
	{
		$data['content'] 	= $this->load->view('design/auditor_profile', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function coc_details()
	{
		$data['content'] 	= $this->load->view('design/coc_details', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function company_registration()
	{
		$data['content'] 	= $this->load->view('design/company_registration', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function company_registration_pending()
	{
		$data['content'] 	= $this->load->view('design/company_registration_pending', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

	public function cpd_activity()
	{
		$data['content'] 	= $this->load->view('design/cpd_activity', (isset($pagedata) ? $pagedata : ''), true);
		$data['plugins'] = [];
		$this->layout2($data);
	}

}
