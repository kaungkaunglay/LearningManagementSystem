<?php
session_start();
require_once "../Details.php";
$TeacherName = null;
$TeacherDescription = null;
$TeacherEmail = null;
if(!isset($_SESSION['TeacherID'])){
    header("../Login/index.php");
}else{
    $teacherID = $_SESSION['TeacherID'];
    $columns = array("TeacherName","TeacherEmail","TeacherDescription");
    $condition = [
            "TeacherID" => $teacherID
    ];
    $raw = CRUD::Select("Teacher",$columns,$condition);
    $TeacherName = $raw[0]["TeacherName"];
    $TeacherEmail = $raw[0]["TeacherEmail"];
    $TeacherDescription = $raw[0]['TeacherDescription'];
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/instructor-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:56 GMT -->
<?php require_once "Head.php" ?>

<body class="layout-default">

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
            <?php require_once "Navbar.php" ?>
        </div>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">


                    <div class="bg-secondary text-white d-flex justify-content-center align-items-center p-4 mb-4" style="height:400px">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center text-lg-left">
                            <div class="mr-lg-4 mb-4 mb-lg-0">
                                <img src="assets/images/256_jeremy-banks-798787-unsplash.jpg" class="rounded-circle" width="200" alt="Frontted">
                            </div>
                            <div>
                                <h1 class="mb-lg-4"><?php echo $TeacherName; ?> </h1>
                                <p class="mb-lg-4"><?php  echo $TeacherDescription;?></p>
<!--                                <a href="#" class="mr-3 text-white text-underline">https://www.frontted.com</a> <i class="fab fa-twitter"></i>-->
                            </div>
                            <div>
                                <button class="btn btn-primary" onclick="window.location='instructor-edit-profile.php'">Edit Account</button>
                            </div>
                        </div>

                    </div>


                    <div class="container-fluid page__container">
                        <h4 class="mb-4"><?php echo $TeacherName; ?>'s Quizs</h4>

                        <div class="row">
                            <?php
                            $columns = array("TestID","TestName","TestDescription");
                            $condition = [
                                    "TeacherID" => $_SESSION['TeacherID']
                            ];
                            $raw = CRUD::Select("Test", $columns,$condition);
                            foreach($raw as $value){
                            ?>
                            <div class="col-md-3">
                                <div class="card card__course">
                                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="#">
                                            <span><img src="assets/images/logos/react.svg" class="mb-1" style="width:34px;" alt="logo"></span>
                                            <span class="course__title"><?php echo $value["TestName"] ?></span>
                                            <span class="course__subtitle"><?php echo $value["TestDescription"] ?></span>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <div class="mb-2">
                                            <span class="mr-2">
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star_half</i></a>
                                            </span>
                                            <strong>4.7</strong><br />
                                            <small class="text-muted">(391 ratings)</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <strong class="h4 m-0">$49</strong>
                                            <a href="instructor-quiz-edit.php?tid=<?php echo $value['TestID']; ?>" class="btn btn-primary ml-auto"><i class="material-icons">edit</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <h4 class="mb-4"><?php echo $TeacherName; ?>'s Courses</h4>

                        <div class="row">
                            <?php
                            $columns = array("CourseID","CourseName","CourseDescription");
                            $condition = [
                                    "TeacherID" => $_SESSION['TeacherID']
                            ];
                            $raw = CRUD::Select("Course",$columns,$condition);
                            foreach($raw as $value){
                                ?>
                                <div class="col-md-3">
                                    <div class="card card__course">
                                        <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                            <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="#">
                                                <span><img src="assets/images/logos/react.svg" class="mb-1" style="width:34px;" alt="logo"></span>
                                                <span class="course__title"><?php echo $value["CourseName"] ?></span>
                                                <span class="course__subtitle"><?php echo $value["CourseDescription"] ?></span>
                                            </a>
                                        </div>
                                        <div class="p-3">
                                            <div class="mb-2">
                                            <span class="mr-2">
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star_half</i></a>
                                            </span>
                                                <strong>4.7</strong><br />
                                                <small class="text-muted">(391 ratings)</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <strong class="h4 m-0">$49</strong>
                                                <a href="instructor-lesson-edit.php?cid=<?php echo $value['CourseID']; ?>" class="btn btn-primary ml-auto"><i class="material-icons">edit</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>


                </div>
                <!-- // END drawer-layout__content -->

                <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
                    <div class="mdk-drawer__content">
                        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>
                            <div class="sidebar-block p-0 m-0">
                             <?php require_once "sidebar_block.php" ?>
                            </div>
                            <div class="sidebar-block p-0">
                                <?php require_once  "sidebar_menu.php" ?>
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
      'default': 'instructor-profile.html',
      'fixed': 'fixed-instructor-profile.html',
      'fluid': 'fluid-instructor-profile.html',
      'mini': 'mini-instructor-profile.html'
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


<!-- Mirrored from lema.frontted.com/instructor-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:56 GMT -->
</html>