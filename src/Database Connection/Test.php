<?php
    include "Connect.php";
    include "CRUD.php";
    Connect::setHostname("139.59.217.138");
    Connect::setDbPort("3306");
    Connect::setDbUsername("kaungkaung");
    Connect::setDbPassword("KaungKaungLay123#");
    Connect::setDbName("test");
    $test = new Connect();


    $pdo = $test->isConnect();
    // Creating CRUD;
    $CRUD =  new CRUD($pdo);
////    $column = array("UserID","Username");
////    $order_column = array("Username");
////    $row = $CRUD->Select("Users",$column,$order_column, true);
////    foreach($row as $data){
////        echo $data['Username']."<br>";
////    }
////    $data = [
////        "username" => "AungKhantZin",
////        "UserPassword"=> "12345678"
////    ];
////
////    $condition=[
////        "UserID" => 2
////    ];
////   $row2 = $CRUD->Update("Users",$data,$condition);
////    if($row2){
////        echo "Update complete";
////    }
////    $data = [
////        "UserID" => 4,
////        "UserName" => "John Doe",
////        "UserEmail"=> "john@gmail.com",
////        "UserPassword" => null
////    ];
////    $row = $CRUD->Insert("Users", $data);
////    if($row){
////        echo "Inserted";
////    }
//
////    $data = [
////        "UserID" => 1,
////        "UserName" => CRUD::Fake_UserName(),
////        "UserPassword" => CRUD::Fake_Password(),
////        "UserEmail"=> CRUD::Fake_PersonalEmail()
////    ];
////    $row = CRUD::Insert("Users",$data);
//////
//$create_columns = [
//    "UserID" => "int",
//    "UserEmail" => "varchar(30)",
//    "UserPassword" => "varchar(40)",
//];
//
////CRUD::Create("Users",$create_columns,true);
////for($i = 0 ; $i <= 10 ; $i++){
////    $data = [
////        "UserID" => $i,
////        "UserEmail" => CRUD::Fake_PersonalEmail(),
////        "UserPassword" => CRUD::Fake_Password()
////    ];
////    CRUD::Insert("Users", $data);
////};
//$alter_columns =
//    [
//        "UserName" => "varchar(20)"
//    ];
//echo CRUD::Alter("Users",$alter_columns);
//echo CRUD::Fake_Characters(3);
//$select_column = array("TeacherID", "TeacherEmail");
//$condition = [
//    "TeacherName" => "AungKhantZin"
//];
//$row = CRUD::Select("Teacher", $select_column,$condition);
//foreach($row as $data){
//    echo $data['TeacherID']."<br>";
//}

$delete  = [
    "TestID" => "TestID21920"
];
$check = CRUD::Delete("Test",$delete);
if($check){
    echo "Record is deleted";
}
?>