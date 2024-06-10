<html>
	<head>
		<link rel=stylesheet type="text/css" href="style.css">
		<title>學生資料管理系統</title>
		<script src="script.js"></script>
		<meta charset="utf-8">
		<style>*{font-family:"微軟正黑體";}</style>
	</head>
	<body>
		<h1 align="center">學生資料管理系統</h1>
		<?php
			header("Content-Type:text/html; charset=utf-8");
			include("db_connect.php");
			include("messages.php");
			$error = 0;
			if($db){
				session_start();
				
				if(isset($_SESSION['username'])){
					header("Location: main.php");
				}
 
		
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$username = $_POST['username'];
					$password = $_POST['password'];
					$dbname = "system";
					$sel = mysqli_select_db($db, $dbname);
					if($sel){
						$cmd = "SELECT * FROM users WHERE role = 'T'" ;
						$count = mysqli_query($db, $cmd);
						$count = mysqli_num_rows($count);
						
						if($count == 0){
							$pwd_hash = password_hash($password, PASSWORD_BCRYPT);
							$cmd = "INSERT INTO `users` (`username`, `password_hash`, `role`) VALUES ('$username', '$pwd_hash', 'T');";
							mysqli_query($db, $cmd);
							echo "<script>showMsg('" . $INIT_SUC . "', '1');</script>";
						}else{
							$cmd = "SELECT password_hash FROM users WHERE username = '$username'";
							$pwd_hash = mysqli_query($db, $cmd);
							$pwd_hash = $pwd_hash->fetch_array()[0] ?? '';
				
							$cmd = "SELECT role FROM users WHERE username = '$username'";
							$role = mysqli_query($db, $cmd);
							$role = $role->fetch_array()[0] ?? '';
						
							if(password_verify($password, $pwd_hash)){
								$_SESSION['username'] = $username;
								$_SESSION['role'] = $role;
								header("Location: main.php");
								exit();
							}else{
								echo "<script>showMsg('" . $LOG_ERR . "', '0');</script>";
							}
						}
					}else{
						$error = 1;
						?>
							<div class="error">
								連接資料庫發生錯誤!<br>
								<button class="red" onClick="window.location.reload()">重新整理</button>
							</div>
						<?php
					}
				}
				
				if(!$error == 1){
		?>
		<form class="log" align="center" method="post" action="">
			使用者名稱<input type="text" name="username" placeholder="使用者名稱" required><br>
			密碼<input type="password" name="password" placeholder="密碼" required><br>
			<button class="login" type="submit">登入</button>
		</form>
		<?php
				}
				mysqli_close($db);
			}
		?>
	</body>
</html>