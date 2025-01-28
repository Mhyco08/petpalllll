<?php  //this is actually for log in
    $host="localhost";
    $user="root";
    $pass="";
    $db="login";//DATABASE name
    $conn=new mysqli(hostname: $host, username: $user, password:$pass, database: $db, port:3307);// FOR CONNECTION I USED THE PORT NUMBER BASE SA SQL PORT PAG INOPEN PANEL
    if($conn->connect_error){
        echo "Failed to connect DB".$conn->connect_error;
    }
?>