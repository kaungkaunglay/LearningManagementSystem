<?php
session_start();

if(isset($_GET['testid'])){
    unset($_SESSION['count']);
    header("Location: Answer.php?testid=".$_GET['testid']);
}