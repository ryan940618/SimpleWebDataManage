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
			$name = $_POST['name'];
			$sex = $_POST['sex'];
			$birthday = $_POST['birthday'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			
			$dbname = "system";
			$sel = mysqli_select_db($db, $dbname) or die("db連接錯誤");
			if($sel){
				$cmd = "INSERT INTO `student` (`name`, `sex`, `birthday`, `email`, `phone`, `address`) VALUES ('$name', '$sex', '$birthday', '$email', '$phone', '$address');";
				if(mysqli_query($db, $cmd)){
					$msg = $ADD_SUC;
					$type = 1;
				}else{
					$msg = $ADD_ERR;
					$type = 0;
				}
				$_SESSION['msg'] = $msg;
				$_SESSION['type'] = $type;
				header("Location: main.php");
			}
		}
	}
?>