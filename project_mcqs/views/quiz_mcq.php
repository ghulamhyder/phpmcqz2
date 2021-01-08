

<?php
	session_start(); 
	require_once '../vendor/autoload.php'; 
	 use project\Quiz;

 if(!isset($_SESSION['email'])){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
	exit;
}
	require_once 'components/header.php';
	
	$finish=false;
	$obj=new Quiz();
	//if(isset($_SESSION['new_word'])) {unset($_SESSION['question']);};
    if(!isset($_SESSION['question'])){
        $_SESSION['pos']=0;
        $_SESSION['correct']=0;
        $_SESSION['test_status']='';
		$questions=$obj->shuffle_mcqz();
        $_SESSION['questions']=$questions;
        $render=$obj->render_question($questions,$_SESSION['pos']);
		$_SESSION['question']=$render;
    }

    else{
    		if(isset($_REQUEST['check'])){
       				 $radio=$_REQUEST['choices'];
       				 
       				 
        	if($radio===$_SESSION['questions'][$_SESSION['pos']]['correct_answer']){
          			$_SESSION['correct']++; 
        	}
			        $_SESSION['pos']++;
			 
			      if($_SESSION['pos']>=count($_SESSION['questions'])){
			        	$obj->finish();
	 				}

        $_SESSION['question']=$obj->render_question($_SESSION['questions'],$_SESSION['pos']);
      

        }//if
    }//else
    	
     $_SESSION['test_status']="<h2>question ".($_SESSION['pos']+1)." of ".count($_SESSION['questions']);
       
    
   ?>
  
  
  	<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			 <?php echo $_SESSION['test_status'];?>
			<div class="contents">

  	 	<form name="form1" action=""  method='GET'>
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