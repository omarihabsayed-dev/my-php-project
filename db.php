<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$name = $_ENV['DB_NAME'];

$conn = mysqli_connect($host, $user, $pass, $name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function check_query($result) {
    global $conn;
    if(!$result) {
        return "Error" . mysqli_error($conn);
    }
    return true;
}

function user_exists($conn, $username) {
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
}

function create_user ($conn, $username, $email, $password) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$passwordHash')";
    return mysqli_query($conn, $sql);
}

function update_user ($conn, $user_id, $username, $email) {
    $sql = "UPDATE users SET email='$email', username='$username' WHERE id='$user_id'";
    return mysqli_query($conn, $sql);
}

function delete_user ($conn, $user_id) {
    $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
    return mysqli_query($conn,"DELETE FROM users WHERE id='$user_id'");
}

?> 