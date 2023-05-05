<?php

    include "connect.php";
    session_start();

    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }else{
        $user_id = '';
    }

 

    $logout = $conn->prepare("UPDATE admin_page SET status = 'Unactive' WHERE id = ?");
    $logout->execute([$user_id]);

    session_unset();
    session_destroy();
    header("location:index.php");
?>

