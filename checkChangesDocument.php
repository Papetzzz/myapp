<?php
session_start();
// Connect to your database (assuming SQL Server in this example)
$serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // Fill in your server name
$connectionInfo = array("Database" => "CpE_Transactions");
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Check connection
if ($conn === false) {
    die("Connection failed: " . print_r(sqlsrv_errors(), true));
}

$transactionID = $_POST['TransactionId'];
// Query to check for new records
$sql = "SELECT COUNT(*) AS new_records, s.Code 
FROM Transactions_table tr 
JOIN Status_Table s ON tr.StatusID = s.StatusID 
WHERE tr.TransactionID = ".$transactionID." AND  s.Code != 'N' 
GROUP BY s.Code;
";

$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die("Query execution failed: " . print_r(sqlsrv_errors(), true));
}

// Fetch result
$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

// Check if there are new records
if ($row !== null) {
    // Check if there are new records
    if ($row["new_records"] > 0) {
        $response = array("error" => false, "submitted" => true, "message" => "Submitted successfully.", "Code" => $row["Code"]);
        echo json_encode($response);
        // echo "true"; // Send 'true' if there are new records
    } else {
        $response = array("error" => false, "submitted" => false, "message" => "No Changes in Transaction");
        echo json_encode($response);
    }
} else {
    $response = array("error" => false, "submitted" => false, "message" => "No Changes in Transaction");
    echo json_encode($response);
}


// Close the connection
sqlsrv_close($conn);
?>
