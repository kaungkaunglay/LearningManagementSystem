<?php
require_once "../Details.php";
require_once "UploadHandler.php";
$course_name = null;
$array =  array();

// Added Resource
$r_name = null;
$r_description = null;
$r_file = null;

function Display_title($Resource_name){
    if(!is_null($Resource_name)){
        echo $Resource_name;
    }
    echo "";
}
function Display_Description($Resource_Description){
    if(!is_null($Resource_Description)){
        echo $Resource_Description;
    }
    echo "";
}
function Display_Video($Resource_Video){
    if(!is_null($Resource_Video)){
        echo $Resource_Video;
    }else{
        echo "data:image/png;base64,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";
    }
}
$get_columns = array("CourseName");
$condition =
    [
        "CourseID" => $_GET['cid']
    ];
$raw = CRUD::Select("Course",$get_columns,$condition);
$course_name = $raw[0]['CourseName'];
if(isset($_POST['addnew'])){
    header("Location: instructor-lesson-edit.php?cid=".$_GET['cid']);
}
if(isset($_POST['preview'])){
    //Get First Resource
    $columns = array("ResourceID");
    $condition = [
            "CourseID" => $_GET['cid']
    ];
    $data = CRUD::Select("Resource",$columns, $condition,1);
    header("Location: CoursePreview.php?cid=".$_GET['cid']."&rid=".$data[0]['ResourceID']);
}
if(!isset($_GET['cid'])){
    header("Location: instructor-course.php");
}else{
    if(isset($_GET['rid'])){
        $get_columns  = array("ResourceName","Description","ResourceImage");
        $condition = [
                "ResourceID" => $_GET['rid']
        ];
        $raw = CRUD::Select("Resource",$get_columns,$condition);
        $r_name = $raw[0]['ResourceName'];
        $r_description = $raw[0]['Description'];
        $r_file = $raw[0]['ResourceImage'];

        if(isset($_POST['submit'])){
            $resource_name  = htmlentities(trim($_POST['ResourceName']));
            $resource_description = htmlentities(trim($_POST['ResourceDescription']));

            $unique =  uniqid();
            // Check that existing  file has
            $upload_handler = new UploadHandler("FileName","InstructorVideos");
            if($upload_handler->GetSize() != 0){ // New File is uploaded
                $upload_handler->Upload(100,"mb","video",$unique);

                $update_columns = [
                    "ResourceName" => $resource_name,
                    "Description" => $resource_description,
                    "ResourceImage" => $upload_handler->GetTargetFile($unique),
                    "CourseID" => $_GET['cid']
                ];
                $condition = [
                    "ResourceID" => $_GET['rid'],
                    "CourseID" => $_GET['cid']
                ];
                CRUD::Update("Resource",$update_columns,$condition);
                header("Location: instructor-lesson-edit.php?cid=".$_GET['cid']."&rid=".$_GET['rid']);
            }else{
                //Get resource vidoe
                $column = array("ResourceImage");
                $condition = [
                        "CourseID" => $_GET['cid'],
                        "ResourceID"=> $_GET['rid']
                ];
                $raw = CRUD::Select("Resource",$column,$condition);
                $r_file = $raw[0]["ResourceImage"];

                $update_columns = [
                    "ResourceName" => $resource_name,
                    "Description" => $resource_description,
                    "ResourceImage" => $r_file,
                    "CourseID" => $_GET['cid']
                ];
                $condition = [
                    "ResourceID" => $_GET['rid'],
                    "CourseID" => $_GET['cid']
                ];
                CRUD::Update("Resource",$update_columns,$condition);
                header("Location: instructor-lesson-edit.php?cid=".$_GET['cid']."&rid=".$_GET['rid']);
            }


        }
    }else{
        if(isset($_POST['submit'])){
            if($_POST['ResourceName'] == ""){
                $_SESSION['message']  =  "Lesson Title is required";
            }
            else if($_POST['ResourceName'] == ""){
                $_SESSION['message'] =  "Lesson Description is required";
            }else{
                $resource_name = htmlentities(trim($_POST['ResourceName']));
                $resource_description = htmlentities(trim($_POST['ResourceDescription']));

                $unique = uniqid();
                //File Uploading
                $upload_handler = new UploadHandler("FileName","InstructorVideos");
                $upload_handler->Upload(100,"mb","video",$unique);

                $insert_columns = [
                    "ResourceID" => "RID".CRUD::Fake_Characters(5),
                    "ResourceName" => $resource_name,
                    "Description" => $resource_description,
                    "ResourceImage" => $upload_handler->GetTargetFile($unique),
                    "Duration" => $upload_handler->GetDuration(),
                    "CourseID" => $_GET['cid']
                ];
                CRUD::Insert("Resource",$insert_columns);
            }




    }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from lema.frontted.com/instructor-lesson-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:55 GMT -->
<?php require_once "Head.php" ?>

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
                        <div class="page__heading d-flex align-items-center justify-content-between">
                            <?php
                            if(!isset($_GET['rid'])){

                            ?>
                            <h1 class="m-0">Add Course</h1>
                            <?php } else{ ?>
                            <h1 class="m-0">Edit Coure</h1>
                            <?php  }?>
                        </div>
                    </div>
        <?php
        function DisplayResourceID (){
            if(isset($_GET['rid'])){
                echo "&rid=".$_GET['rid'];
            }
        }
        ?>
                    <form class="container-fluid page__container" method="post" action="instructor-lesson-edit.php?cid=<?php  echo $_GET['cid']; DisplayResourceID();?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-form__body card-body">
                                        <div class="form-group">
                                            <label for="category">Course:</label><br />
                                            <select id="category" class="custom-select w-auto">
                                                <option readonly value="usa"><?php echo $course_name ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="fname">Title</label>
                                            <input  name="ResourceName" id="fname" type="text" class="form-control" placeholder="Title of the video name" value="<?php Display_title($r_name);?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <textarea  name="ResourceDescription" id="desc" rows="

                                            4" class="form-control" placeholder="Please enter some description"><?php Display_Description($r_description);?></textarea>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label for="subscribe">Published</label><br>
                                            <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                                <input checked="" type="checkbox" id="subscribe" class="custom-control-input">
                                                <label class="custom-control-label" for="subscribe">Yes</label>
                                            </div>
                                            <label for="subscribe" class="mb-0">Yes</label>
                                        </div>


                                    </div>
                                    <div class="card-body text-center">
                                        <input name="submit" type="submit" class="btn btn-success" value="Save Changes">

                                        <?php
                                        if(isset($_GET['rid'])){
                                        ?>
                                        <button type="submit" name="addnew" class="btn btn-success">Add New Course</button>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <!-- Lessons -->

                                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                                        <h4 class="card-header__title">Lesson Video</h4>
                                    </div>

                                    <div class="card-body">

                                        <div class="embed-responsive embed-responsive-16by9 mb-3">
                                            <iframe class="embed-responsive-item" src="<?php Display_Video($r_file); ?>" allowfullscreen=""></iframe>
                                        </div>
                                        <!-- Lessons -->
                                        <div class="form-group mb-3">
                                            <div class="dz-clickable media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable" data-dropzone-files='["assets/images/account-add-photo.svg"]'>
                                                <div class="dz-preview dz-file-preview dz-clickable mr-3">
                                                    <div class="avatar avatar-lg">
                                                        <img src="assets/images/account-add-photo.svg" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                                                    </div>

                                                <div class="media-body">
                                                    <input name="FileName" type="file" class="dz-button" accept="video/mp4,video/x-m4v,video/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <?php
                                        function Button_Primary($resourceID, $rid){
                                            if($resourceID == $rid){
                                                echo "primary";
                                            }else{
                                                echo "light";
                                            }
                                        }
                                        $cols_arr = array("ResourceID");
                                        $condition = [
                                            "CourseID" => $_GET['cid']
                                        ];
                                        $data = CRUD::Select("Resource",$cols_arr,$condition);
                                        if(!empty($data)){
                                            $i = 1;
                                            foreach($data as $item){
                                                ?>
                                        <div class="btn-group mb-2">
                                            <button onclick="window.location='instructor-lesson-edit.php?cid=<?php echo $_GET['cid']."&rid=".$item['ResourceID']?>'" name="count" type="button" class="btn btn-<?php Button_Primary($item['ResourceID'],  isset($_GET['rid'])?  $_GET['rid']:  "traverl-69" );?>"><?php echo $i ?></button>
                                        </div> <?php if($i % 5 ==0 ){echo "<br>";} ?>
                                        <?php
                                        $i++;
                                        }
                                        } ?>
                                        <div style="float: right;">
                                            <?php
                                                if(!empty($data)){
                                            ?>
                                            <input name="preview" type="submit" class="btn btn-success" value="Preview">
                                            <?php } ?>
                                        </div>
                                </div>
                            </div>
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
      'default': 'instructor-lesson-edit.html',
      'fixed': 'fixed-instructor-lesson-edit.html',
      'fluid': 'fluid-instructor-lesson-edit.html',
      'mini': 'mini-instructor-lesson-edit.html'
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


<!-- Mirrored from lema.frontted.com/instructor-lesson-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Nov 2022 02:45:55 GMT -->
</html>