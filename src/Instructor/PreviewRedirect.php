<?php
require_once "../Details.php";
if(isset($_GET['cid'])){
    //select first one of the resource
    $cols = array("ResourceID");
    $condition = [
        "CourseID" => $_GET['cid']
    ];
    $data = CRUD::Select("Resource",$cols,$condition,1);
    if(!empty($data)){ header("Location: CoursePreview.php?cid=".$_GET['cid']."&rid=".$data[0]['ResourceID']);}else{
        header("Location: CoursePreview.php?cid=".$_GET['cid']);
    }

}