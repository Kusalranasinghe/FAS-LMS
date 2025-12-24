<?php
include("database.php");
session_start(); 
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="navbar" style="padding: 10px; font-weight: 600;">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
    </div>

    <form style="width: 500px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
        <h2 style="margin: 10px;">Login</h2>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your email.." required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Your password.." required>

        <input type="submit" value="Login">
    </form>

</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if(empty($email && $password)) {
        echo "All fields are required";
    } 
    else {

        // Get user from database
        $sql = "SELECT * FROM users WHERE email = '$email'";
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
            echo "No user found with this email";
        }
    }
}

mysqli_close($conn);
?>