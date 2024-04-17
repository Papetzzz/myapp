<?php
session_start();
$serverName = "DESKTOP-94I5S6B\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"CpE_Transactions");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

function countSubmission($conn) {
    $sql = "SELECT t.TransactionID FROM Transactions_table t
            JOIN TransactionMode_table tm ON t.TransactionModeID = tm.TransactionModeID
            JOIN Status_Table s ON t.StatusID = s.StatusID
            WHERE s.Code = 'N' AND t.ProfessorID = ? AND tm.Code = ?";
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
    $sub_count = $row_count;
    // Free the statement
    sqlsrv_free_stmt($stmt);
    return $sub_count;
}

function countConsultation($conn) {
    $sql = "SELECT t.TransactionID FROM Transactions_table t
            JOIN TransactionMode_table tm ON t.TransactionModeID = tm.TransactionModeID
            JOIN Status_Table s ON t.StatusID = s.StatusID
            WHERE s.Code = 'N' AND t.ProfessorID = ? AND tm.Code = ?";
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
    return $row_count;
    // Free the statement
    sqlsrv_free_stmt($stmt);
}

function countRecords($conn) {
    // Perform any necessary operations to count records
    // For example, querying a database
    $countConsult = countConsultation($conn); // Replace with actual count of consultations
    $countSubmit = countSubmission($conn); // Replace with actual count of submissions

    // Return the counts as an associative array
    return array(
        'countconsult' => $countConsult,
        'countsubmit' => $countSubmit
    );
}

// Check if the request is an AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Call the function and return the result as JSON
    echo json_encode(countRecords($conn));
} else {
    // Handle non-AJAX requests (optional)
    echo 'This endpoint is only accessible via AJAX.';
}

?>