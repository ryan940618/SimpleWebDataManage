<!DOCTPYE html>
<?php
	session_start();
			if(!isset($_SESSION['username'])){
				header("Location: index.php");
			}
			
			if($_SESSION['role'] !== "T"){
				header("Location: main.php");
			}
?>
<html>
	<head>
		<link rel=stylesheet type="text/css" href="style.css">
		<title>學生資料管理系統</title>
		<script src="script.js"></script>
		<meta charset="utf-8">
		<style>*{font-family:"微軟正黑體";}</style>
	</head>
	<body>
		<center>
			<h1 align="center">學生資料管理系統 - 新增帳號</h1>
		<button onclick="javascript:location.href='main.php'">回到主畫面</button>
		<button onclick="javascript:location.href='admin.php'">回到帳號管理</button>
			<form action="admin_db_add.php" method="post">
				<table>
					<tr>
						<th>欄位</th>
						<th>資料</th>
					</tr>
					<tr>
						<td>使用者名稱</td>
						<td><input type="text" name="username" required="required"></td>
					</tr>
					<tr>
						<td>密碼</td>
						<td><input type="password" name="password" required="required"></td>
					</tr>
					<tr>
						<td>身分組</td>
						<td>
							<input type="radio" name="role" value="S" checked>學生
							<input type="radio" name="role" value="T">教職員
						</td>
					</tr>
				</table>
				<button type="submit">新增</button>
			</form>
		</center>
	</body>
</html>