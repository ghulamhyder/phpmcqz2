<?php

session_start();


if(isset($_SESSION['email'])){
	session_destroy();
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
}







?>