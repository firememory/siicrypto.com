<?php
use lithium\g11n\Message;
extract(Message::aliases());
use app\extensions\action\Functions;
$function = new Functions();
ini_set('memory_limit', '-1');
use lithium\core\Environment; 
$locales = Environment::get('locales');

$pdf =& $this->Pdf;
$this->Pdf->setCustomLayout(array(
    'header'=>function() use($pdf){
        list($r, $g, $b) = array(200,200,200);
        $pdf->SetFillColor($r, $g, $b); 
        $pdf->SetTextColor(0 , 0, 0);
        $pdf->Cell(0,15, 'SiiCrypto.com - Withdrawal form', 0,1,'C', 1);
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
$pdf->SetSubject('SiiCrypto.com - Withdrawal form');
$pdf->SetKeywords('SiiCrypto.com, Email Print');
$pdf->SetTitle('SiiCrypto - Withdrawal'.$data['Reference']);


$pdf->SetAutoPageBreak(true);
				$Reference = $data['Reference'];
				
				$pdf->AddPage('P');
				$html = '<div style="text-align:center;background-color:black;padding:10px">
													<img src="/app/webroot/img/logo.png" border="0" height="30px" width="200px"/>
												</div>';
				$pdf->writeHTML($html, true, 0, true, 0);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetXY(20,25,false);
				if($locale!='en'){
					$html = "<strong>* Translation in ". strtoupper($locale).": ".$locales[$locale]." language</strong>";
				}

				$html = $html."<div style='text-align:center'>";
				$html = $html."Withdrawal wire instructions Form to be signed and submitted by uploading to SiiCrypto for outward wire payment.";
				if($locale!='en'){
					$html = $html.'<br><small>* '.$t("Withdrawal wire instructions Form to be signed and submitted by uploading to SiiCrypto for outward wire payment.")."</small>";
				}
				$html = $html."<br> Reference No: ".$data['Reference']."</div>";
				$html = $html . "<div><small>";
				$html = $html . "Instructions: Please fully complete and sign this form before uploading. ";
				if($locale!='en'){
					$html = $html . "<br>* ". $t("Instructions: Please fully complete and sign this form before uploading.");
				}
				$html = $html . "<br></small></div>";
			
				$html = $html . '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">';
							$html = $html . 'DETAILS OF YOUR ACCOUNT';
							if($locale!='en'){
								$html = $html . '<br><small>* '. $t('DETAILS OF YOUR ACCOUNT').'</small>';
							}
							$html = $html .'</th>
						</tr>
						<tr>
							<th width="50%"><small>';
							$html = $html .'BANK ACCOUNT NAME:';
							if($locale!='en'){
								$html = $html . '<br>* '. $t('BANK ACCOUNT NAME').':';
							}
							$html = $html .'</small></th>
							<td><small>ILS FIDUCIARIES (SWITZERLAND) SARL</small></td>
						</tr>
						<tr>
							<th><small>';
							$html = $html .'BANK ACCOUNT NUMBER:';
							if($locale!='en'){
								$html = $html .'<br>* '.$t('BANK ACCOUNT NUMBER').': ';
							}
							$html = $html .'</small></th>
							<td>ACC '.$data['Currency'].'-100-070378-';
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
				$html = $html.'
							</td>
						</tr><tr>
							<th><small>';
							$html = $html.'YOUR FULL NAME:';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR FULL NAME').': ';
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['AccountName'];
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'YOUR EMAIL ADDRESS';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('YOUR EMAIL ADDRESS').':';
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['email'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'REFERENCE (Quote this reference number with wire)';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('REFERENCE (Quote this reference number with wire)');
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['Reference'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">';
							$html = $html.'AMOUNT OF YOUR OUTWARD WIRE PAYMENT';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('AMOUNT OF YOUR OUTWARD WIRE PAYMENT');
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
				$html = $html.$data['Currency'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'NET AMOUNT TO BE WIRED:';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('NET AMOUNT TO BE WIRED').':';
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.number_format($data['netAmount'],2);
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'AMOUNT: (Words)';
							if($locale!='en'){
								$html = $html.'<br>* '.'AMOUNT: (Words)';
							}
							$html = $html.'</small></th>
							<td>';
				$Amount = ucwords($function->number_to_words($data['netAmount']))." ".$data['Currency']. " ONLY";				
				$html = $html.$Amount;
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'VANTU BANK CHARGES DEDUCTED:';
							if($locale!='en'){
								$html = $html.'<br>*'.'VANTU BANK CHARGES DEDUCTED' .':';
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.number_format($data['VantuCharges'],2);
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'FIDUCIARY COST DEDUCTED:';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('FIDUCIARY COST DEDUCTED').':';
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.number_format($data['ILSCharges'],2);
				$html = $html.'</td>
						</tr>						
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">DETAILS OF THE RECEIVING BANK FOR WIRE PAYMENT</th>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'FULL NAME OF RECEIVING PARTY';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('FULL NAME OF RECEIVING PARTY').':';
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['AccountName'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'RECEIVING BANK ACCOUNT NUMBER:';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('RECEIVING BANK ACCOUNT NUMBER').':';
							}
							$html = $html.'</small></th>
							<td>';
				$html = $html.$data['data']['AccountNumber'];							
				$html = $html.'</td>
						</tr>						<tr>
							<th><small>';
							$html = $html.'RECEIVING BANK NAME:';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('RECEIVING BANK NAME').':';
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['BankName'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'RECEIVING BANK ADDRESS';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('RECEIVING BANK ADDRESS').':';
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['BankAddress'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>';
							$html = $html.'ORIGINAL SENDING BANK SWIFT CODE:';
							if($locale!='en'){
								$html = $html.'<br>* '.$t('ORIGINAL SENDING BANK SWIFT CODE').':';
							}
							$html = $html.'</small></th>
							<td>';
					$html = $html.$data['data']['SwiftCode'];							
					$html = $html.'</td>
						</tr>
						</table>';
						if($locale!='en'){
								$pdf->writeHTML($html, true, 0, true, 0);
								$pdf->AddPage();
								$pdf->SetXY(20,20,false);
								$html = '';
							}
						
						$html = $html.'<div><small>
				<p>';
				$html = $html.'I/We confirm that the funds requested to be withdrawn from my SiiCrypto account will only be transmitted to my/our own bank account. I/We understand that under the requirements of Vanuatu’s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank’s and National Bank of Vanuatu’s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any outward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation.';
				if($locale!='en'){
					$html = $html.'<br>* '.$t('I/We confirm that the funds requested to be withdrawn from my SiiCrypto account will only be transmitted to my/our own bank account. I/We understand that under the requirements of Vanuatu’s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank’s and National Bank of Vanuatu’s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any outward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation.');
				}
				$html = $html.'</p>
				<p>';
				$html = $html.'I/We declare that the above information is true and correct.';
				if($locale!='en'){
					$html = $html.'<br>* '.$t('I/We declare that the above information is true and correct.');
				}
				'</p></small></div>';
				$html = $html . 'Date: '.gmdate('Y-M-d H:i:s',time());
				$html = $html . '<div style="text-align:right;"><u>'.$data['data']['AccountName'].'</u><br>';
				$html = $html . 'Account Holder\'s Name';
				if($locale!='en'){
					$html = $html . '<br>* '.$t('Account Holder\'s Name');
				}
				$html = $html . '<br></div>';
				$html = $html . '<p></p>';
				$html = $html . '<div style="text-align:right">';
				$html = $html . 'Please sign here:';
				if($locale!='en'){
					$html = $html . '<br>* '. $t('Please sign here').':';
					$html = $html . '______________________________________________<br><u>'.$data['data']['AccountName'].'</u><br>';
				}
				$html = $html . '______________________________________________<br><u>'.$data['data']['AccountName'].'</u><br>';
				
				$html = $html . 'Account Holder\'s Signature';
				if($locale!='en'){
					$html = $html .'<br>* '.$t( 'Account Holder\'s Signature');
				}
				$html = $html . '</div>';
				$html = $html .'IP: '. $_SERVER['REMOTE_ADDR'];
				$pdf->writeHTML($html, true, 0, true, 0);

?>