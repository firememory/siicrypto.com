<div class="row container-fluid">
<h2>Deposit <?=$data['data']['currency']?></h2>
<p>You have requested to deposit <?=$data['data']['amountFiat']?> <?=$data['data']['currency']?> to your SiiCrypto.com account <strong><?=$data['username']?></strong></p>
<p>Click to download the PDF directly from here <a href="/vanity/out/SiiCrypto-<?=$data['data']['Reference']?>.pdf" target="_blank">SiiCrypto-<?=$data['data']['Reference']?>.pdf</a></p>
<p>Print, Sign and Upload the PDF document.</p>
Once you upload "<strong>Declaration of Source of Funds (DSF)</strong>", we will send this document for SiiCrypto Admin Approval. Once it is approved, you can send the funds to the account.</p>
<!--<a href="/users/sendDeposit/<?=$data['data']['Reference']?>" class="btn btn-primary">Click to send to directly to your email to sign it</a>-->
<p>&nbsp;</p>
<a href="/ex/dashboard" class="btn btn-primary">Dashboard</a>
<p>&nbsp;</p>
</div>