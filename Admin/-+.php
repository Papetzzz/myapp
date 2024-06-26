<?php
session_start();

if (!(isset($_SESSION['UserID']) && isset($_SESSION['UserName']))) {
    header('Location: LoginPage.php');
    exit();
}
// Ensure TransactionId parameter is provided
if(isset($_GET['TransactionId'])) {
    $userName = $_SESSION['UserName'];
    $transactionId = $_GET['TransactionId'];

    // Fetch transaction details from the database based on the provided TransactionId
    // Replace this code with your actual database query
    $serverName = "DESKTOP-94I5S6B\SQLEXPRESS";
    $connectionInfo = array("Database" => "CpE_Transactions");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        // Handle connection failure
        die(print_r(sqlsrv_errors(), true));
    }

    $query = "  SELECT * from Transactions_table t
    join Users_table u on t.UserID = u.UserID WHERE TransactionID = ?";
    $params = array($transactionId);
    $result = sqlsrv_query($conn, $query, $params);

    if ($result === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch transaction details
    $transaction = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

    // Close the database connection
    sqlsrv_close($conn);
}
else {
    // Redirect or display an error message if TransactionId parameter is not provided
    header("Location: error.php");
    exit();
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
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- My Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- =======================================================
    * Template Name: NiceAdmin
    * Updated: Jan 29 2024 with Bootstrap v5.3.2
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="Home.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
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

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

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

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

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
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
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
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
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
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
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

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <i class="fs-3 bi bi-person-circle"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $userName?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $userName?></h6>
                            <!-- <span>Web Designer</span> -->
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

            <li class="nav-item">
                <a class="nav-link collapsed" href="Home.php">
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
                        <a href="DocumentForm.php">
                            <i class="bi bi-circle"></i><span>Document Submission Form</span>
                        </a>
                    </li>
                    <li>
                        <a href="ConsultationForm.php">
                            <i class="bi bi-circle"></i><span>Consultation Form</span>
                        </a>
                    </li>
                    
                </ul>
            </li><!-- End Forms Nav -->
            <li class="nav-item" id="adminItem" style="display: none">
                <a class="nav-link collapsed" data-bs-target="#admin-nav" data-bs-toggle="collapse" >
                    <i class="bi bi-shield-lock"></i><span>Admin Page</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="admin-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="Admin/Home_Admin.php">
                            <i class="bi bi-circle"></i><span>All Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="Admin/AllRequests.php">
                            <i class="bi bi-circle"></i><span>All Requests</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
         

        </ul>

    </aside><!-- End Sidebar-->

    
        <main role="main" id="main" class="main pb-3">
            <section class="section dashboard">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title text-center">Document Submission Receipt</h1>
                                    <div id="divDFormReceiptAlerts">Successfull Submitted Document</div><!--action="DFormButton.php" method="post" --> 
                                
                                        <div class="mb-3">
                                            <label for="name" class="form-label"><b>Name:</b><?php echo $userName?></label>
                                            
                                        </div>

                                        <div class="row mb-3">
                                            <div class= "col-sm-4">
                                                <label for="yearSelect" class="form-label">Year Level:</label>
                                                <select class="form-select" aria-label="Default select example" id="yearSelect"name="yearSelect">
                                                    <option selected="">Select year</option>
                                                    <?php
                                                    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // serverName\instanceName
                                                    $connectionInfo = array("Database" => "CpE_Transactions");
                                                    $conn = sqlsrv_connect($serverName, $connectionInfo);

                                                    if ($conn === false) {
                                                        // Handle connection failure
                                                        die(print_r(sqlsrv_errors(), true));
                                                    }

                                                    $search = "SELECT DISTINCT Year FROM Section_table;";
                                                    $result = sqlsrv_query($conn, $search);

                                                    if ($result === false) {
                                                        // Handle query execution error
                                                        die(print_r(sqlsrv_errors(), true));
                                                    }

                                                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['Year'] . "'>" . $row['Year'] . "</option>";
                                                    }
                                                    sqlsrv_free_stmt($result);
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-8">
                                                <label for="name" class="form-label">Section:</label>
                                                <select class="form-select" aria-label="Default select example" id="sectionSelect" name="sectionSelect">
                                                    <option selected="">Select section</option>
                                                </select>
                                            </div>
                                            <script>
                                                document.getElementById('yearSelect').addEventListener('change', function() {
                                                    var year = this.value;
                                                    fetchSections(year);
                                                });

                                                function fetchSections(year) {
                                                    // AJAX call to fetch sections based on the selected year
                                                    var xhr = new XMLHttpRequest();
                                                    xhr.onreadystatechange = function() {
                                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                                            if (xhr.status === 200) {
                                                                // Success
                                                                var sections = JSON.parse(xhr.responseText);
                                                                console.log(sections)
                                                                populateSections(sections);
                                                            } else {
                                                                // Error
                                                                console.error('Failed to fetch sections');
                                                            }
                                                        }
                                                    };
                                                    xhr.open('GET', 'fetch_sections.php?year=' + year, true);
                                                    xhr.send();
                                                }

                                                function populateSections(sections) {
                                                    var sectionSelect = document.getElementById('sectionSelect');
                                                    sectionSelect.innerHTML = '<option selected="" value=0>Select section</option>';
                                                    sections.forEach(function(section) {
                                                        var option = document.createElement('option');
                                                        option.value = section.sectionID; // Set the value to sectionID
                                                        option.textContent = section.sectionCode; // Display sectionCode and section
                                                        sectionSelect.appendChild(option);
                                                    });
                                                }
                                            </script>
                                            <?php
                                                $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; //serverName\instanceName
                                                $connectionInfo = array("Database" => "CpE_Transactions");
                                                $conn = sqlsrv_connect($serverName, $connectionInfo);

                                                if ($conn === false) {
                                                    // Handle connection failure
                                                    die(print_r(sqlsrv_errors(), true));
                                                }
                                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["year"])) {
                                                    // Retrieve selected year from the form
                                                    $selectedYear = $_POST["yearSelect"];
                                                    
                                                    // Call your PHP function here with the selected year
                                                    getSection($selectedYear);
                                                }
                                                function getSection($year){
                                                    
                                                    // Prepare the SQL statement with parameterized query
                                                    $search = "SELECT SectionID, SectionCode FROM Section_table WHERE Year = ?";
                                                    $params = array($year);
                                                    $result = sqlsrv_query($conn, $search, $params);

                                                    if ($result === false) {
                                                        // Handle query execution error
                                                        die(print_r(sqlsrv_errors(), true));
                                                    }
                                                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                        echo "<option value=".$row['SectionID'].">".$row['SectionCode']."</option>";
                                                    }
                                                    sqlsrv_free_stmt($result);
                                                }

                                                // Close the database connection
                                                sqlsrv_close($conn);
                                            ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="section" class="form-label">Document Type:</label>
                                            <select class="form-select" aria-label="Default select example" id="documentType" name="documentType">
                                                <option selected="">Select Document Type</option>
                                                <?php
                                                    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // serverName\instanceName
                                                    $connectionInfo = array("Database" => "CpE_Transactions");
                                                    $conn = sqlsrv_connect($serverName, $connectionInfo);

                                                    if ($conn === false) {
                                                        // Handle connection failure
                                                        die(print_r(sqlsrv_errors(), true));
                                                    }

                                                    $search = "SELECT DocumentTypeId,Type FROM DocumentType_Table";
                                                    $result = sqlsrv_query($conn, $search);

                                                    if ($result === false) {
                                                        // Handle query execution error
                                                        die(print_r(sqlsrv_errors(), true));
                                                    }

                                                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['DocumentTypeId'] . "'>" . $row['Type'] . "</option>";
                                                    }
                                                    sqlsrv_free_stmt($result);
                                                ?>
                                                
                                            </select>
                                            <div class="invalid-feedback">
                                                        Please Fill your Document Type.
                                                </div>

                                        </div>

                                        <div class="mb-3">
                                            <label for="purpose" class="form-label">Purpose of Submission:</label>
                                            <textarea class="form-control" id="purpose" name="purpose" rows="4"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pro" class="form-label">Professor's Name:</label>
                                            <?php
                                                try {
                                                    // $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; //serverName\instanceName
                                                    // $connectionInfo = array("Database" => "CpE_Transactions");
                                                    // $conn = sqlsrv_connect($serverName, $connectionInfo);
                                                    include('../config/db_connect.php');

                                                    if ($conn === false) {
                                                        // Handle connection failure
                                                        die(print_r(sqlsrv_errors(), true));
                                                    }

                                                    // Perform SQL query
                                                    $search = "SELECT * FROM Users_table WHERE RegistrationTypeID = 2 ORDER BY Name";
                                                    $result = sqlsrv_query($conn, $search);

                                                    if ($result === false) {
                                                        // Handle query execution error
                                                        die(print_r(sqlsrv_errors(), true));
                                                    }

                                                    // Start select box
                                                    echo '<select class="form-select mb-3" aria-label="Default select example" name="professorId" id="professorId">';
                                                    
                                                    // Fetch and display results
                                                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                        // Output option for each row
                                                        echo '<option value="' . $row['UserID'] . '">' . $row['Name'] . '</option>';
                                                    }
                                                    
                                                    // Close select box
                                                    echo '</select>';

                                                    // Free result memory
                                                    sqlsrv_free_stmt($result);

                                                } catch (Exception $e) {
                                                    // Handle other types of exceptions
                                                    die("Some problem getting data from database: " . $e->getMessage());
                                                }

                                                // Close the PHP tag
                                                ?>
                                        </div>
                                        <button  class="btn btn-primary w-100" id="dFormSubmitBtn">Submit</button><!--type="submit"-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <?php
        if ($IsAdmin == 1){
            echo '<script>';
            echo '$(function() {';
            echo '$("#adminItem").show();';
            echo '});';
            echo '</script>';
        }
    ?>

    </body>
</html>