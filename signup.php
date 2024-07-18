<?php 
include 'header.php';


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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="">
         <form action="signup.php" method="POST" name="form">
         <section class="vh-110 gradient-custom">
    <div class="container py-5 h-100">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5 text-center bg-dark text-white">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="text" id="user" name="user" class="form-control form-control-lg" required>
                  <label class="form-label" for="user">Your Name</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                  <label class="form-label" for="email">Your Email</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="text" id="city" name="city" class="form-control form-control-lg" required>
                  <label class="form-label" for="city">Your City</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="pass" name="pass" class="form-control form-control-lg" required>
                  <label class="form-label" for="pass">Password</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="cpass" name="cpass" class="form-control form-control-lg" required>
                  <label class="form-label" for="cpass">Repeat your password</label>
                </div>

                <div class="d-flex justify-content-center">
                    <input data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" type="submit" id="btn" value="signup" name="submit">
                </div>

                <p class="mb-0">Have already an account? <a href="login.php" class="text-white-50 fw-bold"><u>Login here</u></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
         </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
