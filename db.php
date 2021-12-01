<?php
require_once('log/log_message.php');

class db{
    public $table_name = '';
    public $primary_key = '';
    private $db_connect = '';
    private $last_query = '';
    private $query = '';
    private $result = '';

    function __construct($db_connect){
        $this->db_connect = $db_connect;
    }

    public function query($query = ''){
        $this->query = $query;
        $this->get();

        return $this;
    }

    public function insert($columns_values = []){
        $columns = array_keys($columns_values);
        $columns = implode(', ', $columns);

        $values = json_encode(array_values($columns_values));
        $values = substr($values, 1, -1);

        $this->query = "INSERT INTO $this->table_name \n($columns) \nVALUES ($values)";
        $this->get();
        return mysqli_insert_id($this->db_connect);
    }

    public function update($columns_values = [], $where = []){
        $this->query = "UPDATE $this->table_name SET \n";

        foreach($columns_values as $key => $value){
            $key = str_replace('"', '', $key);
            $key = str_replace('\'', '', $key);
            if(end($columns_values) == $value){
                $this->query .= "$key = '$value' \n";
            }
            else{
                $this->query .= "$key = '$value', \n";
            }
        }

        if(!empty($where)){
            foreach($where as $key => $value){
                $this->query .= "WHERE $key = '$value' \n";
            }
            $this->get();
        }
        return $this;
    }

    public function delete($where = [], $where_value = ''){
        $this->query = "DELETE FROM $this->table_name \n";
        if(is_array($where)){
            foreach($where as $key => $value){
                if(strpos($this->query, "WHERE") > 0){
                    $this->query .= "AND $key = '$value' \n";
                }else{
                    $this->query .= "WHERE $key = '$value' \n";
                }
            }
        }else{
            $this->query = "DELETE FROM $this->table_name WHERE $where = '$where_value'";
        }
        $this->get();
    }

    public function select($select = '*'){
        $this->query = "SELECT $select \n";

        return $this;
    }

    public function from($table_name = ''){
        $this->query .= "FROM $table_name \n";

        return $this;
    }

    public function join($table = '', $on_columns = '', $type = ''){
        $type = strtoupper($type);
        $this->query .= "$type JOIN $table ON $on_columns \n";

        return $this;
    }

    public function like($where = [], $where_value = ''){
        if(is_array($where)){
            //array
            foreach($where as $column => $value){
                if(strpos($this->query, "WHERE") > 0){
                    $this->query .= "AND $column LIKE '%$value%' \n";
                }else{
                    $this->query .= "WHERE $column LIKE '%$value%' \n";
                }
            }
        }
        else{
            if(strpos($this->query, "WHERE") > 0){ 
                //string or single value
                $this->query .= "AND $where LIKE '%$where_value%' \n";
            }else{
                //string or single value
                $this->query .= "WHERE $where LIKE '%$where_value%' \n";
            }
        }
        
        return $this;
    }

    public function like_or($where = '', $where_value = ''){
        if(is_array($where)){
            //array
            foreach($where as $column => $value){
                if(strpos($this->query, "WHERE") > 0){
                    $this->query .= "OR $column LIKE '%$value%' \n";
                }else{
                    $this->query .= "WHERE $column LIKE '%$value%' \n";
                }
            }
        }
        else{
            //string or single value
            if(strpos($this->query, "WHERE") > 0){ 
                $this->query .= "OR $where LIKE '%$where_value%' \n";
            }else{
                $this->query .= "WHERE $where LIKE '%$where_value%' \n";
            }
        }
        
        return $this;
    }

    public function where($where = [], $where_value = ''){
        if(is_array($where)){
            //array
            foreach($where as $column => $value){
                if(strpos($this->query, "WHERE") > 0){
                    $this->query .= "AND $column = '$value' \n";
                }else{
                    $this->query .= "WHERE $column = '$value' \n";
                }
            }
        }
        else{
            if($where_value == NULL){
                //NULL
                if(strpos($this->query, "WHERE") > 0){ 
                    $this->query .= "AND $where IS NULL \n";
                }else{
                    $this->query .= "WHERE $where IS NULL \n";
                }
            }else if(strpos($where, "!=") > 0 || strpos($where, ">") > 0 || strpos($where, "<") > 0){
                if(strpos($this->query, "WHERE") > 0){ 
                    $this->query .= "AND $where '$where_value' \n";
                }else{
                    $this->query .= "WHERE $where '$where_value' \n";
                }
            }else if(strpos($where, "WHERE IS NOT NULL") > 0){
                //NOT NULL
                if(strpos($this->query, "WHERE") > 0){ 
                    $this->query .= "AND $where IS NOT NULL \n";
                }else{
                    $this->query .= "WHERE $where IS NOT NULL \n";
                }
            }else if(strpos($this->query, "WHERE") > 0){ 
                //string or single value
                $this->query .= "AND $where = '$where_value' \n";
            }else{
                //string or single value
                $this->query .= "WHERE $where = '$where_value' \n";
            }
        }
        
        return $this;
    }

    public function where_or($where = [], $where_value = ''){
        if(is_array($where)){
            //array
            foreach($where as $column => $value){
                if(strpos($this->query, "WHERE") > 0){
                    $this->query .= "OR $column = '$value' \n";
                }else{
                    $this->query .= "WHERE $column = '$value' \n";
                }
            }
        }
        else{
            if($where_value == NULL){
                //NULL
                if(strpos($this->query, "WHERE") > 0){ 
                    $this->query .= "OR $where IS NULL \n";
                }else{
                    $this->query .= "WHERE $where IS NULL \n";
                }
            }else if(strpos($where, "WHERE IS NOT NULL") > 0){
                //NOT NULL
                if(strpos($this->query, "WHERE") > 0){ 
                    $this->query .= "OR $where IS NOT NULL \n";
                }else{
                    $this->query .= "WHERE $where IS NOT NULL \n";
                }
            }else if(strpos($this->query, "WHERE") > 0){ 
                //string or single value
                $this->query .= "OR $where = '$where_value' \n";
            }else{
                //string or single value
                $this->query .= "WHERE $where = '$where_value' \n";
            }
        }
        
        return $this;
    }

    public function where_in($column = '', $values = []){
        if(is_array($values)){
            $values = json_encode($values);
        }
        
        $values = str_replace('[', '(', $values);
        $values = str_replace(']', ')', $values);

        if(strpos($this->query, "WHERE") > 0){ 
            $this->query .= "AND $column IN $values \n";
        }else{
            $this->query .= "WHERE $column IN $values \n";
        }

        return $this;
    }

    public function where_not_in($column = '', $values = []){
        $values = json_encode($values);
        $values = str_replace('[', '(', $values);
        $values = str_replace(']', ')', $values);

        if(strpos($this->query, "WHERE") > 0){ 
            $this->query .= "AND $column NOT IN $values \n";
        }else{
            $this->query .= "WHERE $column NOT IN $values \n";
        }

        return $this;
    }

    public function group_by($column = ''){
        $this->query .= "GROUP BY $column \n";

        return $this;
    }

    public function having($column = '', $value = ''){
        if(strpos($this->query, "HAVING") > 0){ 
            $this->query .= "AND $column '$value' \n";
        }else{
            $this->query .= "HAVING $column '$value' \n";
        }
    }
    
    public function having_or($column = '', $value = ''){
        if(strpos($column, "LIKE") > 0){
            if(strpos($this->query, "HAVING") > 0){ 
                $this->query .= "OR $column \n";
            }else{
                $this->query .= "HAVING $column \n";
            }
        }else if(strpos($this->query, "HAVING") > 0){ 
            $this->query .= "OR $column '$value' \n";
        }else{
            $this->query .= "HAVING $column '$value' \n";
        }
    }

    public function order_by($column = '', $order = 'ASC'){
        $order = strtoupper($order);
        if(strpos($this->query, "ORDER BY") > 0){
            $this->query .= ", $column $order \n";
        }else{
            $this->query .= "ORDER BY $column $order \n";
        }

        return $this;
    }

    public function limit($limit = 0, $offset = 0){
        if(!empty($limit) && !empty($offset)){
            $this->query .= "LIMIT $limit OFFSET $offset \n";
        }else if(!empty($limit)){
            $this->query .= "LIMIT $limit \n";
        }
    }

    public function get(){
        $this->result = mysqli_query($this->db_connect, $this->query);
        $this->last_query = $this->query;

        return $this;
    }

    public function num_rows(){
        $num_rows = mysqli_num_rows($this->result);
        $this->free_result();
        return $num_rows;
    }

    public function result(){
        $all_result = array();

        if(!empty($this->result)){
            while($row = mysqli_fetch_assoc($this->result)){
                $all_result[] = $row;
            }
        }
        $this->free_result();

        if(empty($all_result)){
            $all_result = [];
        }

        return $all_result;
    }

    public function row(){
        $row_result = [];
        if(!empty($this->result)){
            $fields = mysqli_fetch_fields($this->result);
            $row = mysqli_fetch_row($this->result);

            if(!empty($row)){
                foreach($fields as $key => $value){
                    $row_result[$value->name] = $row[$key];
                }
            }
        }
        $this->free_result();

        if(empty($row_result)){
            $row_result = [];
        }

        return $row_result;
    }

    private function free_result(){
        if(empty($this->result)){
            log_message('error', 'Free result error: ' . mysqli_error($this->db_connect) . ' at ' . $_SERVER['PHP_SELF']);
            die("Free result error: " . mysqli_error($this->db_connect));
        }else{
            mysqli_free_result($this->result);
        }
    }

    public function close_connection(){
        mysqli_close($this->db_connect);
    }

    public function last_query(){
        return $this->last_query;
    }
}