<?php
require_once "UploadHandler.php" ;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/ui-forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:58 GMT -->
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

                <div class="container-fluid page__heading-container">
                    <div class="page__heading d-flex align-items-center justify-content-between">
                        <h1 class="m-0">Forms</h1>
                    </div>
                </div>
<?php
function GetCourseID($course_name){
    $array = array("CourseID");
    $condition = [
            "CourseName" => $course_name
    ];
   $data =  CRUD::Select("Course",$array,$condition);
    return $data[0]['CourseID'];
}
function GetTestID($test_name){
    $array = array("TestID");
    $condition  = [
            "TestName" => $test_name
    ];
    $data = CRUD::Select("Test",$array, $condition);
    return $data[0]['TestName'];
}
            if(isset($_POST['submit'])){
                  $unique = uniqid();
                 $LabName = htmlentities(trim($_POST['LabName']));
                 $CourseName = htmlentities(trim($_POST['CourseName']));
                 $TestName = htmlentities(trim($_POST['TestName']));

                 $upload = new UploadHandler("file","CoverPhotos");

                 if($upload->GetSize() != 0 ){
                     $upload->Upload(100,"mb","images",$unique);
                     $insert_columns = [
                             "LabID" => "LID".CRUD::Fake_Characters(5),
                             "LabName" => $LabName,
                             "CoverImage" => $upload->GetTargetFile($unique),
                             "CourseID" => GetCourseID($CourseName),
                             "TestID" => GetTestID($TestName),
                             "TeacherID" => $_SESSION['TeacherID']
                     ];
                     CRUD::Insert("Lab",$insert_columns);
                 }else{
                     $_SESSION['message'] = "File must be uploaded";
                 }
            }
?>



                <div class="container-fluid page__container">

                     <form method="post" action="Lab.php" class="card card-form" enctype="multipart/form-data">
                        <div class="row no-gutters">
                            <div class="col-lg-4 card-body">
                                <p><strong class="headings-color">Lab Creation</strong></p>
                                <p class="dz-image"><img style="position: center; width: 200px" src="https://img.icons8.com/fluency/512/classroom.png" alt=""></p>
                            </div>
                            <div class="col-lg-8 card-form__body card-body">
                                <div class="form-group">
                                    <label>Lab Name</label>
                                    <input name="LabName" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Lab Name..">
                                </div>
                                <div class="form-group">
                                    <label for="select01">Choose Course</label>
                                    <select name="CourseName" id="select01" data-toggle="select" class="form-control">
                                        <?php
                                        $col_array = array("CourseName");
                                        $condition = [
                                                "TeacherID" => $_SESSION['TeacherID']
                                        ];
                                        $data = CRUD::Select("Course",$col_array,$condition);
                                        foreach($data as $item){
                                        ?>
                                        <option selected=""><?php echo $item['CourseName']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="select02">Quiz</label>
                                    <select  name="TestName" id="select02" data-toggle="select" data-minimum-results-for-search="-1" class="form-control">
                                        <?php
                                        $cols_arry = array("TestName");
                                        $tests = CRUD::Select("Test",$cols_arry, $condition);
                                        foreach($tests as $test){
                                        ?>
                                        <option><?php echo $test['TestName'];  ?>   </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <script>
                                  $(document).ready(function(){
                                    $('#customFileUploadMultiple').on('change',function(){
                                        var filename = $(this).val();
                                        $(this).next('.custom-file-label').html(filename);
                                    })
                                  })
                                </script>
                                <div class="form-group">
                                    <label for="">Lab Cover Photo</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input name="file" accept="image/*" type="file" class="custom-file-input" id="customFileUploadMultiple">
                                            <label id="file-label" class="custom-file-label" for="customFileUploadMultiple">Choose file</label>
                                        </div>
                                    </div>

                                </div>
                                <script>
                                    var index = 1;
                                    $(document).ready(function(){

                                        $('#add').on('click',function(){
                                            // alert('wewkr');
                                            var foo = document.getElementById("fooBar");
                                            var element = document.createElement("input");
                                            var name = "txtname" + index ;
                                            element.setAttribute("type","text");
                                            element.setAttribute("class","form-control");
                                            element.setAttribute("placeholder","Enter student Email");
                                            element.setAttribute("id", "email");
                                            element.setAttribute("name",name);

                                            var remove = document.createElement("input");
                                            remove.setAttribute("type","button");
                                            remove.setAttribute("id","remove");
                                            remove.setAttribute("class","btn btn-outline-secondary");
                                            remove.setAttribute("value","-");

                                            var input_group = document.createElement("div");
                                            input_group.setAttribute("class","input-group mb-3");
                                            input_group.setAttribute("id","group");

                                            var append = document.createElement("div");
                                            append.setAttribute("class","input-group-append");

                                            foo.appendChild(input_group);
                                            input_group.appendChild(element); //Input Student Email
                                            input_group.appendChild(append);
                                            append.appendChild(remove);
                                            index = index + 1;
                                        })
                                    })
                                </script>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Student Email">
                                        <div class="input-group-append">
                                            <input id="add" class="btn btn-outline-secondary" type="button" value="+">
                                        </div>

                                    </div>
                                    <div id="fooBar" >

                                    </div>

                                </div>
                                <input name="submit" type="submit" value="Submit" class="btn btn-success">
                            </div>
                        </div>
                    </form>

                    <!-- <div class="card card-form">
<div class="row no-gutters">
  <div class="col-lg-4 card-body">
    <p><strong class="headings-color">Basic Information</strong></p>
    <p class="text-muted">Edit your account details and settings.</p>
  </div>
  <div class="col-lg-8 card-form__body card-body">

  </div>
</div>
</div> -->
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
      'default': 'ui-forms.html',
      'fixed': 'fixed-ui-forms.html',
      'fluid': 'fluid-ui-forms.html',
      'mini': 'mini-ui-forms.html'
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


<!-- Flatpickr -->
<script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
<script src="assets/js/flatpickr.js"></script>

<!-- jQuery Mask Plugin -->
<script src="assets/vendor/jquery.mask.min.js"></script>

<!-- Quill -->
<script src="assets/vendor/quill.min.js"></script>
<script src="assets/js/quill.js"></script>

<!-- Dropzone -->
<script src="assets/vendor/dropzone.min.js"></script>
<script src="assets/js/dropzone.js"></script>

<!-- Select2 -->
<script src="assets/vendor/select2/select2.min.js"></script>
<script src="assets/js/select2.js"></script>

</body>


<!-- Mirrored from lema.frontted.com/ui-forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:58 GMT -->
</html>