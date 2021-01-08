

<?php
	session_start(); 
	require_once '../vendor/autoload.php'; 
	use project\Dbase_model; 

 if(!isset($_SESSION['email'])){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
	exit;
}
	require_once 'components/header.php';
	$total='';
	$finish=false;
	//if(isset($_SESSION['new_word'])) {unset($_SESSION['question']);};
    if(!isset($_SESSION['question'])){
        $_SESSION['pos']=0;
        $_SESSION['correct']=0;
        
        
       $_SESSION['test_status']='';
        $obj=new Dbase_model();
					$questions=$obj->get_all('mcqs');
					
					$mcq_ids=[];
					if(isset($questions)){
						foreach ($questions as $val){
							$mcq_ids[]=$val['mcq_id'];
						}
				
					}
					shuffle($mcq_ids); 
					
					    $min = 0;
    					$max = (count($mcq_ids)-1)-10;
						$random_index = rand($min, $max);
    					$mcq_ids = array_slice($mcq_ids, $random_index, 10);
    					$mcq_ids=implode(',', $mcq_ids);

    					$questions=$obj->get_all('mcqs',$mcq_ids);
    					shuffle($questions); 

    				    $_SESSION['questions']=$questions;
    				    $total=count($_SESSION['questions']);
    				   

    				     $render=render_question($questions,$_SESSION['pos']);
    				     $_SESSION['question']=$render;
    				    
    				    

    }
    else{
    		if(isset($_POST['check'])){
       				 $radio=$_POST['choices'];
       				 
        			echo $total;
        			exit;
       
      			  if($radio===$_SESSION['questions'][$_SESSION['pos']]['correct_answer']){
          			$_SESSION['correct']++; 
        	}
			        $_SESSION['pos']++;
			 
			        if($_SESSION['pos']>=$total){
			        	$finish=true;
			           // $_SESSION['test_status']='';
			           // $_SESSION['question']='';
			            //$_SESSION['test_status']="<h2>test completed </h2>";
			            //$_SESSION['question']="<h2><p class='text-left mt-3 ml-3'>you got ".$_SESSION['correct']." out of ".count($_SESSION['questions'])."</h2></div>";
			            //echo $_SESSION['test_status'];
			           // echo $_SESSION['question'];
			        	//unset($_SESSION['questions']);
			            unset($_SESSION['question']);
			            unset($_SESSION['pos']);
			            unset($_SESSION['test_status']);
			            //session_destroy();
			            
			            return false;
	 }
        $_SESSION['question']=render_question($_SESSION['questions'],$_SESSION['pos']);
      

        }//if
    }//else
    	if(!empty($_SESSION['test_status']))
     $_SESSION['test_status']="<h2>question ".($_SESSION['pos']+1)." of ".count($_SESSION['questions']);
       
    function render_question($questions,$pos){
    
    $test='';
    $question=$questions[$pos]['statement'];
    $chA=$questions[$pos]['answer1'];
    $chB=$questions[$pos]['answer2'];
    $chC=$questions[$pos]['answer3'];
    $chD=$questions[$pos]['answer4'];

   // $test.="<div class='text-left mt-3 mb-2 ml-5'>";
   $test.="<h3><p class='text-left mt-3 ml-3'>Question:".($pos+1)." ".$question."</p><br>";
    $test.="<br/><input type='radio' name='choices' value='1'>A)".$chA."<br/>";
    $test.="<br/><input type='radio' name='choices' value='2'>B)".$chB."<br/>";
    $test.="<br/><input type='radio' name='choices' value='3'>C)".$chC."<br/>";
    $test.="<br/><input type='radio' name='choices' value='4'>D)".$chD."<br/><br/></div>";
    
    return $test;


}
   ?>
  
  
  	<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			 <?php //echo $_SESSION['test_status'];?>
			<div class="contents">

  	 	<form name="form1" action=""  method='post'>
  	 			<div class='text-left mt-1 mb-1 ml-5'>
				<?php  echo $_SESSION['question']; ?>
    			<input type="submit" name='check' class='btn btn-success mb-5 ml-5' value='sendAns'>
    		</div>
    	</form>
    
	</div>
	</div>
</div>
</div>


  </body>
</html>