<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>e-RC 2013</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>/static/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      
      .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
    </style>
     <link href="<?php echo base_url();?>/static/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    
  </head>  
  
  <?php $this->load->view('header');?> 
  <body>   	
  	<div class="container">
      <div class="row-fluid"><!--Start row fluid -1-->
	      <!--<div class="span12 well">	
	      	<p class="text-center"><?php echo $message; ?></p>	      
	      </div>-->	      
	       <div class="hero-unit center">
				<p><?php echo $message; ?></p>
				<p><b>Or you could just press this neat little button:</b></p>
				<a href="<?php echo base_url();?>home/erc" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Take Me Home</a>
		   </div> 
	  </div><!--end of row fluid -1 -->    
    </div> <!-- /container -->
    <?php $this->load->view('footer');?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>    
	</body>
</html>
