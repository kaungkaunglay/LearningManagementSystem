<?php
session_start();
require_once "../Details.php";
$message =  null;
if(isset($_POST['login'])){
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $select_column = array("TeacherID");

    $condition = [
            "TeacherEmail" => $email,
            "TeacherPassword" => hash('sha256',$password)
    ];
    $data = CRUD::Select("Teacher", $select_column,$condition);
    if(empty($data)){
        $message = "User does not exist or wrong password ";
    }else{
        $_SESSION['TeacherID'] = $data[0]['TeacherID'];
        header("Location: ../instructor/index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/oddo-html/HTML/main/login-34.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 12:53:01 GMT -->
<head>
    <title><?php echo Details::getTitle(); ?></title>
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
            <div class="col-lg-12 align-items-center">
                <div class="form-section">
                    <h1>Sign Into Your Account</h1>
                    <ul class="social-list">
                        <li><a href="#" class="facebook-color"><i class="fa fa-facebook facebook-i"></i><span>Facebook</span></a></li>
                        <li><a href="#" class="twitter-color"><i class="fa fa-twitter twitter-i"></i><span>Twitter</span></a></li>
                        <li><a href="#" class="google-color"><i class="fa fa-google google-i"></i><span>Google</span></a></li>
                    </ul>
                    <form action="index.php" method="post">
                        <div class="form-group clearfix">
                            <input name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                        </div>
                        <div class="form-group clearfix">
                            <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                        </div>
                        <div class="checkbox form-group clearfix">
                            <div class="form-check float-start">
                                <input class="form-check-input" type="checkbox" id="rememberme">
                                <label class="form-check-label" for="rememberme">
                                    Remember me
                                </label>
                            </div>
                            <a href="Forgot-password.php" class="link-light float-end forgot-password">Forgot your password?</a>
                        </div>
                        <div>
                            <?php
                            if(!is_null($message)){
                                echo "<div style='color:red'>".$message."</div>";
                            }
                            ?>
                        </div>
                        <div class="form-group clearfix">
                            <button name="login" type="submit" class="btn btn-lg btn-primary btn-theme">Login</button>
                        </div>
                    </form>
                    <p>Don't have an account? <a href="register.php" class="thembo"> Register</a></p>
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

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/oddo-html/HTML/main/login-34.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 12:53:09 GMT -->
</html>
