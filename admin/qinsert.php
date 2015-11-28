<?php
include 'connection.php';
$temp = $db->selectCollection($_GET['subject']);
$selsubb = $_GET['subject'];
$temp->insert(array(
		"_id" => $id = new mongoId()
));
header("location: /final1/admin/qupdate.php?id=$id&subject=$selsubb");
?>
