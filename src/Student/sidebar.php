<?php
require_once "../GETPageName.php";
function Check($name){
    $url_name  = GETPageName::GETPageName();
    if($url_name == $name){
        echo "active";
    }
}

?>

<div class="sidebar-block p-0">
    <!--


<div class="sidebar-heading">Layouts</div>
<ul class="sidebar-menu mt-0 mb-4">

<li class="sidebar-menu-item">
<a class="sidebar-menu-button" href="fixed-student-dashboard.php">
<span class="sidebar-menu-icon sidebar-menu-icon--left">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M5.5,9.251h2c0.552,0,1,0.448,1,1v1c0,0.552-0.448,1-1,1h-2c-0.552,0-1-0.448-1-1v-1C4.5,9.699,4.948,9.251,5.5,9.251z M5.5,14.251h2c0.552,0,1,0.448,1,1v1c0,0.552-0.448,1-1,1h-2c-0.552,0-1-0.448-1-1v-1C4.5,14.699,4.948,14.251,5.5,14.251z M11,11.5h8.5c0.414,0,0.75-0.336,0.75-0.75S19.914,10,19.5,10H11c-0.414,0-0.75,0.336-0.75,0.75S10.586,11.5,11,11.5z M11,16.5 h8.5c0.414,0,0.75-0.336,0.75-0.75S19.914,15,19.5,15H11c-0.414,0-0.75,0.336-0.75,0.75S10.586,16.5,11,16.5z M24,4.751 c0-1.657-1.343-3-3-3H3c-1.657,0-3,1.343-3,3v14.5c0,1.657,1.343,3,3,3h18c1.657,0,3-1.343,3-3V4.751z M9.654,3.751 c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38c0.096,0.149,0.149,0.322,0.154,0.5 c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38 C9.558,4.602,9.505,4.429,9.5,4.251C9.505,4.073,9.558,3.9,9.654,3.751z M6.154,3.751c0.258-0.467,0.845-0.637,1.312-0.38 c0.16,0.088,0.292,0.22,0.38,0.38C7.942,3.9,7.995,4.073,8,4.251c-0.005,0.178-0.058,0.351-0.154,0.5 c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38C6.058,4.602,6.005,4.429,6,4.251 C6.005,4.073,6.058,3.9,6.154,3.751z M2.592,3.842C2.752,3.484,3.108,3.253,3.5,3.251c0.351,0.004,0.674,0.194,0.846,0.5 C4.442,3.9,4.495,4.073,4.5,4.251c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38 c-0.16-0.088-0.292-0.22-0.38-0.38C2.558,4.602,2.505,4.429,2.5,4.251C2.501,4.11,2.532,3.97,2.592,3.842z M22,19.251 c0,0.552-0.448,1-1,1H3c-0.552,0-1-0.448-1-1V7c0-0.138,0.112-0.25,0.25-0.25h19.5C21.888,6.75,22,6.862,22,7V19.251z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
</span>
<span class="sidebar-menu-text">Fixed</span>
</a>
</li>
<li class="sidebar-menu-item active">
<a class="sidebar-menu-button" href="index.php">
<span class="sidebar-menu-icon sidebar-menu-icon--left">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M24,4.75c0-1.657-1.343-3-3-3H3c-1.657,0-3,1.343-3,3v14.5c0,1.657,1.343,3,3,3h18c1.657,0,3-1.343,3-3V4.75z M21.75,6.75 C21.888,6.75,22,6.862,22,7v5.5c0,0.138-0.112,0.25-0.25,0.25h-12c-0.138,0-0.25-0.112-0.25-0.25V7c0-0.138,0.112-0.25,0.25-0.25 H21.75z M9.65,3.75c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38c0.096,0.149,0.149,0.322,0.154,0.5 c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38C9.87,5.042,9.738,4.91,9.65,4.75 c-0.096-0.149-0.149-0.322-0.154-0.5c0.006-0.178,0.06-0.351,0.158-0.5H9.65z M6.15,3.75c0.258-0.467,0.845-0.637,1.312-0.38 c0.16,0.088,0.292,0.22,0.38,0.38C7.94,3.899,7.994,4.072,8,4.25c-0.005,0.178-0.058,0.351-0.154,0.5 C7.588,5.217,7.001,5.387,6.534,5.13c-0.16-0.088-0.292-0.22-0.38-0.38C6.058,4.601,6.005,4.428,6,4.25 c0.005-0.178,0.058-0.351,0.154-0.5H6.15z M2.588,3.842C2.749,3.482,3.106,3.25,3.5,3.25c0.351,0.004,0.673,0.195,0.846,0.5 C4.442,3.899,4.495,4.072,4.5,4.25c-0.005,0.178-0.058,0.351-0.154,0.5C4.088,5.217,3.501,5.387,3.034,5.13 c-0.16-0.088-0.292-0.22-0.38-0.38C2.558,4.601,2.505,4.428,2.5,4.25c0.001-0.141,0.032-0.28,0.092-0.408H2.588z M8,20 c0,0.138-0.112,0.25-0.25,0.25H3c-0.552,0-1-0.448-1-1V7c0-0.138,0.112-0.25,0.25-0.25h5.5C7.888,6.75,8,6.862,8,7V20z M22,19.25 c0,0.552-0.448,1-1,1H9.75c-0.138,0-0.25-0.112-0.25-0.25v-5.5c0-0.138,0.112-0.25,0.25-0.25h12c0.138,0,0.25,0.112,0.25,0.25 V19.25z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
</span>
<span class="sidebar-menu-text">Admin</span>
</a>
</li>
<li class="sidebar-menu-item">
<a class="sidebar-menu-button" href="fluid-student-dashboard.php">
<span class="sidebar-menu-icon sidebar-menu-icon--left">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M5,9.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5H5c-0.276,0-0.5-0.224-0.5-0.5v-2 C4.5,9.975,4.724,9.751,5,9.751z M5,14.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5H5c-0.276,0-0.5-0.224-0.5-0.5 v-2C4.5,14.975,4.724,14.751,5,14.751z M11,9.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5h-2 c-0.276,0-0.5-0.224-0.5-0.5v-2C10.5,9.975,10.724,9.751,11,9.751z M11,14.751h2c0.276,0,0.5,0.224,0.5,0.5v2 c0,0.276-0.224,0.5-0.5,0.5h-2c-0.276,0-0.5-0.224-0.5-0.5v-2C10.5,14.975,10.724,14.751,11,14.751z M17,9.751h2 c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5h-2c-0.276,0-0.5-0.224-0.5-0.5v-2C16.5,9.975,16.724,9.751,17,9.751z M17,14.751h2c0.276,0,0.5,0.224,0.5,0.5v2c0,0.276-0.224,0.5-0.5,0.5h-2c-0.276,0-0.5-0.224-0.5-0.5v-2 C16.5,14.975,16.724,14.751,17,14.751z M24,4.751c0-1.657-1.343-3-3-3H3c-1.657,0-3,1.343-3,3v14.5c0,1.657,1.343,3,3,3h18 c1.657,0,3-1.343,3-3V4.751z M9.654,3.751c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38 c0.096,0.149,0.149,0.322,0.154,0.5c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38 c-0.16-0.088-0.292-0.22-0.38-0.38C9.558,4.602,9.505,4.429,9.5,4.251C9.505,4.073,9.558,3.9,9.654,3.751z M6.154,3.751 c0.258-0.467,0.845-0.637,1.312-0.38c0.16,0.088,0.292,0.22,0.38,0.38C7.942,3.9,7.995,4.073,8,4.251 c-0.005,0.178-0.058,0.351-0.154,0.5c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38 C6.058,4.602,6.005,4.429,6,4.251C6.005,4.073,6.058,3.9,6.154,3.751z M2.592,3.842C2.752,3.484,3.108,3.253,3.5,3.251 c0.351,0.004,0.674,0.194,0.846,0.5C4.442,3.9,4.495,4.073,4.5,4.251c-0.005,0.178-0.058,0.351-0.154,0.5 c-0.258,0.467-0.845,0.637-1.312,0.38c-0.16-0.088-0.292-0.22-0.38-0.38C2.558,4.602,2.505,4.429,2.5,4.251 C2.501,4.11,2.532,3.97,2.592,3.842z M22,19.251c0,0.552-0.448,1-1,1H3c-0.552,0-1-0.448-1-1V7c0-0.138,0.112-0.25,0.25-0.25h19.5 C21.888,6.75,22,6.862,22,7V19.251z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
</span>
<span class="sidebar-menu-text">Fluid</span>
</a>
</li>
</ul>
-->
    <div class="sidebar-heading">Student</div>


    <ul class="sidebar-menu mt-0">


        <li class="sidebar-menu-item <?php Check("student-dashboard"); ?>">
            <a class="sidebar-menu-button" href="student-dashboard.php">
                                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                        <path d="M7.652,14.05v-0.6C7.65,12.373,6.777,11.501,5.7,11.5H4.5c-0.414,0-0.75,0.336-0.75,0.75v6C3.75,18.664,4.086,19,4.5,19 h1.2c1.077-0.001,1.949-0.873,1.951-1.95v-0.6C7.65,16.117,7.564,15.79,7.4,15.5c-0.089-0.155-0.089-0.345,0-0.5 C7.564,14.71,7.651,14.383,7.652,14.05z M6.152,17.05c-0.017,0.249-0.231,0.437-0.48,0.42c-0.225-0.015-0.405-0.195-0.42-0.42v-0.6 c0.017-0.249,0.231-0.437,0.48-0.42c0.225,0.015,0.405,0.195,0.42,0.42V17.05z M6.152,14.05c-0.017,0.249-0.231,0.437-0.48,0.42 c-0.225-0.015-0.405-0.195-0.42-0.42v-0.6c0.017-0.249,0.231-0.437,0.48-0.42c0.225,0.015,0.405,0.195,0.42,0.42V14.05z M7.652,4.95C7.618,3.873,6.716,3.028,5.64,3.062C4.611,3.095,3.785,3.921,3.752,4.95v4.8c0,0.414,0.336,0.75,0.75,0.75 s0.75-0.336,0.75-0.75v-1.2c-0.017-0.249,0.171-0.463,0.42-0.48c0.249-0.017,0.463,0.171,0.48,0.42c0.001,0.02,0.001,0.04,0,0.06 v1.2c0,0.414,0.336,0.75,0.75,0.75s0.75-0.336,0.75-0.75V4.95z M6.152,6.15c-0.017,0.249-0.231,0.437-0.48,0.42 c-0.225-0.015-0.405-0.195-0.42-0.42v-1.2c0.017-0.249,0.231-0.437,0.48-0.42c0.225,0.015,0.405,0.195,0.42,0.42V6.15z M11.2,4H9.7 C9.286,4,8.95,4.336,8.95,4.75S9.286,5.5,9.7,5.5h1.5c0.414,0,0.75-0.336,0.75-0.75S11.614,4,11.2,4z M11.951,12.75 c0-0.414-0.336-0.75-0.75-0.75c0,0-0.001,0-0.001,0H9.7c-0.414,0-0.75,0.336-0.75,0.75S9.286,13.5,9.7,13.5h1.5 c0.414,0.001,0.75-0.335,0.751-0.749C11.951,12.751,11.951,12.75,11.951,12.75z M8.5,20h-6C2.224,20,2,19.776,2,19.5v-17 C2,2.224,2.224,2,2.5,2h8.672c0.265,0,0.52,0.105,0.707,0.293l2.828,2.828C14.895,5.308,15,5.563,15,5.828V12c0,0.552,0.448,1,1,1 c0.552,0,1-0.448,1-1V5.414c0.001-0.531-0.21-1.04-0.586-1.414L13,0.586C12.624,0.212,12.116,0.001,11.586,0H2C0.895,0,0,0.895,0,2 v18c0,1.105,0.895,2,2,2h6.5c0.552,0,1-0.448,1-1S9.052,20,8.5,20z M23.685,16.61l-6-2.382c-0.119-0.047-0.251-0.047-0.37,0 l-6,2.382c-0.194,0.077-0.319,0.266-0.315,0.475v3.13c0,0.276,0.224,0.5,0.5,0.5s0.5-0.224,0.5-0.5v-2.08 c0-0.138,0.111-0.249,0.248-0.25c0.029,0,0.057,0.005,0.085,0.015l5,1.765c0.108,0.037,0.224,0.037,0.332,0l6-2.118 c0.261-0.091,0.398-0.376,0.307-0.637C23.924,16.773,23.819,16.663,23.685,16.61L23.685,16.61z M20.763,19.829l-2.93,1.034 c-0.215,0.076-0.451,0.076-0.666,0l-2.93-1.034c-0.26-0.092-0.546,0.045-0.638,0.306c-0.019,0.053-0.028,0.11-0.028,0.166v2.145 c0,0.212,0.134,0.401,0.334,0.471l2.574,0.909c0.661,0.232,1.382,0.232,2.043,0l2.573-0.909c0.2-0.07,0.334-0.259,0.334-0.471V20.3 c0-0.276-0.223-0.5-0.5-0.5c-0.057,0-0.113,0.01-0.166,0.028L20.763,19.829z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                <span class="sidebar-menu-text">Dashboard</span>
            </a>
        </li>

        <li class="sidebar-menu-item <?php Check("StudentTest"); ?>">
            <a class="sidebar-menu-button" href="StudentTest.php">
                                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                        <path d="M2.5,16C2.224,16,2,15.776,2,15.5v-11C2,4.224,2.224,4,2.5,4h14.625c0.276,0,0.5,0.224,0.5,0.5V8c0,0.552,0.448,1,1,1 s1-0.448,1-1V4c0-1.105-0.895-2-2-2H2C0.895,2,0,2.895,0,4v12c0,1.105,0.895,2,2,2h5.375c0.138,0,0.25,0.112,0.25,0.25v1.5 c0,0.138-0.112,0.25-0.25,0.25H5c-0.552,0-1,0.448-1,1s0.448,1,1,1h7.625c0.552,0,1-0.448,1-1s-0.448-1-1-1h-2.75 c-0.138,0-0.25-0.112-0.25-0.25v-1.524c0-0.119,0.084-0.221,0.2-0.245c0.541-0.11,0.891-0.638,0.781-1.179 c-0.095-0.466-0.505-0.801-0.981-0.801L2.5,16z M3.47,9.971c-0.303,0.282-0.32,0.757-0.037,1.06c0.282,0.303,0.757,0.32,1.06,0.037 c0.013-0.012,0.025-0.025,0.037-0.037l2-2c0.293-0.292,0.293-0.767,0.001-1.059c0,0-0.001-0.001-0.001-0.001l-2-2 c-0.282-0.303-0.757-0.32-1.06-0.037s-0.32,0.757-0.037,1.06C3.445,7.006,3.457,7.019,3.47,7.031l1.293,1.293 c0.097,0.098,0.097,0.256,0,0.354L3.47,9.971z M7,11.751h2.125c0.414,0,0.75-0.336,0.75-0.75s-0.336-0.75-0.75-0.75H7 c-0.414,0-0.75,0.336-0.75,0.75S6.586,11.751,7,11.751z M18.25,16.5c0,0.276-0.224,0.5-0.5,0.5s-0.5-0.224-0.5-0.5v-5.226 c0-0.174-0.091-0.335-0.239-0.426c-1.282-0.702-2.716-1.08-4.177-1.1c-0.662-0.029-1.223,0.484-1.252,1.146 c-0.001,0.018-0.001,0.036-0.001,0.054v7.279c0,0.646,0.511,1.176,1.156,1.2c1.647-0.011,3.246,0.552,4.523,1.593 c0.14,0.14,0.33,0.219,0.528,0.218c0.198,0.001,0.388-0.076,0.529-0.215c1.277-1.044,2.878-1.61,4.527-1.6 c0.641-0.023,1.15-0.547,1.156-1.188v-7.279c-0.001-0.327-0.134-0.64-0.369-0.867c-0.236-0.231-0.557-0.353-0.886-0.337 c-1.496,0.016-2.963,0.411-4.265,1.148c-0.143,0.092-0.23,0.251-0.23,0.421V16.5z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                <span class="sidebar-menu-text">Tests</span>
            </a>
        </li>
        <li class="sidebar-menu-item <?php Check("StudentAnswer") ?>">
            <a class="sidebar-menu-button" href="StudentAnswer.php">
                                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                        <path d="M11.75,4.5C11.888,4.5,12,4.612,12,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75c0-0.138,0.112-0.25,0.25-0.25h1 c0.138,0,0.25,0.112,0.25,0.25v4.7c0,0.135,0.11,0.245,0.246,0.244c0.018,0,0.036-0.002,0.054-0.006 c0.48-0.108,0.969-0.171,1.46-0.188c0.133-0.002,0.239-0.11,0.24-0.243V4.5c0-1.105-0.895-2-2-2h-1.25C14.112,2.5,14,2.388,14,2.25 V1c0-0.552-0.448-1-1-1s-1,0.448-1,1v1.25c0,0.138-0.112,0.25-0.25,0.25h-1.5C10.112,2.5,10,2.388,10,2.25V1c0-0.552-0.448-1-1-1 S8,0.448,8,1v1.25C8,2.388,7.888,2.5,7.75,2.5h-1.5C6.112,2.5,6,2.388,6,2.25V1c0-0.552-0.448-1-1-1S4,0.448,4,1v1.25 C4,2.388,3.888,2.5,3.75,2.5H2c-1.105,0-2,0.895-2,2v13c0,1.105,0.895,2,2,2h7.453c0.135,0,0.244-0.109,0.245-0.243 c0-0.019-0.002-0.038-0.007-0.057c-0.109-0.48-0.173-0.968-0.191-1.46c-0.002-0.133-0.11-0.239-0.243-0.24H2.25 C2.112,17.5,2,17.388,2,17.25V4.75C2,4.612,2.112,4.5,2.25,4.5h1.5C3.888,4.5,4,4.612,4,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1 V4.75C6,4.612,6.112,4.5,6.25,4.5h1.5C7.888,4.5,8,4.612,8,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75 c0-0.138,0.112-0.25,0.25-0.25H11.75z M17.5,11c-3.59,0-6.5,2.91-6.5,6.5s2.91,6.5,6.5,6.5s6.5-2.91,6.5-6.5 C23.996,13.912,21.088,11.004,17.5,11z M17.5,22.5c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.052,22.5,17.5,22.5z M18.439,18.327c-0.118,0.037-0.196,0.15-0.189,0.273v0.15c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75V18.2 c0.003-0.588,0.413-1.096,0.988-1.222c0.607-0.131,0.993-0.73,0.862-1.338c-0.131-0.607-0.73-0.993-1.338-0.862 c-0.517,0.112-0.887,0.57-0.887,1.099c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75c0-1.45,1.176-2.625,2.626-2.624 c1.45,0,2.625,1.176,2.624,2.626c0,1.087-0.671,2.062-1.686,2.451V18.327z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                <span class="sidebar-menu-text">Answered Test</span>
            </a>
        </li>

        <li class="sidebar-menu-item <?php Check("student-edit-account") ?>">
            <a class="sidebar-menu-button" href="student-edit-account.php">
                                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                        <path d="M16.1,13.071c0.085-0.085,0.097-0.218,0.03-0.317c-0.649-0.959-2.342-1.584-4.633-2.426l-0.628-0.23 c-0.076-0.088-0.124-0.196-0.138-0.311c-0.093-0.431-0.073-0.879,0.058-1.3c1.076-1.166,1.609-2.733,1.466-4.314 C12.257,1.756,10.677,0,8.5,0S4.745,1.756,4.745,4.174C4.603,5.747,5.131,7.308,6.2,8.471C6.343,8.895,6.368,9.35,6.272,9.787 c-0.015,0.114-0.061,0.221-0.134,0.309l-0.631,0.232c-2.448,0.9-4.215,1.55-4.754,2.626C0.269,14.074,0.013,15.28,0,16.5 C0,16.776,0.224,17,0.5,17h11.569c0.066,0,0.13-0.026,0.177-0.073L16.1,13.071z M15.086,22.74c0.044-0.172-0.006-0.354-0.131-0.479 l-2.215-2.215c-0.195-0.195-0.512-0.195-0.707,0c-0.06,0.06-0.104,0.134-0.127,0.216l-0.886,3.1 c-0.076,0.265,0.077,0.542,0.343,0.619C11.407,23.993,11.454,24,11.5,24c0.046,0,0.093-0.006,0.137-0.02l3.1-0.885 C14.908,23.047,15.041,22.912,15.086,22.74z M21.772,16.936c0.195-0.195,0.195-0.512,0-0.707l-3-3 c-0.195-0.195-0.512-0.195-0.707,0l-5.011,5.01c-0.195,0.195-0.195,0.512,0,0.707l3,3c0.195,0.195,0.512,0.195,0.707,0 L21.772,16.936z M19.48,11.813c-0.196,0.195-0.196,0.512-0.001,0.707c0,0,0.001,0.001,0.001,0.001l3,3 c0.105,0.088,0.24,0.132,0.377,0.124c0.142-0.009,0.276-0.069,0.377-0.17c1.022-1.024,1.022-2.683,0-3.707 C22.185,10.744,20.504,10.764,19.48,11.813z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                <span class="sidebar-menu-text">Edit Account</span>
            </a>
        </li>


        <li class="sidebar-menu-item <?php Check("student-profile") ?>">
            <a class="sidebar-menu-button" href="student-profile.php">
                                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="22" height="22">
                                                    <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                        <path d="M11.979,17.125c4.052,0,6.875-5.1,6.875-9.67c-0.001-0.95-0.136-1.895-0.4-2.808l0,0c-0.828-2.841-3.522-4.723-6.475-4.522 C9.029-0.063,6.342,1.818,5.51,4.654v0.009c-0.26,0.911-0.395,1.853-0.4,2.8C5.105,12.035,7.929,17.125,11.979,17.125z M16.617,11.281c-0.048,0.125-0.185,0.19-0.312,0.148c-1.395-0.412-2.846-0.599-4.3-0.554c-1.469-0.045-2.936,0.144-4.346,0.559 c-0.127,0.043-0.265-0.022-0.312-0.147c-0.42-1.088-0.664-2.235-0.722-3.4C6.619,7.818,6.642,7.751,6.689,7.7 c0.047-0.049,0.112-0.077,0.18-0.077H17.09c0.138,0,0.25,0.112,0.25,0.25c0,0.004,0,0.008,0,0.012 C17.28,9.048,17.036,10.194,16.617,11.281z M21.632,18.127c0.123,0.065,0.274,0.018,0.339-0.105C21.99,17.986,22,17.946,22,17.906 v-1.531c0-0.138,0.112-0.25,0.25-0.25H23c0.414,0,0.75-0.336,0.75-0.75s-0.336-0.75-0.75-0.75h-0.75c-0.138,0-0.25-0.112-0.25-0.25 v-3c0-0.828-0.672-1.5-1.5-1.5s-1.5,0.672-1.5,1.5v3c0,0.138-0.112,0.25-0.25,0.25H18c-0.414,0-0.75,0.336-0.75,0.75 s0.336,0.75,0.75,0.75h0.75c0.138,0,0.25,0.112,0.25,0.25v0.2c0,0.092,0.051,0.177,0.132,0.22L21.632,18.127z M23.033,19.792 c-0.759-0.561-1.581-1.031-2.45-1.4c-0.119-0.052-0.258-0.005-0.32,0.109l-1.181,1.667l-2.367,3.338 c-0.066,0.121-0.022,0.273,0.099,0.339c0.037,0.02,0.078,0.031,0.12,0.031H23.5c0.276,0,0.5-0.224,0.5-0.5V21.77 C24.007,20.995,23.648,20.263,23.033,19.792z M11.079,21.4l-3.527-3.968c-0.117-0.132-0.294-0.193-0.467-0.16 c-2.206,0.358-4.3,1.221-6.118,2.52C0.351,20.262-0.007,20.995,0,21.77v1.605c0,0.276,0.224,0.5,0.5,0.5h7.326 c0.073,0,0.142-0.032,0.19-0.087l3.066-2.06C11.162,21.633,11.161,21.493,11.079,21.4z M18.31,17.837 c-0.029-0.07-0.088-0.123-0.161-0.145c-0.244-0.069-0.5-0.136-0.76-0.2c-0.091-0.022-0.187,0.009-0.249,0.08l-0.633,0.586 l-5.731,5.305c-0.09,0.105-0.078,0.263,0.027,0.353c0.045,0.039,0.103,0.06,0.162,0.06h3.191c0.092,0,0.176-0.05,0.22-0.13 l3.068-4.452l0.855-1.24C18.335,17.987,18.339,17.907,18.31,17.837z M8.489,8.826C8.185,9.108,8.168,9.583,8.45,9.887 c0.282,0.304,0.757,0.321,1.061,0.039l0,0c0.173-0.097,0.384-0.097,0.557,0c0.304,0.282,0.779,0.265,1.061-0.039 c0.282-0.304,0.265-0.779-0.039-1.061C10.339,8.192,9.24,8.192,8.489,8.826z M13.421,10.125c0.19,0.001,0.372-0.071,0.511-0.2 c0.173-0.097,0.384-0.097,0.557,0c0.304,0.282,0.779,0.265,1.061-0.039c0.282-0.304,0.265-0.779-0.039-1.061 c-0.751-0.633-1.849-0.633-2.6,0c-0.304,0.282-0.322,0.756-0.04,1.06C13.013,10.038,13.213,10.125,13.421,10.125L13.421,10.125z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                <span class="sidebar-menu-text">View Profile</span>
            </a>
        </li>
    </ul>

    <!--
<div class="sidebar-heading">Administrator</div>


<ul class="sidebar-menu mt-0">

<li class="sidebar-menu-item">
<a class="sidebar-menu-button" href="series.php">
<span class="sidebar-menu-icon sidebar-menu-icon--left">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M12,0c-0.552,0-1,0.448-1,1v0.31c-0.001,0.138-0.112,0.249-0.25,0.249H2.026c-0.828,0-1.5,0.672-1.5,1.5c0,0,0,0,0,0 v13.959c0,0.828,0.672,1.5,1.5,1.5h8.727c0.138,0,0.249,0.111,0.25,0.249v1.1c-0.001,0.08-0.04,0.154-0.105,0.2L7.93,22.191 c-0.426,0.351-0.487,0.982-0.136,1.408c0.317,0.385,0.869,0.477,1.295,0.216l2.766-1.976c0.086-0.063,0.204-0.063,0.29,0 l2.766,1.976c0.471,0.289,1.087,0.141,1.375-0.329c0.261-0.425,0.168-0.977-0.216-1.295l-2.97-2.12 c-0.065-0.046-0.104-0.12-0.105-0.2v-1.1c0.001-0.138,0.112-0.249,0.25-0.249h8.727c0.828,0,1.5-0.672,1.5-1.5V3.055 c0-0.828-0.672-1.5-1.5-1.5h-8.725C13.112,1.553,13.003,1.445,13,1.31V1C13,0.448,12.552,0,12,0z M14.306,8.7l1.969,1.968 c0.096,0.097,0.252,0.098,0.349,0.003c0.001-0.001,0.002-0.002,0.003-0.003l2.9-2.9c0.361-0.418,0.993-0.463,1.411-0.102 s0.463,0.993,0.102,1.411c-0.032,0.037-0.066,0.071-0.102,0.102l-3.072,3.072c-0.78,0.775-2.04,0.775-2.82,0l-1.969-1.97 c-0.097-0.097-0.255-0.097-0.352,0L10.105,12.9c-0.373,0.376-0.881,0.586-1.411,0.585l0,0c-0.53,0.002-1.038-0.209-1.411-0.585 l-1-1c-0.098-0.097-0.255-0.097-0.353,0l-0.864,0.863c-0.419,0.359-1.051,0.31-1.41-0.109c-0.321-0.374-0.321-0.927,0-1.301 l1.04-1.04c0.79-0.753,2.031-0.753,2.821,0l1,1c0.098,0.097,0.255,0.097,0.353,0L11.486,8.7C12.265,7.921,13.527,7.921,14.306,8.7 C14.306,8.7,14.306,8.7,14.306,8.7z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
</span>
<span class="sidebar-menu-text">Dashboard</span>
</a>
</li>

<li class="sidebar-menu-item">
<a class="sidebar-menu-button" href="courses.php">
<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
<span class="sidebar-menu-text">Review Courses</span>
</a>
</li>


<li class="sidebar-menu-item">
<a class="sidebar-menu-button" href="course.php">
<span class="sidebar-menu-icon sidebar-menu-icon--left">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M12,0C5.373,0,0,5.373,0,12s5.373,12,12,12s12-5.373,12-12C23.993,5.376,18.624,0.007,12,0z M21.428,8.666 c0.046,0.13-0.021,0.273-0.151,0.319C21.25,8.995,21.221,9,21.193,9h-3.856c-0.087,0-0.168-0.046-0.214-0.12 c-0.499-0.815-1.185-1.501-2-2C15.047,6.834,15,6.753,15,6.664V2.808c0-0.139,0.113-0.251,0.252-0.25 c0.028,0,0.056,0.005,0.082,0.014C18.178,3.585,20.415,5.823,21.428,8.666L21.428,8.666z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4 s4,1.791,4,4S14.209,16,12,16z M8.666,2.572c0.131-0.046,0.274,0.023,0.32,0.154C8.995,2.752,9,2.78,9,2.808v3.856 c0,0.087-0.045,0.168-0.12,0.214c-0.815,0.499-1.501,1.185-2,2C6.834,8.954,6.752,9,6.663,9H2.807C2.726,9.002,2.649,8.965,2.6,8.9 C2.553,8.834,2.541,8.748,2.569,8.672C3.581,5.826,5.82,3.586,8.666,2.572z M2.572,15.334c-0.047-0.129,0.02-0.272,0.149-0.319 C2.749,15.005,2.778,15,2.807,15h3.856c0.087,0,0.168,0.045,0.214,0.12c0.499,0.815,1.185,1.501,2,2 c0.074,0.046,0.12,0.127,0.12,0.214v3.856c0,0.138-0.112,0.25-0.25,0.25c-0.028,0-0.057-0.005-0.084-0.015 C5.821,20.412,3.585,18.176,2.572,15.334z M15.334,21.429c-0.13,0.046-0.273-0.021-0.319-0.151C15.005,21.251,15,21.222,15,21.194 v-3.856c0-0.087,0.045-0.168,0.12-0.214c0.815-0.499,1.501-1.185,2-2c0.046-0.075,0.127-0.12,0.214-0.12h3.856 c0.08,0.001,0.154,0.041,0.2,0.106c0.047,0.066,0.059,0.151,0.031,0.227C20.409,18.178,18.174,20.414,15.334,21.429z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
</span>
<span class="sidebar-menu-text">Support</span>
</a>
</li>

<li class="sidebar-menu-item">
<a class="sidebar-menu-button" href="quizzes.php">
<span class="sidebar-menu-icon sidebar-menu-icon--left">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M13,17.5c0-3.59-2.91-6.5-6.5-6.5S0,13.91,0,17.5S2.91,24,6.5,24C10.088,23.996,12.996,21.088,13,17.5z M4.109,18.312 c-0.172-0.216-0.137-0.53,0.079-0.703C4.276,17.538,4.387,17.5,4.5,17.5h0.876c0.067-0.001,0.122-0.054,0.124-0.121V14.5 c0-0.552,0.448-1,1-1s1,0.448,1,1v2.875c0.001,0.068,0.056,0.124,0.124,0.125H8.5C8.776,17.5,9,17.724,9,18 c0,0.113-0.038,0.224-0.109,0.312l-2,2.5c-0.187,0.216-0.513,0.24-0.729,0.053c-0.019-0.016-0.036-0.034-0.053-0.053L4.109,18.312z M15,5.5h1c0.276,0,0.5,0.224,0.5,0.5v7c0,0.276-0.224,0.5-0.5,0.5h-1c-0.276,0-0.5-0.224-0.5-0.5V6C14.5,5.724,14.724,5.5,15,5.5z M18.5,7.5h1C19.776,7.5,20,7.724,20,8v5c0,0.276-0.224,0.5-0.5,0.5h-1c-0.276,0-0.5-0.224-0.5-0.5V8C18,7.724,18.224,7.5,18.5,7.5 z M21,0.586C20.625,0.211,20.116,0,19.585,0H8C6.895,0,6,0.895,6,2v7.275c-0.002,0.136,0.106,0.247,0.242,0.25 C6.608,9.532,7.28,9.559,7.727,9.607c0.134,0.015,0.256-0.081,0.271-0.215C8,9.381,8,9.37,8,9.359V2.5C8,2.224,8.224,2,8.5,2 h10.879c0.132,0,0.259,0.053,0.353,0.146l2.122,2.122C21.947,4.362,22,4.489,22,4.621V18c0,0.276-0.224,0.5-0.5,0.5h-6.859 c-0.121,0.001-0.223,0.09-0.24,0.21c-0.075,0.496-0.197,0.985-0.364,1.458c-0.048,0.126,0.015,0.267,0.141,0.315 c0.028,0.011,0.057,0.016,0.087,0.016H22c1.105,0,2-0.895,2-2V4.414c0-0.53-0.211-1.039-0.586-1.414L21,0.586z M12.565,12.3 c0.094,0.102,0.253,0.108,0.355,0.013C12.971,12.265,13,12.198,13,12.128V10.5c0-0.276-0.224-0.5-0.5-0.5h-1 c-0.276,0-0.5,0.224-0.5,0.5v0.229c0.002,0.111,0.061,0.213,0.156,0.271C11.676,11.375,12.149,11.812,12.565,12.3z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
</span>
<span class="sidebar-menu-text">Reports</span>
</a>
</li>


<li class="sidebar-menu-item">
<a class="sidebar-menu-button" href="courses.php">
<span class="sidebar-menu-icon sidebar-menu-icon--left">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 40 40" width="22" height="22"><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M22.5,9.5h-1.862c-0.185-0.64-0.441-1.257-0.762-1.84l1.316-1.316c0.586-0.586,0.586-1.535,0.001-2.121 c0,0,0,0-0.001-0.001l-1.415-1.413c-0.586-0.586-1.535-0.586-2.121,0l-1.317,1.317C15.756,3.804,15.14,3.548,14.5,3.363V1.5 C14.5,0.672,13.828,0,13,0h-2c-0.828,0-1.5,0.672-1.5,1.5v1.863C8.861,3.548,8.244,3.804,7.661,4.126L6.343,2.809 c-0.586-0.586-1.535-0.586-2.121,0L2.807,4.223C2.221,4.809,2.221,5.758,2.806,6.344c0,0,0,0,0.001,0.001l1.317,1.317 C3.802,8.245,3.547,8.861,3.361,9.5H1.5C0.672,9.5,0,10.172,0,11v2c0,0.828,0.672,1.5,1.5,1.5h1.861 c0.185,0.639,0.441,1.256,0.763,1.839l-1.317,1.319c-0.586,0.586-0.586,1.535,0,2.121l1.415,1.414c0.595,0.563,1.526,0.563,2.121,0 l1.316-1.317C8.242,20.198,8.86,20.454,9.5,20.64v1.86c0,0.828,0.672,1.5,1.5,1.5h2c0.828,0,1.5-0.672,1.5-1.5v-1.86 c0.639-0.185,1.256-0.441,1.839-0.763l1.318,1.317c0.586,0.586,1.535,0.586,2.121,0l1.414-1.414c0.586-0.586,0.586-1.535,0-2.121 l-1.316-1.317c0.321-0.583,0.577-1.201,0.763-1.84H22.5c0.828,0,1.5-0.672,1.5-1.5c0-0.001,0-0.001,0-0.002v-2 C24,10.172,23.328,9.5,22.5,9.5z M12,18c-3.314,0-6-2.686-6-6s2.686-6,6-6s6,2.686,6,6S15.314,18,12,18z M15.293,11.582 l-4.521-2.937c-0.153-0.1-0.349-0.108-0.51-0.021C10.1,8.711,10,8.88,10,9.064V15c0,0.184,0.101,0.354,0.264,0.441 c0.162,0.085,0.358,0.076,0.512-0.024l4.521-3c0.231-0.152,0.295-0.462,0.144-0.692c-0.038-0.057-0.086-0.106-0.144-0.144 L15.293,11.582z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
</span>
<span class="sidebar-menu-text">App Settings</span>
</a>
</li>

</ul>
-->
</div>