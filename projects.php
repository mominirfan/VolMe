<?php
//@AUTHOR - Momin Irfan
//@DATE - 10/07/2016


$servername = "localhost";
$username = "Peruna3330DBUser";
$password = "Sr3Nw4480!";
$dbname = "smu3330_43231257_db";
$pw = "pwd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$conn -> query("CREATE TABLE PROJECT(project_title VARCHAR(256) primary key, project_description VARCHAR(256), location VARCHAR(256), start_date VARCHAR(256), end_date VARCHAR(256), remote_work int, req_skills VARCHAR(256), published_at VARCHAR(256), completed int, nonprofit VARCHAR(256))"); 

//create logic to add entries to the database
if ($_GET['add'] == "true")
{
	if ( $_POST['project_title'] != "" && $_POST['project_description'] != "" && $_POST['location'] != "" && $_POST['start_date'] != "" && $_POST['end_date'] != "" && $_POST['remote_work'] != "" && $_POST['req_skills'] != "" && $_POST['published_at'] != "" && $_POST['nonprofit'] != "")
	{
		$pt = $_POST['project_title'];
		$pd = $_POST['project_description'];
		$loc = $_POST['location'];
		$sd = $_POST['start_date'];
		$ed = $_POST['end_date'];
		$rw = $_POST['remote_work'];
		$rs = $_POST['req_skills'];
		$pa = $_POST['published_at']; 
		$np = $_POST['nonprofit'];

		$sql = mysqli_prepare($conn, "INSERT INTO PROJECT (project_title, project_description, location, start_date, end_date, remote_work, req_skills, published_at, completed, nonprofit ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)");
		mysqli_stmt_bind_param($sql, 'sssssisss', $pt, $pd, $loc, $sd, $ed, $rw, $rs, $pa, $np);
    	
		if (mysqli_stmt_execute($sql))
  		{
  			echo "Entry added successfully\n";
  			$sql->close();
  		}
  		else
  		{
  			echo "Error adding the entry\n";
  		}
	}
	else
	{
		$sql = "Wrong inputs entered";
	}


}


//create option to display the contents of the database as a JSON Array
if ($_GET['display'] == "true")
{
	$res = $conn->query("SELECT * FROM PROJECT");
	$arr = array();
	while ($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row;
	}

	echo json_encode($arr);
}

if($_GET['delete'] == true)
{
	if($_GET['project_delete'] == "")
	{
		Echo "Enter a project to complete"; 
	}
	else
	{
		$sql = mysqli_prepare($conn, "DELETE FROM PROJECT WHERE project_title=?");
		mysqli_stmt_bind_param($sql, 's', $_GET['project_delete']);
		if (mysqli_stmt_execute($sql))
  		{
  			echo "change made"; 
  			$sql->close();
  		}
  		else
  		{
  			echo "No project to delete given\n";
  		}
	}
}

if($_GET['getProjects'] == true)
{
	if($_GET[ 'np'] == "")
	{
		Echo "Invalid Non-Profit Entered";
	}
	else
	{	
		
//		$sql = mysqli_prepare($conn, "SELECT project_title FROM PROJECT WHERE nonprofit=?");
//		mysqli_stmt_bind_param($sql, 's', $np);
//		if (mysqli_stmt_execute($sql))
//		{
			$np = $_GET['np'];
			$res = $conn->query("SELECT project_title FROM PROJECT WHERE nonprofit='$np'");
			$arr = array();
			while ($row = mysqli_fetch_assoc($res))
			{
				$arr[] = $row;
			}

			echo json_encode($arr);
//  		}
// 		else
// 		{
// 			echo "Error Excecuting Statement";
//  		}
	}


}
mysqli_close($conn);


?>
