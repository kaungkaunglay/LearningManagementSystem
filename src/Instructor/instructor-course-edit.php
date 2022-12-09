<?php
require_once "../Details.php";
session_start();
$Test_ID = null;
$Test_name = null;
$description = null;
if(!isset($_SESSION['TeacherID'])){
    header("../Login/index.php");
}
if(isset($_GET['cid'])){
    $_SESSION['cid'] = $_GET['cid'];
    $condition12 = [
        "CourseID" => $_GET['cid']
    ];
    $raw = CRUD::Select("Course",array("CourseName","CourseDescription"),$condition12);
    $Test_name = $raw[0]['CourseName'];
    $description = $raw[0]['CourseDescription'];
}
if(isset($_POST['submit'])){
    if(isset($_GET['cid'])){
        $columns = [
            "CourseName" => $_POST['name'],
            "CourseDescription" => $_POST['description']
        ];
        $condition = [
            "CourseID"  => $_SESSION['cid']
        ];
        $check = CRUD::Update("Course", $columns,$condition);
        header("Location: instructor-course.php");
    }else{
        $Course_name = $_POST['name'];
        $Coursedescription = $_POST['description'];
        $data = [
            "CourseID" => "CID".CRUD::Fake_Characters(5),
            "CourseName" => $Course_name,
            "CourseDescription" => $Coursedescription,
            "TeacherID" => $_SESSION['TeacherID']
        ];
        $check = CRUD::Insert("Course",$data);
        if($check){
            header("Location: instructor-course.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php require_once "Head.php" ?>

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
                        <h1 class="m-0">Create Course</h1>
                    </div>
                </div>




                <div class="container-fluid page__container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <form class="card-form__body card-body" action="instructor-course-edit.php<?php if(isset($_GET['cid'])) {echo '?cid='.$_GET['cid']; } ?>" method="post">
                                    <div class="form-group">
                                        <label for="fname">Test Name</label>
                                        <input required name="name" id="fname" type="text" class="form-control" placeholder="Title goes here" value="<?php if(!is_null($Test_name)){echo $Test_name;} ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Test Description</label>
                                        <textarea required name="description" id="desc" rows="4" class="form-control"><?php if(!is_null($description)){echo $description;} ?></textarea>
                                    </div>

                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="category">Category</label><br />-->
                                    <!--                                            <select id="category" class="custom-select w-auto">-->
                                    <!--                                                <option value="usa">Web Design</option>-->
                                    <!--                                                <option value="usa">Web Development</option>-->
                                    <!--                                                <option value="usa">Marketing</option>-->
                                    <!--                                            </select>-->
                                    <!--                                        </div>-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="subscribe">Published</label><br>-->
                                    <!--                                            <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">-->
                                    <!--                                                <input checked="" type="checkbox" id="subscribe" class="custom-control-input">-->
                                    <!--                                                <label class="custom-control-label" for="subscribe">Yes</label>-->
                                    <!--                                            </div>-->
                                    <!--                                            <label for="subscribe" class="mb-0">Yes</label>-->
                                    <!--                                        </div>-->

                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label>Course Preview</label>-->
                                    <!--                                            <div class="dz-clickable media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable" data-dropzone-files='["assets/images/account-add-photo.svg"]'>-->
                                    <!--                                                <div class="dz-preview dz-file-preview dz-clickable mr-3">-->
                                    <!--                                                    <div class="avatar avatar-lg">-->
                                    <!--                                                        <img src="assets/images/account-add-photo.svg" class="avatar-img rounded" alt="..." data-dz-thumbnail>-->
                                    <!--                                                    </div>-->
                                    <!--                                                </div>-->
                                    <!--                                                <div class="media-body">-->
                                    <!--                                                    <button class="btn btn-sm btn-light dz-clickable">Choose photo</button>-->
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                        </div>-->
                                    <div class="card-body text-center">

                                        <button name="submit" type="submit" class="btn btn-success">Save Changes</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                        <div class="col-md-4">

                            <!-- Lessons -->
                            <div class="card">
                                <div class="card-header card-header-large bg-light d-flex align-items-center">
                                    <div class="flex">
                                        <h4 class="card-header__title">Lessons</h4>
                                        <div class="card-subtitle text-muted">Manage Lessons</div>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="student-courses.html" class="btn btn-primary">New <i class="material-icons">add</i></a>
                                    </div>
                                </div>


                                <ul class="list-group list-group-fit">
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <i class="material-icons text-light-gray">list</i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#">Overview</a>
                                            </div>
                                            <div class="media-right">
                                                <small class="text-muted">3:33</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <i class="material-icons text-light-gray">list</i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#">Asset Pipeline</a>
                                            </div>
                                            <div class="media-right">
                                                <small>18:43</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <i class="material-icons text-light-gray">list</i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#">Getting Started</a>
                                                <small class="badge badge-soft-success ">FREE</small>
                                            </div>
                                            <div class="media-right">
                                                <small class="text-muted">5:21</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <i class="material-icons text-light-gray">list</i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#">Advanced Workflows</a>
                                                <small class="badge badge-soft-warning ">PRO</small>
                                            </div>
                                            <div class="media-right">
                                                <small class="text-muted">5:24</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <i class="material-icons text-light-gray">list</i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#">Tips & Tricks</a>
                                                <small class="badge badge-soft-warning ">PRO</small>
                                            </div>
                                            <div class="media-right">
                                                <small class="text-muted">11:38</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <i class="material-icons text-light-gray">list</i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#">Final Quiz</a>
                                            </div>
                                            <div class="media-right">
                                                <small class="badge badge-soft-primary ">QUIZ</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>


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
      'default': 'instructor-course-edit.html',
      'fixed': 'fixed-instructor-course-edit.html',
      'fluid': 'fluid-instructor-course-edit.html',
      'mini': 'mini-instructor-course-edit.html'
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


<!-- Dropzone -->
<script src="assets/vendor/dropzone.min.js"></script>
<script src="assets/js/dropzone.js"></script>

</body>


<!-- Mirrored from lema.frontted.com/instructor-course-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:55 GMT -->
</html>