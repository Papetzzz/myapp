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
            <a href="../Professor/Home_Professor.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="">
                <span style="font-size: 20px" class="d-none d-lg-block">CpE Communication</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

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

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
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

         

        </ul>

    </aside><!-- End Sidebar-->


        <main role="main" id="main" class="main pb-3">
            <section class="section dashboard">

            <!-- <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">$row['Section']-$row['Name']</h5>
                    <h6 class="card-subtitle mb-2 text-muted">$row['Purpose']</h6>
                    <p class="card-text">Do you want to accept this consultation?</p>
                    <div class="col-12 text-start mb-3" id="divReason" style="display: none;">
                        <label for="inputReason" class="form-label">Reason:</label>
                        <textarea type="text" class="form-control" id="inputReason" placeholder="Please provide reason for declining"></textarea>
                    </div>
                    <div class="row">
                        <p class="card-text col">
                            <a class="btn btn-primary col-md-2" onclick="acceptRequest()">
                                <i class="bi bi-check-circle me-1"></i>Accept
                            </a>
                            <a class="btn btn-danger  col-md-2" onclick="declineRequest()">
                                <i class="bi bi-x-circle me-1"></i>Decline
                            </a>
                        </p>
                    </div>
                </div>
            </div>

<script>
    function declineRequest() {
        $('#divReason').show('slow')
    }
</script> -->

                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-md-6">
                        <div class="card pointer info-card sales-card" onclick="window.location.href='DocumentList.php'">

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
                                <h5 class="card-title" style="min-height:5rem">Documents Submission List <span id="documentsFilterResult">| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>0</h6>
                                    <!-- @*  <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> *@ -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card pointer info-card sales-card" onclick="window.location.href='ConsultationList.php'">
                        

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

                            <div class="card-body"style="min-height:171px">
                                <h5 class="card-title" style="min-height:5rem">Consultation List <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>0</h6>
                                        <!-- @*  <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> *@ -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    

                </div>
                <div class="row" id="divConsultationCards">
                </div>
                
            </section>
            <div id="divConsultCardsTemplate">
                <div class="col-md-6" id="consultCardTransactNum">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Section_Desc - userName</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><b>Purpose: </b>$Purpose</h6>
                                <h6 class="card-subtitle mb-2 text-muted"><b>Date Requested: </b>requestedDate</h6>
                                
                                <div class="col-12 text-start mb-3" id="divReasonTransactNum" style="display: none;">
                                    <label for="inputReason" class="form-label">Reason:</label>
                                    <textarea type="text" class="form-control" id="inputReason" placeholder="Please provide reason for declining"></textarea>
                                </div>
                                <hr>
                                <div class="row" id="rowAcceptDeclineTransactNum">
                                    <p class="card-text col-md-6 mb-1">Do you want to accept this consultation?</p>
                                    <div class="card-text col me-2">
                                        <button class="btn btn-primary col-sm-5 me-1" onclick="acceptRequest(TransactNum)">
                                            <i class="bi bi-check-circle me-1"></i>Accept
                                        </button>
                                        <button class="btn btn-danger  col-sm-5" onclick="declineRequest(TransactNum)">
                                            <i class="bi bi-x-circle me-1"></i>Decline
                                        </button>
                                    </div>
                                </div>
                                <div id="submitButtonTransactNum" style="display: none;">
                                    <button class="btn btn-primary col-sm-5 me-1" >
                                        <i class="bi bi-check-circle me-1"></i>Submit Response
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </main>


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
        function declineRequest(TransactionID) {
            $('#divReason'+TransactionID).show('slow')
            $('#submitButton'+TransactionID).show('slow')
            $('#rowAcceptDecline'+TransactionID).hide('slow')
            $('#submitButton'+TransactionID).click(function(){
                
            })
        }
    </script>
    <script>
        // Function to update the table based on the selected ordering and direction
        function updateTable(e,dateRange) {
            // Get the selected ordering and direction
            var orderBy = $('#orderByCSelect').val();
            var direction = $('#orderCSelect').val();
            dateRange = dateRange ?? null;
            console.log(dateRange)
            // Perform an AJAX request to fetch the updated data from the server
            // Send the selected ordering and direction to the server
            $.ajax({
                url: 'load_consult_cards.php',
                type: 'GET',
                data: { orderBy: orderBy, 
                    direction: direction,
                    dateFilter: dateRange
                 },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    if (response.length > 0){
                        $.each(response, function(i, field){

                            var card = $('#divConsultCardsTemplate').html();
                            card = card.replace('Section_Desc',field.Section)
                            card = card.replace('userName',field.Name)
                            card = card.replace('$Purpose',field.Purpose)
                            var sqlDateTimeString = field.Date.date
                            var formattedDateTime = new Date(sqlDateTimeString.replace(/-/g, '/')).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: true});
                            card = card.replace('requestedDate',formattedDateTime)
                            card = card.replace(/TransactNum/g,field.TransactionID)
                            $('#divConsultationCards').append(card)

                        })
                    }

                    // Replace the existing table with the updated table
                    // $('#tbodyCTable').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText)
                    console.error(status)
                    console.error(error)
                    console.error('Failed to load consult cards');
                }
            });
        }

        // Call the updateTable function once initially to populate the table
        updateTable();
    </script>
</body>
</html>
