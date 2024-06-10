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
		$cmd = "SELECT * FROM `student` WHERE id = '$id'";
		$data = mysqli_query($db, $cmd) or die("get data錯誤");
		$row_array = mysqli_fetch_assoc($data);
		}
		
		$name = $row_array['name'];
		$sex = $row_array['sex'];
		$birthday = $row_array['birthday'];
		$email = $row_array['email'];
		$phone = $row_array['phone'];
		$address = $row_array['address'];
	}else{
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
		<h1 align="center">學生資料管理系統 - 修改資料</h1>
		<button onclick="javascript:location.href='main.php'">回到主畫面</button>
		<form action="db_update.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<table>
				<tr>
					<th>欄位</th>
					<th>資料</th>
				</tr>
				<tr>
					<td>學號</td>
					<td><b><?php echo $id?></b></td>
				</tr>
				<tr>
					<td>姓名</td>
					<td><input type="text" name="name" value="<?php echo $name?>" required="required"></td>
				</tr>
				<tr>
					<td>性別</td>
					<td>
						<input type="radio" name="sex" id="radio" value="M" <?php if($sex == 'M') echo "checked";?>>男
						<input type="radio" name="sex" id="radio" value="F" <?php if($sex == 'F') echo "checked";?>>女
					</td>
				</tr>
				<tr>
					<td>生日</td>
					<td><input type="date" name="birthday" value="<?php echo $birthday?>"required="required"></td>
				</tr>
				<tr>
					<td>電子郵件</td>
					<td><input type="email" name="email" value="<?php echo $email?>" required="required"></td>
				</tr>
				<tr>
					<td>電話</td>
					<td><input type="text" name="phone" value="<?php echo $phone?>" required="required"></td>
				</tr>
				<tr>
					<td>住址</td>
					<td><input type="text" name="address" value="<?php echo $address?>"required="required" size="40"></td>
				</tr>				
			</table>
			<br>
			<button type="submit">修改</button>
		</form>
		</center>
	</body>
</html>

