<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connector file
    require_once "../includes/dbconnect.php";

    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL statement to insert data into the users table
    $insertSql = "INSERT INTO user (username, email, password, phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $phone);

    if ($stmt->execute()) {
        // Data inserted successfully
        $stmt->close();
        // Close the database connection
        $conn->close();
        // Redirect to a success page or login page
        header("Location: login.php");
        exit();
    } else {
        // Error occurred while inserting data
        echo "Error: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
    // Close the database connection
    $conn->close();
}
?>
