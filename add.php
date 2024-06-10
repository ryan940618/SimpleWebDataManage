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
			<h1 align="center">學生資料管理系統 - 新增資料</h1>
			<button onclick="javascript:location.href='index.php'">回到主畫面</button>
			<form action="db_add.php" method="post">
				<table>
					<tr>
						<th>欄位</th>
						<th>資料</th>
					</tr>
					<tr>
						<td>姓名</td>
						<td><input type="text" name="name" required="required"></td>
					</tr>
					<tr>
						<td>性別</td>
						<td>
							<input type="radio" name="sex" value="M" checked>男
							<input type="radio" name="sex" value="F">女
						</td>
					</tr>
					<tr>
						<td>生日</td>
						<td><input type="date" id="date" name="birthday" placeholder="格式為：2015-01-01" required="required"></td>
					</tr>
					<tr>
						<td>電子郵件</td>
						<td><input type="email" name="email" required="required"></td>
					</tr>
					<tr>
						<td>電話</td>
						<td><input type="text" name="phone" required="required"></td>
					</tr>
					<tr>
						<td>住址</td>
						<td><input type="text" name="address" required="required" size="40"></td>
					</tr>
				</table>
				<button type="submit">新增</button>
			</form>
		</center>
	</body>
</html>

<?php
	echo "<script>initdate();</script>";
?>
