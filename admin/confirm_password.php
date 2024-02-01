<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Initialize variables
// $userId = $_POST["user_id"];
$passwordErr = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the new password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }

    // If the password is valid, update it in the database
    if (empty($passwordErr)) {
        $sql = "UPDATE users SET hashed_password = '$password' WHERE user_id = '$userId'";
        $conn->query($sql);

        // Redirect to a success page or login page
        header("Location: password_reset_success.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Include any additional styles or scripts you may need -->
</head>
<body>

    <h2>Password Reset</h2>
    <p>Please enter your new password.</p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?user_id=' . $userId; ?>">
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <span style="color: red;"><?php echo $passwordErr; ?></span>

        <br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <!-- You may add client-side validation to match the passwords -->

        <br>

        <input type="submit" value="Reset Password">
    </form>

</body>
</html>


