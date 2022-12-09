<?php
session_start();
if(isset($_GET['testid'])){
    if(isset($_SESSION['count'])){
        unset($_SESSION['count']);
    }
    header("Location: student-take-quiz.php?testid=".$_GET['testid']);
}