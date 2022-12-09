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

//Creating Course Table

$course = [
        "CourseID" => "varchar(10)",
        "CourseName" => "varchar(30)",
        "CourseDescription" => "varchar(255)",
        "CourseImage" => "varchar(30)",
        "Status" => "tinyint",
        "TeacherID" => "varchar(15)"
];
CRUD::Create("Course",$course,true);

// Insert columns

for($i=0 ; $i < 20; $i++){
    $data = [
        "CourseID" => "CID".CRUD::Fake_Characters(5),
        "CourseName" => CRUD::Fake_Text(10),
        "CourseDescription" =>  CRUD::Fake_RealText(30,1),
        "CourseImage" => "/Image/".CRUD::Fake_Text(10),
        "Status" => 0,
        "TeacherID" => "TID".CRUD::Fake_Characters(5)
    ];
    CRUD::Insert("Course",$data);
}

//Creating Resource Table

$resource = [
    "ResourceID" => "varchar(10)",
    "ResourceName" => "varchar(30)",
    "Description" => "varchar(255)",
    "ResourceImage" => "varchar(30)",
    "CourseID" => "varchar(10)"
];
CRUD::Create("Resource", $resource, true);
// insert columns

for($i =0 ; $i < 20; $i++ ){
    $data = [
        "ResourceID" => "RID".CRUD::Fake_Characters(5),
        "ResourceName" => CRUD::Fake_Text(10),
        "Description" => CRUD::Fake_RealText(30,10),
        "ResourceImage" => "/Image/".CRUD::Fake_Text(10),
        "CourseID" => "CID".CRUD::Fake_Characters(5)
    ];
    CRUD::Insert("Resource",$data);
}
?>