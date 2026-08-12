<?php
function setActiveClass($pageName) {
    $currentPage = basename($_SERVER["PHP_SELF"]);
    return $currentPage == $pageName ? "active" : "";
}

function getClassPage() {
    return basename($_SERVER['PHP_SELF'], '.php');
}