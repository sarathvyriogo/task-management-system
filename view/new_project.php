<?php if(!isset($conn)){ include_once '../config/db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-project">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Name</label>
					<input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
				</div>
			</div>
          	<div class="col-md-6">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" id="status" class="custom-select custom-select-sm" required>
						<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
						<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Started</option>
						<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>On-Progress</option>
						<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>On-Hold</option>
						<option value="4" <?php echo isset($status) && $status == 4 ? 'selected' : '' ?>>Over Due</option>
						<option value="5" <?php echo isset($status) && $status == 5 ? 'selected' : '' ?>>Done</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Start Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">End Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>" required>
            </div>
          </div>
		</div>
        <div class="row">
        	<?php if($_SESSION['login_type'] == 1 ): ?>
           <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Project Manager</label>
              <select class="form-control form-control-sm select2" name="manager_id" required>
              	<option></option>
              	<?php 
              	$managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 2 order by concat(firstname,' ',lastname) asc ");
              	while($row= $managers->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
      <?php else: ?>
      	<input type="hidden" name="manager_id" value="<?php echo $_SESSION['login_id'] ?>">
      <?php endif; ?>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Project Team Members</label>
              <select class="form-control form-control-sm select2" multiple="multiple" name="user_ids[]" required>
              	<option></option>
              	<?php 
              	$employees = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 3 order by concat(firstname,' ',lastname) asc ");
              	while($row= $employees->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($user_ids) && in_array($row['id'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="" class="control-label">Description</label>
					<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
						<?php echo isset($description) ? $description : '' ?>
					</textarea>
				</div>
			</div>
		</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-project">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=project_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
// Event handler for form submission
$('#manage-project').submit(function(e){
    e.preventDefault(); // Prevents the default form submission behavior
    start_load(); // Function to initiate a loading indicator

    // AJAX request to handle the project save process
    $.ajax({
        url: '/task-management-system/controller/ajax.php?action=save_project',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp){
            if(resp == 1){
                alert_toast('Data successfully saved', 'success');
                setTimeout(function(){
                    location.href = 'index.php?page=project_list';
                }, 2000);
            }
        }
    });
});

</script>