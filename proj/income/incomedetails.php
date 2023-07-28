<?php
// Include the database connector file
require_once "../includes/dbconnect.php";

// Delete income data if the "Delete" button is clicked
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteSql = "DELETE FROM income WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $deleteId);

    if ($stmt->execute()) {
        // Data deleted successfully, redirect back to incomedetails.php
        header("Location: incomedetails.php");
        exit();
    } else {
        // Error occurred while deleting data
        $deleteMessage = "Error deleting income entry: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Fetch income data from the database
$sql = "SELECT * FROM income";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Details</title>
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
        .table-container {
            overflow-x: auto;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Income Details</h2>

    <?php if (isset($deleteMessage)) : ?>
        <div class="alert alert-success"><?php echo $deleteMessage; ?></div>
    <?php endif; ?>

    <div class="table-container">
        <?php if ($result->num_rows > 0) : ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Source</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["source"]; ?></td>
                            <td><?php echo $row["amount"]; ?></td>
                            <td><?php echo $row["date"]; ?></td>
                            <td><?php echo $row["details"]; ?></td>
                            <td>
                                <a href="incomedetails.php?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm delete-btn">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No income data found in the database.</p>
        <?php endif; ?>
    </div>

</div>

<!-- Bootstrap JS and custom JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
