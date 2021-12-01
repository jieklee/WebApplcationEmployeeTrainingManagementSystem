<?php

require_once('../sef.php');

class Admin extends sef{
    function __construct($db_connect){
        parent::__construct($db_connect);
    }

    public function save_user(){
        $input_field = ['User_Name', 'User_Email', 'User_Type'];
        $post_data = $this->input->post($input_field);
		
		foreach($post_data as $value){
			if(empty($value)){
				return $post_data;
			}
		}
        
		$user_id['User_ID'] = $this->input->post('User_ID');
        $row = $this->db->select('User_ID')->from('tbl_user')->where('User_Name', $post_data['User_Name'])->get()->row();
        $this->db->table_name = 'tbl_user';
        
		if(empty($row['User_ID']) && empty($user_id['User_ID'])){
			$post_data['User_Password'] = substr(md5(mt_rand(10,100)),0,8);
			$vemail = $this->send_mail($post_data);
			$post_data["User_Password"] = md5($post_data['User_Password']);		
			$this->db->insert($post_data);
		}
		else{
			if(!empty($row['User_ID'])){
				if($row['User_ID'] != $user_id['User_ID']){
					$post_data['error'] = "This username has been existed.";
					
					return $post_data;
				}
			}
			$this->db->update($post_data, $user_id);
		}
        header('Location: user.php');
        die();

        $this->db->close_connection();
    }

    public function get_user_info($user_id){
        return $this->db->select()
                        ->from('tbl_user')
                        ->where('User_ID', $user_id)
                        ->get()->row();

        $this->db->close_connection();
    }

    public function delete_user(){
        $where['User_ID'] = $this->input->get('User_ID');
        $this->db->table_name = 'tbl_user';
        $this->db->delete($where);

        header('Location: user.php');
        die();

        $this->db->close_connection();
    }
	
	public function user_dtb(){
		$data['draw'] = $this->input->post('draw');
		$data['data'] = $this->get_user_list($_POST);
		$data['recordsTotal'] = $this->get_user_list_row($_POST);
		$data['recordsFiltered'] = $data['recordsTotal'];
		
		echo json_encode($data);
	}
	
	public function get_user_list($dtb_obj){
		$this->db->select('User_ID, User_Name, User_Type')->from('tbl_user');
		$this->db->where('User_Type != ', ROLE_ADMIN);
		
		if(!empty($dtb_obj)){
			$this->dtb_search($dtb_obj, TRUE);
		}
		return $this->db->get()->result();
	}
	
	public function get_user_list_row($dtb_obj){
		$this->db->select('User_ID, User_Name, User_Type')->from('tbl_user');
		$this->db->where('User_Type != ', ROLE_ADMIN);
		
		if(!empty($dtb_obj)){
			$this->dtb_search_count($dtb_obj, TRUE);
		}
		
		return $this->db->get()->num_rows();
	}
	
	private function send_mail($user_info){
        $mail = $this->global->smtp();
        $mail->from('smtplee10@gmail.com', 'Employee Training Management System');
        
        $mail->subject('Invitation ETMS');

        $message = 'This is your username and password to login our system. <br/>
                    Username: {User_Name} <br/>
                    Password: {User_Password} <br/>
                    Link: <a href="{link}" target="_blank">ETMS</a>';
        $message = str_replace('{User_Name}', $user_info['User_Name'], $message);
        $message = str_replace('{User_Password}', $user_info['User_Password'], $message);
        $message = str_replace('{link}', $_SERVER['SERVER_NAME'] . '/sef', $message);
        $mail->body($message);
        
        $mail->to($user_info['User_Email'], $user_info['User_Name']);
        return $mail->send();
    }
	
	 public function save_venue(){
        $post_data['Venue_Name'] = $this->input->post('Venue_Name');

        if(empty($post_data['Venue_Name'])){
            $post_data['Venue_ID'] = $this->input->post('Venue_ID');
            return $post_data;
        }
        
        $venue_id['Venue_ID'] = $this->input->post('Venue_ID');
        
        $row = $this->db->select('Venue_ID')->from('tbl_venue')->where('Venue_Name', $post_data['Venue_Name'])->get()->row();

        $this->db->table_name = 'tbl_venue';
        if(!empty($venue_id['Venue_ID']) && empty($row)){
            $this->db->update($post_data, $venue_id);
        }else if(!empty($row)){
            if($row['Venue_ID'] != $venue_id['Venue_ID']){
                $post_data['error'] = "Venue name exisiting."; 
                return $post_data;
            }
        }else{
            $this->db->insert($post_data);
        }

        header('Location: setting_venue_n_room.php');
        die();

        $this->db->close_connection();
    }

    public function get_venue_list(){
        return $this->db->select()
                        ->from('tbl_venue')
                        ->order_by('Venue_Name')
                        ->get()->result();

        $this->db->close_connection();
    }
	
	public function get_active_venue(){
		$this->db->select('b.Venue_Name');
		$this->db->from('tbl_room a');
		$this->db->join('tbl_venue b', 'a.Venue_ID = b.Venue_ID');
		$this->db->where('a.Status','1');
		$this->db->group_by('b.Venue_ID');
		$this->db->order_by('b.Venue_Name');
		
		return $this->db->get()->result();
	
	}

    public function delete_venue(){
        $where['Venue_ID'] = $this->input->get('Venue_ID');

        $this->db->table_name = 'tbl_venue';
        $this->db->delete($where);

        header('Location: setting_venue_n_room.php');
        die();

        $this->db->close_connection();
    }
	
	public function save_room(){
        $data = ['Venue_ID', 'Room_Name'];
        $post_data = $this->input->post($data);

        if(empty($post_data['Room_Name'])){
            $post_data['Room_ID'] = $this->input->post('Room_ID');
            return $post_data;
        }
        
        $room_id['Room_ID'] = $this->input->post('Room_ID');
        $post_data['Room_Name'] = strtoupper($post_data['Room_Name']);
        $row = $this->db->select('Room_ID')->from('tbl_room')->where('Room_Name', $post_data['Room_Name'])->where('Venue_ID', $post_data['Venue_ID'])->get()->row();

        $this->db->table_name = 'tbl_room';
        if(!empty($room_id['Room_ID']) && empty($row)){
            $this->db->update($post_data, $room_id);
        }else if(!empty($row)){
            if($row['Room_ID'] != $room_id['Room_ID']){
                $post_data['error'] = "Room name existing."; 
                return $post_data;
            }
        }else{
            $this->db->insert($post_data);
        }

        header('Location: setting_venue_n_room.php');
        die();

        $this->db->close_connection();
    }

    public function get_room_list(){
        return $this->db->select()
                        ->from('tbl_room')
                        ->order_by('Room_Name')
                        ->get()->result();

        $this->db->close_connection();
    }
	
    public function get_active_room(){
        return $this->db->select('a.Room_Name, b.Venue_Name')
                        ->from('tbl_room a')
						->join('tbl_venue b', 'a.Venue_ID = b.Venue_ID')
						->where('a.Status' ,'1')
                        ->order_by('a.Room_Name')
                        ->get()->result();

        $this->db->close_connection();
    }

    public function change_room_status(){
        $room_id['Room_ID'] = $this->input->post('Room_ID');
        $status['Status'] = $this->input->post('status');

        $this->db->table_name = 'tbl_room';
        $this->db->update($status, $room_id);

        $this->db->close_connection();
    }

    public function delete_room(){
        $where['Room_ID'] = $this->input->get('Room_ID');
        $this->db->table_name = 'tbl_room';
        $this->db->delete($where);

        header('Location: setting_venue_n_room.php');
        die();

        $this->db->close_connection();
    }
		
	public function delete_training_course(){
        $where['Training_Course_ID'] = $this->input->get('Training_Course_ID');
        $this->db->table_name = 'tbl_training_course';
        $this->db->delete($where);

        header('Location: training_course.php');
        die();

        $this->db->close_connection();
    }
	
	public function training_course_dtb(){
		$data['draw'] = $this->input->post('draw');
		$data['data'] = $this->get_training_course_list($_POST);
		$data['recordsTotal'] = $this->get_training_course_list_row($_POST);
		$data['recordsFiltered'] = $data['recordsTotal'];
		
		echo json_encode($data);
	}

	public function get_training_course_list($dtb_obj){
		$this->db->select()->from('tbl_training_course');
		
		if(!empty($dtb_obj)){
			$this->dtb_search($dtb_obj, TRUE);
		}
		
		return $this->db->get()->result();	
	}
	
	public function save_training_course(){
        $input_field = ['Training_Course_Name', 'Training_Course_Description', 'Training_Course_Start_Date', 'Training_Course_End_Date','Training_Course_Start_Time','Training_Course_End_Time','Venue_Name','Room_Name'];
        $data = $this->input->post($input_field);

        foreach($data as $key => $value){
			if(empty($value)){
                $data['Training_Course_Start_Date'] = (empty($data['Training_Course_Start_Date']) ? date('d-m-Y') : $data['Training_Course_Start_Date']);
                $data['Training_Course_End_Date'] = (empty($data['Training_Course_End_Date']) ? date('d-m-Y') : $data['Training_Course_End_Date']);
                $data['Start_Date_And_End_Date'] = $data['Training_Course_Start_Date'] . ' - ' . $data['Training_Course_End_Date'];
                return $data;
			}
        }
		
		//YYYY-MM-DD
        $start_date = explode('-', $data['Training_Course_Start_Date']);
		$end_date = explode('-', $data['Training_Course_End_Date']);
		$post_data = $data;
        $post_data['Training_Course_Start_Date'] = $start_date[2] . '-' . $start_date[1] . '-' . $start_date[0];
		$post_data['Training_Course_End_Date'] = $end_date[2] . '-' . $end_date[1] . '-' . $end_date[0];
		
		$training_course_id['Training_Course_ID'] = $this->input->post('Training_Course_ID');
		
		if(isset($_POST['edit_btn'])){
			if(!empty($_FILES['Training_Course_Cert']['name'])){
				$post_data['Training_Course_Cert'] = $_FILES['Training_Course_Cert']['name'];
				$post_data['Training_Course_Cert_Path'] = '../upload/' . $_FILES['Training_Course_Cert']['name'];
				
				move_uploaded_file($_FILES['Training_Course_Cert']['tmp_name'], $post_data['Training_Course_Cert_Path']);
			}
		}

        $row = $this->db->select('Training_Course_ID')->from('tbl_training_course')->where('Training_Course_Name', $post_data['Training_Course_Name'])->get()->row();

        $this->db->table_name = 'tbl_training_course';
        if(empty($row['Training_Course_ID']) && empty($training_course_id['Training_Course_ID'])){
			$this->db->insert($post_data);
		}else{
			if(!empty($row['Training_Course_ID'])){
				if($row['Training_Course_ID'] != $training_course_id['Training_Course_ID']){
					$data['error'] = "This Training Course has been existed.";
					
					return $data;
				}
			}
			$this->db->update($post_data, $training_course_id);
		}

        header('Location: training_course.php');
        die();

        $this->db->close_connection();
    }
	
	public function get_training_course_list_row($dtb_obj){
		$this->db->select()->from('tbl_training_course');
		
		if(!empty($dtb_obj)){
			$this->dtb_search_count($dtb_obj, TRUE);
		}
		
		return $this->db->get()->num_rows();
    }

    public function get_training_course_not_in_attendee_list(){
        return $this->db->select('a.Training_Course_ID, a.Training_Course_Name')
                        ->from('tbl_training_course a')
                        ->join('tbl_attendee b', 'a.Training_Course_ID = b.Training_Course_ID', 'left')
                        ->where('b.Training_Course_ID', NULL)
                        ->group_by('a.Training_Course_ID')
                        ->get()->result();

        $this->db->close_connection();
    }

    public function get_trainer_list(){
        return $this->db->select('User_ID, User_Name')
                        ->from('tbl_user')
                        ->where('User_Type', ROLE_TRAINER)
                        ->get()->result();
        
        $this->db->close_connection();
    }

    public function get_assigned_training_course_list(){
        return $this->db->select('b.Training_Course_ID, b.Training_Course_Name')
                        ->from('tbl_attendee a')
                        ->join('tbl_training_course b', 'a.Training_Course_ID = b.Training_Course_ID')
                        ->group_by('b.Training_Course_ID')
                        ->get()->result();

        $this->db->close_connection();
    }

    public function get_trainee_not_in_attendee_list(){
        return $this->db->select('a.User_ID, a.User_Name')
                        ->from('tbl_user a')
                        ->join('tbl_attendee b', 'a.User_ID = b.Trainee_User_ID', 'left')
                        ->where('a.User_Type', ROLE_TRAINEE)
                        ->where('b.Trainee_User_ID', NULL)
                        ->get()->result();
        
        $this->db->close_connection();
    }
    
    public function assign_trainee_to_course(){
        $input_field = ['Training_Course_ID', 'Trainer_User_ID'];
        $data = $this->input->post($input_field);

        $data['Trainee_User_ID'] = '';
        if(array_key_exists('Trainee_User_ID', $_POST)){
            $data['Trainee_User_ID'] = $this->input->post('Trainee_User_ID');
        }

        foreach($data as $value){
            if(empty($value)){
                return $data;
            }
        }

        //change back to array, because $this->input->post('Trainee_User_ID') has change it to string
        $data['Trainee_User_ID'] = json_decode($data['Trainee_User_ID']);
        $insert_data['Training_Course_ID'] = $data['Training_Course_ID'];
        $insert_data['Trainer_User_ID'] = $data['Trainer_User_ID'];

        $this->db->table_name = 'tbl_attendee';
        //delete previous data first
        $this->db->delete('Training_Course_ID', $insert_data['Training_Course_ID']);
        //insert the new data
        foreach($data['Trainee_User_ID'] as $value){
            $insert_data['Trainee_User_ID'] = $value;
            $this->db->insert($insert_data);
        }

        $this->db->close_connection();
        
        header('Location: assign_trainee.php');
        die();
    }

    public function get_assigned_training_course_info($training_course_id){
        return $this->db->select('b.Training_Course_ID, b.Training_Course_Name, c.User_ID, c.User_Name')
                        ->from('tbl_attendee a')
                        ->join('tbl_training_course b', 'a.Training_Course_ID = b.Training_Course_ID')
                        ->join('tbl_user c', 'a.Trainer_User_ID = c.User_ID')
                        ->where('b.Training_Course_ID', $training_course_id)
                        ->group_by('b.Training_Course_ID')
                        ->get()->row();

        $this->db->close_connection();
    }

    public function get_assigned_trainee_list($training_course_id, $flag = FALSE){
        $result = $this->db->select('b.User_ID, b.User_Name')->from('tbl_attendee a')
                            ->join('tbl_user b', 'a.Trainee_User_ID = b.User_ID')
                            ->where('a.Training_Course_ID', $training_course_id)
                            ->get()->result();
        
        if($flag){
            return $result;
        }else{
            $user_id_list = [];
            foreach($result as $value){
                $user_id_list[] = $value['User_ID'];
            }

            return $user_id_list;
        }

        $this->db->close_connection();
    }

    public function get_course_trainee_and_unassign_trainee_list($training_course_id){
        $trainee_list = $this->get_assigned_trainee_list($training_course_id, TRUE);
        $unassign_trainee_list = $this->get_trainee_not_in_attendee_list();

        $all_trainee_list = [];
        $count = 0;
        foreach($trainee_list as $value){
            $all_trainee_list[$count]['User_ID'] = $value['User_ID'];
            $all_trainee_list[$count]['User_Name'] = $value['User_Name'];
            $count++;
        }

        foreach($unassign_trainee_list as $value){
            $all_trainee_list[$count]['User_ID'] = $value['User_ID'];
            $all_trainee_list[$count]['User_Name'] = $value['User_Name'];
            $count++;
        }

        return $all_trainee_list;
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
	
	public function get_request_list(){
        $this->db->select('a.Attendee_ID, a.title, a.created_on, b.User_Name');
        $this->db->from('tbl_attendee_request a');
        $this->db->join('tbl_user b', 'a.User_ID = b.User_ID');
		$this->db->where('status_request', 'Pending');


        return $this->db->get()->result();

        $this->db->close_connection();
    }

    public function get_request_description(){
        $this->db->select('description');
        $this->db->from('tbl_attendee_request');
        $this->db->where('Attendee_ID', $this->input->post('Attendee_ID'));
        $data = $this->db->get()->row();

        echo json_encode($data);

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
	
	public function get_feedback_list(){
        $this->db->select('a.Feedback_ID, a.title, a.created_on, b.User_ID');
        $this->db->from('tbl_feedback a');
        $this->db->join('tbl_user b', 'a.User_ID = b.User_ID');

        return $this->db->get()->result();

        $this->db->close_connection();
    }

    public function get_feedback_description(){
        $this->db->select('description');
        $this->db->from('tbl_feedback');
        $this->db->where('Feedback_ID', $this->input->post('Feedback_ID'));
        $data = $this->db->get()->row();

        echo json_encode($data);

        $this->db->close_connection();
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

        $post_data['User_Phone'] = $data['User_Phone'];
        if(empty(strpos($post_data['User_Phone'], '-'))){
            $phone_start = substr($post_data['User_Phone'], 0, 3);
            $phone_end = substr($post_data['User_Phone'], 3);
            $post_data['User_Phone'] = $phone_start . '-' . $phone_end;
        }
        
        $post_data['User_Password'] = md5($data['User_Password']);

        $row = $this->db->select('User_Password')->from('tbl_user')->where('User_ID', $_SESSION['User_ID'])->get()->row();
    
        //if not same password in db, return error message
        if($row['User_Password'] != $post_data['User_Password']){
            $post_data['error'] = 'Wrong password.';
            return $post_data;
        }

        //update profile in db
        unset($post_data['User_Password']);
        $user_id['User_ID'] = $_SESSION['User_ID'];

        $this->db->table_name = 'tbl_user';
        $this->db->update($post_data, $user_id);

        //update session data
        $_SESSION['User_Phone'] = $post_data['phone_number'];

        //redirect to profile page
        $redirect = 'profile.php';
        header('Location: ' . $redirect);
        die();

        $this->db->close_connection();
    }
	
	public function update_request_status(){
        $status['status_request'] = $this->input->post('status');
        $where['Attendee_ID'] = $this->input->post('Attendee_ID');

        $this->db->table_name = 'tbl_attendee_request';
        $this->db->update($status, $where);

        $this->db->close_connection();
    }

}

$Admin = new Admin($db_connect);
