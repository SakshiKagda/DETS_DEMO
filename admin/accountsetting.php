<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
        /* .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        } */
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
        <div class="container mt-5">
            <h2>Update Admin Profile</h2>
            
            <?php
            // Database connection details
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'expense_db';
            
            // Create connection
            $conn = new mysqli($host, $username, $password, $database);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Get the admin's ID from the session
            $adminId = $_SESSION['id'];
            
            // SQL query to fetch the admin's current information
            $sql = "SELECT * FROM admins WHERE id = $adminId";
            $result = $conn->query($sql);
            
            // Check if the admin exists
            if ($result->num_rows > 0) {
                // Output the form for updating the admin's profile
                while ($row = $result->fetch_assoc()) {
                    echo "<form action='update_admin_profile.php' method='post' enctype='multipart/form-data'>";
                    echo "<div class='form-group'>";
                    echo "<label for='name'>Name:</label>";
                    echo "<input type='text' class='form-control' id='name' name='name' value='" . $row['username'] . "'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='email'>Email:</label>";
                    echo "<input type='email' class='form-control' id='email' name='email' value='" . $row['email'] . "'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='mobile'>Mobile Number:</label>";
                    echo "<input type='text' class='form-control' id='mobile' name='mobile' value='" . $row['mobile_number'] . "'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='gender'>Gender:</label>";
                    echo "<select class='form-control' id='gender' name='gender'>";
                    echo "<option value='male' " . ($row['gender'] == 'male' ? 'selected' : '') . ">Male</option>";
                    echo "<option value='female' " . ($row['gender'] == 'female' ? 'selected' : '') . ">Female</option>";
                    echo "</select>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                    echo "<label for='profile_image'>Profile Image:</label>";
                    echo "<input type='file' class='form-control-file' id='profile_image' name='profile_image'>";
                    echo "</div>";
                    echo "<button type='submit' class='btn btn-primary'>Update Profile</button>";
                    echo "<button type='submit' class='btn btn-primary'>Back</button>";
                    echo "</form>";
                }
            } else {
                echo "<p>No admin found.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
</html>
