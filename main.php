<!DOCTPYE html>
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
	session_start();
	
	if(isset($_SESSION['msg']) && isset($_SESSION['type'])){
		if($_SESSION['type'] == 1){
			echo "<script>showMsg(\"".$_SESSION['msg']."\", 1);</script>";
		}else{
			echo "<script>showMsg(\"".$_SESSION['msg']."\", 0);</script>";
		}
	unset($_SESSION['msg']);
	unset($_SESSION['type']);
	unset($_SESSION['id']);
	}

	if(!isset($_SESSION['username'])){
		header("Location: index.php");
	}
		
	include("db_connect.php");
	
	if($db){
		$dbname = "system";
		$sel = mysqli_select_db($db, $dbname) or die("db連接錯誤");
		if($sel){
			$cmd = "SELECT * FROM `student`";
			$data = mysqli_query($db, $cmd) or die("get data錯誤");
			$count = mysqli_num_rows($data);
		}
	}
	
	if($_SESSION['role'] == "T"){
		$role = "教職員";
	}else{
		$role = "學生";
	}
?>
		<p align="center">
			您目前的登入身分為： <?=$role;?> <?=$_SESSION['username'];?>
			<button onclick="window.location.href='logout.php'">登出</button><br>
			目前資料筆數：<?=$count;?>
			<?php
				if($_SESSION['role'] == "T"){
			?>
			<button onclick="javascript:location.href='add.php'">新增資料</button>
			<button onclick="javascript:location.href='admin.php'">帳號管理</button>
			<?php
				}
			?>
			<table>
				<tr>
					<th>學號</th>
					<th>姓名</th>
					<th>性別</th>
					<th>生日</th>
					<th>電子郵件</th>
					<th>電話</th>
					<th>住址</th>
					<?php
						if($_SESSION['role'] == "T"){
							echo "<th>操作</th>";
						}
					?>
				</tr>
				<?php
					while($row_array = mysqli_fetch_assoc($data)) {
						echo "<tr>";
						echo "<td>".$row_array['id']."</td>";
						echo "<td>".$row_array['name']."</td>";
						
						if($row_array['sex'] == "M"){
							echo "<td>男</td>";
						}else{
							echo "<td>女</td>";
						}
				
						echo "<td>".$row_array['birthday']."</td>";
						echo "<td>".$row_array['email']."</td>";
						echo "<td>".$row_array['phone']."</td>";
						echo "<td>".$row_array['address']."</td>";
				
						if($_SESSION['role'] == "T"){
							echo "<td>";
							echo "<button onclick=\"javascript:location.href='update.php?id=".$row_array['id']."'\">修改</button>";
							echo "<button class=\"red\" onclick=\"javascript:location.href='delete.php?id=".$row_array['id']."'\">刪除</button>";
							echo "</td>";
						}
						
						echo "</tr>";
					}
				?>
			</table>
		</p>
	</body>
</html>

