
<?php
if (isset($_GET['IdNum'])) {
    $IdNum = $_GET['IdNum'];

    // Provide the correct server name
    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // Replace with your server name

    $connectionInfo = array("Database" => "CpE_Transactions");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        // Handle connection failure
        $response = array("error" => true, "message" => "Failed to connect to the database");
        echo json_encode($response);
        exit();
    }
    
    $search = "SELECT 
        CASE 
            WHEN EXISTS (SELECT 1 FROM Users_Table WHERE IdNumber = ?) THEN 1 
            ELSE 0 
        END AS Result;";
    $params = array($IdNum);
    $result = sqlsrv_query($conn, $search, $params);
    
    if ($result === false) {
        // Handle query execution error
        $response = array("error" => true, "message" => "Failed to execute query");
        echo json_encode($response);
        exit();
    }
    
    // Fetch the result
    if (sqlsrv_fetch($result) === true) {
        $exists = sqlsrv_get_field($result, 0);
        $response = array("error" => false, "exists" => $exists);
        echo json_encode($response);
    } else {
        // Handle fetch error
        $response = array("error" => true, "message" => "Failed to fetch result");
        echo json_encode($response);
    }
    
    // Free result and close connection
    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
} else {
    // Handle case where IdNum parameter is not set
    $response =  array("error" => true,"message" =>"Error: IdNum parameter is missing in the request.");
    echo json_encode($response);
}
?>
