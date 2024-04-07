<?php
    session_start();
    // Get the selected ordering and direction from the AJAX request
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'Date';
    $direction = isset($_GET['direction']) ? $_GET['direction'] : 'DESC';
    $dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : null;

    // Define the date ranges based on the selected filter
    switch ($dateFilter) {
        case 'a': // Today
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
            break;
        case 'b': // From 7 days ago to today
            $startDate = date('Y-m-d', strtotime('-7 days'));
            $endDate = date('Y-m-d');
            break;
        case 'c': // From 31 days ago to today
            $startDate = date('Y-m-d', strtotime('-31 days'));
            $endDate = date('Y-m-d');
            break;
        default: // Default to 365 days ago to today
            $startDate = date('Y-m-d', strtotime('-365 days'));
            $endDate = date('Y-m-d');
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
                        d.Type as DocumentName,
                        a.TransactionDate as Date
                    FROM Transactions_table a
                    JOIN Users_table u ON a.UserID = u.UserID
                    JOIN Section_table s ON a.SectionID = s.SectionID
                    JOIN DocumentType_Table d ON a.DocumentTypeId = d.DocumentTypeId 
                    WHERE TransactionModeID = 2 
                        AND a.ProfessorID = ".$_SESSION['UserID']." AND
                        a.TransactionDate BETWEEN '$startDate' AND '$endDate'
                    ORDER BY $orderBy $direction;"; // Dynamically order the results based on $orderBy and $direction

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

            // echo  '<tr onclick="goToDReceipt('.$row['TransactionID'].')">';
            // echo '<th scope="row">'.$counter.'</th>';
            // echo '<td>'.$row['Name'].'</td>';
            // echo '<td>'.$row['Section'].'</td>';
            // echo '<td>'.$row['DocumentName'].'</td>';
            // echo '<td>'.$row['Date']->format('M d, Y h:i a') .'</td>';
        
            // echo '</tr>';
            $table_color='';
            if ($counter%2 == 0){
                $table_color='table-active';
            }
            echo '<tr onclick="goToDReceipt('.$row['TransactionID'].')"  style="border-top-width: thick" class='.$table_color.'>';
            echo '<th rowspan="4">'.$counter.'</th>';
            echo '<th scope="col">Name</th>';
            echo '<td scope="row">'.$row['Name'].'</td>';
            echo '</tr>';
            echo '<tr onclick="goToDReceipt('.$row['TransactionID'].')"  class='.$table_color.'>';
            echo '<th scope="col">Section</th>';
            echo '<td scope="row">'.$row['Section'].'</td>';
            echo '</tr>';
            echo '<tr onclick="goToDReceipt('.$row['TransactionID'].')" class='.$table_color.'>';
            echo '<th scope="col">Document Name</th>';
            echo '<td scope="row">'.$row['DocumentName'].'</td>';
            echo '</tr>';
            echo '<tr onclick="goToDReceipt('.$row['TransactionID'].')" class='.$table_color.'>';
            echo '<th scope="col">Date</th>';
            if ($row['Date'] != null) {
                echo '<td scope="row">'.$row['Date']->format('M d, Y') .'<br>'.$row['Date']->format('h:i a') .'</td>';
            } 
            else {
                echo '<td></td>'; // Or any other message you want to display for null values
            }
            echo '</tr>';
        }
        if ($counter == 0){
            echo '<tr>';
            echo '<th colspan="3" class="text-center text-secondary"><i class="bi bi-info-circle me-1"></i>No records to show. </th>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<th colspan="3" class="text-center text-secondary">---------- Nothing Follows ----------</th>';
            echo '</tr>';
        }
        
        sqlsrv_free_stmt($result);
    } catch (Exception $e) {
            // Handle other types of exceptions
            die("Some problem getting data from database: " . $e->getMessage());
    }
?>