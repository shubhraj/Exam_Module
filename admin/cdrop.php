<?php
include 'connection.php';
if(isset($_GET['name'])){
	$temp = $db->selectCollection($_GET['name']);
	$response = $temp->drop();
	header("location: /final1/admin/subconfig.php");
}
?>