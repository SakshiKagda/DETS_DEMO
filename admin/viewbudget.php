<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Expense Tracker System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .main {
            display: flex;
            padding-top: 70px;
        }

        h2 {
            color: black;
        }

        tr {
            color: black;
        }

        .thead {
            background-color: #047edf;
        }

        th {
            color: white;
        }

        .icon {
            float: right;
            margin-right: 10px;
        }

        .pagination .page-item .page-link {
            color: black;
        }

        .exceeded {
            color: red;
            font-weight: bold;
        }

        .content-wrapper {
            background-color: #E1EEF2 !important;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link.active {
            color: #2847de !important;

            background: transparent;
        }

        .btn-primary {
            background-color: #047edf !important;
            border-color: #047edf !important;
        }

        .page-title .page-title-icon {
            background-color: #2847de !important;
        }
    </style>
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <div class="main">
        <sidebar>
            <?php include("sidebar.php"); ?>
        </sidebar>
        <div class="content-wrapper">
            <div class="container mt-5">
                <div class="page-header">
                    <h1 class="page-title">
                        <a href="index.php" style="text-decoration: none; color: inherit;"> <!-- Add this anchor tag -->
                            <span class="page-title-icon text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span>
                        </a>
                        View Budgets
                    </h1>
                </div>

                <div class="icon">
                    <div class="filter-dropdown">
                        <label for="filter">Filter by Category:</label>
                        <select id="filter" name="filter">
                            <option value="all">All</option>
                            <?php
                            // Fetch distinct categories from the budgets table
                            $categorySql = "SELECT DISTINCT category FROM budgets";
                            $categoryResult = $conn->query($categorySql);
                            if ($categoryResult->num_rows > 0) {
                                while ($categoryRow = $categoryResult->fetch_assoc()) {
                                    echo "<option value='" . $categoryRow['category'] . "'>" . $categoryRow['category'] . "</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="month-filter">Filter by Month:</label>
                        <select id="month-filter" name="month-filter">
                            <option value="all">All</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>

                        </select>
                        <input type="submit" value="Apply" onclick="applyMonthFilter()">
                    </div>
                </div>

                <?php
                include 'connect.php';

                $monthFilter = isset($_GET['month-filter']) ? $_GET['month-filter'] : 'all';
                $monthCondition = ($monthFilter != 'all') ? "AND MONTH(budgets.start_date) = '$monthFilter' AND MONTH(budgets.end_date) = '$monthFilter'" : '';

                $sql = "SELECT DISTINCT users.user_id AS user_id, users.username AS username, users.email AS email 
                       FROM users INNER JOIN budgets ON users.user_id = budgets.user_id 
                       WHERE 1 $monthCondition";
                $result = $conn->query($sql);

                // Check if any users exist
                if ($result->num_rows > 0) {
                    // Output data of each user
                    while ($row = $result->fetch_assoc()) {
                        $userId = $row["user_id"];
                        $username = $row["username"];
                        $email = $row["email"];

                        // SQL query to fetch budget for the current user
                        $budgetSql = "SELECT * FROM budgets WHERE user_id = $userId";
                        $budgetResult = $conn->query($budgetSql);

                        // Check if any budget exist for the current user
                        if ($budgetResult->num_rows > 0) {
                            echo "<h4>User: $username ($email)</h4>";
                            // Output table for budget
                            echo "<table class='table table-bordered table-hover'>";
                            echo "<thead class='thead'>";
                            echo "<tr>";
                            echo "<th>User ID</th>";
                            echo "<th>Category</th>";
                            echo "<th>Planned Amount</th>";
                            echo "<th>Expense Amount</th>";
                            echo "<th>Start Date</th>";
                            echo "<th>End Date</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            // Output data of each budget
                            while ($budgetRow = $budgetResult->fetch_assoc()) {
                                echo "<tr class='budget-row'>"; // Add class for targeting rows in JavaScript
                                echo "<td>" . $budgetRow["user_id"] . "</td>";
                                echo "<td class='budget-category'>" . $budgetRow["category"] . "</td>"; // Add class for category column
                                echo "<td>" . $budgetRow["planned_amount"] . "</td>";

                                // SQL query to fetch total expense for the current category
                                $totalExpenseSql = "SELECT SUM(expenseAmount) AS totalExpense, expenseCategory FROM expenses WHERE user_id = $userId AND expenseCategory = '" . $budgetRow["category"] . "'";
                                $totalExpenseResult = $conn->query($totalExpenseSql);
                                $totalExpenseRow = $totalExpenseResult->fetch_assoc();
                                $totalExpense = $totalExpenseRow["totalExpense"];
                                $categoryName = $totalExpenseRow["expenseCategory"];

                                // Check if total expense is empty
                                if (empty($totalExpense)) {
                                    $totalExpense = 0;
                                }

                                if ($totalExpense > $budgetRow["planned_amount"]) {
                                    // If exceeded, add class for styling
                                    echo "<td class='exceeded'>" . $totalExpense . "</td>";
                                    // Show alert
                                    echo "<script>alert('Total expense exceeds planned amount for category: " . $categoryName . "');</script>";
                                } else {
                                    echo "<td>" . $totalExpense . "</td>";
                                }

                                // Display start date and end date
                                echo "<td class='budget-start-date'>" . $budgetRow["start_date"] . "</td>";
                                echo "<td class='budget-end-date'>" . $budgetRow["end_date"] . "</td>";

                                echo "</tr>";
                            }


                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<p>No budget found for user: $username ($email)</p>";
                        }
                        echo "<br><br><br>";
                    }
                } else {
                    echo "<p>No users found.</p>";
                }
                $results_per_page = 10; // Set the desired number of results per page
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $offset = ($page - 1) * $results_per_page;

                ?>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
                <a href="index.php" class="btn btn-primary mt-3">Go Back</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <footer>
        <?php include("footer.php"); ?>
    </footer>

    <script>
        function applyMonthFilter() {
            var monthFilterValue = document.getElementById('month-filter').value;
            var budgets = document.querySelectorAll('.budget-row');

            budgets.forEach(function (budget) {
                var startDate = budget.querySelector('.budget-start-date').textContent.trim();
                var endDate = budget.querySelector('.budget-end-date').textContent.trim();
                var startMonth = startDate.split('-')[1];
                var endMonth = endDate.split('-')[1];

                if (monthFilterValue === 'all' || (startMonth === monthFilterValue && endMonth === monthFilterValue)) {
                    budget.style.display = 'table-row';
                } else {
                    budget.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>