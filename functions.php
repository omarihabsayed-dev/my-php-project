<?php
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