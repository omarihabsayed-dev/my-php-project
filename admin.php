<?php 
include("partials/header.php");
include("partials/navigation.php");
if(!isUserLoggedIn()){
    redirect("Location: login.php");
}

$result = mysqli_query($conn,"SELECT id, username, email, reg_date FROM users");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["edit_user"])) {
        $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        mysqli_query($conn,"UPDATE users SET email='$email' WHERE id='$user_id'");
        redirect("admin.php");
    }
}
?>

<h1>Manage Users</h1>

<div class="container">
    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo fullMonthDate($row["reg_date"]); ?></td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="<?php echo $row["id"]; ?>">
                    <input type="email" name="email" value="<?php echo $row["email"]; ?>" required>
                    <button class="edit" type="submit" name="edit_user">Edit</button>
                </form>
                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="user_id" value="<?php echo $row["id"]; ?>">
                    <button class="delete" type="submit" name="delete_user">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <td>2</td>
            <td>jane_doe</td>
            <td>jane@example.com</td>
            <td>February 15</td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="2">
                    <input type="email" name="email" value="jane@example.com" required>
                    <button class="edit" type="submit" name="edit_user">Edit</button>
                </form>
                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="user_id" value="2">
                    <button class="delete" type="submit" name="delete_user">Delete</button>
                </form>
            </td>
        </tr>
        <!-- Additional user rows can go here -->
        </tbody>
    </table>
</div>

<?php
include("partials/footer.php");
?>