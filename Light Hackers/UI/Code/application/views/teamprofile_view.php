<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Team Profile</title>
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
						<li class="text-center text-error"><?php  echo "e-YRC#".$loginId."-".$theme ; ?></li>
						<li class="divider"></li>
						<li class="active"><a href="#">Team Profile</a></li>
						<li><a href="<?php echo base_url();?>teamprofile/tasklist">Task List </a></li>
						<li><a href="<?php echo base_url();?>teamprofile/theme">Theme Details</a></li>	
						<li><a href="<?php echo base_url();?>teamprofile/download">Download <span class="label label-info"> New!</span></a></li>			
						<li><a href="<?php echo base_url();?>teamprofile/upload">Upload <span class="label label-info"> New!</span></a></li>
						<li><a href="<?php echo base_url();?>teamprofile/robotDelivery">Robot Delivery </a></li>
							<li><a href="<?php echo base_url();?>teamprofile/taskstatus">Score Card <span class="label label-info"> New!</span></a></li>							
						
						<!--<li><a class="text-error" href="<?php echo base_url();?>teamprofile/testfaq">Test FAQ</a></li>-->
						<!--<li><a href="<?php echo base_url();?>teamprofile/bookslot">Book Time Slot</a></li>-->		
					</ul>
				</div>	
			</div>
					
		<div class="span8">		
			<!--
			<div class="row">
	  			<div class="span10 text-center">  				
	  				<<marquee behavior="scroll" direction="left"><p><h3 class="text-error">Registratons Open : 22 July 2013 Onwards !</h3></p></marquee>
	  				<div class="well"><p>Book Time Slot is open. Please Book your date.</p></div>
	  		  	</div>
	  		 </div> 	
  	     	-->
  	        
  	        
  	        <?php if($eyrc == 1){?>
  	        <div class="row-fluid">
	  	        <div class="span12">
	  	        	<!--<div class="alert alert-success">    				
	    				<h4>Congratulations!</h4>
		    			We are happy to inform you that your team has been shortlisted for the e-Yantra Robotics Competition 2013.
						<br>
						<strong>The details of further process will be mailed to the team leader very soon.</strong>
					    <br><p>All the Best</p>	    			
	    			</div>-->	
	    			<div class="alert">
	    				<p>The theme assigned to your team is <strong><?php if($theme == "WD") echo "WEEDING ROBOT";if($theme == "SS") echo "SEED SOWING ROBOT";if($theme == "FR") echo "FERTILIZING ROBOT";if($theme == "FP") echo "FRUIT PLUCKING ROBOT";?></strong>.</p> 
	    				<p>For details please visit <a href="<?php echo base_url();?>teamprofile/theme">Theme details</a>. At present we have provided only the basic theme description.</p> 
	    				<p>As the competition progresses we will provide rulebook and other details.</p>
	    				<p class="text-error"><strong> Theme once assigned will not be changed under any circumstances.</strong></p>	
	    				<p> Your updated team id is <strong><?php  echo "e-YRC#".$loginId."-".$theme ; ?></strong></p>    				
	    			</div>
	    		<!--	<marquee><p>Tracking Id of Robotic Kit disptached: <a href="<?php echo base_url();?>static/docu/KitContent/tracking_id_2013.pdf" target= "_blank">Click Here</a></p></marquee> -->
	  	        </div>
  	        </div>
  	        <?php }else if($eyrc == 0){ ?>
	  	    <div class="row-fluid">
		  	    <div class="span12">
		  	        <div class="alert alert-block">    
		    			<p>We thank you for your participation in the selection stage of the e-Yantra competition.</p> 
		    			<br>
		    			<strong>We regret to inform you that you have NOT been shortlisted for the e-Yantra Robotics Competition 2013.</strong> 
		    			<br><br>
		    			<p>We value your interest in e-Yantra and hope that we might have another chance at engaging with you sometime. 
		    			Wishing you all the very best in your future endeavors.</p> 
		    			<br>
						<p>Do please keep visiting our website (www.e-yantra.org) and Facebook page (https://www.facebook.com/eyantra ) for other similar opportunities.</p>
		    		</div>
		    	</div>
	    	</div>		
  	        <?php } ?>	
  	        
  	        <? if(($eyrc == 1) && ($shippingaddress == "YES")){?>
				<!--
				<div class="row-fluid">
					<div class="span12">
						<div class="well">
							<p class="text-success">We have received your college details.</p>
						</div>	
					</div>
				</div>
				-->
			<?php }else if( ($eyrc == 1) && ($shippingaddress == "NO")){ ?>
	  	        <div class="row-fluid">
		  	        <div class="span12">
						<div class="well">
							<p class="text-error">We need your complete college details to ship the robotic kit.Please provide correct college address <a id="collegeShipAddr">here</a>.</p>
						</div>	
					</div>
				</div>	
			<?php } ?>
			
			<div class="row-fluid">
					<div class="span12">						
						<div class="well">
						<!--Body content-->			
						    <!--<?php $this->load->helper('form'); ?>-->	
							<p>Your College Details :
							<!--<?php echo $collegeDetail["id"] ?>-->
							<?php echo "<br><address><strong>".$collegeDetail["collegeName"]."</strong>" ?>
							<?php echo "<br>".$collegeDetail["state"]." ".$collegeDetail["pincode"]."</address>" ?>
							<!--<?php echo $collegeDetail["pincode"] ?><br>--></br>	
							</p>
							 Click on below links to fill in the details of the respective team members. Details once saved will be non-editable. 
							<p> Team Member :
							<?php					
							    $j = 1;
								foreach($teamLeader as $row){						
									//echo $row['id'].$row['email'].$row['contact'];
									if($row['active'] == 0){
										echo "<br>".$j.". <input type='hidden' id='teamMember_".$j."' value=".$row['id'].">".$row['name']."  <font color='red'>(e-mail not verified)</font>";
									}else{
										echo "<br>".$j.". <input type='hidden' id='teamMember_".$j."' value=".$row['id']."><a href='#' id='teamMember".$j."'>".$row['name']."</a>";							
									}
									$j++;
								}		
							?>
							</p> 
							
							<p>
								<?php						
			      					echo '<img src="data:image/png;base64,'.base64_encode($grpimg['photo']).'" class="img-polaroid">';
								?>
							</p>
							
							<!--<iframe src="http://www.e-yantra.org/interns/mod/quiz/view.php?id=59" width="100%" height="2280"></iframe>--> 
						</div>
					</div>
				</div>				
				<!--<code>Click <a href="<?php echo base_url(); ?>teamprofile/download/">HERE</a></code>-->			
				<?php if($survey == 0){ ?>
				<div class="row-fluid">
				 	<div class="span12">
				 		
				 	<?php if ($this->session->flashdata('msg')){ ?> 
				  	      <div class="alert alert-success">
							  <button class="close" data-dismiss="alert" type="button">×</button>
							  <strong>Submitted Successfully ! </strong> Please do NOT submit again ....
						  </div>						
		  			<?php } ?>
		  			<p>Please Fill this form</p>	   
				    <?php $this->load->helper('form'); ?>				    
				    <?php			    
				    echo form_open('teamprofile/submitsurvey');	
					?>			    	
				    <div class="media">
					    <a class="pull-right" href="#">
					    	<img class="img-polaroid" height="140px" width="140px" src="<?php echo base_url();?>static/img/poster.png">
					    </a>
					    <div class="media-body">
					    	<input type="hidden" id="teamId" name="teamId" value="<?php echo $loginId; ?>">
					    	<div class="control-group">
							    <label class="control-label" for="poster">Have you seen this poster in your College Notice Board? </label>
							    <label class="radio"><input type="radio" name="poster" id="poster" value="yes" checked>YES</label>
								<label class="radio"><input type="radio" name="poster" id="poster" value="no">NO</label>
							 </div>
							 <hr>						 
							 <div class="control-group">
						   		 <label class="control-label" for="inputEmail">From where did you hear about e-Yantra Robotics Competition?</label>
						    	 <div class="controls">
						    		<select id="source" name="source">
										<option value="website">Website</option>
										<option value="email">e-mail from e-Yantra</option>
										<option value="socialmedia">Social Media </option>
										<option value="printmedia">Print Media</option>
										<option value="other">Other ...</option>							
									</select>
						    	</div>
								</div>
								<hr>
								 <div class="control-group">
									<label class="control-label" for="inputOther">Other</label>
									<div class="controls">
									<input type="text" id="inputOther" name="inputOther" placeholder="Other">
									</div>
								</div>
													 
								<div class="control-group">
								    <div class="controls">
								  	    <button type="submit" class="btn">Submit</button>  
								    </div>
								</div> 
						</div>			    
				    	</div>
					   	</form>
					    </div>		   
					</div><!--END OF row-fluid-->  
				
				<?php }?>				
		        </div>
	        </div>
	   </div> <!--end of row-->
	        
	        
	  </div><!--end of row fluid--> 	    
    </div> <!-- /container-fluid-->
    <?php $this->load->view('footer');?>
    
    <!-- Modal -->
	<div id="memberDetail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Update Member Details</h3>
		</div>
		<div class="modal-body">
			    <!--<form class="form-horizontal">-->
			    <?php $this->load->helper('form'); ?>		    
			    
			    <?php			    
			    $attributes = array('class' => 'form-horizontal', 'id' => 'updateUserDetail');
				echo form_open('teamprofile/updateUserDetail', $attributes);	
				?>
				    <div class="control-group">
				    	<label class="control-label" for="Name">Name</label>
				    	<div class="controls">
				    		<input type="text" id="name" placeholder="Name" disabled>
				    	</div>
				    </div>
				    
			    	<div class="control-group">
			    		<label class="control-label" for="email">Email</label>
			    		<div class="controls">
			    			<input type="text" id="email" placeholder="Email" disabled>
			    		</div>
			    	</div>
			    	
			    	<div class="control-group">
			    		<label class="control-label" for="contact">Contact</label>
			    		<div class="controls">
			    			<input type="text" id="contact" name="contact" placeholder="Contact Number" maxlength="10">
			    		</div>
			    	</div>
			    	
			    	<div class="control-group">
				    <label class="control-label" for="branch">Branch</label>
				    <div class="controls">
				    	<select class="input-xlarge" id="branchName" name="branchName">
				    		<option value="0" selected="selected">--SELECT BRANCH--</option>
				    		<option value="AERONAUTICAL ENGINEERING">AERONAUTICAL ENGINEERING</option>
							<option value="AUTOMOBILE ENGINEERING">AUTOMOBILE ENGINEERING</option>
							<option value="BIO-MEDICAL ENGINEERING">BIO-MEDICAL ENGINEERING</option>
							<option value="BIO-TECHNOLOGY">BIO-TECHNOLOGY</option>
							<option value="CIVIL ENGINEERING">CIVIL ENGINEERING</option>
							<option value="CHEMICAL ENGINEERING">CHEMICAL ENGINEERING</option> 
							<option value="COMPUTER SCIENCE AND ENGINEERING">COMPUTER SCIENCE AND ENGINEERING</option>
							<option value="ELECTRONICS ENGINEERING">ELECTRONICS ENGINEERING</option>
							<option value="ELECTRONICS AND COMMUNICATION ENGINEERING">ELECTRONICS AND COMMUNICATION ENGINEERING</option>
							<option value="ELECTRICAL ENGINEERING">ELECTRICAL ENGINEERING</option>    
							<option value="ELECTRICAL AND ELECTRONICS ENGINEERING">ELECTRICAL AND ELECTRONICS ENGINEERING</option>
							<option value="ELECTRONICS AND INSTRUMENTATION ENGINEERING">ELECTRONICS AND INSTRUMENTATION ENGINEERING</option>
							<option value="ENVIRONMENTAL ENGINEERING">ENVIRONMENTAL ENGINEERING</option>
							<option value="FOOD TECHNOLOGY">FOOD TECHNOLOGY</option>
							<option value="INSTRUMENTATION AND CONTROL ENGINEERING">INSTRUMENTATION AND CONTROL ENGINEERING</option>
							<option value="INFORMATION TECHNOLOGY">INFORMATION TECHNOLOGY</option>   
							<option value="LEATHER TECHNOLOGY">LEATHER TECHNOLOGY</option>
							<option value="MECHATRONICS">MECHATRONICS</option>
							<option value="MEDICAL ELECTRONICS">MEDICAL ELECTRONICS</option>
							<option value="MECHANICAL ENGINEERING">MECHANICAL ENGINEERING</option>
							<option value="MATERIAL SCIENCE ENGINEERING">MATERIAL SCIENCE ENGINEERING</option>
							<option value="METALLURGY">METALLURGY</option>
							<option value="NUCLEAR ENGINEERING">NUCLEAR ENGINEERING</option>
							<option value="PETRO CHEMICAL ENGINEERING">PETRO CHEMICAL ENGINEERING</option>
							<option value="PETROLEUM ENGINEERING">PETROLEUM ENGINEERING</option>
							<option value="PHARMACEUTICAL ENGINEERING">PHARMACEUTICAL ENGINEERING</option>
							<option value="POLYMER TECHNOLOGY">POLYMER TECHNOLOGY</option>
							<option value="PRODUCTION ENGINEERING">PRODUCTION ENGINEERING</option>
							<option value="PLASTIC TECHNOLOGY">PLASTIC TECHNOLOGY</option>
							<option value="PRINTING TECHNOLOGY">PRINTING TECHNOLOGY</option>
							<option value="ROBOTICS AND AUTOMATION">ROBOTICS AND AUTOMATION</option>
							<option value="TELECOMMUNICATION ENGINEERING">TELECOMMUNICATION ENGINEERING</option>
							<option value="TEXTILE CHEMISTRY">TEXTILE CHEMISTRY</option>
							<option value="TEXTILE TECHNOLOGY">TEXTILE TECHNOLOGY</option>
							<option value="GEO-INFORMATICS">GEO-INFORMATICS</option>
							<option value="INDUSTRIAL ENGINEERING">INDUSTRIAL ENGINEERING</option>
				    	</select>
				    </div>
				    </div>
				    
				    <div class="control-group">
				    <label class="control-label" for="year">Year</label>
				    <div class="controls">
				    	<select class="input-xlarge" id="year" name="year">				    		
				    		<option value="0" selected="selected">--SELECT YEAR--</option>
				    		<option value="1">First Year</option>
				    		<option value="2">Second Year</option>
				    		<option value="3">Third Year</option>
				    		<option value="4">Fourth Year</option>
				    	</select>
				    </div>
				    </div>
				    
				    <div class="control-group">
				    <label class="control-label" for="gender">Gender</label>
				    <div class="controls">
				    	<select class="input-xlarge" id="gender" name="gender">				    		
				    		<option value="0" selected="selected">--SELECT GENDER--</option>
				    		<option value="Male">Male</option>
				    		<option value="Female">Female</option>
				    	</select>
				    </div>
				    </div>

				    <div class="control-group">
				    <label class="control-label" for="address">Home Address</label>
				    <div class="controls">
				    	<textarea class="input-xlarge" rows="3" id="address" name="address" placeholder="Please Fill Your Correct full home Address.">				    		
				    	</textarea>
				    </div>
				    </div> 		  
				    
				    <input type="hidden" id="memberId" name="memberId">
				    <input type="hidden" id="memberRole" name="memberRole">  
				</div>
					
					<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-primary" type="submit" id="savechanges" name="savechanges">Save changes</button>
			</form>		
		</div>
	</div><!--End Of Model-->
	<!-- Modal -->
	<div id="profileMsg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="profileMsgLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="profileMsgLabel">Notice</h3>
		</div>
		<div class="modal-body">
		<p>Please fill all the team members detail to complete the Registration process.</p>
		</div>
		<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>		
		</div>
	</div><!--end of model-->
	
	<!--college contact detail-->
	<div id="shipaddress" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addressLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="addressLabel">Shipping address</h3>
		</div>
		<div class="modal-body">
			
		<?php $this->load->helper('form'); ?>		    
			    
		<?php			    
		      $attributes = array('class' => 'form-horizontal', 'id' => 'collegeContactDetail');
			  echo form_open('teamprofile/collegeContactDetail', $attributes);	
		?>	
		<p>We need your complete college details to ship the robotic kit.Please provide correct college address.</p>		
		<hr>
		<div class="control-group">
		   	<label class="control-label" for="teamId">TeamId</label>
		    	<div class="controls">
		    		<input type="text" id="teamId" name="teamId" value="<?php echo $loginId; ?>" disabled>
		    	</div>
	    </div>
	    
	    <div class="control-group">
		   	<label class="control-label" for="email">Team-leader email</label>
		    	<div class="controls">
		    		<input type="text" id="email" name="email" value="<?php echo $username; ?>" disabled>
		    	</div>
	    </div>
	    
	    <div class="control-group">
		   	<label class="control-label" for="pricipalname">Principal Name</label>
		    	<div class="controls">
		    		<input type="text" id="pricipalname" name="pricipalname">
		    	</div>
	    </div>
	    
	    <div class="control-group">
			<label class="control-label" for="collegeaddress">College Address</label>
			    <div class="controls">
			    	<textarea class="input-xlarge" rows="3" id="collegeaddress" name="collegeaddress" placeholder="Please Fill Your Correct College Address."></textarea>
				</div>
		</div>
		
		<div class="control-group">
			 <label class="control-label" for="collegecontact">College Contact</label>
			    <div class="controls">
			    	<div class="input-prepend">
				    	<span class="add-on">91</span>
				    	<input type="text" id="collegecontact" name="collegecontact" placeholder="Contact Number" maxlength="10">
			    	</div>
			    </div>
		</div>
		
		<div class="control-group">
			 <label class="control-label" for="collegecontact">Principal e-mail</label>
			    <div class="controls">
			    	<input type="text" id="principalemail" name="principalemail" placeholder="Principal email">
			    </div>
		</div>
		
		<div class="control-group">
				    <label class="control-label" for="collegestate">State</label>
				    <div class="controls">
				    	<select class="input-xlarge" id="collegestate" name="collegestate">
				    		<option value="0" selected="selected">--- SELECT STATE --</option>
							<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
							<option value="Andhra Pradesh">Andhra Pradesh</option>
							<option value="Arunachal Pradesh">Arunachal Pradesh</option>
							<option value="Assam">Assam</option>
							<option value="Bihar">Bihar</option>
							<option value="Chandigarh">Chandigarh</option>
							<option value="Chhattisgarh">Chhattisgarh</option>
							<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
							<option value="Daman and Diu">Daman and Diu</option>
							<option value="Delhi">Delhi</option>
							<option value="Goa">Goa</option>
							<option value="Gujarat">Gujarat</option>
							<option value="Haryana">Haryana</option>
							<option value="Himachal Pradesh">Himachal Pradesh</option>
							<option value="Jammu and Kashmir">Jammu and Kashmir</option>
							<option value="Jharkhand">Jharkhand</option>
							<option value="Karnataka">Karnataka</option>
							<option value="Kerala">Kerala</option>
							<option value="Lakshadweep">Lakshadweep</option>
							<option value="Madhya Pradesh">Madhya Pradesh</option>
							<option value="Maharashtra">Maharashtra</option>
							<option value="Manipur">Manipur</option>
							<option value="Meghalaya">Meghalaya</option>
							<option value="Mizoram">Mizoram</option>
							<option value="Nagaland">Nagaland</option>
							<option value="Odisha">Odisha</option>
							<option value="Puducherry">Puducherry</option>
							<option value="Punjab">Punjab</option>
							<option value="Rajasthan">Rajasthan</option>
							<option value="Sikkim">Sikkim</option>
							<option value="Tamil Nadu">Tamil Nadu</option>
							<option value="Tripura">Tripura</option>
							<option value="Uttar Pradesh">Uttar Pradesh</option>
							<option value="Uttarakhand">Uttarakhand</option>
							<option value="West Bengal">West Bengal</option>
						</select>
				    </div>
				 </div>   
				    
				 <div class="control-group">
				    <label class="control-label" for="collegepincode">College Pincode</label>
					    <div class="controls">
					     	<input class="input-small" type="text" id="collegepincode" name="collegepincode" placeholder="Pincode" maxlength="6">
						</div>	
				 </div>
				 
				 <input type="hidden" id="collegeteamId" name="collegeteamId" value="<?php echo $loginId; ?>">
				 <input type="hidden" id="collegeemail" name="collegeemail" value="<?php echo $username; ?>">
		</div><!--end of model body-->		    
		<div class="modal-footer">
		<button class="btn btn-primary" type="submit" id="savecollegeaddr" name="savecollegeaddr">Submit</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>	
		</form>	
		</div>
	</div><!--end of model-->
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
			$("#ercprofile").addClass("active");
			
			$.ajax({           
                type: "GET",
                url: "<?=base_url()?>teamprofile/checkProfileComplete",                  //the script to call to get data          
                data:"teamId="+<?php echo $loginId; ?>,                        //you can insert url argumnets here to pass to api.php
                dataType: 'json',               //data format                
	            success: function(data){    //on recieve of reply             
	                    //console.log(data);	
	                    //alert(data); 
	                    if(data == true){
	                    	//alert ("Please fill the team members detail");
	                    	$('#profileMsg').modal('show');
	                    }                                          
	                }
            });
            						
			$("#collegeShipAddr").click(function(){
				$('#shipaddress').modal('show');		
			});
			
			$("#teamMember1").click(function(){
				getMemberProfile($('#teamMember_1').val());			
			});
			
			$("#teamMember2").click(function(){				
				getMemberProfile($('#teamMember_2').val());
			});	
			
			$("#teamMember3").click(function(){
				getMemberProfile($('#teamMember_3').val());
			});
				
			$("#teamMember4").click(function(){
				getMemberProfile($('#teamMember_4').val());
			});
			
			function getMemberProfile(memberId){
     		 	//alert(memberId);
     		 	$.ajax({           
                type: "GET",
                url: "<?=base_url()?>teamprofile/getTeamMemberProfile",                  //the script to call to get data          
                data:"memberId="+memberId,                        //you can insert url argumnets here to pass to api.php
                dataType: 'json',               //data format                
	            success: function(data){    //on recieve of reply             
	                    //console.log(data);	                    
	                    for(i in data){ 
	                        //$("#collegeName").append("<option class=\"input-xxlarge\" value=\""+data[i].collegeName+"\">"+data[i].collegeName+"</option>");	    
	                        //data[i].id => to get collegeId Number
	                        $("#name").val(data.name);
	                        $("#email").val(data.email);
	                        $("#contact").val(data.contact);
	                        $("#branchName").val(data.branch).attr('selected',true);
	                        $("#year").val(data.year).attr('selected',true);
	                        $("#gender").val(data.gender).attr('selected',true);
	                        $("#address").val(data.address);
	                        $("#memberId").val(data.id);
	                        $("#memberRole").val(data.role);
	                        //alert((data.contact).length);
	                        if(data.contact == ""){
	                        	$("#contact").removeAttr("disabled");	                        	
	                        }else{
	                        	$("#contact").attr("disabled", true);
	                        }
	                        if(data.branch == ""){
	                        	$("#branchName").removeAttr("disabled");	                        	
	                        }else{
	                        	$("#branchName").attr("disabled", true);
	                        }
	                        if(data.year == ""){
	                        	$("#year").removeAttr("disabled");	                        	
	                        }else{
	                        	$("#year").attr("disabled", true);
	                        }
	                        if(data.gender == ""){
	                        	$("#gender").removeAttr("disabled");	                        	
	                        }else{
	                        	$("#gender").attr("disabled", true);
	                        }
	                        if(data.address == ""){
	                        	$("#address").removeAttr("disabled");	                        	
	                        }else{
	                        	$("#address").attr("disabled", true);
	                        }
	                        if ((data.contact == "") && (data.branch == "") && (data.year == "") && (data.gender == "") && (data.address == "")){
	                        	$("#savechanges").removeAttr("disabled");
	                        }else{
	                        	$("#savechanges").attr("disabled", true);
	                        }	                        
	                    }                       
	                }
            	});
            	$('#memberDetail').modal('show')
			}//end of getMemberProfile 
			
			$("#savechanges").click(function(){				
				
				if( ($("#contact").val() == "") || ($("#contact").val().length != 10) ){
					alert ("Please fill Your Correct Contact");
					return false;
				}
				
				if($("#branchName").val() == 0){
					alert ("Please Select Your Branch");
					return false;
				}
				if($("#year").val() == 0){
					alert ("Please Select Your College Year");
					return false;
				}
				
				if($("#gender").val() == 0){
					alert ("Please Select Your Gender");
					return false;
				}
				
				if( ($("#address").val() == "") || ($("#address").val().length < 10) ){
					alert ("Please fill Your address");
					return false;
				}				
				return true;
			});
			
			$("#savecollegeaddr").click(function(){				
				
				if( ($("#pricipalname").val() == "") || ($("#pricipalname").val().length < 5) ){
					alert ("Please fill Your College Principal name");
					return false;
				}
				
				if( ($("#collegeaddress").val() == "") || ($("#collegeaddress").val().length < 10) ){
					alert ("Please fill Your College Address");
					return false;
				}					
				
				if( ($("#collegecontact").val() == "") || ($("#collegecontact").val().length != 10) ){
					alert ("Please fill Your Correct College Contact");
					return false;
				}
				
				if( ($("#principalemail").val() == "") || ($("#principalemail").val().length < 5) ){
					alert ("Please fill Principal email");
					return false;
				}
				
				if($("#collegestate").val() == 0){
					alert ("Please Select Your State");
					return false;
				}
				
				if( ($("#collegepincode").val() == "") || ($("#collegepincode").val().length != 6) ){
					alert ("Please fill Pincode");
					return false;
				}
											
				return true;
			});
					
		});//end of document ready function	
		
		
	</script>
	
  </body>
</html>




