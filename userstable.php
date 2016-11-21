<?php
//@AUTHOR - Momin Irfan
//@DATE - 10/07/2016


$servername = "localhost";
$username = "Peruna3330DBUser";
$password = "Sr3Nw4480!";
$dbname = "smu3330_43231257_db";
$pw = "pwd";
$sql = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE TABLE USERPROJ(ID INT auto_increment PRIMARY KEY, user VARCHAR(256), project VARCHAR(256), CONSTRAINT FOREIGN KEY (user) REFERENCES USERS(email), CONSTRAINT FOREIGN KEY (project) REFERENCES PROJECTS(project_title))");

////$conn->query("INSERT INTO USERPROJ (user, project) VALUES('rupal', 'cleanup4')");

if($_GET['add'] == "true")
{
	if($_POST['project'] == "" || $_POST['email'] == "")
	{
		Echo "Enter a user and project";
	}
	else
	{
		$sql = mysqli_prepare($conn, "INSERT INTO USERPROJ (user, project) VALUES(?, ?)");
		mysqli_stmt_bind_param($sql, 'ss', $_POST['email'], $_POST['project']);
		if (mysqli_stmt_execute($sql))
  		{
  			echo "Project Updated\n";
  			$sql->close();
  		}
  		else
  		{
  			echo "User or Project Does not exist\n";
  		}
	}
}


if($_GET['projvols'] == "true")
{
	if($_GET['project'] == "")
	{
		Echo "Enter a project";
	}
	else
	{
		$proj = $_GET['project'];
		$res = $conn->query("SELECT user FROM USERPROJ WHERE project='$proj'");
		$arr = array();
		while ($row = mysqli_fetch_assoc($res))
		{
			$arr[] = $row;
		}

		echo json_encode($arr);
	}
}

if ($_GET['display'] == "true")
{
	$res = $conn->query("SELECT * FROM USERPROJ");
	$arr = array();
	while ($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row;
	}

	echo json_encode($arr);
}


mysqli_close($conn);

?>
