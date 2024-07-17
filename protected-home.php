<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<h1>Welcome, <?php echo $_SESSION['userId']; ?></h1>
<a href="profile.php">Update Profile</a>
<a href="account.php">Change Password</a>
<a href="holiday.php">View Public Holidays</a>
<a href="logout.php">Logout</a>
