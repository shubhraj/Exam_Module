<?php
$id =$_GET['id'];
$m = new Mongo();
$db = $m->examdata;
$gridFS = $db->getGridFS();
$obj = $gridFS->findOne(array('_id' => new MongoId($id)));
$chunks = $db->fs->chunks->find(array('files_id'=> $obj->file['_id']))->sort(array('n' => 1));
header('Content-Type: image/jpeg');
foreach ($chunks as $chunk){
	echo $chunk['data']->bin;
}
?>