    <P>
        <a href="register.php">Register</a>
    </P>

    <?php if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true): ?>
        <p>
            <a href="admin.php">Admin</a>
        </p>

        <p>
            <a href="logout.php">Logout</a>
        </p>
    <?php else: ?>
        <p>
            <a href="login.php">Login</a>
        </p>

    <?php endif; ?>