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
	
	<div style="text-align:left;padding:10px">
<h4>Hi,</h4>
<p>
User: <?=$compact['data']['transactions']['username']?> has requested to withdraw <?=$compact['data']['transactions']['Amount']?> <?=$compact['data']['transactions']['Currency']?>. He has uploaded the signed document.
</p>

<p>Please click on the <a href="https://<?=COMPANY_URL?>/users/confirmUpload/<?=$compact['data']['transactions']['Reference']?>">link</a> to confirm signature and send to ILS.</p>

<p>Thanks,<br>
<?=NOREPLY?></p>
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
