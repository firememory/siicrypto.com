<?php
use app\extensions\action\Functions;

$function = new Functions();

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
				<th style="	padding: 20px 0 20px 0;	background-color:#ddd; font-size:24px">Your wire request has been approved in the amount of <?=$compact['data']['data']['Amount']?> <?=$compact['data']['data']['Currency']?>
				</th>
			</tr>
			<tr>
				<td><h4>Dear <?=$compact['data']['data']['username']?>,</h4>
				<p>You have requested to wire transfer <?=$compact['data']['data']['data']['amountFiat']?> <?=$compact['data']['data']['Currency']?> to your SiiCrypto.com account username: <strong><?=$compact['data']['data']['username']?></strong> with Reference No: <strong><?=$compact['data']['data']['Reference']?></strong></p>
				
				<p>You may now instruct your bank to wire your funds to ILS FIDUCIARIES (SWITZERLAND) SARL. Your detailed wire instructions are given below. Please use the information below to send a wire transfer to fund your SiiCrypto account. You can print out this form and give it to your bank, or use this information to complete your bank’s standard wire instruction form</p>
				</td>
			</tr>
			</table>
			<table style="width:95%;	align:auto;	margin:auto;	border:0px;	background-color:white;text-align:left">			
				<tr>
							<th colspan="2" style="background-color:#CAFFFF">PLEASE WIRE THE FOLLOWING FUNDS USING THE WIRE INSTRUCTIONS BELOW:</th>
				</tr>
				<tr>
					<th colspan="2" >BANK NAME: <?=$compact['data']['bank']['Bank Name']?></th>
				</tr>
				<tr>
					<th colspan="2" >BANK ADDRESS: <?=$compact['data']['bank']['Bank Address']?></th>
				</tr>
				<tr>
					<th colspan="2" >SWIFT CODE: <?=$compact['data']['bank']['Bank SWIFT Code']?></th>
				</tr>
				<tr>
					<th colspan="2" >Intermediary Bank: <?=$compact['data']['bank']['Intermediary Bank']?></th>
				</tr>
				<tr>
					<th colspan="2" >Intermediary Bank SWIFT Code: <?=$compact['data']['bank']['Intermediary Bank SWIFT Code']?></th>
				</tr>
				<tr>
					<th colspan="2" >For the Benefit of: <?=$compact['data']['bank']['For the Benefit of']?></th>
				</tr>
				<tr>
					<th colspan="2" >Account No: <?=$compact['data']['bank']['Account No']?></th>
				</tr>
				<tr>
					<th colspan="2" >SWIFT CODE: <?=$compact['data']['bank']['SWIFT Code']?></th>
				</tr>
				<tr>
					<th colspan="2" >For the Further Benefit of: <?=$compact['data']['bank']['For the Further Benefit of']?></th>
				</tr>
				<tr>
					<th colspan="2" >Bank Address: <?=$compact['data']['bank']['Further Bank Address']?></th>
				</tr>				
				<tr>
					<th colspan="2" >Account No: <?=$compact['data']['bank']['Further Account No']?></th>
				</tr>
				<tr>
					<th colspan="2" >Vantu Account Name: <?=$compact['data']['bank']['Vantu Account Name']?></th>
				</tr>
				<tr>
					<th colspan="2" >Vantu Account No: <strong><?=$compact['data']['bank']['Vantu Account No']?></strong>
						</td>
				</tr>
				<tr>
					<th colspan="2" style="background-color:#CAFFFF">REFERENCE: SiiCrypto Client Name: <?=$compact['data']['data']['data']['fullName']?> SiiCrypto Client Reference No: <?=$compact['data']['data']['data']['Reference']?></th>
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
