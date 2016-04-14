<?php
use lithium\g11n\Message;
extract(Message::aliases());
use app\extensions\action\Functions;
$function = new Functions();
use lithium\core\Environment; 

$locales = Environment::get('locales');

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
				
				$pdf->AddPage('P');
				$pdf->Image(LITHIUM_APP_PATH.'/webroot/img/vantuBank.png', 10, 17, 0, 0, '', '', '', false, 100, '', false, false, 0);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetXY(20,55,false);
				
				if($locale!='en'){
					$html = $html . "<strong>* Translation in ". strtoupper($locale).": ".$locales[$locale]." language</strong>";
				}
				$html = $html . "<div style='text-align:center'>Declaration of Source of Funds (DSF) submitted via email for inward wire payment.";
				if($locale!='en'){
					$html = $html . "<br>* ".$t('Declaration of Source of Funds (DSF) submitted via email for inward wire payment.')."";
				}
				$html = $html . "<br>Reference No: ".$data['Reference']."</div>";
 			
				$html = $html . "<div><small>"."Instructions: Please fully complete and sign this form before wiring your funds.";
				if($locale!='en'){
					$html = $html . "<br>* ".$t('Instructions: Please fully complete and sign this form before wiring your funds.')."";
				}
				$html = $html . "</small></div>";
				
				$html = $html . "<div><small>Note: Vantu Bank's customer service may contact you to authenticate your expected payment. Please make sure the contact details below are valid. If Vantu Bank needs to reach you and is unable to do so within 48 hours your funds may be put on hold. The purpose for the wire must be made clear in order to prevent delays.";
				if($locale!='en'){
					$html = $html . "* <br>".$t("Note: Vantu Bank's customer service may contact you to authenticate your expected payment. Please make sure the contact details below are valid. If Vantu Bank needs to reach you and is unable to do so within 48 hours your funds may be put on hold. The purpose for the wire must be made clear in order to prevent delays.")."<br>";
				}
				$html = $html . "</small></div>";
				
				$html = $html . '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">';
							$html = $html . 'DETAILS OF YOUR ACCOUNT AT VANTU BANK LTD.';
							if($locale!='en'){
								$html = $html . '<br>* '.$t('DETAILS OF YOUR ACCOUNT AT VANTU BANK LTD.');
							}
							$html = $html . '</th>
						</tr>
						<tr>
							<th width="50%"><small>';
							$html = $html . 'FULL NAME OF YOUR ACCOUNT AT VANTU BANK';
							if($locale!='en'){
								$html = $html .'<br>* '. $t('FULL NAME OF YOUR ACCOUNT AT VANTU BANK');
							}
							$html = $html . '</small></th>
							<td><small>ILS FIDUCIARIES (SWITZERLAND) SARL</small></td>
						</tr>
						<tr>
							<th><small>';
							$html = $html . 'FULL ACCOUNT NUMBER OF YOUR ACCOUNT';
							if($locale!='en'){
								$html = $html .'<br>* '. $t('FULL ACCOUNT NUMBER OF YOUR ACCOUNT');
							}
							$html = $html .'</small></th>
							<td>ACC '.$data['Currency'].'-100-070378-<strong>';
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
							<th><small>';
							$html = $html.'YOUR FULL NAME';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR FULL NAME');
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['fullName'];
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'YOUR TELEPHONE NUMBER';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR TELEPHONE NUMBER');
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['telephone'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'YOUR EMAIL ADDRESS';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR EMAIL ADDRESS');
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['email'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'YOUR TYPE OF OCCUPATION/BUSINESS';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR TYPE OF OCCUPATION/BUSINESS');
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['occupation'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'REFERENCE (Quote this reference number in your deposit)';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('REFERENCE (Quote this reference number in your deposit)');
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['Reference'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">';
							$html = $html.'DETAILS OF YOUR INWARD WIRE PAYMENT';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('DETAILS OF YOUR INWARD WIRE PAYMENT');
							}
							$html = $html.'</th>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'CURRENCY';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('CURRENCY');
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['currency'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'AMOUNT';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('AMOUNT');
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.number_format($data['data']['amountFiat'],2);							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'AMOUNT (Words)';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('AMOUNT (Words)');
							}
							$html = $html.'</small></th>
							<td>';
				$Amount = ucwords($function->number_to_words($data['data']['amountFiat']))." ".$data['data']['currency']. " ONLY";				
				$html = $html.$Amount;
				$html = $html.'</td>
						</tr>';
							if($locale!='en'){
								$html = $html . '</table>';
								$pdf->writeHTML($html, true, 0, true, 0);
								$pdf->AddPage();
								$pdf->SetXY(20,20,false);
								$html =  '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >';
							}
						$html = $html.'<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">';
							$html = $html.'DETAILS OF THE SENDER OF YOUR INWARD WIRE PAYMENT';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('DETAILS OF THE SENDER OF YOUR INWARD WIRE PAYMENT');
							}
							$html = $html.'</th>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'FULL NAME OF ORIGINATING PARTY';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('FULL NAME OF ORIGINATING PARTY');
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['fullName'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'YOUR FULL PHYSICAL OR STREET ADDRESS';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR FULL PHYSICAL OR STREET ADDRESS');
							}
								$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['address'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'YOUR CITY, STATE, ZIP Code, COUNTRY';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR CITY, STATE, ZIP Code, COUNTRY');
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['addressDetail'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'ORIGINAL SENDING BANK NAME';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('ORIGINAL SENDING BANK NAME');
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['bankName'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'ORIGINAL SENDING BANK ADDRESS';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('ORIGINAL SENDING BANK ADDRESS');
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['bankAddress'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'ORIGINAL SENDING BANK SWIFT CODE';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('ORIGINAL SENDING BANK SWIFT CODE');
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['swiftCode'];							
					$html = $html.'</td>
						</tr>
						</table>
						<hr>';
							if($locale=='en'){
								$pdf->writeHTML($html, true, 0, true, 0);
								$pdf->AddPage();
								$pdf->SetXY(20,20,false);
								$html = 'I/We declare that the source of this payment is one of the following:
For "Other", please be specific.</p>';
							}else{
								$html = $html .'<br><br>';
								$html = $html . 'I/We declare that the source of this payment is one of the following:<br>';
								$html = $html .'<small>* '.$t('I/We declare that the source of this payment is one of the following:').'</small>';
								$html = $html .'<br>';
								$html = $html . 'For "Other", please be specific.<br>';		
								$html = $html .'<small>* '. $t('For "Other", please be specific.').'</small>';		
								$html = $html .'<br>';
							}
						
						$html = $html.'<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
								<tr>
									<td>';
									if($data['data']['sourceEmploymentIncome']=="Yes"){$html = $html."x ";}
									$html = $html.'Employment Income';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Employment Income').'</small>';
										}
						$html = $html.'</td><td>';
									if($data['data']['sourceGift']=="Yes"){$html = $html."x ";}
						$html = $html.'Gift';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Gift').'</small>';
										}
						$html = $html.'</td><td>';
									if($data['data']['sourceGrants']=="Yes"){$html = $html."x ";}
						$html = $html.'Grants/Scholarships';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Grants/Scholarships').'</small>';
										}
						$html = $html.'</td></tr>
								<tr>
									<td>';
									if($data['data']['sourceInsurance']=="Yes"){$html = $html."x ";}
									$html = $html.'Insurance Claim Payments';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Insurance Claim Payments').'</small>';
										}
						$html = $html.'</td><td>';
									if($data['data']['sourceInvestment']=="Yes"){$html = $html."x ";}
						$html = $html.'Investment Income Savings';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Investment Income Savings').'</small>';
										}
						$html = $html.'</td><td>';
									if($data['data']['sourcePension']=="Yes"){$html = $html."x ";}
						$html = $html.'Retirement/Pension Income';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Retirement/Pension Income').'</small>';
										}
						$html = $html.'</td></tr>							
								<tr>
									<td>';
									if($data['data']['sourceSale']=="Yes"){$html = $html."x ";}
									$html = $html.'Sale of Assets';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Sale of Assets').'</small>';
										}
						$html = $html.'</td><td>';
									if($data['data']['sourceTrust']=="Yes"){$html = $html."x ";}
									$html = $html.'Trust/Inheritance';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Trust/Inheritance').'</small>';
										}
						$html = $html.'</td><td>';
									if($data['data']['sourceLottery']=="Yes"){$html = $html."x ";}
						$html = $html.'Lottery Winnings';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Lottery Winnings').'</small>';
										}
						$html = $html.'</td></tr>							
								<tr>
									<td colspan="3">';
									if($data['data']['sourceBusiness']=="Yes"){$html = $html."x ";}
						$html = $html.'Business <small>(If this box is checked you will need to complete the Details of Business Payment section below)</small>';
										if($locale!='en'){
											$html = $html.'<br><small>*'.$t('Business (If this box is checked you will need to complete the Details of Business Payment section below)').'</small>';
										}
										
							$html = $html.'</td>
								</tr>							
								<tr>
									<td>';
									if($data['data']['sourceOther']=="Yes"){$html = $html."x ";}
									$html = $html.'Other, please be specific';
										if($locale!='en'){
											$html = $html.'<br><small>* '.$t('Other, please be specific').'</small>';
										}
									$html = $html.': </td>
									<td colspan="2">'.$data['data']['Other'].'</td>
									</tr>
								</table><hr>';
				$html = $html . '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
									<tr>
										<th colspan="2" style="text-align:center;background-color:#CAFFFF">';
										$html = $html . 'DETAILS OF BUSINESS PAYMENT';
										if($locale!='en'){
											$html = $html . '<br><small>* '.$t('DETAILS OF BUSINESS PAYMENT').'</small>';
										}
										$html = $html . '</th>
									</tr>
									<tr>
										<td width="50%">';
										$html = $html . 'WHAT IS THE PRINCIPAL BUSINESS ACTIVITY OF THE ORIGINATING PARTY?';
										if($locale!='en'){
											$html = $html . '<br><small>* '.$t('WHAT IS THE PRINCIPAL BUSINESS ACTIVITY OF THE ORIGINATING PARTY?').'</small>';
										}
											$html = $html . '</td>
										<td>'.$data['data']['Business1'].'</td>
									</tr>
									<tr>
										<td>';
										$html = $html . 'WHAT IS THE NATURE OF YOUR BUSINESS RELATIONSHIP WITH THE ORIGINATING PARTY?';
										if($locale!='en'){
											$html = $html . '<br><small>* '.$t('WHAT IS THE NATURE OF YOUR BUSINESS RELATIONSHIP WITH THE ORIGINATING PARTY?').'</small>';
										}
										$html = $html . '</td>
										<td>'.$data['data']['Business2'].'</td>
									</tr>
									<tr>
										<td>';
										$html = $html . 'WHAT ARE THE UNDERLYING GOODS OR SERVICES RELATED TO THIS PAYMENT?';
										if($locale!='en'){
											$html = $html . '<br><small>* '.$t('WHAT ARE THE UNDERLYING GOODS OR SERVICES RELATED TO THIS PAYMENT?').'</small>';
										}
										$html = $html . '</td>
										<td>'.$data['data']['Business3'].'</td>
									</tr>';
										if($locale!='en'){
											$html = $html . '</table>';
											$pdf->writeHTML($html, true, 0, true, 0);
											$pdf->AddPage();
											$pdf->SetXY(20,20,false);
											$html =  '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >';
										}
									$html = $html . '<tr>
										<td>';
										$html = $html . 'PLEASE ADVISE THE WEBSITE OF THE ORIGINATING PARTY, IF APPLICABLE';
										if($locale!='en'){
											$html = $html . '<br><small>* '.$t('PLEASE ADVISE THE WEBSITE OF THE ORIGINATING PARTY, IF APPLICABLE').'</small>';
										}
										$html = $html . '</td>
										<td>'.$data['data']['Business4'].'</td>
									</tr>
									<tr>
										<td>';
										$html = $html . 'WHAT ARE YOUR EXPECTED MONTHLY PAYMENTS FROM THE ORIGINATING PARTY (number and value)?';
										if($locale!='en'){
											$html = $html . '<br><small>* '.$t('WHAT ARE YOUR EXPECTED MONTHLY PAYMENTS FROM THE ORIGINATING PARTY (number and value)?').'</small>';
										}
										$html = $html . '</td>
										<td>'.$data['data']['Business5'].'</td>
									</tr>
									<tr>
									<td colspan="2"><small>';
									$html = $html . 'If the Details of Business Payment section has been completed then we have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).';
									if($locale!='en'){
										$html = $html . '<br>* '. $t('If the Details of Business Payment section has been completed then we have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).');
									}
									$html = $html . '</small></td>
									</tr>
									</table><hr>
									<div><small>
				<p>';
				$html = $html . 'I/We have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).';
									if($locale!='en'){
										$html = $html . '<br>* '. $t('I/We have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).');
									}
				$html = $html . '</p>
				<p>';
				$html = $html . 'I/We understand that under the requirements of Vanuatu\'s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank\'s and National Bank of Vanuatu\'s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any inward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation. This payment does not originate from any sanctioned or prohibited country or related sanctioned program.';
				if($locale!='en'){
					$html = $html . '<br>* '. $t('I/We understand that under the requirements of Vanuatu\'s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank\'s and National Bank of Vanuatu\'s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any inward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation. This payment does not originate from any sanctioned or prohibited country or related sanctioned program.');
				}
				$html = $html . '</p>
				<p>';
				$html = $html . 'I/We declare that the above information is true and correct.';
				if($locale!='en'){
					$html = $html . '<br>* '. $t('I/We declare that the above information is true and correct.');
				}
				$html = $html . '</p></small></div>';
				
				$html = $html . 'Date: '.gmdate('Y-M-d H:i:s',time());
				
				$html = $html . '<div style="text-align:right;"><u>'.$data['data']['fullName'].'</u><br>';
				$html = $html . 'Account Holder\'s Name';
				if($locale!='en'){
					$html = $html . '<br>* '. $t('Account Holder\'s Name');
				}
				$html = $html . '<br></div>
				<span><small>';
				$html = $html . 'By signing below you agree that this signature confirms that you have adopted the contents of this message and that the person(s) who have completed this Declaration of Source of Funds form is/are the person(s) who wrote it and that the sender of the form is the person(s) described herein.';
				if($locale!='en'){
					$html = $html . '<br>* '.  $t('By signing below you agree that this signature confirms that you have adopted the contents of this message and that the person(s) who have completed this Declaration of Source of Funds form is/are the person(s) who wrote it and that the sender of the form is the person(s) described herein.');
					
				}
				$html = $html . '</small></span>
				<div style="padding-left:100px;text-align:right;margin-bottom:10px">
				</div>';
				$html = $html . '<p></p>';
				$html = $html . '<div style="text-align:right;margin-bottom:220px">';
				$html = $html . 'Please sign here';
				$html = $html . ':______________________________________________<br><u>'.$data['data']['fullName'].'</u><br>';
				if($locale!='en'){
					$html = $html . '<br>* '.$t('Please sign here');
					$html = $html . ':______________________________________________<br><u>'.$data['data']['fullName'].'</u><br>';
				}
				
				$html = $html . 'Account Holder\'s Name';
				if($locale!='en'){
					$html = $html . '<br>* '. $t('Account Holder\'s Name');
				}
					$html = $html . '</div>';
				$html = $html .'IP: '. $_SERVER['REMOTE_ADDR'];
				$pdf->writeHTML($html, true, 0, true, 0);
?>