<?php

?>
<div class="sidebar-block p-0 m-0">
    <div class="d-flex align-items-center sidebar-p-a border-bottom bg-light">
        <a href="#" class="flex d-flex align-items-center text-body text-underline-0">
                                        <span class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-soft-secondary text-muted">AD</span>
                                        </span>
            <span class="flex d-flex flex-column">
                                            <strong><?php echo $student_name ?></strong>
                                            <small class="text-muted text-uppercase">Student</small>
                                        </span>
        </a>
        <div class="dropdown ml-auto">
            <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_vert</i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="student-dashboard.php">Dashboard</a>
                <a class="dropdown-item" href="student-profile.php">My profile</a>
                <a class="dropdown-item" href="student-edit-account.php">Edit account</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" rel="nofollow" data-method="delete" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>