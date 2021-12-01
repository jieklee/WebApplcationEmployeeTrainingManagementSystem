<?php

require_once('../sef.php');


class User extends sef{
    function __construct($db_connect){
        parent::__construct($db_connect);
    }

	public function change_password(){
        $post_data = $this->input->post();

        //if empty return back form, else encrypt password with md5()
        foreach($post_data as $key => $value){
            if(empty($value)){
                return $post_data;
            }else{
                $post_data[$key] = md5($value);
            }
        }

        //return error message, if new password is not same
        if($post_data['new_password'] != $post_data['reenter_password']){
            $post_data['error'] = 'Password does not matched.';
            return $post_data;
        }
        
        //get password from db for checking
        $where['User_ID'] = $_SESSION['User_ID'];
        $row = $this->db->select('User_Password')->from('tbl_user')->where($where)->get()->row();

        //if not same as password in db, return error message
        if($row['User_Password'] != $post_data['old_password']){
            $post_data['error'] = 'Wrong old password.';
            return $post_data;
        }
        
        //update password in db
        $password['User_Password'] = $post_data['new_password'];

        $this->db->table_name = 'tbl_user';
        $this->db->update($password, $where);

        //redirect back to the same page
        $redirect = $_SERVER['PHP_SELF'];
        header("Location: $redirect");
        die();

        $this->db->close_connection();
    }
	
	public function edit_profile(){
        $data = $this->input->post();

        foreach($data as $key => $value){
            if(empty($value)){
                return $data;
            }
        }

        $post_data['phone_number'] = $data['User_Phone'];
        if(empty(strpos($post_data['phone_number'], '-'))){
            $phone_start = substr($post_data['phone_number'], 0, 3);
            $phone_end = substr($post_data['phone_number'], 3);
            $post_data['phone_number'] = $phone_start . '-' . $phone_end;
        }
        
        $post_data['password'] = md5($data['User_Password']);

        $row = $this->db->select('User_Password')->from('tbl_user')->where('User_ID', $_SESSION['User_ID'])->get()->row();
    
        if($row['User_Password'] != $post_data['password']){
            $post_data['error'] = 'Wrong password.';
            return $post_data;
        }

        unset($post_data['password']);
        $user_id['User_ID'] = $_SESSION['User_ID'];

        $this->db->table_name = 'tbl_user';
        $this->db->update($post_data, $user_id);

        $_SESSION['User_Phone'] = $post_data['phone_number'];

        $redirect = 'profile.php';
        header('Location: ' . $redirect);
        die();

        $this->db->close_connection();
    }
	
	public function submit_request_training(){
        $input_field = ['title', 'description'];
        $post_data = $this->input->post($input_field);

        foreach($post_data as $key => $value){
            if(empty($value)){
                return $post_data;
            }
        }

        $post_data['description'] = str_replace('\r\n', '<br/>', $post_data['description']);
        $post_data['description'] = str_replace('\r', '<br/>', $post_data['description']);
        $post_data['description'] = str_replace('\n', '<br/>', $post_data['description']);
        $post_data['User_ID'] = $_SESSION['User_ID'];
        $this->db->table_name = 'tbl_attendee_request';
        $this->db->insert($post_data);
		
        $this->db->close_connection();
    }
	
	public function submit_feedback(){
        $input_field = ['title', 'description'];
        $post_data = $this->input->post($input_field);

        foreach($post_data as $key => $value){
            if(empty($value)){
                return $post_data;
            }
        }

        $post_data['description'] = str_replace('\r\n', '<br/>', $post_data['description']);
        $post_data['description'] = str_replace('\r', '<br/>', $post_data['description']);
        $post_data['description'] = str_replace('\n', '<br/>', $post_data['description']);
        $post_data['User_ID'] = $_SESSION['User_ID'];
        $this->db->table_name = 'tbl_feedback';
        $this->db->insert($post_data);
		
        $this->db->close_connection();
    }

    public function add_new_announcement(){
        $post_data = $this->input->post(['title', 'description']);

        foreach($post_data as $key => $value){
            if(empty($value)){
                return $post_data;
            }
        }

        if(!empty($_FILES['assignment']['name'])){
            $post_data['assignment'] = $_FILES['assignment']['name'];
            $post_data['assignment_path'] = '../upload/' . $_FILES['assignment']['name'];
            
            move_uploaded_file($_FILES['assignment']['tmp_name'], $post_data['assignment_path']);
        }
        $post_data['Training_Course_ID'] = $_SESSION['Training_Course_ID'];

        $this->db->table_name = 'tbl_announcement';
        $this->db->insert($post_data);

        header('Location: dashboard.php');
        die();

        $this->db->close_connection();
    }
    
    public function get_announcement_list(){
        return $this->db->select()->from('tbl_announcement')->where('Training_Course_ID', $_SESSION['Training_Course_ID'])->order_by('created_on', 'desc')->get()->result();
    
        $this->db->close_connection();
    }
}	

$User = new User($db_connect);

?>