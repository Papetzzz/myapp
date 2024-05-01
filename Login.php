<?php
/*
// $ip =   "192.168.1.9";
// exec("ping -n 3 $ip", $output, $status);
// print_r($output);
// Arduino's IP address
$arduino_ip = '192.168.1.9'; // Change this to your Arduino's IP address
// Data to send
$data = 123; // Change this to your desired data

// Send HTTP request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://$arduino_ip/data?data=$data");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo "result </br>";
echo $response; // Response from Arduino
*/
/***********************************************/

$serverName = "DESKTOP-94I5S6B\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"CpE_Transactions");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//$IDNumber='19-03022';
//$Password='DELAROCA';
//$search= "SELECT * FROM Users_table WHERE IDNumber = '$IDNumber' and Password='$Password'";
//$result=sqlsrv_prepare($conn,$search);

if (!$conn) {
     die("Connection could not be established: " . print_r(sqlsrv_errors(), true));
 }
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $IDNumber = filter_var($_POST['id_number'], FILTER_SANITIZE_SPECIAL_CHARS);
    // $Password = $_POST['Password']; // No need to filter, as it's not used in the query
 
    // $selectQuery = "SELECT * FROM Users_table WHERE IDNumber = ?";
 
    $IDNumber=$_POST['IDNumber'];
    $Password=$_POST['Password'];
    $search= "SELECT u.*, rt.Code FROM Users_table u 
    JOIN RegistrationType_table rt ON u.RegistrationTypeID = rt.RegistrationTypeID WHERE IDNumber = '$IDNumber'";

     //$params = array($IDNumber);
     $result = sqlsrv_query($conn, $search);
 
     if ($result === false) {
         echo "Login failed. Error details:<br />";
         die(print_r(sqlsrv_errors(), true));
     }
 
     if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
         // Assuming you have a function to verify the password
         if ($Password===$row['Password']) {
                echo "Login Successful!";
                session_start();
                    $_SESSION['UserValid'] = true;
                    $_SESSION['UserID']=$row['UserID'];
                    $_SESSION['UserName']=$row['Name'];
                    $_SESSION['IsAdmin']=$row['IsAdmin'];
                    $_SESSION['RegType']=$row['Code'];
                    
                if ($row['RegistrationTypeID'] == 2){
                    header('Location: Professor/Home_Professor.php');
                    exit();
                } else if ($row['RegistrationTypeID'] == 1){
                    header('Location: Home.php');
                    exit();

                }   else if ($_SESSION['RegType'] == 'A'){
                        header('Location: Admin/Home_Admin.php');
                        exit();
                }


             // Redirect to the appropriate page after successful login
            
         } else {
             // Sending file (file1.php)
             session_start();
             $_SESSION['UserValid'] = false;
             header('Location: LoginPage.php');
             exit();

         }
     } else {
          session_start();
          $_SESSION['UserValid'] = false;
          header('Location: LoginPage.php');
          exit();

     }
 }
 ?>