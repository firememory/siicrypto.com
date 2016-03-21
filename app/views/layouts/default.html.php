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
<?php $user = Session::read('member'); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="<?php if(isset($keywords)){echo $keywords;} ?>">	
		<meta name="description" content="<?php if(isset($description)){echo $description;} ?>">		
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">


		<title><?php echo MAIN_TITLE;?><?php if(isset($title)){echo $title;} ?></title>

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
<?php

if(Session::read('ex')==""){
		Session::write('ex','BTC/GBP');
	}else{
		$ex =	strtoupper(str_replace("_","/",substr($_SERVER['REQUEST_URI'],-7)));
		Session::write('ex',$ex);			
}
$ex = Session::read('ex');

?>
<body <?php if(strtolower($this->_request->controller)=='ex'){ ?> onLoad="UpdateDetails('<?=$ex?>');" <?php }elseif($this->_request->controller!='Sessions' && $this->_request->controller!='Admin'){?> onLoad="CheckServer();" <?php }?>>

    <div style="padding-right:0;" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div  style="padding-right:0; padding-left:0;" class="container-fluid">
						<?php echo $this->_render('element', 'header');?>		
      </div>  <!-- container-fluid -->
    </div> <!-- navbar-fixed-top -->
    <div class="container-fluid">
      <div class="row">
			<?php if(strtolower($this->_request->controller)!='admin'){ ?>
						<div class="col-sm-4 col-md-3 sidebar">
						<ul class="nav nav-sidebar">
							<li class="active"><a href="#"> <i class="glyphicon glyphicon-th-list"></i> Trades</a></li>
							<?php echo $this->_render('element', 'sidebar-menu');?>		
							<?php if($user!=""){?>
							<li class="active"><a href="/users/settings"> <i class="fa fa-gears"></i> Your Account</a></li>
							<li class="active"><a href="/ex/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
							<?php }?>
						</ul>
						<?php if($user==""){ ?>
						<ul class="nav nav-sidebar">
						<li class="active"><a href="/users/signup">Register & Open an account</a></li>
						</ul>
						<?php }?>
<small style="letter-spacing: 0px;">
<p>SiiCrypto first time users need to open an online GreenCoinX wallet at <a href="https://xgcwallet.org" target="_blank">www.xgcwallet.org</a></p>
<p>Users will complete an online "Know Your Client" verification process which only takes a few minutes.</p>
<p><strong>SiiCrypto clients fiat funds are held by ILS Fiduciaries (Switzerland) Sarl the Swiss branch of ILS World, a global provider of independent fiduciary services.</strong></p>
<p><strong>SiiCrypto clients GreenCoinX and Bitcoin cannot be accessed without client approval.</strong></p>
<p>The promise of crypto currency was always the fast and inexpensive transfer of funds worldwide, while bypassing the banking system.Until GreenCoinX this has been impeded by identity concerns. Now GreenCoinX has made this promise a reality by its KYC capability.</p>
</small>
					</div> <!-- sidebar-->
					
			<?php }?>
				<?php if(strtolower($this->_request->controller)=='admin'){ ?>
					<div class="col-md-12 main">				
					<?php echo $this->_render('element', 'admin');?>
				<?php }else{?>
					<div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
				<?php }?>
				
				<?php echo $this->content(); ?>
					<div class="footer" style="border-bottom:double">
							<?php echo $this->_render('element', 'localbitcoins');?>	
							<?php // echo $this->_render('element', 'footer');?>	
					</div>	<!-- footer -->
				</div> <!-- main -->					
			</div> <!-- row-->
			
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
Please note due to regulatory issues some residents of certain USA states are excluded.

 

Rejection email will say…

 

We regret we are unable to accept your application at this time due to USA state regulatory issues.

         ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
