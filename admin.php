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
		
	if($_SESSION['role'] !== "T"){
		header("Location: main.php");
	}
	
	include("db_connect.php");
	
	if($db){
		$dbname = "system";
		$sel = mysqli_select_db($db, $dbname) or die("db連接錯誤");
		if($sel){
			$cmd = "SELECT * FROM `users`";
			$data = mysqli_query($db, $cmd) or die("get data錯誤");
			$count = mysqli_num_rows($data);
		}
	}
?>

<p align="center">
	<button onclick="window.location.href='logout.php'">登出</button>
	<button onclick="window.location.href='main.php'">回到主畫面</button><br>
	目前資料筆數：<?=$count;?>
	<button onclick="javascript:location.href='reg.php'">新增帳號</button>

		<table>
			<tr>
				<th>編號</th>
				<th>使用者名稱</th>
				<th>身分組</th>
				<th>操作</th>
			</tr>
		<?php
			while($row_array = mysqli_fetch_assoc($data)) {
				echo "<tr>";
				echo "<td>".$row_array['id']."</td>";
				echo "<td>".$row_array['username']."</td>";
				
				if($row_array['role'] == "T"){
					echo "<td>教職員</td>";
				}else{
					echo "<td>學生</td>";
				}
				echo "<td>";
					echo "<button onclick=\"javascript:location.href='admin_update.php?id=".$row_array['id']."'\">修改</button>";
					if($row_array['username'] !== $_SESSION['username']){
						echo "<button class=\"red\" onclick=\"javascript:location.href='admin_delete.php?id=".$row_array['id']."'\">刪除</button>";
					}else{
						echo "<button class=\"disabled\">刪除</button>";
					}
					echo "</td>";
				echo "</tr>";
			}
		?>
		</table>
		</p>
	</body>
</html>

