<?php 
require 'DBcon.php';
$mongo = DBConnection::instantiate();
$collection = $mongo->getCollection('users');
$cursor = $collection->find();
$tot_records = $cursor->count();
?>
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
<a id="lbutton" href="createu1.php?colname=studcol">ADD STUDENT</a>
<br><br><a id="lbutton" href="remove1.php?colname=studcol">REMOVE STUDENT</a>
</div>
<br>
<div class="contents">
<?php if($tot_records > 0): ?>
<div class="tableadjust">
<table>
<thead><tr><th>Roll no</th><th>Password</th></tr></thead>
<?php foreach($cursor as $doc):?>
<tbody>
<tr height="20"><td><?php echo $doc['rno']; ?></td>
<td><?php echo $doc['password']; ?></td>
</tr>	
<?php endforeach; ?>

</tbody>
</table>
</div>
	<?php else :?>
        <h1>NO DATA</h1>	
  <?php endif;?>
</div>

</body>

</html> 