<!DOCTYPE html>
<?php
session_start();
unset($_SESSION['offset'])
?>
<html>	
	<head>
		<link rel="stylesheet" href="css/bootstrap.css"  type="text/css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"  type="text/css"/>
		<style>
		.chart{
			height:350px;
			width:350px;
		}
		.round{
			background-color:rgba(0, 112, 255, 0.26);margin-left:0px;margin-right:0px;border-radius:10px;padding-right:0px;padding-left:0px;
		}
		.border{
			border:2px solid rgba(0, 112, 255, 0.26);
			border-radius:10px;
		}
		.zero{
			margin-left:0px;margin-right:0px;
			margin-top:0px;margin-bottom:0px;
			padding-left:0px;padding-right:0px;
			padding-top:5px;padding-bottom:0px;
		}
		</style>
		<title>Smart Visualizer		</title>
	</head>
	<body>
		<div style="background-color:rgba(0, 112, 255, 0.26);margin-left:0px;mergin-right:0px">
			<div class= "container">
				<div class="row">
					<div class="col-lg-8">
						<h3 class="text-right"><a href="#" >SmartOp: Modelling and Prediction for Energy Optimization</a></h3>
					</div>
				<div class="col-lg-4">
					<h4 class="text-right" style="color: #2a6496;">Day -<span id="day"></span>        Hour -<span id="hour"></span></h4>
				</div>
			</div>
			</div>
		</div>
		<hr>
		<div class="container">
			<div class ="row">
				<div class="col-lg-4">
					<div id="daychart" class="border" style="height:320px">
					
					</div>
				</div>
				<div class="col-lg-4">
					<div id="monthchart" class="border" style="height:320px">
						
					</div>
				</div>
				<div class="col-lg-4  zero border" style="height:320px">
					<div class="zero" >
						<h3 class="text-center zero"style="color:#274b6d;font-size:16px"><b>Tips ans Info</b></h3>
						<hr>
					</div>
					<div class="t1" id="tips" style="margin-left:10px;overflow:auto;height:45%">
				
					</div>
					<div style="height:25%;background-color:#37a9ff;border-radius:10px">
						<div class="t2"id="tips1" style="margin-left:10px;overflow:auto;">
						</div>
				
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class = "container border" id="hourchart">
		</div>
		<div class = "container border" id="dailytrend">
		</div>
	
		<script src="jquery/jquery-1.10.1.min.js"></script>
		<script src="jquery/highcharts.js"></script>
		<script src="jquery/exporting.js"></script>
		
		<script>
		setInterval(function(){get_tips();get_contents();}, 1000);
	
		//actual consumtion of per hr of whole day
		var actualhr=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
		
		//thresholds for of per hr whole day
		var thresholdhr=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
		
		//overshooted values of per hr for whole day
		var overshootedhr=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
		
		//actual consumtion of per day
		var actuald=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
		
		//thresholds for of per day
		var thresholdd=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
		
		//overshooted values of per day
		var overshootedd=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
		
		var actualday=[0];	//actual consumtion of day
		var thresholdday=[0];	//threshold for the day
		var overshootedday=[0];	//overshooted value for day
		var actualmonth=[0];	//actual consumption for the month
		var slab1=[0];	//threshold for slab1 for month
		var slab2=[0];	//threshold for slab2 for month
		var slab3=[0];	//threshold for slab3 for month
		var slab4=[0];	//threshold for slab4 for month
		var slab5=[0];	//threshold for slab5 for month
		var s1,s2,s3,s4,s5;
		var nextslab=[0];
		var currentslab=[0];
		var line=[0];
	  
		//updating all value in realtime 
		function get_contents() {
			$('.t1').scrollTop($('.t1')[0].scrollHeight);
			$('.t2').scrollTop($('.t2')[0].scrollHeight);
			$.get("read.php", function(data) {
				//alert(data);
				if(data!=""){
					var tip = '<p style="color:blue;">TIPS<br>1. Leave the Thermostat Alone <br> 2. Keep The Curtains Closed <br>3. Turn On a Fan<br> 4. Get Rid of Hot Air<br> 5. Use the Dehumidifier<br> 6. Keep Your Air Conditioner Out of the Sun<br>7. Save Chores for the Right Time</p>';
					var res = data.split(","); //result from data file
					var day = parseInt(res[0]);	//day	
					var hr = parseInt(res[1]);	//hour
					actualhr[hr-1]=parseInt(res[3]);	//updating hour in graph
					thresholdhr[hr-1]=parseInt(res[2]);		//updating threshold value

					//setting the day and hour
					$('#day').text(day);
					$('#hour').text(hr);
					
					//updating the tips and info
					$('#tips1').html('<p style="color:white">Currently in : '+res[12]+' <br>Current Predicted Hour Cost : '+res[13]+ ' <br>Monthly Bill So for : '+res[14]+ '</p>');
					
					//hourly updating
					//setting the overshooted value
					if(thresholdhr[hr-1] < actualhr[hr-1]){
						overshootedhr[hr-1] = actualhr[hr-1]- thresholdhr[hr-1];
						actualhr[hr-1]=thresholdhr[hr-1];
						thresholdhr[hr-1]=0;
						$('#tips').append('<p style="color:red;">Last Hour Consumption Exceeded by '+overshootedhr[hr-1]+' units</p>');
						$('#tips').append('<p style="color:blue;">TIPS<br>1. Leave the Thermostat Alone <br> 2. Keep The Curtains Closed <br>3. Turn On a Fan<br> 4. Get Rid of Hot Air<br> 5. Use the Dehumidifier<br> 6. Keep Your Air Conditioner Out of the Sun<br>7. Save Chores for the Right Time</p>');
					}
					else{
						thresholdhr[hr-1]=thresholdhr[hr-1]-actualhr[hr-1];
						overshootedhr[hr-1]=0;
						$('#tips').append('<p style="color:green;">Last Hour Consumption is controlled</p>');
					}
					
					
					var hourly = $('#hourchart').highcharts();
					hourly.series[0].setData(overshootedhr);
					hourly.series[1].setData(thresholdhr);
					hourly.series[2].setData(actualhr);
					
					//daily updating
					thresholdday[0] = parseInt(res[4]);
					actualday[0] = parseInt(res[5]);
					
					
					//setting the daily overshooted value
					if(thresholdday[0] < actualday[0]){
						overshootedday[0] = actualday[0] - thresholdday[0];
						actualday[0]=thresholdday[0];
						thresholdday[0]=0;
					}
					else{
						thresholdday[0] = thresholdday[0]-actualday[0];
						overshootedday[0]=0;
					}
					
					
					var daily = $('#daychart').highcharts();
					daily.series[0].setData(overshootedday);
					daily.series[1].setData(thresholdday);
					daily.series[2].setData(actualday);
					
					//updating the whole months days consumtion trend
					actuald[day-1]=parseInt(res[5]);
					thresholdd[day-1]=parseInt(res[4]);
					overshootedd[day-1]=overshootedday[0];
					
					var dailytrend = $('#dailytrend').highcharts();
					dailytrend.series[0].setData(overshootedd);
					dailytrend.series[1].setData(thresholdd);
					dailytrend.series[2].setData(actuald);
					

					
					//monthly updating
					slab1[0] = parseInt(res[6]);
					slab2[0] = parseInt(res[7]);
					slab3[0] = parseInt(res[8]);
					slab4[0] = parseInt(res[9]);
					slab5[0] = parseInt(res[10]);
					s1=slab1[0];s2=slab2[0];s3=slab3[0];s4=slab4[0];s5=slab5[0];
					actualmonth[0] = parseInt(res[11]);
					//setting the daily overshooted value
					//and telling the user whenever he overshoots the salb values
					if(slab1[0] < actualmonth[0]){
						//if user exceed 1st slab
						$('#tips').append('<p style="color:red;">First Slab Exceeded</p>');
						$('#tips').append(tip);
						slab1[0] = 0;
						if(slab2[0] < actualmonth[0]){
						//if user exceed second slab
							slab2[0] = 0;
							//alert('Second Slab Exceeded');
							$('#tips').append('<p style="color:red;">Second Slab Exceeded</p>');
							$('#tips').append(tip);
							if(slab3[0] < actualmonth[0]){
								//if user exceed third slab
								slab3[0] = 0;
								//alert('Third Slab Exceeded');
								$('#tips').append('<p style="color:red;">Third Slab Exceeded</p>');
								$('#tips').append(tip);
								if(slab4[0] < actualmonth[0]){
									//if user exceed fourth slab
									slab4[0] = 0;
									//alert('Fourth Slab Exceeded');
									$('#tips').append('<p style="color:red;">Fourth Slab Exceeded</p>');
									$('#tips').append(tip);
									if(slab5[0] < actualmonth[0]){
										//if user exceed fifth slab
										//alert('Fifth Slab Exceeded');
										$('#tips').append('<p style="color:red;">Fifth Slab Exceeded</p>');
										$('#tips').append(tip);
										slab4[0] = 0;
									}
									else{
										slab5[0]=slab5[0]-actualmonth[0]+s1+s2+s3+s4;
										currentslab[0]=slab5[0];
										nextslab[0]=0;
									}
								}
								else{
									if(((slab4[0]/100)*80)<actualmonth[0]+s1+s2+s3){
										//line[0]=0.1;
										nextslab[0]=slab5[0];
									}
									slab4[0]=slab4[0]-actualmonth[0]+s1+s2+s3;
									currentslab[0]=slab4[0];
									
								}
							}
							else{
								if(((slab3[0]/100)*80)<actualmonth[0]+s1+s2){
									//line[0]=0.1;
									nextslab[0]=slab4[0];
								}
								slab3[0]=slab3[0]-actualmonth[0]+s1+s2;
								currentslab[0]=slab3[0];
								
							}
						}
						else{
							if(((slab2[0]/100)*80)<actualmonth[0]+s1){
								//line[0]=0.1;
								nextslab[0]=slab3[0];
							}
							slab2[0]=slab2[0]-actualmonth[0]+s1;
							currentslab[0]=slab2[0];
							
					
						}
					}
					else{
						if(((slab1[0]/100)*80)<actualmonth[0]){
							//line[0]=0.1;
							nextslab[0]=slab2[0];
						}
						slab1[0]=slab1[0]-actualmonth[0];
						currentslab[0]=slab1[0];											
					}
					
					var monthly = $('#monthchart').highcharts();
					monthly.series[0].setData(nextslab);
					//monthly.series[1].setData(line);
					monthly.series[1].setData(currentslab);
					monthly.series[2].setData(actualmonth);
				}
			  });
		}
		//updating the tips realtime from the file if user wants
		function get_tips() {
			$.get("readtips.php", function(data) {
				if(data!="" && data!="<br>"){
					$('#tips').append(data);
				}
			  });
		}
		
		//chart showing consumtion for hour
		$(function () {
			$('#hourchart').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Hourly Visualization'
				},
				xAxis: {
					categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'],
					title: {
						text: 'Number of Hours'
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Consumption (Wh)'
					},
					stackLabels: {
						enabled: false,
						style: {
							fontWeight: 'bold',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'white'
						}
					}
				},
				legend: {
					align: 'right',
					x: -70,
					verticalAlign: 'top',
					y: 0,
					floating: true,
					backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'rgba(0, 112, 255, 0.26)',
					borderColor: 'black',
					borderWidth: 0.5,
					shadow: true
				},
				tooltip: {
					formatter: function() {
						return '<b>'+ this.x +'</b><br/>'+
							this.series.name +': '+ this.y +'<br/>'+
							'Total: '+ this.point.stackTotal;
					}
				},
				plotOptions: {
					column: {
						stacking: 'normal',
						dataLabels: {
							enabled: false,
							color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
							style: {
								textShadow: '0 0 3px black, 0 0 3px black'
							}
						}
					}
				},
				series: [{
					name: 'Excess Usage',
					data: overshootedhr
				},{
					name: 'Safe Consumption',
					data: thresholdhr
				},{
					name: 'Consumed',
					data: actualhr
				}]
			});
		});
		
		//chart showing consumtion for day
		$(function () {
			$('#daychart').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Daily Visualization'
				},
				xAxis: {
					categories: ['.']
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Consumption (Wh)'
					},
					stackLabels: {
						enabled: true,
						style: {
							fontWeight: 'bold',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'white'
						}
					}
				},
				legend: {
					align: 'right',
					layout:'horizontal',
					fontSize:"8px",
					x: -2,
					verticalAlign: 'bottom',
					y: 15,
					floating: true,
					backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'rgba(0, 112, 255, 0.26)',
					borderColor: 'black',
					borderWidth: 0.5,
					shadow: true
				},
				tooltip: {
					formatter: function() {
						return '<b>'+ this.x +'</b><br/>'+
							this.series.name +': '+ this.y +'<br/>'+
							'Total: '+ this.point.stackTotal;
					}
				},
				plotOptions: {
					column: {
						stacking: 'normal',
						dataLabels: {
							enabled: false,
							color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
							style: {
								textShadow: '0 0 3px black, 0 0 3px black'
							}
						}
					}
				},
				series: [{
					name: 'Excess Usage',
					data: overshootedday
				}, {
					name: 'Safe Consumption',
					data: thresholdday
				}, {
					name: 'Consumed',
					data: actualday
				}]
			});
		});
		
		//chart showing consumtion for month
		$(function () {
			$('#monthchart').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Monthly Visualization'
				},
				xAxis: {
					categories: ['.']
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Consumption (Wh)'
					},
					stackLabels: {
						enabled: true,
						style: {
							fontWeight: 'bold',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'white'
						}
					}
				},
				legend: {
					align: 'right',
					layout:'horizontal',
					fontSize:"8px",
					x: -10,
					verticalAlign: 'bottom',
					y: 15,
					floating: true,
					backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'rgba(0, 112, 255, 0.26)',
					borderColor: 'black',
					borderWidth: 0.5,
					shadow: false
				},
				tooltip: {
					formatter: function() {
						return '<b>'+ this.x +'</b><br/>'+
							this.series.name +': '+ this.y +'<br/>'+
							'Total: '+ this.point.stackTotal;
					}
				},
				plotOptions: {
					column: {
						stacking: 'normal',
						dataLabels: {
							enabled: false,
							color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
							style: {
								textShadow: '0 0 3px black, 0 0 3px black'
							}
						}
					}
				},
				series: [{
					name: 'Next-Slab',
					data: nextslab
				}, {
					name: 'Current-Slab',
					data: currentslab
				},{
					name: 'Consumed',
					data: actualmonth
				}]
			});
		});
		$(function () {
			$('#dailytrend').highcharts({
				title: {
					text: 'Day wise Trend',
					x: -20 //center
				},
				xAxis: {
					categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
				},
				yAxis: {
					title: {
						text: 'Consumption (Wh)'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				tooltip: {
					valueSuffix: '°C'
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 0
				},
				series: [{
					name: 'Excess Usage',
					data: overshootedd
				}, {
					name: 'Quota',
					data: thresholdd
				}, {
					name: 'Consumed',
					data: actuald
				}]
			});
		});
		</script>
	</body>
</html>