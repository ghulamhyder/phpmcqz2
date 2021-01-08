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

<div class="container">
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
			<div class="contents">
				<h3 class="text text-center">Login Form</h3>
				<hr>
				<img src="public/assets/images/login.png"  style='width:30%;' class="img-thumbnail mx-auto d-block"><br>
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
				<form action="index.php" method="post">
						<div class="row">

					<div class="form-group">
					<div class="col-12 col-3">
						<label>Email:</label>
					</div>
					<div class="col-12 col-8">
						<input type="email"  name="email"  size="50"/>
					</div>	
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="password"  name="pass"  size="50"/>
							
					</div>
					<input type="submit" name="loginuser" class='btn btn-primary' value="   Login    " />
					<a href="http://localhost/Quiz_application/project_mcqs/register.php" class="float-right">you have not account yet?</a>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>

