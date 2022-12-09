<?php
require_once "../Details.php";
function Is_Student_Exist($email){
    $cols_array = array("StudentID");
    $condition = [
        "StudentEmail" => $email
    ];
    $row = CRUD::Select("Student",$cols_array,$condition);
    if(empty($row)){
        return false;
    }else{
        return true;
    }
}
if(isset($_POST['register']))
{
    $name = htmlentities(trim($_POST['name']));
    $email = htmlentities(trim($_POST['email']));
    $password = htmlentities(trim($_POST['password']));

$data = [
        "StudentID" => "SID".CRUD::Fake_Characters(5),
        "StudentName" => $name,
        "StudentEmail" => $email,
        "StudentPassword" => hash("sha256",$password)
];
if(!Is_Student_Exist($email)){
    $check = CRUD::Insert("Student", $data);
    if($check){
        header("Location: index.php");
    }
    else{
        die("Something went wrong! Please Try again later");
    }
}else{
    $_SESSION['message'] = "Account already exist";
}
}
?>

<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from affixtheme.com/html/xmee/demo/register-33.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Nov 2022 16:26:09 GMT -->
<?php
require_once "LRHead.php";
?>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
    <section class="fxt-template-animation fxt-template-layout33">
        <div class="fxt-content-wrap">
            <?php require_once "Heading_Content.php"; ?>
            <div class="fxt-form-content">
                <div class="fxt-main-form">
                    <div class="fxt-inner-wrap fxt-opacity fxt-transition-delay-13">
                        <h2 class="fxt-page-title">Sign Up</h2>
                        <p class="fxt-description">Sign Up to try our amazing services</p>
                        <form method="POST" action="register.php">
                            <div class="form-group">
                                <label for="name" class="fxt-label">Full Name</label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Enter your name" required="required">
                            </div>
                            <div class="form-group">
                                <label for="email" class="fxt-label">Email Address</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" required="required">
                            </div>
                            <div class="form-group">
                                <label for="password" class="fxt-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required="required">
                            </div>
                            <div class="form-group">
                                <div class="fxt-checkbox-box">
                                    <input id="checkbox1" type="checkbox" required>
                                    <label for="checkbox1" class="ps-4">I agree with Terms of Service. Terms Of Payments and Privacy Policy</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <button name="register" type="submit" class="fxt-btn-fill">Register</button>
                            </div>
                        </form>
                        <div class="fxt-divider-text">OR</div>
                        <div id="fxt-login-option" class="fxt-login-option">
                            <ul>
                                <li class="fxt-google active">
                                    <a href="#">
                                        <span class="fxt-option-icon"><i class="fab fa-google"></i></span>
                                        <span class="fxt-option-text ml-2">Continue with Google</span>
                                    </a>
                                </li>
                                <li class="fxt-facebook">
                                    <a href="#">
                                        <span class="fxt-option-icon"><i class="fab fa-facebook-f"></i></span>
                                        <span class="fxt-option-text ml-2">Continue with Facebook</span>
                                    </a>
                                </li>
                                <li class="fxt-apple">
                                    <a href="#">
                                        <span class="fxt-option-icon"><i class="fab fa-apple"></i></span>
                                        <span class="fxt-option-text ml-2">Continue with Apple</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    <script src="js/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <!-- Validator js -->
    <script src="js/validator.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>


<!-- Mirrored from affixtheme.com/html/xmee/demo/register-33.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Nov 2022 16:26:09 GMT -->
</html>