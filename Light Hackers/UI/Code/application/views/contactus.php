<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>/static/css/bootstrap.css" rel="stylesheet">    
    <link href="<?php echo base_url();?>/static/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    
  </head>  
  
  <?php $this->load->view('header');?> 
  <body>   	
  	<div class="container">
      <div class="row"><!--Start row fluid -1-->
	      <div class="span6 ">
	      		    <address>
						<hr>
						Team Members: <br>
						Shailesh Jain <br>
						Prashant Rupapara<br>
						Bhaskar B.<br>
						Shreyas S<br>
						<br><br>
					    <strong>ERTS Lab</strong><br>
					    First Floor, KReSIT Building, CSE Department<br>
					    IIT Bombay - Powai, Mumbai 400076<br>
					   <!-- <abbr title="Phone">P:</abbr> (022) 2576-4986 -->
					</address>
					     
					
					<iframe width="725" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?client=firefox-beta&amp;ie=UTF8&amp;q=iit+powai&amp;fb=1&amp;gl=in&amp;hq=iit+powai&amp;hnear=iit+powai&amp;cid=0,0,7565430156140317006&amp;t=m&amp;z=16&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.in/maps?client=firefox-beta&amp;ie=UTF8&amp;q=iit+powai&amp;fb=1&amp;gl=in&amp;hq=iit+powai&amp;hnear=iit+powai&amp;cid=0,0,7565430156140317006&amp;t=m&amp;z=16&amp;iwloc=A&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>   		      
	      </div>
	      
	      <div class="span6 ">
	      		      
	      </div> 
	  </div><!--end of row fluid -1 -->   
    </div> <!-- /container -->
    <?php $this->load->view('footer');?>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>  
    
    <script>
    $(document).ready(function(){	
    	$("#erccontact").addClass("active");
    });//end of document ready function		
    </script>  
	</body>
</html>
