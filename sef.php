<?php

require_once('log/log_message.php');
require_once('constants.php');
require_once('database.php');
require_once('form_error.php');
require_once('db.php');
require_once('input.php');
require_once('assets/mail/global_controller.php');

class sef{
	protected $db = '';
    protected $db_connect = '';
    protected $global = '';
    protected $input = '';
	
	function __construct($db_connect){
        $this->db_connect = $db_connect;
        $this->db = new db($db_connect);
        $this->global = new Global_Controller();
        $this->input = new input($db_connect);
    }
	
	public function check_login(){
        if(!empty($_SESSION)){
            if($_SESSION['User_Type'] == ROLE_ADMIN){
                if(empty(strpos($_SERVER['PHP_SELF'], 'sef/admin'))){
                    header('Location: /sef/admin/user.php');
                    die();
                }
            }else if($_SESSION['User_Type'] == ROLE_TRAINER || $_SESSION['User_Type'] == ROLE_TRAINEE){
                if(empty(strpos($_SERVER['PHP_SELF'], 'sef/user'))){
                    header('Location: /sef/user/dashboard.php');
                    die();
                }
            }
        }else{
            if($_SERVER['PHP_SELF'] != '/sef/index.php'){
                header('Location: /sef');
                die();
            }
        }
    }
	
	 public function login(){
        $post_data = $this->input->post();
        if(!empty($post_data['password'])){
            $post_data['password'] = md5($post_data['password']);
        }

        foreach($post_data as $key => $value){
            if(empty($value)){
                return $post_data;
            }
        }
		
		$data['User_Name'] = $post_data['username'];
		$data['User_Password'] = $post_data['password'];

        $row = $this->db->select()->from('tbl_user')->where($data)->get()->row();
        
        if(empty($row)){
            $post_data['error'] = 'Wrong Username or Password';
            return $post_data;
        }
        else{
            $user_data = array(
                'User_ID' => $row['User_ID'],
                'User_Name' => $row['User_Name'],
                'User_Email' => $row['User_Email'],
                'User_Type' => $row['User_Type'],
				'User_Phone' => $row['User_Phone'],
				'User_Department' => $row['User_Department'],
            );
            $_SESSION = $user_data;

            if($_SESSION['User_Type'] == ROLE_ADMIN || $_SESSION['User_Type'] == ROLE_HR){
                header('Location: admin/user.php');
                die();
            }else{
				$this->db->select('a.Training_Course_ID')->from('tbl_training_course a');
				$this->db->join('tbl_attendee b', 'a.Training_Course_ID = b.Training_Course_ID', 'left');
				
				if($_SESSION['User_Type'] == ROLE_TRAINER){
					$this->db->where('Trainer_User_ID', $_SESSION['User_ID']);
				}else{
					$this->db->where('Trainee_User_ID', $_SESSION['User_ID']);
				}
				
				$training_info = $this->db->get()->row();
				$_SESSION['Training_Course_ID'] = $training_info['Training_Course_ID'];
								
                header('Location: user/dashboard.php');
                die();
            }
        }

        $this->db->close_connection();
    }

    public function logout(){
        session_destroy();
        $this->db->close_connection();
        header('Location: /sef');
        die();
    }
	
	 public function get_feedback(){
    }
	
	public function get_feedback_description(){
    }
	
	public function get_all_subject($where = []){
    }
	
	public function get_subject_taking($user_id, $flag = FALSE){
    }
	
	public function get_subject_info($subject_id){
    }
	
	public function get_training_course_info($training_course_id){
        return $this->db->select()
                        ->from('tbl_training_course')
                        ->where('Training_Course_ID', $training_course_id)
                        ->get()->row();

        $this->db->close_connection();
    }
	
	public function dtb_search($dtb_obj, $by_having = false){
        $offset = $dtb_obj['start'];
        $limit = $dtb_obj['length'];
        $columns = $dtb_obj['columns'];
        $order = $dtb_obj['order'];
        $search = $dtb_obj['search'];

        if(!empty($search['value'])){
            foreach($columns as $c){
                if(!empty($c['name'])){
                    if($by_having){
                        $this->db->having_or($c['name'] .' LIKE "%'. $search['value'] .'%"');    
                    }else{
                        $this->db->like_or($c['name'], $search['value']);	    
                    }
                }
            }
        }

        foreach($order as $o){
            if(!empty($columns[$o['column']]['name'])){
                $this->db->order_by($columns[$o['column']]['name'], $o['dir']);
            }
        }
        
        $this->db->limit($limit, $offset);
    }

    public function dtb_search_count($dtb_obj, $by_having = false){
        $columns = $dtb_obj['columns'];
        $search = $dtb_obj['search']; 
        
        if(!empty($search['value'])){
            foreach($columns as $c){
                if(!empty($c['name'])){
                    if($by_having){
                        $this->db->having_or($c['name'] .' LIKE "%'. $search['value'] .'%"');    
                    }else{
                        $this->db->like_or($c['name'], $search['value']);	
                    }
                }
            }
        }
    }

	public function forgot_password(){
        $post_data = $this->input->post();

        if(empty($post_data)){
            return $post_data;
        }

        $data = $this->db->select('User_Name')->from('tbl_user')->where($post_data)->get()->row();

        if(empty($data)){
            $post_data['error'] = 'This username is not existed in our system.';
            return $post_data;
        }else{
            $password['User_Password'] = substr(md5(mt_rand(10,100)), 0, 8);
            $this->send_forgot_password_email($data, $password['User_Password']);

            $password['User_Password'] = md5($password['User_Password']);
            $this->db->table_name = 'tbl_user';
            $this->db->update($password, $post_data);

            $post_data['success'] = 'success';
            return $post_data;
        }
    }
}

$sef = new sef($db_connect);

?>