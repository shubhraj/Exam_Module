<html>
<head>
<link rel="stylesheet" href="config.css"/>
</head>
<body>
<div class="nav">
<ul>
<li><a href="/final1/admin/viewresult.php">View Result</a><hr></li>
<li><a href="/final1/admin/studconfig.php">Manage Student</a><hr></li>
<li><a href="/final1/admin/subconfig.php">Manage Subject</a></li>

</ul>
</div>
<br>
<div class="contents">

<form action="viewresult.php" method="get">
<b> View Result</b>
<select name="subject">
<?php $mongo = new Mongo();
$db = $mongo->result;
$collection_list = $db->getCollectionNames();?>
	<?php foreach ($collection_list as $clist):?>
		<option value="<?php echo $clist?>"><?php echo $clist?></option>
	<?php endforeach;?>
</select>
<input type="submit" value="submit" name="submit"/>
</form>
<div class="qe">
<?php 
if (isset($_GET['submit'])){
	$col = $db->selectCollection($_GET['subject']);
	$cursor = $col->find();
	echo "<h4>".$col."</h4>";
	echo "<hr>";
	foreach ($cursor as $doc){
		echo $doc['rno']."  :  ";
		echo $doc['marks']."<br>";
		echo "<hr>";
}
	
}
?>
</div>
</div>
</body>
</html>
