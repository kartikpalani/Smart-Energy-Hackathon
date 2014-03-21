<?php
// disable warnings
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE); 

$sClientId = '774188544910.apps.googleusercontent.com';
$sClientSecret = '4ZUBlGoP2IiuaqxqXu1R7JBX';
$sCallback = 'http://portal.e-yantra.org/teamprofile/intfrd'; // callback url, don't forget to change it to your!
$iMaxResults = 5000; // max results
$sStep = 'auth'; // current step

// include GmailOath library  https://code.google.com/p/rspsms/source/browse/trunk/system/plugins/GmailContacts/GmailOath.php?r=11
include_once('GmailOath.php');

session_start();

// prepare new instances of GmailOath  and GmailGetContacts
$oAuth = new GmailOath($sClientId, $sClientSecret, $argarray, false, $sCallback);
$oGetContacts = new GmailGetContacts();

if ($_GET && $_GET['oauth_token']) {

    $sStep = 'fetch_contacts'; // fetch contacts step

    // decode request token and secret
    $sDecodedToken = $oAuth->rfc3986_decode($_GET['oauth_token']);
    $sDecodedTokenSecret = $oAuth->rfc3986_decode($_SESSION['oauth_token_secret']);

    // get 'oauth_verifier'
    $oAuthVerifier = $oAuth->rfc3986_decode($_GET['oauth_verifier']);

    // prepare access token, decode it, and obtain contact list
    $oAccessToken = $oGetContacts->get_access_token($oAuth, $sDecodedToken, $sDecodedTokenSecret, $oAuthVerifier, false, true, true);
    $sAccessToken = $oAuth->rfc3986_decode($oAccessToken['oauth_token']);
    $sAccessTokenSecret = $oAuth->rfc3986_decode($oAccessToken['oauth_token_secret']);
    $aContacts = $oGetContacts->GetContacts($oAuth, $sAccessToken, $sAccessTokenSecret, false, true, $iMaxResults);

    // turn array with contacts into html string
    $sContacts = $sContactName = '';
	$eContacts = array();
    foreach($aContacts as $k => $aInfo) {
        $sContactName = end($aInfo['title']);
        $aLast = end($aContacts[$k]);
        foreach($aLast as $aEmail) {
            //$sContacts .= '<p>' . $sContactName . '(' . $aEmail['address'] . ')</p>';
            $sContacts .=  '<p>' . $aEmail['address'] . '</p>'; 
			array_push($eContacts,$aEmail['address']);          
        }
    }  
} else {
    // prepare access token and set it into session
    $oRequestToken = $oGetContacts->get_request_token($oAuth, false, true, true);
    $_SESSION['oauth_token'] = $oRequestToken['oauth_token'];
    $_SESSION['oauth_token_secret'] = $oRequestToken['oauth_token_secret'];
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invite Your Friend</title>
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
				<?php if ($sStep == 'auth'): ?>
					<div class="span10 offset2">
						<div class="well" align="center">	
							<h4>Invite your friends for e-Yantra Competiton</h4>
							<a class="btn btn-large btn-primary" type="button" href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $oAuth->rfc3986_decode($oRequestToken['oauth_token']) ?>">Gmail</a>
							<a class="btn btn-large btn-primary" type="button" href="#">Yahoo</a>
							<p>If you have a Google or Yahoo! Please click on any of the buttons above.</p>
						</div>
					</div>  				       
			    <?php endif ?>	  			
			    <?php if ($sStep == 'fetch_contacts'){ ?>
				    <div class="span10 offset2">
				    	<?php $this->load->helper('form'); ?>
				    	<?php			    
			    		$attributes = array('class' => 'form-horizontal', 'id' => 'invitefrd', 'name' => 'invitefrd', 'method' => 'post');
						echo form_open('teamprofile/sndinvite', $attributes);	
						?>	  
				    	<!--<form class="form-horizontal" name="invitefrd">-->
				    	<p><button class="btn btn-primary" type="button" id="selectall" onclick="javascript:checkall('invitefrd','frdcontact',true)">Select All</button>  <button class="btn btn-primary" type="button" id="deselectall" onclick="javascript:checkall('invitefrd','frdcontact',false)">Deselect All</button><p>
				    	<p><button class="btn btn-primary" type="submit" name="subcon" id="subcon">Next</button></p>
				    	<?php foreach($eContacts as $email) { if ($email != NULL){ ?>				    		
				  			<label class="checkbox"><input type="checkbox" id="frdcontact" name="frdcontact[]" value="<?php echo $email; ?>"><?php echo $email; ?></label>
						<?php	}  }  ?>
						<p><button class="btn btn-primary" type="submit" name="subcon"  id="subcon">Next</button></p>						
						</form>
			    	</div>
			    <?php } ?>						
		</div>	
	</div>	 
	<?php $this->load->view('footer');?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>static/js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script> 
    <script>
    	function checkall(formname,checkname,thestate){
			var el_collection=eval("document.forms."+formname+"."+checkname)
			for (c=0;c<el_collection.length;c++)
				el_collection[c].checked=thestate
		}
		
		$("#subcon").click(function(){{
			alert("Tested");
    		if(!$('#invitefrd input[type="checkbox"]').is(':checked')){
      			alert("Please check at least one.");
      			return false;
    	}
		});
	</script>   
    </body>
</html>  

<!--
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Google API - Get contact list | Script Tutorials</title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h2>Google API - Get contact list</h2>
            <a href="#" class="stuts">Back to original tutorial on <span>Script Tutorials</span></a>
        </header>
        <img src="oauthLogo.png" class="google" alt="google" />

    <?php if ($sStep == 'auth'): ?>
        <center>
        <h1>Step 1. OAuth</h1>
        <h2>Please click <a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $oAuth->rfc3986_decode($oRequestToken['oauth_token']) ?>">this link</a> in order to get access token to receive contacts</h2>
        </center>
    <?php elseif ($sStep == 'fetch_contacts'): ?>
        <center>
        <h1>Step 2. Results</h1>
        <br />
        <?= "SACHIN" ;//$sContacts; ?>
        </center>        
    <?php endif ?>
    <?php if ($sStep == 'fetch_contacts'){  
	    foreach($eContacts as $email) { if ($email != NULL){ ?>
	  			<input type="checkbox" name="contactemail" value="<?php echo $email; ?>"><?php echo $email; ?><br>
	<?php	} }
	}
    ?>
    

</body>
</html>
-->