<?php
// Database connection settings
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

// SQL query to retrieve data
$sql = "SELECT itemname, price FROM pricelist";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Price Data</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Price Data</h2>

<table>
    <tr>
        <!--<th>ID</th>-->
        <th>Item Name</th>
        <th>Price</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            //echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["itemname"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    $conn->close();
    ?>
</table>

<a href="registerprice.html">Add a new item</a>

</body>
</html>
