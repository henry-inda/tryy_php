<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: <?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : '#f2f2f2'; ?>;
            color: <?php echo isset($_COOKIE['theme']) && $_COOKIE['theme'] === '#333333' ? '#ffffff' : '#000000'; ?>;
        }
    </style>
    <script>
        function setTheme(theme) {
            document.body.style.backgroundColor = theme;
            document.body.style.color = theme === '#333333' ? '#ffffff' : '#000000';
            document.cookie = "theme=" + theme + "; path=/";
        }
    </script>
</head>
<body>
    <?php
    // Include the navbar.php file from the includes folder
    include "../includes/navbar.php";
    ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- ... Same as before ... -->
</nav>

<div class="container mt-5">
    <h2>Settings</h2>
    <div class="form-check form-switch mt-3">
        <input class="form-check-input" type="checkbox" id="darkModeToggle"
               onchange="setTheme(this.checked ? '#333333' : '#f2f2f2')">
        <label class="form-check-label" for="darkModeToggle">Dark Mode</label>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
