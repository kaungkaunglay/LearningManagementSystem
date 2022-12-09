<?php
require_once "../Details.php";
session_start();
//get instructor details
$cols_array = array("TeacherName","TeacherEmail","TeacherDescription","TeacherPassword");
$condition  = [
    "TeacherID" => $_SESSION['TeacherID']
];
$data =  CRUD::Select("Teacher",$cols_array,$condition);
$student_name = $data[0]['TeacherName'];
$student_description = $data[0]['TeacherDescription'];
$student_email = $data[0]['TeacherEmail'];
$student_password = $data[0]['TeacherPassword'];

if(isset($_POST['submit'])){
    $update_name = htmlentities(trim($_POST['TeacherName']));
    $update_email = htmlentities(trim($_POST['Email']));
    $update_description = htmlentities(trim($_POST['Description']));
    $update_columns = [
            "TeacherName" => $update_name,
            "TeacherEmail"=> $update_email,
            "TeacherDescription" => $update_description
    ];
    $condition = [
            "TeacherID" => $_SESSION['TeacherID']
    ];
   CRUD::Update("Teacher", $update_columns,$condition);
   if(isset($_POST['OldPassword']) && isset($_POST['ConfirmPassword']) && isset($_POST['NewPassword'])){
        $old_password = hash("sha256",htmlentities(trim($_POST['OldPassword'])));
        $cols_array = array("TeacherPassword");
        $raw = CRUD::Select("Teacher",$cols_array,$condition);
        $student_password = $raw[0]["TeacherPassword"];
        if($old_password != $student_password){
               $_SESSION['message'] = "Incorrect password";
        }else{
            if($_POST['NewPassword'] != $_POST['ConfirmPassword']){
                $_SESSION['message'] = "New Password and Confirm password must be same";
            }else{
                $new_password = hash("sha256",htmlentities(trim($_POST['ConfirmPassword'])));
                $update_columns = [
                    "TeacherPassword" => $new_password
                ];
                CRUD::Update("Teacher",$update_columns,$condition);
            }
        }
   }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/student-edit-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:48 GMT -->
<?php
require_once "Head.php";
?>

<body class="layout-default">




    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
            <?php require_once "Navbar.php"?>
        </div>


        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">




                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex align-items-center justify-content-between">

                            <h1 class="m-0">Edit Account</h1>
                        </div>
                    </div>






                    <form class="container-fluid page__container" method="post" action="instructor-edit-profile.php">
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-4 card-body">
                                    <p><strong class="headings-color">Basic Information</strong></p>
                                    <p class="text-muted mb-0">Edit your account details and settings.</p>
                                </div>
                                <div class="col-lg-8 card-form__body card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="lname">Full name</label>
                                                <input id="lname" name="TeacherName" type="text" class="form-control" placeholder="Last name" value="<?php echo $student_name?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="lname">Email</label>
                                                <input id="lname" name="Email" type="text" class="form-control" placeholder="Email" value="<?php echo $student_email; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Bio / Description</label>
                                        <textarea name="Description" id="desc" rows="4" class="form-control" placeholder=""><?php echo $student_description ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Country</label><br />
                                        <select id="country" class="custom-select w-auto">
                                            <option value="usa">United States</option>
                                            <option value="usa">Canada</option>
                                        </select>
                                        <small class="form-text text-muted">The country is not visible to other users.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="subscribe">Subscribe to newsletter</label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input checked="" type="checkbox" id="subscribe" class="custom-control-input">
                                            <label class="custom-control-label" for="subscribe">Yes</label>
                                        </div>
                                        <label for="subscribe" class="mb-0">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-4 card-body">
                                    <p><strong class="headings-color">Update Your Password</strong></p>
                                    <p class="text-muted mb-0">Change your password.</p>
                                </div>
                                <div class="col-lg-8 card-form__body card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="opass">Old Password</label>
                                                <input  name="OldPassword" id="opass" type="password" class="form-control" placeholder="Old password">
                                            </div>
                                            <div class="form-group">
                                                <label for="npass">New Password</label>
                                                <input name="NewPassword"   id="npass" type="password" class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label for="cpass">Confirm Password</label>
                                                <input  name="ConfirmPassword" id="cpass" type="password" class="form-control" placeholder="Confirm password">
                                            </div>
                                            <div style="color: red;">
                                                <?php
                                                   if(isset($_SESSION['message'])){
                                                       echo $_SESSION['message'];
                                                       unset($_SESSION['message']);
                                                   }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-4 card-body">
                                    <p><strong class="headings-color">Profile Settings</strong></p>
                                    <p class="text-muted mb-0">Update your public profile with relevant and meaningful information.</p>
                                </div>
                                <div class="col-lg-8 card-form__body card-body">
                                    <div class="form-group">
                                        <label>Avatar</label>
                                        <div class="dz-clickable media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable" data-dropzone-files='["assets/images/account-add-photo.svg"]'>
                                            <div class="dz-preview dz-file-preview dz-clickable mr-3">
                                                <div class="avatar avatar-lg">
                                                    <img src="assets/images/account-add-photo.svg" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <button class="btn btn-sm btn-primary dz-clickable">Choose photo</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc2">Description</label>
                                        <textarea id="desc2" rows="4" class="form-control" placeholder="Description ..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="social1">Social links</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge mb-2">
                                                    <input id="social1" type="text" class="form-control form-control-prepended" placeholder="Facebook">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fab fa-facebook text-facebook"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-merge mb-2">
                                                    <input id="social2" type="text" class="form-control form-control-prepended" placeholder="Twitter">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fab fa-twitter text-twitter"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-merge mb-2">
                                                    <input id="social3" type="text" class="form-control form-control-prepended" placeholder="Instagram">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fab fa-instagram text-instagram"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="customCheck1">Available for freelance?</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                            <label class="custom-control-label" for="customCheck1">Yes, show me as available for freelance!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mb-5">
                            <input name="submit" type="submit" class="btn btn-success" value="Save">
                        </div>
                    </form>


                </div>
                <!-- // END drawer-layout__content -->

                <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
                    <div class="mdk-drawer__content">
                        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>

                            <?php require_once "sidebar_block.php" ?>
                            <div class="sidebar-block p-0">
                                <?php require_once "sidebar_menu.php" ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->


    <div class="mdk-drawer js-mdk-drawer" id="events-drawer" data-align="end">
        <div class="mdk-drawer__content">
            <div class="sidebar sidebar-light sidebar-left" data-perfect-scrollbar>




                <small class="text-dark-gray px-3 py-1">
                    <strong>Thursday, 28 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>12:30 PM</small>
                                <small class="text-dark-gray">2 hrs</small>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Marketing Team Meeting</strong></a>

                                    <small class="text-muted d-flex align-items-center"><i class="material-icons icon-16pt mr-1">location_on</i> 16845 Hicks Road</small>


                                </div>
                                <div class="avatar-group mt-2">

                                    <div class="avatar avatar-xs">
                                        <img src="assets/images/256_joao-silas-636453-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="assets/images/256_jeremy-banks-798787-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <small class="text-dark-gray px-3 py-1">
                    <strong>Wednesday, 27 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>07:48 PM</small>
                                <small class="text-dark-gray">30 min</small>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Call Alex</strong></a>


                                    <small class="text-muted d-flex align-items-center"><i class="material-icons icon-16pt mr-1">phone</i> 202-555-0131</small>

                                </div>



                            </div>
                        </div>
                    </div>

                </div>

                <small class="text-dark-gray px-3 py-1">
                    <strong>Tuesday, 26 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>03:13 PM</small>
                                <small class="text-dark-gray">2 hrs</small>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Design Team Meeting</strong></a>

                                    <small class="text-muted d-flex align-items-center"><i class="material-icons icon-16pt mr-1">location_on</i> 16845 Hicks Road</small>


                                </div>
                                <div class="avatar-group mt-2">

                                    <div class="avatar avatar-xs">
                                        <img src="assets/images/256_rsz_1andy-lee-642320-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="assets/images/256_michael-dam-258165-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="assets/images/stories/256_rsz_clem-onojeghuo-193397-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <small class="text-dark-gray px-3 py-1">
                    <strong>Monday, 25 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>12:30 PM</small>
                                <small class="text-dark-gray">2 hrs</small>
                            </div>
                            <div class="col d-flex">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Call Wendy</strong></a>


                                    <small class="text-muted d-flex align-items-center"><i class="material-icons icon-16pt mr-1">phone</i> 202-555-0131</small>

                                </div>


                                <div class="avatar avatar-xs">
                                    <img src="assets/images/256_michael-dam-258165-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default" :layout-location="{
      'default': 'student-edit-account.html',
      'fixed': 'fixed-student-edit-account.html',
      'fluid': 'fluid-student-edit-account.html',
      'mini': 'mini-student-edit-account.html'
    }"></app-settings>
    </div>

    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- Range Slider -->
    <script src="assets/vendor/ion.rangeSlider.min.js"></script>
    <script src="assets/js/ion-rangeslider.js"></script>

    <!-- App -->
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/sidebar-mini.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>




</body>


<!-- Mirrored from lema.frontted.com/student-edit-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:48 GMT -->
</html>