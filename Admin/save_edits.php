<?php
session_start();

// Get the selected parameters from the AJAX request
$name = isset($_GET['Name']) ? $_GET['Name'] : null;
$id_number = isset($_GET['IdNumber']) ? $_GET['IdNumber'] : null;
$userId = isset($_GET['UserId']) ? $_GET['UserId'] : null;
$is_active = isset($_GET['Active']) ? $_GET['Active'] : null;
$is_admin = isset($_GET['Admin']) ? $_GET['Admin'] : null;

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
$update = "UPDATE Users_table SET Name = ?, IDNumber = ?, IsActive = ?, IsAdmin = ? WHERE UserID = ?";

// Prepare the SQL statement
$stmt = sqlsrv_prepare($conn, $update, array(&$name, &$id_number, &$is_active, &$is_admin, &$userId));

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
