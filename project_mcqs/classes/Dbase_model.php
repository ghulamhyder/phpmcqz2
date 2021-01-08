<?php
namespace project;
//session_start();
 use project\Register_model;

class Dbase_model extends Register_model{

	public function __construct(){

		parent::__construct();
	}



	public function updateData($table,$fields=null,$id=null){

			$update_query = "UPDATE $table SET ";
		if(is_array($fields)){
			foreach ($fields as $key => $val) {
				if($key=='password')
					$val=password_hash($val,PASSWORD_BCRYPT,['cost'=>8]);
				
				if(is_numeric($val)){

					$update_query .= $key .'='. $val.", ";
				}else{
					$update_query .= $key .'='. "'{$val}'," ;
				}
			}
			$update_query=rtrim($update_query,", ")." WHERE ";
			if(is_array($id)){
				foreach ($id as $key => $val) {
					$update_query .= $key ." $val ";
				}
			}

		}
		
		if(mysqli_query($this->model,$update_query)){
			return true;
		}else{
			return false;
		}
}
	public function passHash($email,$pass){
		
		$arr=$this->check_mail('users','email',$email);
		if(!empty($arr)){

			$x=$arr;
			$_SESSION['user_id']=$x[0];
			$_SESSION['fname']=$x[1];
			$_SESSION['lname']=$x[2];
			$_SESSION['email']=$x[3];
			$_SESSION['role']=$x[5];

			return password_verify($pass, $x[4]);
		}

		else{
		 return false;
		}
	}
	public function del_data($table,$data,$id=null){
		$del_query="DELETE FROM ".$table;
		if(is_array($data)){
			if($data['where'] !=null){
				$del_query .= " WHERE ";
				$i=0;
			foreach ($data['where'] as $key => $val) {
				if($i > 0)
					$del_query .= " AND ";

				$operator_arr=explode(' ', $key);
				if(isset($operator_arr[1]))
					$operator=$operator_arr[1];
				else
					$operator="=";	
				$del_query .= "$operator_arr[0] $operator";
				$del_query.= is_numeric($val) ? $val : "'{$val}'";

				$i++;
			}
		}
	}else{
		$del_query .= " WHERE ".$data."=";
		$del_query.= is_numeric($id) ? $id : "'{$id}'";

	}
		return $del_query;exit;
	if(mysqli_query($this->model,$del_query))
			return true;
		else 
			return false;



	}
	
	public function logout(){
		session_destroy();
	}


}


?>