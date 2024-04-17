<?php
// echo '<script> alert("ala pa naman") </script>';
session_start();

// Get the selected ordering and direction from the AJAX request
$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'DateSubmitted';
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'DESC';
$dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : null;

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
    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // Fill in your server name
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
                a.RequestedDate AS Date,
                a.TransactionDate as DateSubmitted
                FROM Transactions_table a
                join Users_table u on a.UserID = u.UserID
                join Section_table s on a.SectionID = s.SectionID
                join Status_Table st on a.StatusID = st.StatusID
                where TransactionModeID = 1
                    AND a.ProfessorID = ".$_SESSION['UserID'].
                    "AND st.Code = 'N'  AND
                    a.TransactionDate BETWEEN '$startDate' AND '$endDate'
                    ORDER BY $orderBy $direction"; // Dynamically order the results based on $orderBy and $direction

    // Execute the SQL query
    $result = sqlsrv_query($conn, $search);

    if ($result === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    $rows = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $rows[] = $row;
    }
    
    echo json_encode($rows);
    sqlsrv_free_stmt($result);
} catch (Exception $e) {
    // Handle other types of exceptions
    die("Some problem getting data from database: " . $e->getMessage());
}
?>
