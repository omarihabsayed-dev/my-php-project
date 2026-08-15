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
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $query_status = check_query(update_user($conn, $user_id, $username, $email));
        if($query_status === true){
            $_SESSION["message"] = "User updated successfully to";
            $_SESSION["msg_type"] = "success";
             redirect("admin.php");
        }
    } elseif(isset($_POST["delete_user"])) {
        $query_status = check_query(delete_user($conn, $user_id));
        if($query_status === true){
            $_SESSION["message"] = "User deleted successfully";
            $_SESSION["msg_type"] = "success";
            redirect("admin.php");
        }
    }
}
?>

<h1>Manage Users</h1>

<div class="container">
    <?php if(isset($_SESSION["message"])): ?>
        <div class="notification <?php echo $_SESSION["msg_type"]; ?>">
            <?php
            echo $_SESSION["message"];
            unset($_SESSION["message"]);
            unset($_SESSION["msg_type"]);
            ?>
        </div>
        <?php endif; ?>
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
                    <input type="text" name="username" value="<?php echo $row["username"]; ?>" required>
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