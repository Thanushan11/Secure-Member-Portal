<?php
include 'header.php';
session_start();
include 'conn.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    $oldPassword = $_POST['opass'];
    $newPassword = $_POST['npass'];
    $confirmNewPassword = $_POST['rnpass'];

    // Validate if new password and confirm new password match
    if ($newPassword != $confirmNewPassword) {
        echo "Passwords do not match";
        exit();
    }

    // Fetch current password from database
    $stmt = $conn->prepare("SELECT password FROM tbl_users WHERE userId = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo "User not found";
    } else {
        $currentPassword = $row['password'];

        // Verify old password
        if (!password_verify($oldPassword, $currentPassword)) {
            echo "Incorrect old password";
        } else {
            // Update password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE tbl_users SET password = :password WHERE userId = :userId");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':userId', $userId);

            if ($stmt->execute()) {
                echo '<script>alert("Password updated successfully"); window.location.href = "protected-home.php";</script>' ;
            } else {
                echo '<script>alert("Error updating password"); window.location.href = "protected-home.php";</script>' ;
                
            }
        }
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<form method="post" action="account.php">
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Change password!</h2>
              

              <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="form3Example3cg" class="form-control form-control-lg" name="opass" required>
                  
                  <label class="form-label" for="form3Example3cg">Your Old Password</label>
                </div>


                <div data-mdb-input-init class="form-outline mb-4">
                  
                <input type="password" id="pass" name="npass" class="form-control form-control-lg" required>
                
                <label class="form-label" for="pass">New Password</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                  
                <input type="password" id="rnpass" name="rnpass" class="form-control form-control-lg" required>
                
                <label class="form-label" for="pass">Retype New Password</label>
                </div>

              <input data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit" id="btn" value="change password" name="submit">
              

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
</form>
