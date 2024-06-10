<?php
	header("Content-Type:text/html; charset=utf-8");

	$ip = "localhost";
	$user = "root";
	$pwd = "notgonnashowmypassword";
	
	$db = @mysqli_connect($ip, $user, $pwd);
	
	if($db){
		mysqli_query($db, "SET NAMES 'utf8'");
		mysqli_query($db, "SET CHARACTER SET 'utf8'");	
	}else{
		?>
			<div class="error">
				連接伺服器發生錯誤!<br>
				<button class="red" onClick="window.location.reload()">重新整理</button>
			</div>
		<?php
	}
?>