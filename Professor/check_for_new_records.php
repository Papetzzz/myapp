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

// Query to check for new records
$sql = "SELECT COUNT(*) AS new_records FROM Transactions_table a WHERE TransactionDate > DATEADD(SECOND, -5, GETDATE()) AND a.ProfessorID = ".$_SESSION['UserID'];
$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die("Query execution failed: " . print_r(sqlsrv_errors(), true));
}

// Fetch result
$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

// Check if there are new records
if ($row["new_records"] > 0) {
    echo "true"; // Send 'true' if there are new records
} else {
    echo "false"; // Send 'false' if there are no new records
}

// Close the connection
sqlsrv_close($conn);
?>
