<?php
$host = "localhost";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host=$host;dbname=phptest", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

$response = array('success' => false);
 
$userInput = $_POST['firstname'];  
// SQL query to check if the input exists in the database
$stmt = $conn->prepare("SELECT * FROM details WHERE firstname = :userInput");
$stmt->bindParam(':userInput', $userInput);
$stmt->execute();
 
if ($stmt->rowCount() > 0) {
	echo json_encode(["message" => "Input exists in the database."]);
	 
} else {
	if (isset($_POST['fName']) && $_POST['lName'] != '' && isset($_POST['email']) && $_POST['password'] != '' ) {
		$sql = "INSERT INTO details(firstname, lastname, email, pswrd) VALUES('" . addslashes($_POST['fName']) . "', '" . addslashes($_POST['lName']) . "', '" . addslashes($_POST['email']) . "', '" . addslashes($_POST['password']) . "')";

		if ($conn->query($sql)) {
			$response['success'] = true;
		}
	}
}
 
header('Content-Type: application/json');
 

// if (isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['phone']) && $_POST['phone'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
// 	$sql = "INSERT INTO contacts(email, phone, pswrd) VALUES('" . addslashes($_POST['email']) . "', '" . addslashes($_POST['phone']) . "', '" . addslashes($_POST['password']) . "')";

// 	if ($conn->query($sql)) {
// 		$response['success'] = true;
// 	}
// }

echo json_encode($response);
