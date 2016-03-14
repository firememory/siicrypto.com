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
        $pdf->Cell(0,15, 'SiiCrypto.com - Withdrawal Request', 0,1,'C', 1);
        $pdf->Ln();
    },
    'footer'=>function() use($pdf){
        $footertext = sprintf('SiiCrypto.com - ILS - Vantu Bank', date('Y')); 
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
$pdf->SetSubject('SiiCrypto.com - Withdrawal Request');
$pdf->SetKeywords('SiiCrypto.com, Email Print');
$pdf->SetTitle('SiiCrypto - Withdrawal'.$data['data']['Reference']);


$pdf->SetAutoPageBreak(true);
				$Reference = $data['Reference'];
				
				$pdf->AddPage('P');
				$html = '<div style="text-align:center;background-color:black;padding:10px">
													<img src="/app/webroot/img/logo.png" border="0" height="30px" width="200px"/>
												</div>';
				$pdf->writeHTML($html, true, 0, true, 0);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetXY(20,25,false);
				$html = "<div style='text-align:center'>
				<h3>SiiCrypto Outgoing Wire re ILS Fiduciaries (Switzerland) Sarl bank account </h3>
				<h4>For the attention of The Manager, Vantu Bank</h4>
				<h5>Please be advised of our instructions to wire transfer the following amount to the SiiCrypto client stated below:</h5>
				<br> Reference No: ".$data['data']['Reference']."</div>";
				$html = $html . "<div><small>Instructions: Please fully complete and sign this form before uploading. <br></small></div>";
			
				$html = $html . '<table border="1" cellspacing="0" cellpadding="2" style="border:1px solid black" >
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">DETAILS OF YOUR ACCOUNT</th>
						</tr>
						<tr>
							<th width="50%"><small>VANTU BANK ACCOUNT NAME:</small></th>
							<td><small>ILS FIDUCIARIES (SWITZERLAND) SARL</small></td>
						</tr>
						<tr>
							<th><small>VANTU BANK ACCOUNT NUMBER:</small></th>
							<td>100-070378-';
								switch ($data['data']['Currency']){
										case "USD":
										$html = $html. "1"; break;
										case "EUR":
										$html = $html. "2"; break;
										case "GBP":
										$html = $html. "3"; break;
										case "CAD":
										$html = $html. "4"; break;
								}
					$html = $html.	'</td>
						</tr>
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">AMOUNT OF YOUR OUTWARD WIRE PAYMENT</th>
						</tr>
						<tr>
							<th><small>CURRENCY</small></th>
							<td>';
				$html = $html.$data['data']['Currency'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>NET AMOUNT TO BE WIRED TO SIICRYPTO CLIENT:</small></th>
							<td>';
				$html = $html.number_format($data['data']['netAmount'],2);
				$html = $html.'</td>
						</tr>
						<tr>
							<td colspan="2">Note that all charges should be debited directly to the ILS Fiduciaries (Switzerland) Sarl bank account using the SiiCrypto Reference No stated above. The net amount wired should not change.</td>
						</tr>
						<tr>
							<th><small>AMOUNT: (Words)</small></th>
							<td>';
				$Amount = ucwords($function->number_to_words($data['data']['netAmount']))." ".$data['data']['Currency']. " ONLY";				
				$html = $html.$Amount;
				$html = $html.'</td>
						</tr>
						<tr>
							<th colspan="2" style="text-align:center;background-color:#CAFFFF">SIICRYPTO CLIENT’S RECEIVING BANK ACCOUNT DETAILS</th>
						</tr>
						<tr>
							<th><small>SIICRYPTO CLIENT FULL NAME:</small></th>
							<td>';
				$html = $html.$data['data']['data']['AccountName'];							
				$html = $html.'</td>
						</tr>
						<tr>
							<th><small>BANK ACCOUNT NUMBER:</small></th>
							<td>';
				$html = $html.$data['data']['data']['AccountNumber'];							
				$html = $html.'</td>
						</tr>						<tr>
							<th><small>BANK NAME:</small></th>
							<td>';
					$html = $html.$data['data']['data']['BankName'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>BANK ADDRESS:</small></th>
							<td>';
					$html = $html.$data['data']['data']['BankAddress'];							
					$html = $html.'</td>
						</tr>
						<tr>
							<th><small>BANK SWIFT CODE:</small></th>
							<td>';
					$html = $html.$data['data']['data']['SwiftCode'];							
					$html = $html.'</td>
						</tr>
						</table>
						';
				$html = $html . 'Date: '.gmdate('Y-M-d H:i:s',time());
				$html = $html . '<div style="text-align:left;">
				For and on behalf of ILS Fiduciaries (Switzerland) Sarl
				<p>&nbsp;</p>
				____________________________________________<br>
				Authorised Signature
				<p>&nbsp;</p>
				____________________________________________<br>
				Authorised Signature<br>
				Please email this signed SiiCrypto Outgoing Wire Form to Vantu Bank email account admin@vantubank.com with a copy to gideon@vantubank.com
				</div>';
				$html = $html . '<p></p>';
				$html = $html .'IP: '. $_SERVER['REMOTE_ADDR'];
				$pdf->writeHTML($html, true, 0, true, 0);

?>