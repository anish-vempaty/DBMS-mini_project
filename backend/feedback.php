<?php
session_start();
include "../db/connect.php";
if (isset($_POST["full_name"])) {

	
	$full_name = $_POST["full_name"];
	$email = $_POST['email'];
	$event_id = $_POST['event_id'];
	$event_name = $_POST['event_name'];
	$Feedback = $_POST['Feedback'];
	$nameval = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";


if(empty($full_name)  || empty($email)  ||
	empty($event_name) || empty($Feedback) ) {
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($nameval,$full_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $full_name is not valid..!</b>
			</div>
		";
		exit();
	}
	
	if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
		exit();
	}
	//existing email address in our database
	
		$sql = "INSERT INTO `feedback` 
		(`f_no`,`event_id`, `name`, `email`, 
		 `event_name`,  `feedback`) 
		VALUES (NULL,'$event_id', '$full_name',  '$email', 
		 '$event_name', '$Feedback')";
		
		if(mysqli_query($con,$sql)){
			echo "register_success";
			echo "<script> location.href='index.php'; </script>";
            exit;
		}
	}
	
}



?>
