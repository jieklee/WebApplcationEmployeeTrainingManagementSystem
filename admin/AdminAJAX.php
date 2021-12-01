<?php
require_once('Admin.php');

if(!empty($_POST)){
	if($_POST['action'] == 'user_dtb'){
		$Admin->user_dtb();
	}else if($_POST['action'] == 'change_room_status'){
        $Admin->change_room_status();
    }else if($_POST['action'] == 'training_course_dtb'){
		$Admin->training_course_dtb();
	}else if($_POST['action'] == 'get_request_description'){
        $Admin->get_request_description();
    }else if($_POST['action'] == 'get_feedback_description'){
        $Admin->get_feedback_description();
	}else if($_POST['action'] == 'update_request_status'){
        $Admin->update_request_status();
    }
}

if(!empty($_GET)){
	if($_GET['action'] == 'delete_user'){
		$Admin->delete_user();
	}else if($_GET['action'] == 'delete_venue'){
        $Admin->delete_venue();
    }else if($_GET['action'] == 'delete_room'){
        $Admin->delete_room();
    }else if($_GET['action'] == 'delete_training_course'){
        $Admin->delete_training_course();
    }
}
?>