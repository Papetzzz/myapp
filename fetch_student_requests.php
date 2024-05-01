<?php
// echo '<script> alert("ala pa naman") </script>';
session_start();

// Get the selected ordering and direction from the AJAX request
$TransactionCode = isset($_GET['TransactionCode']) ? $_GET['TransactionCode'] : '';

try {
    $serverName = "DESKTOP-94I5S6B\\SQLEXPRESS"; // Fill in your server name
    $connectionInfo = array("Database" => "CpE_Transactions");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    if ($conn === false) {
        // Handle connection failure
        die(print_r(sqlsrv_errors(), true));
    }
    $startDate = date('Y-m-d 00:00:00', strtotime('-100 days'));
    
    // echo $startDate." ".$endDate." ".$TransactionCode;
    // Modify your SQL query to order the results based on the selected criteria and direction
    $search = "SELECT
                a.TransactionID,
                u.Name,
                a.Purpose as Purpose,
                st.Description as Status,
                a.TransactionDate as RequestDate,
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
                LEFT join Users_table u on a.ProfessorID = u.UserID	
                LEFT join TransactionMode_table tm on a.TransactionModeID = tm.TransactionModeID
                LEFT join Section_table s on a.SectionID = s.SectionID
                LEFT join Status_Table st on a.StatusID = st.StatusID
                LEFT JOIN DocumentType_Table dt on a.DocumentTypeId = dt.DocumentTypeId
                where  a.UserID = ".$_SESSION['UserID']."
                    AND a.TransactionDate BETWEEN '".$startDate."' AND getdate()
                    ORDER BY a.TransactionDate DESC"; // Dynamically order the results based on $orderBy and $direction
                    // tm.Code = '".$TransactionCode."'
                    // AND
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
