

<?php

session_start();
$serverName = "DESKTOP-94I5S6B\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"CpE_Transactions");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$UserID = $_SESSION['UserID'];
$SectionID=$_POST['sectionSelect'];
$TransactionModeID=2;
$ProfessorID=$_POST['professorId'];
$SubmissionType=1;//$_POST['Regtype'];
$StatusID=1;
$Purpose=$_POST['purpose'];
$DocumentTypeId=$_POST['documentType'];  //$_POST['name'];

$insert= "INSERT INTO Transactions_table
(UserID, SectionID, TransactionModeID, SubmissionTypeID,TransactionDate,
ProfessorID,RequestedDate,StatusID,Purpose,DocumentTypeId)  

values  
(".$UserID.",".$SectionID.",".$TransactionModeID.",".$SubmissionType.",GETDATE(),".$ProfessorID.",GETDATE(),".$StatusID.",'".$Purpose."',".$DocumentTypeId.")";
$result=sqlsrv_prepare($conn,$insert);

if( sqlsrv_execute($result)) {
          // Retrieve the last inserted ID (TransactionID)
     $lastId = sqlsrv_query($conn, "SELECT IDENT_CURRENT('Transactions_table') AS LastID");
     $row = sqlsrv_fetch_array($lastId, SQLSRV_FETCH_ASSOC);
     $transactionID = $row['LastID'];

     // Send success response along with the TransactionID
     $response = array("error" => false, "submitted" => true, "message" => "Submitted successfully.", "TransactionID" => $transactionID);
     echo json_encode($response);
     die();

}else{
     $response = array("error" => true, "submitted" => false ,"message" => "Connection could not be established.");
     if( ($errors = sqlsrv_errors() ) != null) {
          foreach( $errors as $error ) {
              echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
              echo "code: ".$error[ 'code']."<br />";
              echo "message: ".$error[ 'message']."<br />";
          }
      }
      echo json_encode($response);
     die( print_r( sqlsrv_errors(), true));
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