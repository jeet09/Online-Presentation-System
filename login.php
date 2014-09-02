<!doctype html>
<html>
<head>
	<?php include("inc/site.inc.php"); ?>
	<title> <?php echo $site_name; ?> </title>
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<link href="css/button.css" type="text/css" rel="stylesheet" />

	<style>
			.tb5 {
				border:2px solid #456879;
				border-radius:10px;
				height: 40px;
				width: 230px;
			}
			#table1 {
			    height: 100%;	
			    width: 100%;
			    display: table;
			    padding-top:100px;
			  }
			  #table2 {
			    vertical-align: middle;
			    display: table-cell;
			    height: 100%;
			    
			  }
			  #myTable {
			    margin: 0 auto;
			  }
  </style>
</head>
<body>
	<div class="content">
		<div class="top_block header">
			<div class="content">
				<img src="img/logo.png" width="60" height="80" align="left"><h2> <?php echo $site_name; ?></h2></img>
			</div>
		</div>
		<div class="background left">
		</div>
		<div class="left_block left">
			<div class="content">
			</div>
		</div>
		<div class="background right">
		</div>
		<div class="right_block right">
			<div class="content">
			</div>
		</div>
		<div class="background main content">
		</div>
		<div class="center_block main content">
			<div class="content">
				<?php
					echo "<form id = 'frm3' action = 'login.php?check' method ='post' >\n
					<div id='table1'> \n
					<div id='table2'>\n
					<table id='myTable' border='0'>\n

						<tr>\n
							<td>Enter User Name: </td>\n
							<td><input type = 'text' name = 'uname' class='tb5' required></td>\n				
						</tr>\n
						<tr>\n
							<td>Enter Password: </td>\n
							<td><input type = 'password' name = 'upass' class='tb5' required></td>\n				
						</tr>\n
						<tr>\n
							<td colspan='2' align='center'><input type = 'submit'  value = 'Login' class='mybutton'>
							<input type = 'reset' value = 'Reset' class='mybutton'></td>\n
						</tr>\n
						</table>\n</div>\n</div></form>";
					if( array_key_exists('check',$_REQUEST) ) {
						include('inc/settings.php');
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						$uname = $_REQUEST['uname'];
						$paswd = sha1($_REQUEST['upass']);
						$sql= "SELECT user_name,pwd,user_type from ".$tb_pr."_user_details;";
						$result = mysqli_query($conn,$sql);
						$flag = 0;
						while($row = mysqli_fetch_array($result))
						  {
  							if ($row['user_name'] == $uname && $row['pwd'] == $paswd) {
						  		$usr_type = $row['user_type'];
						  		$usr_name = $row['user_name'];
						  		$flag = 0;
						  		break;
						  		}
							  else
								$flag = 1;
								
						  }
						  //echo $usr_type;
						  //echo $flag;
						  if($flag == 0)
						  {
												  
							
						  	if($usr_type == 35){
						  		session_start();
						  		$_SESSION['user'] = $usr_name;
						  		header("Location: admin/index.php");
							  	exit; }
						  	else{
						  		session_start();
						  		$_SESSION['user'] = $usr_name;
						  		header("Location: index.php");
						  		exit;}
						  }
						  else
						  	echo "<ul><li><font color='red'>Username/Password Incorrect!!!</font></li></ul>";

						mysqli_close($conn);

						
					}
				?>
			</div>
		</div>
		<div class="bottom_block footer">
			<div class="content">
			</div>
		</div>
	</div>

</body>
</html>
