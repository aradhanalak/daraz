<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
</head>
<body>
    <h1>Update Record</h1>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "daraz";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the current record
        $stmt = $conn->prepare("SELECT itemname, price FROM pricelist WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($itemname, $price);
        $stmt->fetch();
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $itemname = $_POST['itemname'];
        $price = $_POST['price'];

        // Prepare the SQL UPDATE statement
        $stmt = $conn->prepare("UPDATE pricelist SET itemname = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssi", $itemname, $price, $id);

        if ($stmt->execute() === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

        // Redirect back to the main page
        header("Location: viewlistV3.php");
        exit();
    }

    $conn->close();
    ?>

    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Item Name:</label>
        <input type="text" name="itemname" id="itemname" value="<?php echo $itemname; ?>" required>
        <br>
        <label for="price">Price:</label>
        <input type="price" name="price" id="price" value="<?php echo $price; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
