<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "db_conn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png");

			if (in_array($img_ex_lc, $allowed_exs)) {
				$message = $_REQUEST['message'];
				$type =  $_REQUEST['type'];
				$address = $_REQUEST['address'];
				
				$new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
				$img_upload_path = 'uploads/' . $new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "INSERT INTO complaints(image,address,message,type) 
				        VALUES('$new_img_name','$address','$message','$type')";
				mysqli_query($conn, $sql);
			} else {
				$em = "You can't upload files of this type";
				header("Location: test.php?error=$em");
			}
		
	} else {
		$em = "unknown error occurred!";
		header("Location: test.php?error=$em");
	}
} else {
	header("Location: test.php");
}
?>