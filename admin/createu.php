<head>
<link rel="stylesheet" href="config.css"/>
</head>
<body>
<div class="msg">
<form method="post" action ="createu.php">
<h3>Create New User</h3>
<input type="text" name="rno" placeholder="Enter roll no">
<input type="text" name="name" placeholder="Enter name">
<input type="password" name="password" placeholder="Enter password"><br>
<input type="submit" value="submit">
</form>
<a id="lbutton" href="createu.php?colname=studcol">New Record</a>
<a id="lbutton" href="studconfig.php">Back</a><br><br>
</div>
</body>
<?php
if (isset($_POST['rno'])){
	
	
	
	require 'DBcon.php';
	$mongo = DBConnection::instantiate();
	$collection = $mongo->getCollection('users');
	if(!($collection->findOne(array("rno" =>$_POST['rno'])))){
	
		try {
			$collection->insert(array(
					"rno"=> $_POST["rno"],
					"password"=> $_POST["password"]));
		} catch (MongoCursorException $e) {
			die($e->getMessage());
		}
		echo '<div class="msg">';
		echo 'Users created successfully'."<br><br>";
		echo "Roll no:".$_POST['rno']."<br>";
		echo "Name:".$_POST['name']."<br><br>";
		//echo "Password".$_POST['password']."<br>";
		echo '</div>';
	}else {
		echo "<script type='text/javascript'>";
		echo "alert(\"User already exist\");";
		echo "</script>";
		//header("location:/final1/login.php");
	}

}

?>
