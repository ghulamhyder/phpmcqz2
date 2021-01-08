<?php
require_once '../vendor/autoload.php'; 

use  project\Dbase_model;

$obj=new Dbase_model;


if(isset($_POST['update']) && $_POST['table']){
		$val=$_POST['update'];
		$tableName=$_POST['table'];
		$pk_key=$_POST['pk'];
		$data=$obj->check_mail($tableName,$pk_key,$val);
		if(!empty($data)){
			echo json_encode($data);
		}

}
if(isset($_POST['mcq']) && $_POST['table1']){
			$fields=[

		 			'statement'=>$_POST['mcq'],
		 			'answer1'=> $_POST['ans1'],
		 			'answer2'=> $_POST['ans2'],
		 			'answer3'=> $_POST['ans3'],
		 			'answer4'=> $_POST['ans4'],
		 			'correct_answer'=>$_POST['right'],
		 		];
				
				$pk_key=$_POST['pk_key'];

			if($obj->updateData($_POST['table1'],$fields,["$pk_key ="=>$_POST['hideId']])){
					echo json_encode(["successfully"]);
			}else{
				echo json_encode(["successfully"]);
			}
	}//end $_POST[mcq]
	if(isset($_POST['email']) && isset($_POST['table1']) && isset($_POST['role'])){
			$fields=[

		 			'fname'=>$_POST['fname'],
		 			'lname'=> $_POST['lname'],
		 			'email'=> $_POST['email'],
		 			'password'=> $_POST['pass'],
		 			'role'=> $_POST['role'],
		 			'created_at'=>date('Y-m-d H:m:s'),
		 		];
				
				$pk_key=$_POST['pk_key'];


			if($obj->updateData($_POST['table1'],$fields,["$pk_key ="=>$_POST['hideId']])){
					echo json_encode(["successfully"]);
			}else{
				echo json_encode(["successfully"]);
			}
	}//end $_POST['email']

if(isset($_POST['del_id']) && isset($_POST['table'])){
		$pk_key=$_POST['pk'];
		$data=[
				//'where'=>['mcq_id >='=>$_POST['del_id'],'mcq_id <='=>'xxx']
				'where'=>[$pk_key=>$_POST['del_id']]
			];

			echo $obj->del_data($_POST['table'],$data);exit;
		if($obj->del_data($_POST['table'],$data))
			echo json_encode(["successfully"]);
		else 
			echo json_encode(["notsuccessfully"]); 
		
}
if(isset($_POST['subName']) && isset($_POST['quiz_sub'])){

	$data['subject']=$_POST['subName'];
	$data['total_question']=$_POST['totQus'];
	$stime=explode('T',$_POST['strtime']);
	$etime=explode('T',$_POST['endtime']);
	date_default_timezone_set("Asia/Karachi");
	$data['start_time']=$stime[0].' '.$stime[1];
	$data['end_time']=$etime[0].' '.$etime[1];
	if($obj->insert_data2($data,$_POST['quiz_sub']))
		echo "successfully";
	else 
		echo "unsuccessfully";
}
///////////////////////////add_mcq.php/////////////////////
if(isset($_POST['question']) && isset($_POST['add_mcqsTab'])){
	$data['sub_id']=$_POST['subId'];
	$data['statement']=$_POST['question'];
	$data['answer1']=$_POST['ans1'];
	$data['answer2']=$_POST['ans2'];
	$data['answer3']=$_POST['ans3'];
	$data['answer4']=$_POST['ans4'];
	$data['correct_answer']=$_POST['right'];
	//echo $obj->insert_data2($data,$_POST['add_mcqsTab'];
	if($obj->insert_data2($data,$_POST['add_mcqsTab']))
			return 'successfully';
	else
		return 'unsuccessfully';
}
////////////////////////////register2.php/////////////////////
if(isset($_POST['email']) && isset($_POST['regiTab'])){
	
		$check_mail=$obj->check_mail($_POST['regiTab'],'email',$_POST['email']);
		if(isset($check_mail)){
			echo "exists"; 
		}
		else{
			$hash=password_hash($_POST['pass1'],PASSWORD_BCRYPT,['cost'=>8]);
		$data['fname']=$_POST['fname'];
		$data['lname']=$_POST['lname'];
		$data['email']=$_POST['email'];
		$data['password']=$hash;
		$data['role']='user';
		date_default_timezone_set("Asia/Karachi");
		$data['created_at']=date('Y-m-d H:i:s');

		if($obj->insert_data2($data,$_POST['regiTab']))
			 echo "success";
		else
			echo "somethingError";
	}
}
///////////////////////////choose_subject.php////////////////////////
	if(isset($_POST['subTab'])){
		$arr=$obj->get_all($_POST['subTab']);
		echo json_encode($arr);
	}
	if(isset($_POST['subTab2']) && isset($_POST['subId'])){

		$arr=$obj->check_mail($_POST['subTab2'],'sub_id',$_POST['subId']);
		//echo "<pre>";
		//print_r($arr);
		//echo "</pre>";exit;

		echo json_encode($arr);
		
	}
//////////////////////////viewResult.php by user/////////////////////////
	//sub_id:subId,user_id:userId
	//myjoin($table=null,$fields=null,$keys=null,$where=null
	if(isset($_POST['sub_id']) && isset($_POST['user_id'])){
		$table['table1']='results as r';
		$table['join']='INNER JOIN';
		$table['table2']='quiz_subject as q';
		//$table['join']='INNER JOIN';
		//$table['table3']='users as u';

		$fields=[

			'r.result_id ',
			'r.date',
			'r.marks_obtained',
			'r.total_question',
			'q.subject',
			'u.email'
		];

		$keys=['r.sub_id=q.sub_id','r.user_id=u.user_id'];
		if($_POST['sub_id'] !='null')
		$where=['r.sub_id'=>$_POST['sub_id'],'r.user_id'=>$_POST['user_id']];
		else
			$where=['r.user_id'=>$_POST['user_id']];


		$x=$obj->myjoin($table,$fields,$keys,$where);
		echo json_encode($x);
		

	}
	///////////////////////////mySelect_subject_view.php by admin////////////////////

?>