<?php 
session_start(); 
require_once '../vendor/autoload.php'; 
use project\Dbase_model; 

 if(!isset($_SESSION['email']) && $_SESSION['role'] !='admin'){
	header('Location: '.'http://localhost/Quiz_application/project_mcqs/');
}
require_once 'components/header.php';
$insert=false;
$obj=new Dbase_model;

if(isset($_POST['subResult'])){
	$data['sub_id']=$_POST['subId'];
	date_default_timezone_set('Asia/Karachi');
	$data['date']=date('Y-m-d H:m:s');
	$data['total_question']=$_POST['totalQus'];
	$data['marks_obtained']=$_POST['marks'];
	$data['user_id']=$_SESSION['user_id'];
	$_SESSION['sub_id']=$data['sub_id'];
	$obj=new Dbase_model;
	if($obj->insert_data2($data,'results'))
		$insert=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="contents">
					<div class="col-12 col-md-10 offset-1">
				<?php if($insert): ?>
					<?php $insert=false;?>
				<div class="alert alert-success">data inserted successfully</div>
				<?php endif ?>
				<?php if(isset($_SESSION['sub_id'])):?>
				<input type="hidden" name="subId" id="subId" value="<?php echo $_SESSION['sub_id'];?>">
			<?php endif ?>
				<input type="hidden" name="userId" id="userId" value="<?php echo $_SESSION['user_id'];?>">
				<table class="table table-bordered" id='tab1'>
					<thead>
						<tr>
							<th>S.no</th>
							<th>Subject</th>
							<th>Date</th>
							<th>Marks</th>
							<th>Questions</th>
							<th>Percent%</th>
							<th>User</th>
						</tr>
					</thead>
					<tbody id='tabData'>
						
					</tbody>
				</table>
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
		var subId='null';
		var userId=$('#userId').val();
		
		$.ajax({
			url:DOMAIN+'/views/Myajax.php',
			type:'post',
			data:{sub_id:subId,user_id:userId},
			success:function(data){
				var results=JSON.parse(data);
				console.log(results);
				$.each(results,function(index,items){
				var percent=Math.floor((items.marks_obtained *100)/items.total_question);
					
					var mydate=items.date.split(' ');
					var userdate=mydate[0].split('-');
					let x='<tr>'+
							'<td>'+items.result_id+'</td>'+
							'<td>'+items.subject+'</td>'+
							'<td>'+userdate[2]+'-'+userdate[1]+'-'+userdate[0]+'</td>'+
							'<td>'+items.marks_obtained+'</td>'+
							'<td>'+items.total_question+'</td>'+
							'<td>'+percent+'%</td>'+
							'<td>'+items.email+'</td>'+
						'</tr>';
					
					$('#tabData').append(x);
					
				});
			}

		})

	});//ready
</script>
</body>
</html>