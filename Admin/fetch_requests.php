<?php
session_start();

// Get the selected parameters from the AJAX request
$year = isset($_GET['Year']) ? $_GET['Year'] : null;
$section = isset($_GET['Section']) ? $_GET['Section'] : null;
$startDate = isset($_GET['StartDate']) ? $_GET['StartDate'] : null;
$endDate = isset($_GET['EndDate']) ? $_GET['EndDate']: null;
$suggestedStart = isset($_GET['SuggestedStart']) ? $_GET['SuggestedStart']: null;
$suggestedEnd = isset($_GET['SuggestedEnd']) ? $_GET['SuggestedEnd']: null;
$profID = isset($_GET['ProfID']) ? $_GET['ProfID']: null;
$docTypeID = isset($_GET['DocTypeID']) ? $_GET['DocTypeID']: null;
$isReceived = isset($_GET['IsReceived']) ? $_GET['IsReceived']: false;
$isDocument = isset($_GET['IsDocument']) ? $_GET['IsDocument']: false;
$isApproved = isset($_GET['IsApproved']) ? $_GET['IsApproved']: false;

// Handle empty values and default start/end dates
if ($year === '') {
    $year = null;
}
if ($section === '') {
    $section = null;
}
if ( $profID === '') {
    $profID = null;
}
if ( $docTypeID === '') {
    $docTypeID = null;
}
if ($startDate === '') {
    $startDate = date('Y-m-d 00:00:00', strtotime('-100 days'));
}
if ($endDate === '') {
    $endDate = date('Y-m-d 23:59:59');
} else {
    $endDate .=" 23:59:59" ;
}
if ($suggestedStart === '') {
    $suggestedStart = date('Y-m-d 00:00:00', strtotime('-100 days'));
}
if ($suggestedEnd === '') {
    $suggestedEnd = date('Y-m-d 23:59:59');
} else {
    $suggestedEnd .=" 23:59:59" ;
}

// Connection parameters
$serverName = "DESKTOP-94I5S6B\\SQLEXPRESS";
$connectionInfo = array("Database" => "CpE_Transactions");

try {
    // Connect to the database
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    if ($conn === false) {
        // Handle connection failure
        die(print_r(sqlsrv_errors(), true));
    }
    
    // Construct the SQL query
    $search = "SELECT
                a.TransactionID,
                u.Name,
                a.Purpose as Purpose,
                st.Description as Status,
                a.RequestedDate AS RequestDateTime,
                a.TransactionDate as DateSubmitted,
                tm.Code,
                CASE
                    WHEN a.DateAccepted IS NOT NULL THEN 'Yes'
                    ELSE 'No'
                END as IsReceived,
                a.Remarks,
                dt.Type
            FROM Transactions_table a
            LEFT JOIN Users_table u ON a.ProfessorID = u.UserID	
            LEFT JOIN TransactionMode_table tm ON a.TransactionModeID = tm.TransactionModeID
            LEFT JOIN Section_table s ON a.SectionID = s.SectionID
            LEFT JOIN Status_Table st ON a.StatusID = st.StatusID
            LEFT JOIN DocumentType_Table dt on a.DocumentTypeId = dt.DocumentTypeId";
    
    // Initialize WHERE clause and parameters array
    $whereClause = '';
    $params = array();
    
    // Construct WHERE clause dynamically based on selected parameters
    if ($year !== null) {
        $whereClause .= " AND s.Year = ?";
        $params[] = $year;
    }
    if ($section !== null) {
        $whereClause .= " AND s.SectionID = ?";
        $params[] = $section;
    }
    if ($profID !== null) {
        $whereClause .= " AND a.ProfessorID = ?";
        $params[] = $profID;
    }
    if ($docTypeID !== null) {
        $whereClause .= " AND a.DocumentTypeId = ?";
        $params[] = $docTypeID;
    }

    if ($isDocument === 'true' && $isReceived !== null) {
        $whereClause .= " AND a.DateAccepted IS " . ($isReceived === 'true' ? "NOT NULL" : "NULL");
    }
 
    if ($isDocument !== 'true' && $isApproved !== null) {
        $whereClause .= " AND (st.Code = " . ($isApproved === 'true' ? "'A'" : "'N' or st.Code = 'R'").")";
    }

    if ($startDate !== null && $endDate !== null) {
        $whereClause .= " AND a.TransactionDate BETWEEN ? AND ?";
        $params[] = $startDate;
        $params[] = $endDate;
    }
    if ($isDocument !== 'true' && $suggestedStart !== null && $suggestedEnd !== null) {
        $whereClause .= " AND a.RequestedDate BETWEEN ? AND ?";
        $params[] = $suggestedStart;
        $params[] = $suggestedEnd;
    }
    
    // Append the WHERE clause to the SQL query if necessary
    if ($whereClause !== '') {
        $search .= " WHERE 1=1" . $whereClause;
    }
    // echo $search;
    // echo json_encode($params);
    // Prepare and execute the query
    $stmt = sqlsrv_query($conn, $search, $params);
    
    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }
    
    // Fetch the results into an array
    $transactions = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $transactions[] = $row;
    }
    
    // Free the statement
    sqlsrv_free_stmt($stmt);
    
    // Encode the array into JSON format and return it
    echo json_encode($transactions);
} catch (Exception $e) {
    // Handle other types of exceptions
    die("Some problem getting data from database: " . $e->getMessage());
}
?>
