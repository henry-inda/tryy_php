<!DOCTYPE html>
<html>
<head>
<style>

        /* Custom styling for the navbar */
        /* ... Same as before ... */

        /* Styling for the main content with animated background */
        #main {
            padding: 20px;
            /* Set the animated background */
            background: linear-gradient(135deg, #92a8d1, #667eea, #3f51b5, #00bcd4, #4caf50, #fbc02d, #ff9800, #ff5722, #e91e63, #9c27b0);
            background-size: 300% 300%; /* Increase the size of the background animation */
            animation: gradientAnimation 10s ease infinite; /* Apply the animation to the background */
        }

        /* Define the animation keyframes */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
    <title>Sfund</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
    // Include the navbar.php file from the includes folder
    include "../includes/navbar.php";
    ?>
    <div class="container mt-5" id="main">
        <h2>Welcome to your dashboard</h2>
        <p>You can add your dashboard content here.</p>
        <!-- Add buttons for the forms -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
        <a href="../income/income.php" class="btn btn-primary btn-lg mr-md-2 mb-2" role="button">Add Income</a>
        <a href="../expenditure/expenditure.php" class="btn btn-success btn-lg mr-md-2 mb-2" role="button">Add Expenditure</a>
        <a href="../budget/budget.php" class="btn btn-info btn-lg mb-2" role="button">Manage Budget</a>
    </div>
    </div>
    <!-- Include Bootstrap JS link here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
