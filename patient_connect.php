<?php 
session_start();
$firstname=filter_input(INPUT_POST, 'p_id');
$lastname=filter_input(INPUT_POST, 'p_name');
$username=filter_input(INPUT_POST, 'p_dob');
$password=filter_input(INPUT_POST, 'p_contact');
if (!empty($firstname)) {
	if (!empty($lastname)) {
		if (!empty($username)) {
			if (!empty($password)) {
				$host="localhost";
				$dbusername="root";
				$dbpassword="";
				$dbname="hms";
				$conn=new mysqli ($host, $dbusername, $dbpassword, $dbname);
				if (mysqli_connect_error()) {
					die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
				}
				else {
					$sql="INSERT INTO patients (Patient_ID, Name, DOB, Contact)
 					values ('$firstname', '$lastname', '$username', '$password')";
 				if ($conn->query($sql)) {
						echo "You have signed up Succesfully";
						header("Location: ./frp/success.php");
				}
				else {
						echo "Sign up failed". $sql ."<br>". $conn->error;
						
				}
					$conn->close();
				}
			}
			else {
				echo "This field cannot be empty";
			}
		}
		else {
			echo "This field cannot be empty";
			die();
		}
	}
	else {
		echo "This field cannot be empty";
		die();
	}
}

else {
	echo "This field cannot be empty";
	die();
}
?>