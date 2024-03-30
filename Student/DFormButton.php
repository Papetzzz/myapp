<?php

$serverName = "DESKTOP-94I5S6B\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"CpE_Transactions");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

session_start();
$UserID = $_SESSION['UserID'];
$SectionID=$_POST['sectionSelect'];
$TransactionModeID=2;
$ProfessorID=$_POST['professorID'];
$SubmissionType=1;//$_POST['Regtype'];
$StatusID=1;
$Purpose=$_POST['purpose'];
$Admin=0;  //$_POST['name'];

$insert= "insert into Transactions_table  
(UserID,SectionID,TransactionModeID,SubmissionTypeID,TransactionDate,ProfessorID,RequestedDate,StatusID,Purpose)  

values  
($UserID,$SectionID,$TransactionModeID,$SubmissionTypeID,GETDATE(),$ProfessorID,GETDATE(),$StatusID,'$Purpose')";
$result=sqlsrv_prepare($conn,$insert);

if( sqlsrv_execute($result)) {
     echo "Submmited Succesfully";
      
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