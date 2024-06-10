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
			$dbname = "system";
			$sel = mysqli_select_db($db, $dbname) or die("db連接錯誤");
			if($sel){
				$cmd = "DELETE FROM `users` WHERE `id` = '$id';";
				
				if(mysqli_query($db, $cmd)){
					$msg = $DEL_SUC;
					$type = 1;
				}else{
					$msg = $DEL_ERR;
					$type = 0;
				}
				$_SESSION['msg'] = $msg;
				$_SESSION['type'] = $type;
				header("Location: admin.php");
			}
		}
	}
?>