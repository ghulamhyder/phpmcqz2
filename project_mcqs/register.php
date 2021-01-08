<?php
session_start();
require_once './vendor/autoload.php';

use project\Dbase_model;
//use project\Myclass2;
//use project\Myclass3;
//$regi=new Register();
//$regi->register_user();

	$err['email']='';
	$err['pass']='';
	$err['empty']='';
	$err['success']='';
?>
<?php if(isset($_POST['registeruser'])){
	$data['fname']=$_POST['fname'];
	$data['lname']=$_POST['lname'];
	$data['email']=$_POST['email'];
	$data['pass']=$_POST['pass'];
	$regi=new Dbase_model();


	
	if($regi->check_mail($data['email'])){
		
		$err['email']=1;
}
	elseif(strlen($data['pass']) >= 2 && strlen($data['pass']) <= 8){
		$err['pass']=1;
}
	elseif(empty($data['email']) OR empty($data['pass'])){
		
		$err['empty']=1;
	}
	elseif(empty($err['email']) && empty($err['pass'])){


		if($regi->insert_data($data)){
			$err['success']=1;
			
		}
		
	}
	
}
?>
<?php include_once 'views/components/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
			<div class="contents">
				<h3 class="text text-center">User Registration Form</h3>
				<hr>
				<img src="public/assets/images/user.png" style='width:30%;' class="img-thumbnail mx-auto d-block"><br>
				<?php if(!empty($err['empty'])) :?>
				<div class=" alert alert-danger" role='alert'>Empty Field not allowed</div>
				<?php elseif(!empty($err['email'])):?>
				<div class=" alert alert-danger" role='alert'>Email alreday exists try another</div>
                 
                <?php elseif(!empty($err['pass'])):?>
				<div class=" alert alert-danger" role='alert'>2 to 6 chars</div>
				<?php elseif(!empty($err['success'])):?>
				<div class=" alert alert-success" role='alert'>data inserted successfully</div>
				
				<?php endif ?>
				<form action="register.php" method="post">
					<table>
						<tbody>
				
				<tr class="form-group">
					
					<td><label for="mobile_no">Fname: </label></td>
                    <td><input type="text" name="fname" size="50"/></td>
                    
				</tr>
				<tr class="form-group">
                    <td><label for="password">Lname </label></td>
                    <td><input type="text" name="lname" size="50"/></td>
					
                </tr>
                <tr class="form-group">
                    <td><label for="full_name">Email </label></td>
                    <td><input type="text" name="email" size="50"/></td>
                    
                </tr>
                <tr class="form-group">
                    <td><label for="email">Password: </label></td>
                    <td><input type="text" name="pass" size="50"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="registeruser"  class='btn btn-primary' value="    Register User    " /></td>
                    <td><a href="http://localhost/Quiz_application/project_mcqs">Signin</a></td>
                </tr>
						</tbody>
					</table>

					
					
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>

