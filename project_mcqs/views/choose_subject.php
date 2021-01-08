<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Dbase_model; ?>

<?php/* if(!isset($_SESSION['email']) && $_SESSION['role'] !='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
	exit;
}*/
	
?>
<?php require_once 'components/header.php';?>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="contents">
				<center>
				<div class="card text-white bg-secondary">
				<div class="card-header">SELECT SUBJECT</div>
				<div class="card-body">
				<h4 class="card-title">SELECT SUBJECT</h4>
				<input type="hidden" name="mytable" id="mytable" value="quiz_subject">
				<input type="hidden" name="mytable" id="mytable" value="quiz_subject">
				<?php if($_SESSION['role'] === 'admin'):?>
				<form name='form1' id='form1' action='add_mcq.php' method='post'>
					<div class="form-group">
						<select name='sub_mcqs' id='sub_mcqs' class="form-control">
							<option value=''>--Select--</option>
						</select>
					</div>
				<input type="submit" name="select_sub" id='select_sub' value='AddSubject' class="btn btn-success" />
				

				<?php elseif($_SESSION['role'] === 'user'): ?>
					<form name='form1' id='form1' action='dashboard.php' method='post' onsubmit="return true">
				<div class="form-group">
						<select name='sub_mcqs' id='sub_mcqs' class="form-control">
							<option value=''>--Select--</option>
						</select>
					</div>
				<input type="submit" name="select_sub" id='select_sub' value='StarTest' class="btn btn-success" />
				</form>

				<?php  //elseif($_SESSION['view']==='view mcqs') ?>
					<!--<form name='form1' id='form1' action='add_mcq.php' method='post'>
				<div class="form-group">
						<select name='sub_mcqs' id='sub_mcqs' class="form-control">
							<option value=''>--Select--</option>
						</select>
					</div>
					<input type="submit" name="select_view" id='select_view' value='View' class="btn btn-success" />
				</form>-->
				<?php endif ?>
				
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
		var table1=$('#mytable').val();
		
		
		getvalues();
		function getvalues(){
		$.ajax({
			url:DOMAIN+'/views/Myajax.php',
			type:'post',
			data:{subTab:table1},
			success:function(data){
				var aldata=JSON.parse(data);
				//console.log(aldata);
				$.each(aldata,function(index,val){
					$('#sub_mcqs').append(
							$('<option>',{
								value:val.sub_id,
								text:val.subject
							}));
				});
			}
		})//end ajax
	}
	
	$('#select_sub').click(function(){
		//console.log($('#sub_mcqs').val());
		
		//alert($('#sub_mcqs').val());
		
		if($('#sub_mcqs').val()==''){
			alert('empty field not allowed!');
			$('#form1').attr('onsubmit','return false');
			
		}
		else {
			
			$('#form1').attr('onsubmit','return true');

		}
	})

		
	
	});//ready func
	
</script>
	
</body>
</html>