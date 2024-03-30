<?php
// Assuming you have a SQL Server connection established already
// Fetch sections based on the year received from the AJAX request

// Check if the year parameter is set in the request
if(isset($_GET['year'])) {
    $year = $_GET['year'];

    // Prepare and execute SQL query to fetch sections based on the selected year
    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // serverName\instanceName
    $connectionInfo = array("Database" => "CpE_Transactions");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        // Handle connection failure
        die(print_r(sqlsrv_errors(), true));
    }

    $search = "SELECT SectionID, SectionCode FROM Section_table WHERE Year = ?";
    $params = array($year);
    $result = sqlsrv_query($conn, $search, $params);

    if ($result === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    $sections = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $sections[] = array(
            'sectionID' => $row['SectionID'],
            'sectionCode' => $row['SectionCode']
        );
    }

    // Return sections as JSON response
    header('Content-Type: application/json');
    echo json_encode($sections);

    // Free result and close connection
    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
} else {
    // Handle case where year parameter is not set
    echo "Error: Year parameter is missing in the request.";
}
?>
