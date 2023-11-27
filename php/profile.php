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

$userInput = $_POST['email']; 
$stmt = $conn->prepare("SELECT * FROM details WHERE email = :userInput");
$stmt->bindParam(':userInput', $userInput);
$stmt->execute();

if ($stmt->rowCount() > 0) {
	echo json_encode(["message" => "Input exists in the database."]);
	 
} else {
	if (isset($_POST['age']) && $_POST['dob'] != '' && isset($_POST['contact']) && $_POST['address'] != '' ) {
		$sql = "INSERT INTO details(age, dob, contact, adress) VALUES('" . addslashes($_POST['age']) . "', '" . addslashes($_POST['dob']) . "', '" . addslashes($_POST['contact']) . "', '" . addslashes($_POST['address']) . "')";

		if ($conn->query($sql)) {
			$response['success'] = true;
		}
	}
}

header('Content-Type: application/json');
echo json_encode($response);
