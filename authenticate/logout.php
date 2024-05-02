<?php
define('ROOT_URL', 'http://localhost/final_project_admin/');
    session_start();
    session_unset();
    session_destroy();
    header('location: ' . ROOT_URL . 'index.php');
?>