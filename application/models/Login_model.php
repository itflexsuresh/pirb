<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }


        function password_chks()
    {
        // /echo "hii";exit;

        $this->db->where('password', $_POST['password']);
        $this->db->where('email', $_POST['username']);
        $this->db->select('password');
        $this->db->from('users');
        $rows = $this->db->get()->num_rows();
        return $rows;
    }

    function login(){
    	$user_name         = $this->input->post('username');
        $password         = $this->input->post('password');
        $query            = $this->db->get_where('users', array('email' => $user_name, 'password' => $password));
       // print_r($query);exit;
        $record           = $query->result();
       
        // $userid = $record[0]->user_id;
        //  print_r($userid);exit;
       // $login_date = date("Y-m-d H:i:s");
        //echo count($record);exit;
         if (count($record) > 0) 
         { 
            // if ($record[0]->status == 0) 
            // { 
            //     $rec_status     = 'Suspended';
            //     return $rec_status;
            // } 
             $userDetails    = array(
                'usrId'     => $record[0]->UserID,
                'usrName'   => $record[0]->email,
                'usrrole'   => $record[0]->role,
                'fname'  => $record[0]->fname );

            //print_r($userDetails);exit;

            $this->session->set_userdata($userDetails);
            //$sql = $this->db->query("update tbl_users set last_login_date='$login_date' where user_id='$userid'");  
            
            redirect('dashboard/');
            return true;
        }
        else 
        { 
            $rec_status     = 'Invalid';
            return $rec_status;
        }
    }
    function Forgot_password_update(){
        //logics
        echo "Forgot Password";exit;
    }
}