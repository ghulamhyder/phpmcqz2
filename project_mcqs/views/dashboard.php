<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Quiz; ?>

<?php if(!isset($_SESSION['email'])){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
	exit;
}
if(isset($_POST['select_sub'])){
	 $_SESSION['subId']=$_POST['sub_mcqs'];
	 
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
			
				  if(!isset($_SESSION['quiz'])):
				  	$_SESSION['pos']=0;
				  	$_SESSION['correct']=0;
				  	$_SESSION['noAtt']=0;
				  	$_SESSION['timeout']=0;

					$questions=$obj->shuffle_mcqz($_SESSION['subId']);
					//echo "<pre>";
					//print_r($questions);
					//echo "<pre>";exit;
					$_SESSION['quiz']=$questions;
					$_SESSION['subName']=$questions[0]['subject'];
					$_SESSION['subId']=$questions[0]['sub_id'];
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
				<?php if($_SESSION['pos'] >=count($_SESSION['quiz'])):
				 
					$data['totlaQus']=count($_SESSION['quiz']);
					$data['correct']=$_SESSION['correct'];
					$data['noAtt']=$_SESSION['noAtt'];
					$data['timeout']=$_SESSION['timeout'];
					$data['subId']=$_SESSION['subId'];
					echo $obj->finish($data);
					$obj->unsetSession(); 
				 endif ?>
				
			<form name="form1" id='form1' action="dashboard.php" method="post">
					<div class='text-left mt-1 mb-1 ml-5'>
					<strong class="text-center">Subject:</strong><small><?php echo ucfirst($_SESSION['subName']);?></small><br>
					<strong class="text-center">Total Question:</strong><small><?php echo ucfirst(count($_SESSION['quiz']));?></small>
					<h4 class="text-center"><?php echo ucfirst($_SESSION['subName']);?></h4>
					<?php echo $obj->render_question($_SESSION['quiz'],$_SESSION['pos']);?>
					
					<input type="Submit" name="Submit" value='sendAns' class="btn btn-success mb-5 ml-5">
				</div>
			</form>	
			</div>
		</div>
	</div>
</div>
	<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>

<script type="text/javascript">
	$(document).ready(function(){
	//var x=document.querySelector('.mytime');
	//var y=document.getElementById('hidtime');
	//var myform=document.getElementById('form1');
	//var txt=document.getElementById('timetxt');
	console.log($('.mytime').html('hello'));
	
	let timeleft=1*60;
	//let sec=timeleft % 60;
	//x.innerHTML=sec;

	function mytime(){
		
		//math.floor(5.8);
		let min=Math.floor(timeleft/60);
		let sec=timeleft%60;
		if(sec < 10){
			sec='0'+sec;
		}
		if(timeleft <=0){
			clearTimeout(tm);
			$('#form1').submit();
				
	}
		else{
				//x.innerHTML=min+':'+sec;
				$('.mytime').html(min+':'+sec);
				//txt.value=min+':'+sec;
		}
		timeleft--;
		var tm=setTimeout(function(){mytime()},1000);

	}
	
	mytime();

	});
</script>
	
		

		
	
	
</body>
</html>
