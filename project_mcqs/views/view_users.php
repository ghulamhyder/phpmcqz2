<?php session_start(); ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php use project\Dbase_model; ?>

<?php if(!isset($_SESSION['email']) && $_SESSION['role'] !='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
}
	
?>
<?php //require_once '../vendor/autoload.php';?>
<?php require_once 'components/header.php';?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="contents">
				<?php 
					$obj=new Dbase_model();

					 $table=$obj->get_pkId_name('users');
					 
					$schema=$obj->schema($table['Table']);
					$rows=$obj->get_all($table['Table']);
					
					
					$data=[

						'tableName'=>$table['Table'],
						'pk_key'=>$table['Column_name']

					  
					  ];
					 
					//echo "<pre>";
					//print_r($data['pk_id']);
					//echo "</pre>";exit;

					$url='http://localhost/Quiz_application/project_mcqs';
					?>
					<?php include_once 'modal/user_modal.php';?>
					<table class="table table-responsive">
						<thead>
							<tr>
						<?php if(isset($schema)) : ?>
							<?php foreach($schema as $val) :?>
							
						<th><?php echo ucfirst(str_replace('_', ' ', $val['Field']))?></th>
								
							<?php endforeach ?>
							
						
						<?php else: ?>
								<th>user_id</th>
								<th>Fname</th>
								<th>Lname</th>
								<th>Email</th>
								<th>Password</th>
								<th>Role</th>
								<th>Created at</th>
								
						
						<?php endif ?>

						<th colspan='10' class="text-center">Action</th>
							</tr>
							</thead>
						

						<tbody>
				<?php foreach ($rows as $val) :?>
					
				<tr>
					<td><?php echo $val['user_id'];?></td>
					<td><?php echo $val['fname'];?></td>
					<td><?php echo $val['lname'];?></td>
					<td><?php echo $val['email'];?></td>
					<td><?php echo $val['password'];?></td>
					<td><?php echo $val['role'];?></td>
					<td><?php echo $val['created_at'];?></td>
					<td><a href='' id="<?php echo $val['user_id'];?>" class="btn btn-danger user-del">Delete</button></td>
					<td><a href='' id="<?php echo $val['user_id'];?>" class="btn btn-success user-edit" data-target='#user_modal'data-toggle='modal'>Edit</a></td>
				</tr>
				<?php  endforeach ?>
			</tbody></table>
				<?php //endif ?>

				
			</div>
		</div>
	</div>
</div>

<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/jquery-3.5.1.min.js');?>
<?php jsLink('http://localhost/Quiz_application/project_mcqs/public/assets/js/bootstrap.min.js');?>
<script type="text/javascript">
	$(document).ready(function(){

		var DOMAIN='http://localhost/Quiz_application/project_mcqs';

$(document).on('click','#userBtn1',function(){
			if( $('#fname').val() ==  '' ||
				$('#lname').val() == '' ||
				$('#email').val() == '' ||
				$('#pass').val() == '' ||
				$('#role').val() == '' ){
				alert('empty data not allowed');
			}else{
				var val1=$('#edit-mcq').serialize();
				$.ajax({
					url:DOMAIN+'/views/Myajax.php',
					type:'post',
					data:val1,
					success:function(data){
						//alert("data updated "+JSON.parse(data));
						console.log(data);
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
				$('#fname').val(arr[1]);
				$('#lname').val(arr[2]);
				$('#email').val(arr[3]);
				$('#pass').val(arr[4]);
				$('#role').val(arr[5]);
				$('#time').val(arr[6]);

			}
		})
}

		$(document).on('click','.user-edit',function(e){
				e.preventDefault();
			$('#user_modal').show();
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
		function deleteData(val1,tableName,pk_key){
			$.ajax({
				url:DOMAIN+'/views/Myajax.php',
				type:'post',
				data:{del_id:val1,table:tableName,pk:pk_key},
				success:function(data){
					//alert("data deleted "+JSON.parse(data));
					console.log(data);
				}
			})
		}
		$(document).on('click','.user-del',function(e){
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
