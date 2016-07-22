<?php
	ob_start();
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
		$pic = $_FILES['photo']['name'];
		$path = "../images/user/" . $_FILES['photo']['name'];
		if (copy($_FILES['photo']['tmp_name'], $path)) {
			echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
			} else {
			echo "Sorry, there was a problem uploading your file.";
		}
		} else {
		$pic = $_POST['preview_image'];
	}
	$name = $_POST['name'];
	$department = $_POST['department'];
	$email = $_POST['email'];
	$skills = $_POST['skills'];
	$phone = $_POST['phone'];
	$id_country = $_POST['country'];
	$row = "update r_user SET  name='$name',image='$pic',department='$department',email='$email',phone='$phone',skills='$skills',id_country='$id_country' where id_user=" . $_SESSION['id'];
	$result = mysql_query($row) or die(mysql_error());
	
	if ($result) {
		$_SESSION['name'] = $name;
		if(!empty($pic)){
		$_SESSION['image'] = $pic;
		}
		header('location:profile.php');
		} else {
		header('location:profile.php');
	}
?>