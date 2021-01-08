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
<?php /*if(isset($_POST['registeruser'])){
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
	
}*/
?>
<?php include_once 'views/components/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
			<div class="contents">
				<h3 class="text text-center">User Registration Form</h3>
				<hr>
				<img src="public/assets/images/user.png" style='width:30%;' class="img-thumbnail mx-auto d-block"><br>
				
				<div id='err'></div>
				<form  name='form1' id='form1' action="register.php" method="post">
					<table>
						<tbody>
				
				<tr class="form-group">
					<input type="hidden" name="regiTab" id="userstable" value='users'>
					<td><label>Fname: </label></td>
                    <td><input type="text" name="fname" id="fname" size="50" placeholder="firstName"></td>
                    
				</tr>
				<tr class="form-group">
                    <td><label for="password">Lname </label></td>
                    <td><input type="text" name="lname" id="lname" size="50" placeholder="LastName"></td>
					
                </tr>
                <tr class="form-group">
                    <td><label for="full_name">Email </label></td>
                    <td><input type="email" name="email" id="email" size="50" placeholder="Email"></td>
                    
                </tr>
                <tr class="form-group">
                    <td><label for="email">Password: </label></td>
                    <td><input type="password" name="pass1" id="pass1" size="50" placeholder="password"></td>
                </tr>
                 <tr class="form-group">
                    <td><label for="email">RePassword: </label></td>
                    <td><input type="password" name="pass2" id="pass2" size="50" placeholder="Re-Password"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="registeruser" id="registeruser"  class='btn btn-primary' value="Register User" /></td>
                    <td><a href="http://localhost/Quiz_application/project_mcqs">Signin</a></td>
                </tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var DOMAIN='http://localhost/Quiz_application/project_mcqs';
			$(document).on('click','#registeruser',function(e){
				e.preventDefault();
				function myfadeout(){
					setTimeout(function(){
			 		$('#err').fadeOut("slow");
			 	},3000);
				}
			 if($('#fname').val()=='' ||
				$('#lname').val()=='' ||
				$('#email').val()=='' ||
				$('#pass1').val()=='' ||
				$('#pass2').val()=='' ){

			 	$('#err').addClass('alert alert-danger');
			 	$('#err').html('Empty Field not allowed');
			 	myfadeout();
			 	

			 }else{

			 	var pass1=$('#pass1').val();
			 	var pass2=$('#pass2').val();

			 	if(pass1.length < 5 || pass1.length > 8){
			 		$('#err').addClass('alert alert-danger');
			 		$('#err').html('minimum chars 5 and maximum 8 allowed');
			 		myfadeout();
			 	}
			 	else if(pass1 != pass2){
			 		$('#err').addClass('alert alert-danger');
			 		$('#err').html('password did not match!');
			 		myfadeout();
			 	}
			 	else{

			 		$.ajax({
			 			url:DOMAIN+'/views/Myajax.php',
			 			type:'post',
			 			data:$('#form1').serialize(),
			 			success:function(data){
			 				
			 					var str=data.trim();
			 				
			 				if(str==='exists'){
			 					$('#err').addClass('alert alert-danger');
			 					$('#err').html('Email alreday exists try another!');
			 					myfadeout();	
			 				}
			 				else if(str==='success'){
			 					$('#err').removeClass('alert alert-danger');
			 					$('#err').addClass('alert alert-success');
			 					$('#err').html('you have been register Successfully!');
			 					$('#err').fadeIn(3000);
			 					$('#fname').val('');
								$('#lname').val('');
								$('#email').val('');
								$('#pass1').val(''); 
								$('#pass2').val('');
			 					myfadeout();
			 					

			 				}
			 				else if(str==='somethingError'){
			 					
			 					$('#err').addClass('alert alert-danger');
			 					$('#err').html('Some thing Error!');
			 					$('#err').fadeIn(3000);
			 					myfadeout();

			 				}


			 			}
			 		})
			 	}

			 }


					
			})

		});
	</script>
</body>
</html>

