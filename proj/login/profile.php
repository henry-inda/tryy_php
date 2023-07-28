<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
    // Include the navbar.php file from the includes folder
    include "../includes/navbar.php";
    ?>

<div class="container mt-5">
    <?php
    // Assume the user ID is stored in the session as "user_id"
    session_start();
    if (isset($_SESSION["user_id"])) {
        // Include the database connector file
        require_once "../includes/dbconnect.php";

        // Get the user ID from the session
        $userId = $_SESSION["user_id"];

        // Prepare and execute the SQL statement to retrieve user data
        $selectSql = "SELECT username, email, phone FROM user WHERE id = ?";
        $stmt = $conn->prepare($selectSql);
        $stmt->bind_param("i", $userId);

        $stmt->execute();
        $stmt->bind_result($username, $email, $phone);
        $stmt->fetch();

        // Close the statement and database connection
        $stmt->close();
        $conn->close();

        // Hide the middle four digits of the phone number
        $maskedPhone = substr($phone, 0, 2) . str_repeat("*", 4) . substr($phone, -2);


        // Display the user information
        echo "<h2>Welcome, $username</h2>";
        echo "<p>Email: $email</p>";
        echo "<p>Phone: $maskedPhone</p>";
    } else {
        // If the user is not logged in, display a message or redirect to login page
        echo "<h2>You are not logged in.</h2>";
        // You can add a link to the login page here or handle as per your requirement
    }
    ?>
</div>

<!-- Include Bootstrap JS link here -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
