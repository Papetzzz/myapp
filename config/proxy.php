<?php
// Forward the request to the NodeMCU
$nodeMCU_response = file_get_contents("http://192.168.178.92/?pin=13");

// Echo the response back to the client
echo $nodeMCU_response;
?>
