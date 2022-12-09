<?php
require "../Details.php";
function Is_Instructor_Exist($email){
    $cols_array = array("TeacherID");
    $condition = [
            "TeacherEmail" => $email
    ];
    $row = CRUD::Select("Teacher",$cols_array,$condition);
    if(empty($row)){
        return false;
    }else{
        return true;
    }
}
if(isset($_POST['register'])){
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $data = [
            "TeacherID" => "TID".CRUD::Fake_Characters(5),
            "TeacherName" => $name,
            "TeacherEmail" => $email,
            "TeacherPassword" => hash('sha256',$password),
            "TeacherDescription" => null
    ];
    if(!Is_Instructor_Exist($email)){
        $check = CRUD::Insert("Teacher",$data);
        if($check){
            header("Location: index.php");
        }else{
            die("Something went wrong! Please Try again later");
        }
    }else{
        $_SESSION['message'] = "Instructor already exist";
    }

}

?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/oddo-html/HTML/main/register-34.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 12:53:38 GMT -->
<head>
    <title>ODDO - Login and Register Form HTML5 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">

</head>
<body id="top">
<div class="page_loader"></div>

<!-- Login 34 start -->
<div class="login-34">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-section">
                    <div class="logo-2">
<!--                        <a href="login-34.html">-->
<!--                            <img src="assets/img/logos/logo-2.png" alt="logo">-->
<!--                        </a>-->
                    </div>
                    <h1>Create An Cccount</h1>
                    <ul class="social-list">
                        <li><a href="#" class="facebook-color"><i class="fa fa-facebook facebook-i"></i><span>Facebook</span></a></li>
                        <li><a href="#" class="twitter-color"><i class="fa fa-twitter twitter-i"></i><span>Twitter</span></a></li>
                        <li><a href="#" class="google-color"><i class="fa fa-google google-i"></i><span>Google</span></a></li>
                    </ul>
                    <form action="register.php" method="post">
                        <div class="form-group clearfix">
                            <input name="name" type="text" class="form-control" placeholder="Full Name" aria-label="Full Name">
                        </div>
                        <div class="form-group clearfix">
                            <input name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                        </div>
                        <div class="form-group clearfix">
                            <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                        </div>
                        <div class="form-group clearfix">
                            <div class="form-check">
                                <input required class="form-check-input" type="checkbox" id="rememberme">
                                <label class="form-check-label" for="rememberme">
                                    I agree to the terms of service
                                </label>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <label style="color:red;" class="col-form-label" for="">
                                <?php
                                if(isset($_SESSION['message'])){
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                }
                                ?>
                            </label>

                        </div>
                        <div class="form-group clearfix">
                            <button name="register" type="submit" class="btn btn-lg btn-primary btn-theme">Register</button>
                        </div>
                    </form>
                    <p>Already a member? <a href="index.php" class="thembo"> Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 34 end -->

<!-- External JS libraries -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/app.js"></script>
<!-- Custom JS Script -->

</body>

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/oddo-html/HTML/main/register-34.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 12:53:38 GMT -->
</html>
