<?php
session_start();
$p_id=filter_input(INPUT_POST, 'p_id');

if (!empty($p_id)) {

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "hms";

    $conn=new mysqli ($servername, $dbusername, $dbpassword, $dbname);


    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    }
    else {
        $sql = $conn->prepare("SELECT * FROM patients WHERE Patient_ID = ?");

        $sql->bind_param("s", $p_id);
        $sql->execute();
        $res = $sql->get_result();
        $r=$res->fetch_assoc();
       echo "Patients ID:  " .$r["Patient_ID"];
       echo "<br/>";
       echo "Name: " .$r["Name"];
       echo "<br/>";
       echo "Date of Birth: " .$r["DOB"];
       echo "<br/>";
       echo "Contact Number: " .$r["Contact"];
       echo "<br/>";
       echo "Last time Visit" .$r["last_visit"];
       
        // print_r( "Name:" .$r["Name"]. "Patients ID:" .$r["Patient_ID"] );
        // print_r($r);
        
    }
    
} else {
    echo("Field is required");
}


?>