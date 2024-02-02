<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense - Financial Tracker</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<!-- Main Content -->
<div class="container mt-4">
    <h2>Edit Expense</h2>

    <!-- Expense Form -->
    <form>
        <div class="form-group">
            <label for="editDate">Date:</label>
            <input type="text" id="editDate" class="form-control" value="2024-01-24" readonly>
        </div>
        <div class="form-group">
            <label for="editCategory">Category:</label>
            <input type="text" id="editCategory" class="form-control" value="Food">
        </div>
        <div class="form-group">
            <label for="editDescription">Description:</label>
            <input type="text" id="editDescription" class="form-control" value="Lunch">
        </div>
        <div class="form-group">
            <label for="editAmount">Amount:</label>
            <input type="text" id="editAmount" class="form-control" value="$15.00">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="view_expenses.html" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
