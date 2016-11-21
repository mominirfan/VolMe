<?php

echo "clinton wins election 2016<br/>";

$servername = "localhost";
$username = "Peruna3330DBUser";
$password = "Sr3Nw4480!";
$dbname = "smu3330_43231257_db";
$pw = "pwd";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$conn->query("CREATE TABLE USER (id int auto_increment PRIMARY KEY, username VARCHAR(256), password VARCHAR(256), type VARCHAR(256))");
$conn->query("CREATE TABLE AUCTION (id int auto_increment PRIMARY KEY, title VARCHAR(256), category VARCHAR(256), description VARCHAR(256), startingBid DECIMAL(25,2), CONSTRAINT bidID FOREIGN KEY (id) REFERENCES BIDS(id), duration int, CONSTRAINT seller FOREIGN KEY (id) REFERENCES USER(id))");
$conn->query("CREATE TABLE BIDS (id int auto_increment PRIMARY KEY, amount DECIMAL(25,2), CONSTRAINT auction FOREIGN KEY (id) REFERENCES AUCTION(id), CONSTRAINT buyer FOREIGN KEY (id) REFERENCES USER(id))");

$conn->query("INSERT INTO USER VALUES(1,\"john sully\",\"jsully\", \"bruh\", \"seller\")"); 
$conn->query("INSERT INTO USER VALUES(2,\"nimom nafri\",\"mirfan\", \"mang\", \"buyer\")"); 
$conn->query("INSERT INTO BIDS (id, amount, auction, buyer) VALUES(1,9001,1, 2)"); 
$conn->query("INSERT INTO BIDS (id, amount, auction, buyer) VALUES(2,603,2,2)"); 
$conn->query("INSERT INTO AUCTION (id,title, category, description, startingBid, bidID, duration, seller) VALUES(1, \"A1\",\"cars\",\"runs well clean title\", 9000.43, 1, 30, 1)"); 
$conn->query("INSERT INTO AUCTION (id,title, category, description, startingBid, bidID, duration, seller) VALUES(2, \"A2\",\"phones\",\"iphone 6s\", 599.99, 2, 30, 1)"); 


$res = $conn->query("SELECT * FROM USER"); 
$res->data_seek(0);


echo "bruh"; 
while ($row = $res ->fetch_assoc())
{
	
	echo "Id = " . $row['id'] . "| Username = " . $row['username'] . "| Password = " . $row['password'] . "| Type = " . $row['type'] . "<br/>";

}



//create option to display the contents of the database as a JSON Array
if ("true" == "true")
{
	$res = $conn->query("SELECT * FROM USER");
	$arr = array();
	echo sizeOf($arr);
	while ($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row;
	}

	echo json_encode($arr);
}

if ("true" == "true")
{
	$res = $conn->query("SELECT * FROM USER");
	$arr = array();
	echo sizeOf($arr);
	while ($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row;
	}

	echo json_encode($arr);
}

if ("true" == "true")
{
	$res = $conn->query("SELECT * FROM BIDS");
	$arr = array();
	echo sizeOf($arr);
	while ($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row;
	}

	echo json_encode($arr);
}

mysqli_close($conn);
?> 
