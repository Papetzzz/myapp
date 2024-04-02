<?php
    session_start();
    // Get the selected ordering and direction from the AJAX request
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'Date';
    $direction = isset($_GET['direction']) ? $_GET['direction'] : 'DESC';
    $dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : null;
    $statusCode = isset($_GET['statusCode']) ? $_GET['statusCode'] : 'N';
    // Define the date ranges based on the selected filter
    switch ($dateFilter) {
        case 'a': // Today
            $startDate = date('Y-m-d 00:00:00');
            $endDate = date('Y-m-d 23:59:59');
            break;
        case 'b': // From 7 days ago to today
            $startDate = date('Y-m-d 00:00:00', strtotime('-7 days'));
            $endDate = date('Y-m-d 23:59:59');
            break;
        case 'c': // From 31 days ago to today
            $startDate = date('Y-m-d 00:00:00', strtotime('-31 days'));
            $endDate = date('Y-m-d 23:59:59');
            break;
        default: // Default to 365 days ago to today
            $startDate = date('Y-m-d 00:00:00', strtotime('-365 days'));
            $endDate = date('Y-m-d 23:59:59');
            break;
    }
    
    try {
        $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; //serverName\instanceName
        $connectionInfo = array("Database" => "CpE_Transactions");
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        
        if ($conn === false) {
            // Handle connection failure
            die(print_r(sqlsrv_errors(), true));
        }
        
        // Modify your SQL query to order the results based on the selected criteria and direction
        $search = "SELECT
            a.TransactionID,
            u.Name,
            s.Description as Section,
            a.Purpose as Purpose,
            a.RequestedDate as Date,
            a.TransactionDate as DateSubmitted
            FROM Transactions_table a
            JOIN Users_table u ON a.UserID = u.UserID
            JOIN Section_table s ON a.SectionID = s.SectionID
            JOIN Status_Table st ON a.StatusID = st.StatusID
            WHERE TransactionModeID = 1
                AND a.ProfessorID = ".$_SESSION['UserID']." 
                AND st.Code = '".$statusCode."' 
                AND a.TransactionDate BETWEEN '$startDate' AND '$endDate'
            ORDER BY $orderBy $direction;"; 
            // Dynamically order the results based on $orderBy and $direction

        // Execute the SQL query and fetch the results as before
        $result = sqlsrv_query($conn, $search);

        if ($result === false) {
            // Handle query execution error
            die(print_r(sqlsrv_errors(), true));
        }

        
        // Fetch and display results
        $counter = 0;
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            // Output option for each row
            $counter++;

            echo  '<tr onclick="goToCReceipt('.$row['TransactionID'].')">';
            echo '<th scope="row">'.$counter.'</th>';
            echo '<td>'.$row['Name'].'</td>';
            echo '<td>'.$row['Section'].'</td>';
            echo '<td>'.$row['Purpose'].'</td>';
            echo '<td>'.$row['Date']->format('M d, Y') .'</td>';
            echo '<td>'.$row['Date']->format('h:i a') .'</td>';
            echo '<td>'.$row['DateSubmitted']->format('M d, Y h:i a') .'</td>';
        
            echo '</tr>';
        }
        if ($counter == 0){
            echo '<tr>';
            echo '<th colspan="7" class="text-center text-secondary"><i class="bi bi-info-circle me-1"></i>No records to show. </th>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<th colspan="7" class="text-center text-secondary">---------- Nothing Follows ----------</th>';
            echo '</tr>';
        }
        
        // echo '<script>';
        // echo "alert('startdate: ".$startDate.", enddate: ".$endDate."')";
        // echo "</script>";
        sqlsrv_free_stmt($result);
    } catch (Exception $e) {
            // Handle other types of exceptions
            die("Some problem getting data from database: " . $e->getMessage());
    }
?>

