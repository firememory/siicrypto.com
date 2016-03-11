<?php
use app\extensions\action\Functions;
$function = new Functions();

ini_set('memory_limit', '-1');

$pdf =& $this->Pdf;
$this->Pdf->setCustomLayout(array(
    'header'=>function() use($pdf){
        list($r, $g, $b) = array(200,200,200);
        $pdf->SetFillColor($r, $g, $b); 
        $pdf->SetTextColor(0 , 0, 0);
        $pdf->Cell(0,15, 'Vantu Bank - Declaration of Source of Funds (DSF)', 0,1,'C', 1);
        $pdf->Ln();
    },
    'footer'=>function() use($pdf){
        $footertext = sprintf('Vantu Bank - SiiCrypto.com', date('Y')); 
        $pdf->SetY(-10); 
        $pdf->SetTextColor(0, 0, 0); 
        $pdf->SetFont(PDF_FONT_NAME_MAIN,'', 8); 
        $pdf->Cell(0,8, $footertext,'T',1,'C');
    }

));
$pdf->SetFont('helvetica');
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->SetAuthor('https://SiiCrypto.com');
$pdf->SetCreator('support@SiiCrypto.com');
$pdf->SetSubject('Vantu Bank - Declaration of Source of Funds (DSF)');
$pdf->SetKeywords('SiiCrypto.com, Email Print');
$pdf->SetTitle('SiiCrypto - '.$data['Reference']);


$pdf->SetAutoPageBreak(true);
				$Reference = $data['Reference'];
				$btcword = ucwords($function->number_to_words($value))." BTC";
				$pdf->AddPage('P');
				$pdf->Image(LITHIUM_APP_PATH.'/webroot/img/vantuBank.png', 10, 17, 0, 0, '', '', '', false, 100, '', false, false, 0);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetXY(20,55,false);
				$html = "<div style='text-align:center'>Declaration of Source of Funds (DSF) submitted via email for inward wire payment.<br> Reference No: ".$data['Reference']."</div>";
				$html = $html . "<div><small>Instructions: Please fully complete and sign this form before wiring your funds. <br>When you click the 'Submit' button below a copy will be sent to Vantu Bank immediately.</small></div>";
				
				$html = $html . "<div><small>Note: Vantu Bank's customer service may contact you to authenticate your expected payment. Please make sure the contact details below are valid. If Vantu Bank needs to reach you and is unable to do so within 48 hours your funds may be put on hold. The purpose for the wire must be made clear in order to prevent delays.</small></div>";
				
				$html = $html . '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">DETAILS OF YOUR ACCOUNT AT VANTU BANK LTD.</th>
						</tr>
						<tr>
							<th width="50%"><small>FULL NAME OF YOUR ACCOUNT AT VANTU BANK</small></th>
							<td><small>ILS FIDUCIARIES (SWITZERLAND) SARL</small></td>
						</tr>
						<tr>
							<th><small>FULL ACCOUNT NUMBER OF YOUR ACCOUNT</small></th>
							<td>100-070378-<strong>';
								switch ($data['Currency']){
										case "USD":
										$html = $html. "1"; break;
										case "EUR":
										$html = $html. "2"; break;
										case "GBP":
										$html = $html. "3"; break;
										case "CAD":
										$html = $html. "4"; break;
								}
				$html = $html.'</strong>
							</td>
						</tr><tr>
							<th><small>YOUR FULL NAME</small></th>
							<td>';
				$html = $html.$data['data']['fullName'];
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>YOUR TELEPHONE NAME</small></th>
							<td>';
					$html = $html.$data['data']['telephone'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>YOUR EMAIL ADDRESS</small></th>
							<td>';
					$html = $html.$data['data']['email'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>YOUR TYPE OF OCCUPATION/BUSINESS</small></th>
							<td>';
				$html = $html.$data['data']['occupation'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>REFERENCE (Quote this reference number in your deposit)</small></th>
							<td>';
				$html = $html.$data['data']['Reference'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">DETAILS OF YOUR INWARD WIRE PAYMENT</th>
						</tr>
						<tr>
							<th><small>CURRENCY</small></th>
							<td>';
				$html = $html.$data['data']['currency'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>AMOUNT</small></th>
							<td>';
				$html = $html.number_format($data['data']['amountFiat'],2);							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>AMOUNT (Words)</small></th>
							<td>';
				$Amount = ucwords($function->number_to_words($data['data']['amountFiat']))." ".$data['data']['currency']. " ONLY";				
				$html = $html.$Amount;
				$html = $html.'</td>
						</tr>
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">DETAILS OF THE SENDER OF YOUR INWARD WIRE PAYMENT</th>
						</tr>
						<tr>
							<th><small>FULL NAME OF ORIGINATING PARTY</small></th>
							<td>';
				$html = $html.$data['data']['fullName'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>YOUR FULL PHYSICAL OR STREET ADDRESS</small></th>
							<td>';
					$html = $html.$data['data']['address'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>YOUR CITY, STATE, ZIP Code, COUNTRY</small></th>
							<td>';
					$html = $html.$data['data']['addressDetail'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>ORIGINAL SENDING BANK NAME</small></th>
							<td>';
					$html = $html.$data['data']['bankName'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>ORIGINAL SENDING BANK ADDRESS</small></th>
							<td>';
					$html = $html.$data['data']['bankAddress'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>ORIGINAL SENDING BANK SWIFT CODE</small></th>
							<td>';
					$html = $html.$data['data']['swiftCode'];							
					$html = $html.'</td>
						</tr>
						</table>
						
						<hr>';
						$pdf->writeHTML($html, true, 0, true, 0);
						$pdf->AddPage();
						$pdf->SetXY(20,20,false);
						$html = 'I/We declare that the source of this payment is one of the following:<br>
For "Other", please be specific.</p>';
						$html = $html.'<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
								<tr>
									<td>';
									if($data['data']['sourceEmploymentIncome']=="Yes"){$html = $html."x ";}
						$html = $html.'Employment Income</td><td>';
									if($data['data']['sourceGift']=="Yes"){$html = $html."x ";}
						$html = $html.'Gift</td><td>';
									if($data['data']['sourceGrants']=="Yes"){$html = $html."x ";}
						$html = $html.'Grants/Scholarships</td></tr>
								<tr>
									<td>';
									if($data['data']['sourceInsurance']=="Yes"){$html = $html."x ";}
						$html = $html.'Insurance Claim Payments</td><td>';
									if($data['data']['sourceInvestment']=="Yes"){$html = $html."x ";}
						$html = $html.'Investment Income Savings</td><td>';
									if($data['data']['sourcePension']=="Yes"){$html = $html."x ";}
						$html = $html.'Retirement/Pension Income</td></tr>							
								<tr>
									<td>';
									if($data['data']['sourceSale']=="Yes"){$html = $html."x ";}
						$html = $html.'Sale of Assets</td><td>';
									if($data['data']['sourceTrust']=="Yes"){$html = $html."x ";}
						$html = $html.'Trust/Inheritance</td><td>';
									if($data['data']['sourceLottery']=="Yes"){$html = $html."x ";}
						$html = $html.'Lottery Winnings</td></tr>							
								<tr>
									<td colspan="3">';
									if($data['data']['sourceBusiness']=="Yes"){$html = $html."x ";}
						$html = $html.'Business <small>(If this box is checked you will need to complete the Details of Business Payment section below)</small></td>
								</tr>							
								<tr>
									<td>';
									if($data['data']['sourceOther']=="Yes"){$html = $html."x ";}
									$html = $html.'Other, please be specific: </td>
									<td colspan="2">'.$data['data']['Other'].'</td>
									</tr>
								</table><hr>';
				$html = $html . '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
									<tr>
										<th colspan="2" style="text-align:center;background-color:#CAFFFF">DETAILS OF BUSINESS PAYMENT</th>
									</tr>
									<tr>
										<td width="50%">WHAT IS THE PRINCIPAL BUSINESS ACTIVITY OF THE ORIGINATING PARTY?</td>
										<td>'.$data['data']['Business1'].'</td>
									</tr>
									<tr>
										<td>WHAT IS THE NATURE OF YOUR BUSINESS RELATIONSHIP WITH THE ORIGINATING PARTY?</td>
										<td>'.$data['data']['Business2'].'</td>
									</tr>
									<tr>
										<td>WHAT ARE THE UNDERLYING GOODS OR SERVICES RELATED TO THIS PAYMENT?</td>
										<td>'.$data['data']['Business3'].'</td>
									</tr>
									<tr>
										<td>PLEASE ADVISE THE WEBSITE OF THE ORIGINATING PARTY, IF APPLICABLE</td>
										<td>'.$data['data']['Business4'].'</td>
									</tr>
									<tr>
										<td>WHAT ARE YOUR EXPECTED MONTHLY PAYMENTS FROM THE ORIGINATING PARTY (number and value)?</td>
										<td>'.$data['data']['Business5'].'</td>
									</tr>
									<tr>
									<td colspan="2"><small>If the Details of Business Payment section has been completed then we have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).</small></td>
									</tr>
									</table><hr>
									<div><small>
				<p>I/We have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).</p>
				<p>I/We understand that under the requirements of Vanuatu\'s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank\'s and National Bank of Vanuatu\'s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any inward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation. This payment does not originate from any sanctioned or prohibited country or related sanctioned program.</p>
				<p>I/We declare that the above information is true and correct.</p></small></div>';
				
				$html = $html . 'Date: '.gmdate('Y-M-d H:i:s',time());
				$html = $html . '<div style="text-align:right;"><u>'.$data['data']['fullName'].'</u><br>
				Account Holder\'s Name<br></div>
				<span><small>By typing in your name and then clicking the send button below you agree that this electronic signature confirms that you have adopted the contents of this electronic message and that the person(s) who have completed this Declaration of Source of Funds form is/are the person(s) who wrote it and that the sender of the form is the person(s) described herein.</small></span>
				<div style="padding-left:100px;text-align:right;margin-bottom:10px">
				</div>';
				$html = $html . '<p></p>';
				$html = $html . '<div style="text-align:right;margin-bottom:220px">Please sign here:______________________________________________<br><u>'.$data['data']['fullName'].'</u><br>
				Account Holder\'s Signature
				</div>';
				$html = $html .'IP: '. $_SERVER['REMOTE_ADDR'];
				$pdf->writeHTML($html, true, 0, true, 0);
				

?>