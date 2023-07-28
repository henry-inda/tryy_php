<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connector file
    require_once "../includes/dbconnect.php";

    // Get form data
    $description = $_POST["description"];
    $amount = $_POST["amount"];

    // Prepare and execute the SQL statement to insert data into the ex_category table
    $insertSql = "INSERT INTO ex_category (description, amount) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("sd", $description, $amount);

    if ($stmt->execute()) {
        // Data inserted successfully
        $stmt->close();
        // Close the database connection
        $conn->close();
        // Redirect to budgetdetails.php after data is inserted
        header("Location: budgetdetails.php");
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
