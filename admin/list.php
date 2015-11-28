
<?php 
include 'connection.php';
?>
<!-- -------------------------------------------------------------- -->
<head>
<link rel="stylesheet" href="list.css"/>
</head>

<?php if (isset($_GET['subject'])):
	$sub =$db->selectCollection($_GET['subject']); 		
	$cursor = $sub->find();
	$tot_que = $cursor->count();
?>
<?php endif;?>
<!-- create new /// remember: 'subject' different variable for each form-------------------------------------------------------------- -->
<?php if(isset($_GET['subject'])):
$sub = $db->createCollection($_GET['subject']);
$cursor = $sub->find();
$tot_que = $cursor->count(); 
?>
<?php endif;?>
<!-- -------------------------------------------------------------- -->
		<?php if ($cursor->count()>0):?>
			<form method="post">
			<div id="home">
			<a href="subconfig.php">Back</a>
				<a href="/final1/admin/qinsert.php?subject=<?php echo $_GET['subject']?>">Add Quetion</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<a href="/final1/admin/cdrop.php?name=<?php echo $_GET['subject']?>">Drop collection</a>
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				SELECTED DATABASE : <b><?php echo $sub?></b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				TOTAL QUETIONS : <b> <?php echo $tot_que?><b>
				
			</div>
				
				
				<br>
				<table>
				<thead>
					<tr>
					<!-- <th width="10%">ID</th> -->
					<th width="40">Quetion</th>
					<th width="10%">Option1</th>
					<th width="10%">Option2</th>
					<th width="10%">Option3</th>
					<th width="10%">Option4</th>
					<th width="5%" >Ans</th>
					<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
				
				<?php foreach ($cursor as $doc):?>
				<tr>
					<!-- <td>
					ID: <?php //echo $doc['_id']?>
					</td> -->
					<td><?php echo $doc['que'];?></td>
					<td><?php echo $doc['o1'];?></td>
					<td><?php echo $doc['o2'];?></td>
					<td><?php echo $doc['o3'];?></td>
					<td><?php echo $doc['o4'];?></td>
					<td style="text-align: center"><?php echo $doc['o0'];?></td>
					<td>
						<a href="/final1/admin/qupdate.php?id=<?php echo $doc['_id'];?>&subject=<?php echo $_GET['subject']?>">Update</a>
						<a href="/final1/admin/qdelete.php?id=<?php echo $doc['_id'];?>&subject=<?php echo $_GET['subject']?>">Delete</a>
	
					</td>
				<?php endforeach;?>
				</tr>
				</tbody>
			</table>
			
		<?php else:?>
		<div class="msg">
		<p>NO data</p>
		SELECTED DATABASE ---> <b><?php echo $sub?></b><br><br><br>
		<a href="/final1/admin/cdrop.php?name=<?php echo $_GET['subject']?>">Drop collection</a>
		<a href="/final1/admin/qinsert.php?subject=<?php echo $_GET['subject']?>">ADD</a>
		</div>
<?php endif;?>
</form>
<!-- -------------------------------------------------------------- -->
	