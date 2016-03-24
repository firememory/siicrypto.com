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
<h4>Hi <?=$data['username']?>,</h4>
<p>You have requested to withdraw <strong><?=abs($data['Amount'])?> <?=$data['Currency']?></strong> from <?=COMPANY_URL?>.</p>
<p>Click on the link below to confirm the transfer. </p>
<p>If you did not authorize this withdrawal to the address: <strong><?=$data['address']?></strong> please <strong style="color:#FF0000">do not</strong> click on the link.</p>
<a href="https://<?=COMPANY_URL?>/users/paymentconfirm/<?=$data['Currency']?>/<?=$data['verify.payment']?>">https://<?=COMPANY_URL?>/users/paymentconfirm/<?=$data['Currency']?>/<?=$data['verify.payment']?></a>

<p>You will be asked for your main password on the page following the link to authorize the transfer. This is an added security feature SiiCrypto.com employs to secure your coins from hackers / spammers.</p>

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
