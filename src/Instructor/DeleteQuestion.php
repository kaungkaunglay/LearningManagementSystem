<?php
session_start();
require_once  "../Details.php";
if(isset($_GET['qid']) && isset($_GET['tid'])){
    $condition = [
        "QuestionID" => $_GET['qid']
    ];
    CRUD::Delete("Question",$condition);
    if(isset($_SESSION['count']) && ($_SESSION['count'] != 0) ){
        $_SESSION['count'] = $_SESSION['count'] - 1;
    }
    header("Location: instructor-create-quiz.php?tid=".$_GET['tid']);
}
if(isset($_GET['qcid']) && isset($_GET['tid'])){
    echo $_GET['qcid'];
    $condition= [
        "QuestionChoiceID" => $_GET['qcid']
    ];
    CRUD::Delete("QuestionChoice",$condition);
    header("Location: instructor-create-quiz.php?tid=".$_GET['tid']);
}
?>