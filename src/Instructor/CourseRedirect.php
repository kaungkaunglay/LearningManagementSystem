<?php
session_start();
if(isset($_GET['tid'])){
    unset($_SESSION['count']);
    header("Location: instructor-create-quiz.php?tid=".$_GET['tid']);
}
if(isset($_GET['cid'])){
    unset($_SESSION['count']);
    header("Location: instructor-lesson-edit.php?cid=".$_GET['cid']);
}