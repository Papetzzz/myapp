<?php
session_start();

// Get the selected parameters from the AJAX request

$userId = isset($_GET['UserId']) ? $_GET['UserId'] : null;

// Connection parameters
$serverName = "DESKTOP-94I5S6B\\SQLEXPRESS";
$connectionInfo = array("Database" => "CpE_Transactions");

// Connect to the database
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Check if the connection is successful
if ($conn === false) {
    // Handle connection failure
    die(print_r(sqlsrv_errors(), true));
}

// Construct the SQL update query
$update = "UPDATE Users_table SET Password = 'CPE2024' WHERE UserID = ?";

// Prepare the SQL statement
$stmt = sqlsrv_prepare($conn, $update, array(&$userId));

if ($stmt) {
    // Execute the prepared statement
    if (sqlsrv_execute($stmt)) {
        echo "Success";
    } else {
        // Handle execution error
        echo "Error executing SQL statement.";
        die(print_r(sqlsrv_errors(), true));
    }
} else {
    // Handle preparation error
    echo "Error preparing SQL statement.";
    die(print_r(sqlsrv_errors(), true));
}

// Close the statement and connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
