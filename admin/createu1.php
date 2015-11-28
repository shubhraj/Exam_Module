<?php 
function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	return substr(str_shuffle($chars),0,$length);
}
?>	
<?php
if (isset($_POST['submit'])){
	require 'DBcon.php';
	$mongo = DBConnection::instantiate();
	$collection = $mongo->getCollection('users');
	$start = $_POST['start'];
	$end = $_POST['end'];
	$j=0;
	for($i=$start;$i<=$end;$i++){
		
		if(!($collection->findOne(array("rno" =>"$i")))){
			try {
				$collection->insert(array(
					"rno" => "$i",
					"password" =>rand_string(8)
				)); 
				++$j;
			} catch (MongoCursorException $e) {
			die($e->getMessage());
			}
		}
	}
	echo '<div class="msg">';
	if($j==0){
		echo 'No records inserted (alredy exist)';
	}else {
		echo $j." new records inserted";
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
<form method="post" action ="createu1.php">
<h3>Create Users</h3>
<input type="number" name="start" placeholder="starting rool number" required>
<input type="number" name="end" placeholder="ending roll number" required><br>
<input type="submit" name="submit" value="submit">
<br>
<br><br>
</form>
</div>
</body>