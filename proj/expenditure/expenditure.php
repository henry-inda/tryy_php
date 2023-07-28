<!DOCTYPE html>
<html>
<head>
    <title>Expenditure Form</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f1f1f1;
        }

        /* Center the form vertically */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card w-50">
        <div class="card-header">
            <h2 class="text-center">Expenditure Form</h2>
        </div>
        <div class="card-body">
            <form id="expenditureForm" action="expenditure_add.php" method="post">
                <div class="mb-3">
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="particulars" class="form-label">Particulars:</label>
                    <input type="text" id="particulars" name="particulars" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="amount_spent" class="form-label">Amount Spent:</label>
                    <input type="number" id="amount_spent" name="amount_spent" step="0.01" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <input type="text" id="category" name="category" class="form-control" required>
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
    document.getElementById('expenditureForm').onsubmit = function (event) {
        var amountSpent = document.getElementById('amount_spent').value;
        if (isNaN(amountSpent) || parseFloat(amountSpent) <= 0) {
            event.preventDefault();
            alert('Please enter a valid amount spent.');
        }
    };
</script>
</body>
</html>
