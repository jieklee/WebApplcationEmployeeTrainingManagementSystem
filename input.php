<?php
class input{
    private $db_connect = '';

    function __construct($db_connect){
        $this->db_connect = $db_connect;
    }

    public function post($find = [], $flag = TRUE){
        $post_data = [];
        $single_data = '';

        if($flag == TRUE){
            if(!empty($find)){
                if(is_array($find)){
                    //array
                    foreach($_POST as $key => $value){
                        foreach($find as $find_key => $find_value){
                            if($key == $find_value){
                                if(is_array($value)){
                                    //value is array
                                    $post_data[$key] = json_encode($value);
                                }else{
                                    //value is not array
                                    $post_data[$key] = mysqli_real_escape_string($this->db_connect, $value);
                                }
                                break;
                            }
                        }
                    }
                }
                else{
                    //string or single value
                    foreach($_POST as $key => $value){
                        if($find == $key){
                            if(is_array($value)){
                                //value is array
                                $single_data = json_encode($value);
                            }
                            else{
                                //value is not array
                                $single_data = mysqli_real_escape_string($this->db_connect, $value);
                            }
                            return $single_data;
                        }
                    }
                }
            }
            else{
                //all except button
                foreach($_POST as $key => $value){
                    if(is_array($value)){
                        //value is array
                        $post_data[$key] = json_encode($value);
                    }
                    else{
                        //value is not array
                        $post_data[$key] = mysqli_real_escape_string($this->db_connect, $value);
                    }
                }
                array_pop($post_data);
            }
        }
        else{
            if(!empty($find)){
                if(is_array($find)){
                    //array
                    foreach($_POST as $key => $value){
                        foreach($find as $find_key => $find_value){
                            if($key == $find_value){
                                if(is_array($value)){
                                    //value is array
                                    $post_data[$key] = json_encode($value);
                                }
                                else{
                                    //value is not array
                                    $post_data[$key] = $value;
                                }
                                break;
                            }
                        }
                    }
                }
                else{
                    //string or single value
                    foreach($_POST as $key => $value){
                        if($find == $key){
                            if(is_array($value)){
                                //value is array
                                $single_data = json_encode($value);
                            }else{
                                //value is not array
                                $single_data = $value;
                            }
                            return $single_data;
                        }
                    }
                }
            }
            else{
                //all except button
                foreach($_POST as $key => $value){
                    if(is_array($value)){
                        //value is array
                        $post_data[$key] = json_encode($value);
                    }else{
                        //value is not array
                        $post_data[$key] = $value;
                    }
                }
                array_pop($post_data);
            }
        }
        
        return $post_data;
    }

    public function get($find = [], $flag = TRUE){
        $get_data = [];
        $single_data = '';

        if($flag == TRUE){
            if(!empty($find)){
                if(is_array($find)){
                    //array
                    foreach($_GET as $key => $value){
                        foreach($find as $find_key => $find_value){
                            if($key == $find_value){
                                if(is_array($value)){
                                    //value is array
                                    $get_data[$key] = json_encode($value);
                                }else{
                                    //value is not array
                                    $get_data[$key] = mysqli_real_escape_string($this->db_connect, $value);
                                }
                                break;
                            }
                        }
                    }
                }
                else{
                    //string or single value
                    foreach($_GET as $key => $value){
                        if($find == $key){
                            if(is_array($value)){
                                //value is array
                                $single_data = json_encode($value);
                            }
                            else{
                                //value is not array
                                $single_data = mysqli_real_escape_string($this->db_connect, $value);
                            }
                            return $single_data;
                        }
                    }
                }
            }
            else{
                //all except button
                foreach($_GET as $key => $value){
                    if(is_array($value)){
                        //value is array
                        $get_data[$key] = json_encode($value);
                    }
                    else{
                        //value is not array
                        $get_data[$key] = mysqli_real_escape_string($this->db_connect, $value);
                    }
                }
                array_pop($get_data);
            }
        }
        else{
            if(!empty($find)){
                if(is_array($find)){
                    //array
                    foreach($_GET as $key => $value){
                        foreach($find as $find_key => $find_value){
                            if($key == $find_value){
                                if(is_array($value)){
                                    //value is array
                                    $get_data[$key] = json_encode($value);
                                }
                                else{
                                    //value is not array
                                    $get_data[$key] = $value;
                                }
                                break;
                            }
                        }
                    }
                }
                else{
                    //string or single value
                    foreach($_GET as $key => $value){
                        if($find == $key){
                            if(is_array($value)){
                                //value is array
                                $single_data = json_encode($value);
                            }else{
                                //value is not array
                                $single_data = $value;
                            }
                            return $single_data;
                        }
                    }
                }
            }
            else{
                //all except button
                foreach($_GET as $key => $value){
                    if(is_array($value)){
                        //value is array
                        $get_data[$key] = json_encode($value);
                    }
                    else{
                        //value is not array
                        $get_data[$key] = $value;
                    }
                }
                array_pop($get_data);
            }
        }
        
        return $get_data;
    }
}