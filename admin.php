

<?php
if(isset($_POST['submit'])){
	$mongo = new Mongo();
	$db = $mongo->examdata;
	$ad = $db->admin;
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!($ad->findOne(array("username" =>md5("admin"))))){
		$ad->insert(array(
				"username"=>md5("admin"),
				"password"=>md5("admin")
		));
	}
	else{
			$query = array(
					'username'=>md5($username),
					'password'=>md5($password)
			);
				if (($ad->findOne($query))){
					header("location:admin/viewresult.php");
					exit;
				}else {
					$er = "Login failed...";
				}
	}
}
?>
<html>
<head>
  <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css" media="screen" type="text/css" />
</head>
<body>
	<div class="loginform">
			<h1>Online Exam</h1>
			<h2>Administrator Login</h2>
			<form action="admin.php" method="post"><br>
			<input type="text" placeholder="Username" name="username" autocomplete="off" required>
			<input type="password" placeholder="Password" name="password" required>
			<input name="submit" type="submit" value="Login" /><br>
			<p><?php echo $er;?></p>
			</form>
	</div>
</body>
</html>
