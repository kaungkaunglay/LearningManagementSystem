<?php

require_once "Connect.php";
require_once "CRUD.php";
//Creating New Connection
Connect::setHostname("139.59.217.138");
Connect::setDbPort("3306");
Connect::setDbUsername("kaungkaung");
Connect::setDbPassword("KaungKaungLay123#");
Connect::setDbName("test");
$test = new Connect();
// Creating Course Table

$pdo = $test->isConnect();
$CRUD =  new CRUD($pdo);

$category = [
    "CategoryID" => "varchar(15)",
    "CategoryName" => "varchar(60)",
    "TeacherID" => "varchar(15)"
];
CRUD::Create("Category",$category, true);
for($i = 0 ; $i < 20; $i++){
    $data = [
        "CategoryID" => "CatID".CRUD::Fake_Characters(5),
        "CategoryName" => CRUD::Fake_Text(10),
        "TeacherID" => "TID".CRUD::Fake_Characters(5)
    ];
    CRUD::Insert("Category",$data);
}
$lab_group = [
    "LabGroupID" => "varchar(10)",
    "StudentEmail" => "varchar(50)"
];
CRUD::Create("LabGroup",$lab_group,true);
for($i=0; $i < 20 ; $i ++ ){
    $data = [
        "LabGroupID" => "LGID".CRUD::Fake_Characters(5),
        "StudentEmail"  => CRUD::Fake_PersonalEmail()
    ];
    CRUD::Insert("LabGroup",$data);
}

//Lab

$lab = [
    "LabID" => "varchar(10)",
    "LabName" => "varchar(30)",
    "CoverImage" => "Text",
    "CourseID" => "varchar(15)",
    "TestID" => "varchar(15)",
    "TeacherID" => "varchar(15)",
    "LabGroupID" => "varchar(10)"
];
CRUD::Create("Lab",$lab,true);
for($i=0 ; $i < 20 ; $i++){
    $data = [
        "LabID" => "LID".CRUD::Fake_Characters(5),
        "LabName" => CRUD::Fake_RealText(20,2),
        "CoverImage" => "CoverImage/".CRUD::Fake_Text(20),
        "CourseID" => "CID".CRUD::Fake_Characters(5),
        "TestID" => "TestID".CRUD::Fake_Characters(5),
        "TeacherID" => "TID".CRUD::Fake_Characters(5),
        "LabGroupID" => "LGID".CRUD::Fake_Characters(5)
    ] ;
    CRUD::Insert("Lab",$data);
}