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
				<th style="	padding: 20px 0 20px 0;	background-color:#ddd; font-size:24px">SiiCrypto Outgoing Wire Request to Vantu Bank in the amount of <?=$compact['data']['data']['netAmount']?> <?=$compact['data']['data']['Currency']?>
				</th>
			</tr>
			<tr>
				<td><h4>Attention The Manager, ILS Fiduciaries (Switzerland) Sarl,</h4>

				
				<p>Please be advised that a SiiCrypto Client has requested a wire transfer to be made to the clients bank account. We have confirmed that such wire transfer is valid and correct. We hereby send you a web link to download, print wire transfer instructions for your signature and onward transmission to Vantu Bank. The amount to be wired is <?=$compact['data']['data']['netAmount']?> <?=$compact['data']['data']['Currency']?> from <strong>ILS FIDUCIARIES (SWITZERLAND) SARL</strong> account  with Reference No: <strong><?=$compact['data']['data']['Reference']?></strong></p>
				
				<p>For security reasons ILS is only able to download the document directly from the SiiCrypto website. Please download the secure PDF file directly from <a href="https://<?=COMPANY_URL?>/users/ILSDownload/<?=$compact['data']['data']['Reference']?>">https://<?=COMPANY_URL?>/users/ILSDownload/<?=$compact['data']['data']['Reference']?></a></p>

				<p>Please email the signed SiiCrypto Outgoing Wire Form to Vantu Bank email account admin@vantubank.com with a copy to gideon@vantubank.com, dw@greenbankcapitalinc.com and nd@siicrypto.com</p>
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
