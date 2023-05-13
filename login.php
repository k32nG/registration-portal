<?php
session_start();
include_once('config.php');
if(isset($_POST['login']))
{
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM users WHERE email = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password']))
        {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            
            header("Location: index.php");
        }
        else
        {
            echo "<script>alert('Invalid Password')</script>";
        }
    }
    else
    {
        echo "<script>alert('Invalid User ID or Password')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <header>
        <?php require_once 'header.php'; ?> 
        <div class="jumbotron text-center">
            <h1>Login</h1>
        </div>
    </header>
    <main class="container">
        <form method="post">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" class="form-control" id="user_id" name="user_id" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <br>
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </div>
        </form>
    </main>
    <br>
    <p>New User? <a href="new_user.php">Register here</a></p>
    <?php require_once 'footer.php'; ?>
</body>
</html>