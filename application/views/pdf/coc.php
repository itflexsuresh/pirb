<?php

function base64conversion($path){
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	return 'data:image/' . $type . ';base64,' . base64_encode($data);
}

function currencyconvertor($currency){
	$amount 	= number_format(floor($currency*100)/100, 2,".","");
	$lastchr	= $amount[strlen($amount)-1];
	
	if($lastchr < 5){
		$amount[strlen($amount)-1] = '0';
	}else{
		$amount[strlen($amount)-1] = '5';
	}
	
	return $amount;
}
?>

<html>
<head>
  <title>PDF Invoice Plumber COC</title>
</head>

<style type="text/css">
  
  td {
    width: 50%;
  }
  body {
    font-family: "Segoe UI";
  }         
  table.custom_reg_uniq th, table.regist_fee_uniq th {
    border: 1px solid #000;
    border-bottom: 0;
    border-right: 0px;
  }
  table.custom_reg_uniq td, table.regist_fee_uniq td {
    border: 1px solid #000;
    border-right: 0px;
  }
  table.custom_reg_uniq th:last-child, table.regist_fee_uniq th:last-child{
    border-right: 1px solid #000;
  }
  table.custom_reg_uniq td:last-child, table.regist_fee_uniq td:last-child{
    border-right: 1px solid #000;
  }
  table.invoice_uniq, table.custom_reg_uniq, table.regist_fee_uniq, table.total_uniq, table.comp_detail_uniq, 
  table.bill_detail_uniq, table.term_uniq {
    border-collapse: collapse;
  }
  table.comp_detail_uniq *, table.bill_detail_uniq *{
    padding-left: 10px;
    padding-right: 10px;
  }

</style>

<?php
$invoiceDate  = date("d-m-Y", strtotime($rowData['created_at']));
$VAT          = $settings["vat_percentage"];
$currency    	= $this->config->item('currency');

  if ($rowData['coc_type'] == '1') {
    $coc_type_id = 13;
    $delivery_rate['amount'] = 0;
    $PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();
	$courierdetails = "";
  }elseif($rowData['coc_type'] == '2'){
		$coc_type_id = 14;
		if ($rowData['delivery_type'] == '1') {
		  $delivery_method = 24;
		}elseif ($rowData['delivery_type'] == '2') {
		  $delivery_method = 17;
		}elseif ($rowData['delivery_type'] == '3') {
		  $delivery_method = 2;
		}

		$PDF_rate =  $this->db->select('amount')->from('rates')->where('id',$coc_type_id)->get()->row_array();
		$delivery_rate =  $this->db->select('amount')->from('rates')->where('id',$delivery_method)->get()->row_array();
		
		$courierdetails = '<tr>
		<td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Courier/Regsitered Post Fee</td>				
		<td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;"></td>
		<td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.currencyconvertor($delivery_rate['amount']).'</td>
		<td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;">'.$currency.currencyconvertor($delivery_rate['amount']).'</td>
		</tr>';
    }
  $total_subtotal = $delivery_rate['amount']+$rowData['cost_value'];
  $base_url= base_url();

    if($rowData["status"]=='1'){

         $paid = '<img class="paid" style="width: 250px;" src="'.base64conversion(base_url()."assets/images/paid.png").'">';

         $paid_status = "PAID";
        
      }
      else{

        $paid ='<img class="paid" style="width: 250px;" src="'.base64conversion(base_url()."assets/images/unpaid.png").'">';

        $paid_status = 'UNPAID';
        
      }

    $stringaarr = explode("@@@",$rowData['areas']);
    $provincesettings = explode("@@@",$rowData2['provincesettings']);

  $logo = "".$_SERVER['DOCUMENT_ROOT']."/auditit_new/pirb/assets/images/pitrb-logo.png";
?>


<body>

  <table style="width: 100%; margin: 0 auto; border: 1px solid #000; padding: 0 10px 0 10px;">
    <tbody>

      <tr>
        <td>
          <img class="logo" style="width: 250px; margin-top:10px;" src="<?php echo $logo; ?>">
        </td>

        <td style="vertical-align: top;">
          <table align="right" class="invoice_uniq" style="margin-top:10px;">
            <thead>
              <tr>
                <th style="border: 1px solid #000; padding: 8px 30px 8px 30px;">Invoice Number</th>
                <th style="padding: 8px 30px 8px 30px; border: 1px solid #000;"><?php echo $rowData['inv_id']; ?></th>  
              </tr>             
            </thead>
          </table>

        </td>
      </tr>

      <tr>
        <td style="vertical-align: top;">
          <table class="comp_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 250px;">
            <thead>
              <tr>
                <th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Company Details</th>
              </tr>
            </thead>

            <tbody>
              <tr><td><?php echo $rowData2['address']; ?></td></tr>            
              <tr><td><?php echo $rowData2['name']; ?></td></tr>
              <tr><td><?php echo $rowData2['suburb']; ?></td></tr>
              <tr><td><?php echo $rowData2['city']; ?></td></tr>
              <tr><td><?php echo $rowData1['work_phone']; ?></td></tr>
              <tr><td><?php echo $rowData1['email']; ?></td></tr>
              <tr><td><?php echo $rowData1['reg_no']; ?></td></tr>
              <tr><td><?php echo $rowData1['vat_no']; ?></td></tr>                              
            </tbody>
          </table>
        </td>

        <td>
          <table align="right" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>
                  <?php echo $paid; ?>
                </th> 
              </tr>
            </thead>
          </table>
          
        </td>
      </tr>

      <tr>
        <td>
          <table class="bill_detail_uniq" style="margin-top:10px; border: 1px solid #000; width: 250px;">
            <thead>
              <tr>
                <th style="text-align: left; border-bottom: 1px solid #000; padding-bottom: 5px; padding-top: 5px;">Billing Details</th>
              </tr>
            </thead>

            <tbody>
              <tr><td><?php echo $rowData['address']; ?></td></tr>            
              <tr><td><?php echo $stringaarr[6]; ?></td></tr>
              <tr><td><?php echo $stringaarr[5]; ?></td></tr>
              <tr><td><?php echo $stringaarr[4]; ?></td></tr>
              <tr><td><?php echo $rowData['email2']; ?></td></tr>
              <tr><td><?php echo $rowData['reg_no'] ?></td></tr>
              <tr><td><?php echo $rowData['vat_no']; ?></td></tr>
            </tbody>
          </table>
        </td>

        <td style="vertical-align: top;">
          <table align="right" class="custom_reg_uniq" style="margin-top: 10px;">
            <thead>
              <tr>
                <th style="padding: 10px;   font-size: 14px; text-align: center;">Customer Company Reg</th>
                <th style="padding: 10px;   font-size: 14px; text-align: center;">Customer VAT Reg</th>
                <th style="padding: 10px;   font-size: 14px; text-align: center;">Invoice Date</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td style="padding: 10px;   font-size: 14px; text-align: center;"><?php echo $rowData['reg_no']; ?></td>
                <td style="padding: 10px;   font-size: 14px; text-align: center;"><?php echo $rowData['vat_no']; ?></td>
                <td style="padding: 10px;   font-size: 14px; text-align: center;"><?php echo $invoiceDate; ?></td>
              </tr>
            </tbody>

          </table>
        </td>
      </tr>

      <tr>
        <td>
          <table style="border: 1px solid #000;margin-top: 10px;" class="term_uniq">
            <thead>
              <tr>
                <th style="border-bottom: 1px solid #000; padding:5px 30px;text-align: center;">
                  Terms
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: center; padding:10px 30px;">
                  COD 
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>

      <tr>
        <td colspan="2">
          <table class="regist_fee_uniq" style="margin-top: 10px; width: 100%">
            <thead>
              <tr>  
                <th style="width: 50%;  margin: 0; padding: 10px 0 10px 0; text-align: center;">Description</th>
                <th style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">QTY</th>
                <th style="width: 19%; margin: 0; padding: 10px 0 10px 0;text-align: center;">Rate</th>
                <th style="width: 18%;  margin: 0; padding: 10px 0 10px 0;text-align: center;">Amount</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td style="width: 50%;  margin: 0; padding: 10px 0 10px 5px;">Purchase of <?php echo $rowData['quantity']; ?> PIRB Certificate of Compliance</td>       
                <td style="width: 10%;  margin: 0; padding: 10px 0 10px 0;text-align: center;"><?php echo $rowData['quantity']; ?></td>
                <td style="width: 19%; margin: 0; padding: 10px 0 10px 0;    text-align: center;"><?php echo $currency.currencyconvertor($PDF_rate['amount']); ?></td>
                <td style="width: 18%;  margin: 0; padding: 10px 0 10px 0;    text-align: center;"><?php echo $currency.$rowData['cost_value']; ?></td>
              </tr>
			
			  <?php echo $courierdetails; ?>

            </tbody>
          </table>  
        </td>
      </tr>

      <tr>
        <td>
          <table style="margin-top: 10px;">
            <thead>
              <tr>
                <th style="text-align: left;">Banking Detail</th>
              </tr>
            </thead>

            <tbody>
              <tr><td><?php echo $rowData1['bank_name']; ?></td></tr>            
              <tr><td><?php echo $rowData1['branch_code']; ?></td></tr>
              <tr><td><?php echo $rowData1['account_name']; ?></td></tr>
              <tr><td><?php echo $rowData1['account_no']; ?></td></tr>
              <tr><td><?php echo $rowData1['account_type']; ?></td></tr>
            </tbody>
          </table>
        </td>

        <td style="vertical-align: top;">
          <table align="right" class="total_uniq" style="margin-top: 10px;">
            <tbody>

              <tr style="text-align: center;">
                <td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">Sub Total</td>
                <td style="margin: 0; padding: 5px 50px; border: 1px solid #000; "><?php echo $currency.currencyconvertor($total_subtotal); ?></td>
              </tr>

              <tr style="text-align: center;">
                <td style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">VAT <?php echo ' '.$VAT; ?>%</td>
                <td style="margin: 0; padding: 5px 50px; border: 1px solid #000; "><?php echo $currency.$rowData['vat']; ?></td>
              </tr>

              <tr style="text-align: center;">
                <td bgcolor="#ccc" style="margin: 0; padding: 5px 25px; border: 1px solid #000; font-weight: bold;">Total</td>
                <td bgcolor="#ccc" style="margin: 0; padding: 5px 50px; border: 1px solid #000;"><?php echo $currency.$rowData['total_due']; ?></td>
              </tr>

            </tbody>
          </table>
        </td>

      </tr>

    </tbody>
  </table>


</body>
</html>

