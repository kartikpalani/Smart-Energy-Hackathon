<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Emergency</title>
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

    </style>
    
  </head>   
  <?php $this->load->view('header');?> 
  <body> 
  
  	<div class="container">
  			<ul class="nav nav-tabs">
  		 		<li><a href="<?php echo base_url();?>admin/">Hub Status</a></li>
				<li><a href="<?php echo base_url();?>admin/node">Node Status</a></li>	
				<li><a href="<?php echo base_url();?>admin/power">Power Consumption</a></li>
				<li class="active"><a href="<?php echo base_url();?>admin/emergency">Emergency</a></li>		 
			</ul>  	
  		
    <div class="row">
    	<div class="span8">
	
				<div> <a href = "<?php echo base_url();?>admin/emergencyredOn" > <button class = "btn btn-large btn-danger " type = "button">Red</button></a></div> <br>
				<div> <a href = "<?php echo base_url();?>admin/emergencyyellowOn"> <button class = "btn btn-large btn-warning" type = "button" >Yellow</button></a></div>
    	 	
    </div>  	     
    </div> <!-- /container -->
    
    <?php $this->load->view('footer');?>
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>
    <script src="http://connect.facebook.net/en_GB/all.js#xfbml=1"></script>
    
    <script src="<?php echo base_url();?>static/parser_rules/advanced.js"></script>
	<script src="<?php echo base_url();?>static/dist/wysihtml5-0.3.0.js"></script>

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
		var editor = new wysihtml5.Editor("message", {
		    toolbar:      "toolbar",
		    stylesheets:  "<?=base_url()?>static/css/stylesheet.css",
		    parserRules:  wysihtml5ParserRules
		});
		
		$("#alltl").click(function(){				
				$.ajax({           
                type: "GET",
                url: "<?=base_url()?>admin/getAllTlEmail",                  //the script to call to get data          
                //data:"state="+"Kerala",                            //you can insert url argumnets here to pass to api.php
                dataType: 'json',               //data format                
	            success: function(data){    //on recieve of reply                                 
	                    $("#to").empty();            
	                    for(i in data)	                        	    
	                        $("#to").append(data[i].username+",\n");            
	                }
            	});			
			});//end of function state change	    
	</script>
  </body>
</html>
