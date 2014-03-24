<!doctype html>

<?php
session_start();
unset($_SESSION['offset'])
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script>
	  setInterval(function(){get_contents();}, 2000);
	  
	  function get_contents() {
		$.get("read.php", function(data) {
			if(data!=""){
				$('#contents').text(data);
			}
		  });
	  }
  </script>
</head>
<body>
  <div id="contents">Loading...</div>
</body>
</html>