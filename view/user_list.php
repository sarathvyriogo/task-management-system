<?php include_once '../config/db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_user"><i class="fa fa-plus"></i> Add New User</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$type = array('',"Admin","Project Manager","Employee");
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users order by concat(firstname,' ',lastname) asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td><b><?php echo $type[$row['type']] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	/**
	 * jQuery document ready function to initialize actions on page load.
	 */
	$(document).ready(function () {
	    // Initialize DataTable for the element with id 'list'
	    $('#list').dataTable();

	    // Attach click event to elements with class 'view_user' using event delegation
	    $(document).on("click", ".view_user", function () {
	        // Open a modal to view user details using the uni_modal function
	        uni_modal("<i class='fa fa-id-card'></i> User Details", "view_user.php?id=" + $(this).attr('data-id'));
	    });

	    // Attach click event to elements with class 'delete_user' using event delegation
	    $(document).on("click", ".delete_user", function () {
	        // Confirm user deletion using the _conf function
	        _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')]);
	    });
	});

	/**
	 * Function to delete a user.
	 * @param {number} $id - User ID to be deleted.
	 */
	function delete_user($id) {
	    // Start loading indicator
	    start_load();

	    // Ajax request to delete the user with the specified ID
	    $.ajax({
	        url: '/task-management-system/controller/ajax.php?action=delete_user',
	        method: 'POST',
	        data: { id: $id },
	        success: function (resp) {
	            // If deletion is successful, display a success message and reload the page after a delay
	            if (resp == 1) {
	                alert_toast("Data successfully deleted", 'success');
	                setTimeout(function () {
	                    location.reload();
	                }, 1500);
	            }
	        }
	    });
	}

</script>