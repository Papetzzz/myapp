<?php
// echo '<script> alert("ala pa naman") </script>';
session_start();
$query = isset($_GET['query']) ? $_GET['query'] : '';

try {
    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // Fill in your server name
    $connectionInfo = array("Database" => "CpE_Transactions");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    if ($conn === false) {
        // Handle connection failure
        die(print_r(sqlsrv_errors(), true));
    }
    
    // Modify your SQL query to concatenate the search parameters and order the results
    $search = "SELECT r.Code, u.* FROM Users_table u 
               JOIN RegistrationType_table r ON u.RegistrationTypeID = r.RegistrationTypeID
               WHERE Name like '%" . $query . "%' OR IDNumber like '%" . $query . "%'
                ORDER BY u.UserID ASC";

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
