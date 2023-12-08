<?php
// Start a new session
session_start();
// Display errors for debugging purposes
ini_set('display_errors', 1);
/**
 * Class Action
 * 
 * This class encapsulates actions and operations,
 * with a private property $db representing a database connection.
 */
class Action {
	private $db;
/**
 * Class constructor for initializing the Action class.
 * 
 * - Starts the output buffer.
 * - Includes the file for database connection.
 * - Sets the database connection variable.
 */
 	public function __construct() {
		ob_start();// Start the output buffer
	   	include_once '../config/db_connect.php';// Include the file for database connection
	    $this->db = $conn;// Set the database connection variable
	}
/**
 * Class destructor for cleaning up after the Action class.
 * 
 * - Closes the database connection.
 * - Flushes the output buffer.
 */
	function __destruct() {
	    $this->db->close();// Close the database connection
	    ob_end_flush();// Flush the output buffer
	}
/**
 * Function to handle user login.
 * 
 * @return int Returns 1 on successful login, 2 on login failure.
 */
	function login(){
		// Sanitize and escape data in the $_POST array using a custom function
		$_POST = $this->sanitizePostData($_POST,$this->db);
		// Extracting data from the POST array
		extract($_POST);
		// Performing a database query to select user data based on provided email and MD5-encrypted password
		$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '".$email."' ");
		// Fetch a row of data from the result set and store it in $data
		$data = $qry->fetch_array();
		// Check if the entered password matches the hashed password in the database
		if (password_verify($password, $data['password'])) {
		    if($qry->num_rows > 0){
				// Iterate through the fetched array and set session variables for user data
				foreach ($data as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
					return 1;// Successful login
			}
		} else {
		    return 2;// Login failed
		}
	}
/**
 * Function to handle user logout.
 * - Destroys the session.
 * - Unsets all session variables.
 * - Redirects to the login page.
 */
	function logout(){
		session_destroy(); // Destroy the session
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../view/login.php");// Redirect to the login page
	}

/**
 * Sanitize and escape data in the $_POST array using mysqli_real_escape_string and strip_tags.
 *
 * @param array $data The array containing data to be sanitized.
 * @param mysqli $conn The MySQLi database connection object.
 * @return array The sanitized data array.
 */
	function sanitizePostData($data, $conn) {
	    // Iterate through each key-value pair in the $data array
	    foreach ($data as $key => $value) {
	        // Use mysqli_real_escape_string to escape special characters in the value
	        // Use strip_tags to remove any HTML or PHP tags from the value
	        if (is_string($value)) {
            	$data[$key] = mysqli_real_escape_string($conn, strip_tags($value));
        	}
	    }
	    
	    // Return the sanitized data array
	    return $data;
	}

/**
 * Function to save user information (create or update).
 * 
 * @return int Returns 1 on successful save, 2 if a user with the same email already exists, or other error codes.
 */
	function save_user(){
		// Sanitize and escape data in the $_POST array using a custom function
		$_POST = $this->sanitizePostData($_POST,$this->db);
		extract($_POST);
		// Initializing an empty string to store data for database insertion or update
		$data = "";
		// Looping through each element in the POST array
		foreach($_POST as $k => $v){
			// Check if the key is not in the exclusion list and is not numeric
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				// If the data string is empty, directly assign the key-value pair, otherwise append with a comma
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		 // Check if $password is not empty
		if(!empty($password)){
			 		// Hash the password using PASSWORD_DEFAULT algorithm
					$password = password_hash($password, PASSWORD_DEFAULT);
					// Append the hashed password to the $data string
					$data .= ", password= '$password' ";

		}
		// Check if a user with the same email already exists, excluding the current user (if updating)
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		// If an image file is provided in the file upload and has a temporary name
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			// Move the uploaded file to the 'assets/uploads/' directory
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			// Append the filename to the data string
			$data .= ", avatar = '$fname' ";

		}
		//echo "<pre>";print_r($data);die();
		// If the user ID is empty, insert a new record into the 'users' table; otherwise, update the existing record
		if(empty($id)){
			//echo "<pre>";print_r($data);die();
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			//$data = "UPDATE users set $data where id = $id";
			//echo "<pre>";print_r($data);die();
			$save = $this->db->query("UPDATE users set $data where id = $id");
			if($save){
				if($_SESSION['login_id'] == $id)
				{
					$_SESSION['login_name'] =$_POST['firstname'].' '.$_POST['lastname'];
				}
				
			}
		}
		// If the database operation is successful, return a success code
		if($save){
			return 1;
		}
	}
/**
 * Function to delete a user based on the provided user ID.
 * 
 * @return int Returns 1 on successful deletion or other error codes if applicable.
 */
	function delete_user(){
		// Sanitize and escape data in the $_POST array using a custom function
		$_POST = $this->sanitizePostData($_POST,$this->db);
		// Extracting data from the POST array
		extract($_POST);
		// Performing a database query to delete the user with the specified ID
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		// If the deletion operation is successful, return a success code
		if($delete)
			return 1;
	}
 /**
 * Function to save project information (create or update).
 * 
 * @return int Returns 1 on successful save, otherwise the function may have specific error handling.
 */
	function save_project(){
		// Sanitize and escape data in the $_POST array using a custom function
		$_POST = $this->sanitizePostData($_POST,$this->db);
		// Extracting data from the POST array
		extract($_POST);
		// Initializing an empty string to store data for database insertion or update
		$data = "";
		// Looping through each element in the POST array
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if($k == 'description')
					 // HTML-encode the 'description' field and replace single quotes
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				// If the data string is empty, directly assign the key-value pair, otherwise append with a comma
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		// If the 'user_ids' field is set, concatenate user IDs and append to the data string
		if(isset($user_ids)){
			$data .= ", user_ids='".implode(',',$user_ids)."' ";
		}
		// If the project ID is empty, insert a new record into the 'project_list' table; otherwise, update the existing record
		if(empty($id)){
			$save = $this->db->query("INSERT INTO project_list set $data");
		}else{
			$save = $this->db->query("UPDATE project_list set $data where id = $id");
		}
		// If the database operation is successful, return a success code
		if($save){
			return 1;
		}
	}
/**
 * Function to delete a project based on the provided project ID.
 * 
 * @return int Returns 1 on successful deletion or other error codes if applicable.
 */
	function delete_project(){
		// Sanitize and escape data in the $_POST array using a custom function
		$_POST = $this->sanitizePostData($_POST,$this->db);
		extract($_POST);
		$delete = $this->db->query("DELETE FROM project_list where id = $id");
		if($delete){
			return 1;
		}
	}
/**
 * Function to save task information (create or update).
 * 
 * @return int Returns 1 on successful save, otherwise the function may have specific error handling.
 */
	function save_task(){
		// Sanitize and escape data in the $_POST array using a custom function
		$_POST = $this->sanitizePostData($_POST,$this->db);
		// Extracting data from the POST array
		extract($_POST);
		// Initializing an empty string to store data for database insertion or update
		$data = "";
		// Looping through each element in the POST array
		foreach($_POST as $k => $v){
			// Check if the key is not in the exclusion list, is not numeric, and apply additional conditions
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if($k == 'description')
				// HTML-encode the 'description' field and replace single quotes
				$v = htmlentities(str_replace("'","&#x2019;",$v));
				// If the data string is empty, directly assign the key-value pair, otherwise append with a comma
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		// If the task ID is empty, insert a new record into the 'task_list' table; otherwise, update the existing record
		if(empty($id)){
			$save = $this->db->query("INSERT INTO task_list set $data");
		}else{
			$save = $this->db->query("UPDATE task_list set $data where id = $id");
		}
		// If the database operation is successful, return a success code
		if($save){
			return 1;
		}
	}
/**
 * Function to delete a project.
 * 
 * @return int Returns 1 on successful deletion, otherwise the function may have specific error handling.
 */
	function delete_task(){
		// Sanitize and escape data in the $_POST array using a custom function
		$_POST = $this->sanitizePostData($_POST,$this->db);
		// Extracting data from the POST array
		extract($_POST);
		// Performing a database query to delete the project with the specified ID
		$delete = $this->db->query("DELETE FROM task_list where id = $id");
		// If the deletion operation is successful, return a success code
		if($delete){
			return 1;
		}
	}
}