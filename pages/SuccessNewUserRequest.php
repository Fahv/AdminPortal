<html>
<head>
	<noscript>
		<meta http-equiv="refresh" content="5;url=/AdminPortal/index.html" />
	</noscript>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>
<body>
	<div id="content">
<h3>Successfully sent email to admin</h3>
<p>You should be redirected to the home scren in<br /> <span id="seconds">5</span> seconds <br /><a href='/AdminPortal/index.html'>Take me there now!</a></p>
</div>
 <script>
      var seconds = 5;
      setInterval(
        function(){
          if (seconds <= 1) {
            window.location = '/AdminPortal/index.html';
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
