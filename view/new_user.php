<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_user">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<?php if($_SESSION['login_type'] == 1): ?>
						<div class="form-group">
							<label for="" class="control-label">User Role</label>
							<select name="type" id="type" class="custom-select custom-select-sm">
								<option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Employee</option>
								<option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Project Manager</option>
								<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Admin</option>
							</select>
						</div>
						<?php else: ?>
							<input type="hidden" name="type" value="3">
						<?php endif; ?>
						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<img src="<?php echo isset($avatar) ? '/task-management-system/assets/uploads/'.$avatar :'' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
						</div>
					</div>
					<div class="col-md-6">
						
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
							<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Confirm Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
// Event handler for keyup on password and confirm password fields
$('[name="password"], [name="cpass"]').keyup(function(){
    // Retrieve the values of the password and confirm password fields
    var pass = $('[name="password"]').val();
    var cpass = $('[name="cpass"]').val();

    // Check if either password or confirm password is empty
    if(cpass == '' || pass == ''){
        // If empty, reset the data-status attribute
        $('#pass_match').attr('data-status', '');
    } else {
        // If both fields have values
        if(cpass == pass){
            // If passwords match, set data-status to '1' and display success message
            $('#pass_match').attr('data-status', '1').html('<i class="text-success">Password Matched.</i>');
        } else {
            // If passwords don't match, set data-status to '2' and display error message
            $('#pass_match').attr('data-status', '2').html('<i class="text-danger">Password does not match.</i>');
        }
    }
});
/**
 * Function to display the selected image preview.
 * @param {Object} input - The file input element.
 * @param {Object} _this - Reference to the current context.
 */
function displayImg(input, _this) {
    // Check if files are selected
    if (input.files && input.files[0]) {
        // Create a FileReader object
        var reader = new FileReader();

        // Define a function to be executed when the file is successfully loaded
        reader.onload = function (e) {
            // Set the source of the image with the loaded file result
            $('#cimg').attr('src', e.target.result);
        };

        // Read the contents of the file as a data URL
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Event handler for form submission using AJAX to save user data.
 */
$('#manage_user').submit(function (e) {
    // Prevent the default form submission behavior
    e.preventDefault();

    // Remove border-danger class from all input elements
    $('input').removeClass("border-danger");

    // Start loading indicator
    start_load();

    // Clear any existing message
    $('#msg').html('');

    // Check if both password and confirm password are not empty
    if ($('[name="password"]').val() != '' && $('[name="cpass"]').val() != '') {
        // Check if password match status is not 1 (not matched)
        if ($('#pass_match').attr('data-status') != 1) {
            // Check if password is not empty
            if ($("[name='password']").val() != '') {
                // Add border-danger class to password and confirm password fields
                $('[name="password"],[name="cpass"]').addClass("border-danger");

                // End loading and return false to prevent further processing
                end_load();
                return false;
            }
        }
    }

    // Use AJAX to submit the form data to the server for saving
    $.ajax({
        url: '/task-management-system/controller/ajax.php?action=save_user',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            if (resp == 1) {
                // Display success toast
                alert_toast('Data successfully saved.', "success");

                // Redirect to the user list page after a delay
                setTimeout(function () {
                    location.replace('index.php?page=user_list');
                }, 750);
            } else if (resp == 2) {
                // Display error message for duplicate email
                $('#msg').html("<div class='alert alert-danger'>Email already exists.</div>");
                $('[name="email"]').addClass("border-danger");

                // End loading
                end_load();
            }
        }
    });
});

</script>