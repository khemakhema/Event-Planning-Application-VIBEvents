<?php
session_start();
if (isset($_SESSION["username"]) || isset($_SESSION["companyName"])) {
    
    session_destroy();
    unset($_SESSION["username"]);
    header("Location: ");
}




?>