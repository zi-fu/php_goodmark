<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id'])){
	$id = $_REQUEST['id'];
	$user_id = $_SESSION['login_id'];

	//いいねチェック
	$goodmark = $db->prepare('SELECT COUNT(*) AS cnt FROM like_mark WHERE liked_post_id=? AND pressed_member_id=?');
	$goodmark->execute(array(
		$id,
		$user_id));
	$goodmark = $goodmark->fetch();

	if ($goodmark['cnt'] === "0") {
		//いいねを記録する
		if (!empty($user_id)) {
			$like =$db->prepare('INSERT INTO like_mark SET liked_post_id=?, pressed_member_id=?');
			$like->execute(array(
				$id,
				$user_id
			));
		}
	}
}

header('Location: index.php');
exit();
?>
