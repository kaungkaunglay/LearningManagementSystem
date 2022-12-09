<?php
require_once "../Details.php";
require_once "Time.php";
$course_name = null;
$teacher_name = null;
$teacher_description = null ;
$course_Description  = null;
$total_time = 0;
if(isset($_GET['cid'])){
    $columns_array = array("CourseName","CourseDescription","TeacherID");
    $condition = [
            "CourseID" => $_GET['cid']
    ];
    $row = CRUD::Select("Course",$columns_array,$condition);
    $course_name = $row[0]["CourseName"];
    $course_Description = $row[0]["CourseDescription"];
    $teacher_array = array("TeacherName","TeacherEmail","TeacherDescription");
    $condition = [
            "TeacherID" => $row[0]["TeacherID"]
    ];
    $row = CRUD::Select("Teacher",$teacher_array, $condition);
    $teacher_name = $row[0]["TeacherName"];
    $teacher_description = $row[0]["TeacherDescription"];
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/student-course.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:52 GMT -->
<?php require_once "Head.php"; ?>

<body class="layout-default">

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
        <?php require_once "Navbar.php"; ?>
        </div>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">



                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <div>
                                <h1 class="m-lg-0"><?php echo $course_name. " Course"; ?></h1>
                                <div class="d-inline-flex align-items-center">
                                    <i class="material-icons icon-16pt mr-1 text-muted">access_time</i> 2 <small class="text-muted ml-1 mr-1">hours</small>: 26 <small class="text-muted ml-1">min</small>
                                </div>
                            </div>
                            <div>
                                <a href="instructor-lesson-edit.php?cid=<?php echo $_GET['cid'] ?>" class="btn btn-success">
                                    <strong>Back</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $file = null;
                    $file_column = array("ResourceImage");
                    if(isset($_GET['rid']))
                    {
                        $condition = [
                            "ResourceID" => $_GET['rid'],
                            "CourseID" => $_GET['cid']
                        ];
                        $data = CRUD::Select("Resource", $file_column,$condition);
                        $file = $data[0]['ResourceImage'];

                        $condition =[
                            "CourseID" => $_GET['cid']
                        ];
                        $data = CRUD::Select("Resource",$file_column,$condition,1);
                        $file = $data[0]['ResourceImage'];
                    }else{

                    }
                    ?>
                    <div class="container-fluid page__container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="<?php echo $file; ?>" allowfullscreen=""></iframe>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <div class="media align-items-center">
                                            <div class="media-left">
                                                <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="About Adrian" width="40" class="rounded-circle">
                                            </div>
                                            <div class="media-body">
                                                <div class="card-title mb-0"><a href="student-profile.html" class="text-body"><strong><?php echo $teacher_name; ?></strong></a></div>
                                                <p class="text-muted mb-0">Instructor</p>
                                            </div>
                                            <div class="media-right">
                                                <a href="#" class="btn btn-facebook btn-sm"><i class="fab fa-facebook"></i></a>
                                                <a href="#" class="btn btn-twitter btn-sm"><i class="fab fa-twitter"></i></a>
                                                <a href="#" class="btn btn-light btn-sm"><i class="fab fa-github"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                       <?php echo $teacher_description; ?>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                                        <div class="flex">
                                            <h4 class="card-header__title">Course Description</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                    <p><?php echo $course_Description; ?></p>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">

                                <!-- Lessons -->
                                <div class="card">
                                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                                        <div class="flex">
                                            <h4 class="card-header__title">Course Lessons</h4>
                                        </div>
                                    </div>

                                    <ul class="list-group list-group-fit">
                                        <?php
                                        function active($resource_id, $rid){
                                            if($resource_id == $rid)
                                            {
                                                echo "active";
                                            }
                                        }
                                        function ChangeText($resource_id, $rid){
                                            if($resource_id  == $rid){
                                                echo "white";
                                            }else{
                                                echo "blue";
                                            }
                                        }

                                if(isset($_GET['rid'])){
                                            if(isset($_GET['cid'])){
                                                $resource_columns = array("ResourceID","ResourceName","Description","Duration");
                                                $condition = [
                                                        "CourseID" => $_GET['cid']
                                                ];
                                                $row = CRUD::Select("Resource",null,$condition);
                                                $i = 1;
                                                foreach($row as $item){
                                        ?>
                                        <li class="list-group-item <?php active($item['ResourceID'],$_GET['rid']) ?>">
                                            <div  class="media">
                                                <div class="media-left"><?php echo $i; ?>.</div>
                                                <div class="media-body">
                                                    <a class="text-<?php ChangeText($item['ResourceID'],$_GET['rid']); ?>" href="CoursePreview.php?cid=<?php echo $item['CourseID'] ?>&rid=<?php echo $item['ResourceID'] ?>"><?php echo $item['ResourceName']; ?></a>
                                                </div>
                                                <div class="media-right">
                                                    <small><?php

                                                        echo $item['Duration']  ?></small>
                                                </div>
                                            </div>
                                        </li>
                                        <?php      $i++; }
                                                }}?>

                                    </ul>
                                </div>

                                <!--
                <div class="rating text-warning">
                    <i class="material-icons">star</i>
                    <i class="material-icons">star</i>
                    <i class="material-icons">star</i>
                    <i class="material-icons">star</i>
                    <i class="material-icons">star_border</i>
                </div>
                <small class="text-muted">20 ratings</small>
            </div>
        </div> -->
                            </div>
                        </div>
                    </div>


                </div>
                <!-- // END drawer-layout__content -->

                <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
                    <div class="mdk-drawer__content">
                        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>
                            <?php  require_once "sidebar_block.php"; ?>
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
                <?php require_once "sidebar_block.php" ?>
                <div class="sidebar-block p-0">
                    <?php require_once "sidebar_menu.php" ?>
                </div>
            </div>
        </div>
    </div>

    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default" :layout-location="{
      'default': 'student-course.html',
      'fixed': 'fixed-student-course.html',
      'fluid': 'fluid-student-course.html',
      'mini': 'mini-student-course.html'
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


<!-- Mirrored from lema.frontted.com/student-course.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:52 GMT -->
</html>