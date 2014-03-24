<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Group Image</title>
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
        <div class="row">
			<ul class="thumbnails">
				<?php foreach($grpimg as $row){ ?>
				<li class="span3">
					<div class="thumbnail" >
						<?php echo '<img alt="260x180" style="width: 260px; height: 180px;" src="data:image/png;base64,'.base64_encode($row['photo']).'">'; ?>
						<h4 class="text-center"><?php echo 'e-YRC#'.$row['teamId'] ?></h4>
					</div>
				</li>				
				<?php } ?>	
			</ul>			
				<div align="center"><?php echo $this->pagination->create_links(); ?></div>				
		</div>	
	</div>	 
	<?php $this->load->view('footer');?>
	 

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script> 
    <script>
    
	</script>   
    </body>
</html>    


