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
        $this->connect();
    }
    // public function __destruct()
    // {
    //     $this->conn->close();
    // }
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
        $this->connect();
        $sql = "SELECT * FROM $this->table WHERE $fields = '$value'";

        $sql .= " LIMIT $this->limit OFFSET $this->offset";

        $result = $this->conn->query($sql);
        $this->resetQuery();

        if ($result) {
            $returnData = array();
            while ($row = $result->fetch_object()) {
                $returnData[] = $row;
            }
            $this->conn->close();
            return $returnData;
        } else {
            // Handle the case where the query fails
            $this->conn->close();
            die("Error in SQL query: " . $this->conn->error);
        }
    }


    public function getAll()
    {
        $this->connect();
        $sql = "SELECT * FROM $this->table LIMIT ? OFFSET ?";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param('ss', $this->limit, $this->offset);
        $this->statement->execute();
        $this->resetQuery();

        $result = $this->statement->get_result();
        $returnData = [];
        while ($row = $result->fetch_object()) {
            $returnData[] = $row;
        }
        $this->conn->close();
        return $returnData;
    }
    public function get($fields, $value)
    {
        $this->connect();
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
        $this->conn->close();
    }
    public function insert($data = [])
    {
        $this->connect();
        $fields = implode(',', array_keys($data));
        $valueStr = implode(',', array_fill(0, count($data), '?'));
        $values = array_values($data);
        $sql = "INSERT INTO $this->table($fields) VALUES($valueStr)";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param(str_repeat('s', count($data)), ...$values);
        $this->statement->execute();
        $this->resetQuery();
        $this->conn->close();
        return $this->statement->affected_rows;
    }
    public function insertMultiple($dataArray = [])
    {
        $this->connect();

        if (empty($dataArray)) {
            return 0; // Return 0 affected rows if there's nothing to insert
        }

        $fields = implode(',', array_keys($dataArray[0])); // Assuming all arrays have the same keys

        $valueSets = [];
        $values = [];
        foreach ($dataArray as $data) {
            $valueStr = implode(',', array_fill(0, count($data), '?'));
            $valueSets[] = "($valueStr)";
            $values = array_merge($values, array_values($data));
        }

        $valueSetsStr = implode(',', $valueSets);

        $sql = "INSERT INTO $this->table($fields) VALUES $valueSetsStr";

        $this->statement = $this->conn->prepare($sql);

        // Dynamically bind parameters
        $bindTypes = str_repeat('s', count($dataArray[0])); // Assuming all arrays have the same structure
        $this->statement->bind_param(str_repeat('s', count($values)), ...$values);

        $this->statement->execute();
        $affectedRows = $this->statement->affected_rows;

        $this->resetQuery();
        $this->conn->close();

        return $affectedRows;
    }
    public function update($fields, $value, $data = [])
    {
        $this->connect();
        $keyValues = [];
        foreach ($data as $key => $values) {
            $keyValues[] = $key . '=?';
        }
        $setFields = implode(',', $keyValues);

        $values = array_values($data);
        $sql = "UPDATE $this->table SET $setFields WHERE $fields = '$value'";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param(str_repeat('s', count($data)), ...$values);
        $this->statement->execute();
        $this->resetQuery();
        $this->conn->close();
        return $this->statement->affected_rows;
    }
    public function delete($fields, $value)
    {
        $this->connect();
        $sql = "DELETE FROM $this->table WHERE $fields = ?";
        $this->statement = $this->conn->prepare($sql);
        $this->statement->bind_param('s', $value);
        $this->statement->execute();
        $this->resetQuery();
        $this->conn->close();
        return $this->statement->affected_rows;
    }
}
