<?php
$ip =   "192.168.249.92?p=2&s=1";
$output = array();
exec("ping -n 3 $ip", $output, $status);
// echo json_encode($output).$status;
// Check if the command executed successfully and output contains relevant information
if ($status === 0 && !empty($output)) {
    $reachable = false;
    foreach ($output as $line) {
        // Check if the line contains "Destination host unreachable"
        if (strpos($line, "Destination host unreachable") !== false) {
            $reachable = false;
            break;
        }
        // Check if the line contains "Reply from" which indicates a successful ping
        if (strpos($line, "Reply from") !== false) {
            $reachable = true;
        }
    }
    if ($reachable) {
        $response = array("success" => true, "message" => "Host is reachable");
    } else {
        $response = array("success" => false, "message" => "Ping failed: Destination host unreachable");
    }
} else {
    $response = array("success" => false, "message" => "Failed to execute ping command");
}

echo json_encode($response);

?>