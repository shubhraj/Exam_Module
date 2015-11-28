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


<?php 
include 'connection.php';
$collection_list = $db->getCollectionNames();
?>
<div class="contents"><br>
<fieldset>
<form method="get" action="list.php">
<b>Select Subject :</b>
<select name="subject">	
	<?php foreach ($collection_list as $clist):?>
		<option value="<?php echo $clist?>"><?php echo $clist?></option>
	<?php endforeach;?>
</select>
<input type="submit" name="">
</form>

<form method="get" action="list.php">
		<b>Create Subject :</b>
		<input type="text" name="subject" placeholder="enter subject name" required>
<input type="submit" name="" >
</form>
</fieldset>
</div>