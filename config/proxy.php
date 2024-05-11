<?php
// Forward the request to the NodeMCU
$nodeMCU_response = file_get_contents("http://172.20.10.5/?pin=13");

// Echo the response back to the client
echo $nodeMCU_response;
?>
