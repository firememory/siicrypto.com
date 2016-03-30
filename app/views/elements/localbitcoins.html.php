<?php
/*
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
*/
?>
<div class="row container-fluid">
<small style="font-size:9px">
<?=$GLOBALS['userCountry']?>-<?=$GLOBALS['userState']?></small>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75470134-1', 'auto');
  ga('send', 'pageview');

</script>