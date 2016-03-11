<?php
use app\extensions\action\Functions;

$function = new Functions();

			$response = file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}");
			$details = json_decode($response);
			if($details->tor) {
				$tor = "Login is disabled from TOR!";
			}
?>
<!DOCTYPE html>
<html>
<head>
<title><?=COMPANY_NAME?></title>
<style>@font-face {
 font-family: Calibre;
 src: url(https://siicrypto.com/css/calibre-regular.woff);
}
div{
	padding:20px;
	align:auto;
	text-align:center;
	background-color:#eee
}
body{
	font-family: Calibre;
	font-size:20px;
	margin:10px;
}
td{
	padding: 20px 20px 20px 20px;
	text-align:left;
}
a{
text-decoration: none
}
</style>
</head>
<body>
<div style="border-radius: 10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;">
	<div style="background-color:black;border-radius: 10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;">
		<a href="https://siicrypto.com" target="_blank"><img src="https://siicrypto.com/img/logo.png" alt="SiiCrypto.com" text="SiiCrypto.com"/></a>
	</div>
	
	<div>
		<table style="width:95%;	align:auto;	margin:auto;	border:0px;	background-color:white;">
			<tr>
				<th style="	padding: 20px 0 20px 0;	background-color:#ddd; font-size:24px">Deposit <?=$compact['data']['data']['Amount']?> <?=$compact['data']['data']['Currency']?>
				</th>
			</tr>
			<tr>
				<td><h4>Dear <?=$compact['data']['data']['username']?>,</h4>
				<p>You have requested to deposit <?=$compact['data']['data']['data']['amountFiat']?> <?=$compact['data']['data']['Currency']?> to your SiiCrypto.com account username: <strong><?=$compact['data']['data']['username']?></strong> with Reference No: <strong><?=$compact['data']['data']['Reference']?></strong></p>
				
<p>Please deposit / wire to ILS FIDUCIARIES (SWITZERLAND) SARL, Account Number: <strong><?=$compact['data']['data']['Currency']?>-100-070378-<?php
								switch ($compact['data']['data']['Currency']){
										case "USD":
										print_r("1");break;
										case "EUR":
										print_r("2");break;
										case "GBP":
										print_r("3");break;
										case "CAD":
										print_r("4");break;										
								}
							?></strong> the funds.</p>
				</td>
			</tr>
			</table>
			<table style="width:95%;	align:auto;	margin:auto;	border:0px;	background-color:white;text-align:left">			
				<tr>
							<th colspan="2" style="background-color:#CAFFFF">RECEIVING BANK</th>
				</tr>
				<tr>
					<th>BANK NAME</th>
					<th>Commerzbank A.G</th>
				</tr>
				<tr>
					<th>BANK ADDRESS</th>
					<th>Kaiserplatz 60261, Frankfurt am-Main, Germany</th>
				</tr>
				<tr>
					<th>SWIFT CODE</th>
					<th>COBADEFF</th>
				</tr>
				<tr>
					<th>For the Benefit of</th>
					<th>National Bank of Vanuatu</th>
				</tr>
				<tr>
					<th>Account No</th>
					<th>400870818200</th>
				</tr>
				<tr>
					<th>SWIFT CODE</th>
					<th>NBOVVUVU</th>
				</tr>
				<tr>
					<th>For the Further Benefit of</th>
					<th>Vantu Bank</th>
				</tr>
				<tr>
					<th>Bank Address</th>
					<th>Vantu House, 133 Santina Parade, Elluk, Port Vila, Vanuatu</th>
				</tr>				
				<tr>
					<th>Account No</th>
					<th>0117982004</th>
				</tr>
				<tr>
					<th>Vantu Account Name</th>
					<th>ILS Fiduciaries (Switzerland) Sarl</th>
				</tr>
				<tr>
					<th>Vantu Account No</th>
							<td><strong><?=$compact['data']['data']['Currency']?>-100-070378-<?php
								switch ($compact['data']['data']['Currency']){
										case "USD":
										print_r("1");break;
										case "EUR":
										print_r("2");break;
										case "GBP":
										print_r("3");break;
										case "CAD":
										print_r("4");break;										
								}
							?></strong>
						</td>
				</tr>
				<tr>
					<th colspan="2" style="background-color:#CAFFFF">REFERENCE</th>
				</tr>
				<tr>
					<th>SiiCrypto Client Name</th>
					<th><?=$compact['data']['data']['data']['fullName']?></th>
				</tr>
				<tr>
					<th>SiiCrypto Client Reference No (DFS)</th>
					<th><?=$compact['data']['data']['data']['Reference']?></th>
				</tr>
				<tr>
					<th>CURRENCY</th>
					<th><?=$compact['data']['data']['data']['currency']?></th>
				</tr>
				<tr>
					<th>AMOUNT</th>
					<th><?=$compact['data']['data']['data']['amountFiat']?></th>
				</tr>
				<tr>
					<th>AMOUNT WORDS</th>
					<th><?=$compact['data']['data']['data']['currency']?> <?=strtoupper($function->number_to_words($compact['data']['data']['data']['amountFiat']))?> ONLY</th>
				</tr>
				<tr>
					<td colspan=2>
					<div style=""><small><strong>Note:</strong> After you send the funds to Vantu Bank, wait for 3 to 7 working days for the funds to be credited to your SiiCrypto Account.</small>


			<tr>
				<td colspan=2>IP: <?=$_SERVER['REMOTE_ADDR'];?><br>
<?=$tor?>
Date and time: <?=gmdate('Y-m-d H:i:s',time())?>
</p></td>
			</tr>
			<tr>
			<td colspan=2>
			Thanks,<br><?=NOREPLY?>
			</td>
			</tr>
		</table>
	</div>
	<p>SiiCrypto is a REALLY safe crypto currency exchange.</p>
	<p><a href="https://greencoinx.com">GreenCoinX.com</a> - <a href="https://xgcwallet.org">XGCWallet.org</a> - <a href="https://KYCGlobal.net">KYCGlobal.net</a></p>
	<div style="padding:30px;font-size:10px">
	<p>Please do not reply to this email. </p>
	<p>This email was sent to you as you tried to register on <?=COMPANY_URL?> with the email address. 
	If you did not register, then you can delete this email.</p>
<p>We do not spam. </p>
	</div>
</div>
</body>
</html>
