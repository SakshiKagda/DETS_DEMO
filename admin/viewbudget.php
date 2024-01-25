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
        h2{
            color: blueviolet;
        }
        tr{
            color: blue;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
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
    <div class="container mt-5">
        <h2>View Budget</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-sucess">
                <tr>
                    <th>Category</th>
                    <th>Planned Amount</th>
                    <th>Actual Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row, replace with dynamic data from your system -->
                <tr>
                    <td>Groceries</td>
                    <td>$200.00</td>
                    <td>$180.00</td>
                    <td>2024-01-01</td>
                    <td>2024-01-31</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <!-- Add more rows based on your data -->
            </tbody>
        </table>
    </div> 
<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            </div>
   
    <footer>
    <?php
        include("footer.php");
        ?>
    </footer>
</body>
</html>