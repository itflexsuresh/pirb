<?php 
class rates_test extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		$this->load->library(array('form_validation', 'session', 'email', 'pagination'));
		$this->load->model(array('Rates_model_test'));
		$this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
		$this->load->database(); 

	}
	public function view()
	{
		$sql = "SELECT `ID`,`SupplyItem`,`Amount`,`ValidFrom` FROM `rates` ORDER BY `ID` desc";
		$query = $this->db->query($sql);
		$data['page_title'] = "Rates";
		$data['records'] = $query->result();
		$data['main_content'] = $this->load->view('rates/rates_view_test',$data,TRUE);
		$this->load->view('admin/index', $data);
	}	
	public function update_view()
	{
		$data['rates_id'] = $this->uri->segment('3');
		//$this->session->set_userdata('rateID',$rates_id);
		$sql = "SELECT `SupplyItem`,`Amount`,`ValidFrom` FROM `rates` WHERE `ID`='".$data['rates_id']."'";
		$query = $this->db->query($sql);
		$data['page_title'] = "Rates";
		$data['records'] = $query->result(); 
		$data['main_content'] = $this->load->view('rates/rates_update_test',$data,TRUE);
		$this->load->view('admin/index', $data);
	}
	public function add_update($role_id){
		if ($this->input->post('radio')=='option1') {
			//echo 'option1';die;
			$rateType = $this->input->post('rate_type');
			$ammountVAT = $this->input->post('amountVAT');
			$data = array('SupplyItem' => $rateType, 'Amount' => $ammountVAT );
			$this->Rates_model_test->update($data,$role_id);
			$this->session->unset_userdata('rateID');
			$this->session->set_flashdata('update_sucess','Rates Updated sucessfully'); 
			redirect('rates_test/view');

		}elseif($this->input->post('radio')=='option2'){
			//echo 'option2';die;
			$rateType = $this->input->post('rate_type');
			$ammountVAT = $this->input->post('amountVAT');		
			$date1 = $this->input->post('future_rate_date');
			$replace = str_replace('-', '/', $date1);
			$valid_date = date("Y-m-d", strtotime($replace)); 

			$data = array('SupplyItem' => $rateType, 'Amount' => $ammountVAT, 'futuredate' => $valid_date );
			//print_r($data);die;
			$this->Rates_model_test->update($data,$role_id);
			$this->session->unset_userdata('rateID');
			$this->session->set_flashdata('update_sucess','Rates Updated sucessfully'); 
			redirect('rates_test/view');
		}
		// $rateType = $this->input->post('rate_type');
		// $ammountVAT = $this->input->post('amountVAT');
		// //$date = $this->input->post('rate_date');
		// //$date1 = date("Y-m-d", $date);
		// //$date = date_format(date_create($this->input->post('rate_date')),"dd-mm-yy");
		// // echo $rateType."<br>";
		// // echo $ammountVAT."<br>";
		
		// $date1 = $this->input->post('rate_date');
		// $replace = str_replace('/', '-', $date1);
		// $valid_date = date("Y-m-d", strtotime($replace)); 
		// //echo $this->input->post('rate_date');
		// //echo $valid_date;die;

		// $data = array('SupplyItem' => $rateType, 'Amount' => $ammountVAT, 'ValidFrom' => $valid_date );
		// $this->Rates_model_test->update($data,$role_id);
		// $this->session->unset_userdata('rateID');
		// $this->session->set_flashdata('update_sucess','Rates Updated sucessfully'); 
		// //$this->session->set_flashdata('update_sucess','Rates Updated sucessfully');
		// redirect('rates_test/view');

	}
}
?>