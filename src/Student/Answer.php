<?php
$questions = array();
$questionsID = array();
session_start();

if(!isset($_GET['testid'])){
    header("Location: StudentTest.php");
}
if(!isset($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
if(isset($_POST['next'])){
    $_SESSION['count'] = $_SESSION['count'] + 1;
}
if(isset($_POST['previous'])){
    $_SESSION['count'] = $_SESSION['count'] - 1;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/student-take-quiz.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:52 GMT -->
<?php
require_once  "Head.php";
?>
<body class="layout-default">
<!-- Header Layout -->
<div class="mdk-header-layout js-mdk-header-layout">

    <!-- Header -->

    <div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
        <div class="mdk-header__content">

      <?php require_once "navbar_expand.php"; ?>

        </div>
    </div>

    <!-- // END Header -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content">

        <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page">




                <div class="container-fluid page__heading-container">
                    <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                        <div>
                            <h1 class="m-lg-0">Final Quiz</h1>
                            <div class="d-inline-flex align-items-center">
                                <i class="material-icons icon-16pt mr-1 text-muted">school</i> <a href="#" class="text-muted">Getting Started with InVision</a>
                            </div>
                        </div>

                        <a href="StudentTest.php" class="btn btn-success ml-lg-3 mt-3 mt-lg-0">Back to Test <i class="material-icons">arrow_forward</i></a>
                    </div>
                </div>
                <?php
                function Check_Answer_is_Correct($QuestionChoiceID, $QuestionID){
                    $columns_array = array("is_right_choice");
                    $condition = [
                        "QuestionChoiceID" => $QuestionChoiceID,
                        "QuestionID" => $QuestionID
                    ];
                    $result =  CRUD::Select("QuestionChoice",$columns_array,$condition);
                    return $result[0]["is_right_choice"];
                }
                if(isset($_POST['submit'])){
                    echo "<script>window.location='StudentTest.php'</script>";
                }
                $columns = array("QuestionID","QuestionName");
                $condition =
                    [
                        "TestID" => $_GET['testid']
                    ];
                $raw = CRUD::Select(
                    "Question",$columns,$condition);

                foreach($raw as $value){
                    $questions[] = $value["QuestionName"];
                    $questionsID[] = $value["QuestionID"];
                }
                ?>
                <div class="container-fluid page__container">
<!--                    UserAnswered Form-->
                        <form class="col-md-8" method="post" action="Answer.php?testid=<?php echo $_GET['testid'] ?>">
                            <div class="card">
                                <div class="card-header">
                                    <div class="media align-items-center">
                                        <div class="media-left">
                                            <h4 class="m-0 text-primary mr-2"><strong>#<?php echo $_SESSION['count'] +1 ?></strong></h4>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="card-title m-0">
                                                <?php echo $questions[$_SESSION['count']]; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $answer_column = array("QuestionChoiceID", "choice","is_right_choice");
                                    $condition =
                                        [
                                            "QuestionID" =>$questionsID[$_SESSION['count']]
                                        ];
                                    $data = CRUD::Select("QuestionChoice",$answer_column,$condition);

                                    function Check_Answered($questionID,$qtChoice){
                                        $columns = array("QuestionChoiceID");
                                        $condition = [
                                                "QuestionID" => $questionID[$_SESSION['count']],
                                                "TestID" => $_GET['testid']
                                        ];
                                       $raw = CRUD::Select("QuestionAnswer",$columns, $condition);
                                       if(!empty($raw)) {
                                           if ($qtChoice == $raw[0]['QuestionChoiceID']) {
                                               echo "Checked";
                                           } else {
                                               echo "disabled";
                                           }
                                       }
                                    }
                                    foreach($data as $value){
                                        ?>
                                        <li class="list-group-item d-flex" data-position="2" data-answer-id="5" data-question-id="2">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                <?php echo $value['choice'];  ?>
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="choice" value="<?php echo $value['QuestionChoiceID'] ?>" <?php Check_Answered($questionsID,$value['QuestionChoiceID']);  ?>>
                                            </div>
                                        </li>
                                    <?php  } ?>
                                </div>
                                <div class="card-footer">
                                    <?php
                                    if($_SESSION['count'] < count($questions)-1){
                                        ?>
                                        <input name="next" type="submit" class="btn btn-light" value="Next">
                                        <?php
                                    }
                                    if($_SESSION['count'] !=0){
                                        ?>
                                        <input name="previous" type="submit" class="btn btn-light" value="Previous">
                                    <?php }?>
                                    <?php   if($_SESSION['count'] == count($questions) -1){ ?>
                                        <input name="submit" type="submit" class="btn btn-success float-right" value="Done">
                                    <?php }?>
                                    <input type="hidden" name="QuestionID" value="<?php echo $questionsID[$_SESSION['count']] ?>">
                                </div>
                            </div>
                        </form>
<!--                       System Answered Form-->

                          <form class="col-md-8" method="post" action="Answer.php?testid=<?php echo $_GET['testid'] ?>">
                        <h5 style="color: green">Correct Answer: </h5> <br>
                        <div class="card">
                            <div class="card-header">
                                <div class="media align-items-center">
                                    <div class="media-left">
                                        <h4 class="m-0 text-primary mr-2"><strong>#<?php echo $_SESSION['count'] +1 ?></strong></h4>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="card-title m-0">
                                            <?php echo $questions[$_SESSION['count']]; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                        <?php
                        $answer_column = array("QuestionChoiceID", "choice","is_right_choice");
                        $condition =
                            [
                                "QuestionID" =>$questionsID[$_SESSION['count']]
                            ];
                        $data = CRUD::Select("QuestionChoice",$answer_column,$condition);

                        function System_Correct($questionID, $qtchoiceID){
                            $columns = array("QuestionChoiceID","is_right_choice");
                            $condition = [
                                "QuestionID" => $questionID[$_SESSION['count']]
                            ];
                            $raw = CRUD::Select("QuestionChoice",$columns, $condition);
                            if(!empty($raw)) {
                                for($i=0; $i < count($raw); $i++){
                                   if($raw[$i]["QuestionChoiceID"] == $qtchoiceID){
                                        if($raw[$i]["is_right_choice"] == 1) {
                                            echo "checked";
                                        }else{
                                            echo "disabled";
                                        };
                                   }
                                }
                            }
                        }
                        function Change_Color($questionID, $qtChoiceID){
                            $columns = array("QuestionChoiceID","is_right_choice");
                            $condition = [
                                "QuestionID" => $questionID[$_SESSION['count']]
                            ];
                            $raw = CRUD::Select("QuestionChoice",$columns, $condition);
                            if(!empty($raw)) {
                                for($i=0; $i < count($raw); $i++){
                                    if($raw[$i]["QuestionChoiceID"] == $qtChoiceID){
                                        if($raw[$i]["is_right_choice"] == 1) {
                                            echo "background-color:green;color:white;";
                                        }
                                    }
                                }
                            }
                        }
                        foreach($data as $value){
                        ?>
                                <li style="<?php Change_Color($questionsID, $value['QuestionChoiceID']); ?>" class="list-group-item d-flex" data-position="2" data-answer-id="5" data-question-id="2">
                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                    <div >
                                        <?php echo $value['choice']  ?>
                                    </div>
                                    <div  id="<?php echo $value['QuestionChoiceID']; ?>" class="ml-auto">
                                        <input type="radio" name="choice" value="<?php echo $value['QuestionChoiceID'] ?>" <?php System_Correct($questionsID, $value['QuestionChoiceID']); ?>>
                                    </div>
                                </li>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- // END drawer-layout__content -->

            <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
                <div class="mdk-drawer__content">
                    <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>


                        <div class="sidebar-block p-0 m-0">
                            <div class="d-flex align-items-center sidebar-p-a border-bottom bg-light">
                                <a href="#" class="flex d-flex align-items-center text-body text-underline-0">
                                        <span class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-soft-secondary text-muted">AD</span>
                                        </span>
                                    <span class="flex d-flex flex-column">
                                            <strong>Adrian Demian</strong>
                                            <small class="text-muted text-uppercase">Instructor</small>
                                        </span>
                                </a>
                                <div class="dropdown ml-auto">
                                    <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="student-dashboard.html">Dashboard</a>
                                        <a class="dropdown-item" href="student-profile.html">My profile</a>
                                        <a class="dropdown-item" href="student-edit-account.html">Edit account</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" rel="nofollow" data-method="delete" href="login.html">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php require_once "sidebar.php"; ?>

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
      'default': 'student-take-quiz.html',
      'fixed': 'fixed-student-take-quiz.html',
      'fluid': 'fluid-student-take-quiz.html',
      'mini': 'mini-student-take-quiz.html'
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


<!-- Mirrored from lema.frontted.com/student-take-quiz.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:52 GMT -->
</html>