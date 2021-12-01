<?php 
require_once('sef.php');

if(!empty($_GET)){
    if(array_key_exists('action', $_GET)){
        if($_GET['action'] == 'logout'){
            $sef->logout();
        }
    }
}

$sef->check_login();
?>

<title>Employee Training Management System</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="/sef/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="/sef/assets/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="/sef/assets/bower_components/Ionicons/css/ionicons.min.css">
<!-- Checkbox Toggle -->
<link rel="stylesheet" href="/sef/assets/checkbox_toggle/css/bootstrap-toggle.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="/sef/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/sef/assets/bower_components/select2/dist/css/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/sef/assets/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="/sef/assets/dist/css/skins/_all-skins.min.css">
<!-- Date Picker -->
<link rel="stylesheet" href="/sef/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="/sef/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/sef/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<!-- jQuery 3 -->
<script src="/sef/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/sef/assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/sef/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="/sef/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Checkbox Toggle -->
<script src="/sef/assets/checkbox_toggle/js/bootstrap-toggle.min.js"></script>
<!-- DataTables -->
<script src="/sef/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/sef/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- daterangepicker -->
<script src="/sef/assets/bower_components/moment/min/moment.min.js"></script>
<script src="/sef/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/sef/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/sef/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- AdminLTE App -->
<script src="/sef/assets/dist/js/adminlte.min.js"></script>

<style>
.has-error .select2-selection {
    border-color: rgb(185, 74, 72) !important;
}

.rating-label:hover{
    cursor: pointer;
}
</style>

<script>
//Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
$.widget.bridge('uibutton', $.ui.button);

$(document).ready(function(){
    $('.sidebar-menu').tree();

    //Initialize Select2 Elements
    $('.select_box').select2();

    //Date range picker
    $('.date-range').daterangepicker({
        autoApply: true,
        locale   : {
            format: 'DD-MM-YYYY',
        }
    }, function(start, end, label){
        $('#add_training_course_start_date').val(start.format('DD-MM-YYYY'));
        $('#add_training_course_end_date').val(end.format('DD-MM-YYYY'));
    });

    //Date picker
    $('.date').datepicker({
        autoclose : true,
        format    : 'dd-mm-yyyy',
        //startDate : '+4d'
    });

    //$('.date').datepicker('setDate', min_date);

    //bootstrap WYSIHTML5 - text editor
    /*$('textarea').wysihtml5({
        toolbar: 'none',
    });*/
});
</script>
