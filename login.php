<?php
require 'system/session.php';
require 'system/user.php';
if(isset($_POST['submit'])){
	$user = new User();
	$username = $_POST['username'];
	$password = $_POST['password'];
		if ($user->authenticate($username, $password)){
			$mongo = new Mongo();
			$db = $mongo->result;
			$col = 	$_POST['subject'];
			$ss = $db ->selectCollection($col);
			if(!($ss->findOne(array("rno" =>$_POST['username'])))){
				header("location:/final1/student/startexam.php?id=".$username."&subject=".$_POST['subject']);
			}else {
				echo "<script type='text/javascript'>";
				echo "alert(\"already given the exam\");";
				echo "</script>";
				//header("location:/final1/login.php");
			}
		}else {
			$er = "Login failed...";
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
			<h2>Student login</h2>
			<form action="login.php" method="post">
			<input type="text" placeholder="Username" name="username" autocomplete="off" required>
			<input type="password" placeholder="Password" name="password" required>
			<select name="subject">
			<?php 	$mongo = new Mongo();
					$db = $mongo->exam;	
					$collection_list = $db->getCollectionNames();
					foreach ($collection_list as $clist):?>
						<option value="<?php echo $clist?>"><?php echo $clist?></option>
			<?php endforeach;?>
			</select>
			<input name="submit" type="submit" value="Login" /><br>
			<p><?php echo $er;?></p>
			</form>
	</div>
</body>
</html>


