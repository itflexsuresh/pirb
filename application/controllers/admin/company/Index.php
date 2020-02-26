<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CC_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_Model');
    }

    public function index()
    {
        $pagedata['notification'] = $this->getNotification();
        $data['plugins'] = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
        $data['content'] = $this->load->view('admin/company/index', (isset($pagedata) ? $pagedata : ''), true);
        $this->layout2($data);
    }

    public function DTcompanylist()
    {
        $post = $this->input->post();
        $totalcount 	= $this->Company_Model->getList('count', ['status' => ['0', '1', '2'], 'type' => '4', 'approvalstatus' => ['0','1']] + $post);
        $results 		= $this->Company_Model->getList('all', ['status' => ['0', '1', '2'], 'type' => '4', 'approvalstatus' => ['0','1']] + $post);
        $companystatus	= $this->config->item('companystatus');
        

        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
				$companystatus = isset($companystatus[$result['companystatus']]) ? $companystatus[$result['companystatus']] : '';
                $totalrecord[] = [
									'id' 			=> $result['id'],
									'company' 		=> $result['company'],
									'status' 		=> $companystatus,
									'lmcount' 		=> $result['lmcount'],
									'lttqcount' 	=> $result['lttqcount'],
									'action' 		=> '
															<div class="table-action">
																<a href="' . base_url() . 'admin/company/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
															</div>
														',
                ];
            }
        }
       
        $json = array(
            "draw" => intval($post['draw']),
            "recordsTotal" => intval($totalcount),
            "recordsFiltered" => intval($totalcount),
            "data" => $totalrecord,
        );

        echo json_encode($json);
    }
	
	public function action($id)
    {
       $this->companyprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'adminprofile'], ['redirect' => 'admin/company/index']);
    }


}
