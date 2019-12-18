<?php
include("include/connection.php");


	if(isset($_POST['sign_up'])){

	$name = htmlentities(mysqli_real_escape_string($con,$_POST['user_name']));
	$pass = htmlentities(mysqli_real_escape_string($con,$_POST['user_pass']));
	$email = htmlentities(mysqli_real_escape_string($con,$_POST['user_email']));
	$country = htmlentities(mysqli_real_escape_string($con,$_POST['user_country']));
	$gender = htmlentities(mysqli_real_escape_string($con,$_POST['user_gender']));
	
	$pic_1 = $_FILES['fileToUpload1']['name'];
	$pic_1_temp = $_FILES['fileToUpload1']['tmp_name'];
    $random_number = rand(1,100);
    move_uploaded_file($pic_1_tmp,"people/$pic_1.$random_number");


	$pic_2 = $_FILES['fileToUpload2']['name'];
	$pic_2_temp = $_FILES['fileToUpload2']['tmp_name'];
    $random_number = rand(1,100);
    move_uploaded_file($pic_2_tmp,"people/$pic_2.$random_number");
    

	$pic_3 = $_FILES['fileToUpload3']['name'];
	$pic_3_temp = $_FILES['fileToUpload3']['tmp_name'];
    $random_number = rand(1,100);
    move_uploaded_file($pic_3_tmp,"people/$pic_3.$random_number");
   

	$rand = rand(1, 2); //Random number between 1 and 2

	if($name == ''){
		echo "<script>alert('We can not verify your name')</script>";
	}

	if(strlen($pass)<8){

	echo "<script>alert('Password should be minimum 8 characters!')</script>";
	exit();
	}

	$check_email = "select * from users where user_email='$email'";
	$run_email = mysqli_query($con,$check_email);

	$check = mysqli_num_rows($run_email);

	if($check==1){

	echo "<script>alert('Email already exist, please try another!')</script>";
	echo "<script>window.open('signup.php','_self')</script>";
	exit();
	}
	if($rand == 1)
			$profile_pic = "images/codingcafe.jpg";
	else if($rand == 2)
			$profile_pic = "images/codingcafe.jpg";
	$pass = md5($pass);

	$insert = "insert into users (user_name,user_pass,user_email,user_profile,user_country,user_gender,pic_1,pic_2,pic_3) values ('$name','$pass','$email','$profile_pic','$country','$gender','people/$pic_1.$random_number','people/$pic_2.$random_number','people/$pic_3.$random_number')";

	$query = mysqli_query($con,$insert);

	if($query){

	echo "<script>alert('Congratulations $name, your account has been created successfully.')</script>";
	echo "<script>window.open('signin.php','_self')</script>";

	}
	else {

	echo "<script>alert('Registration failed, try again!')</script>";
	echo "<script>window.open('signup.php','_self')</script>";
	}
}
?>
