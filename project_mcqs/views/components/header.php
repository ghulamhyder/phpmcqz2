<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!--<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/style.css">-->
	<?php cssLink('http://localhost/Quiz_application/project_mcqs/public/assets/css/bootstrap.min.css');?>
	<?php if(!empty($_SESSION['role'])) :?>
	<?php cssLink('http://localhost/Quiz_application/project_mcqs/public/assets/css/style.css');?>
	<?php else: ?>
	<?php cssLink('http://localhost/Quiz_application/project_mcqs/public/assets/css/style2.css');?>
	<?php endif ?>
</head>
<body>
	<header>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
				<a class="navbar-brand" href="#">Mcqs_Quiz </a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
	
				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#">Disabled</a>
						</li>
						
					</ul>
					<?php if(!empty($_SESSION['email']) && $_SESSION['role']=='user') :?>

					<ul class="navbar-nav text-right">
						<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/views/viewResult.php" class="nav-link text-white">View Result</a>
					</li>
						<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/views/choose_subject.php" class="nav-link text-white">Select Subject</a>
					</li>
						<li class="nav-item pl-8">
						<a href="http://localhost/Quiz_application/project_mcqs/register.php" class="nav-link text-white"><?php echo $_SESSION['fname'];?></a>
					</li>
				</ul>
				<ul class="navbar-nav text-right">

						<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/classes/Logout.php" class="nav-link text-white">Logout</a>
					</li>
					
				</ul>

				<?php elseif (!empty($_SESSION['email']) && $_SESSION['role']=='admin') :?>
					<ul class="navbar-nav text-right">
						<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/views/add_subject.php" class="nav-link text-white">Add Subject</a>
					</li>
						<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/views/choose_subject.php" class="nav-link text-white">Add MCQ</a>
					</li>
					<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/views/mySelect_subject_view.php" class="nav-link text-white">View MCQs</a>
					</li>
					<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/views/view_users.php" class="nav-link text-white">View Users</a>
					</li>
					<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/classes/Logout.php" class="nav-link text-white">Logout</a>
					</li>

				</ul>
				
				
				<?php else : ?>
				<ul class="navbar-nav text-right">
						<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/" class="nav-link text-white">SignIn</a>
					</li>
				</ul>
					<ul class="navbar-nav text-right">
						<li class="nav-item">
						<a href="http://localhost/Quiz_application/project_mcqs/register2.php" class="nav-link text-white">SignUp</a>
					</li>
					</ul>
				<?php endif ?>
				</div>
			</nav>
		</header>