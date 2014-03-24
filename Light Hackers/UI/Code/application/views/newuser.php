<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>/static/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/static/css/bootstrap-responsive.css" rel="stylesheet">
    
    <style>
    	select#collegeName option
		    {
		      background-repeat:no-repeat;
		      border-bottom:thin solid #666666;
		    }    	
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    
  </head>  
  <?php $this->load->view('header');?>
  
  <body>   	
  	<div class="container">
  		<?php if ($this->session->flashdata('sussregi')){ ?> 
			  <div class="row-fluid">
				  <div class="span12">	      
				  	  <div class="alert alert-success">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  Signup successful! Welcome to e-Yantra competition - <strong>email address verification needed.</strong>
						  <br>Before you can login, Please check your mailbox to activate your account. 
					  </div>
				  </div>
			  </div>		  						
		<?php } ?>	
		  		
	<div class="row-fluid">			
		<div class="span6">
			<div class="tabbable"> <!-- Only required for left/right tabs -->			
					
				 <ul class="nav nav-tabs">
				 	<li class="active"><a href="#rule3" data-toggle="tab"> Eligibility </a></li>
				    <li><a href="#rule1" data-toggle="tab"> Registration Process </a></li>
				    <li><a href="#rule2" data-toggle="tab"> Terms & Conditions </a></li>
				</ul>
				    <div class="tab-content">
					    <div class="tab-pane" id="rule1">						    
							<p class="lead">Registration is a two-step process.</p> 							
							<p><h3>Step 1 : Create Group Account</h3></p>
							<p>In the first step one of the team members who is nominated as 'Team Leader' should create the account of the team by providing appropriate details of the college and e-mail ids of the team members.All fields in the form are mandatory.
								The details once entered should not be changed and also the members in the team shouldnot be altered in any manner.</p>  
							<p>	Each team will, after creating anaccount, get aTeam id and login details mailed to the team leader, which will be used in the further stages of the competition.Essential details required during the first step of the registration process are as follows:</p>
							<p>	1.<strong>Photo :</strong> Team should upload a group photo of all team members who are participating in the competition. The size of photo should not exceed 50KB.</p>
							<p>	2.<strong>Full Name :</strong> Team Leader should give full namesof all team members as these nameswillappear on certificates and willbe used henceforth in all our communication.</p>
							<p>	3.<strong>Password :</strong> This password will be used to access the e-Yantra Login Portal.</p>
							<p>	4.<strong>Mobile Number :</strong> This number will be used for the further stages of the competition. Please provide anumber which will be active for atleast six months.</p>
							<p>	5.<strong>College State :</strong> Select the state where your college is situated.</p>
							<p>	6.<strong>College Name :</strong> Select the college name from the list populated based on the state selected.</p>
							<p class="text-error">	If your college name doesn’t appear in the list of colleges,you will click on a link andprovide proper college details. After verification, we will add your college to our database within 24 hours.</p>
							<p>	7.<strong>Branch :</strong> Select your Engineering discipline.</p>
							<p>	8.<strong>Year :</strong> Select your current year of study.</p> 
							<p>	9.<strong>Gender :</strong> Male/Female</p>
							<p>	10.<strong>Address :</strong> Provide complete home address with pincode for further correspondence.</p>
							<p>	11.Provide name and e-mail address of the other 3 members of the team.</p> 
							<p>	12.Check the box to agree to our terms and condition.</p>
							<p>	13.Click on button "Register".</p>							
							<p><h3>Step 2 : Complete Team Details</h3></p>
							<p>When the team leader completes Step 1, she/he will receive a  mail with a Teamid and a link for account activation. Team leader has to click on this link to activate the account – this step serves to verify team leader’s e-mail id.</p> 
							<p>1.Team leader can login on the portal once the account is activated.</p> 
							<p>2.Team leader has to complete other team member details after loggingin.Subsequently,  each team member will receive a mail with a link to activate his/her individual profile – this step serves to verify the team member’s e-mail id. When the team member clicks on this link, his/her profile is acitivated.</p> 
							<p>3.The registration process will be complete ONLY when the complete information of all the team members is submitted, verified, and activated.</p>
							<p>4.The teams on completion of the registration will be eligible for  participating in the further stages of the competition.</p>
						</div>
						    
						<div class="tab-pane" id="rule2">
						    <p> 1. Failure to comply with any rules, terms, and conditions of the competition may result in the participating team's disqualification.</p>
							<p> 2. All participants shall agree to allow their names and photographs to be used for publicity purposes by e-Yantra during and after the competition.</p>
							<p> 3. e-Yantra holds the intellectual property rights for all materials submitted by the participating teams for the competition.</p>
							<p> 4. e-Yantra will not be responsible for submitted material lost in transit.</p>
							<p>	5. All material submitted must be the participants' own work.</p>
							<p>	6. Any kind of plagiarism is strictly prohibited and will lead to disqualification of participants. Duplication of the thoughts or work of another source must be referenced.</p>
							<p>	7. e-Yantra’s decision is final and no appeals will be entertained.</p>
							<p>	8. e-Yantra reserves the right to modify or amend the prizes, rules, terms and conditions of the competition at any time.</p>
						</div>
						
						<div class="tab-pane active" id="rule3">
								
								<p class="lead">When you register to take part in the e-Yantra Competition - 2013, you agree to comply with the rules and terms of the competition.</p>
								<p class="lead">Please note that when a team leader provides data relating to his/her team, e-Yantra assumes that these details are provided with the full knowledge and consent of the team members.</p>
								<p class="lead"><strong>Please provide appropriate data with proper contact details to avoid any future discrepancies.</strong></p>	
															
						    <p>	1. The competition is open for registration to full time engineering students who are undergraduates or equivalent, studying in universities, colleges,studying foran engineering degree from any discipline.</p>
							<p>	2. Each team must have four members (this can be any combination of undergraduates from same college).</p>
							<p>	3. All members of a team must belong to the same college / institution.</p>
							<p>	4. Each student can join only one team.</p>
							<p>	5. One member of the team should be designated as the team leader, who is responsible for all communications with e-Yantra.</p>
							<p>	6. e-Yantra’s decision is final should there be any dispute.</p>
						</div>
					</div>
			</div>
		</div><!--end of span-->
		<div class="span6 well">
			
                <?php if ($this->session->flashdata('msg')){ ?> 
			  	      <div class="alert alert-success">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Well done!</strong> We will update our list soon....
					  </div>						
	  			<?php } ?>	
	  						
			    <p class="lead text-center">Create Your Team Profile</p>
			    <hr>			   
			    <!--<form class="form-horizontal">-->
			    <?php $this->load->helper('form'); ?>		    
			    
			    <?php			    
			    $attributes = array('class' => 'form-horizontal', 'id' => 'registerForm', 'ENCTYPE' => 'multipart/form-data');
				echo form_open('home/registerUser', $attributes);	
				?>
					
					
					<?php if (validation_errors()) { ?>
					<div class="alert alert-error"> 
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<p><h5>Warning!</h5><?php echo validation_errors(); ?></p>
					</div>									
				    <?php } ?>
				    				    
				   <p class="text-error text-center"><strong>Please verify your details before submit.<br>The details once entered can not be edited.</strong></p>
				   <hr>
				    <div class="control-group">
						<p class="text-error text-center"><strong>Please upload a Team photo of size upto 50KB.</strong></p>
						<label class="control-label" for="grpimage">Upload Team Photo</label>
						<div class="controls">
							<input type="file" id="grpimage" name="grpimage" placeholder="Upload Your Team Group Photo">
							<p class="help-block">Please, Give names of team members from left to right</p>						
						</div>						
					</div>
				    
				    <hr>
				    <p class="lead">Fill Team Leader Detail</p>
				    <hr>
				    <div class="control-group">
				    <label class="control-label" for="fullName">Full Name</label>
				    <div class="controls">
				    	<input class="input-xlarge span11" type="text" id="fullName" name="fullName" placeholder="Team Leader Full Name" value="<?php echo set_value('fullName'); ?>">
				    </div>
				    </div>
				    
				    <div class="control-group">
				    <label class="control-label" for="email">Email</label>
				    <div class="controls">
				    	<input class="input-xlarge span11" type="text" id="email" name="email" placeholder="Team Leaders Email" value="<?php echo set_value('email'); ?>">
				    </div>
				    </div>
				    
				    <div class="control-group">
				    <label class="control-label" for="password">Password</label>
				    <div class="controls">
				    	<input class="input-xlarge span11" type="password" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
				    </div>
				    </div>
				    
				    <div class="control-group">
				    <label class="control-label" for="contactNumber">Contact Number</label>
				    <div class="controls">
				    	<div class="input-prepend">
					    	<span class="add-on">+91</span>
					    	<input class="input-medium" type="text" id="contactNumber" name="contactNumber" placeholder="Team Leaders contact Number" maxlength="10" value="<?php echo set_value('contactNumber'); ?>">
					    </div>	
				    </div>
				    </div>
				    
				    <div class="control-group">
				    <label class="control-label" for="state">State</label>
				    <div class="controls">
				    	<select class="input-xlarge span11" id="state" name="state">
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
				    <label class="control-label" for="college">College Name</label>
				    <div class="controls" style="font-family:Verdana;">
				    	<select class="input-xlarge span11" id="collegeName" name="collegeName">
				    		<option selected value="0">--SELECT YOUR COLLEGE--</option>
				    	</select>
				    </div>
				    </div>
				    
				    <div class="control-group">
				    <label class="control-label" for="pincode">College Pincode</label>
					    <div class="controls">
					     	<input class="input-small" type="text" id="pincode" name="pincode" placeholder="Pincode" maxlength="6" value="<?php echo set_value('pincode'); ?>" readonly>
						</div>	
				    </div>
				    
				    <div class="control-group">
				    	<p class="text-error text-center">If your college is not in above list. Please <a id="collegeMail">Click Here !!!</a></p>	
				    </div>				    
				    
				    <div class="control-group">
				    <label class="control-label" for="branch">Branch</label>
				    <div class="controls">
				    	<select class="input-xlarge span11" id="branchName" name="branchName">  
				    		<option value="0" selected="selected">--- SELECT BRANCH --</option>
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
				    	<select class="input-xlarge span11" id="year" name="year">	
				    		<option value="0" selected="selected">--- SELECT YEAR --</option>			    		
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
				    	<select class="input-xlarge span11" id="gender" name="gender">		
				    		<option value="0" selected="selected">---Gender---</option>		    		
				    		<option value="Male">Male</option>
				    		<option value="Female">Female</option>
				    	</select>
				    </div>
				    </div>
				    <div class="control-group">
					    <label class="control-label" for="address">Home Address</label>
					    <div class="controls">
					    	<textarea id="address" name="address" class="input-xlarge span11"><?php echo set_value('address'); ?></textarea>				    	
					    </div>
				    </div>   
				    
				    <hr>
				    <p class="lead">Fill other Team Members Detail</p>
				    				    
				    <div class="control-group">
						<label class="control-label" for="teamMember1_Name">Team Member 1</label>
						<div class="controls">
						<input type="text" class="input-xlarge span11" id="teamMember1_Name" name="teamMember1_Name" placeholder="Full Name Of Team Member 1" value="<?php echo set_value('teamMember1_Name'); ?>">
						</div>
						
						<div class="controls">
						<input type="text" class="input-xlarge span11" id="teamMember1_Email" name="teamMember1_Email" placeholder="Email Of Team Member 1" value="<?php echo set_value('teamMember1_Email'); ?>">
						</div>
					</div>					
									    
				    <div class="control-group">
				    	<label class="control-label" for="teamMember2_Name">Team Member 2</label>
						<div class="controls">
						<input type="text" class="input-xlarge span11" id="teamMember2_Name" name="teamMember2_Name" placeholder="Full Name Of Team Member 2" value="<?php echo set_value('teamMember2_Name'); ?>">
						</div>
						
						<div class="controls">
						<input type="text" class="input-xlarge span11" id="teamMember2_Email" name="teamMember2_Email" placeholder="Email Of Team Member 2" value="<?php echo set_value('teamMember2_Email'); ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="teamMember3_Name">Team Member 3</label>
						<div class="controls">
						<input type="text" class="input-xlarge span11" id="teamMember3_Name" name="teamMember3_Name" placeholder="Full Name Of Team Member 3" value="<?php echo set_value('teamMember3_Name'); ?>">
						</div>
						
						<div class="controls">
						<input type="text" class="input-xlarge span11" id="teamMember3_Email" name="teamMember3_Email" placeholder="Email Of Team Member 3" value="<?php echo set_value('teamMember3_Email'); ?>">
						</div>
					</div>
					
					<!--<div class="control-group">
						<p class="text-error text-center"><strong>Please upload a group image of size upto 50KB.</strong></p>
						<label class="control-label" for="grpimage">Upload Group Image</label>
						<div class="controls">
						<input type="file" id="grpimage" name="grpimage" placeholder="Upload Your Team Group Photo">						
						</div>						
					</div>-->
				    
				    <div class="control-group">
				    <div class="controls">
				    <label class="checkbox">
				    <input type="checkbox" id="terms" name="terms"> I agree e-Yantra Terms
				    </label>
				    <button class="btn btn-primary" type="submit" class="btn" name="signin" id="signin">Register</button>
				    </div>
				    </div>
			    </form>
		</div><!--end of span-->
		</div>	

    <!-- Modal for registration rules showing -->
	<div id="myRulesModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myRulesModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Registration Process</h3>
		</div>
		<div class="modal-body">
							<p><h3>Eligibility and team rules</h3></p>
							<p>	1. The competition is open for registration to full time engineering students who are undergraduates or equivalent, studying in universities, colleges,studying foran engineering degree from any discipline.</p>
							<p>	2. Each team must have four members (this can be any combination of undergraduates from same college).</p>
							<p>	3. All members of a team must belong to the same college / institution.</p>
							<p>	4. Each student can join only one team.</p>
							<p>	5. One member of the team should be designated as the team leader, who is responsible for all communications with e-Yantra.</p>
							<p>	6. e-Yantra’s decision is final should there be any discrepancy.</p>
							<p class="lead">Registration is a two-step process.</p> 							
							<p><h3>Step 1 : Create Group Account</h3></p>
							<p>In the first step one of the team members who is nominated as 'Team Leader' should create the account of the team by providing appropriate details of the college and e-mail ids of the team members.All fields in the form are mandatory.
								The details once entered should not be changed and also the members in the team shouldnot be altered in any manner.</p>  
							<p>	Each team will, after creating anaccount, get aTeam id and login details mailed to the team leader, which will be used in the further stages of the competition.Essential details required during the first step of the registration process are as follows:</p>
							<p>	1.<strong>Photo :</strong> Team should upload a group photo of all team members who are participating in the competition. The size of photo should not exceed 50KB.</p>
							<p>	2.<strong>Full Name :</strong> Team Leader should give full namesof all team members as these nameswillappear on certificates and willbe used henceforth in all our communication.</p>
							<p>	3.<strong>Password :</strong> This password will be used to access the e-Yantra Login Portal.</p>
							<p>	4.<strong>Mobile Number :</strong> This number will be used for the further stages of the competition. Please provide anumber which will be active for atleast six months.</p>
							<p>	5.<strong>College State :</strong> Select the state where your college is situated.</p>
							<p>	6.<strong>College Name :</strong> Select the college name from the list populated based on the state selected.</p>
							<p class="text-error">	If your college name doesn’t appear in the list of colleges,you will click on a link andprovide proper college details. After verification, we will add your college to our database within 24 hours.</p>
							<p>	7.<strong>Branch :</strong> Select your Engineering discipline.</p>
							<p>	8.<strong>Year :</strong> Select your current year of study.</p> 
							<p>	9.<strong>Gender :</strong> Male/Female</p>
							<p>	10.<strong>Address :</strong> Provide complete home address with pincode for further correspondence.</p>
							<p>	11.Provide name and e-mail address of the other 3 members of the team.</p> 
							<p>	12.Check the box to agree to our terms and condition.</p>
							<p>	13.Click on button "Register".</p>							
							<p><h3>Step 2 : Complete Team Details</h3></p>
							<p>When the team leader completes Step 1, she/he will receive a  mail with a Teamid and a link for account activation. Team leader has to click on this link to activate the account – this step serves to verify team leader’s e-mail id.</p> 
							<p>1.Team leader can login on the portal once the account is activated.</p> 
							<p>2.Team leader has to complete other team member details after loggingin.Subsequently,  each team member will receive a mail with a link to activate his/her individual profile – this step serves to verify the team member’s e-mail id. When the team member clicks on this link, his/her profile is acitivated.</p> 
							<p>3.The registration process will be complete ONLY when the complete information of all the team members is submitted, verified, and activated.</p>
							<p>4.The teams on completion of the registration will be eligible for  participating in the further stages of the competition.</p>	
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>		
		</div>
	</div>
	
	<!-- Modal for registration rules showing -->
	<div id="sendCollegeMail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="sendCollegeMail" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="sendCollegeMail">Send your college details</h3>
		</div>
		<div class="modal-body">
			<?php $this->load->helper('form'); ?>		    
			    
			<?php			    
			    $attributes = array('class' => 'form-horizontal', 'id' => 'sendCollegeDetails');
				echo form_open('teamprofile/sendCollegeDetails', $attributes);	
			?>
			
			<div class="control-group">
			    <label class="control-label" for="fromemail">Your e-mail</label>
			    	<div class="controls">
			    			<input class="input-xlarge" type="text" id="fromemail" name="fromemail" placeholder="Your e-mail" maxlength="50">
			    	</div>
			</div>
			
			<div class="control-group">
				    <label class="control-label" for="state_1">State</label>
				    <div class="controls">
				    	<select class="input-xlarge" id="state_1" name="state_1">
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
			    <label class="control-label" for="collegeName_1">College Name</label>
			    	<div class="controls">
			    			<input class="input-xlarge" type="text" id="collegeName_1" name="collegeName_1" placeholder="No abbrevation ! Full Name Please" maxlength="100">
			    	</div>
			</div>

			
			<div class="control-group">
				<label class="control-label" for="pincode_1">College Pincode</label>
					<div class="controls">
					     	<input class="input-small" type="text" id="pincode_1" name="pincode_1" placeholder="Pincode" maxlength="6">
					</div>	
			</div>
			
			<div class="control-group">
				  <label class="control-label" for="collegeaddress">College Address</label>
				  <div class="controls">
				    	<textarea class="input-xlarge" rows="3" id="collegeaddress" name="collegeaddress" placeholder="Please Fill Your Correct full college Address">				    		
				    	</textarea>
				  </div>
			</div> 
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" type="submit" id="sendmail" name="sendmail">Send</button>
			<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>		
		</div>
		</form>
	</div>
	    
    </div> <!-- /container -->
    
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
	    $("#collegeMail").click(function(){
	    	$('#sendCollegeMail').modal('show');
	    });
	    
		$(document).ready(function(){			
			$('#myRulesModal').modal('show');
			$("#signin").click(function(){
				if($("#state").val() == 0){
					alert ("Please Select Your State");
					return false;
				}
				if($("#collegeName").val() == 0){
					alert ("Please Select Your College Name");
					return false;
				}
				
				if($("#branchName").val() == 0){
					alert ("Please Select Your Branch");
					return false;
				}
				
				if($("#year").val() == 0){
					alert ("Please Select Your Year"); 
					return false; 
				}
				
				if($("#gender").val() == 0){ 
					alert ("Please Select Gender");
					return false;
				}
				
				if( $("#email").val() == $("#teamMember1_Email").val() || $("#email").val() == $("#teamMember2_Email").val() || $("#email").val() == $("#teamMember3_Email").val()){
					alert ("Duplicate email");
					return false;
				}
				
				if( $("#teamMember1_Email").val() == $("#teamMember2_Email").val() || $("#teamMember1_Email").val() == $("#teamMember3_Email").val() || $("#teamMember2_Email").val() == $("#teamMember3_Email").val()){
					alert ("Duplicate email");
					return false;
				}
				//alert("Make Sure You have filled correct Information");
				return true;
			});
			
			
			$("#state").change(function(){								
				$.ajax({           
                type: "GET",
                url: "<?=base_url()?>home/getCollegeList",                  //the script to call to get data          
                data:"state="+$('#state').val(),                        //you can insert url argumnets here to pass to api.php
                dataType: 'json',               //data format                
	            success: function(data){    //on recieve of reply             
	                    //console.log(data);	                   
	                    $("#collegeName").empty();	                            			
	                    $("#collegeName").append('<option value=\"0\" selected>--SELECT YOUR COLLEGE--</option>');
	                    for(i in data) 
	                        $("#collegeName").append("<option class=\"input-xxlarge\" value=\""+data[i].collegeName+"\" data-pincode =\""+data[i].pincode+"\">"+data[i].collegeName+"</option><hr>");	    
	                        //data[i].id => to get collegeId Number                   
	                }
            	});			
			});//end of function state change	
			
			$("#collegeName").change(function(){
				var $selected = $('#collegeName').children(":selected");
  				//alert ($selected.data("pincode"));
  				$("#pincode").val($selected.data("pincode"));				
			});//end of function set pincode
			
			
			$("#sendmail").click(function(){				
				
				if( ($("#fromemail").val() == "") || ($("#fromemail").val().length < 5) ){
					alert ("Please fill Your Correct e-mail");
					return false;
				}
				
				if($("#state_1").val() == 0){
					alert ("Please Select Your State");
					return false;
				}				
				
				if( ($("#collegeName_1").val() == "") || ($("#collegeName_1").val().length < 10) ){
					alert ("Please fill Your Full College Name");
					return false;
				}
				
				if( ($("#pincode_1").val() == "") || ($("#pincode_1").val().length != 6)){
					alert ("Please Fill Correct Pincode");
					return false;
				}
			
				if( ($("#collegeaddress").val() == "") || ($("#collegeaddress").val().length < 10) ){
					alert ("Please fill Your address");
					return false;
				}				
				return true;
			});
					
		});//end of document ready function			
	</script> 
  </body>
</html>
