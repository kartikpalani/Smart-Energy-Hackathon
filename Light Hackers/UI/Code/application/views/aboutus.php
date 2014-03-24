<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>About Competition</title>
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
  		<!--<div class="row">
  			<div class="span12 text-center">  				
  				<div class="well"><marquee behavior="scroll" direction="left"><p><h1 class="text-error">Registrations Open : 22 July 2013 Onwards !</h1></p></marquee></div>
  			</div>
  		</div>--> 		
  		<div class="row-fluid">  			
			<!--Sidebar content-->
			<div class="span3">
				<div class="well affix" style="width:280px;padding: 8px 0;">
					<ul class="nav nav-list">						
						<li class="active"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">About Competition</a></li>
						<li><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">FAQ</a></li>
						<li><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Terms and conditions</a></li>
						<li><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">Eligibility and team rules</a></li>
						<!--<li><a href="#">Theme Details</a></li>	
						<li><a href="#">Download</a></li>			
						<li><a href="#">Upload</a></li>-->		
					</ul>
				</div>	
			</div>			
			
			<div class="span9">					
				<!--
				<strong>About Us</strong>
				<hr>		
				<p>E-Yantra is an initiative by MHRD and IIT Bombay to improve the quality of robotics and embedded systems education in the country. Project E-Yantra was conceptualized by Prof Kavi Arya and Prof. Krithi Ramamritham, at IIT Bombay. Prof. Arya is the overall coordinator (Principal Investigator) of this project. This project came out of their years of experience in teaching the Embedded Systems course to students both at IIT-Bombay and at remote engineering colleges through the Distance Education Program of IIT-Bombay.</p>
				<p>We found it easy to teach concepts to local students through hands-on work in the lab. The same task was much more difficult with remote students having questionable access to labs with more questionable supervision. We started to work on the concept of a “lab-in-a-box”. After a number of trials and errors we have converged onto the given Firebird series of robots which have been tried and tested on numerous courses, workshops and projects. We have experimented with numerous accessories for the robots and the current design of the robots encapsulates in their design our cumulative experience with teaching and deploying these robots.</p>
				<p>This is the second year that we are launching the national level E-Yantra competition. This competition aims to spread awareness about the best practices in robotics amongst all interested engineering students. It aims to make robotics fun and practical and allow students to actually apply their knowledge and solve a real life problem with the given hardware.</p>
				-->
				
				<div class="accordion" id="accordion2">
					<div class="accordion-group">
						<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"> About the e-Yantra Robotics Competition </a>
						</div>
						<div id="collapseOne" class="accordion-body collapse in">
						<div class="accordion-inner">
							<p><strong>How much do I have to pay to participate?</strong></p>
							<p><strong>You pay NOTHING to participate– it is FREE to students.</strong> In fact, e-Yantra provides the team with a robotic kit,which is required for participating in the competition. 
							While sensors and actuators are provided by e-Yantra (as part of the Robotic kit), to teams based on the problem assigned to them, teams are required to pay for other accessories required to build structures on the robot. Also,teams need to make the arena(usually an inexpensive “flex sheet” based passive arena) for the task assigned to them.
							Teams selected as Finalists to participate in the Grand Finals to be held at IIT Bombay in February – March 2014, have to pay for their tickets (basic fares as per the competition norms will be reimbursed) and some incidental expenses to participate in the finals.</p>
							
							<p><strong>Do we HAVE to have a college support us? Why not a team member’s home?</strong></p>
							<p>It is ESSENTIAL to have college support since the goal of the e-Yantra project is to help equip colleges with better equipment and skills. You may work at home for convenience but it is fairer to work in a college environment where others may get inspired to emulate your work and excitement. In fact that’s what we go to college for – isn’t it?</p>
							
							<p><strong>What is this competition about?</strong></p>
							<p>It is all about getting a robot to solve a useful problem. The emphasis is on the software side or programming as all participating teams are provided a robot. However, a certain amount of construction will be expected from participants but this will be of a very basic level  - doable by ANY engineering student.</p>
							
							<p><strong>Do we have to build a robot for this competition?</strong></p>
							<p><strong>NO – this is what makes us different from ALL other robotic competitions.</strong> All participants are given a robot of the same kind and expected to PROGRAM it to achieve the task goal. The ERTS Lab at IIT-Bombay has designed this robot.
							
							<p><strong>I don’t know anything about robotics – how will I fare in this competition?</strong></p>
							<p>As long as you are a keen programmer or know some programming in “C” language you can make a good start. It is important that you have the desire or aptitude to learn whatever skills are required to complete the given task. Appropriate direction will be given by the e-Yantra team.</p>
						</div>
						</div>
					</div>
					
					<div class="accordion-group">
						<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"> FAQ </a>
						</div>
						<div id="collapseTwo" class="accordion-body collapse">
						<div class="accordion-inner">
						<p><strong>What is Project e-Yantra?</strong></p>
						<p>Project e-Yantra is an initiative to spread education in Embedded systems and Robotics by IIT Bombay sponsored by Ministry of Human Resource Development through the National Mission on Education through ICT (NMEICT). This project was conceptualized by Prof.Kavi Arya and Prof. Krithi Ramamritham of the Department of Computer Science and Engineering at IIT Bombay.</p>
						<p><strong>What is the aim of this project?</strong></p>
						<p>The objective is to provide hands-on learning to engineering students who have limited access to labs and mentors. The goal is to create the next generation of (Embedded systems) engineers in India with a practical outlook to take on challenging problems and provide solutions.</p>
						<p><strong>What is e-YantraRobotics Competition (eYRC)?</strong></p>
						<p>eYRC is a competition that is open to students studying engineering in one of the engineering colleges in India.  
						It is a group competition where students in a team program a given robotic platform to solve a given problem in 12 - 15 weeks. The emphasis is on systematically applying one’s mind to solving the problem with given resources and solving the problem by successfully implementingthe best solution. Several tasks are assigned to the teams during the course of the competition to take them through the project lifecycle in a systematic manner.  A lot of emphasis is placed on problem exploration, documentation and presenting the results. A video presentation of the solution is used to short-list the Finalists in the competition. Final scores for the teams are decided using a scoring system that uses individual scores for the tasks assigned. The format of the competition not only tests the theoretical and technical knowledge of the team members but also the communication skills and team player skills of the students.</p>
						</div>
						</div>
					</div>
					
					<div class="accordion-group">
						<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">	Terms and conditions </a>
						</div>						
						<div id="collapseThree" class="accordion-body collapse">
						<div class="accordion-inner">
						<p> 1. Failure to comply with any rules, terms, and conditions of the competition may result in the participating team's disqualification.</p>
						<p> 2. All participants shall agree to allow their names and photographs to be used for publicity purposes by e-Yantra during and after the competition.</p>
						<p> 3. e-Yantra holds the intellectual property rights for all materials submitted by the participating teams for the competition.</p>
						<p> 4. e-Yantra will not be responsible for submitted material lost in transit.</p>
						<p>	5. All material submitted must be the participants own work.</p>
						<p>	6. Any kind of plagiarism is strictly prohibited and will lead to disqualification of participants. Duplication of the thoughts or work of another source must be referenced.</p>
						<p>	7. e-Yantra’s decision is final and no appeals will be entertained.</p>
						<p>	8. e-Yantra reserves the right to modify or amend the prizes, rules, terms and conditions of the competition at any time.</p>

						</div>
						</div>
					</div>
					
					<div class="accordion-group">
						<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">	Eligibility and team rules </a>
						</div>						
						<div id="collapseFour" class="accordion-body collapse">
							<div class="accordion-inner">
								<p>	1. The competition is open for registration to full time engineering students who are undergraduates or equivalent, studying in universities, colleges,studying foran engineering degree from any discipline.</p>
								<p>	2. Each team must have four members (this can be any combination of undergraduates from same college).</p>
								<p>	3. All members of a team must belong to the same college / institution.</p>
								<p>	4. Each student can join only one team.</p>
								<p>	5. One member of the team should be designated as the team leader, who is responsible for all communications with e-Yantra.</p>
								<p>	6. e-Yantra’s decision is final should there be any dispute.</p>
						    </div>
						</div>
					</div>
				</div> 
	        </div>
	  </div><!--end of row fluid-->  	     
    </div> <!-- /container-fluid-->
    <?php $this->load->view('footer');?>  

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>   	
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
    	$("#ercabout").addClass("active");
    });//end of document ready function	
    
    $(".nav-list li").click(function() {
  		$(".nav-list li").removeClass("active");
  		$(this).addClass("active");
	});	
    </script>
  </body>
</html>




