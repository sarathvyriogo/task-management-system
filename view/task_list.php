<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th>Task</th>
						<th>Project Started</th>
						<th>Project Due Date</th>
						<th>Project Status</th>
						<th>Task Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = "";
					if($_SESSION['login_type'] == 2){
						$where = " where p.manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
					}
					
					$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
					$qry = $conn->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM task_list t inner join project_list p on p.id = t.project_id $where order by p.name asc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
						$tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['pid']}")->num_rows;
		                $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['pid']} and status = 3")->num_rows;
						$prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
		                $prog = $prog > 0 ?  number_format($prog,2) : $prog;
		                if($row['pstatus'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
		                if($cprog > 0)
		                  $row['pstatus'] = 2;
		                else
		                  $row['pstatus'] = 1;
		                elseif($row['pstatus'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
		                $row['pstatus'] = 4;
		                endif;


					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td>
							<p><b><?php echo ucwords($row['pname']) ?></b></p>
						</td>
						<td>
							<p><b><?php echo ucwords($row['task']) ?></b></p>
							<p class="truncate"><?php echo strip_tags($desc) ?></p>
						</td>
						<td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
						<td class="text-center">
							<?php
							  if($stat[$row['pstatus']] =='Pending'){
							  	echo "<span class='badge badge-secondary'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='Started'){
							  	echo "<span class='badge badge-primary'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='On-Progress'){
							  	echo "<span class='badge badge-info'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='On-Hold'){
							  	echo "<span class='badge badge-warning'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='Over Due'){
							  	echo "<span class='badge badge-danger'>{$stat[$row['pstatus']]}</span>";
							  }elseif($stat[$row['pstatus']] =='Done'){
							  	echo "<span class='badge badge-success'>{$stat[$row['pstatus']]}</span>";
							  }
							?>
						</td>
						<td>
                        	<?php 
                        	if($row['status'] == 1){
						  		echo "<span class='badge badge-secondary'>Pending</span>";
                        	}elseif($row['status'] == 2){
						  		echo "<span class='badge badge-primary'>On-Progress</span>";
                        	}elseif($row['status'] == 3){
						  		echo "<span class='badge badge-success'>Done</span>";
                        	}
                        	?>
                        </td>
                            <td class="text-center">
								<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
			                      Action
			                    </button>
			                    <div class="dropdown-menu" style="">
			                      <div class="dropdown-divider"></div>
			                      <a class="dropdown-item edit_task" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"  data-task="<?php echo $row['task'] ?>" data-pid="<?php echo $row['pid'] ?>">Edit</a>
			                      <?php if($_SESSION['login_type'] != 3): ?>
			                      <div class="dropdown-divider"></div>
			                     <a class="dropdown-item delete_task" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
			                  <?php endif; ?>
			                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>
<script>
	/**
	 * Function to initialize the DataTable for the task list when the document is ready.
	 */
	$(document).ready(function () {
	    $('#list').dataTable();
	});

	/**
	 * Click event for the 'Edit Task' button.
	 * Opens a modal to edit the task using uni_modal function.
	 */
	$('.edit_task').click(function () {
	    // Construct the title for the modal
	    var title = "Edit Task: " + $(this).attr('data-task');
	    // Construct the URL for managing the task
	    var url = "manage_task.php?pid=" + $(this).attr('data-pid') + "&id=" + $(this).attr('data-id');
	    // Open the modal with a mid-large size
	    uni_modal(title, url, "mid-large");
	});

	/**
	 * Click event for the 'Delete Task' button.
	 * Asks for confirmation and triggers the delete_task function.
	 */
	$('.delete_task').click(function () {
	    // Show confirmation dialog with _conf function
	    _conf("Are you sure to delete this task?", "delete_task", [$(this).attr('data-id')]);
	});

	/**
	 * Function to delete a task.
	 * Sends an AJAX request to delete the task with the specified ID.
	 */
	function delete_task($id) {
	    // Start the loading animation
	    start_load();
	    // Send AJAX request to delete the task
	    $.ajax({
	        url: '/task-management-system/controller/ajax.php?action=delete_task',
	        method: 'POST',
	        data: { id: $id },
	        success: function (resp) {
	            // If deletion is successful, show success message and reload the page after a delay
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