<?php
$serverName = "DESKTOP-94I5S6B\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"CpE_Transactions");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$Name=$_POST['name'];
$Section=$_POST['section'];
$DocumetType=$_POST['documentType'];
$PurposeSubmission=$_POST['purpose'];
$ProfessorId=$_POST['professorId'];

$insert= "Insert into Transactions_table(Name,IDNumber,Password,RegistrationTypeID,IsAdmin)values('$Name','$IDNumber','$Password',$RegType,$Admin)";
$result=sqlsrv_prepare($conn,$insert);

if( sqlsrv_execute($result)) {
     echo "Registration Successful!";
      header('Location: '.'../Login.html');
     die();
}else{
     echo "Connection could not be established.<br />";
     if( ($errors = sqlsrv_errors() ) != null) {
          foreach( $errors as $error ) {
              echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
              echo "code: ".$error[ 'code']."<br />";
              echo "message: ".$error[ 'message']."<br />";
          }
      }
     die( print_r( sqlsrv_errors(), true));
}
?>