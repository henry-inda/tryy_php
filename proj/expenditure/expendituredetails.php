<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // User is not logged in, redirect to the login page or show an error message
    header("Location: login.php");
    exit();
}

// Include the database connector file
require_once "../includes/dbconnect.php";

// Delete expenditure data if the "Delete" button is clicked
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteSql = "DELETE FROM expenditure WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $deleteId);

    $stmt->execute();
    $stmt->close();

    // Redirect to this page again to prevent accidental multiple deletions on page refresh
    header("Location: expendituredetails.php");
    exit();
}

// Fetch expenditure data from the database
$sql = "SELECT * FROM expenditure";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenditure Details</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            padding-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Expenditure Details</h2>

    <?php
    if ($result->num_rows > 0) {
        // Display the expenditure data in a table
        echo '<table class="table table-bordered table-striped">';
        echo '<thead><tr><th>ID</th><th>Date</th><th>Particulars</th><th>Amount Spent</th><th>Category</th><th>Actions</th></tr></thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["date"] . '</td>';
            echo '<td>' . $row["particulars"] . '</td>';
            echo '<td>' . $row["amount_spent"] . '</td>';
            echo '<td>' . $row["category"] . '</td>';
            echo '<td><a href="expendituredetails.php?delete_id=' . $row["id"] . '" class="btn btn-danger btn-sm">Delete</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p>No expenditure data found in the database.</p>";
    }
    ?>

</div>

<!-- Bootstrap JS and custom JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
