<?php
	session_start();
		if(!isset($_SESSION['username'])){
			header("Location: index.php");
		}
		
		if($_SESSION['role'] !== "T"){
			header("Location: main.php");
		}

	include("db_connect.php");
	if($db){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_POST['id'];
			$_SESSION['id'] = $id;
			include("messages.php");
			$username = $_POST['username'];
			$role = $_POST['role'];
			$password = $_POST['password'];
			$pwd_hash = password_hash($password, PASSWORD_BCRYPT);
			
			$dbname = "system";
			$sel = mysqli_select_db($db, $dbname) or die("db連接錯誤");
			if($sel){
				$cmd = "UPDATE `users` SET `username` = '$username', `password_hash` = '$pwd_hash', `role` = '$role' WHERE `id` = '$id';";
				if(mysqli_query($db, $cmd)){
					$msg = $UPD_SUC;
					$type = 1;
				}else{
					$msg = $UPD_ERR;
					$type = 0;
				}
				$_SESSION['msg'] = $msg;
				$_SESSION['type'] = $type;
				header("Location: admin.php");
			}
		}
	}
?>