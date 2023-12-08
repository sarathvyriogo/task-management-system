<!-- SweetAlert2 -->
<script src="/task-management-system/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="/task-management-system/assets/plugins/toastr/toastr.min.js"></script>
<!-- Switch Toggle -->
<script src="/task-management-system/assets/plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
<!-- Select2 -->
<script src="/task-management-system/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="/task-management-system/assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/task-management-system/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DateTimePicker -->
  <script src="/task-management-system/assets/dist/js/jquery.datetimepicker.full.min.js"></script>
  <!-- Bootstrap Switch -->
<script src="/task-management-system/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
 <!-- MOMENT -->
<script src="/task-management-system/assets/plugins/moment/moment.min.js"></script>
<script>
	$(document).ready(function(){
    // Initialize select2 plugin for dropdowns
	$('.select2').select2({
	    placeholder: "Please select here",
	    width: "100%"
	});

    // Function to show a loading indicator
	window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>');
	};

    // Function to hide the loading indicator
	window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	    });
	};

    // Function to open a modal with dynamic content
	window.uni_modal = function($title = '', $url = '', $size = "", $view = ""){
	    start_load();
	    $.ajax({
	        url: $url,
	        error: err => {
	            console.log(err);
	            alert("An error occurred");
	        },
	        success: function(resp){
	            if(resp){
	                $('#uni_modal .modal-title').html($title);
	                $('#uni_modal .modal-body').html(resp);
	                if($size != ''){
	                    $('#uni_modal .modal-dialog').addClass($size);
	                } else {
	                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md");
	                }
	                $('#uni_modal').modal({
	                    show: true,
	                    backdrop: 'static',
	                    keyboard: false,
	                    focus: true
	                });
	                end_load();
	            }
	        }
	    });
	};

    // Function to show a confirmation modal
	window._conf = function($msg = '', $func = '', $params = []){
	     $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
	     $('#confirm_modal .modal-body').html($msg);
	     $('#confirm_modal').modal('show');
	};

    // Function to show a toast notification
	window.alert_toast = function($msg = 'TEST', $bg = 'success', $pos = ''){
	    var Toast = Swal.mixin({
	      toast: true,
	      position: $pos || 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	    Toast.fire({
	        icon: $bg,
	        title: $msg
	    });
	};

    // Initialize Bootstrap custom file input
    $(function () {
        bsCustomFileInput.init();

        // Initialize summernote editor
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });

        // Initialize datetimepicker
        $('.datetimepicker').datetimepicker({
            format: 'Y/m/d H:i'
        });
    });

    // Initialize Bootstrap Toggle for toggle switches
    $(".switch-toggle").bootstrapToggle();

    // Format number inputs
    $('.number').on('input keyup keypress', function(){
        var val = $(this).val();
        val = val.replace(/[^0-9]/, '');
        val = val.replace(/,/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val);
    });
});
</script>
<script src="/task-management-system/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/task-management-system/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/task-management-system/assets/dist/js/adminlte.js"></script>

<!-- PAGE /task-management-system/assets/plugins -->
<script src="/task-management-system/assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/task-management-system/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/task-management-system/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/task-management-system/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/task-management-system/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/task-management-system/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/task-management-system/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/task-management-system/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/task-management-system/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

