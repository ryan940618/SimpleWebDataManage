<!DOCTPYE html>
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
		$dbname = "system";
		$sel = mysqli_select_db($db, $dbname) or die("db連接錯誤");
	}
	
	if(@$_GET['id']){
		$id = $_GET['id'];
		
		if($sel){
		$cmd = "SELECT * FROM `users` WHERE id = '$id'";
		$data = mysqli_query($db, $cmd) or die("get data錯誤");
		$row_array = mysqli_fetch_assoc($data);
		}
		
		$username = $row_array['username'];
		$role = $row_array['role'];
	}else{
		header("Location: admin.php");
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
		<h1 align="center">學生資料管理系統 - 修改資料</h1>
		<button onclick="javascript:location.href='main.php'">回到主畫面</button>
		<button onclick="javascript:location.href='admin.php'">回到帳號管理</button>
		<form action="admin_db_delete.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<table>
				<tr>
					<th>欄位</th>
					<th>資料</th>
				</tr>
				<tr>
					<td>編號</td>
					<td><b><?php echo $id?></b></td>
				</tr>
				<tr>
					<td>使用者名稱</td>
					<td><?php echo $username?></td>
				</tr>
				<tr>
					<td>身分組</td>
					<td>
						<?php
							if($role == "T"){
								echo "教職員";
							}else{
								echo "學生";
							}
						?>
					</td>
				</tr>			
			</table>
			<button class="red" type="submit">刪除</button>
		</form>
		</center>
	</body>
</html>

