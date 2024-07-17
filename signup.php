<?php 
if (isset($_POST['submit'])) {
    include "conn.php";
    $username = $_POST['user'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];

    // Check if email already exists
    $sql = "SELECT * FROM tbl_users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count_email = $stmt->rowCount();

    if ($count_email == 0) {
        // Check if passwords match
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO tbl_users (fullName, email, city, password) VALUES (:username, :email, :city, :hash)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':hash', $hash);
            if ($stmt->execute()) {
                echo '<script>
                    alert("Registration successful!");
                    window.location.href = "login.php";
                </script>';
            } else {
                echo '<script>
                    alert("Error: Could not register. Please try again.");
                    window.location.href = "signup.php";
                </script>';
            }
        } else {
            echo '<script>
                alert("Passwords do not match.");
                window.location.href = "signup.php";
            </script>';
        }
    } else {
        echo '<script>
            alert("Email already exists.");
            window.location.href = "signup.php";
        </script>';
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div id="">
          <h1>SignUp Form</h1>
         <form action="signup.php" method="POST" name="form">
            <label for="">User Name</label>
            <input type="text" id="user" name="user" required ><br><br>
            <label for="">Email</label>
            <input type="text" id="email" name="email" required ><br><br>
            <label for="">City</label>
            <input type="text" id="city" name="city" required ><br><br>
            <label for=""> Enter Password</label>
            <input type="password" id="pass" name="pass" required ><br>
            <label for=""> Retype Password</label>
            <input type="password" id="cpass" name="cpass" required ><br>

            <input type="submit" id="btn" value="signup" name="submit">
         </form>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>