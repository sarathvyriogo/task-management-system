<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 
    // Set the default timezone to Asia/Kolkata
    date_default_timezone_set('Asia/Kolkata');

    // Start output buffering
    ob_start();

    // Determine the title based on the page parameter in the URL
    $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Home";
    ?>

    <!-- Set the page title with the system name -->
    <title><?php echo $title; ?> | Task Management System</title>

    <?php
    // Flush the output buffer
    ob_end_flush();
  ?>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/task-management-system/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/task-management-system/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/task-management-system/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/toastr/toastr.min.css">
  <!-- DateTimePicker -->
  <link rel="stylesheet" href="/task-management-system/assets/dist/css/jquery.datetimepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Switch Toggle -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/task-management-system/assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/task-management-system/assets/dist/css/styles.css">
	<script src="/task-management-system/assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="/task-management-system/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="/task-management-system/assets/plugins/summernote/summernote-bs4.min.css">
  
</head>