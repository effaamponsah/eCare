<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "hms";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
	die('Connect Error ('. mysqli_connect_errno() .') '
		. mysqli_connect_error());
}


function login(){
	echo "Hello a; login";
}

function register(){
	echo "string";
}
