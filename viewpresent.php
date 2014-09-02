<!doctype html>
<html>
<head>
	<?php
		session_start();
		if( $_SESSION['user'] == "")
		{
			header("Location: login.php");
			exit;
		}
		else {
			include('./inc/settings.php');
		
			$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
			if(! $conn )
				die("not connected to mysqli".mysqli_errno());
		}
	?>
	<?php include("inc/site.inc.php"); ?>
	
	<title> <?php echo $site_name; ?> </title>
	<script>

	function full() {
		if (
    		document.fullscreenEnabled ||
    		document.webkitFullscreenEnabled ||
    		document.mozFullScreenEnabled ||
    		document.msFullscreenEnabled) {
    		var i =document.getElementById("fr");
    		// go full-screen
			if (i.requestFullscreen) {
    			i.requestFullscreen();
			} else if (i.webkitRequestFullscreen) {
    			i.webkitRequestFullscreen();
			} else if (i.mozRequestFullScreen) {
    			i.mozRequestFullScreen();
			} else if (i.msRequestFullscreen) {
    			i.msRequestFullscreen();
			}
		}
	}
	function exi() {
		if (
    			document.fullscreenElement ||
    			document.webkitFullscreenElement ||
    			document.mozFullScreenElement ||
    			document.msFullscreenElement) {
					if (document.exitFullscreen) {
    					document.exitFullscreen();
					} else if (document.webkitExitFullscreen) {
    						document.webkitExitFullscreen();
					} else if (document.mozCancelFullScreen) {
    						document.mozCancelFullScreen();
					} else if (document.msExitFullscreen) {
    						document.msExitFullscreen();
					}
		}
		
	}
	
	
	</script>
	
</head>
<body>
	<?php
	
		
		echo "<center><iframe id='fr' src='viewpresentframe.php' width='80%' height='550px'></iframe></center>";
		echo "<br />";
		echo "<center><input type='submit' value='Switch to Full Screen' onclick='full()' /></center>";

	?>

</body>
</html>
