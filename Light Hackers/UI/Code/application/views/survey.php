<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Feedback</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>/static/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      
      .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
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
      <div class="row-fluid"><!--Start row fluid -1-->	            
	       <div class="span12">
	       	<?php $this->load->helper('form'); ?>			    
			<?php			    
			    $attributes = array('id' => 'feedbackForm');
				echo form_open('teamprofile/feedback', $attributes);	
			?>
    		
    		<p class="text-info">Dear Participants,</p>
    		<p class="text-info">We welcome your comments, which will help us improve the e-Yantra in the future.</p>
    		<p class="text-info">Make sure that you first appear for the Online test before giving the feedback. You can view the result only after you give your valuable feedback.</p>
    		<br><table class="table table-bordered table-hover">
 					 <thead>
						<tr class="success">
							<th></th>
							<th>Parameters</th>
							<th>5</th>
							<th>4</th>
							<th>3</th>
							<th>2</th>
							<th>1</th>
						</tr>
					 </thead>
					 
					 <tbody>
						<tr>
							<td>1</td>
							<td>How was the registration process for e-Yantra Robotics Competition-2013 ?</td>
							<td>
								<label class="radio">
									<input type="radio" name="que1" id="question1_0" value="Very Easy">Very Easy
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que1" id="question1_1" checked="true" value="Easy">Easy
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que1" id="question1_1"  value="Average">Average
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que1" id="question1_3"  value="Difficult">Difficult
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que1" id="question1_4"  value="Very Difficult">Very Difficult
								</label>								
							</td>							
						</tr>
						
						<tr>
							<td>2</td>
							<td>How was the Portal Interface for eYRC ?</td>
							<td>
								<label class="radio">
									<input type="radio" name="que2" id="question2_0" value="Very Easy to use">Very Easy to use
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que2" id="question2_1" checked="true" value="Easy to use">Easy to use
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que2" id="question2_1" value="Average">Average
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que2" id="question2_3" value="Difficult to use">Difficult to use
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que2" id="question2_4" value="Very Difficult to use">Very Difficult to use
								</label>								
							</td>							
						</tr>
						
						<tr>
							<td>3</td>
							<td>FAQs provided on the website were?</td>
							<td>
								<label class="radio">
									<input type="radio" name="que3" id="question3_0" value="Very Useful">Very Useful
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que3" id="question3_1" checked="true" value="Useful">Useful
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que3" id="question3_1" value="Less Useful">Less Useful
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que3" id="question3_3" value="Least Useful">Least Useful
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que3" id="question3_4" value="Not Useful">Not Useful
								</label>								
							</td>							
						</tr>
						
						<tr>
							<td>4</td>
							<td>How do you rate the Practice test provided for familiarization with test layout and interface?</td>
							<td>
								<label class="radio">
									<input type="radio" name="que4" id="question4_0"  value="Very Good">Very Good
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que4" id="question4_1" checked="true" value="Good">Good
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que4" id="question4_2" value="Average">Average
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que4" id="question4_3"  value="Poor">Poor
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que4" id="question4_4"  value="Very Poor">Very Poor
								</label>								
							</td>							
						</tr>
						
						<tr>
							<td>5</td>
							<td>What was the difficulty level of questions asked in Online Test?</td>
							<td>
								<label class="radio">
									<input type="radio" name="que5" id="question5_0"  value="Very Easy">Very Easy
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que5" id="question5_1" checked="true" value="Easy">Easy
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que5" id="question5_2" value="Average">Average
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que5" id="question5_3"  value="Difficult">Difficult
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que5" id="question5_4"  value="Very Difficult">Very Difficult
								</label>								
							</td>							
						</tr>
						
						<tr>
							<td>6</td>
							<td>How was the support provided by e-Yantra helpdesk Team?</td>
							<td>
								<label class="radio">
									<input type="radio" name="que6" id="question6_0"  value="Very Good">Very Good
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que6" id="question6_1" value="Easy" checked="true">Easy
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que6" id="question6_2" value="Average">Average
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que6" id="question6_3"  value="Difficult">Difficult
								</label>								
							</td>
							<td>
								<label class="radio">
									<input type="radio" name="que6" id="question6_4"  value="Very Bad">Very Bad
								</label>								
							</td>							
						</tr>
						
						<tr>
							<td>7</td>
							<td>How do you rate the response time from e-Yantra support team to your doubts/queries?</td>
							<td colspan="3"> 
								<label class="radio">
									<input type="radio" name="que7" id="question7_0"  value="Prompt" checked="true">Prompt
								</label>								
							</td>
							<td colspan="2">
								<label class="radio">
									<input type="radio" name="que7" id="question7_1" value="Slow">Slow
								</label>								
							</td>														
						</tr>						
					 </tbody>
    			</table>
    			<div class="control-group">
    				 <label class="control-label" for="comment">Please provide your Suggestions/Ideas if any for improving the website and the process</label>
					 <div class="controls">
						<textarea rows="3" class="span10" name="comment"></textarea>
					 </div>
    			</div>
    			<button class="btn btn-primary" type="submit" name="feedback" id="feedback">Submit Feedback</button>
    		</form>		
		   </div> 
	  </div><!--end of row fluid -1 -->    
    </div> <!-- /container -->
    <?php $this->load->view('footer');?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>    
	</body>
</html>
