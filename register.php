<?php
    include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Student-Registration</title>
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <h2>Student Registration</h2>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name :">

        <label for="nic">NIC</label>
        <input type="text" id="nic" name="nic" placeholder="Enter your nic :">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email :">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password :">

        <label for="cpassword">Confirm Password</label>
        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password :">


        <input type="submit" value="Register">

    </form>
</body>

</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $name = $_POST['name'];
        $nic = $_POST['nic'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if(empty($name) || empty($nic) || empty($email) || empty($password) || empty($cpassword)) {
            echo "All fields are required.";
            exit; 
        }

        if($password !== $cpassword) {
            echo "Passwords do not match.";
            exit; 
        }

        else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, nic, email, password) VALUES ('$name', '$nic', '$email', '$hash')";

            mysqli_query($conn, $sql);
            header("Location: login.php");
        }

        mysqli_close($conn);

    }
?>