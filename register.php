<?php
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Student-Registration</title>
</head>

<body>

    <div class="navbar" style="padding: 10px; font-weight: 600;">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
            
        </ul>
    </div>

    <div class="signup"
        style=" height: 650px; background-image: url('images/istockphoto-1988188005-612x612.jpg'); align-items: center; justify-content: center; display: flex; padding: 50px;  ">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width: 500px; padding: 30px; background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  padding: 20px;
  border-radius: 8px;">

            <h2 style="text-align: center; padding-top: 15px; padding-bottom: 30px; font-weight: bolder; color: white;">Student-Registration</h2>

            <input type="text" id="name" name="name" placeholder="Enter your name :" style="margin-bottom: 15px;">

            <input type="text" id="nic" name="nic" placeholder="Enter your nic :" style="margin-bottom: 15px;">


            <input type="email" id="email" name="email" placeholder="Enter your email :" style="margin-bottom: 15px;">


            <input type="password" id="password" name="password" placeholder="Enter your password :"
                style="margin-bottom: 15px;">


            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password :"
                style="margin-bottom: 20px;">


            <input type="submit" value="Register">

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

    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (empty($name) || empty($nic) || empty($email) || empty($password) || empty($cpassword)) {
        echo "All fields are required.";
        exit;
    }

    if ($password !== $cpassword) {
        echo "Passwords do not match.";
        exit;
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, nic, email, password) VALUES ('$name', '$nic', '$email', '$hash')";

        mysqli_query($conn, $sql);
        header("Location: login.php");
    }

    mysqli_close($conn);

}
?>