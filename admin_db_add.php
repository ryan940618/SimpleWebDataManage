<?php
	session_start();
		if(!isset($_SESSION['username'])){
			header("Location: index.php");
		}
		
		if($_SESSION['role'] !== "T"){
			header("Location: main.php");
		}

	include("db_connect.php");
	include("messages.php");
	if($db){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = $_POST['username'];
			$role = $_POST['role'];
			$password = $_POST['password'];
			$pwd_hash = password_hash($password, PASSWORD_BCRYPT);
			
			$dbname = "system";
			$sel = mysqli_select_db($db, $dbname) or die("db連接錯誤");
			if($sel){
				$cmd = "INSERT INTO `users` (`username`, `password_hash`, `role`) VALUES ('$username', '$pwd_hash', '$role');";
				if(mysqli_query($db, $cmd)){
					$msg = $ADD_SUC;
					$type = 1;
				}else{
					$msg = $ADD_ERR;
					$type = 0;
				}
				$_SESSION['msg'] = $msg;
				$_SESSION['type'] = $type;
				header("Location: admin.php");
			}
		}
	}
?>