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
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful!";
			header("Location: viewlistV2.php");
			exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $conn->close();
}
?>
