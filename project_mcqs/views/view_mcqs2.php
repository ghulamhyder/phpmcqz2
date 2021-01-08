<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Dbase_model; ?>

<?php if(!isset($_SESSION['email']) && $_SESSION['role'] !='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
}
?>
<?php 
	if(isset($_POST['select_sub'])){

		$_SESSION['mysubId']=$_POST['choices'];
		$_SESSION['tabName']=$_POST['mytable'];
}
?>

<?php require_once 'components/header.php';?>




<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="contents">
				<?php 
					$obj=new Dbase_model();
					 $table=$obj->get_pkId_name('mcqs');
					 $pk_key=$table['Column_name'];
					//$schema=$obj->schema($table['Table']);
					
					$questions=$obj->get_all($table['Table']);
					$url='http://localhost/Quiz_application/project_mcqs';
					?>
					<?php include_once 'modal/edit_modal.php';?>
					<table class="table table-responsive">
						<thead>
							<tr>
						<?php if(isset($schema)) : ?>
							<?php foreach($schema as $val) :?>
							
						<th><?php echo ucfirst(str_replace('_', ' ', $val['Field']))?></th>
								
							<?php endforeach ?>
							
						
						<?php else: ?>
								<th>Id</th>
								<th>Question</th>
								<th>Option1</th>
								<th>Option2</th>
								<th>Option3</th>
								<th>Option4</th>
								<th>Correct</th>
								
						
						<?php endif ?>

						<th colspan='10' class="text-center">Action</th>
							</tr>
							</thead>
						<tbody>			
				
					
			</tbody></table>
				

				
			</div>
		</div>
	</div>
</div>

<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>
<script type="text/javascript">
	$(document).ready(function(){

		var DOMAIN='http://localhost/Quiz_application/project_mcqs';
			
				/*$.ajax({
					url:DOMAIN+'/views/Myajax.php',
					type:'post',
					data:val1,
					success:function(data){
						alert("data inserted "+JSON.parse(data));
						//console.log(data);
					}
				})*/
			
		
});

</script>
</body>
</html>
		

	