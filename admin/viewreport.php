<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .main{
            display: flex;
            padding-top: 70px ;
         
        }
        </style>
    
</head>
<body>

    

    <header>
        <?php
        include("header.php");
        ?>
    </header>
    
    <div class="main">
    <sidebar>
    <?php
        include("sidebar.php");
        ?>
    </sidebar>
    <div class="container">
        <div class="container">
        <h2>View Reports</h2>

        <!-- Tab navigation for expenses and income reports -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="expenses-tab" data-bs-toggle="tab" href="#expenses">Expenses Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="income-tab" data-bs-toggle="tab" href="#income">Income Report</a>
            </li>
        </ul>
       
        <!-- Tab content for expenses and income reports -->
        <div class="tab-content">
            <!-- Expenses Report -->
            <div class="tab-pane fade show active" id="expenses">
                <h3>Expenses Report</h3>
                <!-- Table to display expenses report -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Description</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row, replace with dynamic data from your backend -->
                        <tr>
                            <td>2022-03-15</td>
                            <td>$50.00</td>
                            <td>Food</td>
                            <td>Monthly grocery shopping</td>
                        </tr>
                        <!-- Add more rows for each expense entry -->
                    </tbody>
                </table>
            </div>

            <!-- Income Report -->
            <div class="tab-pane fade" id="income">
                <h3>Income Report</h3>
                <!-- Table to display income report -->
                <table class="table table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Description</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row, replace with dynamic data from your backend -->
                        <tr>
                            <td>2022-03-20</td>
                            <td>$200.00</td>
                            <td>Freelance</td>
                            <td>Website development project</td>
                        </tr>
                        <!-- Add more rows for each income entry -->
                    </tbody>
                </table>
                 <!-- Button to go back or perform other actions -->
        <a href="#" class="btn btn-primary mt-3">Go Back</a>
    </div> 
    </div>
    </div>
    </div>
    </div>
   <!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <footer>
    <?php
        include("footer.php");
        ?>
    </footer>
</body>
</html>