<?php
include("partials/header.php");
include("partials/navigation.php");
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in" ] == true) {
    header("Location: admin.php");
    exit();
}
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user["password"])) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["logged_in"] = true;
            header("Location: admin.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "User not found";
    }
}
?>

<div class="container">
    <div class="form-container">
        <form method="POST" action="">
            <h2>Login to your account</h2>

            <?php if ($error): ?>
            <p style="color:red">
                <?php echo $error; ?>
            </p>
            <?php endif; ?>

            <label for="username">Username:</label>
            <input placeholder="Enter your username" type="text" name="username" required>

            <label for="password">Password:</label>
            <input placeholder="Enter your password" type="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>
</div>
    
<?php
include("footer.php");
?>

<?php
mysqli_close($conn);
?>