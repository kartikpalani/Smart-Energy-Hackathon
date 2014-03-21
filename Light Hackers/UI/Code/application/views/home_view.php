<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Smart Street Light</title>
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
    <style>
    	.reg{
    		border : 1px solid #000000;
    		border-radius : 4px 4px 4px 4px; 
    		margin-bottom : 21px;
    		padding : 8px 35px 8px 14px;
    	} 
    	
    </style>
    
  </head>    
  <?php $this->load->view('header');?> 
  <body>   	
  	<div class="container">
				
	              		<h4> Why Smart Street Lights ?</h4>
	              		<p> Smart Street are suddenly the rage amongst cities around the world. The initial impetus is typically energy savings. By replacing old-fashioned bulbs with LEDs, cities can save 40-70% on their street lighting energy bills. And for many cities, street lights eat up 25% or more of their energy budget. Once a city has a canopy network in place, it can then use it for a wide variety of smart grid and smart city applications</p><br>
						<img alt="" src="<?php echo base_url();?>/static/img/team.png"  height="480px" width="1200px">	
						<hr>

		  <div class='row-fluid'>		  	
		  	    <div class="span4">
				    <div class="well">
				    <h4 class="text-info">Communication between modules</h4>
					    <hr>
					    <p>Communications modules to create a canopy of network throughout the city to develop smart intelligence system for the operation of Street Light. The distributed network is created consisting of local server connected to hubs which are connected to nodes(street light).</p>
					   
				    </div>
			    </div>
			    
			    <div class="span4">
				    <div class="well">
				    <h4 class="text-info">Proximity/Current sensors </h4>
					    <hr>
					    <p>Proximity sensors that dim the lights when there's no one around. Use of LDR resistors to operate the street lights based on the sunlight intensity. Measure the current and voltage across each of the street light and have electricity conserved for street lights. During the daytime the Motion sensor can also be used to monitor and analyse the traffic.</p>
					    
				    </div>
			    </div>
			    
			    <div class="span4">
				    <div class="well">
				    <h4 class="text-info">Software to strobe the lights</h4>
					    <hr>
					    <p>The central server software can also be used to strobe the lights to lead police, ambulance and fire to the site of an emergency. The emergency signals generated will be processed by the server and incorportated with the street lights to provide navigation. </p>
					
				    </div>
			    </div>
		  	</div>
	</div>	
		  
		  	
      
      <?php $this->load->view('footer');?>

    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>
    <script src="http://connect.facebook.net/en_GB/all.js#xfbml=1"></script>
    <!--
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
	-->
	
	<script>		
    $(document).ready(function(){	
    	$("#erchome").addClass("active");
    	
    	$('.carousel').carousel({
    		interval: 3000
    	})
    });//end of document ready function		
    </script>
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-41067758-1', 'e-yantra.org');
	  ga('send', 'pageview');
	</script>
  </body>
</html>
