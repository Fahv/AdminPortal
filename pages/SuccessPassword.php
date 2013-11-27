<html>
<head>
	<noscript>
		<meta http-equiv="refresh" content="5;url=Logout.php" />
	</noscript>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>
<body>
	<div id="content">
<h3>Successfully changed your Password</h3>
<p>You will be logged out in<br /> <span id="seconds">5</span> seconds <br /><a href='Logout.php'>Log me out now!</a></p>
</div>
 <script>
      var seconds = 5;
      setInterval(
        function(){
          if (seconds <= 1) {
            window.location = 'Logout.php';
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
