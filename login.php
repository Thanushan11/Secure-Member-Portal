<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <?php
    session_start();
    include 'conn.php';

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM tbl_users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                echo '<script>
                        alert("welcome");
                        
                      </script>';
                exit();
            } else {
                echo '<script>
                        alert("Email or password is incorrect. Please try again.");
                        window.location.href = "login.php";
                      </script>';
            }
        } else {
            echo '<script>
                    alert("Email or password is incorrect. Please try again.");
                    window.location.href = "login.php";
                  </script>';
        }
    }
    ?>
    

<h1>Login Page</h1>

<form method="post" action="login.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="checkbox" name="remember_me"> Remember Me <br>
    <input type="submit" id="btn" value="Login" name="submit">
</form>
