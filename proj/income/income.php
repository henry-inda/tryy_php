<!DOCTYPE html>
<html>
<head>
    <title>Income Form</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f2f2f2;
        }

        /* Center the form vertically */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Style the form elements */
        .form-label {
            font-weight: bold;
        }

        /* Adjust the width of the textarea */
        textarea {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card w-50">
        <div class="card-header">
            <h2 class="text-center">Income Form</h2>
        </div>
        <div class="card-body">
            <form action="income_add.php" method="post">
                <div class="mb-3">
                    <label for="source" class="form-label">Source:</label>
                    <input type="text" id="source" name="source" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <input type="number" id="amount" name="amount" step="0.01" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="details" class="form-label">Details:</label>
                    <textarea id="details" name="details" rows="4" class="form-control" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and custom JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Form validation using JavaScript
    document.querySelector('form').onsubmit = function (event) {
        var amount = document.getElementById('amount').value;
        if (isNaN(amount) || parseFloat(amount) <= 0) {
            event.preventDefault();
            alert('Please enter a valid amount.');
        }
    };
</script>
</body>
</html>
