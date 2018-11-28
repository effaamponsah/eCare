<?php

$firstname = filter_input(INPUT_POST, 'r-form-first-name');
$lastname = filter_input(INPUT_POST, 'r-form-last-name');
$username = filter_input(INPUT_POST, 'r-form-Username');
$password = filter_input(INPUT_POST, 'r-form-Password');

if (!empty($firstname)){
if (!empty($lastname)){
if (!empty($username)){
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
	$sql = "INSERT INTO staff (Fname, Lname, UName, Password)
	values ('$firstname', '$lastname', '$username', '$password')";

	if ($conn->query($sql)){
		echo "You have signed up Succesfully";
	}
	else{
		echo "Sign up failed". $sql ."<br>". $conn->error;
	}

	$conn->close();
}
}
else{
	echo "This field cannot be empty";
}
}
else{
	echo "This field cannot be empty";
	die();
}
}
else{
	echo "This field cannot be empty";
	die();
}
}
else{
	echo "This field cannot be empty";
	die();
}
?>