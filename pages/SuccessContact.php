<html>
<head>
	<noscript>
		<meta http-equiv="refresh" content="5;url=admin-home.php" />
	</noscript>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>
<body>
	<div id="content">
<h3>Successfully changed your contact information</h3>
<p>You should be redirected to the home scren in<br /> <span id="seconds">5</span> seconds <br /><a href='admin-home.php'>Take me there now!</a></p>
</div>
 <script>
      var seconds = 5;
      setInterval(
        function(){
          if (seconds <= 1) {
            window.location = 'admin-home.php';
          }
          else {
            document.getElementById('seconds').innerHTML = --seconds;
          }
        },
        1000
      );
    </script>

</body>
</html>
