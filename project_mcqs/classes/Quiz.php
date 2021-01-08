<?php
namespace project;
use project\Dbase_model; 
class Quiz {

		public function shuffle_mcqz($subId=null){
			  $obj=new Dbase_model();
					//$questions=$obj->get_all('mcqs');
 ////////////////////double table values//////////////////////////////
			  	$selectFields=[
			  		'm.mcq_id',
			  		'm.statement',
			  		'm.answer1',
			  		'm.answer2',
			  		'm.answer4',
			  		'm.correct_answer',
			  		'm.sub_id',
			  		'q.subject'

			  	];
			  		$table['table1']='mcqs as m';
			  		$table['join']=' LEFT JOIN ';
			  		$table['table2']='quiz_subject as q';
			  		$keys='m.sub_id=q.sub_id';
			  		//$where=['m.sub_id IN'=>[1,4]];
			  		//$where=['m.sub_id <='=>2,'m.sub_id >='=>4];
			  		$where=['m.sub_id'=>$subId];
//////////////singleTable values/////////////////////////////////////////////////////////
			  		//$table='mcqs';
			  		//$selectFields=['subject','statement','answer1','answer2'];
			  		//$selectFields=null;
			  		//$keys=null;
			  		//$where=null;
			  		//$where=['m.sub_id <='=>2,'m.sub_id >='=>4];
			  		//$where=['m.sub_id IN'=>[1,4]];
			  		//$where=['m.sub_id'=>4];
			  		

			  		//$fields='count(*)';
			  $testQus=$obj->myjoin($table,$selectFields,$keys,$where);
			  		 
			  		 
					
					$mcq_ids=[];
					if(isset($testQus)){
						foreach ($testQus as $val){
							$mcq_ids[]=$val['mcq_id'];
						}
				
					}
					shuffle($mcq_ids); 
						$min = 0;
    					$max = (count($mcq_ids)-1)-5;
						$random_index = rand($min, $max);

    					$mcq_ids = array_slice($mcq_ids, $random_index, 5);
    					

    					//$mcq_ids=implode(',', $mcq_ids);

    					//$questions=$obj->get_all('mcqs',$mcq_ids);
    					//$keys=['mcq_id IN'=>$mcq_ids];
    					//$myarr=[19,4,5,22,1];
								
									
    				$table['table1']='mcqs as m';
			  		$table['join']=' LEFT JOIN ';
			  		$table['table2']='quiz_subject as q';
			  		$keys='m.sub_id=q.sub_id';
    				$where=['m.mcq_id IN'=>$mcq_ids,'m.sub_id'=>$subId];
    				$questions=$obj->myjoin($table,null,$keys,$where);
    				shuffle($questions); 
					return $questions;
		}

		public function render_question($questions,$pos){
    
			    $test='';
			    $question=$questions[$pos]['statement'];
			    $chA=$questions[$pos]['answer1'];
			    $chB=$questions[$pos]['answer2'];
			    $chC=$questions[$pos]['answer3'];
			    $chD=$questions[$pos]['answer4'];
			    $qusID=$questions[$pos]['mcq_id'];

			   // $test.="<div class='text-left mt-3 mb-2 ml-5'>";
	$test.="<h3><p class='text-left mt-3 ml-3'>Question:".($pos+1)." ".$question."</p><hr>";
	$test.="<br/><input type='radio' name='choices' value='1'>A)".$chA."<br/>";
	$test.="<br/><input type='radio' name='choices' value='2'>B)".$chB."<br/>";
	$test.="<br/><input type='radio' name='choices' value='3'>C)".$chC."<br/>";
	$test.="<br/><input type='radio' name='choices' value='4'>D)".$chD."<br/><br/></div>";
	$test.="<br/><input type='radio' checked='checked' style='display:none;' value='quiz' name='choices'>";
	$test.="<input type='radio' checked='checked' style='display:none;' value='quiz' name='timeout'>";
			    
			    return $test;
	}
	
	public function finish($data){
		 $render="<div class='text-left mt-1 mb-1 ml-5'>
					<h2>test completed</h2>
				<h3><p class='text-left mt-3 ml-3'>
					 
					<center><h2>Correct=".$data['correct']."</h2></center>
					<center><h2>Wrong=".($data['totlaQus']-$data['correct'])."</h2></center>
					<center><h2>NoAttempt=".$data['noAtt']."</h2></center>
					<center><h2>Timeout=".$data['timeout']."</h2></center>
					<center><h2>Total=".$data['totlaQus']."</h2></center>
					</p>
					<form name='form2' id='form2' action='viewResult.php' method='post'>
		<input type='hidden' name='totalQus' id='totalQus' value='".$data['totlaQus']."'>
		<input type='hidden' name='marks' id='marks' value='".$data['correct']."'>
		<input type='hidden' name='subId' id='subId' value='".$data['subId']."'>
					<center><input type='submit' name='subResult' id='subResult' value='SaveResult' class='btn btn-success'></center>
			</form>
					</div>";
			return $render;
		 
	}
	public function unsetSession(){
			unset($_SESSION['quiz']);
			unset($_SESSION['pos']);
			unset($_SESSION['correct']);
			unset($_SESSION['noAtt']);
			unset($_SESSION['subName']);
			unset($_SESSION['subId']);
			exit;
	}
	

}

?>






