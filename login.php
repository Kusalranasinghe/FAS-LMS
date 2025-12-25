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
                <a class="nav-link active" aria-current="page" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>

        </ul>
    </div>

    <div class="signin"
        style=" height: 650px; background-image: url('images/istockphoto-1988188005-612x612.jpg'); align-items: center; justify-content: center; display: flex; padding: 50px;  ">

        <form style="width: 500px; padding: 30px; background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  padding: 20px;
  border-radius: 8px; " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2 style="text-align: center; padding-top: 15px; font-weight: bolder; color: white;">Faculty of Applied Science</h2>
            <h2 style="text-align: center; padding-bottom: 30px; font-weight: bolder; color: white;">
                Student-Login</h2>

            <input type="email" id="email" name="email" placeholder="Enter your email :" style="margin-bottom: 15px;">


            <input type="password" id="password" name="password" placeholder="Enter your password :"
                style="margin-bottom: 15px;">

            <input type="submit" value="Login">
        </form>
    </div>

    <footer style="height: 300px;">
        <div class="footer-container">
            <div class="footer-column">
                <h4>Company</h4>
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="#careers">Careers</a></li>
                    <li><a href="#privacy">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact</h4>
                <p>ABC Green Campus , Gampaha</p>
                <p>Email: <a href="mailto:info@example.com">abccampus@gmail.com</a></p>
            </div>
            <div class="footer-column">
                <h4>Follow Us</h4>
                <div class="social-icons">

                    <a href="#facebook">Facebook</a>
                    <a href="#twitter">Twitter</a>
                    <a href="#instagram">Instagram</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Your Company. All rights reserved.</p>
        </div>
    </footer>




</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if (empty($email && $password)) {
        echo "All fields are required";
    } else {

        // Get user from database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Verify password
            if (password_verify($password, $user["password"])) {

                // Save session
                $_SESSION["user"] = $user["name"];

                header("Location: dashboard.php");
                exit();

            } else {
                echo "Invalid password";
            }

        } else {
            echo "No user found with this email";
        }
    }
}

mysqli_close($conn);
?>