
	<?php //if (session_status() == PHP_SESSION_ACTIVE):?>	
	<?php $sub=$_GET['subject'];?>
	<?php if (isset($sub)){
	require 'DBconStud.php';
	$mongo = DBConnection::instantiate();
	$s = $mongo->selCollection($_GET['subject']); 		
	$cursor = $s->find();
	}
	?>
	<?php if ($cursor->count()>0):?>
		<html>
		<head>
		<link rel="stylesheet" href="startexam.css" media="screen" type="text/css" />
		<script type="text/javascript">

		function countDown(secs, elem)
        {
            var element = document.getElementById(elem);
            element.innerHTML = "<b>"+secs+" Minutes Left</b>";
                if(secs < 1) {
                    document.quiz.submit();
                }
                else
                {
                    secs--;
                    setTimeout('countDown('+secs+',"'+elem+'")',60000); //1000 for 1 sec
                }
            }

            function validate() {
                return true;
            }
		</script>
		
		</head>
		<body>
		<div id="status"></div> <!-- ------------display timer -->
            <script type="text/javascript">countDown(10,"status");</script>
		<form name="quiz" onsubmit="return validate()" method="post" action="result.php">
		<input type="hidden" name="rno" value=<?php echo $_GET['id'];?>>
		<input type="hidden" name="subject" value=<?php echo $sub;?>> <!--  for result calc -->
		<div id="quefield">
		
		
		<?php $i=1; foreach ($cursor As $doc):?>
		<fieldset>
			<legend>Quetion: <?php echo $i++;?></legend>
			<div id="q1"><?php echo $doc['que'];?><br></div>
			<div id="o1">A<input type="radio" value="1" name=<?php echo $doc['_id']?>/><?php echo $doc['o1'];?></div>			
			<div id="o2">B<input type="radio" value="2" name=<?php echo $doc['_id']?>/><?php echo $doc['o2'];?></div>
			<div id="o3">C<input type="radio" value="3" name=<?php echo $doc['_id']?>/><?php echo $doc['o3'];?></div>
			<div id="o4">D<input type="radio" value="4" name=<?php echo $doc['_id']?>/><?php echo $doc['o4'];?></div>			
		</fieldset>
		<?php endforeach;?>
		
		</div>
		<button id="bsub">Submit</button>
		</form>
		</body>
	<?php else:?>
		<p>NO data</p>
	<?php endif;?>
	</html>
<?php //endif;?>