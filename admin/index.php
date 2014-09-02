<!doctype html>
<html>
<head>
	<?php
		session_start();
		if( $_SESSION['user'] == "")
		{
			header("Location: ../login.php");
			exit;
		}
	?>
	<?php include("../inc/site.inc.php"); ?>
	<title> <?php echo $site_name; ?> </title>
	<link href="../css/style.css" type="text/css" rel="stylesheet" />
	<link href="../css/button.css" type="text/css" rel="stylesheet" />

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
			    padding-top:90px;
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
				<a href='index.php' style="text-decoration:none"><img src="../img/logo.png" width="60" height="80" align="left"><h2> <?php echo $site_name; ?></a></h2></img>
				<font style="float:right"><?php  echo "Hello <b>". $_SESSION['user']."</b> ";
				 echo "<a href=index.php?logout>Logout</a>"."&nbsp;";
				 	if( array_key_exists("logout",$_REQUEST) ) {
				 		session_destroy();
				 		header("Location: ../login.php");
				 		exit;
				 	}
				 ?></font>
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
				<?php
					echo "<form id = 'frm3' action = 'index.php?check' method ='post' >\n
					<div id='table1'> \n
					<div id='table2'>\n
					<table id='myTable' cellpadding='6' border='0'>\n
						<tr>\n
							<td align='center'><a href='index.php?site' style='text-decoration:none'><font size='5' face='Courier New'>Site<br />Management</font></a></td>\n
						</tr>\n
						<tr>\n
							<td align='center'><a href='index.php?user' style='text-decoration:none'><font size='5' face='Courier New'>User<br />Management</font></a></td>\n
						</tr>\n
						<tr>\n
							<td align='center'><a href='index.php?presentation' style='text-decoration:none'><font size='5' face='Courier New'>Presentation Management</font></a></td>\n
						</tr>\n
					</table>\n</div>\n</div></form>";
					
					
				?>
			</div>
		</div>
		<div class="background main content">
		</div>
		<div class="center_block main content">
			<div class="content">
			<?php
					echo "<a href='index.php'><img src='../img/home.png' width='50' height='50'></img></a>";
					if( array_key_exists("site",$_REQUEST) ) {
						echo " <form id = 'frm3' action = 'index.php?sitename' method ='post' >\n
							<div id='table1'> \n
							<div id='table2'>\n
							<table id='myTable' border='0'>\n
								<tr>\n
									<td>Enter Site Name:</td>\n
									<td><input type='text' name='sitename' class='tb5' required /></td>\n
								</tr>\n		
								<tr>\n
									<td align='center' colspan='2'><input type='submit' value='submit' class='mybutton' /> </td>\n
								</tr>\n					
							</table>\n</div>\n</div></form>";
							
					}
					else if( array_key_exists("user",$_REQUEST) ) {
						echo " <form id = 'frm3' action = 'index.php' method ='post' >\n
							<div id='table1'> \n
							<div id='table2'>\n
							<table id='myTable' border='0'>\n
								<tr>\n
									<td><a href='index.php?adduser' class='mybutton'>Add User</a></td>\n
								</tr>\n		
								<tr>\n
									<td><a href='index.php?updateuser' class='mybutton'>Modify User</a></td>\n
								</tr>\n					
								<tr>\n
									<td><a href='index.php?deleteuser' class='mybutton'>Delete User</a></td>\n
								</tr>\n
							</table>\n</div>\n</div></form>";
					}
					else if( array_key_exists("presentation",$_REQUEST) ) {
						echo "<form id = 'frm5' action = 'index.php?present' method ='POST'>\n
						<div id='table1'> <div id='table2'><table  id='myTable' border='0'>\n";
						include('../inc/settings.php');
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						$sql= "SELECT * from ".$tb_pr."_user_details;";
						$result = mysqli_query($conn,$sql);
						
						echo "<tr><td><select name=".'"users"'.">";
						echo "<option value=0 >Select User</options>";
						while($row = mysqli_fetch_array($result))
  						{
  							if( $row['user_type'] == 75)
							echo "<option value = ".$row['user_id'].">".$row['user_name']."</option>";
						}
							echo "</select></td>";
						echo "<td><input class='mybutton' type = ".'"submit"'."value = ".'"Select User"'."></td></tr>";
						mysqli_close($conn);
						echo "</table>\n</div>\n</div>\n</form>";
						
					}
					
			if( array_key_exists("sitename",$_REQUEST) ) {
								$sitename=  $_REQUEST['sitename'];
									
								$str = "<?php\n".'$site_name= "'.$sitename.'";'."\n"."?>";
				  				$file = fopen("../inc/site.inc.php","w");
		 		  				fwrite($file, $str);
						  		fclose($file);
						  		header("Location: index.php");
				}
			if( array_key_exists("adduser",$_REQUEST) ) {
					
							echo "<form id = 'frm2' action = 'index.php?create' method ='POST'>\n
							<div id='table1'> <div id='table2'><table  id='myTable' style='margin-top:-60px' border='0'>\n
					
					
							<td><input type = 'text' name = 'uname' placeholder='Enter User Name'  class='tb5' 								required></td>\n
							</tr>\n			
							<tr>\n
							<td><input type = 'password' name = 'paswd' placeholder='Enter Password'  								class='tb5'required></td>\n
							</tr>\n
							<tr>\n
							<td><input type = 'password' name = 'rpaswd' placeholder='Re-Type Password' required 								class='tb5'></td>\n
							</tr>\n
							<tr>\n
							<td colspan='2'><input type = 'radio' name = 'gndr1'  checked = 'true' value = 								'male'>Male
							<input type = 'radio' name = 'gndr1' value = 'female'>Female</td>\n
							</tr>\n
							<tr>\n
							<td><input type = 'email' name = 'usremail' placeholder='Enter Email'  class='tb5' 								required></td>\n
							</tr>\n
							<tr>\n
							<td><input type = 'file' name = 'profilepic'  class='tb5' required></td>\n
							</tr>\n
							<tr>\n
							<td colspan='2'><input type = 'Submit' name = 'signup' value='SignUp' 								style='width:45%' class='mybutton' >
							<input type = 'reset' value='Reset' style='width:45%'  class='mybutton' >
							</td>\n
							</tr>\n
							</table>\n
							</div>\n
							</div>\n</form>";
							if($_REQUEST['adduser']!="") {
								echo "<ul><li>".$_REQUEST['adduser']."</ul></li>";
							}
			
			}
			else if( array_key_exists("updateuser",$_REQUEST) ) {
						echo "<form id = 'frm2' action = 'index.php?update' method ='POST'>\n
						<div id='table1'> <div id='table2'><table  id='myTable' border='0'>\n";
						include('../inc/settings.php');
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						$sql= "SELECT * from ".$tb_pr."_user_details;";
						$result = mysqli_query($conn,$sql);
						
						echo "<tr><td><select name=".'"users"'.">";
						echo "<option value=0 >Select User</options>";
						while($row = mysqli_fetch_array($result))
  						{
							echo "<option value = ".$row['user_id'].">".$row['user_name']."</option>";
						}
							echo "</select></td>";
						echo "<td><input class='mybutton' type = ".'"submit"'."value = ".'"Update User"'."></td></tr>";
						mysqli_close($conn);
						echo "</table>\n</div>\n</div>\n</form>";
								
			}
			else if( array_key_exists("deleteuser",$_REQUEST) ) {
				echo "<form id = 'frm2' action = 'index.php?delete' method ='POST'>\n
						<div id='table1'> <div id='table2'><table  id='myTable' border='0'>\n";
						include('../inc/settings.php');
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						$sql= "SELECT * from ".$tb_pr."_user_details;";
						$result = mysqli_query($conn,$sql);
						
						echo "<tr><td><select name=".'"users"'.">";
						echo "<option value=0 >Select User</options>";
						while($row = mysqli_fetch_array($result))
  						{
  							if( $row['user_type'] == 75 )
							echo "<option value = ".$row['user_id'].">".$row['user_name']."</option>";
						}
							echo "</select></td>";
						echo "<td><input class='mybutton' type = ".'"submit"'."value = ".'"Delete User"'."></td></tr>";
						mysqli_close($conn);
						echo "</table>\n</div>\n</div>\n</form>";
								
			}
			
					
					
		if( array_key_exists('create',$_REQUEST) ) { 
						include('../inc/settings.php');
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());

							
							$urname = $_REQUEST['uname'];
							$pwd1 = $_REQUEST['paswd'];
							$pwd2 = $_REQUEST['rpaswd'];
							$gender = $_REQUEST['gndr1'];
							$email = $_REQUEST['usremail'];	
							$propic = $_REQUEST['profilepic'];
							$d1 = date("Y/m/d");
							 if(strcmp($pwd1,$pwd2) == 0)
							 {
							 	if(strlen($pwd1) >= 6 && strlen($pwd1) <= 20)
							 	{
							 		$pwd = sha1($pwd1);
									$sql= "INSERT INTO ".$tb_pr."_user_details VALUES
									(null,'$urname','$pwd','$d1',75,'$_POST[gndr1]','$email','$_POST[profilepic]')";
									if (!mysqli_query($conn,$sql))
						  			echo "Error: ".mysqli_error($conn);
						  			else {
						  				header("Location: index.php");
						  			}
					
				 	 			}
							  	else
							  	{
							  	header("Location: index.php?adduser=Password length should be in between 									6-20.");

						  		
							  	}

							}
							else
							{
								header("Location: index.php?adduser=Password Does Not Match");

							}
					
				}
				if( array_key_exists("update",$_REQUEST) ) {
						include('../inc/settings.php');	
						echo "<form id = 'frm2' action = 'index.php?updateconfirm' method ='POST'>\n
						<div id='table1'> <div id='table2'><table  id='myTable' border='0'>\n";					
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						$sql= "SELECT * from ".$tb_pr."_user_details WHERE user_id = ".$_REQUEST['users'].";";

						$result = mysqli_query($conn,$sql);

						$row = mysqli_fetch_array($result);
						

						echo "<input type = hidden name = ".'"uid1"'." value = ".$row['user_id'].">";

						echo "<tr><td>User Name</td><td><input class='tb5' type = text name = ".'"uname1"'."value = ".$row['user_name']."></td></tr>";

						echo "<tr><td>Password</td><td> <input class='tb5' type = password name = ".'"pwd1"'." value = ".""."></td></tr>";
						

						if($row['user_type'] == 35)
						echo "<tr><td>Type of User </td><td> <input type = radio name = ".'"utyp"'." checked = ".'"true"'." value = 35> Administrator 
					<input type = ".'"radio"'." name = ".'"utyp"'." value = 75> Authenticated 							User</td></tr>";
						else
						echo "<tr><td>Type of User</td><td><input type = radio name = ".'"utyp"'." value = 35> Administrator 
						<input type = ".'"radio"'." name = ".'"utyp"'." checked = ".'"true"'." value = 							75> Authenticated User</td></td>";

						echo "<tr><td>Email-id</td><td> <input type = email name = ".'"uemail"'." value = ".$row['email_id']."></td></tr>";

						echo "<tr><td align='center' colspan='2'><input class='mybutton' type = submit></td></td>";
						echo "</table>\n</div>\n</div>\n</form>";
						echo "<ul><li>If you want to change password, then Enter password else keep it blank!!</li></ul>";

				}
				if( array_key_exists("updateconfirm",$_REQUEST) ) {
					include('../inc/settings.php');

					$conn=mysqli_connect($hname,$uname,$pwd,$dbname);

						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						if( $_REQUEST['pwd1'] !="" ) {
					$sql= "UPDATE ".$tb_pr."_user_details SET user_name = '".$_REQUEST['uname1']."', pwd ='".sha1($_REQUEST['pwd1'])."', user_type =".$_REQUEST['utyp'].", email_id = '".$_REQUEST['uemail']."' WHERE user_id = ".$_REQUEST['uid1'].";";
						}
						else
						{
						$sql= "UPDATE ".$tb_pr."_user_details SET user_name = '".$_REQUEST['uname1']."', user_type =".$_REQUEST['utyp'].", email_id = '".$_REQUEST['uemail']."' WHERE user_id = ".$_REQUEST['uid1'].";";
						}
						if (mysqli_query($conn,$sql)) 
							 echo "Updated Successfully";
						
						
						else 
							echo "Updated not Successfully";
							
			}	
					
						
			if( array_key_exists("delete",$_REQUEST) ) {
				include('../inc/settings.php');
				echo $_REQUEST['users'];
				$conn=mysqli_connect($hname,$uname,$pwd,$dbname);

				if(! $conn )
					die("not connected to mysqli".mysqli_errno());
				$sql= "DELETE from ".$tb_pr."_user_details WHERE user_id ='".$_REQUEST['users']."';";

				if (mysqli_query($conn,$sql))
					echo "User delete Successfully...";
				else
					echo "User is not delete,try again";
			}
			if( array_key_exists("present",$_REQUEST) ) {
				$user_id = $_POST['users'];
						echo "<form id = 'frm2' action = 'index.php?deletepresent' method ='POST'>\n
						<div id='table1'> <div id='table2'><table  id='myTable' border='0'>\n";
						include('../inc/settings.php');
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						$sql= "SELECT * from ".$tb_pr."_presentation_details where user_id =".$user_id.";";
						$result = mysqli_query($conn,$sql);
						
						echo "<tr><td><select name=".'"presentation"'.">";
						echo "<option value=0 >Select Presentation</options>";
						while($row = mysqli_fetch_array($result))
  						{
							echo "<option value = ".$row['presentation_id'].">".$row['name_of_presentation']."</option>";
						}
							echo "</select></td>";
						echo "<td><input class='mybutton' type = ".'"submit"'."value = ".'"Delete Presentation"'."></td></tr>";
						mysqli_close($conn);
						echo "</table>\n</div>\n</div>\n</form>";
			}
			if( array_key_exists("deletepresent",$_REQUEST) ) {
				include('../inc/settings.php');
				$conn=mysqli_connect($hname,$uname,$pwd,$dbname);

					if(! $conn )
					die("not connected to mysqli".mysqli_errno());
					$sql= "DELETE from ".$tb_pr."_slide_details WHERE presentation_id ='".$_REQUEST['presentation']."';";
					if (mysqli_query($conn,$sql))
						echo "<ul><li>Slides delete Successfully.</li></ul>";
					$sql1= "DELETE from ".$tb_pr."_presentation_details WHERE presentation_id ='".$_REQUEST['presentation']."';";

					if (mysqli_query($conn,$sql1))
					echo "<ul><li>Presentation delete Successfully.</li></ul>";
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
