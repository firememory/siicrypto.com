<?php
use lithium\storage\Session;
			$opts = array(
			  'http'=> array(
					'method'=> "GET",
					'user_agent'=> "MozillaXYZ/1.0"));
			$context = stream_context_create($opts);
			$json = file_get_contents('https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/', false, $context);
			$jdec = json_decode($json);
//			print_r($jdec);
			$rate = $jdec->{'USD'}->{'avg_24h'};
//			print_r($jdec->{'USD'}->{'avg_24h'});
?>
<div class="row container-fluid">
<small style="font-size:9px">
<?=$GLOBALS['userCountry']?>-<?=$GLOBALS['userState']?> - <?=$rate?></small>
</div>
