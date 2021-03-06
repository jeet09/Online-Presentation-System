<!doctype html>
<html>
<head>
	<title>Online Presentation System</title>
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<link href="css/button.css" type="text/css" rel="stylesheet" />
	<link href="css/table.css" type="text/css" rel="stylesheet" />
	<style>
		.tb5 {
			border:2px solid #456879;
			border-radius:10px;
			height: 40px;
			width: 230px;
			}
			#table-1 {
    height: 100%;
    width: 100%;
    display: table;
  }
  #table-2 {
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
				<img src="img/logo.png" width="60" height="80" align="left"><h2>Online Presentation System</h2></img>
			</div>
		</div>
		<div class="background left">
			
		</div>
		<div class="left_block left">
			<div class="content">
				<?php
				echo "<div id='table-1'> <div id='table-2'><table style='margin-bottom:200px' id='myTable' cellpadding='10' cellspacing='0' border='0'>\n
					<tr style='height:10px'>\n";
						if( array_key_exists ("start",$_REQUEST) ) {				
							echo "<td></td>\n";
						}
						else {
						echo "<td  cellpadding='5'><img src='./img/arrow.png' width='50' height='50'></img></td>\n"; }
						echo "<td cellpadding='5'><font size='4'>Start Installation</font></td>\n
					</tr>\n				
					<tr style='height:10px'>\n";
						if( array_key_exists("start",$_REQUEST) ) {
							echo "<td><img src='./img/arrow.png' width='50' height='50'></img></td>\n";
						}
						else
						{
							echo "<td></td>";
						}
						echo "<td cellspacing='2'><font size='4'>Configure Database</font></td>\n
					</tr>\n
					<tr style='height:10px'>\n
						<td></td>\n
						<td cellspacing='2'><font size='4'>Create<br />User</font></td>\n
					</tr>\n
					</table>\n</div>\n</div>\n";
			?>
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
				if( !array_key_exists('start',$_REQUEST) ) {
				echo "<center><h2>Welcome to Online Presentation System</h2></center>\n";
				echo "<center><a href='install.php?start' style='text-decoration:none' class='mybutton' >Install</a><center>\n";
				
				
				echo "</form>"	 ;
				}
				else
				{
					echo "<div id='table-1'> <div id='table-2'><table id='myTable' border='0'>\n
					<form id = 'f1' action = 'install.php?startover' method ='post' type = 'text/html'>\n
						<tr>\n
							<td><input type = 'text' required name = 'hostnametxt' placeholder = 'Enter Host Name' required class='tb5' ></td>\n
						</tr>\n
						<tr>\n
							<td><input type = 'text' name = 'dbusrtxt' placeholder = 'Enter Database User Name' class='tb5' required></td>\n
						</tr>\n
						<tr>\n
							<td><input type = 'password' name = 'dbpwdtxt' placeholder = 'Enter Database Password' class='tb5' required></td>\n
						</tr>\n
						<tr>\n
							<td><input type = 'text' name = 'dbnametxt' placeholder = 'Enter Database Name' class='tb5' required></td>\n
						</tr>\n
						<tr>\n
							<td><input type = 'text' name = 'prefixtxt' placeholder = 'Enter Table Prefix' class='tb5' required></td>\n
						</tr>\n
						<tr>\n
							<td colspan='2' align='center'><button class='mybutton'>Submit</button></td>\n
						</tr>\n
					</form>\n
				</table>\n</div>\n</div>";
				}

	if(array_key_exists('startover',$_REQUEST) ) 
	{
		
		$str = "<?php\n".'$hname= "'.$_REQUEST['hostnametxt'].'";'."\n".'$uname= "'.$_REQUEST['dbusrtxt'].'";'."\n".'$pwd= "'.
		$_REQUEST['dbpwdtxt'].'";'."\n".'$dbname= "'.$_REQUEST['dbnametxt'].'";'."\n".'$tb_pr= "'.$_REQUEST['prefixtxt'].'";'
		."\n"."?>";
			
			
			$file = fopen("inc/settings.php","w");
		 	fwrite($file, $str);
			fclose($file);

					include('inc/settings.php');

					$conn = mysqli_connect($hname,$uname,$pwd,$dbname);

					if(! $conn )	
						die("not connected to mysqli".mysqli_errno());
					
						
					$var1 = 0;

					/*--------------user_details--------------*/
					$sql1="create table ".$tb_pr."_user_details (
						user_id int(4) primary key AUTO_INCREMENT,
						user_name varchar(15) not null UNIQUE,
						pwd varchar(50) not null,
						date_of_join date not null,
						user_type int(2) not null,
						gender varchar(6) not null,
						email_id varchar(50) not null,
						profile_picture varchar(50) not null
					);";
					echo "<br>";
						if (mysqli_query($conn,$sql1))
							$var1 += 1; 
						else 
							die("<br><font color='red'>Error in creating table!! </font>".mysqli_error($conn));

					/*--------------presentation_details--------------*/
					$sql2="create table ".$tb_pr."_presentation_details (
						presentation_id int(6) primary key AUTO_INCREMENT,
						user_id int(4),
						name_of_presentation varchar(20) not null,
						date_of_creation date not null,
						FOREIGN KEY(user_id) REFERENCES ".$tb_pr."_user_details(user_id) ON DELETE SET NULL ON 							UPDATE CASCADE);";

						if(mysqli_query($conn,$sql2))
							$var1 += 1;
						else 
							die("<br>Error in creating table".mysqli_error($conn)); 


				/*--------------slide_details--------------*/		
				$sql3="create table ".$tb_pr."_slide_details (
					slide_id int(10) primary key AUTO_INCREMENT,
					presentation_id int(6),
					slide_name varchar(20) not null,
					slide_content varchar(1000) not null,
					FOREIGN KEY(presentation_id) REFERENCES ".$tb_pr."_presentation_details(presentation_id) ON DELETE 						SET NULL ON UPDATE CASCADE
				);";

					if(mysqli_query($conn,$sql3))
						$var1 += 1;
					else 
						die("<br>Error in creating table".mysqli_error($conn));

					echo"<br>";
					if (!$var1 == 3)
						
						die( "Database creation fail....");

					mysqli_close($conn);
					header("Location: createuser.php");
					exit;

			}
			
				
				
				?>
			</div>
		</div>
		<div class="bottom_block footer">
			<div class="content">
			</div>
		</div>
</body>
</html>
