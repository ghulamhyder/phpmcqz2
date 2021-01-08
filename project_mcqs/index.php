<?php
session_start();
require_once './vendor/autoload.php';

use project\Dbase_model;

$regi=new Dbase_model();
	if(isset($_POST['loginuser'])){

		$data['email']=$_POST['email'];
		$data['pass']=$_POST['pass'];
		$ulogin=new Dbase_model();
	
	
	if(!empty($data['pass']) && strlen($data['pass']) > 2 && strlen($data['pass']) <=8){

		

	if($ulogin->passHash($data['email'],$data['pass'])){

		if(!empty($_SESSION['email']) && $_SESSION['role']!='user'){
			header('Location: '.'views/add_subject.php');
			exit;
		}
	header('Location: '.'views/choose_subject.php');
		exit;
		//echo "hello";exit;
}else{
	$err['err1']=1;
}

		}

	else{

	$err['err2']=1;
	}


	}

?>


<?php include_once 'views/components/header.php';?>
<div class="container mycont">
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3 box1">
			<div class="row">
				<div class="col-12 col-sm-6 offset-3">
					<h2 class='myhead'>Login Form</h2>
					<hr>
					<img src="public/assets/images/login.png">
					<?php if(!empty($err['err1'])):?>
						<div class="alert alert-danger" role='alert'>	
							<small style='color: red;'>2 to 6 chars</small>
						</div>
				<?php endif ?>
				<?php if(!empty($err['err2'])):?>
						<div class="alert alert-danger" role='alert'>	
							<small style='color: red;'>Email or Password incorrect</small>
						</div>
				<?php endif ?>
				</div>
				
			</div><!--closeRow1--->
			<form name='form1' action="" method="post">
			<div class="row">
				<div class="col-12 col-sm-3 title">Email Address:</div>
				<div class="col-12 col-sm-9">
					<input type="email" name="email" class="form-control" placeholder="Email" />
				</div>
			</div><!--closeRow2--->
			<div class="row">
				<div class="col-12 col-sm-3 title">Password:</div>
				<div class="col-12 col-sm-9">
					<input type="password" name="pass" class="form-control" placeholder="Password" />
				</div>
			</div><!--closeRow3-->
			<div class="row">
				<div class="col-12 col-sm-3"></div>
				<div class="col-12 col-sm-9 btn1">
					<input type="submit" name="loginuser" class="btn btn-success mybtn" value='Login'>
					<a href="http://localhost/Quiz_application/project_mcqs/register.php" class="float-right already">you have not account yet?</a>
				</div>

			</div><!--closeRow4-->

		</form>
		</div>
	</div><!--rowmain -->
</div>
</body>
</html>