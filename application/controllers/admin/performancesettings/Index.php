<?php
defined('BASEPATH') or exit('No direct script access allowed');
//Admin end company controller
class Index extends CC_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_Model');
    }

    public function index($id = '')
    {
        if ($id != '') {
            $result = $this->Company_Model->getList('row', ['id' => $id, 'status' => ['0', '1']]);
            if ($result) {
                $pagedata['result'] = $result;
            } else {
                $this->session->set_flashdata('error', 'No Record Found.');
                redirect('admin/administration/installationtype');
            }
        }

        $pagedata['notification'] = $this->getNotification();
        $data['plugins'] = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
        $data['content'] = $this->load->view('admin/company/index', (isset($pagedata) ? $pagedata : ''), true);
        $this->layout2($data);
    }

    //Company Register DataTable
    public function company_list_DT()
    {
        $post = $this->input->post();
        $totalcount = $this->Company_Model->getList('count', ['status' => ['0', '1']] + $post);
        $results = $this->Company_Model->getList('all', ['status' => ['0', '1']] + $post);

        $totalrecord = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
                $totalrecord[] = [
                    'id' => $result['id'],
                    'company_name' => $result['company_name'],
                    'status' => $result['status'],
                    'licensed_num' => $result['status'],
                    'licensed_num' => $result['status'],
                    'action' => '
															<div class="table-action">
																<a href="' . base_url() . 'admin/company/index/action/' . $result['id'] . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
															</div>
														',
                ];
            }
        }

        //
        // <a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>

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

        if ($id != '') {
            $pagedata['edit']            = $this->Company_Model->edit_company($id);
            $pagedata['user_detail']     = $this->Company_Model->get_user_details($pagedata['edit'][0]['user_id']);
            $pagedata['register_date']   = $this->Company_Model->get_register_date($pagedata['edit'][0]['user_id']);
            $pagedata['notification']    = $this->getNotification();
            $pagedata['notification']    = $this->getNotification();
            $pagedata['province']        = $this->getProvinceList();
            $pagedata['worktype']        = $this->config->item('worktype');
            $pagedata['specialization']  = $this->config->item('specialization');
            $data['plugins']             = ['datatables', 'datatablesresponsive', 'sweetalert', 'validation'];
            $pagedata['company_status']  = $this->load->view('admin/company/company_status',(isset($pagedata) ? $pagedata : ''),true);
            $data['content']             = $this->load->view('common/company', (isset($pagedata) ? $pagedata : ''), true);
            $this->layout2($data);
        } else {
            $this->session->set_flashdata('error', 'No Record Found.');
            redirect('admin/company/index');
        }

        if ($this->input->post()) {
            $requestData = $this->input->post();

            if ($requestData['submit'] == 'submit') {
                $data = $this->Company_Model->action($requestData);
                if ($data) {
                    $message = 'Company ' . (($id == '') ? 'created' : 'updated') . ' successfully.';
                }

            } else {
                $data = $this->Company_Model->changestatus($requestData);
                $message = 'Company deleted successfully.';
            }

            if (isset($data)) {
                $this->session->set_flashdata('success', $message);
            } else {
                $this->session->set_flashdata('error', 'Try Later.');
            }

            redirect('admin/company/index');
        }

    }

}
