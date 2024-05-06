<?php
// $pinB_value = $_GET['pinB'];
// // Forward the request to the NodeMCU
// $nodeMCUB_response = file_get_contents("http://192.168.1.198/?pinB=$pinB_value");
// // $nodeMCU_response = file_get_contents("http://192.168.1.198/?pinB=10");

// // Echo the response back to the client
// echo $nodeMCUB_response;

// Forward the request to the NodeMCU
    $pinB_value = $_GET['pinB'];
    $url = "http://192.168.1.8/?pinB=$pinB_value";
    $nodeMCUB_response = @file_get_contents($url);

    if ($nodeMCUB_response === FALSE) {
        // Error handling: Log or display the error message
        echo "Error: Failed to make HTTP request to $url";
    } else {
        // Echo the response back to the client
        echo $nodeMCUB_response;
    }
?>
