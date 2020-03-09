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
        $totalcount 	= $this->Company_Model->getList('count', ['type' => '4', 'approvalstatus' => ['0', '1'], 'formstatus' => ['1'], 'status' => ['0', '1', '2']] + $post);
        $results 		= $this->Company_Model->getList('all', ['type' => '4', 'approvalstatus' => ['0', '1'], 'formstatus' => ['1'], 'status' => ['0', '1', '2']] + $post);
        $companystatus	= $this->config->item('companystatus');
        
        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
				$companystatus1 = isset($companystatus[$result['status']]) ? $companystatus[$result['status']] : '';
                $totalrecord[] = [
									'id' 			=> $result['id'],
									'company' 		=> $result['company'],
									'status' 		=> $companystatus1,
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

    public function DTemplist()
    {
        $post = $this->input->post();
        $totalcount     = $this->Company_Model->getEmpList('count', ['type' => '4', 'approvalstatus' => ['0', '1'], 'formstatus' => ['1'], 'status' => ['0', '1', '2']] + $post);
        $results        = $this->Company_Model->getEmpList('all', ['type' => '4', 'approvalstatus' => ['0', '1'], 'formstatus' => ['1'], 'status' => ['0', '1', '2']] + $post);
        $companystatus  = $this->config->item('companystatus');
        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
                if ($result['points']!='' && $result['performance']!='') {
                    $points         = $result['points'];
                    $performance    = $result['performance'];
                }else{
                    $points         = 0;
                    $performance    = 0;
                }

                $companystatus1 = isset($companystatus[$result['status']]) ? $companystatus[$result['status']] : '';
                $totalrecord[] = [
                                    'reg'           => $result['registration_no'],
                                    'designation'   => $this->config->item('designation2')[$result['designation']],
                                    'status'        => $this->config->item('plumberstatus')[$result['status']],
                                    'namesurname'   => $result['name'].' '.$result['surname'],
                                    'cpdstatus'     => $points,
                                    'perstatus'     => $performance,
                                    'rating'        => '1',
                                    'action'        => '
                                                            <div class="table-action">
                                                                <a href="' . base_url() . 'admin/company/index/empaction/'.$post['comp_id'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-eye"></i></a>
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

    public function empaction($compid,$id)
    {
       $this->employee(['compid' => $compid, 'id' => $id], ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'adminempdetails'], ['redirect' => 'admin/company/company/employee_listing']);
    }
	
	public function action($id)
    {
        $this->companyprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'adminprofile'], ['redirect' => 'admin/company/index']);
    }

    public function rejected()
    {
        $pagedata['notification']   = $this->getNotification();
        
        $data['plugins']            = ['datatables', 'datatablesresponsive'];
        $data['content']            = $this->load->view('admin/company/rejected', (isset($pagedata) ? $pagedata : ''), true);
        
        $this->layout2($data);      
    }

    public function DTRejectedCompany()
    {
        $post = $this->input->post();
        $totalcount     = $this->Company_Model->getList('count', ['type' => '4', 'approvalstatus' => ['2'], 'status' => ['0', '1', '2']] + $post);
        $results        = $this->Company_Model->getList('all', ['type' => '4', 'approvalstatus' => ['2'], 'status' => ['0', '1', '2']] + $post);
        $companystatus  = $this->config->item('companystatus');
        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
                $companystatus = $result['companystatus']!='' && isset($companystatus[$result['companystatus']]) ? $companystatus[$result['companystatus']] : '';
                $totalrecord[] = [
                                    'date'          => date('d-m-Y', strtotime($result['created_at'])),
                                    'company'       => $result['company'],
                                    'reason'        => $this->config->item('companyrejectreason')[$result['reject_reason']],
                                    'action'        => '
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
    
    public function rejectedaction($id)
    {
       // $this->plumberprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'rejectedapplications'], ['redirect' => 'admin/plumber/index/rejected']);
         $this->companyprofile($id, ['roletype' => $this->config->item('roleadmin'), 'pagetype' => 'rejectedapplications'], ['redirect' => 'admin/company/index/rejected']);
    }

    // Empployee Lsiting
    public function emplist($id){
         $this->employee($id, ['roletype' => $this->config->item('roleadmin'),'redirect' => 'admin/company/index/index']);
    }
	
	 public function diary($id){
        //print_r($id);die;
        $this->companydiary($id, ['roletype' => $this->config->item('roleadmin'),'redirect' => 'admin/company/index/index']);
    }


}
