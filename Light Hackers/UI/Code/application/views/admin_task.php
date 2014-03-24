<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Power Consumption</title>
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
				<li class="active"><a href="<?php echo base_url();?>admin/power">Power Consumption</a></li>
				<li><a href="<?php echo base_url();?>admin/emergency">Emergency</a></li>	
			
						 
			</ul>  	
  		
    
	    <div class="row-fluid">
			<div class="span2">
			<!--Sidebar content-->
				<div>	
				<label class="radio">
						<input type="radio" name="themename" value="1">Hub1			
					</label>
					
					<label class="radio">
						<input type="radio" name="themename" value="2">Hub2				
					</label>
					
					<label class="radio">
						<input type="radio" name="themename" value="3">Hub3				
					</label>
					
					<label class="radio">
						<input type="radio" name="themename" value="4">Hub4				
					</label>
				</div>	
			</div>
			
			<div class="span10">
				<!--Body content-->
				    <table class="table table-bordered" id="taskTable">
				   		<thead>
							<tr>
								<th>Id</th>
								<th>LDR status</th>
								<th>Pir Status</th>
								<th>Current Rating</th>
								<th>Voltage Rating</th>
								<th>Power Consumtion</th>
								<th>Emergency Light</th>
							</tr>
						</thead>
						<tbody></tbody>
				    </table>
			</div>
		</div>
		  	     
    </div> <!-- /container -->
    
    <?php $this->load->view('footer');?>
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>
    <!--<script src="http://connect.facebook.net/en_GB/all.js#xfbml=1"></script>-->
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
		/*$("input:radio[name=themename]").click(function(){				
			var params = $(this).val();
			alert(params);
		});//end of function state change*/
			function ldr_status($value)
			{
				if($value == 0)
				return "Day Time";
				else if($value == 1)
				return "Night Time";
				return "Active ";
			}	
			function emergencystatus($value)
			{
				if($value == "0")
				return "No signal";
				else if($value == "1")
				return "Red Led On";
				else if($value == "2")
				return "Yellow Led On";
				else
				return "None";
			}
			
			function pir_status($value)
			{
				if($value == 0)
				return "Invalid";
				else if($value == 2)
				return "No motion";
				else if($value == 3)
				return "Motion";
				return "Sensing";
			}		
			function orient($value)
			{
				if($value == 0)
				return "Left";
				else if($value == 1)
				return "Right";
				else 
				return "None";
			
			}
		function myFunction(value){
			//alert(value);
			$.ajax({                
            type: "GET",                
            url: "<?=base_url()?>admin/approveFlag",                  //the script to call to get data          
            data:"teamId="+value,                        //you can insert url argumnets here to pass to api.php
            //dataType: 'json',               //data format                
	        success: function(data){    //on recieve of reply	                    	                   
	                window.location.reload();
	                }
            	});			
			
		}
		
		/*
		function refreshPower(){
			//alert('hi');
			$("input:radio[name=themename][value=0]").attr('checked', 'checked');
			$.ajax({                
                type: "GET",                
                url: "<?=base_url()?>admin/getTeamList",                  //the script to call to get data          
                data:"tm="+$("input:radio[name=themename]").val(),                        //you can insert url argumnets here to pass to api.php
                dataType: 'json',               //data format                
	            success: function(data){    //on recieve of reply             
	                    
	                $('#taskTable tbody > tr').remove();
	                    for(i in data){
	                    //alert(data[i].id);
	                    var $id = parseInt(i)+1;
								
						$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>"+ldr_status(data[i].ldrstatus)+"</td><td>"+pir_status(data[i].pirstatus)+"</td><td>"+data[i].current+"</td><td>"+data[i].voltage+"</td><td>"+(data[i].current)*(data[i].voltage)+"</td><td>"+emergencystatus(data[i].emergencylight) +"</td></tr>");	
						
						
	                     	
						}
	            }
            });
		}
		
		$( window ).load(function(){
			setInterval(refreshPower,5000);
		});
		*/
		
		$("input:radio[name=themename]").click(function(){								
				$.ajax({                
                type: "GET",                
                url: "<?=base_url()?>admin/getTeamList",                  //the script to call to get data          
                data:"tm="+$(this).val(),                        //you can insert url argumnets here to pass to api.php
                dataType: 'json',               //data format                
	            success: function(data){    //on recieve of reply             
	                    //console.log(data);	                   
	                    
	                    /*$("#collegeName").empty();	                            			
	                    $("#collegeName").append('<option value=\"0\" selected>--SELECT YOUR COLLEGE--</option>');
	                    for(i in data) 
	                        $("#collegeName").append("<option class=\"input-xxlarge\" value=\""+data[i].collegeName+"\" data-pincode =\""+data[i].pincode+"\">"+data[i].collegeName+"</option><hr>");	    
	                        //data[i].id => to get collegeId Number
	                     */  
	                     $('#taskTable tbody > tr').remove();
	                     for(i in data){
	                     	//alert(data[i].id);
	                     	var $id = parseInt(i)+1;
								
								$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>"+ldr_status(data[i].ldrstatus)+"</td><td>"+pir_status(data[i].pirstatus)+"</td><td>"+data[i].current+"</td><td>"+data[i].voltage+"</td><td>"+(data[i].current)*(data[i].voltage)+"</td><td>"+emergencystatus(data[i].emergencylight) +"</td></tr>");	
	                     	
	                     	/*if(data[i].task0Flag == 0)
	                     		$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>e-YRC#"+data[i].teamId+"</td><td>"+data[i].task0Flag+"</td><td>"+robotStatus(data[i].robotDelivery)+"</td><td>"+themeFlag(data[i].task1Flag)+"</td><td>"+impleFlag(data[i].task2Flag)+"</td><td>"+demoFlag(data[i].task3link)+"</td><td>"+docuFlag(data[i].task4Flag)+"</td></tr>");
	                     	
	                     	if(data[i].task0Flag == 1)
	                     		$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>e-YRC#"+data[i].teamId+"</td><td>"+data[i].task0Flag+"&nbsp;&nbsp;<button class=\"btn\" type=\"button\" id=\"approve\" value="+data[i].teamId+" onclick=\"myFunction("+data[i].teamId+")\">approve</button></td><td>"+robotStatus(data[i].robotDelivery)+"</td><td>"+themeFlag(data[i].task1Flag)+"</td><td>"+impleFlag(data[i].task2Flag)+"</td><td>"+demoFlag(data[i].task3link)+"</td><td>"+docuFlag(data[i].task4Flag)+"</td></tr>");
	                     	
	                     	if(data[i].task0Flag == 2)
	                     		$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>e-YRC#"+data[i].teamId+"</td><td>Approved</td><td>"+robotStatus(data[i].robotDelivery)+"</td><td>"+themeFlag(data[i].task1Flag)+"</td><td>"+impleFlag(data[i].task2Flag)+"</td><td><a href ="+demoFlag(data[i].task3link)+"> HERE</a></td><td>"+docuFlag(data[i].task4Flag)+"</td></tr>");	 
	                     	 if(data[i].task0Flag == 3)
	                     		$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>e-YRC#"+data[i].teamId+"</td><td>Reprint</td><td>"+robotStatus(data[i].robotDelivery)+"</td><td>"+themeFlag(data[i].task1Flag)+"</td><td>"+impleFlag(data[i].task2Flag)+"</td><td>"+demoFlag(data[i].task3link)+"</td><td>"+docuFlag(data[i].task4Flag)+"</td></tr>");	                   
	              		
	              		 if(data[i].task3link == "")
	                     		$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>e-YRC#"+data[i].teamId+"</td><td>Approved</td><td>"+robotStatus(data[i].robotDelivery)+"</td><td>"+themeFlag(data[i].task1Flag)+"</td><td>"+impleFlag(data[i].task2Flag)+"</td><td>"+demoFlag(data[i].task3link)+"</td><td>"+docuFlag(data[i].task4Flag)+"</td></tr>");	 
	                     else
	                      		$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>e-YRC#"+data[i].teamId+"</td><td>Approved</td><td>"+robotStatus(data[i].robotDelivery)+"</td><td>"+themeFlag(data[i].task1Flag)+"</td><td>"+impleFlag(data[i].task2Flag)+"</td><td><a href="+demoFlag(data[i].task3link)+" target='_blank'>HERE</a></td><td>"+docuFlag(data[i].task4Flag)+"</td></tr>");	    
									*/
	              		}
	                }
            	});			
			});//end of function state change 			
	</script>
  </body>
</html>
