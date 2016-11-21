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

//create logic to add entries to the database
if ($_POST['add'] == "true")
{
	if ($_POST['name'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['description'] != "" && $_POST['website'] != "")
	{
		//$id = $_POST['id']; 
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$description = $_POST['description'];
		$website = $_POST['website'];
		$sql = mysqli_prepare($conn, "INSERT INTO NONPROFITS (name, email,password, description, website) VALUES(?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($sql, 'sssss', $name, $email, $password, $description, $website);
	}
	else
	{
		$sql = "Wrong inputs entered";
	}
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


//create option to display the contents of the database as a JSON Array 
if ($_GET['display'] == "true")
{
	$res = $conn->query("SELECT * FROM NONPROFITS ORDER BY id");
	$arr = array(); 
	while ($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row; 
	}

	echo json_encode($arr); 
}

mysqli_close($conn); 


?> 