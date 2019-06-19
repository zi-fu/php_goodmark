<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id'])){
    $id = $_REQUEST['id'];

	//いいねチェック
	$messages = $db->prepare('SELECT * FROM posts WHERE id=?');
	$messages->execute(array($id));
	$message = $messages->fetch();
	$user_id = $message['member_id'];

    if ($message['member_id'] == $_SESSION['id']){
        //削除する
        $del = $db->prepare('DELETE FROM like_mark WHERE liked_post_id=? AND pressed_member_id=?');
        $del->execute(array($id,$user_id));
    }
}

header('Location: index.php');
exit();
?>