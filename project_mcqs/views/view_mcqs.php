<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Dbase_model; ?>

<?php if(!isset($_SESSION['email']) && $_SESSION['role'] !='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
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
					
				<?php if(isset($questions)) : ?>
					
						<tbody>
				<?php foreach ($questions as $qus) :?>
					
				<tr>
					<td><?php echo $qus['mcq_id'];?></td>
					<td><?php echo $qus['statement'];?></td>
					<td><?php echo $qus['answer1'];?></td>
					<td><?php echo $qus['answer2'];?></td>
					<td><?php echo $qus['answer3'];?></td>
					<td><?php echo $qus['answer4'];?></td>
					<td><?php echo $qus['correct_answer'];?></td>
					<td><a href='' id="<?php echo $qus['mcq_id'];?>" class="btn btn-danger del-data">Delete</button></td>
					<td><a href='' id="<?php echo $qus['mcq_id'];?>" class="btn btn-success edit-data" data-target='#edit_modal'data-toggle='modal'>Edit</a></td>
				</tr>
				<?php  endforeach ?>
			</tbody></table>
				<?php endif ?>

				
			</div>
		</div>
	</div>
</div>

<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>
<script type="text/javascript">
	$(document).ready(function(){

		var DOMAIN='http://localhost/Quiz_application/project_mcqs';


			
		
		$(document).on('click','#qusBtn1',function(){
			if( $('#mcq').val() ==  '' ||
				$('#ans1').val() == '' ||
				$('#ans2').val() == '' ||
				$('#ans3').val() == '' ||
				$('#ans4').val() == '' ||
				$('#right').val()==''){
				alert('empty data not allowed');
			}else{
				var val1=$('#edit-mcq').serialize();
				$.ajax({
					url:DOMAIN+'/views/Myajax.php',
					type:'post',
					data:val1,
					success:function(data){
						alert("data inserted "+JSON.parse(data));
						//console.log(data);
					}
				})
			}
		})


		function editData_fetch(val1,tableName,pk_key){

		$.ajax({
			url:DOMAIN+'/views/Myajax.php',
			type:'post',
			data:{update:val1,table:tableName,pk:pk_key},
			success:function(data){
				var arr=JSON.parse(data);
				//console.log(arr);
				$('#hideId').val(arr[0]);
				$('#mcq').val(arr[1]);
				$('#ans1').val(arr[2]);
				$('#ans2').val(arr[3]);
				$('#ans3').val(arr[4]);
				$('#ans4').val(arr[5]);
				$('#right').val(arr[6]);


			}
		})
}

		$(document).on('click','.edit-data',function(e){
				e.preventDefault();
			$('#edit_modal').show();
			var val1=$(this).attr('id');
			var tableName=$('#table1').val();
			var pk_key=$('#pk_key').val();
			editData_fetch(parseInt(val1),tableName,pk_key);
		});
///////////////////////////////////////////////////////////		
///////////////////////////////////////////////////////////
///////////////////////////End of DataUpdate//////////////
//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
		function deleteData(id,tableName,pk_key){
			$.ajax({
				url:DOMAIN+'/views/Myajax.php',
				type:'post',
				data:{del_id:id,table:tableName,pk:pk_key},
				success:function(data){
					//alert("data deleted "+JSON.parse(data));
					console.log(data);
				}
			})
		}
		$(document).on('click','.del-data',function(e){
				e.preventDefault();
			var val1=$(this).attr('id');
			var tableName=$('#table1').val();
			var pk_key=$('#pk_key').val();
			if(confirm("Are you sure you want to delete mcq_id "+val1)){
			deleteData(parseInt(val1),tableName,pk_key);
		}
		});
	});
</script>

</body>
</html>
