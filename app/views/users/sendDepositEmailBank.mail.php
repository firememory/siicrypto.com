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
				<td><h4>Dear ILS/Vantu Bank,</h4>

				
				<p><?=$compact['data']['data']['username']?> has requested to deposit <?=$compact['data']['data']['data']['amountFiat']?> <?=$compact['data']['data']['Currency']?> to your SiiCrypto.com account username: <strong><?=$compact['data']['data']['username']?></strong> with Reference No: <strong><?=$compact['data']['data']['Reference']?></strong></p>
				
<p>We are enclosing the Declaration of Source of Funds (DSF) from the user <?=$compact['data']['data']['username']?>.</p>
<p>The user will deposit the funds as per the document to Vantu Bank.</p>
<p>Please credit ILS FIDUCIARIES (SWITZERLAND) SARL, Account Number: <strong>ACC <?=$compact['data']['data']['Currency']?>-100-070378-<?php
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
							?></strong> on receipt of funds.</p>
				</td>
			</tr>
			<tr>
				<td>IP: <?=$_SERVER['REMOTE_ADDR'];?><br>
<?=$tor?>
Date and time: <?=gmdate('Y-m-d H:i:s',time())?>
</p></td>
			</tr>
			<tr>
			<td>
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
