<?php
require_once "../Details.php";
session_start();
$Questions = array();
$QuestionID = array();

if(!isset($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
$course_name  = null;
$count = 0;

if(!isset($_GET['tid'])){
    header("Location: instructor-tests.php");
}else{
    $_SESSION['tid'] = $_GET['tid'];
    $columns = array("TestName");
    $condition = [
            "TestID" => $_GET['tid']
    ];
    $raw = CRUD::Select("Test",$columns,$condition);
    $course_name = $raw[0]['TestName'];
    if(isset($_POST['CreateQuestion'])){
        $Question_Name = $_POST['Qname'];
        $insert_question_column = [
                "QuestionID" => "QID".CRUD::Fake_Characters(5),
                "QuestionName" => $Question_Name,
                "is_active" => 0,
                "TestID" => $_GET['tid']
        ];
        CRUD::Insert("Question", $insert_question_column);
    }


}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/instructor-create-quiz.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:55 GMT -->
<?php require "Head.php" ?>
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
                            <h1 class="m-lg-0"> <?php echo $course_name ?> :: Quiz</h1>
                            <a href="instructor-tests.php" class="btn btn-success ml-lg-3">Back to Course <i class="material-icons">arrow_forward</i></a>
                        </div>
                    </div>

                    <div class="container-fluid page__container">
                        <?php
                        function Update_Choice($QuestionID){
                            if(isset($_POST['correct'])) {
                                $choice = $_POST['correct'];
                                $Update_columns = [
                                    "is_right_choice" => 1
                                ];
                                $condition = [
                                    "QuestionChoiceID" => $choice,
                                    "QuestionID" =>  $QuestionID
                                ];
                                $update_all_columns = [
                                        "is_right_choice" => 0
                                ];
                                $all_condition = [
                                        "QuestionID" => $QuestionID
                                ];
                                CRUD::Update("QuestionChoice", $update_all_columns, $all_condition); // update all columns
                                CRUD::Update("QuestionChoice", $Update_columns, $condition); // update specific column is only true
                            }
                        }
                        ?>
                        <?php
                            if(isset($_POST['next']))
                            {
                                if(isset($_POST['QuestionID'])){
                                    $_SESSION['QuestionID'] = $_POST['QuestionID'];
                                }
                                Update_Choice($_SESSION['QuestionID']);
                                $_SESSION['count'] = $_SESSION['count'] + 1;
                            }
                            if(isset($_POST['previous'])){
                                if(isset($_POST['QuestionID'])){
                                    $_SESSION['QuestionID'] = $_POST['QuestionID'];
                                }
                                Update_Choice($_SESSION['QuestionID']);
                                $_SESSION['count'] = $_SESSION['count'] - 1;
                            }

                        ?>
                            <div class="card">
                            <div class="card-body card-form__body">
                                <form action="instructor-create-quiz.php?tid=<?php echo $_GET['tid'] ?>" method="post">
                                    <div class="form-group mb-3">
                                        <label class="control-label h6">New Question:</label>
                                        <input name="Qname" type="text"  class="form-control">
                                    </div>
                                    <button name="CreateQuestion" class="btn btn-primary"><i class="material-icons">add</i> Create Question</button>
                                </form>
                            </div>
                        </div>

                        <div id="questions_wrapper">


                    <?php
                        $columns = array("QuestionID", "QuestionName");
                        $condition = [
                                "TestID" => $_GET['tid']
                        ];
                        $raw = CRUD::Select("Question", $columns, $condition);

                        foreach($raw as $key => $value) {
                            $QuestionID[] = $value["QuestionID"];
                            $Questions[]  = $value["QuestionName"];
                        }

                    ?>
<?php
if(!empty($Questions)){
?>
                            <div class="card mb-4" data-position="1" data-question-id="1">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex align-items-center ">

                                        <span class="question_handle btn btn-sm btn-secondary">
                                            <i class="material-icons">menu</i>
                                        </span>
                                        <div class="h4 m-0 ml-4">Q: <?php
                                               if($_SESSION['count'] > count($Questions) -1){
                                                   $_SESSION['count'] = 0;
                                               }else{
                                                   echo $Questions[$_SESSION['count']];
                                               }
                                                ?></div>

                                    </div>
                                    <div>
                                        <a href="DeleteQuestion.php?qid=<?php echo $QuestionID[$_SESSION['count']].'&&tid='.$_GET['tid']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div id="answerWrapper_1" class="mb-4">
                                        <div class="row mb-1">
                                            <div class="col"><strong></strong></div>
                                        </div>
                                        <?php
                                        $raw = "";
                                        function Select($QuestionID){
                                            $choices = array("QuestionChoiceID","choice","is_right_choice");

                                            $condition = [
                                                "QuestionID" => $QuestionID[$_SESSION['count']]
                                            ];

                                            return CRUD::Select("QuestionChoice", $choices, $condition);
                                        }
                                             $raw = Select($QuestionID);

                                            if (isset($_POST['add'])) {
                                                $choice = $_POST['choice'];
                                                $insert_columns = [
                                                    "QuestionChoiceID" => "QCID".CRUD::Fake_Characters(5),
                                                    "QuestionID" => $QuestionID[$_SESSION['count']],
                                                    "is_right_choice" => 0,
                                                    "choice" => $choice
                                                ];
                                                $_SESSION['QuestionID'] = $QuestionID[$_SESSION['count']];
                                                $check = CRUD::Insert("QuestionChoice", $insert_columns);
                                                 $raw = Select($QuestionID);
                                            }
                                            if(isset($_POST['submit'])){
                                                Update_Choice($QuestionID[$_SESSION['count']]);
                                                echo "<script>window.location='instructor-tests.php'</script>";
                                            }


                                        ?>
                                        <script>
                                        </script>
                                        <form action="instructor-create-quiz.php?tid=<?php echo $_GET['tid'] ?>" method="post">
                                            <ul class="list-group" id="answer_container_1">
                                                <?php
                                                foreach($raw as $value){
                                                ?>
                                                <li class="list-group-item d-flex" data-position="1" data-answer-id="1" data-question-id="1">
                                                    <span class="mr-2"><i class="material-icons"><a style="text-decoration: none" href="DeleteQuestion.php?qcid=<?php echo $value['QuestionChoiceID'].'&&tid='.$_GET['tid'];?>">delete</a></i></span>
                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                                    <label for="<?php echo $value['QuestionChoiceID'] ?>">
                                                        <?php echo $value['choice']; ?>
                                                    </label>
                                                    <div class="ml-auto">
                                                        <input id="<?php echo $value['QuestionChoiceID'] ?>"  type="radio" name="correct" value="<?php echo $value['QuestionChoiceID'] ?>" <?php
                                                        if($value['is_right_choice'] == 1){ echo "checked";}
                                                        ?>>
                                                    </div>
                                                </li>

                                                <?php } ?>
                                                <li style="background-color:silver" class="list-group-item d-flex" data-position="3" data-answer-id="3" data-question-id="1">
                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                                    <input name="choice" type="text"  class="form-control">
                                                </li>
                                                <div class="form-group mb-0">
                                                    <button name="add" type="submit" style="margin-top: 40px; float: left; width: 200px;" class="btn btn-success">ADD</button>
                                                    <div style="float: right;">
                                            <?php
                                                    if($_SESSION['count'] !=0){
                                                    ?>
                                                    <button name="previous" type="submit" style="margin-top: 40px;  width: 100px;" class="btn btn-success">Previous</button>
                                                <?php } ?>
                                                        <?php
                                                        if($_SESSION['count'] < count($Questions)-1){
                                                        ?>
                                                        <button name="next" type="submit" style="margin-top: 40px;  width: 100px;" class="btn btn-success">Next</button>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if($_SESSION['count'] == count($Questions) -1){
                                                        ?>
                                                        <button name="submit" type="submit" style="margin-top: 40px;  width: 100px;" class="btn btn-success">Submit</button>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <input type="hidden" id="QuestionID" name="QuestionID" value="<?php echo $QuestionID[$_SESSION['count']] ?>">
                                                </div>

                                            </ul>

                                        </form>

                                    </div>
                                </div>
                            </div>
                            <?php } ?>
<!---->
<!--                            <div class="card mb-4" data-position="1" data-question-id="1">-->
<!--                                <div class="card-header d-flex justify-content-between">-->
<!--                                    <div class="d-flex align-items-center ">-->
<!---->
<!--                                        <span class="question_handle btn btn-sm btn-secondary">-->
<!--                                            <i class="material-icons">menu</i>-->
<!--                                        </span>-->
<!--                                        <div class="h4 m-0 ml-4">Q: How you define something?</div>-->
<!--                                    </div>-->
<!--                                    <div>-->
<!--                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="card-body">-->
<!---->
<!---->
<!--                                    <div id="answerWrapper_2" class="mb-4">-->
<!--                                        <div class="row mb-1">-->
<!--                                            <div class="col"><strong></strong></div>-->
<!--                                            <div class="col text-right"><strong>Correct</strong></div>-->
<!--                                        </div>-->
<!---->
<!--                                        <form action="#">-->
<!--                                            <ul class="list-group" id="answer_container_2">-->
<!--                                                <li class="list-group-item d-flex" data-position="1" data-answer-id="4" data-question-id="2">-->
<!--                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>-->
<!--                                                    <div>-->
<!--                                                        First Answer Title-->
<!--                                                    </div>-->
<!--                                                    <div class="ml-auto">-->
<!--                                                        <input type="radio" name="question[correct_answer_id]" id="correct_answer_4" checked>-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                                <li class="list-group-item d-flex" data-position="2" data-answer-id="5" data-question-id="2">-->
<!--                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>-->
<!--                                                    <div>-->
<!--                                                        Second Answer-->
<!--                                                    </div>-->
<!--                                                    <div class="ml-auto">-->
<!--                                                        <input type="radio" name="question[correct_answer_id]" id="correct_answer_5">-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                                <li class="list-group-item d-flex" data-position="3" data-answer-id="6" data-question-id="2">-->
<!--                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>-->
<!--                                                    <div>-->
<!--                                                        Third Answer-->
<!--                                                    </div>-->
<!--                                                    <div class="ml-auto">-->
<!--                                                        <input type="radio" name="question[correct_answer_id]" id="correct_answer_6">-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                        </form>-->
<!--                                    </div>-->
<!---->
<!---->
<!---->
<!--                                    <div class="">-->
<!--                                        <form action="#">-->
<!--                                            <div class="form-group mb-0">-->
<!--                                                <button class="btn btn-success">New Answer</button>-->
<!--                                            </div>-->
<!--                                        </form>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!---->
<!--                            <div class="card mb-4" data-position="1" data-question-id="1">-->
<!--                                <div class="card-header d-flex justify-content-between">-->
<!--                                    <div class="d-flex align-items-center ">-->
<!---->
<!--                                        <span class="question_handle btn btn-sm btn-secondary">-->
<!--                                            <i class="material-icons">menu</i>-->
<!--                                        </span>-->
<!--                                        <div class="h4 m-0 ml-4">Q: Can you deploy to production?</div>-->
<!--                                    </div>-->
<!--                                    <div>-->
<!--                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="card-body">-->
<!---->
<!---->
<!---->
<!--                                    <div id="answerWrapper_3" class="mb-4">-->
<!--                                        <div class="row mb-1">-->
<!--                                            <div class="col"><strong></strong></div>-->
<!--                                            <div class="col text-right"><strong>Correct</strong></div>-->
<!--                                        </div>-->
<!---->
<!--                                        <form action="#">-->
<!--                                            <ul class="list-group" id="answer_container_3">-->
<!--                                                <li class="list-group-item d-flex" data-position="1" data-answer-id="7" data-question-id="3">-->
<!--                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>-->
<!--                                                    <div>-->
<!--                                                        First Answer Title-->
<!--                                                    </div>-->
<!--                                                    <div class="ml-auto">-->
<!--                                                        <input type="radio" name="question[correct_answer_id]" id="correct_answer_7" checked>-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                                <li class="list-group-item d-flex" data-position="2" data-answer-id="8" data-question-id="3">-->
<!--                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>-->
<!--                                                    <div>-->
<!--                                                        Second Answer-->
<!--                                                    </div>-->
<!--                                                    <div class="ml-auto">-->
<!--                                                        <input type="radio" name="question[correct_answer_id]" id="correct_answer_8">-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                                <li class="list-group-item d-flex" data-position="3" data-answer-id="9" data-question-id="3">-->
<!--                                                    <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>-->
<!--                                                    <div>-->
<!--                                                        Third Answer-->
<!--                                                    </div>-->
<!--                                                    <div class="ml-auto">-->
<!--                                                        <input type="radio" name="question[correct_answer_id]" id="correct_answer_9">-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                        </form>-->
<!--                                    </div>-->
<!---->
<!---->
<!--                                    <div class="">-->
<!--                                        <form action="#">-->
<!--                                            <div class="form-group mb-0">-->
<!--                                                <button class="btn btn-success">New Answer</button>-->
<!--                                            </div>-->
<!--                                        </form>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->


                        </div>
                    </div>


                </div>
                <!-- // END drawer-layout__content -->

                <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
                    <div class="mdk-drawer__content">
                        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>

                            <?php require "sidebar_block.php" ?>
                            <div class="sidebar-block p-0">
                                <?php require "sidebar_menu.php" ?>
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
      'default': 'instructor-create-quiz.html',
      'fixed': 'fixed-instructor-create-quiz.html',
      'fluid': 'fluid-instructor-create-quiz.html',
      'mini': 'mini-instructor-create-quiz.html'
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


    <!-- Dragula -->
    <script src="assets/vendor/dragula/dragula.min.js"></script>
    <script src="assets/js/dragula.js"></script>




    <script>
        drake = dragula([document.getElementById('questions_wrapper')], {
            moves: function(el, container, handle) {
                return handle.classList.contains('question_handle') || handle.parentNode.classList.contains('question_handle');
            }
        });
        drake.on('drop', function(el, target, source, sibling) {
            console.log($(el).data('position'));
            // $.ajax({
            //   method: "POST",
            //   url: '/admin/courses/[course_id]/questions/sort',
            //   data: {
            //     el: $(el).data('position'),
            //     sibling: $(sibling).data('position')
            //   }
            // })
            // .done(function( msg ) {
            //   console.log('works');
            // });
        });

        var containers = [
            document.getElementById('answer_container_1'),
            document.getElementById('answer_container_2'),
            document.getElementById('answer_container_3')
        ]
        var drake_answers = dragula(containers);
        drake_answers.on('drop', function(el, target, source, sibling) {

            // $.ajax({
            //   method: "POST",
            //   url: '/admin/courses/[course_id]]/questions/answers/sort',
            //   data: {
            //     el: $(el).data('position'),
            //     sibling: $(sibling).data('position'),
            //     question_id: $(el).data('question-id')
            //   }
            // })
            // .done(function( msg ) {
            //   // update/flush position after success

            // });
        });
    </script>

</body>


<!-- Mirrored from lema.frontted.com/instructor-create-quiz.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:55 GMT -->
</html>
