<?php
// // echo '<script> alert("ala pa naman") </script>';
// session_start();

// // Get the selected ordering and direction from the AJAX request
// $TransactionCode = isset($_GET['TransactionCode']) ? $_GET['TransactionCode'] : '';

function getYears($conn) {
    $sql = "SELECT DISTINCT Year FROM Section_table";
    $params = array(); // Assuming "C" is the transaction mode code for submission
    $stmt = sqlsrv_query($conn, $sql, $params);   

    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Initialize an array to store years
    $years = array();

    // Fetch results and store years in the array
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { 
        $years[] = $row['Year'];
    }

    // Free the statement
    sqlsrv_free_stmt($stmt);
    
    return $years;
}

function getSections($conn) {
    $sql = "SELECT DISTINCT Year,SectionID, Description FROM Section_table ORDER BY Description";
    $params = array(); // Assuming "C" is the transaction mode code for submission
    $stmt = sqlsrv_query($conn, $sql, $params);   

    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Initialize an array to store sections
    $sections = array();

    // Fetch results and store sections in the array
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { 
        $sections[] = $row;
    }

    // Free the statement
    sqlsrv_free_stmt($stmt);
    
    // Encode the array into JSON format
    // $json = json_encode($sections);
    
    return $sections;
}

function getProfessor($conn) {
    $sql = "SELECT UserID, Name FROM Users_table ut
    JOIN RegistrationType_table rt ON ut.RegistrationTypeID = rt.RegistrationTypeID
    WHERE rt.Code = 'PR'
    ORDER BY Name";
    $params = array(); // Assuming "C" is the transaction mode code for submission
    $stmt = sqlsrv_query($conn, $sql, $params);   

    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Initialize an array to store sections
    $profs = array();

    // Fetch results and store sections in the array
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { 
        $profs[] = $row;
    }

    // Free the statement
    sqlsrv_free_stmt($stmt);
    
    
    return $profs;
}

function getDocTypes($conn) {
    $sql = " SELECT * FROM DocumentType_Table ORDER BY Type";
    $params = array(); // Assuming "C" is the transaction mode code for submission
    $stmt = sqlsrv_query($conn, $sql, $params);   

    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Initialize an array to store sections
    $docType = array();

    // Fetch results and store sections in the array
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { 
        $docType[] = $row;
    }

    // Free the statement
    sqlsrv_free_stmt($stmt);
    
    
    return $docType;
}

function getList($conn) {
    // Perform any necessary operations to count records
    // For example, querying a database
    $years = getYears($conn); // Replace with actual count of consultations
    $sections = getSections($conn); // Replace with actual count of submissions
    $profs = getProfessor($conn);
    $docType = getDocTypes($conn);
    // Return the counts as an associative array
    return array(
        'Years' => $years,
        'Sections' => $sections,
        'Professors' => $profs,
        'DocumentType' => $docType,
    );
}

// Check if the request is an AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Call the function and return the result as JSON
    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // Fill in your server name
    $connectionInfo = array("Database" => "CpE_Transactions");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    echo json_encode(getList($conn)); // Corrected function call
} else {
    // Handle non-AJAX requests (optional)
    echo 'This endpoint is only accessible via AJAX.';
}

?>
