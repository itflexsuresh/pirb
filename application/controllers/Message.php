<?php 
class message extends CI_Controller {

	function __construct() { 
		parent::__construct(); 
		$this->load->library(array('form_validation', 'session', 'email', 'pagination'));
		$this->load->model(array('Message_model'));
		$this->load->helper(array('form', 'url', 'file', 'email', 'html', 'cookie'));
		$this->load->database(); 

	}
	public function view()
	{
		$sql = "SELECT `MessageListID`,`MessageGroup`,`MessageStart`,`MessageEnd`,`Message` FROM `MessageListsItems` ORDER BY `MessageListID` desc";
		$query = $this->db->query($sql);
		$data['page_title'] = "Global Message";
		$data['records'] = $query->result();
		$data['main_content'] = $this->load->view('message/message_view',$data,TRUE);
		$this->load->view('admin/index', $data);
	}
	public function new_message_view(){
		$msg_view = array();
		$msg_view['page_title'] = "Global Message";
		$msg_view['main_content'] = $this->load->view('message/message_send',$msg_view,TRUE);
		$this->load->view('admin/index', $msg_view);
	}
	public function send_message(){
		$msg_grp = $this->input->post('msg_role');
		// $start_date = $this->input->post('start_date');
		// $end_date = $this->input->post('end_date');
		$message = $this->input->post('editor');
		$status = 1;
		// echo $msg_grp."<br>";
		// echo $start_date."<br>";
		// echo $end_date."<br>";
		// echo $message."<br>";
		// die;
		if ($msg_grp==1) {
			$users = 'Plumber';
		}elseif($msg_grp==2){
			$users = 'Auditor';
		}elseif($msg_grp==3){
			$users = 'Reseller';
		}
		elseif($msg_grp==4){
			$users = 'Company';
		}
		$start_date = date("Y-m-d", strtotime(str_replace('-','/', $this->input->post('start_date'))));
		$end_date = date("Y-m-d", strtotime(str_replace('-','/', $this->input->post('end_date'))));
		// echo $start_date."<br>";
		// echo $end_date."<br>";
		// die;

		$data = array('Message' =>$message ,'MessageStart' =>$start_date ,'MessageEnd' =>$end_date ,'MessageGroup' =>$msg_grp ,'Users' =>$users ,'IsActive' =>$status );
		// print_r($data);
		// die;
		$this->Message_model->insert_message($data);
		$this->session->set_flashdata('new_msg_sucess','Message Added Sucessfuly');
		redirect('message/view');
	}
	public function delete_msgs(){
		$msg_id = $this->uri->segment('3');
		// echo $msg_id;
		// die;
		$this->Message_model->delete($msg_id);
		$this->session->set_flashdata('delete_sucess','Message Deleted Sucessfuly');
		redirect('message/view');
	}
	public function edit_view(){
		$data['edit_msg_id'] = $this->uri->segment('3');
		//$this->session->set_userdata('msg_id',$edit_msg_id);
		$sql  = "SELECT `MessageListID`,`MessageGroup`,`MessageStart`,`MessageEnd`,`Message` FROM `MessageListsItems` WHERE `MessageListID`='".$data['edit_msg_id']."'";
		$query = $this->db->query($sql);
		$data['page_title'] = "Global Message";
		$data['records'] = $query->result();
		$data['main_content'] = $this->load->view('message/message_edit',$data,TRUE);
		$this->load->view('admin/index', $data);
	}
	public function add_msg_edit($msgID){
		$start_date = date("Y-m-d", strtotime(str_replace('/','-', $this->input->post('start_date'))));
		$end_date = date("Y-m-d", strtotime(str_replace('/','-', $this->input->post('end_date'))));
		$msg_grp = $this->input->post('msg_role');
		$message = $this->input->post('editor');
		if ($msg_grp==1) {
			$users = 'Plumber';
		}elseif($msg_grp==2){
			$users = 'Auditor';
		}elseif($msg_grp==3){
			$users = 'Reseller';
		}
		elseif($msg_grp==4){
			$users = 'Company';
		}

		$status = 1;
		//if ($this->session->userdata('msg_id')!='') {
			$data = array('Message' =>$message ,'MessageStart' =>$start_date ,'MessageEnd' =>$end_date ,'MessageGroup' =>$msg_grp ,'Users' =>$users ,'IsActive' =>$status );
			// print_r($data);
			// die;
			$this->Message_model->edit_msg($data,$msgID);
		//}
		//$this->session->unset_userdata('msg_id');
		$this->session->set_flashdata('update_sucess','Message Updated Sucessfully');
		redirect('message/view');

	}
	public function get_ajaxpagination_view(){
		    // POST data
     $postData = $this->input->post();
	 //print_r($postData);die;

     // Get data
     $data = $this->Message_model->getMessage_ajax($postData);

     echo json_encode($data);

	}
	// History
		public function get_ajaxpagination_view_history(){
		    // POST data
     $postData = $this->input->post();
	 //print_r($postData);die;

     // Get data
     $data = $this->Message_model->getMessage_ajax_history($postData);

     echo json_encode($data);

	}
}