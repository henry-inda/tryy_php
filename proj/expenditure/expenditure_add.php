<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connector file
    require_once "../includes/dbconnect.php";

    // Get form data
    $date = $_POST["date"];
    $particulars = $_POST["particulars"];
    $amountSpent = $_POST["amount_spent"];
    $category = $_POST["category"];

    // Prepare and execute the SQL statement to insert data
    $insertSql = "INSERT INTO expenditure (date, particulars, amount_spent, category) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ssds", $date, $particulars, $amountSpent, $category);

    if ($stmt->execute()) {
        // Data inserted successfully
        $stmt->close();
        // Close the database connection
        $conn->close();
        // Redirect to expendituredetails.php after data is inserted
        header("Location: expendituredetails.php");
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
