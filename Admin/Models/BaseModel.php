<?php
// include('Core/Database.php');
class BaseModel extends Database
{
    protected $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    //Lấy tất cả dữ liệu
    public function getall($table){
        $sql = "SELECT * FROM $table";

        $query = $this->_query($sql);

        $data=[];

        while($row = mysqli_fetch_assoc($query)){
            array_push($data, $row);
        }
        return $data;
    }
    // public function getLastInsertedID() {
    //     $query = "SELECT LAST_INSERT_ID() as last_id";
    //     $result = $this->connect()->query($query);
    
    //     if ($result && $row = $result->fetch_assoc()) {
    //         return $row['last_id'];
    //     }
    
    //     return null;
    // }

    
    public function select($sql, $data = array(), $fetchStyle = MYSQLI_ASSOC) {
        $connection = $this->connect();
    
        if ($connection) {
            $stmt = $connection->prepare($sql);
    
            if ($stmt) {
                foreach ($data as $key => $value) {
                    $stmt->bind_param($key, $value);
                }
    
                $stmt->execute();
                $result = $stmt->get_result();
    
                $rows = array();
                while ($row = $result->fetch_array($fetchStyle)) {
                    $rows[] = $row;
                }
    
                $stmt->close();
                $connection->close();
    
                return $rows;
            } else {
                // Handle statement preparation error
                return false;
            }
        } else {
            // Handle connection error
            return false;
        }
    }
    

    public function insert($table, $data) {
        $keys = implode(",", array_keys($data));
        $values = "'" . implode("','", $data) . "'"; 
    
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        
        $connection = $this->connect(); // Gọi phương thức connect() từ lớp Database để có kết nối
    
        if ($connection) {
            $result = mysqli_query($connection, $sql);
            return $result;
        } else {
            mysqli_error($connection);
            return false;
        }
    }
    public function insertGetId($table, $data) {
        $keys = implode(",", array_keys($data));
        $values = "'" . implode("','", $data) . "'"; 
    
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
    
        $connect = $this->connect(); // Gọi phương thức connect() từ lớp Database để có kết nối
    
        if ($connect) {
            $result = mysqli_query($connect, $sql);
            if ($result) {
                // Lấy ID của bản ghi vừa được thêm vào
                $lastInsertedID = mysqli_insert_id($connect);
                return $lastInsertedID;
            } else {
                mysqli_error($connect);
                return false;
            }
        } else {
            mysqli_error($connect);
            return false;
        }
    }
    
    
    public function delete($table, $cond) {
        $sql = "DELETE FROM $table WHERE $cond";
        
        $connection = $this->connect(); // Gọi phương thức connect() từ lớp Database để có kết nối
    
        if ($connection) {
            $result = mysqli_query($connection, $sql);
            return $result;
        } else {
            // Xử lý lỗi kết nối ở đây
            return false;
        }
    }

    public function update($table, $data, $cond) {
        if (empty($data) || !is_array($data) || empty($cond)) {
            return false;
        }
    
        $updateKeys = '';
        foreach ($data as $key => $value) {
            // Escaping values to prevent SQL injection
            $escapedValue = mysqli_real_escape_string($this->connect(), $value);
            $updateKeys .= "$key = '$escapedValue',";
        }
        $updateKeys = rtrim($updateKeys, ",");
    
        $sql = "UPDATE $table SET $updateKeys WHERE $cond";
    
        $connection = $this->connect();
        if ($connection) {
            $result = mysqli_query($connection, $sql);
            return $result;
        } else {
            // Handle connection error here
            return false;
        }
    }

    public function count($table) {
        $sql = "SELECT COUNT(*) as count FROM $table";
        
        $connection = $this->connect();
        if ($connection) {
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                return $row['count'];
            } else {
                // Handle query error here
                return false;
            }
        } else {
            // Handle connection error here
            return false;
        }
    }
    
    


    private function _query($sql){
        return mysqli_query($this->connect, $sql);
    }
}