<?php
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
				<td><h4>Hi <?=$compact['data']['data']['username']?>,</h4>
<p>You have requested to deposit <?=$compact['data']['data']['data']['amountFiat']?> <?=$compact['data']['data']['Currency']?> to your SiiCrypto.com account <strong><?=$compact['data']['data']['username']?></strong> with Reference No: <strong><?=$compact['data']['data']['Reference']?></strong></p>

<p>Your Declaration of Source of Funds (“DSF”) is attached to this email. Please print it out, sign it, and scan it. 
<p>If the browser you used to connect to SiiCrypto is your primary browser then you can upload the signed DSF to this link <a href="https://siicrypto.com/users/funding_fiat/<?=$compact['data']['data']['Currency']?>" target="_blank">UPLOAD DSF HERE</a>.</p>
<p>If your primary browser is not the browser you used to connect to SiiCrypto, then copy this link<br>
https://siicrypto.com/users/funding_fiat/<?=$compact['data']['data']['Currency']?><br>
and paste it into the browser you are using.  You do not need to close down your open SiiCrypto webpage before pasting this link into your browser.</p>

<p>If your SiiCrypto webpage has been open for longer than twenty minutes you will have been auto logged out and you will need to login again.</p>

<p>Once you have uploaded the signed DSF to SiiCrypto using the above links, it will be sent to ILS Fiduciaries (Switzerland) Sarl and Vantu Bank. You will then receive another email providing the wire transfer details and you can then wire transfer the funds using the reference number quoted above.</p>

<p>Please do not wire the funds until you receive an email confirmation from us.</p>
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
