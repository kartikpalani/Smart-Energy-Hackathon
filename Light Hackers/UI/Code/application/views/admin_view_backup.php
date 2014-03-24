<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>admin</title>
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
    	
    	#regdata {
    		margin:10px 10px 10px 10px;
		    width: 900px;
		    height: 500px;
		} 
		
		#statedata {
    		margin:10px 10px 10px 10px;
		     width: 900px;
		    height: 500px;
		}
		
		#datewise {
    		margin:10px 10px 10px 10px;
		     width: 900px;
		    height: 500px;
		} 
		
		#slottest {
    		margin:10px 10px 10px 10px;
		     width: 900px;
		    height: 500px;
		}        	
    </style>
    
  </head>  
   
  <?php $this->load->view('header');?> 
  <body> 
  
  	<div class="container">
  			<ul class="nav nav-tabs">
  		 		<li class="active"><a href="#">Hub Status</a></li>
				<li><a href="<?php echo base_url();?>admin/node">Node Status</a></li>	
				<li><a href="<?php echo base_url();?>admin/power">Power Consumption</a></li>
				<li><a href="<?php echo base_url();?>admin/emergency">Emergency</a></li>		 
			</ul>  	
  		<div class='row'>
  	 		<div class="span12">
  	 			<div class="hp-banner">
  	 				<strong>Task-4 Documentation</strong> <br><br>
	  	 			<p>Dates: 21st February - 5th March, 2014</p>
	  	 			<?php  
					$value = array();
	  	 				foreach($docuStatus as $i) {
	  	 					$value[] = $i;							
	  	 				}	
						$count = array(); 
						$j = 1; 	 				
						foreach($value as $i) {
	  	 					 $count[$j] = $i['total'];	
							 $j++;						
	  	 				}
							
	  	 				?>
	  	 			<p>Documentation Pending 	: <strong class = 'btn btn-danger'><?php echo $count[2] ; ?> </strong> </p> 
	  	 			<p>Documentation Submitted : <strong class = 'btn btn-success'><?php echo $count[1]-1 ?> </strong> </p>
	  	 			<p>Theme Wise Distribution <br> Seed Sowing : <strong class = 'btn btn-primary'><?php echo 27; ?> </strong> </p>
	  	 			<p>Weeding Robot  : <strong class = 'btn btn-primary'><?php echo 18; ?> </strong> </p>	
	  	 			<p>Fertilizing Robot  : <strong class = 'btn btn-primary'><?php echo 28; ?> </strong> </p>	
	  	 			<p>Fruit Plucking : <strong class = 'btn btn-primary'><?php echo 22; ?> </strong> </p>	
	  	 				 Teams Late Submission after deadline: <strong> 355, 477, 266, 866, 1361, 640</strong>
	  	 		</div>
  	 			<div class="hp-banner">
  	 				<strong>Task-3 Demonstration</strong> <br><br>
	  	 			<p>Dates: 21st February - 3rd March, 2014</p>
	  	 			<?php  
					$value = array();
	  	 				foreach($videoStatus as $i) {
	  	 					$value[] = $i;							
	  	 				}	
						$count = array(); 
						$j = 1; 	 				
						foreach($value as $i) {
	  	 					 $count[$j] = $i['total'];	
							 $j++;						
	  	 				}
							
	  	 				?>
	  	 			<p>Video Link Pending 	: <strong class = 'btn btn-danger'><?php echo $count[1] ; ?> </strong> </p> 
	  	 			<p>Video Link Submitted : <strong class = 'btn btn-success'><?php echo 160-$count[1] ?> </strong> </p>
	  	 			<p>Theme Wise Distribution <br> Seed Sowing : <strong class = 'btn btn-primary'><?php echo 31; ?> </strong></p>
	  	 			<p>Weeding Robot  : <strong class = 'btn btn-primary'><?php echo 21; ?> </strong></p>	
	  	 			<p>Fertilizing Robot  : <strong class = 'btn btn-primary'><?php echo 28; ?> </strong> </p>	
	  	 			<p>Fruit Plucking : <strong class = 'btn btn-primary'><?php echo 22; ?> </strong> </p>	
	  	 			
	  	 				 Teams Late Submission after deadline: <strong> WD : 361</strong>
	  	 		</div>
  	 			  <div class="hp-banner">
  	 				<strong>Task-2 Implementation Analysis</strong> <br><br>
	  	 			<p>Dates: 26th December - 27th January, 2013</p>
	  	 			<p>Implementation Analysis Submitted : <strong class = 'btn btn-success'><?php echo 145 ; ?> </strong> </p> 
	  	 			<p>Implementation Analysis Not Submitted : <strong class = 'btn btn-danger'><?php echo 15 ?> </strong> </p>
	  	 			<p>Theme Wise Distribution <br> Seed Sowing : <strong class = 'btn btn-primary'><?php echo 35; ?> </strong> Not Submitted : 235,330, 398,1307, 1492</p>
	  	 			<p>Weeding Robot  : <strong class = 'btn btn-primary'><?php echo 34; ?> </strong> Not Submitted : 86, 538,1199, 1224,1461,1465</p>	
	  	 			<p>Fertilizing Robot  : <strong class = 'btn btn-primary'><?php echo 38; ?> </strong> Not Submitted : 489,1574 </p>	
	  	 			<p>Fruit Plucking : <strong class = 'btn btn-primary'><?php echo 38; ?> </strong>  Not Submitted : 630, 1359 </p>	
	  	 			
	  	 			 Teams Late Submission after deadline: <strong> 1359</strong>
	  	 		</div>
  	 			  <div class="hp-banner">
  	 				<strong>Task-1 Theme Analysis</strong> <br><br>
	  	 			<p>Dates: 21st November - 23rd December, 2013</p>
	  	 			<p>Theme Analysis Submitted : <strong class = 'btn btn-success'><?php echo 149 ; ?> </strong> </p> 
	  	 			<p>Theme Analysis Not Submitted : <strong class = 'btn btn-danger'><?php echo 11 ?> </strong> </p>
	  	 			<p>Theme Wise Distribution <br> Seed Sowing : <strong class = 'btn btn-primary'><?php echo 38; ?> </strong> Not Submitted : 330, 1323</p>
	  	 			<p>Weeding Robot  : <strong class = 'btn btn-primary'><?php echo 34; ?> </strong> Not Submitted : 86, 538, 1224,1406,1461,1465</p>	
	  	 			<p>Fertilizing Robot  : <strong class = 'btn btn-primary'><?php echo 39; ?> </strong> Not Submitted : 489 </p>	
	  	 			<p>Fruit Plucking : <strong class = 'btn btn-primary'><?php echo 38; ?> </strong>  Not Submitted : 368, 630</p>	
	  	 			
	  	 			 Teams Late Submission after deadline: <strong>368,630,1323 </strong>
	  	 		</div>
  	 				<div class="hp-banner">
  	 				<strong>Robot delivery status</strong> <br><br>
	  	 			<p>Dates: 14th November - 30th November, 2013</p>
	  	 			<?php  
	  	 				$value = array();
	  	 				foreach($robotCount as $i) {
	  	 					$value[] = $i;							
	  	 				}	
						$count = array(); 
						$j = 1; 	 				
						foreach($value as $i) {
	  	 					 $count[$j] = $i['total'];	
							 $j++;						
	  	 				}
	  	 				?>
	  	 			<p>Robot delivery Pending 	: <strong class = 'btn btn-warning'><?php echo 0 ; ?> </strong> </p> 
	  	 			<p>Robot Received : <strong class = 'btn btn-primary'><?php echo $count[2]+$count[3]; ?> </strong> </p>
	  	 			<p>Robot Acknowledgment submitted : <strong class = 'btn btn-success'><?php echo $count[3]; ?> </strong> </p>
	  	 			
	  	 		</div>
  	 			<div class="hp-banner">
  	 				<strong>Task-0 Flex Printing</strong> <br><br>
	  	 			<p>Dates: 7th November - 22nd November, 2013</p>
	  	 			<?php  
	  	 				$value = array();
	  	 				foreach($flexCount as $i) {
	  	 					$value[] = $i;							
	  	 				}	
						$count = array(); 
						$j = 1; 	 				
						foreach($value as $i) {
	  	 					 $count[$j] = $i['total'];	
							 $j++;						
	  	 				}
	  	 				?>
	  	 			<p>Flex image Pending 	: <strong class = 'btn btn-primary'><?php echo 0 ; ?> </strong> </p> 
	  	 			<p>Flex image Submitted : <strong class = 'btn btn-warning'><?php echo 0; ?> </strong> </p>
	  	 			<p>Flex image Approved  : <strong class = 'btn btn-success'><?php echo 160; ?> </strong> </p>
	  	 			<p>Flex image Reprint   : <strong class = 'btn btn-danger'><?php echo 0; ?> </strong>(18, 402, 516, 1327, 1330, 1498) </p>	
	  	 			
	  	 		</div>
  	 			<div class="hp-banner">
  	 				<strong>Teams shortlisted and Theme Allotment</strong> <br><br>
	  	 			<p>Total Teams Shortlisted : <strong >160</strong> (14th October)</p>
	  	 			<p>NOC/NDA submission : <strong class = 'btn btn-primary'>160</strong> (Team id which backed out 25,678,1280 replaced with 1175, 1361, 1476)</p>
	  	 			<p>Theme Assigned on 31st October
	  	 			<p>Seed sowing Robot : <strong>40</strong></p> 
	  	 			<p>Fruit Plucking Robot : <strong>40</strong></p>	
	  	 			<p>Weeding Robot : <strong >40</strong></p> 
	  	 			<p>Fertilizing Robot : <strong >40</strong></p> 
	  	 		</div>
  	 			<div class="hp-banner">
	  	 			<strong>Test Taken</strong><br>
	  	 			<p>Slot booked Participants : <strong class = 'btn btn-primary'>5060</strong> Teams : <strong >1265</strong>(27th August - 5th September, 2013)</p>
	  	 			<p>Total Online test taken by : <?php echo "<a class = 'btn  btn-primary'>$countTestAttempt</a>" ;?> (12th September - 30th September)</p>
	  	 			<?php $count = count($teamCount);
					echo "Total Number Of Teams appeared : <strong>$count</strong><br>";
					$teamCount = array_count_values($teamCount);
	  	 			foreach( $teamCount as $number => $times_number_occurred) {
   					 echo "Number of $number Members teams appeared : <strong> $times_number_occurred </strong><br>  ";
					}?>	
	  	 		</div>	
	  	 		<div class="hp-banner">
	  	 			<p>Total Registration Participants : <strong class = 'btn btn-primary'>6316</strong> Teams : <strong>1579</strong> (22nd July - 4th September, 2013)</p>
	  	 		</div>
	  	 		<hr>

  	 	<div class='row'>
  	 		<div class="span12">
  	 			<div class="hp-banner">
	  	 			<strong>Total Registration</strong>
	  	 			<div id="regdata"></div>
	  	 		</div>	
	  	 		<hr>
	  	 		<div class="hp-banner">
	  	 			<strong>Statewise Registration</strong>
	  	 			<div id="statedata"></div>
	  	 		</div>
	  	 		<hr>
	  	 		<div class="hp-banner">
	  	 			<strong>Datewise Registration</strong>
	  	 			<div id="datewise"></div>
	  	 		</div>	
	  	 		<hr>
	  	 		<div class="hp-banner">
	  	 			<strong>Time slot booking</strong>
	  	 			<div id="slottest"></div>	  	 			
	  	 		</div> 			
  	 		</div> 	 	
  	 	</div>  	
  	     
    </div> <!-- /container -->
    
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
	<script src="http://yui.yahooapis.com/3.11.0/build/yui/yui-min.js"></script> 
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>


	<script>	 
	
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      google.setOnLoadCallback(drawChart1);
      google.setOnLoadCallback(drawChart2);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $statedata; ?>);

        var options = {
          //'title': 'Statewise Registration',
          'width': 900,
		  'height': 500	      
        };

        var chart = new google.visualization.PieChart(document.getElementById('statedata'));
        chart.draw(data, options);
      }
      
      function drawChart1() {
        var data = google.visualization.arrayToDataTable(<?php echo $datewise; ?>);

        var options = {
                    hAxis: {title: 'Date', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('datewise'));
        chart.draw(data, options);
      }
      
      function drawChart2() {
        var data = google.visualization.arrayToDataTable(<?php echo $slotTest; ?>);

        var options = {
                    hAxis: {title: 'TestDate', showTextEvery : 1 , titleTextStyle: {color: 'red'} , slantedText:true , slantedTextAngle:50}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('slottest'));
        chart.draw(data, options);
      }

    
	
	$('#regTab a').click(function (e) {
    	e.preventDefault();
    	$(this).tab('show');
    })
	// Create a new YUI instance and populate it with the required modules.		
	YUI().use('charts', function (Y) { 
	    // Charts is available and ready for use. Add implementation
	    // code here.
	    // Data for the chart
		var regdata = <?php echo $regdata; ?>;		
		
		var styleDef = {
	        axes:{
	            values:{
	                label:{
	                    rotation:0,
	                    color:"#ff0000"
	                }
	            },
	            category:{
	                label:{
	                    rotation:-55,
	                    color: "#ff0000"
	                } 
	            }
	        }
    	};    
		// Instantiate and render the chart
		var mychart = new Y.Chart({
		    dataProvider: regdata,		    
		    render: "#regdata",		    
            categoryKey:"category",           
		    styles:styleDef,		    
		    horizontalGridlines: true,
            verticalGridlines: true                  
		});//end of my chart
	});//end of YUI function
  
</script>
  </body>
</html>
