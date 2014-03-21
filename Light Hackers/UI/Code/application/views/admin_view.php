<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hub Status</title>
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
				<li class = "active"><a href="<?php echo base_url();?>admin/">Hub Status</a></li>
				<li><a href="<?php echo base_url();?>admin/node">Node Status</a></li>	
				<li><a href="<?php echo base_url();?>admin/power">Power Consumption</a></li>
				<li><a href="<?php echo base_url();?>admin/emergency">Emergency</a></li>	
			
						 
			</ul>  	
  		
       <div class="row-fluid">
			<div class="span2">
			<!--Sidebar content-->
				<div>	
					<label class="radio">
						<input type="radio" name="themename" value="1">Status			
					</label>
								
				</div>	
			</div>
	    <div class="row-fluid">
			
			<div class="span10">
				<!--Body content-->
				    <table class="table table-bordered" id="taskTable">
				   		<thead>
							<tr>
								<th>Hub Id</th>
								<th>Location</th>
								<th>Install Date</th>
								<th>Number of Nodes</th>
								<th>Active Status</th>

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
			function status($value)
			{
				if($value == 0)
				return "Inactive";
				else if($value == 1)
				return "Active";
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
				return "None";
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
				
		$("input:radio[name=themename]").click(function(){								
				$.ajax({                
                type: "GET",                
                url: "<?=base_url()?>admin/getHubList",                  //the script to call to get data          
                data:"tm="+$(this).val(),                        //you can insert url argumnets here to pass to api.php
                dataType: 'json',               //data format                
	            success: function(data){    //on recieve of reply                    
	                    
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
								
								$("#taskTable > tbody").append("<tr><td>"+$id+"</td><td>"+data[i].location+"</td><td>"+data[i].installdate+"</td><td>"+data[i].node+"</td><td>"+status(data[i].status)+"</td></tr>");	
	                     	
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
