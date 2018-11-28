<?php

$connection = mysql_connect("localhost", "root", "");
// Selecting Database
$db = mysql_select_db("hms", $connection);
session_start();
$user_check=$_SESSION['staff'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username from staff where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['username'];
if(!isset($login_session)){
mysql_close($connection); 
header('Location: index (2).html'); // Redirecting To Home Page
}
?>