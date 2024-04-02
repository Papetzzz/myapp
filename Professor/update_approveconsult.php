

<?php

session_start();
$serverName = "DESKTOP-94I5S6B\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"CpE_Transactions");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$TransactionID=$_POST['TransactionID'];
$IsApprove=$_POST['IsApprove'];
$insert= "UPDATE Transactions_table
SET StatusID = 
	CASE
		WHEN @IsApproved = ".$IsApprove." THEN (SELECT StatusID FROM Status_Table WHERE Code = 'A')
		WHEN @IsApproved = ".$IsApprove." THEN (SELECT StatusID FROM Status_Table WHERE Code = 'X')
	END		
WHERE TransactionID = ".$TransactionID ;
$result=sqlsrv_prepare($conn,$insert);

if( sqlsrv_execute($result)) {
     //      // Retrieve the last inserted ID (TransactionID)
     // $lastId = sqlsrv_query($conn, "SELECT IDENT_CURRENT('Transactions_table') AS LastID");
     // $row = sqlsrv_fetch_array($lastId, SQLSRV_FETCH_ASSOC);
     // $transactionID = $row['LastID'];

     // // Send success response along with the TransactionID
     // $response = array("error" => false, "submitted" => true, "message" => "Submitted successfully.", "TransactionID" => $transactionID);
     // echo json_encode($response);
     // die();

}else{
     // $response = array("error" => true, "submitted" => false ,"message" => "Connection could not be established.");
     // if( ($errors = sqlsrv_errors() ) != null) {
     //      foreach( $errors as $error ) {
     //          echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
     //          echo "code: ".$error[ 'code']."<br />";
     //          echo "message: ".$error[ 'message']."<br />";
     //      }
     //  }
     //  echo json_encode($response);
     // die( print_r( sqlsrv_errors(), true));
}
?> 
<div id="divAlertSuccess" hidden>
     <div class="alert alert-success alert-dismissible fade show" role="alert" >
          Message
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>

</div>
<!-- <script>
     var alert = $('#divAlertSuccess').html()
     alert = alert.replace('Message','Request Submmited Succesfully')
     $('#divDFormAlerts').append(alert)
</script> -->