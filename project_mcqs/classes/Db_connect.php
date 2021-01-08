<?php
namespace project;

class Db_connect {
	public function get_connection(){

			/*$servename='localhost';
			$userName='root';
			$password='';
			$dbname='mydbtest';
		
		$conn= new \PDO("mysql:host=$servename;dbName=$dbname","$userName",$password);
		$conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		return $conn;*/
		
	 //return new \PDO("mysql:host=localhost;dbname=mydbtest","root","",array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

		$conn=mysqli_connect('localhost','root','','quizappdb');
		if($conn){
			return $conn;
		}else{
			echo "not successfully";
		}
	
	}
}


?>