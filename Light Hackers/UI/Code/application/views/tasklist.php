<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Task List</title>
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
  		<div class="row-fluid">  			
			<!--Sidebar content-->
			<div class="span3">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<li class="text-center text-error"><?php  echo "e-YRC#".$loginId."-".$theme; ?></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url();?>teamprofile/">Team Profile</a></li>
						<li class="active"><a href="<?php echo base_url();?>teamprofile/tasklist">Task List</a></li>
						<li><a href="<?php echo base_url();?>teamprofile/theme">Theme Details</a></li>	
						<li><a href="<?php echo base_url();?>teamprofile/download">Download <span class="label label-info"> New!</span></a></li>			
						<li><a href="<?php echo base_url();?>teamprofile/upload">Upload <span class="label label-info"> New!</span></a></li>
						<li><a href="<?php echo base_url();?>teamprofile/robotDelivery">Robot Delivery </a></li>	
							<li><a href="<?php echo base_url();?>teamprofile/taskstatus">Score Card <span class="label label-info"> New!</span></a></li>						
														
					</ul>
				</div>	
			</div>			
			
		<div class="span8">
			<div class="row-fluid">
				<div class="span12">
					<div id="tasklist" class="accordion">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle collapsed" href="#task1" data-parent="#tasklist" data-toggle="collapse"> Important Dates </a>
							</div>
							<div id="task1" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner"> 
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Task</th> 	 	         
												<th>Tentative Start Date</th>
												<th>Tentative Last Date</th>												
											</tr>
										</thead>
									<tbody>
										<tr>											
											<td>Theme Allotment</td>
											<td>31st October-2013</td>
											<td>-</td>
										</tr>
										
										<tr>											
											<td>Robot Shipment from IIT-Bombay</td>
											<td>11th November-2013</td>
											<td>30th November-2103</td>
										</tr>
										
										<tr>											
											<td>Task-0 Flex Printing</td>
											<td>07th November-2013</td>
											<td>22nd November-2013</td>
										</tr>
										
										<tr>											
											<td>Task-1 Theme Analysis</td>
											<td>21st November-2013</td>
											<td>23rd December-2013</td>
										</tr>
										
										<tr>											
											<td>Task-2 Implementation Analysis</td>
											<td>26th December-2013</td>
											<td>27th January-2014</td>
										</tr>
										
										<tr>											
											<td>Task-3 Demonstration</td>
											<td>21st Feburary-2014</td>
											<td>3rd March-2014</td>
										</tr>
										
										<tr>											
											<td>Task-4 Documentation</td>
											<td>21st Feburary-2014</td>
											<td>5th March-2014</td>
										</tr>
										
										<tr>											
											<td>Finals (At IIT-Bombay)</td>
											<td>28th March-2014</td>
											<td>-</td>
										</tr>									
									</tbody>
									</table>
									<p class="text-error"><strong>Note:</strong> Dates are subject to change. Teams will be informed accordingly.</p>								
								</div>
							</div>
						</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#task2" data-parent="#tasklist" data-toggle="collapse"> Theme Allotment:  </a>
							</div>
							<div id="task2" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner">  
									<p> e-Yantra Robotics Competition-2013 (e-YRC-2013)  challenges students to solve different problems in the “urban agriculture” domain.  Each selected team is allotted a theme; teams are notified of their assigned theme through an e-mail to the team leader.</p>
									<p> Each theme consists of a problem statement in the form of a rule book which completely describes the problem statement, rules, and scoring parameters.  </p>
									<p> Rule book will be made available for download on e-YRC portal interface. </p>
								</div>
							</div>
						</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#task3" data-parent="#tasklist" data-toggle="collapse"> Robot Shipment: </a>
							</div>
							<div id="task3" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner"> 
									<p>e-Yantra will  ship a robotic kit with the following contents to each selected team :</p>
									<ol>
										<li>A Firebird V robot</li>
										<li>Accessories (required for completing the theme)</li>
										<li>A DVD with video tutorials, manuals, and software/drivers for the given robotics platform. </li>
									</ol>
									<p>All these will be sent in a box to the address given by the team. This kit is given free of cost to each team for the duration of the competition.</p>
									<p>Participating teams will be assigned task at various stages of competition. Tasks with start and last dates are detailed in 	<a class="accordion-toggle collapsed" href="#task1" data-parent="#tasklist" data-toggle="collapse"> Important Dates </a>. Detailed instructions for all tasks are given on the portal on midnight of start date. Team should complete and upload the task within the last date. Upload link is available on portal interface from midnight of start date and remain open till midnight of last date. Before uploading, make sure that you submit the final version; team is allowed only one attempt to upload (for each task).Short description about each task is given with link on each task.</p>
								</div>
							</div>
						</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#task4" data-parent="#tasklist" data-toggle="collapse"> Task-0: Flex Printing </a>
							</div>
							<div id="task4" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner">
									<p>Each theme involves solving a problem using the Robotic kit on a given “arena”. The arena represents the area on which the robot performs the solution to the assigned problem. e-Yantra provides the arena design. Teams download the arena design from e-YRC portal interface when instructed by the e-Yantra team.</p>
									<p>Teams are responsible for printing the arena design on a flex sheet locally. Cost for flex printing will be borne by the Team.</p>
									<p>Detailed instructions for this task will be given on the portal along with the download link to the arena design.</p> 
								</div>
							</div>
						</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#task5" data-parent="#tasklist" data-toggle="collapse"> Task-1: Theme Analysis </a>
							</div>
							<div id="task5" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner"> 
									<p>This will be the first task where teams are given a set of questions. These questions are based on information provided in the manuals and rule book, and the concepts covered in the video tutorials. </p>
									<p>Teams can download the questions, and submit answers on the upload link on e-YRC portal. </p>
								</div>
							</div>
						</div>	
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#task6" data-parent="#tasklist" data-toggle="collapse"> Task-2: Implementation Analysis </a>
							</div>
							<div id="task6" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner"> 
									<p>This task involves software and hardware requirement specification. Questions are related to implementation details such as flowcharts, pseudo code etc., and hardware design.</p>
									<p>Teams can download the questions, and submit answers on the upload link on e-YRC portal.</p>
								</div>
							</div>
						</div>	
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#task7" data-parent="#tasklist" data-toggle="collapse"> Task-3: Demonstration </a>
							</div>
							<div id="task7" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner"> 
									<p>In Task 3: Demonstration teams submit a video recording that demonstrates their solution to the assigned theme.</p>
									<p>To ensure a general solution, e-Yantra will specify the details for the demonstration video one week prior to the submission date. Teams are allowed to make changes in code. </p>
									<p>Details and instructions related to video creation will be uploaded on the portal.</p>
								</div>
							</div>
						</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#task8" data-parent="#tasklist" data-toggle="collapse"> Task-4: Documentation </a>
							</div>
							<div id="task8" class="accordion-body collapse" style="height: 0px;">
								<div class="accordion-inner"> 
									<p>Teams have to submit final report consisting of code, project report etc. The template for the task will be given on the portal interface. </p>
									<p>Teams can download the questions, and submit answers on the upload link on e-YRC portal. Teams are evaluated and marked for each task. Final score of a team is the cumulative score of each of the 4 tasks. 5 teams will be selected as “finalists” from each theme based on their cumulative scores. Finalists come to IIT-Bombay to participate in the Grand finals.  Top 3 teams are selected for awards and prizes.</p>
									<p>Teams completing all the tasks successfully are awarded certificates from e-Yantra, IIT-Bombay.</p>
								</div>
							</div> 
						</div>										
					</div>					
				</div>
			</div>
	    </div> <!--end of row-->
	        
	        
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
		
	</script>
	
  </body>
</html>




