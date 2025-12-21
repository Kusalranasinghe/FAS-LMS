<?php
include 'database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Student-Login</title>
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Student Login</h2>

        <label for="nic">NIC</label>
        <input type="text" id="nic" name="nic" placeholder="Enter your nic :">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password :">

        <input type="submit" value="Login">
    </form>
</body>

</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $nic = $_POST["nic"];
    $password = $_POST["password"];

    if(empty($nic && $password)) {
        echo "All fields are required";
    } 
    else {

        // Get user from database
        $sql = "SELECT * FROM users WHERE nic = '$nic'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Verify password
            if(password_verify($password, $user["password"])) {
                
                // Save session
                $_SESSION["user"] = $user["name"];

                header("Location: dashboard.php"); 
                exit();

            } 
            
            else {
                echo "Invalid password";
            }

        } else {
            echo "No user found with this nic.";
        }
    }
}

mysqli_close($conn);
?>