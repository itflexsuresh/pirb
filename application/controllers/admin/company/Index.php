<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CC_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_Model');
        $this->load->model('Documentsletters_Model');
    }

    public function index()
    {
        $this->checkUserPermission('20', '1');

        $pagedata['notification'] = $this->getNotification();
        $pagedata['checkpermission'] = $this->checkUserPermission('20', '2');
        $data['plugins'] = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
        $data['content'] = $this->load->view('admin/company/index', (isset($pagedata) ? $pagedata : ''), true);
        $this->layout2($data);
    }

    public function DTcompanylist()
    {
        $post = $this->input->post();
        $totalcount 	= $this->Company_Model->getList('count', ['type' => '4', 'approvalstatus' => ['0', '1'], 'formstatus' => ['1'], 'status' => ['0', '1', '2']] + $post, ['users', 'usersdetail', 'userscompany']);
        $results 		= $this->Company_Model->getList('all', ['type' => '4', 'approvalstatus' => ['0', '1'], 'formstatus' => ['1'], 'status' => ['0', '1', '2']] + $post, ['users', 'usersdetail', 'userscompany', 'lttqcount', 'lmcount']);
        $companystatus	= $this->config->item('companystatus');

        $checkpermission = $this->checkUserPermission('20', '2');
        
        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {

                if ($checkpermission) {
                    $action = '<div class="table-action">
                                    <a href="' . base_url() . 'admin/company/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                                </div>';
                }else{
                    $action = '';
                }

				$companystatus1 = isset($companystatus[$result['companystatus']]) ? $companystatus[$result['companystatus']] : '';
                $totalrecord[] = [
									'id' 			=> $result['id'],
									'company' 		=> $result['company'],
									'status' 		=> $companystatus1,
									'lmcount' 		=> $result['lmcount'],
									'lttqcount' 	=> $result['lttqcount'],
									'action' 		=>  $action,
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

        $rollingavg                 = $this->getRollingAverage();
        $date                       = date('Y-m-d', strtotime(date('Y-m-d').'+'.$rollingavg.' months'));

        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
                $desigcount     = $this->Company_Model->getdesignationCount(['designation' => $result['designation']]);
                //print_r($desigcount);
                $performance = $this->Plumber_Model->performancestatus('all', ['plumberid' => $result['user_id'], 'archive' => '0', 'date' => $date]);     

                $per_points = array_sum(array_column($performance, 'point'));
                // print_r($performance);die;
                $points     = $this->Company_Model->cpdPoints($result['user_id']);

                if ($points[0]['cpd']!=''){
                     $points         = $points[0]['cpd'];
                }else{
                    $points         = '0';
                } 
                if( $per_points!=''){
                    $performance    = $per_points;
                }else{
                    
                    $performance    = '0';
                }
                if ($result['designation']=='6' || $result['designation']=='4') {
                   $divclass = 'lm';
                }else{
                    $divclass = 'other';
                }
                $overall = round((number_format($points+$performance)/$desigcount[0]['desigcount']),1);
                $companystatus1 = isset($companystatus[$result['status']]) ? $companystatus[$result['status']] : '';
                $totalrecord[] = [
                                    'reg'           => $result['registration_no'],
                                    'designation'   => $this->config->item('designation2')[$result['designation']],
                                    'status'        => $this->config->item('plumberstatus')[$result['status']],
                                    'namesurname'   => $result['name'].' '.$result['surname'],
                                    'cpdstatus'     => $points,
                                    'perstatus'     => $performance,
                                    'rating'        => '<input type="hidden" value="'.$overall.'" class="'.$divclass.'">'.$overall.'',
                                    'action'        => '
                                                            <div class="table-action">
                                                                <a href="' . base_url() . 'admin/company/index/empaction/'.$post['comp_id'].'/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
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
         $this->checkUserPermission('21', '1');

        $pagedata['notification']   = $this->getNotification();
        $pagedata['checkpermission'] = $this->checkUserPermission('21', '2');
        
        $data['plugins']            = ['datatables', 'datatablesresponsive'];
        $data['content']            = $this->load->view('admin/company/rejected', (isset($pagedata) ? $pagedata : ''), true);
        
        $this->layout2($data);      
    }

    public function DTRejectedCompany()
    {
        $post = $this->input->post();
        $totalcount     = $this->Company_Model->getList('count', ['type' => '4', 'approvalstatus' => ['2'], 'status' => ['0', '1', '2']] + $post, ['users', 'usersdetail', 'userscompany']);
        $results        = $this->Company_Model->getList('all', ['type' => '4', 'approvalstatus' => ['2'], 'status' => ['0', '1', '2']] + $post, ['users', 'usersdetail', 'userscompany']);
        $companystatus  = $this->config->item('companystatus');

        $checkpermission = $this->checkUserPermission('21', '2');

        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {

                if ($checkpermission) {
                    $action = 	'<div class="table-action">
									<a href="' . base_url() . 'admin/company/index/action/'.$result['id'].'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
								</div>';
                }else{
                    $action = '';
                }


                $companystatus = $result['companystatus']!='' && isset($companystatus[$result['companystatus']]) ? $companystatus[$result['companystatus']] : '';
                $totalrecord[] = [
                                    'date'          => date('d-m-Y', strtotime($result['created_at'])),
                                    'company'       => $result['company'],
                                    'reason'        => $this->config->item('companyrejectreason')[$result['reject_reason']],
                                    'action'        => $action,
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

    // Document Letters
    public function documents($compId,$documentsid='')
    {
        if($documentsid!=''){
            $result = $this->Documentsletters_Model->getcompanyList('row', ['id' => $documentsid]);
            if($result){
                $pagedata['result'] = $result;              

            }else{
                $this->session->set_flashdata('error', 'No Record Found.');
                if($extras['redirect']) redirect($extras['redirect']); 
                else redirect('admin/company/index'); 
            }
        }
        
        if($this->input->post()){
            $requestData    =   $this->input->post();           
            $result     =  $this->Documentsletters_Model->action2($requestData);             
            if($result){
             $this->session->set_flashdata('success', 'Documents Letters '.(($result==1) ? 'created' : 'updated').' successfully.');

             redirect('admin/company/index/documents/'.$compId);
            }
            else{
             $this->session->set_flashdata('error', 'Try Later.');
            }

        }


        $userdata1  = $this->Company_Model->getList('row', ['id' => $compId], ['users', 'usersdetail']);
        $pagedata['user_details']   = $userdata1;
        $pagedata['roletype']       = $this->config->item('roleadmin');
        $pagedata['notification']   = $this->getNotification();
        $pagedata['companyid']      = $compId;
        $pagedata['menu']           = $this->load->view('common/company/menu', ['id'=>$compId],true);
        $data['plugins'] = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation','inputmask'];
        $data['content'] = $this->load->view('admin/company/documents', (isset($pagedata) ? $pagedata : ''), true);
        $this->layout2($data);
    }


    public function DTDocuments()
    {
        $post       = $this->input->post();         
        $totalcount =  $this->Documentsletters_Model->getcompanyList('count',$post);
        $results    =  $this->Documentsletters_Model->getcompanyList('all',$post);
        $totalrecord    = [];
        if(count($results) > 0){
            foreach($results as $result){
                //echo date('Y-m-d', strtotime($result['updated_at']))!='0001-30-0001 00:00:00';die;
                $created_at = strtotime($result['created_at']);
                $upload_date = date('d-F-Y H:i:s', $created_at);
                if ($result['updated_at']!='') {
                    $updated_at = strtotime($result['updated_at']);
                    $update_date = date('d-F-Y H:i:s', $updated_at);

                    $full_date = $upload_date.' / '.$update_date;
                 }else{
                     $full_date = $upload_date;
                 }

                $filename = isset($result['file']) ? $result['file'] : '';
                
                $filepath   = base_url().'assets/uploads/company/';
                $pdfimg     = base_url().'assets/images/pdf.png';
                $file       = '';
                
                if($filename!=''){
                    $explodefile    = explode('.', $filename);
                    $extfile        = array_pop($explodefile);
                    $imgpath        = (in_array($extfile, ['pdf', 'tiff'])) ? $pdfimg : $filepath.$filename;
                    $file = '<div class="col-md-6"><a href="' .$imgpath.'" target="_blank"><img src="'.$imgpath.'" width="100"></div></a>';
                }
                
                $action = '<div class="table-action"><a href="' . base_url() . 'admin/company/index/documents/'.$result['user_id'].'/' . $result['id'] . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a><a href="'.base_url().'admin/company/index/Deletefunc/'.$result['user_id'].'/' . $result['id'] .'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" style="color:red;"></i></a><a href="' .base_url().'assets/uploads/company/'.$result['file'].'" download><i class="fa fa-download" style="color:blue;"></i></a></div>';

                $totalrecord[] =    [   
                                        'description'=>     $result['description'], 
                                        'datetime'   =>     $full_date,
                                        'file'       =>     $file,
                                        'action'     =>     $action,
                                        
                                    ];
            }
        }
        
        $json = array(            
            "recordsTotal"    => intval($totalcount),  
            "recordsFiltered" => intval($totalcount),
            "data"            => $totalrecord
        );

        echo json_encode($json);
    }


    public function Deletefunc($compId,$documentsid='')
    {       
        
        $result = $this->Documentsletters_Model->deleteid_comp($documentsid);
        if($result == '1'){
            // $url = FCPATH."assets/uploads/plumber/".$documentsid.".pdf";
            // unlink($url);
            $this->session->set_flashdata('success', 'Record was Deleted');
        }
        else{
            $this->session->set_flashdata('error', 'Error to delete the Record.');      
        }

        $this->index();
        redirect('admin/company/index/documents/'.$compId);
    }


}
