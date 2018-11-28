<?php

$username = filter_input(INPUT_POST, 'register-username');
$staffid = filter_input(INPUT_POST, 'register-staffid');
$password = filter_input(INPUT_POST, 'register-password');

if (!empty($username)){
if (!empty($staffid)){
if (!empty($password)){

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "hms";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
	die('Connect Error ('. mysqli_connect_errno() .') '
		. mysqli_connect_error());
}

else {
	$sql = "INSERT INTO doctor (UName, StaffID, Password)
	values ('$username', '$staffid', $password')";

	if ($conn->query($sql)){
		echo "You have registered Succesfully";
	}
	else{
		echo "Registration failed". $sql ."<br>". $conn->error;
	}

	$conn->close();
}
}

else{
	echo "This field cannot be empty";

}
}
else{
	echo "Neck";
	die();
}
}
else{
	echo "Head";
	die();
}
?>