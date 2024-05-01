<?php
$errors = array('defaultPass' =>'');
$DefaultPassword = "CPEProf2024";

if (isset($_POST['Password'])){
    if(empty($_POST['Password'])){
        $errors['defaultPass']="Please enter password";
    } else {
        $Password=$_POST['Password'];
        if ($Password !== $DefaultPassword){
            $errors['defaultPass']="Password invalid"; 
        }
        
    }
}

?>