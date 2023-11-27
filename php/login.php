<?php

$host = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=phptest", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userName = $_POST['fName'];
    $userPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM details WHERE firstname = :userName");
    $stmt->bindParam(':userName', $userName);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userPassword == $user['pswrd']) {

            echo json_encode(["success" => true, "user" => $user["pswrd"]]);
        } else        echo json_encode(["failed" => false]);
    } else {
        echo json_encode(["success" => false, "message" => "User not found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $e->getMessage()]);
}

$conn = null;
?>
