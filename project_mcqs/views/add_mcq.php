<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Dbase_model; ?>

<?php if(!isset($_SESSION['email']) && $_SESSION['role']!='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
}
?>
	<?php if(isset($_POST['select_sub'])):
		$_SESSION['subId']=$_POST['sub_mcqs'];

	endif ?>
<?php require_once 'components/header.php';?>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="contents">
				<h3 class="text-center" id="subHead"></h3>
				<hr>
				
				<div class="col-md-8 offset-md-2">
					<?php if(!empty($err['field_err'])):?>
					<div class="alert alert-danger" role='alert'>
						please fill correct data
					</div>
				<?php elseif(!empty($err['success'])): ?>
					<div class="alert alert-success" role='alert'>
						question added successfully try another!
					</div>
				<?php endif ?>
				<form name='form1' id='form1' action="add_mcq.php" method="post">
					<div class="form-group">
						<input type="hidden" name="add_mcqsTab" value='mcqs'>
						<input type="hidden" name="subTable" id='subTable' value='quiz_subject'>
						<input type="hidden" name="subId" id='subId' value="<?php echo $_SESSION['subId'];?>">
						<label><strong id='title2'></strong></label>
						<input type="text" name="question" id="question"class="form-control">
					</div>
					<div class="form-group">
						<label>Option1</label>
						<input type="text" name="ans1" id="ans1" class="form-control">
					</div>
					<div class="form-group">
						<label>Option2</label>
						<input type="text" name="ans2" id="ans2" class="form-control">
					</div>
					<div class="form-group">
						<label>Option3</label>
						<input type="text" name="ans3" id="ans3"class="form-control">
					</div>
					<div class="form-group">
						<label>Option4</label>
						<input type="text" name="ans4" id="ans4" class="form-control">
					</div>
					<div class="form-group">
						<label>Correct</label>
						<input type="text" name="right" id="right" class="form-control">
					</div>
					<input type="submit" name="add_mcqs" id='add_mcqs' class="form-control btn-primary">
				</form>
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
			var tab=$('#subTable').val();
			var id=$('#subId').val();
			subTitle();
			function subTitle(){
			$.ajax({
					url:DOMAIN+'/views/Myajax.php',
					type:'post',
					data:{subTab2:tab,subId:id},
					success:function(data){
						var subdata = JSON.parse(data);
						var subTitle=subdata[1].toUpperCase();
						//var title2=subdata[1].charAt(0).toUpperCase()+subdata[1].slice(1);
						var title3=subdata[1].split(" ").map(function(val){
							return val.charAt(0).toUpperCase() + val.slice(1);
						})
						var title2=title3.join(' ');
						
						$('#subHead').html('ADD MCQS OF SUBJECT '+subTitle);
						$('#title2').html('ADD Question of Subject  '+title2);
						
					}
				});
		}
			$(document).on('click','#add_mcqs',function(e){
				e.preventDefault();

				if ($('#question').val() == '' ||
					$('#ans1').val() == '' ||
					$('#ans2').val() == '' ||
					$('#ans3').val() == '' ||
					$('#ans4').val() == '' ||
					$('#right').val() == ''){
					alert('empty field not allowed');
				}
			else{
				$.ajax({
					url:DOMAIN+'/views/myajax.php',
					type:'post',
					data:$('#form1').serialize(),
					success:function(data){
						
						alert('data has been inserted'+data);
						$('#question').val('');
						$('#ans1').val(' ');
						$('#ans2').val(' ');
						$('#ans3').val(' ');
						$('#ans4').val(' ');
						$('#right').val(' ');
					}
				})//ajax
			}

			})//onclick
		});
</script>
</body>
</html>