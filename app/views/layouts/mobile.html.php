<?php
 use lithium\storage\Session;
 use app\models\Pages;
 if(!isset($title)){
		$page = Pages::find('first',array(
			'conditions'=>array('pagename'=>'home')
		));
 		$title = $page['title'];
		$keywords = $page['keywords'];
		$description = $page['description'];
 }

?>
<!DOCTYPE html>

<html lang="en">
  <head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="keywords" content="<?php if(isset($keywords)){echo $keywords;} ?>">	
			<meta name="description" content="<?php if(isset($description)){echo $description;} ?>">		
			<meta name="author" content="">
			<link rel="shortcut icon" href="favicon.ico">

		<title>SiiCrypto Exchange | SiiCrypto | Digital Currency Exchange - Buy & Sell GreenCoinX</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
				<link href="/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/dashboard.css?v=<?=rand(1,100000000)?>" rel="stylesheet">
<style type="text/css">
body {
	padding-top: 40px;
	font-family: 'Open Sans', sans-serif;
}
</style>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="/bootstrap/js/bootstrap-datepicker.js"></script>	
	<?php
	$this->scripts('<script src="/js/main.js?v='.rand(1,100000000).'"></script>'); 	
	?>
</head>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<body >

   <div class="container-fluid" style="text-align:center">
    
			
				<div style="border-radius: 10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;">
					<div style="background-color:black;border-radius: 10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;padding:10px">
						<a href="https://siicrypto.com" target="_blank"><img src="https://siicrypto.com/img/logo.png" alt="SiiCrypto.com" text="SiiCrypto.com"/></a>
					</div>
				</div>
						<?php echo $this->content(); ?>
					
			
			
			
		</div> <!-- container-fluid -->
		
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
		<?php echo $this->scripts(); ?>	
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/js/docs.min.js"></script>
  </body>
</html>
<script type="text/javascript">
$(function() {
 $('.tooltip-x').tooltip();
 $('.tooltip-y').tooltip(); 
 $("input:text:visible:first").focus();
});
</script>