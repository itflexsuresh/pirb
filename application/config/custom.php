<?php

$config['sitename']	 				= 	'Audit IT';

$config['googleapikey']	 			= 	'AIzaSyD7kpv3FWxlVF2HWBsX6lrJJMGVWucTcoY';

$config['paymentid']				= 	'10018056';
$config['paymentkey']				= 	'u1jqr1spqbpes';
$config['paymenturl']				= 	'https://sandbox.payfast.co.za/eng/process';
//$config['paymenturl']				= 	'https://www.payfast.co.za/eng/process';
//$config['paymentid']				= 	'10140624';
//$config['paymentkey']				= 	'mbmxqajjukwkb';

$config['customstockno']			= 	'444271';


$config['psidconfig']	 			= 	['2', '6'];
$config['roleadmin']	 			= 	'1';
$config['rolesubadmin']	 			= 	'2';
$config['roleplumber']	 			= 	'3';
$config['rolecompany']	 			= 	'4';
$config['roleauditor']	 			= 	'5';
$config['roleresellers']	 		= 	'6';


// Rates Table

$config['learner']	 				= 	'23';
$config['assistant']	 			= 	'3';
$config['operator']	 				= 	'4';
$config['licensed']	 				= 	'6';

$config['cocpaperwork'] 			= 	'13';
$config['cocelectronic'] 			= 	'14';

$config['postage'] 					= 	'2';
$config['couriour'] 				= 	'17';
$config['collectedbypirb'] 			= 	'24';

$config['inspection'] 				= 	'20';

$config['latefee'] 					= 	'10';
$config['cardfee'] 					= 	'11';

// Global Performance Table

$config['verypoor']	 				= 	'2';
$config['poor']	 					= 	'3';
$config['good']	 					= 	'4';
$config['excellent']	 			= 	'5';

$config['plumberverificationyes']	= 	'7';
$config['plumberverificationno']	= 	'8';

$config['cocverificationyes']		= 	'10';
$config['cocverificationno']		= 	'11';

$config['noaudit']					= 	'12';

$config['rollingaverage']			= 	'13';


$config['otpstatus'] 				= 	'1';

$config['usertype1'] 				= 	[
											'plumber' 	=> '3',
											'company' 	=> '4',
											'auditor' 	=> '5',
											'resellers' => '6'
										];
										
$config['usertype2'] 				= 	[
											'3' 	=> 'plumber',
											'4' 	=> 'company',
											'5' 	=> 'auditor',
											'6' 	=> 'resellers'
										];

$config['status'] 					= 	[
											'' 	=> '',
											'1' => 'Active',
											'0' => 'InActive'
										];

$config['statusicon'] 				= 	[
											'' 	=> '',
											'1' => '<i class="fa fa-check"></i>',
											'0' => '<i class="fa fa-times"></i>'
										];


$config['roletype'] 				= 	[
											'1' => 'Administrator',
											'2' => 'Local Authorities',
											'3' => 'Insurance',
											'4' => 'Guest'
										];

$config['messagegroup'] 			= 	[
											'1' => 'PLUMBER MESSAGE',
											'2' => 'AUDITOR MESSAGE',
											'3' => 'RESELLER MESSAGE',
											'4' => 'COMPANY MESSAGE'
										];

$config['helpgroup'] 			= 	[
											'3' => 'PLUMBER',
											'4' => 'COMPANY',
											'5' => 'AUDITOR',
											'6' => 'RESELLER'
										];

$config['cpdstream'] 				= 	[
											'1' => 'Developmental',
											'2' => 'Work-Based',
											'3' => 'Individual'
										];




$config['titlesign'] 				= 	[
											'1' => 'Mr',
											'2' => 'Mrs',
											'3' => 'Miss',
											'4' => 'Other'
										];
										
$config['gender'] 					= 	[
											'1' => 'Male',
											'2' => 'Female'
										];	
										
$config['racial'] 					= 	[
											'' 	=> 'Select Racial Status',
											'1' => 'Black: African',
											'2' => 'Black: Coloured',
											'3' => 'Black: Indian',
											'4' => 'White',
											'5' => 'Unknown'
										];	
										
$config['yesno'] 					= 	[
											'1' => 'Yes',
											'2' => 'No'
										];
										
$config['homelanguage'] 			= 	[
											'' 	=> 'Select Home Language',
											'1' => 'Afrikaans',
											'2' => 'English',
											'3' => 'isiNdebele',
											'4' => 'Other',
											'5' => 'sePedi',
											'6' => 'seSotho',
											'7' => 'seTswana',
											'8' => 'siSwati',
											'9' => 'tshiVenda',
											'10' => 'Unknown',
											'11' => 'isiXhosa',
											'12' => 'xiTsonga',
											'13' => 'isiZulu',
											'14' => 'South African Sign Language'
										];	
										
$config['othernationality'] 		= 	[
											'1' => 'Asian countries',
											'2' => 'Angola',
											'3' => 'Australia Oceania countries',
											'4' => 'Botswana',
											'5' => 'European countries',
											'6' => 'Lesotho',
											'7' => 'Malawi',
											'8' => 'Mauritius',
											'9' => 'Mozambique',
											'10' => 'Namibia',
											'11' => 'North American countries',
											'12' => 'N/A: Institution',
											'13' => 'Other & rest of Oceania',
											'14' => 'Rest of Africa',
											'15' => 'South Africa',
											'16' => 'SADC except SA',
											'17' => 'Seychelles',
											'18' => 'South / Central American countries',
											'19' => 'Swaziland',
											'20' => 'Tanzania',
											'21' => 'Unspecified',
											'22' => 'Zaire',
											'23' => 'Zambia',
											'24' => 'Zimbabwe'
										];
		
$config['disability'] 				= 	[
											'' 	=> 'None',
											'1' => 'Sight (even with glasses)',
											'2' => 'Hearing (even with h. aid)',
											'3' => 'Communication(talk/listen)',
											'4' => 'Physical (move/stand etc)',
											'5' => 'Intellectual (learn etc)',
											'6' => 'Emotional (behav/psych)',
											'7' => 'Multiple',
											'8' => 'Disabled but unspecified',
											'9' => 'None',
											'10' => 'None now - was Sight',
											'11' => 'None now - was Hearing',
											'12' => 'None now - was Communic',
											'13' => 'None now - was Physical',
											'14' => 'None now - was Intellect',
											'15' => 'None now - was Emotional',
											'16' => 'None now - was Multiple',
											'17' => 'None now - was Disabled but unspecified'
										];	
										
$config['citizen'] 					= 	[
											'1' => 'Dual (South African & Other)',
											'2' => 'Other',
											'3' => 'Permanent',
											'4' => 'South African'
										];		
										
$config['deliverycard'] 			= 	[
											'1' => 'Postage',
											'2' => 'Courier',
											'3' => 'Collected at PIRB'
										];
										
$config['employmentdetail'] 		= 	[
											'1' => 'Employed',
											'2' => 'Unemployed'
										];	
										
$config['companydetail'] 			= 	[
											'1' => 'From Data Listing'
										];	
										
$config['designation1'] 			= 	[
											'1' => 	'
													<div class="des_points">
														<label>
														<input type="radio" value="1" name="designation" class="designation" data-radio="radio1"> <p>Learner Plumber</p>
														</label>
														<p>The following designation requirements must be met to hold and/or maintain a Learner Plumber designation;</p>
														<ul>
															<li>Completion of the PIRB induction course;</li>
															<li>Must preferably be employed and must work under the supervision and/or mentorship of a Licensed or Qualified Plumber;</li>
															<li>Provide details of the PIRB Licensed/Qualified Plumber under whose adequate supervision and/or mentorship you will be doing your plumbing training;</li>
															<li>Obtain 10 CPD points over 12-month cycle</li>
															<li>Re-register every 12 months.</li>
														</ul>
														<p>Current Registration Fee : %s</p>
													</div>
													',
											'2' => 	'
													<div class="des_points">
													<label>
														<input type="radio" value="2" name="designation" class="designation"  data-radio="radio1"> <p>Technical Assistant Practitioner</p>
													</label
														<p>The following designation requirements must be met to hold and/or maintain a Technical Assistant Practitioner designation;</p>
														<ul>
															<li>3 Years proven practicing experience in the plumbing industry</li>
															<li>Completion of the PIRB online induction course;</li>
															<li>Obtain 10 CPD points over 12-month cycle</li>
															<li>Re-register every 12 months</li>
														</ul>
														<p>Current Registration Fee : %s</p>
													</div>
													',
											'3' => 	'
													<div class="des_points">
													<label>
														<input type="radio" value="3" name="designation" class="designation"  data-radio="radio1"> <p>Technical Operator Practitioner</p>
													</label>
														<p>The following designation requirements must be met to hold and/or maintain a Technical Operating Practitioner:</p>
														<ul>
															<li>3 Years proven practicing experience in the plumbing industry and respective designation being applied for;</li>
															<li>Completion of the PIRB online induction course;</li>
															<li>Pass the PIRB’s written and/or practical assessment;</li>
															<li>Obtain 10 CPD points over 12-month cycle;</li>
															<li>Re-register every 12 months.</li>
														</ul>
														<p>Current Registration Fee : %s</p>
													</div>
													',
											'4' => 	'
													<div class="des_points">
													<label>
														<input type="radio" value="4" name="designation" class="designation"  data-radio="radio1"> <p>Licensed Plumber</p>
													</label>
														<p>The following designation requirements must be met to hold and/or maintain a Licensed Plumber Designation;</p>
														<ul>
															<li>Must have completed and passed the relevant plumber trade test as specified in the Manpower Training Act Section 28 or 13 and/or have obtained a plumber qualification in terms of the Skills Development Act;</li>
															<li>Completion of the PIRB online induction course; </li>
															<li>Pass PIRB’s practical and/or written board assessment in the 5 Core PIRB designation levels;</li>
															<li>Obtain 25 CPD points over your respective 12-month registration cycle;</li>
															<li>Re-register every 12 months.</li>
														</ul>
														<p>Current Registration Fee : %s</p>
													</div>
													'
										];		
				
$config['designation2'] 			= 	[ 
											'1' => 'Learner Plumber',
											'2' => 'Technical Assistant Practitioner',
											'3' => 'Technical Operator Practitioner',
											'4' => 'Licensed Plumber',
											'5' => 'Qualified Plumber',
											'6' => 'Master Plumber'
										];
				
$config['designation3'] 			= 	[ 
											'1' => 'Learner Plumber',
											'2' => 'Technical Assistant',
											'3' => 'Technical Operator',
											'4' => 'Licensed Plumber',
											'5' => 'Qualified Plumber',
											'6' => 'Master Plumber'
										];
				
$config['criminalact'] 				= 	'<div class="custom-control custom-checkbox"><input type="checkbox" name="criminalact" id="criminalact" class="criminalact custom-control-input " value="1"> <label for="criminalact" class="custom-control-label">I fully understand that providing false information regarding my qualification during this application is a criminal offense and can lead to criminal conviction.</label></div>';

$config['registerprocedure'] 		= 	'
											<div class="des_points">
											<h4 class="card-title">The Registered Procedure</h4>
											<ul>
												<li>All qualifications of any individual applying for registration will be vetted and verified with the various authenticating bodies.</li>
												<li>The applicant will be notified via email/sms/telephone of any discrepancies that are found and the applicants application will be put on hold. The process of the application/registration will only continue once it has been addressed.</li>
												<li>Once the application has been approved a pro-forma invoice for the yearly registration fee will be sent (current yearly registration fees can be found at www.pirb.co.za). The pro-forma invoice will be sent to the contact details that appear on the application/registration form.</li>
												<li>Only once payment has been received, the PIRB will continue with the application and the application will be registered on the PIRB database.</li>
												<li>It the applicant requested a card, the PIRB registration card registration will be sent via registered mail to the postal address that appears on the application form, or alternatively the PIRB Registration Card can also be collected from the PIRB registration office or collection points.</li>
												<li>If the registration card is sent via registered mail the relevant tracking number will be sms’d to the applicant and it will be the applicants responsibility to keep track of the registered mail. Any registered mail returned to PIRB office due to non-collection by the applicant will only be resent if an additional administration fee is paid. Alternatively it can be collected at the PIRB registration office.</li>
												<li>If the application is found to be in order and payment of the invoice has been within a reasonable time, the PIRB registration process should not take longer than 20 working days from receipt of application.</li>
												<li>Further information can be obtained from www.pirb.co.za or you may email registration@pirb.co.za</li>
											</ul>
											</div>
										';
					
$config['acknowledgement'] 			= 	'
											<div class="des_points">
											<h4 class="card-title">Acknowledgement</h4>
											<ul>
												<li>I acknowledge that part of the PIRB registration process, all qualifications of any individual applying for registration is vetted and verified with various authenticating bodies. If it is found that the relevant authenticating bodies have no knowledge or records of the relevant individuals qualification it will be forwarded to the PIRB Steering Committee to be reviewed. Only once the PIRB steering committee have reviewed your trade test result and gave authorization will be the PIRB register the relevant individual. Further to this if the verification bodies at any stage communicate to the PIRB that the relevant individuals qualification is no longer valid for reason beyond the PIRB’s control, the PIRB reserve the right to remove the PIRB status of the registered individual with immediate effect and the PIRB will not be held liable for any possible damages that may arise from this. It will further not be the responsibility of the PIRB to address or follow this up with the authenticating body.</li>
												<li>I acknowledge that plumber registration is an annual registration and that a registration fee is charged for plumber registration and this fee which is subject to change is to be paid into the PIRB bank account before I am to be registered.</li>
												<li>I acknowledge that I must reapply for re-registration, one calendar month before the renewal date that appears on my registration card and that the PIRB reserves the right to level a penalty fee for late registration.</li>
												<li>I acknowledge that the PIRB has the authority to suspend or terminate my registration if I act against the best interest of the PIRB, its aims and objectives and the PIRB’s Plumbers Code of Conduct. I further acknowledge that in the event of a suspension and or termination the PIRB’s reserves the right to notify this fact publically and the reason for the suspension and/or termination.</li>
												<li>I acknowledge that if I register for the designation of a Licensed, I shall agree to issue a PIRB Plumbing Certificate of Compliance (COC) on all plumbing works undertaken as a PIRB Licensed Plumber.</li>
												<li>I acknowledged that the issuing of the PIRB Plumbing COC shall be done in the strict defined terms of the prescribe requirements for issuing of a PIRB Plumbing COC and acknowledge that random audits will take place on the COC’s and that I will give full cooperation in this regard.</li>
												<li>I acknowledge that as a Licensed Plumber if I fail to issue a PIRB Plumbing Certificate of Compliance (COC) for work undertaken, carried out and or work adequately supervised; and a complaint is raised against the said plumbing works and or my actions; and the said plumbing works and or my actions are found to be contra to the PIRB’s Code of Conduct, I may and can be held accountable for all cost incurred in resolving the said complaint.</li>
											</ul>
											</div>
										';
					
$config['codeofconduct'] 			= 	'
											<div class="des_points">
											<h4 class="card-title">PIRBs Code of Conduct</h4>
											<ul>
												<li>PIRB registered plumbers agree to conduct themselves and their business in a professional manner which shall be seen by those they serve as being honourable, transparent and fair.</li>
												<li>PIRB registered plumbers agree to proactively perform, work and act to promote plumbing practices that protect the health and safety of the community and the integrity of the water supply and wastewater systems.</li>
												<li>PIRB registered plumbers agree to promote, protect and encourage the upliftment and advancement of the skills development and training in terms of the National Skills ACT., for themselves and individuals in the plumbing sector or wishing to join the plumbing industry.</li>
												<li>PIRB registered plumbers agree to monitor and enforce compliance with technical standards of plumbing work that comply with all requirements of the relevant SANS codes of practice and regulations set out in the compulsory National Standards of the Water Service Act 1997 Amended (8th June2001) as well as relevant local municipal bylaws.</li>
												<li>PIRB registered plumbers agree to actively promote and support a consistent and effective regulatory plumbing environment throughout South Africa.</li>
												<li>PIRB registered plumbers agree to regularly consult and liaise with the plumbing industry in an open forum free of any political or commercial agenda for the discussion of matters affecting the plumbing industry and the role of plumbing for the well-being of the community and the integrity of the water supply and wastewater systems.</li>
												<li>PIRB registered plumbers agree to promote, monitor and maintain expertise and competencies among our registered and non-registered plumbing professionals.</li>
												<li>PIRB registered Licensed plumbers agree to issue a PIRB Plumbing Certificate of Compliance (COC) on all plumbing works undertaken as a PIRB Licensed Plumber and shall further issue the COC in terms of the prescribe requirements for issuing of a PIRB Plumbing COC.</li>
											</ul>
											</div>
										';		
										
$config['declaration'] 				= 	'
											<div class="info_text">Declare that the information contained in this application, or attached by me to this application, is complete, accurate and true to the best of my knowledge. I further declare that by forwarding this completed application form to the PIRB I am acknowledging that I have read and fully understood what is required of me as a PIRB registered and professional plumber and that I adhere to all aims and objectives of the PIRB and the PIRB’s Plumber Code of Conduct. I give consent for enquiries for verification purposes to be made into any information I have given on this application.</div>
										';


$config['applicationstatus'] 		= 	[
											'1' => 'ID Attached',
											'2' => 'Qualification Verified',
											'3' => 'Proof of Experience',
											'4' => 'Declaration Signed',
											'5' => 'Initial each page',
											'6' => 'Photo Correct',
											'7' => 'Company Details Correct',
											'8' => 'Induction Completed',
											'9' => 'Payment Recieved',
										];

$config['approvalstatus'] 			= 	[
											'1' => 'Approved',
											'2' => 'Rejected'
										];

$config['rejectreason'] 			= 	[
											'1' => 'No Supporting Evidence',
											'2' => 'Cannot Verifiy Qualification/Certificates',
											'3' => 'No Payment Recieved',
											'4' => 'Other',
										];			

$config['companyrejectreason'] 		= 	[
											'1' => 'Cannot Verifiy',
											'2' => 'Other',
										];			

$config['plumberstatus'] 			= 	[
											'0' => 'Pending',
											'1' => 'Active',
											'2' => 'CPD Suspention',
											'3' => 'Expired',
											'4' => 'Deceased',
											'5' => 'Resigned',
											'6' => 'Suspended'
										];

$config['auditorstatus'] 			= 	[
											'0' => 'Pending',
											'1' => 'Active',
											'2' => 'Inactive'
										];

$config['qualificationtype'] 		= 	[
											'1' => 'Learner Plumber',
											'2' => 'Technical Assistant',
											'3' => 'Technical Operator',
											'4' => 'Licensed Plumber',
											'5' => 'Qualified Plumber',
											'6' => 'Master Plumber',
											'7' => 'Solar',
											'8' => 'Gas',
											'9' => 'Plumbing estimator',
											'10' => 'Heat Pump',
											'11' => 'Plumbing Training Assessor',
											'12' => 'Plumbing Arbitrator'
										];
										
$config['companystatus'] 			= 	[
											'0' => 'Pending',
											'1' => 'Active',
											'2' => 'Expired',
											'3' => 'Suspended',
											'4' => 'Closed Down'
										];
										
$config['specialisations'] 			= 	[
											'1' => 'Solar',
											'2' => 'Gas',
											'3' => 'Plumbing estimator',
											'4' => 'Heat Pump',
											'5' => 'Plumbing Training Assessor',
											'6' => 'Plumbing Arbitrator',
										];			

$config['worktype'] 				= 	[
											'1' => 'Maintenance - Residential',
											'2' => 'Maintenance - Industrial',
											'3' => 'Maintenance - Commercial',
											'4' => 'Construction - Residential',
											'5' => 'Construction - Industrial',
											'6' => 'Construction - Commercial',
											'7' => 'Construction - Civil Works'
										];
				
$config['specialization'] 			= 	[
											'1' => 'Leak Detection',
											'2' => 'Drain Cleaning',
											'3' => 'Solar Water Heating',
											'4' => 'Heat Pumps',
											'5' => 'Gas',
											'6' => 'Bathroom renovations'
										];					


$config['purchasecocdelivery'] 		= 	[
											'1' => 'Collected at PIRB',
											'2' => 'By Courier',
											'3' => 'By Registered Post'
										];					


$config['coctype'] 					= 	[											
											'1' => 'Electronic',
											'2' => 'Paper Based'
										];
				
$config['coctype2'] 				= 	[
											'0' => '',
											'1' => 'Electronic',
											'2' => 'Paper Based'
										];
										
$config['payment_status'] 			=	[
											'0'	=>	'Not Paid',
											'1'	=>	'Paid'
										];
										
$config['payment_status2'] 			=	[
											'0'	=>	'Unpaid',
											'1'	=>	'Paid'
										];
								
$config['cocstatus'] 			=		[
											'1'	=>	'Admin Stock',
											'2'	=>	'Logged',
											'3'	=>	'Allocated (Reseller)',
											'4'	=>	'Allocated (Plumber)',
											'5'	=>	'Non-Logged Allocated (Customer)',
											'6'	=>	'Recalled (unallocated)',
											'7' => 	'Cancelled'
										];
								
$config['cocrecall'] 			=		[
											'1'	=>	'Recalled',
											'2'	=>	'Cancelled',
											'3'	=>	'Reallocated'
										];
														
$config['cocreason'] 			=		[
											'1'	=>	'Lost',
											'2'	=>	'Stolen',
											'3'	=>	'Destroyed'
										];
										
$config['auditstatus'] 			=		[
											'1'		=>	'Audit Complete',
											'2'		=>	'Pending',
											'3'		=>	'Refix Required',
											'4'		=>	'Audit Complete (Refix Incomplete)',
											'5'		=>	'On hold'
										];
										
$config['audits_status1'] 		= 		[
											'1' => 'Available',
											'2' => 'Unavailable'
										];

$config['workmanship'] 			= 		[
											'1' => 'Very Poor',
											'2' => 'Poor',
											'3' => 'Good',
											'4' => 'Excellent'
										];

$config['reviewtype'] 			= 		[
											'1' => 'Failure',
											'2' => 'Cautionary',
											'3' => 'Compliment',
											'4' => 'No Audit Findings'
										];										

$config['diary'] 				= 		[
											'1' => 'Registered successfully.',
											'2' => 'Application is approved.',
											'3' => 'Application is rejected.',
											'4' => 'Profile updated successfully.',
											'5' => 'Purchased COC',
											'6' => 'Allocated COC',
											'7' => 'COC Logged',
											'8' => 'Auditor Allocated',
											'9' => 'Auditor Review Completed',
											'10' => 'Auditor Review Completed with refix',
										];	

$config['invtype'] 				= 		[
											'1' => 'CoC Purchase',
											'2' => 'Panorama',
											'3' => 'Renewal Alert 2',
											'4' => 'Late Fee Alert'
										];	

$config['ncnotice'] 			= 		[
											'' 	=> 'Select one of the following options',
											'1' => 'Not Applicable',
											'2' => 'Yes',
											'3' => 'No'
										];	

$config['cocauditstatus'] 		=		[
											'1'		=>	'Admin Stock',
											'2'		=>	'Logged',
											'3'		=>	'Allocated (Reseller)',
											'4'		=>	'Allocated (Plumber)',
											'5'		=>	'Non-Logged Allocated (Customer)',
											'6'		=>	'Recalled (unallocated)',
											'7' 	=> 	'Cancelled',
											'8'		=>	'Audit Complete',
											'9'		=>	'Pending (Audit)',
											'10'	=>	'Refix Required',
											'11'	=>	'Audit Complete (Refix Incomplete)',
											'12'	=>	'On hold'
										];
										
$config['currency'] 			= 		'R';

