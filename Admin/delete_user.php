<?php
// echo '<script> alert("ala pa naman") </script>';
session_start();
$userId = isset($_POST['userId']) ? $_POST['userId'] : '';
try {
    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // Fill in your server name
    $connectionInfo = array("Database" => "CpE_Transactions");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    if ($conn === false) {
        // Handle connection failure
        die(print_r(sqlsrv_errors(), true));
    }
    
    // Modify your SQL query to perform the deletion
    $query = "DELETE FROM Transactions_table WHERE UserID = ? or ProfessorID = ?;
              DELETE FROM Users_table WHERE UserID = ?;";
    
    // Prepare the SQL statement
    $stmt = sqlsrv_prepare($conn, $query, array($userId, $userId, $userId));

    // Execute the SQL statement
    if (sqlsrv_execute($stmt)) {
        echo json_encode(array("success" => true));
    } else {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }
    
    sqlsrv_free_stmt($stmt);
} catch (Exception $e) {
    // Handle other types of exceptions
    die("Some problem getting data from database: " . $e->getMessage());
}

?>
