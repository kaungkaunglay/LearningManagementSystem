<?php
session_start();
if(isset($_SESSION['TeacherID'])){
    unset($_SESSION['TeacherID']);
    session_destroy();
    header("Location: ../Login/index.php");
}