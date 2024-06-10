<?php
	$id = "";
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
	}
	$LOG_ERR = "帳號或密碼錯誤!";
	$DEL_SUC = "資料" . $id . "刪除成功!";
	$DEL_ERR = "資料" . $id . "刪除失敗!";
	$UPD_SUC = "資料" . $id . "修改成功!";
	$UPD_ERR = "資料" . $id . "修改失敗!";
	$ADD_SUC = "資料新增成功!";
	$ADD_ERR = "資料新增失敗!";
	$INIT_SUC = "初次使用，帳號新增成功，請嘗試登入";
?>