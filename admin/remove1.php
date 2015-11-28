
<?php
if (isset($_POST['submit'])){
	require 'DBcon.php';
	$mongo = DBConnection::instantiate();
	$collection = $mongo->getCollection('users');
	$start = $_POST['start'];
	$end = $_POST['end'];
	$j=0;
	for($i=$start;$i<=$end;$i++){
		
		if(($collection->findOne(array("rno" =>"$i")))){
			$collection->remove(array(
				"rno" => "$i"
			));
			++$j;
		}
	}
	echo '<div class="msg">';
	if($j==0){
		echo 'records does not exist';
	}else {
		echo $j." new records removed";
	}
	echo '</div>';
}
?>
<head>
<link rel="stylesheet" href="config.css"/>
</head>
<body>
<a id="lbutton" href="studconfig.php">Back</a><br><br>
<div class="msg">
<form method="post" action ="remove1.php">
<h3>Remove records</h3>
<input type="number" name="start" placeholder="starting rool number" required>
<input type="number" name="end" placeholder="ending roll number" required><br>
<input type="submit" name="submit" value="submit">
<br><br>
</form>
</div>
</body>