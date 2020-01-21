<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rates_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function update($update_vals,$role_ID){
       // print_r('<pre>');
       // print_r($role_ID);
       // print_r('</pre>');
       // die;
       $this->db->where('ID', $role_ID);
       $this->db->update('rates', $update_vals);


   }
} ?>