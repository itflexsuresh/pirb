<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class plumber extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		$this->load->model('plumberModel');
		$this->load->library('session');
	}

	public function register()
	{
			

         	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

         	// $this->form_validation->set_rules('RegistrationCard', 'registration card', 'required');
         	// $this->form_validation->set_rules('title', 'title', 'required');
         	//	$this->form_validation->set_rules('DateofBirth', 'Date of birth', 'required');
         	// $this->form_validation->set_rules('fname', 'First name', 'required');
         	// $this->form_validation->set_rules('lname', 'Last name', 'required');
         	// $this->form_validation->set_rules('Gender', 'Gender', 'required');
         	// $this->form_validation->set_rules('Equity', 'Racial Status', 'required');
         	// // $this->form_validation->set_rules('CitizenResidentStatus', 'South African National', '
         	// // 	required');
         	// // $this->form_validation->set_rules('Nationality', 'Other Nationality', '
         	// // 	required');
         	// $this->form_validation->set_rules('Language', 'Language', 'required');
         	// $this->form_validation->set_rules('DisabilityStatus', 'Disability', 'required');
         	// $this->form_validation->set_rules('ResidentStatus', 'Citizen Residential Status', 'required');

         	// $this->form_validation->set_rules('contact', 'Mobile Phone', 'required');
         	// $this->form_validation->set_rules('Email', 'Email Address', 'required');

         	// $this->form_validation->set_rules('ProcedureRegistration', 'ProcedureRegistration', 'required',
          //               array('required' => 'Please check Procedure of Registration')  );
         	// $this->form_validation->set_rules('CodeConduct', 'Conduct', 'required',
          //               array('required' => 'Please check %s') );
         	// $this->form_validation->set_rules('Acknowledgement', 'Acknowledgement', 'required',
          //               array('required' => 'Please check %s'));
         	// $this->form_validation->set_rules('Declaration', 'Declaration', 'required',
          //               array('required' => 'Please check %s') );

         	// $this->form_validation->set_rules('SocioeconomicStatus', 'Employment status', 'required',
          //               array('required' => 'Please select %s') );

   //       	$this->form_validation->set_rules(
			//         'IDNo', 'ID No','is_unique[users.IDNo]',
			//         array(
			//                 'is_unique'     => 'This %s already exists.'
			//         )
			// );
 			
 			$data = array();

 			$data['base_path'] = '../';

			$empty_arr = $this->config->item('empty_arr');
		      $data['empty_arr'] = $empty_arr;
		      $data['yes_no_arr'] = $empty_arr+$this->config->item('yes_no_arr');
		      $data['delivery_method_arr'] = $empty_arr+$this->config->item('delivery_method_arr');
		      $data['title_arr'] = $empty_arr+$this->config->item('title_arr');
		      $data['racialstatus_arr'] = $empty_arr+$this->config->item('racialstatus_arr');    
		      $data['gender_data'] = $empty_arr+$this->config->item('gender_arr'); 
		      $data['employment_status_data'] = $empty_arr+$this->config->item('employment_status_arr'); 
		      //$data['nationality_arr'] = $empty_arr+$this->config->item('nationality_arr');
		      
		      $data['nationality_arr'] = $this->commonModel->config('nationality_arr');
		      $data['home_language_arr'] = $this->commonModel->config('home_language_arr');
		      $data['disability_arr'] = $this->commonModel->config('disability_arr');
		      $data['resident_status_arr'] = $this->commonModel->config('resident_status_arr');
		      $data['designation_arr'] = $this->commonModel->config('designation_arr','radio');
 			
 			// $province_data = $this->commonModel->get_province();
 			// $province_data_new = $this->commonModel->set_selectbox($province_data);
 			// $data['province_data'] = $province_data_new;
 			$province_field_arr = array('field'=>'province');
 			$data['province_data'] = $this->commonModel->set_selectbox_data($province_field_arr);
 			
 			$city_field_arr = array('field'=>'city','sel_val'=>set_value('Province'));
 			$data['city_data'] = $this->commonModel->set_selectbox_data($city_field_arr);

 			$phy_city_field_arr = array('field'=>'city','sel_val'=>set_value('PostalProvince'));
 			$data['phy_city_data'] = $this->commonModel->set_selectbox_data($phy_city_field_arr);

 			$cmp_city_field_arr = array('field'=>'city','sel_val'=>set_value('cmpProvince'));
 			$data['cmp_city_data'] = $this->commonModel->set_selectbox_data($cmp_city_field_arr);

 			$cmp_postal_city_arr = array('field'=>'city','sel_val'=>set_value('cmpPostalProvince'));
 			$data['cmp_postal_city_data'] = $this->commonModel->set_selectbox_data($cmp_postal_city_arr);

 			$area_arg = array('field'=>'area','sel_val'=>set_value('ResidentialCity'));
 			$data['area_data'] = $this->commonModel->set_selectbox_data($area_arg);

 			$postal_area_arg = array('field'=>'area','sel_val'=>set_value('PostalCity'));
 			$data['phy_area_data'] = $this->commonModel->set_selectbox_data($postal_area_arg);

 			$cmp_area_arg = array('field'=>'area','sel_val'=>set_value('cmpCity'));
 			$data['cmp_area_data'] = $this->commonModel->set_selectbox_data($cmp_area_arg);

 			$cmp_postal_area_arg = array('field'=>'area','sel_val'=>set_value('cmpPostalCity'));
 			$data['cmp_postal_area_data'] = $this->commonModel->set_selectbox_data($cmp_postal_area_arg);

			$company_field_arr = array('field'=>'company');			
 			$company_data = $this->commonModel->set_selectbox_data($company_field_arr);
 			array_splice( $company_data, 1, 0, array('New company') ); 			
 			$data['company_data'] = $company_data;
//  			print '<pre>';
// print_r($data['company_data']);
// print '</pre>';
// exit;

 			$data['gender_data'] = $empty_arr+$this->config->item('gender_arr'); 
 			$data['employment_status_data'] = $empty_arr+$this->config->item('employment_status_arr'); 

 			// $province_selected_val = set_value('Province');
 			// if($province_selected_val>0){
 			// 	$city_data = $this->commonModel->get_city($province_selected_val);
 			// 	$city_data = $this->commonModel->set_selectbox($city_data);
 			// } else {
 			// 	$city_data = $empty_arr;
 			// }
 			// $data['city_data'] = $city_data;

 			// $phy_province_selected_val = set_value('PostalProvince');
 			// if($phy_province_selected_val>0){
 			// 	$phy_city_data = $this->commonModel->get_city($phy_province_selected_val);
 			// 	$phy_city_data = $this->commonModel->set_selectbox($phy_city_data);
 			// } else {
 			// 	$phy_city_data = $empty_arr;
 			// }
 			// $data['phy_city_data'] = $phy_city_data;

 			// $city_selected_val = set_value('ResidentialCity');
 			// if($city_selected_val>0){
 			// 	$area_data = $this->commonModel->get_area($city_selected_val);
 			// 	$area_data = $this->commonModel->set_selectbox($area_data);
 			// } else {
 			// 	$area_data = $empty_arr;
 			// }
 			// $data['area_data'] = $area_data;

 			// $phy_city_selected_val = set_value('PostalCity');
 			// if($phy_city_selected_val>0){
 			// 	$phy_area_data = $this->commonModel->get_area($phy_city_selected_val);
 			// 	$phy_area_data = $this->commonModel->set_selectbox($phy_area_data);
 			// } else {
 			// 	$phy_area_data = $empty_arr;
 			// }
 			// $data['phy_area_data'] = $phy_area_data;

 			//$cmp_province_selected_val = set_value('cmpProvince');
 			// $data['cmp_city_data'] = $this->commonModel->selectbox_arr(set_value('cmpProvince'),'city');
 			// $data['cmp_area_data'] = $this->commonModel->selectbox_arr(set_value('cmpCity'),'area');

 			// $data['cmp_postal_city_data'] = $this->commonModel->selectbox_arr(set_value('cmpPostalProvince'),'city');
 			// $data['cmp_postal_area_data'] = $this->commonModel->selectbox_arr(set_value('cmpPostalCity'),'area');
 			
 			// if($phy_province_selected_val>0){
 			// 	$phy_city_data = $this->commonModel->get_city($phy_province_selected_val);
 			// 	$phy_city_data = $this->commonModel->set_selectbox($phy_city_data);
 			// } else {
 			// 	$phy_city_data = $empty_arr;
 			// }
 			// $data['phy_city_data'] = $phy_city_data;

    //      	if ($this->form_validation->run() == FALSE) { 
				// $this->load->view('plumber/register', $data);
    //     	} 
 		// 	if ( $this->form_validation->run() && $this->form_validation->error_string == '')
			// {
			//    // Form was not submitted
			// 	exit;
			// }

        	if ($this->form_validation->run() == TRUE || !empty($_POST)) {

        		

        		$config['upload_path']          = './uploads/certificates/';
	            $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|tiff';
	            $config['max_size']             = 2000;
	            $config['max_width']            = 1300;
	            $config['max_height']           = 1024;

	            $users = array();

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('Photo')){
	            	$photo_upload_data = $this->upload->data();	
	            	$users['Photo'] = $photo_upload_data['file_name'];
	            }

	            if($this->upload->do_upload('IDPhoto')){
	            	$id_photo_upload_data = $this->upload->data();	
	            	$users['IDPhoto'] = $id_photo_upload_data['file_name'];
	            }


	            

    		//if ($_POST){

        		$newapplications_fields = array(
        			'RegistrationCard',
					'DeliveryMethod',
					'Designation',
					'DeclarationName',
					'DeclarationIDNumber',
					'ProcedureRegistration',
					'CodeConduct',
					'Acknowledgement',
					'Declaration',
        		);
        		$newapplications = array();								
				foreach($newapplications_fields as $key=>$val){
					if(is_string($key)==TRUE){
						$newapplications[$key] = $val;	
					} else {
						$post_val = $this->input->post($val);
						$newapplications[$val] = $post_val;
					}
				}
				$data['newapplications'] = $newapplications;
    
				$users_fields = array(
					'role'=>2,
					'title',
					'DateofBirth',
					'fname',
					'lname',
					'Gender',
					'Equity',		
					'IDNo',							
					'Nationality',					
					'Alternate',							 
					'Language',
					'DisabilityStatus',
					'ResidentialStreet',
					'PostalAddress',
					'PostalCode',
					'homePhone',
					'contact',
					'BusinessPhone',
					'secondContact',
					'Email',
					'SecondEmail',
					'company',
					'Province',
					'PostalProvince',
					'ResidentialCity',
					'PostalCity',
					'ResidentialSuburb',
					'PostalSuburb',
					'SocioeconomicStatus',
				);

				//	$users = array();								
				foreach($users_fields as $key=>$val){
					if(is_string($key)==TRUE){
						$users[$key] = $val;	
					} else {
						$post_val = $this->input->post($val);
						if($val=='DateofBirth'){
							if($post_val!=''){
								$post_val = date('Y-d-m',strtotime($post_val));
							}
						}						
						$users[$val] = $post_val;
						if($val=='company'){
							if($post_val<0){
								unset($users[$val]);
							}
						}
					}
				}

				if($this->input->post('CitizenResidentStatus')==1){
					$users['CitizenResidentStatus'] = 4;
				} else{
					$users['CitizenResidentStatus'] = $this->input->post('ResidentStatus');
				}
				
				$data['users'] = $users;

				$companies = array();	

				if($this->input->post('company')=='0'){
					$company_fields = array(
										'CompanyName',
										'CompanyRegNo',
										'VatNo',
										'primaryContact',
										'AddressLine1',
										'cmpPostalAddress',
										'cmpPostalCode',
										'CompanyContactNo',
										'Fax',
										'Mobile',
										'CompanyEmail',
										'cmpProvince',
										'cmpCity',
										'cmpSuburb',
										'cmpPostalProvince',
										'cmpPostalCity',
										'cmpPostalSuburb',
									);
												
					foreach($company_fields as $key=>$val){
						if(is_string($key)==TRUE){
							$companies[$key] = $val;	
						} else {

							$post_val = $this->input->post($val);
								$cmp_fiels_spec_array = array('cmpPostalAddress','cmpPostalCode','cmpProvince','cmpCity','cmpSuburb','cmpPostalProvince','cmpPostalCity','cmpPostalSuburb',);
							//$cmp_fiels_spec_array = array('cmpPostalProvince',);
							foreach($cmp_fiels_spec_array as $key1=>$val1){
								if($val==$val1){
									
									$val = ltrim($val,"cmp");
									// $str = 'cmp';
									// $val = substr($val, 3);
									// $first_3_let = substr($val1, 0, 3);

									// if($first_3_let=='cmp'){

									// }
								}
							}
							// if($val=='cmpPostalAddress'){
							// 	$val='PostalAddress';
							// }
							// if($val=='cmpPostalCode'){
							// 	$val='PostalCode';
							// }
							// if($val=='cmpProvince'){
							// 	$val='Province';
							// }
							// if($val=='cmpCity'){
							// 	$val='City';
							// }
							// if($val=='cmpSuburb'){
							// 	$val='Suburb';
							// }
							$companies[$val] = $post_val;
						}
					}
					$companies['status'] = 3;
				} 
				$data['companies'] = $companies;

				$this->plumberModel->insert_data($data);
				$this->session->set_flashdata('msg', 'Plumber is registered successfully');			
				redirect('plumber/register');
      		}
      		else {
      			unset($_SESSION['certificate']);
      			$this->load->view('plumber/register', $data);
      		}

      			
      // 		$data['main_content'] = $this->load->view('plumber/register', $data, TRUE);	    
	    	// $this->load->view('admin/index', $data);
	}

	
	public function update($id=NULL)
	{

         	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
 			
 			$data = array();
 			$data['application_update'] = array();
 			$data['id'] = $id;
 			$data['base_path'] = '../';
 			if($id!=''){
 				$data['base_path'] .= '../';
 				$this->db->select('DateofBirth,Title,ProcedureRegistration,CodeConduct,Acknowledgement,Declaration,t2.RegistrationCard,t2.DeliveryMethod,IDPhoto,Photo,title,Gender,Equity,CitizenResidentStatus,Nationality,Language,DisabilityStatus,DateofBirth,fname,lname,IDNo,Alternate,ResidentialStreet,Province,ResidentialCity,ResidentialSuburb,PostalAddress,PostalProvince,PostalCity,PostalSuburb,PostalCode,homePhone,contact,BusinessPhone,secondContact,Email,SecondEmail,SocioeconomicStatus,company,Designation,DeclarationName,DeclarationIDNumber');
			    $this->db->join('newapplications AS t2', 't1.UserID = t2`.UserID','inner');
			    $this->db->where('t1.UserID',$id);
			    $res = $this->db->get('users AS t1')->row_array();
			    if($res['DateofBirth']!=''){
			    	$res['DateofBirth'] = date('d/m/Y',strtotime($res['DateofBirth']));
			    }
			    if($res['Nationality']>0){
			    	$res['ResidentStatus'] = 0;
			    	$data['nationality_show'] = 1;
			    } else {
			    	$res['ResidentStatus'] = 1;
			    	$data['nationality_show'] = 0;
			    }
			    $data['res'] = $res;

 			}
 			
 			
 			$empty_arr = $this->config->item('empty_arr');
 			$data['empty_arr'] = $empty_arr;
 			$data['yes_no_arr'] = $empty_arr+$this->config->item('yes_no_arr');
 			$data['delivery_method_arr'] = $empty_arr+$this->config->item('delivery_method_arr');
 			$data['title_arr'] = $empty_arr+$this->config->item('title_arr');
 			$data['racialstatus_arr'] = $empty_arr+$this->config->item('racialstatus_arr');    
 			$data['gender_data'] = $empty_arr+$this->config->item('gender_arr'); 
 			$data['employment_status_data'] = $empty_arr+$this->config->item('employment_status_arr'); 
 			//$data['nationality_arr'] = $empty_arr+$this->config->item('nationality_arr');
 			
 			$data['nationality_arr'] = $this->commonModel->config('nationality_arr');
 			$data['home_language_arr'] = $this->commonModel->config('home_language_arr');
 			$data['disability_arr'] = $this->commonModel->config('disability_arr');
 			$data['resident_status_arr'] = $this->commonModel->config('resident_status_arr');
 			$data['designation_arr'] = $this->commonModel->config('designation_arr','radio');
 			
 			$data['application_update']['application_status_arr'] = $this->commonModel->config('application_status_arr','checkbox');
 			$data['application_update']['approve_arr'] = $this->config->item('approve_arr');

 			$province_field_arr = array('field'=>'province');
 			$data['province_data'] = $this->commonModel->set_selectbox_data($province_field_arr);
 			
 			$city_field_arr = array('field'=>'city','sel_val'=>$res['Province']);
 			$data['city_data'] = $this->commonModel->set_selectbox_data($city_field_arr);

 			$phy_city_field_arr = array('field'=>'city','sel_val'=>$res['PostalProvince']);
 			$data['phy_city_data'] = $this->commonModel->set_selectbox_data($phy_city_field_arr);

 			/*$cmp_city_field_arr = array('field'=>'city','sel_val'=>set_value('cmpProvince'));
 			$data['cmp_city_data'] = $this->commonModel->set_selectbox_data($cmp_city_field_arr);

 			$cmp_postal_city_arr = array('field'=>'city','sel_val'=>set_value('cmpPostalProvince'));
 			$data['cmp_postal_city_data'] = $this->commonModel->set_selectbox_data($cmp_postal_city_arr);*/

 			$area_arg = array('field'=>'area','sel_val'=>$res['ResidentialCity']);
 			$data['area_data'] = $this->commonModel->set_selectbox_data($area_arg);

 			$postal_area_arg = array('field'=>'area','sel_val'=>$res['PostalCity']);
 			$data['phy_area_data'] = $this->commonModel->set_selectbox_data($postal_area_arg); 	

 			/*$cmp_area_arg = array('field'=>'area','sel_val'=>set_value('cmpCity'));
 			$data['cmp_area_data'] = $this->commonModel->set_selectbox_data($cmp_area_arg);

 			$cmp_postal_area_arg = array('field'=>'area','sel_val'=>set_value('cmpPostalCity'));
 			$data['cmp_postal_area_data'] = $this->commonModel->set_selectbox_data($cmp_postal_area_arg);*/

			$company_field_arr = array('field'=>'company');			
 			$company_data = $this->commonModel->set_selectbox_data($company_field_arr);
 			array_splice( $company_data, 1, 0, array('New company') ); 			
 			$data['company_data'] = $company_data;

 			

        	if ($this->form_validation->run() == TRUE || !empty($_POST)) {

        		$config['upload_path']          = './uploads/certificates/';
	            $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|tiff';
	            $config['max_size']             = 2000;
	            // $config['max_width']            = 1300;
	            // $config['max_height']           = 1024;

	            $users = array();

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('Photo')){
	            	$photo_upload_data = $this->upload->data();	
	            	$users['Photo'] = $photo_upload_data['file_name'];
	            } else {
	            	echo $this->upload->display_errors();
	            }

	            if($this->upload->do_upload('IDPhoto')){
	            	$id_photo_upload_data = $this->upload->data();	
	            	$users['IDPhoto'] = $id_photo_upload_data['file_name'];
	            }
	            //	exit;

        		$newapplications_fields = array(
        			'RegistrationCard',
					'DeliveryMethod',
					'Designation',
					'DeclarationName',
					'DeclarationIDNumber',
					'ProcedureRegistration',
					'CodeConduct',
					'Acknowledgement',
					'Declaration',
        		);
        		$newapplications = array();								
				foreach($newapplications_fields as $key=>$val){
					if(is_string($key)==TRUE){
						$newapplications[$key] = $val;	
					} else {
						$post_val = $this->input->post($val);
						$newapplications[$val] = $post_val;
					}
				}
				$data['newapplications'] = $newapplications;
    
				$users_fields = array(
					'title',
					'DateofBirth',
					'fname',
					'lname',
					'Gender',
					'Equity',		
					'IDNo',							
					'Nationality',					
					'Alternate',							 
					'Language',
					'DisabilityStatus',
					'ResidentialStreet',
					'PostalAddress',
					'PostalCode',
					'homePhone',
					'contact',
					'BusinessPhone',
					'secondContact',
					'Email',
					'SecondEmail',
					'company',
					'Province',
					'PostalProvince',
					'ResidentialCity',
					'PostalCity',
					'ResidentialSuburb',
					'PostalSuburb',
					'SocioeconomicStatus',
				);
								
				foreach($users_fields as $key=>$val){
					if(is_string($key)==TRUE){
						$users[$key] = $val;	
					} else {
						$post_val = $this->input->post($val);
						if($val=='DateofBirth'){
							if($post_val!=''){
								$post_val = date('Y-d-m',strtotime($post_val));
							}
						}						
						$users[$val] = $post_val;
						if($val=='company'){
							if($post_val<0){
								unset($users[$val]);
							}
						}
					}
				}

				if($this->input->post('CitizenResidentStatus')==1){
					$users['CitizenResidentStatus'] = 4;
				} else{
					$users['CitizenResidentStatus'] = $this->input->post('ResidentStatus');
				}
				
				$data['users'] = $users;

				$companies = array();	

				// if($this->input->post('company')=='0'){
				// 	$company_fields = array(
				// 						'CompanyName',
				// 						'CompanyRegNo',
				// 						'VatNo',
				// 						'primaryContact',
				// 						'AddressLine1',
				// 						'cmpPostalAddress',
				// 						'cmpPostalCode',
				// 						'CompanyContactNo',
				// 						'Fax',
				// 						'Mobile',
				// 						'CompanyEmail',
				// 						'cmpProvince',
				// 						'cmpCity',
				// 						'cmpSuburb',
				// 						'cmpPostalProvince',
				// 						'cmpPostalCity',
				// 						'cmpPostalSuburb',
				// 					);
												
				// 	foreach($company_fields as $key=>$val){
				// 		if(is_string($key)==TRUE){
				// 			$companies[$key] = $val;	
				// 		} else {

				// 			$post_val = $this->input->post($val);
				// 				$cmp_fiels_spec_array = array('cmpPostalAddress','cmpPostalCode','cmpProvince','cmpCity','cmpSuburb','cmpPostalProvince','cmpPostalCity','cmpPostalSuburb',);
				// 			foreach($cmp_fiels_spec_array as $key1=>$val1){
				// 				if($val==$val1){
									
				// 					$val = ltrim($val,"cmp");
				// 				}
				// 			}
				// 			$companies[$val] = $post_val;
				// 		}
				// 	}
				// 	$companies['status'] = 3;
				// } 
				$data['companies'] = $companies;

				//	$this->plumberModel->insert_data($data);
				$this->plumberModel->update_data($data);
				$this->session->set_flashdata('msg', 'Plumber is Updated successfully');			
				redirect("/plumber/update/$id");
      		}
      		$data['application_update']['Designation'] = $res['Designation'];
      		$data['application_update']['designation_arr'] = $data['designation_arr'];
      		
      			$this->load->view('plumber/update', $data);

      	// 	$data['main_content'] = $this->load->view('plumber/update', $data, TRUE);	    
	 	   	// $this->load->view('admin/index', $data);
	}

	public function update_test($id=NULL)
	{

         	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
 			
 			$data = array();
 			$data['application_update'] = array();
 			$data['id'] = $id;
 			$data['base_path'] = '../';
 			if($id!=''){
 				$data['base_path'] .= '../';
 				$this->db->select('DateofBirth,Title,ProcedureRegistration,CodeConduct,Acknowledgement,Declaration,t2.RegistrationCard,t2.DeliveryMethod,IDPhoto,Photo,title,Gender,Equity,CitizenResidentStatus,Nationality,Language,DisabilityStatus,DateofBirth,fname,lname,IDNo,Alternate,ResidentialStreet,Province,ResidentialCity,ResidentialSuburb,PostalAddress,PostalProvince,PostalCity,PostalSuburb,PostalCode,homePhone,contact,BusinessPhone,secondContact,Email,SecondEmail,SocioeconomicStatus,company,Designation,DeclarationName,DeclarationIDNumber');
			    $this->db->join('newapplications AS t2', 't1.UserID = t2`.UserID','inner');
			    $this->db->where('t1.UserID',$id);
			    $res = $this->db->get('users AS t1')->row_array();
			    if($res['DateofBirth']!=''){
			    	$res['DateofBirth'] = date('d/m/Y',strtotime($res['DateofBirth']));
			    }
			    if($res['Nationality']>0){
			    	$res['ResidentStatus'] = 0;
			    	$data['nationality_show'] = 1;
			    } else {
			    	$res['ResidentStatus'] = 1;
			    	$data['nationality_show'] = 0;
			    }
			    $data['res'] = $res;

 			}
 			
 			
 			$empty_arr = $this->config->item('empty_arr');
 			$data['empty_arr'] = $empty_arr;
 			$data['yes_no_arr'] = $empty_arr+$this->config->item('yes_no_arr');
 			$data['delivery_method_arr'] = $empty_arr+$this->config->item('delivery_method_arr');
 			$data['title_arr'] = $empty_arr+$this->config->item('title_arr');
 			$data['racialstatus_arr'] = $empty_arr+$this->config->item('racialstatus_arr');    
 			$data['gender_data'] = $empty_arr+$this->config->item('gender_arr'); 
 			$data['employment_status_data'] = $empty_arr+$this->config->item('employment_status_arr'); 
 			//$data['nationality_arr'] = $empty_arr+$this->config->item('nationality_arr');
 			
 			$data['nationality_arr'] = $this->commonModel->config('nationality_arr');
 			$data['home_language_arr'] = $this->commonModel->config('home_language_arr');
 			$data['disability_arr'] = $this->commonModel->config('disability_arr');
 			$data['resident_status_arr'] = $this->commonModel->config('resident_status_arr');
 			$data['designation_arr'] = $this->commonModel->config('designation_arr','radio');
 			
 			$data['application_update']['application_status_arr'] = $this->commonModel->config('application_status_arr','checkbox');
 			$data['application_update']['approve_arr'] = $this->config->item('approve_arr');

 			$province_field_arr = array('field'=>'province');
 			$data['province_data'] = $this->commonModel->set_selectbox_data($province_field_arr);
 			
 			$city_field_arr = array('field'=>'city','sel_val'=>$res['Province']);
 			$data['city_data'] = $this->commonModel->set_selectbox_data($city_field_arr);

 			$phy_city_field_arr = array('field'=>'city','sel_val'=>$res['PostalProvince']);
 			$data['phy_city_data'] = $this->commonModel->set_selectbox_data($phy_city_field_arr);

 			/*$cmp_city_field_arr = array('field'=>'city','sel_val'=>set_value('cmpProvince'));
 			$data['cmp_city_data'] = $this->commonModel->set_selectbox_data($cmp_city_field_arr);

 			$cmp_postal_city_arr = array('field'=>'city','sel_val'=>set_value('cmpPostalProvince'));
 			$data['cmp_postal_city_data'] = $this->commonModel->set_selectbox_data($cmp_postal_city_arr);*/

 			$area_arg = array('field'=>'area','sel_val'=>$res['ResidentialCity']);
 			$data['area_data'] = $this->commonModel->set_selectbox_data($area_arg);

 			$postal_area_arg = array('field'=>'area','sel_val'=>$res['PostalCity']);
 			$data['phy_area_data'] = $this->commonModel->set_selectbox_data($postal_area_arg); 	

 			/*$cmp_area_arg = array('field'=>'area','sel_val'=>set_value('cmpCity'));
 			$data['cmp_area_data'] = $this->commonModel->set_selectbox_data($cmp_area_arg);

 			$cmp_postal_area_arg = array('field'=>'area','sel_val'=>set_value('cmpPostalCity'));
 			$data['cmp_postal_area_data'] = $this->commonModel->set_selectbox_data($cmp_postal_area_arg);*/

			$company_field_arr = array('field'=>'company');			
 			$company_data = $this->commonModel->set_selectbox_data($company_field_arr);
 			array_splice( $company_data, 1, 0, array('New company') ); 			
 			$data['company_data'] = $company_data;

 			

        	if ($this->form_validation->run() == TRUE || !empty($_POST)) {

        		$config['upload_path']          = './uploads/certificates/';
	            $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|tiff';
	            $config['max_size']             = 2000;
	            // $config['max_width']            = 1300;
	            // $config['max_height']           = 1024;

	            $users = array();

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('Photo')){
	            	$photo_upload_data = $this->upload->data();	
	            	$users['Photo'] = $photo_upload_data['file_name'];
	            } else {
	            	echo $this->upload->display_errors();
	            }

	            if($this->upload->do_upload('IDPhoto')){
	            	$id_photo_upload_data = $this->upload->data();	
	            	$users['IDPhoto'] = $id_photo_upload_data['file_name'];
	            }
	            //	exit;

        		$newapplications_fields = array(
        			'RegistrationCard',
					'DeliveryMethod',
					'Designation',
					'DeclarationName',
					'DeclarationIDNumber',
					'ProcedureRegistration',
					'CodeConduct',
					'Acknowledgement',
					'Declaration',
        		);
        		$newapplications = array();								
				foreach($newapplications_fields as $key=>$val){
					if(is_string($key)==TRUE){
						$newapplications[$key] = $val;	
					} else {
						$post_val = $this->input->post($val);
						$newapplications[$val] = $post_val;
					}
				}
				$data['newapplications'] = $newapplications;
    
				$users_fields = array(
					'title',
					'DateofBirth',
					'fname',
					'lname',
					'Gender',
					'Equity',		
					'IDNo',							
					'Nationality',					
					'Alternate',							 
					'Language',
					'DisabilityStatus',
					'ResidentialStreet',
					'PostalAddress',
					'PostalCode',
					'homePhone',
					'contact',
					'BusinessPhone',
					'secondContact',
					'Email',
					'SecondEmail',
					'company',
					'Province',
					'PostalProvince',
					'ResidentialCity',
					'PostalCity',
					'ResidentialSuburb',
					'PostalSuburb',
					'SocioeconomicStatus',
				);
								
				foreach($users_fields as $key=>$val){
					if(is_string($key)==TRUE){
						$users[$key] = $val;	
					} else {
						$post_val = $this->input->post($val);
						if($val=='DateofBirth'){
							if($post_val!=''){
								$post_val = date('Y-d-m',strtotime($post_val));
							}
						}						
						$users[$val] = $post_val;
						if($val=='company'){
							if($post_val<0){
								unset($users[$val]);
							}
						}
					}
				}

				if($this->input->post('CitizenResidentStatus')==1){
					$users['CitizenResidentStatus'] = 4;
				} else{
					$users['CitizenResidentStatus'] = $this->input->post('ResidentStatus');
				}
				
				$data['users'] = $users;

				$companies = array();	

				
				$data['companies'] = $companies;

				//	$this->plumberModel->insert_data($data);
				$this->plumberModel->update_data($data);
				$this->session->set_flashdata('msg', 'Plumber is Updated successfully');			
				redirect("/plumber/update/$id");
      		}
      		$data['application_update']['Designation'] = $res['Designation'];
      		$data['application_update']['designation_arr'] = $data['designation_arr'];
      		
      		//	$this->load->view('plumber/update', $data);

      		$data['main_content'] = $this->load->view('plumber/update_test', $data, TRUE);	    
	 	   	$this->load->view('admin/index', $data);
	}

	public function list()
	{
		$data = array();
		$this->db->select('UserID,fname,lname,CreateDate');
	    $this->db->from('users');
	    $this->db->where('role',2);
	    $this->db->order_by('CreateDate','DESC');
	    $query = $this->db->get();

	    $data['res'] = $query->result_array();
        $data['page_title'] = 'New application - Plumber';        
        $data['main_content'] = $this->load->view('plumber/list', $data, TRUE);	    
	    $this->load->view('admin/index', $data);
		//	$this->load->view('plumber/list',$data);
	}

	public function upload(){
		extract($_REQUEST);
		$config['upload_path']          = './uploads/certificates/';
	      $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|tiff';
	      $config['max_size']             = 2000;

		$request = 1;
		if(isset($_REQUEST['request'])){
			$request = $_REQUEST['request'];
		}

		// Upload file
		if($request == 1){
			
	      // $config['max_width']            = 1300;
	      // $config['max_height']           = 1024;

	      $users = array();

	      $this->load->library('upload', $config);

	      if($this->upload->do_upload('file')){
	      	$upload_data = $this->upload->data(); 	      	
	      	//	echo $upload_data['file_name'];
            $_SESSION['certificate'][] = $upload_data['file_name'];
	      	$msg = "Successfully uploaded";
	      }	else {
	      	$error = array('error' => $this->upload->display_errors());
	      	$msg = $error['error'];
	      }
			// $target_file = $target_dir . basename($_FILES["file"]["name"]);

			// $msg = "";
			// if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
			//     $msg = "Successfully uploaded";
			// }else{
			//     $msg = "Error while uploading";
			// }
			echo $msg;
		}

		// Remove file
		if($request == 2){
			$filename = $config['upload_path'].$_POST['name']; 
			if (file_exists($filename)) {				
				unlink($filename); 
				exit;
			}
		}

		if($request == 3){
			//	$target_dir          = 'uploads/certificates/';
			$file_list = array();
			
			// Target directory
			$target_dir = $config['upload_path'];

			$this->db->select('Certificate');
		    $this->db->from('newapplicationcertificates');
		    $this->db->where('UserID',$user_id);
		    $query = $this->db->get();
		    $certificate_data = $query->result_array();


			foreach ($certificate_data as $key => $value) {
				# code...
				$file = $value['Certificate'];
	            if($file != '' && $file != '.' && $file != '..'){

	                // File path
	                //	$file_path = base_url().$target_dir.$file;
	                $file_path = $target_dir.$file;
	 
	                // Check its not folder
	                if(!is_dir($file_path) && file_exists($file_path)){
	                    
	                    $size = filesize($file_path);
	                    $file_exact_path = "../../uploads/certificates/$file";
	                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_exact_path);
	      
	                }
	            }
				
			}
			echo json_encode($file_list);
			exit;
		}


	}

	public function test_mail(){
		// $this->email->from('manikandan@itflexsolutions.com', 'Your Name');
		// $this->email->to('testmail22890@gmail.com');
		 
		// $this->email->subject('Email Test');
		// $this->email->message('Testing the email class.');
		// if($this->email->send()){
		// 	echo 1;
		// } else {
		// 	echo 0;
		// }

		$this->load->config('email');
        //	$this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = 'testmail228901@gmail.com';
        $subject = 'Email Test';
        $message = 'Testing the email class.';

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
	}

	public function welcome(){
		$data = array();
		//	$data['session'] = $this->session;
		$data['page_title'] = 'Profile - Welcome';        
		$data['plumber_submit_application'] = $this->commonModel->plumber_submit_application();
      	
		if ($this->input->post('update'))
      	{
      		
      	}

        $data['main_content'] = $this->load->view('plumber/welcome', $data, TRUE);	    
	    $this->load->view('admin/index', $data);
	}

	public function personal(){
		$data = array();
		$user = $this->session->userdata;
		$id = $user['usrId'];
		$data['page_title'] = 'Profile - personal';        
		$data['plumber_submit_application'] = $this->commonModel->plumber_submit_application();
      	
      	$data['application_update'] = array();
 			$data['id'] = $id;
 			$data['base_path'] = '../';
 			if($id!=''){
 				$data['base_path'] .= '../';
 				$this->db->select('DateofBirth,Title,ProcedureRegistration,CodeConduct,Acknowledgement,Declaration,t2.RegistrationCard,t2.DeliveryMethod,IDPhoto,Photo,title,Gender,Equity,CitizenResidentStatus,Nationality,Language,DisabilityStatus,DateofBirth,fname,lname,IDNo,Alternate,ResidentialStreet,Province,ResidentialCity,ResidentialSuburb,PostalAddress,PostalProvince,PostalCity,PostalSuburb,PostalCode,homePhone,contact,BusinessPhone,secondContact,Email,SecondEmail,SocioeconomicStatus,company,Designation,DeclarationName,DeclarationIDNumber');
			    //	$this->db->join('newapplications AS t2', 't1.UserID = t2`.UserID','inner');
			    $this->db->where('t1.UserID',$id);
			    $res = $this->db->get('users AS t1')->row_array();
			    if($res['DateofBirth']!=''){
			    	$res['DateofBirth'] = date('d/m/Y',strtotime($res['DateofBirth']));
			    }
			    if($res['Nationality']>0){
			    	$res['ResidentStatus'] = 0;
			    	$data['nationality_show'] = 1;
			    } else {
			    	$res['ResidentStatus'] = 1;
			    	$data['nationality_show'] = 0;
			    }
			    $data['res'] = $res;

 			}
 			
 			
 			$empty_arr = $this->config->item('empty_arr');
 			$data['empty_arr'] = $empty_arr;
 			$data['yes_no_arr'] = $empty_arr+$this->config->item('yes_no_arr');
 			$data['delivery_method_arr'] = $empty_arr+$this->config->item('delivery_method_arr');
 			$data['title_arr'] = $empty_arr+$this->config->item('title_arr');
 			$data['racialstatus_arr'] = $empty_arr+$this->config->item('racialstatus_arr');    
 			$data['gender_data'] = $empty_arr+$this->config->item('gender_arr'); 
 			$data['employment_status_data'] = $empty_arr+$this->config->item('employment_status_arr'); 
 			//$data['nationality_arr'] = $empty_arr+$this->config->item('nationality_arr');
 			
 			$data['nationality_arr'] = $this->commonModel->config('nationality_arr');
 			$data['home_language_arr'] = $this->commonModel->config('home_language_arr');
 			$data['disability_arr'] = $this->commonModel->config('disability_arr');
 			$data['resident_status_arr'] = $this->commonModel->config('resident_status_arr');
 			$data['designation_arr'] = $this->commonModel->config('designation_arr','radio');
 			
 			$data['application_update']['application_status_arr'] = $this->commonModel->config('application_status_arr','checkbox');
 			$data['application_update']['approve_arr'] = $this->config->item('approve_arr');

 			$province_field_arr = array('field'=>'province');
 			$data['province_data'] = $this->commonModel->set_selectbox_data($province_field_arr);
 			
 			$city_field_arr = array('field'=>'city','sel_val'=>$res['Province']);
 			$data['city_data'] = $this->commonModel->set_selectbox_data($city_field_arr);

 			$phy_city_field_arr = array('field'=>'city','sel_val'=>$res['PostalProvince']);
 			$data['phy_city_data'] = $this->commonModel->set_selectbox_data($phy_city_field_arr);

 			/*$cmp_city_field_arr = array('field'=>'city','sel_val'=>set_value('cmpProvince'));
 			$data['cmp_city_data'] = $this->commonModel->set_selectbox_data($cmp_city_field_arr);

 			$cmp_postal_city_arr = array('field'=>'city','sel_val'=>set_value('cmpPostalProvince'));
 			$data['cmp_postal_city_data'] = $this->commonModel->set_selectbox_data($cmp_postal_city_arr);*/

 			$area_arg = array('field'=>'area','sel_val'=>$res['ResidentialCity']);
 			$data['area_data'] = $this->commonModel->set_selectbox_data($area_arg);

 			$postal_area_arg = array('field'=>'area','sel_val'=>$res['PostalCity']);
 			$data['phy_area_data'] = $this->commonModel->set_selectbox_data($postal_area_arg); 	

 			/*$cmp_area_arg = array('field'=>'area','sel_val'=>set_value('cmpCity'));
 			$data['cmp_area_data'] = $this->commonModel->set_selectbox_data($cmp_area_arg);

 			$cmp_postal_area_arg = array('field'=>'area','sel_val'=>set_value('cmpPostalCity'));
 			$data['cmp_postal_area_data'] = $this->commonModel->set_selectbox_data($cmp_postal_area_arg);*/

			$company_field_arr = array('field'=>'company');			
 			$company_data = $this->commonModel->set_selectbox_data($company_field_arr);
 			array_splice( $company_data, 1, 0, array('New company') ); 			
 			$data['company_data'] = $company_data;
		if ($this->input->post('update'))
      	{
      		
      	}

        $data['main_content'] = $this->load->view('plumber/personal', $data, TRUE);	    
	    $this->load->view('admin/index', $data);
	}

}

