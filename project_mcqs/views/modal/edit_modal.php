

		
	<div class="modal" id="edit_modal">
				
					
		
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 id='cat-h3' class="text text-center color-primary">Edit Question</h3>
					
				<button type="button" class="close" data-dismiss='modal'> &times;</button>

				</div>
				
				<div class="modal-body">
					<div class="row">
						
						<div class="col-md-12">
					<form name="form1" id="edit-mcq" onsubmit="return false">
						
						<div class="form-group">
			<input type="hidden" name="table1" id="table1" value="<?php echo $table['Table'];?>" >
		<input type="hidden" name="pk_key" id="pk_key" value="<?php echo $pk_key;?>">
			<input type="hidden" name="hideId" id="hideId" value="">
					<label>Question</label><input type="text" name="mcq" id="mcq" class="form-control" placeholder="question"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>
			
				
				
					<div class="col-md-6">
						<div class="form-group">
					<label>Option1</label><input type="text" name="ans1" id="ans1" placeholder="Answer1" class="form-control"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>

				
				
					<div class="col-md-6">
						<div class="form-group">
					<label>Option2</label><input type="text" name="ans2" id="ans2" placeholder="Answer2" class="form-control"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>


				<div class="col-md-6">
				<div class="form-group">
				<label>Option3</label><input type="text" name="ans3" id="ans3" class="form-control" placeholder="Answer3"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>


				<div class="col-md-6">
				<div class="form-group">
				<label>Option4</label><input type="text" name="ans4" id="ans4" class="form-control" placeholder="Answer4"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>
				<div class="col-md-12">
				<div class="form-group">
				<label>Right_option</label><input type="text" name="right" id="right" class="form-control" placeholder="Correct Answer"><small id='bra-error' class="form-text text-muted"></small>
				</div></div>
				
				

				</form>
				</div><!--body-->
			</div><!--row2-->
		
			
				<div class="modal-footer">
					<button type="button" class="btn btn-success" name='qusBtn1' id='qusBtn1'data-dismiss='modal'>Submit</button>
					<button type="button" class="btn btn-secondary" data-dismiss='modal'>close</button>
					
				</div>
			</div><!--content-->
		</div><!--modal-dialog-->
	<!--</div>col12-->
	<!--</div>row-->
	</div><!--modal -->






