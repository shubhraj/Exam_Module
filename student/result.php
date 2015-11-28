
<?php //if (session_status() == PHP_SESSION_ACTIVE):?>
<?php
$mongo = new Mongo();
$db = $mongo->exam;
$sub = 	$_POST['subject'];
$s = $db ->selectCollection($sub); 		
$cursor = $s->find();
$r=0;
?>

<?php 
foreach ($cursor as $doc){
	foreach($_POST as $key=>$val){
	$k = $doc['_id']."/";	//concated '/' because $doc['id'] not have / at end where $key has
		if ($key == $k){
			if ($val==$doc['o0']){	
				$r++;	
			}
		}
	}
}
echo "<html>";
echo "<head>";
echo '<link rel="stylesheet" href="startexam.css" media="screen" type="text/css" />';
echo "</head>";
echo "<body>";
echo "<div id='result'>";
echo "<h1>$sub</h1>";
echo "<h2>Result :$r</h2>";
echo "</div>";
echo "</body></html>";

//-------------------------------------------
$mongo = new Mongo();
$db = $mongo->result;
$col = 	$_POST['subject'];
$ss = $db ->selectCollection($col);
$ss->insert(array(
				"rno"=>$_POST['rno'],
				"marks"=>$r,
				"saved_at"=> new MongoDate()
));
//-------------------------------------------

require_once 'system/session.php';
require_once 'system/user.php';
$user= new User();
$user->logout();
?>



<?php //else :header('location:/final1/login.php');?>
<?php //endif;?>
