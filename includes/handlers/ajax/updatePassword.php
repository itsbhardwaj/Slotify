<?php
include("../../config.php");

if(!isset($_POST['username'])) {
	echo "ERROR: Could not set username";
	exit();
}

if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])) {
	echo "NOt all passwords have been set";
	exit();
}

if($_POST['oldPassword'] == "" || $_POST['newPassword1'] =="" || $_POST['newPassword2']== "") {
	echo "Please fill all the fields";
	exit();
}

$username = $_POST['username'];
$oldPassword = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];
$newPassword2 = $_POST['newPassword2'];

$oldMd5 = nd5($oldPassword);

$passwordCheck = mysqli_query($con, "SELECT * FROM users where username = '$username' AND password='$oldMd5'");
if(mysqli_num_rows($passwordCheck) != 1){
	echo "Password is incorrect";
	exit();
}

if($newPassword1 != $newPassword2){
	echo "you new password do not match";
	exit();
}

if(preg_match('/[^A-Za-a0-9]/',$newPassword1)){
	echo "Your password must only contain letters and/or numbers";
	exit();

}

if(strlen($newPassword1)>30 || strlen($newPassword1)<5) {
	echo "Your password must be between 5 - 30 characters";
	exit();
}

$newMd5=nd5($newPassword1);

$query = mysqli_query($con, "UPDATE users set password = '$newMd5' where username='$username'");
echo "update Sucessful";

?>