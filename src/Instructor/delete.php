<?php
require_once  "../Details.php";
if(isset($_GET['tid'])){
    $delete_condition = [
        "TestID" => $_GET['tid']
    ];
    CRUD::Delete("Test", $delete_condition) ;
    header("Location: instructor-tests.php");
}
if(isset($_GET['cid'])){
    $delete_condition = [
        "CourseID" => $_GET['cid']
    ];
    CRUD::Delete("Course", $delete_condition) ;
    header("Location: instructor-course.php");
}