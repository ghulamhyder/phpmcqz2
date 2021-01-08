<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Dbase_model; ?>

<?php if(!isset($_SESSION['email']) && $_SESSION['role']!='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
}
?>


<?php require_once 'components/header.php';?>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="contents">
		<div class="card text-white bg-secondary">
			<div class="card-header">ADD  SUBJECT</div>
			<div class="card-body">
			<h4 class="card-title">Add Subject</h4>
			<form name='form1' id='form1' action="add_subject.php" method="post">
				<div class="container">
				<div class="row">
				<div class="col-12">
			<div class="form-group">
				<label>Subject Name:</label>
				<input type="text" name="subName" id="subName" class="form-control">
			</div></div>
			<div class="col-12 col-md-6">
			<div class="form-group">
				<input type="hidden" name="quiz_sub" id='quiz_sub' value="quiz_subject">
				<label>Total Question</label>
				<input type="number" name="totQus" id="totQus" class="form-control">
			</div></div>
			<div class="col-12 col-md-6">
			<div class="form-group">
				<label> Start Date And Time</label>
				<input type="datetime-local" name="strtime" id="strtime" class="form-control">
			</div></div>
			<div class="col-12">
			<div class="form-group">
				<label>End Date And Time</label>
				<input type="datetime-local" name="endtime" id="endtime" class="form-control">
			</div></div>
			<input type="submit" name="add_sub" id='add_sub' class="form-control btn-primary">
		</div>
		</div>
		</form>
	</div>
</div>
</div>
</div>
</div>
</div>
	<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>
<script type="text/javascript">
	$(document).ready(function(){
		var DOMAIN='http://localhost/Quiz_application/project_mcqs';
		$(document).on('click','#add_sub',function(e){
			e.preventDefault();
			if(	$('#subName').val()=='' ||
				$('#totQus').val()=='' 	||
				$('#strtime').val()=='' ||
				$('#endtime').val()=='' ){
				alert('empty field not allowed!');
		}else{
			$.ajax({
				url:DOMAIN+'/views/myajax.php',
				type:'post',
				data:$('#form1').serialize(),
				success:function(data){
					$('#subName').val('');
					$('#totQus').val('');
					$('#strtime').val('');
					$('#endtime').val('');
					alert('data inserted '+data);
				}
			})
		}
		});
	});
</script>
</body>
</html>