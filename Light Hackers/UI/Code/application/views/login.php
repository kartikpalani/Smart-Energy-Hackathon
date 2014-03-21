<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>/static/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">      
      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
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
  		<br><br>
	<!--<div class = "well">
			<p class = "text-center">This is team login page can be used by team leader for team activites. For taking online test please : <a href = "<?php echo base_url();?>/home/quizlogin">Login</a></p>  
				
	</div>  -->
      					<?php $this->load->helper('form'); ?>			    	   
			    	    <?php 
				        		if (function_exists('validation_errors') && validation_errors()) {
				    						echo '<div class="alert alert-error">';
											echo '<button type="button" class="close" data-dismiss = "alert">&times;</button>';
						    				echo validation_errors();
						    				echo '</div>';
								}	
				    	?>
    	
				    	<?php 
				    	$attributes = array('class' => 'form-signin');
				    	echo form_open('verifylogin',$attributes); 
				    	?>
			    	    <!--<form class="form">-->
			    	    
			    	    <h3 class="form-signin-heading">Login</h3>
			    	    <hr>
			    	    					
						    <div class="control-group">					    
							    <div class="controls">
							    <input class="input-xlarge" type="text" id="username" name="username" placeholder="Username">
							    </div>
						    </div>
						    <div class="control-group">					    
							    <div class="controls">
							    <input class="input-xlarge" type="password" id="password" name="password" placeholder="Password">
							    </div>
						    </div>
						
						   
						    <div class="control-group">
							    <div class="controls">					   
							    <button type="submit" class="btn">Sign in</button>
							    </div>
						    </div>
						  
					    </form> 
    </div> <!-- /container -->
    <?php $this->load->view('footer');?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>  
    <script>
	    $(document).ready(function(){	
	    	$("#login").addClass("active");
	    });
    </script>  
	</body>
</html>
