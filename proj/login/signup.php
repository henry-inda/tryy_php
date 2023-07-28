<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
        }

        /* Custom styling for the main content */
        #main {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["user_id"])) {
    // User is logged in, redirect to a dashboard or home page
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connector file
    require_once "../includes/dbconnect.php";

    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    // Prepare and execute the SQL statement to check if the username or email already exists in the database
    $checkSql = "SELECT id FROM user WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ss", $username, $email);

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username or email already exists, show an error message
        $existingUserError = true;
    } else {
        // Insert the new user into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertSql = "INSERT INTO user (username, email, password, phone) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $phone);

        if ($stmt->execute()) {
            // User registration successful, redirect to login page or dashboard
            header("Location: login.php");
            exit();
        } else {
            // Error during registration, handle as needed (e.g., display a message)
            $registrationError = true;
        }
    }

    // Close the statement
    $stmt->close();
    // Close the database connection
    $conn->close();
}
?>

<div id="main">
    <form action="signup.php" method="post" class="p-4 border border-secondary rounded">
        <h2 class="text-center mb-4">Signup</h2>
        <?php
        if (isset($existingUserError) && $existingUserError) {
            echo '<div class="alert alert-danger mb-3">Username or email already exists.</div>';
        }
        ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="tel" name="phone" class="form-control" required>
        </div>
        <div class="text-center">
            <input type="submit" value="Signup" class="btn btn-primary">
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
