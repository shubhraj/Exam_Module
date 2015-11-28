
<head>
<link rel="stylesheet" href="config.css"/>
</head>
<?php
include 'connection.php';
$temp = $db->selectCollection($_GET['subject']);
$tempsub=$_GET['subject'];
$id= $_GET['id'];
$query=array('_id' => new MongoId($_GET['id']));
$cursor=$temp->find($query);
?>
<?php
			if(isset($_GET['save']))
			{
		      $uprec=array('que'=>$_GET['que'],'o1'=>$_GET['o1'],'o2'=>$_GET['o2'],'o3'=>$_GET['o3'],'o4'=>$_GET['o4'],'o0'=>$_GET['o0']);
			  $temp->update(array('_id'=>$_GET['id']),$uprec);
			 /* $doc['que']=$_GET['que'];
			  $doc['o1']=$_GET['o1'];
			  $doc['o2']=$_GET['o2'];
			  $doc['o3']=$_GET['o3'];
			  $doc['o4']=$_GET['o4'];
			  $doc['o0']=$_GET['o0'];
			  	*/		 /* header("location: /examproj/list.php?subject=<?php echo $_GET['subject']?>");*/	
			}	
		?>
<a id="lbutton" href="list.php?subject=<?php echo $_GET['subject']?>">Back</a>
<div class="msg1">
	<!--	<a  href="list.php?subject=<?php echo $_GET['subject']?>"><h2>view List</h2></a>
		--><?php foreach($cursor as $doc):?>
			
			<?php endforeach;?>
    	<!-- = <?php echo $doc['_id']?><br> 
    	$doc['que']=<?php echo $doc['que']?><br>
      	$doc['o1']= <?php echo $doc['o1']?><br>
    	$doc['o2']= <?php echo $doc['o2']?><br>
    	$doc['o3'] =<?php echo $doc['o3']?><br>
    	$doc['o4']= <?php echo $doc['o4'] ?><br>
        $doc['o0']<?php echo $doc['o0'] ?><br>	 
		</br>
		-->
		<form method="get" action="update.php" >
		SUBJECT : <input type="text" name="subject" readonly="readonly" value="<?php echo $tempsub?>" />
		QuetionID : <input type="text" name="id" readonly="readonly" value="<?php echo $id ?>">
		<br>Q:
		<textarea name="que" cols="100" rows="5" ><?php echo $doc['que']?></textarea><br>
		1: <textarea name ="o1" cols="75" rows="3"><?php echo $doc['o1']?></textarea><br>
		2: <textarea name ="o2" cols="75" rows="3"><?php echo $doc['o2']?></textarea><br>
		3: <textarea name ="o3" cols="75" rows="3"><?php echo $doc['o3']?></textarea><br>
		4: <textarea name ="o4" cols="75" rows="3"><?php echo $doc['o4']?></textarea><br>
	    A: <input type="text" name="o0" value="<?php echo $doc['o0']?>"><br>
  		<!--<a href="update.php?subject=<?php echo $_GET['subject']?>&id<?php echo $doc['_id']?>"> -->
  		<input type=submit name="save" value="save">
  		<a id="lbutton" href="/final1/admin/qdelete.php?id=<?php echo $doc['_id'];?>&subject=<?php echo $_GET['subject']?>">Delete</a>
  
</form>
</div>
<!-- ============================================================= -->
<!-- image upload code -->
	<div class="msg">
<b>Upload or select image first:  </b> with img tag<br>

<?php 
$mongo->close();
$m = new Mongo();
$db = $m->examdata;
$gridFS = $db->getGridFS();
$obj = $gridFS->find();
?>

	<?php while ($o = $obj->getNext()):?>
		<?php if(  ($o->file['subject']==$_GET['subject']) &&  ($o->file['qid'] == $_GET['id']) ):?>
			<?php //echo $o->file['_id'];?> 
			<img width=120 height=100 src="/final1/admin/g3.php?id=<?php echo $o->file['_id'];?>">
		<?php endif;?>
	<?php endwhile;?>

	
<form method="post" enctype = "multipart/form-data">
	<input type="file" name="image">
	<input type="submit">
</form>
<?php 
if($_FILES['image']['error'] !==0){
	//echo 'error';
	// error if img upld failure
}else{
	$m = new Mongo();
	$db = $m->examdata;
	$gridFS = $db->getGridFS();
	$filename = $_FILES['image']['name'];
	$filetype = $_FILES['image']['type'];
	$tmpfilepath = $_FILES['image']['tmp_name'];
	$sub = $tempsub;
	$qid = $id;
	$id = $gridFS->storeFile($tmpfilepath,
		array(
			'filename' => $filename,
			'filetype' => $filetype,
			'subject' => $sub,
			'qid' => $qid)
	);
header("location: qupdate.php?id=".$_GET['id']."&subject=".$_GET['subject']);	
}
?>
</div>
<!-- ============================================================= -->		


