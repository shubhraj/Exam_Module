<?php
include 'connection.php';
$temp = $db->selectCollection($_GET['subject']);
if(isset($_GET['id'])){
	$temp->remove(array(
		"_id" => new MongoID($_GET['id'])
	));
	//header("location:/final1/admin/list.php");
	header('location: /final1/admin/list.php?subject='.$_GET['subject']);
}
