

		
	<div class="modal" id="user_modal">
				
					
		
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 id='cat-h3' class="text text-center color-primary">Edit User</h3>
					
				<button type="button" class="close" data-dismiss='modal'> &times;</button>

				</div>
				
				<div class="modal-body">
					<div class="row">
						
						<div class="col-md-12">
					<form name="form1" id="edit-mcq" onsubmit="return false">
						
						<div class="form-group">
		<input type="hidden" name="table1" id="table1" value="<?php echo $table['Table'] ;?>">
<input type="hidden" name="pk_key" id="pk_key" value="<?php echo $table['Column_name'] ;?>">
					<input type="hidden" name="hideId" id="hideId" value="">
					<label>Fname</label><input type="text" name="fname" id="fname" class="form-control" placeholder="question"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>
			
				
				
					<div class="col-md-6">
						<div class="form-group">
					<label>Lname</label><input type="text" name="lname" id="lname" placeholder="Answer1" class="form-control"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>

				
				
					<div class="col-md-6">
						<div class="form-group">
					<label>Email</label><input type="text" name="email" id="email" placeholder="Answer2" class="form-control"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>


				<div class="col-md-6">
				<div class="form-group">
				<label>password</label><input type="text" name="pass" id="pass" class="form-control" placeholder="Answer3"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>


				<div class="col-md-6">
				<div class="form-group">
					<?php if($_SESSION['role']!=='admin'):?>
				<label>Role</label><input type="text" name="role" id="role" class="form-control" placeholder="Answer4" readonly><small id='bra-error' class="form-text text-muted"></small>
				<?php else:?>
				<label>Role</label><input type="text" name="role" id="role" class="form-control" placeholder="Answer4"><small id='bra-error' class="form-text text-muted"></small>
				<?php endif ?>
				</div></div>
				<div class="col-md-12">
				<div class="form-group">
				<label>Created At</label><input type="text" name="time" id="time" class="form-control" placeholder="Correct Answer" readonly><small id='bra-error' class="form-text text-muted"></small>
				</div></div>
				
				

				</form>
				</div><!--body-->
			</div><!--row2-->
		
			
				<div class="modal-footer">
					<button type="button" class="btn btn-success" name='userBtn1' id='userBtn1'data-dismiss='modal'>Submit</button>
					<button type="button" class="btn btn-secondary" data-dismiss='modal'>close</button>
					
				</div>
			</div><!--content-->
		</div><!--modal-dialog-->
	<!--</div>col12-->
	<!--</div>row-->
	</div><!--modal -->






