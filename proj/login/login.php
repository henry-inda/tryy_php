<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
    $password = $_POST["password"];

    // Prepare and execute the SQL statement to fetch user data from the database
    $selectSql = "SELECT id, password FROM user WHERE username = ?";
    $stmt = $conn->prepare($selectSql);
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        // Password is correct, store user_id in session and redirect to a dashboard or home page
        $_SESSION["user_id"] = $userId;
        $stmt->close();
        $conn->close();
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials, show an error message
        $invalidCredentials = true;
    }

    // Close the statement
    $stmt->close();
    // Close the database connection
    $conn->close();
}
?>
<div id="main">
    <form action="login.php" method="post" class="p-4 border border-secondary rounded">
        <h2 class="text-center mb-4">Login</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" required>
            <?php
            if (isset($invalidCredentials) && $invalidCredentials) {
                echo '<div class="text-danger">Invalid username or password.</div>';
            }
            ?>
        </div>
        <div class="text-center">
            <input type="submit" value="Login" class="btn btn-primary">
            <p>Don't have account?<a href="signup.php">Signup here</a></p>
        </div>
    </form>
</div>
<p>Don't have an account? <a href="signup.php">Signup here</a>.</p>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
