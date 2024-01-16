<?php

trait Database
{
    protected $conn = null;
    protected $table = '';
    protected $statement = '';

    protected $limit = 15;
    protected $offset = 0;

    protected $host = '';
    protected $user = '';
    protected $pass = '';
    protected $name = '';

    public function __construct()
    {
        $this->host = DBHOST;
        $this->user = DBUSER;
        $this->pass = DBPASS;
        $this->name = DBNAME;
        //
        $this->connect();
    }
    public function __destruct()
    {
        $this->conn->close();
    }
    protected function connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if ($this->conn->connect_errno) {
            exit($this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }
    public function table($tableName)
    {
        $this->table = $tableName;
        return $this;
    }
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
    public function resetQuery()
    {
        $this->table = '';
        $this->limit = 15;
        $this->offset = 0;
    }

    public function getListItemsWithCondition($fields, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $fields = '$value'";

        $sql .= " LIMIT $this->limit OFFSET $this->offset";

        $result = $this->conn->query($sql);
        $this->resetQuery();

        if ($result) {
            $returnData = array();
            while ($row = $result->fetch_object()) {
                $returnData[] = $row;
            }
            return $returnData;
        } else {
            // Handle the case where the query fails
            die("Error in SQL query: " . $this->conn->error);
        }
    }


    public function get()
    {
        $sql = "SELECT * FROM $this->table LIMIT ? OFFSET ?";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param('ii', $this->limit, $this->offset);
        $this->statement->execute();
        $this->resetQuery();

        $result = $this->statement->get_result();
        $returnData = [];
        while ($row = $result->fetch_object()) {
            $returnData[] = $row;
        }
        return $returnData;
    }
    public function getOne($fields, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $fields = '$value'";
        $result = $this->conn->query($sql);
        $this->resetQuery();

        if ($result) {
            $returnData = $result->fetch_object();
            return $returnData;
        } else {
            // Handle the case where the query fails
            die("Error in SQL query: " . $this->conn->error);
        }
    }
    public function insert($data = [])
    {
        $fields = implode(',', array_keys($data));
        $valueStr = implode(',', array_fill(0, count($data), '?'));
        $values = array_values($data);
        $sql = "INSERT INTO $this->table($fields) VALUES($valueStr)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param(str_repeat('s', count($data)), ...$values);
        $this->statement->execute();
        $this->resetQuery();

        return $this->statement->affected_rows;
    }
    public function update($fields, $value, $data = [])
    {
        $keyValues = [];
        foreach ($data as $key => $values) {
            $keyValues[] = $key . '=?';
        }
        $setFields = implode(',', $keyValues);

        $values = array_values($data);
        $sql = "UPDATE $this->table SET $setFields WHERE $fields = $value";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param(str_repeat('s', count($data)), ...$values);
        $this->statement->execute();
        $this->resetQuery();

        return $this->statement->affected_rows;
    }
    public function deleteOne($fields, $value)
    {
        $sql = "DELETE FROM $this->table WHERE $fields = ?";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param('i', $value);
        $this->statement->execute();
        $this->resetQuery();

        return $this->statement->affected_rows;
    }
}
