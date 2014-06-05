<?php
require_once('init.php');
$statusArray = 0;

if($_POST['statusArray'] !== null){
	$statusArray = $_POST['statusArray'];
	$template['statusArray'] = $statusArray;
}

if($_POST['next']){
	if($conn->selectUnlockRowsAndLock(explode(',', $statusArray))){
		$template['phone']=$conn->oneRowArrayResult['phone'];
		$template['status']=$conn->oneRowArrayResult['statusId'];
		$template['contactId']=$conn->oneRowArrayResult['contactId'];
	}
}
/*
Если получили ID устанавливаем/проверяем статус,если пришел - устанавливаем.
Затем снимаем блокировку
*/
if($cid=$_POST['userId']){
		$conn->setUserId($cid);
		$status=$_POST['status'];
		if( $status !== null && $status >= 0  && $status <=5){
			$template['rs']=$status;
			$conn->chageStatus($status);
		}
		$conn->unsetRowLock();
}  

echo json_encode($template);