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

function fullMonthDate ($date) {
    return date("F, j", strtotime($date));
}