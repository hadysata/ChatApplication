<?php

     include('config.php');
     
      header("Content-Type: text/html; charset=utf-8");

     
     date_default_timezone_set("Asia/Riyadh");

     
     $time = date("h:i");
     
     $name = $_POST['name'] ;
     $msg = ($_POST['msg']) ;
     $to = $_POST['to'] ;




if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

$sql = "INSERT INTO ml (name,msg,tox,time)
VALUES ('$name', '$msg' ,'$to' , '$time')";

if ($db->query($sql) === TRUE) {
     echo 'true';
} else {
echo'false';
    
}

$db->close();


?>