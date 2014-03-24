<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid container">
			<a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
	
			<!--<a class="brand" href="<?php echo base_url();?>home/erc"><font color="red">e-Yantra</font></a>-->
			<a class="brand" href="<?php echo base_url();?>home/erc"><img src="<?php echo base_url();?>/static/img/logo_smart.jpg" class="img-rounded"></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li  id="erchome">
					<a href="<?php echo base_url();?>home/erc">Home</a>
					</li>
					<!--<li id="ercabout">
					<a href="<?php echo base_url();?>home/login">Dashboard</a>
					</li> -->
					<li id="erccontact">
					<a href="<?php echo base_url();?>home/contactus">Contact Us</a>
					</li>
				<!--<li id="ercposter">
					<a href="<?php echo base_url();?>e-YRC-13-Poster" target= "_blank">Download Poster</a>
				</li>    
					<li id="erctestlogin">
					<a href="<?php echo base_url();?>home/quizlogin">Online Test Login</a>
					</li>
					-->
				</ul>
			<!--</div>	
			<div class="nav-collapse pull-right">-->
				<!--<p class="navbar-text pull-right">-->					
				<ul class="nav pull-right">						
					<?php if($this->session->userdata('logged_in')) {
							 $session_data = $this->session->userdata('logged_in');
			      			 $data['loginId'] = $session_data['id'];	 
			      	         $data['username'] = $session_data['username'];							 
							 $data['theme'] = $session_data['theme'];
							 echo "<li><a href=".base_url()."teamprofile/logout>Logout</a></li>";
						} else if($this->session->userdata('quiz_logged_in')){  
							 $session_data = $this->session->userdata('quiz_logged_in');
			      			 $data['loginId'] = $session_data['teamid'];	 
			      	         $data['username'] = $session_data['username'];
							 echo "<li id='ercprofile'><a href=".base_url()."teamprofile/intfrd2".">e-YRC#".$data['loginId']."|".$data['username']."</a></li> <li><a href=".base_url()."teamprofile/logout1>Logout</a></li>";						
						} else {
						//	echo "<li id='quizlogin'><a href=".base_url()."home/quizlogin>Quiz Login</a></li>";	
						 	echo "<li id='login'><a href=".base_url()."home/login>Login</a></li>";	
						}	
					?>
						
				<!--<a href="#"><?php if($username) { echo $data['username'];}?></a>-->
				</ul>
				<!--</p>-->
			</div>
		</div>
	</div>
</div>
		

