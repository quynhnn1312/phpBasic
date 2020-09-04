<?php
namespace Database;

use Connection\Connection;

abstract class AbstractDatabase
{
    /**
     * @var Connection
     */
    protected $connection;

    public function __construct()
    {
        //Inject đối tượng connection tại đây
        $this->connection = new Connection();
        $this->connection = $this->connection->connect;
    }

    /**
     * @param $tableName
     * @param null $condition
     * @return array
     */
    public function fetch($tableName, $condition = null) {
        //Todo
        // Xu dụng connection để lấy  các bản ghỉ
        // Thục thi query
        // Trả kết quả select
        if($condition == null) {
            $sql = "select * from $tableName";
        }else{
            $sql = "select * from $tableName where $condition";
        }

        $stmt = $this->connection->query($sql);
        return $stmt->fetch_all(MYSQLI_ASSOC);

    }

    public function insert($tableName, $data) {
        //Todo
        // Build query
        // Thục thi query
        // Tra lại kết qủa sau khi insert
        $sql = "insert into $tableName";
        $cols = " (";
        $vals = " (";
        $incognito = "";
        foreach ($data as $key => $value) {
            $cols .= " $key,";
            $vals .= " ?,";

            if(gettype($value) == 'string') $incognito .= "s";
            if(gettype($value) == 'double') $incognito .= "d";
            if(gettype($value) == 'integer') $incognito .= "i";
        }

        $cols = rtrim($cols, ',');
        $vals = rtrim($vals, ',');
        $cols .= ") ";
        $vals .= ") ";
        $sql .= $cols . 'values' . $vals;

        $stmt = $this->connection->prepare($sql);
        $data = array_values($data);
        $stmt->bind_param($incognito, ...$data);

        $result = $stmt->execute();

        if(!$result) return false;
        return true;
    }

    public function update($tableName, $data, $condition) {
        //Todo
        // Build query update
        // Thục thi query
        // Tra lại kết qủa sau khi update
        $sql = "update $tableName set ";
        $incognito = "";
        foreach ($data as $key => $value) {
            $sql .= " $key = ?,";

            if(gettype($value) == 'string') $incognito .= "s";
            if(gettype($value) == 'double') $incognito .= "d";
            if(gettype($value) == 'integer') $incognito .= "i";
        }
        $sql = rtrim($sql, ',');
        $sql .= " where $condition";
        $stmt = $this->connection->prepare($sql);
        $data = array_values($data);
        $stmt->bind_param($incognito, ...$data);
        $result = $stmt->execute();
        var_dump($result); die();
        if(!$result) return false;
        return true;
    }

    public function delete($tableName, $id) {
        //Todo
        // Build query delete
        // Thực thi query
        // Trả kết quả xóa thành công hay khong
        if(!$id) return false;

        $sql = "delete from $tableName where id = $id";
        $result = $this->connection->query($sql);
        if (!$result === TRUE) {
            return false;
        }

        return true;
    }

}

