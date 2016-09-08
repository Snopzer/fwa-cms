<?php
	/*
	File name 		: 	gallery-controller.php
	Date Created 	:	13-06-2016
	Date Updated 	:	08-09-2016
	Description		:	Manage Gallery Operation Like Add/Delete Images
	*/
	ob_start();
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	
	if (isset($_GET['action']) & $_GET['action'] == 'add') {
		$name = mysql_real_escape_string($_POST['image_name']);
		$pic = ($_FILES['photo']['name']);
		$addPic = mysql_query("insert into r_image (image,image_name) VALUES ('".$pic."','".$name."') ")or die(mysql_error());
		$path = "../images/gallery/" . $_FILES['photo']['name'];
		if (copy($_FILES['photo']['tmp_name'], $path)) {
			header('location:gallery.php');
			} else {
			echo "Sorry, there was a problem uploading your file.";
		}
	}
	
    if (isset($_GET['action']) & $_GET['action'] == "delete") {
        $id = $_GET['id'];
        $res = mysql_query("SELECT image FROM r_image WHERE id_image='$id'");
		
        $row = mysql_fetch_array($res);
	    $deltePic = mysql_query("DELETE FROM r_image WHERE id_image='$id'");
        if ($deltePic) {
            header("location:gallery.php");
		}
		else {
			echo "cannot delete record";
		}
	}
?>
