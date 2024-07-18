<?php
session_start();
include "header.php";

// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file (e.g., conn.php)
include 'conn.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $username = htmlspecialchars(trim($_POST['user']));
    $city = htmlspecialchars(trim($_POST['city']));

    // Get userId from session
    $userId = $_SESSION['userId'];

    // Update user profile in the database
    $sql = "UPDATE tbl_users SET fullName = :username, city = :city WHERE userId = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':userId', $userId);

    if ($stmt->execute()) {
        echo '<script>
        alert("Profile updated successfully!"); window.location.href = "protected-home.php";
        </script>';
        exit();
    } else {
        echo '<script>
        alert("Error updating profile. Please try again."); window.location.href = "protected-home.php";
        </script>';
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
    <form method="post" action="profile.php">
    <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
            <h2>Update Profile</h2>
            <div class="mb-3">
                <label for="user" class="form-label">Your Name</label>
                <input type="text" id="user" name="user" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Your City</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <input data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit" id="btn" value="Update" name="Update">
        </form>

             

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
