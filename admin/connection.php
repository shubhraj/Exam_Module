<?php
try {
	
	$mongo = new Mongo();
	$db = $mongo->exam;	
	//$collection_list = $db->getCollectionNames();
	//$gridFS = $db->getGridFS();
	//$obj = $gridFS->find();
} catch (Exception $e) {echo 'Error connecting';}
?>