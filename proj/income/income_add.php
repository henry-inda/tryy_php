<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connector file
    require_once "../includes/dbconnect.php";

    // Get form data
    $source = $_POST["source"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];
    $details = $_POST["details"];

    // Prepare and execute the SQL statement to insert data
    $insertSql = "INSERT INTO income (source, amount, date, details) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("sdss", $source, $amount, $date, $details);

    if ($stmt->execute()) {
        // Data inserted successfully
        $stmt->close();
        // Close the database connection
        $conn->close();
        // Redirect to incomedetails.php after data is inserted
        header("Location: incomedetails.php");
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
