<?php 
include("../../config.php");

if(isset($_POST['songId'])){
	$albumId=$_POST['songId'];

	$query=mysqli_query($con,"UPDATE songs SET plays = plays+1  WHERE id='$songId'");
}

?>