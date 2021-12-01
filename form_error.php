<?php
function form_error($field = '', $data = [], $flag = FALSE){
   $err_msg = '<div class="col-lg-12">
                    <div class="alert alert-danger">
                        {value}
                    </div>
                </div>';
    $err_label = '<label class="control-label" for="inputError">{value}</label>';

    if(!empty($data)){
        if(array_key_exists($field, $data)){
            if($field == 'error'){
                $err_msg = str_replace('{value}', $data[$field], $err_msg);
                return $err_msg;
            }else if(empty($data[$field])){
                if($flag == TRUE){
                    return 'has-error';
                }else{
                    $error = "This field cannot be empty.";
                    $err_label = str_replace('{value}', $error, $err_label);

                    return $err_label;
                }
            }
        }
    }
}