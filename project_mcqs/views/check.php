<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Quiz; ?>

<?php if(!isset($_SESSION['email'])){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
	exit;
}
	
?>
<?php require_once 'components/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
		<div class='text text-white text-right mt-4 mb-3 mytime'></div>
			<div class="contents">
				<?php 
					
				$obj=new Quiz();					 
				$timeout=false;
				  if(!isset($_SESSION['quiz'])):
				  	$_SESSION['pos']=0;
				  	$_SESSION['correct']=0;
				  	$_SESSION['noAtt']=0;
				  	$_SESSION['timeout']=0;
					$questions=$obj->shuffle_mcqz();
					$_SESSION['quiz']=$questions;
				?>
				
	<!-----------------///////////////////////////-------------------->
				<?php else: 
					
					if(isset($_REQUEST['Submit'])):
						
						$radio=$_REQUEST['choices'];
						
						if($radio==$_SESSION['quiz'][$_SESSION['pos']]['correct_answer'])
							$_SESSION['correct']++; 
						elseif($radio=='quiz')
							$_SESSION['noAtt']++;
						$_SESSION['pos']++;
					
						
					elseif(isset($_POST['timeout'])):
							$_SESSION['timeout']++;
							$_SESSION['pos']++;
					endif;
				 endif ?>
	<!------------------------///////////////////////////--------------------->
				<?php if($_SESSION['pos'] >=count($_SESSION['quiz'])):?>
				<div class='text-left mt-1 mb-1 ml-5'>
					<h2>test completed</h2>
				<h3><p class='text-left mt-3 ml-3'>
					<?php $wrong=(count($_SESSION['quiz'])-$_SESSION['correct']); ?>
					<center><h2><?php echo 'Correct='.$_SESSION['correct'];?></h2></center>
					<center><h2><?php echo 'Wrong='.$wrong;?></h2></center>
					<center><h2><?php echo 'NoAttempt='.$_SESSION['noAtt'];?></h2></center>
					<center><h2><?php echo 'Timeout='.$_SESSION['timeout'];?></h2></center>
				<center><h2><?php echo 'Total='.count($_SESSION['quiz']);?></h2></center></p>

				</div>
				<?php $obj->unsetSession(); ?>
				<?php endif ?>
				
			<form name="form1" id='form1' action="check.php" method="post">
					<div class='text-left mt-1 mb-1 ml-5'>
					<h3><p class='text-left mt-3 ml-3'>
Question:<?php echo ($_SESSION['pos']+1).' '.$_SESSION['quiz'][$_SESSION['pos']]['statement'];?></p></h3><hr>
		<br/><input type='radio' name='choices' value='1'>A)
<?php echo $_SESSION['quiz'][$_SESSION['pos']]['answer1'] ;?><br/>
<br/><input type='radio' name='choices' value='2'>B)
<?php echo $_SESSION['quiz'][$_SESSION['pos']]['answer2'] ;?><br/>
<br/><input type='radio' name='choices' value='3'>C)
<?php echo $_SESSION['quiz'][$_SESSION['pos']]['answer3'] ;?><br/>
<br/><input type='radio' name='choices' value='4'>D)
<?php echo $_SESSION['quiz'][$_SESSION['pos']]['answer4'] ;?><br/>
<input type='radio' checked='checked' style='display:none;' value='quiz' name='choices'>
<br><input type='radio' checked='checked' style='display:none;' value='quiz' name='timeout'>
				
<input type="Submit" name="Submit" value='sendAns' class="btn btn-success mt-3 mb-5 ml-1">
				</div>
			</form>	
			</div>
		</div>
	</div>
</div>
	<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>
<?php //jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/time_js.js');?>
<script type="text/javascript">
	
	var x=document.querySelector('.mytime');
	var myform=document.getElementById('form1');
		let timeleft=1*60;
		let sec=timeleft % 60;
	function mytime(){
		
		//math.floor(5.8);
		let min=Math.floor(timeleft/60);
		let sec=timeleft%60;
		if(sec < 10){
			sec='0'+sec;
		}
		if(timeleft <=0){

			clearTimeout(tm);
			
			myform.submit();
				
		}
		else{
				x.innerHTML=min+':'+sec;
				
		}

		timeleft--;
		var tm=setTimeout(function(){mytime()},1000);

	}
	


	
</script>
	
		

		
	
	
</body>
</html>
