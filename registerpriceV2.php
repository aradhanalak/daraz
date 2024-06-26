<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "daraz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemx = $_POST['item-name'];
    $pricex = $_POST['price'];

    $sql = "INSERT INTO pricelist(itemname, price) VALUES ('$itemx', '$pricex')";

    if ($conn->query($sql) === TRUE) {
        echo "New item inserted to the database successfully";
		header("Location: viewlistV3.php");
		exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
