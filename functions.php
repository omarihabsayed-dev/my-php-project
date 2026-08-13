<?php

function isUserLoggedIn() {
    return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] = true;
}

function redirect($location) {
    header("Location: " . $location);
    exit();
}

function setActiveClass($pageName) {
    $currentPage = basename($_SERVER["PHP_SELF"]);
    return $currentPage == $pageName ? "active" : "";
}

function getClassPage() {
    return basename($_SERVER['PHP_SELF'], '.php');
}

function user_exists($conn, $username) {
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
}

function fullMonthDate ($date) {
    return date("F, j", strtotime($date));
}