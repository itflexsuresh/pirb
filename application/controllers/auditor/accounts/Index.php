<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Index extends CC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auditor_Model');
		$this->load->model('Coc_Model');
		$this->load->model('Renewal_Model');
		$this->load->model('Systemsettings_Model');
	}
	
	public function index($id='')
	{

		if($id!=''){	
			$post['id'] = $id;
			$result = $this->Auditor_Model->getInvoiceList('row', $post);
			if($result){				
				$pagedata['result'] 	= $result;
				$pagedata['settings']	= 	$this->Systemsettings_Model->getList('row');
			}else{
				$this->session->set_flashdata('error', 'No Record Found1.');
				redirect('auditor/accounts/index'); 
			}
		}
		
		if($this->input->post()){

			$requestData 	= 	$this->input->post();
			$id	= $requestData['editid'];
			if($requestData['submit']=='submit'){
				$requestData['status']	= '0';				
				$data 	=  $this->Auditor_Model->action2($requestData);	
				if($data) $message = 'Records '.(($id=='') ? 'created' : 'updated').' successfully.';
			}
			
			if(isset($data)){
				$this->session->set_flashdata('success', $message);
				$this->generatepdf($id);
			}else{
				$this->session->set_flashdata('error', 'Try Later.');
			}
			
			redirect('auditor/accounts/index'); 
		}
		
		$id = $this->getUserID();
		$pagedata['notification'] 	= $this->getNotification();
		$pagedata['province'] 		= $this->getProvinceList();		
		$getdata['id']				= $id;		
		$pagedata['auditordetail'] 	= $this->Auditor_Model->getAuditorList('row',$getdata);
		$pagedata['vat'] 			= $this->Coc_Model->getPermissions('row');
		$pagedata['customview'] 	= $this->load->view('common/custom',  '', true);
		// $pagedata['bankdetail'] 	= $this->Coc_Model->getPermissions('row');
		$data['plugins']			= ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','datepicker'];
		$data['content'] 			= $this->load->view('auditor/accounts/index', (isset($pagedata) ? $pagedata : ''), true);
		$this->layout2($data);

	
	}

	public function invoicenovalidation()
	{	
		$requestData 			= $this->input->post();
		$requestData['id'] 		= isset($requestData['id']) ? $requestData['id'] : '';
		$requestData['userid'] 	= $this->getUserID();
		$data 					= $this->Auditor_Model->invoicenovalidation($requestData);		
		echo $data;
	}
	

	public function DTAccounts()
	{
		$post 			= $this->input->post();
		$post['user_id'] 	= $this->getUserID();
		$totalcount 	= $this->Auditor_Model->getInvoiceList('count',$post);
		$results 		= $this->Auditor_Model->getInvoiceList('all', $post);
		// echo json_encode($totalcount); die;
		$totalrecord 	= [];
		if(count($results) > 0)
		{	
			foreach($results as $result)
			{
				$internal_inv = "";
				$originalDate = isset($result['invoice_date']) && $result['invoice_date']!='1970-01-01' && $result['invoice_date']!='0000-00-00' ? date('d-m-Y', strtotime($result['invoice_date'])) : '';

				$internal_inv = $result['invoice_no'];
				// $newDate = date("d-m-Y", strtotime($originalDate));
				if($result['status'] == '0'){
					$status = "Unpaid";
					$action = '<div class="col-md-6">
					<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf"  target="_blank">
					<img src="'.base_url().'assets/images/pdf.png" height="50" width="50">
					</div></a>';
				}
				elseif($result['status'] == '1'){
					$status = "Paid";
					$action = '<div class="col-md-6">
					<a  href="' .base_url().'assets/inv_pdf/'.$result['inv_id'].'.pdf"  target="_blank">
					<img src="'.base_url().'assets/images/pdf.png" height="50" width="50">
					</div></a>';
				}
				else{
					$status = "Not Submitted";
					if($result['status'] == '2'){
						$action = '<div class="table-action"><a href="'.base_url().'auditor/accounts/index/Editfunc/'.$result['inv_id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a></div>';
					}
				}

				$totalrecord[] = 	[      
					'inv_id' 		=> 	$internal_inv,
					'created_at'    =>  $originalDate,
					'description'   =>  $result['description'],
					'total_cost'    => 	$this->config->item('currency').' '.$result['total_cost'],
					'action'	    => 	$action,
					'status'    		=> 	$status

				];
			}
		}

		$json = array(
			"draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}

	public function DTAccounts2($id)
	{
		$post 			= $this->input->post();
		$post['id'] = $id;		
		$totalcount 	= $this->Auditor_Model->getInvoiceList('count',$post);
		$results 		= $this->Auditor_Model->getInvoiceList('all', $post);
		// $results1 		=$this->db->last_query();
		// echo json_encode($results); die;
		$totalrecord 	= [];
		if(count($results) > 0)
		{	
			foreach($results as $result)
			{
				
				$totalrecord[] = 	[    
					'description'   =>  $result['description'],
					'qty'   		=>  '1',
					'total_cost'    => 	$result['total_cost'],
					'vat'	    	=> 	$result['vat'],
					'vat_vendor'    =>  $result['vat_vendor'],

				];
			}
		}

		$json = array(
			"draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}

	public function Editfunc($id)
	{		
		$this->index($id);
	}

	public function generatepdf($inv_id)
	{
		$rowData = $this->Coc_Model->getListPDF('row', ['id' => $inv_id, 'status' => ['0','1']]);
		$designation =	$this->config->item('designation2')[$rowData['designation']];					
		$cocreport = $this->cocreport($inv_id, 'PDF Invoice Auditor', [
			'description' => $rowData['description'], 
			'type' => '2', 
			'logo' => base_url()."assets/uploads/auditor/".$rowData["file2"],
			'sublogo' => base_url()."assets/images/unpaid.png",
			'terms' => "30 Days"
		]);
	}
	
}
