<?php
require_once "../Details.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/instructor-courses.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:55 GMT -->
<?php require_once "Head.php"?>

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



                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <h1 class="m-lg-0">Instructor Tests</h1>
                            <a href="instructor-quiz-edit.php" class="btn btn-success ml-lg-3">New Test <i class="material-icons">add</i></a>
                        </div>
                    </div>





                    <div class="container-fluid page__container">
                        <form action="#" class="mb-2">
                            <div class="d-flex">
                                <div class="search-form mr-3 search-form--light">
                                    <input type="text" class="form-control" placeholder="Filter by name" id="searchSample02">
                                    <button class="btn" type="button"><i class="material-icons">search</i></button>
                                </div>

                                <div class="form-inline ml-auto">
                                    <div class="form-group mr-3">
                                        <label for="custom-select" class="form-label mr-1">Sort</label>
                                        <select id="custom-select" class="form-control custom-select" style="width: 200px;">
                                            <option selected>Name</option>
                                            <option value="2">Created Date</option>
                                            <option value="1">Earnings</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="published01" class="form-label mr-1">Status</label>
                                        <select id="published01" class="form-control custom-select" style="width: 200px;">
                                            <option selected>Published</option>
                                            <option value="1">Draft</option>
                                            <option value="3">All</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
            <?php
            CRUD::Clean();
            $columns = array("TestID","TestName","TestDescription","CreationDate");
            $condition = [
                    "TeacherID" => $_SESSION['TeacherID']
            ];
            $raw = CRUD::Select("Test",$columns,$condition);
            foreach($raw as $item){
            ?>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="d-flex flex-column flex-sm-row">
                                            <a href="#" class="avatar mb-3 w-xs-plus-down-100 mr-sm-3">
                                                <img src="assets/images/logos/vuejs.svg" alt="Card image cap" class="avatar-course-img">
                                            </a>
                                            <div class="flex" style="min-width: 200px;">
                                                <div class="d-flex">
                                                    <div>
                                                        <h4 class="card-title mb-1"><a href="instructor-quiz-edit.php?tid=<?php echo $item['TestID'] ?>"><?php echo $item['TestName'] ?></a></h4>
                                                        <p class="text-muted"><?php echo $item['TestDescription']; ?></p>
                                                    </div>
                                                    <div class="dropdown ml-auto">
                                                        <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="instructor-quiz-edit.php?tid=<?php echo $item['TestID'] ?>">Edit Course</a>
                                                            <a class="dropdown-item" href="CourseRedirect.php?tid=<?php echo $item['TestID'] ?>">Create Quiz</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="delete.php?tid=<?php echo $item['TestID'] ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $columns = array("QuestionID");
                                                $condition = [
                                                        "TestID" => $item['TestID']
                                                ];
                                                $data = CRUD::Select("Question",$columns,$condition);
                                                ?>
                                                <div class="d-flex align-items-end">
                                                    <div class="d-flex flex flex-column mr-3">
                                                        <div class="d-flex align-items-center py-2 border-bottom">
                                                            <span class="mr-2"><?php echo "Created at : ". $item['CreationDate']; ?></span>
                                                            <small class="text-muted ml-auto"><?php echo count($data);  ?> Quizs</small>
                                                        </div>
<!--                                                        <div class="d-flex align-items-center py-2">-->
<!--                                                            <span class="badge badge-vuejs mr-2">VUEJS</span>-->
<!--                                                            <span class="badge badge-soft-secondary">INTERMEDIATE</span>-->
<!--                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

<?php }?>

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
      'default': 'instructor-courses.html',
      'fixed': 'fixed-instructor-courses.html',
      'fluid': 'fluid-instructor-courses.html',
      'mini': 'mini-instructor-courses.html'
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


<!-- Mirrored from lema.frontted.com/instructor-courses.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:55 GMT -->
</html>