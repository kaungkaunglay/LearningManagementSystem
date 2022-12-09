<?php
require_once "../Details.php";
session_start();
if(isset($_POST['submit'])){
    $update_name = htmlentities(trim($_POST['StudentName']));
    $update_email = htmlentities(trim($_POST['Email']));
    $update_description = htmlentities(trim($_POST['Description']));
    $update_columns = [
            "StudentName" => $update_name,
            "StudentEmail"=> $update_email,
            "Description" => $update_description
    ];
    $condition = [
            "StudentID" => $_SESSION['StudentID']
    ];
   CRUD::Update("Student", $update_columns,$condition);
   if(isset($_POST['OldPassword']) && isset($_POST['ConfirmPassword']) && isset($_POST['NewPassword'])){
        $old_password = hash("sha256",htmlentities(trim($_POST['OldPassword'])));
        $cols_array = array("StudentPassword");
        $raw = CRUD::Select("Student",$cols_array,$condition);
        $student_password = $raw[0]["StudentPassword"];
        if($old_password != $student_password){
               $_SESSION['message'] = "Incorrect password";
        }else{
            if($_POST['NewPassword'] != $_POST['ConfirmPassword']){
                $_SESSION['message'] = "New Password and Confirm password must be same";
            }else{
                $new_password = hash("sha256",htmlentities(trim($_POST['ConfirmPassword'])));
                $update_columns = [
                    "StudentPassword" => $new_password
                ];
                CRUD::Update("Student",$update_columns,$condition);
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
            <div class="mdk-header__content">

     <?php
     require_once "navbar_expand.php";

     ?>

            </div>
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






                    <form class="container-fluid page__container" method="post" action="student-edit-account.php">
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
                                                <input id="lname" name="StudentName" type="text" class="form-control" placeholder="Last name" value="<?php echo $student_name?>">
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


                          <?php require_once "sidebar-head.php" ?>
                            <?php require_once "sidebar.php" ?>
                                <!--

  
  <div class="sidebar-heading">Layouts</div>
  <ul class="sidebar-menu mt-0 mb-4">

      <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" href="fixed-student-edit-account.html">
          <span class="sidebar-menu-icon sidebar-menu-icon--left">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M5.5,9.251h2c0.552,0,1,0.448,1,1v1c0,0.552-0.448,1-1,1h-2c-0.552,0-1-0.448-1-1v-1C4.5,9.699,4.948,9.251,5.5,9.251z M5.5,14.251h2c0.552,0,1,0.448,1,1v1c0,0.552-0.448,1-1,1h-2c-0.552,0-1-0.448-1-1v-1C4.5,14.699,4.948,14.251,5.5,14.251z M11,11.5h8.5c0.414,0,0.75-0.336,0.75-0.75S19.914,10,19.5,10H11c-0.414,0-0.75,0.336-0.75,0.75S10.586,11.5,11,11.5z M11,16.5 h8.5c0.414,0,0.75-0.336,0.75-0.75S19.914,15,19.5,15H11c-0.414,0-0.75,0.336-0.75,0.75S10.586,16.5,11,16.5z M24,4.751 c0-1.657-1.343-3-3-3H3c-1.657,0-3,1.343-3,3v14.5c0,1.657,1.343,3,3,3h18c1.657,0,3-1.343,3-3V4.751z M9.654,3.751 c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38c0.096,0.149,0.149,0.322,0.154,0.5 c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38 C9.558,4.602,9.505,4.429,9.5,4.251C9.505,4.073,9.558,3.9,9.654,3.751z M6.154,3.751c0.258-0.467,0.845-0.637,1.312-0.38 c0.16,0.088,0.292,0.22,0.38,0.38C7.942,3.9,7.995,4.073,8,4.251c-0.005,0.178-0.058,0.351-0.154,0.5 c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38C6.058,4.602,6.005,4.429,6,4.251 C6.005,4.073,6.058,3.9,6.154,3.751z M2.592,3.842C2.752,3.484,3.108,3.253,3.5,3.251c0.351,0.004,0.674,0.194,0.846,0.5 C4.442,3.9,4.495,4.073,4.5,4.251c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38 c-0.16-0.088-0.292-0.22-0.38-0.38C2.558,4.602,2.505,4.429,2.5,4.251C2.501,4.11,2.532,3.97,2.592,3.842z M22,19.251 c0,0.552-0.448,1-1,1H3c-0.552,0-1-0.448-1-1V7c0-0.138,0.112-0.25,0.25-0.25h19.5C21.888,6.75,22,6.862,22,7V19.251z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
          </span>
          <span class="sidebar-menu-text">Fixed</span>
        </a>
      </li>
      <li class="sidebar-menu-item active">
        <a class="sidebar-menu-button" href="index.html">
          <span class="sidebar-menu-icon sidebar-menu-icon--left">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M24,4.75c0-1.657-1.343-3-3-3H3c-1.657,0-3,1.343-3,3v14.5c0,1.657,1.343,3,3,3h18c1.657,0,3-1.343,3-3V4.75z M21.75,6.75 C21.888,6.75,22,6.862,22,7v5.5c0,0.138-0.112,0.25-0.25,0.25h-12c-0.138,0-0.25-0.112-0.25-0.25V7c0-0.138,0.112-0.25,0.25-0.25 H21.75z M9.65,3.75c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38c0.096,0.149,0.149,0.322,0.154,0.5 c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38C9.87,5.042,9.738,4.91,9.65,4.75 c-0.096-0.149-0.149-0.322-0.154-0.5c0.006-0.178,0.06-0.351,0.158-0.5H9.65z M6.15,3.75c0.258-0.467,0.845-0.637,1.312-0.38 c0.16,0.088,0.292,0.22,0.38,0.38C7.94,3.899,7.994,4.072,8,4.25c-0.005,0.178-0.058,0.351-0.154,0.5 C7.588,5.217,7.001,5.387,6.534,5.13c-0.16-0.088-0.292-0.22-0.38-0.38C6.058,4.601,6.005,4.428,6,4.25 c0.005-0.178,0.058-0.351,0.154-0.5H6.15z M2.588,3.842C2.749,3.482,3.106,3.25,3.5,3.25c0.351,0.004,0.673,0.195,0.846,0.5 C4.442,3.899,4.495,4.072,4.5,4.25c-0.005,0.178-0.058,0.351-0.154,0.5C4.088,5.217,3.501,5.387,3.034,5.13 c-0.16-0.088-0.292-0.22-0.38-0.38C2.558,4.601,2.505,4.428,2.5,4.25c0.001-0.141,0.032-0.28,0.092-0.408H2.588z M8,20 c0,0.138-0.112,0.25-0.25,0.25H3c-0.552,0-1-0.448-1-1V7c0-0.138,0.112-0.25,0.25-0.25h5.5C7.888,6.75,8,6.862,8,7V20z M22,19.25 c0,0.552-0.448,1-1,1H9.75c-0.138,0-0.25-0.112-0.25-0.25v-5.5c0-0.138,0.112-0.25,0.25-0.25h12c0.138,0,0.25,0.112,0.25,0.25 V19.25z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
          </span>
          <span class="sidebar-menu-text">Admin</span>
        </a>
      </li>
      <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" href="fluid-student-edit-account.html">
          <span class="sidebar-menu-icon sidebar-menu-icon--left">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M5,9.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5H5c-0.276,0-0.5-0.224-0.5-0.5v-2 C4.5,9.975,4.724,9.751,5,9.751z M5,14.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5H5c-0.276,0-0.5-0.224-0.5-0.5 v-2C4.5,14.975,4.724,14.751,5,14.751z M11,9.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5h-2 c-0.276,0-0.5-0.224-0.5-0.5v-2C10.5,9.975,10.724,9.751,11,9.751z M11,14.751h2c0.276,0,0.5,0.224,0.5,0.5v2 c0,0.276-0.224,0.5-0.5,0.5h-2c-0.276,0-0.5-0.224-0.5-0.5v-2C10.5,14.975,10.724,14.751,11,14.751z M17,9.751h2 c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5h-2c-0.276,0-0.5-0.224-0.5-0.5v-2C16.5,9.975,16.724,9.751,17,9.751z M17,14.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5h-2c-0.276,0-0.5-0.224-0.5-0.5v-2 C16.5,14.975,16.724,14.751,17,14.751z M24,4.751c0-1.657-1.343-3-3-3H3c-1.657,0-3,1.343-3,3v14.5c0,1.657,1.343,3,3,3h18 c1.657,0,3-1.343,3-3V4.751z M9.654,3.751c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38 c0.096,0.149,0.149,0.322,0.154,0.5c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38 c-0.16-0.088-0.292-0.22-0.38-0.38C9.558,4.602,9.505,4.429,9.5,4.251C9.505,4.073,9.558,3.9,9.654,3.751z M6.154,3.751 c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38C7.942,3.9,7.995,4.073,8,4.251 c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38 C6.058,4.602,6.005,4.429,6,4.251C6.005,4.073,6.058,3.9,6.154,3.751z M2.592,3.842C2.752,3.484,3.108,3.253,3.5,3.251 c0.351,0.004,0.674,0.194,0.846,0.5C4.442,3.9,4.495,4.073,4.5,4.251c-0.005,0.178-0.058,0.351-0.154,0.5 c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38C2.558,4.602,2.505,4.429,2.5,4.251 C2.501,4.11,2.532,3.97,2.592,3.842z M22,19.251c0,0.552-0.448,1-1,1H3c-0.552,0-1-0.448-1-1V7c0-0.138,0.112-0.25,0.25-0.25h19.5 C21.888,6.75,22,6.862,22,7V19.251z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
          </span>
          <span class="sidebar-menu-text">Fluid</span>
        </a>
      </li>
  </ul>
  -->
                                <!--
  <div class="sidebar-heading">Administrator</div>

  
  <ul class="sidebar-menu mt-0">

    <li class="sidebar-menu-item">
      <a class="sidebar-menu-button" href="series.html">
        <span class="sidebar-menu-icon sidebar-menu-icon--left">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M12,0c-0.552,0-1,0.448-1,1v0.31c-0.001,0.138-0.112,0.249-0.25,0.249H2.026c-0.828,0-1.5,0.672-1.5,1.5c0,0,0,0,0,0 v13.959c0,0.828,0.672,1.5,1.5,1.5h8.727c0.138,0,0.249,0.111,0.25,0.249v1.1c-0.001,0.08-0.04,0.154-0.105,0.2L7.93,22.191 c-0.426,0.351-0.487,0.982-0.136,1.408c0.317,0.385,0.869,0.477,1.295,0.216l2.766-1.976c0.086-0.063,0.204-0.063,0.29,0 l2.766,1.976c0.471,0.289,1.087,0.141,1.375-0.329c0.261-0.425,0.168-0.977-0.216-1.295l-2.97-2.12 c-0.065-0.046-0.104-0.12-0.105-0.2v-1.1c0.001-0.138,0.112-0.249,0.25-0.249h8.727c0.828,0,1.5-0.672,1.5-1.5V3.055 c0-0.828-0.672-1.5-1.5-1.5h-8.725C13.112,1.553,13.003,1.445,13,1.31V1C13,0.448,12.552,0,12,0z M14.306,8.7l1.969,1.968 c0.096,0.097,0.252,0.098,0.349,0.003c0.001-0.001,0.002-0.002,0.003-0.003l2.9-2.9c0.361-0.418,0.993-0.463,1.411-0.102 s0.463,0.993,0.102,1.411c-0.032,0.037-0.066,0.071-0.102,0.102l-3.072,3.072c-0.78,0.775-2.04,0.775-2.82,0l-1.969-1.97 c-0.097-0.097-0.255-0.097-0.352,0L10.105,12.9c-0.373,0.376-0.881,0.586-1.411,0.585l0,0c-0.53,0.002-1.038-0.209-1.411-0.585 l-1-1c-0.098-0.097-0.255-0.097-0.353,0l-0.864,0.863c-0.419,0.359-1.051,0.31-1.41-0.109c-0.321-0.374-0.321-0.927,0-1.301 l1.04-1.04c0.79-0.753,2.031-0.753,2.821,0l1,1c0.098,0.097,0.255,0.097,0.353,0L11.486,8.7C12.265,7.921,13.527,7.921,14.306,8.7 C14.306,8.7,14.306,8.7,14.306,8.7z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
        </span>
        <span class="sidebar-menu-text">Dashboard</span>
      </a>
    </li>

    <li class="sidebar-menu-item">
      <a class="sidebar-menu-button" href="courses.html">
        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
        <span class="sidebar-menu-text">Review Courses</span>
      </a>
    </li>


    <li class="sidebar-menu-item">
      <a class="sidebar-menu-button" href="course.html">
        <span class="sidebar-menu-icon sidebar-menu-icon--left">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M12,0C5.373,0,0,5.373,0,12s5.373,12,12,12s12-5.373,12-12C23.993,5.376,18.624,0.007,12,0z M21.428,8.666 c0.046,0.13-0.021,0.273-0.151,0.319C21.25,8.995,21.221,9,21.193,9h-3.856c-0.087,0-0.168-0.046-0.214-0.12 c-0.499-0.815-1.185-1.501-2-2C15.047,6.834,15,6.753,15,6.664V2.808c0-0.139,0.113-0.251,0.252-0.25 c0.028,0,0.056,0.005,0.082,0.014C18.178,3.585,20.415,5.823,21.428,8.666L21.428,8.666z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4 s4,1.791,4,4S14.209,16,12,16z M8.666,2.572c0.131-0.046,0.274,0.023,0.32,0.154C8.995,2.752,9,2.78,9,2.808v3.856 c0,0.087-0.045,0.168-0.12,0.214c-0.815,0.499-1.501,1.185-2,2C6.834,8.954,6.752,9,6.663,9H2.807C2.726,9.002,2.649,8.965,2.6,8.9 C2.553,8.834,2.541,8.748,2.569,8.672C3.581,5.826,5.82,3.586,8.666,2.572z M2.572,15.334c-0.047-0.129,0.02-0.272,0.149-0.319 C2.749,15.005,2.778,15,2.807,15h3.856c0.087,0,0.168,0.045,0.214,0.12c0.499,0.815,1.185,1.501,2,2 c0.074,0.046,0.12,0.127,0.12,0.214v3.856c0,0.138-0.112,0.25-0.25,0.25c-0.028,0-0.057-0.005-0.084-0.015 C5.821,20.412,3.585,18.176,2.572,15.334z M15.334,21.429c-0.13,0.046-0.273-0.021-0.319-0.151C15.005,21.251,15,21.222,15,21.194 v-3.856c0-0.087,0.045-0.168,0.12-0.214c0.815-0.499,1.501-1.185,2-2c0.046-0.075,0.127-0.12,0.214-0.12h3.856 c0.08,0.001,0.154,0.041,0.2,0.106c0.047,0.066,0.059,0.151,0.031,0.227C20.409,18.178,18.174,20.414,15.334,21.429z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
        </span>
        <span class="sidebar-menu-text">Support</span>
      </a>
    </li>

    <li class="sidebar-menu-item">
      <a class="sidebar-menu-button" href="quizzes.html">
        <span class="sidebar-menu-icon sidebar-menu-icon--left">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M13,17.5c0-3.59-2.91-6.5-6.5-6.5S0,13.91,0,17.5S2.91,24,6.5,24C10.088,23.996,12.996,21.088,13,17.5z M4.109,18.312 c-0.172-0.216-0.137-0.53,0.079-0.703C4.276,17.538,4.387,17.5,4.5,17.5h0.876c0.067-0.001,0.122-0.054,0.124-0.121V14.5 c0-0.552,0.448-1,1-1s1,0.448,1,1v2.875c0.001,0.068,0.056,0.124,0.124,0.125H8.5C8.776,17.5,9,17.724,9,18 c0,0.113-0.038,0.224-0.109,0.312l-2,2.5c-0.187,0.216-0.513,0.24-0.729,0.053c-0.019-0.016-0.036-0.034-0.053-0.053L4.109,18.312z M15,5.5h1c0.276,0,0.5,0.224,0.5,0.5v7c0,0.276-0.224,0.5-0.5,0.5h-1c-0.276,0-0.5-0.224-0.5-0.5V6C14.5,5.724,14.724,5.5,15,5.5z M18.5,7.5h1C19.776,7.5,20,7.724,20,8v5c0,0.276-0.224,0.5-0.5,0.5h-1c-0.276,0-0.5-0.224-0.5-0.5V8C18,7.724,18.224,7.5,18.5,7.5 z M21,0.586C20.625,0.211,20.116,0,19.585,0H8C6.895,0,6,0.895,6,2v7.275c-0.002,0.136,0.106,0.247,0.242,0.25 C6.608,9.532,7.28,9.559,7.727,9.607c0.134,0.015,0.256-0.081,0.271-0.215C8,9.381,8,9.37,8,9.359V2.5C8,2.224,8.224,2,8.5,2 h10.879c0.132,0,0.259,0.053,0.353,0.146l2.122,2.122C21.947,4.362,22,4.489,22,4.621V18c0,0.276-0.224,0.5-0.5,0.5h-6.859 c-0.121,0.001-0.223,0.09-0.24,0.21c-0.075,0.496-0.197,0.985-0.364,1.458c-0.048,0.126,0.015,0.267,0.141,0.315 c0.028,0.011,0.057,0.016,0.087,0.016H22c1.105,0,2-0.895,2-2V4.414c0-0.53-0.211-1.039-0.586-1.414L21,0.586z M12.565,12.3 c0.094,0.102,0.253,0.108,0.355,0.013C12.971,12.265,13,12.198,13,12.128V10.5c0-0.276-0.224-0.5-0.5-0.5h-1 c-0.276,0-0.5,0.224-0.5,0.5v0.229c0.002,0.111,0.061,0.213,0.156,0.271C11.676,11.375,12.149,11.812,12.565,12.3z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
        </span>
        <span class="sidebar-menu-text">Reports</span>
      </a>
    </li>


    <li class="sidebar-menu-item">
      <a class="sidebar-menu-button" href="courses.html">
        <span class="sidebar-menu-icon sidebar-menu-icon--left">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M22.5,9.5h-1.862c-0.185-0.64-0.441-1.257-0.762-1.84l1.316-1.316c0.586-0.586,0.586-1.535,0.001-2.121 c0,0,0,0-0.001-0.001l-1.415-1.413c-0.586-0.586-1.535-0.586-2.121,0l-1.317,1.317C15.756,3.804,15.14,3.548,14.5,3.363V1.5 C14.5,0.672,13.828,0,13,0h-2c-0.828,0-1.5,0.672-1.5,1.5v1.863C8.861,3.548,8.244,3.804,7.661,4.126L6.343,2.809 c-0.586-0.586-1.535-0.586-2.121,0L2.807,4.223C2.221,4.809,2.221,5.758,2.806,6.344c0,0,0,0,0.001,0.001l1.317,1.317 C3.802,8.245,3.547,8.861,3.361,9.5H1.5C0.672,9.5,0,10.172,0,11v2c0,0.828,0.672,1.5,1.5,1.5h1.861 c0.185,0.639,0.441,1.256,0.763,1.839l-1.317,1.319c-0.586,0.586-0.586,1.535,0,2.121l1.415,1.414c0.595,0.563,1.526,0.563,2.121,0 l1.316-1.317C8.242,20.198,8.86,20.454,9.5,20.64v1.86c0,0.828,0.672,1.5,1.5,1.5h2c0.828,0,1.5-0.672,1.5-1.5v-1.86 c0.639-0.185,1.256-0.441,1.839-0.763l1.318,1.317c0.586,0.586,1.535,0.586,2.121,0l1.414-1.414c0.586-0.586,0.586-1.535,0-2.121 l-1.316-1.317c0.321-0.583,0.577-1.201,0.763-1.84H22.5c0.828,0,1.5-0.672,1.5-1.5c0-0.001,0-0.001,0-0.002v-2 C24,10.172,23.328,9.5,22.5,9.5z M12,18c-3.314,0-6-2.686-6-6s2.686-6,6-6s6,2.686,6,6S15.314,18,12,18z M15.293,11.582 l-4.521-2.937c-0.153-0.1-0.349-0.108-0.51-0.021C10.1,8.711,10,8.88,10,9.064V15c0,0.184,0.101,0.354,0.264,0.441 c0.162,0.085,0.358,0.076,0.512-0.024l4.521-3c0.231-0.152,0.295-0.462,0.144-0.692c-0.038-0.057-0.086-0.106-0.144-0.144 L15.293,11.582z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
        </span>
        <span class="sidebar-menu-text">App Settings</span>
      </a>
    </li>

  </ul>
  -->
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