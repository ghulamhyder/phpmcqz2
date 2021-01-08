<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Dbase_model; ?>

<?php if(!isset($_SESSION['email']) && $_SESSION['role'] !='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
	exit;
}
	
?>
<?php require_once 'components/header.php';?>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-10 offset-md-1">
			<div class="contents">
				<center>
				<div class="card text-white bg-secondary">
				<div class="card-header">SELECT SUBJECT</div>
				<div class="card-body">
				<h4 class="card-title">SELECT SUBJECT</h4>
				
				
				
				<form name='form1' id='form1' action='view_mcqs2.php' method='post' onsubmit="return true">
					<input type="hidden" name="mytable" id="mytable" value="quiz_subject">
				<div class="form-group" id="myradio">
				
				</div>
				<input type="submit" name="select_sub" id='select_sub' value='View Mcqs' class="btn btn-success" />
				</form>

				
				
			</div>
			</div></center><!--end card-->
				</div>
			</div>
		</div>
	</div>

	<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>
<script type="text/javascript">
	$(document).ready(function(){
		var DOMAIN='http://localhost/Quiz_application/project_mcqs';
		
		
		let table1=$('#mytable').val();
		getvalues();
		function getvalues(){
		$.ajax({
			url:DOMAIN+'/views/Myajax.php',
			type:'post',
			data:{subTab:table1},
			success:function(data){
				var aldata=JSON.parse(data);
				let i=1;
				let x='';
				let y="<strong> ( 0 )</strong>None <input type='radio' class='radio-inline mr-1 p-3' name='choices' id='choices' checked='checked' value=''>";
				$.each(aldata,function(index,val){
					
		 x += "<strong> ( "+i+" )</strong> "+val.subject +" <input type='radio' class='radio-inline mr-1 p-3' name='choices' id='choices' value='"+val.sub_id+"'>";
				i++;
					
				});
				$('#myradio').append(y+x);
			}
		})//end ajax
	}
	
		//$('#select_sub').click(function(){
		
		//let option=$('input[type="radio"]:checked').val();
		//let tab=$('#mytable').val();
		
		
		/*$.ajax({
			url:DOMAIN+'/views/view_mcqs2.php',
			type:'post',
			data:{mySubId:option,mytab:tab},
			success:function(data){
				
			}
		})

	
})*/
		
	
	});//ready func
	
</script>
	
</body>
</html>