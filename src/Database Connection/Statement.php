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


$pdo = $test->isConnect();
// Creating CRUD;
$CRUD =  new CRUD($pdo);

// Creating Student Table

$users = [
    "StudentID" => "varchar(10)",
    "StudentName" => "varchar (30)",
    "StudentEmail" => "varchar (50)",
    "StudentPassword" => "varchar (255)",
];
CRUD::Create("Student", $users,true);
//Insert data
for($i=0; $i <20 ; $i++){
    $data = [
        "StudentID" =>  "SID".CRUD::Fake_Characters(5),
        "StudentName" => CRUD::Fake_UserName(),
        "StudentEmail" => CRUD::Fake_PersonalEmail(),
        "StudentPassword" => CRUD::Fake_SHA256()
    ];
    CRUD::Insert("Student", $data);
}

//creating Teacher Table
$teachers = [
    "TeacherID" => "varchar(10)",
    "TeacherName" => "varchar (30)",
    "TeacherEmail" => "varchar (50)",
    "TeacherPassword" => "varchar (255)",
];
CRUD::Create("Teacher", $teachers,true);
for($i=0; $i <20 ; $i++){
    $data = [
        "TeacherID" => "TID".CRUD::Fake_Characters(5),
        "TeacherName" => CRUD::Fake_UserName(),
        "TeacherEmail" => CRUD::Fake_PersonalEmail(),
        "TeacherPassword" => CRUD::Fake_SHA256()
    ];
    CRUD::Insert("Teacher", $data);
}

//Creating Admin Table

$Admins = [
    "AdminID" => "varchar(10)",
    "AdminName" => "varchar (30)",
    "AdminEmail" => "varchar (50)",
    "AdminPassword" => "varchar (255)",
];
CRUD::Create("Admin", $Admins,true);
for($i=0; $i <20 ; $i++){
    $data = [
        "AdminID" => "AID".CRUD::Fake_Characters(5),
        "AdminName" => CRUD::Fake_UserName(),
        "AdminEmail" => CRUD::Fake_PersonalEmail(),
        "AdminPassword" => CRUD::Fake_SHA256()
    ];
    CRUD::Insert("Admin", $data);
}

// Creating Test Table

$Test = [
    "TestID" => "varchar(15)",
    "TestName" => "varchar(30)",
    "TestDescription" => "varchar(255)",
    "TeacherID" => "varchar(10)",
];
CRUD::Create("Test",$Test, true);

for($i = 0 ; $i < 20; $i++){
    $data = [
        "TestID" => "TestID".CRUD::Fake_Characters(5),
        "TestName" => CRUD::Fake_Text(20),
        "TestDescription" => CRUD::Fake_RealText(200, 2),
        "TeacherID" => "TID".CRUD::Fake_Characters(5)
    ];
    CRUD::Insert("Test", $data);
}
// Creating Question Table
$Questions = [
    "QuestionID" => "varchar(10)",
    "QuestionName" => "varchar(255)",
    "is_active" => "tinyint",
    "TestID" => "varchar(10)"
];

CRUD::Create("Question", $Questions, true);

for($i = 0 ; $i < 20; $i++){
    $data = [
        "QuestionID" => "QID".CRUD::Fake_Characters(5),
        "QuestionName" => CRUD::Fake_RealText(255,2),
        "is_active" => 0,
        "TestID" => "TID".CRUD::Fake_Characters(5)
    ];
    CRUD::Insert("Question", $data );
}

//Creating Question_Choice
$Question_Choice = [
    "QuestionChoiceID" => "varchar(10)",
    "QuestionID" => "varchar(10)",
    "is_right_choice" => "tinyint",
    "choice" => "varchar(255)"
];

CRUD::Create("QuestionChoice", $Question_Choice, true);

for($i = 0 ; $i < 20; $i++){
    $data = [
        "QuestionChoiceID" => "QCID".CRUD::Fake_Characters(5),
        "QuestionID" => "QID".CRUD::Fake_Characters(5),
        "is_right_choice" => 0,
        "choice" => CRUD::Fake_RealText(200,2)
    ];
    CRUD::Insert("QuestionChoice", $data );
}

//Creating Question_Answer

$Question_Answer = [
  "StudentID" => "varchar(10)",
    "QuestionID" => "varchar(10)",
    "QuestionChoiceID" => "varchar(10)",
    "is_right" => "tinyint",
    "answertime" => "datetime"
];
CRUD::Create("QuestionAnswer" , $Question_Answer, true);

for($i = 0 ; $i < 20; $i++){
    $data = [
        "StudentID" => "SID".CRUD::Fake_Characters(5),
        "QuestionID" => "QID".CRUD::Fake_Characters(5),
        "QuestionChoiceID" => "QCID".CRUD::Fake_Characters(5),
        "is_right" => 0,
        "answertime" => CRUD::Fake_Date()
    ];
    CRUD::Insert("QuestionAnswer", $data );
}
