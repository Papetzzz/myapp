<?php

session_start();
if (!(isset($_SESSION['UserID']) && isset($_SESSION['UserName']))) {
    header('../Location: LoginPage.php');
    exit();
}
$IsAdmin = $_SESSION['IsAdmin'];
$RegType = $_SESSION['RegType'];

function countSubmission($conn) {
    $sql = "SELECT t.TransactionID FROM Transactions_table t
            JOIN TransactionMode_table tm ON t.TransactionModeID = tm.TransactionModeID
            JOIN Status_Table s ON t.StatusID = s.StatusID
            WHERE s.Code = 'N' AND t.UserID = ? AND tm.Code = ?";
    $params = array($_SESSION['UserID'], "S"); // Assuming "C" is the transaction mode code for submission
    $stmt = sqlsrv_query($conn, $sql, $params);   

    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Initialize row count
    $row_count = 0;

    // Fetch results and count rows
    while (sqlsrv_fetch($stmt) !== false) {
        $row_count++;
    }
    echo $row_count;
    // Free the statement
    sqlsrv_free_stmt($stmt);
}
function countConsultation($conn) {
    $sql = "SELECT t.TransactionID FROM Transactions_table t
            JOIN TransactionMode_table tm ON t.TransactionModeID = tm.TransactionModeID
            JOIN Status_Table s ON t.StatusID = s.StatusID
            WHERE s.Code = 'N' AND t.UserID = ? AND tm.Code = ?";
    $params = array($_SESSION['UserID'], "C"); // Assuming "C" is the transaction mode code for submission
    $stmt = sqlsrv_query($conn, $sql, $params);   

    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Initialize row count
    $row_count = 0;
    

    // Fetch results and count rows
    while (sqlsrv_fetch($stmt) !== false) {
        
        $row_count++;
    }
    echo $row_count;
    // Free the statement
    sqlsrv_free_stmt($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CpE Communication System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../myStyles/myCss.css?v=b" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Updated: Jan 29 2024 with Bootstrap v5.3.2
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->

    <style>
        /* Custom CSS */
        .pointer {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="Home_Admin.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="">
                <span style="font-size: 20px" class="d-none d-lg-block">CpE Communication</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>--><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <!--<li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>--><!-- End Search Icon-->

                <!-- <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon 

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items 

                </li><!-- End Notification Nav 

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon 

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="../assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="../assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="../assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items 

                </li>End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <i class="fs-3 bi bi-person-circle"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['UserName']; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $_SESSION['UserName']; ?></h6>
                            <span>Admin</span>
                        </li>
                        
                        
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="mailto:delarocamarckjoseph16@gmail.com">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" id="logoutButton">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <div id="sidebarST" style="display: none;" >
                <li class="nav-item">
                    <a class="nav-link collapsed" href="../Home.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="../DocumentForm.php">
                                <i class="bi bi-circle"></i><span> Document Submission Form</span>
                            </a>
                        </li>
                        <li>
                            <a href="../ConsultationForm.php">
                                <i class="bi bi-circle"></i><span>Consultation Form</span>
                            </a>
                        </li>
                        
                    </ul>
                </li><!-- End Forms Nav -->
            </div>

            <div id="sidebarPR" style="display: none;">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="../Professor/Home_Professor.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-text"></i><span>Lists</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="../Professor/DocumentList.php">
                                <i class="bi bi-circle"></i><span> Document Submission List</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Professor/ConsultationList.php">
                                <i class="bi bi-circle"></i><span>Consultation Form List</span>
                            </a>
                        </li>

                    </ul>
                </li><!-- End Forms Nav -->
            </div>

            <li class="nav-item" id="adminItem" style="display: none">
                <a class="nav-link collapsed" data-bs-target="#admin-nav" data-bs-toggle="collapse" >
                    <i class="bi bi-shield-lock"></i><span>Admin Page</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="admin-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="Home_Admin.php">
                            <i class="bi bi-circle"></i><span>All Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="AllRequests.php">
                            <i class="bi bi-circle"></i><span>All Requests</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
        </ul>

    </aside><!-- End Sidebar-->

    <div>
        <main id="main" class="main pb-3">
            <div class="row">
                <div class="col-md-10">
                    <div class="pagetitle">
                        <h1>Manage Users</h1>
                        <nav>
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item">Activate / Edit / Delete Users</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary mb-3" onclick="saveChanges()">Save Changes</button>
                </div>
            </div>
            
            <section class="section dashboard">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body py-2">
                                <div class="row py-2">
                                    <div class="col-md-4">
                                        <h5 class="card-title py-1">Search For Users</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="search-bar pb-1">
                                        <form class="search-form d-flex align-items-center"  onsubmit="return false;">
                                            <input type="text" name="query" placeholder="Search" title="Enter search keyword" id="searchUser">
                                            <button type="submit" onclick="updateTable()" title="Search"><i class="bi bi-search"></i></button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="divAlertPart">
                    </div>
                    <div class="col-md-6">
                        <div class="card pointer info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" id="documentsFilter">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">Yesterday</a></li>
                                    <li><a class="dropdown-item" href="#">This Week</a></li>
                                </ul>
                            </div>

                            <div class="card-body"style="min-height:171px">
                                <h5 class="card-title"><i class="bi bi-mortarboard  fs-2 me-1"></i>Professors</h5>

                                

                                <!-- <div class="row">
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-2">1</div>
                                            <div class="col-10">$FirstName $LastName</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-2 d-block d-sm-none"></div>
                                            <div class="col-3 col-sm-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                                </div>
                                            </div>
                                            <div class="col-3 col-sm-4"><a href="#">Edit</a></div>
                                            <div class="col-4 col-sm-5"><a href="#">Delete</a></div>
                                        </div>
                                    </div>
                                </div> -->

                                <table class="table table-bordered border-primary text-center">
                                        <!-- <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Activate</th>
                                                <th scope="col">Admin</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead> -->

                                        <tbody id="tbodyProfTable">
                                            <!-- <tr class="$table_color">
                                                <th rowspan="4">1</th>
                                                <th colspan="3">Name</th>
                                                <td colspan="3">$FirstName $LastName</td>
                                            </tr>
                                            <tr  class="$table_color">
                                                <th colspan="3">Id Number</th>
                                                <td colspan="3">$IDNumber</td>
                                            </tr>
                                            <tr class="$table_color">
                                                <td colspan="3">
                                                    <div class="row">
                                                        <b class="col">Active: </b>
                                                        <div class="col form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchActiveTransactNum">
                                                        </div>  
                                                    </div>
                                                </td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <b class="col">Admin: </b>
                                                        <div class="col form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchAdminTransactNum">
                                                        </div>  
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="$table_color">
                                                <td colspan="2">Reset</td>
                                                <td colspan="2">Edit</td>
                                                <td colspan="2">Delete</td>
                                            </tr> -->
                                        </tbody>
                                    </table>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card pointer info-card sales-card">
                        

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">Yesterday</a></li>
                                    <li><a class="dropdown-item" href="#">This Week</a></li>
                                </ul>
                            </div>

                            <div class="card-body"style="min-height:171px; ">
                                <h5 class="card-title"><i class="bi bi-people fs-2 me-1"></i>Students</h5>
                                <table class="table table-bordered border-primary text-center">
                                        <!-- <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Activate</th>
                                                <th scope="col">Admin</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead> -->

                                        <tbody id="tbodyStudentTable">
                                            <!-- <tr class="$table_color">
                                                <th rowspan="4">1</th>
                                                <th colspan="3">Name</th>
                                                <td colspan="3">$FirstName $LastName</td>
                                            </tr>
                                            <tr  class="$table_color">
                                                <th colspan="3">Id Number</th>
                                                <td colspan="3">$IDNumber</td>
                                            </tr>
                                            <tr class="$table_color">
                                                <td colspan="3">
                                                    <div class="row">
                                                        <b class="col">Active: </b>
                                                        <div class="col form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchActiveTransactNum">
                                                        </div>  
                                                    </div>
                                                </td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <b class="col">Admin: </b>
                                                        <div class="col form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchAdminTransactNum">
                                                        </div>  
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="$table_color">
                                                <td colspan="2">Reset</td>
                                                <td colspan="2">Edit</td>
                                                <td colspan="2">Delete</td>
                                            </tr> -->
                                        </tbody>
                                    </table>

                            
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div style="display:none;" >
        
        <table class="table table-bordered border-primary">
            <!-- <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Activate</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead> -->

            <tbody id="tbodyAdminTableTemplate" style="vertical-align: center;">
                <tr class="table_color" style="border-top-width: thick">
                    <th rowspan="4">Number</th>
                    <th colspan="3">Name</th>
                    <td colspan="3" id="UserNameTransactNum">$FirstName $LastName</td>
                </tr>
                <tr  class="table_color">
                    <th colspan="3">Id Number</th>
                    <td colspan="3" id="UserIdNumberTransactNum">$IDNumber</td>
                </tr>
                <tr class="table_color">
                    <td colspan="3">
                        <div class="row">
                            <b class="col">Active: </b>
                            <div class="col form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchActiveTransactNum" disabled>
                            </div>  
                        </div>
                    </td>
                    <td colspan="3">
                        <div class="row">
                            <b class="col">Admin: </b>
                            <div class="col form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchAdminTransactNum" disabled>
                            </div>  
                        </div>
                    </td>
                </tr>
                <tr class="table_color">
                    <td colspan="2"><a href="#" onclick="ResetPass(TransactNum)">Reset Pass</a></td>
                    <td colspan="2"><a href="#" onclick="EditUser(event,TransactNum)">Edit</a></td>
                    <td colspan="2"><a href="#" onclick="DeleteUser(TransactNum)">Delete</a></td>
                </tr>
            </tbody>
        </table>
        <div id="alertTemplateSuccess">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Message
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        $( "#searchUser" ).on( "keyup", function() {
            updateTable()
        } );
        function updateTable() {
        // Alert is useful for debugging, but remove it in the final version
        var query = $('#searchUser').val();
            $.ajax({
                url: 'load_users.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    query: query
                },
                success: function(response) {
                    $('#tbodyProfTable').empty()
                    $('#tbodyStudentTable').empty()
                    // console.log(response);
                    // Handle response data if needed
                    if (response.length > 0) {
                        var countPR = 0;
                        var countST = 0;
                        $.each(response, function(i, field) {
                            var table_color='';
            
                            var table = $('#tbodyAdminTableTemplate').html()
                            table = table.replace('$FirstName $LastName',field.Name)
                            table = table.replace('$IDNumber',field.IDNumber)
                            table = table.replace(/TransactNum/g,field.UserID)
                            if (field.Code == 'PR'){
                                countPR++;
                                if (countPR%2 == 0){
                                    table_color='table-active';
                                }
                                table = table.replace(/table_color/g,table_color)
                                table = table.replace('Number',countPR)
                                $('#tbodyProfTable').append(table)
                            }
                            else if (field.Code == 'ST'){
                                countST++;
                                if (countST%2 == 0){
                                    table_color='table-active';
                                }
                                table = table.replace(/table_color/g,table_color)
                                table = table.replace('Number',countST)
                                $('#tbodyStudentTable').append(table)
                            }
                            if (field.IsActive == 1){
                                $('#flexSwitchActive'+field.UserID).attr('checked',true)
                            } else {
                                $('#flexSwitchActive'+field.UserID).removeAttr('checked')
                            }
                            if (field.IsAdmin == 1){
                                $('#flexSwitchAdmin'+field.UserID).attr('checked',true)
                            } else {
                                $('#flexSwitchAdmin'+field.UserID).removeAttr('checked')
                            }
                            

                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error(status);
                    console.error(error);
                    console.error('Failed to update status');
                }
            });
        }
        var edited_user = [];
        function EditUser(event,TransactNum){
            event.preventDefault();
            if (!(edited_user.includes(TransactNum))){
                edited_user.push(TransactNum);
                var user_name = $('#UserName'+TransactNum).html()
                $('#UserName'+TransactNum).html('<input type="text" class="form-control" value="'+user_name+'">').trigger( "focusin" )
                $('#UserName'+TransactNum).trigger( "focusin" )
                var user_idnum = $('#UserIdNumber'+TransactNum).html()
                $('#UserIdNumber'+TransactNum).html('<input type="text" class="form-control" value="'+user_idnum+'">')
                // $('#UserIdNumber'+TransactNum).trigger( "focusin" )
                $('#flexSwitchActive'+TransactNum).prop('disabled',false)
                $('#flexSwitchAdmin'+TransactNum).prop('disabled',false)
            }
        }
        function DeleteUser(TransactNum){
            $.ajax({
                url: 'delete_user.php',
                type:'POST',
                dataType: 'json',
                data:{
                    userId: TransactNum
                },
                success: function(response){
                    console.log(response);
                    if (response.success == true){
                        updateTable();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error(status);
                    console.error(error);
                    console.error('Failed to update status');
                }
            })
        }
        updateTable()

        function saveChanges(){
            $.each(edited_user, function(i,TransactNum){
                var user_name = $('#UserName'+TransactNum+' input').val()
                var user_idnum = $('#UserIdNumber'+TransactNum+' input').val()
                var is_active = $('#flexSwitchActive'+TransactNum).is(':checked')
                var is_admin = $('#flexSwitchAdmin'+TransactNum).is(':checked');
                $.ajax({
                    url: 'save_edits.php',
                    type: 'GET',
                    dataType: 'text',
                    data: {
                        Name: user_name,
                        IdNumber: user_idnum,
                        UserId: TransactNum,
                        Active: is_active,
                        Admin: is_admin
                    },
                    success: function(response) {
                        if (response == "Success"){
                            $('#UserName'+TransactNum).html(user_name)
                            $('#UserIdNumber'+TransactNum).html(user_idnum)
                            $('#flexSwitchActive'+TransactNum).prop('disabled',true)
                            $('#flexSwitchAdmin'+TransactNum).prop('disabled',true)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        console.error(status);
                        console.error(error);
                        console.error('Failed to update records');
                    }
                })
            })
            
        }
    </script>
    
    
    <script>
        function ResetPass(UserID){
                $.ajax({
                    url: 'ResetPass.php',
                    type: 'GET',
                    dataType: 'text',
                    data: {
                       
                        UserId: UserID,
            
                    },
                    success: function(response) {
                        if (response == "Success"){
                            var a = $('#alertTemplateSuccess').html()
                            a = a.replace('Message','Password is reset.')
                            $('#divAlertPart').append(a);
                            $('html, body').animate({
                                scrollTop: $('#divAlertPart').offset().top - 100
                            }, 'slow');
                            setTimeout(function(){
                                $('#divAlertPart').empty()
                            },10000)

                        }
                    },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error(status);
                    console.error(error);
                    console.error('Failed to Reset Password');
                }
                })
            }
    

        $(function() {
            $('#logoutButton').click(function() {
                $.ajax({
                    url: '../logout.php',
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Optional: Redirect the user to another page after logout
                            window.location.href = '../LoginPage.php';
                        } else {
                            // Handle errors
                            console.error('Logout failed');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });


    </script>
    <?php
        if ($IsAdmin == 1){
            echo '<script>';
            echo '$(function() {';
            echo '$("#adminItem").show();';
            echo '});';
            echo '</script>';
        }
        echo '<script>';
        echo '$(function() {';
        echo '$("#sidebar'.$RegType.'").show();';
        echo '});';
        echo '</script>';
    ?>
</body>
</html>
