<?php
session_start();
include 'conn.php';
include 'header.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

// Fetch the user's name from the database
$stmt = $conn->prepare("SELECT `fullName` FROM `tbl_users` WHERE `userId` = :userId");
$stmt->bindParam(':userId', $userId);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $user_name = $row['fullName'];
} else {
    $user_name = "User"; // Default name if user not found
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
    <div class="gradient-custom">
      <div class="card" style="width: 100%;">
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">Update Profile</h6>
          <a href="profile.php">Update Profile</a>
        </div>
      </div>
      <div class="card" style="width: 100%;">
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">Change Password</h6>
          <a href="account.php">Change Password</a>
        </div>
      </div>
      <div class="card" style="width: 100%;">
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">View Public Holidays</h6>
          <a href="holiday.php">View Public Holidays</a>
        </div>
      </div>
      <div class="card" style="width: 100%;">
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">Logout</h6>
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
