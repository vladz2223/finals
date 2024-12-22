<?php
    $servername ="localhost";
    $username ="root";
    $password = "";
    $dbname = 'registration';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT into admin (email, password) VALUES ('$email','$password')";

        if($conn->query($sql) === TRUE){
            echo "SIGN UP SUCCESSFUL";
        }else{
            echo "ERROR: " .$sql. "<br>" .$conn->error;
        }
    }
?>