<?php
    include 'connection.php';
	$temp=$db->selectCollection($_GET['subject']);
	$id=$_REQUEST['id'];
	$uprec=array();
	$uprec['que']=$_GET['que'];
	$uprec['o1']=$_GET['o1'];
	$uprec['o2']=$_GET['o2'];
	$uprec['o3']=$_GET['o3'];
	$uprec['o4']=$_GET['o4'];
	$uprec['o0']=$_GET['o0'];
	$temp->update(array('_id'=>new MongoID($id)),$uprec);
    
	header("location: /final1/admin/list.php?subject=".$_GET['subject']);
	/* $cursor=$temp->find();
	 foreach($cursor as $doc)
	 {
	 	echo $doc['que']."<br>";
	 }*/
?>
<!-- <a href="/try3/list.php?subject=<?php echo $_GET['subject'] ?>"><h2>read it</h2></a> -->