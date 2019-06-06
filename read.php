<?php

     include('config.php');

     $to = $_GET['name'] ;
     
     
     if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

$sql = "SELECT name,msg, time FROM ml WHERE tox='$to'";

    $result = $db->query($sql);

    
if ($result->num_rows > 0) {
    // output data of each row
    
   $rows = array();
 while($row = $result->fetch_assoc()) {
     $rows['msgs'][] = $row;
   }

 print json_encode($rows);
} else {
    echo "false";
}

$db->close();


?>