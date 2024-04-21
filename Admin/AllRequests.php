<?php

session_start();
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
            <a href="Home.php" class="logo d-flex align-items-center">
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

                    </ul><!-- End Notification Dropdown Items -->

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

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="mailto:delarocamarckjoseph16@gmail.com">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
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
                        <a href="AllDocuments.php">
                            <i class="bi bi-circle"></i><span>All Requests</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
        </ul>

    </aside><!-- End Sidebar-->

    <div>
        <main id="main" class="main pb-3">
            
            <section class="">
                <div class="row">
                    <div class="col-md-10">
                        <div class="pagetitle">
                            <h1>All Requests</h1>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                        <button type="button" class="btn btn-primary mb-3" onclick="saveChanges()">Save Changes</button>
                    </div> -->
                </div>
                <div class="col-12">
                    <div class="card pointer info-card sales-card">
                        

                        <div class="card-body"style="min-height:171px; ">
                            <h5 class="card-title"><i class="bi bi-funnel fs-2 me-1"></i>Filter by</h5>
                            
                            <div class="row">
                                <div class="col-md-6 row mb-3">
                                    <label class="col-sm-4 col-form-label">Year:</label>
                                    <div class="col-sm-8">
                                        <select class="form-select  mb-2" aria-label="Default select example" id="filterByYear">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 row mb-3">
                                    <label class="col-sm-4 col-form-label">Section:</label>
                                    <div class="col-sm-8">
                                        <select class="form-select  mb-2" aria-label="Default select example" id="filterBySection"  disabled>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 row mb-3">
                                    <label class="col-sm-4 col-form-label">Start Date:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="filterByStart">
                                    </div>
                                </div>
                                <div class="col-md-6 row mb-3">
                                    <label class="col-sm-4 col-form-label">End Date:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="filterByEnd">
                                    </div>
                                </div>
                                <div class="col-md-6 row mb-3">
                                    <label class="col-sm-4 col-form-label">Professor:</label>
                                    <div class="col-sm-8">
                                        <select class="form-select  mb-2" aria-label="Default select example" id="filterByProfessor">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" id="myFilters" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="docFilter-tab" data-bs-toggle="tab" data-bs-target="#docFilterContent" type="button" role="tab" aria-controls="home" aria-selected="true">Documents</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="consultFilter-tab" data-bs-toggle="tab" data-bs-target="#consultFilterContent" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Consultation</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="docFilterContent" role="tabpanel" aria-labelledby="docFilter-tab">
                                <div class="row">    
                                        <div class="col-md-6 row mb-3">
                                            <label class="col-sm-4 col-form-label">Document Name:</label>
                                            <div class="col-sm-8">
                                                <select class="form-select  mb-2" aria-label="Default select example" id="filterByDocName">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input mx-1" type="checkbox" id="docIsReceived">
                                                <label class="form-check-label" for="docIsReceived">
                                                    Is Received
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="consultFilterContent" role="tabpanel" aria-labelledby="consultFilter-tab">
                                    <div class="col-12 row">
                                        
                                        <div class="col-md-6 row mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input mx-1" type="checkbox" id="consultIsApparoved">
                                                <label class="form-check-label" for="consultIsApparoved">
                                                    Is Approved
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="card-title">Suggested Date</h6>
                                        </div>
                                        <div class="col-md-6 row mb-3">
                                            <label class="col-sm-4 col-form-label">From:</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="filterRequestedByStart">
                                            </div>
                                        </div>
                                        <div class="col-md-6 row mb-3">
                                            <label class="col-sm-4 col-form-label">To:</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="filterRequestedByEnd">
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                        

                    </div>
                </div>
                <div class="col-12">
                    <div class="card pointer info-card sales-card">
                        <div class="card-body"style="min-height:171px; ">
                            <h5 class="card-title"><i class="bi bi-envelope-paper fs-2 me-1"></i>Requests</h5>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documentsTabContent" type="button" role="tab" aria-controls="home" aria-selected="true" onclick="fetchRequests('S')">Documents</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="consultation-tab" data-bs-toggle="tab" data-bs-target="#consultationTabContent" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1" onclick="fetchRequests('C')">Consultation</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade active show" id="documentsTabContent" role="tabpanel" aria-labelledby="documents-tab" style="overflow-x:auto;">
                                    <table class="table table-bordered border-primary text-center">
                                        <tbody id="documentRequests">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="consultationTabContent" role="tabpanel" aria-labelledby="consultation-tab" style="overflow-x:auto;">
                                    <table class="table table-bordered border-primary text-center">
                                        <tbody id="consultationRequests">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <div style="display:none;">
        <table class="table table-bordered border-primary text-center">
            <tbody id="documentRequestsTemplate">
                <tr class="table_color" style="border-top-width: thick">
                    <th>Professor: </th>
                    <td>Name_Professor</td>
                </tr>
                <tr class="table_color">
                    <th>Purpose: </th>
                    <td>RequestPurpose</td>
                </tr>
                <tr class="table_color">
                    <th>Document Type: </th>
                    <td>RequestDocType</td>
                </tr>
                <tr class="table_color">
                    <th>Date Submitted: </th>
                    <td>RequestDate</td>
                </tr>
                <tr class="table_color">
                    <th>Received: </th>
                    <td>RequestIsReceived</td>
                </tr>
                
            </tbody>
        </table>
        <table class="table table-bordered border-primary text-center">
            <tbody id="consultationRequestsTemplate">
                <tr class="table_color" style="border-top-width: thick">
                    <th>Professor: </th>
                    <td>Name_Professor</td>
                </tr>
                <tr class="table_color">
                    <th>Purpose: </th>
                    <td>RequestPurpose</td>
                </tr>
                <tr class="table_color">
                    <th>Status: </th>
                    <td>RequestStatus</td>
                </tr>
                <tr class="table_color">
                    <th>Date Submitted: </th>
                    <td>RequestDate</td>
                </tr>
                <tr class="table_color">
                    <th>Date/Time Suggested: </th>
                    <td>RequestDateTime</td>
                </tr>
                <tr class="table_color">
                    <th colspan="2">Remarks: </th>
                </tr>
                <tr class="table_color">
                    <td colspan="2">RequestRemarks </td>
                </tr>
                
            </tbody>
        </table>
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
    
    <script src="../myScripts/adminRequestRecords.js"></script>
    <script>
        $(function() {
            fetchRequests()
            getDataList()
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
</body>
</html>
