<!DOCTYPE html>
<html>
<head>
    <title>Budget Form</title>
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

        /* Style the card for the form */
        .card-form {
            max-width: 400px;
        }

        /* Style the form elements */
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card card-form">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center">Budget Form</h2>
        </div>
        <div class="card-body">
            <form id="budgetForm" action="budget_add.php" method="post">
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <input type="number" name="amount" class="form-control" required>
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
    document.getElementById('budgetForm').onsubmit = function (event) {
        var amount = document.getElementsByName('amount')[0].value;
        if (isNaN(amount) || parseFloat(amount) <= 0) {
            event.preventDefault();
            alert('Please enter a valid amount.');
        }
    };
</script>
</body>
</html>
